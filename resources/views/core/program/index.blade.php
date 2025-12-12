@extends('core.layout.app')

@section('content')
    <div class="card">
        <div class="card-header">Program Page</div>
        <div class="card-body">
            <form action="{{ route('programs.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-5">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="department_id">Department Name</label>
                                    <select name="department_id" id="department_id" class="form-control">
                                        <option selected value="">--Select Option--</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department['id'] }}">{{ $department['name_ne'] }}</option>
                                        @endforeach

                                    </select>
                                    @error('department_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="sector_id">Sector Name</label>
                                    <select name="sector_id" id="sector_id" class="form-control">
                                        <option selected value="">--Select Option--</option>
                                        @foreach ($sectors as $sector)
                                            <option value="{{ $sector['id'] }}">{{ $sector['name_ne'] }}</option>
                                        @endforeach

                                    </select>
                                     @error('sector_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="sub_sector_id">Sub Sector Name</label>
                                    <select name="sub_sector_id" id="sub_sector_id" class="form-control">
                                        <option selected value="">--Select Option--</option>
                                        @foreach ($sub_sectors as $sub_sector)
                                            <option value="{{ $sub_sector['id'] }}">{{ $sub_sector['name_ne'] }}</option>
                                        @endforeach
                                    </select>
                                     @error('sub_sector_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="main_program_id">Main Program Name</label>
                                    <select name="main_program_id" id="main_program_id" class="form-control">
                                        <option selected value="">--Select Option--</option>
                                        @foreach ($main_programs as $main_program)
                                            <option value="{{ $main_program['id'] }}">{{ $main_program['name_ne'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                     @error('main_program_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="kharcha_sanket">Kharcha sanket</label>
                                    <input type="text" class="form-control" id="kharcha_sanket" name="kharcha_sanket"
                                        placeholder="Eg: 12345">
                                       @error('kharcha_sanket')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="name_en">English Name</label>
                                    <input type="text" class="form-control" id="name_en" name="name_en"
                                        placeholder="Eg: Program Name">
                                        @error('name_en')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="name_ne">Nepali Name</label>
                                    <input type="text" class="form-control" id="name_ne" name="name_ne"
                                        placeholder="Eg: Program Name in Nepali (unicode format)">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="name_ne">Fiscal Year</label>
                                    <input type="text" class="form-control" id="fiscal_year" name="fiscal_year"
                                        placeholder="Eg: 2082/83">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="lifecycle_status">Lifecycle status</label>
                                    <select name="lifecycle_status" id="lifecycle_status" class="form-control">
                                        <option value="incept">Incept (conceptual) </option>
                                        <option value="approved">approved(budget approved)</option>
                                        <option value="ongoing">ongoing (running)</option>
                                        <option value="complete">complete (finished)</option>
                                    </select>
                                      @error('lifecycle_status')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="name_ne">Progress percent</label>
                                    <input type="text" class="form-control" id="progress_percent" name="progress_percent"
                                        placeholder="Eg: 80 Percent">
                                        @error('progress_percent')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="objective">Objective</label>
                                    <textarea name="objective" class="form-control" id="objective" cols="30" rows="10"></textarea>
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
