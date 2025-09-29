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
                <div class="box-inner">
                    <div class="box-header well">
                        <h2><?=$this->help->labelnya()?></h2>
                    </div>
                    <div class="box-content">
                        <form action="<?=base_url()?>MsKegiatan/save" method="post" class="form-horizontal">
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Tahun</label>
                                <div class="col-md-5">
                                     <input name="tahun" class="form-control" value="<?=$tahun?>" readonly required></input>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Bagian</label>
                                <div class="col-md-5">
                                    <select class="form-control chosen" name="fk_bagian_id" id="fk_bagian_id">
                                        <option value="">Pilih</option>
                                        <?php foreach($arrMsBagian as $val): ?>
                                            <option <?= $fk_bagian_id==$val['id']?'selected':'';?> value="<?=$val['id']?>"><?=$val['nama_bagian']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Kegiatan</label>
                                <div class="col-md-5">
                                    <select class="form-control chosen" name="fk_program_id" id="fk_program_id" >
                                        <option value="">Pilih</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Sub Kegiatan</label>
                                <div class="col-md-5">
                                     <input name="kegiatan" class="form-control" value="<?=$kegiatan?>" required></input>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Kode Sub Kegiatan</label>
                                <div class="col-md-5">
                                     <input name="kode_kegiatan" class="form-control" value="<?=$kode_kegiatan?>" required></input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Singkatan</label>
                                <div class="col-md-5">
                                     <input name="singkatan" class="form-control" value="<?=$singkatan?>" ></input>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?=$id?>">

                            <div class="form-group">
                                <div class="col-md-12">&nbsp;</div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-2"></div>
                                <div class="col-md-2" align="center">
                                    <a href="<?=base_url()?>MsKegiatan" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-chevron-left"></i> kembali</a>
                                    <button type="submit" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-hdd"></i> <?=$button;?></button>
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
    programnya();
});

$("#fk_bagian_id").change(function(){
    programnya();
});

function programnya(){
    fk_bagian_id = $("#fk_bagian_id").val();
    fk_program_id = "<?=$fk_program_id?>";
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'MsKegiatan/getProgram'?>",
        data: {fk_bagian_id,fk_program_id},
        success: function(msg){
           $('#fk_program_id').html(msg.Bagian);
           $('#fk_program_id').trigger("chosen:updated");
        }
    }); 
}
</script>