@extends('layouts.admin')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cevap Resimleri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Cevap Resimleri</h1>
    <a href="{{ route('answer-images.create') }}" class="btn btn-primary mb-3">Yeni Cevap Resmi Ekle</a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Resim Yolu</th>
            <th>Cevap</th>
            <th>İşlemler</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($images as $image)
            <tr>
                <td>{{ $image->id }}</td>
                <td>{{ $image->ImagePath }}</td>
                <td>{{ Str::limit($image->answer->AnswerContent, 50) }}</td>
                <td>
                    <a href="{{ route('answer-images.show', $image->id) }}" class="btn btn-info btn-sm">Görüntüle</a>
                    <a href="{{ route('answer-images.edit', $image->id) }}" class="btn btn-warning btn-sm">Düzenle</a>
                    <form action="{{ route('answer-images.destroy', $image->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Silmek istediğinize emin misiniz?')">Sil</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
