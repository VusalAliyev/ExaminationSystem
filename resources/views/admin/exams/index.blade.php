@extends('layouts.admin')

@section('content')
    <h1>İmtahanlar</h1>
    <a href="{{ route('exams.create') }}" class="btn btn-primary mb-3">Yeni İmtahan Əlavə Et</a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Ad</th>
            <th>Təşkilatçı</th>
            <th>Növ</th>
            <th>Qrup</th>
            <th>İl</th>
            <th>Sektor</th> <!-- Yeni sütun -->
            <th>Əməliyyatlar</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($exams as $exam)
            <tr>
                <td>{{ $exam->id }}</td>
                <td>{{ $exam->name }}</td>
                <td>{{ $exam->organizer ? $exam->organizer->name : 'Təyin edilməyib' }}</td>
                <td>{{ $exam->type ? $exam->type->type : 'Təyin edilməyib' }}</td>
                <td>{{ $exam->group ? $exam->group->group_name : 'Təyin edilməyib' }}</td>
                <td>{{ $exam->year ? $exam->year->year : 'Təyin edilməyib' }}</td>
                <td>{{ $exam->sector ? $exam->sector->sector_name : 'Təyin edilməyib' }}</td> <!-- Sector bilgisi -->
                <td>
                    <a href="{{ route('exams.show', $exam->id) }}" class="btn btn-info btn-sm">Bax</a>
                    <a href="{{ route('exams.edit', $exam->id) }}" class="btn btn-warning btn-sm">Redaktə Et</a>
                    <form action="{{ route('exams.destroy', $exam->id) }}" method="POST" style="display:inline;">
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
