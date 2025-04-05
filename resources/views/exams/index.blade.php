@extends('layouts.admin')

@section('content')
    <h1>Sınavlar</h1>
    <a href="{{ route('exams.create') }}" class="btn btn-primary mb-3">Yeni Sınav Ekle</a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Ad</th>
            <th>Organizatör</th>
            <th>Tür</th>
            <th>Grup</th>
            <th>Yıl</th>
            <th>İşlemler</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($exams as $exam)
            <tr>
                <td>{{ $exam->id }}</td>
                <td>{{ $exam->Name }}</td>
                <td>{{ $exam->organizer->Name }}</td>
                <td>{{ $exam->type->Type }}</td>
                <td>{{ $exam->group->GroupNumber }}</td>
                <td>{{ $exam->year->Year }}</td>
                <td>
                    <a href="{{ route('exams.show', $exam->id) }}" class="btn btn-info btn-sm">Görüntüle</a>
                    <a href="{{ route('exams.edit', $exam->id) }}" class="btn btn-warning btn-sm">Düzenle</a>
                    <form action="{{ route('exams.destroy', $exam->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Silmek istediğinize emin misiniz?')">Sil
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
