 <section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Update TBP</div>
            <h1>
                <a href="<?=base_url()?>Pencairan" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-list-alt"></i> Tabel Data</a>
            </h1>
        </div>
    </div>
</section>
<section class="content_section">
    <div class="content_spacer">
        <div class="content">
            <div class="box col-md-12">
                <div class="panel panel-default">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <td style="text-align: right" class="col-md-2"><b>Tgl Pencairan</b></td>
                                <th>:</th>
                                <td class="col-md-4"><?= $this->help->ReverseTgl($hasil->tgl_pencairan); ?> </td>
                                <td style="text-align: right" class="col-md-2"><b>PA</b></td>
                                <th>:</th>
                                <td class="col-md-5"><?= $hasil->nama_pejabat_pa; ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><b>Jenis Anggaran</b></td>
                                <th>:</th>
                                <td><?= $hasil->jenis_anggaran; ?> </td>
                                <td style="text-align: right"><b>PPTK</b></td>
                                <th>:</th>
                                <td><?= $hasil->nama_pejabat_pptk; ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><b>Bagian</b></td>
                                <th>:</th>
                                <td><?= $hasil->singkatan_bagian; ?> </td>
                                <td style="text-align: right"><b>Bendahara Pengeluaran</b></td>
                                <th>:</th>
                                <td><?= $hasil->nama_bendahara; ?></td>
                            </tr> 
                        </table>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="table-responsive">  
                        <form class="form-horizontal" action="<?=$url?>" method="post" enctype="multipart/form-data" autocomplete='off'>                   
                            <table class="table table-bordered table-striped" id="example2">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="5%">No</th>
                                        <th class="text-center" width="10%">No. TBP</th>
                                        <th class="text-center">Bl. SPJ</th>
                                        <th class="text-center">Tgl Rekap</th>
                                        <th class="text-center">Bagian</th>
                                        <th class="text-center">Sub Kegiatan</th>
                                        <th class="text-center">Rek Belanja</th>
                                        <th class="text-center">Jml Dana</th>
                                        <th class="text-center">Pengajuan Sebelum</th>
                                        <th class="text-center">Pengajuan Sekarang</th>
                                        <th class="text-center">Sisa Anggaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1;?>
                                    <input type="hidden" name="id_pencairan" value="<?=$hasil->id?>" class="form-control">
                                    <?php foreach((array)$detail as $val) :?>
                                        <tr>
                                            <td style="text-align: center" ><?php echo $no++;?></td>
                                            <td>
                                                <input type="text" name="listId[<?=$val->id?>]" value="<?=$val->info_no_bku?>" class="form-control text-center">
                                                <input type="hidden" name="listTabelnya[<?=$val->id?>]" value="<?=$val->tabelnya?>" class="form-control">
                                            </td>
                                            <td align="center"><?=$val->nama_bulan?></td>
                                            <td align="center"><?=$this->help->ReverseTgl($val->tgl_rekap)?></td>
                                            <td align="center"><?=$val->singkatan_bagian?></td>
                                            <td><?=$val->kegiatan?></td>
                                            <td><?=$val->nama_rek_belanja?></td>
                                            <td style="text-align: right"><?=$val->jml_dana_idr?></td>
                                            <td style="text-align: right"><?=$val->pengajuan_sebelum_idr?></td>
                                            <td style="text-align: right"><?=$val->pengajuan_sekarang_idr?></td>
                                            <td style="text-align: right"><?=$val->sisa_kas_idr?></td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                            <div class="form-group">
                                <div class="col-md-2"></div>
                                <div class="col-md-6" align="center">
                                <button id="submit" type="submit" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-hdd"></i> Update TBP</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>