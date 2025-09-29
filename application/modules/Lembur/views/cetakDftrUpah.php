<!doctype html>
<html>
    <head>
        <title>Daftar Penerimaan Uang Lembur</title>
    </head>
    <body>
        <div class="responsive">
            <table width="100%" style="font-size:11pt;text-align:center;font-family:tahoma;line-height: 1;">
                <tr>
                    <td><b>DAFTAR PEMBAYARAN PERHITUNGAN UANG LEMBUR</b></td>
                </tr>
                 <tr>
                    <td><b>DALAM RANGKA <?=strtoupper($hasil['perihal'])?></b></td>
                </tr>                
                 <tr>
                    <td><b>SUB KEGIATAN <?=strtoupper($hasil['kegiatan'])?></b></td>
                </tr>
            </table>
            <br>       
            <table width="100%" class="bordersolid" style="font-size:10pt;font-family:tahoma;line-height: 2.5;" border="1" cellspacing="-1">
                <thead>
                    <tr>
                        <th rowspan="2" width="40px">No.</th>
                        <th rowspan="2" width="200px">Nama Pegawai</th>
                        <th rowspan="2" width="100px">Golongan<br>Ruang</th>
                        <th colspan="4">Perhitungan</th>
                        <th rowspan="2" width="100px">Pph 21<br>(Rp)</th>
                        <th rowspan="2" width="100px">Jml Yang <br>Diterimakan (Rp)</th>
                        <th rowspan="2" colspan="2">Tanda Tangan</th>
                    </tr>
                    <tr>
                        <th>Jumlah<br>Jam</th>
                        <th>Jumlah<br>Hari</th>
                        <th>Tarif<br>Lembur (Rp)</th>
                        <th>Jumlah (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no=1; $totJml=0; $totPph21=0; $totDtrma=0; ?>
                    <?php foreach ($detail as $val) { ?>
                        <tr>
                            <td align="center"><?=$no.'.'?></td>
                            <td><?=$val->nama_sdm?></td>
                            <td align="center"><?=$val->golongan?></td>
                            <td align="center"><?=$val->jml_jam?></td>
                            <td align="center"><?=$val->jml_hari?></td>
                            <td align="right"><?=number_format($val->tarif)?></td>
                            <?php $totTrf = $val->tarif*$val->jml_jam; ?>
                            <td align="right"><?=number_format($totTrf)?></td>
                            <?php $pph21nya = ($totTrf*$val->pph21)/100; ?>
                            <td align="right"><?=number_format($pph21nya)?></td>
                            <?php $jmlDtrma = $totTrf-$pph21nya; ?>
                            <td align="right"><?=number_format($jmlDtrma)?></td>
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
                        <?php
                            $no++; 
                            $totJml+=$totTrf; 
                            $totPph21+=$pph21nya; 
                            $totDtrma+=$jmlDtrma;
                        ?>
                    <?php } ?>
                    <tr>
                        <th colspan="6">JUMLAH</th>
                        <th align="right"><?=number_format($totJml)?></th>
                        <th align="right"><?=number_format($totPph21)?></th>
                        <th align="right"><?=number_format($totDtrma)?></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tbody>
            </table>
            <br>
            <table width="100%" style="font-size:11pt;line-height: 1;font-family:tahoma; text-align: center" border="0" cellspacing="-1">
                <tr>
                    <td width="40%"></td>
                    <td width="20%"></td>
                    <td width="40%">Mengetahui,</td>
                </tr>
                <tr>
                    <td>Bendahara Pengeluaran Pembantu</td>
                    <td></td>
                    <td><?=strtoupper($hasil['jabatan_pejabat_kpa'])?></td>
                </tr>
                <tr>
                    <td height="70px">&nbsp;</td>
                </tr>
                <tr>
                    <td><b><u><?=$hasil['nama_bendahara_pembantu']?></u></b></td>
                    <td></td>
                    <td><b><u><?=$hasil['nama_pejabat_kpa']?></u></b></td>
                </tr>
                <tr>
                    <td>NIP. <?=$hasil['nip_bendahara_pembantu']?></td>
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