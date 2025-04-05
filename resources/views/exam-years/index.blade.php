@extends('layouts.admin')

@section('content')
    <h1>Sınav Yılları</h1>
    <a href="{{ route('exam-years.create') }}" class="btn btn-primary mb-3">Yeni Sınav Yılı Ekle</a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Yıl</th>
            <th>İşlemler</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($examYears as $examYear)
            <tr>
                <td>{{ $examYear->id }}</td>
                <td>{{ $examYear->Year }}</td>
                <td>
                    <a href="{{ route('exam-years.show', $examYear->id) }}" class="btn btn-info btn-sm">Görüntüle</a>
                    <a href="{{ route('exam-years.edit', $examYear->id) }}" class="btn btn-warning btn-sm">Düzenle</a>
                    <form action="{{ route('exam-years.destroy', $examYear->id) }}" method="POST"
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
