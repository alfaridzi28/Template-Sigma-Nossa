@extends('layout')

@section('body')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    {{-- breadcrumb --}}
                    <div class="col-md-8">
                        <h4 class="page-title mb-0">Capacity</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">SCMT UI</a></li>
                            <li class="breadcrumb-item"><a href="#">User Management</a></li>
                            <li class="breadcrumb-item active" aria-current="page">List Capacity</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include(' capacity.modal.alert') <div class="row">
        <div class="col-lg-12">
            <button class="btn btn-primary mb-2" type="button" data-toggle="modal" data-target="#Modal">Add Capacity</button>
            <div class="card">
                <div class="card-body" style="overflow:scroll">

                    <table id="datatable" class="datatable table table-bordered table-condensed table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Node</th>
                                <th>Port</th>
                                <th>Ruas</th>
                                <th>Nbr</th>
                                <th>Capacity</th>
                                <th>Label</th>
                                <th>Regional</th>
                                <th>Link</th>
                                <th>Reporting</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('capacity.modal.create')

    @include('capacity.modal.delete')

    @include('capacity.modal.edit-capacity')

</div>
@endsection

@push('scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        order: [
            [0, 'asc']
        ],
        ajax: {
            'url': "{{route ('capacity.index')}}"
        },
        columns: [{
                "data": null,
                "class": "align-top",
                "orderable": false,
                "searchable": false,
                "render": function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                data: 'node',
                name: 'node'
            },
            {
                data: 'port',
                name: 'port'
            },
            {
                data: 'ruas',
                name: 'ruas'
            },
            {
                data: 'nbr',
                name: 'nbr'
            },
            {
                data: 'capacity',
                name: 'capacity',
                render: $.fn.dataTable.render.number(',', '.', '')
            },
            {
                data: 'label',
                name: 'label'
            },
            {
                data: 'regional',
                name: 'regional'
            },
            {
                data: 'link',
                name: 'link'
            },
            {
                "title": "reporting",
                "data": "reporting",
                "tooltip": "Active",
                render: function(data, type, row) {
                    if (type === 'display') { //if column data is 1 then set attr to checked, use row id as input id (plus prefix)
                        return '<input type="checkbox" ' + ((data == 1) ? 'checked' : '') + ' class="filter-ck1" data-id="' + row.id + '" />';
                    }
                    return data;
                },
                "className": "dt-body-center"
            },
            {
                "title": "status",
                "data": "stat",
                "tooltip": "Active",
                render: function(data, type, row) {
                    if (type === 'display') { //if column data is 1 then set attr to checked, use row id as input id (plus prefix)
                        return '<input type="checkbox" ' + ((data == 1) ? 'checked' : '') + ' class="filter-ck2" data-id="' + row.id + '" />';
                    }
                    return data;
                },
                "className": "dt-body-center"
            },
            {
                orderable: false,
                searchable: false,
                sortable: false,
                data: 'aksi'
            }
        ],
    });

    $(function() {

        $('#datatable').on('click', '.filter-ck1', function() {
            var reporting = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "{{route ('capacity.report')}}",
                data: {
                    'reporting': reporting,
                    "id": id,
                },
                success: function(data) {
                    console.log(data.success)
                }
            });
        });
    })

    $(function() {

        $('#datatable').on('click', '.filter-ck2', function() {
            var stat = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "{{route ('capacity.status')}}",
                data: {
                    'stat': stat,
                    "id": id,
                },
                success: function(data) {
                    console.log(data.success)
                }
            });
        });
    })


    $('#deleteModal').on('show.bs.modal', function(e) {
        $('#delete-form').attr('action', e.relatedTarget.getAttribute('href'));
        console.log(e.getAttribute);
    });

    $('body').on('click', '.editCapacity', function() {
        var id = $(this).data('id');
        $.get("{{ route('capacity.index') }}" + '/' + id + '/edit', function(data) {
            console.log(data);
            $('#editBtn').val("edit-user");
            $('#modalEditCapacity').modal('show');
            $('#id').val(data.id);
            $('#node').val(data.node);
            $('#port').val(data.port);
            $('#ruas').val(data.ruas);
            $('#nbr').val(data.nbr);
            $('#capacity').val(data.capacity);
            $('#label').val(data.label);
            $('#regional').val(data.regional);
            $('#link').val(data.link);
        })
    });
</script>
@endpush