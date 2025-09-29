<!doctype html>
<html>
    <head>
        <title>Halaman 2</title>
    </head>
    <body onload="window.print()" style="margin:0">
        <div class="responsive">
            <table width="100%" class="bordersolid" style="font-size:11pt;line-height: 1;" cellspacing="-1" border="0">
                <tr>
                    <td class="border_top border_left" width="30px"></td>
                    <td class="border_top" width="100px"></td>
                    <td class="border_top" width="10px"></td>
                    <td class="border_top" width="200px"></td>
                    <td class="border_top border_left" width="5px" valign="top">&nbsp;I.</td>
                    <td class="border_top" width="80px">Berangkat dari</td>
                    <td class="border_top" align="center" width="3px" valign="top">:</td>
                    <td class="border_top" width="200px" valign="top">Pemerintah Kabupaten Kediri</td>
                    <td class="border_top border_right" width="5px"></td>
                </tr>
                <tr>
                    <td class="border_left"></td>
                    <td colspan="3"></td>
                    <td class="border_left"></td>
                    <td valign="top">Ke</td>
                    <td valign="top" align="center">:</td>
                    <td valign="top"><?=$hasil['kategori']=='DL'?ucwords(strtolower($hasil['kota'])).' ('.$hasil['tujuan_skpd'].')':$hasil['tujuan_skpd']?></td>
                    <td class="border_right"></td>
                </tr>
                <tr>
                    <td class="border_left"></td>
                    <td colspan="3"></td>
                    <td class="border_left"></td>
                    <td class="border_bottom">Pada tanggal</td>
                    <td class="border_bottom" align="center">:</td>
                    <td class="border_bottom"><?=$this->help->ReverseTgl($hasil['tgl_berangkat'])?></td>
                    <td class="border_right"></td>
                </tr>
                <tr>
                    <td class="border_left" colspan="4"></td>
                    <td class="border_left"></td>
                    <?php
                        $ttdJudul = '';
                        // if($hasil['urut_ttd_sppd']=='2'){
                        //     $ttdJudul = 'a.n. BUPATI KEDIRI <br> SEKRETARIS DAERAH <br>u.b.<br> '.$hasil['jabatan_ttd_sppd'];
                        // }else if($hasil['urut_ttd_sppd']=='3'){
                        //     $ttdJudul = $hasil['jabatan_ttd_sppd'].' KABUPATEN KEDIRI';
                        // }else if($hasil['urut_ttd_sppd']=='4'){
                        //     $ttdJudul = 'a.n. ... <br>'.$hasil['jabatan_ttd_sppd'];
                        // }
                        $ttdJudul = $hasil['jabatan_ttd_sppd'];
                    ?>
                    <td colspan="3"><?=$ttdJudul?></td>
                    <td class="border_right"></td>
                </tr>
                <tr>
                    <td colspan="4" class="border_left" height="70px"></td>
                    <td class="border_left"></td>
                    <td class="border_right" colspan="4"></td>
                </tr>
                <tr>
                    <td class="border_left"></td>
                    <td colspan="3"></td>
                    <td class="border_left"></td>
                    <td colspan="3" ><u><b><?=$hasil['nama_ttd_sppd']?></b></u></td>
                    <td class="border_right"></td>
                </tr>
                <tr>
                    <td class="border_left" height="30px"></td>
                    <td colspan="3"></td>
                    <td class="border_left"></td>
                    <td valign="top" colspan="3" >NIP. <?=$hasil['nip_ttd_sppd']?></td>
                    <td class="border_right"></td>
                </tr>                
                <tr>
                    <td colspan="4" class="border_left border_top" height="7px"></td>
                    <td class="border_left border_top"></td>
                    <td class="border_right border_top" colspan="4"></td>
                </tr>
                <tr>
                    <td class="border_left" valign="top">&nbsp;II.</td>
                    <td valign="top">Tiba di</td>
                    <td valign="top" align="center">:</td>
                    <td valign="top"><?=$hasil['kategori']=='DL'?ucwords(strtolower($hasil['kota'])).' ('.$hasil['tujuan_skpd'].')':$hasil['tujuan_skpd']?></td>
                    <td class="border_left"></td>
                    <td valign="top">Berangkat dari</td>
                    <td valign="top" align="center">:</td>
                    <td valign="top"><?=$hasil['kategori']=='DL'?ucwords(strtolower($hasil['kota'])).' ('.$hasil['tujuan_skpd'].')':$hasil['tujuan_skpd']?></td>
                    <td class="border_right"></td>
                </tr>
                <tr>
                    <td class="border_left"></td>
                    <td valign="top">Pada tanggal</td>
                    <td valign="top" align="center">:</td>
                    <td valign="top"><?=$this->help->ReverseTgl($hasil['tgl_berangkat'])?></td>
                    <td class="border_left"></td>
                    <td valign="top">Ke</td>
                    <td valign="top" align="center">:</td>
                    <td valign="top">Pemerintah Kabupaten Kediri</td>
                    <td class="border_right"></td>
                </tr>
                <tr>
                    <td class="border_left"></td>
                    <td valign="top"></td>
                    <td valign="top" align="center"></td>
                    <td valign="top"></td>
                    <td class="border_left"></td>
                    <td class="border_bottom" valign="top">Pada tanggal</td>
                    <td class="border_bottom" valign="top" align="center">:</td>
                    <td class="border_bottom" valign="top"><?=$this->help->ReverseTgl($hasil['tgl_tiba'])?></td>
                    <td class="border_right"></td>
                </tr>
                <tr>
                    <td class="border_left" height="70px" colspan="4"></td>
                    <td class="border_left"></td>
                    <td class="border_right" colspan="4"></td>
                </tr>
                 <tr>
                    <td class="border_left"></td>
                    <td colspan="3">(<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>)<br>NIP. </td>
                    <td class="border_left"></td>
                    <td colspan="4" class="border_right">(<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>)<br>NIP. </td>
                </tr>
                <tr>
                    <td class="border_left" colspan="4">&nbsp;</td>
                    <td class="border_left"></td>
                    <td class="border_right" colspan="4"></td>
                </tr>               
                <tr>
                    <td colspan="4" class="border_left border_top" height="7px"></td>
                    <td class="border_left border_top"></td>
                    <td class="border_right border_top" colspan="4"></td>
                </tr>
                <tr>
                    <td class="border_left" valign="top">&nbsp;III.</td>
                    <td valign="top">Tiba di</td>
                    <td valign="top" align="center">:</td>
                    <td valign="top">....................................</td>
                    <td class="border_left"></td>
                    <td valign="top">Berangkat dari</td>
                    <td valign="top" align="center">:</td>
                    <td valign="top">....................................</td>
                    <td class="border_right"></td>
                </tr>
                <tr>
                    <td class="border_left"></td>
                    <td valign="top">Pada tanggal</td>
                    <td valign="top" align="center">:</td>
                    <td valign="top">....................................</td>
                    <td class="border_left"></td>
                    <td valign="top">Ke</td>
                    <td valign="top" align="center">:</td>
                    <td valign="top">....................................</td>
                    <td class="border_right"></td>
                </tr>
                <tr>
                    <td class="border_left"></td>
                    <td valign="top"></td>
                    <td valign="top" align="center"></td>
                    <td valign="top"></td>
                    <td class="border_left"></td>
                    <td class="border_bottom" valign="top">Pada tanggal</td>
                    <td class="border_bottom" valign="top" align="center">:</td>
                    <td class="border_bottom" valign="top">....................................</td>
                    <td class="border_right"></td>
                </tr>
                <tr>
                    <td class="border_left" height="70px" colspan="4"></td>
                    <td class="border_left"></td>
                    <td class="border_right" colspan="4"></td>
                </tr>
                 <tr>
                    <td class="border_left"></td>
                    <td colspan="3">(<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>)<br>NIP. </td>
                    <td class="border_left"></td>
                    <td colspan="4" class="border_right">(<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>)<br>NIP. </td>
                </tr>
                <tr>
                    <td class="border_left" colspan="4">&nbsp;</td>
                    <td class="border_left"></td>
                    <td class="border_right" colspan="4"></td>
                </tr>              
                <tr>
                    <td colspan="4" class="border_left border_top" height="7px"></td>
                    <td class="border_left border_top"></td>
                    <td class="border_right border_top" colspan="4"></td>
                </tr>
                <tr>
                    <td class="border_left" valign="top">&nbsp;IV.</td>
                    <td valign="top">Tiba di</td>
                    <td valign="top" align="center">:</td>
                    <td valign="top">....................................</td>
                    <td class="border_left"></td>
                    <td valign="top">Berangkat dari</td>
                    <td valign="top" align="center">:</td>
                    <td valign="top">....................................</td>
                    <td class="border_right"></td>
                </tr>
                <tr>
                    <td class="border_left"></td>
                    <td valign="top">Pada tanggal</td>
                    <td valign="top" align="center">:</td>
                    <td valign="top">....................................</td>
                    <td class="border_left"></td>
                    <td valign="top">Ke</td>
                    <td valign="top" align="center">:</td>
                    <td valign="top">....................................</td>
                    <td class="border_right"></td>
                </tr>
                <tr>
                    <td class="border_left"></td>
                    <td valign="top"></td>
                    <td valign="top" align="center"></td>
                    <td valign="top"></td>
                    <td class="border_left"></td>
                    <td class="border_bottom" valign="top">Pada tanggal</td>
                    <td class="border_bottom" valign="top" align="center">:</td>
                    <td class="border_bottom" valign="top">....................................</td>
                    <td class="border_right"></td>
                </tr>
                <tr>
                    <td class="border_left" height="70px" colspan="4"></td>
                    <td class="border_left"></td>
                    <td class="border_right" colspan="4"></td>
                </tr>
                <tr>
                    <td class="border_left"></td>
                    <td colspan="3">(<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>)<br>NIP. </td>
                    <td class="border_left"></td>
                    <td colspan="4" class="border_right">(<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>)<br>NIP. </td>
                </tr>
                <tr>
                    <td class="border_left" colspan="4">&nbsp;</td>
                    <td class="border_left"></td>
                    <td class="border_right" colspan="4"></td>
                </tr>              
                <tr>
                    <td colspan="4" class="border_left border_top" height="7px"></td>
                    <td class="border_left border_top"></td>
                    <td class="border_right border_top" colspan="4"></td>
                </tr>
                <tr>
                    <td class="border_left" valign="top">&nbsp;V.</td>
                    <td valign="top">Tiba di</td>
                    <td valign="top" align="center">:</td>
                    <td valign="top">Pemerintah Kabupaten Kediri</td>
                    <td rowspan="3" class="border_left"></td>
                    <td rowspan="3" align="justify" colspan="3">Telah diperiksa, dengan keterangan bahwa perjalanan tersebut diatas benar dilakukan atas perintahnya dan semata-mata untuk kepentingan jabatan dalam waktu yang sesingkat-singkatnya.</td>
                    <td rowspan="3" class="border_right"></td>
                </tr>
                <tr>
                    <td class="border_left"></td>
                    <td valign="top">Pada tanggal</td>
                    <td valign="top" align="center">:</td>
                    <td valign="top"></td>
                </tr>
                <tr>
                    <td class="border_left"></td>
                    <td valign="top"></td>
                    <td valign="top" align="center"></td>
                    <td valign="top"></td>
                </tr>
                <tr>
                    <td class="border_left" colspan="4" align="center"></td>
                    <td class="border_left"></td>
                    <td class="border_right" colspan="4"  align="center"></td>
                </tr>
                <tr>
                    <td class="border_left" height="70px" colspan="4"></td>
                    <td class="border_left"></td>
                    <td class="border_right" colspan="4"></td>
                </tr>                
                <tr>
                    <td class="border_left"></td>
                    <td colspan="3"><u><b>(<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>)</b></u></td>
                    <td class="border_left"></td>
                    <td colspan="3" align="center"><u><b></b></u></td>
                    <td class="border_right"></td>
                </tr>
                <tr>
                    <td class="border_left"></td>
                    <td height="30px" valign="top" colspan="3">NIP. </td>
                    <td class="border_left"></td>
                    <td valign="top" colspan="3" align="center"></td>
                    <td class="border_right"></td>
                </tr>
                <tr>
                    <td class="border_left border_top border_bottom">VI.</td>
                    <td class="border_top border_bottom" colspan="3">Catatan lain - lain</td>
                    <td class="border_left border_top border_bottom"></td>
                    <td class="border_right border_top border_bottom" colspan="4"></td>
                </tr>
                <tr>
                    <td class="border_left border_top border_bottom">VII.</td>
                    <td class="border_top border_bottom" colspan="3">PERHATIAN:<br>
                        PA/KPA yang menerbitkan SPD, pegawai yang melakukan perjalanan dinas, para pejabat yang mengesahkan tanggal berangkat/tiba, serta bendahara pengeluaran bertanggung jawab berdasarkan peraturanperaturan Keuangan Negara apabila negara menderita rugi akibat kesalahan, kelalaian, dan kealpaannya.
                    </td>
                    <td class="border_left border_top border_bottom"></td>
                    <td class="border_right border_top border_bottom" colspan="4"></td>
                </tr>
            </table>
            <br>
            <table width="100%" style="font-size:11pt;">
                <tr>
                    <td width="400px"></td>
                    <td>Dikeluarkan di</td>
                    <td style="width: 10px">:</td>
                    <td>KEDIRI</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="3" style="padding-top: -15px"><hr class="bordersolid" style="color:black"></td>
                </tr>
                <tr>
                    <td></td>
                    <td align="center" colspan="3">Pengguna Anggaran/ Kuasa Pengguna Anggaran</td>
                </tr>
                <tr><td height="50px"></td></tr>
                <tr>
                    <td></td>
                    <td align="center" colspan="3"><u><b><?=$hasil['nama_pejabat_kpa']?></b></u></td>
                </tr>
                <tr>
                    <td></td>
                    <td align="center" colspan="3">NIP. <?=$hasil['nip_pejabat_kpa']?></td>
                </tr>
            </table>
        </div>
    </body>
</html>
<style type="text/css">
.border_right{
    border-right: 1px solid #000;
}
.border_left{
    border-left: 1px solid #000;
}
.border_top{
    border-top: 1px solid #000;
}
.border_bottom{
    border-bottom: 1px solid #000;
}
.bordersolid{
    border: 1px solid black; border-collapse: collapse;
}
</style>