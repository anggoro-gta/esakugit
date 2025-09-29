<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Entri GU</div>
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
                        <form class="form-horizontal" action="<?php echo base_url();?>EntriGu/save" method="post" enctype="multipart/form-data" onsubmit="return validateForm();" id="assignmentForm">
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Bulan</label>
                                <div class="col-md-2">
                                    <select class="form-control chosen" name="bulan" id="bulan" required>
                                        <option value="">Pilih</option>
                                        <?php foreach($arrBulan as $key => $bl): ?>
                                            <option value="<?=$key?>"><?=$bl?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>   
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Nama GU</label>
                                <div class="col-md-4">
                                    <input type="text" name="nama_gu" id="nama_gu" class="form-control" >
                                </div>  
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <div class="table-responsive">
                                    <table border="1">
                                        <tr>
                                            <th style="text-align: center" class="col-md-2">Bagian</th>
                                            <th style="text-align: center" class="col-md-5">Sub Kegiatan</th>
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
                                            <th class="text-center">Sub Kegiatan</th>
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
                                <button id="submit" type="submit" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
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
    if($("#nama_gu").val()==''){
        messages.push("Nama GU");
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

</script>