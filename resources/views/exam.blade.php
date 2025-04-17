<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sınav - {{ $exam->name }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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

        .header {
            background: linear-gradient(135deg, #6b21a8, #a855f7);
            padding: 1rem 2rem;
            color: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            font-size: 1.6rem;
            font-weight: 600;
        }

        .timer {
            font-size: 1.2rem;
            font-weight: 500;
            background: rgba(255, 255, 255, 0.2);
            padding: 0.5rem 1rem;
            border-radius: 8px;
        }

        .finish-btn {
            padding: 0.5rem 1rem;
            background: #ef4444;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .finish-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
        }

        .exam-container {
            display: flex;
            flex: 1;
            margin: 2rem;
            gap: 1.5rem;
        }

        .sidebar {
            width: 250px;
            background: #ffffff;
            padding: 1.5rem;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
        }

        .sidebar h2 {
            font-size: 1.4rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 1.5rem;
        }

        .subject-list {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .subject-item {
            padding: 0.75rem;
            background: #f8fafc;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s, transform 0.3s;
            font-size: 1rem;
            color: #475569;
        }

        .subject-item:hover {
            background: #e2e8f0;
            transform: translateX(5px);
        }

        .subject-item.active {
            background: linear-gradient(135deg, #a855f7, #d8b4fe);
            color: #ffffff;
            font-weight: 600;
        }

        .main-content {
            flex: 1;
            background: #ffffff;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
            position: relative;
        }

        .question-area {
            display: none;
        }

        .question-area.active {
            display: block;
        }

        .question-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .question-header h3 {
            font-size: 1.3rem;
            font-weight: 600;
            color: #1e293b;
        }

        .question-content {
            font-size: 1.1rem;
            color: #475569;
            margin-bottom: 1rem;
        }

        .question-image {
            max-width: 100%;
            height: auto;
            margin-bottom: 1rem;
            border-radius: 8px;
        }

        .answers-list {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .answer-item {
            padding: 0.75rem;
            background: #f8fafc;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .answer-item:hover {
            background: #e2e8f0;
        }

        .answer-item input[type="radio"] {
            margin-right: 0.5rem;
        }

        .answer-item.selected {
            background: #d8b4fe;
            color: #ffffff;
        }

        .answer-image {
            max-width: 100px;
            height: auto;
            border-radius: 4px;
        }

        .navigation {
            display: flex;
            justify-content: space-between;
            margin-top: 2rem;
        }

        .nav-btn {
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, #a855f7, #d8b4fe);
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .nav-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(168, 85, 247, 0.3);
        }

        .nav-btn:disabled {
            background: #d1d5db;
            cursor: not-allowed;
        }

        @media (max-width: 768px) {
            .exam-container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
            }
        }
    </style>
</head>
<body>
<!-- Header -->
<header class="header">
    <h1>{{ $exam->name }}</h1>
    <div class="timer" id="timer">60:00</div>
    <button class="finish-btn" onclick="finishExam()">İmtahanı Bitir</button>
</header>

<!-- Main Container -->
<div class="exam-container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <h2>Fənnlər</h2>
        <div class="subject-list">
            @foreach ($subjects as $subject)
                <div class="subject-item" data-subject-id="{{ $subject->id }}" onclick="loadQuestions({{ $exam->id }}, {{ $subject->id }})">
                    {{ $subject->name }}
                </div>
            @endforeach
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <div class="question-area" id="question-area">
            <div class="question-header">
                <h3>Sual <span id="question-number">1</span> / <span id="total-questions">0</span></h3>
                <span>Puan: <span id="question-point">0</span></span>
            </div>
            <div class="question-content" id="question-content"></div>
            <img id="question-image" class="question-image" style="display: none;" />
            <div class="answers-list" id="answers-list"></div>
            <div class="navigation">
                <button class="nav-btn" id="prev-btn" onclick="changeQuestion(-1)" disabled>Əvvəlki</button>
                <button class="nav-btn" id="next-btn" onclick="changeQuestion(1)">Növbəti</button>
            </div>
        </div>
    </main>
</div>

<!-- JavaScript -->
<script>
    let currentSubjectId = null;
    let questions = [];
    let currentQuestionIndex = 0;
    let timeLeft = 3600; // 1 saat (saniye cinsinden)
    let userAnswers = {}; // Kullanıcının seçtiği cevapları saklamak için
    let timerInterval = null;

    // Timer'ı başlat
    function startTimer() {
        const timerElement = document.getElementById('timer');
        timerInterval = setInterval(() => {
            if (timeLeft <= 0) {
                clearInterval(timerInterval);
                alert('Sınav süresi bitti!');
                finishExam();
                return;
            }
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            timerElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            timeLeft--;
        }, 1000);
    }

    // Soruları yükle
    async function loadQuestions(examId, subjectId) {
        if (currentSubjectId === subjectId) return;

        currentSubjectId = subjectId;
        currentQuestionIndex = 0;

        // Aktif fenn işaretle
        document.querySelectorAll('.subject-item').forEach(item => {
            item.classList.remove('active');
            if (parseInt(item.dataset.subjectId) === subjectId) {
                item.classList.add('active');
            }
        });

        // Soruları çek
        try {
            console.log('Fetching questions for examId:', examId, 'subjectId:', subjectId);
            const response = await fetch(`/exam/${examId}/subject/${subjectId}/questions`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            console.log('Response status:', response.status);
            if (!response.ok) {
                throw new Error('Sorular yüklenemedi: ' + response.statusText);
            }
            questions = await response.json();

            console.log('Loaded questions:', questions);

            // Soru alanını göster
            document.getElementById('question-area').classList.add('active');
            document.getElementById('total-questions').textContent = questions.length;

            if (questions.length > 0) {
                displayQuestion();
            } else {
                document.getElementById('question-content').textContent = 'Bu fənnə aid sual tapılmadı.';
                document.getElementById('answers-list').innerHTML = '';
                document.getElementById('prev-btn').disabled = true;
                document.getElementById('next-btn').disabled = true;
            }
        } catch (error) {
            console.error('Sorular yüklenirken hata oluştu:', error);
            document.getElementById('question-content').textContent = 'Sorular yüklenemedi: ' + error.message;
        }
    }

    // Soruyu göster
    function displayQuestion() {
        const question = questions[currentQuestionIndex];
        document.getElementById('question-number').textContent = currentQuestionIndex + 1;
        document.getElementById('question-content').textContent = question.question_content;
        document.getElementById('question-point').textContent = question.point;

        // Soru resmi
        const questionImage = document.getElementById('question-image');
        if (question.question_images && question.question_images.length > 0) {
            questionImage.src = `/storage/${question.question_images[0].image_path}`;
            questionImage.style.display = 'block';
        } else {
            questionImage.style.display = 'none';
        }

        // Cevaplar
        const answersList = document.getElementById('answers-list');
        answersList.innerHTML = '';
        question.answers.forEach((answer, index) => {
            const answerItem = document.createElement('div');
            answerItem.classList.add('answer-item');
            const isSelected = userAnswers[question.id] === answer.id;
            if (isSelected) {
                answerItem.classList.add('selected');
            }
            answerItem.innerHTML = `
                <input type="radio" name="answer" value="${answer.id}" id="answer-${index}" ${isSelected ? 'checked' : ''}>
                <label for="answer-${index}">${answer.answer_content}</label>
            `;
            if (answer.images && answer.images.length > 0) {
                const img = document.createElement('img');
                img.src = `/storage/${answer.images[0].image_path}`;
                img.classList.add('answer-image');
                answerItem.appendChild(img);
            }
            answerItem.querySelector('input').addEventListener('change', () => {
                userAnswers[question.id] = answer.id;
                document.querySelectorAll('.answer-item').forEach(item => item.classList.remove('selected'));
                answerItem.classList.add('selected');
            });
            answersList.appendChild(answerItem);
        });

        // Navigasyon butonları
        document.getElementById('prev-btn').disabled = currentQuestionIndex === 0;
        document.getElementById('next-btn').disabled = currentQuestionIndex === questions.length - 1;
        if (currentQuestionIndex === questions.length - 1) {
            document.getElementById('next-btn').textContent = 'Bitir';
        } else {
            document.getElementById('next-btn').textContent = 'Növbəti';
        }
    }

    // Soru değiştir
    function changeQuestion(direction) {
        currentQuestionIndex += direction;
        if (currentQuestionIndex < 0) currentQuestionIndex = 0;
        if (currentQuestionIndex >= questions.length) {
            finishExam();
            return;
        }
        displayQuestion();
    }

    // Sınavı bitir
    function finishExam() {
        clearInterval(timerInterval); // Timer’ı durdur
        fetch('{{ route('exam.finish', $exam->id) }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                exam_id: {{ $exam->id }},
                answers: userAnswers
            })
        }).then(response => response.json())
            .then(data => {
                alert(`Sınav tamamlandı!\nToplam Puan: ${data.total_score}\nDoğru Cevaplar: ${data.correct_answers}\nYanlış Cevaplar: ${data.wrong_answers}\nMaksimum Puan: ${data.max_score}`);
                window.location.href = '{{ route('home') }}'; // Ana sayfaya yönlendir
            }).catch(error => {
            console.error('Sınav sonuçları gönderilirken hata oluştu:', error);
            alert('Bir hata oluştu, lütfen tekrar deneyin.');
        });
    }

    // İlk fennin sorularını otomatik yükle
    window.onload = function() {
        startTimer();
        const firstSubject = document.querySelector('.subject-item');
        if (firstSubject) {
            const examId = {{ $exam->id }};
            const subjectId = firstSubject.dataset.subjectId;
            console.log('Initial load - examId:', examId, 'subjectId:', subjectId);
            loadQuestions(examId, subjectId);
        } else {
            document.getElementById('question-content').textContent = 'Fənn tapılmadı.';
        }
    };
</script>
</body>
</html>
