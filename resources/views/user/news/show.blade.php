<a href="{{ route('user.news.index') }}" class="btn">Quay lại</a>


<div class="container">
    <h1>{{ $news->title }}</h1>

    @if($news->image)
        <img src="{{ asset('storage/' . $news->image) }}" alt="" style="width: 300px; height: auto; margin-bottom: 20px;">
    @endif

    <p>{{ $news->content }}</p>

    <p><strong>Ngày đăng:</strong> {{ $news->created_at->format('d/m/Y H:i') }}</p>
</div>
