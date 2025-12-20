@extends('core.layout.app')

@section('content')
    <div class="card">
        <div class="card-header">Main Program Page</div>
        <div class="card-body">
            <form action="{{ route('main-programs.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-5">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="name_en">Department Name</label>
                                    <select name="department_id" id="department_id" class="form-control">
                                        <option selected value="">--Select Option--</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department['id'] }}">{{ $department['name_ne'] }}</option>
                                        @endforeach
                                    </select>
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
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="name_en">Karyakram Name</label>
                                    <input type="text" class="form-control" id="name_en" name="name_en"
                                        placeholder="English Name">
                                    @error('name_en')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="name_ne">Nepali Name</label>
                                    <input type="text" class="form-control" id="name_ne" name="name_ne"
                                        placeholder="Eg: मुख्य कार्यक्रम नाम (unicode format)">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="code">Objective</label>
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
    {{-- <div class="card">
    <div class="card-header">Main Program Page</div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-5">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="name_en">English Name</label>
                             <select name="" id="" class="form-control">
                                 <option selected value="">--Select Option--</option>
                                <option value=""></option>
                             </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="code">Sector Name</label>
                            <select name="" id="" class="form-control">
                                <option value=""></option>
                             </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="code">Description</label>
                            <textarea name="description" class="form-control" id="description" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary">Save Sector</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
