@if(Auth::check() && Auth::user()->role === 'pengusaha')
    <!-- Report Button -->
    <div class="mt-2">
        <button onclick="openReportModal({{ $review->id }})" 
                class="text-sm text-red-600 hover:text-red-800 flex items-center">
            <svg class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
            </svg>
            Laporkan
        </button>
    </div>

    <!-- Report Modal -->
    <div id="reportModal{{ $review->id }}" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
            <div class="relative bg-white rounded-lg max-w-md w-full mx-auto shadow-xl">
                <form method="POST" action="{{ route('review.report.store', $review->id) }}">
                    @csrf
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Laporkan Ulasan</h3>
                        <p class="text-sm text-gray-500 mt-1">Laporkan ulasan yang tidak pantas atau melanggar kebijakan</p>
                    </div>
                    <div class="px-6 py-4 space-y-4">
                        <div>
                            <label for="reason{{ $review->id }}" class="block text-sm font-medium text-gray-700">Alasan Laporan</label>
                            <select name="reason" id="reason{{ $review->id }}" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500">
                                <option value="">Pilih alasan</option>
                                <option value="spam">Spam</option>
                                <option value="inappropriate_content">Konten Tidak Pantas</option>
                                <option value="fake_review">Review Palsu</option>
                                <option value="harassment">Pelecehan</option>
                                <option value="off_topic">Tidak Relevan</option>
                                <option value="other">Lainnya</option>
                            </select>
                        </div>
                        <div>
                            <label for="description{{ $review->id }}" class="block text-sm font-medium text-gray-700">Deskripsi (Opsional)</label>
                            <textarea name="description" id="description{{ $review->id }}" rows="3"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500"
                                placeholder="Jelaskan lebih detail tentang laporan Anda..."></textarea>
                        </div>
                    </div>
                    <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                        <button type="button" onclick="closeReportModal({{ $review->id }})"
                            class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-red-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-red-700">
                            Kirim Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openReportModal(reviewId) {
            document.getElementById('reportModal' + reviewId).classList.remove('hidden');
        }

        function closeReportModal(reviewId) {
            document.getElementById('reportModal' + reviewId).classList.add('hidden');
        }

        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target.id && event.target.id.startsWith('reportModal')) {
                closeReportModal(event.target.id.replace('reportModal', ''));
            }
        });
    </script>
@endif
