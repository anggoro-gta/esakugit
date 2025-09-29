<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Edit Entry GU</div>
            <h1>
                <a href="<?=base_url()?>EntriGu" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-list-alt"></i> Tabel Data</a>
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
                <div class="panel panel-default">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <td style="text-align: right" class="col-md-2"><b>Bulan</b></td>
                                <th width="20px">:</th>
                                <td class="col-md-4"><?= $this->help->namaBulan($entriGu['bulan']); ?> </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="text-align: right" class="col-md-2"><b>Nama GU</b></td>
                                <th width="20px">:</th>
                                <td class="col-md-4"><?= $entriGu['nama']; ?> </td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="table-responsive">                     
                        <table class="table table-bordered table-striped" id="example2">
                            <thead>
                                <tr>
                                    <th style="text-align: center" width="40px">No</th>
                                    <th style="text-align: center">Bagian</th>
                                    <th style="text-align: center">Sub Kegiatan</th>
                                    <th style="text-align: center">Jumlah</th>
                                    <th style="text-align: center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; $total=0;?>
                                <?php foreach($detail as $val) :?>
                                    <tr>
                                        <td style="text-align: center" ><?= $no++;?></td>
                                        <td><?=$val['nama_bagian']?></td>
                                        <td><?=$val['nama_kegiatan_bappeda']?></td>
                                        <td style="text-align: right"><?=number_format($val['jumlah'])?></td>
                                        <td style="text-align: center">
                                            <a href="<?=base_url()?>EntriGu/deleteDetail/<?=$val['fk_entri_gu_id']?>/<?=$val['id']?>/<?=$val['fk_kegiatan_id']?>" class="btn btn-xs btn-danger" title="Hapus" onclick="javasciprt: return confirm('Apakah anda yakin?')" ><i class="glyphicon glyphicon-trash icon-white"></i></a>
                                            <a href="#" class="btn btn-xs btn-success" title="Edit" onclick="edit_detail(<?=$val['id']?>,<?=$val['fk_entri_gu_id']?>)" ><i class="glyphicon glyphicon-edit icon-white"></i></a>
                                        </td>
                                    </tr>
                                    <?php $total += $val['jumlah'];?>
                                <?php endforeach;?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align: right"><b>TOTAL</b></td>
                                    <td style="text-align: right"><b><?=number_format($total)?></b></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-content">
                    <form class="form-horizontal" action="<?php echo base_url();?>EntriGu/update" method="post" enctype="multipart/form-data" id="assignmentForm">
                        <input type="hidden" name="fk_entri_gu_id" value="<?=$entriGu['id']?>">
                        <div class="form-group">
                            <div class="col-md-10">
                                <div class="table-responsive">
                                <table border="1">
                                    <tr>
                                        <th style="text-align: center" class="col-md-2">Bagian</th>
                                        <th style="text-align: center" class="col-md-5">Kegiatan</th>
                                        <th style="text-align: center" class="col-md-2">Jumlah (Rp)</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select class="form-control chosen" id="Bagian" >
                                                <option value="">Pilih</option>
                                                <?php foreach($arrMsBagian as $bd): ?>
                                                    <option value="<?=$bd['id']?>"><?=$bd['nama_bagian']?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control chosen" id="kegiatan" >
                                                <option value="">Pilih</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control kosong nominal" id="jumlah">
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
                                <a id="tambah" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-plus"></i> Tambahkan Ke List (F2)</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <div class="panel panel-default">
                                <table class="table table-bordered table-striped" >
                                    <tr style="background-color: #d5d2d1">
                                        <th class="text-center">Bagian</th>
                                        <th class="text-center">Kegiatan</th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                    <tbody id="tampilDetail"></tbody>
                                    <tfoot>
                                        <th></th>
                                        <td style="text-align: right;"><b>TOTAL</b></td>
                                        <td style="text-align: right;"><b><span  id="total"></span></b></td>
                                        <th></th>
                                    </tfoot>
                                </table>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2"></div>
                            <div class="col-md-6" align="center">
                            <button id="submit" type="submit" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-hdd"></i> Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade slide-up disable-scroll" id="modal_edit" role="dialog" aria-hidden="false">  
  <div class="modal-dialog" style="width: 50%;padding: 0px">
      <div class="modal-content">
        <form method="post" action="<?=base_url("EntriGu/updateDetail")?>" enctype="multipart/form-data" class="form-horizontal">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
              <h5><b>Update Detail GU</b></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Sub Kegiatan</label>
                            <div class="col-sm-6">
                                <input type="text" id="detail_kegiatan" class="form-control" readonly >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Jumlah</label>
                            <div class="col-sm-4">
                                <input type="text" name="detail_jumlah" id="detail_jumlah" class="form-control nominal" >
                            </div>
                        </div>
                        <input type="hidden" id="detail_id" name="detail_id" class="form-control" readonly >
                        <input type="hidden" id="detail_fk_gu_id" name="detail_fk_gu_id" class="form-control" readonly >
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
<script type="text/javascript">
$(document).ready(function() {
    $('#example2').dataTable({
        // "searching": false,
        "bSort": false,
        'oLanguage': {
            "sProcessing":   "Sedang memproses...",
            "sLengthMenu":   "Tampilkan _MENU_ entri",
            "sZeroRecords":  "Tidak ditemukan data yang sesuai",
            "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
            "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
            "sInfoPostFix":  "",
            "sSearch":       "Cari:",
            "sUrl":          "",
            "oPaginate": {
                "sFirst":    "Pertama",
                "sPrevious": "Sebelumnya",
                "sNext":     "Selanjutnya",
                "sLast":     "Terakhir"
            }
        },
    });

    $(document).keyup(function(e) {
        if(e.which == 27) { //esc
            kosong();  
        }
        if(e.which == 113) { //f2
            tambahList();        
        }
    });     
});

$("#reset").click(function(){
    kosong();
});
function kosong(){
    $(".kosong").val('');
    $('#Bagian').val('');
    $('#Bagian').trigger("chosen:updated");
    $('#kegiatan').val('');
    $('#kegiatan').trigger("chosen:updated");
}

$("#tambah").click(function(){
    tambahList();
});

function tambahList(){
    Bagian = $('#Bagian').val();
    kegiatan = $('#kegiatan').val();
    jml = $('#jumlah').val();

    if(Bagian==''){
        alert('Bagian tidak boleh kosong..');
        return false;
    }
    if(kegiatan==''){
        alert('Kegiatan tidak boleh kosong.');
        return false;
    }
    if(jml==''){
        alert('Jumlah tidak boleh kosong.');
        return false;
    }

    namaBagian = '';
    namakegBappeda = '';
    $.ajax({
        async: false,
        type: "POST",
        url: "<?php echo base_url().'EntriGu/cariNama'?>",
        data: {Bagian,kegiatan},
        dataType: 'json',
        success: function(msg){ 
            namaBagian = msg.namaBagian;
            namakegBappeda = msg.namakegBappeda;
        }
    });  

    $("#tampilDetail").append(
        '<tr>'+
            '<td>'+namaBagian+'</td>'+
            '<td>'+namakegBappeda+'</td>'+
            '<td class="text-right">'+jml+'</td>'+
            '<td class="text-center"><a style="cursor: pointer;" title="hapus" class="remove btn btn-xs btn-danger" ><i class="glyphicon glyphicon-trash"></i></a>'+
                '<input type="hidden" name="listBagian[]" value="'+Bagian+'">'+
                '<input type="hidden" name="listNamaBagian[]" value="'+namaBagian+'">'+
                '<input type="hidden" name="listKegiatanBapppeda[]" value="'+kegiatan+'">'+
                '<input type="hidden" name="listNamaKegiatanBapppeda[]" value="'+namakegBappeda+'">'+
                '<input type="hidden" name="listJml[]" class="listJml" value="'+jml+'">'+
            '</td>'+
        '</tr>'
    );

    hsl_total();
    kosong();
}
               
function hsl_total(){
    totalnya = 0;
    $(".listJml").each(function() {
        val = this.value.replace(/,/g , "");

        totalnya += parseInt(val);
    });
        
    $("#total").html(formatMoney(totalnya));
}
     
$("#tampilDetail").on('click','.remove',function(){
    if(confirm('Apakah anda yakin?')){
        $(this).parent().parent().remove();
        hsl_total();
    }
});

$("#Bagian").change(function(){
    Bagian = $("#Bagian").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'EntriGu/getKegiatan'?>",
        data: {Bagian},
        success: function(msg){
           $('#kegiatan').html(msg.kegiatan);
           $('#kegiatan').trigger("chosen:updated");
        }
    });     
});

function formatMoney(angka){
    var rupiah = '';
    var angkarev = angka.toString().split('').reverse().join('');
    for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+',';
    return rupiah.split('',rupiah.length-1).reverse().join('');
};

function edit_detail(id,fk_entri_gu_id){
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'EntriGu/getCariDataDetail'?>",
        data: {id},
        success: function(msg){
            $('#detail_kegiatan').val(msg.nama_keg);
            $('#detail_jumlah').val(msg.jumlah);
            $('#detail_id').val(id);
            $('#detail_fk_gu_id').val(fk_entri_gu_id);
        }
    });  
    $("#modal_edit").modal("show"); 
}
</script>