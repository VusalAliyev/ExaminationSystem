@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-4">
        <h1 class="mb-4 text-primary">İmtahanlar</h1>

        <a href="{{ route('exams.create') }}" class="btn btn-primary mb-3">Yeni İmtahan Əlavə Et</a>

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">İmtahan Siyahısı</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ad</th>
                        <th>Təşkilatçı</th>
                        <th>Növ</th>
                        <th>Qrup</th>
                        <th>İl</th>
                        <th>Sektör</th>
                        <th>Xarici Dil</th>
                        <th>Seçilmiş Fənn</th> <!-- Yeni sütun -->
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
                            <td>{{ $exam->sector ? $exam->sector->sector_name : 'Təyin edilməyib' }}</td>
                            <td>{{ $exam->foreignLanguage ? $exam->foreignLanguage->name : 'Təyin edilməyib' }}</td>
                            <td>{{ $exam->selectedSubject ? $exam->selectedSubject->name : 'Təyin edilməyib' }}</td> <!-- Seçilmiş Fənn -->
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
            </div>
        </div>
    </div>

    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border: none;
            border-radius: 10px;
        }
        .card-header {
            border-radius: 10px 10px 0 0;
        }
        .btn {
            border-radius: 5px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
@endsection
