@extends('layouts.admin')

@section('content')
    <h1>Yeni Sınav Ekle</h1>
    <form action="{{ route('exams.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="Name" class="form-label">Sınav Adı</label>
            <input type="text" name="Name" id="Name" class="form-control" value="{{ old('Name') }}" required>
            @error('Name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="ExamOrganizerID" class="form-label">Organizatör</label>
            <select name="ExamOrganizerID" id="ExamOrganizerID" class="form-control" required>
                <option value="">Seçiniz</option>
                @foreach ($organizers as $organizer)
                    <option value="{{ $organizer->id }}" {{ old('ExamOrganizerID') == $organizer->id ? 'selected' : '' }}>{{ $organizer->Name }}</option>
                @endforeach
            </select>
            @error('ExamOrganizerID')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="ExamTypeID" class="form-label">Sınav Türü</label>
            <select name="ExamTypeID" id="ExamTypeID" class="form-control" required>
                <option value="">Seçiniz</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{ old('ExamTypeID') == $type->id ? 'selected' : '' }}>{{ $type->Type }}</option>
                @endforeach
            </select>
            @error('ExamTypeID')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="ExamGroupID" class="form-label">Sınav Grubu</label>
            <select name="ExamGroupID" id="ExamGroupID" class="form-control" required>
                <option value="">Seçiniz</option>
                @foreach ($groups as $group)
                    <option value="{{ $group->id }}" {{ old('ExamGroupID') == $group->id ? 'selected' : '' }}>{{ $group->GroupNumber }}</option>
                @endforeach
            </select>
            @error('ExamGroupID')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="ExamYearID" class="form-label">Sınav Yılı</label>
            <select name="ExamYearID" id="ExamYearID" class="form-control" required>
                <option value="">Seçiniz</option>
                @foreach ($years as $year)
                    <option value="{{ $year->id }}" {{ old('ExamYearID') == $year->id ? 'selected' : '' }}>{{ $year->Year }}</option>
                @endforeach
            </select>
            @error('ExamYearID')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Kaydet</button>
        <a href="{{ route('exams.index') }}" class="btn btn-secondary">Geri Dön</a>
    </form>
@endsection
