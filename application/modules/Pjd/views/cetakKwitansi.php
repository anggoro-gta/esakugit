<!doctype html>
<html>
    <head>
        <title>Kwitansi</title>
    </head>
    <body>
        <?php $jmlKwi=count($detailGroup); $noKwi=1; ?>
        <?php foreach ((array)$detailGroup as $dt) : ?>
            <div class="responsive">
                <table width='100%' style='font-family:arial;font-size:9pt' cellspacing='-2' border="0">
                    <tr><td>&nbsp;</td></tr>
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
                <table width="100%" style="font-size:9pt;text-align:center;font-family:arial">
                    <tr>
                        <td><b>K W I T A N S I</b></td>
                    </tr>
                    <hr style='margin-top:1px;color:black'><hr style='margin-top:-9px;color:black'>
                </table> 
                <?php
                    $jbtnKPA = $hasil['jabatan_pejabat_kpa'];
                    $namaKPA = $hasil['nama_pejabat_kpa'];
                    $nipKPA = $hasil['nip_pejabat_kpa'];
                    if(empty($jbtnKPA)){
                        $jbtnKPA = $hasil['jabatan_pejabat_pa'];
                        $namaKPA = $hasil['nama_pejabat_pa'];
                        $nipKPA = $hasil['nip_pejabat_pa'];
                    }

                    $bndhrPmbntu=' Pembantu';
                    $namaBndhrPmbntu = $hasil['nama_bendahara_pembantu'];
                    $nipBndhrPmbntu = $hasil['nip_bendahara_pembantu'];
                    if($namaBndhrPmbntu==''){
                        $bndhrPmbntu='';
                        $namaBndhrPmbntu = $hasil['nama_bendahara'];
                        $nipBndhrPmbntu = $hasil['nip_bendahara'];
                    }

                ?>
                <table width="100%" style="font-size:9pt;font-family:arial;margin-top:-7px" border="0">
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
                        <td width="160px">Sudah Terima Dari</td>
                        <td width="10px" align="center">:</td>
                        <td colspan="4" width="300px">Kuasa Pengguna Anggaran</td>
                    </tr>
                    <tr>
                        <td>Uang Sebesar</td>
                        <td align="center">:</td>
                        <td colspan="4">
                            <?php 
                            $totAkhir='0';
                            foreach ($detailAll[$dt['fk_sdm_id']] as $dt2) : 
                                $totAkhir += $dt2['total_akhir'];
                            endforeach; 
                            ?>
                            Rp. <?=number_format($totAkhir)?>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">Untuk Pembayaran</td>
                        <td valign="top" align="center">:</td>
                        <?php
                            $klmat = "Biaya Perjalanan Dinas";
                            if(empty($hasil['is_uang_harian'])){
                                if($hasil['is_transport']==1 && empty($hasil['is_penginapan'])){
                                    $klmat = "Biaya Transportasi";
                                }
                                if($hasil['is_penginapan']==1 && empty($hasil['is_transport'])){
                                    $klmat = "Biaya Uang Sewa Penginapan";
                                }
                                if($hasil['is_transport']==1 && $hasil['is_penginapan']==1){
                                    $klmat = "Biaya Transportasi dan Uang Sewa Penginapan";
                                }
                            }

                            if($hasil['is_kontribusi']==1){
                                $klmat = "Biaya Kontribusi";
                            }
                        ?>
                        <td colspan="4"><?=$klmat.' dalam rangka '.$hasil['acara']?>, sub kegiatan <?=$hasil['kegiatan']?>, pada tanggal 
                            <?php 
                                $tglST = explode('-', $hasil['tgl_berangkat']);
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
                        </td>
                    </tr>
                    <!-- <tr>
                        <td valign="top">Berdasarkan SPPD</td>
                        <td valign="top" align="center">:</td>
                        <?php
                            $esl = $dt['eselon'];
                            if($esl=='2A' || $esl=='2B' || $esl=='3A'){
                                $brwng = 'BUPATI';
                            }else{
                                $brwng = $bagn->nama_bagian;
                            }
                        ?>
                        <td colspan="4">BUPATI KEDIRI</td>
                    </tr> -->
                    <tr>
                        <td valign="top">Nomor Surat Tugas</td>
                        <td valign="top" align="center">:</td>
                        <td colspan="4">
                            <?php
                                $nonya = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                if(!empty($hasil['no_surat_tugas'])){
                                    $nonya = $hasil['no_surat_tugas'];
                                }

                                $no_st = '090/'.$nonya.'/'.$bagn->kode_bagian.'/'.$hasil['tahun'];
                                if($hasil['asal_surat_tugas']=='Luar'){
                                    $no_st = $hasil['no_surat_tugas'];
                                }
                                echo $no_st;
                            ?> 
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">Tanggal Surat Tugas</td>
                        <td valign="top" align="center">:</td>
                        <td colspan="4"><?php $tglST = explode('-', $hasil['tgl_surat_tugas']);
                            echo $tglST[2].' '.$this->help->namaBulan($tglST[1]).' '.$tglST[0]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">Untuk perjalanan dinas dari</td>
                        <td valign="top" align="center">:</td>
                        <td valign="top"><?=$bagn->nama_bagian?></td>
                        <td valign="top" width="10px" align="center">Ke</td>
                        <td valign="top" width="10px" align="center">:</td>
                        <td valign="top"><?=$hasil['kategori']=='DL'?ucwords(strtolower($hasil['kota'])).' ('.$hasil['tujuan_skpd'].')':$hasil['tujuan_skpd']?></td>
                    </tr>                
                    <tr>
                        <td valign="top">Terbilang</td>
                        <td valign="top" align="center">:</td>
                        <td colspan="4"><b><i>(=<?=$this->help->terbilang($totAkhir)?> Rupiah=)</i></b></td>
                    </tr>
                </table>   
                <br>
                <table width="110%" style="font-size:8pt;font-family:arial;text-align: center; margin-left: -15px; margin-right: -15px" border="0" cellspacing="-1" cellpadding="0">                    
                    <?php 
                        $pmbntu='';
                        if($hasil['nama_bendahara_pembantu']){ 
                            $pmbntu='ada';
                        }
                    ?>
                    <tr>
                        <td width="20%">Menyetujui,</td>
                        <td width="20%">Mengetahui,</td>
                        <?php if(empty($pmbntu)){ ?>
                            <td width="20%" style="text-align: left">LUNAS DIBAYAR Tgl: </td>
                        <?php }else{ ?>
                            <!-- <td width="20%"></td> -->
                            <td width="20%" style="text-align: left">LUNAS DIBAYAR Tgl: </td>
                        <?php } ?>
                        <td width="20%">Kediri, 
                            <?php 
                                $tglRnci = $hasil['tgl_rincian'];
                                if($tglRnci){
                                    $tglRc = explode('-', $tglRnci);
                                    echo $tglRc[2].' '.$this->help->namaBulan($tglRc[1]).' '.$tglRc[0]; 
                                }else{
                                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?=$hasil['jabatan_pejabat_kpa']?></td>
                        <td>PPTK</td>
                        <!-- <td>Bendahara Pengeluaran</td> -->
                        <?php if(!empty($pmbntu)){ ?>
                            <td>Bendahara Pengeluaran</td>
                        <?php } ?>
                        <td>Yang Menerima</td>
                    </tr>
                    <tr>
                        <td>Selaku KPA</td>
                        <td></td>
                        <!-- <td></td> -->
                        <?php if(!empty($pmbntu)){ ?>
                            <td>Pembantu</td>
                        <?php } ?>
                        <td></td>
                    </tr>
                    <tr><td height="60px" colspan="3"></td></tr>
                    <tr>
                        <td><u><?=$hasil['nama_pejabat_kpa']?></u></td>
                        <td><u><?=$hasil['nama_pejabat_pptk']?></u></td>
                        <!-- <td><u><?=$hasil['nama_bendahara']?></u></td> -->
                        <?php if(!empty($pmbntu)){ ?>
                            <td><u><?=$hasil['nama_bendahara_pembantu']?></u></td>
                        <?php } ?>
                        <td><u><?=$dt['nama_sdm']?></u></td>
                    </tr>
                    <tr>
                        <td>NIP. <?=$hasil['nip_pejabat_kpa']?></td>
                        <td>NIP. <?=$hasil['nip_pejabat_pptk']?></td>
                        <!-- <td>NIP. <?=$hasil['nip_bendahara']?></td> -->
                        <?php if(!empty($pmbntu)){ ?>
                            <td>NIP. <?=$hasil['nip_bendahara_pembantu']?></td>
                        <?php } ?>
                        <td><?= $dt['nip']!='-'?"NIP. ".$dt['nip']:'';?></td>
                    </tr>
                </table>   
            </div>            
            <?php if($jmlKwi!=$noKwi){?>
                <pagebreak>
            <?php } $noKwi++; ?>
        <?php endforeach; ?>
    </body>
</html>