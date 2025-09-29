<!doctype html>
<html>
    <head>
        <title>Laporan Staf</title>
    </head>
    <body>
        <div class="responsive">
            <div>
                <table width='100%' style='text-align:center;font-family:arial' cellspacing='-2'>
                    <tr>
                        <td valign='top' rowspan='5' width='90px'></td>
                        <td style='font-size:12pt'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>PEMERINTAH KABUPATEN KEDIRI</b></td>
                        <td rowspan='5' width='50px'></td>
                    </tr>
                    <tr>
                        <td style='font-size:14pt' colspan='2'><b>BADAN PERENCANAAN PEMBANGUNAN DAERAH</b></td>
                    </tr>
                    <tr>
                        <td style='font-size:12pt'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Jl. Soekarno Hatta No. 1 kediri Telp. (0354) 689995 Fax. (0354) 689995</td>
                    </tr>
                    <tr>
                        <td style='font-size:11pt'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; E-mail : <u>bappeda@kedirikab.go.id</u></td>
                    </tr>
                    <tr>
                        <td style='font-size:12pt'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; K E D I R I</td>
                    </tr>
                    <tr>
                        <td colspan='3' style='text-align:right;font-size:12pt'>Kode Pos : 64182</td>
                    </tr>
                </table>
                <hr style='height:4px;color:black'>
            </div>
            <br>
            <table width="100%" style="font-size:12pt;font-family:times;line-height: 1.5;">
                <tr>
                    <td align="center" colspan="3"><b><u>LAPORAN STAF</u></b></td>
                </tr>
                <br>
                <tr>
                    <td width="150px">Kepada</td>
                    <td width="20px">:</td>
                    <td>Yth. Kepala Bappeda Kabupaten Kediri</td>
                </tr>
                <tr>
                    <td>Dari</td>
                    <td>:</td>
                    <td><?= $hasil->fk_bagian_id==1?$hasil->Bagiannya.' Bappeda':$hasil->Bagiannya ?></td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Sifat</td>
                    <td>:</td>
                    <td>Segera</td>
                </tr>
                <tr>
                    <td valign="top">Perihal</td>
                    <td valign="top">:</td>
                    <td valign="top"><?=ucwords($hasil->acara)?></td>
                </tr>
            </table>
            <hr style='height:1px;color:black'>
            <br>
            <table width="100%" style="font-size:11pt;line-height: 1;" border="0" cellspacing="-1">
                <tr>
                                        
                </tr>
            </table>
        </div>
    </body>
</html>