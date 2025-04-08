@extends('layouts.admin')

@section('content')
    <h1>Cavab Haqqında Məlumat</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ID: {{ $answer->id }}</h5>
            <p class="card-text">Cavab Məzmunu: {{ $answer->answer_content }}</p>
            <p class="card-text">Vəziyyət: {{ $answer->state == 'Correct' ? 'Doğru' : 'Yanlış' }}</p>
            <p class="card-text">Sual: {{ $answer->question ? $answer->question->question_content : 'Təyin edilməyib' }}</p>
            <a href="{{ route('exam-answers.index') }}" class="btn btn-secondary">Geri Qayıt</a>
            <a href="{{ route('exam-answers.edit', $answer->id) }}" class="btn btn-warning">Redaktə Et</a>
        </div>
    </div>
@endsection
