@extends('core.layout.app')

@section('content')


<div class="card">
    <div class="card-header">Main Program Page</div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-5">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="code">Main Program Code</label>
                            <input type="text" class="form-control" id="code" name="code" placeholder="Enter Sector Code">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="name_en">English Name</label>
                             <select name="" id="" class="form-control">
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
</div>

@endsection