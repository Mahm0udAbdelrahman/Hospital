@extends('admin.layouts.app')

@section('content')

<!--APP-CONTENT START-->
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
    .item input[type="text"],
    .ck-editor__editable_inline {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: 100%;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .nav-tabs .nav-item .nav-link {
        font-size: 18px;
        padding: 10px 20px;
        color: #555;
    }

    .nav-tabs .nav-item .nav-link.active {
        background-color: #007bff;
        color: white;
    }

    .nav-tabs .nav-item .nav-link:hover {
        background-color: #0056b3;
        color: white;
    }

    .tab-content {
        padding: 20px;
        border: 1px solid #ccc;
        border-top: none;
        border-radius: 0 0 4px 4px;
    }

    .ck-editor__editable {
        min-height: 200px;
        max-width: 100%;
        font-size: 16px;
    }

    .btn-create {
        width: 100%;
        font-size: 18px;
        padding: 10px;
    }

</style>


<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Page Header -->
<div class="d-md-flex d-block align-items-center justify-content-between page-header-breadcrumb">
    <div>
        <h2 class="main-content-title fs-24 mb-1">{{ __('Create Hospital') }}</h2>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)">{{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Hospitals') }}</li>
        </ol>
    </div>
</div>
<!-- Page Header Close -->

<!-- Start:: row-1 -->
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    {{ __('Add New') }}
                </div>
            </div>
            <form class="form-horizontal" method="POST" action="{{ route('hospitals.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-label">{{ __('Country') }}</label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-select" name="country_id">
                                    <option disabled selected>{{ __('Choose Country...') }}</option>
                                    @foreach ($countries as $country)
                                    <option @selected(old('country_id')==$country->id) value="{{ $country->id }}">
                                        {{ App::getLocale() == 'en' ? $country->getTranslationsArray()['en']['name'] : $country->getTranslationsArray()['ar']['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('country_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-label">{{ __('center') }}</label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-select js-example-basic-multiple" name="center_id[]" multiple="multiple">
                                    <option disabled>{{ __('Choose center...') }}</option>
                                    @foreach ($centers as $center)
                                    <option @selected(old('center_id')==$center->id) value="{{ $center->id }}">
                                        {{ App::getLocale() == 'en' ? $center->getTranslationsArray()['en']['name'] : $center->getTranslationsArray()['ar']['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('center_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone" class="form-label">{{ __('Phone') }}</label>
                        <input type="text" class="form-control" value="{{ old('phone') }}" name="phone" id="phone" aria-describedby="phoneHelp">
                        @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input type="email" class="form-control" value="{{ old('email') }}" name="email" id="email" aria-describedby="emailHelp">
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="case_treated" class="form-label">{{ __('Case Treated') }}</label>
                        <input type="text" class="form-control" value="{{ old('case_treated') }}" name="case_treated" id="case_treated" aria-describedby="case_treatedHelp">
                        @error('case_treated')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="surgery" class="form-label">{{ __('Surgery') }}</label>
                        <input type="text" class="form-control" value="{{ old('surgery') }}" name="surgery" id="surgery" aria-describedby="surgeryHelp">
                        @error('surgery')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="medical_staff" class="form-label">{{ __('Medical Staff') }}</label>
                        <input type="text" class="form-control" value="{{ old('medical_staff') }}" name="medical_staff" id="medical_staff" aria-describedby="medical_staffHelp">
                        @error('medical_staff')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="bed" class="form-label">{{ __('Bed') }}</label>
                        <input type="text" class="form-control" value="{{ old('bed') }}" name="bed" id="bed" aria-describedby="bedHelp">
                        @error('bed')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="form-group">
                        <label for="image" class="form-label">{{ __('Image') }}</label>
                        <input type="file" class="form-control" value="{{ old('image') }}" name="image" id="image" aria-describedby="imageHelp">
                        @error('image')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-label">{{ __('Status') }}</label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-select" name="status">
                                    <option disabled selected>{{ __('Choose Status...') }}</option>
                                    <option value="1">{{ __('Active') }}</option>
                                    <option value="0">{{ __('Unactive') }}</option>
                                </select>
                                @error('status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

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
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="pane-{{ $localeCode }}" role="tabpanel" aria-labelledby="tab-{{ $localeCode }}">
                                <div class="form-group">
                                    <label for="name-{{ $localeCode }}">{{ __('Name') }} {{ $localeCode }}</label>
                                    <input type="text" value="{{ old($localeCode . '.name') }}" name="{{ $localeCode }}[name]" id="name-{{ $localeCode }}" class="form-control">
                                    @error("$localeCode.name")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="address-{{ $localeCode }}">{{ __('Address') }} {{ $localeCode }}</label>
                                    <input type="text" value="{{ old($localeCode . '.address') }}" name="{{ $localeCode }}[address]" id="address-{{ $localeCode }}" class="form-control">
                                    @error("$localeCode.address")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description-{{ $localeCode }}">{{ __('Description') }} {{ $localeCode }}</label>
                                    <textarea name="{{ $localeCode }}[description]" id="description-{{ $localeCode }}" class="form-control ck-editor" rows="5">{{ old($localeCode . '.description') }}</textarea>
                                    @error("$localeCode.description")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-create">{{ __('Create') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End:: row-1 -->

<!--APP-CONTENT CLOSE-->


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
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });

</script>

@endsection
