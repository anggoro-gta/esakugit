<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Rekanan Swakelola</div>
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
                        <form action="<?=base_url()?>MsRekananSwakelola/save" method="post" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-md-2 control-label required">Nama Rekanan</label>
                                <div class="col-md-5">
                                    <input name="nama_rekanan" class="form-control" value="<?=$nama_rekanan?>" required></input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Nama Pimpinan</label>
                                <div class="col-md-5">
                                    <input name="nama_pimpinan" class="form-control" value="<?=$nama_pimpinan?>"></input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Jabatan</label>
                                <div class="col-md-5">
                                     <input name="jabatan" class="form-control" value="<?=$jabatan?>"></input>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 control-label">NPWP</label>
                                <div class="col-md-5">
                                     <input name="npwp" class="form-control" value="<?=$npwp?>" required></input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Nama Bank</label>
                                <div class="col-md-5">
                                    <input name="nama_bank" class="form-control" value="<?=$nama_bank?>"></input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">No Rekening</label>
                                <div class="col-md-5">
                                    <input name="no_rekening" class="form-control" value="<?=$no_rekening?>"></input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Atas Nama Rekening</label>
                                <div class="col-md-5">
                                    <input name="atas_nama_rekening" class="form-control" value="<?=$atas_nama_rekening?>"></input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Kab/Kota</label>
                                <div class="col-md-5">
                                     <input name="kab_kota" class="form-control" value="<?=$kab_kota?>"></input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Alamat</label>
                                <div class="col-md-5">
                                    <textarea name="alamat" class="form-control"><?=$alamat?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Tlp</label>
                                <div class="col-md-5">
                                    <input type="text" name="tlp" class="form-control" value="<?=$tlp?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Status</label>
                                <div class="col-md-2">
                                    <select class="form-control chosen" name="status">
                                        <option <?= $status=='1'?'selected':'';?> value="1">Aktif</option>
                                        <option <?= $status=='0'?'selected':'';?> value="0">Tidak Aktif</option>
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
                                    <a href="<?=base_url()?>MsRekananSwakelola" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-chevron-left"></i> kembali</a>
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