import './bootstrap';
import Alpine from 'alpinejs';
import Chart from 'chart.js/auto';

// Initialize Alpine.js
window.Alpine = Alpine;
Alpine.start();

// Make Chart.js globally available
window.Chart = Chart;

// Add CSRF token to all axios requests
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
}

// Add user ID to window.Laravel if not already set
window.Laravel = window.Laravel || {};
window.Laravel.userId = document.head.querySelector('meta[name="user-id"]')?.content || null;

// Log that libraries are loaded
console.log('Alpine.js loaded:', typeof Alpine);
console.log('Chart.js loaded:', typeof Chart);
