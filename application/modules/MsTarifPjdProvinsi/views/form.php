<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Tarif PJD Provinsi</div>
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
                        <form action="<?=base_url()?>MsTarifPjdProvinsi/save" method="post" class="form-horizontal">
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Provinsi</label>
                                <div class="col-md-5">
                                     <input name="provinsi" class="form-control" value="<?=$provinsi?>" required></input>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Tarif DD</label>
                                <div class="col-md-2">
                                     <input name="tarif_dd" class="form-control nominal" value="<?=$tarif_dd?>" required></input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Tarif DL</label>
                                <div class="col-md-2">
                                     <input name="tarif_dl" class="form-control nominal" value="<?=$tarif_dl?>"></input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Tarif Diklat</label>
                                <div class="col-md-2">
                                     <input name="tarif_diklat" class="form-control nominal" value="<?=$tarif_diklat?>"></input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Tarif Fullboard</label>
                                <div class="col-md-2">
                                     <input name="tarif_fullboard" class="form-control nominal" value="<?=$tarif_fullboard?>"></input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Tarif Bimtek</label>
                                <div class="col-md-2">
                                     <input name="tarif_bimtek" class="form-control nominal" value="<?=$tarif_bimtek?>"></input>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?=$id?>">

                            <div class="form-group">
                                <div class="col-md-12">&nbsp;</div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-2"></div>
                                <div class="col-md-2" align="center">
                                    <a href="<?=base_url()?>MsTarifPjdProvinsi" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-chevron-left"></i> kembali</a>
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

</script>