@extends('layouts.admin')

@section('content')
    <h1>Sınav Türleri</h1>
    <a href="{{ route('exam-types.create') }}" class="btn btn-primary mb-3">Yeni Sınav Türü Ekle</a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Tür</th>
            <th>İşlemler</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($examTypes as $examType)
            <tr>
                <td>{{ $examType->id }}</td>
                <td>{{ $examType->type }}</td>
                <td>
                    <a href="{{ route('exam-types.show', $examType->id) }}" class="btn btn-info btn-sm">Görüntüle</a>
                    <a href="{{ route('exam-types.edit', $examType->id) }}" class="btn btn-warning btn-sm">Düzenle</a>
                    <form action="{{ route('exam-types.destroy', $examType->id) }}" method="POST"
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
