@extends('template.template')

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
                            <li class="breadcrumb-item active" aria-current="page">List Regional & Witel</li>
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
                            <select name="filter_regional" id="filter_regional" class=" form-control filter">
                                <option value="">Choose Regional</option>
                                @foreach($regional as $region)
                                <option value="{{$region->regional}}">{{$region->regional}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <select name="filter_witel" id="filter_witel" class="form-control filter">
                                <option value="">Choose Witel</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <select name="filter_rating" id="filter_rating" class="form-control filter">
                                <option value="">Choose Rating</option>
                                <option value="Bad">Bad</option>
                                <option value="Poor">Poor</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="row">
            <div id="charregional" style="width:90%; margin: 0 auto">
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

    let regionall = $('#filter_regional').val(),
        witell = $('#filter_witel').val(),
        rating = $('#filter_rating').val()

    var dataTable = $("#profillingbcp").DataTable({
        ajax: {
            url: "{{route ('profillingbcp.index')}}",
            data: function(d) {
                d.regionall = regionall;
                d.witell = witell;
                d.rating = rating;
                return d
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

    $('#filter_regional').on('change', function() {
        var regional = $(this).val();
        $("#filter_witel").html('');
        $.ajax({
            type: 'POST',
            url: "{{route ('profillingbcp.findwitel')}}",
            data: {
                'regional': regional
            },
            dataType: 'json',
            success: function(result) { // Jika berhasil
                $('#filter_witel').html(
                    '<option value="">Choose Witel</option>'); // Berikan hasil ke witel
                $.each(result.regional, function(key, value) {
                    $("#filter_witel").append('<option value="' + value
                        .witel + '">' + value.witel + '</option>');
                });
            }
        });
    });

    $('.filter').on('change', function() {
        regionall = $('#filter_regional').val()
        witell = $('#filter_witel').val()
        rating = $('#filter_rating').val()

        dataTable.ajax.reload(null, false)
    });

    var reg = <?php echo json_encode($reg) ?>;
    var bad = <?php echo json_encode($bad) ?>;
    var poor = <?php echo json_encode($poor) ?>;

    Highcharts.chart('charregional', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Chart Regional'
        },
        xAxis: {
            categories: reg
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: 'Amount'
            }
        },
        series: [{
                name: 'Bad',
                data: bad
            },
            {
                name: 'Poor',
                data: poor
            },
            // {
            //     name: 'Poor',
            //     data: dataRegPoor
            // }
        ]
    });
});
</script>
@endpush