<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Proses Rekap Belanja <?=$judul?></div>
            <h1>
                <a onclick="window.history.back()" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-list-alt"></i> Tabel Data</a>
            </h1>
        </div>
    </div>
</section>
<section class="content_section">
    <div class="content_spacer">
        <div class="content">
            <div class="box col-md-12">
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Error!</strong> <?php echo $this->session->flashdata('error') ?>
                    </div>
                <?php endif; ?>
                <div class="box-inner">
                    <div class="box-header well">
                        <h2><?=$this->help->labelnya()?></h2>
                    </div>
                    <div class="box-content">
                        <form class="form-horizontal" action="<?=$url?>" method="post" enctype="multipart/form-data" onsubmit="return validateForm();" id="assignmentForm"> 
                            <div class="col-md-6">
                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Bl. SPJ</label>
                                    <div class="col-md-3">
                                        <select class="form-control chosen" name="bulan" id="bulan" required>
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
                                            <select class="form-control chosen" name="fk_bagian_id" id="fk_bagian_id" >
                                                <option value="">Pilih</option>
                                                <?php foreach ($arrBagian as $bid) { ?>
                                                    <option value="<?=$bid['id']?>"><?=$bid['nama_bagian']?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                <?php }else{ ?>
                                    <input type="hidden" name="fk_bagian_id" id="fk_bagian_id" value="<?=$this->session->userdata("fk_bagian_id")?>">
                                <?php }?>
                                <div class="form-group required">      
                                    <label class="col-md-3 control-label">Sub Kegiatan</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="fk_kegiatan_id" id="fk_kegiatan_id" >
                                            <option value="">Pilih</option>
                                        </select>
                                    </div>
                                </div> 
                                <div class="form-group required">      
                                    <label class="col-md-3 control-label">Belanja</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="fk_rekening_belanja_id" id="fk_rekening_belanja_id" >
                                            <option value="">Pilih</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Batas Anggaran Per Semester</label>
                                    <div class="col-md-4">
                                        <input type="text" name="bts_anggaran" id="bts_anggaran" class="form-control nominal" readonly required>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-md-6">  
                               <!--  <div class="form-group required">
                                    <label class="col-md-2 control-label"><?=$judul=='Swakelola'?'No. SP2D':'No. TBP'?></label>
                                    <div class="col-md-4"> -->
                                        <input type="hidden" name="no_bku" class="form-control text-center" value=". . . . ." required autocomplete="off">
                                    <!-- </div>
                                </div> -->
                                <div class="form-group required">
                                    <label class="col-md-2 control-label">Jumlah Dana</label>
                                    <div class="col-md-4">
                                        <input type="text" name="jml_dana" id="jml_dana" class="form-control nominal" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Pengajuan Sebelumnya</label>
                                    <div class="col-md-4">
                                        <input type="text" name="pengajuan_sebelum" id="pengajuan_sebelum" class="form-control nominal">
                                        <input type="hidden" name="tot_pajak_bpjs" id="tot_pajak_bpjs" class="form-control">
                                        <input type="hidden" name="tot_pajak_kegiatan" id="tot_pajak_kegiatan" class="form-control">
                                        <input type="hidden" name="tot_pajak_sblm" id="tot_pajak_sblm" class="form-control">
                                        <input type="hidden" name="tot_pajak_rapat_sblm" id="tot_pajak_rapat_sblm" class="form-control">
                                        <input type="hidden" name="tot_pajak_lembur_sblm" id="tot_pajak_lembur_sblm" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-md-2 control-label">Pengajuan Sekarang</label>
                                    <div class="col-md-4">
                                        <input type="text" name="pengajuan_sekarang" id="pengajuan_sekarang" class="form-control nominal" required>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-md-2 control-label">Sisa Anggaran</label>
                                    <div class="col-md-4">
                                        <input type="text" name="sisa_kas" id="sisa_kas" class="form-control nominal" required readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-12">                        
                                <div class="col-md-4"></div>
                                <div class="col-md-3">
                                    <a class="btn btn-sm btn-info" id="tampil"><i class="glyphicon glyphicon-search"></i> Tampilkan</a>
                                </div>
                            </div>
                            <div id="tampilData"></div>
                            <div class="form-group">
                                <div class="col-md-2"></div>
                                <div class="col-md-6" align="center">
                                <button id="submit" type="submit" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-hdd"></i> Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
$(document).ready(function(){
    tampilkan();
    cari_keg();
});

$("#fk_bagian_id").change(function(){
    cari_keg();
});

tabel = "<?=$tabel?>";
kategori = "<?=$kategori?>";

function cari_keg(){
    fk_bagian_id = $("#fk_bagian_id").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'KwitansiHR/getKegiatanRekap'?>",
        data: {tabel,fk_bagian_id},
        success: function(msg){
            $('#fk_kegiatan_id').html(msg.nama_keg);
            $('#fk_kegiatan_id').trigger("chosen:updated");
        }
    });     
}

$("#fk_kegiatan_id").change(function(){
    fk_kegiatan_id = $(this).val();
    fk_bagian_id = $("#fk_bagian_id").val();
    
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'KwitansiHR/getCariRekeningBelanja'?>",
        data: {fk_bagian_id,fk_kegiatan_id,tabel},
        success: function(msg){
            $('#fk_rekening_belanja_id').html(msg.nama_rek);
            $('#fk_rekening_belanja_id').trigger("chosen:updated");
        }
    });   

});

$("#fk_rekening_belanja_id").change(function(){
    id_rek = $(this).val();
    bulan = $("#bulan").val();
    
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'KwitansiHR/getCariDanaSblm'?>",
        data: {id_rek,bulan,tabel},
        success: function(msg){
            $('#jml_dana').val(msg.anggaran);
            $('#bts_anggaran').val(msg.bts_smster);
            $('#pengajuan_sebelum').val(msg.dana_sebelum);
            $('#tot_pajak_bpjs').val(msg.pajak_bpjs);
            $('#tot_pajak_kegiatan').val(msg.pajak_kegiatan);
            $('#tot_pajak_sblm').val(msg.pajak_sblm);
            $('#tot_pajak_rapat_sblm').val(msg.pajak_rapat_sblm);
            $('#tot_pajak_lembur_sblm').val(msg.pajak_lembur_sblm);
            sisaDana();
        }
    });   
});

function validateForm(assignmentForm){
    var messages = [];
    if($("#fk_bagian_id").val()==''){
        messages.push("Bagian, ");
    }
    if($("#fk_kegiatan_id").val()==''){
        messages.push("Sub Kegiatan Bappeda, ");
    }
    ssaKas = $("#sisa_kas").val();
    rep_ssaKas = ssaKas.replace(/,/g,"");
    if(rep_ssaKas < 0){
        messages.push("Sisa Kas Tidak Boleh Minus, ");
    }

    bts = $("#bts_anggaran").val();
    rep_bts = bts.replace(/,/g,"");

    sblm = $("#pengajuan_sebelum").val();
    rep_sblm = sblm.replace(/,/g,"");

    skrg = $("#pengajuan_sekarang").val();
    rep_skrg = skrg.replace(/,/g,"");
    tot_pengajuan = parseFloat(rep_sblm)+parseFloat(rep_skrg);

    if(tot_pengajuan > rep_bts){
        messages.push("Melebihi Batas Anggaran Per Semester, ");
    }

    if (messages.length > 0) { 
        messages.push("Tidak boleh kosong.");
        alert(messages.join('\n'));
        return false;
    } else {
        if(!confirm('Apakah anda yakin?')){
            return false;
        }
        return true;
    }
}

$("#tampil").click(function(){
    var messages = [];
    if($("#bulan").val()==''){
        messages.push("Bulan, ");
    }
    if($("#fk_bagian_id").val()==''){
        messages.push("Bagian, ");
    }
    if($("#fk_kegiatan_id").val()==''){
        messages.push("Kegiatan Bappeda, ");
    }
    if($("#fk_rekening_belanja_id").val()==''){
        messages.push("Rekening Belanja, ");
    }
    if (messages.length > 0) { 
        messages.push("Tidak boleh kosong.");
        alert(messages.join('\n'));
        return false;
    }
    tampilkan();
});

function tampilkan(){  
    fk_bagian_id = $("#fk_bagian_id").val();
    fk_kegiatan_id = $("#fk_kegiatan_id").val();
    
    $.ajax({
        type:'post',
        url: "<?php echo base_url()?>KwitansiHR/get_dataUpdateRekap",
        data:{tabel,fk_bagian_id,fk_kegiatan_id,kategori},
        beforeSend  : function(){
            $("body").css("cursor", "progress");      
        },
        success: function(data){
            $("body").css("cursor", "default");
            $("#tampilData").html(data);
        }
    });
};

$("#jml_dana").keyup(function(){
    sisaDana();
});
$("#pengajuan_sebelum").keyup(function(){
    sisaDana();
});
$("#pengajuan_sekarang").keyup(function(){
    sisaDana();
});

function sisaDana(){
    jml_dana = $("#jml_dana").val();
    if(jml_dana==''){
        jml_dana='0';
    }
    rep_jml_dana = jml_dana.replace(/,/g,"");

    pengajuan_sebelum = $("#pengajuan_sebelum").val();
    if(pengajuan_sebelum==''){
        pengajuan_sebelum='0';
    }
    rep_pengajuan_sebelum = pengajuan_sebelum.replace(/,/g,"");

    pengajuan_sekarang = $("#pengajuan_sekarang").val();
    if(pengajuan_sekarang==''){
        pengajuan_sekarang='0';
    }
    rep_pengajuan_sekarang = pengajuan_sekarang.replace(/,/g,"");

    sisa='';
    if(jml_dana!=''){
        tot = parseFloat(rep_jml_dana)-(parseFloat(rep_pengajuan_sebelum)+parseFloat(rep_pengajuan_sekarang));
        sisa = convertToRupiah(tot);
    }
    $("#sisa_kas").val(sisa);
}

</script>
                    