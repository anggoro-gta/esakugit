<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Tarif Lembur</div>
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
                        <form action="<?=base_url()?>MsTarifLembur/save" method="post" class="form-horizontal">
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Kategori Pegawai</label>
                                <div class="col-md-2">
                                    <select class="form-control chosen" name="kategori" id="kategori" required>
                                        <option value="">.: Pilih :.</option>
                                        <option <?=$kategori=='PNS'?'selected':''?> value="PNS">PNS</option>
                                        <option <?=$kategori=='PPPK'?'selected':''?> value="PPPK">PPPK</option>
                                        <option <?=$kategori=='NON ASN'?'selected':''?> value="NON ASN">NON ASN</option>
                                    </select>
                                </div> 
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Golongan</label>
                                <div class="col-md-2">
                                    <select class="form-control chosen" name="golongan" id="golongan" required>
                                        <option value="">.: Pilih :.</option><!-- 
                                        <option <?=$golongan=='IV'?'selected':''?> value="VI">VI (PNS)</option>
                                        <option <?=$golongan=='III'?'selected':''?> value="III">III (PNS)</option>
                                        <option <?=$golongan=='II'?'selected':''?> value="II">II (PNS)</option>
                                        <option <?=$golongan=='I'?'selected':''?> value="I">I (PNS)</option>
                                        <option <?=$golongan=='IX'?'selected':''?> value="IX">IX (PPPK)</option>
                                        <option <?=$golongan=='VII'?'selected':''?> value="VII">VII (PPPK)</option>
                                        <option <?=$golongan=='V'?'selected':''?> value="V">V (PPPK)</option>
                                        <option <?=$golongan=='I'?'selected':''?> value="I">I (PPPK)</option>
                                        <option <?=$golongan=='NON ASN'?'selected':''?> value="NON ASN">NON ASN</option> -->
                                    </select>
                                </div> 
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Tarif Lembur</label>
                                <div class="col-md-2">
                                     <input name="tarif" class="form-control nominal" value="<?=$tarif?>" required></input>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Potongan PPh21 (%)</label>
                                <div class="col-md-2">
                                     <input type="number" name="pot_pph" class="form-control angka" value="<?=$pot_pph?>" required></input>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Tarif Uang Makan</label>
                                <div class="col-md-2">
                                     <input name="uang_makan" class="form-control nominal" value="<?=$uang_makan?>" required></input>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?=$id?>">

                            <div class="form-group">
                                <div class="col-md-12">&nbsp;</div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-2"></div>
                                <div class="col-md-2" align="center">
                                    <a href="<?=base_url()?>MsTarifLembur" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-chevron-left"></i> kembali</a>
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
<script>
$(document).ready(function(){
    cari_gol("<?=$golongan?>");
});

$("#kategori").change(function(){
    cari_gol();
});

function cari_gol(golongan=null){
    kategori = $("#kategori").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'MsTarifLembur/golTarif'?>",
        data: {kategori,golongan},
        success: function(msg){
           $('#golongan').html(msg.hsl);
           $('#golongan').trigger("chosen:updated");
        }
    });   
}
</script>