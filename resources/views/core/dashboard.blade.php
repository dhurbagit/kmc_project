@extends('core.layout.app')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    {{-- ********************************************************************************************************************************************* --}}
    {{-- Filter Form --}}
    <form class="row g-3 mb-4" method="GET" action="{{ route('dss.dashboard') }}">
        <div class="col-md-3">
            <label class="form-label">Fiscal Code</label>
            <select name="fiscal_code" class="form-control">
                @for ($y = 2078; $y <= 2090; $y++)
                    @php
                        $value = $y . '/' . substr($y + 1, -2);
                        $selectedValue = request('fiscal_code') ?? (old('fiscal_code') ?? '2082/83');
                    @endphp

                    <option value="{{ $value }}" {{ $selectedValue === $value ? 'selected' : '' }}>
                        {{ $value }}
                    </option>
                @endfor
            </select>

        </div>

        <div class="col-md-4">
            <label class="form-label">Department</label>
            <select name="department_id" class="form-control">
                <option value="">All Departments</option>
                @foreach ($departments as $d)
                    <option value="{{ $d->id }}" @selected((int) $departmentId === $d->id)>
                        {{ $d->name_ne }} ({{ $d->code }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2 d-flex align-items-end">
            <button class="btn btn-primary w-100">Apply</button>
        </div>
    </form>
    {{-- ********************************************************************************************************************************************* --}}
    {{-- KPI Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="small text-muted">Allocated</div>
                    <div class="h4 mb-0">Rs. {{ number_format($kpi->allocated ?? 0, 2) }}</div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="small text-muted">Revised</div>
                    <div class="h4 mb-0">Rs. {{ number_format($kpi->revised ?? 0, 2) }}</div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="small text-muted">Expenditure</div>
                    <div class="h4 mb-0">Rs. {{ number_format($kpi->expenditure ?? 0, 2) }}</div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="small text-muted">Programs / Departments</div>
                    <div class="h4 mb-0">{{ $totalPrograms }} / {{ $totalDepartments }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    @if ($selectedDepartment)
                        @php
                            $deptUsedPct = $deptAllocatedTotal > 0 ? ($deptUsedTotal * 100) / $deptAllocatedTotal : 0;
                            $deptGapPct = $deptAllocatedTotal > 0 ? 100 - $deptUsedPct : 0;
                        @endphp
                    @endif
                    Sector-wise Allocated ({{ $selectedDepartment->name_ne ?? 'Not Selected Department' }}) —
                    @if ($selectedDepartment)
                        <strong>Used%:</strong> {{ number_format($deptUsedPct, 2) }}%
                        — <strong>Gap%:</strong> {{ number_format($deptGapPct, 2) }}%
                    @else
                        <span class="text-muted">
                            Select a department to see Used% and Gap%.
                        </span>
                    @endif

                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card shadow-sm">
                            <div class="card-body">

                                {{-- A) ALL DEPARTMENTS => MANY PIES --}}
                                @if ($isAllDepartments)
                                    <div class="row g-3">
                                        @foreach ($deptSectorPies as $i => $pie)
                                            <div class="col-md-6 col-lg-4">
                                                <div class="card shadow-sm h-100">
                                                    <div class="card-header">
                                                        {{ $pie['department_name'] }} — Sector-wise USED
                                                        ({{ $fiscalCode }})
                                                    </div>

                                                    <div class="card-body">
                                                        {{-- IMPORTANT: give chart a height --}}
                                                        <div style="height:260px;">
                                                            <canvas id="deptPie_{{ $i }}"></canvas>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif


                                {{-- B) SINGLE DEPARTMENT => ONE PIE (clickable) --}}
                                @if (!$isAllDepartments && $selectedDepartment)
                                    <div class="card shadow-sm mt-3">
                                        <div class="card-header">
                                            {{ $selectedDepartment->name_ne ?? $selectedDepartment->name_en }} —
                                            Sector-wise USED ({{ $fiscalCode }})
                                        </div>

                                        <div class="card-body">
                                            {{-- IMPORTANT: give chart a height --}}
                                            <div style="height:320px;">
                                                <canvas id="sectorPie"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <br>
            @if ($departmentId && $sectorId)
                <div class="card shadow-sm mb-3">
                    <div class="card-header">
                        Clicked Sector Detail — Fiscal: {{ $fiscalCode }}
                    </div>
                    <div class="card-body">
                        {{-- Program Detail --}}
                        <h6 class="mb-2">Programs (Under Sector:
                            {{ $selectedSector?->name_ne ?? ($selectedSector?->name_en ?? '—') }})</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>Main Program</th>
                                        <th>Program</th>
                                        <th class="text-end">Allocated</th>
                                        <th class="text-end">Used</th>
                                        <th class="text-end">Gap</th>
                                        <th class="text-end">Used %</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($programRows as $p)
                                        @php
                                            $alloc = (float) $p->allocated;
                                            $used = (float) $p->used;
                                            $usedPct = $alloc > 0 ? ($used * 100) / $alloc : 0;
                                            $mpName = $p->main_program_name_ne ?: $p->main_program_name_en;
                                            $progName = $p->name_ne ?: $p->name_en;
                                        @endphp
                                        <tr>
                                            <td>{{ $mpName ?? '—' }}</td>
                                            <td>{{ $progName }} @if ($p->code)
                                                    ({{ $p->code }})
                                                @endif
                                            </td>
                                            <td class="text-end">{{ number_format($alloc, 2) }}</td>
                                            <td class="text-end">{{ number_format($used, 2) }}</td>
                                            <td class="text-end">{{ number_format($p->gap_amount, 2) }}</td>
                                            <td class="text-end">{{ number_format($usedPct, 2) }}%</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            @endif

            <br>
            {{-- Department Summary --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header">Department Summary ({{ $fiscalCode }})</div>
                <div class="card-body table-responsive">
                    <table class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <th>Department</th>
                                <th>Sector</th>
                                <th>Sub-sector</th>
                                <th>Main Program</th>
                                <th>Program</th>
                                <th class="text-end">Allocated</th>
                                <th class="text-end">Revised</th>
                                <th class="text-end">Expenditure</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($departmentSummary as $r)
                                <tr>
                                    <td>{{ $r->department_name }}</td>
                                    <td>{{ $r->sector_name ?? '—' }}</td>
                                    <td>{{ $r->sub_sector_name ?? '—' }}</td>
                                    <td>{{ $r->main_program_name ?? '—' }}</td>
                                    <td>{{ $r->program_name }} ({{ $r->program_code ?? '-' }})</td>
                                    <td class="text-end">{{ number_format($r->allocated, 2) }}</td>
                                    <td class="text-end">{{ number_format($r->revised, 2) }}</td>
                                    <td class="text-end">{{ number_format($r->expenditure, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>
@endsection
@push('scripts')
    
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            function buildColors(n) {
                const palette = ['#4e79a7', '#f28e2b', '#e15759', '#76b7b2', '#59a14f', '#edc948', '#b07aa1', '#ff9da7',
                    '#9c755f', '#bab0ab', '#2f4b7c', '#665191'
                ];
                return Array.from({
                    length: n
                }, (_, i) => palette[i % palette.length]);
            }

            function renderPie(canvasId, labels, used, alloc, sectorIds = null, deptId = null, fiscalCode = null) {
                const el = document.getElementById(canvasId);
                if (!el) {
                    console.log("missing canvas:", canvasId);
                    return;
                }

                labels = labels || [];
                used = (used || []).map(Number);
                alloc = (alloc || []).map(Number);

                console.log("render", canvasId, {
                    labels,
                    used,
                    alloc
                });

                if (!labels.length || !used.length) return;

                const total = used.reduce((a, b) => a + (b || 0), 0);
                if (total <= 0) return;

                window.__charts = window.__charts || {};
                if (window.__charts[canvasId]) window.__charts[canvasId].destroy();

                window.__charts[canvasId] = new Chart(el.getContext('2d'), {
                    type: 'pie',
                    data: {
                        labels,
                        datasets: [{
                            data: used,
                            backgroundColor: buildColors(labels.length),
                            borderColor: '#fff',
                            borderWidth: 2,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            },
                            tooltip: {
                                callbacks: {
                                    title: (items) => items?.[0]?.label ?? '',
                                    label: (ctx) => {
                                        const i = ctx.dataIndex;
                                        const u = used[i] || 0;
                                        const a = alloc[i] || 0;
                                        const g = Math.max(a - u, 0);
                                        const usedPct = a > 0 ? (u * 100 / a) : 0;
                                        const gapPct = a > 0 ? (100 - usedPct) : 0;
                                        const fmt = (n) => new Intl.NumberFormat().format(Math.round(n));
                                        return [
                                            `Allocated: Rs. ${fmt(a)}`,
                                            `Used: Rs. ${fmt(u)}`,
                                            `Gap: Rs. ${fmt(g)}`,
                                            `Used %: ${usedPct.toFixed(2)}%`,
                                            `Gap %: ${gapPct.toFixed(2)}%`,
                                        ];
                                    }
                                }
                            }
                        },
                        onClick: (evt, elements) => {
                            if (!sectorIds || !deptId || !fiscalCode) return;
                            if (!elements.length) return;
                            const idx = elements[0].index;
                            const sectorId = sectorIds[idx];
                            if (!sectorId) return;

                            const url = new URL(window.location.href);
                            url.searchParams.set('department_id', deptId);
                            url.searchParams.set('fiscal_code', fiscalCode);
                            url.searchParams.set('sector_id', sectorId);
                            url.hash = 'sector-detail';
                            window.location.href = url.toString();
                        }
                    }
                });
            }

            document.addEventListener('DOMContentLoaded', function() {
                // MULTI (All departments)
                @if ($isAllDepartments)
                    const pies = @json($deptSectorPies);
                    const fiscal = @json($fiscalCode);
                    pies.forEach((p, i) => {
                        renderPie(`deptPie_${i}`, p.labels, p.used, p.alloc, p.sector_ids, p.department_id,
                            fiscal);
                    });
                @endif

                // SINGLE (Selected department)
                @if (!$isAllDepartments && $selectedDepartment)
                    renderPie(
                        'sectorPie',
                        @json($sectorPieLabels),
                        @json($sectorPieUsed),
                        @json($sectorAllocated),
                        @json(collect($sectorSummary)->pluck('id')->values()->all()),
                        @json($departmentId),
                        @json($fiscalCode)
                    );
                @endif
            });
        </script>
    
@endpush
