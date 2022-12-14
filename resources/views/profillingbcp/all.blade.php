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
                            <!-- <li class="breadcrumb-item"><a href="{{route('user.landing')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('profillingbcp.index')}}">List Regional &
                                    Witel</a>
                            <li class="breadcrumb-item"><a href="{{url('profillingbcp-sto?witel=$witel')}}">List
                                    STO</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">List Cl Id</li>
                            </li> -->
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
                    <table id="profillingall"
                        class="datatable table table-bordered text-center table-condensed table-hover table-striped"
                        style="width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Regional</th>
                                <th>Witel</th>
                                <th>STO</th>
                                <th>Clid</th>
                                <th>Odp</th>
                                <th>Callingstation ID</th>
                                <th>Nas Node ID</th>
                                <th>User ID</th>
                                <th>Onu SN</th>
                                <th>Product Code</th>
                                <th>Speed</th>
                                <th>Dp Latency</th>
                                <th>Dp Ploss</th>
                                <th>Dp SA</th>
                                <th>Dp SS</th>
                                <th>Dp Total</th>
                                <th>Total Devices</th>
                                <th>Total Delay</th>
                                <th>Total Ploss</th>
                                <th>Session Setup</th>
                                <th>Service Access</th>
                                <th>Pcrf Status</th>
                                <th>Onu Status</th>
                                <th>Onu RX Level</th>
                                <th>Rating</th>
                                <th>Ne Access Temperature Value</th>
                                <th>Flag Temperature</th>
                                <th>Ne Access Cpu Value</th>
                                <th>FLag CPU</th>
                                <th>Ne Access Memory Value</th>
                                <th>Flag Memory</th>
                                <th>Ne Access Occupancy Value</th>
                                <th>Flag Occupancy</th>
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
        'X-CSRF-TOKEN': $('meta[name=" csrf-token"]').attr('content')
    }
});
$(document).ready(function() {

    var dataTable = $("#profillingall").DataTable({
        ajax: {
            url: "{{route ('profillingbcp.all')}}",
            data: {
                clid: '<?php echo ($clid) ?>'
            }
        },
        order: [
            [0, 'asc'],
            [1, 'asc'],
        ],
        scrollY: true,
        scrollX: true,
        processing: true,
        serverSide: true,
        select: true,
        stateSave: true,

        columns: [{
                "data": null,
                "orderable": false,
                "searchable": false,
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                data: 'dt',
                name: 'dt'
            },
            {
                data: 'regional',
                name: 'regional'
            },
            {
                data: 'witel',
                name: 'witel'
            },
            {
                data: 'sto',
                name: 'sto',
            },
            {
                data: 'clid',
                name: 'clid',
            },
            {
                data: 'odp',
                name: 'odp',
            },
            {
                data: 'callingstation_id',
                name: 'callingstation_id',
            },
            {
                data: 'nas_node_id',
                name: 'nas_node_id',
            },
            {
                data: 'user_id',
                name: 'user_id',
            },
            {
                data: 'onu_sn',
                name: 'onu_sn',
            },
            {
                data: 'product_code',
                name: 'product_code',
            },
            {
                data: 'speed',
                name: 'speed',
            },
            {
                data: 'dp_latency',
                name: 'dp_latency',
            },
            {
                data: 'dp_ploss',
                name: 'dp_ploss',
            },
            {
                data: 'dp_sa',
                name: 'dp_sa',
            },
            {
                data: 'dp_ss',
                name: 'dp_ss',
            },
            {
                data: 'dp_total',
                name: 'dp_total',
            },
            {
                data: 'total_devices',
                name: 'total_devices',
            },
            {
                data: 'total_delay',
                name: 'total_delay',
            },
            {
                data: 'total_ploss',
                name: 'total_ploss',
            },
            {
                data: 'session_setup',
                name: 'session_setup',
            },
            {
                data: 'service_access',
                name: 'service_access',
            },
            {
                data: 'pcrf_status',
                name: 'pcrf_status',
            },
            {
                data: 'onu_status',
                name: 'onu_status',
            },
            {
                data: 'onu_rx_level',
                name: 'onu_rx_level',
            },
            {
                data: 'rating',
                name: 'rating',
            },
            {
                data: 'ne_access_temperature_value',
                name: 'ne_access_temperature_value',
            },
            {
                data: 'flag_temperature',
                name: 'flag_temperature',
            },
            {
                data: 'ne_access_cpu_value',
                name: 'ne_access_cpu_value',
            },
            {
                data: 'flag_cpu',
                name: 'flag_cpu',
            },
            {
                data: 'ne_access_memory_value',
                name: 'ne_access_memory_value',
            },
            {
                data: 'flag_memory',
                name: 'flag_memory',
            },
            {
                data: 'ne_access_occupancy_value',
                name: 'ne_access_occupancy_value',
            },
            {
                data: 'flag_occupancy',
                name: 'flag_occupancy',
            },
        ],

    });

});
</script>
@endpush