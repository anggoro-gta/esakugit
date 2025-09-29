<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Cetak BKU</div>
            <h1>
                <a href="<?=base_url()?>Pjd" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-list-alt"></i> Tabel Data</a>
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
                        <form class="form-horizontal" enctype="multipart/form-data"> 
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Bulan</label>
                                <div class="col-md-2">
                                    <select class="form-control chosen" name="bulan" id="bulan" required>
                                        <option value="">Pilih</option>
                                        <?php foreach($arrBulan as $key => $bl): ?>
                                            <option value="<?=$key?>"><?=$bl?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>   
                            </div>
                            <div class="form-group required">  
                                <label class="col-md-2 control-label">Nama GU</label>
                                <div class="col-md-5">
                                    <select class="form-control chosen" name="fk_gu_id" id="fk_gu_id" >
                                        <option value="">Pilih</option>
                                    </select>
                                </div>  
                            </div>
                            <div class="form-group required">  
                                <label class="col-md-2 control-label">Bagian</label>
                                <div class="col-md-5">
                                    <select class="form-control chosen" name="fk_bagian_id" id="fk_bagian_id" >
                                        <option value="">Pilih</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group required">      
                                <label class="col-md-2 control-label">Sub Kegiatan</label>
                                <div class="col-md-5">
                                    <select class="form-control chosen" name="fk_kegiatan_id" id="fk_kegiatan_id" >
                                        <option value="">Pilih</option>
                                    </select>
                                </div>
                            </div> 
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Kategori</label>
                                <div class="col-md-2">
                                    <select class="form-control chosen" name="kategori" id="kategori" required>
                                        <option value="">.: Pilih :.</option>
                                        <option <?=$kategori=='DD'?'selected':''?> value="DD">DD</option>
                                        <option <?=$kategori=='DL'?'selected':''?> value="DL">DL</option>
                                    </select>
                                </div> 
                            </div>    
                            <div class="form-group required">
                                <label class="col-md-2 control-label">No BKU</label>
                                <div class="col-md-2">
                                    <select class="form-control chosen" name="no_bku" id="no_bku">
                                        <option value="">Pilih</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">                        
                                <div class="col-md-2"></div>
                                <div class="col-md-2">
                                    <a class="btn btn-sm btn-success" id="tampil"><i class="glyphicon glyphicon-search"></i> Tampilkan</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="tampilData"></div>
</section>
<script type="text/javascript">
$(document).ready(function(){
    tampilkan();
});

$("#bulan").change(function(){
    bln = $(this).val();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Pjd/getNamaGu'?>",
        data: {bln},
        success: function(msg){
           $('#fk_gu_id').html(msg.nama_gu);
           $('#fk_gu_id').trigger("chosen:updated");
           $('#fk_bagian_id').html('');
           $('#fk_bagian_id').trigger("chosen:updated");
           $('#fk_kegiatan_id').html('');
           $('#fk_kegiatan_id').trigger("chosen:updated");
        }
    });
});

$("#fk_gu_id").change(function(){
    cari_bagian();
});

function cari_bagian(){
    fk_gu_id = $("#fk_gu_id").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Pjd/getBagianGU'?>",
        data: {fk_gu_id},
        success: function(msg){
            $('#fk_bagian_id').html(msg.Bagian);
            $('#fk_bagian_id').trigger("chosen:updated");
            $('#fk_kegiatan_id').html('');
            $('#fk_kegiatan_id').trigger("chosen:updated");
        }
    });     
}

$("#fk_bagian_id").change(function(){
    cari_keg();
});

function cari_keg(){
    fk_gu_id = $("#fk_gu_id").val();
    fk_bagian_id = $("#fk_bagian_id").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Pjd/getKegiatanGU'?>",
        data: {fk_gu_id,fk_bagian_id},
        success: function(msg){
            $('#fk_kegiatan_id').html(msg.nama_keg);
            $('#fk_kegiatan_id').trigger("chosen:updated");
        }
    });     
}

$("#kategori").change(function(){
    bulan = $("#bulan").val();
    fk_gu_id = $("#fk_gu_id").val();
    fk_bagian_id = $("#fk_bagian_id").val();
    fk_kegiatan_id = $("#fk_kegiatan_id").val();
    kategori = $("#kategori").val();
    if(fk_kegiatan_id==''){
        alert('Kegiatan Bappeda harus diisi terlebih dahulu.');
        $('#kategori').val('');
        $('#kategori').trigger("chosen:updated");
        return false;
    }
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Pjd/getCariNoBKU'?>",
        data: {bulan,fk_gu_id,fk_bagian_id,fk_kegiatan_id,kategori},
        success: function(msg){
            $('#no_bku').html(msg.nomorBKU);
            $('#no_bku').trigger("chosen:updated");
        }
    });     
});

$("#tampil").click(function(){ 
    if($("#no_bku").val()==''){
        alert('No BKU tidak boleh kosong.');
        return false;
    }
    tampilkan();
});
function tampilkan(){ 
    no_bku = $("#no_bku").val(); 
    bulan = $("#bulan").val();
    fk_gu_id = $("#fk_gu_id").val();
    fk_bagian_id = $("#fk_bagian_id").val();
    fk_kegiatan_id = $("#fk_kegiatan_id").val();
    kategori = $("#kategori").val();
    
    $.ajax({
        type:'post',
        url: "<?php echo base_url()?>Pjd/get_dataBKU",
        data:{no_bku,bulan,fk_gu_id,fk_bagian_id,fk_kegiatan_id,kategori},
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
                    