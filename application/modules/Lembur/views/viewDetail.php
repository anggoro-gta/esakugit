 <section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Detail Lembur</div>
            <h1>
                <a href="<?=base_url()?>Lembur" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-list-alt"></i> Tabel Data</a>
            </h1>
        </div>
    </div>
</section>
<section class="content_section">
    <div class="content_spacer">
        <div class="content">
            <div class="box col-md-12">
                <div class="panel panel-default">
                    <div class="table-responsive">
                        <table class="table">
                            <input type="hidden" id="idLembur" value="<?=$hsl['id']?>">
                            <tr>
                                <td style="text-align: right" class="col-md-2"><b>SPJ Bulan</b></td>
                                <th>:</th>
                                <td class="col-md-4"><?= $this->help->namaBulan($hsl['bulan']) ?> </td>
                                <td style="text-align: right" class="col-md-2"><b>Sub Kegiatan</b></td>
                                <th>:</th>
                                <td class="col-md-5"><?= $hsl['kegiatan']; ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><b>Tgl Surat Tugas</b></td>
                                <th>:</th>
                                <td><?= $this->help->ReverseTgl($hsl['tgl_surat_tugas']); ?> </td>
                                <td style="text-align: right"><b>Penandatangan ST</b></td>
                                <th>:</th>
                                <td><?= $hsl['nama_penandatangan_st']; ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><b>Latar Belakang</b></td>
                                <th>:</th>
                                <td><?= $hsl['latar_belakang']; ?> </td>
                                <td style="text-align: right"><b>Pengusul</b></td>
                                <th>:</th>
                                <td><?= $hsl['nama_pengusul']; ?></td>
                            </tr>                            
                            <tr>
                                <td style="text-align: right"><b>Perihal</b></td>
                                <th>:</th>
                                <td><?= $hsl['perihal']; ?></td>
                                <td style="text-align: right"><b>KPA</b></td>
                                <th>:</th>
                                <td><?= $hsl['nama_pejabat_kpa']; ?> </td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><b>Tgl Kegiatan</b></td>
                                <th>:</th>
                                <td><?=$this->help->ReverseTgl($hsl['tgl_kegiatan_dari']).' &nbsp;&nbsp; S/D &nbsp;&nbsp; '.$this->help->ReverseTgl($hsl['tgl_kegiatan_sampai']); ?></td>
                                <td style="text-align: right"><b>PPTK</b></td>
                                <th>:</th>
                                <td><?= $hsl['nama_pejabat_pptk']; ?> </td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><b>Bagian</b></td>
                                <th>:</th>
                                <td><?=$hsl['singkatan_bagian']; ?></td>
                                <td style="text-align: right"><b>Bendahara Pembantu</b></td>
                                <th>:</th>
                                <td><?= $hsl['nama_bendahara_pembantu']; ?> </td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><b>Kegiatan</b></td>
                                <th>:</th>
                                <td><?=$hsl['nama_program']; ?></td>
                                <td style="text-align: right"><b></b></td>
                                <th></th>
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
                                    <th class="text-center" width="5%">No</th>
                                    <th class="text-center" width="30%">Nama</th>
                                    <th class="text-center" width="15%">Tanggal</th>
                                    <th class="text-center" width="7%">Jml<br>Jam</th>
                                    <th class="text-center" width="7%">Hari<br>Libur</th>
                                    <th class="text-center" width="10%">Tarif<br>Lembur</th>
                                    <th class="text-center" width="10%">Pph21 (%)</th>
                                    <th class="text-center" width="10%">Uang Mamin</th>
                                    <th class="text-center" width="10%">Jml Mamin</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1;?>
                                <?php foreach((array)$detail as $val) :?>
                                    <tr>
                                        <td style="text-align: center" ><?php echo $no++;?></td>
                                        <td><?=$val['nama_sdm']?></td>
                                        <td style="text-align: center"><?=$this->help->ReverseTgl($val['tgl'])?></td>
                                        <td style="text-align: center"><?=$val['jml_jam']?></td>
                                        <td style="text-align: center"><?=$val['is_libur']?></td>
                                        <td style="text-align: right"><?=number_format($val['tarif'])?></td>
                                        <td style="text-align: center"><?=$val['pph21']?></td>
                                        <td style="text-align: right"><?=number_format($val['uang_makan'])?></td>
                                        <td style="text-align: center"><?=$val['jml_makan']?></td>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div>
                    <div class="form-group">        
                        <div class="col-md-12 text-center">
                            <!-- <button class="btn btn-md btn-warning" title="Cetak Telaah Staf" id="cetakTelaah"><i class="glyphicon glyphicon-file"></i> Telaah</button> -->
                            <!-- <a title="Cetak Surat Tugas" class="btn btn-md btn-success" id="cetakST" ><i class="glyphicon glyphicon-file"></i> Surat Tugas</a> -->
                            <!-- <a title="Cetak DH PNS" class="btn btn-md btn-primary" id="cetakDhPNS" ><i class="glyphicon glyphicon-file"></i> Daftar Hadir</a> -->
                            <!-- <a title="Cetak DH NON ASN" class="btn btn-md btn-primary" id="cetakDhNonPNS" ><i class="glyphicon glyphicon-file"></i> DH NON ASN</a> -->
                            <!-- <a title="Cetak Daftar Penerimaan Uang Lembur PNS" class="btn btn-md btn-info" id="cetakDpPNS" ><i class="glyphicon glyphicon-file"></i> DPUL PNS</a> -->
                            <!-- <a title="Cetak Daftar Penerimaan Uang Lembur NON ASN" class="btn btn-md btn-primary" id="cetakDpNonPNS" ><i class="glyphicon glyphicon-file"></i> DPUL NON ASN</a> -->
                            <!-- <a title="Cetak Daftar Penerimaan Uang Makan Lembur" class="btn btn-md btn-info" id="cetakDpUMPNS" ><i class="glyphicon glyphicon-file"></i> DPUM</a> -->
                            <!-- <a title="Cetak Daftar Penerimaan Uang Makan Lembur NON ASN" class="btn btn-md btn-primary" id="cetakDpUMNonPNS" ><i class="glyphicon glyphicon-file"></i> DPUM NON ASN</a> -->
                            <!-- <a title="Cetak Kwitansi" class="btn btn-md btn-info" id="cetakKwi" ><i class="glyphicon glyphicon-file"></i> Kwitansi</a> -->
                            <!-- <a title="Dowload Laporan Lembur" class="btn btn-md btn-warning" id="lapLembur" ><i class="glyphicon glyphicon-download"></i> Lap. Lembur</a> -->
                            <!-- <a title="Cetak SSPD" class="btn btn-md btn-default" id="cetakSSPD" ><i class="glyphicon glyphicon-file"></i> SSPD</a> -->
                        </div>
                    </div>
                </div>
                <br><br><br><br><br><br>
            </div>
        </div>
    </div>
</section>
<!-- MODAL  -->
<div class="modal fade slide-up disable-scroll" id="modal_kwi" role="dialog" aria-hidden="false">  
    <div class="modal-dialog" style="width: 35%;padding: 0px">
        <div class="modal-content">
            <form method="post" action="<?=base_url("Lembur/cetakKwi")?>" target="_blank" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                  <h5><b>CETAK KWITANSI</b></h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group">      
                            <label class="col-md-4 control-label">Tampilkan Nilai Pajak</label>
                            <div class="col-md-2">
                                <input type="checkbox" name="tampilkan_pajak" class="form-control text-center">
                            </div>
                        </div>
                        <input name="id_lembur_kwi" id="id_lembur_kwi" type="hidden">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-md btn-default pull-left inline" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-md btn-success pull-left inline" >Cetak</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade slide-up disable-scroll" id="modal_sspd" role="dialog" aria-hidden="false">  
    <div class="modal-dialog" style="width: 35%;padding: 0px">
        <div class="modal-content">
            <form method="post" action="<?=base_url("Lembur/cetak_sspd")?>" target="_blank" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                  <h5><b>CETAK SSPD (Surat Setoran Pajak Daerah)</b></h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group">      
                            <label class="col-md-4 control-label">Tgl Cetak</label>
                            <div class="col-md-7">
                                <input type="text" name="tgl_cetak" class="form-control text-center tanggal" required autocomplete="off"></input>
                            </div>
                        </div>
                        <input name="id_lembur" id="id_lembur" type="hidden">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-md btn-default pull-left inline" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-md btn-success pull-left inline" >Cetak</button>
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
    
});

$("#cetakTelaah").click(function(){
    idLembur = $("#idLembur").val();
     
    window.open("<?= base_url()?>Lembur/cetakTelaah?id="+idLembur);
});

$("#cetakST").click(function(){
    idLembur = $("#idLembur").val();
     
    window.open("<?= base_url()?>Lembur/cetakST?id="+idLembur);
});

$("#cetakDhPNS").click(function(){
    idLembur = $("#idLembur").val();
     
    window.open("<?= base_url()?>Lembur/cetakDhPNS?id="+idLembur);
});

$("#cetakDhNonPNS").click(function(){
    idLembur = $("#idLembur").val();
     
    window.open("<?= base_url()?>Lembur/cetakDhNonPNS?id="+idLembur);
});

$("#cetakDpPNS").click(function(){
    idLembur = $("#idLembur").val();
     
    window.open("<?= base_url()?>Lembur/cetakDpPNS?id="+idLembur);
});

$("#cetakDpNonPNS").click(function(){
    idLembur = $("#idLembur").val();
     
    window.open("<?= base_url()?>Lembur/cetakDpNonPNS?id="+idLembur);
});

$("#cetakDpUMPNS").click(function(){
    idLembur = $("#idLembur").val();
     
    window.open("<?= base_url()?>Lembur/cetakDpUMPNS?id="+idLembur);
});

$("#cetakKwi").click(function(){
    idLembur = $("#idLembur").val();
     
    // $('#id_lembur_kwi').val(idLembur);
    // $("#modal_kwi").modal("show");
    window.open("<?= base_url()?>Lembur/cetakKwi?id="+idLembur);
});

$("#lapLembur").click(function(){
    idLembur = $("#idLembur").val();
     
    window.open("<?= base_url()?>Lembur/lapLembur?id="+idLembur);
});

$("#cetakSSPD").click(function(){
    idLembur = $("#idLembur").val();
     
    $('#id_lembur').val(idLembur);
    $("#modal_sspd").modal("show");
});


</script>