<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Entri Data</div>
        </div>
    </div>
</section>
<section class="content_section">
    <div class="content_spacer">
        <div class="content">
            <div class="box col-md-12">
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Sukses!</strong> <?php echo $this->session->flashdata('success') ?>
                    </div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Error!</strong> <?php echo $this->session->flashdata('error') ?>
                    </div>
                <?php endif; ?>
                <div class="box-inner">
                    <div class="box-content">                
                        <div class='form-horizontal' >
                            <div class="form-group"> 
                                <label class="col-md-2 control-label">Nomor</label>
                                <div class="col-md-2">
                                    <input type="text" id="nomor" class="form-control">
                                </div>
                                <label class="col-md-2 control-label">Bulan</label>
                                <div class="col-md-2">
                                    <select class="form-control chosen" name="bulan" id="bulan" >
                                        <option value="">Pilih</option>
                                        <?php foreach($arrBulan as $key => $bl): ?>
                                            <option value="<?=$key?>"><?=$bl?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">  
                                <label class="col-md-2 control-label">Bagian</label>
                                <div class="col-md-2">
                                    <select class="form-control chosen" name="fk_bagian_id" id="fk_bagian_id" >
                                        <option value="">Pilih</option>
                                        <?php foreach($arrMsBagian as $val): ?>
                                            <option value="<?=$val['id']?>"><?=$val['nama_bagian']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <label class="col-md-2 control-label">Program</label>
                                <div class="col-md-4">
                                    <select class="form-control chosen" name="fk_program_id" id="fk_program_id" >
                                        <option value="">Pilih</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group"> 
                                <label class="col-md-2 control-label">Kegiatan Bappeda</label>
                                <div class="col-md-5">
                                    <select class="form-control chosen" name="fk_kegiatan_id" id="fk_kegiatan_id" >
                                        <option value="">Pilih</option>
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <a class="btn btn-success" id="tampil"><i class="glyphicon glyphicon-search"></i> Tampilkan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="tampilData"></div>
</section>
<script type="text/javascript">
$(document).ready(function(){
    data();
});  
$("#tampil").click(function(){
    data();
});
function data(){   
    nomor = $("#nomor").val(); 
    bulan = $("#bulan").val(); 
    fk_bagian_id = $("#fk_bagian_id").val(); 
    fk_program_id = $("#fk_program_id").val(); 
    fk_kegiatan_id = $("#fk_kegiatan_id").val(); 
    
    $.ajax({
        type:'post',
        url: "<?php echo base_url()?>Entri/getListDetail",
        data:{nomor,bulan,fk_bagian_id,fk_program_id,fk_kegiatan_id},
        beforeSend  : function(){
            $("body").css("cursor", "progress");      
        },
        success: function(data){
            $("body").css("cursor", "default");
            $("#tampilData").html(data);
        }
    });
};

$("#fk_bagian_id").change(function(){
    fk_bagian_id = $("#fk_bagian_id").val();
    fk_program_id = '';
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'MsKegiatan/getProgram'?>",
        data: {fk_bagian_id,fk_program_id},
        success: function(msg){
           $('#fk_program_id').html(msg.Bagian);
           $('#fk_program_id').trigger("chosen:updated");
           $('#fk_kegiatan_id').html('');
           $('#fk_kegiatan_id').trigger("chosen:updated");
        }
    });     
});

$("#fk_program_id").change(function(){
    fk_bagian_id = $("#fk_bagian_id").val();
    fk_program_id =  $(this).val();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Entri/getKegiatan'?>",
        data: {fk_bagian_id,fk_program_id},
        success: function(msg){
           $('#fk_kegiatan_id').html(msg.kegiatan);
           $('#fk_kegiatan_id').trigger("chosen:updated");
        }
    });     
});

</script>