@extends('layouts.admin')

@section('content')
<h1>Sınav Konuları</h1>
    <a href="{{ route('exam-subjects.create') }}" class="btn btn-primary mb-3">Yeni Sınav Konusu Ekle</a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Konu Adı</th>
            <th>İşlemler</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($examSubjects as $examSubject)
            <tr>
                <td>{{ $examSubject->id }}</td>
                <td>{{ $examSubject->Name }}</td>
                <td>
                    <a href="{{ route('exam-subjects.show', $examSubject->id) }}"
                       class="btn btn-info btn-sm">Görüntüle</a>
                    <a href="{{ route('exam-subjects.edit', $examSubject->id) }}"
                       class="btn btn-warning btn-sm">Düzenle</a>
                    <form action="{{ route('exam-subjects.destroy', $examSubject->id) }}" method="POST"
                          style="display:inline;">
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
