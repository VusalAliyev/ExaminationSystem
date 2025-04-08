@extends('layouts.admin')

@section('content')
    <h1>Sektorlər</h1>
    <a href="{{ route('sectors.create') }}" class="btn btn-primary mb-3">Yeni Sektor Əlavə Et</a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Sektör Adı</th>
            <th>Əməliyyatlar</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($sectors as $sector)
            <tr>
                <td>{{ $sector->id }}</td>
                <td>{{ $sector->sector_name }}</td>
                <td>
                    <a href="{{ route('sectors.show', $sector->id) }}" class="btn btn-info btn-sm">Bax</a>
                    <a href="{{ route('sectors.edit', $sector->id) }}" class="btn btn-warning btn-sm">Redaktə Et</a>
                    <form action="{{ route('sectors.destroy', $sector->id) }}" method="POST" style="display:inline;">
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
