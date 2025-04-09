@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-4">
        <h1 class="mb-4 text-primary">İmtahan Redaktə Et</h1>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">İmtahan Məlumatları</h5>
                    </div>
                    <div class="card-body">
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
                                <select name="exam_organizer_id" id="exam_organizer_id" class="form-select" required>
                                    <option value="">-- Seçin --</option>
                                    @foreach ($organizers as $organizer)
                                        <option value="{{ $organizer->id }}" {{ $exam->exam_organizer_id == $organizer->id ? 'selected' : '' }}>{{ $organizer->name }}</option>
                                    @endforeach
                                </select>
                                @error('exam_organizer_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="exam_type_id" class="form-label">İmtahan Tipi</label>
                                <select name="exam_type_id" id="exam_type_id" class="form-select" required>
                                    <option value="">-- Seçin --</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}" data-name="{{ $type->type }}" {{ $exam->exam_type_id == $type->id ? 'selected' : '' }}>{{ $type->type }}</option>
                                    @endforeach
                                </select>
                                @error('exam_type_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="exam_group_id" class="form-label">Qrup</label>
                                <select name="exam_group_id" id="exam_group_id" class="form-select" required>
                                    <option value="">-- Seçin --</option>
                                    @foreach ($groups as $group)
                                        <option value="{{ $group->id }}" data-name="{{ $group->group_name }}" {{ $exam->exam_group_id == $group->id ? 'selected' : '' }}>{{ $group->group_name }}</option>
                                    @endforeach
                                </select>
                                @error('exam_group_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="exam_year_id" class="form-label">İl</label>
                                <select name="exam_year_id" id="exam_year_id" class="form-select" required>
                                    <option value="">-- Seçin --</option>
                                    @foreach ($years as $year)
                                        <option value="{{ $year->id }}" {{ $exam->exam_year_id == $year->id ? 'selected' : '' }}>{{ $year->year }}</option>
                                    @endforeach
                                </select>
                                @error('exam_year_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="sector_id" class="form-label">Sektor</label>
                                <select name="sector_id" id="sector_id" class="form-select" required>
                                    <option value="">-- Seçin --</option>
                                    @foreach ($sectors as $sector)
                                        <option value="{{ $sector->id }}" {{ $exam->sector_id == $sector->id ? 'selected' : '' }}>{{ $sector->sector_name }}</option>
                                    @endforeach
                                </select>
                                @error('sector_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="foreign_language_id" class="form-label">Xarici Dil</label>
                                <select name="foreign_language_id" id="foreign_language_id" class="form-select">
                                    <option value="">-- Seçin --</option>
                                    @foreach ($foreignLanguages as $foreignLanguage)
                                        <option value="{{ $foreignLanguage->id }}" {{ $exam->foreign_language_id == $foreignLanguage->id ? 'selected' : '' }}>{{ $foreignLanguage->name }}</option>
                                    @endforeach
                                </select>
                                @error('foreign_language_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3" id="selected-subject-container" style="display: none;">
                                <label for="selected_subject_id" class="form-label">Seçilmiş Fənn</label>
                                <select name="selected_subject_id" id="selected_subject_id" class="form-select">
                                    <option value="">-- Seçin --</option>
                                    <!-- Seçenekler JavaScript ile dinamik olarak doldurulacak -->
                                </select>
                                @error('selected_subject_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success">Yenilə</button>
                            <a href="{{ route('exams.index') }}" class="btn btn-secondary">Geri Qayıt</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Tüm SelectedSubject verilerini JavaScript'e aktar
        const selectedSubjects = @json($selectedSubjects);

        // Hata ayıklama için selectedSubjects'i konsola yazdır
        console.log('Selected Subjects:', selectedSubjects);

        // Seçenekleri güncelleyen fonksiyon
        function updateSelectedSubjectOptions() {
            const typeSelect = document.getElementById('exam_type_id');
            const groupSelect = document.getElementById('exam_group_id');
            const selectedSubjectContainer = document.getElementById('selected-subject-container');
            const selectedSubjectSelect = document.getElementById('selected_subject_id');

            // Seçilen sınav tipi ve grup
            const selectedType = typeSelect.options[typeSelect.selectedIndex]?.dataset.name || '';
            const selectedGroup = groupSelect.options[groupSelect.selectedIndex]?.dataset.name || '';

            // Büyük-küçük harf duyarlılığını kaldırmak için değerleri küçük harfe çevir
            const normalizedType = selectedType.toLowerCase().trim();
            const normalizedGroup = selectedGroup.toLowerCase().trim();

            // Hata ayıklama için seçilen değerleri konsola yazdır
            console.log('Selected Type:', selectedType);
            console.log('Normalized Type:', normalizedType);
            console.log('Selected Group:', selectedGroup);
            console.log('Normalized Group:', normalizedGroup);

            // Varsayılan olarak dropdown'u gizle
            selectedSubjectContainer.style.display = 'none';
            selectedSubjectSelect.innerHTML = '<option value="">-- Seçin --</option>';

            // Koşulları kontrol et
            if (normalizedType === 'blok') {
                if (normalizedGroup === '1') {
                    // IF ve KF seçeneklerini ekle
                    const options = selectedSubjects.filter(subject => ['IF', 'KF'].includes(subject.name));
                    console.log('Filtered IF/KF Options:', options); // Hata ayıklama için
                    options.forEach(subject => {
                        const option = document.createElement('option');
                        option.value = subject.id;
                        option.text = subject.name;
                        // Mevcut seçili değeri kontrol et
                        if (subject.id == '{{ $exam->selected_subject_id }}') {
                            option.selected = true;
                        }
                        selectedSubjectSelect.appendChild(option);
                    });
                    selectedSubjectContainer.style.display = 'block';
                } else if (normalizedGroup === '3') {
                    // CT ve ƏT seçeneklerini ekle
                    const options = selectedSubjects.filter(subject => ['CT', 'ƏT'].includes(subject.name));
                    console.log('Filtered CT/ƏT Options:', options); // Hata ayıklama için
                    options.forEach(subject => {
                        const option = document.createElement('option');
                        option.value = subject.id;
                        option.text = subject.name;
                        // Mevcut seçili değeri kontrol et
                        if (subject.id == '{{ $exam->selected_subject_id }}') {
                            option.selected = true;
                        }
                        selectedSubjectSelect.appendChild(option);
                    });
                    selectedSubjectContainer.style.display = 'block';
                }
            }
        }

        // Sınav tipi veya grup değiştiğinde kontrol et
        document.getElementById('exam_type_id').addEventListener('change', updateSelectedSubjectOptions);
        document.getElementById('exam_group_id').addEventListener('change', updateSelectedSubjectOptions);

        // Sayfa yüklendiğinde de kontrol et (varsayılan değerler için)
        document.addEventListener('DOMContentLoaded', updateSelectedSubjectOptions);
    </script>

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
        .form-control, .btn {
            border-radius: 5px;
        }
        .form-label {
            font-weight: 500;
            color: #495057;
        }
        .form-select {
            max-width: 300px;
        }
        /* Dropdown seçeneklerinin yazı rengini zorla siyah yap */
        .form-select option {
            color: #000 !important;
            background-color: #fff !important;
        }
        /* Seçili seçenek için de yazı rengini siyah yap */
        .form-select option:checked {
            color: #000 !important;
            background-color: #e9ecef !important;
        }
    </style>
@endsection
