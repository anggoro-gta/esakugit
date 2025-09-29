<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Jabatan</div>
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
                        <form action="<?=base_url()?>MsJabatan/save" method="post" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Nama Bagian</label>
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
                                <label class="col-md-2 control-label">Nama Jabatan</label>
                                <div class="col-md-5">
                                     <input name="nama_jabatan" class="form-control" value="<?=$nama_jabatan?>" required></input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Eselon</label>
                                <div class="col-md-5">
                                     <select class="form-control chosen" name="eselon">
                                        <option value="">Pilih</option>
                                        <?php foreach($arrMsEselon as $val2): ?>
                                            <option <?= $eselon==$val2['nama_eselon']?'selected':'';?> value="<?=$val2['nama_eselon']?>"><?=$val2['nama_eselon']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">No Urut TTD</label>
                                <div class="col-md-5">
                                     <input name="urut_ttd" class="form-control angka" value="<?=$urut_ttd?>" ></input>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?=$id?>">

                            <div class="form-group">
                                <div class="col-md-12">&nbsp;</div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-2"></div>
                                <div class="col-md-2" align="center">
                                    <a href="<?=base_url()?>MsJabatan" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-chevron-left"></i> kembali</a>
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