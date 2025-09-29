 <section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Detail Perjalanan Dinas</div>
            <h1>
                <a href="<?=base_url()?>Pjd" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-list-alt"></i> Tabel Data</a>
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
                                <td style="text-align: right" class="col-md-2"><b>Kategori</b></td>
                                <th>:</th>
                                <td class="col-md-4"><?= $hsl['kategori']; ?> </td>
                                <td style="text-align: right" class="col-md-2"><b>Tgl Berangkat</b></td>
                                <th>:</th>
                                <td class="col-md-5"><?= $this->help->ReverseTgl($hsl['tgl_berangkat']); ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><b>Bulan</b></td>
                                <th>:</th>
                                <td><?= $this->help->namaBulan($hsl['bulan']); ?> </td>
                                <td style="text-align: right"><b>Tgl Tiba</b></td>
                                <th>:</th>
                                <td><?= $this->help->ReverseTgl($hsl['tgl_tiba']); ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><b>No Surat Tugas</b></td>
                                <th>:</th>
                                <td><?= $hsl['no_surat_tugas']; ?> </td>
                                <td style="text-align: right"><b>Tgl Rincian</b></td>
                                <th>:</th>
                                <td><?= $this->help->ReverseTgl($hsl['tgl_rincian']); ?></td>
                            </tr>                            
                            <tr>
                                <td style="text-align: right"><b>Tgl Surat Tugas</b></td>
                                <th>:</th>
                                <td><?= $this->help->ReverseTgl($hsl['tgl_surat_tugas']); ?></td>
                                <td style="text-align: right"><b>No BKU</b></td>
                                <th>:</th>
                                <td><?= $hsl['no_bku']; ?> </td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><b>Dasar Surat Tugas</b></td>
                                <th>:</th>
                                <td><?=$hsl['dasar_surat_tugas']; ?></td>
                                <td style="text-align: right"><b>TTD Surat Tugas</b></td>
                                <th>:</th>
                                <td><?= $hsl['nama_ttd_surat_tugas']; ?> </td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><b>Kab/Kota</b></td>
                                <th>:</th>
                                <td><?=$hsl['kota']; ?></td>
                                <td style="text-align: right"><b>TTD SPPD</b></td>
                                <th>:</th>
                                <td><?= $hsl['nama_ttd_sppd']; ?> </td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><b>Tujuan SKPD</b></td>
                                <th>:</th>
                                <td><?=$hsl['tujuan_skpd']; ?></td>
                                <td style="text-align: right"><b>Bagian</b></td>
                                <th>:</th>
                                <td><?= $hsl['nama_bagian']; ?> </td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><b>Alat Transportasi</b></td>
                                <th>:</th>
                                <td><?=$hsl['alat_transportasi']; ?></td>
                                <td style="text-align: right"><b>Kegiatan</b></td>
                                <th>:</th>
                                <td><?= $hsl['nama_program']; ?> </td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><b>Acara</b></td>
                                <th>:</th>
                                <td><?=$hsl['acara']; ?></td>
                                <td style="text-align: right"><b>Sub Kegiatan</b></td>
                                <th>:</th>
                                <td><?= $hsl['kegiatan_bappeda']; ?> </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align: right"><b>Surat Pernyataan DL</b></td>
                                <th>:</th>
                                <td>Berangkat = <b><?=$hsl['tgl_sp_berangkat']?></b>, Kembali = <b><?=$hsl['tgl_sp_kembali']?></b></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="table-responsive">                     
                        <table class="table table-bordered table-striped" id="example2">
                            <thead>
                                <tr>
                                    <th style="vertical-align: middle;" rowspan="2" class="text-center" width="5%">No</th>
                                    <th style="vertical-align: middle;" rowspan="2" class="text-center">Nama</th>
                                    <th style="vertical-align: middle;" colspan="5" class="text-center" width="35%">Uang Harian</th>
                                    <th style="vertical-align: middle;" rowspan="2" class="text-center" width="10%">Transport</th>
                                    <th style="vertical-align: middle;" rowspan="2" class="text-center" width="10%">Penginapan</th>
                                    <th style="vertical-align: middle;" rowspan="2" class="text-center" width="10%">Total Akhir</th>
                                    <th style="vertical-align: middle;" rowspan="2" class="text-center" width="10%">Kontribusi</th>
                                </tr>
                                <tr>
                                    <th class="text-center">Tarif</th>
                                    <th class="text-center">%</th>
                                    <th class="text-center">Representasi</th>
                                    <th class="text-center">Hari</th>
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1;?>
                                <?php foreach((array)$detail as $val) :?>
                                    <tr>
                                        <td style="text-align: center" ><?php echo $no++;?></td>
                                        <td><?=$val['nama_sdm']?></td>
                                        <td style="text-align: right"><?= number_format($val['tarif'])?></td>
                                        <td style="text-align: center"><?=$val['persen']?></td>
                                        <td style="text-align: center"><?= empty($val['representasi'])?'':number_format($val['representasi']);?></td>
                                        <td style="text-align: center"><?=$val['hari']?></td>
                                        <td style="text-align: right"><?=number_format($val['total'])?></td>
                                        <td style="text-align: right"><?= empty($val['transport'])?'':number_format($val['transport']);?></td>
                                        <td style="text-align: right"><?= empty($val['penginapan'])?'':number_format($val['penginapan']);?></td>
                                        <td style="text-align: right"><?=number_format($val['total_akhir'])?></td>
                                        <td style="text-align: right"><?= empty($val['kontribusi'])?'':number_format($val['kontribusi']);?></td>
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