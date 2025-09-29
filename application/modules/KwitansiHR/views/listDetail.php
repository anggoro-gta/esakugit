
<section class="content_section">
    <div class="content_spacer">
        <div class="content">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well">
                        <div class="pull-right">
                            <a href="<?=base_url()?>KwitansiHR/create" class="btn btn-sm btn-success" title="Tambah"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
                            <!-- <a class="btn btn-xs btn-warning" href="<?=base_url()?>KwitansiHR/updateRekap" title="Update Rekap"><i class="glyphicon glyphicon-share-alt"></i> Buat Rekap</a> -->
                            <?php //if($this->session->userdata("level")==1){ ?>
                                <!-- <a class="btn btn-xs btn-danger" href="<?=base_url()?>KwitansiHR/deleteRekap" title="Hapus Rekap"><i class="glyphicon glyphicon-trash"></i> Hapus Rekap</a> -->
                            <?php //} ?>
                            <!-- <a class="btn btn-xs btn-default" id="cetak_rekap" style="background-color: purple" title="Cetak Rekap"><i class="glyphicon glyphicon-file"></i> Cetak Rekap</a> -->
                        </div>
                    </div>
                    <div class="box-content">  
                        <div class="table-responsive">                     
                            <table class="table table-bordered table-striped" id="example2" style="font-size: 85%">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;" width="3%">No</th>
                                        <th style="text-align: center;">Bl. SPJ</th>
                                        <!-- <th style="text-align: center;">No. TBP</th> -->
                                        <th style="text-align: center;">Bagian</th>
                                        <th style="text-align: center;">Kegiatan</th>
                                        <th style="text-align: center;">Sub Kegiatan</th>
                                        <th style="text-align: center;">Belanja</th>
                                        <th style="text-align: center;">Kategori</th>
                                        <th style="text-align: center;">Tgl Kwitansi</th>
                                        <th style="text-align: center;">Perihal</th>
                                        <!-- <th style="text-align: center;">HR bulan</th> -->
                                        <th style="text-align: center">Banyaknya Uang</th>
                                        <th style="text-align: center;">Cetak</th>
                                        <th style="text-align: center;">Aksi</th>
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

<div class="modal fade slide-up disable-scroll" id="modal_rekap" role="dialog" aria-hidden="false">  
    <div class="modal-dialog" style="width: 35%;padding: 0px">
        <div class="modal-content">
            <form method="post" action="<?=base_url("KwitansiHR/cetakRekap")?>" target="_blank" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                  <h5><b>CETAK REKAP</b></h5>
                </div>
                <div class="modal-body">
                    <div class="form-group required">
                        <label class="col-md-3 control-label">Bl. SPJ</label>
                        <div class="col-md-5">
                            <select class="form-control chosen" name="spj_bulan" style="width: 100%" id="spj_bulan" required>
                                <option value="">Pilih</option>
                                <?php foreach($arrBulan as $key => $bl): ?>
                                    <option value="<?=$key?>"><?=$bl?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>   
                    </div>
                    <?php if($this->session->userdata("level")==1){ ?>
                        <div class="form-group required">  
                            <label class="col-md-3 control-label">Bagian</label>
                            <div class="col-md-8">
                                <select class="form-control chosen" name="fk_bagian_id" id="fk_bagian_id_rkp" >
                                    <option value="">Pilih</option>
                                    <?php foreach ($arrMsBagian as $bid) { ?>
                                        <option value="<?=$bid['id']?>"><?=$bid['nama_bagian']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    <?php }else{ ?>
                        <input type="hidden" name="fk_bagian_id" id="fk_bagian_id_rkp" value="<?=$this->session->userdata("fk_bagian_id")?>">
                    <?php }?>
                    <div class="form-group required">      
                        <label class="col-md-3 control-label">Sub Kegiatan</label>
                        <div class="col-md-8">
                            <select class="form-control chosen" name="fk_kegiatan_id" id="fk_kegiatan_id_rkp" >
                                <option value="">Pilih</option>
                            </select>
                        </div>
                    </div> 
                    <div class="form-group required">      
                        <label class="col-md-3 control-label">Belanja</label>
                        <div class="col-md-8">
                            <select class="form-control chosen" name="fk_rekening_belanja_id" id="fk_rekening_belanja_id_rkp" >
                                <option value="">Pilih</option>
                            </select>
                        </div>
                    </div> 
                    <div class="form-group required">      
                        <label class="col-md-3 control-label">No. TBP</label>
                        <div class="col-md-8">
                            <select class="form-control chosen" name="id_rekap_dana" id="id_rekap_dana_rkp" >
                                <option value="">Pilih</option>
                            </select>
                        </div>
                    </div> 
                    <div class="form-group required">      
                        <label class="col-md-3 control-label">Tgl Lunas Dibayar</label>
                        <div class="col-md-8">
                            <input type="text" name="tgl_rekap" id="tgl_rekap" class="form-control tanggal text-center" autocomplete="off" required>
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">
                    <button class="btn btn-md btn-default pull-left inline" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-md btn-success pull-left inline" >Cetak</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade slide-up disable-scroll" id="modal_dh_narsum" role="dialog" aria-hidden="false">  
    <div class="modal-dialog" style="width: 35%;padding: 0px">
        <div class="modal-content">
            <form method="post" action="<?=base_url("KwitansiHR/cetakDHNarsum")?>" target="_blank" enctype="multipart/form-data" class="form-horizontal" autocomplete='off'>
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                  <h5><b>Cetak Daftar Hadir Narsum</b></h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group required">      
                            <label class="col-md-3 control-label">Jml Baris</label>
                            <div class="col-md-3">
                                <input type="number" name="jml_baris" class="form-control text-center angka" required></input>
                            </div>
                        </div>
                        <input name="id_kwi" id="id_kwi" type="hidden">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-md btn-default pull-left inline" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-md btn-success pull-left inline" >Cetak</button>
                </div>
            </form>
        </div>
    </div>
</div>
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
                <input type="hidden" name="formnya" value="KwitansiHR">
                <div class="modal-footer">
                    <button class="btn btn-md btn-default pull-left inline" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-md btn-success pull-left inline" >Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<input type="hidden" id="level" value="<?=$this->session->userdata("level")?>">
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
        ajax: {"url": "<?= base_url()?>KwitansiHR/getDatatables", "type": "POST", "data": {
                "bulan": "<?=$bulan?>","fk_bagian_id": "<?=$fk_bagian_id?>","fk_program_id": "<?=$fk_program_id?>","fk_kegiatan_id": "<?=$fk_kegiatan_id?>"}
        },
        columns: [
            {
                "data": "id",
                "orderable": false,
                "className" : "text-center"
            },
            {
                "data": "spj_bulan",
                "orderable": false,
                "searchable": false,
                render : function ( data, type, row ){ 
                    bln=''
                    if(data!=null){
                        if(data=='01'){
                            bln = 'Januari';
                        }else if(data=='02'){
                            bln = 'Februari';
                        }else if(data=='03'){
                            bln = 'Maret';
                        }else if(data=='04'){
                            bln = 'April';
                        }else if(data=='05'){
                            bln = 'Mei';
                        }else if(data=='06'){
                            bln = 'Juni';
                        }else if(data=='07'){
                            bln = 'Juli';
                        }else if(data=='08'){
                            bln = 'Agustus';
                        }else if(data=='09'){
                            bln = 'September';
                        }else if(data=='10'){
                            bln = 'Oktober';
                        }else if(data=='11'){
                            bln = 'November';
                        }else{
                            bln = 'Desember';
                        }
                    }
                    return bln;
                },
            },
            // {
            //     "data": "info_no_bku",
            //     "orderable": false,
            //     "className" : "text-center"
            // },
            {  "data": "singkatan_bagian",
               "orderable": false,
            },
            {  "data": "nama_program",
               "orderable": false,
            },
            {  "data": "kegiatan",
               "orderable": false,
            },
            {
                "data": "nama_rek_belanja",
                "orderable": false,
                "className" : "text-center"
            },
            {
                "data": "kategori",
                "orderable": false,
                "className" : "text-center"
            },
            {
                "data": "tgl_kwitansi",
                "orderable": false,
                "className" : "text-center"
            },
            {  "data": "untuk_pembayaran",
               "orderable": false,
            },
            // {
            //     "data": "hr_bulan",
            //     "orderable": false,
            //     "searchable": false,
            //     render : function ( data, type, row ){ 
            //         bln=''
            //         if(data!=null){
            //             if(data=='01'){
            //                 bln = 'Januari';
            //             }else if(data=='02'){
            //                 bln = 'Februari';
            //             }else if(data=='03'){
            //                 bln = 'Maret';
            //             }else if(data=='04'){
            //                 bln = 'April';
            //             }else if(data=='05'){
            //                 bln = 'Mei';
            //             }else if(data=='06'){
            //                 bln = 'Juni';
            //             }else if(data=='07'){
            //                 bln = 'Juli';
            //             }else if(data=='08'){
            //                 bln = 'Agustus';
            //             }else if(data=='09'){
            //                 bln = 'September';
            //             }else if(data=='10'){
            //                 bln = 'Oktober';
            //             }else if(data=='11'){
            //                 bln = 'November';
            //             }else if(data=='12'){
            //                 bln = 'Desember';
            //             }
            //         }
            //         return bln;
            //     },
            // },
            {  "data": "nominal_bruto",
               "orderable": false,
                "className" : "text-center",
                "searchable": false,
            },
            {"data": "id",
                render : function ( data, type, row ){ 
                    aksi = '<div class="btn-group" style="width:70px">';
                    aksi += '<a href="<?=base_url()?>KwitansiHR/cetakKwi/'+data+'" target="_blank"  title="Cetak Kwitansi">1. Kwi</a>'; 
                    if(row.kategori=='KONTRAK'){
                        aksi += ' <br> <a onclick="detailDH('+data+')"  title="Cetak Daftar Hadir">2. Dftr Hadir</a>';
                    }                  
                    aksi += '</div>';
                    return aksi ;
                },
                "orderable": false,
                "searchable": false,
                // "className" : "text-center"
            },
            {"data": "id",
                render : function ( data, type, row ){ 
                    aksi = '<div class="btn-group" style="width:70px">';
                    if(row.is_spj=='0'){
                        aksi += '<a class="btn btn-xs btn-danger" href="<?=base_url()?>KwitansiHR/delete/'+data+'"><i class="glyphicon glyphicon-trash icon-white" title="Hapus" onclick="return confirmDelete()"></i></a>';
                        aksi += '<a class="btn btn-xs btn-success" href="<?=base_url()?>KwitansiHR/update/'+data+'"><i class="glyphicon glyphicon-edit icon-white" title="Update"></i></a>';  
                    }
                    // if(row.is_spj=='1' && $("#level").val()==1){
                    //      aksi += '<a class="btn btn-xs" style="background-color: blue; color:white" onclick="Update_bku('+row.fk_rekap_dana_id+')"><i class="glyphicon glyphicon-ok icon-white" title="Update TBP"></i></a>';
                    // }                   
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


$("#cetak_rekap").click(function(){
    $("#modal_rekap").modal("show");  
});

$("#spj_bulan").change(function(){
    cari_keg();
});

$("#fk_bagian_id_rkp").change(function(){
    cari_keg();
});

tabel='t_kwitansi_hr';
function cari_keg(){
    bulan = $("#spj_bulan").val();
    fk_bagian_id = $("#fk_bagian_id_rkp").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'KwitansiHR/getKegiatanRekapDel'?>",
        data: {tabel,bulan,fk_bagian_id},
        success: function(msg){
            $('#fk_kegiatan_id_rkp').html(msg.nama_keg);
            $('#fk_kegiatan_id_rkp').trigger("chosen:updated");
        }
    });     
}

$("#fk_kegiatan_id_rkp").change(function(){
    fk_kegiatan_id = $(this).val();
    bulan = $("#spj_bulan").val();

    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'KwitansiHR/getCariRekeningBelanjaDel'?>",
        data: {tabel,fk_kegiatan_id,bulan},
        success: function(msg){
            $('#fk_rekening_belanja_id_rkp').html(msg.nama_rek);
            $('#fk_rekening_belanja_id_rkp').trigger("chosen:updated");
        }
    });   

});

$("#fk_rekening_belanja_id_rkp").change(function(){
    id_rek = $(this).val();
    bulan = $("#spj_bulan").val();
    fk_kegiatan_id = $("#fk_kegiatan_id_rkp").val();
    
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'KwitansiHR/getCariBKU'?>",
        data: {id_rek,bulan,fk_kegiatan_id},
        success: function(msg){
            $('#id_rekap_dana_rkp').html(msg.bku);
            $('#id_rekap_dana_rkp').trigger("chosen:updated");
        }
    });   
});

function detailDH(id){
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'KwitansiHR/cekKategori'?>",
        data: {id},
        success: function(msg){
            if(msg.kategori=='KONTRAK'){
                window.open("<?= base_url()?>KwitansiHR/cetakDHKontrak?id="+id);
            }else{
                $('#id_kwi').val(id);                
                $("#modal_dh_narsum").modal("show");
            }
        }
    });
}
function Update_bku(id){
    $("#id_rekap_dananya").val(id);
    $("#modal_update_bku").modal("show");  
}
</script>