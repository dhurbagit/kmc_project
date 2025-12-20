@extends('core.layout.app')

@section('content')
    <div class="card">
        <div class="card-header">Evaluations Page</div>
        <div class="card-body">
            <form action="{{ route('evaluations.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-5">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="mb-3">
                                        <label class="form-label">Program</label>
                                        <select name="program_id" class="form-control">
                                            <option selected value="">--Select Program--</option>
                                            @foreach ($programs as $p)
                                                <option value="{{ $p->id }}">{{ $p->name_en ?? $p->name_ne }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('program_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="mb-3">
                                        <label class="form-label">Indicator</label>
                                        <select name="indicator_id" class="form-control">
                                            <option selected value="">--Select Program--</option>
                                            @foreach ($indicators as $i)
                                                <option value="{{ $i->id }}">{{ $i->source_type }}
                                                    {{ $i->code }} – {{ $i->short_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('indicator_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="mb-3">
                                        <label class="form-label">Year (AD)</label>
                                        <input type="number" name="year" class="form-control" min="2000"
                                            max="2100" step="1" placeholder="2024" value="{{ old('year') }}">
                                    </div>
                                    @error('year')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="mb-3">
                                        <label class="form-label">Period</label>
                                        <input type="text" name="period" class="form-control"
                                            placeholder="FY2081/82 or Q1" value="{{ old('period') }}">
                                    </div>
                                    @error('period')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">

                                    <div class="mb-3">
                                        <label class="form-label">Value</label>
                                        <input type="number" name="value" class="form-control" step="0.01"
                                            placeholder="12.50" value="{{ old('value') }}">
                                        <small class="text-muted">Enter numeric value as per indicator unit (%, minutes,
                                            score, ratio).</small>
                                    </div>
                                    @error('value')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="mb-3">
                                        <label class="form-label">Progress (%)</label>
                                        <input type="number" name="progress_percent" class="form-control" min="0"
                                            max="100" step="1" value="{{ old('progress_percent', 0) }}">
                                    </div>
                                    @error('progress_percent')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="mb-3">
                                        <label class="form-label">Notes</label>
                                        <textarea name="notes" class="form-control" rows="3" placeholder="Any evidence / remarks">{{ old('notes') }}</textarea>
                                    </div>
                                    @error('notes')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                 <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
