<section class="content-header">
    <div class="row">
        <div class="col-md-12">
            <div class="judul">Laporan Seluruh GU</div>
        </div>
    </div>
</section>
<section class="content_section">
    <div class="content_spacer">
        <div class="content">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well">
                        <div class="pull-right">
                            <form action="<?=base_url()?>Laporan/pdfSeluruhGu" method="post" class="form-horizontal" target="_blank">
                                <button title="Cetak PDF" class="btn btn-sm btn-warning" target="_blank"><i class="glyphicon glyphicon-print"></i> Pdf</button>
                                <a title="Download Excel" class="btn btn-sm btn-warning" id="cetakExcel" ><i class="glyphicon glyphicon-download"></i> Excel</a>
                            </form>
                        </div>
                    </div>
                    <div class="box-content">  
                        <div class="table-responsive">                     
                            <table class="table table-bordered table-striped" id="example2">
                                <thead>
                                    <tr>
                                        <th width="5%" rowspan="2" style="vertical-align: middle;text-align: center;">No</th>
                                        <th rowspan="2" style="vertical-align: middle;text-align: center;">Bagian</th>
                                        <th rowspan="2" style="vertical-align: middle;text-align: center;">Kegiatan</th>
                                        <th colspan="<?=count($arrEntriGu)?>" style="text-align: center;">Nama GU</th>                                        
                                    </tr>
                                    <tr>
                                        <?php foreach ($arrEntriGu as $val): ?>
                                            <th style="text-align: center;"><?= $val['nama']; ?></th>
                                        <?php endforeach; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach ($arrKegBappeda as $keg): ?>
                                    <tr>
                                        <td style="text-align: center;"><?= $no++; ?></td>
                                        <td style="text-align: center;"><?= $keg->nama_bagian; ?></td>
                                        <td><?= $keg->kegiatan; ?></td>
                                        <?php foreach ($arrEntriGu as $cek): ?>
                                            <?php if($arrDetailGu[$cek['id']][$keg->id]): ?>
                                                <td style="text-align: center;<?=$arrDetailGu[$cek['id']][$keg->id]->warna_laporan?>" ></td>
                                            <?php else: ?>
                                                <td style="text-align: center;"></td>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>                   
                            </table>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">                    
        <table class=" table-striped">
            <tr>
                <td width="22%" style="text-align: right"><b>Masuk</b></td>
                <td style="text-align: center" width="3%"><b>:</b></td>
                <td width="22%"><a style="color: purple"><b>Ungu</b></a></td>
                <td width="22%" style="text-align: right"><b>Selesai</b></td>
                <td align="center" style="text-align: center" width="3%"><b>:</b></td>
                <td width="22%"><a style="color: green"><b>Hijau</b></a></td>
            </tr>
            <tr>
                <td width="22%" style="text-align: right"><b>Belum Selesai</b></td>
                <td style="text-align: center" width="3%"><b>:</b></td>
                <td width="22%"><a style="color: red"><b>Merah</b></a></td>
                <td style="text-align: right"><b>Selesai Scan</b></td>
                <td style="text-align: center" ><b>:</b></td>
                <td><a style="color: blue"><b>Biru</b></a></td>
            </tr>
            <tr>
                <td style="text-align: right"><b>Revisi</b></td>
                <td style="text-align: center" width="3%"><b>:</b></td>
                <td><a style="color: yellow"><b>Kuning</b></a></td>
            </tr>
        </table>
    </div>
</section>
<script type="text/javascript">
$(document).ready(function() {
    $("#cetakExcel").click(function(){        
        window.location.href="<?= base_url()?>Laporan/excelSeluruhGu";  
    });

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