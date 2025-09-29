
<section class="content_section">
    <div class="content_spacer">
        <div class="content">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well">
                    </div>
                    <div class="box-content">  
                        <div class="table-responsive">    
                            <?php if($tabel=='t_kwitansi' || $tabel=='t_kwitansi_hr') { ?>               
                                <table class="table table-bordered table-striped" id="example2">
                                    <thead>
                                        <tr>
                                            <?php if($updateRkp){ ?>
                                                <th class="text-center">Pilih<br><input type="checkbox" id="cekAll" title="Pilih Semua"></th>
                                            <?php } ?>
                                            <th width="5%" class="text-center">No</th>
                                            <?php if($is_kwi_hr=='yes'){ ?>
                                                <th>Kategori</th>
                                            <?php } ?>
                                            <th>Tgl Kwitansi</th>
                                            <th>Untuk Pembayaran</th>
                                            <?php if($is_kwi_hr=='yes'){ ?>
                                                <th>HR Bulan</th>
                                            <?php } ?>
                                            <th class="text-right">Banyaknya Uang</th>
                                            <th>Sub Kegiatan</th>
                                        </tr>
                                    </thead>  
                                    <tbody>
                                        <?php $totPengajuan=0; ?>
                                        <?php $no=1; foreach ((array)$hasil as $val): ?>
                                            <tr>
                                                <?php if($updateRkp){ ?>
                                                    <td class="text-center"><input type="checkbox" class="dataCek" name="dataPilih[<?=$val['id']?>]" value="<?=$val['id']?>"></td>
                                                <?php } ?>
                                                <td class="text-center"><?=$no++?></td>
                                                <?php if($is_kwi_hr=='yes'){ ?>
                                                    <td class="text-center"><?=$val['kategori']?></td>
                                                <?php } ?>
                                                <td class="text-center"><?=$this->help->ReverseTgl($val['tgl_kwitansi'])?></td>
                                                <td><?=$val['untuk_pembayaran']?></td>
                                                <?php if($is_kwi_hr=='yes'){ ?>
                                                    <td class="text-center"><?=$this->help->namaBulan($val['hr_bulan'])?></td>
                                                <?php } ?>
                                                <td class="text-right"><?=number_format($val['total_akhir_all'])?>
                                                    <input type="hidden" id="subTotal_<?=$val['id']?>" value="<?=$val['total_akhir_all']?>">
                                                </td>
                                                <td><?=$val['kegiatan']?></td>
                                            </tr>
                                        <?php  $totPengajuan+=$val['total_akhir_all'];
                                         endforeach; ?>
                                    </tbody>                 
                                </table>
                            <?php } ?>
                            <?php if($tabel=='t_rapat') { ?>
                                 <table class="table table-bordered table-striped" id="example2">
                                    <thead>
                                        <tr>
                                            <?php if($updateRkp){ ?>
                                                <th class="text-center">Pilih<br><input type="checkbox" id="cekAll" title="Pilih Semua"></th>
                                            <?php } ?>
                                            <th style="text-align: center; vertical-align: middle;" width="5%" class="text-center">No</th>
                                            <th style="text-align: center; vertical-align: middle;">Hari</th>
                                            <th style="text-align: center; vertical-align: middle;">Tgl Rapat</th>
                                            <th style="text-align: center; vertical-align: middle;">Pukul</th>
                                            <th style="text-align: center; vertical-align: middle;">Tempat</th>
                                            <th style="text-align: center; vertical-align: middle;">Acara</th>
                                            <th class="text-right">Banyaknya Uang</th>
                                            <th style="text-align: center; vertical-align: middle;">Kegiatan</th>
                                        </tr>
                                    </thead>   
                                    <tbody>
                                        <?php $totPengajuan=0; ?>
                                        <?php $no=1; foreach ((array)$hasil as $val): ?>
                                            <tr>
                                                <?php if($updateRkp){ ?>
                                                    <td class="text-center"><input type="checkbox" class="dataCek" name="dataPilih[<?=$val['id']?>]" value="<?=$val['id']?>"></td>
                                                <?php } ?>
                                                <td class="text-center"><?=$no++?></td>
                                                <td><?=$val['hari']?></td>
                                                <td class="text-center"><?=$this->help->ReverseTgl($val['tgl'])?></td>
                                                <td><?=$val['pukul']?></td>
                                                <td><?=$val['tempat']?></td>
                                                <td><?=$val['acara']?></td>
                                                <td class="text-right"><?=number_format($val['total_akhir_all'])?>
                                                    <input type="hidden" id="subTotal_<?=$val['id']?>" value="<?=$val['total_akhir_all']?>">
                                                </td>
                                                <td><?=$val['kegiatan']?></td>
                                            </tr>
                                        <?php  $totPengajuan+=$val['total_akhir_all']; ?>
                                        <?php  endforeach; ?>
                                    </tbody>                 
                                </table>
                            <?php } ?>
                            <?php if($tabel=='t_entri_lembur') { ?>
                                 <table class="table table-bordered table-striped" id="example2">
                                    <thead>
                                        <tr>
                                            <?php if($updateRkp){ ?>
                                                <th class="text-center" rowspan="2">Pilih<br><input type="checkbox" id="cekAll" title="Pilih Semua"></th>
                                            <?php } ?>
                                            <th style="text-align: center; vertical-align: middle;" rowspan="2" width="5%" class="text-center">No</th>
                                            <th style="text-align: center; vertical-align: middle;" rowspan="2">Tgl ST</th>
                                            <th style="text-align: center; vertical-align: middle;" rowspan="2">Perihal</th>
                                            <th style="text-align: center; vertical-align: middle;" colspan="2">Tgl Kegiatan</th>
                                            <th class="text-right" rowspan="2">Banyaknya Uang</th>
                                            <th style="text-align: center; vertical-align: middle;" rowspan="2">Kegiatan</th>
                                        </tr>
                                        <tr>
                                            <th>Dari</th>
                                            <th>Sampai</th>
                                        </tr>
                                    </thead>  
                                    <tbody>
                                        <?php $totPengajuan=0; ?>
                                        <?php $no=1; foreach ((array)$hasil as $val): ?>
                                            <tr>
                                                <?php if($updateRkp){ ?>
                                                    <td class="text-center"><input type="checkbox" class="dataCek" name="dataPilih[<?=$val['id']?>]" value="<?=$val['id']?>"></td>
                                                <?php } ?>
                                                <td class="text-center"><?=$no++?></td>
                                                <td class="text-center"><?=$this->help->ReverseTgl($val['tgl_surat_tugas'])?></td>
                                                <td><?=$val['perihal']?></td>
                                                <td class="text-center"><?=$this->help->ReverseTgl($val['tgl_kegiatan_dari'])?></td>
                                                <td class="text-center"><?=$this->help->ReverseTgl($val['tgl_kegiatan_sampai'])?></td>
                                                <td class="text-right"><?=number_format($val['total_akhir_all'])?>
                                                    <input type="hidden" id="subTotal_<?=$val['id']?>" value="<?=$val['total_akhir_all']?>">
                                                </td>
                                                <td><?=$val['kegiatan']?></td>
                                            </tr>
                                        <?php  $totPengajuan+=$val['total_akhir_all']; ?>
                                        <?php  endforeach; ?>
                                    </tbody>
                                </table>      
                            <?php } ?>
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
    cek_total();     
});

$(".dataCek").click(function(){
    cek_total();     
});

function cek_total(){
    sub_tot = 0
    $('.dataCek').each(function(e) {
        if ($(this).is(':checked')) {// check the checked property with .is
               id=$(this).val();
               sub_tot += parseFloat($("#subTotal_"+id).val());
        }
        
    });
    $("#pengajuan_sekarang").val(convertToRupiah(sub_tot));
    sisaDana();
}

</script>