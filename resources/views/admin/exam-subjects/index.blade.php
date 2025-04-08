@extends('layouts.admin')

@section('content')
    <h1>İmtahan Mövzuları</h1>
    <a href="{{ route('exam-subjects.create') }}" class="btn btn-primary mb-3">Yeni İmtahan Mövzusu Əlavə Et</a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Mövzu Adı</th>
            <th>Əməliyyatlar</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($examSubjects as $examSubject)
            <tr>
                <td>{{ $examSubject->id }}</td>
                <td>{{ $examSubject->name }}</td>
                <td>
                    <a href="{{ route('exam-subjects.show', $examSubject->id) }}"
                       class="btn btn-info btn-sm">Bax</a>
                    <a href="{{ route('exam-subjects.edit', $examSubject->id) }}"
                       class="btn btn-warning btn-sm">Redaktə Et</a>
                    <form action="{{ route('exam-subjects.destroy', $examSubject->id) }}" method="POST"
                          style="display:inline;">
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
