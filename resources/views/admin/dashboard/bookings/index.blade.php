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
                        <a href="{{ route('bookings.create') }}" class="btn btn-primary">Create</a>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Doctor</th>
                                <th>Hostipal</th>
                                <th>Clinic</th>
                                <th>Date</th>
                                <th>Day</th>
                                <th>Form</th>
                                <th>To</th>
                                <th>Status</th>
                                <th>Options</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                          
                            <tr>
                                <td>{{ $loop->index +1  }}</td>

                                <td>{{ $booking->doctor->doctor_name }}</td>
                                <td>
                                    @if($booking->doctor_hospital_id!=null)
                                    @php
                                        $lang = app()->getLocale();
                                        $clin = App\Models\Hospital::where('id', $booking->doctor_hospital_id)->pluck('id');
                                        $hospitalTranslation = App\Models\HospitalTranslation::whereIn('hospital_id', $clin)->where('locale', $lang)->get();  
                                   
                                   @endphp
                                     
                                    @foreach($hospitalTranslation as $hospital)
                                   
                                     {{ $hospital->name }}
                                    
                                     @endforeach
                                     @else
                                    
                                     not found   
                                     @endif
                                  
                                </td>

                                <td>
                                  @if($booking->doctor_clinic_id!=null)
                                    @php
                                        $lang = app()->getLocale();
                                        $clin = App\Models\Clinic::where('id', $booking->doctor_clinic_id)->pluck('id');
                                        $clinicTranslation = App\Models\ClinicTranslation::whereIn('clinic_id', $clin)->where('locale', $lang)->get();  
                                   
                                   @endphp
                                    @foreach($clinicTranslation as $clinic)
                                     {{ $clinic->name }}  
                                     @endforeach
                                @else
                                not found   
                                @endif
                                  
                                </td>

                     

                                <td>{{ $booking->date }}</td>
                                <td>{{ $booking->day->name }}</td>
                                <td>{{ $booking->form }}</td>
                                <td>{{ $booking->to }}</td>

                                <td>
                                    @if ($booking->status == 1)
                                    Active
                                    @else
                                    Unactive
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-primary me-2"><i class="las la-edit"></i></a>
                                        <form method="POST" action="{{ route('bookings.destroy', $booking->id) }}">
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
