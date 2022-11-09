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
                            <li class="breadcrumb-item active" aria-current="page">List User</li>
                        </ol>
                    </div>

                    {{-- <div class="col-md-4">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <button class="btn btn-primary btn-rounded dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ti-settings mr-1"></i> Settings
                                </button>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Separated link</a>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    @include('module.modal.alert')

    <div class="row">
        <div class="col-lg-12">
            <button class="btn btn-primary mb-2" type="button" data-toggle="modal" data-target="#modalAddUser"
                data-whatever="@getbootstrap">Add User</button>
            <div class="card">
                <div class="card-body" style="overflow:scroll">

                    <table class="datatable table table-bordered table-condensed table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Module</th>
                                <th>Status</th>
                                <th>Created at</th>
                                <th>LDAP</th>
                                <th>Description</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>
                                    <strong class="username">{{ $user->username }}</strong> <br />
                                    <small><i>{{ $user->description }}</i></small>
                                </td>
                                <td align="center">
                                    @if ($user->role == 'superadmin')
                                    <span class="badge badge-primary">Super Admin</span>
                                    @elseif ($user->role == 'admin')
                                    <span class="badge badge-info">Admin</span>
                                    @else
                                    <span class="badge badge-success">User</span>
                                    @endif
                                </td>
                                <td>
                                    @foreach (explode(',', $user->module) as $module)
                                    <span class="badge badge-success">{{ $module }}</span>
                                    @endforeach
                                </td>
                                <td align="center">
                                    {!! $user->active ? '<span class="badge badge-success">Active</span>' : '<span
                                        class="badge badge-danger">Inactive</span>' !!}
                                    @if (!$user->active)
                                    <br />
                                    <small>{{ $user->active_reason }}</small>
                                    @endif
                                </td>
                                <td>{{ $user->created_at }}</td>
                                <td>
                                    @if ($user->ldap == 1)
                                        LDAP
                                    @else
                                        Local
                                    @endif
                                </td>
                                <td>
                                    {{ $user->description }}
                                </td>
                                <td align="center">
                                    <button class="btn btn-sm btn-primary" class="btn btn-success" data-toggle="modal" data-target="#modalEdit" data-id="{{ $user->id }}" data-username="{{ $user->username }}" data-description="{{ $user->description }}" data-role="{{ $user->role }}" data-active="{{ $user->active }}" data-activereason="{{ $user->active_reason }}" data-module="{{ $user->module }}" data-ldap="{{ $user->ldap }}"><i class="dripicons-document-edit"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('user.modal.create')

    @include('user.modal.edit')

</div>
@endsection

@push('scripts')
<script>
    $(document).ready(() => {
        $('.datatable').DataTable();
    });

    $(document).ready(() => {
        $('.select2').select2();
    });

    $('#modalEdit').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id')
        var username = button.data('username')
        var description = button.data('description')
        var role = button.data('role')
        var active = button.data('active')
        var active_reason = button.data('activereason')
        var module = button.data('module')
        var ldap = button.data('ldap')
        console.log(module);
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

        var modal = $(this)
        modal.find('.modal-body #input-id').val(id)
        modal.find('.modal-body #input-username').val(username)
        modal.find('.modal-body #input-description').val(description)
        modal.find('.modal-body #input-role').val(role).change()
        modal.find('.modal-body #input-active').val(active)
        modal.find('.modal-body #input-active-reason').val(active_reason)
        modal.find('.modal-body #input-module').val('')
        if (module=='all'){
            modal.find(".modal-body #input-module option").prop("selected", true);
            $(".modal-body #input-module").attr("size",$(".modal-body #input-module option").length);
        }else{
            $.each(module.split(","), function(i,e){
                //$("#strings option[value='" + e + "']").prop("selected", true);
                modal.find(".modal-body #input-module option[value='" + e + "']").prop("selected", true);
                $(".modal-body #input-module").attr("size",$(".modal-body #input-module option").length);
            });
        }
        modal.find('.modal-body #input-ldap').val(ldap)
    });

    $(function() {
    $("#btn").click(function() {
        var data = {
        "job_status": "Active"
        };
        $('.statusclass').val(data.job_status);
    });
    });
</script>
@endpush
