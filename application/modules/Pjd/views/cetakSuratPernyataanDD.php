<!doctype html>
<html>
    <head>
        <title>Surat Pernyataan</title>
    </head>
    <body onload="window.print()" style="margin:0">
        <div class="responsive">
            <div><?=$header?></div>
            <table width="100%" style="font-size:13pt;text-align:center;font-family:tahoma">
                <tr>
                    <td><b>SURAT PERNYATAAN PERJALANAN DINAS</b></td>
                </tr>
            </table>
            <br>
            <table width="100%" style="font-size:11pt;line-height: 1.2;font-family:tahoma" border="0" cellspacing="-1">
                <tr>
                    <td colspan="4">Yang bertandatangan di bawah ini :</td>
                </tr>
                <?php if(count($detail)<=3){ ?>
                    <?php $nonya=1; foreach ($detail as $val2) { ?>
                        <tr>
                            <td width="50px" align="center"><?=$nonya++?>.</td>
                            <td width="100px">Nama</td>
                            <td width="20px">:</td>
                            <td><?=$val2['nama_sdm']?></td>
                        </tr>
                        <?php if($val2['nip']!='-'){ ?>
                            <tr>
                                <td></td>
                                <td>NIP</td>
                                <td>:</td>
                                <td><?=$val2['nip']?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Pangkat/Gol.</td>
                                <td>:</td>
                                <td><?=$val2['pangkat_gol']?></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td></td>
                            <td>Jabatan</td>
                            <td>:</td>
                            <td><?=$val2['jabatan']?></td>
                        </tr>
                    <?php } ?>
                <?php }else{ ?>
                    <tr>
                        <td width="50px"></td>
                        <td colspan="3">
                            <table width="100%" style="font-size:11pt;line-height: 1.2;font-family:tahoma" class="bordersolid" border="1" cellspacing="-1">
                                <tr>
                                    <th width="40px">No.</th>
                                    <th>Nama</th>
                                    <th>NIP</th>
                                    <th>Pangkat/Gol.</th>
                                    <th>Jabatan</th>
                                </tr>
                                <?php $no=1; foreach ($detail as $val) { ?>
                                     <tr>
                                         <td valign="top" align="center"><?=$no++?></td>
                                         <td valign="top"><?=$val['nama_sdm']?></td>
                                         <td valign="top"><?=$val['nip']?></td>
                                         <td valign="top"><?=$val['pangkat_gol']?></td>
                                         <td valign="top"><?=$val['jabatan']?></td>
                                     </tr>
                                <?php } ?>
                            </table>
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <?php
                    $tgl = explode('-', $hasil['tgl_surat_tugas']);
                ?>
                <tr>
                    <?php
                        $nonya = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                        if(!empty($hasil['no_surat_tugas'])){
                            $nonya = $hasil['no_surat_tugas'];
                        }

                        $no_st = '094/'.$nonya.'/'.$kelAss->kode_bagian.'/'.$tgl[0];
                        if($hasil['asal_surat_tugas']=='Luar'){
                            $no_st = $hasil['no_surat_tugas'];
                        }
                    ?> 
                    <td colspan="4" align="justify">
                        Berdasarkan Surat Perintah Tugas (SPT) Nomor <?=$no_st?> tanggal <?=$tgl[2]?> bulan <?=$this->help->namaBulan($tgl[1])?> tahun <?=$tgl[0]?>, <?=count($sdm)==1?'saya':'kami'?> menyatakan bahwa :
                        
                    </td>
                </tr>
                <tr>
                    <td align="center">1.</td>
                    <td colspan="3">Selama melaksanakan perjalanan dinas tersebut :</td>
                </tr>
                <tr>
                    <td width="50px"></td>
                    <td width="100px">Berangkat</td>
                    <td width="20px">:</td>
                    <td><?=$waktu_berangkat?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Kembali</td>
                    <td>:</td>
                    <td><?=$waktu_kembali?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Waktu</td>
                    <td>:</td>
                    <td><?=$waktu_total?></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td align="center" valign="top">2.</td>
                    <td colspan="3" align="justify">Bahwa perjalanan dinas tersebut telah sesuai dengan ketentuan peraturan perundang-undangan yang berlaku dan dilaksanakan lebih dari 8 jam.</td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td align="center" valign="top">3.</td>
                    <td colspan="3" align="justify">Apabila di kemudian hari pernyataan ini tidak benar dan menimbulkan kerugian Negara, <?=count($sdm)==1?'saya':'kami'?> bertanggungjawab penuh dan bersedia menyetorkan kerugian  tersebut ke Rekening Kas Umum Daerah Pemerintah Kabupaten Kediri.</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="4" align="justify">Demikian surat pernyataan ini dibuat dengan sebenarnya dan untuk digunakan sebagaimana mestinya.</td>
                </tr>
            </table>
            <table width="100%" style="font-size:11pt;line-height: 1;font-family:tahoma" border="0">
                <tr>
                    <td></td>
                    <td colspan="3">Kediri, <?=$tglRinci?></td>
                </tr>   
                <tr>
                    <td colspan="4">Yang Membuat Pernyataan : </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <table width="100%" class="bordersolid" style="font-size:11pt;line-height: 1.5;font-family:tahoma" border="1">
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th width="20%">TTD</th>
                            </tr>
                            <?php $no=1; foreach ($detail as $val3) { ?>
                                <tr>
                                    <td width="30px" align="center"><?=$no++?>.</td>
                                    <td><?=$val3['nama_sdm']?></td>
                                    <td><?=$val3['nip']?></td>
                                    <td width="70px"></td>
                                </tr>
                            <?php } ?>
                        </table>
                        <table width="100%" style="font-size:11pt;line-height: 1;font-family:tahoma; text-align: center" border="0">
                            <?php
                                if(!empty($kpa_pa)){
                                    $kpa1 = explode('_', $kpa_pa);
                                }
                            ?>
                            <tr>
                                <td width="60%">&nbsp;</td>
                                <td>Mengetahui, </td>
                            </tr>                            
                            <tr>
                                <td></td>
                                <td>Kuasa Pengguna Anggaran</td>
                            </tr>
                            <tr><td height="50px"></td></tr>
                            <tr>
                                <td></td>
                                <td><b><u><?=$kpa1[0]?></u></b></td>
                            </tr>                                      
                            <tr>
                                <td></td>
                                <td>NIP. <?=$kpa1[1]?></td>
                            </tr>
                        </table>
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