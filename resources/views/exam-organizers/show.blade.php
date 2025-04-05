<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organizatör Detay</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Organizatör Detay</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ID: {{ $examOrganizer->id }}</h5>
            <p class="card-text">Ad: {{ $examOrganizer->Name }}</p>
            <a href="{{ route('exam-organizers.index') }}" class="btn btn-secondary">Geri Dön</a>
            <a href="{{ route('exam-organizers.edit', $examOrganizer->id) }}" class="btn btn-warning">Düzenle</a>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
