<!doctype html>
<html>
    <head>
        <title>Kesepakatan Harga</title>
    </head>
    <body onload="window.print()" style="margin:1">
        <div class="responsive">
            <?=$header?>
            <br>
            <table width="100%" style="font-family:arial;line-height: 1.5; font-size: 11pt">
            	<tr>
            		<th style="font-size: 13pt">SURAT KESEPAKATAN HARGA</th>
            	</tr>
            	<tr>
            		<th>PENUNJUKAN LANGSUNG <?=strtoupper($hasil['perihal'])?> SUB KEGIATAN <?=strtoupper($hasil['kegiatan'])?></th>
            	</tr>
            	<tr><td><hr></td></tr>
            	<tr><td align="center">Nomor : 602.1 / &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; / <?=$bag->kode_bagian?> / <?=$hasil['tahun']?></td></tr>
            	<tr><td>&nbsp;</td></tr>
            	<tr><td>&nbsp;</td></tr>
            	<?php 
                    if(empty($hasil['tgl_kesepakatan_harga'])){
                        die('<tr><td>Silahkan diisi dahulu kolom <b>Tgl Kesepakatan Harga</b></td></tr>');
                    }
                    $dt = explode('-', $hasil['tgl_kesepakatan_harga']); 
                ?>
            	<tr>
            		<td align="justify">
            			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pada hari ini <?= $this->help->namaHari($this->help->ReverseTgl($hasil['tgl_kesepakatan_harga']));?> tanggal <?=$this->help->terbilang($dt[2])?> bulan <?=$this->help->namaBulan($dt[1])?> Tahun <?=$this->help->terbilang($dt[0])?>, Pejabat Pembuat Komitmen <?=$bag->nama_bagian?> Kabupaten Kediri, telah melaksanakan kesepakatan harga pemesanan <?=$hasil['perihal']?> sub kegiatan <?=$hasil['kegiatan']?> tahun anggaran <?=$hasil['tahun']?>, dengan hasil sebagaimana terlampir.
            		</td>
            	</tr>
            	<tr><td>&nbsp;</td></tr>
            	<tr>
            		<td align="justify">
            			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Demikian Surat Kesepakatan ini dibuat dan merupakan dokumen yang tidak terpisahkan dari pemesanan <?=$hasil['perihal']?> sub kegiatan <?=$hasil['kegiatan']?> tahun anggaran <?=$hasil['tahun']?> , serta mempunyai kekuatan hukum yang sama dan mengikat kedua belah pihak.
	            	</td>
	            </tr>
            	<tr><td>&nbsp;</td></tr>
            	<tr>
            		<td>Kediri, <?=$dt[2].' '.$this->help->namaBulan($dt[1]).' '.$dt[0]?></td>
            	</tr>
            	<tr>
            		<td>Penyedia</td>
            	</tr>
            	<tr>
            		<td><b><?=$rekanan['nama_rekanan']?></b></td>
            	</tr>
            	<tr><td height='50px'>&nbsp;</td></tr>
            	<tr>
            		<td><b><u><?=$hasil['nama_penerima']?></u></b></td>
            	</tr>
            	<tr><td height='30px'>&nbsp;</td></tr>
            	<tr>
            		<td>Pejabat Pembuat Komitmen</td>
            	</tr>
            	<tr><td height='50px'>&nbsp;</td></tr>
            	<tr>
            		<td><b><u><?=$hasil['nama_pejabat_ppk']?></u></b><br>NIP. <?=$hasil['nip_pejabat_ppk']?></td>
            	</tr>
            </table>
            <!-- <pagebreak> -->
            <table width="100%" style="font-family:arial;line-height: 1.2; page-break-before: always;">
                <tr>
                    <td width="120px">Lampiran</td>
                    <td width="20px">:</td>
                    <td>Surat Kesepakatan Harga</td>
                </tr>
                <tr>
                    <td>Nomor</td>
                    <td>:</td>
                    <td>602.1 / &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; / <?=$bag->kode_bagian?> / <?=$hasil['tahun']?></td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td><?=$dt[2].' '.$this->help->namaBulan($dt[1]).' '.$dt[0]?></td>
                </tr>
            </table>
            <br>
            <table width="100%" class="bordersolid" style="font-family:arial;line-height: 1.2; font-size: 11pt" border="1">
                <tr>
                    <td rowspan="2" valign="midle" align="center">No.</td>
                    <td rowspan="2" valign="midle" align="center">Uraian Barang</td>
                    <td rowspan="2" valign="midle" align="center">Jumlah</td>
                    <td colspan="2" align="center" width="150px">Harga Penawaran (Rp.)</td>
                    <td colspan="2" align="center" width="150px">Harga Setelah Negoisasi (Rp.)</td>
                    <td rowspan="2" valign="midle" align="center">Keterangan</td>
                </tr>
                <tr>
                    <td align="center">Harga</td>
                    <td align="center">Jumlah</td>
                    <td align="center">Harga</td>
                    <td align="center">Jumlah</td>
                </tr>
                <?php $no=1;$total=0;foreach ((array)$detail as $val) { ?>
                    <tr>
                        <td align="center"><?=$no++?></td>
                        <td> <?=$val['uraian']?></td>
                        <td align="center"><?=$val['jml'].' '.$val['satuan']?></td>
                        <td align="right"><?=number_format($val['harga_satuan'])?></td>
                        <td align="right"><?=number_format($val['harga_satuan']*$val['jml'])?></td>
                        <td align="right"><?=number_format($val['harga_satuan'])?></td>
                        <td align="right"><?=number_format($val['harga_satuan']*$val['jml'])?></td>
                        <td></td>
                    </tr>
                    <?php $total += $val['harga_satuan']*$val['jml']; ?>
                <?php } ?>
                <tr>
                    <td colspan="4" align="center">Jumlah</td>
                    <td align="right"><?=number_format($total)?></td> 
                    <td></td>                   
                    <td align="right"><?=number_format($total)?></td>  
                    <td></td>                  
                </tr>
            </table>
            <br>
            <br>
            <table width="100%" style="font-family:arial;line-height: 1; text-align: center; font-size: 11pt" border="0">
                <tr>
                    <td width="40%"></td>
                    <td width="20%"></td>
                    <td width="40%"><?=$dt[2].' '.$this->help->namaBulan($dt[1]).' '.$dt[0]?></td>
                </tr>
                <tr>
                    <td>Penyedia Jasa</td>
                    <td></td>
                    <td>Pejabat Pembuat Komitmen</td>
                </tr>
                <tr>
                    <td height="60px"></td>
                </tr>
                <tr>
                    <td><b><u><?=$hasil['nama_penerima']?></u></b></td>
                    <td></td>                    
                    <td><b><u><?=$hasil['nama_pejabat_ppk']?></u></b></td>
                </tr>
                <tr>
                    <td><?=$rekanan['nama_rekanan']?></td>
                    <td></td>
                    <td>NIP. <?=$hasil['nip_pejabat_ppk']?></td>
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