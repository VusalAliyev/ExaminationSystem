<div class="sidebar col-md-2">
    <h4 class="text-center">Navigasyon</h4>
    <hr>
    <a href="{{ route('exam-types.index') }}">Sınav Türleri</a>
    <a href="{{ route('exam-years.index') }}">Sınav Yılları</a>
    <a href="{{ route('exam-groups.index') }}">Sınav Grupları</a>
    <a href="{{ route('exam-subjects.index') }}">Sınav Konuları</a>
    <a href="{{ route('exam-organizers.index') }}">Organizatörler</a>
    <a href="{{ route('exams.index') }}">Sınavlar</a>
    <a href="{{ route('exam-questions.index') }}">Sınav Soruları</a>
    <a href="{{ route('exam-answers.index') }}">Sınav Cevapları</a>
    <a href="{{ route('answer-images.index') }}">Cevap Resimleri</a>
    <a href="{{ route('question-images.index') }}">Soru Resimleri</a>
</div>

<style>
    .sidebar {
        min-height: 100vh;
        background-color: #f8f9fa;
        padding-top: 20px;
    }
    .sidebar a {
        color: #333;
        padding: 10px 15px;
        display: block;
        text-decoration: none;
    }
    .sidebar a:hover {
        background-color: #e9ecef;
    }
    .content {
        padding: 20px;
    }
</style>
