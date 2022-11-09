@extends('layout')

@section('body')
<div class="container-fluid">

    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    {{-- breadcrumb --}}
                    <div class="col-md-8">
                        <h4 class="page-title mb-0">User Management</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">SCMT UI</a></li>
                            <li class="breadcrumb-item"><a href="#">User Management</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create</li>
                        </ol>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-header">
                    @if (\Session::has('message'))
                        <div class="alert alert-success bg-success text-white" role="alert">
                            <strong>{{ \Session::get('message') }}</strong>
                        </div>
                    @endif

                    @if (\Session::has('error'))
                        <div class="alert alert-danger bg-danger text-white" role="alert" style="display:none;">
                            <strong>{{ \Session::get('error') }}</strong>
                        </div>
                    @endif
                </div>

                <div class="card-body">

                    <h4 class="mt-0 header-title">Please fill all the forms below</h4>
                    <form action="{{ route('user.store') }}" method="post">
                        @method('post')
                        @csrf

                        {{-- Username --}}
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="username" placeholder="Username" value="{{ old('username') }}" required="">
                            </div>
                        </div>

                        {{-- Password --}}
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" name="password" placeholder="Password" value="" required="">
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="description" placeholder="Description" value="{{ old('description') }}">
                            </div>
                        </div>

                        {{-- Role --}}
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Role</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="role">
                                    <option value="superadmin">Superadmin</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="active">
                                    <option {{ old('active', '') == '1' ? 'selected' : '' }} value="1">Active</option>
                                    <option {{ old('active', '') == '0' ? 'selected' : '' }} value="0">In-active</option>
                                </select>
                            </div>
                        </div>

                        {{-- Status Description --}}
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Status Description</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="active_reason" placeholder="(Fill as user's inactive reason)" value="{{ old('active_reason', '') }}">
                            </div>
                        </div>

                        {{-- Module --}}
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Modules</label>
                            <div class="col-sm-10">
                                <select name="module[]" class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Modul">
                                    @foreach ($modules as $module)
                                        <option {{ \Str::contains(old('module'), $module->module) ? 'selected' : '' }} value="{{ $module->module }}">{{ $module->module }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <button class="btn btn-primary"> Submit </button>
                                <button id="reset" type="reset" class="btn btn-primary" style="display:none;"> Reset </button>
                            </div>
                        </div>

                    </form>

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
