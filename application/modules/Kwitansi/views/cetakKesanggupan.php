<!doctype html>
<html>
    <head>
        <title>Kesanggupan Kerja</title>
    </head>
    <body>
        <div class="responsive">
        	<?php 
                if(empty($hasil['tgl_kesepakatan_harga'])){
                    die('<tr><td>Silahkan diisi dahulu kolom <b>Tgl Kesepakatan Harga</b></td></tr>');
                }
                $dt = explode('-', $hasil['tgl_kesepakatan_harga']); 
                $psn = explode('-', $hasil['tgl_pesanan']); 
            ?>
            <table width="100%" style="font-family:arial;line-height: 1.2; font-size: 11pt" cellspacing="-1">
            	<tr>
            		<td colspan="6" valign="top" align="center">KOP SURAT REKANAN<br><br><br><br></td>
            	</tr>
            	<tr>
            		<td width="120px">&nbsp;</td>
            		<td width="10px"></td>
            		<td width="200px">&nbsp;</td>
            		<td width="100px"></td>
            		<td colspan="2">Kediri, <?=$dt[2].' '.$this->help->namaBulan($dt[1]).' '.$dt[0]?></td>
            	</tr>
            	<tr>
            		<td>Nomor</td>
            		<td>:</td>
            		<td></td>
            		<td></td>
            		<td colspan="2">Kepada</td>
            	</tr>
            	<tr>
            		<td>Perihal</td>
            		<td>:</td>
            		<td><b><u>Kesanggupan Kerja</u></b></td>
            		<td></td>
            		<td colspan="2">Yth. Pejabat Pembuat Komitmen</td>
            	</tr>
            	<tr>
            		<td></td>
            		<td></td>
            		<td></td>
            		<td></td>
            		<td width="26px"></td>
            		<td><?=$bag->nama_bagian?> Kabupaten Kediri</td>
            	</tr>
            	<tr>
            		<td></td>
            		<td></td>
            		<td></td>
            		<td></td>
            		<td width="26px"></td>
            		<td>di<br>&nbsp;&nbsp; <u>Tempat</u></td>
            	</tr>
            </table>
            <div>
            	<p align="justify" style="font-family:arial;line-height: 1.2; font-size: 11pt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Menanggapi Surat Saudara Nomor : 021/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/<?=$bag->kode_bagian?>/<?=$hasil['tahun']?> tanggal <?=$psn[2].' '.$this->help->namaBulan($psn[1]).' '.$psn[0]?> perihal : <?=!empty($hasil['perihal'])?$hasil['perihal']:$hasil['untuk_pembayaran']?> sub kegiatan <?=$hasil['kegiatan']?> Tahun Anggaran <?=$hasil['tahun']?>, sebagai berikut :
            	</p>
            </div>
             <table width="100%" style="font-family:arial;line-height: 1.5; font-size: 11pt" class="bordersolid" border="1" cellspacing="-1">
            	<tr>
            		<td align="center">No.</td>
            		<td align="center">Uraian</td>
                    <td align="center">Volume</td>
            		<td align="center">Harga Satuan (Rp)</td>
            		<td align="center">Jumlah (Rp)</td>
            	</tr>
                <?php $no=1;$total=0;foreach ((array)$detail as $val) { ?>
                    <tr>
                        <td align="center"><?=$no++?></td>
                        <td> <?=$val['uraian']?></td>
                        <td align="center"><?=$val['jml'].' '.$val['satuan']?></td>
                        <td align="right"><?=number_format($val['harga_satuan'])?></td>
                        <td align="right"><?=number_format($val['harga_satuan']*$val['jml'])?></td>
                    </tr>
                    <?php $total += $val['harga_satuan']*$val['jml']; ?>
                <?php } ?>
            	<tr>
            		<td align="center" colspan="4">JUMLAH</td>
            		<td align="right"><?=number_format($total)?></td>
            	</tr>
            </table>
            <div>
            	<p align="justify" style="font-family:arial;line-height: 1.2; font-size: 11pt">
            		Terbilang : === <i><?=$this->help->terbilang($total)?> Rupiah</i> ===
            		<br>
            		<br>
            		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Demikian Surat Pernyataan Kesanggupan Kerja kami buat untuk dapat digunakan sebagaimana mestinya.
            	</p>
            </div>
            <br>
            <br>
            <table width="100%" style="font-family:arial;line-height: 1; font-size: 11pt; text-align: center" cellspacing="-1">
            	<tr>
            		<td width="50%"></td>
            		<td>Hormat Kami,</td>
            	</tr>
            	<tr>
            		<td>&nbsp;</td>
            		<td></td>
            	</tr>
            	<tr>
            		<td>&nbsp;</td>
            		<td></td>
            	</tr>
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                </tr>
            	<tr>
            		<td></td>
            		<td><b><u><?=$hasil['nama_penerima']?></u></b></td>
            	</tr>
            	<tr>
            		<td></td>
            		<td><?=$rekanan['nama_rekanan']?></td>
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