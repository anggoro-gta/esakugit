<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Entri Lembur</div>
            <h1>
                <a href="<?=base_url()?>Lembur" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-list-alt"></i> Tabel Data</a>
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
                        <form class="form-horizontal" action="<?php echo base_url();?>Lembur/save" method="post" enctype="multipart/form-data" onsubmit="return validateForm();" id="assignmentForm">
                            <div class="col-md-6">
                                <!-- <div class="form-group required">
                                    <label class="col-md-3 control-label">SPJ Bulan</label>
                                    <div class="col-md-5">
                                        <select class="form-control chosen" name="bulan" id="bulan" required>
                                            <option value="">Pilih</option>
                                            <?php foreach($arrBulan as $key => $bl): ?>
                                                <option <?=$bulan==$key?'selected':''?> value="<?=$key?>"><?=$bl?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>   
                                </div> -->
                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Tgl Surat Tugas</label>
                                    <div class="col-md-5">
                                        <input type="text" name="tgl_surat_tugas" id="tgl_surat_tugas" class="form-control tanggal text-center" value="<?=$tgl_surat_tugas?>" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Latar Belakang</label>
                                    <div class="col-md-8">
                                        <textarea class="form-control" rows="3" name="latar_belakang" required><?=$latar_belakang?></textarea>
                                    </div>
                                </div>  
                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Perihal</label>
                                    <div class="col-md-8">
                                        <textarea class="form-control" rows="3" name="perihal" required><?=$perihal?></textarea>
                                    </div>
                                </div>                                
                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Tgl Kegiatan</label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control startdate text-center" name="tgl_kegiatan_dari" id="tgl_kegiatan_dari" value="<?=$tgl_kegiatan_dari?>" required />                        
                                            <span class="input-group-addon"><b>s/d</b></span>                        
                                            <input type="text" class="form-control enddate text-center" name="tgl_kegiatan_sampai" id="tgl_kegiatan_sampai" value="<?=$tgl_kegiatan_sampai?>" required /> 
                                        </div>                   
                                    </div>
                                </div>
                                <!-- <div class="form-group" >
                                    <label class="col-md-3 control-label">Ada NPWP Rekanan</label>
                                    <div class="col-md-1">
                                        <input name="is_rekanan" id="is_rekanan" type="checkbox" class="form-control" <?=$is_rekanan==1?'checked':''?> >
                                        <span class="label-success label label-default">NB: Jika ada maka PPH23 (2%), tetapi jika tidak ada maka  PPH23 (4%)</span>
                                    </div>
                                </div> -->
                                <div class="form-group">  
                                    <label class="col-md-3 control-label">Nama Rekanan Catering</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="fk_rekanan_catering_id" id="fk_rekanan_catering_id">
                                            <option value="">Pilih</option>
                                            <?php foreach($arrMsRekanan as $val): ?>
                                                <option <?=$fk_rekanan_catering_id==$val['id']?'selected':''?> value="<?=$val['id']?>"><?=$val['nama_rekanan'].' ('.$val['nama_pemilik'].')'?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <input type="hidden" name="pph_23_persen" id="pph_23_persen" value="<?=$pph_23_persen?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Tgl Kwitansi</label>
                                    <div class="col-md-5">
                                        <input type="text" name="tgl_kwitansi" id="tgl_kwitansi" class="form-control tanggal text-center" value="<?=$tgl_kwitansi?>" autocomplete="off">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-6">
                                <?php if($this->session->userdata("level")==1){ ?>
                                    <div class="form-group required">  
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
                                <div class="form-group required">  
                                    <label class="col-md-3 control-label">Penandatangan ST</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="nama_penandatangan_st" id="nama_penandatangan_st" required>
                                            <option value="">Pilih</option>
                                            <!-- <?php foreach($arrTtd as $val): 
                                                $jbtn = ($val->jabatan_baru==' ')?$val->jabatan:$val->jabatan_baru;
                                            ?>
                                                <option <?=$nama_penandatangan_st==$val->nama?'selected':''?> value="<?=$val->nama.'_'.$val->nip.'_'.$val->gol_pangkat.'_'.$val->jabatan.'_'.$val->gol_pangkat_baru.'_'.$val->tmt_gol_pangkat_baru.'_'.$val->jabatan_baru.'_'.$val->tmt_jabatan_baru?>"><?=$val->nama.' ['.$jbtn.']'?></option>
                                            <?php endforeach; ?> -->
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group required">  
                                    <label class="col-md-3 control-label">Pengusul</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="nama_pengusul" id="nama_pengusul" required>
                                            <option value="">Pilih</option>
                                            <!-- <?php foreach($arrTtdPengusul as $val): 
                                                $jbtn = $val->jabatan;
                                                if($val->jabatan_baru){
                                                    $jbtn = $val->jabatan_baru;
                                                }
                                            ?>
                                                <option <?=$nama_pengusul==$val->nama?'selected':''?> value="<?=$val->nama.'_'.$val->nip.'_'.$val->gol_pangkat.'_'.$val->jabatan.'_'.$val->gol_pangkat_baru.'_'.$val->tmt_gol_pangkat_baru.'_'.$val->jabatan_baru.'_'.$val->tmt_jabatan_baru?>"><?=$val->nama.' ['.$jbtn.']'?></option>
                                            <?php endforeach; ?> -->
                                        </select>
                                    </div>
                                </div> 
                                <!-- <div class="form-group">  
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
                                <div class="form-group required">  
                                    <label class="col-md-3 control-label">KPA</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="nama_pejabat_kpa" id="nama_pejabat_kpa" required>
                                            <option value="">Pilih</option>
                                            <!-- <?php foreach($arrKPA as $val2): ?>
                                                <?php
                                                    $jbtn = ($val2->jabatan_baru==' ')?$val2->jabatan:$val2->jabatan_baru;
                                                ?>
                                               <option <?=$nama_pejabat_kpa==$val2->nama?'selected':''?> value="<?=$val2->nama.'_'.$val2->nip.'_'.$val2->gol_pangkat.'_'.$val2->jabatan.'_'.$val2->gol_pangkat_baru.'_'.$val2->tmt_gol_pangkat_baru.'_'.$val2->jabatan_baru.'_'.$val2->tmt_jabatan_baru?>"><?=$val2->nama.' ['.$jbtn.']'?></option>
                                            <?php endforeach; ?> -->
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">  
                                    <label class="col-md-3 control-label">PPTK</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="nama_pejabat_pptk" id="nama_pejabat_pptk">
                                            <option value="">Pilih</option>
                                        </select>
                                        <!-- <select class="form-control chosen" name="nama_pejabat_pptk" >
                                            <option value="">Pilih</option>
                                            <?php foreach($arrPPTK as $val2): ?>
                                                <?php
                                                    $jbtn = ($val2->jabatan_baru==' ')?$val2->jabatan:$val2->jabatan_baru;
                                                ?>
                                                <option <?=$nama_pejabat_pptk==$val2->nama?'selected':''?> value="<?=$val2->nama.'_'.$val2->nip.'_'.$jbtn?>"><?=$val2->nama.' ['.$jbtn.']'?></option>
                                            <?php endforeach; ?>
                                        </select> -->
                                    </div>
                                </div>
                                <!-- <div class="form-group required">  
                                    <label class="col-md-3 control-label">Bendahara Pengeluaran</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="nama_bendahara" required>
                                            <option value="">Pilih</option>
                                            <?php foreach($arrBendahara as $val2): ?>
                                               <option <?=$nama_bendahara==$val2->nama?'selected':''?> value="<?=$val2->nama.'_'.$val2->nip?>"><?=$val2->nama?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div> -->
                                <div class="form-group required">      
                                    <label class="col-md-3 control-label">Bendahara Pengeluaran Pembantu</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="nama_bendahara_pembantu" id="nama_bendahara_pembantu" required>
                                            <option value="">Pilih</option>
                                        </select>
                                    </div>
                                    <input type="hidden" id="bndhra_pembntu" value="<?=$nama_bendahara_pembantu?>">
                                </div>                                                              
                            </div>
                            <input type="hidden" name="id" value="<?=$id?>">
                            <input type="hidden" name="tahun" id="tahun" value="<?=$tahun?>">

                            <div class="form-group">
                                <div class="col-md-12">
                                    <legend style="color: blue"> &nbsp; <b>Detail Lembur</b></legend>
                                    <?php if(isset($arrLemburDetail)): ?>
                                    <div class="table-responsive" style="overflow-x: auto">                     
                                        <table class="table table-bordered table-striped" id="example2" >
                                            <thead>
                                                <tr>
                                                    <th class="text-center" width="30px">No</th>
                                                    <th class="text-center" width="30%">Nama</th>
                                                    <th class="text-center" width="15%">Tanggal</th>
                                                    <th class="text-center" width="7%">Jml<br>Jam</th>
                                                    <th class="text-center" width="7%">Hari<br>Libur</th>
                                                    <th class="text-center" width="10%">Tarif<br>Lembur</th>
                                                    <th class="text-center" width="10%">Pph21 (%)</th>
                                                    <th class="text-center" width="10%">Uang Mamin</th>
                                                    <th class="text-center" width="10%">Jml Mamin</th>
                                                    <th class="text-center" width="6%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no=1;?>
                                                <?php foreach((array)$arrLemburDetail as $val) :?>
                                                    <tr>
                                                        <td style="text-align: center" ><?php echo $no++;?></td>
                                                        <td><?=$val['nama_sdm']?></td>
                                                        <td style="text-align: center"><?=$this->help->ReverseTgl($val['tgl'])?></td>
                                                        <td style="text-align: center"><?=$val['jml_jam']?></td>
                                                        <td style="text-align: center"><?=$val['is_libur']?></td>
                                                        <td style="text-align: right"><?=number_format($val['tarif'])?></td>
                                                        <td style="text-align: center"><?=$val['pph21']?></td>
                                                        <td style="text-align: right"><?=number_format($val['uang_makan'])?></td>
                                                        <td style="text-align: center"><?=$val['jml_makan']?></td>
                                                        <td style="text-align: center;">
                                                            <?php if($is_spj=='0'){ ?>
                                                                <a href="#" class="btn btn-xs btn-success" title="Ubah Detail" onclick="edit_detail(<?=$val['fk_entri_lembur_id']?>,<?=$val['id']?>)"><i class="glyphicon glyphicon-edit icon-white"></i></a>
                                                                <a href="<?=base_url()?>Lembur/deleteDetail/<?=$val['fk_entri_lembur_id']?>/<?=$val['id']?>" class="btn btn-xs btn-danger" title="Hapus" onclick="javasciprt: return confirm('Apakah anda yakin?')" ><i class="glyphicon glyphicon-trash icon-white"></i></a></td>
                                                            <?php } ?>
                                                    </tr>
                                                <?php endforeach;?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php endif; ?>
                                    <?php if(($is_spj=='0' || empty($id)) || $this->session->level=='1'){ ?>
                                        <div class="table-responsive">
                                        <table border="1">
                                            <tr>
                                                <th class="text-center" width="30%">Nama</th>
                                                <th class="text-center" width="15%">Tanggal</th>
                                                <th class="text-center" width="7%">Jml<br>Jam</th>
                                                <th class="text-center" width="7%">Hari<br>Libur</th>
                                                <th class="text-center" width="10%">Tarif<br>Lembur</th>
                                                <th class="text-center" width="10%">Pph21 (%)</th>
                                                <th class="text-center" width="10%">Uang Mamin</th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <select class="form-control chosen kosong" id="id_sdm" >
                                                        <option value="">Pilih</option>
                                                       <!--  <?php foreach($arrMsSdm as $sd): ?>
                                                            <?php
                                                                $jbtn = ($sd['jabatan_baru']==' ')?$sd['jabatan']:$sd['jabatan_baru'];
                                                            ?>
                                                            <option value="<?=$sd['id']?>"><?=$sd['nama'].' ['.$jbtn.']'?></option>
                                                        <?php endforeach; ?> -->
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control kosong text-center tanggal" id="tgl" autocomplete="false">
                                                </td>
                                                <td><input type="text" class="form-control kosong angka text-center" id="jam"></td>
                                                <td><input type="checkbox" class="form-control kosong text-center" id="is_libur"></td>
                                                <td>
                                                    <input type="text" class="form-control kosong nominal" id="tarif">
                                                </td>
                                                <td><input type="text" class="form-control kosong angka text-center" id="pph21"></td>
                                                <td>
                                                    <input type="text" class="form-control kosong nominal" id="uang_makan_rp">
                                                    <input type="hidden" class="form-control kosong nominal" id="uang_makan">
                                                    <input type="hidden" class="form-control kosong" id="nama_sdm">
                                                    <input type="hidden" class="form-control kosong" id="nip_sdm">
                                                    <input type="hidden" class="form-control kosong" id="tarif_awal">
                                                    <input type="hidden" class="form-control kosong" id="golongan">
                                                    <input type="hidden" class="form-control kosong" id="jabatan">
                                                    <input type="hidden" class="form-control kosong" id="status_pegawai">
                                                </td>
                                            </tr>
                                        </table>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php if(($is_spj=='0' || empty($id)) || $this->session->level=='1'){ ?>
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
                                                <th class="text-center" width="30%">Nama</th>
                                                <th class="text-center" width="15%">Tanggal</th>
                                                <th class="text-center" width="7%">Jml<br>Jam</th>
                                                <th class="text-center" width="7%">Hari<br>Libur</th>
                                                <th class="text-center" width="10%">Tarif<br>Lembur</th>
                                                <th class="text-center" width="10%">Pph21 (%)</th>
                                                <th class="text-center" width="10%">Uang Mamin</th>
                                                <th style="vertical-align: middle;" class="text-center">Aksi</th>
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
  <div class="modal-dialog" style="width: 50%;padding: 0px">
      <div class="modal-content">
        <form method="post" action="<?=base_url("Lembur/updateDetail")?>" enctype="multipart/form-data" class="form-horizontal">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
              <h5><b>Update Detail PJD</b></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nama</label>
                            <div class="col-sm-6">
                                <input type="text" id="detail_nama" class="form-control" readonly >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Tanggal</label>
                            <div class="col-sm-4">
                                <input type="text" id="detail_tgl" class="form-control text-center" readonly >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Jml Jam</label>
                            <div class="col-sm-2">
                                <input type="text" name="detail_jml_jam" id="detail_jml_jam" class="form-control angka text-center" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Jml Makan</label>
                            <div class="col-sm-2">
                                <input type="text" name="detail_jml_makan" id="detail_jml_makan" class="form-control angka text-center" >
                                <input type="hidden" id="detail_jml_makan_asli" class="form-control angka text-center" >
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label class="col-sm-3 control-label">Hari Libur</label>
                            <div class="col-sm-1">
                                <input type="checkbox" class="form-control kosong text-center" id="detail_is_libur" name="detail_is_libur">
                            </div>
                        </div> -->
                        <input type="hidden" id="detail_id" name="detail_id" class="form-control" readonly >
                        <input type="hidden" id="detail_lembur_detail_id" name="detail_lembur_detail_id" class="form-control" readonly >
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
    cari_program("<?=$fk_program_id?>");
    cari_keg("<?=$fk_program_id?>","<?=$fk_kegiatan_id?>");
    cari_rekBlnja("<?=$fk_kegiatan_id?>","<?=$fk_rekening_belanja_id?>");
    cari_pptk("<?=$nama_pejabat_pptk?>");
    cari_ttd_st("<?=$nama_penandatangan_st?>");
    cari_ttd_pengusul("<?=$nama_pengusul?>");
    cari_kpa("<?=$nama_pejabat_kpa?>");
    
    $(document).keyup(function(e) {
        if(e.which == 27) { //esc
            kosong();  
        }
        if(e.which == 113) { //f2
            tambahList();        
        }
    }); 

    setDateRangePicker(".startdate", ".enddate")

});

function setDateRangePicker(input1, input2){
    $(input1).datepicker({    autoclose: true,    format: "dd-mm-yyyy",  }).on("change", function(){    $(input2).val("").datepicker('setStartDate', $(this).val());  }).attr("readonly", "readonly").css({"cursor":"pointer", "background":"white"});  
    $(input2).datepicker({    autoclose: true,    format: "dd-mm-yyyy",    orientation: "bottom right"  }).attr("readonly", "readonly").css({"cursor":"pointer", "background":"white"});
}

function validateForm(assignmentForm){
    var messages = [];
    if($("#fk_bagian_id").val()==''){
        messages.push("Bagian, ");
    }
    if($("#fk_program_id").val()==''){
        messages.push("Program, ");
    }
    if($("#fk_kegiatan_id").val()==''){
        messages.push("Kegiatan, ");
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
    $('#is_libur').prop('checked', false);
}

$("#id_sdm").change(function(){
    id_sdm=$(this).val();
    tgl_surat_tugas = $('#tgl_surat_tugas').val();


    if(tgl_surat_tugas==''){
        alert('Tgl Surat Tugas tidak boleh kosong..');
        return false;
    }

    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Lembur/getTarifLembur'?>",
        data: {id_sdm,tgl_surat_tugas},
        success: function(msg){
           $('#nama_sdm').val(msg.nama);
           $('#nip_sdm').val(msg.nip);
           $('#golongan').val(msg.golongan);
           $('#jabatan').val(msg.jabatan);
           $('#status_pegawai').val(msg.status_pegawai);
           $('#tarif').val(msg.tarifNominal);
           $('#tarif_awal').val(msg.tarif);
           $('#pph21').val(msg.pph21);
           $('#uang_makan').val(msg.uang_makan);
           $('#uang_makan_rp').val(msg.uangMknNominal);
        }
    }); 
});

$("#is_libur").click(function(){
    tarif = parseFloat($('#tarif_awal').val());
    trfLbr = tarif;
    if($('#is_libur').is(":checked")){
        trfLbr = tarif*2;
    }
    $('#tarif').val(convertToRupiah(trfLbr));
});

$("#tambah").click(function(){
    tambahList();
});

function tambahList(){
    tgl_surat_tugas = $('#tgl_surat_tugas').val();
    tgl_kegiatan_dari = $('#tgl_kegiatan_dari').val();
    tdr = tgl_kegiatan_dari.split('-');
    tglDri = new Date(tdr[2]+'/'+tdr[1]+'/'+tdr[0]).getTime();

    tgl_kegiatan_sampai = $('#tgl_kegiatan_sampai').val();
    tsp = tgl_kegiatan_sampai.split('-');
    tglSpe = new Date(tsp[2]+'/'+tsp[1]+'/'+tsp[0]).getTime();

    keg = $("#fk_kegiatan_id").val();

    if(tgl_surat_tugas==''){
        alert('Tanggal Kegiatan tidak boleh kosong.');
        $("#tgl_surat_tugas").focus();
        return false;
    }
    if(tgl_kegiatan_dari==''){
        alert('Tanggal Kegiatan tidak boleh kosong.');
        $("#tgl_kegiatan_dari").focus();
        return false;
    }
    if(tgl_kegiatan_sampai==''){
        alert('Tanggal Kegiatan tidak boleh kosong.');
        $("#tgl_kegiatan_sampai").focus();
        return false;
    }
    if(keg==''){
        alert('Sub Kegiatan tidak boleh kosong.');
        return false;
    }

    id_sdm = $('#id_sdm').val();
    tgl = $('#tgl').val();
    jam = $('#jam').val();

    isLibr = 'Tidak';
    if($('#is_libur').is(":checked")){
        isLibr = 'Ya';
    }

    // if($('#is_libur').is(":checked")){
    //     isLibr = 'Ya';
    //     jmlJam=8;
    //     if(keg==77 || keg==79){ //bid data (Penyusunan dokumen perencanaan daerah, Fasilitasi dan evaluasi rencana Pembangunan Daerah)
    //         jmlJam=14;
    //     }
    //     if(jam > jmlJam){
    //         // if(confirm('Apakah ini hari libur? Jangan lupa di centang Hari Libur.')){
    //         //     return false;
    //         // }
    //         alert('Jumlah Jam Maksimal Adalah '+jmlJam+' Jam.');
    //         return false;
    //     }

    // }else{
        // jmlJam=4;
        // if(keg==77 || keg==79){ //bid data (Penyusunan dokumen perencanaan daerah, Fasilitasi dan evaluasi rencana Pembangunan Daerah)
        //     jmlJam=7;
        // }
        // if(jam > jmlJam){
            // if(confirm('Apakah ini hari libur? Jangan lupa di centang Hari Libur.')){
            //     return false;
            // }
            // alert('Jika ini hari libur? Jangan lupa di centang Hari Libur.');
            // return false;
        // }
    // }

    if(id_sdm==''){
        alert('Nama tidak boleh kosong.');
        $("#id_sdm").focus();
        return false;
    }
    if(tgl==''){
        alert('Tanggal tidak boleh kosong.');
        $("#tgl").focus();
        return false;
    }
    res = tgl.split('-');
    tglKeg = new Date(res[2]+'/'+res[1]+'/'+res[0]).getTime();

    if(tglDri > tglKeg || tglKeg > tglSpe){
        alert('Tanggal tidak sesuai dengan tgl kegiatan.');
        $("#tgl").focus();
        return false;
    }

    if(jam==''){
        alert('Jumlah jam tidak boleh kosong.');
        $("#jam").focus();
        return false;
    }
    $("#loading").html('<div class="loader"></div>');

    cekDataSdhAda='kosong';keterangan='';keterangan2='';
    $.ajax({
        async: false,
        type: "POST",
        url: "<?php echo base_url().'Lembur/cekCariNama'?>",
        data: {id_sdm,tgl},
        dataType: 'json',
        success: function(msg){ 
            keterangan = msg.hslCek;keterangan22='';
            if(keterangan!=''){ //DD / DL
                alert(keterangan);  
                if(level!=1){
                    alert('Silahkan Konfirmasi Ke Renkeu yg menangani SPJ.');
                    cekDataSdhAda='ada';
                }else{
                    if(!confirm('Apakah Jam nya sudah dicek dan tidak Bentrok ?')){
                        cekDataSdhAda='ada';
                    }
                }                
            }
            if(cekDataSdhAda=='kosong'){ //Rapat
                if(msg.adaRapat=='iya'){
                    keterangan2=msg.hslCekRpt;
                    alert(keterangan2);
                    keterangan22=' <br> '+msg.hslCekRpt;
                    if(level!=1){
                        alert('Silahkan Konfirmasi Ke Renkeu yg menangani SPJ.');
                        cekDataSdhAda='ada';
                    }else{
                        if(!confirm('Apakah Jam Lembur dengan Rapat tidak Bentrok ?')){
                            cekDataSdhAda='ada';
                        } 
                    }
                }
            }
        }
    });

    if(cekDataSdhAda=='kosong'){
        // $.ajax({
        //     async: false,
        //     type: "POST",
        //     url: "<?php echo base_url().'Lembur/cariNama'?>",
        //     data: {id_sdm,tgl_surat_tugas,isLibr,jam},
        //     dataType: 'json',
        //     success: function(msg){ 
        //         nama_sdm = msg.nama;
        //         nip = msg.nip;
        //         golongan = msg.golongan;
        //         jabatan = msg.jabatan;
        //         tarifNominal = msg.tarifNominal;
        //         tarif = msg.tarif;
        //         pph21 = msg.pph21;
        //         status_pegawai = msg.status_pegawai;
        //         uang_makan = msg.uang_makan;
        //         jml_makan = msg.jml_makan;
        //     }
        // }); 

        nama_sdm = $('#nama_sdm').val();
        nip = $('#nip_sdm').val();
        golongan = $('#golongan').val();
        jabatan = $('#jabatan').val();
        tarifNominal = $('#tarif').val();
        pph21 = $('#pph21').val();
        status_pegawai = $('#status_pegawai').val();
        uang_makan = $('#uang_makan_rp').val();

        jmlMkn = 0;
        if(jam >= 2){
            jmlMkn = 1;
        }

        jml_makan = jmlMkn;

        $("#tampilDetail").append(
            '<tr>'+
                '<td>'+nama_sdm+'</td>'+
                '<td class="text-center">'+tgl+'</td>'+
                '<td class="text-center">'+jam+'</td>'+
                '<td class="text-center">'+isLibr+'</td>'+
                '<td class="text-right">'+tarifNominal+'</td>'+
                '<td class="text-center">'+pph21+'</td>'+
                '<td class="text-right">'+uang_makan+'</td>'+
                '<td class="text-center"><a style="cursor: pointer;" title="hapus" class="remove btn btn-xs btn-danger" ><i class="glyphicon glyphicon-trash"></i></a>'+
                    '<input type="hidden" name="listSdmId[]" value="'+id_sdm+'">'+
                    '<input type="hidden" name="listNamaSdm[]" value="'+nama_sdm+'">'+
                    '<input type="hidden" name="listNip[]" value="'+nip+'">'+
                    '<input type="hidden" name="listGol[]" value="'+golongan+'">'+
                    '<input type="hidden" name="listJabatan[]" value="'+jabatan+'">'+
                    '<input type="hidden" name="listTgl[]" value="'+tgl+'">'+
                    '<input type="hidden" name="listJam[]" value="'+jam+'">'+
                    '<input type="hidden" name="listTarif[]" value="'+tarifNominal+'">'+
                    '<input type="hidden" name="listPph[]" value="'+pph21+'">'+
                    '<input type="hidden" name="listHrLbr[]" value="'+isLibr+'">'+
                    '<input type="hidden" name="listUangMakan[]" value="'+uang_makan+'">'+
                    '<input type="hidden" name="listJmlMakan[]" value="'+jml_makan+'">'+
                    '<input type="hidden" name="listStatPeg[]" value="'+status_pegawai+'">'+
                    '<input type="hidden" name="listKeterangan[]" value="'+keterangan+keterangan22+'">'+
                '</td>'+
            '</tr>'
        );    
    } 

    $('#id_sdm').val('');
    $('#id_sdm').trigger("chosen:updated");
    kosong();
    $( "#tgl" ).datepicker('setDate','');
    $("#loading").html('');
}

$("#tampilDetail").on('click','.remove',function(){
    if(confirm('Apakah anda yakin?')){
        $(this).parent().parent().remove();
    }
});

$("#fk_bagian_id").change(function(){
    cari_program();
    cari_ttd_st();
    cari_ttd_pengusul();
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

function cari_bendahara_pembantu(){
    bndhra_pembntu = $("#bndhra_pembntu").val();
    fk_bagian_id = $("#fk_bagian_id").val();
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

$("#fk_program_id").change(function(){
    fk_program_id = $("#fk_program_id").val();
    cari_keg(fk_program_id);     
});

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

function cari_ttd_st(nama_penandatangan_st=null){
    fk_bagian_id = $("#fk_bagian_id").val();
    nama_ttd_surat_tugas = nama_penandatangan_st;
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Pjd/getTtdSt'?>",
        data: {fk_bagian_id,nama_ttd_surat_tugas},
        success: function(msg){
            $('#nama_penandatangan_st').html(msg.arrTtdSt);
            $('#nama_penandatangan_st').trigger("chosen:updated");
        }
    });     
}

function cari_ttd_pengusul(nama_pengusul=null){
    fk_bagian_id = $("#fk_bagian_id").val();
    nama_ttd_surat_tugas = nama_pengusul;
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Pjd/getTtdSt'?>",
        data: {fk_bagian_id,nama_ttd_surat_tugas},
        success: function(msg){
            $('#nama_pengusul').html(msg.arrTtdSt);
            $('#nama_pengusul').trigger("chosen:updated");
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

function edit_detail(fk_lembur_id,id){
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Lembur/getCariDataDetail'?>",
        data: {id},
        success: function(msg){
            $('#detail_nama').val(msg.nama_sdm);
            $('#detail_tgl').val(msg.tgl);
            $('#detail_jml_jam').val(msg.jml_jam);
            $('#detail_jml_makan').val(msg.jml_makan);
            $('#detail_jml_makan_asli').val(msg.jml_makan);
            if(msg.is_libur=='Ya'){
                $("#detail_is_libur").prop('checked', true);
            }else{
                $("#detail_is_libur").prop('checked', false);
            }
            
            $('#detail_id').val(fk_lembur_id);
            $('#detail_lembur_detail_id').val(id);
        }
    });  
    $("#modal_edit").modal("show"); 
}

$("#fk_rekanan_catering_id").change(function(){
    ctrng_id = $(this).val();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Rapat/cariNpwpCatering'?>",
        data: {ctrng_id},
        success: function(msg){
            $('#pph_23_persen').val(msg.pph23Prsen);
        }
    });  
})


</script>