@extends('core.layout.app')

@section('content')
    @php
        $departments = [
            ['code' => 'ADMIN', 'name_en' => 'ADMINISTRATION DEPARTMENT', 'name_ne' => 'प्रशासन विभाग'],
            ['code' => 'REVENUE', 'name_en' => 'DEPARTMENT OF REVENUE', 'name_ne' => 'राजश्व विभाग'],
            ['code' => 'PUBLIC_WORK', 'name_en' => 'DEPARTMENT OF PUBLIC WORK', 'name_ne' => 'सार्वजनिक निर्माण विभाग'],
            ['code' => 'URBAN_DEV', 'name_en' => 'DEPARTMENT OF URBAN DEVELOPMENT', 'name_ne' => 'सहरी विकास विभाग'],
            [
                'code' => 'LAW_HR',
                'name_en' => 'DEPARTMENT OF LAW AND HUMAN RIGHTS',
                'name_ne' => 'कानुन तथा मानव अधिकार विभाग',
            ],
            [
                'code' => 'SOCIAL_DEV',
                'name_en' => 'DEPARTMENT OF SOCIAL DEVELOPMENT',
                'name_ne' => 'सामाजिक विकास विभाग',
            ],
            ['code' => 'FINANCE', 'name_en' => 'DEPARTMENT OF FINANCE', 'name_ne' => 'वित्त विभाग'],
            ['code' => 'COOPERATIVE', 'name_en' => 'COOPERATIVE DEPARTMENT', 'name_ne' => 'सहकारी विभाग'],
            ['code' => 'EDUCATION', 'name_en' => 'DEPARTMENT OF EDUCATION', 'name_ne' => 'शिक्षा विभाग'],
            ['code' => 'ENVIRONMENT', 'name_en' => 'ENVIRONMENT DEPARTMENT', 'name_ne' => 'वातावरण विभाग'],
            ['code' => 'HEALTH', 'name_en' => 'DEPARTMENT OF HEALTH', 'name_ne' => 'स्वास्थ्य विभाग'],
            ['code' => 'IT', 'name_en' => 'DEPARTMENT OF INFORMATION TECHNOLOGY', 'name_ne' => 'सूचना प्रविधि विभाग'],
            [
                'code' => 'DISASTER_MGMT',
                'name_en' => 'DISASTER MANAGEMENT DEPARTMENT',
                'name_ne' => 'विपद व्यवस्थापन विभाग',
            ],
            [
                'code' => 'HERITAGE_TOURISM',
                'name_en' => 'DEPARTMENT OF HERITAGE AND TOURISM',
                'name_ne' => 'सम्पदा तथा पर्यटन विभाग',
            ],
            [
                'code' => 'AGRIC_LIVESTOCK',
                'name_en' => 'DEPARTMENT OF AGRICULTURE AND LIVESTOCK',
                'name_ne' => 'कृषि तथा पशुपंक्षी विभाग',
            ],
            [
                'code' => 'PARK_GREENERY',
                'name_en' => 'PARK AND GREENERY PROMOTION PROJECT',
                'name_ne' => 'पार्क तथा हरियाली प्रवर्द्धन परियोजना',
            ],
        ];

    @endphp
    <div class="card">
        <div class="card-header">
            </p>Department Page</p>
        </div>
        <div class="card-body">
            <form action="{{ route('departments.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-5">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group hidden">
                                    {{-- <label for="name">Department Code</label> --}}
                                    <select name="code" id="code" class="form-control readonly-select" hidden>
                                        <option selected value="">Select a Department</option>
                                        @foreach ($departments as $department)
                                            <option  
                                             readonly value="{{ $department['code'] }}">{{ $department['code'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    {{-- <label for="name">Department Name in English</label> --}}
                                    <select name="name_en" id="name_en" class="form-control readonly-select" hidden>
                                        <option selected value="">Select a Department</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department['name_en'] }}">{{ $department['name_en'] }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="name">Department Name in Nepali</label>
                                    <select name="name_ne" id="name_ne" class="form-control ">
                                        <option selected value="">Select a Department</option>
                                        @foreach ($departments as $department)
                                            <option   {{ old('name_ne', $editDepartment->name_ne ?? '') == $department['name_ne'] ? 'selected' : '' }}
                                            value="{{ $department['name_ne'] }}">{{ $department['name_ne'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('name_ne')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control" rows="4"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
            <br>
            <div class="row">
                <div class="col-lg-12">
                    <div class="department_table_data">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>SNo</th>
                                        <th>Department Code</th>
                                        <th>Department Name (English)</th>
                                        <th>Department Name (Nepali)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($departments_collection as $department)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $department['code'] }}</td>
                                            <td>{{ $department['name_en'] }}</td>
                                            <td>{{ $department['name_ne'] }}</td>
                                            <td>
                                                <a href="{{ route('departments.edit', $department['id']) }}" class="btn btn-primary">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <a href="" class="btn btn-secondary">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('scripts')
<script>
const departmentData = @json(
    collect($departments)->mapWithKeys(function ($d) {
        return [
            $d['name_ne'] => [
                'code'    => $d['code'],
                'name_en' => $d['name_en'],
            ]
        ];
    })
);

document.getElementById('name_ne').addEventListener('change', function () {
    const selected = this.value;

    const info = departmentData[selected] || {
        code: "",
        name_en: ""
    };

    document.getElementById('code').value = info.code;
    document.getElementById('name_en').value = info.name_en;
});
</script>
@endpush

