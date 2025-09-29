<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Rekening Belanja</div>
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
                        <form action="<?=base_url()?>MsRekeningBelanja/save" method="post" class="form-horizontal">
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Sub Kegiatan</label>
                                <div class="col-md-5">
                                    <select class="form-control chosen" name="fk_kegiatan_id" id="fk_kegiatan_id" required>
                                        <option value="">Pilih</option>
                                        <?php foreach($arrKegiatan as $val): ?>
                                            <option <?= $fk_kegiatan_id==$val['id']?'selected':'';?> value="<?=$val['id']?>"><?=$val['kegiatan']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Kode Rekening Belanja</label>
                                <div class="col-md-5">
                                    <input name="kode_rek_belanja" class="form-control" value="<?=$kode_rek_belanja?>" required></input>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Nama Rekening Belanja</label>
                                <div class="col-md-5">
                                    <input name="nama_rek_belanja" class="form-control" value="<?=$nama_rek_belanja?>" required></input>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Pagu Anggaran</label>
                                <div class="col-md-2">
                                    <input name="anggaran" class="form-control nominal" value="<?=$anggaran?>" required></input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Perubahan Perbup 1</label>
                                <div class="col-md-2">
                                    <input name="anggaran_per_perbup1" class="form-control nominal" value="<?=$anggaran_per_perbup1?>"></input>
                                </div>
                                <label class="col-md-1 control-label">Tgl Perbup 1</label>
                                <div class="col-md-2">
                                    <input name="tgl_per_perbup1" class="form-control text-center tanggal" value="<?=$tgl_per_perbup1?>"></input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Perubahan Perbup 2</label>
                                <div class="col-md-2">
                                    <input name="anggaran_per_perbup2" class="form-control nominal" value="<?=$anggaran_per_perbup2?>"></input>
                                </div>
                                 <label class="col-md-1 control-label">Tgl Perbup 2</label>
                                <div class="col-md-2">
                                    <input name="tgl_per_perbup2" class="form-control text-center tanggal" value="<?=$tgl_per_perbup2?>"></input>
                                </div>
                            </div>                            
                            <div class="form-group">
                                <label class="col-md-2 control-label">Perubahan Perbup 3</label>
                                <div class="col-md-2">
                                    <input name="anggaran_per_perbup3" class="form-control nominal" value="<?=$anggaran_per_perbup3?>"></input>
                                </div>
                                <label class="col-md-1 control-label">Tgl Perbup 3</label>
                                <div class="col-md-2">
                                    <input name="tgl_per_perbup3" class="form-control text-center tanggal" value="<?=$tgl_per_perbup3?>"></input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Perubahan Perbup 4</label>
                                <div class="col-md-2">
                                    <input name="anggaran_per_perbup4" class="form-control nominal" value="<?=$anggaran_per_perbup4?>"></input>
                                </div>
                                <label class="col-md-1 control-label">Tgl Perbup 4</label>
                                <div class="col-md-2">
                                    <input name="tgl_per_perbup4" class="form-control text-center tanggal" value="<?=$tgl_per_perbup4?>"></input>
                                </div>
                            </div>                           
                            <div class="form-group">
                                <label class="col-md-2 control-label">Anggaran PAK</label>
                                <div class="col-md-2">
                                    <input name="anggaran_pak" class="form-control nominal" value="<?=$anggaran_pak?>"></input>
                                </div>
                                <label class="col-md-1 control-label">Tgl PAK</label>
                                <div class="col-md-2">
                                    <input name="tgl_pak" class="form-control text-center tanggal" value="<?=$tgl_pak?>"></input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Batas Anggaran Semester 1</label>
                                <div class="col-md-2">
                                    <input name="bts_anggaran_semester_1" class="form-control nominal" value="<?=$bts_anggaran_semester_1?>"></input>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?=$id?>">

                            <div class="form-group">
                                <div class="col-md-12">&nbsp;</div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-2"></div>
                                <div class="col-md-2" align="center">
                                    <a href="<?=base_url()?>MsRekeningBelanja" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-chevron-left"></i> kembali</a>
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