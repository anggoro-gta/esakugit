<!doctype html>
<html>
    <head>
        <title>Lap Lembur</title>
    </head>
    <body>
        <div class="responsive">
            <table width='100%' style='text-align:center;font-family:arial' cellspacing='-1'>
                <tr>
                    <td colspan='2' style='font-size:16pt'><b>PEMERINTAH KABUPATEN KEDIRI</b></td>
                </tr>
                <tr>
                    <td style='font-size:17pt' colspan='2'><b>SEKRETARIAT DAERAH</b></td>
                </tr>
                <tr>
                    <td style='font-size:12pt' colspan='2'>Jl. Soekarno Hatta No. 1 kediri Telp. (0354) 689901 - 689905</td>
                </tr>
                <tr>
                    <td style='font-size:12pt' colspan='2'>Website : <u>kedirikab.go.id</u></td>
                </tr>
                <tr>
                    <td colspan='2'>K E D I R I</td>
                </tr>
            </table>
            <!-- <hr class='bordersolid' style='color:black'> -->
            <hr class='bordersolid' style='height:4px;color:black'>
            <table width="100%" style="font-size:12pt;font-family:tahoma">
                <tr>
                    <td colspan="3" style="font-size: 14pt" align="center"><b><u>LAPORAN HASIL LEMBUR</u></b></td>
                </tr>
                <tr>
                    <td width="120px">Kepada</td>
                    <td>:</td>
                    <td>Yth. <?=$hasil['jabatan_penandatangan_st']?> Kabupaten Kediri</td>
                </tr>
                <tr>
                    <td>Dari</td>
                    <td>:</td>
                    <td><?=$kelAss->nama_bagian;?></td>
                </tr>
                <?php
                    $tglST = explode('-', $hasil['tgl_surat_tugas']);
                    $tglKegSp = explode('-', $hasil['tgl_kegiatan_sampai']);
                ?>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td>                        
                        <?=$tglKegSp[2].' '.$this->help->namaBulan($tglKegSp[1]).' '.$tglKegSp[0]?>
                    </td>
                </tr>
                <tr>
                    <td>Lampiran</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td valign="top">Perihal</td>
                    <td valign="top">:</td>
                    <td valign="top" style="text-align: justify;">Laporan hasil lembur <?=$hasil['perihal']?> sub kegiatan <?=$hasil['kegiatan']?> TA. <?=$hasil['tahun']?></td>
                </tr>
            </table>
            <hr class='bordersolid' style='color:black'>
            <table width="100%" style="font-size:12pt;line-height: 1.5;font-family:tahoma" border="0" cellspacing="-1">                
                <tr>
                    <td colspan="2"  style="text-align: justify;"><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dilaporkan dengan hormat hasil melaksanakan tugas lembur sub kegiatan <?=$hasil['kegiatan']?> Tahun Anggaran <?=$hasil['tahun']?>, sebagaimana surat perintah lembur Nomor: 900/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/<?=$kelAss->kode_bagian?>/<?=$hasil['tahun']?> tanggal <?=$tglST[2].' '.$this->help->namaBulan($tglST[1]).' '.$tglST[0]?>, yang diikuti oleh <?=count($detail).' ('.strtolower($this->help->terbilang(count($detail))).')'?> orang sebagaimana surat perintah lembur terlampir, dengan hasil sebagai berikut:</td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td width="50px"><b>A.</b></td>
                    <td><b>Jenis Kegiatan Yang Dikerjakan</b></td>
                </tr>  
                <tr>
                    <td></td>
                    <td><?=$hasil['perihal']?> sub kegiatan <?=$hasil['kegiatan']?>.</td>
                </tr>              
                <tr>
                    <td><b>B.</b></td>
                    <td><b>Waktu Pelaksanaan</b></td>
                </tr>
                <tr>
                    <td></td>
                    <td  style="text-align: justify;">Mengingat keterbatasan waktu dan tenaga, kegiatan <?=$hasil['perihal']?> sub kegiatan <?=$hasil['kegiatan']?>  TA. <?=$hasil['tahun']?> dilaksanakan di luar jam dan hari kerja, pada tanggal <?=$this->help->ReverseTgl($hasil['tgl_kegiatan_dari'])?> s/d <?=$this->help->ReverseTgl($hasil['tgl_kegiatan_sampai'])?></td>
                </tr>
                <tr>
                    <td><b>C.</b></td>
                    <td><b>Hasil Yang Dikerjakan</b></td>
                </tr>
                <tr>
                    <td></td>
                    <td>&nbsp;</td>
                </tr>
            </table> 
            <br>
            <table width="100%" style="font-size:12pt;line-height: 1.5;font-family:tahoma" border="0" cellspacing="-1"> 
                <tr>
                    <td style="text-align: justify;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Demikian untuk menjadikan periksa dan mohon petunjuk lebih lanjut.</td>
                </tr>
            </table>          
            <br>
            <table width="100%" style="font-size:12pt;line-height: 1;font-family:tahoma; text-align: center" border="0" cellspacing="-1">
                <tr>
                    <td>Mengetahui,</td>
                    <td width="10%">&nbsp;</td>
                    <td>Kediri,  <?=$tglKegSp[2].' '.$this->help->namaBulan($tglKegSp[1]).' '.$tglKegSp[0]?></td>
                </tr>
                <tr>
                    <td><?=ucwords(strtolower($hasil['jabatan_penandatangan_st']))?></td>
                    <td></td>
                    <td>Yang melaporkan,</td>
                </tr>
                <?php
                    $isKuasa = 'Kuasa '; 
                    if(empty($hasil['nama_pejabat_kpa'])){
                        $isKuasa = '';
                    }
                ?>
                <tr>
                    <td>Selaku KPA,</td>
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
                    <td align="center"><b><u><?=$hasil['nama_penandatangan_st']?></u></b></td>
                    <td></td>
                    <td align="center"><b><u><?=$detail[0]['nama_sdm']?></u></b></td>
                </tr>
                <tr>
                    <td align="center">NIP. <?=$hasil['nip_penandatangan_st']?></td>
                    <td></td>
                    <td align="center">NIP. <?=$detail[0]['nip']?></td>
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
.border_bottom{
    border-bottom: 1px solid black;
}
.bordersolid{
    border: 1px solid black; border-collapse: collapse;
}
</style>