<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Entri Transport & Hotel</div>
            <div style="text-align: center; color: white; font-size: 14pt"><b>Acara : <?=$acara->acara?><br>Tujuan SKPD : <?=$acara->tujuan_skpd?><br>Kab/Kota : <?=$acara->kota?></b></div>
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
                        <form action="<?=base_url()?>Pjd/saveTransportHotel" method="post" class="form-horizontal">
                            <div class="col-md-6">
                                <legend style="color: blue; text-align: center"><b>BERANGKAT</b></legend>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Alat Transportasi</label>
                                    <div class="col-md-4">
                                        <select class="form-control chosen" name="alat_transport_brk" id="alat_transport_brk">
                                            <option value="">.: Pilih :.</option>
                                            <option <?=$alat_transport_brk=='Bus'?'selected':''?> value="Bus">Bus</option>
                                            <option <?=$alat_transport_brk=='Kereta Api'?'selected':''?> value="Kereta Api">Kereta Api</option>
                                            <option <?=$alat_transport_brk=='Pesawat'?'selected':''?> value="Pesawat">Pesawat</option>
                                            <!-- <option <?=$alat_transport_brk=='Kapal Laut'?'selected':''?> value="Kapal Laut">Kapal Laut</option> -->
                                            <option <?=$alat_transport_brk=='Mobil'?'selected':''?> value="Mobil">Mobil</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Nama Transportasi</label>
                                    <div class="col-md-9">
                                        <input type="text" name="nama_transport_brk" class="form-control" value="<?=$nama_transport_brk?>" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Dari</label>
                                    <div class="col-md-9">
                                        <input type="text" name="dari_brk" class="form-control" value="<?=$dari_brk?>" placeholder='diisi nama Kantor/Kota/Bandara/Stasiun/Terminal'>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Tujuan</label>
                                    <div class="col-md-9">
                                        <input type="text" name="tujuan_brk" class="form-control" value="<?=$tujuan_brk?>" placeholder='diisi nama Kantor/Kota/Bandara/Stasiun/Terminal'>
                                    </div>
                                </div>
                                <div class="tiketnya">
                                    <?php if(!empty($id) && array($transBrngkt)){?>
                                        <legend style="color: orange; "><b>List Berangkat</b></legend>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <div class="panel panel-default">
                                                <table class="table table-bordered " style="font-size: 9pt">
                                                    <tr style="background-color: yellow">
                                                        <th style="vertical-align: middle; text-align: center">No</th>
                                                        <th style="vertical-align: middle; text-align: center">Nama</th>
                                                        <th style="vertical-align: middle; text-align: center" width="20%">No. Tiket</th>
                                                        <th style="vertical-align: middle; text-align: center" width="20%">No. Penerbangan<br>(khusus Pesawat)</th>
                                                        <th style="vertical-align: middle; text-align: center" width="20%">Kode Booking</th>
                                                        <th style="vertical-align: middle; text-align: center" width="20%">Harga<br>Tiket</th>
                                                        <th style="vertical-align: middle; text-align: center" width="6%">Aksi</th>
                                                    </tr>
                                                    <tbody>
                                                        <?php $no=1; foreach ($transBrngkt as $val1) { ?>
                                                           <tr>
                                                               <td style="text-align: center; vertical-align: middle;"><?=$no++?></td>
                                                               <td style="text-align: center; vertical-align: middle;"><?=$val1->nama_sdm?></td>
                                                               <td style="text-align: center; vertical-align: middle;"><?=$val1->no_tiket_brk?></td>
                                                               <td style="text-align: center; vertical-align: middle;"><?=$val1->no_penerbangan_brk?></td>
                                                               <td style="text-align: center; vertical-align: middle;"><?=$val1->kode_booking_brk?></td>
                                                               <td style="text-align: right; vertical-align: middle;"><?=number_format($val1->harga_brk)?></td>
                                                               <td style="vertical-align: middle;text-align: center;">
                                                                    <a href="<?=base_url()?>Pjd/delTransportBrgkt/<?=$fk_pjd_id?>/<?=$val1->id?>" class="btn btn-xs btn-danger" title="Hapus" onclick="javasciprt: return confirm('Apakah anda yakin?')" ><i class="glyphicon glyphicon-trash icon-white"></i></a>
                                                               </td>
                                                           </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="table-responsive">
                                        <table border="1" style="font-size: 9pt">
                                            <tr>
                                                <th style="vertical-align: middle; text-align: center">Nama</th>
                                                <th style="vertical-align: middle; text-align: center" width="20%">No. Tiket</th>
                                                <th style="vertical-align: middle; text-align: center" width="20%">No. Penerbangan<br>(khusus Pesawat)</th>
                                                <th style="vertical-align: middle; text-align: center" width="20%">Kode Booking</th>
                                                <th style="vertical-align: middle; text-align: center" width="15%">Harga<br>Tiket</th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <select class="form-control chosen kosong" id="fk_pjd_detail_id_brk" style="font-size: 9pt">
                                                        <option value="">Pilih</option>
                                                        <?php foreach($arrMsSdm as $sd): ?>
                                                            <option value="<?=$sd->id?>"><?=$sd->nama_sdm?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control kosong" id="no_tiket_brk" style="font-size: 9pt">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control kosong" id="no_penerbangan_brk" style="font-size: 9pt">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control kosong" id="kode_booking_brk" style="font-size: 9pt">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control kosong nominal" id="harga_brk" style="font-size: 9pt">
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6" align="center">
                                            <a id="reset_brk" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i> Reset</a>
                                            <a id="tambah_brk" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-plus"></i> Tambahkan Ke List</a>
                                            <i id='loading'></i>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="panel panel-default">
                                            <table class="table table-bordered table-striped" style="font-size: 9pt">
                                                <tr style="background-color: #d5d2d1">
                                                    <th style="vertical-align: middle; text-align: center">Nama</th>
                                                    <th style="vertical-align: middle; text-align: center" width="20%">No. Tiket</th>
                                                    <th style="vertical-align: middle; text-align: center" width="20%">No. Penerbangan<br>(khusus Pesawat)</th>
                                                    <th style="vertical-align: middle; text-align: center" width="20%">Kode Booking</th>
                                                    <th style="vertical-align: middle; text-align: center" width="20%">Harga<br>Tiket</th>
                                                    <th style="vertical-align: middle; text-align: center" width="6%">Aksi</th>
                                                </tr>
                                                <tbody id="tampilDetailBrngkt"></tbody>
                                            </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                            <div class="col-md-6">
                                <legend style="color: blue; text-align: center"><b>KEMBALI</b></legend>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Alat Transportasi</label>
                                    <div class="col-md-4">
                                        <select class="form-control chosen" name="alat_transport_plg" id="alat_transport_plg">
                                            <option value="">.: Pilih :.</option>
                                            <option <?=$alat_transport_plg=='Bus'?'selected':''?> value="Bus">Bus</option>
                                            <option <?=$alat_transport_plg=='Kereta Api'?'selected':''?> value="Kereta Api">Kereta Api</option>
                                            <option <?=$alat_transport_plg=='Pesawat'?'selected':''?> value="Pesawat">Pesawat</option>
                                            <option <?=$alat_transport_plg=='Mobil'?'selected':''?> value="Mobil">Mobil</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Nama Transportasi</label>
                                    <div class="col-md-9">
                                        <input type="text" name="nama_transport_plg" class="form-control" value="<?=$nama_transport_plg?>" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Dari</label>
                                    <div class="col-md-9">
                                        <input type="text" name="dari_plg" class="form-control" value="<?=$dari_plg?>" placeholder='diisi nama Kantor/Kota/Bandara/Stasiun/Terminal'>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Tujuan</label>
                                    <div class="col-md-9">
                                        <input type="text" name="tujuan_plg" class="form-control" value="<?=$tujuan_plg?>" placeholder='diisi nama Kantor/Kota/Bandara/Stasiun/Terminal'>
                                    </div>
                                </div>                                
                                <div class="tiketnya">
                                    <?php if(!empty($id) && array($transPlg)){?>
                                        <legend style="color: orange; "><b>List Kembali</b></legend>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <div class="panel panel-default">
                                                <table class="table table-bordered " style="font-size: 9pt">
                                                    <tr style="background-color: yellow">
                                                        <th style="vertical-align: middle; text-align: center">No</th>
                                                        <th style="vertical-align: middle; text-align: center">Nama</th>
                                                        <th style="vertical-align: middle; text-align: center" width="20%">No. Tiket</th>
                                                        <th style="vertical-align: middle; text-align: center" width="20%">No. Penerbangan<br>(khusus Pesawat)</th>
                                                        <th style="vertical-align: middle; text-align: center" width="20%">Kode Booking</th>
                                                        <th style="vertical-align: middle; text-align: center" width="20%">Harga<br>Tiket</th>
                                                        <th style="vertical-align: middle; text-align: center" width="6%">Aksi</th>
                                                    </tr>
                                                    <tbody>
                                                        <?php $no=1; foreach ($transPlg as $val2) { ?>
                                                           <tr>
                                                               <td style="text-align: center; vertical-align: middle;"><?=$no++?></td>
                                                               <td style="text-align: center; vertical-align: middle;"><?=$val2->nama_sdm?></td>
                                                               <td style="text-align: center; vertical-align: middle;"><?=$val2->no_tiket_plg?></td>
                                                               <td style="text-align: center; vertical-align: middle;"><?=$val2->no_penerbangan_plg?></td>
                                                               <td style="text-align: center; vertical-align: middle;"><?=$val2->kode_booking_plg?></td>
                                                               <td style="text-align: right; vertical-align: middle;"><?=number_format($val2->harga_plg)?></td>
                                                               <td style="vertical-align: middle;text-align: center;">
                                                                    <a href="<?=base_url()?>Pjd/delTransportPlg/<?=$fk_pjd_id?>/<?=$val2->id?>" class="btn btn-xs btn-danger" title="Hapus" onclick="javasciprt: return confirm('Apakah anda yakin?')" ><i class="glyphicon glyphicon-trash icon-white"></i></a>
                                                               </td>
                                                           </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="table-responsive">
                                        <table border="1" style="font-size: 9pt">
                                            <tr>
                                                <th style="vertical-align: middle; text-align: center">Nama</th>
                                                <th style="vertical-align: middle; text-align: center" width="20%">No. Tiket</th>
                                                <th style="vertical-align: middle; text-align: center" width="20%">No. Penerbangan<br>(khusus Pesawat)</th>
                                                <th style="vertical-align: middle; text-align: center" width="20%">Kode Booking</th>
                                                <th style="vertical-align: middle; text-align: center" width="15%">Harga<br>Tiket</th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <select class="form-control chosen kosong" id="fk_pjd_detail_id_plg" style="font-size: 9pt">
                                                        <option value="">Pilih</option>
                                                        <?php foreach($arrMsSdm as $sd): ?>
                                                            <option value="<?=$sd->id?>"><?=$sd->nama_sdm?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control kosong" id="no_tiket_plg" style="font-size: 9pt">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control kosong" id="no_penerbangan_plg" style="font-size: 9pt">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control kosong" id="kode_booking_plg" style="font-size: 9pt">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control kosong nominal" id="harga_plg" style="font-size: 9pt">
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6" align="center">
                                            <a id="reset_plg" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i> Reset</a>
                                            <a id="tambah_plg" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-plus"></i> Tambahkan Ke List</a>
                                            <i id='loading'></i>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="panel panel-default">
                                            <table class="table table-bordered table-striped" style="font-size: 9pt">
                                                <tr style="background-color: #d5d2d1">
                                                    <th style="vertical-align: middle; text-align: center">Nama</th>
                                                    <th style="vertical-align: middle; text-align: center" width="20%">No. Tiket</th>
                                                    <th style="vertical-align: middle; text-align: center" width="20%">No. Penerbangan<br>(khusus Pesawat)</th>
                                                    <th style="vertical-align: middle; text-align: center" width="20%">Kode Booking</th>
                                                    <th style="vertical-align: middle; text-align: center" width="20%">Harga<br>Tiket</th>
                                                    <th style="vertical-align: middle; text-align: center" width="6%">Aksi</th>
                                                </tr>
                                                <tbody id="tampilDetailPlg"></tbody>
                                            </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" id='khusus_naik_mobil' style="display: none;">
                                <legend></legend>
                                <legend style="color: #F30DEC; text-align: center"><b>JIKA MEMAKAI BIRO TRAVEL</b></legend>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Harga Sewa</label>
                                    <div class="col-md-2">
                                        <input type="text" name="harga_sewa" class="form-control nominal" value="<?=$harga_sewa?>" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Nama Biro Jasa</label>
                                    <div class="col-md-4">
                                        <input type="text" name="keterangan" class="form-control" value="<?=$keterangan?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <legend style="color: orange; text-align: center"><b>Transportasi Lokal (Ojek Online)</b></legend>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Nama Transport Berangkat</label>
                                        <div class="col-md-8">
                                            <input type="text" name="nama_trans_lokal_brk" class="form-control" value="<?=$nama_trans_lokal_brk?>" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Biaya Berangkat</label>
                                        <div class="col-md-4">
                                            <input type="text" name="biaya_trans_lokal_brk" class="form-control nominal" value="<?=$biaya_trans_lokal_brk?>" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Nama Transport Kembali</label>
                                        <div class="col-md-8">
                                            <input type="text" name="nama_trans_lokal_plg" class="form-control" value="<?=$nama_trans_lokal_plg?>" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Biaya Kembali</label>
                                        <div class="col-md-4">
                                            <input type="text" name="biaya_trans_lokal_plg" class="form-control nominal" value="<?=$biaya_trans_lokal_plg?>" >
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="idTransportLokal" value="<?=$idTransportLokal?>">
                            </div>
                            <div class="col-md-12">
                                <legend style="color: #FA073E; text-align: center"><b></b></legend>
                                <legend style="color: #FA073E; text-align: center"><b>HOTEL</b></legend>
                                <?php if(!empty($id) && array($transHtl)){?>
                                    <legend style="color: orange; "><b>List Hotel</b></legend>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="panel panel-default">
                                            <table class="table table-bordered " style="font-size: 9pt">
                                                <tr style="background-color: yellow">
                                                    <th style="vertical-align: middle; text-align: center">No</th>
                                                    <th style="vertical-align: middle; text-align: center" width="30%">Nama</th>
                                                    <th style="vertical-align: middle; text-align: center" width="30%">Hotel</th>
                                                    <th style="vertical-align: middle; text-align: center" width="15%">Tgl Check In</th>
                                                    <th style="vertical-align: middle; text-align: center" width="15%">Tgl Check Out</th>
                                                    <th style="vertical-align: middle; text-align: center" width="12%">Harga Hotel</th>
                                                    <th style="vertical-align: middle; text-align: center" width="6%">Aksi</th>
                                                </tr>
                                                <tbody>
                                                    <?php $no=1; foreach ($transHtl as $val3) { ?>
                                                       <tr>
                                                           <td style="text-align: center; vertical-align: middle;"><?=$no++?></td>
                                                           <td style="text-align: center; vertical-align: middle;"><?=$val3->nama_sdm?></td>
                                                           <td style="text-align: center; vertical-align: middle;"><?=$val3->nama_hotel?></td>
                                                           <td style="text-align: center; vertical-align: middle;"><?=$val3->tgl_check_in?></td>
                                                           <td style="text-align: center; vertical-align: middle;"><?=$val3->tgl_check_out?></td>
                                                           <td style="text-align: right; vertical-align: middle;"><?=number_format($val3->harga_hotel)?></td>
                                                           <td style="vertical-align: middle;text-align: center;">
                                                                <a href="<?=base_url()?>Pjd/delTransportHtl/<?=$fk_pjd_id?>/<?=$val3->id?>" class="btn btn-xs btn-danger" title="Hapus" onclick="javasciprt: return confirm('Apakah anda yakin?')" ><i class="glyphicon glyphicon-trash icon-white"></i></a>
                                                           </td>
                                                       </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="table-responsive">
                                    <table border="1">
                                        <tr>
                                            <th style="vertical-align: middle; text-align: center">Nama</th>
                                            <th style="vertical-align: middle; text-align: center" width="30%">Nama Hotel</th>
                                            <th style="vertical-align: middle; text-align: center" width="15%">Tgl Check In</th>
                                            <th style="vertical-align: middle; text-align: center" width="15%">Tgl Check Out</th>
                                            <th style="vertical-align: middle; text-align: center" width="12%">Harga Hotel</th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <select class="form-control chosen kosong" id="fk_pjd_detail_id_htl">
                                                    <option value="">Pilih</option>
                                                    <?php foreach($arrMsSdm as $sd): ?>
                                                        <option value="<?=$sd->id?>"><?=$sd->nama_sdm?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control kosong" id="nama_hotel">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control tanggal text-center kosong" id="tgl_check_in">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control tanggal text-center kosong" id="tgl_check_out">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control kosong nominal" id="harga_hotel">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <br>
                                <div class="form-group">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6" align="center">
                                        <a id="reset_htl" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i> Reset</a>
                                        <a id="tambah_htl" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-plus"></i> Tambahkan Ke List</a>
                                        <i id='loading'></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="panel panel-default">
                                        <table class="table table-bordered table-striped" style="font-size: 9pt">
                                            <tr style="background-color: #d5d2d1">
                                                <th style="vertical-align: middle; text-align: center">Nama</th>
                                                <th style="vertical-align: middle; text-align: center" width="20%">Nama Hotel</th>
                                                <th style="vertical-align: middle; text-align: center" width="20%">Tgl Check In</th>
                                                <th style="vertical-align: middle; text-align: center" width="20%">Tgl Check Out</th>
                                                <th style="vertical-align: middle; text-align: center" width="20%">Harga Hotel</th>
                                                <th style="vertical-align: middle; text-align: center" width="10%">Aksi</th>
                                            </tr>
                                            <tbody id="tampilDetailHotel"></tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="fk_pjd_id" value="<?=$fk_pjd_id?>">
                            <input type="hidden" name="id" value="<?=$id?>">
                            <br>
                            <br>                            
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4" align="center">
                                        <a href="<?=base_url()?>Pjd" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-chevron-left"></i> kembali</a>
                                        <button type="submit" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-hdd"></i> <?=$button;?></button>
                                    </div>
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
    cek_alat_transport("<?=$alat_transport_brk?>");
});

$("#alat_transport_brk").change(function(){
    cek_alat_transport($(this).val());
    $('#alat_transport_plg').val($(this).val());
    $('#alat_transport_plg').trigger("chosen:updated");
});


function cek_alat_transport($transpt){
    $("#khusus_naik_mobil").hide();
    $(".tiketnya").hide();
    if($transpt=='Mobil'){
        $("#khusus_naik_mobil").show();
    }else if($transpt!='Mobil' && $transpt!=''){
        $(".tiketnya").show();
    }
}

$("#reset_brk").click(function(){
    kosong();
});
$("#reset_plg").click(function(){
    kosong();
});
function kosong(){
    $(".kosong").val('');
    $('#fk_pjd_detail_id_brk').trigger("chosen:updated");
    $('#fk_pjd_detail_id_plg').trigger("chosen:updated");
}

$("#tambah_brk").click(function(){
    fk_pjd_detail_id_brk = $('#fk_pjd_detail_id_brk').val();
    no_tiket_brk = $('#no_tiket_brk').val();
    no_penerbangan_brk = $('#no_penerbangan_brk').val();
    kode_booking_brk = $('#kode_booking_brk').val();
    harga_brk = $('#harga_brk').val();

    if(fk_pjd_detail_id_brk==''){
        alert('Nama tidak boleh kosong..');
        return false;
    }

    if(fk_pjd_detail_id_brk==''){
        alert('Nama tidak boleh kosong..');
        return false;
    }
    $("#loading").html('<div class="loader"></div>');

    $.ajax({
        async: false,
        type: "POST",
        url: "<?php echo base_url().'Pjd/cariNamaDiPjdDetail'?>",
        data: {fk_pjd_detail_id:fk_pjd_detail_id_brk},
        dataType: 'json',
        success: function(msg){    
            namaSdmDetail = msg.nama;
        }
    });  

    $("#tampilDetailBrngkt").append(
        '<tr>'+
            '<td>'+namaSdmDetail+'</td>'+
            '<td class="text-center">'+no_tiket_brk+'</td>'+
            '<td class="text-center">'+no_penerbangan_brk+'</td>'+
            '<td class="text-center">'+kode_booking_brk+'</td>'+
            '<td class="text-right">'+harga_brk+'</td>'+
            '<td class="text-center"><a style="cursor: pointer;" title="hapus" class="remove btn btn-xs btn-danger" ><i class="glyphicon glyphicon-trash"></i></a>'+
                '<input type="hidden" name="listFkPjdDetailId_brk[]" value="'+fk_pjd_detail_id_brk+'">'+
                '<input type="hidden" name="listTiket_brk[]" value="'+no_tiket_brk+'">'+
                '<input type="hidden" name="listPenerbangan_brk[]" value="'+no_penerbangan_brk+'">'+
                '<input type="hidden" name="listKdeBooking_brk[]" value="'+kode_booking_brk+'">'+
                '<input type="hidden" name="listHarga_brk[]" value="'+harga_brk+'">'+
            '</td>'+
        '</tr>'
    );

    $('#fk_pjd_detail_id_brk').val('');
    $('#fk_pjd_detail_id_brk').trigger("chosen:updated");
    kosong();
    $("#loading").html('');
});

$("#tampilDetailBrngkt").on('click','.remove',function(){
    if(confirm('Apakah anda yakin?')){
        $(this).parent().parent().remove();
    }
});

$("#tambah_plg").click(function(){
    fk_pjd_detail_id_plg = $('#fk_pjd_detail_id_plg').val();
    no_tiket_plg = $('#no_tiket_plg').val();
    no_penerbangan_plg = $('#no_penerbangan_plg').val();
    kode_booking_plg = $('#kode_booking_plg').val();
    harga_plg = $('#harga_plg').val();

    if(fk_pjd_detail_id_plg==''){
        alert('Nama tidak boleh kosong..');
        return false;
    }

    if(fk_pjd_detail_id_plg==''){
        alert('Nama tidak boleh kosong..');
        return false;
    }
    $("#loading").html('<div class="loader"></div>');

    $.ajax({
        async: false,
        type: "POST",
        url: "<?php echo base_url().'Pjd/cariNamaDiPjdDetail'?>",
        data: {fk_pjd_detail_id:fk_pjd_detail_id_plg},
        dataType: 'json',
        success: function(msg){    
            namaSdmDetail = msg.nama;
        }
    });  

    $("#tampilDetailPlg").append(
        '<tr>'+
            '<td>'+namaSdmDetail+'</td>'+
            '<td class="text-center">'+no_tiket_plg+'</td>'+
            '<td class="text-center">'+no_penerbangan_plg+'</td>'+
            '<td class="text-center">'+kode_booking_plg+'</td>'+
            '<td class="text-right">'+harga_plg+'</td>'+
            '<td class="text-center"><a style="cursor: pointer;" title="hapus" class="remove btn btn-xs btn-danger" ><i class="glyphicon glyphicon-trash"></i></a>'+
                '<input type="hidden" name="listFkPjdDetailId_plg[]" value="'+fk_pjd_detail_id_plg+'">'+
                '<input type="hidden" name="listTiket_plg[]" value="'+no_tiket_plg+'">'+
                '<input type="hidden" name="listPenerbangan_plg[]" value="'+no_penerbangan_plg+'">'+
                '<input type="hidden" name="listKdeBooking_plg[]" value="'+kode_booking_plg+'">'+
                '<input type="hidden" name="listHarga_plg[]" value="'+harga_plg+'">'+
            '</td>'+
        '</tr>'
    );

    $('#fk_pjd_detail_id_plg').val('');
    $('#fk_pjd_detail_id_plg').trigger("chosen:updated");
    kosong();
    $("#loading").html('');
});

$("#tampilDetailPlg").on('click','.remove',function(){
    if(confirm('Apakah anda yakin?')){
        $(this).parent().parent().remove();
    }
});

$("#tambah_htl").click(function(){
    fk_pjd_detail_id_htl = $('#fk_pjd_detail_id_htl').val();
    nama_hotel = $('#nama_hotel').val();
    tgl_check_in = $('#tgl_check_in').val();
    tgl_check_out = $('#tgl_check_out').val();
    harga_hotel = $('#harga_hotel').val();

    if(fk_pjd_detail_id_htl==''){
        alert('Nama tidak boleh kosong..');
        return false;
    }

    if(fk_pjd_detail_id_htl==''){
        alert('Nama tidak boleh kosong..');
        return false;
    }
    $("#loading").html('<div class="loader"></div>');

    $.ajax({
        async: false,
        type: "POST",
        url: "<?php echo base_url().'Pjd/cariNamaDiPjdDetail'?>",
        data: {fk_pjd_detail_id:fk_pjd_detail_id_htl},
        dataType: 'json',
        success: function(msg){    
            namaSdmDetail = msg.nama;
        }
    });  

    $("#tampilDetailHotel").append(
        '<tr>'+
            '<td>'+namaSdmDetail+'</td>'+
            '<td class="text-center">'+nama_hotel+'</td>'+
            '<td class="text-center">'+tgl_check_in+'</td>'+
            '<td class="text-center">'+tgl_check_out+'</td>'+
            '<td class="text-right">'+harga_hotel+'</td>'+
            '<td class="text-center"><a style="cursor: pointer;" title="hapus" class="remove btn btn-xs btn-danger" ><i class="glyphicon glyphicon-trash"></i></a>'+
                '<input type="hidden" name="listFkPjdDetailId_htl[]" value="'+fk_pjd_detail_id_htl+'">'+
                '<input type="hidden" name="listNamaHotel[]" value="'+nama_hotel+'">'+
                '<input type="hidden" name="listTglCheckIn[]" value="'+tgl_check_in+'">'+
                '<input type="hidden" name="listTglCheckOut[]" value="'+tgl_check_out+'">'+
                '<input type="hidden" name="listHargaHotel[]" value="'+harga_hotel+'">'+
            '</td>'+
        '</tr>'
    );

    $('#fk_pjd_detail_id_htl').val('');
    $('#fk_pjd_detail_id_htl').trigger("chosen:updated");
    kosong();
    $("#loading").html('');
});

$("#tampilDetailHotel").on('click','.remove',function(){
    if(confirm('Apakah anda yakin?')){
        $(this).parent().parent().remove();
    }
});

</script>