<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Barang Keluar</div>
            <h1>
                <a href="<?=base_url()?>BarangKeluar" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-list-alt"></i> Tabel Data</a>
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
                        <form class="form-horizontal" action="<?php echo base_url();?>BarangKeluar/save" method="post" enctype="multipart/form-data" onsubmit="return validateForm();" id="assignmentForm">
                            <div class="col-md-5">
                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Tgl</label>
                                    <div class="col-md-7">
                                        <input type="text" name="tgl" class="form-control tanggal text-center" value="<?=$tgl?>" required>
                                    </div>
                                </div>
                                <?php if($id){ ?>
                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Nomor</label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control angka" value="<?=$nomor?>" required readonly>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Jenis Barang</label>
                                    <div class="col-md-7">
                                        <select class="form-control chosen" name="kategori" id="kategori" required>
                                            <option value="">Pilih</option>
                                            <?php foreach($arrKategoriBarang as $val3): ?>
                                                <option <?=$kategori==$val3['nama_kategori']?'selected':''?> value="<?=$val3['nama_kategori']?>"><?=$val3['nama_kategori']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group required">  
                                    <label class="col-md-3 control-label">PPTK</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="nama_pejabat_pptk" >
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
                            </div>
                            <div class="col-md-7 required">
                                <div class="form-group required">
                                    <?php if($this->session->userdata("level")!=2){ ?>
                                        <label class="col-md-3 control-label">Bagian</label>
                                        <div class="col-md-8">
                                            <select class="form-control chosen" name="fk_bagian_id_dituju" id="fk_bagian_id_dituju" required>
                                                <option value="">Pilih</option>
                                                <?php foreach($arrMsBagian as $val2): ?>
                                                    <option <?=$fk_bagian_id_dituju==$val2['id']?'selected':''?> value="<?=$val2['id']?>"><?=$val2['nama_bagian']?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>  
                                    <?php }else{ ?>
                                        <input type="hidden" name="fk_bagian_id_dituju" id="fk_bagian_id_dituju" value="<?=$this->session->userdata("fk_bagian_id")?>">
                                    <?php }?> 
                                </div>
                                <div class="form-group required">  
                                    <label class="col-md-3 control-label">Sub Kegiatan Bappeda</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="fk_kegiatan_id" id="fk_kegiatan_id" >
                                            <option value="">Pilih</option>
                                        </select>
                                    </div>  
                                </div>
                                                        
                            </div>
                            <input type="hidden" name="id" value="<?=$id?>">

                            <div class="form-group">
                                <div class="col-md-10">
                                    <legend style="color: blue"> &nbsp; <b>Detail Barang</b></legend>
                                    <?php if(isset($dataDetail)): ?>
                                    <div class="table-responsive">                     
                                        <table class="table table-bordered table-striped" id="example2">
                                            <thead>
                                                <tr>
                                                    <th style="vertical-align: middle;" class="text-center" width="5%">No</th>
                                                    <th style="vertical-align: middle;" class="text-center" width="40%">Nama Barang</th>
                                                    <th style="vertical-align: middle;" class="text-center" width="15%">Satuan</th>
                                                    <th style="vertical-align: middle;" class="text-center" width="10%">Qty</th>
                                                    <th style="vertical-align: middle;" class="text-center" width="15%">Harga Satuan</th>
                                                    <th style="vertical-align: middle;" class="text-center" width="10%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no=1;?>
                                                <?php foreach((array)$dataDetail as $val) :?>
                                                    <tr>
                                                        <td style="text-align: center" ><?php echo $no++;?></td>
                                                        <td><?=$val['nm_brg_gabung']?></td>
                                                        <td style="text-align: center"><?=$val['satuan']?></td>
                                                        <td style="text-align: center"><?=$val['qty']?></td>
                                                        <td style="text-align: center"><?=$val['harga_satuan']?></td>
                                                        <td style="text-align: center"><a href="<?=base_url()?>BarangKeluar/deleteDetail/<?=$val['id']?>" class="btn btn-xs btn-danger" title="Hapus" onclick="javasciprt: return confirm('Apakah anda yakin?')" ><i class="glyphicon glyphicon-trash icon-white"></i></a></td>
                                                    </tr>
                                                <?php endforeach;?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php endif; ?>
                                    <div class="table-responsive col-md-12">
                                        <a id="cariBrg" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-fullscreen"></i> Cari Barang</a>
                                    <table border="1">
                                        <tr>
                                            <th style="text-align: center">Nama Barang</th>
                                            <th style="text-align: center" width="20%">Satuan</th>
                                            <th style="text-align: center" width="10%">Qty</th>
                                            <th style="text-align: center" width="20%">Harga Satuan</th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control kosong" id="nama_barang" readonly>
                                                <input type="hidden" class="form-control kosong" id="id_barang">
                                                <input type="hidden" class="form-control kosong" id="id_pesanan_barang_detail">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control kosong text-center" id="satuan" readonly>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control kosong angka text-center" id="qty_sisa">
                                                <input type="hidden" class="form-control kosong" id="bts_max_qty_sisa">
                                                <input type="hidden" class="form-control kosong" id="qty_akhir">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control kosong angka text-center" id="harga_satuan" readonly>
                                            </td>
                                        </tr>
                                    </table>
                                    </div>
                                </div>
                            </div>
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
                                            <th style="vertical-align: middle;" class="text-center" width="30%">Satuan</th>
                                            <th style="vertical-align: middle;" class="text-center" width="10%">Qty</th>
                                            <th style="vertical-align: middle;" class="text-center" width="30%">Harga Satuan</th>
                                            <th style="vertical-align: middle;" class="text-center" width="4%">Aksi</th>
                                        </tr>
                                        <tbody id="tampilDetail"></tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
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
<div class="modal fade slide-up disable-scroll" id="modal_brg" role="dialog" aria-hidden="false">  
  <div class="modal-dialog" style="width: 70%;padding: 0px">
      <div class="modal-content">
        <form method="post" action="<?=base_url("BarangKeluar/updateDetail")?>" enctype="multipart/form-data" class="form-horizontal">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
              <h5><b>Detail Barang</b></h5>
            </div>
            <div class="modal-body">
                <!-- <div class="col-md-5">CARI : <input type="text" id="cari_barang" class="form-control"></div> -->
                <div id="tampilBrg"></div>
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

    cari_keg("<?=$fk_bagian_id_dituju?>","<?=$fk_kegiatan_id?>");
});

$("#fk_bagian_id_dituju").change(function(){
    cari_keg($(this).val());
});

function cari_keg(fk_bagian_id_dituju,fk_kegiatan_id=null){
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'BarangKeluar/getKegiatan'?>",
        data: {fk_bagian_id_dituju,fk_kegiatan_id},
        success: function(msg){
            $('#fk_kegiatan_id').html(msg.kegiatan);
            $('#fk_kegiatan_id').trigger("chosen:updated");
        }
    });     
}  

function validateForm(assignmentForm){
    var messages = [];
    if($("#fk_bagian_id_dituju").val()==''){
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
    nama_barang = $('#nama_barang').val();
    id_barang = $('#id_barang').val();
    id_pesanan_barang_detail = $('#id_pesanan_barang_detail').val();
    satuan = $('#satuan').val();
    qty_sisa = $('#qty_sisa').val();
    bts_max_qty_sisa = $('#bts_max_qty_sisa').val();
    qty_akhir = $('#qty_akhir').val();
    harga_satuan = $('#harga_satuan').val();

    if(parseInt(qty_sisa) > parseInt(bts_max_qty_sisa)){
        alert('Qty tidak boleh Lebih dari '+bts_max_qty_sisa);
        $('#qty_sisa').val(bts_max_qty_sisa);
        return false;
    }
    if(qty_sisa==''){
         alert('Qty tidak boleh Kosong');
        return false;
    }
    $("#loading").html('<div class="loader"></div>');

   
    $("#tampilDetail").append(
        '<tr>'+
            '<td>'+nama_barang+'</td>'+
            '<td class="text-center">'+satuan+'</td>'+
            '<td class="text-center">'+qty_sisa+'</td>'+
            '<td class="text-right">'+harga_satuan+'</td>'+
            '<td class="text-center"><a style="cursor: pointer;" title="hapus" class="remove btn btn-xs btn-danger" ><i class="glyphicon glyphicon-trash"></i></a>'+
                '<input type="hidden" name="listBrgId[]" value="'+id_barang+'">'+
                '<input type="hidden" name="listBrgNm[]" value="'+nama_barang+'">'+
                '<input type="hidden" name="listQtySisa[]" value="'+qty_sisa+'">'+
                '<input type="hidden" name="listQtyAkhir[]" value="'+bts_max_qty_sisa+'">'+
                '<input type="hidden" name="listSatuan[]" value="'+satuan+'">'+
                '<input type="hidden" name="listHrgSat[]" value="'+harga_satuan+'">'+
                '<input type="hidden" name="listPsnanBrgId[]" value="'+id_pesanan_barang_detail+'">'+
            '</td>'+
        '</tr>'
    );
    

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

$("#cariBrg").click(function(){
    kategori = $('#kategori').val();
    fk_bagian_id_dituju = $('#fk_bagian_id_dituju').val();
    if(kategori==''){
        alert('Jenis Barang tidak boleh kosong..');
        return false;
    }
    if(fk_bagian_id_dituju==''){
        alert('Bagian tidak boleh kosong..');
        return false;
    }

    $.ajax({
        type: "POST",
        dataType: "html",
        url: "<?php echo base_url().'BarangKeluar/getCariDetailBrg'?>",
        data: {kategori,fk_bagian_id_dituju},
        success: function(msg){
            $('#tampilBrg').html(msg);       
            $("#modal_brg").modal("show"); 
        }
    });  
});

</script>