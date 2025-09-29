<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Hapus Rekap Belanja <?=$judul?></div>
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
                <div class="box-inner">
                    <div class="box-header well">
                        <h2><?=$this->help->labelnya()?></h2>
                    </div>
                    <div class="box-content">
                        <form class="form-horizontal" action="<?=$url?>" method="post" enctype="multipart/form-data" onsubmit="return validateForm();" id="assignmentForm"> 
                            <div class="col-md-6">
                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Bulan SPJ</label>
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
                                    <label class="col-md-3 control-label"><?=$judul=='Swakelola'?'No. SP2D':'No. TBP'?></label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="id_rekap_dana" id="id_rekap_dana" >
                                            <option value="">Pilih</option>
                                        </select>
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
                                <button id="submit" type="submit" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-hdd"></i> Hapus</button>
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
    // tampilkan();
    cari_keg();
});

$("#bulan").change(function(){
    cari_keg();
});

$("#fk_bagian_id").change(function(){
    cari_keg();
});

tabel = "<?=$tabel?>";
kategori = "<?=$kategori?>";

function cari_keg(){
    fk_bagian_id = $("#fk_bagian_id").val();
    bulan = $("#bulan").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'KwitansiHR/getKegiatanRekapDel'?>",
        data: {tabel,kategori,bulan,fk_bagian_id},
        success: function(msg){
            $('#fk_kegiatan_id').html(msg.nama_keg);
            $('#fk_kegiatan_id').trigger("chosen:updated");
        }
    });     
}

$("#fk_kegiatan_id").change(function(){
    fk_kegiatan_id = $(this).val();
    bulan = $("#bulan").val();

    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'KwitansiHR/getCariRekeningBelanjaDel'?>",
        data: {tabel,fk_kegiatan_id,bulan},
        success: function(msg){
            $('#fk_rekening_belanja_id').html(msg.nama_rek);
            $('#fk_rekening_belanja_id').trigger("chosen:updated");
        }
    });   

});

$("#fk_rekening_belanja_id").change(function(){
    id_rek = $(this).val();
    bulan = $("#bulan").val();
    fk_kegiatan_id = $("#fk_kegiatan_id").val();
    del='del';
    
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'KwitansiHR/getCariBKU'?>",
        data: {id_rek,bulan,fk_kegiatan_id,del},
        success: function(msg){
            $('#id_rekap_dana').html(msg.bku);
            $('#id_rekap_dana').trigger("chosen:updated");
        }
    });   
});

function validateForm(assignmentForm){
    var messages = [];
    if($("#fk_bagian_id").val()==''){
        messages.push("Bagian, ");
    }
    if($("#fk_kegiatan_id").val()==''){
        messages.push("Kegiatan Bappeda, ");
    }
    if($("#fk_rekening_belanja_id").val()==''){
        messages.push("Rek. Belanja, ");
    }
    if($("#id_rekap_dana").val()==''){
        messages.push("Bo BKU, ");
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
    if($("#id_rekap_dana").val()==''){
        messages.push("No BKU, ");
    }
    if (messages.length > 0) { 
        messages.push("Tidak boleh kosong.");
        alert(messages.join('\n'));
        return false;
    }
    tampilkan();
});

function tampilkan(){  
    id_rekap_dana = $("#id_rekap_dana").val();
    
    $.ajax({
        type:'post',
        url: "<?php echo base_url()?>KwitansiHR/get_dataDeleteRekap",
        data:{tabel,id_rekap_dana},
        beforeSend  : function(){
            $("body").css("cursor", "progress");      
        },
        success: function(data){
            $("body").css("cursor", "default");
            $("#tampilData").html(data);
        }
    });
};

</script>
                    