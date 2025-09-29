<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Entri Rapat</div>
            <h1>
                <a href="<?=base_url()?>Rapat" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-list-alt"></i> Tabel Data</a>
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
                        <form class="form-horizontal" action="<?php echo base_url();?>Rapat/save" method="post" enctype="multipart/form-data" onsubmit="return validateForm();" id="assignmentForm">
                            <div class="col-md-6">
                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Hari</label>
                                    <div class="col-md-5">
                                        <input type="text" name="hari" id="hari" class="form-control text-center" value="<?=$hari?>" autocomplete="off" required readonly>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Tgl</label>
                                    <div class="col-md-5">
                                        <input type="text" name="tgl" id="tgl" class="form-control tanggal text-center" value="<?=$tgl?>" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Pukul</label>
                                    <div class="col-md-5">
                                        <input type="text" name="pukul" id="pukul" class="form-control" value="<?=$pukul?>" autocomplete="off" required >
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Tempat</label>
                                    <div class="col-md-8">
                                        <input type="text" name="tempat" id="tempat" class="form-control" value="<?=$tempat?>" required >
                                    </div>
                                </div> 
                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Acara</label>
                                    <div class="col-md-8">
                                        <textarea class="form-control" rows="3" name="acara" required><?=$acara?></textarea>
                                    </div>
                                </div>                           
                                <div class="form-group">  
                                    <label class="col-md-3 control-label">Nama Rekanan Catering</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="fk_rekanan_catering_id" id="fk_rekanan_catering_id">
                                            <option value="">Pilih</option>
                                            <?php foreach($arrMsRekanan as $val): ?>
                                                <option <?=$fk_rekanan_catering_id==$val['id']?'selected':''?> value="<?=$val['id']?>"><?=$val['nama_rekanan'].' ('.$val['nama_pemilik'].')'?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>  
                                <!-- <div class="form-group">
                                    <label class="col-md-3 control-label">NPWP Catering</label>
                                    <div class="col-md-5">
                                        <input type="text" name="npwp_catering" id="npwp_catering" class="form-control text-center" value="<?=$npwp_catering?>" readonly>
                                    </div>
                                </div> -->
                                <input type="hidden" name="npwp_catering" id="npwp_catering" class="form-control text-center" value="<?=$npwp_catering?>" readonly>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Tgl Kwitansi</label>
                                    <div class="col-md-5">
                                        <input type="text" name="tgl_kwitansi" id="tgl_kwitansi" class="form-control tanggal text-center" value="<?=$tgl_kwitansi?>" autocomplete="off">
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
                                <!-- <div class="form-group">  
                                    <label class="col-md-3 control-label">PPK</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="nama_pejabat_ppk" id="nama_pejabat_ppk">
                                            <option value="">Pilih</option>
                                            <?php foreach($arrPPK as $val2): ?>
                                                <?php
                                                    $jbtn = ($val2->jabatan_baru==' ')?$val2->jabatan:$val2->jabatan_baru;
                                                ?>
                                                <option <?=$nama_pejabat_ppk==$val2->nama?'selected':''?> value="<?=$val2->nama.'_'.$val2->nip.'_'.$jbtn?>"><?=$val2->nama.' ['.$jbtn.']'?></option>
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
                                        <select class="form-control chosen" name="nama_bendahara_pembantu" id="nama_bendahara_pembantu" required>
                                            <option value="">Pilih</option>
                                        </select>
                                    </div>
                                    <input type="hidden" id="bndhra_pembntu" value="<?=$nama_bendahara_pembantu?>">
                                </div>                                   
                            </div>
                            <div class="col-md-6"> 
                                <div class="form-group required">      
                                    <label class="col-md-3 control-label">Penandatangan Surat Undangan</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="nama_ttd" id="nama_ttd" required>
                                            <option value="">Pilih</option>
                                            <!-- <?php foreach($arrTTD as $val3): ?>
                                                <?php
                                                    $sttJab='';
                                                    if($val3->status_jabatan!=''){
                                                        $sttJab=$val3->status_jabatan.' ';
                                                    }

                                                    $esln=$val3->eselon_lama;
                                                    $jbtn=$val3->jabatan_lama;
                                                    if($val3->jabatan_baru){
                                                        $esln=$val3->eselon_baru;
                                                        $jbtn=$val3->jabatan_baru;
                                                        $sttJab='';
                                                    }
                                                    
                                                    if($val3->status_jabatan_baru!=''){
                                                        $sttJab=$val3->status_jabatan_baru.' ';
                                                    }
                                                ?>
                                                <option <?=$nama_ttd==$val3->nama?'selected':''?> value="<?=$val3->nama.'_'.$val3->nip.'_'.$esln.'_'.$sttJab.$jbtn?>"><?=$val3->nama.' ['.$sttJab.$jbtn.']'?></option>
                                            <?php endforeach; ?> -->
                                        </select>
                                    </div>
                                </div>             
                                <legend style="color: green"> &nbsp; <b>Mamin Biasa</b></legend>
                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Jml Peserta</label>
                                    <div class="col-md-2">
                                        <input type="text" <?=$is_spj=='1'?'readonly':''?> name="jml_peserta" id="jml_peserta" class="form-control text-center angka" value="<?=$jml_peserta?>" autocomplete="off" required >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Harga Mamin (@)</label>
                                    <div class="col-md-5">
                                        <input type="text" <?=$is_spj=='1'?'readonly':''?> name="harga_mamin" id="harga_mamin" class="form-control nominal" value="<?=$harga_mamin?>" autocomplete="off" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Harga Snack (@)</label>
                                    <div class="col-md-5">
                                        <input type="text" <?=$is_spj=='1'?'readonly':''?> name="harga_snack" id="harga_snack" class="form-control nominal" value="<?=$harga_snack?>" autocomplete="off" >
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Sub Total</label>
                                    <div class="col-md-5">
                                        <input type="text" name="total" id="total" class="form-control nominal" value="<?=$total?>" autocomplete="off" required readonly>
                                    </div>
                                </div>
                                <legend style="color: orange"> &nbsp; <b>Mamin VIP (jika ada)</b></legend>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Jml Peserta</label>
                                    <div class="col-md-2">
                                        <input type="text" <?=$is_spj=='1'?'readonly':''?> name="jml_peserta_vip" id="jml_peserta_vip" class="form-control text-center angka" value="<?=$jml_peserta_vip?>" autocomplete="off" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Harga Mamin (@)</label>
                                    <div class="col-md-5">
                                        <input type="text" <?=$is_spj=='1'?'readonly':''?> name="harga_mamin_vip" id="harga_mamin_vip" class="form-control nominal" value="<?=$harga_mamin_vip?>" autocomplete="off" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Harga Snack (@)</label>
                                    <div class="col-md-5">
                                        <input type="text" <?=$is_spj=='1'?'readonly':''?> name="harga_snack_vip" id="harga_snack_vip" class="form-control nominal" value="<?=$harga_snack_vip?>" autocomplete="off" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Sub Total</label>
                                    <div class="col-md-5">
                                        <input type="text" name="total_vip" id="total_vip" class="form-control nominal" value="<?=$total_vip?>" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Grand Total</label>
                                    <div class="col-md-5">
                                        <input type="text" name="total_all" id="total_all" class="form-control nominal" value="<?=$total_all?>" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Tampil Pajak Daerah</label>
                                    <div class="col-md-1">
                                        <input type="checkbox" class="form-control" <?=$pajak_daerah>0?'checked':''?> id="cbx_pajak_daerah">
                                    </div>
                                    <label class="col-md-3 control-label">Tampil PPH 23</label>
                                    <div class="col-md-1">
                                        <input type="checkbox" class="form-control" <?=$pph_23>0?'checked':''?> id="cbx_pph23">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Pajak Daerah</label>
                                    <div class="col-md-5">
                                        <input type="text" name="pajak_daerah" id="pajak_daerah" class="form-control nominal" value="<?=$pajak_daerah?>" autocomplete="off" <?=$is_spj=='1'?'readonly':''?>>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-md-3 control-label">PPh 23</label>
                                    <div class="col-md-5">
                                        <input type="text" name="pph_23" id="pph_23" class="form-control nominal" value="<?=$pph_23?>" autocomplete="off" <?=$is_spj=='1'?'readonly':''?>>
                                    </div>
                                </div>                                                            
                            </div>
                            <input type="hidden" name="id" value="<?=$id?>">
                            <input type="hidden" name="tahun" id="tahun" value="<?=$tahun?>">

                            <div class="form-group">
                                <div class="col-md-7">
                                    <legend style="color: blue"> &nbsp; <b>Detail Rapat</b></legend>
                                    <?php if(isset($arrRapatDetail)): ?>
                                    <div class="table-responsive" style="overflow-x: auto">                     
                                        <table width="100%" class="table table-bordered table-striped" id="example2" >
                                            <thead>
                                                <tr>
                                                    <th class="text-center" width="5%">No</th>
                                                    <th class="text-center" width="25%">Nama</th>
                                                    <th class="text-center" width="6%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no=1;?>
                                                <?php foreach((array)$arrRapatDetail as $val) :?>
                                                    <tr>
                                                        <td style="text-align: center" ><?php echo $no++;?></td>
                                                        <td><?=$val['nama_sdm']?></td>
                                                        <td style="text-align: center;">
                                                            <?php if($is_spj=='0'){ ?>
                                                                <a href="<?=base_url()?>Rapat/deleteDetail/<?=$val['fk_rapat_id']?>/<?=$val['id']?>" class="btn btn-xs btn-danger" title="Hapus" onclick="javasciprt: return confirm('Apakah anda yakin?')" ><i class="glyphicon glyphicon-trash icon-white"></i></a>

                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach;?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php endif; ?>
                                    <?php if(($is_spj=='0' || empty($id)) || $this->session->level=='1'){ ?>
                                        <div class="table-responsive">
                                        <table border="1" width="100%">
                                            <tr>
                                                <th class="text-center" width="50%">Nama</th>
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
                                            </tr>
                                        </table>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php if(($is_spj=='0' || empty($id)) || $this->session->level=='1'){ ?>
                                <div class="form-group">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-6" align="center">
                                        <a id="reset" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-remove"></i> Reset (esc)</a>
                                        <a id="tambah" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-plus"></i> Tambahkan Ke List (F2)</a>
                                        <i id='loading'></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-7">
                                        <div class="panel panel-default">
                                        <table class="table table-bordered table-striped" >
                                            <tr style="background-color: #d5d2d1">
                                                <th style="vertical-align: middle;" class="text-center" width="80%">Nama</th>
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
    cari_kpa("<?=$nama_pejabat_kpa?>");
    cari_pptk("<?=$nama_pejabat_pptk?>");
    cari_ttd_st("<?=$nama_ttd?>");
    
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
    tgl = $('#tgl').val();

    if(tgl==''){
        alert('Tanggal tidak boleh kosong.');
        $("#tgl").focus();
        return false;
    }

    id_sdm = $('#id_sdm').val();

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

    $("#loading").html('<div class="loader"></div>');

    cekDataSdhAda='kosong';keterangan='';keterangan2='';
    $.ajax({
        async: false,
        type: "POST",
        url: "<?php echo base_url().'Rapat/cekCariNama'?>",
        data: {id_sdm,tgl},
        dataType: 'json',
        success: function(msg){ 
            keterangan22='';
            keterangan = msg.hslCek;
            if(keterangan!=''){
                alert(keterangan);  
                if(msg.kategori!='DD'){
                    if(level!=1){
                        alert('Silahkan Konfirmasi Ke Sekretariat yg menangani SPJ.');
                        cekDataSdhAda='ada';
                    }else{
                        if(!confirm('Apakah Jam nya sudah dicek dan tidak Bentrok ?')){
                            cekDataSdhAda='ada';
                        }
                    }
                }else{
                    cekDataSdhAda='ada';
                }                  
            }
            if(cekDataSdhAda=='kosong'){
                if(msg.rptLbh3Kli=='iya'){
                    keterangan2=msg.hslCekRpt;
                    alert(keterangan2);
                    cekDataSdhAda='ada';
                    keterangan22=' <br>'+msg.hslCekRpt;
                }
            }
            
        }
    });

    if(cekDataSdhAda=='kosong'){
        $.ajax({
            async: false,
            type: "POST",
            url: "<?php echo base_url().'Rapat/cariNama'?>",
            data: {id_sdm,tgl},
            dataType: 'json',
            success: function(msg){ 
                nama_sdm = msg.nama;
                gol = msg.golongan;
            }
        }); 

        $("#tampilDetail").append(
            '<tr>'+
                '<td>'+nama_sdm+'</td>'+
                '<td class="text-center"><a style="cursor: pointer;" title="hapus" class="remove btn btn-xs btn-danger" ><i class="glyphicon glyphicon-trash"></i></a>'+
                    '<input type="hidden" name="listSdmId[]" value="'+id_sdm+'">'+
                    '<input type="hidden" name="listNamaSdm[]" value="'+nama_sdm+'">'+
                    '<input type="hidden" name="listGolongan[]" value="'+gol+'">'+
                    '<input type="hidden" name="listKeterangan[]" value="'+keterangan+keterangan22+'">'+
                '</td>'+
            '</tr>'
        );    
    } 

    $('#id_sdm').val('');
    $('#id_sdm').trigger("chosen:updated");
    kosong();
    $("#loading").html('');
}

$("#tampilDetail").on('click','.remove',function(){
    if(confirm('Apakah anda yakin?')){
        $(this).parent().parent().remove();
    }
});

$("#fk_bagian_id").change(function(){
    cari_program();
    cari_kpa();
    cari_pptk();
    cari_ttd_st();
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

function cari_ttd_st(nama_penandatangan_st=null){
    fk_bagian_id = $("#fk_bagian_id").val();
    nama_ttd_surat_tugas = nama_penandatangan_st;
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Pjd/getTtdSt'?>",
        data: {fk_bagian_id,nama_ttd_surat_tugas},
        success: function(msg){
            $('#nama_ttd').html(msg.arrTtdSt);
            $('#nama_ttd').trigger("chosen:updated");
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

$("#tgl").change(function(){
    tgl = $(this).val();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Rapat/cariNamaHari'?>",
        data: {tgl},
        success: function(msg){
            $('#hari').val(msg.hari);
        }
    });  
})

$("#fk_rekanan_catering_id").change(function(){
    ctrng_id = $(this).val();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Rapat/cariNpwpCatering'?>",
        data: {ctrng_id},
        success: function(msg){
            $('#npwp_catering').val(msg.npwp);
            $('#pajak_daerah').val('');
            $('#pph_23').val('');
        }
    });  
})

$("#jml_peserta").keyup(function(){
    hitung();
})

$("#harga_mamin").keyup(function(){
    hitung();
})

$("#harga_snack").keyup(function(){
    hitung();
})

$("#jml_peserta_vip").keyup(function(){
    hitung();
})

$("#harga_mamin_vip").keyup(function(){
    hitung();
})

$("#harga_snack_vip").keyup(function(){
    hitung();
})

function hitung(pjkDrhnya,pph23nya){
    npwp = $("#npwp_catering").val();
    
    jmlPst = $("#jml_peserta").val();
    mmin = $("#harga_mamin").val();
    if(mmin==''){
        mmin='0';
    }
    rep_mamin = mmin.replace(/,/g,"");

    snack = $("#harga_snack").val();
    if(snack==''){
        snack='0';
    }
    rep_snack = snack.replace(/,/g,"");
    
    toMamin=parseFloat(rep_mamin)*jmlPst;
    toSnack=parseFloat(rep_snack)*jmlPst;
    tot=parseFloat(toMamin)+parseFloat(toSnack);

    jmlPstVip = $("#jml_peserta_vip").val();
    mminVip = $("#harga_mamin_vip").val();
    if(mminVip==''){
        mminVip='0';
    }
    rep_maminVip = mminVip.replace(/,/g,"");

    snackVip = $("#harga_snack_vip").val();
    if(snackVip==''){
        snackVip='0';
    }
    rep_snackVip = snackVip.replace(/,/g,"");
    
    toMaminVip=parseFloat(rep_maminVip)*jmlPstVip;
    toSnackVip=parseFloat(rep_snackVip)*jmlPstVip;
    totVip=parseFloat(toMaminVip)+parseFloat(toSnackVip);

    totAll = parseFloat(tot)+parseFloat(totVip);

    pjkDrh = parseFloat(totAll)*(10/100);

    pjkPersen23=4;
    if(npwp!=''){
        pjkPersen23=2;
    }
    pph23 = parseFloat(totAll)*(pjkPersen23/100);

    ttl = convertToRupiah(tot);

    ttlVip = '';
    if(totVip > 0){
        ttlVip = convertToRupiah(totVip);
    }

    ttlAll = convertToRupiah(totAll);
    pjkDaerah = convertToRupiah(pjkDrh);
    pph_23 = convertToRupiah(pph23);

    $('#total').val(ttl);
    $('#total_vip').val(ttlVip);
    $('#total_all').val(ttlAll);

    $('#pajak_daerah').val('');
    if(pjkDrhnya==1){
        $('#pajak_daerah').val(pjkDaerah);
    }

    $('#pph_23').val('');
    if(pph23nya==1){
        $('#pph_23').val(pph_23);
    }
}

$("#cbx_pajak_daerah").click(function(){
    cek_cb_box();    
});

$("#cbx_pph23").click(function(){
    cek_cb_box();    
});

function cek_cb_box(){
    pjkDrhnya=null;
    pph23nya=null;
    if ($('#cbx_pajak_daerah').is(':checked')) {
        pjkDrhnya=1;
    }
    if ($('#cbx_pph23').is(':checked')) {
        pph23nya=1;
    }
    hitung(pjkDrhnya,pph23nya);
}


</script>