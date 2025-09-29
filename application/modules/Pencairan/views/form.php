<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Proses Pencairan</div>
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
                                    <label class="col-md-3 control-label">Tgl Pencairan</label>
                                    <div class="col-md-4">
                                        <input type="text" name="tgl_pencairan" id="tgl_pencairan" class="form-control tanggal text-center" required>
                                    </div>
                                </div>   
                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Jenis Anggaran</label>
                                    <div class="col-md-4">
                                        <select class="form-control chosen" name="jenis_anggaran" required>
                                            <option value="">Pilih</option>
                                            <option value="anggaran_awal">Anggaran Awal</option>
                                            <option value="per_perbup1">Perubahan Perbup 1</option>
                                            <option value="per_perbup2">Perubahan Perbup 2</option>
                                            <option value="per_perbup3">Perubahan Perbup 3</option>
                                            <option value="per_perbup4">Perubahan Perbup 4</option>
                                            <option value="pak">PAK</option>
                                        </select>
                                    </div>
                                </div>                             
                                <?php if($this->session->userdata("level")==1){ ?>
                                    <div class="form-group required">  
                                        <label class="col-md-3 control-label">Bagian</label>
                                        <div class="col-md-8">
                                            <select class="form-control chosen" name="fk_bagian_id" id="fk_bagian_id" required>
                                                <option value="">Pilih</option>
                                                <?php foreach ($arrBagian as $bid) { ?>
                                                    <option value="<?=$bid['id']?>"><?=$bid['nama_bagian']?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>                               
                                <?php }else{ ?>
                                    <input type="hidden" name="fk_bagian_id" id="fk_bagian_id" value="<?=$this->session->userdata("fk_bagian_id")?>" required readonly>
                                <?php }?>                                
                                <div class="form-group required">  
                                    <label class="col-md-3 control-label">KPA</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="nama_pejabat_kpa" id="nama_pejabat_kpa" required>
                                            <option value="">Pilih</option>
                                            <?php foreach($arrKPA as $val2): ?>
                                                <?php
                                                    $jbtn = ($val2->jabatan_baru==' ')?$val2->jabatan:$val2->jabatan_baru;
                                                ?>
                                                <option <?=$nama_pejabat_kpa==$val2->nama?'selected':''?> value="<?=$val2->nama.'_'.$val2->nip.'_'.$jbtn?>"><?=$val2->nama.' ['.$jbtn.']'?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group required">  
                                    <label class="col-md-3 control-label">PPTK</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="nama_pejabat_pptk" required>
                                            <option value="">Pilih</option>
                                            <?php foreach($arrPPTK as $val2): ?>
                                                <?php
                                                    $jbtn = ($val2->jabatan_baru==' ')?$val2->jabatan:$val2->jabatan_baru;
                                                ?>
                                                <option <?=$nama_pejabat_pptk==$val2->nama?'selected':''?> value="<?=$val2->nama.'_'.$val2->nip.'_'.$jbtn?>"><?=$val2->nama.' ['.$jbtn.']'?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">  
                                    <label class="col-md-3 control-label">PPTK 2 (Opsional)</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="nama_pejabat_pptk2">
                                            <option value="">Pilih</option>
                                            <?php foreach($arrPPTK as $val2): ?>
                                                <?php
                                                    $jbtn = ($val2->jabatan_baru==' ')?$val2->jabatan:$val2->jabatan_baru;
                                                ?>
                                                <option <?=$nama_pejabat_pptk2==$val2->nama?'selected':''?> value="<?=$val2->nama.'_'.$val2->nip.'_'.$jbtn?>"><?=$val2->nama.' ['.$jbtn.']'?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group required">  
                                    <label class="col-md-3 control-label">Bendahara Pengeluaran Pembantu</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="nama_bendahara_pembantu" id="nama_bendahara_pembantu" required>
                                            <option value="">Pilih</option>
                                            <!-- <?php foreach($arrBendahara as $val2): ?>
                                               <option <?=$nama_bendahara==$val2->nama?'selected':''?> value="<?=$val2->nama.'_'.$val2->nip?>"><?=$val2->nama?></option>
                                            <?php endforeach; ?> -->
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
                                <button id="submit" type="submit" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-hdd"></i> Proses</button>
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
    cari_bndhr_pmbntu($("#fk_bagian_id").val());
});


$("#tampil").click(function(){
    tgl_pencairan = $("#tgl_pencairan").val();
    if(tgl_pencairan==''){
       alert("Tgl Pencairan, Tidak boleh kosong.");
       return false;
    }
    fk_bagian_id = $("#fk_bagian_id").val();
    if(fk_bagian_id==''){
       alert("Bagian, Tidak boleh kosong.");
       return false;
    }
    tampilkan();
});

function tampilkan(){  
    fk_bagian_id = $("#fk_bagian_id").val();
    tgl_pencairan = $("#tgl_pencairan").val();
    
    $.ajax({
        type:'post',
        url: "<?php echo base_url()?>Pencairan/get_dataUpdatePencairan",
        data:{fk_bagian_id,tgl_pencairan},
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
    cari_bndhr_pmbntu($(this).val());
});

function cari_bndhr_pmbntu(fk_bagian_id=null){
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'PesananBarang/getBndhrPmbantu'?>",
        data: {fk_bagian_id},
        success: function(msg){
           $('#nama_bendahara_pembantu').html(msg.bnhrPmbt);
           $('#nama_bendahara_pembantu').trigger("chosen:updated");
        }
    });     
}

</script>
                    