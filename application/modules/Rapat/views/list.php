<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Makan Minum Rapat</div>
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
                <?php if ($this->session->flashdata('error2')): ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Error!</strong> <?php echo print_r($this->session->flashdata('error2')) ?>
                    </div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('warning')): ?>
                    <div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Error!</strong> <?php echo $this->session->flashdata('warning') ?>
                    </div>
                <?php endif; ?>
                <div class="box-inner">
                    <div class="box-content">                
                        <div class='form-horizontal' >
                            <div class="form-group">  
                                <?php if($this->session->userdata("level")==1 || $this->session->userdata("level")==3){ ?>
                                    <label class="col-md-2 control-label">Bagian</label>
                                    <div class="col-md-4">
                                        <select class="form-control chosen kosong" name="fk_bagian_id" id="fk_bagian_id">
                                            <option value="">Pilih</option>
                                            <?php foreach($arrMsBagian as $bd): ?>
                                                <option value="<?=$bd['id']?>"><?=$bd['nama_bagian']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                <?php }else{ ?>
                                    <input type="hidden" name="fk_bagian_id" id="fk_bagian_id" value="<?=$this->session->userdata("fk_bagian_id")?>">
                                <?php }?>
                                <label class="col-md-2 control-label">Kegiatan</label>
                                <div class="col-md-4">
                                    <select class="form-control chosen kosong" name="fk_program_id" id="fk_program_id" >
                                        <option value="">Pilih</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group"> 
                                <label class="col-md-2 control-label">Sub Kegiatan</label>
                                <div class="col-md-5">
                                    <select class="form-control chosen kosong" name="fk_kegiatan_id" id="fk_kegiatan_id" >
                                        <option value="">Pilih</option>
                                    </select>
                                </div>
                                <label class="col-md-1 control-label">Bulan SPJ</label>
                                <div class="col-md-2">
                                    <select class="form-control chosen kosong" name="bulan" id="bulan" >
                                        <option value="">Pilih</option>
                                        <?php foreach($arrBulan as $key => $bl): ?>
                                            <option value="<?=$key?>"><?=$bl?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group"> 
                                <div class="col-md-12" align="center">
                                    <a class="btn btn-sm btn-success" id="tampil"><i class="glyphicon glyphicon-search"></i> Tampilkan</a>
                                    <a class="btn btn-sm btn-primary" id="reset"><i class=""></i> Reset</a>
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
    cari_program();
    data();
});  
$("#tampil").click(function(){
    data();
});
function data(){    
    bulan = $("#bulan").val(); 
    fk_bagian_id = $("#fk_bagian_id").val(); 
    fk_program_id = $("#fk_program_id").val(); 
    fk_kegiatan_id = $("#fk_kegiatan_id").val(); 
    
    $.ajax({
        type:'post',
        url: "<?php echo base_url()?>Rapat/getListDetail",
        data:{bulan,fk_bagian_id,fk_program_id,fk_kegiatan_id},
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
    cari_program();
});

function cari_program(){
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
}

$("#fk_program_id").change(function(){
    fk_bagian_id = $("#fk_bagian_id").val();
    fk_program_id =  $(this).val();
    fk_kegiatan_id=null;
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Pjd/getKegiatan'?>",
        data: {fk_bagian_id,fk_program_id,fk_kegiatan_id},
        success: function(msg){
           $('#fk_kegiatan_id').html(msg.kegiatan);
           $('#fk_kegiatan_id').trigger("chosen:updated");
        }
    });     
});

$("#reset").click(function(){
    $(".kosong").val('');
    $('#bulan').trigger("chosen:updated");
   $('#fk_bagian_id').trigger("chosen:updated");
   $('#fk_program_id').trigger("chosen:updated");
   $('#fk_kegiatan_id').trigger("chosen:updated");
});

</script>