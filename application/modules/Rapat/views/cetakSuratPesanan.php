<!doctype html>
<html>
    <head>
        <title>Surat Pesanan</title>
    </head>
    <body onload="window.print()" style="margin:1">
        <div class="responsive">
            <div style="padding-top:-23px"><?=$header?></div>
            <table  width="100%" style="font-size:11pt;line-height: 1.3;font-family:arial" border="0" cellspacing="-1">
                <tr>
                    <td style="width: 100px"></td>
                    <td style="width: 20px"></td>
                    <td style="width: 350px"></td>
                    <td colspan="2">Kediri, </td>
                </tr>
                <tr><td>&nbsp;</td></tr>
                <tr>
                    <td>Nomor</td>
                    <td>:</td>
                    <td>021/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/418.54/<?=$hasil['tahun']?></td>
                    <td style="width: 63px">Kepada :</td>
                    <td></td>
                </tr>
                <tr>
                    <td valign="top">Sifat</td>
                    <td valign="top">:</td>
                    <td valign="top">Penting</td>
                    <td valign="top">Yth. Sdr. </td>
                    <td><?=$rekananCatering['nama_pemilik']?></td>
                </tr>
                <tr>
                    <td>Lampiran</td>
                    <td>:</td>
                    <td>-</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="vertical-align: top">Perihal</td>
                    <td style="vertical-align: top">:</td>
                    <td style="vertical-align: top"><b><u>Makan dan Minum Rapat</u></b></td>
                    <td></td>
                    <td>di Tempat</td>
                </tr>
                <tr><td>&nbsp;</td></tr>
            </table>
            <br>
            <br>
            <table width="100%" style="font-family:arial">
                <tr>
                    <td colspan="2" align="center" style="font-size:13pt;"><b><u>S U R A T  -  P E S A N A N</u></b></td>
                </tr>
                <tr><td></td></tr>
                <tr>
                    <td colspan="2" align="justify" style="font-size:11pt;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Agar dilayani pengadaan <?=$hasil['acara']?> untuk sub kegiatan <?=$hasil['kegiatan_bappeda']?> pada Bappeda Kabupaten Kediri Tahun Anggaran <?=$hasil['tahun']?> dengan rincian sebagai berikut :</td>
                </tr>
                <tr><td>&nbsp;</td></tr>
                <tr>
                    <td width="70px"></td>
                    <td>
                        <table border="1" width="90%" cellspacing="-1" style="font-size:10pt;border: 1px solid black; border-collapse: collapse;line-height: 2;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Qty</th>
                                    <th>Satuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; if($hasil['harga_mamin'] > 0){ ?>
                                    <tr>
                                        <td align="center"><?=$no?></td>
                                        <td>Makan dan Minum</td>
                                        <td align="center"><?=$hasil['jml_peserta']?></td>
                                        <td align="center">Orang</td>
                                    </tr>
                                <?php $no++; } ?>
                                <?php if($hasil['harga_snack'] > 0){ ?>
                                    <tr>
                                        <td align="center"><?=$no?></td>
                                        <td>Snack</td>
                                        <td align="center"><?=$hasil['jml_peserta']?></td>
                                        <td align="center">Orang</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
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
                    <td>Pemesan,</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Penyedia</td>
                    <td></td>
                    <td>Pejabat Pelaksana Teknis Kegiatan</td>
                </tr>
                <tr>
                    <td height="70px">&nbsp;</td>
                </tr>
                <tr>
                    <td></td>
                    <td><b><u><?=$rekananCatering['nama_pemilik']?></u></b></td>
                    <td></td>
                    <td><b><u><?=$hasil['nama_pejabat_pptk']?></u></b></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="padding-top: -3px"><?=$rekananCatering['nama_rekanan']?></td>
                    <td></td>
                    <td style="padding-top: -3px">NIP. <?=$hasil['nip_pejabat_pptk']?></td>
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