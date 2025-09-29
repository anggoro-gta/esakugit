<!doctype html>
<html>
    <head>
        <title>Ddaftar Transaksi Harian Belanja</title>
        <style type="text/css">
        .str{ 
            mso-number-format:\@; 
        }
        </style>
    </head>
    <body>
        <div class="responsive">
            <table width="100%" style="font-size:10pt;font-family:arial">
                <tr><td>&nbsp;</td></tr>
                <tr>
                    <th colspan="15">DAFTAR TRANSAKSI HARIAN BELANJA DAERAH (DTH)</th> 
                </tr>
                <tr>
                    <th colspan="15">KABUPATEN KEDIRI</th>
                </tr>
                <tr>
                    <th colspan="15">BULAN <?=strtoupper($bulan)?></th>
                </tr>
                <tr>
                    <th colspan="15">TAHUN ANGGARAN <?=$tahun?></th>
                </tr>
                <tr><td colspan="15">&nbsp;</td></tr>
                <tr>
                    <td colspan="15"><b>SKPD : BADAN PERENCANAAN PEMBANGUNAN DAERAH</b></td>
                </tr>
            </table>
            <table border="1" class="bordersolid" cellspacing="-1" width="100%" style="font-size:9pt;font-family:arial">
                <thead>
                    <tr>
                        <th rowspan="2">NO.</th>
                        <th rowspan="2">URAIAN</th>
                        <th colspan="2">SPM/SPD</th>
                        <th colspan="2">SP2D</th>
                        <th rowspan="2">KODE AKUN BELANJA</th>
                        <th colspan="3">POTONGAN PAJAK</th>
                        <th rowspan="2">NPWP REKANAN/ BENDAHARA</th>
                        <th rowspan="2">NAMA REKANAN/ BENDAHARA</th>
                        <th colspan="3">KETERANGAN</th>
                    </tr>
                    <tr>
                        <th>NOMOR</th>
                        <th>NILAI BELANJA</th>
                        <th>NOMOR</th>
                        <th>NILAI BELANJA</th>
                        <th>KODE AKUN</th>
                        <th>JENIS PAJAK</th>
                        <th>JUMLAH (Rp)</th>
                        <th>NTPN</th>
                        <th>ID BILLING</th>
                        <th>TANGGAL</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $npwpBappeda = '001254119655000';
                    ?>
                    <?php $no=1; foreach ($hasil as $val) { ?>
                        <?php if(intval($val->ppn_skrg) > 0){ ?>
                            <tr>
                                <td align="center"><?=$no++?></td>
                                <td><?=$val->nama_rek_belanja?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td align="center" class="str"><?=$val->kode_rek_belanja?></td>
                                <td align="center">411211</td>
                                <td align="center">PPN</td>
                                <td align="right"><?=$val->ppn_skrg?></td>
                                <td align="center" class="str"></td>
                                <td align="center"></td>
                                <td></td>
                                <td></td>
                                <td><?=$val->tgl_pencairan?></td>
                            </tr>
                        <?php } ?>
                        <?php if(intval($val->pph21_skrg) > 0){ ?>
                            <tr>
                                <td align="center"><?=$no++?></td>
                                <td><?=$val->nama_rek_belanja?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td align="center" class="str"><?=$val->kode_rek_belanja?></td>
                                <td align="center">411121</td>
                                <td align="center">PPH 21</td>
                                <td align="right"><?=$val->pph21_skrg?></td>
                                <td align="center" class="str"></td>
                                <td align="center"></td>
                                <td></td>
                                <td></td>
                                <td><?=$val->tgl_pencairan?></td>
                            </tr>
                        <?php } ?>
                        <?php if(intval($val->pph22_skrg) > 0){ ?>
                            <tr>
                                <td align="center"><?=$no++?></td>
                                <td><?=$val->nama_rek_belanja?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td align="center" class="str"><?=$val->kode_rek_belanja?></td>
                                <td align="center">411122</td>
                                <td align="center">PPH 22</td>
                                <td align="right"><?=$val->pph22_skrg?></td>
                                <td align="center" class="str"></td>
                                <td align="center"></td>
                                <td></td>
                                <td></td>
                                <td><?=$val->tgl_pencairan?></td>
                            </tr>
                        <?php } ?>
                        <?php if(intval($val->pph23_skrg) > 0){ ?>
                            <tr>
                                <td align="center"><?=$no++?></td>
                                <td><?=$val->nama_rek_belanja?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td align="center" class="str"><?=$val->kode_rek_belanja?></td>
                                <td align="center">411124</td>
                                <td align="center">PPH 23</td>
                                <td align="right"><?=$val->pph23_skrg?></td>
                                <td align="center" class="str"></td>
                                <td align="center"></td>
                                <td></td>
                                <td></td>
                                <td><?=$val->tgl_pencairan?></td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
<style type="text/css">
    .bordersolid{
        border: 1px solid black; border-collapse: collapse;
    }
</style>