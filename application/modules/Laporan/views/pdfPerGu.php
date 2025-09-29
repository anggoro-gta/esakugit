<!doctype html>
<html>
    <head>
        <title>Laporan Per GU</title>
    </head>
    <body>
        <div class="responsive">
            <table width="100%" style="font-size:11pt">
                <tr>
                    <th colspan="5">Laporan Data Kegiatan Per GU</th> 
                </tr>
                <tr><td colspan="5">&nbsp;</td></tr>
            </table>
            <table style="font-size:10px">
                <tr>
                    <td><b>Nama GU</b></td>
                    <td><b>:</b></td>
                    <td colspan="3"><b><?=$namaGU['nama']?></b></td>
                </tr>
            </table>
            <table border="1" cellspacing="0" width="100%" style="font-size:10px">
                <thead>
                    <tr>
                        <th width ="5%" >No</th>
                        <th>Bagian</th>
                        <th>Kegiatan</th>
                        <th class="text-center">Jumlah</th>
                        <th>Status</th>
                    </tr>
                </thead>  
                <tbody>
                    <?php $no=1;?>
                    <?php foreach($hasil as $val) :?>
                        <tr>
                            <td style="text-align: center" ><?php echo $no++;?></td>
                            <td><?=$val->nama_bagian?></td>
                            <td><?=$val->nama_kegiatan_bappeda?></td>
                            <td style="text-align: right"><?=number_format($val->jumlah)?></td>
                            <td style="text-align: center"><span style="<?=$val->warna_laporan?>"><?=$val->keterangan?></span></td>
                        </tr>
                    <?php endforeach;?>
               </tbody>
            </table>
        </div>
    </body>
</html>