
<section class="content_section">
    <div class="content_spacer">
        <div class="content">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well">
                        <div class="pull-right">
                            <a href="<?=base_url()?>PesananBarang/create" class="btn btn-xs btn-success" title="Buat Kwitansi"><i class="glyphicon glyphicon-plus"></i> Buat Kwitansi</a>
                            <!-- <a class="btn btn-xs btn-warning" href="<?=base_url()?>PesananBarang/updateRekap" title="Buat Rekap"><i class="glyphicon glyphicon-share-alt"></i> Buat Rekap</a> -->
                            <?php //if($this->session->userdata("level")==1){ ?>
                                <!-- <a class="btn btn-xs btn-danger" href="<?=base_url()?>PesananBarang/deleteRekap" title="Hapus Rekap"><i class="glyphicon glyphicon-trash"></i> Hapus Rekap</a>                             -->
                            <?php //} ?>
                            <!-- <a class="btn btn-xs " id="cetak_rekap" style="background-color: purple; color: white" title="Cetak Rekap"><i class="glyphicon glyphicon-file"></i> Cetak Rekap</a> -->
                        </div>
                    </div>
                    <div class="box-content">  
                        <div class="table-responsive">                     
                            <table class="table table-bordered table-striped" id="example2" style="font-size: 85%">
                                <thead>
                                    <tr>
                                        <th width="3%">No</th>
                                        <th>Bl. SPJ</th>
                                        <th>No. TBP</th>
                                        <th>Bagian</th>
                                        <th>Kegiatan</th>
                                        <th>Sub Kegiatan</th>
                                        <th>Belanja</th>
                                        <th>Kategori</th>
                                        <th>Tgl Pesanan</th>
                                        <!-- <th>Nomor</th> -->
                                        <th>Nama Rekanan</th>
                                        <!-- <th>Nama PPTK</th> -->
                                        <!-- <th>Jml Barang</th> -->
                                        <th>Cetak</th>
                                        <th>Aksi</th>
                                        <th>Verifikasi</th>
                                        <!-- <th>Barang Keluar</th> -->
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
<div class="modal fade slide-up disable-scroll" id="modal_update_bku" role="dialog" aria-hidden="false">  
    <div class="modal-dialog" style="width: 35%;padding: 0px">
        <div class="modal-content">
            <form method="post" action="<?=base_url("PesananBarang/updateBKU")?>" enctype="multipart/form-data" class="form-horizontal">
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
                <div class="modal-footer">
                    <button class="btn btn-md btn-default pull-left inline" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-md btn-success pull-left inline" >Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade slide-up disable-scroll" id="modal_rekap" role="dialog" aria-hidden="false">  
    <div class="modal-dialog" style="width: 35%;padding: 0px">
        <div class="modal-content">
            <form method="post" action="<?=base_url("PesananBarang/cetakRekap")?>" target="_blank" enctype="multipart/form-data" class="form-horizontal">
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
        ajax: {"url": "<?= base_url()?>PesananBarang/getDatatables", "type": "POST", "data": {
                "nomor": "<?=$nomor?>","fk_rekanan_id": "<?=$fk_rekanan_id?>","fk_bagian_id": "<?=$fk_bagian_id?>","bulan": "<?=$bulan?>"}
        },
        columns: [
            {
                "data": "id",
                "orderable": false,
                "className" : "text-center"
            }, {
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
            {
                "data": "info_no_bku",
                "orderable": false,
                "className" : "text-center"
            },            
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
            {  "data": "perihal",
               "orderable": false,
            },
            {
                "data": "tgl_pesanan",
                "orderable": false,
                "className" : "text-center"
            },
            // {  "data": "nomor",
            //    "orderable": false,
            // },
            {  "data": "nama_rekanan",
               "orderable": false,
            },
            // {  "data": "nama_pejabat_pptk",
            //    "orderable": false,
            // },
            // {  "data": "total_barang",
            //    "orderable": false,
            //     "searchable": false,
            //     "className" : "text-center"
            // },
            {
                "data": "id",
                "orderable": false,
                "searchable": false,
                "className" : "text-center",
                render : function (data, type, row) {
                    hsl = '';
                    hsl += '<a href="<?=base_url()?>PesananBarang/surat_pesanan/'+data+'" target="_blank"  title="Surat Pesanan">SP</a>';
                    if(row.terima_pesanan=='1'){
                        hsl += ' | ';
                        hsl += '<a href="<?=base_url()?>PesananBarang/kwitansi/'+data+'" target="_blank"  title="Kwitansi">Kwi</a>';                     
                        hsl += ' | ';
                        hsl += '<a href="<?=base_url()?>PesananBarang/bahp/'+data+'" target="_blank"  title="BA Hasil Pemeriksaan">BAP</a>';
                        hsl += ' | ';
                        hsl += '<a href="<?=base_url()?>PesananBarang/bast/'+data+'" target="_blank"  title="BAST">BAST</a>';
                        // hsl += ' | ';
                        // hsl += '<a href="<?=base_url()?>PesananBarang/bahpab/'+data+'" target="_blank"  title="BAHPAB">BAHPAB</a>';
                        if(row.total_harga_beli >= 10000000){
                            hsl += ' | ';
                            hsl += '<a href="<?=base_url()?>PesananBarang/spl/'+data+'" target="_blank"  title="Surat Pembelian Langusung">SPL</a>';
                        }
                    }
                    
                    return hsl;
               },
            },
            {"data": "id",
                render : function ( data, type, row ){ 
                    aksi = '<div class="btn-group">';
                    if(row.is_spj=='0'){
                        aksi += '<a class="btn btn-xs btn-danger" href="<?=base_url()?>PesananBarang/delete/'+data+'"><i class="glyphicon glyphicon-trash icon-white" title="Hapus" onclick="return confirmDelete()"></i></a>';
                        aksi += '<a class="btn btn-xs btn-success" href="<?=base_url()?>PesananBarang/update/'+data+'"><i class="glyphicon glyphicon-edit icon-white" title="Update"></i></a>'; 
                    }

                    aksi += '<a class="btn btn-xs btn-warning" href="<?=base_url()?>PesananBarang/detail/'+data+'"><i class="glyphicon glyphicon-eye-open icon-white" title="Detail"></i></a>';
                    
                    // if(row.is_spj=='1' && $("#level").val()==1){
                    //      aksi += '<a class="btn btn-xs" style="background-color: blue; color:white" onclick="Update_bku('+row.fk_rekap_dana_id+')"><i class="glyphicon glyphicon-ok icon-white" title="Update BKU"></i></a>';
                    // }     
                    aksi += '</div>';
                    return aksi ;
                },
                "orderable": false,
                "searchable": false,
                "className" : "text-center col-md-1"
            },
            {"data": "id",
                render : function ( data, type, row ){ 
                    aksi = '<div class="btn-group">';
                    if(row.terima_pesanan=='0'){
                        aksi += '<a class="btn btn-xs btn-info" href="<?=base_url()?>PesananBarang/verifikasi/'+data+'"><i class="glyphicon glyphicon-ok icon-white" title="Verifikasi"></i></a>';
                    }
                    else{ 
                        if(row.fk_rekap_dana_id==null){
                            if($("#level").val()=='1'){
                                aksi += '<a class="btn btn-xs btn-danger" href="<?=base_url()?>PesananBarang/batalverifikasi/'+data+'"><i class="glyphicon glyphicon-remove icon-white" title="Batal Verifikasi" onclick="return confirmDelete()"></i></a>';
                                aksi += ' | ';
                            }
                            aksi += '<i style="color:green"><b>Selesai</b></i>';
                        }
                        else{
                            aksi += '<i style="color:red"><b>Sdh Dibuat Rekap</b></i>';
                        }
                    }
                    aksi += '</div>';
                    return aksi ;
                },
                "orderable": false,
                "searchable": false,
                "className" : "text-center"
            },
            // {"data": "id",
            //     render : function ( data, type, row ){ 
            //         aksi = '<div class="btn-group">';
            //         // if(row.terima_pesanan=='0'){
            //             aksi += '<a class="btn btn-xs" style="background-color: #EB06FE; color:white" href="<?=base_url()?>PesananBarang/keluarBarang/'+data+'"><i class="glyphicon glyphicon-circle-arrow-right" title="Barang Keluar"></i></a>';
            //     //     }
            //     //     else{ 
            //     //         if(row.fk_rekap_dana_id==null){
            //     //             if($("#level").val()=='1'){
            //     //                 aksi += '<a class="btn btn-xs btn-danger" href="<?=base_url()?>PesananBarang/batalverifikasi/'+data+'"><i class="glyphicon glyphicon-remove icon-white" title="Batal Verifikasi" onclick="return confirmDelete()"></i></a>';
            //     //                 aksi += ' | ';
            //     //             }
            //     //             aksi += '<i style="color:green"><b>Selesai</b></i>';
            //     //         }
            //     //         else{
            //     //             aksi += '<i style="color:red"><b>Sdh Dibuat Rekap</b></i>';
            //     //         }
            //     //     }
            //         aksi += '</div>';
            //         return aksi ;
            //     },
            //     "orderable": false,
            //     "searchable": false,
            //     "className" : "text-center"
            // },
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

function Update_bku(id){
    $("#id_rekap_dananya").val(id);
    $("#modal_update_bku").modal("show");  
}

$("#cetak_rekap").click(function(){
    $("#modal_rekap").modal("show");  
});

$("#spj_bulan").change(function(){
    cari_keg();
});

$("#fk_bagian_id_rkp").change(function(){
    cari_keg();
});

function cari_keg(){
    bulan = $("#spj_bulan").val();
    fk_bagian_id = $("#fk_bagian_id_rkp").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'PesananBarang/getKegiatanRekapDel'?>",
        data: {bulan,fk_bagian_id},
        success: function(msg){
            $('#fk_kegiatan_id_rkp').html(msg.nama_keg);
            $('#fk_kegiatan_id_rkp').trigger("chosen:updated");
        }
    });     
}

$("#fk_kegiatan_id_rkp").change(function(){
    fk_kegiatan_id = $(this).val();
    
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'PesananBarang/getCariRekeningBelanjaDel'?>",
        data: {fk_kegiatan_id},
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
        url: "<?php echo base_url().'PesananBarang/getCariBKU'?>",
        data: {id_rek,bulan,fk_kegiatan_id},
        success: function(msg){
            $('#id_rekap_dana_rkp').html(msg.bku);
            $('#id_rekap_dana_rkp').trigger("chosen:updated");
        }
    });   
});

</script>