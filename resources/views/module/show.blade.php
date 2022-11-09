@extends('layout')

@section('body')
<div class="container-fluid">

    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    {{-- breadcrumb --}}
                    <div class="col-md-8">
                        <h4 class="page-title mb-0">{{ $module->title }}</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">SCMT UI</a></li>
                            <li class="breadcrumb-item"><a href="#">User Management</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create Sub Module inside <span
                                    class="text-bold">{{ $module->title }}</span></li>
                        </ol>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                @include('module.modal.alert')

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body" style="overflow:scroll">

                                <a href="{{ $module->id}}" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modalAddSubmodule"
                                data-whatever="@getbootstrap">Add Submodule</a>

                                <table class="datatable table table-bordered table-condensed table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Submodule</th>
                                            <th>Url</th>
                                            <th>Created at</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($module->submodules as $submodule)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>
                                                <strong>{{ $submodule->subtitle }}</strong> <br />
                                            </td>
                                            <td>{{ $submodule->url }}</td>
                                            <td>{{ $submodule->created_at->diffForHumans() }}</td>
                                            <td align="center">
                                                <a href="{{ route('submodule.destroy', $submodule->id)}}"
                                                    class="btn btn-primary btn-sm" data-toggle="modal"
                                                    data-target="#deleteModal"><i class="dripicons-tag-delete"></i></a>

                                                <button class="btn btn-sm btn-warning" class="btn btn-success" data-toggle="modal" data-target="#modalEditSubmodule" data-id="{{ $submodule->id }}" data-subtitle="{{ $submodule->subtitle }}" data-url="{{ $submodule->url }}" ><i class="dripicons-document-edit"></i></button>

                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('submodule.modal.create')
    @include('module.modal.delete')
    @include('submodule.modal.edit-submodule')

</div>

@endsection

@push('scripts')
<script>
    $(document).ready(() => {
        $('.datatable').DataTable();
    });

    $('#deleteModal').on('show.bs.modal', function (e) {
        $('#delete-form').attr('action', e.relatedTarget.getAttribute('href'));
    });

    $('#modalAddSubmodule').on('show.bs.modal', function (e) {
        $('#id-submodule').attr('action', e.relatedTarget.getAttribute('href'));
        console.log(e.relatedTarget.getAttribute('href'));
    });

    $('#modalEditSubmodule').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id')
        var subtitle = button.data('subtitle')
        var url = button.data('url')

        var modal = $(this)
        modal.find('.modal-body #input-id').val(id)
        modal.find('.modal-body #input-subtitle').val(subtitle)
        modal.find('.modal-body #input-url').val(url)
    });

</script>
@endpush
