@extends('core.layout.app')

@section('content')
    <div class="card">
        <div class="card-header">Indicator Page</div>
        <div class="card-body">
            <form action="{{ route('indicators.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-5">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="name_en">Source Type</label>
                                    <select name="source_type" class="form-control" >
                                        <option value="">Select Source</option>
                                        <option value="SDG">SDG</option>
                                        <option value="ISO37120">ISO 37120</option>
                                        <option value="ISO37122">ISO 37122</option>
                                        <option value="SCI">SCI</option>
                                    </select>
                                    @error('source_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Indicator Code</label>
                                    <input type="text" name="code" class="form-control"
                                        placeholder="e.g. 11.5.1 / 6.3 / DRR-01" >
                                        @error('code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Short Name</label>
                                    <input type="text" name="short_name" class="form-control"
                                        placeholder="e.g. Disaster mortality rate" >
                                        @error('short_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Goal Code</label>
                                    <input type="text" name="goal_code" class="form-control" placeholder="e.g. 11">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Target Code</label>
                                    <input type="text" name="target_code" class="form-control" placeholder="e.g. 11.5">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Unit</label>
                                    <select name="unit" class="form-control">
                                        <option value="">Select Unit</option>
                                        <option value="%">%</option>
                                        <option value="minutes">Minutes</option>
                                        <option value="score">Score</option>
                                        <option value="ratio">Ratio</option>
                                        <option value="per 100,000 population">Per 100,000 Population</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Performance Direction</label>
                                    <select name="higher_is_better" class="form-control">
                                        <option value="1">Higher value is better</option>
                                        <option value="0">Lower value is better</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control" rows="3" placeholder="Full definition of indicator"></textarea>
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
