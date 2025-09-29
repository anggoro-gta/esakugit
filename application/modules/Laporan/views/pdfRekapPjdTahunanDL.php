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
                    <th colspan="29">REKAP BIAYA PERJALANAN DINAS LUAR DAERAH</th> 
                </tr>
                <tr>
                    <th colspan="29"><?=empty($fk_bagian_id)?'SEKRETRIAT DAERAH':$bag->nama_bagian?> KABUPATEN KEDIRI TAHUN ANGGARAN <?=$tahun?></th>
                </tr>
                <tr><td colspan="29">&nbsp;</td></tr>
            </table>
            <table border="1" cellspacing="-1" width="100%" style="font-size:9pt;font-family:arial">
                <thead>
                    <tr>
                        <th rowspan="3">No</th>
                        <th rowspan="3">Nama</th>
                        <th rowspan="3">Jabatan</th>
                        <!-- <th rows3an="2">NIP</th> -->
                        <th rowspan="3">Pangkat / Gol</th>
                        <th rowspan="3">No Surat Tugas</th>
                        <th rowspan="3">Kota/Tujuan</th>
                        <th rowspan="3">Tujuan SKPD</th>
                        <th rowspan="3">Acara</th>
                        <th rowspan="3">Tgl Surat Tugas</th>
                        <th colspan="2">Tanggal</th>
                        <th colspan="5">Biaya</th>
                        <th colspan="4">Hotel</th>
                        <th colspan="10" rowspan="2">Transport</th>
                        <th colspan="8" rowspan="2">Tiket Pesawat / Kereta Api</th>
                        <!-- <th rowspan="3">TOTAL</th> -->
                        <th rowspan="3">Pengembalian (Jika ada)</th>
                        <th rowspan="3">Bagian</th>
                        <th rowspan="3">SPJ Bulan</th>
                        <!-- <th rowspan="3">No TBP</th> -->
                        <th rowspan="3">Kegiatan</th>

                       <!--  <th rowspan="2">Dalam Rangka</th>
                        <th rowspan="2">Bagian/Unit</th>
                        <th rowspan="2">Instansi</th>
                        <th rowspan="2">Lama Hari</th>
                        <th rowspan="2">No. Bukti</th>
                        <th rowspan="2">Tgl Bukti</th>
                        <th rowspan="2">Jml Dibayarkan</th>
                        <th colspan="5">Rincian Biaya</th>
                        <th rowspan="2">Penginapan</th>
                        <th colspan="9">Berangkat</th>
                        <th colspan="9">Kembali</th> -->
                    </tr>
                    <tr>
                        <th rowspan="2">Dari</th>
                        <th rowspan="2">Hingga</th>
                        <th rowspan="2">Uang Harian</th>
                        <th rowspan="2">Uang Representasi</th>
                        <th rowspan="2">Taksi</th>
                        <th rowspan="2">Lain-lain</th>
                        <th rowspan="2">Biaya Transport</th>
                        <th rowspan="2">Nama Hotel</th>
                        <th colspan="2">Tanggal</th>
                        <th rowspan="2">Harga</th>
                        <!-- <th rowspan="2">Alat Transportasi</th>
                        <th rowspan="2">Nama Transportasi</th>
                        <th rowspan="2">Tanggal</th>
                        <th rowspan="2">Dari</th>
                        <th rowspan="2">Tujuan</th>
                        <th rowspan="2">Nomor Tiket</th>
                        <th rowspan="2">No. Penerbangan</th>
                        <th rowspan="2">Kode Booking</th>
                        <th rowspan="2">Harga</th>
                        <th rowspan="2">Ket.</th> -->

                        <!-- <th>Pswt/ KA</th>
                        <th>Nomor Tiket</th>
                        <th>Nomor Flight</th>
                        <th>Jam</th>
                        <th>No. tmpt duduk</th>
                        <th>Tanggal</th>
                        <th>Asal</th>
                        <th>Tujuan</th>
                        <th>Harga</th>
                        <th>Pswt/ KA</th>
                        <th>Nomor Tiket</th>
                        <th>Nomor Flight</th>
                        <th>Jam</th>
                        <th>No. tmpt duduk</th>
                        <th>Tanggal</th>
                        <th>Asal</th>
                        <th>Tujuan</th>
                        <th>Harga</th> -->
                    </tr>
                    <tr>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Alat Transportasi Brgkt</th>
                        <th>Nama Transportasi Brgkt</th>
                        <th>Berangkat Dari</th>
                        <th>Tujuan Berangkat</th>
                        <th>Harga Sewa</th>
                        <th>Keterangan</th>
                        <th>Alat Transportasi Kembali</th>
                        <th>Nama Transportasi Kembali</th>
                        <th>Kembali Dari</th>
                        <th>Tujuan Kembali</th>
                        <th>No Tiket Brgkt</th>
                        <th>No Penerbangan Brgkt</th>
                        <th>Kode Booking</th>
                        <th>Harga Brgkt</th>
                        <th>No Tiket Kembali</th>
                        <th>No Penerbangan Kembali</th>
                        <th>Kode Kembali</th>
                        <th>Harga Kembali</th>
                    </tr>
                    <!-- <tr>
                        <th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th><th>9</th><th>10</th>
                        <th>11</th><th>12</th><th></th><th>13</th><th>14</th><th>15</th><th>16</th><th>17</th><th>18</th><th>19</th><th>20</th>
                        <th>21</th><th>22</th><th>23</th><th>24</th><th>25</th><th>26</th><th>27</th><th>28</th>
                    </tr> -->
                </thead>
                <tbody>
                    <?php $no=1; foreach ($hasil as $val): ?>
                        <tr>
                            <td valign="top" align="center"><?=$no++;?></td>
                            <td valign="top"><?=$val->nama_sdm;?></td>
                            <td valign="top"><?=$val->jabatan;?></td>
                            <!-- <td valign="top"><?=$val->nip;?></td> -->
                            <td valign="top" align="center">
                                <?php 
                                    // $gl=explode('(', $val->pangkat_gol);
                                    // $gll=explode(')', $gl[1]);
                                    // echo $gll[0];
                                    echo $val->pangkat_gol;
                                ?>
                            </td>                            
                            <td valign="top">094/<?=$val->no_surat_tugas;?>/418.54/<?=$val->tahun?></td>
                            <td valign="top"><?=$val->kota;?></td>
                            <td valign="top"><?=$val->tujuan_skpd;?></td>
                            <td valign="top"><?=$val->acara;?></td>
                            <td valign="top"><?=$val->tgl_surat_tugas;?></td>
                            <td valign="top"><?=$val->tgl_berangkat;?></td>
                            <td valign="top"><?=$val->tgl_tiba;?></td>
                            <td valign="top" align="right"><?=$val->total_uang_harian;?></td>
                            <td valign="top" align="right"><?=$val->tot_representasi;?></td>
                            <td></td>
                            <td></td>
                            <td valign="top" align="right"><?=$val->transport;?></td>
                            <td valign="top" ><?=$val->nama_hotel;?></td>
                            <td valign="top" ><?=$val->tgl_check_in;?></td>
                            <td valign="top" ><?=$val->tgl_check_out;?></td>
                            <td valign="top" align="right"><?=$val->harga_hotel;?></td>
                            <td valign="top"><?=$val->alat_transport_brk;?></td>
                            <td valign="top"><?=$val->nama_transport_brk;?></td>
                            <td valign="top"><?=$val->dari_brk;?></td>
                            <td valign="top"><?=$val->tujuan_brk;?></td>
                            <td valign="top"><?=$val->harga_sewa;?></td>
                            <td valign="top"><?=$val->keterangan;?></td>
                            <td valign="top"><?=$val->alat_transport_plg;?></td>
                            <td valign="top"><?=$val->nama_transport_plg;?></td>
                            <td valign="top"><?=$val->dari_plg;?></td>
                            <td valign="top"><?=$val->tujuan_plg;?></td>
                            <td valign="top"><?=$val->no_tiket_brk;?></td>
                            <td valign="top"><?=$val->no_penerbangan_brk;?></td>
                            <td valign="top"><?=$val->kode_booking_brk;?></td>
                            <td valign="top"><?=$val->harga_brk;?></td>
                            <td valign="top"><?=$val->no_tiket_plg;?></td>
                            <td valign="top"><?=$val->no_penerbangan_plg;?></td>
                            <td valign="top"><?=$val->kode_booking_plg;?></td>
                            <td valign="top"><?=$val->harga_plg;?></td>
                            <td></td>
                            <td valign="top"><?=$val->nama_bagian;?></td>
                            <td valign="top"><?=$this->help->namaBulan($val->bulan);?></td>
                            <!-- <td valign="top" class="str"><?=$val->info_no_bku;?></td> -->
                            <td valign="top"><?=$val->kegiatan;?></td>
                            
                            <!-- <td valign="top"><?=$val->acara;?></td>
                            <td valign="top"><?=$val->nama_bagian;?></td>
                            <td valign="top"><?=$val->tujuan_skpd;?></td>
                            <td valign="top"><?=$val->lama_hari;?></td>
                            <td valign="top"><?=$val->no_tbk;?></td>
                            <td valign="top"><?=$val->tgl_rincian;?></td>
                            <td valign="top" align="right"><?=$val->total_akhir;?></td>
                            <td valign="top" align="right"></td>
                            <td valign="top" align="right"><?=$val->penginapan;?></td>
                            <td valign="top" align="right"></td>
                            <td valign="top" align="right"></td>
                            <td valign="top" align="right"></td>
                            <td valign="top" align="right"></td>
                            <td valign="top" align="right"></td>
                            <td valign="top" align="right"></td>
                            <td valign="top" align="right"></td>
                            <td valign="top" align="right"></td>
                            <td valign="top" align="right"></td>
                            <td valign="top" align="right"></td>
                            <td valign="top" align="right"></td>
                            <td valign="top" align="right"></td>
                            <td valign="top" align="right"></td>
                            <td valign="top" align="right"></td>
                            <td valign="top" align="right"></td>
                            <td valign="top" align="right"></td>
                            <td valign="top" align="right"></td>
                            <td valign="top" align="right"></td> -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- <table style="font-size:10pt;font-family:arial">
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
            </table> -->
        </div>
    </body>
</html>