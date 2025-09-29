<!doctype html>
<html>
    <head>
        <title>Kwitansi HR</title>
    </head>
    <body>
        <div class="responsive">
            <table width="100%" style="font-size:14pt;text-align:center;font-family:arial;line-height: 1;">
                <tr>
                    <th>DAFTAR HADIR PEGAWAI KONTRAK / THL</th>
                </tr>
                <tr>
                    <th>SUB KEGIATAN <?=strtoupper($hasil['kegiatan'])?></th>
                </tr>
                <tr>
                    <th><?=$bag->nama_bagian?> KABUPATEN KEDIRI</th>
                </tr>
                <tr>
                    <th>TANGGAL 1 S/D <?=$tglAkhir.' '.strtoupper($nama_bulan).' '.$tahun?></th>
                </tr>
            </table>
            <br>
            <table width="100%" style="font-size:10pt;font-family:arial;line-height: 1.5;" border="1" cellspacing="-1">
                <tr>
                    <td align="center" rowspan="3" width="30px">NO.</td>
                    <td align="center" rowspan="3">NAMA</td>
                    <td align="center" colspan="<?=count($hariArr)?>"><?=strtoupper($nama_bulan)?></td>
                    <td align="center" rowspan="3">KET</td>
                </tr>
                <tr>
                    <?php foreach ($hariArr as $key => $hri) { ?>
                        <td align="center"><?=$hri?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <?php foreach ($hariArr as $key => $hri) { ?>
                        <td align="center"><?=$key?></td>
                    <?php } ?>
                </tr>
                <?php $no=1; foreach ($detail as $val) { ?>
                    <tr>
                        <td align="center"><?=$no++?></td>
                        <td><?=$val->nama?></td>
                        <?php foreach ($hariArr as $key => $hri) { ?>
                            <td></td>
                        <?php } ?>
                        <td></td>
                    </tr>
                <?php } ?>
            </table>
            <br>
            
            <table width="100%" style="font-size:10pt;font-family:arial;line-height: 1;text-align: center" border="0" cellspacing="-1">
                <tr>
                    <td width="30%"></td>
                    <td width="40%"></td>
                    <td width="30%">Kediri, <?=$tglAkhir.' '.$nama_bulan.' '.$tahun?>
                    </td>
                </tr>
                <tr>
                    <td>Mengetahui<br><?=$hasil['jabatan_pejabat_kpa']?></td>
                    <td></td>
                    <td>PEJABAT PELAKSANA TEKNIS KEGIATAN</td>
                </tr>
                <tr><td height="70px"></td></tr>
                <tr>
                    <td><b><u><?=$hasil['nama_pejabat_kpa']?></u></b></td>
                    <td></td>
                    <td><b><u><?=$hasil['nama_pejabat_pptk']?></u></b></td>
                </tr>
                <tr>
                    <td>NIP. <?=$hasil['nip_pejabat_kpa']?></td>
                    <td></td>
                    <td>NIP. <?=$hasil['nip_pejabat_pptk']?></td>
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