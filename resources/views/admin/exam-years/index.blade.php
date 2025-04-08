@extends('layouts.admin')

@section('content')
    <h1>İmtahan İlləri</h1>
    <a href="{{ route('exam-years.create') }}" class="btn btn-primary mb-3">Yeni İmtahan İli Əlavə Et</a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>İl</th>
            <th>Əməliyyatlar</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($examYears as $examYear)
            <tr>
                <td>{{ $examYear->id }}</td>
                <td>{{ $examYear->year }}</td>
                <td>
                    <a href="{{ route('exam-years.show', $examYear->id) }}" class="btn btn-info btn-sm">Bax</a>
                    <a href="{{ route('exam-years.edit', $examYear->id) }}" class="btn btn-warning btn-sm">Redaktə Et</a>
                    <form action="{{ route('exam-years.destroy', $examYear->id) }}" method="POST"
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
