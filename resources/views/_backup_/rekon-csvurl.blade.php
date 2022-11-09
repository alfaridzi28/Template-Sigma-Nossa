@extends('layout-rekon')

@section('body')
<div class="container-fluid">

    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    {{-- breadcrumb --}}
                    <div class="col-md-8">
                        <h4 class="page-title mb-0">View Rekon CSVURL</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">SCMT UI</a></li>
                            <li class="breadcrumb-item"><a href="#">Rekon</a></li>
                            <li class="breadcrumb-item active" aria-current="page">CSVURL</li>
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
                    <div class="alert alert-warning bg-warning text-white" role="alert" style="display:none;">
                        <strong id="error-message"></strong>
                    </div>
                </div>
                <div class="card-body table-responsive" style="overflow:scroll">

                    <table class="table table-bordered table-striped" id="tb_rekon">              
                        <thead>
                            <tr>
                              <th>No.</th>
                              <th>ID</th>
                              <th>WONUM</th>
                              <th>DOCNAME</th>
                              <th>URL</th>
                              <th>PROC_STATUS</th>
                              <th>EXECUTE_STATUS</th>
                              <th>MSG</th>
                              <th>DATE_INSERT</th>
                              <th>DATE_EXECUTE</th>
                              <th>MESSAGE</th>
                              <th>EXT_ORDER_NO</th>
                              <th>NOMOR_KB</th>
                              <th>NOMOR_KL</th>
                              <th>OBL_TRC_NO</th>
                              <th>SERVICE_ID</th>
                              <th>SUPPLIER_CODE</th>
                              <th>NAMA_MITRA</th>
                              <th>INSTALL_DATE</th>
                              <th>SITEID</th>
                              <th>LAST_UPDATE</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                        </tfoot>					    
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<div id="notifications"></div>
@endsection

@push('scripts')
    <script>
        function notifyX(titleXX,msgXX,typeXX){
                $.notify(
                        {
                                title: '<h4>'+titleXX+'</h4>',
                                message: msgXX
                        },
                        {
                                allow_dismiss: true,
                                delay: 0,
                                placement: {
                                        from: 'bottom',
                                        align: 'right'
                                },	
                                type: typeXX
                        }
                );
        
                $('.fadeInDown').click(function() {	
                        $(this).remove();
                });
                
                $('.fadeInDown').fadeOut( 10000, function() {	
                        $(this).remove();
                });
        }

        $(document).ready(() => {
            setTable();
        });
        
        function setTable(){
            
            var table = $('#tb_rekon').DataTable();
            table.destroy();
            
            table = $('#tb_rekon').DataTable({
                "scrollX": true,
                "retrieve": true,
                "fixedColumns":   {leftColumns: 3},
                "columnDefs": [
                    //{"targets": [0],"width": "1%", "searchable": false, "orderable": true, "visible": true},
                    //{"targets": [1,2],"width": "150px", "searchable": true, "orderable": true, "visible": true},
                    {"className": "dt-center","targets":"_all" },
                    {"className": "center","targets":"_all" }
                ],
                "ajax": {
                    //"data"  : '',
                    "dataType": "json",
                    "url"   : "http://10.60.163.39/service/index.php/Json/getRekonCSVURL",
                    "type"  : "POST"
                    
                },
                "columns": [
                    { "data": "Urutan" },
                    { "data": "ID" },
                    { "data": "WONUM" },
                    { "data": "DOCNAME" },
                    { "data": "URL" },
                    { "data": "PROC_STATUS" },
                    { "data": "EXECUTE_STATUS" },
                    { "data": "MSG" },
                    { "data": "DATE_INSERT" },
                    { "data": "DATE_EXECUTE" },
                    { "data": "MESSAGE" },
                    { "data": "EXT_ORDER_NO" },
                    { "data": "NOMOR_KB" },
                    { "data": "NOMOR_KL" },
                    { "data": "OBL_TRC_NO" },
                    { "data": "SERVICE_ID" },
                    { "data": "SUPPLIER_CODE" },
                    { "data": "NAMA_MITRA" },
                    { "data": "INSTALL_DATE" },
                    { "data": "SITEID" },
                    { "data": "last_update" },
                ],
               "dom" : 'lBfrtip',
                //"bPaginate": true,
                //"sPaginationType": "full_numbers",
                //"ordering"  : true,
                //"bInfo"     : false,
                //"bFilter"   : true,
                "paging"      : true,
                //"lengthChange": true,
                "searching"   : true,
                "ordering"    : true,
                "info"        : true,
                "autoWidth"   : true,
                "buttons"   : [
                    {
                        extend  : 'collection',
                        text    : 'Export',
                        buttons : [
                            'copy',
                            'excel',
                            'pdf',
                            'csv'
                        ]
                    },
                ],
            });
            
            //Notify("table refreshed", null, null, 'success');
        }
        
        function set_proc_status(id,status){
            var dataform = { 
               'id':id,
               'status': status,
            }
           
            $.ajax({
                type: 'POST',
                url: 'http://10.60.163.39/service/index.php/Json/updateRekonCSVURL',
                dataType: 'text',
                data: dataform,
                success: function(data) {
                  var hasil = jQuery.parseJSON(data);
                  console.log(hasil);
                    if (hasil.result === 'true'){
                                                  
                        //notifyX('Info','Set Status Sukses','success');
                        Notify("Set Status Sukses", null, null, 'success');
                        
                        var tablerekon = $('#tb_rekon').DataTable();
                        tablerekon.ajax.reload( null, false );
                        
                    }else{
                         //notifyX('Info','Gagal Set Status','danger');
                         Notify("Gagal Set Status", null, null, 'danger');
                         var tablerekon = $('#tb_rekon').DataTable();
                         tablerekon.ajax.reload( null, false );
                    }
                }
            });
        }
    </script>
@endpush
