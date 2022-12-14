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
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">List STO</li>
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
                    <table id="profillingsto"
                        class="datatable table table-bordered text-center table-condensed table-hover table-striped"
                        style="width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Clid</th>
                                <th>Rating</th>
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
        'X-CSRF-TOKEN': $('meta[name=" csrf-token"]').attr('content')
    }
});
$(document).ready(function() {

    var dataTable = $("#profillingsto").DataTable({
        ajax: {
            url: "{{route ('profillingbcp.gpon')}}",
            data: {
                sto: '<?php echo ($sto) ?>'
            }
        },
        order: [
            [0, 'asc'],
            [1, 'asc'],
        ],
        processing: true,
        serverSide: true,
        select: true,
        stateSave: true,

        columns: [{
                data: null,
                "sortable": false,
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                data: 'clid',
                name: 'clid'
            },
            {
                data: 'rating',
                name: 'rating'
            },
            {
                data: 'count',
                name: 'count',
                render: $.fn.dataTable.render.number(',', '.')
            },
        ],

    });

});
</script>
@endpush