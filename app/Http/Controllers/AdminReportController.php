<?php

namespace App\Http\Controllers;

use App\Models\ReviewReport;
use App\Models\UserWarning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminReportController extends Controller
{
  public function index()
  {
    $reports = ReviewReport::with(['review.user', 'foodPlace', 'reporter'])
      ->orderBy('status', 'asc') // pending first
      ->orderBy('created_at', 'desc')
      ->paginate(15);

    $stats = [
      'pending' => ReviewReport::where('status', 'pending')->count(),
      'approved' => ReviewReport::where('status', 'approved')->count(),
      'rejected' => ReviewReport::where('status', 'rejected')->count(),
    ];

    return view('admin.reports.index', compact('reports', 'stats'));
  }

  public function show($id)
  {
    $report = ReviewReport::with(['review.user', 'foodPlace', 'reporter', 'reviewer'])
      ->findOrFail($id);

    return view('admin.reports.show', compact('report'));
  }

  public function approve(Request $request, $id)
  {
    $request->validate([
      'admin_notes' => 'nullable|string|max:1000',
      'action' => 'required|in:warning,suspend_3_days,suspend_7_days,suspend_30_days,permanent_ban'
    ]);

    $report = ReviewReport::findOrFail($id);

    if ($report->status !== 'pending') {
      return back()->with('error', 'Laporan ini sudah ditinjau sebelumnya.');
    }

    DB::transaction(function () use ($report, $request) {
      // Update report status
      $report->update([
        'status' => 'approved',
        'reviewed_by' => Auth::id(),
        'admin_notes' => $request->admin_notes,
        'reviewed_at' => now(),
      ]);

      $reviewUser = $report->review->user;

      // Apply action based on admin decision
      switch ($request->action) {
        case 'warning':
          $this->issueWarning($report, $reviewUser);
          break;

        case 'suspend_3_days':
          $this->suspendUser($report, $reviewUser, '3 days');
          break;

        case 'suspend_7_days':
          $this->suspendUser($report, $reviewUser, '7 days');
          break;

        case 'suspend_30_days':
          $this->suspendUser($report, $reviewUser, '30 days');
          break;

        case 'permanent_ban':
          $this->banUser($report, $reviewUser);
          break;
      }

      // Hide the reported review
      $report->review->update(['is_hidden' => true]);
    });

    return redirect()->route('admin.reports.index')
      ->with('success', 'Laporan berhasil disetujui dan tindakan telah diambil.');
  }

  public function reject(Request $request, $id)
  {
    $request->validate([
      'admin_notes' => 'required|string|max:1000',
    ]);

    $report = ReviewReport::findOrFail($id);

    if ($report->status !== 'pending') {
      return back()->with('error', 'Laporan ini sudah ditinjau sebelumnya.');
    }

    $report->update([
      'status' => 'rejected',
      'reviewed_by' => Auth::id(),
      'admin_notes' => $request->admin_notes,
      'reviewed_at' => now(),
    ]);

    return redirect()->route('admin.reports.index')
      ->with('success', 'Laporan berhasil ditolak.');
  }

  private function issueWarning($report, $user)
  {
    $warningCount = $user->activeWarnings()->count();

    $warningTypes = [
      0 => 'first_warning',
      1 => 'second_warning',
      2 => 'final_warning'
    ];

    $warningType = $warningTypes[$warningCount] ?? 'final_warning';

    UserWarning::create([
      'user_id' => $user->id,
      'review_report_id' => $report->id,
      'warning_type' => $warningType,
      'reason' => "Pelanggaran: {$report->reason_label}",
      'issued_by' => Auth::id(),
    ]);

    $user->addWarning();
  }

  private function suspendUser($report, $user, $duration)
  {
    $user->suspend("Pelanggaran: {$report->reason_label}", $duration);

    // Issue warning as well
    $this->issueWarning($report, $user);
  }

  private function banUser($report, $user)
  {
    $user->suspend("Pelanggaran berat: {$report->reason_label}");

    // Issue final warning
    UserWarning::create([
      'user_id' => $user->id,
      'review_report_id' => $report->id,
      'warning_type' => 'final_warning',
      'reason' => "Banned permanently: {$report->reason_label}",
      'issued_by' => Auth::id(),
    ]);

    $user->update(['warning_count' => 3]); // Max warnings
  }
}
