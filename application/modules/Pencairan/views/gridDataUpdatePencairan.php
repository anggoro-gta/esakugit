
<section class="content_section">
    <div class="content_spacer">
        <div class="content">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well">
                    </div>
                    <div class="box-content">  
                        <div class="table-responsive"> 
                             <table class="table table-bordered table-striped" id="example2">
                                <thead>
                                    <tr>
                                        <?php if($updateRkp){ ?>
                                            <th class="text-center">Pilih<br><input type="checkbox" id="cekAll" title="Pilih Semua"></th>
                                        <?php } ?>
                                        <th style="text-align: center; vertical-align: middle;" width="5%" class="text-center">No</th>
                                        <th style="text-align: center; vertical-align: middle;">Kategori Rekap</th>
                                        <th style="text-align: center;">Bl. SPJ</th>
                                        <th style="text-align: center;">Tgl Rekap</th>
                                        <th style="text-align: center;">Bagian</th>
                                        <th style="text-align: center;">Sub Kegiatan</th>
                                        <th style="text-align: center;">Rek. Belanja</th>
                                        <th style="text-align: center;">Jumlah Dana</th>
                                        <th style="text-align: center">Pengajuan Sebelum</th>
                                        <th style="text-align: center;">Pengajuan Sekarang</th>
                                        <th style="text-align: center;">Sisa Anggaran</th>
                                    </tr>
                                </thead>   
                                <tbody>
                                    <?php $no=1; foreach ((array)$hasil as $val): ?>
                                        <tr>
                                            <?php if($updateRkp){ ?>
                                                <td class="text-center">
                                                    <input type="checkbox" class="dataCek" name="dataPilih[<?=$val['id']?>]" value="<?=$val['id']?>">
                                                    <input type="hidden" name="tabelnya[<?=$val['id']?>]" value="<?=$val['tabelnya']?>">
                                                </td>
                                            <?php } ?>
                                            <td class="text-center"><?=$no++?></td>
                                            <td><?=$val['kategori_rekap']?></td>
                                            <td><?=$val['nama_bulan']?></td>
                                            <td class="text-center"><?=$this->help->ReverseTgl($val['tgl_rekap'])?></td>
                                            <td><?=$val['singkatan_bagian']?></td>
                                            <td><?=$val['kegiatan']?></td>
                                            <td><?=$val['nama_rek_belanja']?></td>
                                            <td class="text-right"><?=$val['jml_dana_idr']?></td>
                                            <td class="text-right"><?=$val['pengajuan_sebelum_idr']?></td>
                                            <td class="text-right"><?=$val['pengajuan_sekarang_idr']?></td>
                                            <td class="text-right"><?=$val['sisa_kas_idr']?></td>
                                        </tr>
                                    <?php  endforeach; ?>
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
<script type="text/javascript">
$("#cekAll").change(function(){
    if (this.checked) {
        $('.dataCek').prop('checked',true);
    } else {
        $('.dataCek').prop('checked', false);
    }      
});


</script>