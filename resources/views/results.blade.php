<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nəticələr - Abituriyent İmtahan Sistemi</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<!-- Header -->
<header class="header">
    <div class="logo">
        <span class="material-icons">book</span>
        <span>Abituriyent İmtahan Sistemi</span>
    </div>
    <h2>Nəticələr</h2>
    <div class="profile">
        <span class="material-icons">account_circle</span>
        <span>Salam, {{ $user->name }}!</span>
    </div>
</header>

<!-- Main Content -->
<!-- Main Content -->
<main class="results-content">
    <div class="result-card">
        <h1>{{ $exam->Name }}</h1>
        <div class="result-details">
            <p><strong>Ümumi Bal:</strong> {{ $result->totalScore }} / {{ $result->maxScore }}</p>
            <p><strong>Düzgün Cavablar:</strong> {{ $result->correctAnswers }}</p>
            <p><strong>Səhv Cavablar:</strong> {{ $result->wrongAnswers }}</p>
            <p><strong>İmtahanı Bitirdiyiniz Tarix:</strong> {{ $result->completedAt}}</p>
        </div>

        <!-- Cavabları Göstər -->
        <button class="show-answers-btn" onclick="document.getElementById('answers-section').style.display='block'">Cavablarımı Göstər</button>
        <div id="answers-section" style="display: none;">
            <h3>Cavablarınız</h3>
            @forelse ($userAnswers as $index => $userAnswer)
                <div class="answer-detail">
                    <p><strong>Sual {{ $index + 1 }}:</strong> {{ $userAnswer->question->text }}</p>
                    <p><strong>Sizin Cavabınız:</strong> {{ $userAnswer->answer->text }}
                        ({{ $userAnswer->answer->isCorrect ? 'Düzgün' : 'Səhv' }})</p>
                </div>
            @empty
                <p>Cavablar tapılmadı.</p>
            @endforelse
        </div>

        <a href="{{ route('home') }}" class="back-btn">Əsas Səhifəyə Qayıt</a>
    </div>
</main>

<!-- Footer -->
<footer class="footer">
    <p>© 2025 Abituriyent İmtahan Sistemi</p>
    <div class="footer-links">
        <a href="#">Bizimlə Əlaqə</a>
        <a href="#">Şərtlər və Qaydalar</a>
    </div>
</footer>
</body>
</html>
