<!doctype html>
<html>
    <head>
        <title>Laporan DD & DL Per SDM</title>
    </head>
    <body>
        <div class="responsive">
            <table width="100%" style="font-size:11pt">
                <tr>
                    <th colspan="3">Laporan DD dan DL Per SDM</th> 
                </tr>
                <tr>
                    <th colspan="3"><?=$judul;?></th> 
                </tr>
                <tr>
                    <th colspan="3">Tahun <?=$this->session->userdata("tahun");?></th> 
                </tr>
                <tr><td colspan="3">&nbsp;</td></tr>
            </table>
            <table style="font-size:10px">
                <tr>
                    <td><b>Nama Pegawai</b></td>
                    <td><b>:</b></td>
                    <td><b><?=$hasil[0]->nama_sdm?></b></td>
                </tr>
            </table>
            <table border="1" cellspacing="0" width="100%" style="font-size:10px">
                <thead>
                    <tr>
                        <th width ="5%" >No</th>
                        <th>Kategori</th>
                        <th>No ST</th>
                        <th>Tgl ST</th>
                        <th>Tgl Berangkat</th>
                        <th>Tgl Kembali</th>
                        <th>Tujuan</th>
                        <th>Acara</th>
                        <th>Sub Kegiatan</th>
                    </tr>
                </thead>  
                <tbody>
                <?php $no=1;?>
                <?php foreach($hasil as $val):?> 
                    <tr>
                        <td valign="top" align="center"><?= $no++ ?></td>
                        <td valign="top" align="center"><?= $val->kategori ?></td>
                        <td valign="top" align="center"><?= $val->no_surat_tugas ?></td>
                        <td valign="top" align="center" width="100px"><?= $val->tglST ?></td>
                        <td valign="top" align="center" width="100px"><?= $val->tglBrgkt ?></td>
                        <td valign="top" align="center" width="100px"><?= $val->tglTiba ?></td>
                        <td valign="top"><?= $val->tujuan_skpd ?></td>
                        <td valign="top"><?= $val->acara ?></td>
                        <td valign="top"><?= $val->kegiatan ?></td>
                    </tr>  
                <?php endforeach; ?>
               </tbody>
            </table>
        </div>
    </body>
</html>