<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Barang</div>
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
                        <form action="<?=base_url()?>MsBarang/save" method="post" class="form-horizontal">
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Tahun Awal</label>
                                <div class="col-md-5">
                                    <input name="masa_thn_awal" class="form-control tahun" value="<?=$masa_thn_awal?>" required></input>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Tahun Akhir</label>
                                <div class="col-md-5">
                                    <input name="masa_thn_akhir" class="form-control tahun" value="<?=$masa_thn_akhir?>" required></input>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Kode Barang</label>
                                <div class="col-md-5">
                                    <input name="kode_barang" class="form-control" value="<?=$kode_barang?>" required></input>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Kategori Barang</label>
                                <div class="col-md-5">
                                    <select class="form-control chosen" name="fk_kategori_barang_id" id="fk_kategori_barang_id" required>
                                        <option value="">Pilih</option>
                                        <?php foreach($arrKategoriBarang as $val3): ?>
                                            <option <?=$fk_kategori_barang_id==$val3['id']?'selected':''?> value="<?=$val3['id']?>"><?=$val3['nama_kategori']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Nama Barang</label>
                                <div class="col-md-5">
                                    <input name="nama_barang" class="form-control" value="<?=$nama_barang?>" required></input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Merk</label>
                                <div class="col-md-5">
                                     <input name="merk" class="form-control" value="<?=$merk?>"></input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Spesifikasi</label>
                                <div class="col-md-5">
                                     <input name="spesifikasi" class="form-control" value="<?=$spesifikasi?>"></input>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Satuan</label>
                                <div class="col-md-5">
                                    <input type="text" name="satuan" class="form-control" value="<?=$satuan?>" required>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Harga Satuan</label>
                                <div class="col-md-2">
                                    <input type="text" name="std_harga_satuan" class="form-control nominal" value="<?=$std_harga_satuan?>" required>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?=$id?>">

                            <div class="form-group">
                                <div class="col-md-12">&nbsp;</div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-2"></div>
                                <div class="col-md-2" align="center">
                                    <a href="<?=base_url()?>MsBarang" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-chevron-left"></i> kembali</a>
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