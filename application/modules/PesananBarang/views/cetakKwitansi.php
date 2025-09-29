 <!doctype html>
<html>
    <head>
        <title>Kwitansi</title>
    </head>
    <body onload="window.print()" style="margin:1">
        <div class="responsive">
            <table width='100%' style='font-family:arial;font-size:9pt' cellspacing='-2' border="0">
                <tr>
                    <td valign='top' rowspan='3' width='50px' align="center"><img src="<?=base_url()?>image/kab_kediri.png" width='45px' height='55px'></td>
                    <td width='500px'>&nbsp; PEMERINTAH KABUPATEN KEDIRI</td>
                    <td width='150px'>No. TBP : <?=$hasil->no_bku?></td>
                    <!-- <td rowspan='3'>
                        <table>
                            
                        </table>
                    </td> -->
                </tr>                
                <tr>
                    <td>&nbsp; SEKRETARIAT DAERAH</td>
                    <td>No. LPJ &nbsp;:</td>
                </tr>
                <tr>
                    <td>&nbsp; Jl. Soekarno Hatta No. 01 kediri Telp. (0354) 689901 - 689905</td>
                    <td>Tahun Anggaran : <?=$hasil->tahun_anggaran?></td>
                </tr>
            </table>
            
            <br>
            <table width="100%" style="font-size:11pt;text-align:center;font-family:arial;line-height: 1">
                <tr>
                    <td><b>K W I T A N S I</b></td>
                </tr>
                <!-- <tr>
                    <td>Nomor : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; / &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?='/'.$hasil->singkatan_bagian.'.'.$hasil->singkatan_kegiatan.'/&nbsp;&nbsp;&nbsp;&nbsp;/'.$hasil->tahun_anggaran?></td>
                </tr> -->
                <hr style='margin-top:1px;color:black'><hr style='margin-top:-9px;color:black'>
            </table> 
                <br>
            <table width="100%" style="font-size:9pt;font-family:arial;margin-top:-7px;line-height: 1" border="0">
                <tr>
                    <td valign="top">Kode Sub Kegiatan</td>
                    <td valign="top" align="center">:</td>
                    <td colspan="4"><?=$hasil->kode_kegiatan?></td>
                </tr>
                <tr>
                    <td valign="top">Kode Rekening Belanja</td>
                    <td valign="top" align="center">:</td>
                    <td colspan="4"><?=$hasil->kode_rekening?></td>
                </tr>
                <tr>
                    <td>NPWP</td>
                    <td align="center">:</td>
                    <td colspan="4"><?=$hasil->npwp?></td>
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
                    <td colspan="4"><?=number_format($hasil->total_akhir)?></td>
                </tr>
                <tr>
                    <td valign="top">Untuk Pembayaran</td>
                    <td valign="top" align="center">:</td>
                    <td colspan="4"><?='Belanja '.$hasil->perihal?> untuk <?=$hasil->kegiatan?> TA <?=$hasil->tahun_anggaran?>, (sebagaimana terlampir).
                        <br>
                        <table style="line-height: 0.8;" cellspacing="-1">
                            <?php
                                $totAll = $hasil->total_akhir;  

                                $ppn = '';
                                $ppn10Persen = 0;
                                $ph22 = '';
                                $ph23 = '';
                                foreach ((array)json_decode($hasil->jenis_pajak) as $val) {
                                    if($val=='PPN'){
                                        $ppn1=11;
                                        $PmbgiPpn1=111;
                                        $ppn10Persen = $totAll*($ppn1/$PmbgiPpn1);
                                        $ppn = number_format($this->help->pembulatanSeratus(ceil($ppn10Persen)));
                                    }
                                    if($val=='PPH_22'){
                                        $ph22 = "ada";
                                        if($hasil->npwp=='' || $hasil->npwp=='-'){ //tidak punya npwp
                                            $nilaipph22 = number_format($this->help->pembulatanSeratus(ceil(($totAll-$ppn10Persen)*(3/100))));
                                        }else{
                                            $nilaipph22 = number_format($this->help->pembulatanSeratus(ceil(($totAll-$ppn10Persen)*(1.5/100))));
                                        }
                                    }
                                    if($val=='PPH_23'){
                                        $ph23 = "ada";
                                        if($hasil->npwp=='' || $hasil->npwp=='-'){ //tidak punya npwp
                                            $nilaipph23 = number_format($this->help->pembulatanSeratus(ceil(($totAll-$ppn10Persen)*(4/100))));
                                        }else{
                                            $nilaipph23 = number_format($this->help->pembulatanSeratus(ceil(($totAll-$ppn10Persen)*(2/100))));
                                        }
                                    }
                                }
                            ?>
                            <?php if(!empty($ppn)){ ?>
                                <tr>
                                    <td>PPn</td>
                                    <td align="center">:</td>
                                    <td><?=$ppn?></td>
                                </tr>
                            <?php } ?>
                            <?php if(!empty($ph22)){ ?>
                                <tr>
                                    <td>PPh 22</td>
                                    <td align="center">:</td>                    
                                    <td><?=$nilaipph22?></td>
                                </tr>
                            <?php } ?>
                            <?php if(!empty($ph23)){ ?>
                                <tr>
                                    <td>PPh 23</td>
                                    <td align="center">:</td>                    
                                    <td><?=$nilaipph23?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </td>
                </tr>          
                <tr>
                    <td valign="top">Terbilang</td>
                    <td valign="top" align="center">:</td>
                    <td colspan="4"><b><i>(=<?=$this->help->terbilang($hasil->total_akhir)?> Rupiah=)</i></b></td>
                </tr>
            </table>
            <br>
            <table width="100%" style="font-size:8pt;font-family:arial;text-align: center" border="0" cellspacing="-1" cellpadding="0">
                <tr>
                    <td valign="bottom"></td>
                    <td width="50%">Kediri, 
                         <?php $tglPs = explode('-', $hasil->tgl_kuitansi);
                         if($hasil->tgl_kuitansi){
                            echo $tglPs[2].' '.$this->help->namaBulan($tglPs[1]).' '.$tglPs[0]; 
                         }else{
                            echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
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
                    <td><b><u><?=$hasil->nama_bendahara_pembantu?></u></b></td>
                    <td><b><u><?=$hasil->nama_pimpinan?></u></b></td>
                </tr>
                <tr>
                    <td>NIP. <?=$hasil->nip_bendahara_pembantu?></td>                    
                    <td><?=$hasil->nama_rekanan?></td>
                </tr>
            </table>
            <br>
             <table width="100%" style="font-size:8pt;font-family:arial;text-align: center" border="0" cellspacing="-1" cellpadding="0">
                <tr>
                    <td valign="bottom" width="50%">Menyetujui,</td>
                    <td valign="bottom">Mengetahui,</td>
                </tr>
                <tr>
                    <td><?=$hasil->jabatan_pejabat_kpa?></td>
                    <td valign="top">PPTK</td>
                </tr>
                <tr>
                    <td valign="bottom">Selaku KPA,</td>
                    <td valign="bottom"></td>
                </tr>
                <tr><td height="60px" colspan="2"></td></tr>
                <tr>
                    <td><b><u><?=$hasil->nama_pejabat_kpa?></u></b></td>
                    <td><b><u><?=$hasil->nama_pejabat_pptk?></u></b></td>
                </tr>
                <tr>
                    <td>NIP. <?=$hasil->nip_pejabat_kpa?></td>
                    <td>NIP. <?=$hasil->nip_pejabat_pptk?></td>
                </tr>
            </table>       
        </div>
    </body>
</html>