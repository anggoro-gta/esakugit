
<section class="content_section">
    <div class="content_spacer">
        <div class="content">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well">
                        <div class="pull-right">
                            <a href="<?=base_url()?>Pjd/create" class="btn btn-sm btn-success" title="Tambah"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
                            <!-- <a class="btn btn-xs btn-warning" href="<?=base_url()?>Pjd/updateBku" title="Buat Rekap"><i class="glyphicon glyphicon-edit"></i> Buat Rekap</a> -->
                            <?php //if($this->session->userdata("level")==1){ ?>
                                <!-- <a class="btn btn-xs btn-danger" href="<?=base_url()?>Pjd/deleteBku" title="Hapus Rekap"><i class="glyphicon glyphicon-trash"></i> Hapus Rekap</a> -->
                            <?php //} ?>
                            <!-- <a class="btn btn-xs btn-default" href="<?=base_url()?>Laporan/rekapPjd" id="cetak_rekap" style="background-color: purple" title="Cetak Rekap"><i class="glyphicon glyphicon-file"></i> Cetak Rekap</a> -->
                        </div>
                    </div>
                    <div class="box-content">  
                        <div class="table-responsive">                     
                            <table class="table table-bordered table-striped" id="example2" style="font-size: 80%">
                                <thead>
                                    <tr>
                                        <th style="vertical-align: middle; text-align: center" rowspan="2" width="3%">No</th>
                                        <th style="vertical-align: middle; text-align: center" rowspan="2">Bl. SPJ</th>
                                        <!-- <th style="vertical-align: middle; text-align: center" rowspan="2">No. TBP</th> -->
                                        <th style="vertical-align: middle; text-align: center" rowspan="2">Bagian</th>
                                        <th style="vertical-align: middle; text-align: center" rowspan="2" class="text-center">Kegiatan</th>
                                        <th style="vertical-align: middle; text-align: center" rowspan="2" class="text-center">Sub Kegiatan</th>
                                        <!-- <th style="vertical-align: middle; text-align: center" rowspan="2">Belanja</th> -->
                                        <th style="vertical-align: middle; text-align: center" rowspan="2">Kategori</th>
                                        <th style="vertical-align: middle; text-align: center"  rowspan="2">No Surat Tugas</th>
                                        <th style="vertical-align: middle; text-align: center" colspan="3">Tanggal</th>
                                        <th style="vertical-align: middle; text-align: center" rowspan="2">Kab/Kota</th>
                                        <th style="vertical-align: middle; text-align: center" rowspan="2">Tujuan SKPD</th>
                                        <th style="vertical-align: middle; text-align: center" rowspan="2">Acara</th>
                                        <th style="vertical-align: middle; text-align: center" rowspan="2">Jml Anggt</th>
                                        <th style="vertical-align: middle; text-align: center" rowspan="2">Cetak</th>
                                        <th style="vertical-align: middle; text-align: center" rowspan="2" width="50px">Aksi</th>
                                    </tr>
                                    <tr>                                        
                                        <th>ST</th>
                                        <th>Berangkat</th>
                                        <th>Tiba</th>
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
<!-- MODAL  -->
<div class="modal fade slide-up disable-scroll" id="modal_kwi" role="dialog" aria-hidden="false">  
    <div class="modal-dialog" style="width: 35%;padding: 0px">
        <div class="modal-content">
            <form method="post" action="<?=base_url("Pjd/cetakKwiPerSdm")?>" target="_blank" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                  <h5><b>CETAK KWITANSI</b></h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group">      
                            <label class="col-md-4 control-label">Cetak Kwitansi Untuk</label>
                            <div class="col-md-7">
                                <select class="form-control" name="id_detail" id="id_detail">
                                    <option value="">Pilih</option>
                                </select>
                            </div>
                        </div>
                        <input name="id_pjd" id="id_pjd" type="hidden">
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

<div class="modal fade slide-up disable-scroll" id="modal_hal_2" role="dialog" aria-hidden="false">  
    <div class="modal-dialog" style="width: 45%;padding: 0px">
        <div class="modal-content">
            <form id="form_hal2" method="post" action="<?=base_url("Pjd/cetakHal2ab")?>" target="_blank" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                  <h5><b>CETAK Halaman 2</b></h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group required">      
                            <label class="col-md-4 control-label">Pilih Halaman</label>
                            <div class="col-md-7">
                                <select class="form-control" name="hal2_kode" id="hal2_kode" required>
                                    <option value="">Pilih</option>
                                    <option value="A">Hal 2A</option>
                                    <option value="B">Hal 2B</option>
                                </select>
                            </div>
                        </div>
                        <div id="hal2_b" style="display: none;">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Jabatan</label>
                                <div class="col-md-7">
                                    <input type="text" name="hal2_jabatan" id="hal2_jabatan" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Nama</label>
                                <div class="col-md-7">
                                    <input type="text" name="hal2_nama" id="hal2_nama" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">NIP</label>
                                <div class="col-md-7">
                                    <input type="text" name="hal2_nip" id="hal2_nip" class="form-control">
                                </div>
                            </div>
                        </div>
                        <input name="hal2_id_pjd" id="hal2_id_pjd" type="hidden">
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

<div class="modal fade slide-up disable-scroll" id="modal_dd" role="dialog" aria-hidden="false">  
    <div class="modal-dialog" style="width: 35%;padding: 0px">
        <div class="modal-content">
            <form method="post" action="<?=base_url("Pjd/cetakSpDD")?>" target="_blank" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                  <h5><b>Cetak Surat Pernyataan DD</b></h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group required">      
                            <label class="col-md-4 control-label">Berangkat</label>
                            <div class="col-md-5">
                                <input type="text" name="waktu_berangkat" class="form-control text-center timepicker" required></input>
                            </div>
                        </div>
                        <div class="form-group required">      
                            <label class="col-md-4 control-label">Kembali</label>
                            <div class="col-md-5">
                                <input type="text" name="waktu_kembali" class="form-control text-center timepicker" required></input>
                            </div>
                        </div>
                        <!-- <div class="form-group required">      
                            <label class="col-md-4 control-label">Yang Menyatakan</label>
                            <div class="col-md-7">
                                <select class="form-control" name="id_sdm" id="id_sdm_d" required>
                                    <option value="">Pilih</option>
                                </select>
                            </div>
                        </div> -->
                        <!-- <div class="form-group">      
                            <label class="col-md-4 control-label">Atasan Langsung</label>
                            <div class="col-md-7">
                                <select class="form-control" name="atasan_langsung1" id="atasan_langsung1_d">
                                    <option value="">Pilih</option>
                                </select>
                            </div>
                        </div> -->
                        <div class="form-group">      
                            <label class="col-md-4 control-label">KPA / PA</label>
                            <div class="col-md-7">
                                <select class="form-control" name="kpa_pa" id="kpa_pa1">
                                    <option value="">Pilih</option>
                                </select>
                            </div>
                        </div>
                        <input name="id_pjd" id="id_pjd_pernyataanDd" type="hidden">
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

<div class="modal fade slide-up disable-scroll" id="modal_dl" role="dialog" aria-hidden="false">  
    <div class="modal-dialog" style="width: 35%;padding: 0px">
        <div class="modal-content">
            <form method="post" action="<?=base_url("Pjd/cetakSpDL")?>" target="_blank" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                  <h5><b>Cetak Surat Pernyataan DL</b></h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group required">      
                            <label class="col-md-4 control-label">Berangkat</label>
                            <div class="col-md-5">
                                <input type="text" name="waktu_berangkat" class="form-control text-center datetimepicker" required></input>
                            </div>
                        </div>
                        <div class="form-group required">      
                            <label class="col-md-4 control-label">Kembali</label>
                            <div class="col-md-5">
                                <input type="text" name="waktu_kembali" class="form-control text-center datetimepicker" required></input>
                            </div>
                        </div>
                        <!-- <div class="form-group required">      
                            <label class="col-md-4 control-label">Yang Menyatakan</label>
                            <div class="col-md-7">
                                <select class="form-control" name="id_sdm" id="id_sdm" required>
                                    <option value="">Pilih</option>
                                </select>
                            </div>
                        </div> -->
                        <!-- <div class="form-group">      
                            <label class="col-md-4 control-label">Atasan Langsung</label>
                            <div class="col-md-7">
                                <select class="form-control" name="atasan_langsung1" id="atasan_langsung1">
                                    <option value="">Pilih</option>
                                </select>
                            </div>
                        </div> -->
                        <div class="form-group">      
                            <label class="col-md-4 control-label">KPA / PA</label>
                            <div class="col-md-7">
                                <select class="form-control" name="kpa_pa" id="kpa_pa">
                                    <option value="">Pilih</option>
                                </select>
                            </div>
                        </div>
                        <input name="id_pjd" id="id_pjd_pernyataanDL" type="hidden">
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
            <form method="post" action="<?=base_url("Pjd/updateNoBKUSaja")?>" enctype="multipart/form-data" class="form-horizontal">
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
                <input type="hidden" name="id_pjd_dana" id="id_pjd_dananya">
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
        ajax: {"url": "<?= base_url()?>Pjd/getDatatables", "type": "POST", "data": {
                "no_surat_tugas": "<?=$no_surat_tugas?>","bulan": "<?=$bulan?>","fk_bagian_id": "<?=$fk_bagian_id?>","fk_program_id": "<?=$fk_program_id?>","fk_kegiatan_id": "<?=$fk_kegiatan_id?>","kategori": "<?=$kategori?>"}
        },
        columns: [
            {
                "data": "id",
                "orderable": false,
                "className" : "text-center"
            },
            {
                "data": "bulan",
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
            // {  "data": "info_no_bku",
            //    "orderable": false,
            //     "className" : "text-center"
            // },
            {
                "data": "nama_bagian",
                "orderable": false,
            },
            {  "data": "nama_program",
               "orderable": false,
                // "className" : "text-center"
            },
            {  "data": "kegiatan",
               "orderable": false,
                // "className" : "text-center"
            },
            // {  "data": "nama_rek_belanja",
            //    "orderable": false,
            //     "className" : "text-center"
            // },
            {  "data": "kategori",
               "orderable": false,
                "className" : "text-center"
            },
            {  "data": "no_surat_tugas",
               "orderable": false,
                "className" : "text-center"
            },
            {  "data": "tgl_surat_tugas",
               "orderable": false,
               "searchable": false,
                "className" : "text-center"
            },
            {  "data": "tgl_berangkat",
               "orderable": false,
               "searchable": false,
                "className" : "text-center"
            },
            {  "data": "tgl_tiba",
               "orderable": false,
               "searchable": false,
                "className" : "text-center"
            },
            {  "data": "kota",
               "orderable": false,
            },
            {  "data": "tujuan_skpd",
               "orderable": false,
            },
            {  "data": "acara",
               "orderable": false,
            },
            {  "data": "total_pjd",
               "orderable": false,
                "searchable": false,
                "className" : "text-center"
            },
            {
                "data": "id",
                "orderable": false,
                "searchable": false,
                "className" : "text-center",
                render : function (data, type, row) {
                    hsl = '';
                    hsl += '<a href="<?=base_url()?>Pjd/surat_tugas/'+data+'" target="_blank"  title="Surat Tugas">ST</a>';
                    hsl += ' | ';
                    hsl += '<a href="<?=base_url()?>Pjd/hal1/'+data+'" target="_blank" title="Cetak Hal 1">Hal 1</a>';
                    hsl += ' | ';
                    hsl += '<a href="<?=base_url()?>Pjd/hal2/'+data+'" target="_blank"  title="Cetak Hal 2">Hal 2</a>';
                    // hsl += '<a href="#" onclick="detail_hal2('+data+')"  title="Cetak Hal 2">Hal 2</a>';
                    hsl += ' | ';
                    hsl += '<a href="<?=base_url()?>Pjd/rincian_biaya/'+data+'" target="_blank"  title="Rincian Biaya Perjalanan Dinas">Rincian Biaya PD</a>';
                    // if(row.no_kwitansi!=null){
                        hsl += ' | ';
                        hsl += '<a href="<?=base_url()?>Pjd/kwiTot/'+data+'" target="_blank"  title="Cetak Kwitansi">Kwi</a>';
                        // hsl += '<a href="#" onclick="detail_kwi('+data+')"  title="Cetak Kwitansi">Kwi</a>';
                        // if(row.kategori=='DD'){
                        //     hsl += ' | ';
                        //     hsl += '<a href="#" onclick="detail_dd('+data+')"  title="Cetak Surat Pernyataan DD">SP DD</a>';
                        // }else{
                        //     hsl += ' | ';
                        //     hsl += '<a href="#" onclick="detail_dl('+data+')"  title="Cetak Surat Pernyataan DL">SP DL</a>';
                        // }
                    // hsl += ' | ';
                    // hsl += '<a href="<?=base_url()?>Pjd/laporan_staf/'+data+'" target="_blank"  title="Laporan Staf">Lap Staf</a>';
                    // }
                    
                    return hsl;
               },
            },
            {"data": "id",
                render : function ( data, type, row ){ 
                    aksi = '<div class="btn-group">';
                    // if(row.no_kwitansi==null){
                        if(row.bulan==null){
                            aksi += '<a class="btn btn-xs btn-danger" href="<?=base_url()?>Pjd/delete/'+data+'"><i class="glyphicon glyphicon-trash icon-white" title="Hapus" onclick="return confirmDelete()"></i></a>';
                            aksi += '<a class="btn btn-xs btn-success" href="<?=base_url()?>Pjd/update/'+data+'"><i class="glyphicon glyphicon-edit icon-white" title="Update"></i></a>';  
                        }
                        aksi += '<a class="btn btn-xs btn-warning" href="<?=base_url()?>Pjd/detail/'+data+'"><i class="glyphicon glyphicon-eye-open icon-white" title="Detail"></i></a>';
                        // if(row.alat_transportasi!='Mobil' && row.alat_transportasi!='Sepeda Motor'){
                        if(row.kategori=='DL'){
                            aksi += '<a class="btn btn-xs btn-info" href="<?=base_url()?>Pjd/transportHotel/'+data+'"><i class="glyphicon glyphicon-paperclip icon-white" title="Pesawat/Kereta Api dan Hotel"></i></a>';
                        }
                        // if(row.bulan!=null && $("#level").val()==1){
                        //     aksi += '<a class="btn btn-xs" style="background-color: blue; color:white" onclick="Update_bku('+row.fk_pjd_dana_id+')"><i class="glyphicon glyphicon-ok icon-white" title="Update TBP"></i></a>';
                        // }  
                        // aksi += '<a class="btn btn-xs btn-info" href="<?=base_url()?>Pjd/ProsesKwitansi/'+data+'"><i title="Pembuatan Nomor Kwitansi" onclick="return confirmNoKwi()">Proses Kwi</i></a>';
                    // }else{
                    //     aksi += '<a class="btn btn-xs btn-warning" href="<?=base_url()?>Pjd/detail/'+data+'"><i class="glyphicon glyphicon-eye-open icon-white" title="Detail"></i></a>';
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

function confirmNoKwi() {
    return confirm('Apakah anda yakin Pembuatan Nomor Kwitansi?');
};

function detail_kwi(id){
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Pjd/getJmlSdm'?>",
        data: {id},
        success: function(msg){
            $('#id_detail').html(msg.dataSdm);
            $('#id_pjd').val(id);
        }
    });  
    $("#modal_kwi").modal("show"); 
}

function detail_dd(id){
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Pjd/getAtsnLngsng'?>",
        data: {id},
        success: function(msg){
            $('#id_sdm_d').html(msg.dataSdm);
            $('#atasan_langsung1_d').html(msg.dataAtsn);
            $('#kpa_pa1').html(msg.dataKpa);
            $('#id_pjd_pernyataanDd').val(id);
        }
    });
    $("#modal_dd").modal("show"); 
}

function detail_dl(id){
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Pjd/getAtsnLngsng'?>",
        data: {id},
        success: function(msg){
            $('#id_sdm').html(msg.dataSdm);
            // $('#atasan_langsung1').html(msg.dataAtsn);
            $('#kpa_pa').html(msg.dataKpa);
            $('#id_pjd_pernyataanDL').val(id);
        }
    });
    $("#modal_dl").modal("show"); 
}

function detail_hal2(id){
    $('#hal2_id_pjd').val(id);

    $("#modal_hal_2").modal("show"); 
}

$("#hal2_kode").change(function(){
    $("#hal2_b").hide();
    if($(this).val()=='B'){
        $("#hal2_b").show();
    }
});

$('#form_hal2').submit(function() {
    kode = $('#hal2_kode').val();
    if(kode=='B'){
        if($('#hal2_jabatan').val()==''){
            alert('Jabatan tidak boleh kosong.!');
            return false;
        }
        if($('#hal2_nama').val()==''){
            alert('Nama tidak boleh kosong.!');
            return false;
        }
        if($('#hal2_nip').val()==''){
            alert('NIP tidak boleh kosong.!');
            return false;
        }
    }
    return true;
});

$('.datetimepicker').datetimepicker({
    format: 'DD-MM-YYYY HH:mm',
});

$('.timepicker').datetimepicker({
    format: 'HH:mm',
});

function Update_bku(id){
    $("#id_pjd_dananya").val(id);
    $("#modal_update_bku").modal("show");  
}

</script>