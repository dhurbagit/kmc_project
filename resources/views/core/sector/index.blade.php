@extends('core.layout.app')

@section('content')
    @php
        $sectors = [
            [
                'code' => 'ECONOMIC',
                'name_en' => 'Economic Development',
                'name_ne' => 'आर्थिक विकास',
            ],
            [
                'code' => 'SOCIAL',
                'name_en' => 'Social Development',
                'name_ne' => 'सामाजिक विकास',
            ],
            [
                'code' => 'INFRA',
                'name_en' => 'Infrastructure Development',
                'name_ne' => 'पूर्वाधार विकास',
            ],
            [
                'code' => 'GOVERNANCE',
                'name_en' => 'Good Governance and Interrelated Areas',
                'name_ne' => 'सुशासन तथा अन्तरसम्बन्धित क्षेत्र',
            ],
            [
                'code' => 'ADMIN',
                'name_en' => 'Office Operations and Administrative',
                'name_ne' => 'कार्यालय सञ्चालन तथा प्रशासनिक',
            ],
        ];

    @endphp

    <div class="card">
        <div class="card-header">Sector Page</div>
        <div class="card-body">
            <form action="{{ route('sectors.store') }}" method="POST">
                @csrf
                <div class="row">

                    <div class="col-lg-5">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="code">Sector Code</label>
                                    <select name="code" id="code" class="form-control readonly-select">
                                        <option selected value="">Select The Chetra(Sector) Code</option>
                                        @foreach ($sectors as $sector)
                                            <option value="{{ $sector['code'] }}">{{ $sector['code'] }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="name_en">English Name</label>
                                    <select name="name_en" id="name_en" class="form-control">
                                        <option selected value="">Select The Chetra(Sector) English Name</option>
                                        @foreach ($sectors as $sector)
                                            <option value="{{ $sector['name_en'] }}">{{ $sector['name_en'] }}</option>
                                        @endforeach

                                    </select>
                                    @error('name_en')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="name_ne">Sector Name</label>
                                    <select name="name_ne" id="name_ne" class="form-control readonly-select">
                                        <option selected value="">Select The Chetra(Sector) Nepali Name</option>
                                        @foreach ($sectors as $sector)
                                            <option value="{{ $sector['name_ne'] }}">{{ $sector['name_ne'] }}</option>
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
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 60px;">S.No</th>
                                    <th>Sector Name (English)</th>
                                    <th>Sector Name (Nepali)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sectors as $sector)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $sector['name_en'] }}</td>
                                        <td>{{ $sector['name_ne'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    @php
        $sectorData = collect($sectors)->mapWithKeys(function ($d) {
            return [
                $d['name_en'] => [
                    'code' => $d['code'],
                    'name_ne' => $d['name_ne'],
                ],
            ];
        });
    @endphp
    <script>
        const sectorData = @json($sectorData);
        document.getElementById('name_en').addEventListener('change', function() {
            const selected = this.value;
            const info = sectorData[selected] || {
                code: "",
                name_ne: ""
            };

            document.getElementById('code').value = info.code;
            document.getElementById('name_ne').value = info.name_ne;
        });
    </script>
@endpush
 