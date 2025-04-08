@extends('layouts.admin')

@section('content')
    <h1>İmtahan Sualları</h1>
    <a href="{{ route('exam-questions.create') }}" class="btn btn-primary mb-3">Yeni Sual Əlavə Et</a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Sual Məzmunu</th>
            <th>Xal</th>
            <th>Mövzu</th>
            <th>İmtahan</th>
            <th>Əməliyyatlar</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($questions as $question)
            <tr>
                <td>{{ $question->id }}</td>
                <td>{{ Str::limit($question->question_content, 50) }}</td>
                <td>{{ $question->point }}</td>
                <td>{{ $question->subject ? $question->subject->name : 'Təyin edilməyib' }}</td>
                <td>{{ $question->exam ? $question->exam->name : 'Təyin edilməyib' }}</td>
                <td>
                    <a href="{{ route('exam-questions.show', $question->id) }}"
                       class="btn btn-info btn-sm">Bax</a>
                    <a href="{{ route('exam-questions.edit', $question->id) }}"
                       class="btn btn-warning btn-sm">Redaktə Et</a>
                    <form action="{{ route('exam-questions.destroy', $question->id) }}" method="POST"
                          style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Silmək istədiyinizə əminsiniz?')">Sil
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">Heç bir sual tapılmadı.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
