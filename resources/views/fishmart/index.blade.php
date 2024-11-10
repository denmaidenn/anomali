@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4" style="font-weight: Bold">Fish Mart</h3>

    <!-- Sales Chart Card -->
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-4">
                        <h5 class="card-title">Grafik Penjualan</h5>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary">Mingguan</button>
                            <button type="button" class="btn btn-secondary">Bulanan</button>
                        </div>
                    </div>

                    <!-- Chart Container -->
                    <div class="product-chart-wrapper" style="height: 200px;">
                        <canvas id="salesChart"></canvas>
                    </div>

                    <!-- Chart Legend -->
                    <div id="sales-chart-legend" class="mt-2">
                        <ul>
                            <li>
                                <span style="background-color: #1991EB"></span>
                                Total Penjualan
                            </li>
                            <li>
                                <span style="background-color: #58d8a3"></span>
                                Target Penjualan
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layout.fishmart') 
    
</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Pastikan elemen canvas ada
        const canvas = document.getElementById('salesChart');
        if (!canvas) {
            console.error('Canvas element not found');
            return;
        }

        const ctx = canvas.getContext('2d');

        // Dummy data
        const salesData = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            datasets: [{
                label: 'Total Penjualan',
                data: [150, 200, 175, 225, 200, 250],
                borderColor: '#1991EB',
                backgroundColor: 'rgba(25, 145, 235, 0.2)',
                borderWidth: 2,
                fill: true
            }, {
                label: 'Target Penjualan',
                data: [180, 180, 180, 180, 180, 180],
                borderColor: '#58d8a3',
                backgroundColor: 'rgba(88, 216, 163, 0.2)',
                borderWidth: 2,
                fill: true
            }]
        };

        try {
            new Chart(ctx, {
                type: 'line',
                data: salesData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#f3f1f1'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        } catch (error) {
            console.error('Error creating chart:', error);
        }
    });
</script>
@endsection

@endsection




