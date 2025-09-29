<!doctype html>
<html>
    <head>
        <title>Surat Tugas</title>
    </head>
    <body>
        <div class="responsive">
            <div><?=$header?></div>            
            <?php
                $tglST = explode('-', $hasil['tgl_surat_tugas']);
            ?>
            <table width="100%" style="font-size:12pt;text-align:center;font-family:tahoma">
                <tr>
                    <td style="font-size: 16pt"><b><u>SURAT PERINTAH LEMBUR</u></b></td>
                </tr>
                <tr>
                    <td style="font-size: 12pt;padding-top: -5px">Nomor : 900/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/<?=$kelAss->kode_bagian?>/<?=$tglST[0]?></td>
                </tr>
            </table>
            <br>
            <table width="100%" style="font-size:12pt;line-height: 1.5;font-family:tahoma" border="0" cellspacing="-1">                
                <tr>
                    <td align="justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Diperintahkan kepada para staf <?=$kelAss->nama_bagian?> Kabupaten Kediri yang tersebut dalam daftar dibawah ini untuk melaksanakan/mengerjakan tugas lembur setelah jam kerja kantor dan di luar hari kerja kantor, pada tanggal <?=$this->help->ReverseTgl($hasil['tgl_kegiatan_dari'])?> s/d <?=$this->help->ReverseTgl($hasil['tgl_kegiatan_sampai'])?> yang dilaksanakan pukul 15.30 WIB s/d selesai (pada hari kerja kantor Senin-Kamis), pukul 12.30 WIB s/d selesai (pada hari kerja kantor jum'at), dan pukul 08.00 WIB s/d selesai (di luar hari kerja kantor), guna mengerjakan <?=$hasil['perihal']?>.</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td align="justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sebanyak <?=count($detail).' ('.$this->help->terbilang(count($detail)).')'?> orang yang terdiri dari :</td>
                </tr>
            </table>
            <table width="100%" style="font-size:12pt;line-height: 1.5;font-family:tahoma" border="0" cellspacing="-1">
                <tr><td></td></tr>
                <tr><td></td></tr>
                <?php $no=1;foreach ((array)$detail as $val) { ?>
                    <tr>
                        <td width="20px">&nbsp;</td>
                        <td valign="top" align="center" width="30px"><?=$no++?>.</td>
                        <td valign="top"><?=$val['nama_sdm']?></td>
                    </tr>
                <?php } ?>                
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="3" align="justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Demikian surat perintah lembur ini dibuat untuk dilaksanakan dengan penuh tanggungjawab.</td>
                </tr>
            </table>
            <br>
            <table width="100%" style="font-size:12pt;line-height: 1;font-family:tahoma;" border="0" cellspacing="-1">
                <tr>
                    <td width="50%">&nbsp;</td>
                    <td>Dikeluarkan di</td>
                    <td width="20px">:</td>
                    <td>Kediri</td>
                </tr>
                <tr>
                    <td></td>
                    <td class="border_bottom">Pada Tanggal</td>
                    <td class="border_bottom">:</td>
                    <td class="border_bottom">                        
                        <?=$tglST[2].' '.$this->help->namaBulan($tglST[1]).' '.$tglST[0]?>
                    </td>
                    <td width="60px"></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td></td>
                    <td align="center" colspan="4"><?=strtoupper($hasil['jabatan_penandatangan_st'])?></td>
                </tr>
                <tr>
                    <td height="70px">&nbsp;</td>
                </tr>
                <tr>
                    <td></td>
                    <td align="center" colspan="4"><b><u><?=$hasil['nama_penandatangan_st']?></u></b></td>
                </tr>
                <tr>
                    <td></td>
                    <td align="center" colspan="4">NIP. <?=$hasil['nip_penandatangan_st']?></td>
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