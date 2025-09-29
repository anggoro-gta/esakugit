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
                <?php if(count($sdm)==1){ ?>
                    <tr>
                        <td width="50px"></td>
                        <td width="100px">Nama</td>
                        <td width="20px">:</td>
                        <td><?=$sdm[0]['nama_sdm']?></td>
                    </tr>
                    <?php if($sdm[0]['nip']!='-'){ ?>
                        <tr>
                            <td></td>
                            <td>NIP</td>
                            <td>:</td>
                            <td><?=$sdm[0]['nip']?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td></td>
                        <td>Jabatan</td>
                        <td>:</td>
                        <td><?=$sdm[0]['jabatan']?></td>
                    </tr>
                <?php }else{ ?>
                    <tr>
                        <td colspan="4">
                            <table width="100%" style="font-size:11pt;line-height: 1.2;font-family:tahoma" class="bordersolid" border="1" cellspacing="-1">
                                <tr>
                                    <th width="40px">No.</th>
                                    <th>Nama</th>
                                    <th>NIP</th>
                                    <th>Jabatan</th>
                                </tr>
                                <?php $no=1; foreach ($sdm as $val) { ?>
                                     <tr>
                                         <td valign="top" align="center"><?=$no++?></td>
                                         <td valign="top"><?=$val['nama_sdm']?></td>
                                         <td valign="top"><?=$val['nip']?></td>
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
            <br>
            <table width="100%" style="font-size:11pt;line-height: 1;font-family:tahoma" border="0">
                <?php
                    $tgl2 = explode('-', $hasil['tgl_rincian']);
                    $kpa = explode('_', $kpa_pa);

                    if(!empty($atasan_langsung1)){
                        $ats1 = explode('_', $atasan_langsung1);
                    }
                ?>
                
                <?php if(count($sdm)==1){ ?>
                    <tr>
                        <?php if(empty($atasan_langsung1)){ ?>
                            <?php if(empty($kpa_pa)){ ?>
                                <td width="50%"></td>
                            <?php }else{ ?>
                                <td width="50%" align="center">Mengetahui,</td>
                            <?php } ?>
                        <?php }else{ ?>
                            <?php if(empty($kpa_pa)){ ?>
                                <td width="50%" align="center">Mengetahui,</td>
                            <?php }else{ ?>
                                <td width="33%" align="center">Mengetahui,</td>
                                <td width="33%">&nbsp;</td>
                            <?php } ?>
                        <?php } ?>
                        <td align="center">Kediri, <?=$tgl2[2]?> <?=$this->help->namaBulan($tgl2[1])?> <?=$tgl2[0]?></td>
                    </tr>
                    <tr>
                        <?php if(empty($atasan_langsung1)){ ?>
                            <td align="center"><?=$kpa[2]?></td>
                        <?php }else{ ?>
                            <?php
                                $atsLgsn = "Atasan Langsung";
                                if($is_peg->pegawai_setda==0){
                                    $atsLgsn = "P P T K";
                                }
                            ?>  
                            <?php if(empty($kpa_pa)){ ?>
                                <td align="center"><?=$atsLgsn?></td>
                            <?php }else{ ?>
                                <td align="center"><?=$kpa[2]?></td>
                                <td align="center"><?=$atsLgsn?></td>
                            <?php } ?>
                        <?php } ?>
                        <td align="center">Yang menyatakan,</td>
                    </tr>
                    <tr>
                        <td height="70px">&nbsp;</td>
                    </tr>
                    <tr>
                        <?php if(empty($atasan_langsung1)){ ?>
                            <td align="center"><b><u><?=$kpa[0]?></u></b></td>
                        <?php }else{ ?>
                            <?php if(empty($kpa_pa)){ ?>
                                <td align="center"><b><u><?=$ats1[0]?></u></b></td>
                            <?php }else{ ?>
                                <td align="center"><b><u><?=$kpa[0]?></u></b></td>
                                <td align="center"><b><u><?=$ats1[0]?></u></b></td>
                            <?php } ?>
                        <?php } ?>
                        <td align="center"><b><u><?=$sdm[0]['nama_sdm']?></u></b></td>
                    </tr>
                    <tr>
                        <?php if(empty($atasan_langsung1)){ ?>                            
                             <?php if(empty($kpa_pa)){ ?>
                                <td></td>
                            <?php }else{ ?>
                                <td align="center">NIP. <?=$kpa[1]?></td>
                            <?php } ?>
                        <?php }else{ ?>
                            <?php if(empty($kpa_pa)){ ?>
                                <td align="center">NIP. <?=$ats1[1]?></td>
                            <?php }else{ ?>
                                <td align="center">NIP. <?=$kpa[1]?></td>
                                <td align="center">NIP. <?=$ats1[1]?></td>
                            <?php } ?>
                        <?php } ?>
                        <td align="center"><?=$sdm[0]['nip']!='-'?'NIP. '.$sdm[0]['nip']:''?></td>
                    </tr>
                <?php }else{ ?>
                    <!-- <tr>
                        <td align="center">Kediri, <?=$tgl2[2]?> <?=$this->help->namaBulan($tgl2[1])?> <?=$tgl2[0]?></td>
                    </tr>
                    <tr>
                        <td align="center">Yang menyatakan,</td>
                    </tr>
                    <tr>
                        <td>
                            <table width="80%" align="center" style="font-size:11pt;line-height: 2;font-family:tahoma;" class="bordersolid" border="1" cellspacing="-1">
                                <tr>
                                    <th width="50px">No.</th>
                                    <th>Nama</th>
                                    <th width="200px">Tanda Tangan</th>
                                </tr>
                                <?php $no=1; foreach ($sdm as $val) { ?>
                                     <tr>
                                         <td valign="top" align="center"><?=$no?></td>
                                         <td valign="top"><?=$val['nama_sdm']?></td>
                                         <?php
                                            $noUrt = $no.'.';
                                            if($no%2==0){
                                                $noUrt = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$no.'.';
                                            }
                                            $no++;
                                         ?>
                                         <td><?=$noUrt?></td>
                                     </tr>
                                <?php } ?>
                            </table>
                        </td>
                    </tr> -->
                <?php } ?>
                <?php //if(!empty($atasan_langsung1)){ ?>
                    <!-- <tr><td>&nbsp;</td></tr>
                    <tr>
                        <td colspan="2" align="center">Mengetahui,</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table width="100%" align="center" style="font-size:11pt;line-height: 1;font-family:tahoma; text-align: center" border="0" cellspacing="-1">
                                </tr>
                                <?php
                                    if(!empty($atasan_langsung1)){
                                        $ats1 = explode('_', $atasan_langsung1);
                                    }
                                ?>
                                <tr>
                                    <?php if(!empty($atasan_langsung1)){ ?>
                                        <td>Atasan Langsung</td>
                                    <?php } ?>
                                    <td><?=$kpa[2]?></td>
                                </tr>
                                <tr>
                                    <td height="70px">&nbsp;</td>
                                </tr>
                                <tr>
                                    <?php if(!empty($atasan_langsung1)){ ?>
                                        <td><b><u><?=$ats1[0]?></u></b></td>
                                    <?php } ?>
                                    <td><b><u><?=$kpa[0]?></u></b></td>
                                </tr>
                                <tr>
                                    <?php if(!empty($atasan_langsung1)){ ?>
                                        <td>NIP. <?=$ats1[1]?></td>
                                    <?php } ?>
                                    <td>NIP. <?=$kpa[1]?></td>
                                </tr>
                            </table>
                        </td>
                    </tr> -->
                <?php //} ?>
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