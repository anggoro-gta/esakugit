<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Pembuatan Data Gaji dan TPP</div>
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
    kategori = 'Jasa Lainnya/ Jasa Konsultansi/ Pekerjaan Kontruksi';
    buttonCreate = 'lainnya'
    
    $.ajax({
        type:'post',
        url: "<?php echo base_url()?>GajiTpp/getListDetail",
        data:{bulan,fk_bagian_id,fk_program_id,fk_kegiatan_id,kategori,buttonCreate},
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
        url: "<?php echo base_url().'PesananBarang/getProgram'?>",
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
        url: "<?php echo base_url().'PesananBarang/getKegiatan'?>",
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