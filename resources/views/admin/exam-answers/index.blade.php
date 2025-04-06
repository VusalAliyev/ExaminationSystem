@extends('layouts.admin')

@section('content')
    <h1>Sınav Cevapları</h1>
    <a href="{{ route('exam-answers.create') }}" class="btn btn-primary mb-3">Yeni Cevap Ekle</a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Cevap İçeriği</th>
            <th>Durum</th>
            <th>Soru</th>
            <th>İşlemler</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($answers as $answer)
            <tr>
                <td>{{ $answer->id }}</td>
                <td>{{ Str::limit($answer->AnswerContent, 50) }}</td>
                <td>{{ $answer->State }}</td>
                <td>{{ Str::limit($answer->question->QuestionContent, 50) }}</td>
                <td>
                    <a href="{{ route('exam-answers.show', $answer->id) }}" class="btn btn-info btn-sm">Görüntüle</a>
                    <a href="{{ route('exam-answers.edit', $answer->id) }}" class="btn btn-warning btn-sm">Düzenle</a>
                    <form action="{{ route('exam-answers.destroy', $answer->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Silmek istediğinize emin misiniz?')">Sil</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
