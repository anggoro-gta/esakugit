<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Tarif PJD</div>
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
                        <form action="<?=base_url()?>MsTarifPjd/save" method="post" class="form-horizontal">
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
                                <label class="col-md-2 control-label">Sub Kategori</label>
                                <div class="col-md-5">
                                     <select class="form-control chosen" name="fk_sub_kategori_id" id="fk_sub_kategori_id" required>
                                        <option value="">Pilih</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Eselon</label>
                                <div class="col-md-2">
                                     <select class="form-control chosen" name="eselon" required>
                                        <option value="">Pilih</option>
                                        <?php foreach($arrMsEselon as $val): ?>
                                            <option <?= $eselon==$val['nama_eselon']?'selected':'';?> value="<?=$val['nama_eselon']?>"><?=$val['nama_eselon']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group required" id="kolom_pegawai">
                                <label class="col-md-2 control-label">Pegawai</label>
                                <div class="col-md-2">
                                    <select class="form-control chosen" name="pegawai">
                                        <option value="">.: Pilih :.</option>
                                        <option <?=$pegawai=='PNS'?'selected':''?> value="PNS">PNS</option>
                                        <option <?=$pegawai=='NON ASN'?'selected':''?> value="NON ASN">NON ASN</option>
                                    </select>
                                </div> 
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Tarif</label>
                                <div class="col-md-2">
                                     <input name="tarif" class="form-control nominal" value="<?=$tarif?>" required></input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Tarif Representasi</label>
                                <div class="col-md-2">
                                     <input name="tarif_representasi" class="form-control nominal" value="<?=$tarif_representasi?>"></input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Keterangan</label>
                                <div class="col-md-5">
                                     <input name="keterangan" class="form-control" value="<?=$keterangan?>" ></input>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?=$id?>">

                            <div class="form-group">
                                <div class="col-md-12">&nbsp;</div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-2"></div>
                                <div class="col-md-2" align="center">
                                    <a href="<?=base_url()?>MsTarifPjd" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-chevron-left"></i> kembali</a>
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
    cari_sub("<?=$fk_sub_kategori_id?>");
});

$("#kategori").change(function(){
    cari_sub();
});

function cari_sub(subKat=null){
    kategori = $("#kategori").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'MsTarifPjd/getSubKategori'?>",
        data: {kategori,subKat},
        success: function(msg){
           $('#fk_sub_kategori_id').html(msg.sub);
           $('#fk_sub_kategori_id').trigger("chosen:updated");
        }
    });     
}
</script>