<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Entri Kwitansi Honorarium</div>
            <h1>
                <a href="<?=base_url()?>KwitansiHR" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-list-alt"></i> Tabel Data</a>
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
                        <form class="form-horizontal" action="<?php echo base_url();?>KwitansiHR/save" method="post" enctype="multipart/form-data" onsubmit="return validateForm();" id="assignmentForm">
                            <div class="col-md-6">
                                <?php if(empty($id)){ ?>
                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Kategori</label>
                                    <div class="col-md-5">
                                         <select class="form-control chosen" name="kategori" id="kategori" required>
                                            <option value="">Pilih</option>
                                            <option <?=$kategori=='KEGIATAN'?'selected':''?> value="KEGIATAN">HR KEGIATAN</option>
                                            <option <?=$kategori=='KONTRAK'?'selected':''?> value="KONTRAK">HR T. KONTRAK / THL</option>
                                            <option <?=$kategori=='NARASUMBER'?'selected':''?> value="NARASUMBER">HR NARASUMBER / MODERATOR</option>
                                        </select>
                                    </div>
                                </div>                                
                                <div id='isKontrakIT'>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Is Kontrak IT</label>
                                        <div class="col-md-5">
                                            <div class="input-group">
                                                <div class="col-md-1">
                                                    <input name="is_kontrak_it" id="is_kontrak_it" type="checkbox">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }else{ ?>
                                <input type="hidden" name="kategori" id="kategori" value="<?=$kategori?>">
                            <?php } ?>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Tgl Kwitansi</label>
                                    <div class="col-md-5">
                                        <input type="text" name="tgl_kwitansi" id="tgl_kwitansi" class="form-control tanggal text-center" value="<?=$tgl_kwitansi?>" autocomplete="off">
                                    </div>
                                </div> 

                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Perihal</label>
                                    <div class="col-md-8">
                                        <textarea class="form-control" rows="3" name="untuk_pembayaran" id="untuk_pembayaran" required><?=$untuk_pembayaran?></textarea>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-md-3 control-label">HR Bulan</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="hr_bulan">
                                            <option value="">Pilih</option>
                                            <?php foreach($arrBulan as $key => $bl): ?>
                                                <option <?=$hr_bulan==$key?'selected':''?> value="<?=$key?>"><?=$bl?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>    
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
                            </div>
                            <div class="col-md-6">   
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
                                        <select class="form-control chosen" name="nama_pejabat_kpa" id="nama_pejabat_kpa">
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
                                        <select class="form-control chosen" name="nama_bendahara_pembantu" id="nama_bendahara_pembantu">
                                            <option value="">Pilih</option>
                                        </select>
                                    </div>
                                    <input type="hidden" id="bndhra_pembntu" value="<?=$nama_bendahara_pembantu?>">
                                </div>                                                           
                            </div>
                            <input type="hidden" name="id" id="id" value="<?=$id?>">
                            <input type="hidden" name="tahun" id="tahun" value="<?=$tahun?>">

                            <div id="tabel_kegiatan">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <legend style="color: blue"> &nbsp; <b>Detail Kwitansi HR</b></legend>
                                        <?php if(isset($arrKwitansiHRDetail)): ?>
                                            <div class="table-responsive" style="overflow-x: auto">                     
                                                <table class="table table-bordered table-striped" id="example2" >
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center" style="vertical-align: middle" rowspan="2" width="50px">No</th>
                                                            <th class="text-center" style="vertical-align: middle" rowspan="2" width="30%">Nama</th>
                                                            <th class="text-center" style="vertical-align: middle" rowspan="2">Jabatan dlm Kegiatan</th>
                                                            <th class="text-center" colspan="3">Jumlah Penerima</th>
                                                            <th class="text-center" colspan="2">PPh 21</th>
                                                            <th class="text-center" style="vertical-align: middle" rowspan="2">Jumlah Diterima</th>
                                                            <th class="text-center" style="vertical-align: middle" rowspan="2">Aksi</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-center">Nominal</th>
                                                            <th class="text-center" width="70px">Kali</th>
                                                            <th class="text-center">Total</th>
                                                            <th class="text-center" width="70px">%</th>
                                                            <th class="text-center">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $no=1;?>
                                                        <?php foreach((array)$arrKwitansiHRDetail as $val) :?>
                                                            <tr>
                                                                <td class="text-center"><?php echo $no++;?></td>
                                                                <td><?=$val['nama']?></td>
                                                                <td><?=$val['jabatan_kegiatan']?></td>
                                                                <td class="text-right"><?=number_format($val['nominal_bruto'])?></td>
                                                                <td class="text-center"><?=$val['jml_kali']?></td>
                                                                    <?php $totBruto = $val['nominal_bruto']*$val['jml_kali'];?>
                                                                <td class="text-right"><?=number_format($totBruto)?></td>
                                                                <td class="text-center"><?=$val['pajak_persen']?></td>
                                                                    <?php $totPjkPph = ($totBruto*$val['pajak_persen'])/100;?>
                                                                <td class="text-right"><?=number_format($totPjkPph)?></td>
                                                                <td class="text-right"><?=number_format($totBruto-$totPjkPph)?></td>
                                                                <td style="text-align: center;">
                                                                    <?php if($is_spj=='0'){ ?>
                                                                    <a href="<?=base_url()?>KwitansiHR/deleteDetail/<?=$val['fk_kwitansi_hr_id']?>/<?=$val['id']?>" class="btn btn-xs btn-danger" title="Hapus" onclick="javasciprt: return confirm('Apakah anda yakin?')" ><i class="glyphicon glyphicon-trash icon-white"></i></a>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach;?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php endif; ?>
                                        <?php if($is_spj=='0' || empty($id)){ ?>
                                            <div class="table-responsive">
                                                <table border="1" style="width: 100%">
                                                    <tr>
                                                        <th class="text-center" rowspan="2" width="20%">Nama</th>
                                                        <th class="text-center" rowspan="2" width="25%">Jabatan Dlm Kegiatan</th>
                                                        <th class="text-center" colspan="3">Jumlah Penerima</th>
                                                        <th class="text-center" colspan="2">PPh 21</th>
                                                        <th class="text-center" rowspan="2">Jumlah Diterima</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-center">Nominal</th>
                                                        <th class="text-center" width="70px">Kali</th>
                                                        <th class="text-center">Total</th>
                                                        <th class="text-center" width="70px">%</th>
                                                        <th class="text-center">Total</th>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <select class="form-control chosen kosong" id="id_sdm_keg">
                                                                <option value="">Pilih</option>                               
                                                            </select>
                                                            <input type="hidden" id="nama_keg" class="form-control kosong">
                                                        </td>
                                                        <td><input type="text" id="jabatan_keg" class="form-control kosong"></td>
                                                        <td><input type="text" id="nominal_keg" class="form-control nominal kosong"></td>
                                                        <td><input type="text" id="kali_keg" class="form-control text-center angka kosong"></td>
                                                        <td><input type="text" id="tot_trma_keg" class="form-control nominal kosong" readonly></td>
                                                        <td><input type="text" id="persen_keg" class="form-control text-center angka kosong"></td>
                                                        <td><input type="text" id="tot_pph_keg" class="form-control nominal kosong" readonly></td>
                                                        <td><input type="text" id="jml_diterima_keg" class="form-control nominal kosong" readonly></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php if($is_spj=='0' || empty($id)){ ?>
                                    <div class="form-group">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6" align="center">
                                            <a class="btn btn-sm btn-warning reset"><i class="glyphicon glyphicon-remove"></i> Reset (esc)</a>
                                            <a id="tambah_kegiatan" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-plus"></i> Tambahkan Ke List (F2)</a>
                                            <i id='loading'></i>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="panel panel-default">
                                            <table class="table table-bordered table-striped" >
                                                <tr style="background-color: #d5d2d1">
                                                    <th style="vertical-align: middle;" class="text-center" rowspan="2" width="30%">Nama</th>
                                                    <th style="vertical-align: middle;" class="text-center" rowspan="2" width="20%">Jabatan Dlm Keg</th>
                                                    <th class="text-center" colspan="3">Jumlah Penerima</th>
                                                    <th class="text-center" colspan="2">PPh 21</th>
                                                    <th style="vertical-align: middle;" class="text-center" rowspan="2">Jumlah Diterima</th>
                                                    <th style="vertical-align: middle;" rowspan="2" class="text-center">Aksi</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-center">Nominal</th>
                                                    <th class="text-center" width="70px">Kali</th>
                                                    <th class="text-center">Total</th>
                                                    <th class="text-center" width="70px">%</th>
                                                    <th class="text-center">Total</th>
                                                </tr>
                                                <tbody id="tampilDetailKegiatan"></tbody>
                                            </table>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                            <div id="tabel_narsum">
                                <div class="col-md-6"> </div>
                                <div class="col-md-6">  
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Satuan Narasumber</label>
                                        <div class="col-md-4">
                                             <select class="form-control chosen" name="satuan_narsum" id="satuan_narsum">
                                                <option value="">Pilih</option>
                                                <option <?=$satuan_narsum=='OJ'?'selected':''?> value="OJ">Orang/Jam (OJ)</option>
                                                <option <?=$satuan_narsum=='OK'?'selected':''?> value="OK">Orang/Kegiatan (OK)</option>
                                                <option <?=$satuan_narsum=='Orang/Acara'?'selected':''?> value="Orang/Acara">Orang/Acara</option>
                                            </select>
                                        </div>
                                    </div> 
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <legend style="color: blue"> &nbsp; <b>Detail Kwitansi HR</b></legend>
                                        <?php if(isset($arrKwitansiHRDetail)): ?>
                                            <div class="table-responsive" style="overflow-x: auto">                     
                                                <table class="table table-bordered table-striped" id="example2" >
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center" style="vertical-align: middle" rowspan="2" width="50px">No</th>
                                                            <th class="text-center" style="vertical-align: middle" rowspan="2" width="30%">Nama</th>
                                                            <th class="text-center" style="vertical-align: middle" rowspan="2">Jabatan dlm Kegiatan</th>
                                                            <th class="text-center" colspan="5">Jumlah Penerima</th>
                                                            <th class="text-center" colspan="2">PPh 21</th>
                                                            <th class="text-center" style="vertical-align: middle" rowspan="2">Jumlah Diterima</th>
                                                            <th class="text-center" style="vertical-align: middle" rowspan="2">Aksi</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-center">Nominal</th>
                                                            <th class="text-center" width="80px">Persen</th>
                                                            <th class="text-center">Sub Total</th>
                                                            <th class="text-center" width="70px">Kali</th>
                                                            <th class="text-center">Total</th>
                                                            <th class="text-center" width="70px">%</th>
                                                            <th class="text-center">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $no=1;?>
                                                        <?php foreach((array)$arrKwitansiHRDetail as $val) :?>
                                                            <tr>
                                                                <td class="text-center"><?php echo $no++;?></td>
                                                                <td><?=$val['nama']?></td>
                                                                <td><?=$val['jabatan_kegiatan']?></td>
                                                                <td class="text-right"><?=number_format($val['nominal_bruto'])?></td>
                                                                <td class="text-center"><?=$val['persen_kali']?></td>
                                                                <td class="text-center"><?=number_format($val['sub_total_bruto'])?></td>
                                                                <td class="text-center"><?=$val['jml_kali']?></td>
                                                                    <?php $totBruto = $val['sub_total_bruto']*$val['jml_kali'];?>
                                                                <td class="text-right"><?=number_format($totBruto)?></td>
                                                                <td class="text-center"><?=$val['pajak_persen']?></td>
                                                                    <?php $totPjkPph = ($totBruto*$val['pajak_persen'])/100;?>
                                                                <td class="text-right"><?=number_format($totPjkPph)?></td>
                                                                <td class="text-right"><?=number_format($totBruto-$totPjkPph)?></td>
                                                                <td style="text-align: center;">
                                                                    <?php if($is_spj=='0'){ ?>
                                                                    <a href="<?=base_url()?>KwitansiHR/deleteDetail/<?=$val['fk_kwitansi_hr_id']?>/<?=$val['id']?>" class="btn btn-xs btn-danger" title="Hapus" onclick="javasciprt: return confirm('Apakah anda yakin?')" ><i class="glyphicon glyphicon-trash icon-white"></i></a>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach;?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php endif; ?>
                                        <?php if($is_spj=='0' || empty($id)){ ?>
                                            <div class="table-responsive">
                                                <table border="1" style="width: 100%">
                                                    <tr>
                                                        <th class="text-center" rowspan="2" width="30%">Nama</th>
                                                        <th class="text-center" colspan="5">Jumlah Penerima</th>
                                                        <th class="text-center" colspan="2">PPh 21</th>
                                                        <th class="text-center" rowspan="2">Jumlah Diterima</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-center">Nominal</th>
                                                        <th class="text-center" width="80px">Persen</th>
                                                        <th class="text-center">Sub Total</th>
                                                        <th class="text-center" width="70px">Kali</th>
                                                        <th class="text-center">Total</th>
                                                        <th class="text-center" width="70px">%</th>
                                                        <th class="text-center">Total</th>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <select class="form-control chosen kosong" id="id_sdm_narsum">
                                                                <option value="">Pilih</option>                               
                                                            </select>
                                                        </td>
                                                        <td><input type="text" id="nominal_narsum" class="form-control nominal kosong"></td>
                                                        <td><input type="text" id="persen_kali_narsum" class="form-control text-center angka kosong"></td>
                                                        <td><input type="text" id="sub_total_bruto" class="form-control nominal kosong" readonly></td>
                                                        <td><input type="text" id="jml_kali_narsum" class="form-control text-center angka kosong"></td>
                                                        <td><input type="text" id="tot_trma_narsum" class="form-control nominal kosong" readonly></td>
                                                        <td><input type="text" id="persen_narsum" class="form-control text-center angka kosong"></td>
                                                        <td><input type="text" id="tot_pph_narsum" class="form-control nominal kosong" readonly></td>
                                                        <td><input type="text" id="jml_diterima_narsum" class="form-control nominal kosong" readonly></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php if($is_spj=='0' || empty($id)){ ?>
                                    <div class="form-group">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6" align="center">
                                            <a class="btn btn-sm btn-warning reset"><i class="glyphicon glyphicon-remove"></i> Reset (esc)</a>
                                            <a id="tambah_narsum" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-plus"></i> Tambahkan Ke List (F2)</a>
                                            <i id='loading'></i>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="panel panel-default">
                                            <table class="table table-bordered table-striped" >
                                                <tr style="background-color: #d5d2d1">
                                                    <th style="vertical-align: middle;" class="text-center" rowspan="2" width="30%">Nama</th>
                                                    <th style="vertical-align: middle;" class="text-center" rowspan="2" width="20%">Jabatan Dlm Keg</th>
                                                    <th class="text-center" colspan="5">Jumlah Penerima</th>
                                                    <th class="text-center" colspan="2">PPh 21</th>
                                                    <th style="vertical-align: middle;" class="text-center" rowspan="2">Jumlah Diterima</th>
                                                    <th style="vertical-align: middle;" rowspan="2" class="text-center">Aksi</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-center">Nominal</th>
                                                    <th class="text-center" width="80px">Persen</th>
                                                    <th class="text-center">Sub Total</th>
                                                    <th class="text-center" width="70px">Kali</th>
                                                    <th class="text-center">Total</th>
                                                    <th class="text-center" width="70px">%</th>
                                                    <th class="text-center">Total</th>
                                                </tr>
                                                <tbody id="tampilDetailNarsum"></tbody>
                                            </table>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                            <div id="tabel_kontrak">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <legend style="color: blue"> &nbsp; <b>Detail Kwitansi HR</b></legend>
                                        <?php if(isset($arrKwitansiHRDetail)): ?>
                                            <div class="table-responsive" style="overflow-x: auto">                     
                                                <table class="table table-bordered table-striped" id="example2" >
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center" style="vertical-align: middle" rowspan="2" width="50px">No</th>
                                                            <th class="text-center" style="vertical-align: middle" rowspan="2" width="20%">Nama</th>
                                                            <th class="text-center" colspan="5">Jumlah Penerimaan</th>
                                                            <th class="text-center" colspan="5">Jumlah Pengeluaran</th>
                                                            <th class="text-center" style="vertical-align: middle" rowspan="2">Jumlah Diterima</th>
                                                            <th class="text-center" style="vertical-align: middle" rowspan="2">Aksi</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-center">HR Kontrak</th>
                                                            <th class="text-center">BPJS Kes<br>Pemkab (4%)</th>
                                                            <th class="text-center">JKK (0,24%)</th>
                                                            <th class="text-center">JKM (0,30%)</th>
                                                            <th class="text-center">Penghasilan Kotor</th>
                                                            <th class="text-center">BPJS Kes<br>Pemkab (4%)</th>
                                                            <th class="text-center">BPJS Kes<br>Peserta (1%)</th>
                                                            <th class="text-center">JKK (0,24%)</th>
                                                            <th class="text-center">JKM (0,30%)</th>
                                                            <th class="text-center">Jumlah</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $no=1;?>
                                                        <?php foreach((array)$arrKwitansiHRDetail as $val) :?>
                                                            <tr>
                                                                <td class="text-center"><?php echo $no++;?></td>
                                                                <td><?=$val['nama']?></td>
                                                                <td class="text-right"><?=number_format($val['nominal_bruto'])?></td>
                                                                <td class="text-right"><?=number_format($val['bpjs_kes_pemkab'])?></td>
                                                                <td class="text-right"><?=number_format($val['bpjs_krj_jkk'])?></td>
                                                                <td class="text-right"><?=number_format($val['bpjs_krj_jkm'])?></td>
                                                                <td class="text-right"><?=number_format($val['penghasilan_kotor'])?></td>
                                                                <td class="text-right"><?=number_format($val['bpjs_kes_pemkab'])?></td>
                                                                <td class="text-right"><?=number_format($val['bpjs_kes_peserta'])?></td>
                                                                <td class="text-right"><?=number_format($val['bpjs_krj_jkk'])?></td>
                                                                <td class="text-right"><?=number_format($val['bpjs_krj_jkm'])?></td>
                                                                <td class="text-right"><?=number_format($val['jml_pengeluaran'])?></td>
                                                                <td class="text-right"><?=number_format($val['jml_diterima'])?></td>
                                                                <td style="text-align: center;">
                                                                    <?php if($is_spj=='0'){ ?>
                                                                        <a href="<?=base_url()?>KwitansiHR/deleteDetail/<?=$val['fk_kwitansi_hr_id']?>/<?=$val['id']?>" class="btn btn-xs btn-danger" title="Hapus" onclick="javasciprt: return confirm('Apakah anda yakin?')" ><i class="glyphicon glyphicon-trash icon-white"></i></a></td>
                                                                    <?php } ?>
                                                            </tr>
                                                        <?php endforeach;?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php endif; ?>
                                        <?php if($is_spj=='0' || empty($id)){ ?>
                                            <div class="table-responsive">
                                                <table border="1" style="width: 100%; font-size: 8pt">
                                                    <tr>
                                                        <th class="text-center" rowspan="2" width="20%">Nama</th>
                                                        <th class="text-center" colspan="5">Jumlah Penerimaan</th>
                                                        <th class="text-center" colspan="5">Jumlah Pengeluaran</th>
                                                        <th class="text-center" rowspan="2">Jumlah Diterima</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-center">HR Kontrak</th>
                                                        <th class="text-center">BPJS Kes<br>Pemkab (4%)</th>
                                                        <th class="text-center">JKK (0,24%)</th>
                                                        <th class="text-center">JKM (0,30%)</th>
                                                        <th class="text-center">Penghasilan Kotor</th>
                                                        <th class="text-center">BPJS Kes<br>Pemkab (4%)</th>
                                                        <th class="text-center">BPJS Kes<br>Peserta(1%)</th>
                                                        <th class="text-center">JKK (0,24%)</th>
                                                        <th class="text-center">JKM (0,30%)</th>
                                                        <th class="text-center">Jumlah</th>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <select class="form-control chosen kosong" id="id_sdm_kon">
                                                                <option value="">Pilih</option>
                                                                <!-- <?php foreach($arrSdmKontrak as $sd): ?>
                                                                    <option value="<?=$sd->id?>"><?=$sd->nama?></option>
                                                                <?php endforeach; ?> -->
                                                            </select>
                                                        </td>
                                                        <td><input type="text" style="font-size: 8pt" id="nominal_kon" class="form-control kosong nominal"></td>
                                                        <td><input type="text" style="font-size: 8pt" id="bpjs_pemkab_terima" class="form-control kosong text-center nominal"></td>
                                                        <td><input type="text" style="font-size: 8pt" id="bpjs_jkk_terima" class="form-control kosong text-center nominal"></td>
                                                        <td><input type="text" style="font-size: 8pt" id="bpjs_jkm_terima" class="form-control kosong text-center nominal"></td>
                                                        <td><input type="text" style="font-size: 8pt" id="hasil_kotor" class="form-control kosong nominal" readonly></td>
                                                        <td><input type="text" style="font-size: 8pt" id="bpjs_pemkab_keluar" class="form-control kosong text-center nominal" readonly></td>
                                                        <td><input type="text" style="font-size: 8pt" id="bpjs_psrta_keluar" class="form-control kosong text-center nominal" ></td>
                                                        <td><input type="text" style="font-size: 8pt" id="bpjs_jkk_keluar" class="form-control kosong text-center nominal" readonly></td>
                                                        <td><input type="text" style="font-size: 8pt" id="bpjs_jkm_keluar" class="form-control kosong text-center nominal" readonly></td>
                                                        <td><input type="text" style="font-size: 8pt" id="jumlah_kon" class="form-control kosong nominal" readonly></td>
                                                        <td><input type="text" style="font-size: 8pt" id="terima_bersih" class="form-control kosong nominal" readonly></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php if($is_spj=='0' || empty($id)){ ?>
                                    <div class="form-group">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6" align="center">
                                            <a class="btn btn-sm btn-warning reset"><i class="glyphicon glyphicon-remove"></i> Reset (esc)</a>
                                            <a id="tambah_kontrak" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-plus"></i> Tambahkan Ke List (F2)</a>
                                            <i id='loading'></i>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="panel panel-default">
                                            <table class="table table-bordered table-striped" style="font-size: 9pt">
                                                <tr style="background-color: #d5d2d1">
                                                    <th style="vertical-align: middle;" class="text-center" rowspan="2" width="20%">Nama</th>
                                                    <th class="text-center" colspan="5">Jumlah Penerima</th>
                                                    <th class="text-center" colspan="5">Jumlah Pengeluaran</th>
                                                    <th style="vertical-align: middle;" class="text-center" rowspan="2">Jumlah Diterima</th>
                                                    <th style="vertical-align: middle;" rowspan="2" class="text-center">Aksi</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-center">HR Kontrak</th>
                                                    <th class="text-center">BPJS Kes<br>Pemkab (4%)</th>
                                                    <th class="text-center">JKK (0,24%)</th>
                                                    <th class="text-center">JKM (0,30%)</th>
                                                    <th class="text-center">Penghasilan Kotor</th>
                                                    <th class="text-center">BPJS Kes<br>Pemkab (4%)</th>
                                                    <th class="text-center">BPJS Kes<br>Peserta(1%)</th>
                                                    <th class="text-center">JKK (0,24%)</th>
                                                    <th class="text-center">JKM (0,30%)</th>
                                                </tr>
                                                <tbody id="tampilDetailKontrak"></tbody>
                                            </table>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12"></div>
                                <div class="col-md-10" align="center">
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
$(document).ready(function(){
    cari_program("<?=$fk_program_id?>");
    cari_keg("<?=$fk_program_id?>","<?=$fk_kegiatan_id?>");
    cari_rekBlnja("<?=$fk_kegiatan_id?>","<?=$fk_rekening_belanja_id?>");
    cari_kpa("<?=$nama_pejabat_kpa?>");
    cari_pptk("<?=$nama_pejabat_pptk?>");
    
    cariKategori("<?=$kategori?>");

    $(document).keyup(function(e) {
        if(e.which == 27) { //esc
            kosong();  
        }
        if(e.which == 113) { //f2
            tambahList();        
        }
    }); 

});

function validateForm(assignmentForm){
    var messages = [];
    if($("#fk_bagian_id").val()==''){
        messages.push("Bagian, ");
    }
    if($("#fk_program_id").val()==''){
        messages.push("Program, ");
    }
    if($("#fk_kegiatan_id").val()==''){
        messages.push("Kegiatan Bappeda, ");
    }
    if (messages.length > 0) { 
        messages.push("Tidak boleh kosong.");
        alert(messages.join('\n'));
        return false;
    } else {
        return true;
    }
}

$("#kategori").change(function(){
    val = $(this).val();
    cariKategori(val);
});

$("#is_kontrak_it").change(function(){
    val = $("#kategori").val();
    cariKategori(val);
});

function cariKategori(val){
    $("#tabel_kegiatan").hide();
    $("#tabel_narsum").hide();
    $("#tabel_kontrak").hide();
    $("#isKontrakIT").hide();
    id = $("#id").val();
    $('#untuk_pembayaran').attr('readOnly',false);

    if(val=='KEGIATAN'){
        $("#tabel_kegiatan").show();
        if(id==''){
            $("#untuk_pembayaran").html('Honorarium ...');
        }

        // $.ajax({
        //     type: "POST",
        //     dataType: "json",
        //     url: "<?php echo base_url().'KwitansiHR/namaSdmHR'?>",
        //     data: {val},
        //     success: function(msg){
        //        $('#id_sdm_keg').html(msg.hasil);
        //        $('#id_sdm_keg').trigger("chosen:updated");
        //     }
        // });
        cari_pegawai(); 

    }
    if(val=='NARASUMBER'){
        $("#tabel_narsum").show();
        if(id==''){
            $("#untuk_pembayaran").html('Honorarium ...');
        }

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url().'KwitansiHR/namaSdmHR'?>",
            data: {val},
            success: function(msg){
               $('#id_sdm_narsum').html(msg.hasil);
               $('#id_sdm_narsum').trigger("chosen:updated");
            }
        }); 

    }
    if(val=='KONTRAK'){
        $("#isKontrakIT").show();
        $("#tabel_kontrak").show();
        if(id==''){
            // $('#untuk_pembayaran').attr('readonly',true);
            if ($('#is_kontrak_it').is(':checked')) {
                $("#untuk_pembayaran").html('Honorarium Pegawai Kontrak IT');
            }else{
                $("#untuk_pembayaran").html('Honorarium Pegawai Kontrak / THL');
            }
        }
    }
}

$(".reset").click(function(){
    kosong();
});
function kosong(){
    $(".kosong").val('');
    $('#id_sdm_keg').trigger("chosen:updated");
    $('#id_sdm_narsum').trigger("chosen:updated");
    $('#id_sdm_kon').trigger("chosen:updated");
}

$("#tambah_kegiatan").click(function(){
    tambahList();
});

$("#tambah_narsum").click(function(){
    tambahList();
});

$("#tambah_kontrak").click(function(){
    tambahList();
});

$("#id_sdm_keg").change(function(){
    id_sdm=$(this).val();
    $.ajax({
        async: false,
        type: "POST",
        url: "<?php echo base_url().'KwitansiHR/cariNamaKeg'?>",
        data: {id_sdm},
        dataType: 'json',
        success: function(msg){ 
            $("#nama_keg").val(msg.nama);
            $("#jabatan_keg").val(msg.jabatan_kegiatan);
        }
    });
})

function tambahList(){
    kategori = $('#kategori').val();

    if(kategori==''){
        alert('Kategori tidak boleh kosong.');
        $("#kategori").focus();
        return false;
    }

    $("#loading").html('<div class="loader"></div>');
 
    if(kategori=='KEGIATAN'){
        id_sdm = $('#id_sdm_keg').val();
        // if(id_sdm==''){
        //     alert('Nama tidak boleh kosong.');
        //     $("#id_sdm_keg").focus();
        //     return false;
        // }

        nama_sdm = $('#nama_keg').val();
        jabatan_kegiatan = $('#jabatan_keg').val();

        nominal_keg = $('#nominal_keg').val();
        rep_nominal_keg = nominal_keg.replace(/,/g,"");
        kali_keg = $('#kali_keg').val();
        tot_trma_keg = $('#tot_trma_keg').val();
        persen_keg = $('#persen_keg').val();
        tot_pph_keg = $('#tot_pph_keg').val();
        jml_diterima_keg = $('#jml_diterima_keg').val();
        rep_jml_diterima_keg = jml_diterima_keg.replace(/,/g,"");
        

        $("#tampilDetailKegiatan").append(
            '<tr>'+
                '<td>'+nama_sdm+'</td>'+
                '<td>'+jabatan_kegiatan+'</td>'+
                '<td style="text-align:right">'+nominal_keg+'</td>'+
                '<td style="text-align:center">'+kali_keg+'</td>'+
                '<td style="text-align:right">'+tot_trma_keg+'</td>'+
                '<td style="text-align:center">'+persen_keg+'</td>'+
                '<td style="text-align:right">'+tot_pph_keg+'</td>'+
                '<td style="text-align:right">'+jml_diterima_keg+'</td>'+
                '<td class="text-center"><a style="cursor: pointer;" title="hapus" class="remove btn btn-xs btn-danger" ><i class="glyphicon glyphicon-trash"></i></a>'+
                    '<input type="hidden" name="listSdmId[]" value="'+id_sdm+'">'+
                    '<input type="hidden" name="listNamaSdm[]" value="'+nama_sdm+'">'+
                    '<input type="hidden" name="listJabKeg[]" value="'+jabatan_kegiatan+'">'+
                    '<input type="hidden" name="listNominal[]" value="'+rep_nominal_keg+'">'+
                    '<input type="hidden" name="listKali[]" value="'+kali_keg+'">'+
                    '<input type="hidden" name="listPajak[]" value="'+persen_keg+'">'+
                    '<input type="hidden" name="listJmlDiterima[]" value="'+rep_jml_diterima_keg+'">'+
                '</td>'+
            '</tr>'
        ); 
        $('#id_sdm_keg').val('');
        $('#id_sdm_keg').trigger("chosen:updated");
    } 

    if(kategori=='NARASUMBER'){
        id_sdm = $('#id_sdm_narsum').val();
        if(id_sdm==''){
            alert('Nama tidak boleh kosong.');
            $("#id_sdm_keg").focus();
            return false;
        }

        nominal_narsum = $('#nominal_narsum').val();
        rep_nominal_narsum = nominal_narsum.replace(/,/g,"");
        persen_kali_narsum = $('#persen_kali_narsum').val();

        sub_total_bruto = $('#sub_total_bruto').val();
        rep_sub_total_bruto = sub_total_bruto.replace(/,/g,"");

        jml_kali_narsum = $('#jml_kali_narsum').val();
        tot_trma_narsum = $('#tot_trma_narsum').val();
        persen_narsum = $('#persen_narsum').val();
        tot_pph_narsum = $('#tot_pph_narsum').val();
        jml_diterima_narsum = $('#jml_diterima_narsum').val();
        rep_jml_diterima_narsum = jml_diterima_narsum.replace(/,/g,"");

        if(id_sdm=='narasumber'){
            nama_sdm='';
            jabatan_kegiatan='Narasumber';
        }
        if(id_sdm=='moderator'){
            nama_sdm='';
            jabatan_kegiatan='Moderator';
        }

        $("#tampilDetailNarsum").append(
            '<tr>'+
                '<td>'+nama_sdm+'</td>'+
                '<td>'+jabatan_kegiatan+'</td>'+
                '<td style="text-align:right">'+nominal_narsum+'</td>'+
                '<td style="text-align:center">'+persen_kali_narsum+'</td>'+
                '<td style="text-align:center">'+sub_total_bruto+'</td>'+
                '<td style="text-align:center">'+jml_kali_narsum+'</td>'+
                '<td style="text-align:right">'+tot_trma_narsum+'</td>'+
                '<td style="text-align:center">'+persen_narsum+'</td>'+
                '<td style="text-align:right">'+tot_pph_narsum+'</td>'+
                '<td style="text-align:right">'+jml_diterima_narsum+'</td>'+
                '<td class="text-center"><a style="cursor: pointer;" title="hapus" class="remove btn btn-xs btn-danger" ><i class="glyphicon glyphicon-trash"></i></a>'+
                    '<input type="hidden" name="listSdmIdNarsum[]" value="'+id_sdm+'">'+
                    '<input type="hidden" name="listNamaSdmNarsum[]" value="'+nama_sdm+'">'+
                    '<input type="hidden" name="listJabNarsum[]" value="'+jabatan_kegiatan+'">'+
                    '<input type="hidden" name="listNominaNarsum[]" value="'+rep_nominal_narsum+'">'+
                    '<input type="hidden" name="listPersenKaliNarsum[]" value="'+persen_kali_narsum+'">'+
                    '<input type="hidden" name="listSubTotalNarsum[]" value="'+rep_sub_total_bruto+'">'+
                    '<input type="hidden" name="listJmlKaliNarsum[]" value="'+jml_kali_narsum+'">'+
                    '<input type="hidden" name="listPajakNarsum[]" value="'+persen_narsum+'">'+
                    '<input type="hidden" name="listJmlDiterimaNarsum[]" value="'+rep_jml_diterima_narsum+'">'+
                '</td>'+
            '</tr>'
        ); 
        $('#id_sdm_keg').val('');
        $('#id_sdm_keg').trigger("chosen:updated");
    } 

    if(kategori=='KONTRAK'){
        id_sdmKon = $('#id_sdm_kon').val();
        if(id_sdmKon==''){
            alert('Nama tidak boleh kosong.');
            $("#id_sdm_kon").focus();
            return false;
        }

        nominal_kon = $('#nominal_kon').val();
        rep_nominal_kon = nominal_kon.replace(/,/g,"");
        bpjs_pemkab_terima = $('#bpjs_pemkab_terima').val();
        rep_bpjs_pemkab_terima = bpjs_pemkab_terima.replace(/,/g,"");
        bpjs_jkk_terima = $('#bpjs_jkk_terima').val();
        rep_bpjs_jkk_terima = bpjs_jkk_terima.replace(/,/g,"");
        bpjs_jkm_terima = $('#bpjs_jkm_terima').val();
        rep_bpjs_jkm_terima = bpjs_jkm_terima.replace(/,/g,"");
        hasil_kotor = $('#hasil_kotor').val();
        rep_hasil_kotor = hasil_kotor.replace(/,/g,"");
        bpjs_psrta_keluar = $('#bpjs_psrta_keluar').val();
        rep_bpjs_psrta_keluar = bpjs_psrta_keluar.replace(/,/g,"");
        jumlah_kon = $('#jumlah_kon').val();
        rep_jumlah_kon = jumlah_kon.replace(/,/g,"");
        terima_bersih = $('#terima_bersih').val();
        rep_terima_bersih = terima_bersih.replace(/,/g,"");   

        $.ajax({
            async: false,
            type: "POST",
            url: "<?php echo base_url().'KwitansiHR/cariNamaKeg'?>",
            data: {id_sdm:id_sdmKon},
            dataType: 'json',
            success: function(msg){ 
                nama_sdm = msg.nama;
            }
        });   

        $("#tampilDetailKontrak").append(
            '<tr>'+
                '<td>'+nama_sdm+'</td>'+
                '<td style="text-align:right">'+nominal_kon+'</td>'+
                '<td style="text-align:right">'+bpjs_pemkab_terima+'</td>'+
                '<td style="text-align:right">'+bpjs_jkk_terima+'</td>'+
                '<td style="text-align:right">'+bpjs_jkm_terima+'</td>'+
                '<td style="text-align:right">'+hasil_kotor+'</td>'+
                '<td style="text-align:right">'+bpjs_pemkab_terima+'</td>'+
                '<td style="text-align:right">'+bpjs_psrta_keluar+'</td>'+
                '<td style="text-align:right">'+bpjs_jkk_terima+'</td>'+
                '<td style="text-align:right">'+bpjs_jkm_terima+'</td>'+
                '<td style="text-align:right">'+jumlah_kon+'</td>'+
                '<td style="text-align:right">'+terima_bersih+'</td>'+
                '<td class="text-center"><a style="cursor: pointer;" title="hapus" class="remove btn btn-xs btn-danger" ><i class="glyphicon glyphicon-trash"></i></a>'+
                    '<input type="hidden" name="listSdmIdKon[]" value="'+id_sdmKon+'">'+
                    '<input type="hidden" name="listNamaSdmKon[]" value="'+nama_sdm+'">'+
                    '<input type="hidden" name="listNominalKon[]" value="'+rep_nominal_kon+'">'+
                    '<input type="hidden" name="listBpjsKesPmkab[]" value="'+rep_bpjs_pemkab_terima+'">'+
                    '<input type="hidden" name="listBpjsKrjJKK[]" value="'+rep_bpjs_jkk_terima+'">'+
                    '<input type="hidden" name="listBpjsKrjJKM[]" value="'+rep_bpjs_jkm_terima+'">'+
                    '<input type="hidden" name="listHasilKotor[]" value="'+rep_hasil_kotor+'">'+
                    '<input type="hidden" name="listBpjsKesPsrta[]" value="'+rep_bpjs_psrta_keluar+'">'+
                    '<input type="hidden" name="listJmlKluar[]" value="'+rep_jumlah_kon+'">'+
                    '<input type="hidden" name="listJmlDiterimaKon[]" value="'+rep_terima_bersih+'">'+
                '</td>'+
            '</tr>'
        ); 
        $('#id_sdm_kon').val('');
        $('#id_sdm_kon').trigger("chosen:updated");
    }  

    kosong();
    $("#loading").html('');
}

$("#tampilDetailKegiatan").on('click','.remove',function(){
    if(confirm('Apakah anda yakin?')){
        $(this).parent().parent().remove();
    }
});

$("#tampilDetailNarsum").on('click','.remove',function(){
    if(confirm('Apakah anda yakin?')){
        $(this).parent().parent().remove();
    }
});

$("#tampilDetailKontrak").on('click','.remove',function(){
    if(confirm('Apakah anda yakin?')){
        $(this).parent().parent().remove();
    }
});

$("#fk_bagian_id").change(function(){
    cari_program();
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

function cari_pegawai(){
    fk_bagian_id = $("#fk_bagian_id").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Pjd/getNamaPegawai'?>",
        data: {fk_bagian_id},
        success: function(msg){
            $('#id_sdm_kon').html(msg.arrPegawai);
            $('#id_sdm_kon').trigger("chosen:updated");
            $('#id_sdm_keg').html(msg.arrPegawai);
            $('#id_sdm_keg').trigger("chosen:updated");
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

    //KEGIATAN
$("#nominal_keg").keyup(function(){
    hitung_keg();
});

$("#kali_keg").keyup(function(){
    hitung_keg();
});

$("#persen_keg").keyup(function(){
    hitung_keg();
});

function hitung_keg(){
    nom = $("#nominal_keg").val();
    if(nom==''){
        nom='0';
    }

    kali_keg = $("#kali_keg").val();
    if(kali_keg==''){
        kali_keg=0;
    }

    pph = $("#persen_keg").val();
    if(pph==''){
        pph=0;
    }

    rep_nom = nom.replace(/,/g,"");
    tot=parseFloat(rep_nom)*kali_keg;
    totTrma = convertToRupiah(tot);
    $('#tot_trma_keg').val(totTrma);

    hsl_pjk=(parseFloat(tot)*pph)/100;
    totPph = convertToRupiah(hsl_pjk);
    $('#tot_pph_keg').val(totPph);

    akhir=parseFloat(tot)-parseFloat(hsl_pjk);
    totAkhr = convertToRupiah(akhir);
    $('#jml_diterima_keg').val(totAkhr);
}

 //NARSUM
$("#nominal_narsum").keyup(function(){
    hitung_narsum();
});

$("#persen_kali_narsum").keyup(function(){
    hitung_narsum();
});

$("#jml_kali_narsum").keyup(function(){
    hitung_narsum();
});

$("#persen_narsum").keyup(function(){
    hitung_narsum();
});

function hitung_narsum(){
    nom = $("#nominal_narsum").val();
    if(nom==''){
        nom='0';
    }

    persen_kali_narsum = $("#persen_kali_narsum").val();
    if(persen_kali_narsum==''){
        persen_kali_narsum=0;
    }

    rep_nom = nom.replace(/,/g,"");
    subTot=(parseFloat(rep_nom)*persen_kali_narsum)/100;
    subTotTrma = convertToRupiah(subTot);
    $('#sub_total_bruto').val(subTotTrma);

    jml_kali_narsum = $("#jml_kali_narsum").val();
    if(jml_kali_narsum==''){
        jml_kali_narsum=0;
    }

    pph = $("#persen_narsum").val();
    if(pph==''){
        pph=0;
    }

    rep_nom = nom.replace(/,/g,"");
    tot=subTot*jml_kali_narsum;
    totTrma = convertToRupiah(tot);
    $('#tot_trma_narsum').val(totTrma);

    hsl_pjk=(parseFloat(tot)*pph)/100;
    totPph = convertToRupiah(hsl_pjk);
    $('#tot_pph_narsum').val(totPph);

    akhir=parseFloat(tot)-parseFloat(hsl_pjk);
    totAkhr = convertToRupiah(akhir);
    $('#jml_diterima_narsum').val(totAkhr);
}

    //KONTRAK
$("#nominal_kon").keyup(function(){
    nom = $("#nominal_kon").val();
    if(nom==''){
        nom='0';
    }
    rep_nom = nom.replace(/,/g,"");

    hslTrmBpjsPmkab=Math.ceil((parseFloat(rep_nom)*4)/100);
    hslTrmBpjsPmkab1 = convertToRupiah(hslTrmBpjsPmkab);
    $('#bpjs_pemkab_terima').val(hslTrmBpjsPmkab1);
    $('#bpjs_pemkab_keluar').val(hslTrmBpjsPmkab1);

    hslTrmBpjsJKK=Math.ceil((parseFloat(rep_nom)*0.24)/100);  //bpjs ketenagakerjaan JKK
    hslTrmBpjsJKK1 = convertToRupiah(hslTrmBpjsJKK);
    $('#bpjs_jkk_terima').val(hslTrmBpjsJKK1);
    $('#bpjs_jkk_keluar').val(hslTrmBpjsJKK1);

    hslTrmBpjsJKM=Math.ceil((parseFloat(rep_nom)*0.30)/100); //bpjs ketenagakerjaan JKM
    hslTrmBpjsJKM1 = convertToRupiah(hslTrmBpjsJKM);
    $('#bpjs_jkm_terima').val(hslTrmBpjsJKM1);
    $('#bpjs_jkm_keluar').val(hslTrmBpjsJKM1);

    hslKluarBpjsPsrta=Math.ceil((parseFloat(rep_nom)*1)/100);
    hslKluarBpjsPsrta1 = convertToRupiah(hslKluarBpjsPsrta);
    $('#bpjs_psrta_keluar').val(hslKluarBpjsPsrta1);

    hitung_kontrak(rep_nom,hslTrmBpjsPmkab,hslKluarBpjsPsrta,hslTrmBpjsJKK,hslTrmBpjsJKM);
});

$("#bpjs_pemkab_terima").keyup(function(){
    nom = $("#nominal_kon").val();
    rep_nom = nom.replace(/,/g,"");

    bpjsPmkab=$("#bpjs_pemkab_terima").val();
    hslTrmBpjsPmkab1='';
    if(bpjsPmkab!=''){
        hslTrmBpjsPmkab = bpjsPmkab.replace(/,/g,"");
        hslTrmBpjsPmkab1 = convertToRupiah(hslTrmBpjsPmkab);
    }else{
        hslTrmBpjsPmkab = 0;
    }
    $('#bpjs_pemkab_keluar').val(hslTrmBpjsPmkab1);

    bpjsPsrta=$("#bpjs_psrta_keluar").val();
    hslKluarBpjsPsrta='';
    if(bpjsPsrta!=''){
        hslKluarBpjsPsrta = bpjsPsrta.replace(/,/g,"");
    }else{
        hslKluarBpjsPsrta = 0;
    }

    bpjsJKK=$("#bpjs_jkk_terima").val();
    hslTrmBpjsJKK='';
    if(bpjsJKK!=''){
        hslTrmBpjsJKK = bpjsJKK.replace(/,/g,"");
       hslTrmBpjsJKK1 = convertToRupiah(hslTrmBpjsJKK);
    }else{
        hslTrmBpjsJKK = 0;
    }
    $('#bpjs_jkk_keluar').val(hslTrmBpjsJKK1);  

    bpjsJKM=$("#bpjs_jkm_terima").val();
    hslTrmBpjsJKM='';
    if(bpjsJKM!=''){
        hslTrmBpjsJKM = bpjsJKM.replace(/,/g,"");
       hslTrmBpjsJKM1 = convertToRupiah(hslTrmBpjsJKM);
    }else{
        hslTrmBpjsJKM = 0;
    }
    $('#bpjs_jkm_keluar').val(hslTrmBpjsJKM1);    
   
    hitung_kontrak(rep_nom,hslTrmBpjsPmkab,hslKluarBpjsPsrta,hslTrmBpjsJKK,hslTrmBpjsJKM);
});

$("#bpjs_psrta_keluar").keyup(function(){
    nom = $("#nominal_kon").val();
    rep_nom = nom.replace(/,/g,"");

    bpjsPsrta=$("#bpjs_psrta_keluar").val();
    hslKluarBpjsPsrta='';
    if(bpjsPsrta!=''){
        hslKluarBpjsPsrta = bpjsPsrta.replace(/,/g,"");
    }else{
        hslKluarBpjsPsrta = 0;
    }

    bpjsPmkab=$("#bpjs_pemkab_terima").val();
    hslTrmBpjsPmkab1='';
    if(bpjsPmkab!=''){
        hslTrmBpjsPmkab = bpjsPmkab.replace(/,/g,"");
        hslTrmBpjsPmkab1 = convertToRupiah(hslTrmBpjsPmkab);
    }
    $('#bpjs_pemkab_keluar').val(hslTrmBpjsPmkab1);


    bpjsJKK=$("#bpjs_jkk_terima").val();
    hslTrmBpjsJKK='';
    if(bpjsJKK!=''){
        hslTrmBpjsJKK = bpjsJKK.replace(/,/g,"");
       hslTrmBpjsJKK1 = convertToRupiah(hslTrmBpjsJKK);
    }else{
        hslTrmBpjsJKK = 0;
    }
    $('#bpjs_jkk_keluar').val(hslTrmBpjsJKK1);  

    bpjsJKM=$("#bpjs_jkm_terima").val();
    hslTrmBpjsJKM='';
    if(bpjsJKM!=''){
        hslTrmBpjsJKM = bpjsJKM.replace(/,/g,"");
       hslTrmBpjsJKM1 = convertToRupiah(hslTrmBpjsJKM);
    }else{
        hslTrmBpjsJKM = 0;
    }
    $('#bpjs_jkm_keluar').val(hslTrmBpjsJKM1);    

    hitung_kontrak(rep_nom,hslTrmBpjsPmkab,hslKluarBpjsPsrta,hslTrmBpjsJKK,hslTrmBpjsJKM);
});

$("#bpjs_jkk_terima").keyup(function(){
    nom = $("#nominal_kon").val();
    rep_nom = nom.replace(/,/g,"");

    bpjsPsrta=$("#bpjs_psrta_keluar").val();
    hslKluarBpjsPsrta='';
    if(bpjsPsrta!=''){
        hslKluarBpjsPsrta = bpjsPsrta.replace(/,/g,"");
    }else{
        hslKluarBpjsPsrta = 0;
    }

    bpjsPmkab=$("#bpjs_pemkab_terima").val();
    hslTrmBpjsPmkab1='';
    if(bpjsPmkab!=''){
        hslTrmBpjsPmkab = bpjsPmkab.replace(/,/g,"");
        hslTrmBpjsPmkab1 = convertToRupiah(hslTrmBpjsPmkab);
    }
    $('#bpjs_pemkab_keluar').val(hslTrmBpjsPmkab1);


    bpjsJKK=$("#bpjs_jkk_terima").val();
    hslTrmBpjsJKK1='';
    if(bpjsJKK!=''){
        hslTrmBpjsJKK = bpjsJKK.replace(/,/g,"");
       hslTrmBpjsJKK1 = convertToRupiah(hslTrmBpjsJKK);
    }else{
        hslTrmBpjsJKK = 0;
    }
    $('#bpjs_jkk_keluar').val(hslTrmBpjsJKK1);  

    bpjsJKM=$("#bpjs_jkm_terima").val();
    hslTrmBpjsJKM1='';
    if(bpjsJKM!=''){
        hslTrmBpjsJKM = bpjsJKM.replace(/,/g,"");
       hslTrmBpjsJKM1 = convertToRupiah(hslTrmBpjsJKM);
    }else{
        hslTrmBpjsJKM = 0;
    }
    $('#bpjs_jkm_keluar').val(hslTrmBpjsJKM1);    

    hitung_kontrak(rep_nom,hslTrmBpjsPmkab,hslKluarBpjsPsrta,hslTrmBpjsJKK,hslTrmBpjsJKM);
});

$("#bpjs_jkm_terima").keyup(function(){
    nom = $("#nominal_kon").val();
    rep_nom = nom.replace(/,/g,"");

    bpjsPsrta=$("#bpjs_psrta_keluar").val();
    hslKluarBpjsPsrta='';
    if(bpjsPsrta!=''){
        hslKluarBpjsPsrta = bpjsPsrta.replace(/,/g,"");
    }else{
        hslKluarBpjsPsrta = 0;
    }

    bpjsPmkab=$("#bpjs_pemkab_terima").val();
    hslTrmBpjsPmkab1='';
    if(bpjsPmkab!=''){
        hslTrmBpjsPmkab = bpjsPmkab.replace(/,/g,"");
        hslTrmBpjsPmkab1 = convertToRupiah(hslTrmBpjsPmkab);
    }
    $('#bpjs_pemkab_keluar').val(hslTrmBpjsPmkab1);


    bpjsJKK=$("#bpjs_jkk_terima").val();
    hslTrmBpjsJKK1='';
    if(bpjsJKK!=''){
        hslTrmBpjsJKK = bpjsJKK.replace(/,/g,"");
       hslTrmBpjsJKK1 = convertToRupiah(hslTrmBpjsJKK);
    }else{
        hslTrmBpjsJKK = 0;
    }
    $('#bpjs_jkk_keluar').val(hslTrmBpjsJKK1);  

    bpjsJKM=$("#bpjs_jkm_terima").val();
    hslTrmBpjsJKM1='';
    if(bpjsJKM!=''){
        hslTrmBpjsJKM = bpjsJKM.replace(/,/g,"");
       hslTrmBpjsJKM1 = convertToRupiah(hslTrmBpjsJKM);
    }else{
        hslTrmBpjsJKM = 0;
    }
    $('#bpjs_jkm_keluar').val(hslTrmBpjsJKM1);    

    hitung_kontrak(rep_nom,hslTrmBpjsPmkab,hslKluarBpjsPsrta,hslTrmBpjsJKK,hslTrmBpjsJKM);
});

function hitung_kontrak(rep_nom,hslTrmBpjsPmkab,hslKluarBpjsPsrta,hslTrmBpjsJKK,hslTrmBpjsJKM){    

    hslKtor = parseFloat(rep_nom)+parseFloat(hslTrmBpjsPmkab)+parseFloat(hslTrmBpjsJKK)+parseFloat(hslTrmBpjsJKM);
    hslKtor1 = convertToRupiah(hslKtor);
    $('#hasil_kotor').val(hslKtor1);        

    jmlKluar = parseFloat(hslTrmBpjsPmkab)+parseFloat(hslKluarBpjsPsrta)+parseFloat(hslTrmBpjsJKK)+parseFloat(hslTrmBpjsJKM);
    if(jmlKluar!=''){
        jmlKluar1 = convertToRupiah(jmlKluar);        
    }else{
        jmlKluar1 = '';
    }
    $('#jumlah_kon').val(jmlKluar1);

    trmaBersih = hslKtor-jmlKluar;
    trmaBersih1 = convertToRupiah(trmaBersih);
    $('#terima_bersih').val(trmaBersih1);
}

</script>