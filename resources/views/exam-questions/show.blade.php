@extends('layouts.admin')

@section('content')
    <h1>Soru Detay</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ID: {{ $question->id }}</h5>
            <p class="card-text">Soru İçeriği: {{ $question->QuestionContent }}</p>
            <p class="card-text">Puan: {{ $question->Point }}</p>
            <p class="card-text">Konu: {{ $question->subject->Name }}</p>
            <p class="card-text">Sınav: {{ $question->exam->Name }}</p>
            <a href="{{ route('exam-questions.index') }}" class="btn btn-secondary">Geri Dön</a>
            <a href="{{ route('exam-questions.edit', $question->id) }}" class="btn btn-warning">Düzenle</a>
        </div>
    </div>
@endsection
