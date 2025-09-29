<!doctype html>
<html>
    <head>
        <title>Laporan Seluruh GU</title>
        <style type="text/css">
        .str{ 
            mso-number-format:\@; 
        }
        </style>
    </head>
    <body>
        <div class="responsive">
            <table width="100%" style="font-size:11pt">
                <tr>
                    <th colspan="<?=count($arrEntriGu)+3?>">Laporan Data Kegiatan Seluruh GU</th> 
                </tr>
                <tr>
                    <th colspan="<?=count($arrEntriGu)+3?>">Tahun <?= $this->session->userdata("tahun")?></th> 
                </tr>
                <tr><td colspan="<?=count($arrEntriGu)+3?>">&nbsp;</td></tr>
            </table>
            <table border="1" cellspacing="0" width="100%" style="font-size:10px">
                <thead>
                    <tr>
                        <th width="5%" rowspan="2" style="vertical-align: middle;text-align: center;">No</th>
                        <th rowspan="2" style="vertical-align: middle;text-align: center;">Bagian</th>
                        <th rowspan="2" style="vertical-align: middle;text-align: center;">Kegiatan</th>
                        <th colspan="<?=count($arrEntriGu)?>" style="text-align: center;">Nama GU</th>                                        
                    </tr>
                    <tr>
                        <?php foreach ($arrEntriGu as $val): ?>
                            <th class="str" style="text-align: center;width: 50px"><?= $val['nama']; ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach ($arrKegBappeda as $keg): ?>
                    <tr>
                        <td style="text-align: center;"><?= $no++; ?></td>
                        <td style="text-align: center; width: 120px"><?= $keg->nama_bagian; ?></td>
                        <td><?= $keg->kegiatan; ?></td>
                        <?php foreach ($arrEntriGu as $cek): ?>
                            <?php if($arrDetailGu[$cek['id']][$keg->id]): ?>
                                <td style="text-align: center;<?=$arrDetailGu[$cek['id']][$keg->id]->warna_laporan?>" ></td>
                            <?php else: ?>
                                <td style="text-align: center;"></td>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>   
            </table>
            <br>
            <div class="col-md-6">                    
                <table cellspacing="0" width="30%" style="font-size:10px">
                    <tr>
                        <td style="text-align: right"><b>Masuk</b></td>
                        <td style="text-align: center"><b>:</b></td>
                        <td style="color: purple"><b>Ungu</b></td>
                        <td style="text-align: right"><b>Selesai</b></td>
                        <td align="center" style="text-align: center"><b>:</b></td>
                        <td style="color: green"><b>Hijau</b></td>
                    </tr>
                    <tr>
                        <td style="text-align: right"><b>Belum Selesai</b></td>
                        <td style="text-align: center"><b>:</b></td>
                        <td style="color: red">Merah</b></td>
                        <td style="text-align: right"><b>Selesai Scan</b></td>
                        <td style="text-align: center" ><b>:</b></td>
                        <td style="color: blue"><b>Biru</b></td>
                    </tr>
                    <tr>
                        <td style="text-align: right"><b>Revisi</b></td>
                        <td style="text-align: center"><b>:</b></td>
                        <td style="color: yellow"><b>Kuning</b></td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>