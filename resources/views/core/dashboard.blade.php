@extends('core.layout.app')

@section('content')
<div class="container">
    <h1>Smart City DSS Dashboard</h1>

    <p class="mb-3">
        Programs contributing to <strong>SDG 11</strong>: {{ $sdg11Count }}
    </p>

    <div class="card">
        <div class="card-header">
            Department-wise Program Progress (%)
        </div>
        <div class="card-body">
            <canvas id="departmentProgressChart" height="120"></canvas>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('departmentProgressChart').getContext('2d');

    const departmentLabels = @json($departmentKpis->pluck('name'));
    const departmentValues = @json($departmentKpis->pluck('progress'));

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: departmentLabels,
            datasets: [{
                label: 'Average Program Progress (%)',
                data: departmentValues,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                tooltip: {
                    enabled: true,
                    callbacks: {
                        label: function(context) {
                            return context.parsed.y + '% completed';
                        }
                    }
                },
                legend: {
                    display: false
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    title: {
                        display: true,
                        text: 'Progress (%)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Departments'
                    }
                }
            }
        }
    });
</script>
@endpush
