<!doctype html>
<html>
    <head>
        <title>Rekap Pjd Tahunan</title>
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
                    <th colspan="29">REKAP BIAYA PERJALANAN DINAS LUAR DAERAH PADA BAPPEDA</th> 
                </tr>
                <tr>
                    <th colspan="29">KABUPATEN KEDIRI TAHUN ANGGARAN <?=$tahun?></th>
                </tr>
                <tr><td colspan="29">&nbsp;</td></tr>
            </table>
            <table border="1" cellspacing="-1" width="100%" style="font-size:9pt;font-family:arial">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>No Surat Tugas</th>
                        <th>Tgl Surat Tugas</th>
                        <th>Tgl Berangkat</th>
                        <th>Tgl Tiba</th>
                        <th>No BKU</th>
                        <th>Bagian</th>
                        <th>Jml<br>Hari</th>
                        <th>Sub Kegiatan</th>
                        <th>Kota/Tujuan</th>
                        <th>Tujuan SKPD</th>
                        <th>Maksud/Tujuan<br>Perjalanan Dinas</th>
                        <th>Uang Harian</th>
                        <th>Uang Representasi</th>
                        <th>Transpotasi<br>Lokal/Taksi</th>
                        <th>Uang Kontribusi<br>(Jika Ditanggung Panitia)</th>
                        <th>BBM (Jika<br>Jln Darat)</th>
                        <th>Maskapai Penerbangan</th>
                        <th>Nomor Tiket</th>
                        <th>Kode Booking</th>
                        <th>No Penerbangan</th>
                        <th>Tempat<br>Asal</th>
                        <th>Tempat<br>Tujuan</th>
                        <th>Tgl<br>Terbang</th>
                        <th>Harga<br>Tiket</th>
                        <th>Nama<br>Hotel</th>
                        <th>Alamat<br>Hotel</th>
                        <th>No Tlp<br>Hotel</th>
                        <th>Tgl<br>Check In</th>
                        <th>Tgl<br>Check Out</th>
                        <th>Total Bill<br>Yang Dibayarkan</th>
                        <th>NO Kamar</th>
                        <th>No Invoice</th>
                        <th>Total<br>Biaya</th>
                        <th>Total SPJ Yang<br>Dibayarkan oleh<br>Bendahara Pengeluaran</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach ($hasil as $val): ?>
                        <tr>
                            <td valign="top" align="center"><?=$no++;?></td>
                            <td valign="top"><?=$val->nama_sdm;?></td>
                            <td valign="top"><?=$val->no_surat_tugas;?></td>
                            <td valign="top"><?=$val->tgl_surat_tugas;?></td>
                            <td valign="top"><?=$val->tgl_berangkat;?></td>
                            <td valign="top"><?=$val->tgl_tiba;?></td>
                            <td valign="top" class="str"><?=$val->no_bku;?></td>
                            <td valign="top"><?=$val->nama_bagian;?></td>
                            <td valign="top"><?=$val->lama_hari;?></td>
                            <td valign="top"><?=$val->kegiatan_bappeda;?></td>  
                            <td valign="top"><?=$val->kota;?></td>
                            <td valign="top"><?=$val->tujuan_skpd;?></td>
                            <td valign="top"><?=$val->acara;?></td>
                            <td valign="top" align="right"><?=$val->total_uang_harian;?></td>
                            <td valign="top" align="right"><?=$val->tot_representasi;?></td>                           
                            <td></td>
                            <td></td>
                            <td valign="top" align="right"><?=$val->transport;?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td valign="top" align="right"><?=$val->penginapan;?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><?=$val->total_uang_harian+$val->tot_representasi+$val->transport+$val->penginapan;?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <table style="font-size:10pt;font-family:arial">
                <tr><td>&nbsp;</td></tr>
                <tr>
                    <td colspan="31"></td>
                    <td align="center" colspan="4"><?=$kepala['jabatan'].' KABUPATEN KEDIRI'?></td>
                </tr>
                <tr><td>&nbsp;</td></tr>
                <tr><td>&nbsp;</td></tr>
                <tr><td>&nbsp;</td></tr>
                <tr>
                    <td colspan="31"></td>
                    <td align="center" colspan="4"><u><?=$kepala['nama']?></u></td>
                </tr>
                <tr>
                    <td colspan="31"></td>
                    <td align="center" colspan="4"><?=$kepala['nip']?></td>
                </tr>
            </table>
        </div>
    </body>
</html>