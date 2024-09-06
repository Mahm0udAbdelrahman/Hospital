@extends('admin.layouts.app')
@section('content')
    @push('cs')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
    @endpush
    @push('js')
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"
            integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

        <!-- Internal Datatables JS -->
        <script src="{{ asset('dashboard/assets/js/datatables.js') }}"></script>
    @endpush
    <!-- Start:: row-3 -->
    <div class="d-block align-items-center justify-content-between page-header-breadcrumb">

        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">
                            Responisve Modal Datatable
                        </div>
                    </div>

                    <div class="card-body">
                        <table id="responsivemodal-DataTable" class="table table-bordered text-nowrap" style="width:100%">
                            <a href="{{ route('hospitals.create') }}" class="btn btn-primary">{{ __('Create') }}</a>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Country') }}</th>
                                    <th>{{ __('Name hospital') }}</th>
                                    <th>{{ __('Center') }}</th>
                                    <th>{{ __('Phone') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Address') }}</th>
                                    <th>{{ __('Case Treated') }}</th>
                                    <th>{{ __('Surgery') }}</th>
                                    <th>{{ __('Medical Staff') }}</th>
                                    <th>{{ __('Bed') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('Image') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Options') }}</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($hospitals as $hospital)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $hospital->country->name }}</td>
                                        <td>{{ $hospital->{'name' . app()->getLocale()} ?? $hospital->name}}</td>
                                        <td>
                                            @php
                                                $center = App\Models\CenterHospital::where('hospital_id',$hospital->id)->pluck('center_id');
                                                $lang = app()->getLocale();
                                                $centerHospiatl = App\Models\CenterTranslation::whereIn('center_id',$center)->where('locale',$lang)->get();                                   
                                               @endphp
                                                @foreach($centerHospiatl as $center)
                                               <li> {{ $center->name }} </li>
                                                @endforeach
                                        </td>
                                        <td>{{ $hospital->phone }}</td>
                                        <td>{{ $hospital->email }}</td>
                                        <td>{{ $hospital->{'address' . app()->getLocale()} ?? $hospital->address}}</td>
                                        <td>{{ $hospital->case_treated .' Case Treated'}}</td>
                                        <td>{{ $hospital->surgery . ' Surgery'}}</td>
                                        <td>{{ $hospital->medical_staff . ' Medical Staff'}}</td>
                                        <td>{{ $hospital->bed . ' Ded'}}</td>

                                        <td>{{ $hospital->{'description' . app()->getLocale()} ?? $hospital->description}}</td>

                                        <td>
                                            @foreach ($hospital->getMedia('image') as $imgs )
                                                 <img src="{{ $imgs->getUrl() }}" width="75" height="75" alt="">
                                            @endforeach
                                        </td>

                                        <td>
                                            @if ($hospital->status == 1)
                                                {{ __('Active') }}
                                            @else
                                                {{ __('Unactive') }}
                                            @endif
                                        </td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('hospitals.edit', $hospital->id) }}"
                                                        class="btn btn-primary me-2"><i class="las la-edit"></i></a>
                                                    <form method="POST"
                                                        action="{{ route('hospitals.destroy', $hospital->id) }}">
                                                        @csrf
                                                        @method('delete')
                                                        <button onclick="if(!confirm('Are you sure?')){return false}"
                                                            class="btn btn-danger"><i class="bi bi-basket"></i></button>
                                                    </form>
                                                </div>
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
    <!-- End:: row-3 -->
@endsection
