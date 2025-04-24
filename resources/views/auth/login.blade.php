<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş - Təhsil Platforması</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #e0f2fe, #f3e8ff);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1rem;
        }

        .auth-container {
            background: #ffffff;
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        .auth-container h2 {
            font-size: 1.8rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 1.5rem;
        }

        .auth-container form {
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
        }

        .form-group {
            text-align: left;
        }

        .form-group label {
            font-size: 0.95rem;
            color: #475569;
            font-weight: 500;
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-group input {
            width: 100%;
            padding: 0.9rem 1.2rem;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 1rem;
            background-color: #f9fafb;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #6d28d9;
            box-shadow: 0 0 0 3px rgba(109, 40, 217, 0.1);
        }

        .form-group input::placeholder {
            color: #9ca3af;
        }

        .error-message {
            color: #ef4444;
            font-size: 0.85rem;
            margin-top: 0.3rem;
            text-align: left;
        }

        .submit-btn {
            padding: 1rem;
            background: #6d28d9;
            color: #ffffff;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s, transform 0.3s;
        }

        .submit-btn:hover {
            background: #5b21b6;
            transform: translateY(-2px);
        }

        .auth-links {
            margin-top: 1.5rem;
            font-size: 0.9rem;
            color: #64748b;
        }

        .auth-links a {
            color: #6d28d9;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .auth-links a:hover {
            color: #5b21b6;
        }

        @media (max-width: 480px) {
            .auth-container {
                padding: 1.5rem;
                max-width: 90%;
            }

            .auth-container h2 {
                font-size: 1.5rem;
            }

            .form-group input {
                padding: 0.8rem 1rem;
                font-size: 0.95rem;
            }

            .submit-btn {
                padding: 0.9rem;
                font-size: 0.95rem;
            }

            .auth-links {
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>
<div class="auth-container">
    <h2>Giriş</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label for="email">E-poçt</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="E-poçt ünvanınızı daxil edin" required>
            @error('email')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Şifrə</label>
            <input type="password" name="password" id="password" placeholder="Şifrənizi daxil edin" required>
            @error('password')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="submit-btn">Giriş Et</button>
    </form>
    <div class="auth-links">
        <p>Hesabınız yoxdur? <a href="{{ route('register') }}">Qeydiyyatdan keçin</a></p>
    </div>
</div>
</body>
</html>
