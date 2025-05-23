<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Paneli')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #212529;
            padding-top: 20px;
            color: #ffffff;
        }
        .sidebar h4 {
            color: #ffffff;
            font-size: 1.25rem;
            margin-bottom: 1rem;
        }
        .sidebar hr {
            border-top: 1px solid #495057;
        }
        .sidebar a {
            color: #adb5bd;
            padding: 10px 15px;
            display: block;
            text-decoration: none;
            font-size: 1rem;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .sidebar a:hover {
            background-color: #343a40;
            color: #ffffff;
        }
        .sidebar .section-title {
            color: #6c757d;
            font-size: 0.85rem;
            text-transform: uppercase;
            padding: 10px 15px;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar">
            <h4 class="text-center">Navigasyon</h4>
            <hr>
            <a href="{{ route('exam-types.index') }}">İmtahan Tipi</a>
            <a href="{{ route('exam-years.index') }}">İmtahan İlləri</a>
            <a href="{{ route('exam-groups.index') }}">İmtahan Grupları</a>
            <a href="{{ route('exam-subjects.index') }}">İmtahan Fənnləri</a>
            <a href="{{ route('exam-organizers.index') }}">Keçirən Qurum</a>
            <a href="{{ route('sectors.index') }}">Sektörlər</a>
            <a href="{{ route('foreign-languages.index') }}">Xarici Dillər</a> <!-- Yeni eklenen bağlantı -->
            <a href="{{ route('exams.index') }}">İmtahanlar</a>
            <a href="{{ route('exam-questions.index') }}">İmtahan Sualları</a>
            <a href="{{ route('exam-answers.index') }}">İmtahan Cavabları</a>
            <a href="{{ route('answer-images.index') }}">Cavab Şəkilləri</a>
            <a href="{{ route('question-images.index') }}">Sual Şəkilləri</a>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 p-4">
            @yield('content')
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
