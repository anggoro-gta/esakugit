<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">DPA / Dasar ST</div>
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
                        <form action="<?=base_url()?>MsDpa/save" method="post" class="form-horizontal">
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Nomor</label>
                                <div class="col-md-5">
                                     <input name="nomor" class="form-control" value="<?=$nomor?>" required></input>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Tgl Awal</label>
                                <div class="col-md-2">
                                     <input name="tgl_awal" class="form-control tanggal text-center" value="<?=$tgl_awal?>" required></input>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Tgl Akhir</label>
                                <div class="col-md-2">
                                     <input name="tgl_akhir" class="form-control tanggal text-center" value="<?=$tgl_akhir?>" required></input>
                                </div>
                            </div>
                            <!-- <div class="form-group required">
                                <label class="col-md-2 control-label">Keterangan</label>
                                <div class="col-md-6">
                                    <textarea name="keterangan" rows="7" class="form-control" required><?=$keterangan?></textarea>
                                </div>
                            </div> -->
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Keterangan</label>
                                <div class="col-md-8">
                                     <textarea name="keterangan" id="ckeditor" class="form-control" required rows="6"><?= !empty($keterangan)?$keterangan:''?></textarea>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?=$id?>">

                            <div class="form-group">
                                <div class="col-md-12">&nbsp;</div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-2"></div>
                                <div class="col-md-2" align="center">
                                    <a href="<?=base_url()?>MsDpa" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-chevron-left"></i> kembali</a>
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
<script src='<?php echo base_url().'charisma/'?>plugins/ckeditor/ckeditor.js'></script>
<script type="text/javascript">
    $(function() {
        CKEDITOR.replace('ckeditor',{
            // removePlugins: 'toolbar'
        });
    });     
</script>