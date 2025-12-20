@extends('core.layout.app')

@section('content')
    <div class="card">
        <div class="card-header">Program Budget Page</div>
        <div class="card-body">
            <form action="{{ route('program-budgets.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-5">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="program_id">Program Name</label>
                                    <select name="program_id" id="program_id" class="form-control">
                                        <option selected value="">--Select Option--</option>
                                        @foreach ($programs as $program)
                                            <option value="{{ $program->id }}">{{ $program->name_ne }}</option>
                                        @endforeach
                                    </select>
                                    @error('program_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="fiscal_year" class="form-label">Fiscal Year (AD)</label>
                                    <input type="number" name="fiscal_year" class="form-control" min="2000"
                                        max="2100" step="1" placeholder="Sector Name2024" id="fiscal_year"
                                        value="{{ old('fiscal_year', $budget->fiscal_year ?? '') }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="fiscal_code">Fiscal Year Code</label>
                                    <select name="fiscal_code" class="form-control" id="fiscal_code">
                                        <option selected value="">Select Fiscal Year (BS)</option>
                                        @for ($y = 2078; $y <= 2090; $y++)
                                            <option value="{{ $y }}/{{ substr($y + 1, -2) }}">
                                                {{ $y }}/{{ substr($y + 1, -2) }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="allocated_budget">Allocated Budget</label>
                                    <input type="number" name="allocated_budget" class="form-control" min="0"
                                        step="0.01" placeholder="5000000.00" id="allocated_budget">
                                    @error('allocated_budget')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                        
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="expenditure">Expenditure</label>
                                    <input type="number" name="expenditure" class="form-control" min="0"
                                        id="expenditure" step="0.01" placeholder="Actual expenditure till date">
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
