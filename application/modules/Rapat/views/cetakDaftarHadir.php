<!doctype html>
<html>
    <head>
        <title>Daftar Hadir</title>
    </head>
    <body>
         <?php 
            $clr='black';
            if(empty($tampilkan_acara)){ 
                $clr='white';
            }

            $clrHnyaHri='black';
            $bordernya='1';
            if(!empty($tampilkan_hny_hari)){
                $clrHnyaHri='white';
                $bordernya='0';
                $clr='black';
            }
        ?>
        <div class="responsive">
            <div style="padding-top: -30px;">
                <table width='100%' style='text-align:center;font-family:arial; color:<?=$clrHnyaHri?>' cellspacing='-2'>
                    <tr>
                        <td valign='top' rowspan='5' width='90px'>
                            <?php if(empty($tampilkan_hny_hari)){ ?>
                                <img src="<?=base_url()?>image/kab_kediri.png" width='73px' height='90px'>
                            <?php } ?>
                        </td>
                        <td style='font-size:16pt'><b>SEKRETARIAT DAERAH KABUPATEN KEDIRI</b></td>
                        <td rowspan='5' width='50px'></td>
                    </tr>
                    <tr>
                        <td style='font-size:16pt'><b><?=strtoupper($bag->nama_bagian)?></b></td>
                    </tr>
                    <tr>
                        <td style='font-size:12pt'>Jl. Soekarno Hatta No. 1 Telp. (0354) 689901-689905</td>
                    </tr>
                    <tr>
                        <td style='font-size:12pt'>Website : <u>www.kedirikab.go.id</u></td>
                    </tr>
                    <tr>
                        <td>K E D I R I</td>
                    </tr>
                    <tr>
                        <td colspan='3' style='text-align:right;font-size:12pt'>Kode Pos : 64182</td>
                    </tr>
                </table>
                <hr class='bordersolid' style='color:<?=$clrHnyaHri?>'>
                <hr class='bordersolid' style='margin-top:-11px;height:3px;color:<?=$clrHnyaHri?>'>
            </div>
            <table width="100%" style="font-size:14pt;text-align:center;font-family:times">
                <tr>
                    <td style="color:<?=$clrHnyaHri?>"><b>DAFTAR HADIR</b></td>
                </tr>
            </table>
            <table width="100%" style="font-size:12pt;font-family:times;line-height: 1.2;">
                <tr>
                    <td style="color:<?=$clr?>" width="100px">HARI</td>
                    <td style="color:<?=$clr?>" width="5px">:</td>
                    <td style="color:<?=$clr?>"><?=$hasil['hari']?></td>
                </tr>
                <tr>
                    <td style="color:<?=$clr?>">TANGGAL</td>
                    <td style="color:<?=$clr?>">:</td>
                    <td style="color:<?=$clr?>"><?=$tanggal?></td>
                </tr>
                <tr>
                    <td style="color:<?=$clr?>">PUKUL</td>
                    <td style="color:<?=$clr?>">:</td>
                    <td style="color:<?=$clr?>"><?=strtoupper($hasil['pukul'])?></td>
                </tr>
                <tr>
                    <td style="color:<?=$clr?>">TEMPAT</td>
                    <td style="color:<?=$clr?>">:</td>
                    <td style="color:<?=$clr?>"><?=strtoupper($hasil['tempat'])?></td>
                </tr>
                <tr>
                    <td style="color:<?=$clr?>" valign="top">ACARA</td>
                    <td style="color:<?=$clr?>" valign="top">:</td>
                    <td style="text-align: justify; color:<?=$clr?>"><?=strtoupper($hasil['acara'])?></td>
                </tr>
            </table>
            <br>
            <table width="100%" class="bordersolid" style="font-size:12pt;font-family:times;line-height: 1.8;color:<?=$clrHnyaHri?>" border="<?=$bordernya?>" cellspacing="-1">
                <thead>
                    <tr>
                        <th width="50px">NO</th>
                        <th width="210px">NAMA</th>
                        <th width="180px">INSTANSI</th>
                        <th width="50px">L/P</th>
                        <th colspan="2">TANDA TANGAN</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=1; $i <= $hasil['jml_peserta'] ; $i++) { ?>
                        <tr>
                           <td align="center"><?=$i?></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <?php
                                $no1=$i.'.';
                                $no2="";
                                $btm1 = 'no_border_bottom';
                                $top1 = 'no_border_top';
                                $btm2 = 'no_border_top';
                                $top2 = '';
                                if($i%2==0){
                                    $no1 = "";
                                    $no2 = $i.'.';
                                    $btm1 = '';
                                    $btm2 = 'no_border_bottom';
                                    $top2 = 'no_border_top';
                                }
                            ?>
                            <td class="<?=$btm1?> <?=$top1?>"><?=$no1?></td>
                            <td class="<?=$btm2?> <?=$top2?>"><?=$no2?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td>&nbsp;</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="<?=$btm1?> <?=$top1?>"></td>
                        <td class="<?=$btm2?> <?=$top2?>"></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <table width="100%" style="font-size:12pt;font-family:times;line-height: 1;">
                <tr>
                    <td width="50%"></td>
                    <td align="center">Mengetahui,</td>
                </tr>
                <tr>
                    <td></td>
                    <td align="center"><?=$hasil['jabatan_pejabat_kpa']?></td>
                </tr>
                <tr>
                    <td></td>
                    <td align="center">Kabupaten Kediri</td>
                </tr>
                <tr>
                    <td height="60px"></td>
                </tr>
                <tr>
                    <td></td>
                    <td align="center"><b><u><?=$hasil['nama_pejabat_kpa']?></u></b></td>
                </tr>
                <tr>
                    <td></td>
                    <td align="center">NIP. <?=$hasil['nip_pejabat_kpa']?></td>
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