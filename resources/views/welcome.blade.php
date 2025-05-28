<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Scheduler for Salons & Barbers</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite('resources/css/app.css')
            <style>
        body {
            font-family: 'Figtree', sans-serif;
            background: #fff;
            color: #222;
        }
        .hero-bg {
            background: linear-gradient(135deg, #ff9800 0%, #ff5722 100%);
        }
        .feature-icon {
            background: #fff3e0;
            color: #ff9800;
            border-radius: 9999px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 3rem;
            height: 3rem;
            margin-bottom: 1rem;
        }
            </style>
    </head>
<body class="min-h-screen flex flex-col">
    <!-- Navigation Bar -->
    <nav class="sticky top-0 z-50 bg-white/90 backdrop-blur shadow-sm border-b border-orange-100 w-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16 relative">
            <div class="flex items-center gap-3">
                <a href="#" class="flex items-center gap-2 shrink-0">
                    <svg class="h-8 w-8 text-orange-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 20C7.59 20 4 16.41 4 12C4 7.59 7.59 4 12 4C16.41 4 20 7.59 20 12C20 16.41 16.41 20 12 20Z" fill="currentColor"/>
                        <path d="M12 6C8.69 6 6 8.69 6 12C6 15.31 8.69 18 12 18C15.31 18 18 15.31 18 12C18 8.69 15.31 6 12 6ZM12 16C9.79 16 8 14.21 8 12C8 9.79 9.79 8 12 8C14.21 8 16 9.79 16 12C16 14.21 14.21 16 12 16Z" fill="currentColor"/>
                        <path d="M12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z" fill="currentColor"/>
                    </svg>
                    <span class="text-2xl font-extrabold text-orange-700 tracking-tight hidden sm:inline">Appointment Scheduler</span>
                </a>
                <div class="hidden md:flex gap-6 ml-8">
                    <a href="#" class="text-gray-700 hover:text-orange-600 font-medium transition">Home</a>
                    <a href="#features" class="text-gray-700 hover:text-orange-600 font-medium transition">Features</a>
                    <a href="#pricing" class="text-gray-700 hover:text-orange-600 font-medium transition">Pricing</a>
                    <a href="#contact" class="text-gray-700 hover:text-orange-600 font-medium transition">Contact</a>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg font-semibold text-orange-600 border border-orange-600 hover:bg-orange-50 transition">Login</a>
                <a href="{{ route('register') }}" class="px-4 py-2 rounded-lg font-semibold bg-orange-600 text-white hover:bg-orange-700 transition">Register</a>
            </div>
            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button id="mobile-menu-button" class="text-orange-600 focus:outline-none">
                    <svg class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>
        <!-- Mobile menu -->
        <div id="mobile-menu" class="md:hidden hidden px-4 py-4 bg-white border-b border-orange-100 absolute top-full left-0 right-0 shadow-lg">
            <a href="#" class="block py-2 text-gray-700 hover:text-orange-600 font-medium">Home</a>
            <a href="#features" class="block py-2 text-gray-700 hover:text-orange-600 font-medium">Features</a>
            <a href="#pricing" class="block py-2 text-gray-700 hover:text-orange-600 font-medium">Pricing</a>
            <a href="#contact" class="block py-2 text-gray-700 hover:text-orange-600 font-medium">Contact</a>
            <a href="{{ route('login') }}" class="block py-2 text-orange-600 font-semibold">Login</a>
            <a href="{{ route('register') }}" class="block py-2 text-white font-semibold bg-orange-600 rounded-lg mt-2 text-center">Register</a>
        </div>
        <script>
            // Simple mobile menu toggle
            document.addEventListener('DOMContentLoaded', function() {
                const btn = document.getElementById('mobile-menu-button');
                const menu = document.getElementById('mobile-menu');
                btn.addEventListener('click', function() {
                    menu.classList.toggle('hidden');
                });
            });
        </script>
    </nav>
    <!-- Hero Section -->
    <section class="hero-bg py-12 sm:py-24 px-4 flex flex-col items-center justify-center text-center relative overflow-hidden">
        <div class="max-w-3xl mx-auto z-10">
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-white mb-4 drop-shadow-lg leading-tight">Effortless Appointments for Salons & Barbers</h1>
            <p class="text-xl md:text-2xl text-orange-100 mb-8 font-medium">Book, manage, and grow your business with our all-in-one appointment scheduler.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-8">
                <a href="{{ route('register', ['role' => 'provider']) }}" class="px-8 py-3 bg-white text-orange-600 font-bold rounded-lg shadow hover:bg-orange-100 transition">Get Started as Salon/Barber</a>
                <a href="{{ route('register', ['role' => 'client']) }}" class="px-8 py-3 bg-orange-700 text-white font-bold rounded-lg shadow hover:bg-orange-800 transition">Book as Client</a>
            </div>
        </div>
        <!-- Decorative SVG background shapes -->
        <svg class="absolute left-0 top-0 w-full h-full z-0 opacity-10" viewBox="0 0 1440 320" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill="#fff" fill-opacity="0.2" d="M0,160L48,170.7C96,181,192,203,288,197.3C384,192,480,160,576,133.3C672,107,768,85,864,101.3C960,117,1056,171,1152,186.7C1248,203,1344,181,1392,170.7L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </section>
    <!-- Features Section -->
    <section id="features" class="max-w-4xl mx-auto py-12 sm:py-16 px-4 grid grid-cols-1 sm:grid-cols-2 gap-8 sm:gap-12">
        <div class="flex flex-col items-center text-center">
            <div class="feature-icon">
                <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3M16 7V3M4 11h16M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
            <h3 class="text-xl font-bold mb-2 text-orange-700">Easy Online Booking</h3>
            <p class="text-gray-600">Clients can book appointments anytime, anywhere. Salons and barbers manage their schedules with ease.</p>
        </div>
        <div class="flex flex-col items-center text-center">
            <div class="feature-icon">
                <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2a4 4 0 018 0v2M12 7a4 4 0 110-8 4 4 0 010 8z"/></svg>
            </div>
            <h3 class="text-xl font-bold mb-2 text-orange-700">Client Management</h3>
            <p class="text-gray-600">Keep track of your clients, their preferences, and appointment history for a personalized experience.</p>
        </div>
        <div class="flex flex-col items-center text-center">
            <div class="feature-icon">
                <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18"/></svg>
            </div>
            <h3 class="text-xl font-bold mb-2 text-orange-700">Service Management</h3>
            <p class="text-gray-600">Easily add, edit, or remove services. Set prices, durations, and descriptions for each offering.</p>
        </div>
        <div class="flex flex-col items-center text-center">
            <div class="feature-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
</svg>

            </div>
            <h3 class="text-xl font-bold text-gray-900 group-hover:text-orange-600 transition-colors">Beautiful Design</h3>
                <p class="text-gray-600 leading-relaxed">Modern, responsive interface with elegant animations and a user-friendly experience that delights your clients.</p>
        </div>
    </section>
    <!-- Pricing Section (placeholder) -->
    <section id="pricing" class="max-w-4xl mx-auto py-12 sm:py-16 px-4 text-center">
        <h2 class="text-3xl font-extrabold text-orange-700 mb-6">Simple, Transparent Pricing</h2>
        <p class="text-gray-600 mb-8">Choose a plan that fits your business. No hidden fees, cancel anytime.</p>
        <div class="flex flex-col sm:flex-row gap-6 sm:gap-8 justify-center items-stretch">
            <div class="flex-1 bg-white border border-orange-100 rounded-lg shadow p-6 sm:p-8">
                <h3 class="text-xl font-bold text-orange-700 mb-2">Starter</h3>
                <p class="text-3xl font-extrabold mb-4">Free</p>
                <ul class="text-gray-600 mb-6 space-y-2 text-left">
                    <li>✔ 1 Staff Account</li>
                    <li>✔ Unlimited Appointments</li>
                    <li>✔ Email Reminders</li>
                </ul>
                <a href="{{ route('register') }}" class="block w-full py-2 bg-orange-600 text-white rounded-lg font-semibold hover:bg-orange-700 transition">Get Started</a>
            </div>
            <div class="flex-1 bg-white border border-orange-200 rounded-lg shadow-lg p-6 sm:p-8 sm:scale-105 transform-gpu">
                <h3 class="text-xl font-bold text-orange-700 mb-2">Pro</h3>
                <p class="text-3xl font-extrabold mb-4">₱499<span class="text-base font-medium">/mo</span></p>
                <ul class="text-gray-600 mb-6 space-y-2 text-left">
                    <li>✔ Unlimited Staff</li>
                    <li>✔ SMS & Email Reminders</li>
                    <li>✔ Priority Support</li>
                </ul>
                <a href="{{ route('register') }}" class="block w-full py-2 bg-orange-700 text-white rounded-lg font-semibold hover:bg-orange-800 transition">Start Free Trial</a>
            </div>
        </div>
    </section>
    <!-- Contact Section (placeholder) -->
    <section id="contact" class="max-w-2xl mx-auto py-12 sm:py-16 px-4 text-center">
        <h2 class="text-2xl sm:text-3xl font-extrabold text-orange-700 mb-4 sm:mb-6">Contact Us</h2>
        <p class="text-gray-600 mb-8">Have questions or need help? Reach out and our team will get back to you soon.</p>
        <a href="mailto:support@appointmentscheduler.com" class="inline-block px-8 py-3 bg-orange-600 text-white font-bold rounded-lg shadow hover:bg-orange-700 transition">Email Support</a>
    </section>
    <!-- Footer -->
    <footer class="text-center text-gray-400 py-6 mt-auto border-t border-orange-100">
        &copy; {{ date('Y') }} Appointment Scheduler for Salons & Barbers. All rights reserved.
    </footer>
    </body>
</html>
