@extends('layouts.admin')

@section('content')
    <h1>Cevap Detay</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ID: {{ $answer->id }}</h5>
            <p class="card-text">Cevap İçeriği: {{ $answer->AnswerContent }}</p>
            <p class="card-text">Durum: {{ $answer->State }}</p>
            <p class="card-text">Soru: {{ $answer->question->QuestionContent }}</p>
            <a href="{{ route('exam-answers.index') }}" class="btn btn-secondary">Geri Dön</a>
            <a href="{{ route('exam-answers.edit', $answer->id) }}" class="btn btn-warning">Düzenle</a>
        </div>
    </div>
@endsection
