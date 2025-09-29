<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Entri Belanja Barang Lainnya</div>
            <h1>
                <a onclick="window.history.back()" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-list-alt"></i> Tabel Data</a>
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
                        <form class="form-horizontal" action="<?php echo base_url();?>Kwitansi/save" method="post" enctype="multipart/form-data" onsubmit="return validateForm();" id="assignmentForm">
                            <div class="col-md-6">
                                <input type="hidden" name="jenis_belanja" class="form-control" value="Barang" >
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Tgl Pesanan</label>
                                    <div class="col-md-5">
                                        <input type="text" name="tgl_pesanan" id="tgl_pesanan" class="form-control tanggal text-center" value="<?=$tgl_pesanan?>" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Tgl Kesepakatan Harga</label>
                                    <div class="col-md-5">
                                        <input type="text" name="tgl_kesepakatan_harga" id="tgl_kesepakatan_harga" class="form-control tanggal text-center" value="<?=$tgl_kesepakatan_harga?>" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-md-3 control-label">Tgl Kwitansi</label>
                                    <div class="col-md-5">
                                        <input type="text" name="tgl_kwitansi" id="tgl_kwitansi" class="form-control tanggal text-center" value="<?=$tgl_kwitansi?>" autocomplete="off" >
                                    </div>
                                </div> 
                               <!--  <div class="form-group">
                                    <label class="col-md-3 control-label">Perihal</label>
                                    <div class="col-md-8">
                                        <input type="text" name="perihal" id="perihal" class="form-control" value="<?=$perihal?>" autocomplete="off">
                                    </div>
                                </div> -->
                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Untuk Pembayaran</label>
                                    <div class="col-md-8">
                                        <textarea name="untuk_pembayaran" class="form-control" placeholder="exp : Belanja ATK, Oli, dll"><?=$untuk_pembayaran?></textarea>
                                    </div>
                                </div>
                                <div class="form-group required">  
                                    <label class="col-md-3 control-label">Nama Rekanan</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="fk_rekanan_id" id="fk_rekanan_id" required>
                                            <option value="">Pilih</option>
                                            <?php foreach($arrMsRekanan as $val): ?>
                                                <option <?=$fk_rekanan_id==$val['id']?'selected':''?> value="<?=$val['id']?>"><?=$val['nama_rekanan'].' - '.$val['nama_pimpinan']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="npwp_penerima" id="npwp_penerima" class="form-control">
                                <input type="hidden" name="nama_penerima" id="nama_penerima" class="form-control">
                                <input type="hidden" name="jabatan_penerima" id="jabatan_penerima" class="form-control">
                                <input type="hidden" name="alamat_penerima" id="alamat_penerima" class="form-control">
                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Banyaknya Uang</label>
                                    <div class="col-md-5">
                                        <input type="text" <?=$is_spj=='1'?'readonly':''?> name="banyaknya_uang" id="banyaknya_uang" class="form-control nominal" value="<?=$banyaknya_uang?>" autocomplete="off" required >
                                    </div>
                                </div>
                                <?php if($is_spj=='0' || empty($id)){ ?>
                                    <div class="form-group required">
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
                                                    if($val=='PPH_21'){
                                                        $ph21 = "selected";
                                                    }
                                                    if($val=='PPH_22'){
                                                        $ph22 = "selected";
                                                    }
                                                    if($val=='PPH_23'){
                                                        $ph23 = "selected";
                                                    }
                                                }
                                            ?>
                                            <select class="form-control chosen" name="jenis_pajak[]" id="jenis_pajak" multiple>
                                                <option value="">Pilih</option>
                                                <option <?=$pn?> value="PPN">PPN</option>
                                                <!-- <option <?=$ph21?> value="PPH_21">PPh 21</option> -->
                                                <option <?=$ph22?> value="PPH_22">PPh 22</option>
                                                <!-- <option <?=$ph23?> value="PPH_23">PPh 23</option> -->
                                            </select>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">PPN</label>
                                    <div class="col-md-5">
                                        <input type="text" name="ppn" id="ppn" class="form-control nominal" value="<?=$ppn?>" autocomplete="off" readonly>
                                    </div>
                                </div> 
                                <!-- <div class="form-group">
                                    <label class="col-md-3 control-label">PPh 21</label>
                                    <div class="col-md-5">
                                        <input type="text" name="pph_21" id="pph_21" class="form-control nominal" value="<?=$pph_21?>" autocomplete="off" readonly>
                                    </div>
                                </div>  -->
                                <div class="form-group">
                                    <label class="col-md-3 control-label">PPh 22</label>
                                    <div class="col-md-5">
                                        <input type="text" name="pph_22" id="pph_22" class="form-control nominal" value="<?=$pph_22?>" autocomplete="off" readonly>
                                    </div>
                                </div> 
                               <!--  <div class="form-group">
                                    <label class="col-md-3 control-label">PPh 23</label>
                                    <div class="col-md-5">
                                        <input type="text" name="pph_23" id="pph_23" class="form-control nominal" value="<?=$pph_23?>" autocomplete="off" readonly>
                                    </div>
                                </div>   -->                            
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
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group required">  
                                    <label class="col-md-3 control-label">PPK</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="nama_pejabat_ppk">
                                            <option value="">Pilih</option>
                                            <?php foreach($arrMsSdm as $val2): ?>
                                                <?php
                                                    $jbtn = ($val2['jabatan_baru']==' ')?$val2['jabatan']:$val2['jabatan_baru'];
                                                ?>
                                                <option <?=$nama_pejabat_ppk==$val2['nama']?'selected':''?> value="<?=$val2['nama'].'_'.$val2['nip'].'_'.$val2['gol_pangkat'].'_'.$jbtn?>" required ><?=$val2['nama'].' ['.$jbtn.']'?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div> 
                                <div class="form-group required">  
                                    <label class="col-md-3 control-label">PPTK</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="nama_pejabat_pptk" id="nama_pejabat_pptk">
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
                            <input type="hidden" name="id" value="<?=$id?>">
                            <input type="hidden" name="tahun" id="tahun" value="<?=$tahun?>">

                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-9">
                                        <legend style="color: blue"> &nbsp; <b>Detail Kwitansi</b></legend>
                                        <?php if(isset($kwitansiDetail)): ?>
                                            <div class="table-responsive" style="overflow-x: auto">                     
                                                <table class="table table-bordered table-striped" id="example2" >
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center" style="vertical-align: middle" width="50px">No</th>
                                                            <th class="text-center" style="vertical-align: middle">Uraian</th>
                                                            <th class="text-center">Jumlah</th>
                                                            <th class="text-center">Satuan</th>
                                                            <th class="text-center">Harga Satuan</th>
                                                            <th class="text-center" style="vertical-align: middle">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $no=1;?>
                                                        <?php foreach((array)$kwitansiDetail as $val) :?>
                                                            <tr>
                                                                <td class="text-center"><?php echo $no++;?></td>
                                                                <td><?=$val['uraian']?></td>
                                                                <td class="text-center"><?=$val['jml']?></td>
                                                                <td class="text-center"><?=$val['satuan']?></td>
                                                                <td class="text-center"><?=number_format($val['harga_satuan'])?></td>
                                                                <td style="text-align: center;">
                                                                    <?php if($is_spj=='0'){ ?>
                                                                        <a href="<?=base_url()?>Kwitansi/deleteDetail/<?=$val['fk_kwitansi_id']?>/barang/<?=$val['id']?>" class="btn btn-xs btn-danger" title="Hapus" onclick="javasciprt: return confirm('Apakah anda yakin?')" ><i class="glyphicon glyphicon-trash icon-white"></i></a>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach;?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                     <div class="col-md-9">
                                         <div class="table-responsive">
                                            <table class="table table-bordered table-striped" style="width: 100%;">
                                                <tr>
                                                    <th class="text-center" width="55%">Uraian</th>
                                                    <th class="text-center">Jumlah</th>
                                                    <th class="text-center">Satuan</th>
                                                    <th class="text-center">Harga Satuan</th>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" id="uraian_dtl" class="form-control kosong"></td>
                                                    <td><input type="text" id="jml_dtl" class="form-control kosong text-center angka"></td>
                                                    <td><input type="text" id="satuan_dtl" class="form-control text-center kosong"></td>
                                                    <td><input type="text" id="harga_satuan_dtl" class="form-control nominal kosong"></td>
                                                </tr>
                                            </table>
                                            <div class="form-group">
                                                <div class="col-md-3"></div>
                                                <div class="col-md-6" align="center">
                                                    <a class="btn btn-sm btn-warning reset"><i class="glyphicon glyphicon-remove"></i> Reset (esc)</a>
                                                    <a id="tambah_dtl" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-plus"></i> Tambahkan Ke List (F2)</a>
                                                    <i id='loading'></i>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                            <div class="col-md-12">
                                                <div class="panel panel-default">
                                                <table class="table table-bordered table-striped" style="font-size: 9pt">
                                                    <tr style="background-color: #d5d2d1">
                                                        <th class="text-center" width="55%">Uraian</th>
                                                        <th class="text-center" >Jumlah</th>
                                                        <th class="text-center" >Satuan</th>
                                                        <th class="text-center" >Harga Satuan</th>
                                                        <th class="text-center">Aksi</th>
                                                    </tr>
                                                    <tbody id="tampilDetail"></tbody>
                                                </table>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
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

<script type="text/javascript">
$(document).ready(function(){
    cari_program("<?=$fk_program_id?>");
    cari_keg("<?=$fk_program_id?>","<?=$fk_kegiatan_id?>");
    cari_rekBlnja("<?=$fk_kegiatan_id?>","<?=$fk_rekening_belanja_id?>");
    cari_kpa("<?=$nama_pejabat_kpa?>");
    cari_pptk("<?=$nama_pejabat_pptk?>");
    cariRekanan("<?=$fk_rekanan_id?>");

    $(document).keyup(function(e) {
        if(e.which == 27) { //esc
            kosong();  
        }
        if(e.which == 113) { //f2
            tambahList();        
        }
    }); 

});

// $("#jenis_belanja").change(function(){
//     cekJnsBlnja($(this).val());
// });

// function cekJnsBlnja(val){
//     $("#keg_swakelola").hide();
//     if(val=='Swakelola'){
//         $("#keg_swakelola").show();
//     }
// }

function validateForm(assignmentForm){
    var messages = [];
    if($("#fk_bagian_id").val()==''){
        messages.push("Bagian, ");
    }
    if($("#fk_program_id").val()==''){
        messages.push("Program, ");
    }
    if($("#fk_id").val()==''){
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
        url: "<?php echo base_url().'PesananBarang/getProgram'?>",
        data: {fk_bagian_id,fk_program_id},
        success: function(msg){
           $('#fk_program_id').html(msg.Bagian);
           $('#fk_program_id').trigger("chosen:updated");
           $('#fk_id').val('');
           $('#fk_id').trigger("chosen:updated");
        }
    });  
    cari_bendahara_pembantu();   
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

$("#fk_rekanan_id").change(function(e) {
    fk_rekanan_id = $(e.target).val();
    cariRekanan(fk_rekanan_id);
});

function cariRekanan(fk_rekanan_id){
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Kwitansi/cariRekanan'?>",
        data: {fk_rekanan_id},
        success: function(msg){
            $('#npwp_penerima').val(msg.npwp_penerima);
            $('#nama_penerima').val(msg.nama_penerima);
            $('#jabatan_penerima').val(msg.jabatan_penerima);
            $('#alamat_penerima').val(msg.alamat_penerima);
        }
    });     
};

$("#jenis_pajak").change(function(e) {
    var jenis = $(e.target).val();
    tgl_pesanan = $("#tgl_pesanan").val();
    // if(tgl_pesanan==''){
    //     alert('Tgl Pesanan wajid diisi !!');
    //     return false;
    // }
    npwp_penerima = $("#npwp_penerima").val();
    uang = $("#banyaknya_uang").val();
    if(uang==''){
        alert('Banyaknya Uang wajid diisi !!');
        return false;
    }
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Kwitansi/hitungPajak'?>",
        data: {tgl_pesanan,npwp_penerima,jenis,uang},
        success: function(msg){
            $('#ppn').val(msg.ppn);
            $('#pph_21').val(msg.pph21);
            $('#pph_22').val(msg.pph22);
            $('#pph_23').val(msg.pph23);
        }
    });     
});

$("#npwp_penerima").change(function(){
    value = $(this).val();
    // if (typeof value === 'string') {
        hsl = value.replace(/(\d{2})(\d{3})(\d{3})(\d{1})(\d{3})(\d{3})/, '$1.$2.$3.$4-$5.$6');
        $('#npwp_penerima').val(hsl);
    // }

    $("#pph_21").val('');
    $("#pph_22").val('');
    $("#pph_23").val('');
});

$("#tambah_dtl").click(function(){
    tambahList();
});

function tambahList(){
    uraian_dtl = $('#uraian_dtl').val();
    jml_dtl = $('#jml_dtl').val();
    satuan_dtl = $('#satuan_dtl').val();
    harga_satuan_dtl = $('#harga_satuan_dtl').val();

    if(uraian_dtl==''){
        alert('Uraian tidak boleh kosong.');
        $("#uraian_dtl").focus();
        return false;
    }

    $("#tampilDetail").append(
        '<tr>'+
            '<td>'+uraian_dtl+'</td>'+
            '<td style="text-align:center">'+jml_dtl+'</td>'+
            '<td style="text-align:center">'+satuan_dtl+'</td>'+
            '<td style="text-align:right">'+harga_satuan_dtl+'</td>'+
            '<td class="text-center"><a style="cursor: pointer;" title="hapus" class="remove btn btn-xs btn-danger" ><i class="glyphicon glyphicon-trash"></i></a>'+
                '<input type="hidden" name="listUraian[]" value="'+uraian_dtl+'">'+
                '<input type="hidden" name="listJml[]" value="'+jml_dtl+'">'+
                '<input type="hidden" name="listSatuan[]" value="'+satuan_dtl+'">'+
                '<input type="hidden" name="listHargaSatuan[]" value="'+harga_satuan_dtl+'">'+
            '</td>'+
        '</tr>'
    ); 
    kosong();
}

$("#tampilDetail").on('click','.remove',function(){
    if(confirm('Apakah anda yakin?')){
        $(this).parent().parent().remove();
    }
});

$(".reset").click(function(){
    kosong();
});

function kosong(){
    $(".kosong").val('');
}

</script>