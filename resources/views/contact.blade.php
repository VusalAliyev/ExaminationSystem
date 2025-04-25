<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abituriyent İmtahan Sistemi - Əlaqə</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f4f7fc;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background: linear-gradient(135deg, #6b21a8, #a855f7);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .navbar-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.6rem;
            font-weight: 600;
            color: #ffffff;
            text-decoration: none;
            flex-shrink: 0;
        }

        .navbar-links {
            display: flex;
            gap: 1.5rem;
            flex-shrink: 0;
        }

        .navbar-links a {
            color: #ffffff;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 500;
            transition: color 0.3s;
        }

        .navbar-links a:hover {
            color: #e0e0e0;
        }

        .navbar-search {
            flex: 1;
            max-width: 400px;
            display: flex;
            align-items: center;
            background-color: rgba(255, 255, 255, 0.15);
            border-radius: 10px;
            padding: 0.5rem 1rem;
            margin: 0 1rem;
            transition: background-color 0.3s;
        }

        .navbar-search i {
            color: #ffffff;
            margin-right: 0.75rem;
        }

        .navbar-search input {
            border: none;
            background: none;
            color: #ffffff;
            font-size: 1rem;
            width: 100%;
            outline: none;
        }

        .navbar-search input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .navbar-profile {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1rem;
            color: #ffffff;
            font-weight: 500;
            flex-shrink: 0;
        }

        .login-btn {
            padding: 0.6rem 1.2rem;
            background: linear-gradient(135deg, #22c55e, #4ade80);
            color: #ffffff;
            text-decoration: none;
            border-radius: 20px;
            font-size: 0.95rem;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(34, 197, 94, 0.3);
        }

        .login-btn:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 6px 20px rgba(34, 197, 94, 0.5);
            background: linear-gradient(135deg, #4ade80, #22c55e);
        }

        .login-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: 0.5s;
        }

        .login-btn:hover::before {
            left: 100%;
        }

        .profile-dropdown {
            position: relative;
        }

        .profile-icon {
            background: none;
            border: none;
            cursor: pointer;
            color: #ffffff;
            font-size: 1.8rem;
            transition: transform 0.3s;
        }

        .profile-icon:hover {
            transform: scale(1.1);
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            min-width: 150px;
            z-index: 1000;
        }

        .dropdown-menu.show {
            display: block;
        }

        .dropdown-item {
            display: block;
            padding: 0.8rem 1.2rem;
            color: #1e293b;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 500;
            transition: background 0.3s, color 0.3s;
        }

        .dropdown-item:hover {
            background: #f9fafc;
            color: #a855f7;
        }

        .logout-btn {
            border-top: 1px solid #e2e8f0;
        }

        .logout-btn:hover {
            background: #fef2f2;
            color: #ef4444;
        }

        .contact-section {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 120px);
            background: linear-gradient(135deg, #e0e7ff, #f3e8ff);
            padding: 2rem;
        }

        .contact-container {
            text-align: center;
            max-width: 600px;
            width: 100%;
            animation: fadeIn 1s ease-in-out;
        }

        .contact-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, #6b21a8, #a855f7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .contact-subtitle {
            font-size: 1rem;
            color: #64748b;
            margin-bottom: 2rem;
        }

        .contact-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .success-message {
            background-color: #d1fae5;
            color: #065f46;
            padding: 0.75rem;
            border-radius: 6px;
            margin-bottom: 1.5rem;
            text-align: center;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .contact-form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            text-align: left;
        }

        .form-group label {
            font-size: 0.95rem;
            font-weight: 500;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 0.95rem;
            color: #1e293b;
            background-color: #f9fafb;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #6b21a8;
            box-shadow: 0 0 0 3px rgba(107, 33, 168, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: #94a3b8;
        }

        .error-message {
            color: #dc2626;
            font-size: 0.85rem;
            margin-top: 0.3rem;
        }

        .submit-button {
            padding: 0.75rem;
            background: linear-gradient(135deg, #6b21a8, #a855f7);
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
            overflow: hidden;
        }

        .submit-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(107, 33, 168, 0.3);
        }

        .submit-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: 0.5s;
        }

        .submit-button:hover::before {
            left: 100%;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .footer {
            background: linear-gradient(135deg, #1e293b, #475569);
            color: #ffffff;
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            margin-top: auto;
        }

        .footer p {
            font-size: 0.95rem;
        }

        .footer .developed-by {
            font-size: 0.95rem;
        }

        .footer-links {
            display: flex;
            gap: 1.5rem;
        }

        .footer-links a {
            color: #e2e8f0;
            text-decoration: none;
            font-size: 0.95rem;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: #ffffff;
        }

        @media (max-width: 1440px) {
            .navbar {
                padding: 1rem 1.5rem;
            }

            .navbar-search {
                max-width: 300px;
                margin: 0 0.5rem;
            }

            .navbar-links {
                gap: 1rem;
            }

            .navbar-links a {
                font-size: 0.9rem;
            }

            .login-btn {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }

            .contact-section {
                padding: 1.5rem;
            }

            .contact-title {
                font-size: 2.2rem;
            }
        }

        @media (max-width: 1024px) {
            .navbar {
                flex-direction: column;
                gap: 1rem;
                padding: 1rem;
            }

            .navbar-search {
                display: flex;
                width: 100%;
                max-width: none;
                margin: 0;
                justify-content: center;
            }

            .navbar-links {
                flex-direction: row;
                gap: 1rem;
                justify-content: center;
                flex-wrap: wrap;
            }

            .navbar-profile {
                width: 100%;
                justify-content: center;
            }

            .login-btn {
                width: auto;
                padding: 0.6rem 1.2rem;
            }

            .contact-card {
                padding: 1.5rem;
            }

            .contact-title {
                font-size: 2rem;
            }

            .contact-subtitle {
                font-size: 0.95rem;
            }
        }

        @media (max-width: 768px) {
            .navbar-search {
                padding: 0.75rem 1rem;
            }

            .navbar-links {
                flex-direction: column;
                align-items: center;
                gap: 0.75rem;
            }

            .footer {
                flex-direction: column;
                gap: 0.75rem;
                text-align: center;
            }

            .footer-links {
                flex-direction: column;
                gap: 0.5rem;
            }

            .profile-dropdown {
                width: 100%;
                display: flex;
                justify-content: center;
            }

            .dropdown-menu {
                width: 100%;
                text-align: center;
            }

            .contact-title {
                font-size: 1.8rem;
            }

            .contact-subtitle {
                font-size: 0.9rem;
            }

            .contact-card {
                padding: 1.2rem;
            }
        }

        @media (max-width: 480px) {
            .navbar-logo {
                font-size: 1.4rem;
            }

            .navbar-search input {
                font-size: 0.9rem;
            }

            .navbar-links a {
                font-size: 0.85rem;
            }

            .login-btn {
                font-size: 0.85rem;
                padding: 0.5rem 1rem;
            }

            .contact-title {
                font-size: 1.5rem;
            }

            .contact-subtitle {
                font-size: 0.85rem;
            }

            .contact-card {
                padding: 1rem;
            }

            .form-group label {
                font-size: 0.9rem;
            }

            .form-group input,
            .form-group textarea {
                font-size: 0.9rem;
            }

            .submit-button {
                font-size: 0.95rem;
                padding: 0.65rem;
            }
        }
    </style>
</head>
<body>
<nav class="navbar">
    <a href="{{ route('home') }}" class="navbar-logo">
        <i class="fas fa-book"></i>
        <span>Abituriyent İmtahan Sistemi</span>
    </a>
    <form class="navbar-search" method="GET" action="{{ route('home') }}">
        <i class="fas fa-search"></i>
        <input type="text" name="search" placeholder="İmtahan axtar..." value="{{ request('search') }}">
    </form>
    <div class="navbar-links">
        <a href="{{ route('home') }}">Əsas Səhifə</a>
        <a href="#">Haqqımızda</a>
        <a href="{{ route('contact') }}">Əlaqə</a>
    </div>

</nav>

<main class="contact-section">
    <div class="contact-container">
        <h1 class="contact-title">Bizimlə Əlaqə Saxlayın</h1>
        <p class="contact-subtitle">Suallarınız və ya təklifləriniz üçün bizimlə əlaqə qurun. Sizə kömək etməkdən məmnun olarıq!</p>
        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="error-message" style="background-color: #fee2e2; color: #dc2626; padding: 0.75rem; border-radius: 6px; margin-bottom: 1.5rem; text-align: center; font-size: 0.9rem; font-weight: 500;">
                {{ session('error') }}
            </div>
        @endif
        <div class="contact-card">
            <form method="POST" action="{{ route('contact.submit') }}" class="contact-form">
                @csrf
                <div class="form-group">
                    <label for="name">Ad Soyad</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Adınızı və soyadınızı daxil edin">
                    @error('name')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">E-Mail</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="E-mail ünvanınızı daxil edin">
                    @error('email')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone">Nömrə</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required placeholder="Telefon nömrənizi daxil edin">
                    @error('phone')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="message">Mesaj</label>
                    <textarea id="message" name="message" rows="5" required placeholder="Mesajınızı bura yazın">{{ old('message') }}</textarea>
                    @error('message')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="submit-button">Göndər</button>
            </form>
        </div>
    </div>
</main>
<footer class="footer">
    <p>© 2025 Abituriyent İmtahan Sistemi</p>
    <span class="developed-by">NVSoft tərəfindən hazırlanıb</span>
    <div class="footer-links">
        <a href="#">Bizimlə Əlaqə</a>
        <a href="#">Şərtlər və Qaydalar</a>
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const profileIcon = document.querySelector('.profile-icon');
        const dropdownMenu = document.querySelector('.dropdown-menu');

        if (profileIcon && dropdownMenu) {
            profileIcon.addEventListener('click', function() {
                dropdownMenu.classList.toggle('show');
            });

            document.addEventListener('click', function(event) {
                if (!profileIcon.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.remove('show');
                }
            });
        }
    });
</script>
</body>
</html>
