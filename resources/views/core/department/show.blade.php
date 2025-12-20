@extends('core.layout.app')

@section('content')
<div class="container-fluid" style="font-family: 'Times New Roman', Times, serif;">

    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 text-gray-800">{{ $department['name_en'] }} Dashboard</h1>
        </div>
    </div>

    <!-- Department Info Card -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $department['name_en'] }}</h6>
                </div>
                <div class="card-body">
                    <p><strong>Code:</strong> {{ $department['code'] ?? 'N/A' }}</p>
                    <p><strong>Name (Nepali):</strong> {{ $department['name_ne'] }}</p>
                    <p><strong>Description:</strong> {{ $department['description'] ?? 'No description available' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header font-weight-bold">Pie Chart</div>
                <div class="card-body"><canvas id="pieChart"></canvas></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header font-weight-bold">Bar Chart</div>
                <div class="card-body"><canvas id="barChart"></canvas></div>
            </div>
        </div>
        <div class="col-md-6 mt-4">
            <div class="card shadow">
                <div class="card-header font-weight-bold">Line Chart</div>
                <div class="card-body"><canvas id="lineChart"></canvas></div>
            </div>
        </div>
        <div class="col-md-6 mt-4">
            <div class="card shadow">
                <div class="card-header font-weight-bold">Histogram</div>
                <div class="card-body"><canvas id="histogramChart"></canvas></div>
            </div>
        </div>
    </div>

    <!-- Programs Table -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header font-weight-bold">Programs, Sectors & Sub-Sectors</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Program</th>
                                <th>Sector</th>
                                <th>Sub-Sectors</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($programs as $program)
                            <tr>
                                <td>{{ $program['name'] }}</td>
                                <td>{{ $program['sector'] }}</td>
                                <td>{{ implode(', ', $program['subSectors']) ?: 'N/A' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Back Button -->
    <div class="row">
        <div class="col-12">
            <a href="{{ route('dashboard') }}" class="btn btn-primary">Back to Dashboard</a>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Sample chart data from controller
    const chartLabels = @json($chartData['labels']);
    const chartValues = @json($chartData['values']);

    // Pie Chart
    new Chart(document.getElementById('pieChart'), {
        type: 'pie',
        data: {
            labels: chartLabels,
            datasets: [{
                data: chartValues,
                backgroundColor: chartLabels.map(() => `hsl(${Math.random()*360}, 70%, 60%)`)
            }]
        }
    });

    // Bar Chart
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: chartLabels,
            datasets: [{
                label: 'Values',
                data: chartValues,
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
            }]
        },
        options: {
            scales: { y: { beginAtZero: true } }
        }
    });

    // Line Chart
    new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: chartLabels,
            datasets: [{
                label: 'Values',
                data: chartValues,
                borderColor: 'rgba(255, 99, 132, 0.8)',
                fill: false
            }]
        }
    });

    // Histogram (using bar type as simple histogram)
    new Chart(document.getElementById('histogramChart'), {
        type: 'bar',
        data: {
            labels: chartLabels,
            datasets: [{
                label: 'Frequency',
                data: chartValues,
                backgroundColor: 'rgba(255, 206, 86, 0.7)',
            }]
        },
        options: {
            scales: { y: { beginAtZero: true } }
        }
    });
</script>
@endpush
