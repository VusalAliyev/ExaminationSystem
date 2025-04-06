@extends('layouts.admin')

@section('content')
    <h1>Sınav Detay</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ID: {{ $exam->id }}</h5>
            <p class="card-text">Ad: {{ $exam->Name }}</p>
            <p class="card-text">Organizatör: {{ $exam->organizer->Name }}</p>
            <p class="card-text">Tür: {{ $exam->type->Type }}</p>
            <p class="card-text">Grup: {{ $exam->group->GroupNumber }}</p>
            <p class="card-text">Yıl: {{ $exam->year->Year }}</p>
            <a href="{{ route('exams.index') }}" class="btn btn-secondary">Geri Dön</a>
            <a href="{{ route('exams.edit', $exam->id) }}" class="btn btn-warning">Düzenle</a>
        </div>
    </div>
@endsection
