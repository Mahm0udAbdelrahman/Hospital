@extends('admin.layouts.app')
@section('content')
<!--APP-CONTENT START-->

<!-- Page Header -->
<div class="d-md-flex d-block align-items-center justify-content-between page-header-breadcrumb">
    <div>
        <h2 class="main-content-title fs-24 mb-1">Create Slider</h2>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sliders</li>
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
            <form class="form-horizontal" method="POST" action="{{ route('sliders.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">


                    <label for="basic-url" class="form-label">Image</label>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" value="{{ old('images') }}" name="images"  id="basic-url" aria-describedby="basic-addon3">
                    </div>
                    @error('images')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror


                    <div class="form-group ">
                        <div class="row row-sm">
                            <div class="col-md-3">
                                <label class="form-label">Status</label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-select" name="status">
                                    <option disabled selected>Choose status...</option>
                                    <option value="1">{{ __('Active') }}</option>
                                    <option value="0">{{ __('Unactive') }}</option>

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
<!--APP-CONTENT CLOSE-->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection
