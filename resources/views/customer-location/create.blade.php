@extends('layout')

@section('body')
<div class="container-fluid">

    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    {{-- breadcrumb --}}
                    <div class="col-md-8">
                        <h4 class="page-title mb-0">Manage Customer Location</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">SCMT UI</a></li>
                            <li class="breadcrumb-item"><a href="#">Customer Location</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Manage</li>
                        </ol>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="mt-0 header-title">Please fill all the forms below</h4>
                    <form id="form-rekon" action="http://localhost:3020/customer-location/store" method="post" enctype="multipart/form-data">
                    {{-- <form id="form-rekon" action="http://10.62.61.105:3020/customer-location/store" method="post" enctype="multipart/form-data"> --}}
                        @method('post')
                        @csrf

                        <input type="hidden" name="created_by" value="{{ auth()->user()->id }}" />

                        {{-- Customer Code --}}
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Customer Code</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="customer_code" placeholder="Customer Code" value="{{ old('customer_code', '') }}" required="">
                            </div>
                        </div>

                        {{-- Customer Name --}}
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Customer Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="customer_name" placeholder="Customer Name" value="{{ old('customer_name', '') }}" required="">
                            </div>
                        </div>

                        {{-- Service ID --}}
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Service ID</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="service_id" placeholder="Service ID" value="{{ old('service_id', '') }}" required="">
                            </div>
                        </div>

                        {{-- Install Location --}}
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Install Location</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="install_loc" placeholder="Install Location" value="{{ old('install_loc', '') }}" required="">
                            </div>
                        </div>

                        {{-- Address --}}
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="address" placeholder="Address" value="{{ old('address', '') }}" required="">
                            </div>
                        </div>

                        {{-- Latitude --}}
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Latitude</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="latitude" placeholder="Latitude" value="{{ old('latitude', '') }}" required="">
                            </div>
                        </div>

                        {{-- Longitude --}}
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Longitude</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="longitude" placeholder="Longitude" value="{{ old('longitude', '') }}" required="">
                            </div>
                        </div>

                        {{-- Workzone --}}
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Workzone</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="workzone" placeholder="Workzone" value="{{ old('workzone', '') }}" required="">
                            </div>
                        </div>

                        {{-- NAMA_MITRA --}}
                        {{-- <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Nama Mitra</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="NAMA_MITRA" placeholder="Nama Mitra" value="{{ old('NAMA_MITRA', '') }}" required="">
                            </div>
                        </div> --}}

                        {{-- INSTALL_DATE --}}
                        {{-- <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Install Date</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="date" name="INSTALL_DATE" placeholder="Install Date" value="{{ old('INSTALL_DATE', '') }}" required="">
                            </div>
                        </div> --}}

                        {{-- SITEID --}}
                        {{-- <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Site ID</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="test" name="SITEID" placeholder="Site ID"  value="{{ old('SITEID', '') }}" required="">
                            </div>
                        </div> --}}

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <button class="btn btn-primary"> Submit </button>
                                <button id="reset" type="reset" class="btn btn-primary" style="display:none;"> Reset </button>
                            </div>
                        </div>

                    </form>

                </div>
                <div class="card-footer">
                    <div class="alert alert-success bg-success text-white" role="alert" style="display:none;">
                        <strong id="success-message"></strong>
                    </div>

                    <div class="alert alert-warning bg-warning text-white" role="alert" style="display:none;" onclick="$(this).hide()">
                        <strong id="error-message"></strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
    <script>
        $(document).ready(() => {
            $('form').submit((e) => {
                $('.alert').hide();
                e.preventDefault();

                var form    = $(e.target),
                    url     = form.attr('action'),
                    data    = form.serialize(),
                    type    = form.attr('method');

                $.ajax({
                    url     : url, 
                    data    : data,
                    type    : type,
                    success : (response) => {
                        console.log(response);
                        $('.alert-success').show();
                        $('#success-message').text(response.message);
                        // $('#success-message').text(response.responseJSON.message);

                        setTimeout(() => {
                            $('.alert').hide();
                            $('#reset').click();
                        }, 3000)
                    },
                    error   : (response) => {
                            $('.alert-warning').show();
                            $('#error-message').text(`${response.responseJSON.message} (${response.responseJSON.code})`);

                            setTimeout(() => {
                                $('.alert').hide();
                            }, 8000)
                        // if(response.status === 500){
                        // } else {
                        //     console.log(response);
                        //     alert('Error occured, please view console log');
                        // }
                    }
                });
            });
        });
    </script>
@endpush
