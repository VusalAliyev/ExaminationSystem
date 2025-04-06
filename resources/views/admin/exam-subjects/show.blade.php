@extends('layouts.admin')

@section('content')
    <h1>Sınav Konusu Detay</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ID: {{ $examSubject->id }}</h5>
            <p class="card-text">Konu Adı: {{ $examSubject->Name }}</p>
            <a href="{{ route('exam-subjects.index') }}" class="btn btn-secondary">Geri Dön</a>
            <a href="{{ route('exam-subjects.edit', $examSubject->id) }}" class="btn btn-warning">Düzenle</a>
        </div>
    </div>
@endsection
