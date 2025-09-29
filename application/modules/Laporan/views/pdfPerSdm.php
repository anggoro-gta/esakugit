<!doctype html>
<html>
    <head>
        <title>Laporan Per SDM</title>
    </head>
    <body>
        <div class="responsive">
            <table width="100%" style="font-size:11pt">
                <tr>
                    <th colspan="3">Laporan Data Kegiatan Per SDM</th> 
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
                    <td><b>Nama SDM</b></td>
                    <td><b>:</b></td>
                    <td><b><?=$hasil[0]->nama_sdm?></b></td>
                </tr>
            </table>
            <table border="1" cellspacing="0" width="100%" style="font-size:10px">
                <thead>
                    <tr>
                        <th width ="5%" >No</th>
                        <th>Nomor</th>
                        <th>Tanggal</th>
                        <th>Kegiatan Orang</th>
                        <th>Kegiatan Bappeda</th>
                    </tr>
                </thead>  
                <tbody>
                <?php $no=1;?>
                <?php foreach($hasil as $val):?> 
                    <tr>
                        <td align="center"><?= $no++ ?></td>
                        <td><?= $val->nomor ?></td>
                        <td align="center" width="100px"><?= $val->tglnya ?></td>
                        <td><?= $val->nama_kegiatan_orang ?></td>
                        <td><?= $val->kegiatan ?></td>
                    </tr>  
                <?php endforeach; ?>
               </tbody>
            </table>
        </div>
    </body>
</html>