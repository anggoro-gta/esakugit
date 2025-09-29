<section class="content-header">
    <div class="row">
        <div class="col-md-12">
            <div class="judul">Rekap Perjalanan Dinas</div>
        </div>
    </div>
</section>

<section class="content_section">
    <div class="content_spacer">
    <div class="content">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2>Filter Data</h2>
            </div>
            <div class="box-content">  
                <form class='form-horizontal' enctype="multipart/form-data" action="<?php echo base_url();?>Laporan/cetakRekapPjd" method="post" target="_blank">  
                    <div class="form-group required">
                        <label class="col-md-2 control-label">Bl. SPJ</label>
                        <div class="col-md-2">
                            <select class="form-control chosen" name="bulan" id="bulan" required>
                                <option value="">Pilih</option>
                                <?php foreach($arrBulan as $key => $bl): ?>
                                    <option value="<?=$key?>"><?=$bl?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>   
                    </div>
                    <?php if($this->session->userdata("level")==1){ ?>
                        <div class="form-group required">  
                            <label class="col-md-2 control-label">Bagian</label>
                            <div class="col-md-4">
                                <select class="form-control chosen" name="fk_bagian_id" id="fk_bagian_id" >
                                    <option value="">Pilih</option>
                                    <?php foreach ($arrMsBagian as $bid) { ?>
                                        <option value="<?=$bid['id']?>"><?=$bid['nama_bagian']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    <?php }else{ ?>
                        <input type="hidden" name="fk_bagian_id" id="fk_bagian_id" value="<?=$this->session->userdata("fk_bagian_id")?>">
                    <?php }?>
                    <!-- <div class="form-group required">  
                        <label class="col-md-2 control-label">Nama GU</label>
                        <div class="col-md-5">
                            <select class="form-control chosen" name="fk_gu_id" id="fk_gu_id" required>
                                <option value="">Pilih</option>
                            </select>
                        </div>  
                    </div> -->
                    <div class="form-group required">      
                        <label class="col-md-2 control-label">Sub Kegiatan</label>
                        <div class="col-md-5">
                            <select class="form-control chosen" name="fk_kegiatan_id" id="fk_kegiatan_id" required>
                                <option value="">Pilih</option>
                            </select>
                        </div>
                    </div> 
                    <div class="form-group required">      
                        <label class="col-md-2 control-label">Belanja</label>
                        <div class="col-md-5">
                            <select class="form-control chosen" name="fk_rekening_belanja_id" id="fk_rekening_belanja_id" >
                                <option value="">Pilih</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-md-2 control-label">Kategori</label>
                        <div class="col-md-2">
                            <select class="form-control chosen" name="kategori" id="kategori" required>
                                <option value="">.: Pilih :.</option>
                                <option <?=$kategori=='DD'?'selected':''?> value="DD">DD</option>
                                <option <?=$kategori=='DL'?'selected':''?> value="DL">DL</option>
                            </select>
                        </div> 
                    </div>
                    <div class="form-group required">
                        <label class="col-md-2 control-label">No. TBP</label>
                        <div class="col-md-2">
                            <select class="form-control chosen" name="id_pjd_dana" id="id_pjd_dana" required>
                                <option value="">Pilih</option>
                            </select>
                        </div>
                    </div>  
                    <!-- <div id="for_tp3" style="display: none">
                        <legend style="color: red"><u>Diisi Jika Ada Belanja AKOMODASI</u></legend>
                        <div class="form-group">
                            <label class="col-md-2 control-label">No BKU</label>
                            <div class="col-md-2">
                                <input type="text" name="no_bku_akomodasi" id="no_bku_akomodasi" class="form-control text-center del_akomodasi">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Jumlah Dana</label>
                            <div class="col-md-2">
                                <input type="text" name="jml_dana_akomodasi" id="jml_dana" class="form-control nominal del_akomodasi">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Pengajuan Sebelumnya</label>
                            <div class="col-md-2">
                                <input type="text" name="pengajuan_sebelum_akomodasi" id="pengajuan_sebelum" class="form-control nominal del_akomodasi">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Pengajuan Sekarang</label>
                            <div class="col-md-2">
                                <input type="text" name="pengajuan_sekarang_akomodasi" id="pengajuan_sekarang" class="form-control nominal del_akomodasi">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Sisa Kas</label>
                            <div class="col-md-2">
                                <input type="text" name="sisa_kas_akomodasi" id="sisa_kas" class="form-control nominal del_akomodasi" readonly>
                            </div>
                        </div>
                        <legend></legend>
                    </div>   -->
                    <div class="form-group required">
                        <label class="col-md-2 control-label">Tgl. Cetak</label>
                        <div class="col-md-2">
                            <input type="text" name="tgl_cetak" id="tgl_cetak" class="form-control tanggal text-center" value="<?=date('d-m-Y')?>">
                        </div>
                    </div>
                    <!-- <div class="form-group required">
                        <label class="col-md-2 control-label">Nama PA</label>
                        <div class="col-md-5">
                            <select class="col-md-12 control-label chosen" name="kpa" id="kpa" required>
                                <option value="">.: Pilih :.</option>
                                <?php foreach ($arrPa as $val): ?>
                                    <?php 
                                        $jbtn = ($val->jabatan_baru==' ')?$val->jabatan:$val->jabatan_baru;
                                    ?>
                                    <option value="<?=$val->id?>"><?=$val->nama.' ['.$jbtn.']'?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>                        
                    </div>   -->
                    <div class="form-group required">
                        <label class="col-md-2 control-label">Pejabat PTK</label>
                        <div class="col-md-5">
                            <select class="col-md-12 control-label chosen" name="ptk" id="ptk" required>
                                <option value="">.: Pilih :.</option>
                                <?php foreach ($arrPPTK as $val2): ?>
                                    <?php
                                        $jbtn = empty($val2->jabatan_baru)?$val2->jabatan:$val2->jabatan_baru;
                                    ?>
                                    <option value="<?=$val2->id?>"><?=$val2->nama.' ['.$jbtn.']'?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>                        
                    </div> 
                    <div class="form-group required">
                        <label class="col-md-2 control-label">Bendahara Pengeluaran</label>
                        <div class="col-md-5">
                            <select class="col-md-12 control-label chosen" name="bendahara" id="bendahara" required>
                                <option value="">.: Pilih :.</option>
                                <?php foreach ($arrBendahara as $val): ?>
                                    <option value="<?=$val->nama.'_'.$val->nip?>"><?=$val->nama?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>                        
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Bendahara Pengeluaran Pembantu</label>
                        <div class="col-md-5">
                            <select class="col-md-12 control-label chosen" name="bendahara_pembantu" id="bendahara_pembantu">
                                <option value="">.: Pilih :.</option>
                                <?php foreach ($arrBendaharaPem as $val): ?>
                                    <option value="<?=$val['id']?>"> <?=$val['nama']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>                        
                    </div>  
                    <div class="form-group">                        
                        <div class="col-md-2"></div>
                        <div class="col-md-10">
                            <button class="btn btn-md btn-warning" title="Cetak PDF"><i class="glyphicon glyphicon-file"></i> Cetak Rekap</button>
                            <a title="Download Excel" class="btn btn-md btn-success" id="cetakExcel" ><i class="glyphicon glyphicon-download"></i> Excel Rekap</a>
                            <!-- <a title="Cetak Kwitansi" class="btn btn-md btn-info" id="cetakKwi" ><i class="glyphicon glyphicon-file"></i> Cetak Kwi</a> -->
                            <a title="Cetak Rincian" class="btn btn-md btn-primary" id="cetakRincian" ><i class="glyphicon glyphicon-file"></i> Cetak Rincian</a>
                            <a title="Download Excel" class="btn btn-md btn-success" id="cetakMasterLap" ><i class="glyphicon glyphicon-download"></i> Master Lap</a>
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
// $("#bulan").change(function(){
//     bln = $(this).val();
//     $.ajax({
//         type: "POST",
//         dataType: "json",
//         url: "<?php echo base_url().'Pjd/getNamaGu'?>",
//         data: {bln},
//         success: function(msg){
//            $('#fk_gu_id').html(msg.nama_gu);
//            $('#fk_gu_id').trigger("chosen:updated");
//            $('#fk_bagian_id').html('');
//            $('#fk_bagian_id').trigger("chosen:updated");
//            $('#fk_kegiatan_id').html('');
//            $('#fk_kegiatan_id').trigger("chosen:updated");
//         }
//     });
// });

// $("#fk_gu_id").change(function(){
//     cari_bagian();
// });

// function cari_bagian(){
//     fk_gu_id = $("#fk_gu_id").val();
//     $.ajax({
//         type: "POST",
//         dataType: "json",
//         url: "<?php echo base_url().'Pjd/getBagianGU'?>",
//         data: {fk_gu_id},
//         success: function(msg){
//             $('#fk_bagian_id').html(msg.Bagian);
//             $('#fk_bagian_id').trigger("chosen:updated");
//             $('#fk_kegiatan_id').html('');
//             $('#fk_kegiatan_id').trigger("chosen:updated");
//         }
//     });     
// }

$("#bulan").change(function(){
    cari_keg();
});

$("#fk_bagian_id").change(function(){
    cari_keg();
});

function cari_keg(){
    bulan = $("#bulan").val();
    fk_bagian_id = $("#fk_bagian_id").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Pjd/getKegiatanPjdDana'?>",
        data: {bulan,fk_bagian_id},
        success: function(msg){
            $('#fk_kegiatan_id').html(msg.nama_keg);
            $('#fk_kegiatan_id').trigger("chosen:updated");
        }
    });     
}

$("#fk_kegiatan_id").change(function(){
    bulan = $("#bulan").val();
    fk_kegiatan_id = $(this).val();
    
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Pjd/getCariRekeningBelanjaDelPjd'?>",
        data: {bulan,fk_kegiatan_id},
        success: function(msg){
            $('#fk_rekening_belanja_id').html(msg.nama_rek);
            $('#fk_rekening_belanja_id').trigger("chosen:updated");
        }
    });   

});

$("#jml_dana").keyup(function(){
    sisaDana();
});
$("#pengajuan_sebelum").keyup(function(){
    sisaDana();
});
$("#pengajuan_sekarang").keyup(function(){
    sisaDana();
});

// function sisaDana(){
//     jml_dana = $("#jml_dana").val();
//     if(jml_dana==''){
//         jml_dana='0';
//     }
//     rep_jml_dana = jml_dana.replace(/,/g,"");

//     pengajuan_sebelum = $("#pengajuan_sebelum").val();
//     if(pengajuan_sebelum==''){
//         pengajuan_sebelum='0';
//     }
//     rep_pengajuan_sebelum = pengajuan_sebelum.replace(/,/g,"");

//     pengajuan_sekarang = $("#pengajuan_sekarang").val();
//     if(pengajuan_sekarang==''){
//         pengajuan_sekarang='0';
//     }
//     rep_pengajuan_sekarang = pengajuan_sekarang.replace(/,/g,"");

//     sisa='';
//     if(jml_dana!=''){
//         tot = parseFloat(rep_jml_dana)-(parseFloat(rep_pengajuan_sebelum)+parseFloat(rep_pengajuan_sekarang));
//         sisa = convertToRupiah(tot);
//     }
//     $("#sisa_kas").val(sisa);
// }

$("#kategori").change(function(){
    id_rek = $("#fk_rekening_belanja_id").val();
    bulan = $("#bulan").val();
    fk_kegiatan_id = $("#fk_kegiatan_id").val();
    kategori = $("#kategori").val();
    if(fk_kegiatan_id==''){
        alert('Kegiatan Bappeda harus diisi terlebih dahulu.');
        $('#kategori').val('');
        $('#kategori').trigger("chosen:updated");
        return false;
    }
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Pjd/getCariNoBKU'?>",
        data: {bulan,id_rek,fk_kegiatan_id,kategori},
        success: function(msg){
            $('#id_pjd_dana').html(msg.nomorBKU);
            $('#id_pjd_dana').trigger("chosen:updated");
        }
    });     
});

$("#cetakExcel").click(function(){
    fk_gu_id = $("#fk_gu_id").val();
    fk_bagian_id = $("#fk_bagian_id").val();
    fk_kegiatan_id = $("#fk_kegiatan_id").val();
    kategori = $("#kategori").val();
    no_bku = $("#no_bku").val();
    bulan = $("#bulan").val();
    tgl_cetak = $("#tgl_cetak").val();
    kpa = $("#kpa").val();
    ptk = $("#ptk").val();
    bendahara_pembantu = $("#bendahara_pembantu").val();

    no_bku_akomodasi = $("#no_bku_akomodasi").val();
    jml_dana_akomodasi = $("#jml_dana_akomodasi").val();
    pengajuan_sebelum_akomodasi = $("#pengajuan_sebelum_akomodasi").val();
    pengajuan_sekarang_akomodasi = $("#pengajuan_sekarang_akomodasi").val();
    sisa_kas_akomodasi = $("#sisa_kas_akomodasi").val();
    
    window.location.href="<?= base_url()?>Laporan/excelRekapPjd?fk_gu_id="+fk_gu_id+'&fk_bagian_id='+fk_bagian_id+'&fk_kegiatan_id='+fk_kegiatan_id+'&kategori='+kategori+'&no_bku='+no_bku+'&bulan='+bulan+'&tgl_cetak='+tgl_cetak+'&kpa='+kpa+'&ptk='+ptk+'&bendahara_pembantu='+bendahara_pembantu+'&no_bku_akomodasi='+no_bku_akomodasi+'&jml_dana_akomodasi='+jml_dana_akomodasi+'&pengajuan_sebelum_akomodasi='+pengajuan_sebelum_akomodasi+'&pengajuan_sekarang_akomodasi='+pengajuan_sekarang_akomodasi+'&sisa_kas_akomodasi='+sisa_kas_akomodasi;  
});

$("#cetakKwi").click(function(){
    fk_gu_id = $("#fk_gu_id").val();
    fk_bagian_id = $("#fk_bagian_id").val();
    fk_kegiatan_id = $("#fk_kegiatan_id").val();
    kategori = $("#kategori").val();
    no_bku = $("#no_bku").val();
    bulan = $("#bulan").val();
    tgl_cetak = $("#tgl_cetak").val();
    kpa = $("#kpa").val();
    ptk = $("#ptk").val();
    bendahara_pembantu = $("#bendahara_pembantu").val();
    
    window.open("<?= base_url()?>Laporan/cetak_kwitansi?fk_gu_id="+fk_gu_id+'&fk_bagian_id='+fk_bagian_id+'&fk_kegiatan_id='+fk_kegiatan_id+'&kategori='+kategori+'&no_bku='+no_bku+'&bulan='+bulan+'&tgl_cetak='+tgl_cetak+'&kpa='+kpa+'&ptk='+ptk+'&bendahara_pembantu='+bendahara_pembantu);
});

$("#cetakRincian").click(function(){
    fk_gu_id = $("#fk_gu_id").val();
    fk_bagian_id = $("#fk_bagian_id").val();
    fk_kegiatan_id = $("#fk_kegiatan_id").val();
    kategori = $("#kategori").val();
    no_bku = $("#no_bku").val();
    bulan = $("#bulan").val();
    tgl_cetak = $("#tgl_cetak").val();
    kpa = $("#kpa").val();
    ptk = $("#ptk").val();
    bendahara_pembantu = $("#bendahara_pembantu").val();
    
    window.open("<?= base_url()?>Laporan/cetak_rincian?fk_gu_id="+fk_gu_id+'&fk_bagian_id='+fk_bagian_id+'&fk_kegiatan_id='+fk_kegiatan_id+'&kategori='+kategori+'&no_bku='+no_bku+'&bulan='+bulan+'&tgl_cetak='+tgl_cetak+'&kpa='+kpa+'&ptk='+ptk+'&bendahara_pembantu='+bendahara_pembantu);
});

$("#cetakMasterLap").click(function(){
    fk_gu_id = $("#fk_gu_id").val();
    fk_bagian_id = $("#fk_bagian_id").val();
    fk_kegiatan_id = $("#fk_kegiatan_id").val();
    kategori = $("#kategori").val();
    no_bku = $("#no_bku").val();
    bulan = $("#bulan").val();
    
    window.location.href="<?= base_url()?>Laporan/excelMasterLap?fk_gu_id="+fk_gu_id+'&fk_bagian_id='+fk_bagian_id+'&fk_kegiatan_id='+fk_kegiatan_id+'&kategori='+kategori+'&no_bku='+no_bku+'&bulan='+bulan;  
});

</script>