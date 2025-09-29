<!doctype html>
<html>
    <head>
        <title>BAHPAB</title>
    </head>
    <body>
        <div class="responsive">
            <?=$header?>
            <br>
            <table width="100%" style="font-family:arial;line-height: 1.5;">
                <tr><td height="30px"></td></tr>
                <tr>
                    <td colspan="2" align="center" style="font-size:13pt;"><b><u>BERITA ACARA HASIL PEMERIKSAAN ADMINISTRATIF BARANG</u></b></td>
                </tr>
                <tr>
                    <td colspan="2"  align="center" style="font-size:13pt;">Nomor : 027/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/418.54/<?=$hasil['tahun_anggaran']?></td>
                </tr>
                <tr><td height="50px"></td></tr>
                <tr>
                    <td colspan="2" align="justify" style="font-size:12pt;">
                        <?php $dt = explode('-', $hasil['tgl_brg_dtg']); ?>
                        Pada hari ini <?= $this->help->namaHari($this->help->ReverseTgl($hasil['tgl_brg_dtg']));?> Tanggal <?=$this->help->terbilang($dt[2])?> Bulan <?=$this->help->namaBulan($dt[1])?> Tahun <?=$this->help->terbilang($dt[0])?>, kami yang bertanda tangan dibawah ini :
                    </td>
                </tr>
                <tr><td></td></tr>
                <tr>
                    <td colspan="2">
                        <table border="0" width="100%" cellspacing="-1" style="font-size:12pt;">
                            <tr>
                                <td width="30px"></td>
                                <td width="20px"></td>
                                <td width="150px">Nama</td>
                                <td width="20px">:</td>
                                <td><?=$hasil['nama_pphp']?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Jabatan</td>
                                <td>:</td>
                                <td>PjPHP</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>Jl. Soekarno-Hatta No. I Kediri</td>
                            </tr>
                            <tr><td>&nbsp;</td></tr>
                            <tr>
                                <td colspan="5" align="justify">
                                    Yang ditetapkan berdasarkan Keputusan Pengguna Anggaran Bappeda Kabupaten Kediri Nomor <?= $hasil['no_keputusan_pjphp'] ?>  
                                    <?php
                                        if(!empty($hasil['no_keputusan_pjphp'])){ 
                                            $ba = explode('-', $hasil['tgl_keputusan_pjphp']); 
                                            echo 'Tanggal '.$ba[2].' '.$this->help->namaBulan($ba[1]).' '.$ba[0];
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr><td>&nbsp;</td></tr>
                            <tr>
                                <td colspan="5" align="justify">
                                    Dengan ini menyatakan bahwa :
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>1.</td>
                                <td colspan="3">Telah mengadakan pemeriksaan administratif hasil pekerjaan Pengadaan Barang pada :</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>a.&nbsp; Pekerjaan</td>
                                <td>:</td>
                                <td>Pengadaan Barang <?=$hasil['perihal']?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>b.&nbsp; Nomor </td>
                                <td>:</td>
                                <td>021/<?=!empty($hasil['nomor'])?$hasil['nomor']:'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'?>/418.54/<?=$hasil['tahun_anggaran']?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>c.&nbsp; Tanggal </td>
                                <td>:</td>
                                <td><?php $tp = explode('-', $hasil['tgl_pesanan']); 
                                          echo $tp[2].' '.$this->help->namaBulan($tp[1]).' '.$tp[0];
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <?php
                                    $klmt = "Kontrak";
                                    if((int)$total_nilai < 10000000){ //10 jt
                                        $klmt = "Pesanan";
                                    }

                                    $totBaru = $total_nilai;
                                    if((int)$total_nilai >= 1000000){ //1 juta
                                        // $totBaru = $total_nilai+($total_nilai*(10/100));
                                    }
                                ?>
                                <td valign="top">d.&nbsp; Nilai <?=$klmt?></td>
                                <td valign="top">:</td>
                                <td><?php
                                    // $nlaiKontrak = $hasil['nilai_kontrak'];
                                    // if($nlaiKontrak){
                                        echo 'Rp. '.number_format($totBaru);
                                        echo "<br><i>(".$this->help->terbilang($totBaru).' Rupiah)</i>';
                                    // }
                                ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>e.&nbsp; Penyedia Barang</td>
                                <td>:</td>
                                <td><?=$rekanan['nama_rekanan']?>
                                </td>
                            </tr>
                             <tr>
                                <td></td>
                                <td valign="top">2.</td>
                                <td colspan="3" align="justify">Berdasarkan pemeriksaan administratif, maka dokumen administratif berkaitan dengan pengadaan barang sebagaimana tersebut diatas dinyatakan telah sesuai dan lengkap.</td>
                            </tr>
                        </table>
                    </td>
                </tr>  
                <tr><td height="50px"></td></tr>
                <tr>
                    <td colspan="2" align="justify" style="font-size:12pt;">
                        Demikian berita acara ini dibuat untuk dipergunakan sebagaimana mestinya.
                    </td>
                </tr>   
                <tr><td>&nbsp;</td></tr>           
            </table>
            <br>
            <?php
                $tglPrbhnKPA='2019-08-07'; // bu Yuli dilantik
                $nmaPPK = $hasil['nama_ppk'];
                $nipPPK = $hasil['nip_ppk'];
                if(strtotime($hasil['tgl_brg_dtg']) >= strtotime($tglPrbhnKPA)){
                    // if($hasil['fk_bagian_id']==1 || $hasil['fk_bagian_id']==2){
                    if($hasil['fk_bagian_id']==1){
                        $nmaPPK = "H. SUKADI, SE., MM.";
                        $nipPPK = "19670307 199003 1 006";
                    }
                }
                if(strtotime($hasil['tgl_brg_dtg']) <= strtotime('2019-09-04')){ // PMM
                    if($hasil['fk_bagian_id']==2){
                        $nmaPPK = "H. SUKADI, SE., MM.";
                        $nipPPK = "19670307 199003 1 006";
                    }
                }
            ?>
            <table border="0" width="100%" cellspacing="-1" style="font-size:12pt;text-align: center">
                <tr>
                    <td width="20px"></td>
                    <td width="310px"></td>
                    <td width="70px"></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Mengetahui,</td>
                    <td></td>
                    <td></td>
                </tr>                
                <tr>
                    <td></td>
                    <td>Pengguna Anggaran/</td>
                    <td></td>
                    <td>PjPHP</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Kuasa Pengguna Anggaran</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td></td>
                    <td><b><u><?=$nmaPPK?></u></b></td>
                    <td></td>
                    <td><b><u><?=$hasil['nama_pphp']?></u></b></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="padding-top: -3px">NIP. <?=$nipPPK?></td>
                    <td></td>
                    <td style="padding-top: -3px">NIP. <?=$hasil['nip_pphp']?></td>
                </tr>
            </table>

            <pagebreak>

            <table width="100%" style="font-family:arial;line-height: 2;">
                <tr><td height="30px"></td></tr>
                <tr>
                    <td colspan="2" align="center" style="font-size:12pt;"><b><u>LAMPIRAN BERITA ACARA HASIL PEMERIKSAAN ADMINISTRATIF BARANG <br> PENGGADAAN/PENUNJUKAN LANGSUNG</u></b></td>
                </tr>
                <tr>
                    <td colspan="2"  align="center" style="font-size:12pt;padding-top: -6px;">Nomor : 027/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/418.54/<?=$hasil['tahun_anggaran']?></td>
                </tr>
                <tr><td height="20px"></td></tr>
                <tr>
                    <td colspan="2">
                        <table border="1" width="100%" cellspacing="-1" style="font-size:11pt;line-height: 1.9;" align="center">
                            <thead>
                                <tr>
                                    <th rowspan="2">No.</th>
                                    <th rowspan="2" colspan="2" width="200px">Jenis Dokumen</th>
                                    <th rowspan="2" width="120px">Tanggal Dokumen</th>
                                    <th rowspan="2" width="120px">Nomor Dokumen</th>
                                    <th width="120px" colspan="2">Keadaan</th>
                                    <th rowspan="2">Keterangan</th>
                                </tr>
                                <tr>
                                    <th>Ada</th>
                                    <th>Tidak</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td align="center" valign="top">1.</td>
                                    <td colspan="2">Dokumen Pelaksanaan Anggaran (DPA)</td>
                                    <td align="center"><?=$tgl_dpa?></td>
                                    <td align="center"><?=$no_dpa?></td>
                                    <td align="center">&#8730;</td>
                                    <td></td>
                                    <td valign="top"></td>
                                </tr>
                                <tr>
                                    <td align="center" valign="top">2.</td>
                                    <td colspan="2">Surat Penetapan Pejabat Pembuat Komitmen</td>
                                    <td align="center"><?=$tgl_ppk?></td>
                                    <td align="center"><?=$no_ppk?></td>
                                    <td align="center">&#8730;</td>
                                    <td></td>
                                    <td valign="top"></td>
                                </tr>
                                <tr>
                                    <td align="center" valign="top">3.</td>
                                    <td colspan="2">Rencana Umum Pengadaan</td>
                                    <td></td>
                                    <td></td>
                                    <td align="center"></td>
                                    <td></td>
                                    <td valign="top"></td>
                                </tr>
                                <tr>
                                    <td align="center" valign="top">4.</td>
                                    <td colspan="2">Bukti Pembelian (Faktur)</td>
                                    <td align="center"><?=!empty($hasil['tgl_kuitansi'])?$this->help->ReverseTgl($hasil['tgl_kuitansi']):''?></td>
                                    <td align="center"></td>
                                    <td align="center">&#8730;</td>
                                    <td></td>
                                    <td valign="top"></td>
                                </tr>
                                <tr>
                                    <td align="center" valign="top">5.</td>
                                    <td colspan="2">Kuitansi</td>
                                    <td align="center"><?=!empty($hasil['tgl_kuitansi'])?$this->help->ReverseTgl($hasil['tgl_kuitansi']):''?></td>
                                    <td align="center"><?=$hasil['no_kuitansi']?></td>
                                    <td align="center">&#8730;</td>
                                    <td></td>
                                    <td valign="top"></td>
                                </tr>
                                <tr>
                                    <td align="center" valign="top">6.</td>
                                    <td colspan="2">Surat Kesanggupan Kerja</td>
                                    <td></td>
                                    <td></td>
                                    <td align="center"></td>
                                    <td></td>
                                    <td valign="top"></td>
                                </tr>
                                <tr>
                                    <td align="center" valign="top">7.</td>
                                    <td colspan="2">Berita Acara Kesepakatan Harga Barang</td>
                                    <td></td>
                                    <td></td>
                                    <td align="center"></td>
                                    <td></td>
                                    <td valign="top"></td>
                                </tr>
                                <tr>
                                    <td align="center" valign="top">8.</td>
                                    <td colspan="2">Surat Perintah Kerja</td>
                                    <td></td>
                                    <td></td>
                                    <td align="center"></td>
                                    <td></td>
                                    <td valign="top"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <br>                
            </table>
            <table border="0" width="100%" cellspacing="-1" style="font-size:12pt;text-align: center">
                <tr>
                    <td width="20px"></td>
                    <td width="310px"></td>
                    <td width="70px"></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Mengetahui,</td>
                    <td></td>
                    <td></td>
                </tr>                
                <tr>
                    <td></td>
                    <td>Pengguna Anggaran/</td>
                    <td></td>
                    <td>PjPHP</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Kuasa Pengguna Anggaran</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td></td>
                    <td><b><u><?=$nmaPPK?></u></b></td>
                    <td></td>
                    <td><b><u><?=$hasil['nama_pphp']?></u></b></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="padding-top: -3px">NIP. <?=$nipPPK?></td>
                    <td></td>
                    <td style="padding-top: -3px">NIP. <?=$hasil['nip_pphp']?></td>
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