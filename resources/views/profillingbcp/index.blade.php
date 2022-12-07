@extends('layout')

@section('body')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    {{-- breadcrumb --}}
                    <div class="col-md-8">
                        <h4 class="page-title mb-0">Profilling BCP</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('user.landing')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">List Profilling BCP</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- @include(' capacity.modal.alert') -->
    <div class="row">
        <div class="col-lg-12">
            <!-- <button class="btn btn-primary mb-2" type="button" data-toggle="modal" data-target="#Modal">Add
                Capacity</button> -->
            <div class="card">
                <div class="card-body">

                    <table id="datatable"
                        class="datatable table table-bordered text-center table-condensed table-hover table-striped"
                        style="width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Calingstation ID</th>
                                <th>Cl ID</th>
                                <th>Nas Node ID</th>
                                <th>User ID</th>
                                <th>Onu SN</th>
                                <th>DP Latency</th>
                                <th>DP Plos</th>
                                <th>DP SA</th>
                                <th>DP SS</th>
                                <th>NE Access Temperature Value</th>
                                <th>NE Access CPU Value</th>
                                <th>NE Access Memory Value</th>
                                <th>NE Access Occupancy Value</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <!-- <button class="btn btn-primary mb-2" type="button" data-toggle="modal" data-target="#Modal">Add
                Capacity</button> -->
            <div class="card">
                <div class="card-body">

                    <table id="datatable1"
                        class="datatable table table-bordered text-center table-condensed table-hover table-striped"
                        style="width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>DS</th>
                                <th>Cl ID</th>
                                <th>Nas Node ID</th>
                                <th>Onu SN</th>
                                <th>Count</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

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
    scrollY: true,
    scrollX: true,
    scrollCollapse: true,
    deferRender: true,
    processing: true,
    serverSide: true,
    order: [
        [0, 'asc']
    ],
    ajax: {
        'url': "{{route ('profillingbcp.index')}}"
    },
    columns: [{
            "data": null,
            "orderable": false,
            "searchable": false,
            "render": function(data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            data: 'callingstation_id',
            name: 'callingstation_id'
        },
        {
            data: 'clid',
            name: 'clid'
        },
        {
            data: 'nas_node_id',
            name: 'nas_node_id'
        },
        {
            data: 'user_id',
            name: 'user_id'
        },
        {
            data: 'onu_sn',
            name: 'onu_sn',
        },
        {
            data: 'dp_latency',
            name: 'dp_latency'
        },
        {
            data: 'dp_ploss',
            name: 'dp_ploss'
        },
        {
            data: 'dp_sa',
            name: 'dp_sa'
        },
        {
            data: 'dp_ss',
            name: 'dp_ss'
        },
        {
            data: 'ne_access_temperature_value',
            name: 'ne_access_temperature_value'
        },
        {
            data: 'ne_access_cpu_value',
            name: 'ne_access_cpu_value'
        },
        {
            data: 'ne_access_memory_value',
            name: 'ne_access_memory_value'
        },
        {
            data: 'ne_access_occupancy_value',
            name: 'ne_access_occupancy_value'
        },
    ],
});

$('#datatable1').DataTable({
    scrollY: true,
    scrollX: true,
    scrollCollapse: true,
    deferRender: true,
    processing: true,
    serverSide: true,
    order: [
        [0, 'asc']
    ],
    ajax: {
        'url': "{{route ('profillingbcp.count')}}"
    },
    columns: [{
            "data": null,
            "orderable": false,
            "searchable": false,
            "render": function(data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            data: 'ds',
            name: 'ds'
        },
        {
            data: 'clid',
            name: 'clid'
        },
        {
            data: 'nas_node_id',
            name: 'nas_node_id'
        },
        {
            data: 'onu_sn',
            name: 'onu_sn'
        },
        {
            data: 'count',
            name: 'count'
        }
    ],
});
</script>
@endpush