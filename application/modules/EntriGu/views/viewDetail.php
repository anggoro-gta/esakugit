<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Detail Entry GU</div>
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
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; $total=0;?>
                                <?php foreach($detail as $val) :?>
                                    <tr>
                                        <td style="text-align: center" ><?php echo $no++;?></td>
                                        <td><?=$val['nama_bagian']?></td>
                                        <td><?=$val['nama_kegiatan_bappeda']?></td>
                                        <td style="text-align: right"><?=number_format($val['jumlah'])?></td>
                                    </tr>
                                    <?php $total += $val['jumlah'];?>
                                <?php endforeach;?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align: right"><b>TOTAL</b></td>
                                    <td style="text-align: right"><b><?=number_format($total)?></b></td>
                                </tr>
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