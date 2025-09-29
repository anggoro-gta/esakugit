<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Detail Data Entry</div>
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
                <div class="panel panel-default">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <td style="text-align: right" class="col-md-2"><b>Nomor</b></td>
                                <th>:</th>
                                <td class="col-md-4"><?= $entrySpj->nomor; ?> </td>
                                <td style="text-align: right" class="col-md-1"><b>Bulan</b></td>
                                <th>:</th>
                                <td class="col-md-5"><?= $this->help->namaBulan($entrySpj->bulan); ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: right" class="col-md-2"><b>Bagian</b></td>
                                <th>:</th>
                                <td><?= $entrySpj->nama_bagian; ?></td>
                                <td style="text-align: right"><b>Kegiatan</b></td>
                                <th>:</th>
                                <td><?= $entrySpj->nama_program; ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><b>Sub Kegiatan</b></td>
                                <th>:</th>
                                <td colspan="4"><?= $entrySpj->kegiatan; ?></td>
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
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1;?>
                                <?php foreach($detail as $val) :?>
                                    <tr>
                                        <td style="text-align: center" ><?php echo $no++;?></td>
                                        <td><?=$val['nama_sdm']?></td>
                                        <td><?=$val['nama_kegiatan_orang']?></td>
                                        <td style="text-align: center"><?=$val['tglnya']?></td>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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
</script>