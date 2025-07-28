@if (Auth::check() && Auth::user()->role === 'pengusaha')
    <!-- Report Button - Enhanced Design with Data Attributes -->
    <div class="mt-3 flex justify-end">
        <button onclick="openReportModal({{ $review->id }})" data-review-id="{{ $review->id }}"
            data-review-user="{{ $review->user->name }}" data-review-comment="{{ Str::limit($review->comment, 200) }}"
            data-review-rating="{{ $review->rating }}"
            class="inline-flex items-center px-3 py-2 text-xs font-medium text-red-600 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100 hover:text-red-700 hover:border-red-300 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-20">
            <svg class="h-4 w-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
            </svg>
            Laporkan Ulasan
        </button>
    </div>

    <!-- Enhanced JavaScript with Better UX -->
    <script>
        function openReportModal(reviewId) {
            // Create modal content
            const modalContent = createReportModalContent(reviewId);

            // Create modal container at body level
            const modal = document.createElement('div');
            modal.id = 'reportModal' + reviewId;
            modal.className = 'fixed inset-0 z-[9999] overflow-y-auto';
            modal.style.cssText = 'backdrop-filter: blur(4px); opacity: 0; transition: opacity 0.2s ease-in-out;';
            modal.innerHTML = modalContent;

            // Append to body (not inside any container)
            document.body.appendChild(modal);

            // Add smooth animation
            setTimeout(() => {
                modal.style.opacity = '1';
                const modalInner = modal.querySelector('.relative');
                modalInner.style.transform = 'scale(1)';
                modalInner.style.opacity = '1';
            }, 10);

            // Focus on reason select
            setTimeout(() => {
                const reasonSelect = document.getElementById('reason' + reviewId);
                if (reasonSelect) reasonSelect.focus();
            }, 100);

            // Prevent body scroll
            document.body.style.overflow = 'hidden';

            // Add event listeners
            addModalEventListeners(modal, reviewId);
        }

        function closeReportModal(reviewId) {
            const modal = document.getElementById('reportModal' + reviewId);
            if (!modal) return;

            const modalContent = modal.querySelector('.relative');

            // Add smooth animation
            modal.style.opacity = '0';
            if (modalContent) {
                modalContent.style.transform = 'scale(0.95)';
                modalContent.style.opacity = '0';
            }

            setTimeout(() => {
                // Remove modal from DOM
                if (modal.parentNode) {
                    modal.parentNode.removeChild(modal);
                }
                // Restore body scroll
                document.body.style.overflow = 'auto';
            }, 200);
        }

        function createReportModalContent(reviewId) {
            // Enhanced data extraction with data attributes as priority
            let reviewUser = 'User';
            let reviewComment = 'Ulasan tidak ditemukan';
            let reviewRating = 5;

            // Find the report button that was clicked
            const reportButton = document.querySelector(`button[data-review-id="${reviewId}"]`) ||
                document.querySelector(`button[onclick*="openReportModal(${reviewId})"]`);


            // Strategy 1: Get data from button attributes (most reliable)
            if (reportButton) {
                const userData = reportButton.getAttribute('data-review-user');
                const commentData = reportButton.getAttribute('data-review-comment');
                const ratingData = reportButton.getAttribute('data-review-rating');

                if (userData) reviewUser = userData;
                if (commentData) reviewComment = commentData;
                if (ratingData) reviewRating = parseInt(ratingData) || 5;
            }

            // Strategy 2: Fallback to DOM extraction if data attributes not available
            if (reviewUser === 'User' || reviewComment === 'Ulasan tidak ditemukan') {
                let reviewElement = null;

                if (reportButton) {
                    reviewElement = reportButton.closest('.bg-white') ||
                        reportButton.closest('[class*="review"]') ||
                        reportButton.closest('.space-y-6') ||
                        reportButton.closest('.rounded-xl');
                }

                console.log('Found review element:', reviewElement);

                if (reviewElement) {
                    try {
                        // Find user name - try multiple selectors
                        const userSelectors = [
                            '.font-semibold',
                            '.font-bold',
                            '.font-medium',
                            '[class*="font-semibold"]',
                            '[class*="font-bold"]',
                            'h4',
                            'h3'
                        ];

                        for (let selector of userSelectors) {
                            const userEl = reviewElement.querySelector(selector);
                            if (userEl && userEl.textContent.trim() &&
                                !userEl.textContent.includes('Rating') &&
                                !userEl.textContent.includes('Detail') &&
                                !userEl.textContent.includes('Laporkan') &&
                                reviewUser === 'User') {
                                reviewUser = userEl.textContent.trim();
                                break;
                            }
                        }

                        // Find comment - look for paragraphs or text elements
                        const commentSelectors = [
                            'p:not([class*="text-xs"]):not([class*="text-sm"])',
                            '.text-gray-700',
                            '.text-gray-600',
                            'div[class*="text-"]:not([class*="text-xs"]):not([class*="text-sm"])'
                        ];

                        for (let selector of commentSelectors) {
                            const commentEl = reviewElement.querySelector(selector);
                            if (commentEl && commentEl.textContent.trim().length > 10 &&
                                !commentEl.textContent.includes('Rating') &&
                                !commentEl.textContent.includes('Laporkan') &&
                                reviewComment === 'Ulasan tidak ditemukan') {
                                reviewComment = commentEl.textContent.trim();
                                break;
                            }
                        }

                        // Find rating - count yellow stars
                        if (reviewRating === 5) { // Only if not set from attributes
                            const yellowStars = reviewElement.querySelectorAll(
                                '.text-yellow-400, [class*="text-yellow-400"]');
                            if (yellowStars.length > 0 && yellowStars.length <= 5) {
                                reviewRating = yellowStars.length;
                            } else {
                                // Try to find rating in text (like "4/5")
                                const ratingText = reviewElement.textContent.match(/(\d+)\/5/);
                                if (ratingText) {
                                    reviewRating = parseInt(ratingText[1]);
                                }
                            }
                        }

                        console.log('Final extracted data:', {
                            reviewUser,
                            reviewComment,
                            reviewRating
                        });
                    } catch (e) {
                        console.error('Error extracting review data:', e);
                    }
                }
            }

            // Escape HTML characters in user input
            reviewUser = reviewUser.replace(/[<>&"]/g, function(match) {
                return {
                    '<': '&lt;',
                    '>': '&gt;',
                    '&': '&amp;',
                    '"': '&quot;'
                } [match];
            });

            reviewComment = reviewComment.replace(/[<>&"]/g, function(match) {
                return {
                    '<': '&lt;',
                    '>': '&gt;',
                    '&': '&amp;',
                    '"': '&quot;'
                } [match];
            });

            // Generate star rating HTML
            const starsHtml = Array.from({
                    length: 5
                }, (_, i) =>
                `<svg class="w-3 h-3 ${i < reviewRating ? 'text-yellow-400' : 'text-gray-300'}" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>`
            ).join('');

            return `
                <div class="flex items-center justify-center min-h-screen px-4 py-6">
                    <!-- Backdrop -->
                    <div class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity backdrop-click"></div>
                    
                    <!-- Modal Content -->
                    <div class="relative bg-white rounded-2xl max-w-lg w-full mx-auto shadow-2xl transform transition-all" style="transform: scale(0.95); opacity: 0; transition: all 0.2s ease-in-out;">
                        <!-- Header -->
                        <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-red-50 to-orange-50 rounded-t-2xl">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center">
                                        <svg class="w-5 h-5 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-lg font-semibold text-gray-900">Laporkan Ulasan</h3>
                                        <p class="text-sm text-gray-600">Bantu kami menjaga kualitas ulasan</p>
                                    </div>
                                </div>
                                <button type="button" class="close-modal-btn text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg p-1.5 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Form -->
                        <form method="POST" action="/review/${reviewId}/report" class="p-6 space-y-6">
                            <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''}">
                            
                            <!-- Review Info -->
                            <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                                <h4 class="text-sm font-medium text-gray-700 mb-2">Ulasan yang Dilaporkan:</h4>
                                <div class="text-sm text-gray-600">
                                    <div class="flex items-center mb-1">
                                        <span class="font-medium">${reviewUser}</span>
                                        <div class="flex items-center ml-2">
                                            ${starsHtml}
                                            <span class="ml-1 text-xs text-gray-500">${reviewRating}/5</span>
                                        </div>
                                    </div>
                                    <p class="text-gray-600 mt-2">"${reviewComment.length > 100 ? reviewComment.substring(0, 100) + '...' : reviewComment}"</p>
                                </div>
                            </div>

                            <!-- Reason Selection -->
                            <div class="space-y-3">
                                <label class="block text-sm font-semibold text-gray-700">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Alasan Laporan
                                    </span>
                                </label>
                                <select name="reason" id="reason${reviewId}" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all bg-white">
                                    <option value="">Pilih alasan pelaporan</option>
                                    <option value="spam">🚫 Spam atau Konten Berulang</option>
                                    <option value="inappropriate_content">⚠️ Konten Tidak Pantas</option>
                                    <option value="fake_review">🎭 Review Palsu atau Tidak Asli</option>
                                    <option value="harassment">😡 Pelecehan atau Kata Kasar</option>
                                    <option value="off_topic">📝 Tidak Relevan dengan Tempat</option>
                                    <option value="misleading">🔍 Informasi Menyesatkan</option>
                                    <option value="other">❓ Lainnya</option>
                                </select>
                            </div>

                            <!-- Description -->
                            <div class="space-y-3">
                                <label for="description${reviewId}" class="block text-sm font-semibold text-gray-700">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-1.586l-4 4z"></path>
                                        </svg>
                                        Deskripsi Detail <span class="text-gray-500 font-normal">(Opsional)</span>
                                    </span>
                                </label>
                                <textarea name="description" id="description${reviewId}" rows="4"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all resize-none"
                                    placeholder="Jelaskan lebih detail mengapa ulasan ini tidak pantas atau melanggar kebijakan..."></textarea>
                                <p class="text-xs text-gray-500">💡 Penjelasan yang detail akan membantu tim kami memproses laporan dengan lebih baik</p>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-100">
                                <button type="button" class="cancel-btn flex-1 px-6 py-3 border border-gray-300 rounded-xl text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 hover:border-gray-400 transition-all focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-20">
                                    <span class="flex items-center justify-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        Batal
                                    </span>
                                </button>
                                <button type="submit"
                                    class="submit-btn flex-1 px-6 py-3 bg-gradient-to-r from-red-600 to-red-700 border border-transparent rounded-xl text-sm font-medium text-white hover:from-red-700 hover:to-red-800 transition-all focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-30 shadow-md hover:shadow-lg">
                                    <span class="flex items-center justify-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                        </svg>
                                        Kirim Laporan
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            `;
        }

        function addModalEventListeners(modal, reviewId) {
            // Close button
            const closeBtn = modal.querySelector('.close-modal-btn');
            if (closeBtn) {
                closeBtn.addEventListener('click', () => closeReportModal(reviewId));
            }

            // Cancel button
            const cancelBtn = modal.querySelector('.cancel-btn');
            if (cancelBtn) {
                cancelBtn.addEventListener('click', () => closeReportModal(reviewId));
            }

            // Backdrop click
            const backdrop = modal.querySelector('.backdrop-click');
            if (backdrop) {
                backdrop.addEventListener('click', () => closeReportModal(reviewId));
            }

            // Form submission
            const form = modal.querySelector('form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    const submitBtn = this.querySelector('.submit-btn');
                    const originalText = submitBtn.innerHTML;

                    submitBtn.disabled = true;
                    submitBtn.innerHTML = `
                        <span class="flex items-center justify-center">
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Mengirim...
                        </span>
                    `;
                });
            }
        }

        // Global event listeners
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const visibleModal = document.querySelector('[id^="reportModal"]:not(.hidden)');
                if (visibleModal) {
                    const reviewId = visibleModal.id.replace('reportModal', '');
                    closeReportModal(reviewId);
                }
            }
        });

        // Clean up any existing modals on page unload
        window.addEventListener('beforeunload', function() {
            const modals = document.querySelectorAll('[id^="reportModal"]');
            modals.forEach(modal => {
                if (modal.parentNode) {
                    modal.parentNode.removeChild(modal);
                }
            });
            document.body.style.overflow = 'auto';
        });
    </script>
@endif
