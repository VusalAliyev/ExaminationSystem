<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; color: #333; }
        h1 { color: #6b21a8; }
        p { margin: 10px 0; }
        .button { display: inline-block; padding: 10px 20px; background: #6b21a8; color: #fff; text-decoration: none; border-radius: 5px; }
        .button:hover { background: #a855f7; }
    </style>
</head>
<body>
<h1>Yeni Əlaqə Formu Göndərilişi</h1>
<p>Abituriyent İmtahan Sistemi əlaqə formundan yeni bir mesaj aldınız.</p>
<h2>Məlumatlar</h2>
<p><strong>Ad Soyad:</strong> {{ $formData['name'] }}</p>
<p><strong>E-Mail:</strong> {{ $formData['email'] }}</p>
<p><strong>Nömrə:</strong> {{ $formData['phone'] }}</p>
<p><strong>Mesaj:</strong></p>
<p>{{ $formData['message'] }}</p>
<p><a href="{{ url('/') }}" class="button">Sayta Keçid</a></p>
<p>Təşəkkürlər,<br>{{ config('app.name') }}</p>
</body>
</html>
