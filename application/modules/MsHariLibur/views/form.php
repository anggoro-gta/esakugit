<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Hari Libur</div>
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
                        <form action="<?=base_url()?>MsHariLibur/save" method="post" class="form-horizontal">
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Tanggal</label>
                                <div class="col-md-2">
                                     <input name="tanggal" class="form-control tanggal" value="<?=$tanggal?>" style="text-align: center" required></input>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Keterangan</label>
                                <div class="col-md-5">
                                     <input name="keterangan" class="form-control upper" value="<?=$keterangan?>" required></input>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?=$id?>">

                            <div class="form-group">
                                <div class="col-md-12">&nbsp;</div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-2"></div>
                                <div class="col-md-2" align="center">
                                    <a href="<?=base_url()?>MsHariLibur" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-chevron-left"></i> kembali</a>
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