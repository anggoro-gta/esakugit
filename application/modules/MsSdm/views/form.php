<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Pegawai</div>
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
                        <form action="<?=base_url()?>MsSdm/save" method="post" class="form-horizontal" autocomplete="off">
                            <div class="col-md-6">
                                <div class="form-group required">
                                    <label class="col-md-4 control-label">Nama</label>
                                    <div class="col-md-7">
                                         <input name="nama" class="form-control" value="<?=$nama?>" required></input>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-md-4 control-label">NIP</label>
                                    <div class="col-md-7">
                                         <input name="nip" class="form-control" value="<?=$nip?>" required></input>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Golongan/Pangkat</label>
                                    <div class="col-md-7">
                                        <select class="form-control chosen" name="gol_pangkat">
                                            <option value="">Pilih</option>
                                            <?php foreach($arrPngktGol as $valP): ?>
                                                <option <?= $gol_pangkat==$valP->nama_pangkat_gol?'selected':'';?> value="<?=$valP->nama_pangkat_gol?>"><?=$valP->nama_pangkat_gol?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Bagian</label>
                                    <div class="col-md-7">
                                        <select class="form-control chosen" name="fk_bagian_id"  id="fk_bagian_id">
                                            <option value="">Pilih</option>
                                            <?php foreach($arrMsBagian as $val): ?>
                                                <option <?= $fk_bagian_id==$val['id']?'selected':'';?> value="<?=$val['id']?>"><?=$val['nama_bagian']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Status Jabatan</label>
                                    <div class="col-md-7">
                                         <input name="status_jabatan" class="form-control" value="<?=$status_jabatan?>" placeholder="Diisi jika status masih Plt."></input>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Jabatan</label>
                                    <div class="col-md-7">
                                        <select class="form-control chosen" name="fk_jabatan_id" id="fk_jabatan_id">
                                            <option value="">Pilih</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-md-4 control-label">Status Pegawai</label>
                                    <div class="col-md-7">
                                        <select class="form-control chosen" name="status_pegawai" required>
                                            <option <?= $status_pegawai=='PNS'?'selected':'';?> value="PNS">PNS</option>
                                            <option <?= $status_pegawai=='PPPK'?'selected':'';?> value="PPPK">PPPK</option>
                                            <option <?= $status_pegawai=='Tenaga Ahli'?'selected':'';?> value="Tenaga Ahli">Tenaga Ahli</option>
                                            <option <?= $status_pegawai=='NON ASN'?'selected':'';?> value="NON ASN">NON ASN</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-md-4 control-label">Status</label>
                                    <div class="col-md-7">
                                        <select class="form-control chosen" name="status" required>
                                            <option <?= $status=='1'?'selected':'';?> value="1">Aktif</option>
                                            <option <?= $status=='0'?'selected':'';?> value="0">Tidak Aktif</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Pejabat KPA</label>
                                    <div class="col-md-7">
                                        <input name="pejabat_kpa" type="checkbox" <?=$pejabat_kpa==1?'checked':''?> >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Pejabat PPK</label>
                                    <div class="col-md-7">
                                        <input name="pejabat_ppk" type="checkbox" <?=$pejabat_ppk==1?'checked':''?> >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Pejabat PPTK</label>
                                    <div class="col-md-7">
                                        <input name="pejabat_pptk" type="checkbox" <?=$pejabat_pptk==1?'checked':''?> >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Bendahara</label>
                                    <div class="col-md-7">
                                        <input name="bendahara_bappeda" type="checkbox" <?=$bendahara_bappeda==1?'checked':''?> >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Bendahara Pembantu</label>
                                    <div class="col-md-7">
                                        <input name="bendahara_pembantu" type="checkbox" <?=$bendahara_pembantu==1?'checked':''?> >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">PPHP</label>
                                    <div class="col-md-7">
                                        <input name="pphp" type="checkbox" <?=$pphp==1?'checked':''?> >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Pegawai Setda</label>
                                    <div class="col-md-7">
                                        <input name="pegawai_setda" type="checkbox" <?=$pegawai_setda==1?'checked':''?> >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Golongan/Pangkat (Baru)</label>
                                    <div class="col-md-7">
                                        <select class="form-control chosen" name="gol_pangkat_baru">
                                            <option value="">Pilih</option>
                                            <?php foreach($arrPngktGol as $valPB): ?>
                                                <option <?= $gol_pangkat_baru==$valPB->nama_pangkat_gol?'selected':'';?> value="<?=$valPB->nama_pangkat_gol?>"><?=$valPB->nama_pangkat_gol?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">TMT Golongan/Pangkat Baru</label>
                                    <div class="col-md-7">
                                         <input name="tmt_gol_pangkat_baru" class="form-control tanggal" value="<?=$tmt_gol_pangkat_baru?>" autocomplete="off"></input>
                                    </div>
                                </div>                                
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Bagian Baru</label>
                                    <div class="col-md-7">
                                        <select class="form-control chosen" name="fk_bagian_id_baru"  id="fk_bagian_id_baru">
                                            <option value="">Pilih</option>
                                            <?php foreach($arrMsBagianBaru as $val): ?>
                                                <option <?= $fk_bagian_id_baru==$val['id']?'selected':'';?> value="<?=$val['id']?>"><?=$val['nama_bagian']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Status Jabatan Baru</label>
                                    <div class="col-md-7">
                                         <input name="status_jabatan_baru" class="form-control" value="<?=$status_jabatan_baru?>" placeholder="Diisi jika status masih Plt."></input>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Jabatan Baru</label>
                                    <div class="col-md-7">
                                        <select class="form-control chosen" name="fk_jabatan_id_baru" id="fk_jabatan_id_baru">
                                            <option value="">Pilih</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">TMT Jabatan Baru</label>
                                    <div class="col-md-7">
                                         <input name="tmt_jabatan_baru" class="form-control tanggal" value="<?=$tmt_jabatan_baru?>" autocomplete="off"></input>
                                    </div>
                                </div> 
                                <br>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Jabatan Dlm Kegiatan</label>
                                    <div class="col-md-7">
                                         <input name="jabatan_kegiatan" class="form-control" value="<?=$jabatan_kegiatan?>"></input>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Nama Bank</label>
                                    <div class="col-md-7">
                                         <input name="nama_bank" class="form-control" value="<?=$nama_bank?>"></input>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">No Rekening</label>
                                    <div class="col-md-7">
                                         <input name="no_rekening" class="form-control" value="<?=$no_rekening?>"></input>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Nama Rekening</label>
                                    <div class="col-md-7">
                                         <input name="nama_rekening" class="form-control" value="<?=$nama_rekening?>"></input>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">NPWP</label>
                                    <div class="col-md-7">
                                         <input name="npwp" class="form-control" value="<?=$npwp?>"></input>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?=$id?>">
                            <br><br><br>

                            <div class="form-group">
                                <div class="col-md-12">&nbsp;</div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-2"></div>
                                <div class="col-md-2" align="center">
                                    <a href="<?=base_url()?>MsSdm" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-chevron-left"></i> kembali</a>
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
$(document).ready(function(){
    jabatanya();
    jabatan_baru();
});

$("#fk_bagian_id").change(function(){
    jabatanya();
});

function jabatanya(){
    fk_bagian_id = $("#fk_bagian_id").val();
    fk_jabatan_id = "<?=$fk_jabatan_id?>";
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'MsSdm/getJabatan'?>",
        data: {fk_bagian_id,fk_jabatan_id},
        success: function(msg){
           $('#fk_jabatan_id').html(msg.arrJabatan);
           $('#fk_jabatan_id').trigger("chosen:updated");
        }
    }); 
}

$("#fk_bagian_id_baru").change(function(){
    jabatan_baru();
});

function jabatan_baru(){
    fk_bagian_id = $("#fk_bagian_id_baru").val();
    fk_jabatan_id = "<?=$fk_jabatan_id_baru?>";
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'MsSdm/getJabatan'?>",
        data: {fk_bagian_id,fk_jabatan_id},
        success: function(msg){
           $('#fk_jabatan_id_baru').html(msg.arrJabatan);
           $('#fk_jabatan_id_baru').trigger("chosen:updated");
        }
    }); 
}
</script>