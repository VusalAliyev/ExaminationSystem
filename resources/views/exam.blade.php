<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İmtahan - Abituriyent İmtahan Sistemi</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<!-- Header -->
<header class="header">
    <div class="logo">
        <span class="material-icons">book</span>
        <span>Abituriyent İmtahan Sistemi</span>
    </div>
    <div class="exam-info">
        <h2>{{ $exam->name }}</h2>
        <p>Qalan vaxt: 01:30:00</p>
    </div>
    <div class="profile">
        <span class="material-icons">account_circle</span>
        <span>Salam, {{ $user->name }}!</span>
    </div>
</header>

<!-- Main Content -->
<main class="exam-content">
    @forelse ($questions as $index => $question)
        <div class="question-card" id="question-{{ $index }}" style="display: {{ $index == 0 ? 'block' : 'none' }}">
            <div class="question-header">
                <span>Sual {{ $index + 1 }}/{{ $questions->count() }}</span>
                <span>{{ $question->point }} bal</span>
            </div>
            <h3>{{ $question->text }}</h3>
            @if ($question->image)
                <div class="question-image">
                    <img src="{{ asset('storage/' . $question->image->imagePath) }}" alt="Sual şəkli">
                </div>
            @else
                <div class="question-image">
                    <p>[Sual şəkli yoxdur]</p>
                </div>
            @endif
            <form class="answers" data-question-id="{{ $question->id }}">
                @foreach ($question->answers as $answer)
                    <label class="answer-option">
                        <input type="radio" name="answer[{{ $question->id }}]" value="{{ $answer->id }}">
                        {{ $answer->text }}
                    </label>
                @endforeach
            </form>
        </div>
    @empty
        <p>Bu imtahanda sual yoxdur.</p>
    @endforelse

    <div class="navigation">
        <button class="prev-btn" onclick="showPreviousQuestion()">Əvvəlki Sual</button>
        <button class="next-btn" onclick="showNextQuestion()">Növbəti Sual</button>
        <form method="POST" action="{{ route('exam.finish', $exam->id) }}">
            @csrf
            <button type="submit" class="finish-btn">İmtahanı Bitir</button>
        </form>
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

<!-- JavaScript for Navigation -->
<script>
    let currentQuestion = 0;
    const totalQuestions = {{ $questions->count() }};

    function showPreviousQuestion() {
        if (currentQuestion > 0) {
            document.getElementById('question-' + currentQuestion).style.display = 'none';
            currentQuestion--;
            document.getElementById('question-' + currentQuestion).style.display = 'block';
        }
    }

    function showNextQuestion() {
        if (currentQuestion < totalQuestions - 1) {
            document.getElementById('question-' + currentQuestion).style.display = 'none';
            currentQuestion++;
            document.getElementById('question-' + currentQuestion).style.display = 'block';
        }
    }
</script>
</body>
</html>
