@extends('admin.layouts.app')
@section('content')
<!--APP-CONTENT START-->

<!-- Page Header -->
<div class="d-md-flex d-block align-items-center justify-content-between page-header-breadcrumb">
    <div>
        <h2 class="main-content-title fs-24 mb-1">Create Medical Tourism</h2>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Medical Tourisms</li>
        </ol>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@push('cs')
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
@endpush
<style>
    .item {
        background-color: #f1f1f1;
        padding: 10px;
        margin-bottom: 10px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .item>* {
        margin-bottom: 10px;
    }

    .item select,
    .item input[type="text"],
    .item textarea {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
        width: 100%;
    }

    .item a {
        margin-right: 10px;
        cursor: pointer;
    }

</style>
<link href="https://cdn.jsdelivr.net/gh/priyashpatil/phone-input-by-country@0.0.1/cpi.css" rel="stylesheet" crossorigin="anonymous" referrerpolicy="no-referrer">
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
            <form class="form-horizontal" method="POST" action="{{ route('medical_tourisms.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    <label for="basic-url" class="form-label">Name</label>
                    <div class="input-group mb-3">
                        <input type="text"  class="form-control" value="{{ old('name') }}" name="name" id="basic-url" aria-describedby="basic-addon3">
                    </div>
                    @error('name')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror

                    {{-- <div class="cpi-input">
                        <div class="input-group mb-3 border rounded">
                            <button class="btn btn-light dropdown-toggle d-flex align-items-center cpi-drop" type="button" name="phone" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ $countries->first()->media->first()->getUrl() }}" width="20" height="20" class="me-1" alt="">
                                <span class="me-1">{{ $countries->first()->code }}</span> <!-- عرض الكود الأول افتراضيًا -->
                            </button>
                            <div class="dropdown-menu w-100">
                                @foreach($countries as $country)
                                @foreach ($country->media as $imgs )
                                <button type="button" name="phone" class="dropdown-item" data-cpi-icon="{{ $imgs->getUrl() }}" data-cpi-ext="{{ $country->code }}" data-phone-code="{{ $country->phone_code }}" data-min-length="{{ $country->min_length }}" data-max-length="{{ $country->max_length }}">
                                    <img src="{{ $imgs->getUrl() }}" width="20" height="20" alt="">
                                    {{ $country->name }} ({{ $country->code }})
                                </button>
                                @endforeach
                                @endforeach
                            </div>
                            <span class="input-group-text bg-white text-muted border-0 cpi-ext-txt">{{ $countries->first()->phone_code }}</span>
                            <input type="text" name="phone" class="form-control border-0 phone-input flex-shrink-1" style="outline: none;" pattern="[0-9]+" required minlength="{{ $countries->first()->min_length }}" maxlength="{{ $countries->first()->max_length }}" title="Enter a valid mobile number">
                        </div>
                        <input type="hidden" name="phone" class="country-code-input">
                    </div> --}}


                    <label for="basic-url" class="form-label">Phone</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{ old('phone') }}" name="phone" id="basic-url" aria-describedby="basic-addon3">
                    </div>
                    @error('phone')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror

                    
                    
                    <label for="basic-url" class="form-label">Email</label>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" value="{{ old('email') }}" name="email" id="basic-url" aria-describedby="basic-addon3">
                    </div>
                    @error('email')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <div class="row row-sm">
                            <div class="col-md-3">
                                <label class="form-label">{{ __('Type') }}</label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-select" name="type">
                                    <option disabled selected>{{ __('Choose status...') }}</option>
                                    <option @if(old('type') == "male") selected @endif  value="male">{{ __('Male') }}</option>
                                    <option @if(old('type') == "female") selected @endif value="female">{{ __('Female') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    @error('status')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror



                    <div class="form-group ">
                        <div class="row row-sm">
                            <div class="col-md-3">
                                <label class="form-label">{{ __('Country') }}</label>
                            </div>
                            <div class="col-md-9">

                                <select class="form-select" name="country_id">
                                    <option disabled selected>{{ __('Choose country...') }}</option>
                                    @foreach ($countries as $country)
                                    <option @selected(old('country_id')==$country->id ) value="{{ $country->id }}">
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


                    <div class="form-group ">
                        <div class="row row-sm">
                            <div class="col-md-3">
                                <label class="form-label">{{ __('Date') }}</label>
                            </div>
                            <div class="col-md-9">

                                <input type="date" class="form-control" value="{{ old('date') }}" name="date" id="basic-url" aria-describedby="basic-addon3">

                            </div>
                        </div>
                    </div>
                    @error('date')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror

                     

                    <label for="basic-url" class="form-label">Medical Report</label>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" value="{{ old('medical_report') }}" name="medical_report" id="basic-url" aria-describedby="basic-addon3">
                    </div>
                    @error('medical_report')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror

                    <label for="basic-url" class="form-label">Case Details</label>
                    <div class="input-group mb-3">
                        <textarea  class="form-control" name="case_details" id="basic-url" aria-describedby="basic-addon3">{{ old('case_details') }}</textarea>
                    </div>
                    @error('case_details')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <div class="row row-sm">
                            <div class="col-md-3">
                                <label class="form-label">{{ __('status') }}</label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-select" name="status">
                                    <option disabled selected>{{ __('Choose status...') }}</option>
                                    <option @if(old('status')=='1') selected @endif value="1">{{ __('Active') }}</option>
                                    <option @if(old('status')=='0') selected @endif value="0">{{ __('Unactive') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    @error('status')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror

                  

                    <button class="form-control btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/gh/priyashpatil/phone-input-by-country@0.0.1/cpi.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
<script>
    const languages = @json($languages); // Assuming $languages is available as a JSON variable

    function addItem() {
        const container = document.getElementById("container");
        const newItem = document.createElement("div");
        newItem.className = "item";
        newItem.innerHTML = `
                <div class="form-group">
                    <div class="row row-sm">
                        <div class="col-md-5">
                            <label class="form-label">Language</label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-select" name="language_id[]">
                                <option disabled selected>Choose languages...</option>
                                ${languages.map(language => `<option value="${language.id}">${language.name}</option>`).join('')}
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row row-sm">
                        <div class="col-md-5">
                            <label class="form-label">Attribute</label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-select" name="attribute[]" onchange="handleAttributeChange(this)">
                                <option disabled selected>Choose attribute...</option>
                                <option value="title">Title</option>
                                <option value="content">Content</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row row-sm">
                        <div class="col-md-4">
                            <label class="form-label">Translate</label>
                        </div>
                        <div class="col-md-9 translate-container">
                            <input type="text" class="form-control" value="{{ old('translate') }}" name="translate[]" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                    </div>
                </div>
                <a onclick="removeItem(this)"><i class="fa-solid fa-minus"></i></a>
                <a onclick="addItem()"><i class="fa-solid fa-plus"></i></a>
            `;
        container.appendChild(newItem);
    }

    function removeItem(btn) {
        const item = btn.closest('.item');
        item.remove();
    }

    function handleAttributeChange(selectElement) {
        const item = selectElement.closest('.item');
        const translateContainer = item.querySelector('.translate-container');

        if (selectElement.value === 'content') {
            translateContainer.innerHTML = '<textarea class="form-control" name="translate[]" id="basic-url" aria-describedby="basic-addon3">{{ old('
            translate ') }}</textarea>';
            const textarea = translateContainer.querySelector('textarea');
            ClassicEditor
                .create(textarea)
                .catch(error => {
                    console.error(error);
                });
        } else {
            translateContainer.innerHTML = '<input type="text" class="form-control" value="{{ old('
            translate ') }}" name="translate[]" id="basic-url" aria-describedby="basic-addon3">';
        }
    }

</script>
<script>
    document.querySelectorAll('.dropdown-item').forEach(item => {
    item.addEventListener('click', function() {
        let selectedIcon = this.getAttribute('data-cpi-icon');
        let selectedExt = this.getAttribute('data-cpi-ext');
        let phoneCode = this.getAttribute('data-phone-code');
        let minLength = this.getAttribute('data-min-length');
        let maxLength = this.getAttribute('data-max-length');

        // تحديث الزر بالصورة والكود
        let btn = document.querySelector('.cpi-drop');
        btn.innerHTML = `<img src="${selectedIcon}" width="20" height="20" class="me-1" alt=""> <span class="me-1">${selectedExt}</span>`;

        // تحديث حقل الامتداد
        document.querySelector('.cpi-ext-txt').innerText = phoneCode;

        // تحديث القيود على طول الرقم
        let phoneInput = document.querySelector('.phone-input');
        phoneInput.setAttribute('minlength', minLength);
        phoneInput.setAttribute('maxlength', maxLength);
    });
});


    </script>

@endsection
