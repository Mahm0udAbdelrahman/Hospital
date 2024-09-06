@extends('admin.layouts.app')
@section('content')
<!--APP-CONTENT START-->


<!-- Page Header -->

<div class="d-md-flex d-block align-items-center justify-content-between page-header-breadcrumb">
    <div>
        <h2 class="main-content-title fs-24 mb-1">Update Setting</h2>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Settings</li>
        </ol>
    </div>

</div>

@if (count($errors) > 0)
<div class="alert alert-danger" role="alert">{{ $errors->first() }}</div>
@endif
@if (session()->has('success'))
<div class="alert alert-success" id="success-message">
    {{ session()->get('success') }}
</div>
@endif

<script>
    setTimeout(function() {
        document.getElementById('success-message').style.display = 'none';
    }, 2000); // 5000 ميلي ثانية تعادل 5 ثوانٍ

</script>
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

            
            <form class="form-horizontal" method="POST" action="{{ route('settings.update', $setting->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body">

                    <label for="basic-url" class="form-label">{{ __('Languages') }}</label>
                    <select class="form-control mb-3" name="language" aria-label="Default select example">
                        <option selected disabled>select language</option>
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <option class="dropdown-item"
                            href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                            @if($setting->language==$properties['native']) selected @endif >
                            {{ $properties['native'] }}
                        </option>
                        @endforeach
                    </select>






                 

                    <label for="basic-url" class="form-label">{{ __('Logo') }}</label>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" value="{{ $setting->logo }}" name="logo" id="basic-url"
                            aria-describedby="basic-addon3">
                    </div>
                    @error('logo')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror

                    <label for="basic-url" class="form-label">{{ __('Favicon') }}</label>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" value="{{ $setting->favicon }}" name="favicon"
                            id="basic-url" aria-describedby="basic-addon3">
                    </div>
                    @error('favicon')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror




                    <label for="basic-url" class="form-label">{{ __('Phone') }}</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{ $setting->phone }}" name="phone"
                            id="basic-url" aria-describedby="basic-addon3">
                    </div>
                    @error('phone')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror

                    <label for="basic-url" class="form-label">{{ __('Email') }}</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{ $setting->email }}" name="email"
                            id="basic-url" aria-describedby="basic-addon3">
                    </div>
                    @error('email')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror

                    <label for="basic-url" class="form-label">{{ __('Location') }}</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{ $setting->location }}" name="location"
                            id="basic-url" aria-describedby="basic-addon3">
                    </div>
                    @error('location')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror

                    <label for="basic-url" class="form-label">{{ __('Whatsapp') }}</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{ $setting->whatsapp }}" name="whatsapp"
                            id="basic-url" aria-describedby="basic-addon3">
                    </div>
                    @error('whatsapp')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror

                    <label for="basic-url" class="form-label">{{ __('Facebook') }}</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{ $setting->facebook }}" name="facebook"
                            id="basic-url" aria-describedby="basic-addon3">
                    </div>
                    @error('facebook')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror

                    <label for="basic-url" class="form-label">{{ __('Twitter') }}</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{ $setting->twitter }}" name="twitter"
                            id="basic-url" aria-describedby="basic-addon3">
                    </div>
                    @error('twitter')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror


                    <label for="basic-url" class="form-label">{{ __('Instagram') }}</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{ $setting->instagram }}" name="instagram"
                            id="basic-url" aria-describedby="basic-addon3">
                    </div>
                    @error('instagram')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror


                    <label for="basic-url" class="form-label">{{ __('linkedin') }}</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{ $setting->linkedin }}" name="linkedin"
                            id="basic-url" aria-describedby="basic-addon3">
                    </div>
                    @error('linkedin')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror

                    <label for="basic-url" class="form-label">{{ __('Youtube') }}</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{ $setting->youtube }}" name="youtube"
                            id="basic-url" aria-describedby="basic-addon3">
                    </div>
                    @error('youtube')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror

                   

                    <label for="basic-url" class="form-label">{{ __('Video') }}</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{ $setting->video }}" name="video"
                            id="basic-url" aria-describedby="basic-addon3">
                    </div>
                    @error('video')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror

                    <label for="basic-url" class="form-label">{{ __('Number Of Consultants') }}</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{ $setting->number_of_consultants }}" name="number_of_consultants"
                            id="basic-url" aria-describedby="basic-addon3">
                    </div>
                    @error('number_of_consultants')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror

                    <label for="basic-url" class="form-label">{{ __('Number Of Medical Team') }}</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{ $setting->number_of_medical_team }}" name="number_of_medical_team"
                            id="basic-url" aria-describedby="basic-addon3">
                    </div>
                    @error('number_of_medical_team')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror


                    <label for="basic-url" class="form-label">{{ __('Number Of Beds') }}</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{ $setting->number_of_beds }}" name="number_of_beds"
                            id="basic-url" aria-describedby="basic-addon3">
                    </div>
                    @error('number_of_beds')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror

                    <label for="basic-url" class="form-label">{{ __('Number Of Ppatients') }}</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{ $setting->number_of_patients }}" name="number_of_patients"
                            id="basic-url" aria-describedby="basic-addon3">
                    </div>
                    @error('number_of_patients')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror
 
                    <label for="basic-url" class="form-label">{{ __('Sustainability Report') }}</label>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" value="{{ $setting->sustainability_report }}" name="sustainability_report" id="basic-url"
                            aria-describedby="basic-addon3">
                    </div>
                    @error('sustainability_report')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror

                    <label for="basic-url" class="form-label">{{ __('Whistleblowing Policy') }}</label>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" value="{{ $setting->whistleblowing_policy }}" name="whistleblowing_policy" id="basic-url"
                            aria-describedby="basic-addon3">
                    </div>
                    @error('whistleblowing_policy')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror

                    <label for="basic-url" class="form-label">{{ __('Internal Rules Of Conduct') }}</label>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" value="{{ $setting->internal_rules_of_conduct }}" name="internal_rules_of_conduct" id="basic-url"
                            aria-describedby="basic-addon3">
                    </div>
                    @error('internal_rules_of_conduct')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror

                    <label for="basic-url" class="form-label">{{ __('Supplier Code Of Conduct') }}</label>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" value="{{ $setting->supplier_code_of_conduct }}" name="supplier_code_of_conduct" id="basic-url"
                            aria-describedby="basic-addon3">
                    </div>
                    @error('supplier_code_of_conduct')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror



                    



                    <div class="card hk-dash-type-1 overflow-hidden">
                        <div class="card-header pa-0">
                            <div class="nav nav-tabs nav-light nav-justified" id="dash-tab" role="tablist">
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <a class="nav-item nav-link {{ $loop->first ? 'active' : '' }}"
                                        id="tab-{{ $localeCode }}" data-toggle="tab" href="#pane-{{ $localeCode }}"
                                        role="tab" aria-controls="pane-{{ $localeCode }}"
                                        aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                        {{ $properties['native'] }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-content" id="nav-tabContent">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                @php
                                $translations = $setting->getTranslationsArray()[$localeCode] ?? [];
                                @endphp
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="pane-{{ $localeCode }}"
                                    role="tabpanel" aria-labelledby="tab-{{ $localeCode }}">
                                    <div class="form-group">
                                        <label for="basic-url{{ $localeCode }}" class="form-label">{{ __('Name') }}
                                            {{ $localeCode }}</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="{{ $localeCode }}[name]"
                                                id="basic-url-{{ $localeCode }}" value="{{ $translations['name'] ?? '' }}"
                                                aria-describedby="basic-addon3{{ $localeCode }}">
                                        </div>
                                        @error("{{ $localeCode }}[name]")
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>



                                    <div class="form-group">
                                        <label for="basic-url{{ $localeCode }}" class="form-label">{{ __('Address') }}
                                            {{ $localeCode }}</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="{{ $localeCode }}[address]"
                                                id="basic-url-{{ $localeCode }}" value="{{ $translations['address'] ?? '' }}"
                                                aria-describedby="basic-addon3{{ $localeCode }}">
                                        </div>
                                        @error("{{ $localeCode }}[address]")
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="basic-url{{ $localeCode }}" class="form-label">{{ __('Description') }}
                                            {{ $localeCode }}</label>
                                        <div class="input-group mb-3">
                                            <textarea type="text" class="form-control" name="{{ $localeCode }}[description]"
                                                id="basic-url-{{ $localeCode }}" value="{{ $translations['description'] ?? '' }}"
                                                aria-describedby="basic-addon3{{ $localeCode }}">{{ $translations['description'] }}</textarea>
                                        </div>
                                        @error("{{ $localeCode }}[description]")
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                <div class="form-group">

                                    <label for="basic-url{{ $localeCode }}" class="form-label">{{ __('Words Guide') }}
                                        {{ $localeCode }}</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="{{ $localeCode }}[words_guide]"
                                            id="basic-url-{{ $localeCode }}" value="{{ $translations['words_guide'] ?? '' }}"
                                            aria-describedby="basic-addon3{{ $localeCode }}">
                                    </div>
                                    @error("{{ $localeCode }}[words_guide]")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>

                                 <div class="form-group">

                                    <label for="basic-url{{ $localeCode }}" class="form-label">{{ __('About') }}
                                        {{ $localeCode }}</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="{{ $localeCode }}[about]"
                                            id="basic-url-{{ $localeCode }}" value="{{ $translations['about'] ?? '' }}"
                                            aria-describedby="basic-addon3{{ $localeCode }}">
                                    </div>
                                    @error("{{ $localeCode }}[about]")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>

                                 <div class="form-group">

                                    <label for="basic-url{{ $localeCode }}" class="form-label">{{ __('Privacy') }}
                                        {{ $localeCode }}</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="{{ $localeCode }}[privacy]"
                                            id="basic-url-{{ $localeCode }}" value="{{ $translations['privacy'] ?? '' }}"
                                            aria-describedby="basic-addon3{{ $localeCode }}">
                                    </div>
                                    @error("{{ $localeCode }}[privacy]")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>

                                 <div class="form-group">

                                    <label for="basic-url{{ $localeCode }}" class="form-label">{{ __('Terms') }}
                                        {{ $localeCode }}</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="{{ $localeCode }}[terms]"
                                            id="basic-url-{{ $localeCode }}" value="{{ $translations['terms'] ?? '' }}"
                                            aria-describedby="basic-addon3{{ $localeCode }}">
                                    </div>
                                    @error("{{ $localeCode }}[terms]")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>


                                 <div class="form-group">
                                    <label for="why_hospital-{{ $localeCode }}">{{ __('Why Hospital') }}
                                        {{ $localeCode }}</label>
                                    <textarea name="{{ $localeCode }}[why_hospital]" id="why_hospital-{{ $localeCode }}" class="form-control ck-editor"
                                        rows="5">{{ $translations['why_hospital'] ?? ''}}</textarea>
                                    @error("$localeCode.why_hospital")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="path_to_success-{{ $localeCode }}">{{ __('Path To Success') }}
                                        {{ $localeCode }}</label>
                                    <textarea name="{{ $localeCode }}[path_to_success]" id="path_to_success-{{ $localeCode }}" class="form-control ck-editor"
                                        rows="5">{{ $translations['path_to_success'] ?? ''}}</textarea>
                                    @error("$localeCode.path_to_success")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="sustainability-{{ $localeCode }}">{{ __('Sustainability') }}
                                        {{ $localeCode }}</label>
                                    <textarea name="{{ $localeCode }}[sustainability]" id="sustainability-{{ $localeCode }}" class="form-control ck-editor"
                                        rows="5">{{ $translations['sustainability'] ?? ''}}</textarea>
                                    @error("$localeCode.sustainability")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="hospital_policies-{{ $localeCode }}">{{ __('Hospital Policies') }}
                                        {{ $localeCode }}</label>
                                    <textarea name="{{ $localeCode }}[hospital_policies]" id="hospital_policies-{{ $localeCode }}" class="form-control ck-editor"
                                        rows="5">{{ $translations['hospital_policies'] ?? ''}}</textarea>
                                    @error("$localeCode.hospital_policies")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="management_team-{{ $localeCode }}">{{ __('Management Team') }}
                                        {{ $localeCode }}</label>
                                    <textarea name="{{ $localeCode }}[management_team]" id="management_team-{{ $localeCode }}" class="form-control ck-editor"
                                        rows="5">{{ $translations['management_team'] ?? ''}}</textarea>
                                    @error("$localeCode.management_team")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>




                                </div>
                            @endforeach
                        </div>
                    </div>













                    <div class="form-group ">
                        <div class="row row-sm">
                            <div class="col-md-3">
                                <label class="form-label">{{ __('Status') }}</label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-select" name="status">
                                    <option disabled selected>{{ __('Choose Status...') }}</option>
                                    <option @if ($setting->status == '1') selected @endif value="1">
                                        {{ __('Active') }}
                                    </option>
                                    <option @if ($setting->status == '0') selected @endif value="0">
                                        {{ __('Unactive') }}
                                    </option>

                                </select>

                            </div>
                        </div>
                    </div>

                    <button class="form-control btn btn-primary">{{ __('Update') }}</button>

                    </>

                </div>
        </div>



        <!-- End:: row-3 -->


    </div>
    <!--APP-CONTENT CLOSE-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
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
