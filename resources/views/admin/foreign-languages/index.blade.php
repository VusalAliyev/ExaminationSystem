@extends('layouts.admin')

@section('content')
    <h1>Xarici Dillər</h1>
    <a href="{{ route('foreign-languages.create') }}" class="btn btn-primary mb-3">Yeni Xarici Dil Əlavə Et</a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Ad</th>
            <th>Əməliyyatlar</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($foreignLanguages as $foreignLanguage)
            <tr>
                <td>{{ $foreignLanguage->id }}</td>
                <td>{{ $foreignLanguage->name }}</td>
                <td>
                    <a href="{{ route('foreign-languages.show', $foreignLanguage->id) }}" class="btn btn-info btn-sm">Bax</a>
                    <a href="{{ route('foreign-languages.edit', $foreignLanguage->id) }}" class="btn btn-warning btn-sm">Redaktə Et</a>
                    <form action="{{ route('foreign-languages.destroy', $foreignLanguage->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Silmək istədiyinizə əminsiniz?')">Sil
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
