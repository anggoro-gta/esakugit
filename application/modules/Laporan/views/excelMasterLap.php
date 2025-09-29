<!doctype html>
<html>
    <head>
        <title>Master Laporan PJD</title>
    </head>
    <body>
        <div class="responsive">            
            <style type="text/css">
                .bordersolid{
                    border: 1px solid black; border-collapse: collapse;
                }
                .tipe_text{
                    mso-number-format:"\@";/*force text*/
                }
            </style>
            <table class="bordersolid" border="1" cellspacing="-1" width="100%" style="font-size:10px;font-family:arial">
                <thead>
                    <tr>
                        <td align="center">NO</td>
                        <td align="center">TGL RINCIAN</td>
                        <td align="center">PERIHAL</td>
                        <td align="center">NO ST</td>
                        <td align="center">TGL ST</td>
                        <td align="center">TUJUAN</td>
                        <td align="center">KOTA</td>
                        <td align="center">TGL TUGAS</td>
                        <td align="center">NAMA PELAPOR</td>
                        <td align="center">NIP PELAPOR</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; ?>
                    <?php foreach ($hasil as $val): ?>
                    <tr>
                        <td valign="top" align="center"><?=$no++?></td>
                        <td valign="top"  align="center" class="tipe_text"><?php
                            $tglRc = explode('-', $val->tgl_rincian);
                            echo $tglRc[2].' '.$this->help->namaBulan($tglRc[1]).' '.$tglRc[0];
                        ?></td>
                        <td valign="top"><?=$val->acara?></td>
                        <td valign="top" align="center"><?=$val->no_surat_tugas?></td>
                        <td valign="top"  align="center" class="tipe_text"><?php
                            $tglST = explode('-', $val->tgl_surat_tugas);
                            echo $tglST[2].' '.$this->help->namaBulan($tglST[1]).' '.$tglST[0];
                        ?></td>
                        <td valign="top" align="center"><?=$val->tujuan_skpd?></td>
                        <td valign="top" align="center"><?=$val->kota?></td>
                            <?php 
                                $tglBr = explode('-', $val->tgl_berangkat);
                                $tglTb = explode('-', $val->tgl_tiba);
                                if(($val->tgl_berangkat!=$val->tgl_tiba) && ($tglBr[1]==$tglTb[1])){
                                    $tglTgs = $tglBr[2].' s/d '.$tglTb[2].' '.$this->help->namaBulan($tglBr[1]).' '.$tglBr[0];
                                }else{
                                    $tglTgs =  $tglBr[2].' '.$this->help->namaBulan($tglBr[1]).' '.$tglBr[0]; 
                                
                                    if($val->tgl_berangkat!=$val->tgl_tiba){
                                        $tglTgs = ' s/d '.' '.$tglTb[2].' '.$this->help->namaBulan($tglTb[1]).' '.$tglTb[0];
                                    }
                                }
                            ?>
                        <td valign="top" align="center" class="tipe_text"><?=$tglTgs?></td>
                        <td valign="top"><?=$val->nama_sdm?></td>
                        <td valign="top"><?=$val->nip?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>