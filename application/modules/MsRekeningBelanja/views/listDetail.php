
<section class="content_section">
    <div class="content_spacer">
        <div class="content">
            <div class="box col-md-12">
                <div class="box-content">  
                    <div class="box-header well">
                        <div class="pull-right">
                            <?php if($this->session->level==1){ ?>
                                <a href="<?=base_url()?>MsRekeningBelanja/create" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="table-responsive">                     
                        <table class="table table-bordered table-striped" width="100%" id="example2" style="font-size: 7pt;" width="100%">
                            <thead>
                                <tr>
                                    <th style="vertical-align: middle;text-align: center" width="3%">No</th>
                                    <th style="vertical-align: middle;text-align: center">Bagian</th>
                                    <th style="vertical-align: middle;text-align: center">Sub Kegiatan</th>
                                    <th style="vertical-align: middle;text-align: center">Kode Rekening</th>
                                    <th style="vertical-align: middle;text-align: center">Nama Rekening</th>
                                    <th style="vertical-align: middle;text-align: center">Pagu Anggaran</th>
                                    <th style="vertical-align: middle;text-align: center">Perubahan<br>Perbup1
                                        <?php if($this->session->level==1){ ?>
                                            <br>
                                            <button type="submit" title="Generate Perbup 1" class="btn btn-xs btn-success" id="generatePerbup1">Generate<br>Perbup1</button>
                                        <?php } ?>
                                    </th>
                                    <th style="vertical-align: middle;text-align: center">Tgl<br>Perbup1
                                        <?php if($this->session->level==1){ ?>
                                            <br>
                                            <button class="btn btn-xs btn-warning" title="Update Tanggal" id="updateTglPerbup1">Update Tgl</button>
                                        <?php } ?>
                                    </th>
                                    <th style="vertical-align: middle;text-align: center">Perubahan<br>Perbup2
                                        <?php if($this->session->level==1){ ?>
                                            <br>
                                            <button type="submit" title="Generate Perbup 2" class="btn btn-xs btn-success" id="generatePerbup2">Generate<br>Perbup2</button>
                                        <?php } ?>
                                    </th>
                                    <th style="vertical-align: middle;text-align: center">Tgl<br>Perbup2
                                        <?php if($this->session->level==1){ ?>
                                            <br>
                                            <button class="btn btn-xs btn-warning" title="Update Tanggal" id="updateTglPerbup2">Update Tgl</button>
                                        <?php } ?>
                                    </th>
                                    <th style="vertical-align: middle;text-align: center">Perubahan<br>Perbup3
                                        <?php if($this->session->level==1){ ?>
                                            <br>
                                            <button type="submit" title="Generate Perbup 3" class="btn btn-xs btn-success" id="generatePerbup3">Generate<br>Perbup3</button>
                                        <?php } ?>
                                    </th>
                                    <th style="vertical-align: middle;text-align: center">Tgl<br>Perbup3
                                        <?php if($this->session->level==1){ ?>
                                            <br>
                                            <button class="btn btn-xs btn-warning" title="Update Tanggal" id="updateTglPerbup3">Update Tgl</button>
                                        <?php } ?>
                                    </th>
                                    <th style="vertical-align: middle;text-align: center">Perubahan<br>Perbup4
                                        <?php if($this->session->level==1){ ?>
                                            <br>
                                            <button type="submit" title="Generate Perbup 4" class="btn btn-xs btn-success" id="generatePerbup4">Generate<br>Perbup4</button>
                                        <?php } ?>
                                    </th>
                                    <th style="vertical-align: middle;text-align: center">Tgl<br>Perbup4
                                        <?php if($this->session->level==1){ ?>
                                            <br>
                                            <button class="btn btn-xs btn-warning" title="Update Tanggal" id="updateTglPerbup4">Update Tgl</button>
                                        <?php } ?>
                                    </th>
                                    <th style="vertical-align: middle;text-align: center">Anggaran PAK
                                        <?php if($this->session->level==1){ ?>
                                            <br>
                                            <button type="submit" title="Generate PAK" class="btn btn-xs btn-success" id="generatePAK">Generate<br>PAK</button>
                                        <?php } ?>
                                    </th>
                                    <th style="vertical-align: middle;text-align: center">Tgl<br>PAK
                                        <?php if($this->session->level==1){ ?>
                                            <br>
                                            <button class="btn btn-xs btn-warning" title="Update Tanggal" id="updateTglPAK">Update Tgl</button>
                                        <?php } ?>
                                    </th>
                                    <th style="vertical-align: middle;text-align: center">Batas Anggaran Semester 1</th>
                                    <th style="vertical-align: middle;text-align: center">Aksi</th>
                                </tr>
                            </thead>                        
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<input type="hidden" id="level" value="<?=$this->session->level?>">
<div class="modal fade slide-up disable-scroll" id="modal_update_perbup1" role="dialog" aria-hidden="false">  
    <div class="modal-dialog" style="width: 35%;padding: 0px">
        <div class="modal-content">
            <form method="post" action="<?=base_url("MsRekeningBelanja/updatePerbup1")?>" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                  <h5><b>Data Perbup 1 di ambil dari data Anggaran Pagu Awal.</b></h5>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-md btn-default pull-left inline" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-md btn-success pull-left inline" >Generate</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade slide-up disable-scroll" id="modal_update_tgl_perbup1" role="dialog" aria-hidden="false">  
    <div class="modal-dialog" style="width: 35%;padding: 0px">
        <div class="modal-content">
            <form method="post" action="<?=base_url("MsRekeningBelanja/updateTglPerbup1")?>" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                  <h5><b>UPDATE Tgl Perbup 1</b></h5>
                </div>
                <div class="modal-body">
                    <div class="form-group required">      
                        <label class="col-md-3 control-label">Tgl Perbup 1</label>
                        <div class="col-md-5">
                            <input type="text" name="tgl_perbup_1" class="form-control text-center tanggal" autocomplete="off" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-md btn-default pull-left inline" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-md btn-success pull-left inline" >Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade slide-up disable-scroll" id="modal_update_perbup2" role="dialog" aria-hidden="false">  
    <div class="modal-dialog" style="width: 35%;padding: 0px">
        <div class="modal-content">
            <form method="post" action="<?=base_url("MsRekeningBelanja/updatePerbup2")?>" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                  <h5><b>Data Perbup 2 di ambil dari data Anggaran Perbup 1.</b></h5>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-md btn-default pull-left inline" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-md btn-success pull-left inline" >Generate</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade slide-up disable-scroll" id="modal_update_tgl_perbup2" role="dialog" aria-hidden="false">  
    <div class="modal-dialog" style="width: 35%;padding: 0px">
        <div class="modal-content">
            <form method="post" action="<?=base_url("MsRekeningBelanja/updateTglPerbup2")?>" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                  <h5><b>UPDATE Tgl Perbup 2</b></h5>
                </div>
                <div class="modal-body">
                    <div class="form-group required">      
                        <label class="col-md-3 control-label">Tgl Perbup 2</label>
                        <div class="col-md-5">
                            <input type="text" name="tgl_perbup_2" class="form-control text-center tanggal" autocomplete="off" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-md btn-default pull-left inline" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-md btn-success pull-left inline" >Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade slide-up disable-scroll" id="modal_update_perbup3" role="dialog" aria-hidden="false">  
    <div class="modal-dialog" style="width: 35%;padding: 0px">
        <div class="modal-content">
            <form method="post" action="<?=base_url("MsRekeningBelanja/updatePerbup3")?>" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                  <h5><b>Data Perbup 3 di ambil dari data Anggaran Perbup 2.</b></h5>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-md btn-default pull-left inline" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-md btn-success pull-left inline" >Generate</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade slide-up disable-scroll" id="modal_update_tgl_perbup3" role="dialog" aria-hidden="false">  
    <div class="modal-dialog" style="width: 35%;padding: 0px">
        <div class="modal-content">
            <form method="post" action="<?=base_url("MsRekeningBelanja/updateTglPerbup3")?>" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                  <h5><b>UPDATE Tgl Perbup 3</b></h5>
                </div>
                <div class="modal-body">
                    <div class="form-group required">      
                        <label class="col-md-3 control-label">Tgl Perbup 3</label>
                        <div class="col-md-5">
                            <input type="text" name="tgl_perbup_3" class="form-control text-center tanggal" autocomplete="off" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-md btn-default pull-left inline" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-md btn-success pull-left inline" >Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade slide-up disable-scroll" id="modal_update_perbup4" role="dialog" aria-hidden="false">  
    <div class="modal-dialog" style="width: 35%;padding: 0px">
        <div class="modal-content">
            <form method="post" action="<?=base_url("MsRekeningBelanja/updatePerbup4")?>" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                  <h5><b>Data Perbup 4 di ambil dari data Anggaran Perbup 3.</b></h5>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-md btn-default pull-left inline" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-md btn-success pull-left inline" >Generate</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade slide-up disable-scroll" id="modal_update_tgl_perbup4" role="dialog" aria-hidden="false">  
    <div class="modal-dialog" style="width: 35%;padding: 0px">
        <div class="modal-content">
            <form method="post" action="<?=base_url("MsRekeningBelanja/updateTglPerbup4")?>" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                  <h5><b>UPDATE Tgl Perbup 4</b></h5>
                </div>
                <div class="modal-body">
                    <div class="form-group required">      
                        <label class="col-md-3 control-label">Tgl Perbup 4</label>
                        <div class="col-md-5">
                            <input type="text" name="tgl_perbup_4" class="form-control text-center tanggal" autocomplete="off" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-md btn-default pull-left inline" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-md btn-success pull-left inline" >Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade slide-up disable-scroll" id="modal_update_pak" role="dialog" aria-hidden="false">  
    <div class="modal-dialog" style="width: 35%;padding: 0px">
        <div class="modal-content">
            <form method="post" action="<?=base_url("MsRekeningBelanja/updatePAK")?>" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                  <h5><b>Data Perbup 4 di ambil dari data Anggaran Perbup 3.</b></h5>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-md btn-default pull-left inline" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-md btn-success pull-left inline" >Generate</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade slide-up disable-scroll" id="modal_update_tgl_pak" role="dialog" aria-hidden="false">  
    <div class="modal-dialog" style="width: 35%;padding: 0px">
        <div class="modal-content">
            <form method="post" action="<?=base_url("MsRekeningBelanja/updateTglPAK")?>" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                  <h5><b>UPDATE Tgl PAK</b></h5>
                </div>
                <div class="modal-body">
                    <div class="form-group required">      
                        <label class="col-md-3 control-label">Tgl PAK</label>
                        <div class="col-md-5">
                            <input type="text" name="tgl_pak" class="form-control text-center tanggal" autocomplete="off" required>
                        </div>
                    </div>
                </div>
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
            ajax: {"url": "<?= base_url()?>MsRekeningBelanja/getDatatables", "type": "POST", "data": {"fk_bagian_id": "<?=$fk_bagian_id?>"}
                },
            columns: [
                {
                    "data": "id",
                    "orderable": false,
                    "className" : "text-center"
                },
                {
                    "data": "nama_bagian",
                    "orderable": false,
                },
                {
                    "data": "kegiatan",
                    "orderable": false,
                },
                {
                    "data": "kode_rek_belanja",
                    "orderable": false,
                },
                {
                    "data": "nama_rek_belanja",
                    "orderable": false,
                },
                {
                    "data": "anggaran",
                    "orderable": false,
                    "className" : "text-right"
                },
                {
                    "data": "anggaran_per_perbup1",
                    "orderable": false,
                    "className" : "text-right"
                },
                {
                    "data": "tgl_per_perbup1",
                    "orderable": false,
                    "className" : "text-center"
                },
                {
                    "data": "anggaran_per_perbup2",
                    "orderable": false,
                    "className" : "text-right"
                },
                {
                    "data": "tgl_per_perbup2",
                    "orderable": false,
                    "className" : "text-center"
                },
                {
                    "data": "anggaran_per_perbup3",
                    "orderable": false,
                    "className" : "text-right"
                },
                {
                    "data": "tgl_per_perbup3",
                    "orderable": false,
                    "className" : "text-center"
                },
                {
                    "data": "anggaran_per_perbup4",
                    "orderable": false,
                    "className" : "text-right"
                },
                {
                    "data": "tgl_per_perbup4",
                    "orderable": false,
                    "className" : "text-center"
                },
                {
                    "data": "anggaran_pak",
                    "orderable": false,
                    "className" : "text-right"
                },
                {
                    "data": "tgl_pak",
                    "orderable": false,
                    "className" : "text-center"
                },
                {
                    "data": "bts_anggaran_semester_1",
                    "orderable": false,
                    "className" : "text-right"
                },
                {
                    "data": "action",
                    "orderable": false,
                    "className" : "text-center",
                    // "visible" : $("#level").val()==2?false:true,
                },
            ],
            order: [[0, 'desc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });
    });

$("#generatePerbup1").click(function(){
    $("#modal_update_perbup1").modal("show");  
})

$("#updateTglPerbup1").click(function(){
    $("#modal_update_tgl_perbup1").modal("show");  
})

$("#generatePerbup2").click(function(){
    $("#modal_update_perbup2").modal("show");  
})

$("#updateTglPerbup2").click(function(){
    $("#modal_update_tgl_perbup2").modal("show");  
})

$("#generatePerbup3").click(function(){
    $("#modal_update_perbup3").modal("show");  
})

$("#updateTglPerbup3").click(function(){
    $("#modal_update_tgl_perbup3").modal("show");  
})

$("#generatePerbup4").click(function(){
    $("#modal_update_perbup4").modal("show");  
})

$("#updateTglPerbup4").click(function(){
    $("#modal_update_tgl_perbup4").modal("show");  
})

$("#generatePAK").click(function(){
    $("#modal_update_pak").modal("show");  
})

$("#updateTglPAK").click(function(){
    $("#modal_update_tgl_pak").modal("show");  
})

</script>