<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Belanja Barang (ATK, Kertas Cover Dll)</div>
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
                                <label class="col-md-2 control-label">No Surat Pesanan</label>
                                <div class="col-md-3">
                                    <input type="text" id="nomor" class="form-control kosong">
                                </div>
                                <label class="col-md-2 control-label">Nama Rekanan</label>
                                <div class="col-md-3">
                                    <select class="form-control chosen kosong" name="fk_rekanan_id" id="fk_rekanan_id" >
                                        <option value="">Pilih</option>
                                        <?php foreach($arrMsRekanan as $val): ?>
                                            <option value="<?=$val['id']?>"><?=$val['nama_rekanan']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php if($this->session->userdata("level")==1 || $this->session->userdata("level")==3){ ?>
                                    <label class="col-md-2 control-label">Bagian</label>
                                    <div class="col-md-3">
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
                                <label class="col-md-2 control-label">Bulan SPJ</label>
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
                                <label class="col-md-5 control-label"></label>
                                <div class="col-md-2">
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
    data();
});   
$("#tampil").click(function(){
    data();
});
function data(){   
    nomor = $("#nomor").val(); 
    fk_rekanan_id = $("#fk_rekanan_id").val();  
    fk_bagian_id = $("#fk_bagian_id").val();  
    bulan = $("#bulan").val();  
    
    $.ajax({
        type:'post',
        url: "<?php echo base_url()?>PesananBarang/getListDetail",
        data:{nomor,fk_rekanan_id,fk_bagian_id,bulan},
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
    $('#fk_rekanan_id').trigger("chosen:updated");
    $('#fk_bagian_id').trigger("chosen:updated");
    $('#bulan').trigger("chosen:updated");
});

</script>