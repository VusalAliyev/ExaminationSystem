@extends('layouts.admin')

@section('title', 'Cavab Şəkilləri')

@section('content')
    <h1>Cavab Şəkilləri</h1>
    <a href="{{ route('answer-images.create') }}" class="btn btn-primary mb-3">Yeni Cavab Şəkli Əlavə Et</a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Şəkil Yolu</th>
            <th>Cavab</th>
            <th>Əməliyyatlar</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($images as $image)
            <tr>
                <td>{{ $image->id }}</td>
                <td>{{ $image->image_path }}</td>
                <td>{{ $image->answer ? Str::limit($image->answer->answer_content, 50) : 'Təyin edilməyib' }}</td>
                <td>
                    <a href="{{ route('answer-images.show', $image->id) }}" class="btn btn-info btn-sm">Bax</a>
                    <a href="{{ route('answer-images.edit', $image->id) }}" class="btn btn-warning btn-sm">Redaktə Et</a>
                    <form action="{{ route('answer-images.destroy', $image->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Silmək istədiyinizə əminsiniz?')">Sil</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">Heç bir şəkil tapılmadı.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
