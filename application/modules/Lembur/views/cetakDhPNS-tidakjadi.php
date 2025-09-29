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
            <table width="100%" class="bordersolid" style="font-size:10pt;font-family:tahoma;line-height: 2.5;" border="1" cellspacing="-1">
                <thead>
                    <tr>
                        <th width="40px">No.</th>
                        <th width="225px">Nama Pegawai</th>
                        <th width="150px">Jabatan</th>
                        <th width="100px">Mulai Lembur</th>
                        <th width="100px">Selesai Lembur</th>
                        <th width="100px">Jml Jam Lembur</th>
                        <th colspan="2">Tanda Tangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach ($detail as $val) { ?>
                        <tr>
                            <td align="center"><?=$no.'.'?></td>
                            <td><?=$val['nama_sdm']?></td>
                            <td><?=$val['jabatan']?></td>
                            <td align="center"><?=$this->help->ReverseTgl($kelSdm[$val['fk_sdm_id']][0]->tgl)?></td>
                            <?php
                                $slsai = ''; $jmlJam = '';
                                foreach ($kelSdm[$val['fk_sdm_id']] as $valAkhr) {
                                    $slsai = $valAkhr->tgl; 
                                    $jmlJam += $valAkhr->jml_jam;
                                }
                            ?>
                            <td align="center"><?=$this->help->ReverseTgl($slsai)?></td>
                            <td align="center"><?=$jmlJam?></td>
                            <?php
                                $no1=$no.'.';
                                $no2="";
                                $btm1 = 'no_border_bottom';
                                $top1 = 'no_border_top';
                                $btm2 = 'no_border_top';
                                $top2 = '';
                                if($no%2==0){
                                    $no1 = "";
                                    $no2 = $no.'.';
                                    $btm1 = '';
                                    $btm2 = 'no_border_bottom';
                                    $top2 = 'no_border_top';
                                }
                            ?>
                            <td width="100px" class="<?=$btm1?> <?=$top1?>"><?=$no1?></td>
                            <td width="100px" class="<?=$btm2?> <?=$top2?>"><?=$no2?></td>
                        </tr>
                    <?php $no++; } ?>
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