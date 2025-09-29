<!doctype html>
<html>
    <head>
        <title>Kwitansi</title>
    </head>
    <body onload="window.print()" style="margin:1">
        <div class="responsive">
            <table width='100%' style='font-family:arial;font-size:9pt' cellspacing='-2' border="0">
                <tr>
                    <td valign='top' rowspan='5' width='50px' align="center"><img src="<?=base_url()?>image/kab_kediri.png" width='40px' height='50px'></td>
                    <td width='500px'>PEMERINTAH KABUPATEN KEDIRI</td>
                    <td width='150px'>No. TBP : <?=$hasil['no_bku']?></td>
                </tr>
                <tr>
                    <td>SEKRETARIAT DAERAH</td>
                    <td>No. LPJ &nbsp;:</td>
                </tr>
                <tr>
                    <td>Jl. Soekarno Hatta No. 01 kediri Telp. (0354) 689901 - 689905</td>
                    <td>Tahun Anggaran : <?=$hasil['tahun']?></td>
                </tr>
            </table>
            <br>
            <table width="100%" style="font-size:11pt;text-align:center;font-family:arial">
                <tr>
                    <td><b>K W I T A N S I</b></td>
                </tr>
                <!-- <tr>
                    <td>Nomor : <?='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' ?><?='/'.$hasil['singkatan_bagian'].'.'.$hasil['singkatan_kegiatan'].'/'?>
                        <?=!empty($hasil['spj_bulan'])?$hasil['spj_bulan']:'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'?>
                        <?='/'.$hasil['tahun']?></td>
                </tr> -->
                <hr style='margin-top:1px;color:black'><hr style='margin-top:-9px;color:black'>
            </table> 
            <br>
            <table width="100%" style="font-size:9pt;font-family:arial;margin-top:-7px;line-height: 1;" border="0">
                <tr>
                    <td valign="top">Kode Sub Kegiatan</td>
                    <td valign="top" align="center">:</td>
                    <td colspan="4"><?=$hasil['kode_kegiatan']?></td>
                </tr>
                <tr>
                    <td valign="top">Kode Rekening Belanja</td>
                    <td valign="top" align="center">:</td>
                    <td colspan="4"><?=$hasil['kode_rekening']?></td>
                </tr>
                <tr>
                    <td>NPWP</td>
                    <td align="center">:</td>
                    <td colspan="4"><?=$hasil['npwp_penerima']?></td>
                </tr>
                <tr>
                    <td width="160px">Sudah Terima Dari</td>
                    <td width="10px" align="center">:</td>
                    <?php
                        $isKuasa = 'Kuasa '; 
                        // if(empty($hasil['nama_pejabat_kpa'])){
                        //     $isKuasa = '';
                        // }
                    ?>
                    <td colspan="4" width="300px"><?=$isKuasa?> Pengguna Anggaran</td>
                </tr>
                <tr>
                    <td>Uang Sebesar</td>
                    <td align="center">:</td>
                    <td colspan="4">Rp. <?=number_format($hasil['banyaknya_uang'])?></td>
                </tr>
                <tr>
                    <td valign="top">Untuk Pembayaran</td>
                    <td valign="top" align="center">:</td>
                    <td colspan="4"><?=$hasil['untuk_pembayaran']?>, sub kegiatan <?=$hasil['kegiatan']?> TA <?=$hasil['tahun']?>, (sebagaimana terlampir).
                        <br>
                        <table style="line-height: 0.8;" cellspacing="-1">
                            <tr>
                                <td></td>
                                <td><?=!empty($hasil['ppn'])?'PPn &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : '.number_format($hasil['ppn']):''?>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <?php
                                        if($hasil['pph_21']){
                                            echo 'PPh 21 &nbsp;&nbsp; : '.number_format($hasil['pph_21']);
                                        }
                                        if($hasil['pph_22']){
                                            echo 'PPh 22 &nbsp;&nbsp; : '.number_format($hasil['pph_22']);
                                        }
                                        if($hasil['pph_23']){
                                            echo 'PPh 23 &nbsp;&nbsp; : '.number_format($hasil['pph_23']);
                                        }
                                    ?>
                                </td>
                        </table>
                    </td>
                </tr>       
                <tr>
                    <td valign="top">Terbilang</td>
                    <td valign="top" align="center">:</td>
                    <td colspan="4"><b><i>(=<?=$this->help->terbilang($hasil['banyaknya_uang'])?> Rupiah=)</i></b></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
            </table> 
            <br>
            <table width="100%" style="font-size:7.6pt;font-family:arial;text-align: center;line-height: 1.1;" border="0" cellspacing="-1" cellpadding="0">
                <tr>
                    <td valign="bottom"></td>
                    <td valign="bottom" width="50%">Kediri, 
                        <?php 
                            if(!empty($hasil['tgl_kwitansi'])){
                                $tglPs = explode('-', $hasil['tgl_kwitansi']);
                                echo $tglPs[2].' '.$this->help->namaBulan($tglPs[1]).' '.$tglPs[0];
                            }else{
                                echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td valign="top">Bendahara <br>Pengeluaran Pembantu</td>
                    <td valign="top">Penerima</td>
                </tr>
                <tr><td height="60px"></td></tr>
                <tr>
                    <td><b><u><?=$hasil['nama_bendahara_pembantu']?></u></b></td>
                    <td><b><u><?=$hasil['nama_penerima']?></u></b></td>
                </tr>
                <tr>
                    <td>NIP. <?=$hasil['nip_bendahara_pembantu']?></td>                    
                    <td><?=$hasil['jabatan_penerima']?></td>
                </tr>
            </table>
            <br>
            <table width="100%" style="font-size:8pt;font-family:arial;text-align: center" border="0" cellspacing="-1" cellpadding="0">
                <tr>
                    <td valign="bottom" width="50%">Menyetujui,</td>
                    <td valign="bottom">Mengetahui,</td>
                </tr>
                <tr>
                    <td><?=$hasil['jabatan_pejabat_kpa']?></td>
                    <td valign="top">PPTK</td>
                </tr>
                <tr>
                    <td valign="bottom">Selaku KPA,</td>
                    <td valign="bottom"></td>
                </tr>
                <tr><td height="60px" colspan="2"></td></tr>
                <tr>
                    <td><b><u><?=$hasil['nama_pejabat_kpa']?></u></b></td>
                    <td><b><u><?=$hasil['nama_pejabat_pptk']?></u></b></td>
                </tr>
                <tr>
                    <td>NIP. <?=$hasil['nip_pejabat_kpa']?></td>
                    <td>NIP. <?=$hasil['nip_pejabat_pptk']?></td>
                </tr>
            </table> 
        </div>
    </body>
</html>