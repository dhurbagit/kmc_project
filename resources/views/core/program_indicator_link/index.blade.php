@extends('core.layout.app')

@section('content')
    <div class="card">
        <div class="card-header">Program Indicator Link Page</div>
        <div class="card-body">
            <form action="{{ route('program-indicator-links.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-5">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="mb-3">
                                        <label class="form-label">Program</label>
                                        <select name="program_id" class="form-control">
                                           <option selected value="">--Select Option--</option>
                                            @foreach ($programs as $Program)
                                                <option value="{{ $Program->id }}">{{ $Program->name_ne }}</option>
                                            @endforeach
                                        </select>
                                         
                                        @error('program_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="mb-3">
                                        <label class="form-label">Indicator</label>
                                        <select name="indicator_id" class="form-control">
                                            <option selected value="">--Select Option--</option>
                                            @foreach ($indicators as $indicator)
                                                <option value="{{ $indicator->id }}">{{ $indicator->source_type . ' ' . $indicator->code . ' ' . $indicator->short_name}}</option>
                                            @endforeach
                                        </select>
                                       
                                        @error('indicator_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="mb-3">
                                        <label class="form-label">Contribution Type</label>
                                        <select name="link_type" class="form-control">
                                            <option value="direct">Direct</option>
                                            <option value="indirect">Indirect</option>
                                        </select>
                                        @error('link_type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="mb-3">
                                        <label class="form-label">Extent of Contribution (0–5)</label>
                                        <input type="number" name="extent_score" class="form-control" min="0"
                                            max="5" step="1" value="3">
                                            @error('extent_score')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="mb-3">
                                        <label class="form-label">Evidence Level</label>
                                        <select name="evidence_level" class="form-control">
                                            <option selected value="">--Select Option--</option>
                                            <option value="discuss">Discussed</option>
                                            <option value="research">Research / Study</option>
                                            <option value="concurrence">Department Concurrence</option>
                                            <option value="declare">Formally Declared</option>
                                        </select>
                                        @error('evidence_level')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="mb-3">
                                        <label class="form-label">Weight</label>
                                        <input type="number" name="weight" class="form-control" min="1"
                                            max="5" step="1" value="1">
                                            @error('weight')
                                            <span class="text-danger">{{ $message }}</span>
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
