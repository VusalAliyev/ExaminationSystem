@extends('layouts.admin')

@section('content')
    <h1>Sınav Grubu Detay</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ID: {{ $examGroup->id }}</h5>
            <p class="card-text">Grup Numarası: {{ $examGroup->GroupNumber }}</p>
            <a href="{{ route('exam-groups.index') }}" class="btn btn-secondary">Geri Dön</a>
            <a href="{{ route('exam-groups.edit', $examGroup->id) }}" class="btn btn-warning">Düzenle</a>
        </div>
    </div>
@endsection
