{{-- @extends('core.layout.app')

@section('content')
    @php
        $sub_sectors = [
            ['name_en' => 'Agriculture', 'name_ne' => 'कृषि'],
            ['name_en' => 'Industry', 'name_ne' => 'उद्योग'],
            ['name_en' => 'Tourism', 'name_ne' => 'पर्यटन'],
            ['name_en' => 'Cooperative', 'name_ne' => 'सहकारी'],
            ['name_en' => 'Finance Region/Area', 'name_ne' => 'वित्तीय क्षेत्र'],
            ['name_en' => 'Livestock Development', 'name_ne' => 'पशुपन्छी विकास'],
            ['name_en' => 'Commerce', 'name_ne' => 'वाणिज्य'],

            ['name_en' => 'Education', 'name_ne' => 'शिक्षा'],
            ['name_en' => 'Health', 'name_ne' => 'स्वास्थ्य'],
            ['name_en' => 'Water Supply and Sanitation', 'name_ne' => 'खानेपानी तथा सरसफाई'],
            ['name_en' => 'Language and Culture', 'name_ne' => 'भाषा तथा संस्कृति'],

            ['name_en' => 'Gender Equality and Social Inclusion', 'name_ne' => 'लैंगिक समानता तथा सामाजिक समावेशीकरण'],
            ['name_en' => 'Youth and Sports', 'name_ne' => 'युवा तथा खेलकुद'],
            ['name_en' => 'Population and Settlement', 'name_ne' => 'जनसंख्या तथा बसाईसराई'],
            ['name_en' => 'Social Security and Protection', 'name_ne' => 'सामाजिक सुरक्षा तथा संरक्षण'],

            ['name_en' => 'Transportation Infrastructure', 'name_ne' => 'यातायात पुर्वाधार'],
            ['name_en' => 'Building, Housing and Urban Development', 'name_ne' => 'भवन, आवास तथा सहरी विकास'],
            ['name_en' => 'Energy', 'name_ne' => 'उर्जा'],
            ['name_en' => 'Communication and Information Technology', 'name_ne' => 'सञ्चार तथा सूचना प्रविधि'],
            ['name_en' => 'Culture Heritage Infrastructure', 'name_ne' => 'सम्पदा पुर्वाधार'],
            ['name_en' => 'Science and Technology', 'name_ne' => 'विज्ञान तथा प्रविधि'],
            ['name_en' => 'Reconstruction', 'name_ne' => 'पुननिर्माण'],

            ['name_en' => 'Environment and Climate', 'name_ne' => 'वातावरण तथा जलवायु'],
            ['name_en' => 'Disaster Management', 'name_ne' => 'विपद् व्यवस्थापन'],
            ['name_en' => 'Human Resource Development', 'name_ne' => 'मानव संशाधन विकास'],
            ['name_en' => 'Peace and Order', 'name_ne' => 'शान्ति तथा सुव्यवस्था'],
            ['name_en' => 'Foreign Affairs', 'name_ne' => 'परराष्ट्र'],
            ['name_en' => 'Law and Justice', 'name_ne' => 'कानुन तथा न्याय'],
            ['name_en' => 'Governance System', 'name_ne' => 'शासन प्रणाली'],
            ['name_en' => 'Statistics Data System', 'name_ne' => 'तथ्यांक प्रणाली'],
            ['name_en' => 'Labor and Employment', 'name_ne' => 'श्रम तथा रोजगार'],
            ['name_en' => 'Planning and Implementation', 'name_ne' => 'योजना तर्जुमा र कार्यन्वयन'],
            ['name_en' => 'Monitoring and Evaluation', 'name_ne' => 'अनुगमन तथा मूल्यांकन'],
            ['name_en' => 'Administrative Governance', 'name_ne' => 'प्रशासकीय सुशासन'],
            ['name_en' => 'Financial Governance', 'name_ne' => 'वित्तीय सुशासन'],
        ];

    @endphp

    <div class="card">
        <div class="card-header">Sub Sector Page</div>
        <div class="card-body">
            <form action="{{ route('sub-sectors.store')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-5">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="code">Sub Sector Code</label>
                                    <input type="text" class="form-control readonly-select" id="code" name="code"
                                        placeholder="Auto Sector Code">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="sector_reference">Sector Name</label>
                                    <select name="sector_id" id="sector_reference" class="form-control">
                                        <option selected value="">--Select Option--</option>
                                        @foreach ($sectors as $sectors)
                                            <option value="{{ $sectors['id'] }}">{{ $sectors['name_ne'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('sector_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="name_en">Upa Chhetra</label>
                                    <select name="name_en" id="name_en" class="form-control">
                                        <option selected value="">--Select Option--</option>
                                        @foreach ($sub_sectors as $sub_sector)
                                            <option value="{{ $sub_sector['name_en'] }}">{{ $sub_sector['name_ne'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('name_en')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="name_ne">Nepali Name</label>
                                    <select name="name_ne" id="name_ne" class="form-control readonly-select">
                                        <option selected value="">--Auto Select Option--</option>
                                        @foreach ($sub_sectors as $sub_sector)
                                            <option value="{{ $sub_sector['name_ne'] }}">{{ $sub_sector['name_ne'] }}
                                            </option>
                                        @endforeach
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

                     <div class="col-lg-7">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                  
                                    <th>Sub-Sector Name (NE)</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subSectors as $subSector)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                    
                                        <td>{{ $subSector->name_ne }}</td>
                                    
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No SubSectors found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@php
    $sub_sectorsData = collect($sub_sectors)->mapWithKeys(function ($d) {
        return [
            $d['name_en'] => [
                'name_ne' => $d['name_ne'],
            ],
        ];
    });
@endphp

@push('scripts')
    <script>
        const subSectorsData = @json($sub_sectorsData);

        document.getElementById('name_en').addEventListener('change', function() {
            const selected = this.value;
            const info = subSectorsData[selected] || {
                name_ne: ""
            };

            document.getElementById('name_ne').value = info.name_ne;
        });
    </script>

    <script>
        function generateCode(text) {
            if (!text) return "";
            return text
                .trim()
                .toUpperCase()
                .replace(/[^A-Z0-9]+/g, "_") // Replace spaces/symbols with _
                .replace(/^_+|_+$/g, ""); // Trim leading/trailing _

            // or try
            //  .replace(/[^a-zA-Z]/g, "") // keep only letters
            // .toUpperCase() // convert to uppercase
            // .substring(0, 5); // limit to 5 characters

        }

        function updateCode(value) {
            document.getElementById("code").value = generateCode(value);
        }

        // When selecting from dropdown
        document.getElementById("name_en").addEventListener("change", function() {
            updateCode(this.value);
        });

        // When typing manually in input box
        // document.getElementById("custom_input").addEventListener("input", function() {
        //     updateCode(this.value);
        // });
    </script>
@endpush --}}


@extends('core.layout.app')

@section('content')
@php
    $sub_sectors = [
        ['name_en' => 'Agriculture', 'name_ne' => 'कृषि'],
        ['name_en' => 'Industry', 'name_ne' => 'उद्योग'],
        ['name_en' => 'Tourism', 'name_ne' => 'पर्यटन'],
        ['name_en' => 'Cooperative', 'name_ne' => 'सहकारी'],
        ['name_en' => 'Finance Region/Area', 'name_ne' => 'वित्तीय क्षेत्र'],
        ['name_en' => 'Livestock Development', 'name_ne' => 'पशुपन्छी विकास'],
        ['name_en' => 'Commerce', 'name_ne' => 'वाणिज्य'],
        ['name_en' => 'Education', 'name_ne' => 'शिक्षा'],
        ['name_en' => 'Health', 'name_ne' => 'स्वास्थ्य'],
        ['name_en' => 'Water Supply and Sanitation', 'name_ne' => 'खानेपानी तथा सरसफाई'],
        ['name_en' => 'Language and Culture', 'name_ne' => 'भाषा तथा संस्कृति'],
        ['name_en' => 'Gender Equality and Social Inclusion', 'name_ne' => 'लैंगिक समानता तथा सामाजिक समावेशीकरण'],
        ['name_en' => 'Youth and Sports', 'name_ne' => 'युवा तथा खेलकुद'],
        ['name_en' => 'Population and Settlement', 'name_ne' => 'जनसंख्या तथा बसाईसराई'],
        ['name_en' => 'Social Security and Protection', 'name_ne' => 'सामाजिक सुरक्षा तथा संरक्षण'],
        ['name_en' => 'Transportation Infrastructure', 'name_ne' => 'यातायात पुर्वाधार'],
        ['name_en' => 'Building, Housing and Urban Development', 'name_ne' => 'भवन, आवास तथा सहरी विकास'],
        ['name_en' => 'Energy', 'name_ne' => 'उर्जा'],
        ['name_en' => 'Communication and Information Technology', 'name_ne' => 'सञ्चार तथा सूचना प्रविधि'],
        ['name_en' => 'Culture Heritage Infrastructure', 'name_ne' => 'सम्पदा पुर्वाधार'],
        ['name_en' => 'Science and Technology', 'name_ne' => 'विज्ञान तथा प्रविधि'],
        ['name_en' => 'Reconstruction', 'name_ne' => 'पुननिर्माण'],
        ['name_en' => 'Environment and Climate', 'name_ne' => 'वातावरण तथा जलवायु'],
        ['name_en' => 'Disaster Management', 'name_ne' => 'विपद् व्यवस्थापन'],
        ['name_en' => 'Human Resource Development', 'name_ne' => 'मानव संशाधन विकास'],
        ['name_en' => 'Peace and Order', 'name_ne' => 'शान्ति तथा सुव्यवस्था'],
        ['name_en' => 'Foreign Affairs', 'name_ne' => 'परराष्ट्र'],
        ['name_en' => 'Law and Justice', 'name_ne' => 'कानुन तथा न्याय'],
        ['name_en' => 'Governance System', 'name_ne' => 'शासन प्रणाली'],
        ['name_en' => 'Statistics Data System', 'name_ne' => 'तथ्यांक प्रणाली'],
        ['name_en' => 'Labor and Employment', 'name_ne' => 'श्रम तथा रोजगार'],
        ['name_en' => 'Planning and Implementation', 'name_ne' => 'योजना तर्जुमा र कार्यन्वयन'],
        ['name_en' => 'Monitoring and Evaluation', 'name_ne' => 'अनुगमन तथा मूल्यांकन'],
        ['name_en' => 'Administrative Governance', 'name_ne' => 'प्रशासकीय सुशासन'],
        ['name_en' => 'Financial Governance', 'name_ne' => 'वित्तीय सुशासन'],
    ];
@endphp

<div class="row">
    <!-- Form Column -->
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header">Create Sub-Sector</div>
            <div class="card-body">
                <form action="{{ route('sub-sectors.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="code">Sub Sector Code</label>
                        <input type="text" name="code" id="code" class="form-control readonly-select" placeholder="Auto Sector Code">
                    </div>

                    <div class="form-group">
                        <label for="sector_reference">Sector Name</label>
                        <select name="sector_id" id="sector_reference" class="form-control">
                            <option value="">--Select Option--</option>
                            @foreach($sectors as $sector)
                                <option value="{{ $sector->id }}">{{ $sector->name_ne }}</option>
                            @endforeach
                        </select>
                        @error('sector_id')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="name_en">Upa Chhetra</label>
                        <select name="name_en" id="name_en" class="form-control">
                            <option value="">--Select Option--</option>
                            @foreach($sub_sectors as $sub_sector)
                                <option value="{{ $sub_sector['name_en'] }}">{{ $sub_sector['name_ne'] }}</option>
                            @endforeach
                        </select>
                        @error('name_en')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="name_ne">Nepali Name</label>
                        <input type="text" name="name_ne" id="name_ne" class="form-control readonly-select" readonly>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="4"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Sub-Sector</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Column -->
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">Sub-Sectors List</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Sub-Sector Name (NE)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subSectors as $subSector)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $subSector->name_ne }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center">No Sub-Sectors found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@php
    $sub_sectorsData = collect($sub_sectors)->mapWithKeys(function ($d) {
        return [$d['name_en'] => ['name_ne' => $d['name_ne']]];
    });
@endphp

@push('scripts')
<script>
    const subSectorsData = @json($sub_sectorsData);

    // Auto-fill Nepali name
    document.getElementById('name_en').addEventListener('change', function() {
        const selected = this.value;
        document.getElementById('name_ne').value = subSectorsData[selected]?.name_ne || '';
        document.getElementById('code').value = generateCode(selected);
    });

    // Generate code automatically
    function generateCode(text) {
        if (!text) return "";
        return text.trim().toUpperCase().replace(/[^A-Z0-9]+/g, "_").replace(/^_+|_+$/g, "");
    }
</script>
@endpush
@endsection
