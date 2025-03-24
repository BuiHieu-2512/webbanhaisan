@extends('layouts.admin')

@section('styles')
<style>
    .chart-container {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 20px;
    }

    .chart-box {
        flex: 1;
        min-width: 300px;
    }

    canvas {
        width: 100% !important;
        height: 300px !important;
    }
</style>
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

<div class="chart-container">
    <!-- Biểu đồ Doanh thu -->
    <div class="chart-box" style="width: 60%;">
        <h2>Doanh thu</h2>
        <canvas id="revenueChart"></canvas>
    </div>

    <!-- Biểu đồ tròn - Tỉ lệ đánh giá sản phẩm -->
    <div class="chart-box" style="width: 35%;">
        <h2>Tỉ lệ đánh giá sản phẩm</h2>
        <canvas id="pieChart"></canvas>
    </div>
</div>

<div class="mt-4">
    <h2>Top 10 Sản phẩm bán chạy</h2>
    <canvas id="barChart"></canvas>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Biểu đồ Doanh thu
        new Chart(document.getElementById('revenueChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: @json($orders->pluck('date')),
                datasets: [{
                    label: 'Doanh thu (VNĐ)',
                    data: @json($orders->pluck('revenue')),
                    borderColor: 'blue',
                    borderWidth: 2,
                    fill: false,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        // Biểu đồ cột - Lượt mua sản phẩm
        new Chart(document.getElementById('barChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: @json($topProducts->pluck('product.name')),
                datasets: [{
                    label: 'Lượt mua',
                    data: @json($topProducts->pluck('purchase_count')),
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        // Biểu đồ tròn - Tỉ lệ đánh giá sản phẩm
        new Chart(document.getElementById('pieChart').getContext('2d'), {
            type: 'pie',
            data: {
                labels: Object.keys(@json($reviewCounts)),
                datasets: [{
                    data: Object.values(@json($reviewCounts)),
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50', '#FF5722'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    });
</script>
@endsection
