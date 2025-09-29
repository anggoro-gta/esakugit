<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Edit Data Entry</div>
            <h1>
                <a href="<?=base_url()?>Entri" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-list-alt"></i> Tabel Data</a>
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

                <form class="form-horizontal" action="<?php echo base_url();?>Entri/update" method="post" enctype="multipart/form-data" id="assignmentForm" autocomplete="off">
                    <div class="panel panel-default">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td style="text-align: right" class="col-md-1"><b>Nomor SPJ</b></td>
                                    <th>:</th>
                                    <td class="col-md-3"><input type="text" name="nomor" class="form-control" value="<?= $entrySpj->nomor; ?>"></td>
                                    <td style="text-align: right" class="col-md-1"><b>Bulan</b></td>
                                    <th>:</th>
                                    <td class="col-md-3">
                                        <select class="form-control chosen" name="bulan" id="bulan" >
                                            <option value="">Pilih</option>
                                            <?php foreach($arrBulan as $key => $bl): ?>
                                                <option <?=$entrySpj->bulan==$key?'selected':''?> value="<?=$key?>"><?=$bl?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td rowspan="4" style="text-align: right" class="col-md-1"><b>Catatan</b></td>
                                    <th rowspan="4">:</th>
                                    <td rowspan="4" class="col-md-3"><textarea name="catatan" rows="7" class="form-control"><?= $entrySpj->catatan; ?></textarea></td>
                                </tr>
                                <tr>
                                    <td style="text-align: right"><b>Nama GU</b></td>
                                    <th>:</th>
                                    <td><input type="text" name="nama_gu" class="form-control" value="<?= $entrySpj->nama_gu; ?>"></td>
                                    <td style="text-align: right"><b>Bagian</b></td>
                                    <th>:</th>
                                    <td><?= $entrySpj->nama_bagian; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: right"><b>Kegiatan</b></td>
                                    <th>:</th>
                                    <td><?= $entrySpj->nama_program; ?></td>
                                    <td style="text-align: right"><b>Sub Kegiatan</b></td>
                                    <th>:</th>
                                    <td><?= $entrySpj->kegiatan; ?></td>
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
                                        <th style="text-align: center">Nama SDM</th>
                                        <th style="text-align: center">Kegiatan Orang</th>
                                        <th style="text-align: center">Tanggal</th>
                                        <th style="text-align: center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1;?>
                                    <?php foreach((array)$detail as $val) :?>
                                        <tr>
                                            <td style="text-align: center" ><?php echo $no++;?></td>
                                            <td><?=$val['nama_sdm']?></td>
                                            <td><?=$val['nama_kegiatan_orang']?></td>
                                            <td style="text-align: center"><?=$val['tglnya']?></td>
                                            <td style="text-align: center">
                                                <div class="btn-group">
                                                    <!-- <a class="btn btn-xs btn-success" href="#" onclick="editDataDetail(<?=$val['id']?>)"><i class="glyphicon glyphicon-edit icon-white" title="Edit"></i></a> -->
                                                    <a href="<?=base_url()?>Entri/deleteDetail/<?=$val['fk_entri_id']?>/<?=$val['id']?>" class="btn btn-xs btn-danger" title="Hapus" onclick="javasciprt: return confirm('Apakah anda yakin?')" ><i class="glyphicon glyphicon-trash icon-white"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="box-content">
                        <input type="hidden" name="fk_entri_id" value="<?=$entrySpj->id?>">
                        <div class="form-group">
                            <div class="col-md-10">
                                <div class="form-group required"> 
                                    <label class="col-md-2 control-label">Kegiatan Orang</label>
                                    <div class="col-md-3">
                                        <select class="form-control chosen" id="kegiatan_orang" name="kegiatan_orang">
                                            <option value="">Pilih</option>
                                            <?php foreach($arrMsKegOrg as $keg): ?>
                                                <option value="<?=$keg['id']?>"><?=$keg['kegiatan']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                <table border="1">
                                    <tr>
                                        <th style="text-align: center">Nama SDM</th>
                                        <th style="text-align: center" width="20%">Tanggal</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select class="form-control chosen" id="id_sdm" >
                                                <option value="">Pilih</option>
                                                <?php foreach($arrMsSdm as $sd): ?>
                                                    <?php
                                                        $jbtn = empty($sd['jabatan_baru'])?$sd['jabatan']:$sd['jabatan_baru'];
                                                    ?>
                                                    <option value="<?=$sd['id']?>"><?=$sd['nama'].' ['.$jbtn.']'?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" style="text-align: center" class="form-control kosong tanggal" id="tgl">
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
                                        <th class="text-center">Nama SDM</th>
                                        <th class="text-center">Kegiatan Orang</th>
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                    <tbody id="tampilDetail"></tbody>
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
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- MODAL TAMBAH -->
<div class="modal fade slide-up disable-scroll" id="modal_edit" role="dialog" aria-hidden="false">  
  <div class="modal-dialog" style="width: 50%;padding: 0px">
      <div class="modal-content">
        <form method="post" action="<?=base_url("Entri/editTgl")?>" enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
              <h5><b>EDIT</b></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nama</label>
                        <div class="col-sm-6">
                            <input type="text" id="nama_edit" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kegiatan Orang</label>
                        <div class="col-sm-6">
                            <input type="text" id="keg_edit" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tanggal</label>
                        <div class="col-sm-4">
                            <input type="text" name="tgl" id="tgl_edit" class="form-control text-center tanggal" required>
                        </div>
                    </div>
                    <input type="hidden" name="id" id="id_edit" class="form-control" required>
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
    $('#id_sdm').val('');
    $('#id_sdm').trigger("chosen:updated");
    $('#kegiatan_orang').val('');
    $('#kegiatan_orang').trigger("chosen:updated");
}

$("#tambah").click(function(){
    tambahList();
});

function tambahList(){
    id_sdm = $('#id_sdm').val();
    idKegiatanOrangB = $('#kegiatan_orang').val();
    tglB = $('#tgl').val();

    if(id_sdm==''){
        alert('Nama SDM tidak boleh kosong..');
        return false;
    }
    if(idKegiatanOrangB==''){
        alert('Kegiatan Orang tidak boleh kosong.');
        return false;
    }
    if(tglB==''){
        alert('Tanggal tidak boleh kosong.');
        return false;
    }

    cek = cekHariLibur();
    if(cek!=''){
        if(!confirm('Tanggal '+tglB+' Adalah '+cek)){
            return false;
        }
    }

    cekDL = '';
    $(".listNamaKegTgl").each(function() {
        val = this.value.split('_');
        if(val[0]==id_sdm){
                //1=Perjalanan Dinas Luar Daerah
            if(val[1]==1 || idKegiatanOrangB==1){ 
                if(val[2]==tglB){
                    cekDL = this.value;
                }
            }
        }
    });

    if(cekDL!=''){
        if(!confirm('Tanggal '+tglB+' Ada Kegiatan Perjalanan Dinas Luar')){
            return false;
        }
    }

    cekDataSdhAda='kosong';
    $.ajax({
        async: false,
        type: "POST",
        url: "<?php echo base_url().'Entri/cariNama'?>",
        data: {id_sdm,idKegiatanOrangB,tglB},
        dataType: 'json',
        success: function(msg){
            if(msg.hslCek!=''){
                alert(msg.hslCek);       
                cekDataSdhAda='ada';
            }
                
            namaSdm = msg.nama;
            namakegOrg = msg.keg;
            fk_bagian_id = msg.fk_bagian_id;
        }
    });  

    if(cekDataSdhAda=='kosong'){
        $("#tampilDetail").append(
            '<tr>'+
                '<td>'+namaSdm+'</td>'+
                '<td>'+namakegOrg+'</td>'+
                '<td class="text-center">'+tglB+'</td>'+
                '<td class="text-center"><a style="cursor: pointer;" title="hapus" class="remove btn btn-xs btn-danger" ><i class="glyphicon glyphicon-trash"></i></a>'+
                    '<input type="hidden" name="listSdmId[]" class="listNamaSdm" value="'+id_sdm+'">'+
                    '<input type="hidden" name="listNamaSdm[]" class="listNamaSdm" value="'+namaSdm+'">'+
                    '<input type="hidden" name="listKegiatanOrangID[]" value="'+idKegiatanOrangB+'">'+
                    '<input type="hidden" name="listNamaKegiatanOrang[]" value="'+namakegOrg+'">'+
                    '<input type="hidden" name="listFkBagianCurrent[]" value="'+fk_bagian_id+'">'+
                    '<input type="hidden" class="listNamaKegTgl" value="'+id_sdm+'_'+idKegiatanOrangB+'_'+tglB+'">'+
                    '<input type="hidden" name="listTgl[]" value="'+tglB+'">'+
                '</td>'+
            '</tr>'
        );
    }
    
    // $('#id_sdm').val('');
    // $('#id_sdm').trigger("chosen:updated");
    if(idKegiatanOrangB!=3){ // selain rapat
        $('#tgl').val('');
        $( "#tgl" ).datepicker('setDate','');
    }
}
               
function cekHariLibur(){
    var retval='';
    tgl = $("#tgl").val();
    $.ajax({
        async: false,
        type: "POST",
        url: "<?php echo base_url().'Entri/cekTglLibur'?>",
        data: {tgl},
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

function editDataDetail(id){
    $.ajax({
        type: "POST",
        url: "<?php echo base_url().'Entri/cariDataDetail'?>",
        data: {id},
        dataType: 'json',
        success: function(msg){
            $("#nama_edit").val(msg.nama);
            $("#keg_edit").val(msg.keg_orang);
        }
    });

    $("#id_edit").val(id);
    $('#modal_edit').modal('show');
}

// $("#tgl_edit").change(function(){
    
// })

</script>