<!doctype html>
<html>
    <head>
        <title>Daftar Hadir Lembur</title>
    </head>
    <body>
        <div class="responsive">
            <!-- <table>
                <tr>
                    <td style="font-size: 9pt">No : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/<?=$hasil['singkatan_kegiatan']?>/<?=$hasil['bulan']?>/<?=$hasil['tahun']?></td>
                </tr>
            </table> -->
            <table width="100%" style="font-size:11pt;text-align:center;font-family:tahoma;line-height: 1;">
                <tr>
                    <td><b>DAFTAR HADIR LEMBUR</b></td>
                </tr>
                 <tr>
                    <td><b>DALAM RANGKA <?=strtoupper($hasil['perihal'])?></b></td>
                </tr>                
                 <tr>
                    <td><b>SUB KEGIATAN <?=strtoupper($hasil['kegiatan'])?></b></td>
                </tr>
            </table>
            <br>  
            <?php
                $tglLks = explode('-', $hasil['tgl_kegiatan_dari']);
            ?>          
            <table width="100%" class="bordersolid" style="font-size:10pt;font-family:tahoma;line-height: 2;" border="1" cellspacing="-1">
                <thead>
                    <tr>
                        <th rowspan="3" width="40px">No.</th>
                        <th rowspan="3" width="225px">Nama</th>
                        <th rowspan="3" width="50px">Gol</th>
                        <!-- <th colspan="<?=count($tglPlksnaan)*3?>"><?=strtoupper($this->help->namaBulan($tglLks[1])).' '.$tglLks[0]?></th> -->
                    </tr>
                    <tr>
                        <th colspan="<?=count($tglPlksnaan)*3?>">TANGGAL</th>
                    </tr>
                    <tr>
                        <?php foreach ($tglPlksnaan as $plk) {
                            $tglnya = explode('-', $plk->tgl);
                         ?>
                            <th colspan="2"><?=$tglnya[2].'/'.$tglnya[1].'/'.$tglnya[0]?></th>
                            <th>JML JAM</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach ($detail as $val) { ?>
                        <tr>
                            <td rowspan="2" align="center"><?=$no++.'.'?></td>
                            <td rowspan="2"><?=$val['nama_sdm']?></td>
                            <td rowspan="2" align="center"><?=$val['golongan']?></td>
                            <?php foreach ($tglPlksnaan as $plk) { ?>
                                <?php
                                    $jm = '';
                                    $silang = '';
                                    $warna="";
                                    if(isset($detailJam[$val['fk_sdm_id']][$plk->tgl])){
                                        $jm = "<span style='color: #F6F5F5; font-size:11pt'>".$detailJam[$val['fk_sdm_id']][$plk->tgl].'</span> JAM';
                                        $silang = '&nbsp;';
                                        $warna="black";
                                        //EFEDED
                                    }
                                ?>
                                <td align="center" style="color:<?=$warna?>"><?=$silang?></td>
                                <td align="center" style="color:<?=$warna?>"><?=$silang?></td>
                                <td align="center" rowspan="2" align="center" style="color:<?=$warna?>"><?=$jm?></td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <?php foreach ($tglPlksnaan as $plk) { ?>
                                <?php
                                    $silang = '';
                                    $warna="";
                                    if(isset($detailJam[$val['fk_sdm_id']][$plk->tgl])){
                                        $silang = '........';
                                        $warna="black";
                                    }
                                ?>
                                <td align="center" style="color:<?=$warna?>"><?=$silang?></td>
                                <td align="center" style="color:<?=$warna?>"><?=$silang?></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <br>
            <table width="100%" style="font-size:11pt;line-height: 1;font-family:tahoma; text-align: center" border="0" cellspacing="-1">
                 <tr>
                    <td width="35%"></td>
                    <td width="35%"></td>
                    <td width="35%">Mengetahui,</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><?=strtoupper($hasil['jabatan_pejabat_kpa'])?></td>
                </tr>
                <tr>
                    <td height="70px">&nbsp;</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><b><u><?=$hasil['nama_pejabat_kpa']?></u></b></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>NIP. <?=$hasil['nip_pejabat_kpa']?></td>
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