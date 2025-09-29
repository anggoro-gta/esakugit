<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Kegiatan</div>
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
                        <form action="<?=base_url()?>MsProgram/save" method="post" class="form-horizontal">
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Nama Bagian</label>
                                <div class="col-md-5">
                                    <select class="form-control chosen" name="fk_bagian_id" required >
                                        <option value="">Pilih</option>
                                        <?php foreach($arrMsBagian as $val): ?>
                                            <option <?= $fk_bagian_id==$val['id']?'selected':'';?> value="<?=$val['id']?>"><?=$val['nama_bagian']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Nama Program</label>
                                <div class="col-md-5">
                                    <select class="form-control chosen" name="fk_program_utama_id" required >
                                        <option value="">Pilih</option>
                                        <?php foreach($arrMsProgUtama as $val2): ?>
                                            <option <?= $fk_program_utama_id==$val2['id']?'selected':'';?> value="<?=$val2['id']?>"><?=$val2['program_utama']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Nama Kegiatan</label>
                                <div class="col-md-5">
                                     <input name="nama_program" class="form-control" value="<?=$nama_program?>" required></input>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Kode Kegiatan</label>
                                <div class="col-md-5">
                                     <input name="kode_program" class="form-control" value="<?=$kode_program?>" required></input>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Masa Berlaku</label>
                                <div class="col-md-2">
                                    <input type="text" style="text-align: center" name="thn_dari" class="form-control tahun" value="<?=$thn_dari?>" required>
                                </div>
                                <label class="col-md-1 control-label" style="text-align: center">S/D</label>
                                <div class="col-md-2">
                                    <input type="text" style="text-align: center" name="thn_sampai" class="form-control tahun" value="<?=$thn_sampai?>" required>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?=$id?>">

                            <div class="form-group">
                                <div class="col-md-12">&nbsp;</div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-2"></div>
                                <div class="col-md-2" align="center">
                                    <a href="<?=base_url()?>MsProgram" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-chevron-left"></i> kembali</a>
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