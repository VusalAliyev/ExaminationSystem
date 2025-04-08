@extends('layouts.admin')

@section('content')
    <h1>İmtahan Redaktə Et</h1>
    <form action="{{ route('exams.update', $exam->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">İmtahan Adı</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $exam->name }}" required>
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exam_organizer_id" class="form-label">Təşkilatçı</label>
            <select name="exam_organizer_id" id="exam_organizer_id" class="form-control" required>
                <option value="">Seçin</option>
                @foreach ($organizers as $organizer)
                    <option value="{{ $organizer->id }}" {{ $exam->exam_organizer_id == $organizer->id ? 'selected' : '' }}>{{ $organizer->name }}</option>
                @endforeach
            </select>
            @error('exam_organizer_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exam_type_id" class="form-label">İmtahan Növü</label>
            <select name="exam_type_id" id="exam_type_id" class="form-control" required>
                <option value="">Seçin</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{ $exam->exam_type_id == $type->id ? 'selected' : '' }}>{{ $type->type }}</option>
                @endforeach
            </select>
            @error('exam_type_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exam_group_id" class="form-label">İmtahan Qrupu</label>
            <select name="exam_group_id" id="exam_group_id" class="form-control" required>
                <option value="">Seçin</option>
                @foreach ($groups as $group)
                    <option value="{{ $group->id }}" {{ $exam->exam_group_id == $group->id ? 'selected' : '' }}>{{ $group->group_name }}</option>
                @endforeach
            </select>
            @error('exam_group_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exam_year_id" class="form-label">İmtahan İli</label>
            <select name="exam_year_id" id="exam_year_id" class="form-control" required>
                <option value="">Seçin</option>
                @foreach ($years as $year)
                    <option value="{{ $year->id }}" {{ $exam->exam_year_id == $year->id ? 'selected' : '' }}>{{ $year->year }}</option>
                @endforeach
            </select>
            @error('exam_year_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Yenilə</button>
        <a href="{{ route('exams.index') }}" class="btn btn-secondary">Geri Qayıt</a>
    </form>
@endsection
