<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stockify - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .input-group {
            position: relative;
        }
        
        .input-group input {
            transition: all 0.3s ease;
        }
        
        .input-group input:focus {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }
        
        .floating-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }
        
        .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 6s ease-in-out infinite;
        }
        
        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 20%;
            animation-delay: 0s;
        }
        
        .shape:nth-child(2) {
            width: 60px;
            height: 60px;
            top: 60%;
            right: 20%;
            animation-delay: 2s;
        }
        
        .shape:nth-child(3) {
            width: 40px;
            height: 40px;
            bottom: 20%;
            left: 30%;
            animation-delay: 4s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .logo-container {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 relative">
    <!-- Floating Background Shapes -->
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    
    <div class="w-full max-w-md relative z-10">
        <!-- Session Status (placeholder for Laravel session status) -->
        <div class="mb-4" id="session-status">
            <!-- Session status messages would appear here -->
        </div>

        <form method="POST" action="{{ route('login') }}" class="glass-effect p-8 rounded-2xl shadow-2xl">
            <!-- CSRF Token (Laravel) -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
            <!-- Logo and Title -->
            <div class="text-center mb-8">
                <div class="logo-container mb-4">
                    <i class="fas fa-cube text-4xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Stockify</h2>
                <p class="text-gray-600 text-sm">Welcome back! Please sign in to your account</p>
            </div>

            <!-- Email Address -->
            <div class="mb-6">
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-envelope mr-2 text-gray-400"></i>Email Address
                </label>
                <div class="input-group">
                    <input 
                        id="email" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition-all duration-300 bg-white/50" 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required 
                        autofocus 
                        autocomplete="username"
                        placeholder="Enter your email address"
                    >
                </div>
                <!-- Error messages placeholder -->
                <div class="mt-2 text-red-600 text-sm" id="email-error">
                    <!-- Email validation errors would appear here -->
                </div>
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-lock mr-2 text-gray-400"></i>Password
                </label>
                <div class="input-group relative">
                    <input 
                        id="password" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition-all duration-300 bg-white/50" 
                        type="password" 
                        name="password" 
                        required 
                        autocomplete="current-password"
                        placeholder="Enter your password"
                    >
                    <button type="button" class="absolute right-3 top-3 text-gray-400 hover:text-gray-600" onclick="togglePassword()">
                        <i class="fas fa-eye" id="password-toggle"></i>
                    </button>
                </div>
                <!-- Error messages placeholder -->
                <div class="mt-2 text-red-600 text-sm" id="password-error">
                    <!-- Password validation errors would appear here -->
                </div>
            </div>

            <!-- Remember Me -->
            <div class="mb-6">
                <label for="remember_me" class="flex items-center cursor-pointer">
                    <input 
                        id="remember_me" 
                        type="checkbox" 
                        class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 focus:ring-2" 
                        name="remember"
                    >
                    <span class="ml-3 text-sm text-gray-600 font-medium">Remember me</span>
                </label>
            </div>

            <!-- Submit Button and Forgot Password -->
            <div class="space-y-4">
                <button 
                    type="submit" 
                    class="btn-primary w-full py-3 px-4 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105"
                >
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Sign In
                </button>
                
                <div class="text-center">
                    <a 
                        href="{{ route('password.request') }}" 
                        class="text-sm text-indigo-600 hover:text-indigo-800 font-medium transition-colors duration-200"
                    >
                        <i class="fas fa-key mr-1"></i>
                        Forgot your password?
                    </a>
                </div>
            </div>

            <!-- Divider -->
            <div class="my-6 flex items-center">
                <div class="flex-1 border-t border-gray-300"></div>
                <span class="px-4 text-gray-500 text-sm">or</span>
                <div class="flex-1 border-t border-gray-300"></div>
            </div>

            <!-- Register Link -->
            <div class="text-center">
                <p class="text-sm text-gray-600">
                    Don't have an account? 
                    <a 
                        href="{{ route('register') }}" 
                        class="text-indigo-600 hover:text-indigo-800 font-semibold transition-colors duration-200 ml-1"
                    >
                        <i class="fas fa-user-plus mr-1"></i>
                        Register here
                    </a>
                </p>
            </div>
        </form>
        
        <!-- Footer -->
        <div class="text-center mt-8 text-white/80">
            <p class="text-sm">© 2024 Stockify. All rights reserved.</p>
        </div>
    </div>

    <script>
        // Password toggle functionality
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('password-toggle');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Add subtle animations on form interaction
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input[type="email"], input[type="password"]');
            
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('scale-105');
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('scale-105');
                });
            });
        });
    </script>
</body>
</html>