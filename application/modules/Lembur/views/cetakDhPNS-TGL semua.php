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
                    <td><b>DAFTAR HADIR</b></td>
                </tr>
                 <tr>
                    <td><b>LEMBUR PADA HARI KERJA DAN HARI LIBUR</b></td>
                </tr>
                 <tr>
                    <td><b>DALAM RANGKA <?=strtoupper($hasil['perihal'])?></b></td>
                </tr>                
                 <tr>
                    <td><b>KEGIATAN <?=strtoupper($hasil['kegiatan_bappeda'])?></b></td>
                </tr>
            </table>
            <br>  
            <?php
                $tglLks = explode('-', $hasil['tgl_kegiatan_dari']);
                $tglLksSpi = explode('-', $hasil['tgl_kegiatan_sampai']);

                $jmlTgl = 0;
                for ($i=$tglLks[2]; $i <= $tglLksSpi[2]; $i++) { 
                    $jmlTgl++;
                }
            ?>  
            <?php 
                $page = $tglLks[2]+7;
                for ($p=$tglLks[2]; $p < $page; $p++) { 
            ?>        
            <table width="100%" style="font-size:10pt;font-family:tahoma;line-height: 2;" border="1" cellspacing="-1">
                <thead>
                    <tr>
                        <th rowspan="3" width="35px">No.</th>
                        <th rowspan="3" width="200px">Nama</th>
                        <th rowspan="3" width="40px">Gol</th>
                        <th colspan="<?=$jmlTgl*3?>"><?=strtoupper($this->help->namaBulan($tglLks[1])).' '.$tglLks[0]?></th>
                    </tr>
                    <tr>
                        <th colspan="<?=$jmlTgl*3?>">TANGGAL</th>
                    </tr>
                    <tr>
                        <?php for ($i=$tglLks[2]; $i <= $tglLksSpi[2]; $i++) { ?>
                            <th colspan="2"><?=$i?></th>
                            <th>JML<br>JAM</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach ($detail as $val) { ?>
                        <tr>
                            <td rowspan="2" align="center"><?=$no++.'.'?></td>
                            <td rowspan="2"><?=$val['nama_sdm']?></td>
                            <td rowspan="2" align="center"><?=$val['golongan']?></td>
                            <?php for ($i=$tglLks[2]; $i <= $tglLksSpi[2]; $i++) { ?>
                                <?php
                                    $jm = '<span style="font-size:7pt" >x</span>';
                                    $silang = '<span style="font-size:7pt" >x</span>';
                                    if(isset($detailJam[$val['fk_sdm_id']][$i])){
                                        $jm = $detailJam[$val['fk_sdm_id']][$i].' JAM';
                                        $silang = '&nbsp;';
                                    }
                                ?>
                                <td align="center"><?=$silang?></td>
                                <td align="center"><?=$silang?></td>
                                <td align="center" rowspan="2" align="center"><?=$jm?> </td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <?php for ($i=$tglLks[2]; $i <= $tglLksSpi[2]; $i++) { ?>
                                <?php
                                    $jm = '<span style="font-size:7pt" >x</span>';
                                    $silang = '<span style="font-size:7pt" >x</span>';
                                    if(isset($detailJam[$val['fk_sdm_id']][$i])){
                                        $silang = '........';
                                    }
                                ?>
                                <td align="center"><?=$silang?></td>
                                <td align="center"><?=$silang?></td>
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
                    <td width="35%"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>Pejabat Pelaksana Teknis Kegiatan</td>
                </tr>
                <tr>
                    <td height="70px">&nbsp;</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><b><u><?=$hasil['nama_pejabat_pptk']?></u></b></td>
                </tr>
                <tr>
                    <td></td>
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
.border_bottom{
    border-bottom: 1px solid black;
}
.bordersolid{
    border: 1px solid black; border-collapse: collapse;
}
</style>