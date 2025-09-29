<!doctype html>
<html>
<head>
    <title>Telaah Staf</title>
</head>
<body>
    <div class="responsive">
        <div><?=$header?></div>
        <table width="100%" style="font-size:12pt;text-align:center;font-family:tahoma">
            <tr>
                <td style="font-size: 16pt"><b><u>TELAAH STAF</u></b></td>
            </tr>
        </table>
        <br>
        <table width="100%" style="font-size:11pt;line-height: 1.3;font-family:tahoma" border="0" cellspacing="-1">                
            <tr>
                <td>Kepada</td>
                <td>:</td>
                <td>Yth. Bapak <?=$hasil['jabatan_penandatangan_st']?> Bappeda Kabupaten Kediri</td>
            </tr>
            <tr>
                <td>Dari</td>
                <td>:</td>
                <td><?=$hasil['jabatan_pengusul']?> Bappeda Kabupaten Kediri</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td>
                    <?php
                    $tglST = explode('-', $hasil['tgl_surat_tugas']);
                    ?>
                    <?=$tglST[2].' '.$this->help->namaBulan($tglST[1]).' '.$tglST[0]?>        
                </td>
            </tr>
            <tr>
                <td>Perihal</td>
                <td>:</td>
                <td><?=$hasil['perihal']?></td>
            </tr>
        </table>
        <br>
        <div style="border-bottom:1px dashed black"></div>
        <br>
        <table width="100%" style="font-size:11pt;line-height: 1.3;font-family:tahoma" border="0" cellspacing="-1">                
            <tr>
                <td align="justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dilaporkan dengan hormat bahwa <?=$hasil['latar_belakang']?> sampai dengan saat ini, kegiatan tersebut belum bisa terlaksana sesuai dengan yang direncanakan, dikarenakan keterbatasan waktu dan tenaga yang ada.</td>
            </tr>
            <tr>
                <td align="justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Demi kelancaran pelaksanaan tugas dimaksud perlu adanya tambahan jam kerja dan tenaga, untuk itu dimohon terhadap nama-nama berikut ditugaskan untuk menyelesaikan <?=$hasil['perihal']?> setelah jam kerja kantor dan diluar hari kerja kantor, pada tanggal <?=$this->help->ReverseTgl($hasil['tgl_kegiatan_dari'])?> s/d <?=$this->help->ReverseTgl($hasil['tgl_kegiatan_sampai'])?>. Adapun nama-nama yang ditugaskan adalah sebagai berikut :</td>
            </tr>
        </table>
        <br>
        <table width="100%" class="bordersolid" style="font-size:11pt;line-height: 1.3;font-family:tahoma" border="1" cellspacing="-1">
            <tr>
                <th width="20px">No.</th>
                <th width="30%">Nama</th>
                <th width="25%">NIP</th>
                <th>Jabatan</th>
            </tr>
            <?php $no=1;foreach ($detail as $val) { ?>
                <tr>
                    <td valign="top" align="center"><?=$no++?></td>
                    <td valign="top"><?=$val['nama_sdm']?></td>
                    <td valign="top"><?=$val['nip']?></td>
                    <td valign="top"><?=$val['jabatan']?></td>
                </tr>
            <?php } ?>
        </table>
        <br>
        <table width="100%" style="font-size:11pt;line-height: 1;font-family:tahoma; text-align: center" border="0" cellspacing="-1">
            <tr>
                <td width="50%">&nbsp;</td>
                <td><?=$hasil['jabatan_pengusul']?></td>
            </tr>
            <tr>
                <td height="70px">&nbsp;</td>
            </tr>
            <tr>
                <td></td>
                <td><b><u><?=$hasil['nama_pengusul']?></u></b></td>
            </tr>
            <tr>
                <td></td>
                <td>NIP. <?=$hasil['nip_pengusul']?></td>
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