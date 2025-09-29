<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Entri Data</div>
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
                        <form class="form-horizontal" action="<?php echo base_url();?>Entri/save" method="post" enctype="multipart/form-data" onsubmit="return validateForm();" id="assignmentForm" autocomplete="off">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <div class="required">
                                        <label class="col-md-3 control-label">Bulan</label>
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-control chosen" name="bulan" id="bulan" >
                                            <option value="">Pilih</option>
                                            <?php foreach($arrBulan as $key => $bl): ?>
                                                <option value="<?=$key?>"><?=$bl?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <!-- <label class="col-md-2 control-label">Nama GU</label>
                                    <div class="col-md-4">
                                        <select class="form-control chosen" name="fk_gu_id" id="fk_gu_id" >
                                            <option value="">Pilih</option>
                                        </select>
                                    </div>
                                    <input type="hidden" id="nama_gu" name="nama_gu">  -->  
                                </div>
                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Bagian</label>
                                    <div class="col-md-7">
                                        <select class="form-control chosen" name="fk_bagian_id" id="fk_bagian_id" >
                                            <option value="">Pilih</option>
                                            <?php foreach($arrMsBagian as $val): ?>
                                                <option value="<?=$val['id']?>"><?=$val['nama_bagian']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>   
                                </div>
                                <div class="form-group required">  
                                    <label class="col-md-3 control-label">Kegiatan</label>
                                    <div class="col-md-9">
                                        <select class="form-control chosen" name="fk_program_id" id="fk_program_id" >
                                            <option value="">Pilih</option>
                                        </select>
                                    </div>  
                                </div>
                                <div class="form-group required">      
                                    <label class="col-md-3 control-label">Sub Kegiatan</label>
                                    <div class="col-md-9">
                                        <select class="form-control chosen" name="fk_kegiatan_id" id="fk_kegiatan_id" >
                                            <option value="">Pilih</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group required"> 
                                    <label class="col-md-3 control-label">Kegiatan Orang</label>
                                    <div class="col-md-3">
                                        <select class="form-control chosen" id="kegiatan_orang" name="kegiatan_orang">
                                            <option value="">Pilih</option>
                                            <?php foreach($arrMsKegOrg as $keg): ?>
                                                <option value="<?=$keg['id']?>"><?=$keg['kegiatan']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <label class="col-md-1 control-label">Nomor</label>
                                    <div class="col-md-5">
                                        <input type="text" name="nomor" id="nomor" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group"> 
                                    <label class="col-md-2 control-label">Catatan</label>
                                    <div class="col-md-10">
                                        <textarea name="catatan" rows="12" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group nonRapat">
                                <div class="col-md-10">
                                    <div class="table-responsive">
                                    <table border="1">
                                        <tr>
                                            <th style="text-align: center">Nama SDM</th>
                                            <!-- <th style="text-align: center" width="50%">Kegiatan Orang</th> -->
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
                                            <!-- <td>
                                                <select class="form-control chosen" id="kegiatan_orang" >
                                                    <option value="">Pilih</option>
                                                    <?php foreach($arrMsKegOrg as $keg): ?>
                                                        <option value="<?=$keg['id']?>"><?=$keg['kegiatan']?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td> -->
                                            <td>
                                                <input type="text" style="text-align: center" class="form-control kosong tanggal" id="tgl">
                                            </td>
                                        </tr>
                                    </table>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group nonRapat">
                                <div class="col-md-2"></div>
                                <div class="col-md-6" align="center">
                                    <a id="reset" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-remove"></i> Reset (esc)</a>
                                    <a id="tambah" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-plus"></i> Tambahkan Ke List (F2)</a>
                                </div>
                            </div>
                            <div class="form-group nonRapat">
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
                            <!-- <div class="form-group rapat" style="display: none">
                                <div class="col-md-10">
                                    <div class="panel panel-default">
                                    <table class="table table-bordered table-striped" >
                                        <tr style="background-color: #d5d2d1">
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama SDM</th>
                                            <th class="text-center">Pilih Semua <br> <input type="checkbox" id="checkAll" title="pilih semua"></th>
                                        </tr>
                                        <?php $no=1; foreach($arrMsSdm as $sd): ?>
                                            <tr>
                                                <td class="text-center"><?=$no++;?></td>
                                                <td ><?=$sd['nama']?></td>
                                                <td>
                                                    <input type="checkbox" class="chek_all" name="listSdmIdRapat[]" value="<?=$sd['id']?>">
                                                    <input type="hidden" name="listNamaSdmRapat[]" value="<?=$sd['nama']?>">
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </table>
                                    </div>
                                </div>
                            </div> -->
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
level = "<?=$this->session->userdata("level")?>";

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
    if($("#bulan").val()==''){
        messages.push("Bulan, ");
    }
    if($("#nama_gu").val()==''){
        messages.push("Nama GU, ");
    }
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

            // if(msg.hslCek!=''){
            //     alert(msg.hslCek);       
            //     cekDataSdhAda='ada';
            // }
                
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

$("#fk_bagian_id").change(function(){
    fk_bagian_id = $("#fk_bagian_id").val();
    fk_program_id = '';
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
});

$("#fk_program_id").change(function(){
    fk_bagian_id = $("#fk_bagian_id").val();
    fk_program_id =  $(this).val();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Entri/getKegiatan'?>",
        data: {fk_bagian_id,fk_program_id},
        success: function(msg){
           $('#fk_kegiatan_id').html(msg.kegiatan);
           $('#fk_kegiatan_id').trigger("chosen:updated");
        }
    });     
});

$("#kegiatan_orang").change(function(){
    kegiatan_orang =  $(this).val();
    fk_kegiatan_id = $("#fk_kegiatan_id").val();
    nama_gu = $("#nama_gu").val();
    fk_bagian_id = $("#fk_bagian_id").val();
    bulan = $("#bulan").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Entri/getCariNomor'?>",
        data: {kegiatan_orang,fk_kegiatan_id,nama_gu,fk_bagian_id,bulan},
        success: function(msg){
           $('#nomor').val(msg.nom);
        }
    });  
});

// $("#bulan").change(function(){
//     bulan =  $(this).val();
//     $.ajax({
//         type: "POST",
//         dataType: "json",
//         url: "<?php echo base_url().'Entri/cariGU'?>",
//         data: {bulan},
//         success: function(msg){
//            $('#nama_gu').html(msg.namaGU);
//            $('#nama_gu').trigger("chosen:updated");
//         }
//     });     
// });

$("#bulan").change(function(){
    // bln = $(this).val();
    // $.ajax({
    //     type: "POST",
    //     dataType: "json",
    //     url: "<?php echo base_url().'Pjd/getNamaGu'?>",
    //     data: {bln},
    //     success: function(msg){
    //        $('#fk_gu_id').html(msg.nama_gu);
    //        $('#fk_gu_id').trigger("chosen:updated");
    //        $('#fk_bagian_id').html('');
    //        $('#fk_bagian_id').trigger("chosen:updated");
    //        $('#fk_program_id').html('');
    //        $('#fk_program_id').trigger("chosen:updated");
    //        $('#fk_kegiatan_id').html('');
    //        $('#fk_kegiatan_id').trigger("chosen:updated");
    //     }
    // });
});

$("#fk_gu_id").change(function(){
    cari_bagian();
});

function cari_bagian(){
    fk_gu_id = $("#fk_gu_id").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Pjd/getBagianGU'?>",
        data: {fk_gu_id},
        success: function(msg){            
            $("#nama_gu").val(msg.nama_gu);
            $('#fk_bagian_id').html(msg.Bagian);
            $('#fk_bagian_id').trigger("chosen:updated");
            $('#fk_program_id').html('');
            $('#fk_program_id').trigger("chosen:updated");
            $('#fk_kegiatan_id').html('');
            $('#fk_kegiatan_id').trigger("chosen:updated");
        }
    });     
}

</script>