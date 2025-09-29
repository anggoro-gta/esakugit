<!doctype html>
<html>
    <head>
        <title>Surat Pesanan</title>
    </head>
    <body>
        <div class="responsive">
            <?=$header?>
            <table  width="100%" style="font-size:11pt;line-height: 1.3;font-family:arial" border="0" cellspacing="-1">
                <tr>
                    <td style="width: 100px"></td>
                    <td style="width: 20px"></td>
                    <td style="width: 300px"></td>
                    <td colspan="2">Kediri, 
                        <?php
                            $tglPsn = explode('-', $hasil['tgl_pesanan']);
                            echo $tglPsn[2].' '.$this->help->namaBulan($tglPsn[1]).' '.$tglPsn[0];
                        ?>
                    </td>
                </tr>
                <tr><td>&nbsp;</td></tr>
                <tr>
                    <td>Nomor</td>
                    <td>:</td>
                    <td>021/<?=!empty($hasil['nomor'])?$hasil['nomor']:'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'?>/418.54/<?=$hasil['tahun_anggaran']?></td>
                    <td style="width: 63px">Kepada :</td>
                    <td></td>
                </tr>
                <tr>
                    <td valign="top">Sifat</td>
                    <td valign="top">:</td>
                    <td valign="top">Penting</td>
                    <td valign="top">Yth. Sdr. </td>
                    <td><?=$rekanan['jabatan'].' '.$rekanan['nama_rekanan']?></td>
                </tr>
                <tr>
                    <td>Lampiran</td>
                    <td>:</td>
                    <td>-</td>
                    <td></td>
                    <td><?=$rekanan['alamat']?></td>
                </tr>
                <tr>
                    <td style="vertical-align: top">Perihal</td>
                    <td style="vertical-align: top">:</td>
                    <td style="vertical-align: top"><b><u><?=$hasil['perihal']?></u></b></td>
                    <td></td>
                    <td>di <br><u><?=$rekanan['kab_kota']?></u></td>
                </tr>
                <tr><td>&nbsp;</td></tr>
            </table>
            <table width="100%" style="font-family:arial">
                <tr>
                    <td colspan="2" align="center" style="font-size:13pt;"><b><u>S U R A T  -  P E S A N A N</u></b></td>
                </tr>
                <tr><td></td></tr>
                <tr>
                    <td colspan="2" align="justify" style="font-size:11pt;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Agar dilayani pengadaan <?=$hasil['perihal']?> untuk sub kegiatan <?=$hasil['kegiatan_bappeda']?> pada Bappeda Kabupaten Kediri Tahun Anggaran <?=$hasil['tahun_anggaran']?> dengan rincian sebagai berikut :</td>
                </tr>
                <tr><td></td></tr>
                <tr>
                    <td width="70px"></td>
                    <td>
                        <table border="1" width="90%" cellspacing="-1" style="font-size:10pt;border: 1px solid black; border-collapse: collapse;">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Qty</th>
                                <th>Satuan</th>
                            </tr>
                            <?php $no=1; foreach ($detail as $val): ?>
                                <tr>
                                    <td align="center" width="40px"><?=$no++?></td>
                                    <td><?=$val['nm_brg_gabung']?></td>
                                    <td align="center" width="60px"><?=$val['qty_awal']?></td>
                                    <td align="center" width="150px"><?=$val['satuan']?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </td>
                </tr>
                <br>
                <tr>
                    <td colspan="2" align="justify" style="font-size:11pt;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Demikian untuk menjadikan maklum dan perhatiannya.</td>
                </tr>
            </table>
            <br>
            <table border="0" width="100%" cellspacing="-1" style="font-size:11pt;text-align: center">
                <tr>
                    <td width="50px"></td>
                    <td width="220px"></td>
                    <td width="100px"></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Sanggup Mengerjakan,</td>
                    <td></td>
                    <!-- <td><?=$hasil['jabatan_ppk']?><br> Bappeda Kab. Kediri</td> -->
                    <td>Pemesan,</td>
                </tr>
                <tr>
                    <td></td>
                    <td><?=$rekanan['nama_rekanan']?></td>
                    <td></td>
                    <td>Pejabat Pembuat Komitmen</td>
                    <!-- <td><i>Selaku Pejabat Pembuat Komitmen</i></td> -->
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td></td>
                    <td><b><u><?=$rekanan['nama_pimpinan']?></u></b></td>
                    <td></td>
                    <td><b><u><?=$hasil['nama_ppk']?></u></b></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="padding-top: -3px"><?=$rekanan['jabatan']?></td>
                    <td></td>
                    <td style="padding-top: -3px">NIP. <?=$hasil['nip_ppk']?></td>
                </tr>
            </table>
        </div>
    </body>
</html>
<style type="text/css">
.border_all{
    border: 1px solid #000;
}
.no_border_right{
    border-right: 0px solid #000;
}
.no_border_left{
    border-left: 0px solid #000;
}
.no_border_top{
    border-top: 0px solid #000;
}
.no_border_bottom{
    border-bottom: 0px solid #000;
}
.bordersolid{
    border: 1px solid black; border-collapse: collapse;
}
</style>