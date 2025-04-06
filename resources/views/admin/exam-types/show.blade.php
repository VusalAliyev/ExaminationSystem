@extends('layouts.admin')

@section('content')
    <h1>Sınav Türü Detay</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ID: {{ $examType->id }}</h5>
            <p class="card-text">Tür: {{ $examType->Type }}</p>
            <a href="{{ route('exam-types.index') }}" class="btn btn-secondary">Geri Dön</a>
            <a href="{{ route('exam-types.edit', $examType->id) }}" class="btn btn-warning">Düzenle</a>
        </div>
    </div>
@endsection
