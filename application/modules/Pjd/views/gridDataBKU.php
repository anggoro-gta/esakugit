
<section class="content_section">
    <div class="content_spacer">
        <div class="content">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well">
                        <div class="pull-right">
                            <form action="<?=base_url()?>Pjd/pdfKwitansiAll" method="post" class="form-horizontal" target="_blank">
                                <input type="hidden" name="fk_gu_id" value="<?=$fk_gu_id?>">
                                <input type="hidden" name="fk_bagian_id" value="<?=$fk_bagian_id?>">
                                <input type="hidden" name="fk_kegiatan_id" value="<?=$fk_kegiatan_id?>">
                                <input type="hidden" name="kategori" value="<?=$kategori?>">
                                <input type="hidden" name="no_bku" value="<?=$no_bku?>">
                                <button title="Cetak PDF" class="btn btn-sm btn-warning" target="_blank"><i class="glyphicon glyphicon-print"></i> Cetak Kwitansi ALL</button>
                            </form>
                        </div>
                    </div>
                    <div class="box-content">  
                        <div class="table-responsive">                     
                            <table class="table table-bordered table-striped" id="example2">
                                <thead>
                                    <tr>
                                        <th width="5%" class="text-center">No</th>
                                        <th>Bagian</th>
                                        <th>Kategori</th>
                                        <th>Bulan</th>
                                        <th>No Surat Tugas</th>
                                        <th>Tgl Surat Tugas</th>
                                        <th class="text-center">Jml Anggota</th>
                                        <th class="text-center">No. BKU</th>
                                    </tr>
                                </thead>  
                                <tbody>
                                    <?php if($no_bku): ?>
                                        <?php $no=1; foreach ($hasil as $val): ?>
                                            <tr>
                                                <td class="text-center"><?=$no++?></td>
                                                <td><?=$val['nama_bagian']?></td>
                                                <td><?=$val['kategori']?></td>
                                                <td><?=$this->help->namaBulan($val['bulan'])?></td>
                                                <td><?=$val['no_surat_tugas']?></td>
                                                <td><?=$this->help->ReverseTgl($val['tgl_surat_tugas'])?></td>
                                                <td class="text-center"><?=$val['total_pjd']?></td>
                                                <td class="text-center"><?=$val['no_bku']?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>                 
                            </table>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>