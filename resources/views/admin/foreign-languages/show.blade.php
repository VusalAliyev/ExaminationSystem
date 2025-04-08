@extends('layouts.admin')

@section('content')
    <h1>Xarici Dil Haqqında Məlumat</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ID: {{ $foreignLanguage->id }}</h5>
            <p class="card-text">Ad: {{ $foreignLanguage->name }}</p>
            <a href="{{ route('foreign-languages.index') }}" class="btn btn-secondary">Geri Qayıt</a>
            <a href="{{ route('foreign-languages.edit', $foreignLanguage->id) }}" class="btn btn-warning">Redaktə Et</a>
        </div>
    </div>
@endsection
