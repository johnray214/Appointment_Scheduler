@props([
    'name',
    'show' => false,
    'maxWidth' => '2xl'
])

@php
$maxWidth = [
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
][$maxWidth];

$modalId = 'modal-' . str_replace(['.', ' '], '-', $name) . '-' . uniqid();
@endphp

<div id="{{ $modalId }}" 
     class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50" 
     style="display: {{ $show ? 'block' : 'none' }};"
     data-modal-name="{{ $name }}">
    <!-- Backdrop -->
    <div class="fixed inset-0 transform transition-all modal-backdrop">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>

    <!-- Modal Content -->
    <div class="mb-6 transform transition-all {{ $maxWidth }} mx-auto modal-content">
        {{ $slot }}
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('{{ $modalId }}');
        const backdrop = modal.querySelector('.modal-backdrop');
        const content = modal.querySelector('.modal-content');
        const modalName = '{{ $name }}';
        let isOpen = {{ $show ? 'true' : 'false' }};

        // Get all focusable elements within the modal
        function getFocusableElements() {
            const selector = 'a, button, input:not([type="hidden"]), textarea, select, details, [tabindex]:not([tabindex="-1"])';
            return [...modal.querySelectorAll(selector)].filter(el => !el.hasAttribute('disabled'));
        }

        // Handle tab key navigation
        function handleTabKey(e) {
            if (e.key !== 'Tab') return;
            
            const focusable = getFocusableElements();
            if (focusable.length === 0) return;
            
            const first = focusable[0];
            const last = focusable[focusable.length - 1];
            
            if (e.shiftKey) {
                if (document.activeElement === first) {
                    e.preventDefault();
                    last.focus();
                }
            } else {
                if (document.activeElement === last) {
                    e.preventDefault();
                    first.focus();
                }
            }
        }


        // Toggle modal visibility
        function toggleModal(show) {
            isOpen = show;
            modal.style.display = show ? 'block' : 'none';
            document.body.classList.toggle('overflow-y-hidden', show);
            
            if (show) {
                // Focus first focusable element if needed
                if ({{ $attributes->has('focusable') ? 'true' : 'false' }}) {
                    const focusable = getFocusableElements();
                    if (focusable.length > 0) {
                        setTimeout(() => focusable[0].focus(), 100);
                    }
                }
            }
        }


        // Close modal
        function closeModal() {
            toggleModal(false);
        }


        // Event listeners
        backdrop.addEventListener('click', closeModal);
        
        // Close when clicking on close buttons with data-modal-close attribute
        modal.addEventListener('click', (e) => {
            if (e.target.closest('[data-modal-close]')) {
                closeModal();
            }
        });


        // Handle keyboard events
        modal.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeModal();
            } else if (e.key === 'Tab') {
                handleTabKey(e);
            }
        });


        // Handle custom events
        window.addEventListener('open-modal', (e) => {
            if (e.detail === modalName) {
                toggleModal(true);
            }
        });

        window.addEventListener('close-modal', (e) => {
            if (e.detail === modalName) {
                toggleModal(false);
            }
        });

        // Initialize modal state
        toggleModal({{ $show ? 'true' : 'false' }});
    });
    </script>
    
    <style>
    /* Modal transitions */
    .modal-enter {
        opacity: 0;
    }
    .modal-enter-active {
        opacity: 1;
        transition: opacity 200ms ease-out;
    }
    .modal-leave {
        opacity: 1;
    }
    .modal-leave-active {
        opacity: 0;
        transition: opacity 150ms ease-in;
    }
    
    /* Modal content animation */
    .modal-content {
        opacity: 0;
        transform: translateY(10px);
        transition: opacity 200ms ease-out, transform 200ms ease-out;
    }
    
    .modal-content.show {
        opacity: 1;
        transform: translateY(0);
    }
    </style>
</div>
