<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Entri Belanja Gaji dan TPP</div>
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
                        <form class="form-horizontal" action="<?php echo base_url();?>GajiTpp/save" method="post" enctype="multipart/form-data" onsubmit="return validateForm();" id="assignmentForm">
                            <div class="col-md-6">                                
                                <div class="form-group required">  
                                    <label class="col-md-3 control-label">Bulan SPJ</label>
                                    <div class="col-md-4">
                                        <select class="form-control chosen" name="spj_bulan" id="spj_bulan" required>
                                            <option value="">Pilih</option>
                                            <?php foreach($this->help->namaBulan() as $key => $bl): ?>
                                                <option <?=$spj_bulan==$key?'selected':''?> value="<?=$key?>"><?=$bl?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group required">  
                                    <label class="col-md-3 control-label">Kegiatan</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="fk_program_id" id="fk_program_id" required>
                                            <option value="">Pilih</option>
                                        </select>
                                    </div>  
                                </div>
                                <div class="form-group required">      
                                    <label class="col-md-3 control-label">Sub Kegiatan</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="fk_kegiatan_id" id="fk_kegiatan_id" required>
                                            <option value="">Pilih</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group required">      
                                    <label class="col-md-3 control-label">Belanja</label>
                                    <div class="col-md-8">
                                        <select class="form-control chosen" name="fk_rekening_belanja_id" id="fk_rekening_belanja_id" required>
                                            <option value="">Pilih</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Jumlah Dana</label>
                                    <div class="col-md-3">
                                        <input type="text" name="jml_dana" id="jml_dana" value="<?=$jml_dana?>" class="form-control nominal" required>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Pengajuan Sebelum</label>
                                    <div class="col-md-3">
                                        <input type="text" name="pengajuan_sebelum" id="pengajuan_sebelum" value="<?=$pengajuan_sebelum?>" class="form-control nominal" required>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Pengajuan Sekarang</label>
                                    <div class="col-md-3">
                                        <input type="text" name="pengajuan_sekarang" id="pengajuan_sekarang" value="<?=$pengajuan_sekarang?>" class="form-control nominal" required>
                                    </div>
                                </div> 
                                <div class="form-group required">
                                    <label class="col-md-3 control-label">Sisa Anggaran</label>
                                    <div class="col-md-3">
                                        <input type="text" name="sisa_kas" id="sisa_kas" value="<?=$sisa_kas?>" class="form-control nominal" required>
                                    </div>
                                </div>                          
                            </div>
                            <!-- <div class="form-group col-md-12">    
                                <div class="col-md-10">
                                    <div class="panel panel-default">
                                    <table class="table table-bordered table-striped" >
                                        <tr style="background-color: #d5d2d1">
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Belanja</th>
                                            <th class="text-center">Pagu</th>
                                            <th class="text-center">Realisasi</th>
                                            <th class="text-center col-md-2">Nilai</th>
                                        </tr>
                                        <tr>
                                            <td>Gaji Pokok</td>
                                            <td>
                                                <select class="form-control chosen" name="fk_rekening_belanja_id" id="fk_rekening_belanja_id" >
                                                    <option value="">Pilih</option>
                                                </select>
                                            </td>
                                            <td><input type="text" name="pagu_gaji_pokok" id="gaji_pokok" class="form-control nominal" readonly></td>
                                            <td><input type="text" name="real_gaji_pokok" id="gaji_pokok" class="form-control nominal" readonly></td>
                                            <td><input type="text" name="gaji_pokok" id="gaji_pokok" class="form-control nominal" ></td>
                                        </tr>
                                    </table>
                                    </div>
                                </div>
                            </div>  -->
                            <input type="hidden" name="fk_rekap_dana_id" value="<?=$fk_rekap_dana_id?>">
                            <input type="hidden" name="id" value="<?=$id?>">
                            <input type="hidden" name="tahun" id="tahun" value="<?=$tahun?>">
                            
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
    cari_keg("<?=$fk_program_iad?>","<?=$fk_kegiatan_id?>");
    cariRek("<?=$fk_kegiatan_id?>","<?=$fk_rekening_belanja_id?>");
    // $(document).keyup(function(e) {
    //     if(e.which == 27) { //esc
    //         kosong();  
    //     }
    //     if(e.which == 113) { //f2
    //         tambahList();        
    //     }
    // }); 

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

Bagian=8;

function cari_program(fk_program_id=null){
    fk_bagian_id = Bagian;
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
    fk_bagian_id = Bagian;
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

tabel='';

$("#fk_kegiatan_id").change(function(){
    fk_kegiatan_id = $("#fk_kegiatan_id").val();
    cariRek(fk_kegiatan_id);
});

function cariRek(fk_kegiatan_id,fk_rekening_belanja_id=null){
    fk_bagian_id = Bagian;
    
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'GajiTpp/getCariRekeningBelanja'?>",
        data: {fk_bagian_id,fk_kegiatan_id,fk_rekening_belanja_id,tabel},
        success: function(msg){
            $('#fk_rekening_belanja_id').html(msg.nama_rek);
            $('#fk_rekening_belanja_id').trigger("chosen:updated");
        }
    });   
}

$("#fk_rekening_belanja_id").change(function(){
    cariRealisasi();
});

function cariRealisasi(){
    spj_bulan = $("#spj_bulan").val();
    if(spj_bulan==''){
        alert('Bulan SPJ tidak boleh kosong.');
        $('#fk_rekening_belanja_id').val('');
        $('#fk_rekening_belanja_id').trigger("chosen:updated");
        return false;
    }

    fk_rekening_belanja_id = $("#fk_rekening_belanja_id").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'GajiTpp/getCariRealisasiAnggaran'?>",
        data: {spj_bulan,fk_rekening_belanja_id},
        success: function(msg){
            $('#jml_dana').val(msg.jml_dana);
            $('#pengajuan_sebelum').val(msg.pengajuan_sebelum);
            $('#sisa_kas').val(msg.sisa_kas);
        }
    });   

}

$("#pengajuan_sekarang").keyup(function(){
    jml_dana = $("#jml_dana").val();
    pengajuan_sebelum = $("#pengajuan_sebelum").val();
    pengajuan_sekarang = $("#pengajuan_sekarang").val();

    if(pengajuan_sebelum==''){
        alert('Jumlah Dana & Pengajuan Sebelum tidak boleh kosong.');
        $('#pengajuan_sekarang').val('');
        return false;
    }

    rep_dana = jml_dana.replace(/,/g,"");
    rep_pengSblm = pengajuan_sebelum.replace(/,/g,"");
    rep_pengSKrg = pengajuan_sekarang.replace(/,/g,"");

    sisa = parseFloat(rep_dana) - (parseFloat(rep_pengSblm)+parseFloat(rep_pengSKrg));

    if(sisa < 0){
        alert('Pengajuan Sekarang melebihi Sisa Anggaran.');
        $('#pengajuan_sekarang').val('');
        $('#sisa_kas').val('');
        return false;
    }

    $("#sisa_kas").val(convertToRupiah(sisa));
});

</script>