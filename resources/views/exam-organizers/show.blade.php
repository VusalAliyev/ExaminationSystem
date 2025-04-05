@extends('layouts.admin')

@section('content')
    <h1>Organizatör Detay</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ID: {{ $examOrganizer->id }}</h5>
            <p class="card-text">Ad: {{ $examOrganizer->Name }}</p>
            <a href="{{ route('exam-organizers.index') }}" class="btn btn-secondary">Geri Dön</a>
            <a href="{{ route('exam-organizers.edit', $examOrganizer->id) }}" class="btn btn-warning">Düzenle</a>
        </div>
    </div>
@endsection
