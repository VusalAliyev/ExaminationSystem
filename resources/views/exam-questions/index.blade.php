@extends('layouts.admin')

@section('content')
    <h1>Sınav Soruları</h1>
    <a href="{{ route('exam-questions.create') }}" class="btn btn-primary mb-3">Yeni Soru Ekle</a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Soru İçeriği</th>
            <th>Puan</th>
            <th>Konu</th>
            <th>Sınav</th>
            <th>İşlemler</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($questions as $question)
            <tr>
                <td>{{ $question->id }}</td>
                <td>{{ Str::limit($question->QuestionContent, 50) }}</td>
                <td>{{ $question->Point }}</td>
                <td>{{ $question->subject->Name }}</td>
                <td>{{ $question->exam->Name }}</td>
                <td>
                    <a href="{{ route('exam-questions.show', $question->id) }}"
                       class="btn btn-info btn-sm">Görüntüle</a>
                    <a href="{{ route('exam-questions.edit', $question->id) }}"
                       class="btn btn-warning btn-sm">Düzenle</a>
                    <form action="{{ route('exam-questions.destroy', $question->id) }}" method="POST"
                          style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Silmek istediğinize emin misiniz?')">Sil
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
