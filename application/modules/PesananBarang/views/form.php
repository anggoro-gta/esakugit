<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Pembuatan Kelengkapan Belanja Barang</div>
            <h1>
                <a href="<?=base_url()?>PesananBarang" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-list-alt"></i> Tabel Data</a>
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
                        <form class="form-horizontal" action="<?php echo base_url();?>PesananBarang/save" method="post" enctype="multipart/form-data" onsubmit="return validateForm();" id="assignmentForm">
                            <div class="col-md-6">
                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Tgl Pesanan</label>
                                    <div class="col-md-5">
                                        <input type="text" name="tgl_pesanan" class="form-control tanggal text-center" value="<?=$tgl_pesanan?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Nomor</label>
                                    <div class="col-md-5">
                                        <input type="text" name="nomor" class="form-control" value="<?=$nomor?>">
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Perihal Pengadaan</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="perihal" id="perihal" required>
                                            <option value="">Pilih</option>
                                            <?php foreach($arrKategoriBarang as $val3): ?>
                                                <option <?=$perihal==$val3['nama_kategori']?'selected':''?> value="<?=$val3['id'].'_'.$val3['nama_kategori']?>"><?=$val3['nama_kategori']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">  
                                    <label class="col-md-3 control-label">Nama Rekanan</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="fk_rekanan_id" required>
                                            <option value="">Pilih</option>
                                            <?php foreach($arrMsRekanan as $val): ?>
                                                <option <?=$fk_rekanan_id==$val['id']?'selected':''?> value="<?=$val['id']?>"><?=$val['nama_rekanan']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label class="col-md-3 control-label">Nomor Kontrak</label>
                                    <div class="col-md-5">
                                        <input type="text" name="no_kontrak" class="form-control" value="<?=$no_kontrak?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Tgl Kontrak</label>
                                    <div class="col-md-5">
                                        <input type="text" name="tgl_kontrak" class="form-control tanggal text-center" value="<?=$tgl_kontrak?>">
                                    </div>
                                </div> -->
                               <!--  <div class="form-group">
                                    <label class="col-md-3 control-label">Nilai Kontrak / Pesanan</label>
                                    <div class="col-md-5">
                                        <input type="text" name="nilai_kontrak" class="form-control nominal" value="<?=$nilai_kontrak?>">
                                    </div>
                                </div> -->
                                <?php if($this->session->userdata("level")==1){ ?>
                                    <div class="form-group required">
                                            <label class="col-md-3 control-label">Bagian</label>
                                            <div class="col-md-8">
                                                <select class="form-control chosen" name="fk_bagian_id" id="fk_bagian_id" required>
                                                    <option value="">Pilih</option>
                                                    <?php foreach($arrMsBagian as $val2): ?>
                                                        <option <?=$fk_bagian_id==$val2['id']?'selected':''?> value="<?=$val2['id']?>"><?=$val2['nama_bagian']?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div> 
                                    </div>
                                <?php }else{ ?>
                                    <input type="hidden" name="fk_bagian_id" id="fk_bagian_id" value="<?=$this->session->userdata("fk_bagian_id")?>">
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
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Jenis Pajak</label>
                                    <div class="col-md-5">
                                        <?php
                                            $pn = '';
                                            $ph22 = '';
                                            $ph23 = '';
                                            foreach ((array)$jenis_pajak as $val) {
                                                if($val=='PPN'){
                                                    $pn = "selected";
                                                }
                                                if($val=='PPH_22'){
                                                    $ph22 = "selected";
                                                }
                                                if($val=='PPH_23'){
                                                    $ph23 = "selected";
                                                }
                                            }

                                            $optn = '';
                                            if($is_spj==1){
                                                $optn = 'disabled';
                                            }
                                        ?>
                                        <select class="form-control chosen" name="jenis_pajak[]" id="jenis_pajak" multiple>
                                            <option value="">Pilih</option>
                                            <option <?=$optn?> <?=$pn?> value="PPN">PPN</option>
                                            <option <?=$optn?> <?=$ph22?> value="PPH_22">PPh 22</option>
                                            <option <?=$optn?> <?=$ph23?> value="PPH_23">PPh 23</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">                                 
                                <!-- <div class="form-group required">  
                                    <label class="col-md-3 control-label">PA</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="nama_pejabat_pa" >
                                            <option value="">Pilih</option>
                                            <?php foreach($arrPA as $val2): ?>
                                                <?php
                                                    $jbtn = ($val2->jabatan_baru==' ')?$val2->jabatan:$val2->jabatan_baru;
                                                ?>
                                                <option <?=$nama_pejabat_pa==$val2->nama?'selected':''?> value="<?=$val2->nama.'_'.$val2->nip.'_'.$jbtn?>"><?=$val2->nama.' ['.$jbtn.']'?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>  -->
                                <div class="form-group required">  
                                    <label class="col-md-3 control-label">KPA</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="nama_pejabat_kpa" required>
                                            <option value="">Pilih</option>
                                            <?php foreach($arrKPA as $val2): ?>
                                                <?php
                                                    $jbtn = ($val2->jabatan_baru==' ')?$val2->jabatan:$val2->jabatan_baru;
                                                ?>
                                                <option <?=$nama_pejabat_kpa==$val2->nama?'selected':''?> value="<?=$val2->nama.'_'.$val2->nip.'_'.$jbtn?>"><?=$val2->nama.' ['.$jbtn.']'?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div> 
                                <div class="form-group required">  
                                    <label class="col-md-3 control-label">PPK</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="nama_ppk" required>
                                            <option value="">Pilih</option>
                                            <?php foreach($arrMsSdm as $val2): ?>
                                                <?php
                                                    $jbtn = ($val2['jabatan_baru']==' ')?$val2['jabatan']:$val2['jabatan_baru'];
                                                ?>
                                                <option <?=$nama_ppk==$val2['nama']?'selected':''?> value="<?=$val2['nama'].'_'.$val2['nip'].'_'.$val2['gol_pangkat'].'_'.$jbtn?>"><?=$val2['nama'].' ['.$jbtn.']'?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div> 
                                <div class="form-group required">  
                                    <label class="col-md-3 control-label">PPTK</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="nama_pejabat_pptk" required>
                                            <option value="">Pilih</option>
                                            <?php foreach($arrPPTK as $val2): ?>
                                                <?php
                                                    $jbtn = ($val2->jabatan_baru==' ')?$val2->jabatan:$val2->jabatan_baru;
                                                ?>
                                                <option <?=$nama_pejabat_pptk==$val2->nama?'selected':''?> value="<?=$val2->nama.'_'.$val2->nip.'_'.$jbtn?>"><?=$val2->nama.' ['.$jbtn.']'?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div> 
                                <div class="form-group">  
                                    <label class="col-md-3 control-label">Bendahara Pengeluaran</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="nama_bendahara">
                                            <option value="">Pilih</option>
                                            <?php foreach($arrBendahara as $val2): ?>
                                                <?php
                                                    $jbtn = empty($val2->jabatan_baru)?$val2->jabatan:$val2->jabatan_baru;
                                                ?>
                                               <option <?=$nama_bendahara==$val2->nama?'selected':''?> value="<?=$val2->nama.'_'.$val2->nip.'_'.$jbtn?>"><?=$val2->nama.' ['.$jbtn.']'?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group required">      
                                    <label class="col-md-3 control-label">Bendahara Pengeluaran Pembantu </label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="nama_bendahara_pembantu" id="nama_bendahara_pembantu" required>
                                            <option value="">Pilih</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Tgl Kuitansi</label>
                                    <div class="col-md-5">
                                        <input type="text" name="tgl_kuitansi" class="form-control tanggal text-center" value="<?=$tgl_kuitansi?>">
                                    </div>
                                </div>                                 
                                <div class="form-group">
                                    <label class="col-md-3 control-label">No Kuitansi</label>
                                    <div class="col-md-5">
                                        <input type="text" name="no_kuitansi" class="form-control" value="<?=$no_kuitansi?>">
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label class="col-md-3 control-label">Kode Rekening Belanja</label>
                                    <div class="col-md-8">
                                        <input type="text" name="kode_rek_belanja" class="form-control" value="<?=$kode_rek_belanja?>">
                                        <span style="color: orange"><b>isi kolom ini jika belanja diatas <u style="color:red">10 Juta</u>.</b></span>
                                    </div>
                                </div>   -->                           
                            </div>
                            <input type="hidden" name="id" value="<?=$id?>">

                            <div class="form-group">
                                <div class="col-md-10">
                                    <legend style="color: blue"> &nbsp; <b>Detail Barang</b></legend>
                                    <?php if(isset($arrPesananDetail)): ?>
                                    <div class="table-responsive">                     
                                        <table class="table table-bordered table-striped" id="example2">
                                            <thead>
                                                <tr>
                                                    <th style="vertical-align: middle;" class="text-center" width="5%">No</th>
                                                    <th style="vertical-align: middle;" class="text-center" width="50%">Nama Barang</th>
                                                    <th style="vertical-align: middle;" class="text-center" width="10%">Qty</th>
                                                    <th style="vertical-align: middle;" class="text-center" width="20%">Satuan</th>
                                                    <?php if($idPerihal!=4){ ?>
                                                    <th style="vertical-align: middle;" class="text-center" width="30%">Harga Maksimal + PPN</th>
                                                    <?php }  ?>
                                                    <th style="vertical-align: middle;" class="text-center" width="10%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no=1;?>
                                                <?php foreach((array)$arrPesananDetail as $val) :?>
                                                    <tr>
                                                        <td style="text-align: center" ><?php echo $no++;?></td>
                                                        <td><?=$val['nm_brg_gabung']?></td>
                                                        <td style="text-align: center"><?=$val['qty_awal']?></td>
                                                        <td style="text-align: center"><?=$val['satuan']?></td>
                                                        <?php if($idPerihal!=4){ ?>
                                                        <td style="text-align: center"><?=number_format($val['harga_maksimal'])?></td>
                                                        <?php }  ?>
                                                        <td style="text-align: center">
                                                            <?php if($is_spj==0){ ?>
                                                            <a href="#" class="btn btn-xs btn-success" title="Ubah Detail" onclick="edit_detail(<?=$val['fk_pesanan_barang_id']?>,<?=$val['id']?>,<?=$val['qty_awal']?>)"><i class="glyphicon glyphicon-edit icon-white"></i></a><a href="<?=base_url()?>PesananBarang/deleteDetail/<?=$val['fk_pesanan_barang_id']?>/<?=$val['id']?>" class="btn btn-xs btn-danger" title="Hapus" onclick="javasciprt: return confirm('Apakah anda yakin?')" ><i class="glyphicon glyphicon-trash icon-white"></i></a>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach;?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php endif; ?>

                                    <?php if($is_spj==0){ ?>
                                    <div class="table-responsive col-md-10">
                                    <table border="1" id="non_pengadaan" style="display: none;">
                                        <tr>
                                            <th style="text-align: center">Nama Barang</th>
                                            <th style="text-align: center" width="10%">Qty</th>
                                            <th style="text-align: center" width="30%">Satuan</th>
                                            <th style="text-align: center" width="30%">Harga SSH</th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control kosong" id="cari_barang" placeholder="Silahkan Ketik Nama Barang">
                                                <input type="hidden" class="form-control kosong" id="id_barang">
                                                <input type="hidden" class="form-control kosong" id="nama_barangnya">
                                                <input type="hidden" class="form-control kosong" id="harga_maksimal">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control kosong angka text-center" id="qty_awal">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control kosong text-center" id="satuan" readonly>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control kosong text-center" id="hrgaMaksimalView" readonly>
                                            </td>
                                        </tr>
                                    </table>
                                    <table border="1" id="pengadaan" style="display: none;">
                                        <tr>
                                            <th style="text-align: center">Nama Barang</th>
                                            <th style="text-align: center" width="10%">Qty</th>
                                            <th style="text-align: center" width="30%">Satuan</th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control kosong" id="peng_cari_barang">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control kosong angka text-center" id="peng_qty_awal">
                                            </td>
                                            <td>
                                                <select class="form-control" id="peng_satuan">
                                                    <option value="Lembar">Lembar</option>
                                                    <option value="Bendel">Bendel</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </table>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php if($is_spj==0){ ?>
                                <div class="form-group">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-6" align="center">
                                        <a id="reset" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-remove"></i> Reset (esc)</a>
                                        <a id="tambah" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-plus"></i> Tambahkan Ke List (F2)</a>
                                        <i id='loading'></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8">
                                        <div class="panel panel-default">
                                        <table class="table table-bordered table-striped" >
                                            <tr style="background-color: #d5d2d1">
                                                <th style="vertical-align: middle;" class="text-center">Nama Barang</th>
                                                <th style="vertical-align: middle;" class="text-center" width="10%">Qty</th>
                                                <th style="vertical-align: middle;" class="text-center" width="20%">Satuan</th>
                                                <th id="hrgMaksimal" style="vertical-align: middle;" class="text-center" width="30%">Harga SSH</th>
                                                <th style="vertical-align: middle;" class="text-center" width="4%">Aksi</th>
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
        <form method="post" action="<?=base_url("PesananBarang/updateDetail")?>" enctype="multipart/form-data" class="form-horizontal">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
              <h5><b>Update Detail Barang</b></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nama Barang</label>
                            <div class="col-sm-8">
                                <input type="text" id="detail_nama" class="form-control" readonly >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Qty</label>
                            <div class="col-sm-3">
                                <input type="text" name="detail_qty" id="detail_qty" class="form-control angka text-center" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Satuan</label>
                            <div class="col-sm-6">
                                <input type="text" id="detail_satuan" class="form-control text-center" readonly>
                            </div>
                        </div>
                        <input type="hidden" id="detail_id" name="detail_id" class="form-control" readonly >
                        <input type="hidden" id="detail_fk_pesanan_barang_id" name="detail_fk_pesanan_barang_id" class="form-control" readonly >
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
$(document).ready(function(){
    $(document).keyup(function(e) {
        if(e.which == 27) { //esc
            kosong();  
        }
        if(e.which == 113) { //f2
            tambahList();        
        }
    }); 

    cari_program("<?=$fk_program_id?>");
    cari_keg("<?=$fk_program_id?>","<?=$fk_kegiatan_id?>");    
    cari_rekBlnja("<?=$fk_kegiatan_id?>","<?=$fk_rekening_belanja_id?>");
    cari_bndhr_pmbntu("<?=$fk_bagian_id?>");
    cekPerihal("<?=$idPerihal?>");

});

$("#fk_bagian_id").change(function(){
    cari_program();
    cari_bndhr_pmbntu($(this).val());
});

function cari_program(fk_program_id=null){
    fk_bagian_id = $("#fk_bagian_id").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'PesananBarang/getProgram'?>",
        data: {fk_bagian_id,fk_program_id},
        success: function(msg){
           $('#fk_program_id').html(msg.Bagian);
           $('#fk_program_id').trigger("chosen:updated");
           $('#fk_kegiatan_id').val('');
           $('#fk_kegiatan_id').trigger("chosen:updated");
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
        url: "<?php echo base_url().'PesananBarang/getKegiatan'?>",
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

$("#cari_barang").autocomplete({ 
    minLength:3,
    delay:0,
    source: function(request, response) {
        $.getJSON("<?php echo site_url('PesananBarang/get_cari_barang'); ?>", { perihal: $('#perihal').val(), term:$('#cari_barang').val() }, 
                  response);
    },
    select:function(event, ui){
        $('#id_barang').val(ui.item.id_barang);
        $('#nama_barangnya').val(ui.item.nama_barangnya);
        $('#satuan').val(ui.item.satuan);
        $('#harga_maksimal').val(ui.item.std_harga_satuan);
        $('#hrgaMaksimalView').val(ui.item.std_harga_satuan_view);
    }
});

$("#perihal").change(function(){
    $("#non_pengadaan").css("display", "none");
    $("#pengadaan").css("display", "none");
    rsl = $(this).val().split('_');
    cekPerihal(rsl[0]);
});

function cekPerihal(kat){
    if(kat!=''){
        if(kat==4){ //penggandaan / fotocopy
            $("#pengadaan").css("display", "block");
            $("#hrgMaksimal").hide();
        }else{
            $("#non_pengadaan").css("display", "block");
            $("#hrgMaksimal").show();
        }
    }  
};

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
}

$("#tambah").click(function(){
    tambahList();
});

function tambahList(){
    rsl = $("#perihal").val().split('_');
    if(rsl[0]==4){ //pengadaan
        id_barang = '';
        harga_maksimal = '';
        qty_awal = $('#peng_qty_awal').val();
        satuan = $('#peng_satuan').val();
        nama_barang = $('#peng_cari_barang').val();
        if(nama_barang==''){
            alert('Nama Barang tidak boleh kosong..');
            return false;
        }    

        if(qty_awal==''){
            alert('Qty tidak boleh kosong..');
            return false;
        }
        if(satuan==''){
            alert('Satuan tidak boleh kosong..');
            return false;
        }
        
        $("#loading").html('<div class="loader"></div>');
        $("#tampilDetail").append(
            '<tr>'+
                '<td>'+nama_barang+'</td>'+
                '<td class="text-center">'+qty_awal+'</td>'+
                '<td class="text-center">'+satuan+'</td>'+
                '<td class="text-center"><a style="cursor: pointer;" title="hapus" class="remove btn btn-xs btn-danger" ><i class="glyphicon glyphicon-trash"></i></a>'+
                    '<input type="hidden" name="listBrgId[]" value="'+id_barang+'">'+
                    '<input type="hidden" name="listBrgNm[]" value="'+nama_barang+'">'+
                    '<input type="hidden" name="listQtyAwal[]" value="'+qty_awal+'">'+
                    '<input type="hidden" name="listSatuan[]" value="'+satuan+'">'+
                    '<input type="hidden" name="listHrgMak[]" value="'+harga_maksimal+'">'+
                '</td>'+
            '</tr>'
        ); 

    }else{
        id_barang = $('#id_barang').val();
        qty_awal = $('#qty_awal').val();
        satuan = $('#satuan').val();
        nama_barang = $('#nama_barangnya').val();
        harga_maksimal = $('#harga_maksimal').val();
        hrgaMaksimalView = $('#hrgaMaksimalView').val();
        if(id_barang==''){
            alert('Nama Barang tidak boleh kosong..');
            return false;
        }    

        if(qty_awal==''){
            alert('Qty tidak boleh kosong..');
            return false;
        }
        if(satuan==''){
            alert('Satuan tidak boleh kosong..');
            return false;
        }
        
        $("#loading").html('<div class="loader"></div>');
        $("#tampilDetail").append(
            '<tr>'+
                '<td>'+nama_barang+'</td>'+
                '<td class="text-center">'+qty_awal+'</td>'+
                '<td class="text-center">'+satuan+'</td>'+
                '<td class="text-center">'+hrgaMaksimalView+'</td>'+
                '<td class="text-center"><a style="cursor: pointer;" title="hapus" class="remove btn btn-xs btn-danger" ><i class="glyphicon glyphicon-trash"></i></a>'+
                    '<input type="hidden" name="listBrgId[]" value="'+id_barang+'">'+
                    '<input type="hidden" name="listBrgNm[]" value="'+nama_barang+'">'+
                    '<input type="hidden" name="listQtyAwal[]" value="'+qty_awal+'">'+
                    '<input type="hidden" name="listSatuan[]" value="'+satuan+'">'+
                    '<input type="hidden" name="listHrgMak[]" value="'+harga_maksimal+'">'+
                '</td>'+
            '</tr>'
        );     

        $('#id_sdm').val('');
        $('#id_sdm').trigger("chosen:updated");
    }
    
    kosong();
    $("#loading").html('');
}

$("#tampilDetail").on('click','.remove',function(){
    if(confirm('Apakah anda yakin?')){
        $(this).parent().parent().remove();
    }
});

function edit_detail(fk_pesanan_barang_id,id,qty_awal){
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'PesananBarang/getCariDataDetail'?>",
        data: {id},
        success: function(msg){
            $('#detail_nama').val(msg.nm_brg);
            $('#detail_satuan').val(msg.satuan);
            $('#detail_qty').val(qty_awal);
            $('#detail_id').val(id);
            $('#detail_fk_pesanan_barang_id').val(fk_pesanan_barang_id);        
        }
    });  
    $("#modal_edit").modal("show"); 
}

function cari_bndhr_pmbntu(fk_bagian_id=null){
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'PesananBarang/getBndhrPmbantu'?>",
        data: {fk_bagian_id},
        success: function(msg){
           $('#nama_bendahara_pembantu').html(msg.bnhrPmbt);
           $('#nama_bendahara_pembantu').trigger("chosen:updated");
        }
    });     
}

</script>