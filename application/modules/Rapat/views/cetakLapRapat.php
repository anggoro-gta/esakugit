<!doctype html>
<html>
    <head>
        <title>Lap Rapat</title>
    </head>
    <body>
        <div class="responsive">
            <table width='100%' style='text-align:center;font-family:arial' cellspacing='-1'>
                <tr>
                    <td colspan='2' style='font-size:16pt'><b>PEMERINTAH KABUPATEN KEDIRI</b></td>
                </tr>
                <tr>
                    <td style='font-size:17pt' colspan='2'><b>SEKRETARIAT DAERAH</b></td>
                </tr>
                <tr>
                    <td style='font-size:12pt' colspan='2'>Jl. Soekarno Hatta No. 1 kediri Telp. (0354) 689901 - 689905</td>
                </tr>
                <tr>
                    <td style='font-size:12pt' colspan='2'>Website : <u>kedirikab.go.id</u></td>
                </tr>
                <tr>
                    <td colspan='2'>K E D I R I</td>
                </tr>
            </table>
            <hr class='bordersolid' style='height:4px;color:black'>
            <br>
            <table width="100%" style="font-size:12pt;font-family:tahoma">
                <tr>
                    <td style="font-size: 14pt" align="center"><b><u>NOTULENSI RAPAT</u></b></td>
                </tr>
            </table>
            <br>
            <table width="100%" style="font-size:12pt;line-height: 1.5;font-family:tahoma" border="0" cellspacing="-1">                
                <tr>
                    <td style="width: 100px">Hari</td>
                    <td style="width: 20px; text-align: center">:</td>
                    <td><?=$hasil['hari']?></td>
                </tr> 
                <?php
                    $tg = explode('-', $hasil['tgl']);
                ?>
                <tr>
                    <td>Tanggal</td>
                    <td style="text-align: center">:</td>
                    <td><?=$tg[2].' &nbsp;'.$this->help->namaBulan($tg[1]).' &nbsp;'.$tg[0]?></td>
                </tr> 
                <tr>
                    <td>Pukul</td>
                    <td style="text-align: center">:</td>
                    <td><?=$hasil['pukul']?></td>
                </tr> 
                <tr>
                    <td>Tempat</td>
                    <td style="text-align: center">:</td>
                    <td><?=ucwords(strtolower($hasil['tempat']))?></td>
                </tr>   
                <tr>
                    <td valign="top">Acara</td>
                    <td valign="top" style="text-align: center">:</td>
                    <td><?=$hasil['acara']?></td>
                </tr>    
                <tr>
                    <td>Peserta</td>
                    <td style="text-align: center">:</td>
                    <td>Terlampir sebagaimana daftar hadir</td>
                </tr>
                <tr>
                    <td valign="top">Materi</td>
                    <td valign="top" style="text-align: center">:</td>
                    <td><br><br><br><br><br><br></td>
                </tr>         
            </table> 
            <br>
            <table width="100%" style="font-size:12pt;line-height: 1.5;font-family:tahoma; text-align: center" border="0" cellspacing="-1">
                <tr>
                    <td style="width: 50%"></td>
                    <td align="center"><b>Notulis</b></td>
                </tr>
                <tr>
                    <td><br><br><br><br><br></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td><b><u>Nama</u></b></td>
                </tr>
                <tr>
                    <td></td>
                    <td>NIP. </td>
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
.border_bottom{
    border-bottom: 1px solid black;
}
.bordersolid{
    border: 1px solid black; border-collapse: collapse;
}
</style>