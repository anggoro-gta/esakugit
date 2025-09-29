<section class="content-header">
    <div class="row">
        <div class="col-md-12">
            <div class="judul">Realisasi Anggaran</div>
        </div>
    </div>
</section>

<section class="content_section">
    <div class="content_spacer">
    <div class="content">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2>Filter Data</h2>
            </div>
            <div class="box-content">  
                <form class='form-horizontal' action="<?php echo base_url();?>Laporan/cetakLRA" method="post" enctype="multipart/form-data" target="_blank">
                    <div class="form-group">
                        <?php //if($this->session->userdata("level")==1 || $this->session->userdata("level")==3){ ?>
                            <div class="required"><label class="col-md-2 control-label">Kategori</label></div>
                            <div class="col-md-2">
                                <select class="form-control chosen" name="kategori" required>
                                    <option value="">Pilih</option>
                                    <option value="keuangan">Realisasi Keuangan</option>
                                    <option value="fisik">Realisasi Fisik</option>
                                </select>
                            </div>                            
                        <?php //}else{ ?>
                            <!-- <input type="hidden" name="kategori" value="fisik"> -->
                        <?php //}?>
                        <div class="required"><label class="col-md-2 control-label">Tampilkan Rekening Belanja</label></div>
                        <div class="col-md-1">
                            <input type="checkbox" name="tampil_rekening" class="form-control" checked>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="required"><label class="col-md-2 control-label">Bulan</label></div>
                        <div class="col-md-2">
                            <select class="form-control chosen" name="bulan" required>
                                <option value="">Pilih</option>
                                <?php foreach($arrBulan as $key => $bl): ?>
                                    <option value="<?=$key?>"><?=$bl?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <?php if($this->session->userdata("level")==1 || $this->session->userdata("level")==3){ ?>
                            <label class="col-md-2 control-label">Bagian</label>
                            <div class="col-md-3">
                                <select class="form-control chosen" name="Bagian">
                                    <option value="">.: Pilih :.</option>
                                    <?php foreach ($arrMsBagian as $bd): ?>
                                        <option value="<?=$bd['id']?>"> <?=$bd['nama_bagian']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div> 
                        <?php }else{ ?>
                            <input type="hidden" name="Bagian" value="<?=$this->session->userdata("fk_bagian_id")?>">
                        <?php }?>
                    </div>
                    <div class="form-group">
                        <div class="required"><label class="col-md-2 control-label">Jenis Anggaran</label></div>
                        <div class="col-md-3">
                            <select class="form-control chosen" name="jenis_anggaran" required>
                                <option value="">Pilih</option>
                                <option value="anggaran_awal">Anggaran Awal</option>
                                <option value="per_perbup1">Perubahan Perbup 1 <?=!empty($tglPer->tgl_per_perbup1)?'('.$tglPer->tgl_per_perbup1.')':''?></option>
                                <option value="per_perbup2">Perubahan Perbup 2 <?=!empty($tglPer->tgl_per_perbup2)?'('.$tglPer->tgl_per_perbup2.')':''?></option>
                                <option value="per_perbup3">Perubahan Perbup 3 <?=!empty($tglPer->tgl_per_perbup3)?'('.$tglPer->tgl_per_perbup3.')':''?></option>
                                <option value="per_perbup4">Perubahan Perbup 4 <?=!empty($tglPer->tgl_per_perbup4)?'('.$tglPer->tgl_per_perbup4.')':''?></option>
                                <option value="pak">PAK <?=!empty($tglPer->tgl_pak)?'('.$tglPer->tgl_pak.')':''?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">                        
                        <div class="col-md-2"></div>
                        <div class="col-md-2">
                            <button id="submit" type="submit" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-file"></i> Cetak</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    <div id="tampilData"></div>
</section>