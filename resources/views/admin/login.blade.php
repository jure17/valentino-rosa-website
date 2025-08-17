<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Valentino Rosa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .login-bg {
            background: linear-gradient(135deg, #fdfcfc 0%, #ffffff 50%, #fdf2f8 100%);
        }
        .login-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .pink-accent {
            background: linear-gradient(135deg, #D12C7A 0%, #e91e63 100%);
        }
        .floating {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .fade-in {
            animation: fadeIn 0.8s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="login-bg min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo Section -->
        <div class="text-center mb-8 fade-in">
            <div class="floating inline-block">
                <img src="{{ URL::asset('/images/main-page/logo.png') }}" alt="Valentino Rosa" class="w-32 mx-auto mb-4">
            </div>
            <h1 class="text-2xl font-light text-gray-800 mb-2">Admin Panel</h1>
            <p class="text-sm text-gray-600">Accedi per gestire gli immobili</p>
        </div>

        <!-- Login Form -->
        <div class="login-card rounded-2xl shadow-2xl p-8 fade-in" style="animation-delay: 0.2s;">
            @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-red-700 text-sm">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}" class="space-y-6">
                @csrf
                
                <!-- Username Field -->
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <input type="text" id="username" name="username" required 
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all duration-200"
                               placeholder="Inserisci username">
                    </div>
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <input type="password" id="password" name="password" required 
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all duration-200"
                               placeholder="Inserisci password">
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full pink-accent text-white py-3 px-4 rounded-lg font-medium hover:shadow-lg transform hover:scale-105 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">
                    Accedi
                </button>
            </form>

            <!-- Back to Site Link -->
            <div class="mt-6 text-center">
                <a href="/" class="text-sm text-gray-600 hover:text-pink-600 transition-colors duration-200">
                    ← Torna al sito principale
                </a>
            </div>
        </div>

        <!-- Decorative Elements -->
        <div class="absolute top-10 left-10 w-20 h-20 bg-pink-200 rounded-full opacity-20 floating" style="animation-delay: 1s;"></div>
        <div class="absolute bottom-10 right-10 w-16 h-16 bg-pink-300 rounded-full opacity-20 floating" style="animation-delay: 2s;"></div>
    </div>
</body>
</html> 