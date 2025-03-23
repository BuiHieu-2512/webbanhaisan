@extends('layouts.admin')

@section('styles')
<!-- Add any page-specific styles here -->
@endsection

@section('content')
<h1>Thống kê Doanh Thu</h1>

<form method="GET" action="{{ route('admin.dashboard') }}">
    <label for="start_date">Từ ngày:</label>
    <input type="date" id="start_date" name="start_date" value="{{ $startDate }}">

    <label for="end_date">Đến ngày:</label>
    <input type="date" id="end_date" name="end_date" value="{{ $endDate }}">

    <button type="submit">Lọc</button>
</form>

<canvas id="revenueChart"></canvas>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('revenueChart').getContext('2d');
    const revenueData = @json($orders);

    const labels = revenueData.map(order => order.date);
    const data = revenueData.map(order => order.revenue);

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Doanh thu (VNĐ)',
                data: data,
                borderColor: 'blue',
                borderWidth: 2
            }]
        }
    });
</script>
@endsection