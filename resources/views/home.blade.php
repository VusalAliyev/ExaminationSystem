<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abituriyent İmtahan Sistemi - Əsas Səhifə</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<!-- Navbar -->
<nav class="navbar">
    <a href="{{ route('home') }}" class="navbar-logo">
        <i class="fas fa-book"></i>
        <span>Abituriyent İmtahan Sistemi</span>
    </a>
    <form class="navbar-search" method="GET" action="{{ route('home') }}">
        <i class="fas fa-search"></i>
        <input type="text" name="search" placeholder="İmtahan axtar..." value="{{ request('search') }}">
    </form>
    <div class="navbar-links">
        <a href="#">Əsas Səhifə</a>
        <a href="#">Haqqımızda</a>
        <a href="#">İmtahanlar</a>
        <a href="#">Əlaqə</a>
    </div>
    <div class="navbar-profile">
        <i class="fas fa-user-circle"></i>
        @if($user)
            <span>Salam, {{ $user->name }}!</span>
        @else
            <span>Salam, Qonaq! <a href="{{ route('login') }}">Giriş Yap</a></span>
        @endif
    </div>
</nav>

<!-- Main Content -->
<div class="container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <h2>İmtahanları Filtrlə</h2>
        <form method="GET" action="{{ route('home') }}" id="filterForm">
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
                <select id="group" name="group" onchange="updateSelectedSubjectDropdown()">
                    <option value="">Hamısı</option>
                    @foreach ($groups as $group)
                        <option value="{{ $group->id }}" data-group-name="{{ $group->group_name }}" {{ request('group') == $group->id ? 'selected' : '' }}>
                            {{ $group->group_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="filter">
                <label for="type">Tip:</label>
                <select id="type" name="type" onchange="updateSelectedSubjectDropdown()">
                    <option value="">Hamısı</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" data-type-name="{{ $type->type }}" {{ request('type') == $type->id ? 'selected' : '' }}>
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
                    <option value="">Seçin</option>
                </select>
            </div>
            <button type="submit" class="apply-btn">Tətbiq Et</button>
        </form>
    </aside>

    <!-- Exam Cards -->
    <main class="main-content">
        <h1>Mövcud İmtahanlar</h1>
        <div class="exam-grid-wrapper">
            <div class="exam-grid">
                @forelse ($exams as $index => $exam)
                    <div class="exam-card" data-index="{{ $index }}" style="display: none;">
                        <h3>{{ $exam->name }}</h3>
                        <p>Təşkilatçı: {{ $exam->organizer ? $exam->organizer->name : 'Təyin edilməyib' }}</p>
                        <p>İl: {{ $exam->year ? $exam->year->year : 'Təyin edilməyib' }}</p>
                        <p>Qrup: {{ $exam->group ? $exam->group->group_name : 'Təyin edilməyib' }}</p>
                        <p>Tip: {{ $exam->type ? $exam->type->type : 'Təyin edilməyib' }}</p>
                        <p>Sektor: {{ $exam->sector ? $exam->sector->sector_name : 'Təyin edilməyib' }}</p>
                        <button class="start-btn" onclick="startExam('{{ route('exam', $exam->id) }}')">İmtahana Başlat</button>
                    </div>
                @empty
                    <p class="no-exam">Heç bir imtahan tapılmadı.</p>
                @endforelse
            </div>
            <button id="load-more-btn" class="load-more-btn">Daha Çox</button>
        </div>
    </main>
</div>

<!-- Footer -->
<footer class="footer">
    <p>© 2025 Abituriyent İmtahan Sistemi</p>
    <span class="developed-by">NVSoft tərəfindən hazırlanıb</span>
    <div class="footer-links">
        <a href="#">Bizimlə Əlaqə</a>
        <a href="#">Şərtlər və Qaydalar</a>
    </div>
</footer>

<!-- JavaScript -->
<script>
    function updateSelectedSubjectDropdown() {
        const typeSelect = document.getElementById('type');
        const groupSelect = document.getElementById('group');
        const selectedSubjectFilter = document.getElementById('selectedSubjectFilter');
        const selectedSubject = document.getElementById('selected_subject');

        // Seçilen değerleri al
        const selectedType = typeSelect.options[typeSelect.selectedIndex]?.dataset.typeName || '';
        const selectedGroup = groupSelect.options[groupSelect.selectedIndex]?.dataset.groupName || '';

        console.log('Selected Type:', selectedType);
        console.log('Selected Group:', selectedGroup);

        // Dropdown’u sıfırla
        selectedSubject.innerHTML = '<option value="">Seçin</option>';
        selectedSubjectFilter.style.display = 'none';

        // Blok türü ve Qrup 1 seçildiyse IF ve KF göster
        if (selectedType === 'Blok' && selectedGroup === '1') {
            selectedSubjectFilter.style.display = 'block';
            selectedSubject.innerHTML += `
                <option value="KF">Kimya-Fizika</option>
                <option value="IF">İnformatika-Fizika</option>
            `;
        }
        // Blok türü ve Qrup 3 seçildiyse ƏT ve CT göster
        else if (selectedType === 'Blok' && selectedGroup === '3') {
            selectedSubjectFilter.style.display = 'block';
            selectedSubject.innerHTML += `
                <option value="ƏT">Ədəbiyyat-Tarix</option>
                <option value="CT">Coğrafiya-Tarix</option>
            `;
        }
    }

    function startExam(url) {
        Swal.fire({
            title: 'İmtahana başlamaq istədiyinizə əminsiniz mi?',
            text: 'İmtahanı başlatdıqdan sonra geri dönüş olmayacaq!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#a855f7',
            cancelButtonColor: '#ef4444',
            confirmButtonText: 'Bəli, başla',
            cancelButtonText: 'Ləğv et'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }

    function initializeLoadMore() {
        const examCards = document.querySelectorAll('.exam-card');
        const loadMoreBtn = document.getElementById('load-more-btn');
        const totalCards = examCards.length;

        console.log('Total Cards:', totalCards); // Hata ayıklama için

        if (totalCards === 0) {
            loadMoreBtn.style.display = 'none';
            return;
        }

        let cardsPerRow = 4;
        if (window.innerWidth <= 1200) cardsPerRow = 3;
        if (window.innerWidth <= 768) cardsPerRow = 2;
        if (window.innerWidth <= 480) cardsPerRow = 1;

        const cardsPerLoad = cardsPerRow * 2; // Her yüklemede 2 satır kart
        let visibleCards = cardsPerLoad;

        console.log('Cards Per Load:', cardsPerLoad, 'Visible Cards:', visibleCards); // Hata ayıklama için

        // İlk kartları göster
        examCards.forEach((card, index) => {
            if (index < visibleCards) {
                card.style.display = 'block';
            }
        });

        // Daha fazla kart varsa butonu göster
        if (totalCards > visibleCards) {
            loadMoreBtn.style.display = 'block';
        } else {
            loadMoreBtn.style.display = 'none';
        }

        loadMoreBtn.addEventListener('click', () => {
            visibleCards += cardsPerLoad;

            console.log('Load More Clicked, New Visible Cards:', visibleCards); // Hata ayıklama için

            examCards.forEach((card, index) => {
                if (index < visibleCards) {
                    card.style.display = 'block';
                }
            });

            if (visibleCards >= totalCards) {
                loadMoreBtn.style.display = 'none';
            }
        });
    }

    window.onload = function() {
        initializeLoadMore();
        updateSelectedSubjectDropdown(); // İlk yüklemede dropdown’u güncelle
    };
</script>
</body>
</html>
