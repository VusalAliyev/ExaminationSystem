@extends('layouts.admin')

@section('content')
    <h1>İmtahan Qrupu Haqqında Məlumat</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ID: {{ $examGroup->id }}</h5>
            <p class="card-text">Qrup Adı: {{ $examGroup->group_name }}</p>
            <a href="{{ route('exam-groups.index') }}" class="btn btn-secondary">Geri Qayıt</a>
            <a href="{{ route('exam-groups.edit', $examGroup->id) }}" class="btn btn-warning">Redaktə Et</a>
        </div>
    </div>
@endsection
