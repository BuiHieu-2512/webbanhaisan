<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản Phẩm theo Danh Mục</title>
</head>
<body>
    <header>
        <!-- Nội dung header -->
    </header>

    <div class="container">
        <h1>Danh Mục: {{ $category->name }}</h1>
        
        @if($products->isNotEmpty())
            <ul>
                @foreach($products as $product)
                    <li>
                        <a href="{{ route('products.show', ['id' => $product->id]) }}">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="Image" width="100" height="100">
                            <p>{{ $product->name }}</p>
                            <p>Giá: {{ number_format($product->price, 0, ',', '.') }} VNĐ</p>
                        </a>
                    </li>
                @endforeach
            </ul>

            
        @else
            <p>Không có sản phẩm nào trong danh mục này.</p>
        @endif
    </div>

    <footer>
        <!-- Nội dung footer -->
    </footer>
</body>
</html>
