
<section class="content_section">
    <div class="content_spacer">
        <div class="content">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well">
                        <div class="pull-right">
                            <a href="<?=base_url()?>Pencairan/create" class="btn btn-xs btn-success" title="Buat SPP"><i class="glyphicon glyphicon-plus"></i> Buat SPP</a>
                        </div>
                    </div>
                    <div class="box-content">  
                        <div class="table-responsive">                     
                            <table class="table table-bordered table-striped" id="example2" style="font-size: 80%">
                                <thead>
                                    <tr>
                                        <th rowspan="2" style="text-align: center;vertical-align: middle; " width="3%">No</th>
                                        <th rowspan="2" style="text-align: center;vertical-align: middle; ">Tgl Pencairan</th>
                                        <th rowspan="2" style="text-align: center;vertical-align: middle; ">Jenis Anggaran</th>
                                        <th rowspan="2" style="text-align: center;vertical-align: middle; ">Bagian</th>
                                        <th colspan="2" style="text-align: center;vertical-align: middle; ">Cetak</th>
                                        <th rowspan="2" style="text-align: center;vertical-align: middle; ">Aksi</th>
                                    </tr>
                                    <tr>
                                        <th style="text-align: center">SPP</th>
                                        <th style="text-align: center">TNT</th>
                                    </tr>
                                </thead>                   
                            </table>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>
<input type="hidden" id="level" value="<?=$this->session->userdata("level")?>">

<div class="modal fade slide-up disable-scroll" id="modal_update_bku" role="dialog" aria-hidden="false">  
    <div class="modal-dialog" style="width: 35%;padding: 0px">
        <div class="modal-content">
            <form method="post" action="<?=base_url("KwitansiHR/updateBKU")?>" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                  <h5><b>UPDATE TBP</b></h5>
                </div>
                <div class="modal-body">
                    <div class="form-group required">      
                        <label class="col-md-3 control-label">No. TBP</label>
                        <div class="col-md-5">
                            <input type="text" name="no_bku" id="no_bku" class="form-control text-center" autocomplete="off" required>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id_rekap_dana" id="id_rekap_dananya">
                <input type="hidden" name="formnya" value="Rekap">
                <div class="modal-footer">
                    <button class="btn btn-md btn-default pull-left inline" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-md btn-success pull-left inline" >Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $( ".tanggal" ).datepicker();
    var t = $("#example2").dataTable({
        "lengthMenu": [[10, 25, 50, 100, 500, -1], [10, 25, 50, 100, 500, "All"]],
        initComplete: function() {
            var api = this.api();
            $('#mytable_filter input')
                    .off('.DT')
                    .on('keyup.DT', function(e) {
                        if (e.keyCode == 13) {
                            api.search(this.value).draw();
                }
            });
        },
        'oLanguage':
        {
            "sProcessing":   "Sedang memproses...",
            "sLengthMenu":   "Tampilkan _MENU_ entri",
            "sZeroRecords":  "Tidak ditemukan data yang sesuai",
            "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
            "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
            "sInfoPostFix":  "",
            "sSearch":       "Cari:",
            "sUrl":          "",
            "oPaginate": {
                "sFirst":    "Pertama",
                "sPrevious": "Sebelumnya",
                "sNext":     "Selanjutnya",
                "sLast":     "Terakhir"
            }
        },
        processing: true,
        serverSide: true,
        ajax: {"url": "<?= base_url()?>Pencairan/getDatatables", "type": "POST", "data": {
                "bulan": "<?=$bulan?>","fk_bagian_id": "<?=$fk_bagian_id?>","fk_program_id": "<?=$fk_program_id?>","fk_kegiatan_id": "<?=$fk_kegiatan_id?>"}
        },
        columns: [
            {
                "data": "id",
                "orderable": false,
                "className" : "text-center"
            },
            {
                "data": "tgl_pencairan",
                "orderable": false,
                "className" : "text-center"
            },
            {
                "data": "jenis_anggaran",
                "orderable": false,
                "className" : "text-center"
            },
            {
                "data": "singkatan_bagian",
                "orderable": false,
                "className" : "text-center"
            },
            {
                "data": "id",
                "orderable": false,
                "searchable": false,
                "className" : "text-center",
                render : function (data, type, row) {
                    hsl = '';
                    hsl += '<a href="<?=base_url()?>Pencairan/cetakSPP/'+data+'" target="_blank"  title="Cetak SPP">Cetak</a>';

                    return hsl;
               },
            },
            {
                "data": "id",
                "orderable": false,
                "searchable": false,
                "className" : "text-center",
                render : function (data, type, row) {
                    hsl = '';
                    hsl += '<a href="<?=base_url()?>Pencairan/cetakTNT/'+data+'" target="_blank"  title="Cetak TNT">PDF</a>';
                    hsl += ' | <a href="<?=base_url()?>Pencairan/cetakTNTExcel/'+data+'" title="Cetak TNT">Excel</a>';

                    return hsl;
               },
            },
            {"data": "id",
                render : function ( data, type, row ){ 
                    aksi = '<div class="">';
                    
                    if(row.status_update_tbp==0){
                        aksi += '<a class="btn btn-xs btn-danger" href="<?=base_url()?>Pencairan/delete/'+data+'"><i class="glyphicon glyphicon-trash icon-white" title="Hapus" onclick="return confirmDelete()"></i></a>'; 
                        aksi += ' | ';
                    } 

                    if($("#level").val()==1){
                        aksi += '<a class="btn btn-xs" style="background-color: blue; color:white" href="<?=base_url()?>Pencairan/updateTBP/'+data+'"><i class="glyphicon glyphicon-ok icon-white" title="Update TBP"></i></a>';
                        if(row.status_update_tbp==1){
                            aksi += ' | ';
                            aksi += '<a class="btn btn-xs btn-warning" href="<?=base_url()?>Pencairan/deleteTBP/'+data+'"><i class="glyphicon glyphicon-remove icon-white" title="Hapus No TBP" onclick="return confirmDelete()"></i></a>';
                        }
                    }                  

                    aksi += '</div>';
                    return aksi ;
                },
                "orderable": false,
                "searchable": false,
                "className" : "text-center"
            },
        ],
        order: [[0, 'desc']],
        rowCallback: function(row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $('td:eq(0)', row).html(index);
        },
        
    });
});

function confirmDelete() {
    return confirm('Apakah anda yakin?');
};

</script>