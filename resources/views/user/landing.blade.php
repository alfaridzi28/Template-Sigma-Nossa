@extends('layout')

@section('body')
<div class="container-fluid">

    <div class="row" style="margin-top: 80px">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex text-center justify-content-center">
                        <h1>Hello, {{ auth()->user()->username }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection