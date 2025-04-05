<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sınav Detay</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Sınav Detay</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ID: {{ $exam->id }}</h5>
            <p class="card-text">Ad: {{ $exam->Name }}</p>
            <p class="card-text">Organizatör: {{ $exam->organizer->Name }}</p>
            <p class="card-text">Tür: {{ $exam->type->Type }}</p>
            <p class="card-text">Grup: {{ $exam->group->GroupNumber }}</p>
            <p class="card-text">Yıl: {{ $exam->year->Year }}</p>
            <a href="{{ route('exams.index') }}" class="btn btn-secondary">Geri Dön</a>
            <a href="{{ route('exams.edit', $exam->id) }}" class="btn btn-warning">Düzenle</a>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
