<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Detail Pesanan Barang</div>
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
                <div class="panel panel-default">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <td style="text-align: right" class="col-md-2"><b>Tgl Pesanan</b></td>
                                <th>:</th>
                                <td class="col-md-4"><?=  $this->help->ReverseTgl($hsl['tgl_pesanan']); ?> </td>
                                <td style="text-align: right" class="col-md-2"><b>Bagian</b></td>
                                <th>:</th>
                                <td class="col-md-5"><?= $Bagian[0]['nama_bagian']; ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><b>Nomor</b></td>
                                <th>:</th>
                                <td><?= $hsl['nomor']; ?> </td>
                                <td style="text-align: right"><b>Program</b></td>
                                <th>:</th>
                                <td><?= $hsl['nama_program']; ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><b>Perihal Pengadaan</b></td>
                                <th>:</th>
                                <td><?= $hsl['perihal']; ?> </td>
                                <td style="text-align: right"><b>Kegiatan Bappeda</b></td>
                                <th>:</th>
                                <td><?= $hsl['kegiatan_bappeda']; ?></td>
                            </tr>                            
                            <tr>
                                <td style="text-align: right"><b>Nama Rekanan</b></td>
                                <th>:</th>
                                <td><?= $rekanan[0]['nama_rekanan']; ?></td>
                                <td style="text-align: right"><b>PPK</b></td>
                                <th>:</th>
                                <td><?= $hsl['nama_ppk']; ?> </td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><b>No Kontrak</b></td>
                                <th>:</th>
                                <td><?= $hsl['no_kontrak']; ?></td>
                                <td style="text-align: right"><b>Tgl Kontrak</b></td>
                                <th>:</th>
                                <td><?= $this->help->ReverseTgl($hsl['tgl_kontrak']); ?> </td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><b>Nilai Kontrak</b></td>
                                <th>:</th>
                                <td style="background-color: yellow; color: black"><?= number_format($hsl['nilai_kontrak']); ?></td>
                                <td style="text-align: right"><b>Tgl Verifikasi</b></td>
                                <th>:</th>
                                <td><?= $this->help->ReverseTgl($hsl['tgl_brg_dtg']); ?> </td>
                            </tr>                            
                            <tr>
                                <td style="text-align: right"><b>Tgl Kuitansi</b></td>
                                <th>:</th>
                                <td><?= $this->help->ReverseTgl($hsl['tgl_kuitansi']); ?> </td>
                                <td style="text-align: right"><b></b></td>
                                <th></th>
                                <td></td>
                            </tr>                           
                            <tr>
                                <td style="text-align: right"><b>No Kuitansi</b></td>
                                <th>:</th>
                                <td><?= $hsl['no_kuitansi']; ?> </td>
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
                                <?php if($hsl['terima_pesanan']==0): ?>
                                <tr>
                                    <th style="vertical-align: middle;" class="text-center" width="5%">No</th>
                                    <th style="vertical-align: middle;" class="text-center">Nama</th>
                                    <th style="vertical-align: middle;" class="text-center" width="10%">Qty</th>
                                    <th style="vertical-align: middle;" class="text-center" width="35%">Satuan</th>
                                </tr>
                                <?php else: ?>
                                <tr>
                                    <th style="vertical-align: middle;" rowspan="2" class="text-center" width="3%">No</th>
                                    <th style="vertical-align: middle;" rowspan="2" class="text-center" width="30%">Nama</th>
                                    <th style="vertical-align: middle;" rowspan="2" class="text-center" width="5%">Qty Awal</th>
                                    <th style="vertical-align: middle;" rowspan="2" class="text-center" width="10%">Satuan</th>
                                    <th style="vertical-align: middle;" colspan="2" class="text-center" width="25%">Std Harga Satuan</th>
                                    <th style="vertical-align: middle;" colspan="4" class="text-center" width="20%">Verifikasi</th>
                                </tr>
                                <tr>
                                    <th class="text-center">Minimal</th>
                                    <th class="text-center">Mak. (SSH + PPN)</th>
                                    <th class="text-center" width="7%">Qty</th>
                                    <th class="text-center">Harga Satuan</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Status</th>
                                </tr>
                                <?php endif; ?>
                            </thead>
                            <tbody>
                                <?php $no=1; $grandTotal=0; $grandQtyAwl=0; $grandQtyAkhr=0;?>
                                <?php foreach((array)$detail as $val) :?>
                                    <tr>
                                        <td style="text-align: center" ><?php echo $no++;?></td>
                                        <td><?=$val['nm_brg_gabung']?></td>
                                        <td style="text-align: center"><?= $val['qty_awal']?></td>
                                        <?php $grandQtyAwl += $val['qty_awal']; ?>
                                        <td style="text-align: center"><?=$val['satuan']?></td>
                                        <?php if($hsl['terima_pesanan']==1): ?>
                                            <td style="text-align: center"><?=number_format($val['harga_minimal'])?></td>
                                            <td style="text-align: center"><?=number_format($val['harga_maksimal'])?></td>
                                            <td style="text-align: center"><?=$val['qty_akhir']?></td>
                                            <td style="text-align: center"><?=number_format($val['harga_satuan_beli'])?></td>
                                            <?php
                                                $total = $val['harga_satuan_beli']*$val['qty_akhir'];
                                                $grandTotal += $total;
                                                $grandQtyAkhr += $val['qty_akhir'];
                                            ?>
                                            <td style="text-align: right"><?=number_format($total)?></td>
                                            <?php
                                                $bgClr='red';
                                                $stt='X';
                                                if($val['status_verifikasi']==1){
                                                    $bgClr='green';
                                                    $stt='V';
                                                }
                                            ?>
                                            <td style="text-align: center;background-color: <?=$bgClr?>;color:white"><b><?=$stt?></b></td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach;?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align: center"><?=$grandQtyAwl?></td>
                                    <td></td>
                                    <?php if($hsl['terima_pesanan']==1): ?>
                                        <td></td>
                                        <td></td>
                                        <td style="text-align: center"><?=$grandQtyAkhr?></td>
                                        <td></td>
                                        <td style="text-align: right;background-color: yellow; color: black"><?=number_format($grandTotal)?></td>
                                        <td></td>
                                    <?php endif; ?>
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