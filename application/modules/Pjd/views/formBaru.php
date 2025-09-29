<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Entri Perjadin</div>
            <h1>
                <a href="<?=base_url()?>Pjd" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-list-alt"></i> Tabel Data</a>
            </h1>
        </div>
    </div>
</section>
<section class="content_section">
    <div class="content_spacer">
        <div class="content">
            <div class="box col-md-12">
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Sukses!</strong> <?php echo $this->session->flashdata('success') ?>
                    </div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Error!</strong> <?php echo $this->session->flashdata('error') ?>
                    </div>
                <?php endif; ?>
                <div class="box-inner">
                    <div class="box-header well">
                        <h2><?=$this->help->labelnya()?></h2>
                    </div>
                    <div class="box-content">
                        <form class="form-horizontal" action="<?php echo base_url();?>Pjd/save" method="post" enctype="multipart/form-data" onsubmit="return validateForm();" id="assignmentForm">
                            <div class="col-md-6">
                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Kategori</label>
                                    <div class="col-md-5">
                                        <select class="form-control chosen" name="kategori" id="kategori" required>
                                            <option value="">.: Pilih :.</option>
                                            <option <?=$kategori=='DD'?'selected':''?> value="DD">DD</option>
                                            <option <?=$kategori=='DL'?'selected':''?> value="DL">DL</option>
                                        </select>
                                    </div> 
                                </div>
                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Jenis PJD</label>
                                    <div class="col-md-5">
                                        <select class="form-control chosen" name="jenis_pjd" id="jenis_pjd" required>
                                            <option value="">.: Pilih :.</option>
                                            <option <?=$jenis_pjd=='Koordinasi'?'selected':''?> value="Koordinasi">Koordinasi</option>
                                            <option <?=$jenis_pjd=='Undangan/Rapat'?'selected':''?> value="Undangan/Rapat">Undangan/Rapat</option>
                                            <option <?=$jenis_pjd=='Diklat'?'selected':''?> value="Diklat">Diklat</option>
                                            <option <?=$jenis_pjd=='Fullboard'?'selected':''?> value="Fullboard">Fullboard</option>
                                            <option <?=$jenis_pjd=='Bimtek'?'selected':''?> value="Bimtek">Bimtek</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Provinsi</label>
                                    <div class="col-md-9">
                                         <select class="form-control chosen" name="fk_sub_kategori_id" id="fk_sub_kategori_id" required>
                                            <option value="">Pilih</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Asal Surat Tugas</label>
                                    <div class="col-md-5">
                                        <select class="form-control chosen" name="asal_surat_tugas" id="asal_surat_tugas" required>
                                            <option value="">.: Pilih :.</option>
                                            <option <?=$asal_surat_tugas=='Dalam'?'selected':''?> value="Dalam">Dalam SKPD</option>
                                            <option <?=$asal_surat_tugas=='Luar'?'selected':''?> value="Luar">Luar SKPD / ST Srikandi</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">No Surat Tugas</label>
                                    <div class="col-md-8">
                                        <input type="text" name="no_surat_tugas" id="no_surat_tugas" class="form-control" value="<?=$no_surat_tugas?>" >
                                    </div>
                                    <label class="col-md-3"></label>
                                    <div class="col-md-8">
                                        <span id="info_no_st" class="label-success label label-default"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Tgl Surat Tugas</label>
                                    <div class="col-md-5">
                                        <input type="text" name="tgl_surat_tugas" id="tgl_surat_tugas" class="form-control tanggal text-center" value="<?=$tgl_surat_tugas?>" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Dasar Surat Tugas</label>
                                    <div class="col-md-8">
                                        <textarea class="form-control" rows="5" name="dasar_surat_tugas"><?=$dasar_surat_tugas?></textarea>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Kota/Kab</label>
                                    <!-- <div class="col-md-8" id="dropdown_kota">
                                         <select class="form-control chosen" name="kota_dropdown" id="kota_dropdown">
                                            <option value="">Pilih</option>
                                        </select>
                                    </div> -->
                                    <div class="col-md-8" id="text_kota">
                                        <input type="text" name="kota_text" class="form-control upper" value="<?=$kota?>">
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Tujuan SKPD</label>
                                    <div class="col-md-8">
                                        <input type="text" name="tujuan_skpd" class="form-control" value="<?=$tujuan_skpd?>" required>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Alat Transportasi</label>
                                    <div class="col-md-5">
                                        <select class="form-control chosen" name="alat_transportasi">
                                            <option value="">.: Pilih :.</option>
                                            <option <?=$alat_transportasi=='Sepeda Motor'?'selected':''?> value="Sepeda Motor">Sepeda Motor</option>
                                            <option <?=$alat_transportasi=='Mobil'?'selected':''?> value="Mobil">Mobil</option>
                                            <option <?=$alat_transportasi=='Bus'?'selected':''?> value="Bus">Bus</option>
                                            <option <?=$alat_transportasi=='Kereta Api'?'selected':''?> value="Kereta Api">Kereta Api</option>
                                            <option <?=$alat_transportasi=='Pesawat'?'selected':''?> value="Pesawat">Pesawat</option>
                                            <option <?=$alat_transportasi=='Kapal Laut'?'selected':''?> value="Kapal Laut">Kapal Laut</option>
                                        </select>
                                    </div> 
                                </div>
                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Acara</label>
                                    <div class="col-md-8">
                                        <textarea class="form-control" rows="5" name="acara" required><?=$acara?></textarea>
                                    </div>
                                </div>
                                <?php //if($this->session->userdata("level")==1 || $this->session->userdata("fk_bagian_id")==1){ ?>
                                    <legend style="background-color: yellow; color:black; font-size: 12pt">Keterangan di Kwitansi</legend>
                                    <div class="form-group">     
                                        <label class="col-md-2 control-label">Uang Harian</label>
                                        <div class="col-md-1">
                                            <input type="checkbox" <?=$is_uang_harian==1?'checked':''?> name="cbx_uang_harian" id="cbx_uang_harian">
                                        </div>
                                        <label class="col-md-2 control-label">Transportasi</label>
                                        <div class="col-md-1">
                                            <input type="checkbox" <?=$is_transport==1?'checked':''?> name="cbx_transport" id="cbx_transport">
                                        </div>
                                        <label class="col-md-2 control-label">Penginapan/Hotel</label>
                                        <div class="col-md-1">
                                            <input type="checkbox" <?=$is_penginapan==1?'checked':''?> name="cbx_penginapan" id="cbx_penginapan">
                                        </div>
                                        <label class="col-md-2 control-label">Kontribusi</label>
                                        <div class="col-md-1">
                                            <input type="checkbox" <?=$is_kontribusi==1?'checked':''?> name="cbx_kontribusi" id="cbx_kontribusi">
                                        </div>
                                    </div>
                                <?php //} ?>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Tgl Berangkat</label>
                                    <div class="col-md-5">
                                        <input type="text" name="tgl_berangkat" id="tgl_berangkat" class="form-control tanggal text-center" value="<?=$tgl_berangkat?>" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Tgl Tiba</label>
                                    <div class="col-md-5">
                                        <input type="text" name="tgl_tiba" id="tgl_tiba" class="form-control tanggal text-center" value="<?=$tgl_tiba?>" required autocomplete="off">
                                    </div>
                                </div>                                
                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Jml Hari</label>
                                    <div class="col-md-2">
                                        <select class="form-control chosen" name="jml_hari" id="jml_hari" required>
                                            <option value="">.: Pilih :.</option>
                                            <option <?=$jml_hari=='1'?'selected':''?> value="1"> 1</option>
                                            <option <?=$jml_hari=='2'?'selected':''?> value="2"> 2</option>
                                            <option <?=$jml_hari=='3'?'selected':''?> value="3"> 3</option>
                                            <option <?=$jml_hari=='4'?'selected':''?> value="4"> 4</option>
                                            <option <?=$jml_hari=='5'?'selected':''?> value="5"> 5</option>
                                            <?php if($this->session->level==1 || $this->session->fk_bagian_id==5){ ?>
                                                <option <?=$jml_hari=='6'?'selected':''?> value="6"> 6</option>
                                                <option <?=$jml_hari=='7'?'selected':''?> value="7"> 7</option>
                                                <option <?=$jml_hari=='8'?'selected':''?> value="8"> 8</option>
                                                <option <?=$jml_hari=='9'?'selected':''?> value="9"> 9</option>
                                                <option <?=$jml_hari=='10'?'selected':''?> value="10"> 10</option>
                                                <option <?=$jml_hari=='11'?'selected':''?> value="11"> 11</option>
                                            <?php } ?>
                                        </select>
                                    </div> 
                                </div>
                                <div class="form-group required" id="tengah1">
                                    <label class="col-md-3 control-label" style="color: orange;">Tgl Berangkat Hari ke-2</label>
                                    <div class="col-md-5">
                                        <input type="text" name="tgl_tengah_1" id="tgl_tengah_1" class="form-control tanggal text-center tgl_tengah" value="<?=$tgl_tengah_1?>"  autocomplete="off">
                                    </div>
                                </div> 
                                <div class="form-group required" id="tengah2">
                                    <label class="col-md-3 control-label" style="color: orange;">Tgl Berangkat Hari ke-3</label>
                                    <div class="col-md-5">
                                        <input type="text" name="tgl_tengah_2" id="tgl_tengah_2" class="form-control tanggal text-center tgl_tengah" value="<?=$tgl_tengah_2?>"  autocomplete="off">
                                    </div>
                                </div> 
                                <div class="form-group required" id="tengah3">
                                    <label class="col-md-3 control-label" style="color: orange;">Tgl Berangkat Hari ke-4</label>
                                    <div class="col-md-5">
                                        <input type="text" name="tgl_tengah_3" id="tgl_tengah_3" class="form-control tanggal text-center tgl_tengah" value="<?=$tgl_tengah_3?>"  autocomplete="off">
                                    </div>
                                </div> 
                                <div class="form-group required" id="tengah4">
                                    <label class="col-md-3 control-label" style="color: orange;">Tgl Berangkat Hari ke-5</label>
                                    <div class="col-md-5">
                                        <input type="text" name="tgl_tengah_4" id="tgl_tengah_4" class="form-control tanggal text-center tgl_tengah" value="<?=$tgl_tengah_4?>"  autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group required" id="tengah5">
                                    <label class="col-md-3 control-label" style="color: orange;">Tgl Berangkat Hari ke-6</label>
                                    <div class="col-md-5">
                                        <input type="text" name="tgl_tengah_5" id="tgl_tengah_5" class="form-control tanggal text-center tgl_tengah" value="<?=$tgl_tengah_5?>"  autocomplete="off">
                                    </div>
                                </div> 
                                <div class="form-group required" id="tengah6">
                                    <label class="col-md-3 control-label" style="color: orange;">Tgl Berangkat Hari ke-7</label>
                                    <div class="col-md-5">
                                        <input type="text" name="tgl_tengah_6" id="tgl_tengah_6" class="form-control tanggal text-center tgl_tengah" value="<?=$tgl_tengah_6?>"  autocomplete="off">
                                    </div>
                                </div> 
                                <div class="form-group required" id="tengah7">
                                    <label class="col-md-3 control-label" style="color: orange;">Tgl Berangkat Hari ke-8</label>
                                    <div class="col-md-5">
                                        <input type="text" name="tgl_tengah_7" id="tgl_tengah_7" class="form-control tanggal text-center tgl_tengah" value="<?=$tgl_tengah_7?>"  autocomplete="off">
                                    </div>
                                </div> 
                                <div class="form-group required" id="tengah8">
                                    <label class="col-md-3 control-label" style="color: orange;">Tgl Berangkat Hari ke-9</label>
                                    <div class="col-md-5">
                                        <input type="text" name="tgl_tengah_8" id="tgl_tengah_8" class="form-control tanggal text-center tgl_tengah" value="<?=$tgl_tengah_8?>"  autocomplete="off">
                                    </div>
                                </div>  
                                <div class="form-group required" id="tengah9">
                                    <label class="col-md-3 control-label" style="color: orange;">Tgl Berangkat Hari ke-10</label>
                                    <div class="col-md-5">
                                        <input type="text" name="tgl_tengah_9" id="tgl_tengah_9" class="form-control tanggal text-center tgl_tengah" value="<?=$tgl_tengah_9?>"  autocomplete="off">
                                    </div>
                                </div>  
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Tgl Kwitansi</label>
                                    <div class="col-md-5">
                                        <input type="text" name="tgl_rincian" class="form-control tanggal text-center" value="<?=$tgl_rincian?>" autocomplete="off">
                                    </div>
                                </div>
                                <?php if($this->session->userdata("level")==1){ ?>
                                    <div class="form-group">  
                                        <label class="col-md-3 control-label">Bagian</label>
                                        <div class="col-md-8">
                                            <select class="form-control chosen" name="fk_bagian_id" id="fk_bagian_id" required>
                                                <option value="">Pilih</option>
                                                <?php foreach($arrMsBagian as $bd): ?>
                                                    <option <?=$fk_bagian_id==$bd['id']?'selected':''?> value="<?=$bd['id']?>"><?=$bd['nama_bagian']?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                <?php }else{ ?>
                                    <input type="hidden" name="fk_bagian_id" id="fk_bagian_id" value="<?=$fk_bagian_id?>">
                                <?php }?>
                                <div class="form-group">  
                                    <label class="col-md-3 control-label">TTD Surat Tugas</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="nama_ttd_surat_tugas" id="nama_ttd_surat_tugas" >
                                            <option value="">Pilih</option>
                                            <!-- <?php foreach($arrTtd as $val): 
                                                     $jbtn = ($val->jabatan_baru==' ')?$val->jabatan:$val->jabatan_baru;
                                            ?>
                                                <option <?=$nama_ttd_surat_tugas==$val->nama && $jabatan_ttd_surat_tugas==$jbtn?'selected':''?> value="<?=$val->nama.'_'.$val->nip.'_'.$val->gol_pangkat.'_'.$jbtn.'_'.$val->urut_ttd.'_'.$val->gol_pangkat_baru.'_'.$val->tmt_gol_pangkat_baru?>"><?=$val->nama.' ['.$jbtn.']'?></option>
                                            <?php endforeach; ?> -->
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">  
                                    <label class="col-md-3 control-label">TTD SPPD</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="nama_ttd_sppd" id="nama_ttd_sppd" >
                                            <option value="">Pilih</option>
                                            <!-- <?php foreach($arrTtd as $val2): ?>
                                                <?php
                                                    $jbtn = ($val2->jabatan_baru==' ')?$val2->jabatan:$val2->jabatan_baru;
                                                ?>
                                                <option <?=$nama_ttd_sppd==$val2->nama?'selected':''?> value="<?=$val2->nama.'_'.$val2->nip.'_'.$val2->gol_pangkat.'_'.$jbtn.'_'.$val2->urut_ttd.'_'.$val2->gol_pangkat_baru.'_'.$val2->tmt_gol_pangkat_baru?>"><?=$val2->nama.' ['.$jbtn.']'?></option>
                                            <?php endforeach; ?> -->
                                        </select>
                                    </div>
                                </div>
                               <!--  <div class="form-group">  
                                    <label class="col-md-3 control-label">PA</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="nama_pejabat_pa" id="nama_pejabat_pa">
                                            <option value="">Pilih</option>
                                            <?php foreach($arrPA as $val2): ?>
                                                <?php
                                                    $jbtn = ($val2->jabatan_baru==' ')?$val2->jabatan:$val2->jabatan_baru;
                                                ?>
                                                <option <?=$nama_pejabat_pa==$val2->nama?'selected':''?> value="<?=$val2->nama.'_'.$val2->nip.'_'.$jbtn?>"><?=$val2->nama.' ['.$jbtn.']'?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div> -->
                                <div class="form-group">  
                                    <label class="col-md-3 control-label">KPA</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="nama_pejabat_kpa" id="nama_pejabat_kpa">
                                            <option value="">Pilih</option>
                                            <!-- <?php foreach($arrKPA as $val2): ?>
                                                <?php
                                                    $jbtn = ($val2->jabatan_baru==' ')?$val2->jabatan:$val2->jabatan_baru;
                                                ?>
                                               <option <?=$nama_pejabat_kpa==$val2->nama?'selected':''?> value="<?=$val2->nama.'_'.$val2->nip.'_'.$jbtn?>"><?=$val2->nama.' ['.$jbtn.']'?></option>
                                            <?php endforeach; ?> -->
                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="form-group">  
                                    <label class="col-md-3 control-label">Bendahara Pengeluaran</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="nama_bendahara">
                                            <option value="">Pilih</option>
                                            <?php foreach($arrBendahara as $val2): ?>
                                                <?php
                                                    // $jbtn = empty($val2->jabatan_baru)?$val2->jabatan:$val2->jabatan_baru;
                                                    $jbtn = $val2->jabatan;
                                                ?>
                                               <option <?=$nama_bendahara==$val2->nama?'selected':''?> value="<?=$val2->nama.'_'.$val2->nip.'_'.$jbtn?>"><?=$val2->nama?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div> -->
                                <div class="form-group">  
                                    <label class="col-md-3 control-label">PPTK</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="nama_pejabat_pptk" id="nama_pejabat_pptk" >
                                            <option value="">Pilih</option>
                                            <!-- <?php foreach($arrPPTK as $val2): ?>
                                                <?php
                                                    $jbtn = ($val2->jabatan_baru==' ')?$val2->jabatan:$val2->jabatan_baru;
                                                ?>
                                                <option <?=$nama_pejabat_pptk==$val2->nama?'selected':''?> value="<?=$val2->nama.'_'.$val2->nip.'_'.$jbtn?>"><?=$val2->nama.' ['.$jbtn.']'?></option>
                                            <?php endforeach; ?> -->
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group required">  
                                    <label class="col-md-3 control-label">Kegiatan</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="fk_program_id" id="fk_program_id" >
                                            <option value="">Pilih</option>
                                        </select>
                                    </div>  
                                </div>
                                <div class="form-group required">      
                                    <label class="col-md-3 control-label">Sub Kegiatan</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="fk_kegiatan_id" id="fk_kegiatan_id" >
                                            <option value="">Pilih</option>
                                        </select>
                                    </div>
                                </div> 
                                <div class="form-group required">      
                                    <label class="col-md-3 control-label">Rekening Belanja</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="fk_rekening_belanja_id" id="fk_rekening_belanja_id" >
                                            <option value="">Pilih</option>
                                        </select>
                                    </div>
                                </div> 
                                <div class="form-group">  
                                    <label class="col-md-3 control-label">Bendahara Pengeluaran Pembantu</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" id="nama_bendahara_pembantu" name="nama_bendahara_pembantu">
                                            <option value="">Pilih</option>
                                        </select>
                                    </div>
                                    <input type="hidden" id="bndhra_pembntu" value="<?=$nama_bendahara_pembantu?>">
                                </div>                               
                            </div>
                            <input type="hidden" name="id" value="<?=$id?>">
                            <input type="hidden" name="tahun" value="<?=$tahun?>">

                            <div class="form-group">
                                <div class="col-md-12">
                                    <legend style="color: blue"> &nbsp; <b>Detail PJD</b></legend>
                                    <?php if(isset($arrPjdDetail)): ?>
                                    <div class="table-responsive" style="overflow-x: auto">                     
                                        <table class="table table-bordered table-striped" id="example2" style="font-size: 9pt;">
                                            <thead>
                                                <tr>
                                                    <th style="vertical-align: middle;" rowspan="2" class="text-center" width="5%">No</th>
                                                    <th style="vertical-align: middle;" rowspan="2" class="text-center" width="20%">Nama</th>
                                                    <th style="vertical-align: middle;" colspan="4" class="text-center" width="50%">Uang Harian</th>
                                                    <th style="vertical-align: middle;" rowspan="2" class="text-center" width="10%">Transport</th>
                                                    <th style="vertical-align: middle;" rowspan="2" class="text-center" width="10%">Penginapan</th>
                                                    <th style="vertical-align: middle;" rowspan="2" class="text-center" width="10%">Kontribusi</th>
                                                    <th style="vertical-align: middle;" rowspan="2" class="text-center" width="10%">Total Akhir</th>
                                                    <th style="vertical-align: middle;" rowspan="2" class="text-center" width="6%">Aksi</th>
                                                    <th style="vertical-align: middle;" colspan="4" class="text-center" width="6%">TTD Rincian</th>
                                                    <th style="vertical-align: middle;" colspan="3" class="text-center" width="6%">TTD Kwitansi</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-center">Tarif</th>
                                                    <!-- <th class="text-center">%</th> -->
                                                    <th class="text-center" width="10%">Representasi</th>
                                                    <th class="text-center">Hari</th>
                                                    <th class="text-center">Total</th>
                                                    <th class="text-center">Nama</th>
                                                    <th class="text-center">Nip</th>
                                                    <th class="text-center">Pangkat</th>
                                                    <th class="text-center">Jabatan</th>
                                                    <th class="text-center">Nama</th>
                                                    <th class="text-center">Nip</th>
                                                    <th class="text-center">Jabatan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no=1;?>
                                                <?php foreach((array)$arrPjdDetail as $val) :?>
                                                    <tr>
                                                        <td style="text-align: center" ><?php echo $no++;?></td>
                                                        <td><?=$val['nama_sdm']?></td>
                                                        <td style="text-align: right"><?= number_format($val['tarif'])?></td>
                                                        <!-- <td style="text-align: center"><?=$val['persen']?></td> -->
                                                        <td style="text-align: right"><?= empty($val['representasi'])?'':number_format($val['representasi']);?></td>
                                                        <td style="text-align: center"><?=$val['hari']?></td>
                                                        <td style="text-align: right"><?=number_format($val['total'])?></td>
                                                        <td style="text-align: right"><?= empty($val['transport'])?'':number_format($val['transport']);?></td>
                                                        <td style="text-align: right"><?= empty($val['penginapan'])?'':number_format($val['penginapan']);?></td>
                                                        <td style="text-align: right"><?= empty($val['kontribusi'])?'':number_format($val['kontribusi']);?></td>
                                                        <td style="text-align: right"><?=number_format($val['total_akhir'])?></td>
                                                        <td style="text-align: center">
                                                            <?php if(empty($bulan)){ ?>
                                                                <a href="#" class="btn btn-xs btn-success" title="Ubah Detail" onclick="edit_detail(<?=$val['fk_pjd_id']?>,<?=$val['id']?>)"><i class="glyphicon glyphicon-edit icon-white"></i></a><a href="<?=base_url()?>Pjd/deleteDetail/<?=$val['fk_pjd_id']?>/<?=$val['id']?>" class="btn btn-xs btn-danger" title="Hapus" onclick="javasciprt: return confirm('Apakah anda yakin?')" ><i class="glyphicon glyphicon-trash icon-white"></i></a>
                                                            <?php } ?>
                                                        </td>
                                                        <td><?=$val['nama_rincian']?></td>
                                                        <td><?=$val['nip_rincian']?></td>
                                                        <td><?=$val['pangkat_rincian']?></td>
                                                        <td><?=$val['jabatan_rincian']?></td>
                                                        <td><?=$arrPjd[0]['nama_pejabat_kpa']?></td>
                                                        <td><?=$arrPjd[0]['nip_pejabat_kpa']?></td>
                                                        <td><?=$arrPjd[0]['jabatan_kpa']?></td>
                                                    </tr>
                                                <?php endforeach;?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php endif; ?>
                                    <?php if(empty($bulan)){ ?>
                                        <div class="table-responsive">
                                        <table border="1">
                                            <tr>
                                                <th style="text-align: center">Nama</th>
                                                <th style="text-align: center" width="10%">Tarif</th>
                                                <!-- <th style="text-align: center" width="6%">%</th> -->
                                                <th style="text-align: center" width="10%">Representasi</th>
                                                <th style="text-align: center" width="6%">Hari</th>
                                                <th style="text-align: center" width="10%">Total</th>
                                                <th style="text-align: center" width="10%">Transport</th>
                                                <th style="text-align: center" width="10%">Penginapan</th>
                                                <th style="text-align: center" width="10%">Kontribusi</th>
                                                <th style="text-align: center" width="10%">Total Akhir</th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <select class="form-control chosen kosong" id="id_sdm" >
                                                        <option value="">Pilih</option>
                                                        <!-- <?php foreach($arrMsSdm as $sd): ?>
                                                            <?php
                                                                $jbtn = ($sd['jabatan_baru']==' ')?$sd['jabatan']:$sd['jabatan_baru'];
                                                            ?>
                                                            <option value="<?=$sd['id']?>"><?=$sd['nama'].' ['.$jbtn.']'?></option>
                                                        <?php endforeach; ?> -->
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control kosong nominal" id="tarif">
                                                </td>
<!--                                                 <td>
                                                    <input type="text" class="form-control kosong angka text-center" id="persen">
                                                </td> -->
                                                <td>
                                                    <input type="text" class="form-control kosong nominal" id="representasi">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control kosong angka text-center" id="hari">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control kosong text-right" id="total" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control kosong nominal" id="transport">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control kosong nominal" id="penginapan">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control kosong nominal" id="kontribusi">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control kosong nominal" id="total_akhir" readonly>
                                                </td>
                                            </tr>
                                        </table>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php if(empty($bulan)){ ?>
                                <div class="form-group">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-6" align="center">
                                        <a id="reset" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-remove"></i> Reset (esc)</a>
                                        <a id="tambah" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-plus"></i> Tambahkan Ke List (F2)</a>
                                        <i id='loading'></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="panel panel-default">
                                        <table class="table table-bordered table-striped" >
                                            <tr style="background-color: #d5d2d1">
                                                <th style="vertical-align: middle;" rowspan="2" class="text-center">Nama</th>
                                                <th style="vertical-align: middle;" colspan="4" class="text-center" width="40%">Uang Harian</th>
                                                <th style="vertical-align: middle;" rowspan="2" class="text-center" width="10%">Transport</th>
                                                <th style="vertical-align: middle;" rowspan="2" class="text-center" width="10%">Penginapan</th>
                                                <th style="vertical-align: middle;" rowspan="2" class="text-center" width="10%">Kontribusi</th>
                                                <th style="vertical-align: middle;" rowspan="2" class="text-center" width="10%">Total Akhir</th>
                                                <th style="vertical-align: middle;" rowspan="2" class="text-center" width="4%">Aksi</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Tarif</th>
                                                <!-- <th class="text-center">%</th> -->
                                                <th class="text-center" width="10%">Representasi</th>
                                                <th class="text-center">Hari</th>
                                                <th class="text-center">Total</th>
                                            </tr>
                                            <tbody id="tampilDetail"></tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="form-group">
                                <div class="col-md-2"></div>
                                <div class="col-md-6" align="center">
                                <button id="submit" type="submit" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-hdd"></i> <?=$button?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- MODAL edit detail -->
<div class="modal fade slide-up disable-scroll" id="modal_edit" role="dialog" aria-hidden="false">  
  <div class="modal-dialog" style="width: 80%;padding: 0px">
      <div class="modal-content">
        <form method="post" action="<?=base_url("Pjd/updateDetail")?>" enctype="multipart/form-data" class="form-horizontal">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
              <h5><b>Update Detail PJD</b></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nama</label>
                            <div class="col-sm-6">
                                <input type="text" id="detail_nama" class="form-control" readonly >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Tarif</label>
                            <div class="col-sm-4">
                                <input type="text" name="detail_tarif" id="detail_tarif" class="form-control nominal" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Hari</label>
                            <div class="col-sm-2">
                                <input type="text" name="detail_hari" id="detail_hari" class="form-control text-center angka" >
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label class="col-sm-3 control-label">Persen (%)</label>
                            <div class="col-sm-2">
                                <input type="text" name="detail_persen" id="detail_persen" class="form-control text-center angka" >
                            </div>
                        </div> -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Representasi</label>
                            <div class="col-sm-4">
                                <input type="text" name="detail_representasi" id="detail_representasi" class="form-control nominal">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Total</label>
                            <div class="col-sm-4">
                                <input type="text" name="detail_total" id="detail_total" class="form-control nominal" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Transport</label>
                            <div class="col-sm-4">
                                <input type="text" name="detail_transport" id="detail_transport" class="form-control nominal" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Penginapan</label>
                            <div class="col-sm-4">
                                <input type="text" name="detail_penginapan" id="detail_penginapan" class="form-control nominal" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Kontribusi</label>
                            <div class="col-sm-4">
                                <input type="text" name="detail_kontribusi" id="detail_kontribusi" class="form-control nominal" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Total Akhir</label>
                            <div class="col-sm-4">
                                <input type="text" name="detail_total_akhir" id="detail_total_akhir" class="form-control nominal" readonly>
                            </div>
                        </div>
                        <input type="hidden" id="detail_id" name="detail_id" class="form-control" readonly >
                        <input type="hidden" id="detail_fk_pjd_id" name="detail_fk_pjd_id" class="form-control" readonly >
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <legend style="color: blue"><u>TTD Rincian</u></legend>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nama</label>
                                <div class="col-sm-7">
                                    <select class="form-control" name="ttd_nama_rincian" id="ttd_nama_rincian" >
                                        <option value="">Pilih</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <legend style="color: blue"><u>TTD Kwitansi</u></legend>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nama</label>
                                <div class="col-sm-7">
                                    <select class="form-control" name="ttd_nama_kwitansi" id="ttd_nama_kwitansi" >
                                        <option value="">Pilih</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary pull-left inline" >Simpan</button>
                <button class="btn btn-default pull-left inline" data-dismiss="modal">Batal</button>
            </div>
        </form>
      </div>
  </div>
</div>
<style>
.loader {
  border: 10px solid #f3f3f3;
  border-radius: 50%;
  border-top: 10px solid #3498db;
  width: 70px;
  height: 70px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>

<script type="text/javascript">
level = "<?=$this->session->userdata("level")?>";

$(document).ready(function(){
    note_no_st("<?=$asal_surat_tugas?>");
    cari_sub("<?=$fk_sub_kategori_id?>");
    // cari_kota("<?=$fk_sub_kategori_id?>","<?=$kota?>");
    $(document).keyup(function(e) {
        if(e.which == 27) { //esc
            kosong();  
        }
        if(e.which == 113) { //f2
            tambahList();        
        }
    }); 
    tglTmbhn(<?=$jml_hari?>);
    cari_ttd_st("<?=$nama_ttd_surat_tugas?>");
    cari_ttd_sppd("<?=$nama_ttd_sppd?>");
    cari_kpa("<?=$nama_pejabat_kpa?>");
    cari_pptk("<?=$nama_pejabat_pptk?>");
    cari_program("<?=$fk_program_id?>");
    cari_keg("<?=$fk_program_id?>","<?=$fk_kegiatan_id?>");
    cari_rekBlnja("<?=$fk_kegiatan_id?>","<?=$fk_rekening_belanja_id?>");

});

$("#asal_surat_tugas").change(function(){
    asl = $(this).val();
    note_no_st(asl);

});

function note_no_st(asl){
    val='';
    if(asl=='Luar'){
        val = 'Nomor ST nya diisi lengkap. Contoh 090/1111/418.XX/tahun';
    }
    if(asl=='Dalam'){
        val = 'Hanya diisi nomor ST nya saja';
    }
    $("#info_no_st").html(val);
}

$("#jml_hari").change(function(){
    jml = $(this).val();
    $("#hari").val(jml);
    $(".tgl_tengah").val('');
    tglTmbhn(jml);
});

function tglTmbhn(jmlHri){
    $("#tengah1").hide();
    $("#tengah2").hide();
    $("#tengah3").hide();
    $("#tengah4").hide();
    $("#tengah5").hide();
    $("#tengah6").hide();
    $("#tengah7").hide();
    $("#tengah8").hide();
    $("#tengah9").hide();
    if(jmlHri=='3'){
        $("#tengah1").show();
    }
    if(jmlHri=='4'){
        $("#tengah1").show();
        $("#tengah2").show();
    }
    if(jmlHri=='5'){
        $("#tengah1").show();
        $("#tengah2").show();
        $("#tengah3").show();
    }
    if(jmlHri=='6'){
        $("#tengah1").show();
        $("#tengah2").show();
        $("#tengah3").show();
        $("#tengah4").show();
    }
    if(jmlHri=='7'){
        $("#tengah1").show();
        $("#tengah2").show();
        $("#tengah3").show();
        $("#tengah4").show();
        $("#tengah5").show();
    }
    if(jmlHri=='8'){
        $("#tengah1").show();
        $("#tengah2").show();
        $("#tengah3").show();
        $("#tengah4").show();
        $("#tengah5").show();
        $("#tengah6").show();
    }
    if(jmlHri=='9'){
        $("#tengah1").show();
        $("#tengah2").show();
        $("#tengah3").show();
        $("#tengah4").show();
        $("#tengah5").show();
        $("#tengah6").show();
        $("#tengah7").show();
    }
    if(jmlHri=='10'){
        $("#tengah1").show();
        $("#tengah2").show();
        $("#tengah3").show();
        $("#tengah4").show();
        $("#tengah5").show();
        $("#tengah6").show();
        $("#tengah7").show();
        $("#tengah8").show();
    }
    if(jmlHri=='11'){
        $("#tengah1").show();
        $("#tengah2").show();
        $("#tengah3").show();
        $("#tengah4").show();
        $("#tengah5").show();
        $("#tengah6").show();
        $("#tengah7").show();
        $("#tengah8").show();
        $("#tengah9").show();
    }
}

$("#tarif").keyup(function(){
    cariTotal();
});
$("#hari").keyup(function(){
    cariTotal();
});
// $("#persen").keyup(function(){
//     cariTotal();
// });
$("#representasi").keyup(function(){
    cariTotal();
});

function cariTotal(){
    tarif = $("#tarif").val();
    rep_tarif = tarif.replace(/,/g,"");
    hari = $("#hari").val();
    // persen = $("#persen").val();
    persen=100;

    representasi = $("#representasi").val();
    if(representasi==''){
        representasi='0';
    }
    rep_representasi = representasi.replace(/,/g,"");

    jml='';
    if(rep_tarif!='' && hari!='' && persen!=''){
        jml = convertToRupiah((((rep_tarif*persen)/100)+parseFloat(rep_representasi))*hari);
    }
    $("#total").val(jml);
    cariTotalAkhir();
}

$("#transport").keyup(function(){
    cariTotalAkhir();
});
$("#penginapan").keyup(function(){
    cariTotalAkhir();
});
$("#kontribusi").keyup(function(){
    cariTotalAkhir();
});


function cariTotalAkhir(){
    total = $("#total").val();
    if(total==''){
        total='0';
    }
    rep_total = total.replace(/,/g,"");
    transport = $("#transport").val();
    if(transport==''){
        transport='0';
    }
    rep_transport = transport.replace(/,/g,"");
    penginapan = $("#penginapan").val();
    if(penginapan==''){
        penginapan='0';
    }
    rep_penginapan = penginapan.replace(/,/g,"");
    kontribusi = $("#kontribusi").val();
    if(kontribusi==''){
        kontribusi='0';
    }
    rep_kontribusi = kontribusi.replace(/,/g,"");

    jmlAkhir='';
    if(rep_total!=''){
        totAkhr = parseFloat(rep_total)+parseFloat(rep_transport)+parseFloat(rep_penginapan)+parseFloat(rep_kontribusi);
        jmlAkhir = convertToRupiah(totAkhr);
    }
    $("#total_akhir").val(jmlAkhir);
}

//detail
$("#detail_tarif").keyup(function(){
    cariTotalDetail();
});
$("#detail_hari").keyup(function(){
    cariTotalDetail();
});
$("#detail_persen").keyup(function(){
    cariTotalDetail();
});

function cariTotalDetail(){
    tarif = $("#detail_tarif").val();
    rep_tarif = tarif.replace(/,/g,"");
    hari = $("#detail_hari").val();
    // persen = $("#detail_persen").val();
    persen=100;

    representasi = $("#detail_representasi").val();
    if(representasi==''){
        representasi='0';
    }
    rep_representasi = representasi.replace(/,/g,"");

    jml='';
    if(rep_tarif!='' && hari!='' && persen!=''){
        jml = convertToRupiah((((rep_tarif*persen)/100)+parseFloat(rep_representasi))*hari);
    }
    $("#detail_total").val(jml);
    cariTotalAkhirDetail();
}

$("#detail_transport").keyup(function(){
    cariTotalAkhirDetail();
});
$("#detail_penginapan").keyup(function(){
    cariTotalAkhirDetail();
});
$("#detail_kontribusi").keyup(function(){
    cariTotalAkhirDetail();
});

function cariTotalAkhirDetail(){
    total = $("#detail_total").val();
    rep_total = total.replace(/,/g,"");
    
    transport = $("#detail_transport").val();
    if(transport==''){
        transport='0';
    }
    rep_transport = transport.replace(/,/g,"");
    
    penginapan = $("#detail_penginapan").val();
    if(penginapan==''){
        penginapan='0';
    }
    rep_penginapan = penginapan.replace(/,/g,"");

    kontribusi = $("#detail_kontribusi").val();
    if(kontribusi==''){
        kontribusi='0';
    }
    rep_kontribusi = kontribusi.replace(/,/g,"");

    jmlAkhir='';
    if(rep_total!=''){
        totAkhr = parseFloat(rep_total)+parseFloat(rep_transport)+parseFloat(rep_penginapan)+parseFloat(rep_kontribusi);
        jmlAkhir = convertToRupiah(totAkhr);
    }
    $("#detail_total_akhir").val(jmlAkhir);
}
// end detail

function validateForm(assignmentForm){
    var messages = [];
    if($("#fk_bagian_id").val()==''){
        messages.push("Bagian, ");
    }
    if($("#fk_program_id").val()==''){
        messages.push("Program, ");
    }
    if($("#fk_kegiatan_id").val()==''){
        messages.push("Kegiatan OPD, ");
    }
    
    if($("#jml_hari").val()=='3'){
        if($("#tgl_tengah_1").val()==''){
            messages.push("Tgl Berangkat Tengah 1, ");
        }
    }
    if($("#jml_hari").val()=='4'){
        if($("#tgl_tengah_1").val()==''){
            messages.push("Tgl Berangkat Tengah 1, ");
        }
        if($("#tgl_tengah_2").val()==''){
            messages.push("Tgl Berangkat Tengah 2, ");
        }
    }
    if($("#jml_hari").val()=='5'){
        if($("#tgl_tengah_1").val()==''){
            messages.push("Tgl Berangkat Tengah 1, ");
        }
        if($("#tgl_tengah_2").val()==''){
            messages.push("Tgl Berangkat Tengah 2, ");
        }
        if($("#tgl_tengah_3").val()==''){
            messages.push("Tgl Berangkat Tengah 3, ");
        }
    }

    if (messages.length > 0) { 
        messages.push("Tidak boleh kosong.");
        alert(messages.join('\n'));
        return false;
    } else {
        return true;
    }
}

$("#reset").click(function(){
    kosong();
});
function kosong(){
    $(".kosong").val('');
    $('#id_sdm').trigger("chosen:updated");
}

$("#tambah").click(function(){
    tambahList();
});

$("#id_sdm").change(function(){
    id=$(this).val();
    kategori = $('#kategori').val();
    fk_sub_kategori_id = $('#fk_sub_kategori_id').val();
    jenis_pjd = $('#jenis_pjd').val();

    if(kategori==''){
        alert('Kategori tidak boleh kosong..');
        return false;
    }

    if(jenis_pjd==''){
        alert('Jenis PJD tidak boleh kosong..');
        return false;
    }

    if(fk_sub_kategori_id==''){
        alert('Provinsi tidak boleh kosong..');
        return false;
    }

    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Pjd/getTarifPjdBaru'?>",
        data: {id,kategori,jenis_pjd,fk_sub_kategori_id},
        success: function(msg){
           $('#tarif').val(msg.trfnya);
           $('#representasi').val(msg.rpresntsi);
        }
    }); 
});

function tambahList(){
    kategori = $('#kategori').val();
    no_surat_tugas = $('#no_surat_tugas').val();
    tgl_surat_tugas = $('#tgl_surat_tugas').val();
    tgl_berangkat = $('#tgl_berangkat').val();
    tgl_tiba = $('#tgl_tiba').val();
    tgl_tengah_1 = $('#tgl_tengah_1').val();
    tgl_tengah_2 = $('#tgl_tengah_2').val();
    tgl_tengah_3 = $('#tgl_tengah_3').val();
    tgl_tengah_4 = $('#tgl_tengah_4').val();
    tgl_tengah_5 = $('#tgl_tengah_5').val();
    tgl_tengah_6 = $('#tgl_tengah_6').val();
    tgl_tengah_7 = $('#tgl_tengah_7').val();
    tgl_tengah_8 = $('#tgl_tengah_8').val();
    fk_bagian_id = $('#fk_bagian_id').val();
    fk_kegiatan_id = $('#fk_kegiatan_id').val();
    nama_pejabat_pa = $('#nama_pejabat_pa').val();
    nama_pejabat_kpa = $('#nama_pejabat_kpa').val();

    if(kategori==''){
        alert('Kategori tidak boleh kosong..');
        return false;
    }
    if(tgl_berangkat==''){
        alert('Tgl Berangkat tidak boleh kosong..');
        return false;
    }
    if(tgl_tiba==''){
        alert('Tgl Tiba tidak boleh kosong..');
        return false;
    }
    // if(nama_pejabat_pa==''){
    //     alert('Kolom PA tidak boleh kosong..');
    //     return false;
    // }
    if(fk_kegiatan_id==''){
        alert('Sub Kegiatan tidak boleh kosong..');
        return false;
    }

    id_sdm = $('#id_sdm').val();
    tarif = $('#tarif').val();
    hari = $('#hari').val();
    persen = $('#persen').val();
    total = $('#total').val();
    representasi = $('#representasi').val();
    transport = $('#transport').val();
    penginapan = $('#penginapan').val();
    total_akhir = $('#total_akhir').val();
    kontribusi = $('#kontribusi').val();

    cek = cekHariLibur();
    if(cek!=''){
        if(!confirm(cek)){
            return false;
        }
    }

    if(id_sdm==''){
        alert('Nama tidak boleh kosong..');
        return false;
    }
    $("#loading").html('<div class="loader"></div>');

    cekDataSdhAda='kosong';keterangan='';
    namaSdm='';nip='';gol_pangkat='';jabatan='';eselon='';nama_rincian='';nip_rincian='';pangkat_rincian='';jabatan_rincian='';urut_ttd_rincian='';
    $.ajax({
        async: false,
        type: "POST",
        url: "<?php echo base_url().'Pjd/cariNama'?>",
        data: {kategori,no_surat_tugas,tgl_surat_tugas,tgl_berangkat,tgl_tiba,fk_kegiatan_id,id_sdm,fk_bagian_id,nama_pejabat_pa,nama_pejabat_kpa,tgl_tengah_1,tgl_tengah_2,tgl_tengah_3,tgl_tengah_4,tgl_tengah_5,tgl_tengah_6,tgl_tengah_7,tgl_tengah_8},
        dataType: 'json',
        success: function(msg){             
            keterangan = msg.hslCek;
            if(msg.kategori=='Lembur' || msg.kategori=='Rapat'){
                alert(keterangan);
                // if(level!=1){
                //     alert('Silahkan Konfirmasi Ke Sekretariat yg menangani SPJ.');
                //     cekDataSdhAda='ada';
                // }else{
                    if(!confirm('Apakah Jam nya sudah dicek dan tidak Bentrok ?')){
                        cekDataSdhAda='ada';
                    } 
                // }               
            }
            if(msg.kategori=='DD' || msg.kategori=='DL'){ //DD dan DL Ditolak
                alert(keterangan);       
                cekDataSdhAda='ada';
            }
                
            namaSdm = msg.nama;
            nip = msg.nip;
            gol_pangkat = msg.gol_pangkat;
            jabatan = msg.jabatan;
            eselon = msg.eselon;
            nama_rincian = msg.nama_rincian;
            nip_rincian = msg.nip_rincian;
            pangkat_rincian = msg.pangkat_rincian;
            jabatan_rincian = msg.jabatan_rincian;
            urut_ttd_rincian = msg.urut_ttd_rincian;
        }
    });  

    if(cekDataSdhAda=='kosong'){
        $("#tampilDetail").append(
            '<tr>'+
                '<td>'+namaSdm+'</td>'+
                '<td class="text-right">'+tarif+'</td>'+
                // '<td class="text-center">'+persen+'</td>'+
                '<td class="text-right">'+representasi+'</td>'+
                '<td class="text-center">'+hari+'</td>'+
                '<td class="text-right">'+total+'</td>'+
                '<td class="text-right">'+transport+'</td>'+
                '<td class="text-right">'+penginapan+'</td>'+
                '<td class="text-right">'+kontribusi+'</td>'+
                '<td class="text-right">'+total_akhir+'</td>'+
                '<td class="text-center"><a style="cursor: pointer;" title="hapus" class="remove btn btn-xs btn-danger" ><i class="glyphicon glyphicon-trash"></i></a>'+
                    '<input type="hidden" name="listSdmId[]" value="'+id_sdm+'">'+
                    '<input type="hidden" name="listNamaSdm[]" value="'+namaSdm+'">'+
                    '<input type="hidden" name="listNip[]" value="'+nip+'">'+
                    '<input type="hidden" name="listGolPangkat[]" value="'+gol_pangkat+'">'+
                    '<input type="hidden" name="listJabatan[]" value="'+jabatan+'">'+
                    '<input type="hidden" name="listEselon[]" value="'+eselon+'">'+
                    '<input type="hidden" name="listTarif[]" value="'+tarif+'">'+
                    // '<input type="hidden" name="listPersen[]" value="'+persen+'">'+
                    '<input type="hidden" name="listRepresentasi[]" value="'+representasi+'">'+
                    '<input type="hidden" name="listHari[]" value="'+hari+'">'+
                    '<input type="hidden" name="listTotal[]" value="'+total+'">'+
                    '<input type="hidden" name="listTransport[]" value="'+transport+'">'+
                    '<input type="hidden" name="listPenginapan[]" value="'+penginapan+'">'+
                    '<input type="hidden" name="listTotalAkhir[]" value="'+total_akhir+'">'+
                    '<input type="hidden" name="listKontribusi[]" value="'+kontribusi+'">'+
                    '<input type="hidden" name="listNamaRincian[]" value="'+nama_rincian+'">'+
                    '<input type="hidden" name="listNipRincian[]" value="'+nip_rincian+'">'+
                    '<input type="hidden" name="listPangkatRincian[]" value="'+pangkat_rincian+'">'+
                    '<input type="hidden" name="listJabatanRincian[]" value="'+jabatan_rincian+'">'+
                    '<input type="hidden" name="listUrutTtdRincian[]" value="'+urut_ttd_rincian+'">'+
                    '<input type="hidden" name="listKeterangan[]" value="'+keterangan+'">'+
                '</td>'+
            '</tr>'
        );
    }

    $('#id_sdm').val('');
    $('#id_sdm').trigger("chosen:updated");
    kosong();
    $("#loading").html('');
}
               
function cekHariLibur(){
    var retval='';
    tgl_berangkat = $("#tgl_berangkat").val();
    tgl_tiba = $("#tgl_tiba").val();
    $.ajax({
        async: false,
        type: "POST",
        url: "<?php echo base_url().'Pjd/cekTglLibur'?>",
        data: {tgl_berangkat,tgl_tiba},
        dataType: 'json',
        success: function(msg){
            if(msg.hasil!='sukses'){
                retval = msg.hasil;
            }
        }
    });  
    
    return retval;
};

$("#tampilDetail").on('click','.remove',function(){
    if(confirm('Apakah anda yakin?')){
        $(this).parent().parent().remove();
    }
});

$("#fk_bagian_id").change(function(){
    cari_program();
    cari_ttd_st();
    cari_ttd_sppd();
    cari_kpa();
    cari_pptk();
});

function cari_program(fk_program_id=null){
    fk_bagian_id = $("#fk_bagian_id").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'MsKegiatan/getProgram'?>",
        data: {fk_bagian_id,fk_program_id},
        success: function(msg){
           $('#fk_program_id').html(msg.Bagian);
           $('#fk_program_id').trigger("chosen:updated");
           $('#fk_kegiatan_id').val('');
           $('#fk_kegiatan_id').trigger("chosen:updated");
        }
    });  
    cari_bendahara_pembantu(); 
    cari_pegawai();
}

$("#fk_program_id").change(function(){
    fk_program_id = $("#fk_program_id").val();
    cari_keg(fk_program_id);  
});

function cari_ttd_st(nama_ttd_surat_tugas=null){
    fk_bagian_id = $("#fk_bagian_id").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Pjd/getTtdSt'?>",
        data: {fk_bagian_id,nama_ttd_surat_tugas},
        success: function(msg){
            $('#nama_ttd_surat_tugas').html(msg.arrTtdSt);
            $('#nama_ttd_surat_tugas').trigger("chosen:updated");
        }
    });     
}

function cari_ttd_sppd(nama_ttd_sppd=null){
    nama_ttd_surat_tugas=nama_ttd_sppd;
    fk_bagian_id = $("#fk_bagian_id").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Pjd/getTtdSt'?>",
        data: {fk_bagian_id,nama_ttd_surat_tugas},
        success: function(msg){
            $('#nama_ttd_sppd').html(msg.arrTtdSt);
            $('#nama_ttd_sppd').trigger("chosen:updated");
        }
    });     
}

function cari_kpa(nama_pejabat_kpa=null){
    fk_bagian_id = $("#fk_bagian_id").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Pjd/getKpa'?>",
        data: {fk_bagian_id,nama_pejabat_kpa},
        success: function(msg){
            $('#nama_pejabat_kpa').html(msg.arrKpa);
            $('#nama_pejabat_kpa').trigger("chosen:updated");
        }
    });     
}

function cari_pptk(nama_pejabat_pptk=null){
    fk_bagian_id = $("#fk_bagian_id").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Pjd/getPptk'?>",
        data: {fk_bagian_id,nama_pejabat_pptk},
        success: function(msg){
            $('#nama_pejabat_pptk').html(msg.arrPptk);
            $('#nama_pejabat_pptk').trigger("chosen:updated");
        }
    });     
}

function cari_pegawai(){
    fk_bagian_id = $("#fk_bagian_id").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Pjd/getNamaPegawai'?>",
        data: {fk_bagian_id},
        success: function(msg){
            $('#id_sdm').html(msg.arrPegawai);
            $('#id_sdm').trigger("chosen:updated");
        }
    });     
}

function cari_keg(fk_program_id,fk_kegiatan_id=null){
    fk_bagian_id = $("#fk_bagian_id").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Pjd/getKegiatan'?>",
        data: {fk_bagian_id,fk_program_id,fk_kegiatan_id},
        success: function(msg){
            $('#fk_kegiatan_id').html(msg.kegiatan);
            $('#fk_kegiatan_id').trigger("chosen:updated");
        }
    });     
}

$("#fk_kegiatan_id").change(function(){
    fk_kegiatan_id = $("#fk_kegiatan_id").val();
    cari_rekBlnja(fk_kegiatan_id);  
});

function cari_rekBlnja(fk_kegiatan_id,fk_rekening_belanja_id=null){
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Pjd/getRekBelanja'?>",
        data: {fk_kegiatan_id,fk_rekening_belanja_id},
        success: function(msg){
            $('#fk_rekening_belanja_id').html(msg.rek_belanja);
            $('#fk_rekening_belanja_id').trigger("chosen:updated");
        }
    });     
}

function edit_detail(fk_pjd_id,id){
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Pjd/getCariDataDetail'?>",
        data: {id},
        success: function(msg){
            $('#detail_nama').val(msg.nama_sdm);
            $('#detail_tarif').val(msg.tarif);
            $('#detail_hari').val(msg.hari);
            $('#detail_persen').val(msg.persen);
            $('#detail_total').val(msg.total);
            $('#detail_representasi').val(msg.representasi);
            $('#detail_transport').val(msg.transport);
            $('#detail_penginapan').val(msg.penginapan);
            $('#detail_total_akhir').val(msg.total_akhir);
            $('#detail_kontribusi').val(msg.kontribusi);
            $('#detail_id').val(id);
            $('#detail_fk_pjd_id').val(fk_pjd_id);
            $('#ttd_nama_rincian').html(msg.dataSdmRincian);
            $('#ttd_nama_rincian').trigger("chosen:updated");
            $('#ttd_nama_kwitansi').html(msg.dataSdmKwitansi);
            $('#ttd_nama_kwitansi').trigger("chosen:updated");
        }
    });  
    $("#modal_edit").modal("show"); 
}

$("#kategori").change(function(){
    cari_sub();
});

function cari_sub(subKat=null){
    kategori = $("#kategori").val();

    // if(kategori=='DD'){
        
    // }

    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'MsTarifPjd/getSubKategoriBaru'?>",
        data: {kategori,subKat},
        success: function(msg){
           $('#fk_sub_kategori_id').html(msg.sub);
           $('#fk_sub_kategori_id').trigger("chosen:updated");
        }
    });     
}

function cari_bendahara_pembantu(){
    fk_bagian_id = $("#fk_bagian_id").val();
    bndhra_pembntu = $("#bndhra_pembntu").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Pjd/namaBndhraPmbntu'?>",
        data: {fk_bagian_id,bndhra_pembntu},
        success: function(msg){
           $('#nama_bendahara_pembantu').html(msg.hasil);
           $('#nama_bendahara_pembantu').trigger("chosen:updated");
        }
    });     
}

</script>