@extends('core.layout.app')

@section('content')
    <div class="card">
        <div class="card-header">KPI Snapshot Page</div>
        <div class="card-body">
           <form action="{{ route('kpi-snapshots.store') }}" method="POST">
            @csrf
             <div class="row">
                <div class="col-lg-5">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="mb-3">
                                    <label class="form-label">Department (optional)</label>
                                    <select name="department_id" class="form-control">
                                        <option selected value="">-- Select Option --</option>
                                        @foreach ($departments as $d)
                                            <option value="{{ $d->id }}" @selected(old('department_id') == $d->id)>
                                                {{ $d->name_en ?? $d->name_ne }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="text-muted">Choose if snapshot is department-level KPI.</small>
                                    <br>
                                    @error('department_id')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="mb-3">
                                    <label class="form-label">Program (optional)</label>
                                    <select name="program_id" class="form-control">
                                       <option selected value="">-- Select Option --</option>
                                        @foreach ($programs as $p)
                                            <option value="{{ $p->id }}" @selected(old('program_id') == $p->id)>
                                                {{ $p->name_en ?? $p->name_ne }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="text-muted">Choose if snapshot is program-level KPI.</small>
                                    <br>
                                    @error('program_id')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="mb-3">
                                    <label class="form-label">Indicator (optional)</label>
                                    <select name="indicator_id" class="form-control">
                                        <option selected value="">-- Select Option --</option>
                                        @foreach ($indicators as $i)
                                            <option value="{{ $i->id }}" @selected(old('indicator_id') == $i->id)>
                                                {{ $i->source_type }} {{ $i->code }} – {{ $i->short_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="text-muted">Choose if snapshot is indicator-level KPI.</small>
                                    <br>
                                    @error('indicator_id')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="mb-3">
                                    <label class="form-label">Snapshot Date</label>
                                    <input type="date" name="snapshot_date" class="form-control"
                                        value="{{ old('snapshot_date', now()->toDateString()) }}" required>
                                    <small class="text-muted">Example: 2025-12-14</small>
                                    <br>
                                    @error('snapshot_date')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="mb-3">
                                    <label class="form-label">Value (optional)</label>
                                    <input type="number" name="value" class="form-control" step="0.01"
                                        placeholder="e.g. 12.50" value="{{ old('value') }}">
                                    <small class="text-muted">Numeric value based on indicator unit (%, minutes, score,
                                        ratio, etc.).</small><br>
                                        @error('value')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="mb-3">
                                    <label class="form-label">Progress (%)</label>
                                    <input type="number" name="progress_percent" class="form-control" min="0"
                                        max="100" step="1" value="{{ old('progress_percent', 0) }}" required>
                                    <small class="text-muted">0–100 only</small>
                                    @error('progress_percent')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">Save Sector</button>
                        </div>
                    </div>
                </div>
            </div>
           </form>
        </div>
    </div>
@endsection
