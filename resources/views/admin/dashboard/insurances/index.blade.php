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
                        <a href="{{ route('insurances.create') }}" class="btn btn-primary">Create</a>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>insurance_section</th>
                                <th>Hospital</th>
                                <th>Image</th>

                                <th>status</th>
                                <th>Options</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($insurances as $insurance)
                            
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $insurance->{'name' . app()->getLocale()} ?? $insurance->name}}</td>
                                <td>{{ $insurance->insurance_section->{'name' . app()->getLocale()} ?? $insurance->insurance_section->name	  }}</td>



                                <td>
                                    @php
                                    $sb= App\Models\InsuranceHostipal::where('insurance_id',$insurance->id)->pluck('hospital_id');
                                    $lang=app()->getLocale();
                                    $subs= App\Models\HospitalTranslation::whereIn('hospital_id',$sb)->where('locale',$lang)->get();
                                    @endphp
                                    @foreach ($subs as $s)
                                    <li>{{ $s->name}}</li>
                                    @endforeach
                                </td>

                                <td>
                                    @foreach($insurance->media as $img)
                                    <img src="{{ $img->getUrl() }}" height="75" width="75" >
                                    @endforeach
                                </td>

                                <td>
                                    @if ($insurance->status == 1)
                                    {{ __('Active') }}
                                    @else
                                    {{ __('Unactive') }}
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('insurances.edit', $insurance->id) }}" class="btn btn-primary me-2"><i class="las la-edit"></i></a>
                                        <form method="POST" action="{{ route('insurances.destroy', $insurance->id) }}">
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
