@extends('layouts.admin')

@section('content')
    <h1>İmtahan Mövzusu Haqqında Məlumat</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ID: {{ $examSubject->id }}</h5>
            <p class="card-text">Mövzu Adı: {{ $examSubject->name }}</p>
            <a href="{{ route('exam-subjects.index') }}" class="btn btn-secondary">Geri Qayıt</a>
            <a href="{{ route('exam-subjects.edit', $examSubject->id) }}" class="btn btn-warning">Redaktə Et</a>
        </div>
    </div>
@endsection
