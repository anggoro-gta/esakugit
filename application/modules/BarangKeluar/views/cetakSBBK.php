<!doctype html>
<html>
    <head>
        <title>SBBK</title>
    </head>
    <body>
        <div class="responsive">
            <?=$header?>
            <br>
            <table width="100%" style="font-family:arial;line-height: 1.2;font-size:11pt;">
                <tr><td height="10px"></td></tr>
                <tr>
                    <td colspan="3" align="center" style="font-size:13pt;"><b><u>SURAT BUKTI BARANG KELUAR (SBBK)</u></b></td>
                </tr>
                <tr><td height="15px"></td></tr>   
                <tr>
                    <td width="120px">Nomor</td>
                    <td width="20px">:</td>
                    <td><?=$hasil['nomor']?></td>
                </tr>
                <tr>
                    <td valign="top">Kepada Bagian</td>
                    <td valign="top">:</td>
                    <td><?=$Bagian['nama_bagian']?></td>
                </tr> 
                <tr>
                    <td>Dari</td>
                    <td>:</td>
                    <td>Pengurus Barang</td>
                </tr>
                <tr>
                    <td>Jenis Barang</td>
                    <td>:</td>
                    <td><?=$hasil['kategori']?></td>
                </tr>
                <tr>
                    <td valign="top">Kegiatan</td>
                    <td valign="top">:</td>
                    <td><?=$hasil['kegiatan_bappeda']?></td>
                </tr>       
            </table>
            <br>
            <table class="bordersolid" border="1" cellspacing="-1" width="100%" style="line-height: 1;font-size:11pt;">
                <tr>
                    <th width="20px">No.</th>
                    <th width="200px">Nama Barang</th>
                    <th>Satuan</th>
                    <th>Harga</th>
                    <th>Jml Barang</th>
                    <th>Total</th>
                </tr>
                <?php $no=1; foreach ($detail as $val): ?>
                    <?php 
                        $qty = $val['qty'];
                        $hrgSat = $val['harga_satuan'];
                        $jml = $qty*$hrgSat; 
                    ?>
                    <tr>
                        <td valign="top" align="center"><?=$no++;?></td>
                        <td><?=$val['nm_brg_gabung'];?></td>
                        <td valign="top" align="center"><?=$val['satuan'];?></td>
                        <td valign="top" align="right"><?=number_format($hrgSat);?></td>
                        <td valign="top" align="center"><?=$qty;?></td>
                        <td valign="top" align="right"><?=number_format($jml);?></td>
                    </tr>
                    <?php 
                        $totQty += $qty;
                        $totHrgSat += $hrgSat;
                        $totJml += $jml; 
                    ?>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3" align="center">Jumlah</td>
                    <td align="right"><?=number_format($totHrgSat)?></td>
                    <td align="center"><?=$totQty?></td>
                    <td align="right"><?=number_format($totJml)?></td>
                </tr>
            </table>
            <br>
            <table border="0" width="100%" cellspacing="-1" style="font-size:11pt;text-align: center">
                <tr>
                    <td width="50px"></td>
                    <td width="250px"></td>
                    <td width="100px"></td>
                    <?php $tgl = explode('-', $hasil['tgl']); ?>
                    <td>Kediri, <?=$tgl[2].' '.$this->help->namaBulan($tgl[1]).' '.$tgl[0]?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Yang Menyerahkan,</td>
                    <td></td>
                    <td>Yang Menerima,</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <!-- <td><?=$hasil['jabatan_ppk']?></td> -->
                    <td>Pejabat Pelaksana Teknis Kegiatan</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td></td>
                    <td><b><u><?=$hasil['nama_pphp']?></u></b></td>
                    <td></td>
                    <td><b><u><?=$hasil['nama_pejabat_pptk']?></u></b></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="padding-top: -3px"><?=!empty($hasil['nip_pphp'])?'NIP. '.$hasil['nip_pphp']:''?></td>
                    <td></td>
                    <td style="padding-top: -3px">NIP. <?=$hasil['nip_pejabat_pptk']?></td>
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
