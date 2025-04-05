@extends('layouts.admin')

@section('content')

 <h1>Sınav Grupları</h1>
    <a href="{{ route('exam-groups.create') }}" class="btn btn-primary mb-3">Yeni Sınav Grubu Ekle</a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Grup Numarası</th>
            <th>İşlemler</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($examGroups as $examGroup)
            <tr>
                <td>{{ $examGroup->id }}</td>
                <td>{{ $examGroup->GroupNumber }}</td>
                <td>
                    <a href="{{ route('exam-groups.show', $examGroup->id) }}" class="btn btn-info btn-sm">Görüntüle</a>
                    <a href="{{ route('exam-groups.edit', $examGroup->id) }}" class="btn btn-warning btn-sm">Düzenle</a>
                    <form action="{{ route('exam-groups.destroy', $examGroup->id) }}" method="POST"
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
