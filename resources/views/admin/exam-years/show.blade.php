@extends('layouts.admin')

@section('content')
    <h1>İmtahan İli Haqqında Məlumat</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ID: {{ $examYear->id }}</h5>
            <p class="card-text">İl: {{ $examYear->year }}</p>
            <a href="{{ route('exam-years.index') }}" class="btn btn-secondary">Geri Qayıt</a>
            <a href="{{ route('exam-years.edit', $examYear->id) }}" class="btn btn-warning">Redaktə Et</a>
        </div>
    </div>
@endsection
