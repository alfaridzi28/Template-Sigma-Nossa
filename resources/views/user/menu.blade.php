@extends('layout')

@section('body')
<div class="container-fluid">

    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    {{-- breadcrumb --}}
                    <div class="col-md-8">
                        <h4 class="page-title mb-0">{{ $submodule->subtitle }}</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">SQM Portal</a></li>
                            <li class="breadcrumb-item"><a href="#">{{ $submodule->subtitle }}</a></li>
                        </ol>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                {{-- <div class="card">
                    <div class="card-body">
                            <p>
                                <a class="btn btn-success btn-sm" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                Elastic Username / Password
                                </a>
                            </p>
                            <div class="collapse" id="collapseExample">
                                <div class="card card-body">
                                    <div class="row">
                                        <div class="col">
                                            username: <b>user</b>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            password: <b>public123</b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div> --}}

                <div class="card-body">

                    <iframe src="{{$submodule->url}}" frameborder="0" height="1500" width="100%"></iframe>

                </div>

            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
    $(document).ready(() => {
            $('.select2').select2();
        });
</script>
@endpush