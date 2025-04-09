@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-4">
        <h1 class="mb-4 text-primary">İmtahan Haqqında Məlumat</h1>

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">İmtahan Detalları</h5>
            </div>
            <div class="card-body">
                <h5 class="card-title">ID: {{ $exam->id }}</h5>
                <p class="card-text">Ad: {{ $exam->name }}</p>
                <p class="card-text">Təşkilatçı: {{ $exam->organizer ? $exam->organizer->name : 'Təyin edilməyib' }}</p>
                <p class="card-text">Növ: {{ $exam->type ? $exam->type->type : 'Təyin edilməyib' }}</p>
                <p class="card-text">Qrup: {{ $exam->group ? $exam->group->group_name : 'Təyin edilməyib' }}</p>
                <p class="card-text">İl: {{ $exam->year ? $exam->year->year : 'Təyin edilməyib' }}</p>
                <p class="card-text">Sektör: {{ $exam->sector ? $exam->sector->sector_name : 'Təyin edilməyib' }}</p>
                <p class="card-text">Xarici Dil: {{ $exam->foreignLanguage ? $exam->foreignLanguage->name : 'Təyin edilməyib' }}</p>
                <p class="card-text">Seçilmiş Fənn: {{ $exam->selectedSubject ? $exam->selectedSubject->name : 'Təyin edilməyib' }}</p> <!-- Seçilmiş Fənn -->
                <a href="{{ route('exams.index') }}" class="btn btn-secondary">Geri Qayıt</a>
                <a href="{{ route('exams.edit', $exam->id) }}" class="btn btn-warning">Redaktə Et</a>
            </div>
        </div>
    </div>

    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border: none;
            border-radius: 10px;
        }
        .card-header {
            border-radius: 10px 10px 0 0;
        }
        .btn {
            border-radius: 5px;
        }
        .card-text {
            font-size: 1.1rem;
            color: #495057;
        }
    </style>
@endsection
