@extends('layouts.app')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sınav Grupları</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Sınav Grupları</h1>
    <a href="{{ route('exam-groups.create') }}" class="btn btn-primary mb-3">Yeni Sınav Grubu Ekle</a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Grup Numarası</th>
            <th>İşlemler</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($examGroups as $examGroup)
            <tr>
                <td>{{ $examGroup->id }}</td>
                <td>{{ $examGroup->GroupNumber }}</td>
                <td>
                    <a href="{{ route('exam-groups.show', $examGroup->id) }}" class="btn btn-info btn-sm">Görüntüle</a>
                    <a href="{{ route('exam-groups.edit', $examGroup->id) }}" class="btn btn-warning btn-sm">Düzenle</a>
                    <form action="{{ route('exam-groups.destroy', $examGroup->id) }}" method="POST" style="display:inline;">
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
