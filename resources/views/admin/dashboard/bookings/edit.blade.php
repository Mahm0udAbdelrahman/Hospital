@extends('admin.layouts.app')
@section('content')
<!--APP-CONTENT START-->


<!-- Page Header -->

<div class="d-md-flex d-block align-items-center justify-content-between page-header-breadcrumb">
    <div>
        <h2 class="main-content-title fs-24 mb-1">Update Booking</h2>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Bookings</li>
        </ol>
    </div>

</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    .item {
        background-color: #f1f1f1;
        padding: 10px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
    }

    .item>* {
        margin-right: 10px;
    }

    .item button img {
        width: 20px;
        height: 20px;
    }

    .item select,
    .item input[type="text"] {
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

</style>



<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>





{{-- @if (count($errors) > 0)
<div class="alert alert-danger" role="alert">{{ $errors->first() }}</div>
@endif
@if (session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif --}}
<!-- Page Header Close -->

<!-- Start:: row-1 -->
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    Add new
                </div>

            </div>
            <form class="form-horizontal" method="POST" action="{{ route('bookings.update', $booking->id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body">

                    <div class="form-group">
                        <div class="row row-sm">
                            <div class="col-md-3">
                                <label class="form-label">Type Booking</label>
                            </div>
                            <div class="col-md-9">
                                <select name="typeBooking" class="form-select" id="typeBooking">
                                    <option disabled selected>Choose Type Booking...</option>
                                    <option @if($booking->doctor_hospital_id != null) selected @endif value="hospital">Hospital</option>
                                    <option @if($booking->doctor_clinic_id != null) selected @endif value="clinic">Clinic</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-label">{{ __('Doctor') }}</label>
                            </div>
                            <div class="col-md-9">
                                <select id="doctor" class="form-select" name="doctor_id">
                                    <option disabled selected>{{ __('Choose Doctor...') }}</option>
                                    @foreach ($doctors as $doctor)
                                    <option @selected($booking->doctor_id == $doctor->id ) value="{{ $doctor->id }}">
                                        {{ App::getLocale() == 'en' ? $doctor->getTranslationsArray()['en']['doctor_name'] : $doctor->getTranslationsArray()['ar']['doctor_name'] }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('doctor_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="hospitalField" style="display: none;">
                        <div class="row row-sm">
                            <div class="col-md-3">
                                <label class="form-label">{{ __('Hospital') }}</label>
                            </div>
                            <div class="col-md-9">
                                <select id="hospital" class="form-select" name="doctor_hospital_id">
                                    <option disabled>{{ __('Choose Hospital...') }}</option>
                                    <!-- Hospital options go here -->
                                    @foreach ($hospitals as $hospital)
                                    <option @selected($booking->doctor_hospital_id == $hospital->id ) value="{{ $hospital->id }}">
                                        {{ App::getLocale() == 'en' ? $hospital->getTranslationsArray()['en']['name'] : $hospital->getTranslationsArray()['ar']['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @error('doctor_hospital_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror


                    <div class="form-group" id="clinicField" style="display: none;">
                        <div class="row row-sm">
                            <div class="col-md-3">
                                <label class="form-label">{{ __('Clinic') }}</label>
                            </div>
                            <div class="col-md-9">
                                <select id="clinic" class="form-select" name="doctor_clinic_id">
                                    <option disabled>{{ __('Choose Clinic...') }}</option>
                                    @foreach ($clinics as $clinic)
                                    <option @selected($booking->doctor_clinic_id == $clinic->id ) value="{{ $clinic->id }}">
                                        {{ App::getLocale() == 'en' ? $clinic->getTranslationsArray()['en']['name'] : $clinic->getTranslationsArray()['ar']['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @error('doctor_clinic_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror



                    <label for="basic-url" class="form-label">Date</label>
                    <div class="input-group mb-3">
                        <input type="date" class="form-control" value="{{ $booking->date }}" name="date" id="basic-url" aria-describedby="basic-addon3">
                    </div>
                    @error('date')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror


                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-label">{{ __('Day') }}</label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-select" name="day_id">
                                    <option disabled selected>{{ __('Choose Day...') }}</option>
                                    @foreach ($days as $day)
                                    <option @selected($booking->day_id == $day->id ) value="{{ $day->id }}">
                                        {{ App::getLocale() == 'en' ? $day->getTranslationsArray()['en']['name'] : $day->getTranslationsArray()['ar']['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('day_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <label for="basic-url" class="form-label">Form Time</label>
                    <div class="input-group mb-3">
                        <input type="time" class="form-control" value="{{ $booking->form}}" name="form" id="basic-url" aria-describedby="basic-addon3">
                    </div>
                    @error('form')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror

                    <label for="basic-url" class="form-label">To Time</label>
                    <div class="input-group mb-3">
                        <input type="time" class="form-control" value="{{ $booking->to}}" name="to" id="basic-url" aria-describedby="basic-addon3">
                    </div>
                    @error('to')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror








                    <div class="form-group ">
                        <div class="row row-sm">
                            <div class="col-md-3">
                                <label class="form-label">{{ __('Status') }}</label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-select" name="status">
                                    <option disabled selected>{{ __('Choose Status...') }}</option>
                                    <option @if ($booking->status == '1') selected @endif value="1">
                                        {{ __('Active') }}
                                    </option>
                                    <option @if ($booking->status == '0') selected @endif value="0">
                                        {{ __('Unactive') }}
                                    </option>

                                </select>

                            </div>
                        </div>
                    </div>
                    @error('status')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror



                    <button class="form-control btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>



    <!-- End:: row-3 -->


</div>
<!--APP-CONTENT CLOSE-->


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const typeBooking = document.getElementById('typeBooking');
        const hospitalField = document.getElementById('hospitalField');
        const clinicField = document.getElementById('clinicField');

        // Function to toggle visibility based on selected booking type
        function toggleFields() {
            const selectedValue = typeBooking.value;
            if (selectedValue === 'hospital') {
                hospitalField.style.display = 'block';
                clinicField.style.display = 'none';
            }if (selectedValue === 'clinic') {
                hospitalField.style.display = 'none';
                clinicField.style.display = 'block';
            }
        }

        // Call the function initially in case there's a selected value
        toggleFields();

        // Add event listener to handle changes
        typeBooking.addEventListener('change', toggleFields);
    });

</script>

<script>
    $(document).ready(function() {
        $('#doctor').change(function() {
            var doctorId = $(this).val();
            $.ajax({
                url: '/admin/get-hospitals/' + doctorId 
                , type: 'GET'
                , success: function(data) {
                    $('#hospital').empty();
                    $('#hospital').append('<option value="">Select hospital</option>');
                    $.each(data, function(key, value) {
                        $('#hospital').append('<option value="' + value.hospital_id + '">' +
                            value.name + '</option>');
                    });
                }
            });
        });
    });


    $(document).ready(function() {
        $('#doctor').change(function() {
            var doctorId = $(this).val();
            $.ajax({
                url: '/admin/get-clinics/' + doctorId 
                , type: 'GET'
                , success: function(data) {
                    $('#clinic').empty();
                    $('#clinic').append('<option value="">Select clinic</option>');
                    $.each(data, function(key, value) {
                        $('#clinic').append('<option value="' + value.clinic_id + '">' +
                            value.name + '</option>');
                    });
                }
            });
        });
    });

</script>
{{-- <script>
    $(document).ready(function() {
        var selectedDoctorId = {{ old('doctor_id', $selectedDoctorId) }};
        var selectedHospitalId = {{ old('doctor_hospital_id', $selectedHospitalId) }};

        function loadHospitals(countryId, selectedCityId = null) {
            if (doctorId) {
                $.ajax({
                    url: '/admin/get-hospitals/' + doctorId,
                    type: 'GET',
                    success: function(data) {
                        $('#hospital').empty();
                        $('#hospital').append('<option value="">{{ __("Choose hospital...") }}</option>');
                        $.each(data, function(key, value) {
                            $('#hospital').append('<option value="'+ value.id +'" '+ (value.hospital_id == selectedHospitalId ? 'selected' : '') +'>'+ value.name +'</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error loading cities:", error);
                    }
                });
            } else {
                $('#hospital').empty();
                $('#hospital').append('<option value="">{{ __("Choose hospital...") }}</option>');
            }
        }

        if (selectedDoctorId) {
            $('#doctor').val(selectedDoctorId);
            loadHospitals(selectedDoctorId, selectedHospitalId);
        }

        $('#doctor').change(function() {
            var doctorId = $(this).val();
            loadHospitals(doctorId);
        });
    });
</script>
  <script>
        $(document).ready(function() {
            $('#doctor').change(function() {
                var doctorId = $(this).val();
                $.ajax({
                    url: '/admin/get-hospitals/' + doctorId,
                    type: 'GET',
                    success: function(data) {
                        $('#hospital').empty();
                        $('#hospital').append('<option value="">Select hospital</option>');
                        $.each(data, function(key, value) {
                            $('#hospital').append('<option value="' + value.hospital_id + '">' +
                                value.name + '</option>');
                        });
                    }
                });
            });
        });
    </script>


<script>
    $(document).ready(function() {
        var selectedDoctorId = {{ old('doctor_id', $selectedDoctorId) }};
        var selectedClinicId = {{ old('doctor_clinic_id', $selectedClinicId) }};

        function loadClinics(countryId, selectedCityId = null) {
            if (doctorId) {
                $.ajax({
                    url: '/admin/get-clinics/' + doctorId,
                    type: 'GET',
                    success: function(data) {
                        $('#clinic').empty();
                        $('#clinic').append('<option value="">{{ __("Choose clinic...") }}</option>');
                        $.each(data, function(key, value) {
                            $('#clinic').append('<option value="'+ value.id +'" '+ (value.clinic_id == selectedClinicId ? 'selected' : '') +'>'+ value.name +'</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error loading cities:", error);
                    }
                });
            } else {
                $('#clinic').empty();
                $('#clinic').append('<option value="">{{ __("Choose clinic...") }}</option>');
            }
        }

        if (selectedDoctorId) {
            $('#doctor').val(selectedDoctorId);
            loadClinics(selectedDoctorId, selectedClinicId);
        }

        $('#doctor').change(function() {
            var doctorId = $(this).val();
            loadClinics(doctorId);
        });
    });
</script>
  <script>
        $(document).ready(function() {
            $('#doctor').change(function() {
                var doctorId = $(this).val();
                $.ajax({
                    url: '/admin/get-clinics/' + doctorId,
                    type: 'GET',
                    success: function(data) {
                        $('#clinic').empty();
                        $('#clinic').append('<option value="">Select clinic</option>');
                        $.each(data, function(key, value) {
                            $('#clinic').append('<option value="' + value.clinic_id + '">' +
                                value.name + '</option>');
                        });
                    }
                });
            });
        });
    </script>
 --}}


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
