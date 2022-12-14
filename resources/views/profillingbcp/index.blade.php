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
                            <li class="breadcrumb-item active" aria-current="page">List Regional & Witel</li> -->
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
                    <div class="row">
                        <div class="col-4">
                            <select name="filter_regional" id="filter_regional" class=" form-control filter-select">
                                <option value="">Choose Regional</option>
                                @foreach($regional as $region)
                                <option value="{{$region->regional}}">{{$region->regional}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <select name="filter_witel" id="filter_witel" class="form-control filter-select">
                                <option value="">Choose Witel</option>
                                @foreach($witel as $wtl)
                                <option value="{{$wtl->witel}}">{{$wtl->witel}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <button type="button" id=filter class="btn btn-info">Filter</button>
                                <button type="button" id=reset class="btn btn-primary">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table id="profillingbcp"
                        class="datatable table table-bordered text-center table-condensed table-hover table-striped"
                        style="width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Regional</th>
                                <th>Witel</th>
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
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {

    fill_datatable();

    function fill_datatable(filter_regional = '', filter_witel = '') {
        var dataTable = $("#profillingbcp").DataTable({
            ajax: {
                url: "{{route ('profillingbcp.index')}}",
                data: {
                    filter_regional: filter_regional,
                    filter_witel: filter_witel,
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
                    data: 'regional',
                    name: 'regional'
                },
                {
                    data: 'witel',
                    name: 'witel'
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
    }

    $('#filter').click(function() {
        var filter_regional = $('#filter_regional').val();
        var filter_witel = $('#filter_witel').val();

        if (filter_regional != '' && filter_regional != '') {
            $('#profillingbcp').DataTable().destroy();
            fill_datatable(filter_regional, filter_witel);
        } else {
            alert('Select Both filter option');
        }
    });

    $('#reset').click(function() {
        $('#filter_regional').val();
        $('#filter_witel').val();

        $('#profillingbcp').DataTable().destroy();
        fill_datatable();
    });

});
</script>
@endpush