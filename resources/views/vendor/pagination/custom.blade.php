@if ($paginator->hasPages())
    <nav class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span>&laquo;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span>{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="current">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a>
        @else
            <span>&raquo;</span>
        @endif
    </nav>
@endif

<style>
.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    list-style: none;
    padding: 10px;
    gap: 8px;
}

.pagination a, .pagination span {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 5px;
    border: 1px solid #007bff;
    background-color: #fff;
    color: #007bff;
    text-decoration: none;
    transition: 0.3s;
    font-size: 16px;
}

.pagination a:hover {
    background-color: #007bff;
    color: white;
}

.pagination .current {
    background-color: #007bff;
    color: white;
    font-weight: bold;
}

.pagination span {
    color: #999;
    border-color: #ccc;
    pointer-events: none;
}
</style>
