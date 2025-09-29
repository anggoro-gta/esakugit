<!doctype html>
<html>
    <head>
        <title>Surat Undangan</title>
    </head>
    <body>
        <div class="responsive">
            <div><?=$header?></div>
            <br>
            <table width="100%" style="font-size:11pt;line-height: 1.5;font-family:tahoma" border="0" cellspacing="-1">                
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="3" align="center">Kediri, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$hasil['tahun']?></td>
                </tr>
                <tr>
                    <td width="100px">Nomor</td>
                    <td width="10px">:</td>
                    <td width="350px">005/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/<?=$kelAss->kode_bagian?>/<?=$hasil['tahun']?></td>
                    <td colspan="3">Kepada :</td>
                </tr>
                <tr>
                    <td>Sifat</td>
                    <td>:</td>
                    <td>Segera</td>
                    <td width="30px">Yth.</td>
                    <td colspan="2">Sdr.</td>
                </tr>
                 <tr>
                    <td>Lampiran</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                 <tr>
                    <td>Perihal</td>
                    <td>:</td>
                    <td><b><u>UNDANGAN</u></b></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td></td>
                    <td colspan="2"> Di - </td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td></td>
                    <td width="30px"></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>KEDIRI</u></td>
                </tr>
            </table>
            <br>
            <br>
            <br>
            <table width="100%" style="font-size:11pt;line-height: 1.5;font-family:tahoma" border="0" cellspacing="-1">
                <tr>
                    <td width="110px"></td>
                    <td colspan="3">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Bersama ini mengharap dengan hormat agar Saudara menugaskan staf yang membidangi untuk menghadiri rapat yang akan dilaksanakan pada :
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td width="100px">Hari</td>
                    <td width="10px">:</td>
                    <td><?=$hasil['hari']?></td>
                </tr>
                <?php
                    $tg = explode('-', $hasil['tgl']);
                ?>
                <tr>
                    <td></td>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td><?=$tg[2].' &nbsp;'.$this->help->namaBulan($tg[1]).' &nbsp;'.$tg[0]?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Pukul</td>
                    <td>:</td>
                    <td><?=$hasil['pukul']?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Tempat</td>
                    <td>:</td>
                    <td><?=ucwords(strtolower($hasil['tempat']))?></td>
                </tr>
                <tr>
                    <td></td>
                    <td valign="top">Acara</td>
                    <td valign="top">:</td>
                    <td><?=$hasil['acara']?></td>
                </tr>
                <tr>
                    <td height="30px"></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="3">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Demikian atas perhatian dan kerjasamanya disampaikan terima kasih.
                    </td>
                </tr>
            </table>
            <br>
            <br>
            <br>
            <table width="100%" style="font-size:11pt;line-height: 1.2;font-family:tahoma; text-align: center" border="0" cellspacing="-1">
                <?php
                    $ttdJudul = '';
                    if($hasil['urut_ttd']=='1'){
                        $ttdJudul = $hasil['nama_jabatan_ttd'];
                    }else if($hasil['urut_ttd']=='2'){
                        $ttdJudul = 'a.n. BUPATI KEDIRI <br> '.$hasil['nama_jabatan_ttd'];
                    }else if($hasil['urut_ttd']=='3'){
                        $ttdJudul = 'a.n. BUPATI KEDIRI <br> SEKRETARIS DAERAH <br>u.b.<br> '.$hasil['nama_jabatan_ttd'];
                    }else if($hasil['urut_ttd']=='4'){
                        $ttdJudul = 'a.n. BUPATI KEDIRI <br>'.strtoupper($kelAss->kelompok_asisten).'<br>u.b.<br> '.$hasil['nama_jabatan_ttd'];
                    }
                ?>
                <tr>
                    <td width="50%">&nbsp;</td>
                    <td><?=$ttdJudul?></td>
                </tr>
                <tr>
                    <td height="60px"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><b><u><?=$hasil['nama_ttd']?></u></b></td>
                </tr>
                <tr>
                    <td></td>
                    <td>NIP. <?=$hasil['nip_ttd']?></td>
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