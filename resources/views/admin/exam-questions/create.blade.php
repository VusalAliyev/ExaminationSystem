@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-4">
        <h1 class="mb-4 text-primary">{{ $exam->name }} üçün Sual Əlavə Et</h1>

        <div class="row">
            <!-- Fennler ve Sual Ekleme Alanı -->
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Fennlər</h5>
                    </div>
                    <div class="card-body">
                        <!-- Fennler Listesi -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Bir Fen Seçin:</label>
                            <select id="subject-selector" class="form-select">
                                <option value="">-- Fen Seçin --</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Sual Ekleme ve Gösterim Alanı -->
                        @foreach ($subjects as $subject)
                            <div class="subject-content" id="subject-content-{{ $subject->id }}" style="display: none;">
                                <!-- Sual Ekleme Formu -->
                                <form action="{{ route('exam-questions.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                                    <input type="hidden" name="exam_subject_id" value="{{ $subject->id }}">

                                    <!-- Soru Grupları -->
                                    <div id="question-groups-{{ $subject->id }}">
                                        <div class="question-group mb-4 p-3 rounded">
                                            <h6 class="text-muted mb-3">Sual 1</h6>
                                            <div class="mb-3">
                                                <label for="question_content_0" class="form-label">Sualın Mətni</label>
                                                <textarea name="questions[0][question_content]" id="question_content_0" class="form-control" rows="4" required></textarea>
                                                @error('questions.*.question_content')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="point_0" class="form-label">Sualın Balı</label>
                                                <input type="number" name="questions[0][point]" id="point_0" class="form-control" required>
                                                @error('questions.*.point')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Sualın Şəkilləri</label>
                                                <div class="question-images">
                                                    <div class="input-group mb-2">
                                                        <input type="file" name="questions[0][question_images][]" class="form-control">
                                                        <button type="button" class="btn btn-outline-danger remove-image">Sil</button>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-outline-secondary add-image mt-2">Daha Şəkil Əlavə Et</button>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Cavablar</label>
                                                <div class="answers">
                                                    <div class="answer-group mb-3 p-3 rounded">
                                                        <div class="mb-2">
                                                            <label class="form-label">Cavab Mətni</label>
                                                            <input type="text" name="questions[0][answers][0][content]" class="form-control" required>
                                                            @error('questions.*.answers.*.content')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label">Doğru Cavab?</label>
                                                            <select name="questions[0][answers][0][state]" class="form-control" required>
                                                                <option value="1">Bəli</option>
                                                                <option value="0">Xeyr</option>
                                                            </select>
                                                            @error('questions.*.answers.*.state')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label">Cavab Şəkilləri</label>
                                                            <div class="answer-images">
                                                                <div class="input-group mb-2">
                                                                    <input type="file" name="questions[0][answers][0][images][]" class="form-control">
                                                                    <button type="button" class="btn btn-outline-danger remove-answer-image">Sil</button>
                                                                </div>
                                                            </div>
                                                            <button type="button" class="btn btn-outline-secondary add-answer-image mt-2">Daha Şəkil Əlavə Et</button>
                                                        </div>
                                                        <button type="button" class="btn btn-outline-danger remove-answer mt-2">Cavabı Sil</button>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-outline-primary add-answer mt-2">Daha Cavab Əlavə Et</button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Daha Fazla Soru Ekle Butonu -->
                                    <button type="button" class="btn btn-outline-primary w-100 mb-3 add-question" data-subject-id="{{ $subject->id }}">Daha Sual Əlavə Et</button>

                                    <button type="submit" class="btn btn-success w-100">Sual(ları) Yadda Saxla</button>
                                </form>

                                <!-- Eklenmiş Sorular -->
                                <div class="mt-5">
                                    <h5 class="text-muted mb-3">Bu Fenn üçün Əlavə Edilmiş Suallar</h5>
                                    @php
                                        $questions = \App\Models\ExamQuestion::where('exam_id', $exam->id)
                                                    ->where('exam_subject_id', $subject->id)
                                                    ->with('answers')
                                                    ->get();
                                    @endphp
                                    @if($questions->isEmpty())
                                        <p class="text-muted">Hələ ki, bu fen üçün sual əlavə edilməyib.</p>
                                    @else
                                        @foreach($questions as $index => $question)
                                            <div class="mb-4 p-3 border rounded">
                                                <h6 class="text-primary">Sual {{ $index + 1 }} ({{ $question->point }} bal)</h6>
                                                <p>{{ $question->question_content }}</p>
                                                @if($question->images->isNotEmpty())
                                                    <div class="mb-2">
                                                        <strong>Sualın Şəkilləri:</strong>
                                                        <div class="d-flex flex-wrap">
                                                            @foreach($question->images as $image)
                                                                <img src="{{ Storage::url($image->image_path) }}" alt="Sual Şəkli" class="img-fluid rounded me-2 mb-2" style="max-width: 150px; max-height: 150px; object-fit: cover;">
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="mt-2">
                                                    <strong>Cavablar:</strong>
                                                    <ul class="list-unstyled">
                                                        @foreach($question->answers as $answer)
                                                            <li class="{{ $answer->state ? 'text-success fw-bold' : '' }}">
                                                                - {{ $answer->answer_content }}
                                                                @if($answer->state)
                                                                    (Doğru Cavab)
                                                                @endif
                                                                @if($answer->images->isNotEmpty())
                                                                    <div class="mt-1 d-flex flex-wrap">
                                                                        @foreach($answer->images as $image)
                                                                            <img src="{{ Storage::url($image->image_path) }}" alt="Cavab Şəkli" class="img-fluid rounded me-2 mb-2" style="max-width: 100px; max-height: 100px; object-fit: cover;">
                                                                        @endforeach
                                                                    </div>
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Icons (Chevron için) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <script>
        let questionIndex = 1;
        let answerIndex = 1;

        // Fen Seçimi
        document.getElementById('subject-selector').addEventListener('change', function () {
            const selectedSubjectId = this.value;
            document.querySelectorAll('.subject-content').forEach(content => {
                content.style.display = 'none';
            });
            if (selectedSubjectId) {
                document.getElementById(`subject-content-${selectedSubjectId}`).style.display = 'block';
            }
        });

        // Daha Fazla Soru Ekle
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('add-question')) {
                const subjectId = e.target.getAttribute('data-subject-id');
                const container = document.querySelector(`#question-groups-${subjectId}`);
                const newQuestion = document.createElement('div');
                newQuestion.classList.add('question-group', 'mb-4', 'p-3', 'rounded');
                newQuestion.innerHTML = `
                    <h6 class="text-muted mb-3">Sual ${questionIndex + 1}</h6>
                    <div class="mb-3">
                        <label class="form-label">Sualın Mətni</label>
                        <textarea name="questions[${questionIndex}][question_content]" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sualın Balı</label>
                        <input type="number" name="questions[${questionIndex}][point]" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sualın Şəkilləri</label>
                        <div class="question-images">
                            <div class="input-group mb-2">
                                <input type="file" name="questions[${questionIndex}][question_images][]" class="form-control">
                                <button type="button" class="btn btn-outline-danger remove-image">Sil</button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-secondary add-image mt-2">Daha Şəkil Əlavə Et</button>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cavablar</label>
                        <div class="answers">
                            <div class="answer-group mb-3 p-3 rounded">
                                <div class="mb-2">
                                    <label class="form-label">Cavab Mətni</label>
                                    <input type="text" name="questions[${questionIndex}][answers][0][content]" class="form-control" required>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Doğru Cavab?</label>
                                    <select name="questions[${questionIndex}][answers][0][state]" class="form-control" required>
                                        <option value="1">Bəli</option>
                                        <option value="0">Xeyr</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Cavab Şəkilləri</label>
                                    <div class="answer-images">
                                        <div class="input-group mb-2">
                                            <input type="file" name="questions[${questionIndex}][answers][0][images][]" class="form-control">
                                            <button type="button" class="btn btn-outline-danger remove-answer-image">Sil</button>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-outline-secondary add-answer-image mt-2">Daha Şəkil Əlavə Et</button>
                                </div>
                                <button type="button" class="btn btn-outline-danger remove-answer mt-2">Cavabı Sil</button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-primary add-answer mt-2">Daha Cavab Əlavə Et</button>
                    </div>
                    <button type="button" class="btn btn-outline-danger remove-question mt-2">Sualı Sil</button>
                `;
                container.appendChild(newQuestion);
                questionIndex++;
            }
        });

        // Daha Fazla Şəkil Ekle (Sual Şəkilləri)
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('add-image')) {
                const container = e.target.previousElementSibling;
                const questionIndex = container.closest('.question-group').querySelector('textarea[name$="[question_content]"]').name.match(/\d+/)[0];
                const newInput = document.createElement('div');
                newInput.classList.add('input-group', 'mb-2');
                newInput.innerHTML = `
                    <input type="file" name="questions[${questionIndex}][question_images][]" class="form-control">
                    <button type="button" class="btn btn-outline-danger remove-image">Sil</button>
                `;
                container.appendChild(newInput);
            }
        });

        // Şəkli Sil (Sual Şəkilləri)
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-image')) {
                e.target.parentElement.remove();
            }
        });

        // Daha Fazla Cavab Ekle
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('add-answer')) {
                const container = e.target.previousElementSibling;
                const questionIndex = container.closest('.question-group').querySelector('textarea[name$="[question_content]"]').name.match(/\d+/)[0];
                const answerCount = container.querySelectorAll('.answer-group').length;
                const newAnswer = document.createElement('div');
                newAnswer.classList.add('answer-group', 'mb-3', 'p-3', 'rounded');
                newAnswer.innerHTML = `
                    <div class="mb-2">
                        <label class="form-label">Cavab Mətni</label>
                        <input type="text" name="questions[${questionIndex}][answers][${answerCount}][content]" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Doğru Cavab?</label>
                        <select name="questions[${questionIndex}][answers][${answerCount}][state]" class="form-control" required>
                            <option value="1">Bəli</option>
                            <option value="0">Xeyr</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Cavab Şəkilləri</label>
                        <div class="answer-images">
                            <div class="input-group mb-2">
                                <input type="file" name="questions[${questionIndex}][answers][${answerCount}][images][]" class="form-control">
                                <button type="button" class="btn btn-outline-danger remove-answer-image">Sil</button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-secondary add-answer-image mt-2">Daha Şəkil Əlavə Et</button>
                    </div>
                    <button type="button" class="btn btn-outline-danger remove-answer mt-2">Cavabı Sil</button>
                `;
                container.appendChild(newAnswer);
            }
        });

        // Cavab Şəkli Ekle
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('add-answer-image')) {
                const container = e.target.previousElementSibling;
                const questionIndex = container.closest('.question-group').querySelector('textarea[name$="[question_content]"]').name.match(/\d+/)[0];
                const answerIndex = container.closest('.answer-group').querySelector('input[name$="[content]"]').name.match(/answers\[(\d+)\]/)[1];
                const newInput = document.createElement('div');
                newInput.classList.add('input-group', 'mb-2');
                newInput.innerHTML = `
                    <input type="file" name="questions[${questionIndex}][answers][${answerIndex}][images][]" class="form-control">
                    <button type="button" class="btn btn-outline-danger remove-answer-image">Sil</button>
                `;
                container.appendChild(newInput);
            }
        });

        // Cavab Şəklini Sil
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-answer-image')) {
                e.target.parentElement.remove();
            }
        });

        // Cavabı Sil
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-answer')) {
                e.target.parentElement.remove();
            }
        });

        // Soruyu Sil
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-question')) {
                e.target.parentElement.remove();
            }
        });
    </script>

    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border: none;
            border-radius: 10px;
        }
        .card-header {
            border-radius: 10px 10px 0 0;
        }
        .form-control, .btn {
            border-radius: 5px;
        }
        .form-label {
            font-weight: 500;
            color: #495057;
        }
        .question-group, .answer-group {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
        }
        .btn-outline-primary, .btn-outline-secondary, .btn-outline-danger {
            transition: all 0.3s ease;
        }
        .btn-outline-primary:hover, .btn-outline-secondary:hover, .btn-outline-danger:hover {
            transform: translateY(-2px);
        }
        .form-select {
            max-width: 300px;
        }
        .subject-content {
            margin-top: 20px;
        }
        .img-fluid {
            margin-right: 5px;
            margin-bottom: 5px;
        }
    </style>
@endsection
