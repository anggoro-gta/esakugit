<!doctype html>
<html>
    <head>
        <title>Surat Tugas</title>
    </head>
    <body onload="window.print()" style="margin:0">
        <div class="responsive">
            <div style="padding-top:-23px"><?=$header?></div>
            <table width="100%" style="font-size:12pt;text-align:center;font-family:tahoma">
                <tr>
                    <td style="font-size: 16pt"><b><u>SURAT PERINTAH TUGAS</u></b></td>
                </tr>
                <tr>
                    <td style="font-size: 12pt;padding-top: -5px">Nomor : 
                        <?php if($hasil['asal_surat_tugas']=='Dalam'){ ?>
                            090/<?=!empty($hasil['no_surat_tugas'])?$hasil['no_surat_tugas']:'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'?>/<?=$kelAss->kode_bagian.'/'.$hasil['tahun']?>
                        <?php } else {    
                            echo $hasil['no_surat_tugas'];  
                        } ?>        
                    </td>
                </tr>
            </table>
            <br>
            <table width="100%" style="font-size:11pt;line-height: 1.2;" border="0" cellspacing="-1">
                <tr>
                    <?php if(empty($hasil['dasar_surat_tugas'])){ ?>
                       <td valign="top"><b>Dasar</b></td>
                        <td valign="top">:</td>
                        <!--  <td colspan="4" align="justify">Dokumen Pelaksanaan Anggaran (DPA) Badan Perencanaan Pembangunan Daerah Tahun Anggaran 2019 Nomor : 903/9520/418.54/2018</td> -->
                    <?php } else { ?>
                        <td valign="top"><b>Dasar</b></td>
                        <td valign="top">:</td>
                        <td colspan="4" align="justify"><?=$hasil['dasar_surat_tugas']?></td>
                    <?php } ?>                     
                </tr> 
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="6" align="center" style="font-size: 15pt"><b>MEMERINTAHKAN</b></td>
                </tr> 
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <!-- <tr>
                    <td valign="top" width="60px"><b>Kepada</b></td>
                    <td valign="top" width="10px">:</td>
                    <td colspan="4"></td>
                </tr> -->
                <?php if(count($detail) <= 3): ?>
                    <?php $no=1; foreach ((array)$detail as $dt) : ?>
                        <tr>
                            <?php if($no==1){ ?>
                                <td valign="top" width="60px"><b>Kepada</b></td>
                                <td valign="top" width="10px">:</td>
                            <?php }else{ ?>
                                <td colspan="2">
                            <?php } ?>

                            </td>
                            <?php $clsp='2'; if(count($detail)!=1){ ?>
                                <td width="15px"><?=$no++.'.'?></td>
                            <?php $clsp='1'; } ?>
                            <td width="20%" colspan="<?=$clsp?>">Nama</td>
                            <td width="5px">:</td>
                            <td width="60%"><b><?=$dt['nama_sdm']?></b></td>
                        </tr>
                        <?php if($dt['nip']!='-'){ ?>
                            <tr>
                                <td colspan="2"></td>
                                <?php if(count($detail)!=1){ ?>
                                    <td></td>
                                <?php } ?>
                                <td colspan="<?=$clsp?>">Pangkat/gol</td>
                                <td>:</td>
                                <td><?=$dt['pangkat_gol']?></td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <?php if(count($detail)!=1){ ?>
                                    <td></td>
                                <?php } ?>
                                <td colspan="<?=$clsp?>">NIP</td>
                                <td>:</td>
                                <td><?=$dt['nip']?></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="2"></td>
                            <?php if(count($detail)!=1){ ?>
                                <td></td>
                            <?php } ?>
                            <td colspan="<?=$clsp?>">Jabatan</td>
                            <td>:</td>
                            <td><?=$dt['jabatan']?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td valign="top" width="60px"><b>Kepada</b></td>
                        <td valign="top" width="10px">:</td>
                        <td colspan="4">
                            <table class="bordersolid" width="100%" style="font-size:10pt;line-height: 1;"  border="1" cellspacing="-1">
                               <tr>
                                    <td align="center" width="5px">No</td>
                                    <td align="center">Nama</td>
                                    <td align="center">Pangkat/gol</td>
                                    <td align="center" width="155px">NIP</td>
                                    <td align="center">Jabatan</td>
                                </tr>
                                <?php $no=1; foreach ($detail as $val){ ?>
                                    <tr>
                                        <td valign="top" align="center"><?=$no++?></td>
                                        <td valign="top"><?=$val['nama_sdm']?></td>
                                        <td valign="top"><?=$val['pangkat_gol']!='-'?$val['pangkat_gol']:'';?></td>
                                        <td valign="top"><?=$val['nip']!='-'?$val['nip']:'';?></td>
                                        <td valign="top"><?=$val['jabatan']?></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </td>
                    </tr>
                <?php endif; ?>
                <tr><td>&nbsp;</td></tr>
                <tr>
                    <td valign="top"><b>Untuk</b></td>
                    <td valign="top">:</td>
                    <td colspan="4" align="justify">
                        <?php $tglST = explode('-', $hasil['tgl_berangkat']);?>
                        <?=$hasil['acara']?>, pada hari <?=$this->help->namaHari($this->help->ReverseTgl($hasil['tgl_berangkat']))?> 
                        <?php
                            if($hasil['tgl_berangkat']!=$hasil['tgl_tiba']){
                                echo ' s/d '.$this->help->namaHari($this->help->ReverseTgl($hasil['tgl_tiba']));
                            }
                        ?>
                        tanggal 
                        <?php 
                            $tglTb = explode('-', $hasil['tgl_tiba']);
                            if(($hasil['tgl_berangkat']!=$hasil['tgl_tiba']) && ($tglST[1]==$tglTb[1])){
                                 echo $tglST[2].' s/d '.$tglTb[2].' '.$this->help->namaBulan($tglST[1]).' '.$tglST[0];
                            }else{
                                echo $tglST[2].' '.$this->help->namaBulan($tglST[1]).' '.$tglST[0]; 
                            
                                if($hasil['tgl_berangkat']!=$hasil['tgl_tiba']){
                                    echo ' s/d '.' '.$tglTb[2].' '.$this->help->namaBulan($tglTb[1]).' '.$tglTb[0];
                                }
                            }
                        ?>
                        di <?=$hasil['kategori']=='DD'?$hasil['tujuan_skpd']:ucwords(strtolower($hasil['kota'])).' ('.$hasil['tujuan_skpd'].')'?>.
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="4">Demikian surat tugas ini untuk dilaksanakan dengan penuh tanggung jawab.</td>
                </tr>
            </table>
            <br>
            <table width="100%" style="font-size:11pt;line-height: 1">
                <tr>
                    <td width="350px"></td>
                    <td>Dikeluarkan di</td>
                    <td style="width: 10px">:</td>
                    <td>KEDIRI</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Pada Tanggal</td>
                    <td>:</td>
                    <td>
                    <?php
                        $tglST = explode('-', $hasil['tgl_surat_tugas']);
                        if($tglST[2]!='00'){
                            echo $tglST[2].' '.$this->help->namaBulan($tglST[1]).' '.$tglST[0];                            
                        }
                    ?>                        
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="3" style="padding-top: -15px"><hr class="bordersolid" style="color:black"></td>
                </tr>
                <tr>
                    <td></td>
                    <?php
                        $ttdJudul = '';
                        if($hasil['urut_ttd_surat_tugas']=='1'){
                            $ttdJudul = $hasil['jabatan_ttd_surat_tugas'];
                        }else if($hasil['urut_ttd_surat_tugas']=='2'){
                            $ttdJudul = 'a.n. BUPATI KEDIRI <br> '.$hasil['jabatan_ttd_surat_tugas'];
                        }else if($hasil['urut_ttd_surat_tugas']=='3'){
                            $ttdJudul = 'a.n. BUPATI KEDIRI <br> SEKRETARIS DAERAH <br>u.b.<br> '.$hasil['jabatan_ttd_surat_tugas'];
                        }else if($hasil['urut_ttd_surat_tugas']=='4'){
                            $ttdJudul = 'a.n. BUPATI KEDIRI <br>'.strtoupper($kelAss->kelompok_asisten).'<br>u.b.<br> '.$hasil['jabatan_ttd_surat_tugas'];
                        }
                    ?>
                    <td style="padding-top: -6px" align="center" colspan="3"><?=$ttdJudul?></td>
                </tr>
                <tr><td height="50px"></td></tr>
                <tr>
                    <td></td>
                    <td align="center" colspan="3"><b><u><?=$hasil['nama_ttd_surat_tugas']?></u></b></td>
                </tr>
                <tr>
                    <td></td>
                    <td align="center" colspan="3">
                        <?php
                            if(!empty($hasil['nip_ttd_surat_tugas'])){
                                $gol = explode('(', $hasil['pangkat_ttd_surat_tugas']);
                                echo $gol[0];
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td align="center" colspan="3"><?=$hasil['nip_ttd_surat_tugas']!='-'?'NIP. '.$hasil['nip_ttd_surat_tugas']:''?></td>
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