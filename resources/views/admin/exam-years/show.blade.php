@extends('layouts.admin')

@section('content')
    <h1>Sınav Yılı Detay</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ID: {{ $examYear->id }}</h5>
            <p class="card-text">Yıl: {{ $examYear->Year }}</p>
            <a href="{{ route('exam-years.index') }}" class="btn btn-secondary">Geri Dön</a>
            <a href="{{ route('exam-years.edit', $examYear->id) }}" class="btn btn-warning">Düzenle</a>
        </div>
    </div>
@endsection
