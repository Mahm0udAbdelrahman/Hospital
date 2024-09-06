@extends('admin.layouts.app')
@section('content')
@push('cs')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
@endpush
@push('js')
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
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
                        <a href="{{ route('doctors.create') }}" class="btn btn-primary">Create</a>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('membership_no') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Address') }}</th>
                                <th>{{ __('Hospital') }}</th>
                                <th>{{ __('Clinic') }}</th>
                                <th>{{ __('Specialty') }}</th>
                                <th>{{ __('Country') }}</th>
                                <th>{{ __('City') }}</th>
                                <th>{{ __('Phone') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Year Of Experience') }}</th>
                                <th>{{ __('Image') }}</th>
                                <th>{{ __('Rate') }}</th>
                                <th>{{ __('Review') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Options') }}</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($doctors as $doctor)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $doctor->membership_no  }}</td>
                                <td>{{ $doctor->{'doctor_name' . app()->getLocale()} ?? $doctor->doctor_name }}</td>
                                <td>{{ $doctor->{'doctor_address' . app()->getLocale()} ?? $doctor->doctor_address }}</td>


                                <td>
                                    <?php
                                               $hosp = App\Models\DoctorHospital::where('doctor_id',$doctor->id)->pluck('hospital_id');
                                               $lang = App()->getLocale();
                                               $hospitals = App\Models\HospitalTranslation::whereIn('hospital_id',$hosp)->where('locale',$lang)->get();

                                            ?>
                                    @foreach($hospitals as $hospital)
                                    
                                    <li>{{ $hospital->name ?? 'No Hospital'}}</li>


                                    @endforeach
                                </td>

                                <td>
                                    <?php
                                            $clic = App\Models\DoctorClinic::where('doctor_id',$doctor->id)->pluck('clinic_id');
                
                                            $clinics = App\Models\ClinicTranslation::whereIn('clinic_id',$clic)->where('locale',$lang)->get();
                                                ?>
                                    @foreach($clinics as $clinic)

                                    <li>{{ $clinic->name ?? 'No Clinic' }}</li>


                                    @endforeach
                                </td>
                                <td>{{ $doctor->specialty->name  ?? ''}}</td>
                                <td>{{ $doctor->country->name ?? '' }}</td>
                                <td>{{ $doctor->city->name  ?? ''}}</td>

                                <td>{{ $doctor->phone }}</td>
                                <td>{{ $doctor->email }}</td>
                                <td>{{ $doctor->year_of_experience }}</td>
                                @foreach ($doctor->media as $imgs)
                                <td>
                                    <img src="{{ $imgs->getUrl() }}" width="75" height="75" alt="">
                                </td>
                                @endforeach

                                <td>{{ $doctor->rate }}</td>
                                <td>{{ $doctor->review }}</td>

                                <td>
                                    @if ($doctor->status == 1)
                                    <span class="badge rounded-pill bg-primary"> {{__('Active')}}</span>
                                    @else
                                    <span class="badge rounded-pill bg-secondary">{{__('Unactive')}}</span>

                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-primary me-2"><i class="las la-edit"></i></a>
                                        <form method="POST" action="{{ route('doctors.destroy', $doctor->id) }}">
                                            @csrf
                                            @method('delete')
                                            <button onclick="if(!confirm('Are you sure?')){return false}" class="btn btn-danger"><i class="bi bi-basket"></i></button>
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
