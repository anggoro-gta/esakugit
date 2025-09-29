<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Bagian</div>
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
                        <form action="<?=base_url()?>MsBagian/save" method="post" class="form-horizontal">
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Nama Bagian</label>
                                <div class="col-md-5">
                                     <input name="nama_bagian" class="form-control" value="<?=$nama_bagian?>" required></input>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Singkatan Bagian</label>
                                <div class="col-md-5">
                                     <input name="singkatan_bagian" class="form-control" value="<?=$singkatan_bagian?>" required></input>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Kode Bagian</label>
                                <div class="col-md-5">
                                     <input name="kode_bagian" class="form-control" value="<?=$kode_bagian?>" required></input>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Kelompok Asisten</label>
                                <div class="col-md-5">
                                    <select class="form-control chosen" name="kelompok_asisten" id="kelompok_asisten" required>
                                        <option value="">Pilih</option>
                                        <?php foreach($arrAssisten as $ass): ?>
                                            <option <?=$kelompok_asisten==$ass->nama_jabatan?'selected':''?> value="<?=$ass->nama_jabatan?>"><?=$ass->nama_jabatan?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?=$id?>">

                            <div class="form-group">
                                <div class="col-md-12">&nbsp;</div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-2"></div>
                                <div class="col-md-2" align="center">
                                    <a href="<?=base_url()?>MsBagian" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-chevron-left"></i> kembali</a>
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