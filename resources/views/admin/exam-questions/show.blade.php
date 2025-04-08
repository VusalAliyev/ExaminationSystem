@extends('layouts.admin')

@section('content')
    <h1>Sual Haqqında Məlumat</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ID: {{ $question->id }}</h5>
            <p class="card-text">Sual Məzmunu: {{ $question->question_content }}</p>
            <p class="card-text">Xal: {{ $question->point }}</p>
            <p class="card-text">Mövzu: {{ $question->subject ? $question->subject->name : 'Təyin edilməyib' }}</p>
            <p class="card-text">İmtahan: {{ $question->exam ? $question->exam->name : 'Təyin edilməyib' }}</p>
            <a href="{{ route('exam-questions.index') }}" class="btn btn-secondary">Geri Qayıt</a>
            <a href="{{ route('exam-questions.edit', $question->id) }}" class="btn btn-warning">Redaktə Et</a>
        </div>
    </div>
@endsection
