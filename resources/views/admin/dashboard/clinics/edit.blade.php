@extends('admin.layouts.app')
@section('content')
<!--APP-CONTENT START-->


<!-- Page Header -->

<div class="d-md-flex d-block align-items-center justify-content-between page-header-breadcrumb">
    <div>
        <h2 class="main-content-title fs-24 mb-1">Create Clinic</h2>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Clinics</li>
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







@if (count($errors) > 0)
<div class="alert alert-danger" role="alert">{{ $errors->first() }}</div>
@endif
@if (session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif
<!-- Page Header Close -->

<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Start:: row-1 -->
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    Add new
                </div>

            </div>
            <form class="form-horizontal" method="POST" action="{{ route('clinics.update', $clinic->id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body">
                    <div class="form-group">
                     <label for="basic-url" class="form-label">Logo</label>
                    @foreach($clinic->getMedia('logo') as $img)
                    <img src="{{ $img->getUrl() }}" id="img-prvv" height="150" width="150" >
                    @endforeach
                    </div>

                    <div class="form-group">
                        <label for="basic-url" class="form-label">Image</label>
                    @foreach($clinic->getMedia('image') as $img)
                    <img src="{{ $img->getUrl() }}" id="img-prv" height="150" width="150" >
                    @endforeach
                </div>


                    <label for="basic-url" class="form-label">Logo</label>
                    <div class="input-group mb-3">
                        <input type="file" onchange="showPrevieww(event)"  class="form-control" value="{{ $clinic->logo }}" name="logo" id="basic-url" aria-describedby="basic-addon3">
                    </div>
                    @error('logo')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror
                    <script>
                        function showPrevieww(event){
                            if(event.target.files.length > 0){
                                let src = URL.createObjectURL(event.target.files[0]);
                                let prv = document.getElementById('img-prvv');
                                prv.src = src;
                            }
                        }
                    </script>
                    


                    <label for="basic-url" class="form-label">image</label>
                    <div class="input-group mb-3">
                        <input type="file" onchange="showPreview(event)" class="form-control" value="{{ $clinic->image }}" name="image" id="basic-url" aria-describedby="basic-addon3">
                    </div>
                    @error('image')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror
                    <script>
                        function showPreview(event){
                            if(event.target.files.length > 0){
                                let src = URL.createObjectURL(event.target.files[0]);
                                let prv = document.getElementById('img-prv');
                                prv.src = src;
                            }
                        }
                    </script>

                    <div class="form-group">
                        <div class="row row-sm">
                            <div class="col-md-3">
                                <label class="form-label">{{ __('Country') }}</label>
                            </div>
                            <div class="col-md-9">
                                <select id="country" class="form-select" name="country_id">
                                    <option disabled>{{ __('Choose Country...') }}</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}" {{ old('country_id', $selectedCountryId) == $country->id ? 'selected' : '' }}>
                                            {{ App::getLocale() == 'en' ? $country->getTranslationsArray()['en']['name'] : $country->getTranslationsArray()['ar']['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @error('country_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="form-group">
                        <div class="row row-sm">
                            <div class="col-md-3">
                                <label class="form-label">{{ __('City') }}</label>
                            </div>
                            <div class="col-md-9">
                                <select id="city" class="form-select" name="city_id">
                                    <option disabled>{{ __('Choose City...') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    @error('city_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror



                    <div class="form-group ">
                        <div class="row row-sm">
                            <div class="col-md-3">
                                <label class="form-label">{{ __('Status') }}</label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-select" name="status">
                                    <option disabled selected>{{ __('Choose Status...') }}</option>
                                    <option @if ($clinic->status == '1') selected @endif value="1">
                                        {{ __('Active') }}
                                    </option>
                                    <option @if ($clinic->status == '0') selected @endif value="0">
                                        {{ __('Unactive') }}
                                    </option>

                                </select>

                            </div>
                        </div>
                    </div>
                    @error('status')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror

                    <div class="card hk-dash-type-1 overflow-hidden">
                        <div class="card-header pa-0">
                            <div class="nav nav-tabs nav-light nav-justified" id="dash-tab" role="tablist">
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <a class="nav-item nav-link {{ $loop->first ? 'active' : '' }}" id="tab-{{ $localeCode }}" data-toggle="tab" href="#pane-{{ $localeCode }}" role="tab" aria-controls="pane-{{ $localeCode }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                    {{ $properties['native'] }}
                                </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-content" id="nav-tabContent">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            @php
                            $translations = $clinic->getTranslationsArray()[$localeCode];
                            @endphp
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="pane-{{ $localeCode }}" role="tabpanel" aria-labelledby="tab-{{ $localeCode }}">
                                <div class="form-group">
                                    <label for="name-{{ $localeCode }}">{{ __('Name') }} {{ $localeCode }}</label>
                                    <input type="text" value="{{ $translations['name'] }}" name="{{ $localeCode }}[name]" id="name-{{ $localeCode }}" class="form-control">
                                    @error("$localeCode.name")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description-{{ $localeCode }}">{{ __('description') }} {{ $localeCode }}</label>
                                    <textarea name="{{ $localeCode }}[description]" id="description-{{ $localeCode }}" class="form-control ck-editor" rows="5">{{ $translations['description'] }}</textarea>
                                    @error("$localeCode.description")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>




                            </div>
                            @endforeach
                        </div>
                    </div>

                    <button class="form-control btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>



    <!-- End:: row-3 -->


</div>
<!--APP-CONTENT CLOSE-->


<script>
    $(document).ready(function() {
      var selectedCountryId = {{ old('country_id', $selectedCountryId) }};
      var selectedCityId = {{ old('city_id', $selectedCityId) }};
  
      function loadCities(countryId, selectedCityId = null) {
          if (countryId) {
              $.ajax({
                  url: '/admin/get-cities/' + countryId,
                  type: 'GET',
                  success: function(data) {
                      $('#city').empty();
                      $('#city').append('<option value="">{{ __("Choose City...") }}</option>');
                      $.each(data, function(key, value) {
                          $('#city').append('<option value="' + value.id + '" ' + (value.id == selectedCityId ? 'selected' : '') + '>' + value.name + '</option>');
                      });
                  },
                  error: function(xhr, status, error) {
                      console.error("Error loading cities:", error);
                  }
              });
          } else {
              $('#city').empty();
              $('#city').append('<option value="">{{ __("Choose City...") }}</option>');
          }
      }
  
      if (selectedCountryId) {
          $('#country').val(selectedCountryId);
          loadCities(selectedCountryId, selectedCityId);
      }
  
      $('#country').change(function() {
          var countryId = $(this).val();
          loadCities(countryId);
      });
  
      $('#city').change(function() {
          var cityId = $(this).val();
          console.log("Selected city ID:", cityId);
      });
  });
  
  
</script>





<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // Initialize CKEditor for all textareas with class 'ck-editor'
    ClassicEditor
        .create(document.querySelectorAll('.ck-editor'))
        .catch(error => {
            console.error(error);
        });

</script>








@endsection
