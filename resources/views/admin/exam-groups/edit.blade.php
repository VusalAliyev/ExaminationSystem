@extends('layouts.admin')

@section('content')
    <h1>İmtahan Qrupu Redaktə Et</h1>
    <form action="{{ route('exam-groups.update', $examGroup->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="group_name" class="form-label">Qrup Adı</label>
            <input type="text" name="group_name" id="group_name" class="form-control" value="{{ $examGroup->group_name }}" required>
            @error('group_name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Yenilə</button>
        <a href="{{ route('exam-groups.index') }}" class="btn btn-secondary">Geri Qayıt</a>
    </form>
@endsection
