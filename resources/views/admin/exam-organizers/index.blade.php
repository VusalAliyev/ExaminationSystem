@extends('layouts.admin')

@section('content')
    <h1>Organizatörler</h1>
    <a href="{{ route('exam-organizers.create') }}" class="btn btn-primary mb-3">Yeni Organizatör Ekle</a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Ad</th>
            <th>İşlemler</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($examOrganizers as $examOrganizer)
            <tr>
                <td>{{ $examOrganizer->id }}</td>
                <td>{{ $examOrganizer->Name }}</td>
                <td>
                    <a href="{{ route('exam-organizers.show', $examOrganizer->id) }}" class="btn btn-info btn-sm">Görüntüle</a>
                    <a href="{{ route('exam-organizers.edit', $examOrganizer->id) }}" class="btn btn-warning btn-sm">Düzenle</a>
                    <form action="{{ route('exam-organizers.destroy', $examOrganizer->id) }}" method="POST"
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
