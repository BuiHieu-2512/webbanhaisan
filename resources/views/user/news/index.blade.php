
<div class="container">

<a href="{{ route('user.dashboard') }}" class="btn-back">⬅ Quay lại Trang Chủ</a>

    <h1>Danh sách Tin Tức</h1>

    @if($news->isEmpty())
        <p>Hiện chưa có tin tức nào.</p>
    @else
        @foreach($news as $item)
            <div style="border-bottom: 1px solid #ccc; margin-bottom: 15px;">
                <h2>{{ $item->title }}</h2>
                
                {{-- Giới hạn hiển thị 100 ký tự đầu, dùng Str::limit nếu muốn --}}
                <p>{{ \Illuminate\Support\Str::limit($item->content, 100) }}</p>
                
                @if($item->image)
                    <img src="{{ asset('storage/' . $item->image) }}" alt="" style="width: 200px; height: auto;">
                @endif

                <p>
                    <a href="{{ route('user.news.show', $item->id) }}" style="color: blue;">Xem chi tiết &raquo;</a>
                </p>
            </div>
        @endforeach

        {{-- Hiển thị phân trang --}}
        <div style="margin-top: 20px;">
            {{ $news->links() }}
        </div>
    @endif
</div>

