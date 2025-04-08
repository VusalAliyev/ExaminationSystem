@extends('layouts.admin')

@section('content')
    <h1>İmtahan Qrupları</h1>
    <a href="{{ route('exam-groups.create') }}" class="btn btn-primary mb-3">Yeni İmtahan Qrupu Əlavə Et</a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Qrup Adı</th>
            <th>Əməliyyatlar</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($examGroups as $examGroup)
            <tr>
                <td>{{ $examGroup->id }}</td>
                <td>{{ $examGroup->group_name }}</td>
                <td>
                    <a href="{{ route('exam-groups.show', $examGroup->id) }}" class="btn btn-info btn-sm">Bax</a>
                    <a href="{{ route('exam-groups.edit', $examGroup->id) }}" class="btn btn-warning btn-sm">Redaktə Et</a>
                    <form action="{{ route('exam-groups.destroy', $examGroup->id) }}" method="POST"
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
