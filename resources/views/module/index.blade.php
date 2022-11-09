@extends('layout')

@section('body')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    {{-- breadcrumb --}}
                    <div class="col-md-8">
                        <h4 class="page-title mb-0">Modules</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">SCMT UI</a></li>
                            <li class="breadcrumb-item"><a href="#">User Management</a></li>
                            <li class="breadcrumb-item active" aria-current="page">List User</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('module.modal.alert')
    <div class="row">
        <div class="col-lg-12">
            <button class="btn btn-primary mb-2" type="button" data-toggle="modal" data-target="#modalAddModule"
                data-whatever="@getbootstrap">Add Module</button>
            <div class="card">
                <div class="card-body" style="overflow:scroll">

                    <table class="datatable table table-bordered table-condensed table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Module Name</th>
                                <th>Created at</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($modules as $module)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>
                                    <strong>{{ $module->title }}</strong> <br />
                                    @foreach ($module->submodules as $submodule)
                                        <ul class="ml-n2">
                                            <li class="mt-n1 mb-n1">{{ $submodule->subtitle }}</li>
                                        </ul>
                                    @endforeach
                                </td>
                                <td>{{ $module->created_at }}</td>
                                <td align="center">

                                    <a href="{{ route('module.destroy', $module->id) }}" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#deleteModal"><i class="dripicons-tag-delete"></i></a>

                                    <button data-toggle="modal" data-target="#modalEditModule" data-id="{{ $module->id }}" data-title="{{ $module->title }}" class="btn btn-warning btn-sm"><i class="dripicons-document-edit"></i></button>

                                    <a href="{{ route('module.show', $module->id) }}" class="btn btn-success btn-sm"><i class="dripicons-preview"></i></a>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('module.modal.create')

    @include('module.modal.delete')

    @include('module.modal.edit-module')

</div>
@endsection

@push('scripts')
<script>
    $(document).ready(() => {
        $('.datatable').DataTable();
    });

    $('#deleteModal').on('show.bs.modal', function (e) {
        $('#delete-form').attr('action', e.relatedTarget.getAttribute('href'));
        console.log(e.getAttribute);
    });

    $('#modalEditModule').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id')
        var title = button.data('title')

        var modal = $(this)
        modal.find('.modal-body #input-id').val(id)
        modal.find('.modal-body #input-title').val(title)
    });

</script>
@endpush
