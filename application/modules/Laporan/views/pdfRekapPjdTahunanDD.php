<!doctype html>
<html>
    <head>
        <title>Rekap Pjd Tahunan</title>
    </head>
    <body>
        <div class="responsive">
            <table width="100%" style="font-size:10pt;font-family:arial">
                <tr><td>&nbsp;</td></tr>
                <tr>
                    <th colspan="17">REKAP BIAYA PERJALANAN DINAS DALAM DAERAH</th> 
                </tr>
                <tr>
                    <th colspan="17"><?=empty($fk_bagian_id)?'SEKRETRIAT DAERAH':$bag->nama_bagian?> KABUPATEN KEDIRI</th>
                </tr>
                <tr>
                    <th colspan="17">TAHUN ANGGARAN <?=$tahun?></th>
                </tr>
                <tr><td colspan="17">&nbsp;</td></tr>
            </table>
            <table border="1" cellspacing="-1" width="100%" style="font-size:9pt;font-family:arial">
                <thead>
                    <tr>
                        <th rowspan="3">No</th>
                        <th rowspan="3">No. TBK</th>
                        <th rowspan="3">Tanggal</th>
                        <th rowspan="3">No ST</th>
                        <th rowspan="3">Tgl ST</th>
                        <th rowspan="3">Bagian</th>
                        <th rowspan="3">Moda Transportasi</th>
                        <th rowspan="3">Nama</th>
                        <th rowspan="3">NIP</th>
                        <th rowspan="3">Keperluan</th>
                        <th rowspan="3">Jumlah Dibayarkan</th>
                        <th rowspan="3">Gol. Peg</th>
                        <th rowspan="3">Tujuan</th>
                        <th colspan="3">SPPD</th>
                        <th colspan="5">Rincian Biaya</th>
                    </tr>
                    <tr>
                        <th colspan="2">Tanggal</th>
                        <th rowspan="2">Lama Hari</th>
                        <th colspan="2">Uang Harian</th>
                        <th rowspan="2">Transport</th>
                        <th rowspan="2">Biaya Lain</th>
                        <th rowspan="2">Jumlah</th>
                    </tr>
                    <tr>
                        <th>Berangkat</th>
                        <th>Kembali</th>
                        <th>Per Hari</th>
                        <th>Total</th>
                    </tr>
                    <!-- <tr>
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                        <th>5</th>
                        <th>6</th>
                        <th>7</th>
                        <th>8</th>
                        <th>9</th>
                        <th>10</th>
                        <th>11</th>
                        <th>12</th>
                        <th>13</th>
                        <th>14</th>
                        <th>15</th>
                        <th>16</th>
                        <th>17=14+15+16</th>
                    </tr> -->
                </thead>
                <tbody>
                    <?php $no=1; foreach ($hasil as $val): ?>
                        <tr>
                            <td valign="top" align="center"><?=$no++;?></td>
                            <td valign="top"><?=$val->no_tbk;?></td>
                            <td valign="top"><?=$val->tgl_rincian;?></td>
                            <td valign="top"><?=$val->no_surat_tugas;?></td>
                            <td valign="top"><?=$val->tgl_surat_tugas;?></td>
                            <td valign="top"><?=$val->nama_bagian;?></td>
                            <td valign="top"><?=$val->alat_transportasi;?></td>
                            <td valign="top"><?=$val->nama_sdm;?></td>
                            <td valign="top"><?=$val->nip;?></td>
                            <td valign="top"><?=$val->acara;?></td>
                            <td valign="top" align="right"><?=$val->total_akhir;?></td>
                            <td valign="top" align="center">
                                <?php 
                                    $gl=explode('(', $val->pangkat_gol);
                                    $gll=explode(')', $gl[1]);
                                    echo $gll[0];
                                ?>
                            </td>
                            <td valign="top"><?=$val->tujuan_skpd;?></td>
                            <td valign="top"><?=$val->tgl_berangkat;?></td>
                            <td valign="top"><?=$val->tgl_tiba;?></td>
                            <td valign="top"><?=$val->lama_hari;?></td>
                            <td valign="top" align="right"><?=$val->tarif_persen;?></td>
                            <td valign="top" align="right"><?=$val->total;?></td>
                            <td valign="top" align="right"><?=$val->transport;?></td>
                            <td valign="top" align="right">-</td>
                            <td valign="top" align="right"><?=$val->total_akhir;?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- <table style="font-size:10pt;font-family:arial">
                <tr><td>&nbsp;</td></tr>
                <tr>
                    <td colspan="13"></td>
                    <td align="center" colspan="4"><?=$kepala['jabatan'].' KABUPATEN KEDIRI'?></td>
                </tr>
                <tr><td>&nbsp;</td></tr>
                <tr><td>&nbsp;</td></tr>
                <tr><td>&nbsp;</td></tr>
                <tr>
                    <td colspan="13"></td>
                    <td align="center" colspan="4"><u><?=$kepala['nama']?></u></td>
                </tr>
                <tr>
                    <td colspan="13"></td>
                    <td align="center" colspan="4"><?=$kepala['nip']?></td>
                </tr>
            </table> -->
        </div>
    </body>
</html>