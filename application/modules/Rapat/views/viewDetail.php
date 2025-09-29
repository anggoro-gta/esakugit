 <section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Detail Rapat</div>
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
                <div class="panel panel-default">
                    <div class="table-responsive">
                        <table class="table">
                            <input type="hidden" id="idRapat" value="<?=$hsl['id']?>">
                            <tr>
                                <td style="text-align: right"><b>Hari</b></td>
                                <th>:</th>
                                <td width="40%"><?= $hsl['hari']; ?> </td>
                                <td style="text-align: right"><b></b></td>
                                <th>:</th>
                                <td><?= $hsl['nama_pejabat_pa']; ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><b>Tgl</b></td>
                                <th>:</th>
                                <td><?= $this->help->ReverseTgl($hsl['tgl']); ?> </td>
                                <td style="text-align: right"><b>KPA</b></td>
                                <th>:</th>
                                <td><?= $hsl['nama_pejabat_kpa']; ?></td>
                            </tr>                            
                            <tr>
                                <td style="text-align: right"><b>Pukul</b></td>
                                <th>:</th>
                                <td><?= $hsl['pukul']; ?></td>
                                <td style="text-align: right"><b>PPTK</b></td>
                                <th>:</th>
                                <td><?= $hsl['nama_pejabat_pptk']; ?> </td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><b>Tempat</b></td>
                                <th>:</th>
                                <td><?=$hsl['tempat']; ?></td>
                                <td style="text-align: right"><b></b></td>
                                <th>:</th>
                                <td><?= $hsl['nama_bendahara']; ?> </td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><b>Acara</b></td>
                                <th>:</th>
                                <td><?=$hsl['acara']; ?></td>
                                <td style="text-align: right"><b>Bendahara Pembantu</b></td>
                                <th>:</th>
                                <td><?= $hsl['nama_bendahara_pembantu']; ?> </td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><b>Nama Catering</b></td>
                                <th>:</th>
                                <td><?=$catering['nama_rekanan']; ?></td>
                                <td style="text-align: right"><b>Jml Peserta</b></td>
                                <th>:</th>
                                <td><?=$hsl['jml_peserta']; ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><b>Tgl Kwitansi</b></td>
                                <th>:</th>
                                <td><?= $this->help->ReverseTgl($hsl['tgl_kwitansi']); ?> </td>
                                <td style="text-align: right"><b>Harga Mamin</b></td>
                                <th>:</th>
                                <td><?=number_format($hsl['harga_mamin']); ?> &nbsp;&nbsp; <b>&</b> &nbsp;&nbsp;<b>Harga Snack : </b> <?=number_format($hsl['harga_snack'])?></td>
                            </tr> 
                            <tr>
                                <td style="text-align: right"><b>Bagian</b></td>
                                <th>:</th>
                                <td><?=$hsl['singkatan_bagian']; ?></td>
                                <td style="text-align: right"><b>Total</b></td>
                                <th>:</th>
                                <td><?=number_format($hsl['total']); ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><b>Kegiatan</b></td>
                                <th>:</th>
                                <td><?=$hsl['nama_program']; ?></td>
                                <td style="text-align: right"><b>Pajak Daerah</b></td>
                                <th>:</th>
                                <td><?=number_format($hsl['pajak_daerah']); ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><b>Sub Kegiatan</b></td>
                                <th>:</th>
                                <td><?=$hsl['kegiatan']; ?></td>
                                <td style="text-align: right"><b>PPh 23</b></td>
                                <th>:</th>
                                <td><?=number_format($hsl['pph_23']); ?></td>
                            </tr>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="table-responsive">                     
                        <table class="table table-bordered table-striped" id="example2">
                            <thead>
                                <tr>
                                     <tr>
                                        <th class="text-center" width="5%">No</th>
                                        <th class="text-center" width="25%">Nama</th>
                                    </tr>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1;?>
                                <?php foreach((array)$detail as $val) :?>
                                    <tr>
                                        <td style="text-align: center" ><?php echo $no++;?></td>
                                        <td><?=$val['nama_sdm']?></td>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div>
                    <div class="form-group">        
                        <div class="col-md-12 text-center">
                            <!-- <a title="Cetak Daftar Hadir" class="btn btn-md btn-success" id="cetakSU" ><i class="glyphicon glyphicon-file"></i> Surat Undangan</a>
                            <a title="Cetak Daftar Hadir" class="btn btn-md btn-primary" id="cetakDH" ><i class="glyphicon glyphicon-file"></i> Daftar Hadir</a>
                            <a title="Cetak Kwitansi" class="btn btn-md btn-info" id="cetakKwi" ><i class="glyphicon glyphicon-file"></i> Kwitansi</a>
                            <a title="Dowload Laporan Lembur" class="btn btn-md btn-warning" id="lapRapat" ><i class="glyphicon glyphicon-download"></i> Lap. Rapat</a> -->
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
<div class="modal fade slide-up disable-scroll" id="modal_dh" role="dialog" aria-hidden="false">  
    <div class="modal-dialog" style="width: 35%;padding: 0px">
        <div class="modal-content">
            <form method="post" action="<?=base_url("Rapat/cetakDH")?>" target="_blank" enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                  <h5><b>CETAK DAFTAR HADIR</b></h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group">      
                            <label class="col-md-6 control-label">Tampilkan Semua</label>
                            <div class="col-md-2">
                                <input type="checkbox" name="tampilkan_acara" class="form-control text-center">
                            </div>
                        </div>
                        <div class="form-group">      
                            <label class="col-md-6 control-label">Tampilkan Hanya (Hari, Tgl, Tempat, Acara) Saja</label>
                            <div class="col-md-2">
                                <input type="checkbox" name="tampilkan_hny_hari" class="form-control text-center">
                            </div>
                        </div>
                        <input name="id_rapat" id="id_rapat" type="hidden">
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
            <form method="post" action="<?=base_url("Rapat/cetak_sspd")?>" target="_blank" enctype="multipart/form-data" class="form-horizontal">
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
                        <input name="id_rapat" id="id_rapat_sspd" type="hidden">
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

$("#cetakKwi").click(function(){
    idRapat = $("#idRapat").val();
     
    // $('#idRapat').val(idRapat);
    // $("#modal_kwi").modal("show");
    window.open("<?= base_url()?>Rapat/cetakKwi?id="+idRapat);
});

$("#cetakDH").click(function(){
    idRapat = $("#idRapat").val();
     
    $('#id_rapat').val(idRapat);
    $("#modal_dh").modal("show");
});

$("#cetakSSPD").click(function(){
    idRapat = $("#idRapat").val();
     
    $('#id_rapat_sspd').val(idRapat);
    $("#modal_sspd").modal("show");
});

$("#cetakSU").click(function(){
    idRapat = $("#idRapat").val();
     
    window.open("<?= base_url()?>Rapat/cetakSU?id="+idRapat);
});

$("#lapRapat").click(function(){
    idRapat = $("#idRapat").val();
     
    window.open("<?= base_url()?>Rapat/lapRapat?id="+idRapat);
});

</script>