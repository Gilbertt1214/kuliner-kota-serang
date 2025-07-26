<?php

namespace App\Http\Controllers;

use App\Models\ReviewReport;
use App\Models\Review;
use App\Models\FoodPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewReportController extends Controller
{
  public function store(Request $request, $reviewId)
  {
    $request->validate([
      'reason' => 'required|in:spam,inappropriate_content,fake_review,harassment,off_topic,other',
      'description' => 'nullable|string|max:1000',
    ]);

    $review = Review::findOrFail($reviewId);

    // Check if user owns the food place (only pengusaha can report)
    if (Auth::user()->role !== 'pengusaha') {
      return back()->with('error', 'Hanya pengusaha yang dapat melaporkan ulasan.');
    }

    // Check if food place belongs to current user
    if ($review->foodPlace->user_id !== Auth::id()) {
      return back()->with('error', 'Anda hanya dapat melaporkan ulasan untuk tempat kuliner Anda sendiri.');
    }

    // Check if already reported
    $existingReport = ReviewReport::where('review_id', $reviewId)
      ->where('reporter_id', Auth::id())
      ->where('status', 'pending')
      ->first();

    if ($existingReport) {
      return back()->with('error', 'Anda sudah melaporkan ulasan ini sebelumnya.');
    }

    ReviewReport::create([
      'review_id' => $reviewId,
      'reporter_id' => Auth::id(),
      'food_place_id' => $review->food_place_id,
      'reason' => $request->reason,
      'description' => $request->description,
    ]);

    return back()->with('success', 'Laporan berhasil dikirim dan akan ditinjau oleh admin.');
  }

  public function index()
  {
    if (Auth::user()->role !== 'pengusaha') {
      abort(403);
    }

    $reports = ReviewReport::with(['review.user', 'foodPlace'])
      ->where('reporter_id', Auth::id())
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('admin.reports.index', compact('reports'));
  }
}
