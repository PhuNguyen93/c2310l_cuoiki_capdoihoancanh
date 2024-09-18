<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
    <title>Car Rental Dashboard</title>
    <style>
        body {
            background-color: #f4f7fa;
            font-family: 'Arial', sans-serif;
            color: #333;
        }
        .card {
            border: none;
            border-radius: 15px;
            transition: transform 0.3s, box-shadow 0.3s;
            height: 100%;
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .widget {
            padding: 30px;
            border-radius: 15px;
            color: #fff;
        }
        .bg-primary { background-color: #007bff !important; }
        .bg-success { background-color: #28a745 !important; }
        .bg-warning { background-color: #ffc107 !important; }
    </style>
</head>
<body>

@extends('layouts.adminApp')

@section('content')
<div class="container-fluid">
    <div class="row">
        <main role="main" class="col-12">
            <h1 class="h2 text-center my-4">Car Rental Dashboard</h1>
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card bg-primary widget">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-car-front widget-icon"></i> Total Cars</h5>
                            <p class="card-text fs-2">0</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-success widget">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-car-side widget-icon"></i> Cars Currently Rented</h5>
                            <p class="card-text fs-2">0</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-warning widget">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-cash widget-icon"></i> Total Revenue</h5>
                            <p class="card-text fs-2">0 VND</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Revenue Over Time</h5>
                            <canvas id="revenueChart" class="revenue-chart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Recent Activities</h5>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Vehicle</th>
                                        <th>Rental Date</th>
                                        <th>Return Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($borrowings as $borrowing)
                                    <tr>
                                        <td>{{ $borrowing->driver->user->name }}</td>
                                        <td>{{ $borrowing->vehicle->vehicle_name }}</td>
                                        <td>{{ $borrowing->borrow_date->format('d/m/Y') }}</td>
                                        <td>{{ $borrowing->return_date ? $borrowing->return_date->format('d/m/Y') : 'Not Returned' }}</td>
                                        <td>{{ $borrowing->vehicle->status }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Pagination links -->
                            <div class="d-flex justify-content-center mt-4">
    <nav aria-label="Page navigation">
        <ul class="pagination pagination-rounded">
            <li class="page-item {{ $borrowings->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $borrowings->url(1) }}" aria-label="First">
                    <span aria-hidden="true">&laquo;&laquo;</span>
                </a>
            </li>
            <li class="page-item {{ $borrowings->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $borrowings->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

            @foreach ($borrowings->getUrlRange(1, $borrowings->lastPage()) as $page => $url)
                <li class="page-item {{ $page == $borrowings->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach

            <li class="page-item {{ $borrowings->hasMorePages() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $borrowings->nextPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
            <li class="page-item {{ $borrowings->hasMorePages() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $borrowings->url($borrowings->lastPage()) }}" aria-label="Last">
                    <span aria-hidden="true">&raquo;&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script>
    // JavaScript to draw the revenue chart
    var ctx = document.getElementById('revenueChart').getContext('2d');
    var revenueChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May'],
            datasets: [{
                label: 'Revenue',
                data: [1200000, 1500000, 1800000, 1300000, 1600000],
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 2,
                fill: true
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection

</body>
</html>