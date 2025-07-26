@extends('layouts.admin')

@section('title', 'Detail Laporan Review')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.reports.index') }}" 
                       class="text-gray-500 hover:text-gray-700 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Detail Laporan Review</h1>
                        <p class="text-gray-600 mt-1">ID Laporan: #{{ $report->id }}</p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="px-3 py-1 rounded-full text-sm font-medium 
                        {{ $report->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                           ($report->status === 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                        {{ ucfirst($report->status) }}
                    </span>
                    <span class="text-sm text-gray-500">
                        {{ $report->created_at->format('d M Y, H:i') }}
                    </span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Report Details -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                        Detail Laporan
                    </h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Alasan Laporan</label>
                            <div class="flex items-center space-x-2">
                                <span class="px-2 py-1 bg-red-100 text-red-800 text-sm rounded">
                                    {{ $report->reason_label }}
                                </span>
                            </div>
                        </div>

                        @if($report->description)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Tambahan</label>
                            <div class="bg-gray-50 rounded-lg p-4 border">
                                <p class="text-gray-700 leading-relaxed">{{ $report->description }}</p>
                            </div>
                        </div>
                        @endif

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Dilaporkan oleh</label>
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                    <span class="text-blue-600 font-medium text-sm">
                                        {{ substr($report->reporter->name, 0, 1) }}
                                    </span>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">{{ $report->reporter->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $report->reporter->email }}</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tempat Makan</label>
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">{{ $report->foodPlace->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $report->foodPlace->location }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reported Review -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        Review yang Dilaporkan
                    </h2>

                    <div class="border border-gray-200 rounded-lg p-4 {{ $report->review->is_hidden ? 'bg-red-50 border-red-200' : 'bg-gray-50' }}">
                        @if($report->review->is_hidden)
                        <div class="flex items-center mb-3 text-red-600">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L12 12m3.121-3.121L21 21m-6.878-6.878L12 12"/>
                            </svg>
                            <span class="text-sm font-medium">Review ini telah disembunyikan</span>
                        </div>
                        @endif

                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                                    <span class="text-gray-600 font-medium">
                                        {{ substr($report->review->user->name, 0, 1) }}
                                    </span>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">{{ $report->review->user->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $report->review->created_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-4 h-4 {{ $i <= $report->review->rating ? 'text-yellow-400' : 'text-gray-300' }}" 
                                         fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                                <span class="ml-1 text-sm text-gray-600">{{ $report->review->rating }}/5</span>
                            </div>
                        </div>

                        @if($report->review->comment)
                        <div class="mb-3">
                            <p class="text-gray-700 leading-relaxed">{{ $report->review->comment }}</p>
                        </div>
                        @endif

                        @if($report->review->tags && count($report->review->tags) > 0)
                        <div class="flex flex-wrap gap-2 mb-3">
                            @foreach($report->review->tags as $tag)
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                                    #{{ $tag }}
                                </span>
                            @endforeach
                        </div>
                        @endif

                        @if($report->review->photos && count($report->review->photos) > 0)
                        <div class="grid grid-cols-3 gap-2">
                            @foreach($report->review->photos as $photo)
                                <img src="{{ asset('storage/' . $photo) }}" 
                                     alt="Review Photo" 
                                     class="w-full h-20 object-cover rounded-lg">
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Admin Notes -->
                @if($report->admin_notes)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Catatan Admin
                    </h2>
                    <div class="bg-purple-50 rounded-lg p-4 border border-purple-200">
                        <p class="text-gray-700 leading-relaxed">{{ $report->admin_notes }}</p>
                        @if($report->reviewer)
                        <div class="mt-3 pt-3 border-t border-purple-200">
                            <p class="text-sm text-purple-600">
                                Ditinjau oleh: {{ $report->reviewer->name }} pada {{ $report->reviewed_at->format('d M Y, H:i') }}
                            </p>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar Actions -->
            <div class="space-y-6">
                <!-- Quick Actions -->
                @if($report->status === 'pending')
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Tindakan</h3>
                    
                    <div class="space-y-3">
                        <button onclick="openApprovalModal()" 
                                class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Setujui Laporan
                        </button>
                        
                        <button onclick="openRejectionModal()" 
                                class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Tolak Laporan
                        </button>
                    </div>
                </div>
                @endif

                <!-- Report Information -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Laporan</h3>
                    
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">ID:</span>
                            <span class="font-medium">#{{ $report->id }}</span>
                        </div>
                        
                        <div class="flex justify-between">
                            <span class="text-gray-600">Status:</span>
                            <span class="px-2 py-1 rounded-full text-xs font-medium 
                                {{ $report->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                   ($report->status === 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                                {{ ucfirst($report->status) }}
                            </span>
                        </div>
                        
                        <div class="flex justify-between">
                            <span class="text-gray-600">Dibuat:</span>
                            <span class="font-medium">{{ $report->created_at->format('d M Y') }}</span>
                        </div>
                        
                        @if($report->reviewed_at)
                        <div class="flex justify-between">
                            <span class="text-gray-600">Ditinjau:</span>
                            <span class="font-medium">{{ $report->reviewed_at->format('d M Y') }}</span>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- User Information -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Info Pengguna</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pelapor</label>
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                    <span class="text-blue-600 font-medium text-sm">
                                        {{ substr($report->reporter->name, 0, 1) }}
                                    </span>
                                </div>
                                <div>
                                    <p class="font-medium text-sm">{{ $report->reporter->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $report->reporter->role }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pemilik Review</label>
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                                    <span class="text-gray-600 font-medium text-sm">
                                        {{ substr($report->review->user->name, 0, 1) }}
                                    </span>
                                </div>
                                <div>
                                    <p class="font-medium text-sm">{{ $report->review->user->name }}</p>
                                    <p class="text-xs text-gray-500">
                                        {{ $report->review->user->warning_count ?? 0 }} peringatan
                                        @if($report->review->user->suspended_until)
                                            | Disuspend sampai {{ \Carbon\Carbon::parse($report->review->user->suspended_until)->format('d M Y') }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Approval Modal -->
<div id="approvalModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Setujui Laporan</h3>
                <button onclick="closeApprovalModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <form action="{{ route('admin.reports.approve', $report->id) }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tindakan terhadap pengguna</label>
                    <select name="action" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        <option value="">Pilih tindakan...</option>
                        <option value="warning">Peringatan saja</option>
                        <option value="suspend_3_days">Suspend 3 hari</option>
                        <option value="suspend_7_days">Suspend 7 hari</option>
                        <option value="suspend_30_days">Suspend 30 hari</option>
                        <option value="permanent_ban">Ban permanen</option>
                    </select>
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Catatan admin (opsional)</label>
                    <textarea name="admin_notes" rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                              placeholder="Tambahkan catatan mengenai keputusan ini..."></textarea>
                </div>
                
                <div class="flex space-x-3">
                    <button type="button" onclick="closeApprovalModal()" 
                            class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                    <button type="submit" 
                            class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                        Setujui
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Rejection Modal -->
<div id="rejectionModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Tolak Laporan</h3>
                <button onclick="closeRejectionModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <form action="{{ route('admin.reports.reject', $report->id) }}" method="POST">
                @csrf
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alasan penolakan</label>
                    <textarea name="admin_notes" rows="4" required
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                              placeholder="Jelaskan mengapa laporan ini ditolak..."></textarea>
                </div>
                
                <div class="flex space-x-3">
                    <button type="button" onclick="closeRejectionModal()" 
                            class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                    <button type="submit" 
                            class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                        Tolak
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openApprovalModal() {
    document.getElementById('approvalModal').classList.remove('hidden');
    document.getElementById('approvalModal').classList.add('flex');
}

function closeApprovalModal() {
    document.getElementById('approvalModal').classList.add('hidden');
    document.getElementById('approvalModal').classList.remove('flex');
}

function openRejectionModal() {
    document.getElementById('rejectionModal').classList.remove('hidden');
    document.getElementById('rejectionModal').classList.add('flex');
}

function closeRejectionModal() {
    document.getElementById('rejectionModal').classList.add('hidden');
    document.getElementById('rejectionModal').classList.remove('flex');
}

// Close modals when clicking outside
document.addEventListener('click', function(e) {
    if (e.target.id === 'approvalModal') closeApprovalModal();
    if (e.target.id === 'rejectionModal') closeRejectionModal();
});

// Close modals with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeApprovalModal();
        closeRejectionModal();
    }
});
</script>
@endsection
