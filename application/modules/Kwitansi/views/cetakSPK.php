<!doctype html>
<html>
    <head>
        <title>SPK</title>
    </head>
    <body onload="window.print()" style="margin:1">
        <div class="responsive">
            <?=$header?>
            <br>
            <?php 
                $dt = explode('-', $hasil['tgl_kwitansi']);
                $ksp = explode('-', $hasil['tgl_kesepakatan_harga']);
            ?>
            <table width="100%" style="font-family:arial;line-height: 1.3; font-size: 11pt" class="bordersolid" border="1" cellspacing="-1">
            	<tr>
                    <td width="30%" align="center">SURAT PERINTAH KERJA<br>(SPK)</td>   
                    <td>
                        &nbsp;Proyek/Satuan Kerja :<br>
                        &nbsp;<b>BADAN PERENCANAAN PEMBANGUNAN DAERAH KAB. KEDIRI</b><br>
                        &nbsp;Nomor dan Tanggal SPK.<br>
                        &nbsp;Nomor &nbsp;&nbsp; : 602.1 / &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; / 418.54 / <?=$hasil['tahun']?> <br>
                        &nbsp;Tanggal &nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$ksp[2].' '.$this->help->namaBulan($ksp[1]).' '.$ksp[0]?>
                    </td>   
                </tr>
                <tr>
                    <td>
                        <b>PAKET PEKERJAAN :</b><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;<?=$hasil['untuk_pembayaran']?><br>&nbsp;
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <b>SUMBER DANA : </b>Dana Alokasi Umum (DAU) Tahun Anggaran <?=$hasil['tahun']?>
                    </td>
                </tr>
                <?php
                    $wkt = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                    $jmlHrinya = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                    if($hasil['tgl_kesepakatan_harga']){
                        $tgl1 = new DateTime($hasil['tgl_kesepakatan_harga']);
                        $tgl2 = new DateTime($hasil['tgl_kwitansi']);
                        $selisih = $tgl2->diff($tgl1);
                        $jmlHari = $selisih->days;
                        $jmlHrinya = $jmlHari.' ('.$this->help->terbilang($jmlHari).')';

                        $wkt = $ksp[2];
                        if($ksp[1]!=$dt[1]){
                            $wkt = $ksp[2].' '.$this->help->namaBulan($ksp[1]);
                        }
                    }
                ?>
                <tr>
                    <td colspan="2">
                        <b>WAKTU PELAKSANAAN PEKERJAAN : </b><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;<?=$jmlHrinya?> hari kalender, sejak tanggal <?=$wkt.' sampai dengan '.$dt[2].' '.$this->help->namaBulan($dt[1]).' '.$dt[0]?>
                    </td>
                </tr>
            </table>
            <table width="100%" style="font-family:arial;line-height: 1.3; font-size: 11pt" class="bordersolid" border="1" cellspacing="-1">
                <tr>
                    <th colspan="6">NILAI PEKERJAAN</th>
                </tr>
                <tr>
                    <th>NO.</th>
                    <th>URAIAN</th>
                    <th>VOLUME</th>
                    <th>SATUAN</th>
                    <th>HARGA SATUAN (Rp.)</th>
                    <th>JUMLAH (Rp.)</th>
                </tr>
                <?php if(!isset($detail)){ ?>
                    <tr>
                        <td align="center">1.</td>
                        <td> <?=$hasil['untuk_pembayaran']?></td>
                        <td align="center"><?=$hasil['qty']?></td>
                        <td align="center"><?=$hasil['satuan']?></td>
                        <td align="right"><?=number_format($hasil['banyaknya_uang'])?></td>
                        <td align="right"><?=number_format($hasil['banyaknya_uang'])?></td>
                    </tr>
                    <tr>
                        <td colspan="5" align="center">Jumlah total sudah termasuk PPN</td>
                        <td align="right"><?=number_format($hasil['banyaknya_uang'])?></td>
                    </tr>
                    <tr>
                        <td colspan="6">Terbilang : <b>=== <?=$this->help->terbilang($hasil['banyaknya_uang'])?> Rupiah ===</b></td>
                    </tr>
                <?php }else{ ?>
                    <?php $no=1; $totalnya=0; foreach ((array)$detail as $val) { ?>
                        <tr>
                            <td align="center"><?=$no++?>.</td>
                            <td> <?=$val['uraian']?></td>
                            <td align="center"><?=$val['jml']?></td>
                            <td align="center"><?=$val['satuan']?></td>
                            <td align="right"><?=number_format($val['harga_satuan'])?></td>
                            <td align="right"><?=number_format($val['harga_satuan']*$val['jml'])?></td>
                        </tr>
                    <?php 
                            $totalnya += $val['harga_satuan']*$val['jml']; 
                        } 
                    ?>
                    <tr>
                        <td colspan="5" align="center">Jumlah total sudah termasuk PPN</td>
                        <td align="right"><?=number_format($totalnya)?></td>
                    </tr>
                    <tr>
                        <td colspan="6">Terbilang : <b>=== <?=$this->help->terbilang($totalnya)?> Rupiah ===</b></td>
                    </tr>
                <?php } ?>
            </table>
            <table width="100%" style="font-family:arial;line-height: 1.3; font-size: 11pt" class="bordersolid" border="1" cellspacing="-1">
                <tr>
                    <td colspan="2" align="justify">
                        INSTRUKSI KEPADA PENYEDIA BARANG : Penagihan hanya dapat dilakukan setelah penyelesaian pekerjaan yang diperintahkan dalam SPK ini. Jika pekerjaan tidak dapat diselesaikan dalam jangka waktu pelaksanaan pekerjaan karena kesalahan atau kelalaian penyedia barang, maka penyedia barang berkewajiban membayar denda kepada Pejabat Pembuat Komitmen sebesar 1/1000 (satu per seribu) dari nilai SPK sebelum PPN setiap hari kalender keterlambatan. Selain tunduk kepada ketentuan dalam SPK ini, penyedia barang berkewajiban untuk mematuhi standar ketentuan dan syarat umum SPK terlampir.
                    </td>
                </tr>
                <tr>
                    <td width="50%" align="center">
                        Untuk dan Atas Nama<br>
                        BAPPEDA KABUPATEN KEDIRI<br>
                        PA / PPK<br>
                        &nbsp;<br>&nbsp;<br>&nbsp;<br>
                        <b><u><?=$hasil['nama_pejabat_ppk']?></u></b><br>
                        NIP. <?=$hasil['nip_pejabat_ppk']?>
                    </td>
                    <td align="center">
                        &nbsp;<br>
                        Untuk dan Atas Nama<br>
                        Penyedia Barang<br>
                        &nbsp;<br>&nbsp;<br>&nbsp;<br>
                        <b><u><?=$hasil['nama_penerima']?></u></b><br>
                        <?=$hasil['jabatan_penerima']?>
                    </td>
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