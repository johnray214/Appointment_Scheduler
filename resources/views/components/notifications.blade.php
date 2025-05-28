@if (auth()->check())
    @php
        $notifications = auth()->user()->unreadNotifications;
        $notificationsId = 'notifications-' . uniqid();
    @endphp

    <div class="relative" id="{{ $notificationsId }}">
        <button 
            id="notificationButton" 
            class="relative p-2 text-gray-700 hover:text-gray-900 focus:outline-none notification-button"
            aria-expanded="false"
            aria-controls="notificationPanel"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            @if($notifications->count() > 0)
                <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500 notification-badge"></span>
            @endif
        </button>

        <div 
            id="notificationPanel"
            class="absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg overflow-hidden z-50 notification-panel"
            style="display: none;"
            role="dialog"
            aria-labelledby="notificationButton"
            aria-hidden="true"
        >
            <div class="px-4 py-2 bg-gray-100 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-sm font-medium text-gray-700">Notifications</h3>
                    @if($notifications->count() > 0)
                        <button 
                            class="text-xs text-blue-600 hover:text-blue-800 mark-all-read"
                            type="button"
                            onclick="markAllAsRead()"
                        >
                            Mark all as read
                        </button>
                    @endif
                </div>
            </div>
            
            <div class="divide-y divide-gray-200 max-h-96 overflow-y-auto">
                @forelse($notifications as $notification)
                    <a 
                        href="{{ $notification->data['link'] ?? '#' }}" 
                        class="block px-4 py-3 hover:bg-gray-50 transition-colors duration-150"
                        wire:click.prevent="markAsRead('{{ $notification->id }}', '{{ $notification->data['link'] ?? '#' }}')"
                    >
                        <div class="flex items-start">
                            <div class="flex-shrink-0 pt-0.5">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">
                                    {{ $notification->data['message'] ?? 'New notification' }}
                                </p>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $notification->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="px-4 py-3 text-center text-sm text-gray-500">
                        No new notifications
                    </div>
                @endforelse
            </div>
            
            @if($notifications->count() > 0)
                <div class="px-4 py-2 bg-gray-50 border-t border-gray-200 text-center">
                    <a 
                        href="{{ route('notifications.index') }}" 
                        class="text-sm font-medium text-blue-600 hover:text-blue-800"
                    >
                        View all notifications
                    </a>
                </div>
            @endif
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('{{ $notificationsId }}');
        const button = container.querySelector('.notification-button');
        const panel = container.querySelector('.notification-panel');
        const badge = container.querySelector('.notification-badge');
        let isOpen = false;

        // Toggle notifications panel
        function toggleNotifications() {
            isOpen = !isOpen;
            panel.style.display = isOpen ? 'block' : 'none';
            button.setAttribute('aria-expanded', isOpen);
            panel.setAttribute('aria-hidden', !isOpen);
            
            if (isOpen) {
                // Add animation classes
                panel.classList.add('opacity-0', 'translate-y-2');
                // Force reflow
                void panel.offsetWidth;
                panel.classList.add('transition-all', 'duration-200', 'ease-out');
                panel.classList.remove('opacity-0', 'translate-y-2');
                
                // Focus the first focusable element
                const firstFocusable = panel.querySelector('a, button, [tabindex]');
                if (firstFocusable) {
                    firstFocusable.focus();
                }
            }
        }


        // Close when clicking outside
        function handleClickOutside(event) {
            if (isOpen && !panel.contains(event.target) && event.target !== button) {
                toggleNotifications();
            }
        }


        // Handle keyboard navigation
        function handleKeyDown(event) {
            if (event.key === 'Escape' && isOpen) {
                toggleNotifications();
                button.focus();
            }
        }


        // Event listeners
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            toggleNotifications();
        });

        document.addEventListener('click', handleClickOutside);
        document.addEventListener('keydown', handleKeyDown);

        // Handle mark all as read
        const markAllButton = container.querySelector('.mark-all-read');
        if (markAllButton) {
            markAllButton.addEventListener('click', function() {
                if (badge) {
                    badge.style.display = 'none';
                }
            });
        }


        // Clean up
        return () => {
            document.removeEventListener('click', handleClickOutside);
            document.removeEventListener('keydown', handleKeyDown);
            button.removeEventListener('click', toggleNotifications);
        };
    });
    </script>
    
    <style>
    .notification-panel {
        opacity: 0;
        transform: translateY(-10px);
        transition: opacity 150ms ease-out, transform 150ms ease-out;
    }
    
    .notification-panel[aria-hidden="false"] {
        opacity: 1;
        transform: translateY(0);
    }
    
    .notification-button[aria-expanded="true"] {
        @apply text-gray-900;
    }
    </style>
@endif
