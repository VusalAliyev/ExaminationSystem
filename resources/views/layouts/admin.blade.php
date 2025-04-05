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
            background-color: #212529; /* Dark gray/black background like in the image */
            padding-top: 20px;
            color: #ffffff; /* White text for contrast */
        }
        .sidebar h4 {
            color: #ffffff; /* White text for the heading */
            font-size: 1.25rem;
            margin-bottom: 1rem;
        }
        .sidebar hr {
            border-top: 1px solid #495057; /* Slightly lighter divider for contrast */
        }
        .sidebar a {
            color: #adb5bd; /* Light gray text for links, similar to the image */
            padding: 10px 15px;
            display: block;
            text-decoration: none;
            font-size: 1rem;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .sidebar a:hover {
            background-color: #343a40; /* Slightly lighter dark shade on hover */
            color: #ffffff; /* White text on hover */
        }
        /* Optional: Add spacing and styling for sections if you want to mimic the "WORKSPACE" style */
        .sidebar .section-title {
            color: #6c757d; /* Muted gray for section titles like "WORKSPACE" */
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
            <a href="{{ route('exam-types.index') }}">Sınav Türleri</a>
            <a href="{{ route('exam-years.index') }}">Sınav Yılları</a>
            <a href="{{ route('exam-groups.index') }}">Sınav Grupları</a>
            <a href="{{ route('exam-subjects.index') }}">Sınav Konuları</a>
            <a href="{{ route('exam-organizers.index') }}">Organizatörler</a>
            <a href="{{ route('exams.index') }}">Sınavlar</a>
            <a href="{{ route('exam-questions.index') }}">Sınav Soruları</a>
            <a href="{{ route('exam-answers.index') }}">Sınav Cevapları</a>
            <a href="{{ route('answer-images.index') }}">Cevap Resimleri</a>
            <a href="{{ route('question-images.index') }}">Soru Resimleri</a>
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
