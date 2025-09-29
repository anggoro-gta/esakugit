<!doctype html>
<html>
    <head>
        <title>Cetak SPPD</title>
    </head>
    <body>
        <div class="responsive">
            <?php for ($i=1; $i <=5 ; $i++) { ?>
                <table width="100%" style="font-size:10pt;font-family:tahoma;line-height: 1.2;" border="1" cellspacing='-1'>
                    <tr>
                        <td width="50%" rowspan="2">
                            <div>
                            <table width='100%' border="0" style="line-height: 1;text-align:center;">
                                <tr>
                                    <td valign='top' rowspan='4' width='50px' align="center"><img src="<?=base_url()?>image/kab_kediri.png" width='50px' height='60px'></td>
                                    <td width='500px'><b>PEMERINTAH KABUPATEN KEDIRI</b></td>
                                </tr>
                                <tr>
                                    <td><b>BADAN PENDAPATAN DAERAH</b></td>
                                </tr>
                                <tr>
                                    <td>Jl. Soekarno - Hatta No. 1 Telp. (0354) 672752</td>
                                </tr>
                                <tr>
                                    <td><b>KEDIRI</b></td>
                                </tr>
                            </table>
                            </div>
                        </td>
                        <td valign="top" class="border_all" align="center" rowspan="2">
                            <span style="font-size: 18pt"><b>SSPD</b></span><br>
                            (SURAT SETORAN PAJAK DAERAH)<br>
                            Tahun <?=$hasil['tahun']?>
                        </td>
                        <td valign="top" class="border_top">
                            &nbsp;LEMBAR
                        </td>
                        <td valign="top" align="right">
                            &nbsp;
                            <table border="0" style="font-size: 20pt;" cellspacing='-1'>
                                <tr>
                                    <td class="border_all"><b>&nbsp;<?=$i?>&nbsp;</b></td>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center" width="150px" class="border_right">Untuk Wajib Pajak</td>
                    </tr>
                </table> 
                <table width="100%" style="font-size:10pt;font-family:tahoma;line-height: 1.4;" border="0" cellspacing='-1'>
                    <tr>
                        <td colspan="11" class="border_left border_right">&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="100px" class="border_left">&nbsp;</td>
                        <td colspan="2" width="150px">Nama Wajib Pajak</td>
                        <td align="center" width="30px">:</td>
                        <td colspan="6" class="border_bottom_grey" style=""><?=$rekanan['nama_rekanan'].' ('.$rekanan['nama_pemilik'].')'?></td>
                        <td width="40px" class="border_right"></td>
                    </tr>
                    <tr>
                        <td class="border_left"></td>
                        <td width="75px">Alamat</td>
                        <td>Jalan</td>
                        <td align="center" >:</td>
                        <td colspan="6" class="border_bottom_grey"><?=$rekanan['jalan']?></td>
                        <td class="border_right"></td>
                    </tr>
                    <tr>
                        <td class="border_left"></td>
                        <td></td>
                        <td>Desa</td>
                        <td align="center" >:</td>
                        <td colspan="6" class="border_bottom_grey"><?=$rekanan['desa_kel']?></td>
                        <td class="border_right"></td>
                    </tr>
                    <tr>
                        <td class="border_left"></td>
                        <td></td>
                        <td>Kecamatan</td>
                        <td align="center" >:</td>
                        <td colspan="6" class="border_bottom_grey"><?=$rekanan['kecamatan']?></td>
                        <td class="border_right"></td>
                    </tr>
                    <tr>
                        <td class="border_left"></td>
                        <td></td>
                        <td>Kabupaten</td>
                        <td align="center" >:</td>
                        <td colspan="6" class="border_bottom_grey"><?=$rekanan['kab_kota']?></td>
                        <td class="border_right"></td>
                    </tr>
                    <tr>
                        <td class="border_left"></td>
                        <td colspan="2">NPWPD</td>
                        <td align="center" >:</td>
                        <td colspan="6" class="border_bottom_grey"><?=$rekanan['npwp']?></td>
                        <td class="border_right"></td>
                    </tr>
                    <tr>
                        <td colspan="11" class="border_left border_right" height="7px"></td>
                    </tr>
                    <tr>
                        <td class="border_left"></td>
                        <td colspan="2">Menyetor berdasarkan *)</td>
                        <td align="center" >:</td>
                        <td class="border_all" width="25px"></td>
                        <td width="100px">&nbsp;SKPD</td>
                        <td class="border_all" width="25px"></td>
                        <td width="100px">&nbsp;STPD</td>
                        <td class="border_all" width="25px"></td>
                        <td>&nbsp;Lain-lain</td>
                        <td class="border_right"></td>
                    </tr>
                    <tr>
                        <td colspan="11" class="border_left border_right" height="7px"></td>
                    </tr>
                    <tr>
                        <td class="border_left" colspan="4"></td>
                        <td class="border_all"></td>
                        <td>&nbsp;SKPDT</td>
                        <td class="border_all" align="center">&radic;</td>
                        <td colspan="3">&nbsp;SPTPD</td>
                        <td class="border_right"></td>
                    </tr>
                    <tr>
                        <td colspan="11" class="border_left border_right" height="7px"></td>
                    </tr>
                    <tr>
                        <td class="border_left" colspan="4"></td>
                        <td class="border_all"></td>
                        <td>&nbsp;SKPDKB</td>
                        <td class="border_all"></td>
                        <td colspan="3">&nbsp;SK Pembetulan</td>
                        <td class="border_right"></td>
                    </tr>                
                    <tr>
                        <td colspan="11" class="border_left border_right" height="7px"></td>
                    </tr>
                    <tr>
                        <td class="border_left" colspan="4"></td>
                        <td class="border_all"></td>
                        <td>&nbsp;SKPDKBT</td>
                        <td class="border_all"></td>
                        <td colspan="3">&nbsp;SK Keberatan</td>
                        <td class="border_right"></td>
                    </tr>               
                    <tr>
                        <td colspan="11" class="border_left border_right" height="7px"></td>
                    </tr>
                    <tr>
                        <td class="border_left"></td>
                        <td>Masa Pajak :</td>
                        <td class="border_bottom_grey"></td>
                        <td align="right" colspan="2">Tahun :</td>
                        <td class="border_bottom_grey"></td>
                        <td></td>
                        <td align="right">No. Urut :</td>
                        <td class="border_bottom_grey " colspan="2"></td>
                        <td class="border_right"></td>
                    </tr>             
                    <tr>
                        <td colspan="11" class="border_left border_right" height="7px"></td>
                    </tr>
                </table> 
                <?php $tgl = explode('-', $tgl_cetak); ?>
                <table width="100%" style="font-size:10pt;font-family:tahoma;line-height: 1.4;" border="1" cellspacing='-1'>
                    <tr>
                        <td align="center" width="30px">No.</td>
                        <td align="center" width="120px">Kode <br> Rekening</td>
                        <td align="center">Jenis <br> Pajak Daerah</td>
                        <td align="center" colspan="3" width="200px">Uraian</td>
                        <td align="center">Jumlah Pajak <br> (Rp.)</td>
                    </tr>
                    <tr>
                        <td align="center">1.</td>
                        <td align="center">4. 1. 1. 2. 1.</td>
                        <td align="center"><b>PAJAK <br>RESTORAN</b></td>
                        <td class="no_border_right" width="120px" valign="top">Nama Satker</td>
                        <td class="no_border_left no_border_right" valign="top" width="20px">:</td>
                        <td class="no_border_left no_border_right"><?=$bag->nama_bagian?> Kab. Kediri</td>
                        <td align="right"><?=number_format($pajakDaerah,2,',','.')?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="no_border_right">Tanggal kegiatan</td>
                        <td class="no_border_left no_border_right">:</td>
                        <td class="no_border_left no_border_right"><?=$this->help->namaBulan($tgl[1]).' '.$tgl[2]?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td valign="top" class="no_border_right">Nama kegiatan</td>
                        <td valign="top" class="no_border_left no_border_right">:</td>
                        <td class="no_border_left no_border_right">Makan minum <?=$kategori?> sub kegiatan <?=$hasil['kegiatan']?> TA. <?=$hasil['tahun']?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td></td>
                        <td></td>
                        <td colspan="3"></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="3" align="center">Jumlah Setoran Pajak</td>
                        <td align="right"><?=number_format($pajakDaerah,2,',','.')?></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center" class="no_border_bottom"> Dengan huruf : </td>
                        <td colspan="5" class="no_border_bottom"> &nbsp;<i><?=$this->help->terbilang($pajakDaerah)?> Rupiah</i></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="no_border_top no_border_bottom"></td>
                        <td colspan="5" class="no_border_top no_border_bottom">&nbsp;</td>
                    </tr>
                </table>
                <table width="100%" style="font-size:10pt;font-family:tahoma;line-height: 1.2;" border="1" cellspacing='-1'>
                    <tr>
                        <td width="33%" align="center" class="no_border_bottom no_border_top">
                            Ruang untuk Teraan<br>
                            Kas Regester / Tanda Tangan<br>
                            Petugas Penerima
                        </td>
                        <td width="33%" align="center" class="no_border_bottom no_border_top">
                            Diterima oleh,<br>
                            Petugas Tempat Pembayaran<br>
                            Tanggal :
                        </td>
                        <td align="center" class="no_border_bottom no_border_top">
                            Kediri, <?=$tgl[0].' '.$this->help->namaBulan($tgl[1]).' '.$tgl[2]?><br>
                            Penyetor
                        </td>
                        <tr>
                            <td height="70px"  class="no_border_top no_border_bottom">&nbsp;</td>
                            <td class="no_border_top no_border_bottom"></td>
                            <td class="no_border_top no_border_bottom"></td>
                        </tr>
                        <?php
                            $nmaBndhra = $hasil['nama_bendahara_pembantu'];
                            $nipBndhra = $hasil['nip_bendahara_pembantu'];
                            if(empty($hasil['nama_bendahara_pembantu'])){
                                $nmaBndhra = $hasil['nama_bendahara'];
                                $nipBndhra = $hasil['nip_bendahara'];
                            }
                        ?>
                        <tr>
                            <td class="no_border_top no_border_bottom" align="center"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
                            <td class="no_border_top no_border_bottom" align="center"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
                            <td class="no_border_top no_border_bottom" align="center"><u><?=$nmaBndhra?></u></td>
                        </tr>
                        <tr>
                            <td class="no_border_top"></td>
                            <td class="no_border_top"></td>
                            <td class="no_border_top" align="center">NIP. <?=$nipBndhra?></td>
                        </tr>
                    </tr>
                </table> 
                <br>
                <table width="100%" style="font-size:10pt;font-family:tahoma;line-height: 1.4;" border="0" cellspacing='-1'>
                    <tr>
                        <td width="50px"></td>
                        <td width="180px">*) Beri tanda V pada kotak</td>
                        <td width="20px" class="border_all"></td>
                        <td> &nbsp; sesuai dengan ketetapan yang dimiliki</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="4"><u>KETERANGAN :</u></td>
                    </tr>
                    <tr>
                        <td colspan="4">Lembar ke 1 : Untuk Wajib Pajak</td>
                    </tr>
                    <tr>
                        <td colspan="4">Lembar ke 2 : Untuk Bagian Pendapatan BAPENDA</td>
                    </tr>
                    <tr>
                        <td colspan="4">Lembar ke 3 : Untuk Bendahara OPD</td>
                    </tr>
                    <tr>
                        <td colspan="4">Lembar ke 4 : Untuk Kasda/Bank Jatim</td>
                    </tr>
                    <tr>
                        <td colspan="4">Lembar ke 5 : Untuk dikirim ke BAPENDA melalui Bank Jatim</td>
                    </tr>
                </table> 
                <?php if($i<5){ ?>
                    <pagebreak>
                <?php } ?>        
            <?php } ?>        
        </div>
    </body>
</html>
<style type="text/css">
.border_all{
    border: 1px solid #000;
}
.border_top{
    border-top: 1px solid #000;
}
.border_right{
    border-right: 1px solid #000;
}
.border_left{
    border-left: 1px solid #000;
}
.border_bottom{
    border-bottom: 1px solid #000;
}
.border_bottom_grey{
    border-bottom: 1px solid #E1DBDB;
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