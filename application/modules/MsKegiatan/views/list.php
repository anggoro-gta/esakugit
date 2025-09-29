<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Sub Kegiatan</div>
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
                <?php if($this->session->userdata("level")==1 || $this->session->userdata("level")==3){ ?>
                <div class="box-inner">
                    <div class="box-content">                
                        <div class='form-horizontal' >
                                <div class="form-group">  
                                    <label class="col-md-2 control-label">Bagian</label>
                                    <div class="col-md-4">
                                        <select class="form-control chosen kosong" name="fk_bagian_id" id="fk_bagian_id">
                                            <option value="">Pilih</option>
                                            <?php foreach($arrMsBagian as $bd): ?>
                                                <option value="<?=$bd['id']?>"><?=$bd['nama_bagian']?></option>
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
                <?php }else{ ?>
                    <input type="hidden" name="fk_bagian_id" id="fk_bagian_id" value="<?=$this->session->userdata("fk_bagian_id")?>">
                <?php }?>
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
    fk_bagian_id = $("#fk_bagian_id").val(); 
    
    $.ajax({
        type:'post',
        url: "<?php echo base_url()?>MsKegiatan/getListDetail",
        data:{fk_bagian_id},
        beforeSend  : function(){
            $("body").css("cursor", "progress");      
        },
        success: function(data){
            $("body").css("cursor", "default");
            $("#tampilData").html(data);
        }
    });
};

$("#reset").click(function(){
    $(".kosong").val('');
    $('#bulan').trigger("chosen:updated");
    $('#fk_bagian_id').trigger("chosen:updated");
});

</script>