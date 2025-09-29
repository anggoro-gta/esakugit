<!doctype html>
<html>
    <head>
        <title>Halaman 2</title>
    </head>
    <body>
        <div class="responsive">
            <table width="100%" style="font-size:11pt;line-height: 1;" cellspacing="-1" border="0">
                <tr>
                    <td class="border_top border_left" width="30px"></td>
                    <td class="border_top" width="100px"></td>
                    <td class="border_top" width="10px"></td>
                    <td class="border_top" width="240px"></td>
                    <td class="border_top border_left" width="5px"></td>
                    <td class="border_top clrWhite" width="70px">Berangkat Dari</td>
                    <td class="border_top clrWhite" align="center" width="3px" valign="top">:</td>
                    <td class="border_top clrWhite" width="200px" valign="top">Pemerintah Kabupaten Kediri</td>
                    <td class="border_top border_right" width="5px"></td>
                </tr>
                <tr>
                    <td class="border_left"></td>
                    <td colspan="3"></td>
                    <td class="border_left"></td>
                    <td valign="top" class="clrWhite">Ke</td>
                    <td valign="top" align="center" class="clrWhite">:</td>
                    <td valign="top" class="clrWhite"><?=$hasil['kategori']=='DL'?ucwords(strtolower($hasil['kota'])).' ('.$hasil['tujuan_skpd'].')':$hasil['tujuan_skpd']?></td>
                    <td class="border_right"></td>
                </tr>
                <tr>
                    <td class="border_left"></td>
                    <td colspan="3"></td>
                    <td class="border_left"></td>
                    <td class="border_bottom clrWhite">Pada tanggal</td>
                    <td class="border_bottom clrWhite" align="center">:</td>
                    <td class="border_bottom clrWhite"><?=$this->help->ReverseTgl($hasil['tgl_berangkat'])?></td>
                    <td class="border_right"></td>
                </tr>
                <tr>
                    <td class="border_left" colspan="4"></td>
                    <td class="border_left"></td>
                    <?php
                        $ttdJudul = '';
                        if($hasil['urut_ttd_sppd']=='2'){
                            $ttdJudul = 'a.n. BUPATI KEDIRI <br> SEKRETARIS DAERAH <br>u.b.<br> '.$hasil['jabatan_ttd_sppd'];
                        }else if($hasil['urut_ttd_sppd']=='3'){
                            $ttdJudul = $hasil['jabatan_ttd_sppd'].' KABUPATEN KEDIRI';
                        }else if($hasil['urut_ttd_sppd']=='4'){
                            $ttdJudul = 'a.n. KEPALA BAPPEDA KABUPATEN KEDIRI <br>'.$hasil['jabatan_ttd_sppd'];
                        }
                    ?>
                    <td align="center" colspan="3" class="clrWhite"><?=$ttdJudul?></td>
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
                    <td colspan="3" align="center" class="clrWhite"><u><b><?=$hasil['nama_ttd_sppd']?></b></u></td>
                    <td class="border_right"></td>
                </tr>
                <tr>
                    <td class="border_left" height="30px"></td>
                    <td colspan="3"></td>
                    <td class="border_left"></td>
                    <td valign="top" colspan="3" align="center" class="clrWhite">NIP. <?=$hasil['nip_ttd_sppd']?></td>
                    <td class="border_right"></td>
                </tr>                
                <tr>
                    <td colspan="4" class="border_left border_top" height="7px"></td>
                    <td class="border_left border_top"></td>
                    <td class="border_right border_top" colspan="4"></td>
                </tr>
                <tr>
                    <td class="border_left clrWhite" valign="top">&nbsp;II.</td>
                    <td valign="top" class="clrWhite">Tiba di</td>
                    <td valign="top" align="center" class="clrWhite">:</td>
                    <td valign="top" class="clrWhite"><?=$hasil['kategori']=='DL'?ucwords(strtolower($hasil['kota'])).' ('.$hasil['tujuan_skpd'].')':$hasil['tujuan_skpd']?></td>
                    <td class="border_left"></td>
                    <td valign="top" class="clrWhite">Berangkat dari</td>
                    <td valign="top" align="center" class="clrWhite">:</td>
                    <td valign="top" class="clrWhite"><?=$hasil['kategori']=='DL'?ucwords(strtolower($hasil['kota'])).' ('.$hasil['tujuan_skpd'].')':$hasil['tujuan_skpd']?></td>
                    <td class="border_right"></td>
                </tr>
                <tr>
                    <td class="border_left"></td>
                    <td valign="top" class="clrWhite">Pada tanggal</td>
                    <td valign="top" align="center" class="clrWhite">:</td>
                    <td valign="top" class="clrWhite"><?=$this->help->ReverseTgl($hasil['tgl_berangkat'])?></td>
                    <td class="border_left"></td>
                    <td valign="top" class="clrWhite">Ke</td>
                    <td valign="top" align="center" class="clrWhite">:</td>
                    <td valign="top" class="clrWhite">Pemerintah Kabupaten Kediri</td>
                    <td class="border_right"></td>
                </tr>
                <tr>
                    <td class="border_left"></td>
                    <td valign="top"></td>
                    <td valign="top" align="center"></td>
                    <td valign="top"></td>
                    <td class="border_left"></td>
                    <td class="border_bottom" valign="top" class="clrWhite">Pada tanggal</td>
                    <td class="border_bottom clrWhite" valign="top" align="center">:</td>
                    <td class="border_bottom clrWhite" valign="top"><?=$this->help->ReverseTgl($hasil['tgl_tiba'])?></td>
                    <td class="border_right"></td>
                </tr>
                <tr>
                    <td class="border_left" height="80px" valign="top" align="center" colspan="4"><?=$jabatan?></td>
                    <td class="border_left"></td>
                    <td class="border_right" valign="top" align="center" colspan="4"><?=$jabatan?></td>
                </tr>
                <tr>
                    <td align="center" colspan="4" class="border_left"><?=$nama?></td>
                    <td class="border_left"></td>
                    <td align="center" colspan="4" class="border_right"><?=$nama?></td>
                </tr>
                <tr>
                    <td class="border_left" valign="top" align="center" colspan="4">NIP. <?=$nip?></td>
                    <td class="border_left"></td>
                    <td class="border_right" valign="top" align="center" colspan="4">NIP. <?=$nip?></td>
                </tr>               
                <tr>
                    <td colspan="4" class="border_left border_top" height="7px"></td>
                    <td class="border_left border_top"></td>
                    <td class="border_right border_top" colspan="4"></td>
                </tr>
            </table>
        </div>
    </body>
</html>
<style type="text/css">
.border_right{
    border-right: 1px solid white;
}
.border_left{
    border-left: 1px solid white;
}
.border_top{
    border-top: 1px solid white;
}
.border_bottom{
    border-bottom: 1px solid white;
}
.clrWhite{
    color: white;
}
</style>