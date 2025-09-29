
<section class="content_section">
    <div class="content_spacer">
        <div class="content">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well">
                        <div class="pull-right">
                            <a href="<?=base_url()?>Rekap/create" class="btn btn-sm btn-success" title="Buat Rekap"><i class="glyphicon glyphicon-plus"></i> Buat Rekap</a>
                        </div>
                    </div>
                    <div class="box-content">  
                        <div class="table-responsive">                     
                            <table class="table table-bordered table-striped" id="example2" style="font-size: 80%">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;" width="3%">No</th>
                                        <th style="text-align: center;">Bagian</th>
                                        <th style="text-align: center;">Kategori Rekap</th>
                                        <th style="text-align: center;">Bl. SPJ</th>
                                        <!-- <th style="text-align: center;">No. TBP</th> -->
                                        <th style="text-align: center;">Tgl Rekap</th>
                                        <th style="text-align: center;">Bagian</th>
                                        <th style="text-align: center;">Sub Kegiatan</th>
                                        <th style="text-align: center;">Rek. Belanja</th>
                                        <th style="text-align: center;">Jumlah Dana</th>
                                        <th style="text-align: center">Pengajuan Sebelum</th>
                                        <th style="text-align: center;">Pengajuan Sekarang</th>
                                        <th style="text-align: center;">Sisa Anggaran</th>
                                        <th style="text-align: center;">Cetak</th>
                                        <th style="text-align: center;" width="6%">Aksi</th>
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

<div class="modal fade slide-up disable-scroll" id="modal_update_tgl" role="dialog" aria-hidden="false">  
    <div class="modal-dialog" style="width: 35%;padding: 0px">
        <div class="modal-content">
            <form method="post" action="<?=base_url("Rekap/updateTgl")?>" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                  <h5><b>UPDATE Tgl Rekap</b></h5>
                </div>
                <div class="modal-body">
                    <div class="form-group required">      
                        <label class="col-md-3 control-label">Tgl Rekap</label>
                        <div class="col-md-5">
                            <input type="text" name="tgl_rekap" id="tgl_rekap" class="form-control text-center tanggal" autocomplete="off" required>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id_rekap_dana" id="id_rekap_dananya">
                <input type="hidden" name="namaTabelnya" id="namaTabelnya">
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
        ajax: {"url": "<?= base_url()?>Rekap/getDatatables", "type": "POST", "data": {
                "bulan": "<?=$bulan?>","fk_bagian_id": "<?=$fk_bagian_id?>","fk_program_id": "<?=$fk_program_id?>","fk_kegiatan_id": "<?=$fk_kegiatan_id?>"}
        },
        columns: [
            {
                "data": "id",
                "orderable": false,
                "className" : "text-center"
            },
            {
                "data": "singkatan_bagian",
                "orderable": false,
                "className" : "text-center"
            },
            {
                "data": "kategori_rekap",
                "orderable": false,
                "className" : "text-center"
            },
            {
                "data": "nama_bulan",
                "orderable": false,
                "className" : "text-center"
            },
            // {  "data": "info_no_bku",
            //    "orderable": false,
            //     "className" : "text-center"
            // },
            {
                "data": "tgl_rekap",
                "orderable": false,
                "className" : "text-center"
            },
            {  "data": "singkatan_bagian",
               "orderable": false,
            },
            {  "data": "kegiatan",
               "orderable": false,
            },
            {
                "data": "nama_rek_belanja",
                "orderable": false,
            },
            {
                "data": "jml_dana_idr",
                "orderable": false,
                "className" : "text-right"
            },
            {
                "data": "pengajuan_sebelum_idr",
                "orderable": false,
                "className" : "text-right"
            },
            {
                "data": "pengajuan_sekarang_idr",
                "orderable": false,
                "className" : "text-right"
            },
            {
                "data": "sisa_kas_idr",
                "orderable": false,
                "className" : "text-right"
            },
            {
                "data": "id",
                "orderable": false,
                "searchable": false,
                "className" : "text-center",
                render : function (data, type, row) {
                    hsl = '';
                    hsl += '<a href="<?=base_url()?>Rekap/cetakRekap/'+row.tabelnya+'/'+data+'" target="_blank"  title="Cetak Rekap">Rekap</a>';
                    // hsl += ' | ';
                    // hsl += '<a href="<?=base_url()?>Rekap/cetakNPD/'+row.tabelnya+'/'+data+'" target="_blank"  title="Cetak NPD">NPD</a>';
                    // if(row.tabelnya=='rekap_dana' && (row.dari_tabel!='t_kwitansi_hr' && row.dari_tabel!='t_kwitansi' && row.dari_tabel!='pb_pesanan_barang')){
                        // hsl += ' | ';
                        // hsl += '<a href="<?=base_url()?>Rekap/cetakSSPD/'+row.tabelnya+'/'+data+'" target="_blank"  title="Cetak SSPD">SSPD</a>';
                    // }
                    return hsl;
               },
            },
            {"data": "id",
                render : function ( data, type, row ){ 
                    aksi = '<div class="">';
                    if(row.status_pencairan==0){
                        aksi += '<a class="btn btn-xs" style="background-color: blue; color:white" onclick="Update_tgl(\''+row.tabelnya+'\''+','+data+')"><i class="glyphicon glyphicon-calendar icon-white" title="Update Tanggal"></i></a>';
                        aksi += ' | ';
                        aksi += '<a class="btn btn-xs btn-danger" href="<?=base_url()?>Rekap/delRekap/'+row.tabelnya+'/'+data+'"><i class="glyphicon glyphicon-trash icon-white" title="Hapus" onclick="return confirmDelete()"></i></a>';                    
                    }
                    if(row.kategori_hr=='NARASUMBER' || row.kategori_hr=='KEGIATAN'){
                        aksi += ' | ';
                        aksi += '<a class="btn btn-xs" style="background-color: magenta; color:white" href="<?=base_url()?>Rekap/updateNarsum/'+data+'"><i class="glyphicon glyphicon-hand-right icon-white" title="Update Narsum"></i></a>';
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

$("#cetak_rekap").click(function(){
    $("#modal_rekap").modal("show");  
});

$("#spj_bulan").change(function(){
    cari_keg();
});

$("#fk_bagian_id_rkp").change(function(){
    cari_keg();
});

tabel='t_Rekap';
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

$("#cetakSSPD").click(function(){
    id_rekap_dana = $("#id_rekap_dana_rkp").val();
    tgl_sspd = $("#tgl_sspd").val();
    if(tgl_sspd==''){
        alert('Tgl Cetak SSPD wajib diisi.');
        $("#tgl_sspd").focus();

        return false;
    }
     
    window.open("<?= base_url()?>Rekap/cetak_sspd_rekap?id_rekap_dana="+id_rekap_dana+"&tgl_sspd="+tgl_sspd);
    
});

function Update_tgl(tabelnya,id){
    $("#id_rekap_dananya").val(id);
    $("#namaTabelnya").val(tabelnya);
    $("#modal_update_tgl").modal("show");  
}

</script>