@extends('layouts.admin')

@section('content')
    <h1>Sektor Haqqında Məlumat</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ID: {{ $sector->id }}</h5>
            <p class="card-text">Sektor Adı: {{ $sector->sector_name }}</p>
            <a href="{{ route('sectors.index') }}" class="btn btn-secondary">Geri Qayıt</a>
            <a href="{{ route('sectors.edit', $sector->id) }}" class="btn btn-warning">Redaktə Et</a>
        </div>
    </div>
@endsection
