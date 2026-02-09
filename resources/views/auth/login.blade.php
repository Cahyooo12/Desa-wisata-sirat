<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
</head>
<body style="font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f1f5f9; margin: 0; padding: 0;">
    <div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 24px;">
        <div style="width: 100%; max-width: 420px; display: flex; flex-direction: column; align-items: center;">
            
            <!-- Logo floating above -->
            <div style="margin-bottom: -56px; z-index: 20; position: relative;">
                <div style="width: 112px; height: 112px; background-color: white; border-radius: 50%; padding: 6px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); display: flex; align-items: center; justify-content: center; overflow: hidden; border: 2px solid #f8fafc;">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;" />
                </div>
            </div>

            <!-- Main Card -->
            <div style="width: 100%; background-color: white; border-radius: 40px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15); padding: 80px 48px 48px; position: relative; z-index: 10;">
                
                <div style="text-align: center; margin-bottom: 40px;">
                    <h1 style="font-size: 30px; font-weight: 800; color: #1e293b; margin: 0 0 8px 0; letter-spacing: -0.025em;">Admin Login</h1>
                    <p style="color: #94a3b8; font-size: 13px; font-weight: 500; margin: 0;">Masuk untuk mengelola konten desa.</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    @if (session('status'))
                        <div style="margin-bottom: 16px; font-size: 12px; font-weight: 700; color: #16a34a; background-color: #f0fdf4; padding: 16px; border-radius: 16px;">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Username -->
                    <div style="margin-bottom: 24px;">
                        <label for="email" style="display: block; font-size: 14px; font-weight: 800; color: #475569; margin-bottom: 8px; margin-left: 4px;">Username</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                               style="width: 100%; height: 56px; padding: 0 24px; border-radius: 16px; background-color: #f8fafc; border: 1px solid #e2e8f0; font-size: 15px; font-weight: 700; color: #1e293b; outline: none; transition: all 0.2s;"
                               onfocus="this.style.borderColor='#c084fc'; this.style.boxShadow='0 0 0 4px rgba(192, 132, 252, 0.1)';"
                               onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';">
                        @error('email')
                            <p style="margin-top: 4px; font-size: 11px; color: #f43f5e; font-weight: 700; margin-left: 4px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div style="margin-bottom: 32px;">
                        <label for="password" style="display: block; font-size: 14px; font-weight: 800; color: #475569; margin-bottom: 8px; margin-left: 4px;">Password</label>
                        <input id="password" type="password" name="password" required 
                               style="width: 100%; height: 56px; padding: 0 24px; border-radius: 16px; background-color: #f8fafc; border: 1px solid #e2e8f0; font-size: 15px; font-weight: 700; color: #1e293b; outline: none; transition: all 0.2s;"
                               onfocus="this.style.borderColor='#c084fc'; this.style.boxShadow='0 0 0 4px rgba(192, 132, 252, 0.1)';"
                               onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';">
                        @error('password')
                            <p style="margin-top: 4px; font-size: 11px; color: #f43f5e; font-weight: 700; margin-left: 4px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            style="width: 100%; height: 64px; background: linear-gradient(135deg, #4a0080 0%, #6a0dad 100%); color: white; font-size: 16px; font-weight: 800; border-radius: 50px; border: none; cursor: pointer; text-transform: uppercase; letter-spacing: 0.1em; box-shadow: 0 20px 25px -5px rgba(74, 0, 128, 0.2); transition: all 0.2s;"
                            onmouseover="this.style.transform='scale(1.02)'; this.style.boxShadow='0 25px 50px -12px rgba(74, 0, 128, 0.3)';"
                            onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 20px 25px -5px rgba(74, 0, 128, 0.2)';"
                            onmousedown="this.style.transform='scale(0.98)';"
                            onmouseup="this.style.transform='scale(1.02)';">
                        MASUK
                    </button>
                </form>

                <div style="margin-top: 40px; text-align: center;">
                    <a href="/" style="display: inline-flex; align-items: center; gap: 8px; color: #94a3b8; font-size: 14px; font-weight: 800; text-decoration: none; transition: color 0.2s;"
                       onmouseover="this.style.color='#4a0080';"
                       onmouseout="this.style.color='#94a3b8';">
                        <span class="material-symbols-outlined" style="font-size: 18px;">arrow_back</span>
                        Kembali ke Website
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
