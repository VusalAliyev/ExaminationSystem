<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abituriyent İmtahan Sistemi - Əsas Səhifə</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<!-- Header -->
<header class="header">
    <div class="logo">
        <span class="material-icons">book</span>
        <span>Abituriyent İmtahan Sistemi</span>
    </div>
    <form class="search-bar" method="GET" action="{{ route('home') }}">
        <span class="material-icons">search</span>
        <input type="text" name="search" placeholder="İmtahan axtar..." value="{{ request('search') }}">
    </form>
    <div class="profile">
        <span class="material-icons">account_circle</span>
        <span>Salam, {{ $user->name }}!</span>
    </div>
</header>

<!-- Main Content -->
<div class="container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <h2>İmtahanları Filtrlə</h2>
        <form method="GET" action="{{ route('home') }}">
            <div class="filter">
                <label for="year">İl:</label>
                <select id="year" name="year">
                    <option value="">Hamısı</option>
                    @foreach ($years as $year)
                        <option value="{{ $year->id }}" {{ request('year') == $year->id ? 'selected' : '' }}>
                            {{ $year->year }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="filter">
                <label for="group">Qrup:</label>
                <select id="group" name="group" onchange="toggleSelectedSubject()">
                    <option value="">Hamısı</option>
                    @foreach ($groups as $group)
                        <option value="{{ $group->id }}" {{ request('group') == $group->id ? 'selected' : '' }}>
                            {{ $group->group_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="filter">
                <label for="type">Tip:</label>
                <select id="type" name="type" onchange="toggleSelectedSubject()">
                    <option value="">Hamısı</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ request('type') == $type->id ? 'selected' : '' }}>
                            {{ $type->type }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="filter">
                <label for="organizer">Təşkilatçı:</label>
                <select id="organizer" name="organizer">
                    <option value="">Hamısı</option>
                    @foreach ($organizers as $organizer)
                        <option value="{{ $organizer->id }}" {{ request('organizer') == $organizer->id ? 'selected' : '' }}>
                            {{ $organizer->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="filter">
                <label for="sector">Sektor:</label>
                <select id="sector" name="sector">
                    <option value="">Hamısı</option>
                    @foreach ($sectors as $sector)
                        <option value="{{ $sector->id }}" {{ request('sector') == $sector->id ? 'selected' : '' }}>
                            {{ $sector->sector_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="filter" id="selectedSubjectFilter" style="display: none;">
                <label for="selected_subject">Seçmə Fənn:</label>
                <select id="selected_subject" name="selected_subject">
                    <option value="">Hamısı</option>
                    <!-- Seçmə fənlər JavaScript ilə dinamik doldurulacaq -->
                </select>
            </div>
            <button type="submit" class="apply-btn">Tətbiq Et</button>
        </form>
    </aside>

    <!-- Exam Cards -->
    <main class="main-content">
        <h1>Mövcud İmtahanlar</h1>
        <div class="exam-grid">
            @forelse ($exams as $exam)
                <div class="exam-card">
                    <h3>{{ $exam->name }}</h3>
                    <p>Təşkilatçı: {{ $exam->organizer ? $exam->organizer->name : 'Təyin edilməyib' }}</p>
                    <p>İl: {{ $exam->year ? $exam->year->year : 'Təyin edilməyib' }}</p>
                    <p>Qrup: {{ $exam->group ? $exam->group->group_name : 'Təyin edilməyib' }}</p>
                    <p>Tip: {{ $exam->type ? $exam->type->type : 'Təyin edilməyib' }}</p>
                    <p>Sektor: {{ $exam->sector ? $exam->sector->sector_name : 'Təyin edilməyib' }}</p>
                    <p>Seçmə Fənn: {{ $exam->selected_subject ? $exam->selected_subject->name : 'Təyin edilməyib' }}</p>
                    <button class="start-btn" onclick="confirmStartExam('{{ route('exam', $exam->id) }}')">İmtahanı Başlat</button>
                </div>
            @empty
                <p>Heç bir imtahan tapılmadı.</p>
            @endforelse
        </div>
    </main>
</div>

<!-- Footer -->
<footer class="footer">
    <p>© 2025 Abituriyent İmtahan Sistemi</p>
    <div class="footer-links">
        <a href="#">Bizimlə Əlaqə</a>
        <a href="#">Şərtlər və Qaydalar</a>
    </div>
</footer>

<!-- JavaScript for Showing/Hiding and Populating Selected Subject Filter -->
<!-- JavaScript for Showing/Hiding and Populating Selected Subject Filter -->
<!-- JavaScript for Showing/Hiding and Populating Selected Subject Filter -->
<script>
    // Seçmə fənlər (serverdən gələn məlumatlar)
    const subjects = @json($selected_subjects->mapWithKeys(function ($subject) {
        return [$subject->id => $subject->name];
    })->toArray());

    // Seçmə fənləri qrupa görə filtrləmək üçün mapping
    const subjectMapping = {
        'KF': 'kf',
        'IF': 'if',
        'CT': 'ct',
        'ƏT': 'et'
    };

    // Qrupa görə icazə verilən fənlər
    const allowedSubjects = {
        1: ['kf', 'if'], // 1-ci qrup: Kimya və İnformatika
        3: ['ct', 'et']  // 3-cü qrup: Coğrafiya və Ədəbiyyat
    };

    function toggleSelectedSubject() {
        const groupSelect = document.getElementById('group');
        const typeSelect = document.getElementById('type');
        const selectedSubjectFilter = document.getElementById('selectedSubjectFilter');
        const selectedSubjectDropdown = document.getElementById('selected_subject');
        const selectedGroupId = groupSelect.value;
        const selectedTypeId = typeSelect.value;

        // Buraxılış imtahanı seçilibsə seçmə fənn filtri gizlənsin
        const types = @json($types->mapWithKeys(function ($type) {
            return [$type->id => $type->type];
        })->toArray());
        const isGraduation = types[selectedTypeId] === 'Buraxılış';

        if (isGraduation || (selectedGroupId != 1 && selectedGroupId != 3)) {
            selectedSubjectFilter.style.display = 'none';
            return;
        }

        // 1-ci və 3-cü qruplar seçildikdə seçmə fənn filtri görünsün
        selectedSubjectFilter.style.display = 'block';

        // Dropdown-u təmizlə
        selectedSubjectDropdown.innerHTML = '<option value="">Hamısı</option>';

        // Qrupa uyğun fənləri əlavə et
        const allowed = allowedSubjects[selectedGroupId] || [];
        for (const [id, name] of Object.entries(subjects)) {
            const shortName = subjectMapping[name]; // Adı qısaldılmış formaya çevir
            if (allowed.includes(shortName)) {
                const option = document.createElement('option');
                option.value = id;
                option.text = name;
                if (id == '{{ request('selected_subject') }}') {
                    option.selected = true;
                }
                selectedSubjectDropdown.appendChild(option);
            }
        }
    }

    // Səhifə yüklənəndə filtri yoxla
    window.onload = function() {
        toggleSelectedSubject();
    };
</script>
<!-- JavaScript for SweetAlert Confirmation -->
<script>
    function confirmStartExam(url) {
        Swal.fire({
            title: 'İmtahana başlamaq istədiyinizə əminsiniz mi?',
            text: 'İmtahanı başlatdıqdan sonra geri dönüş olmayacaq!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Okay',
            cancelButtonText: 'Ləğv et'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url; // İmtahan səhifəsinə yönləndir
            }
        });
    }
</script>
</body>
</html>
