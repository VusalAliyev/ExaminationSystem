@extends('layouts.admin')

@section('content')
    <h1>İmtahan Cavabları</h1>
    <a href="{{ route('exam-answers.create') }}" class="btn btn-primary mb-3">Yeni Cavab Əlavə Et</a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Cavab Məzmunu</th>
            <th>Vəziyyət</th>
            <th>Sual</th>
            <th>Əməliyyatlar</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($answers as $answer)
            <tr>
                <td>{{ $answer->id }}</td>
                <td>{{ Str::limit($answer->answer_content, 50) }}</td>
                <td>{{ $answer->state == 'Correct' ? 'Doğru' : 'Yanlış' }}</td>
                <td>{{ $answer->question ? Str::limit($answer->question->question_content, 50) : 'Təyin edilməyib' }}</td>
                <td>
                    <a href="{{ route('exam-answers.show', $answer->id) }}" class="btn btn-info btn-sm">Bax</a>
                    <a href="{{ route('exam-answers.edit', $answer->id) }}" class="btn btn-warning btn-sm">Redaktə Et</a>
                    <form action="{{ route('exam-answers.destroy', $answer->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Silmək istədiyinizə əminsiniz?')">Sil</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Heç bir cavab tapılmadı.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
