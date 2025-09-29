<!doctype html>
<html>
    <head>
        <title>Surat Pembelian Langsung</title>
    </head>
    <body>
        <div class="responsive">
            <?=$header?>
            <br>
            <table width="100%" style="font-family:arial;line-height: 2;">
                <!-- <tr><td height="10px"></td></tr> -->
                <tr>
                    <td colspan="2" align="center" style="font-size:13pt;"><b><u>SURAT PEMBELIAN LANGSUNG</u></b></td>
                </tr>
                <tr>
                    <td colspan="2"  align="center" style="font-size:13pt;padding-top: -20px">Nomor : 602/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/418.54/<?=$hasil['tahun_anggaran']?></td>
                </tr>
            </table>
            <br>
            <br>
            <table border="0" width="100%" cellspacing="-1" style="font-size:12pt;">
                <tr>
                    <td>Kegiatan</td>
                    <td>:</td>
                    <td><?=$hasil['nama_program']?></td>
                </tr>
                <tr>
                    <td>Sub Kegiatan</td>
                    <td>:</td>
                    <td><?=$hasil['kegiatan_bappeda']?></td>
                </tr>
                <tr>
                    <td>Kode Rekening</td>
                    <td>:</td>
                    <td><?=$hasil['kode_rek_belanja']?></td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td><?=$this->help->ReverseTgl($hasil['tgl_pesanan'])?></td>
                </tr>
            </table>
            <br>
            <table border="1" width="100%" cellspacing="-1" style="font-size:12pt;border: 1px solid black;border-collapse: collapse;">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Uraian Pekerjaan / item /<br>spesifikasi teknis</th>
                        <th>Volume</th>
                        <th>Harga Satuan (Rp)</th>
                        <th>Jumlah Harga (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total=''; $grandTotal=''; $no=1; foreach ($detail as $val) { ?>
                        <tr>
                            <td align="center"><?=$no++?></td>
                            <td><?=$val['nm_brg_gabung']?></td>
                            <td align="center"><?=$val['qty_akhir']?></td>
                            <td align="right"><?=number_format($val['harga_satuan_beli'])?></td>
                            <?php
                                $total = $val['qty_akhir']*$val['harga_satuan_beli'];
                                $grandTotal += $total;
                            ?>
                            <td align="right"><?=number_format($total)?></td>
                        </tr>
                    <?php } ?>
                    <!-- <tr>
                        <td colspan="4" align="right">Jumlah Bruto</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="4" align="right">Pajak-pajak yang dikenakan</td>
                        <td></td>
                    </tr> -->
                    <tr>
                        <td colspan="4" align="right"><b>Total</b>&nbsp; </td>
                        <td align="right"><b><?=number_format($grandTotal)?></b></td>
                    </tr>
                    <tr>
                        <td colspan="5" valign="top"><b>Terbilang : <i><?=$this->help->terbilang($grandTotal)?> Rupiah</i></b></td>
                    </tr>
                </tbody>
            </table>
            <table border="0" width="100%" cellspacing="-1" style="font-size:12pt;text-align: center">
                <tr><td height="20px"></td></tr>
                <tr>
                    <td width="50%"></td>
                    <?php $dt=explode("-",$hasil['tgl_pesanan']); ?>
                    <td>Kediri, <?= $dt[2].' '.$this->help->namaBulan($dt[1]).' '.$dt[0];?></td>
                </tr>
                <tr>
                    <td>Penyedia barang/jasa</td>
                    <td>Pejabat Pengadaan</td>
                </tr>
                <tr>
                    <td><?=$rekanan['nama_rekanan']?></td>
                    <td></td>
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
                    <td><b><u><?=$rekanan['nama_pimpinan']?></u></b></td>
                    <td><b><u>WIRATNO MAHARDIKO, S.Pd</u></b></td>
                </tr>
                <tr>
                    <td style="padding-top: -3px"><?=$rekanan['jabatan']?></td>
                    <td style="padding-top: -3px">NIP. 19850814 201101 1 008</td>
                </tr>
                <tr><td height="40px"></td></tr>
                <tr>
                    <td colspan="2">Mengetahui,</td>
                </tr>
                <?php if($hasil['fk_bagian_id']==1){ ?>
                    <tr>
                        <td>Pejabat Pembuat Komitmen</td>
                        <td>Pengguna Anggaran</td>
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
                        <td><b><u><?=$hasil['nama_ppk']?></u></b></td>
                        <td><b><u><?=$hasil['nama_pejabat_pa']?></u></b></td>
                    </tr>
                    <tr>
                        <td style="padding-top: -3px">NIP. <?=$hasil['nip_ppk']?></td>
                        <td style="padding-top: -3px">NIP. <?=$hasil['nip_pejabat_pa']?></td>
                    </tr> 
                <?php }else{ ?>      
                    <tr>
                        <td colspan="2">Pejabat Pembuat Komitmen / <br>Kuasa Pengguna Anggaran</td>
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
                        <td colspan="2"><b><u><?=$hasil['nama_ppk']?></u></b></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding-top: -3px">NIP. <?=$hasil['nip_ppk']?></td>
                    </tr>             
                <?php } ?>
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