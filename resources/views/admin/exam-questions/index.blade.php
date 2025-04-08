index.blade.php
@extends('layouts.admin')

@section('content')
    <h1>İmtahan Sualları</h1>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>İmtahan Adı</th>
            <th>Təşkilatçı</th>
            <th>Növ</th>
            <th>Qrup</th>
            <th>İl</th>
            <th>Sektör</th>
            <th>Xarici Dil</th>
            <th>Əməliyyatlar</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($exams as $exam)
            <tr>
                <td>{{ $exam->id }}</td>
                <td>{{ $exam->name }}</td>
                <td>{{ $exam->organizer ? $exam->organizer->name : 'Təyin edilməyib' }}</td>
                <td>{{ $exam->type ? $exam->type->type : 'Təyin edilməyib' }}</td>
                <td>{{ $exam->group ? $exam->group->group_name : 'Təyin edilməyib' }}</td>
                <td>{{ $exam->year ? $exam->year->year : 'Təyin edilməyib' }}</td>
                <td>{{ $exam->sector ? $exam->sector->sector_name : 'Təyin edilməyib' }}</td>
                <td>{{ $exam->foreignLanguage ? $exam->foreignLanguage->name : 'Təyin edilməyib' }}</td>
                <td>
                    <a href="{{ route('exam-questions.create', $exam->id) }}" class="btn btn-primary btn-sm">Sual Əlavə Et</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
