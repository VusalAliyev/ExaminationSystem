@extends('layouts.admin')

@section('content')
    <h1>İmtahan Haqqında Məlumat</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ID: {{ $exam->id }}</h5>
            <p class="card-text">Ad: {{ $exam->name }}</p>
            <p class="card-text">Təşkilatçı: {{ $exam->organizer->name }}</p>
            <p class="card-text">Növ: {{ $exam->type->type }}</p>
            <p class="card-text">Qrup: {{ $exam->group->group_name }}</p>
            <p class="card-text">İl: {{ $exam->year->year }}</p>
            <a href="{{ route('exams.index') }}" class="btn btn-secondary">Geri Qayıt</a>
            <a href="{{ route('exams.edit', $exam->id) }}" class="btn btn-warning">Redaktə Et</a>
        </div>
    </div>
@endsection
