
<div class="container">
    <h2>⭐ Đánh giá sản phẩm</h2>
    <form method="POST" action="{{ route('reviews.store') }}">
    @csrf
    <input type="hidden" name="order_id" value="{{ $order->id }}">
    <input type="hidden" name="product_id" value="{{ $item->product->id }}">

    <label>Đánh giá (1-5 sao):</label>
    <select name="rating" required>
        <option value="1">⭐</option>
        <option value="2">⭐⭐</option>
        <option value="3">⭐⭐⭐</option>
        <option value="4">⭐⭐⭐⭐</option>
        <option value="5">⭐⭐⭐⭐⭐</option>
    </select>

    <label>Nhận xét:</label>
    <textarea name="comment" placeholder="Nhập nhận xét..."></textarea>

    <button type="submit">Gửi đánh giá</button>
</form>

</div>

