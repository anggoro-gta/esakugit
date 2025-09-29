
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
                                        <?php if($updateBku){ ?>
                                            <th class="text-center">Pilih<br><input type="checkbox" id="cekAll" title="Pilih Semua"></th>
                                        <?php } ?>
                                        <th width="5%" class="text-center">No</th>
                                        <!-- <th>Bulan</th> -->
                                        <th>No Surat Tugas</th>
                                        <th>Tgl Surat Tugas</th>
                                        <th>Tgl Berangkat</th>
                                        <th>Tgl Tiba</th>
                                        <th>Kab/Kota</th>
                                        <th>Tujuan</th>
                                        <th class="text-center">Jml Anggota</th>
                                        <th class="text-center">Nominal</th>
                                    </tr>
                                </thead>  
                                <tbody>
                                    <?php $totPengajuan=0;
                                     if($hasil[0]['id']!=null): ?>
                                        <?php $no=1; foreach ($hasil as $val): ?>
                                            <tr>
                                                <?php if($updateBku){ ?>
                                                    <td class="text-center"><input type="checkbox" class="dataCek" name="dataPilih[<?=$val['id']?>]" value="<?=$val['id']?>"></td>
                                                <?php } ?>
                                                <td class="text-center"><?=$no++?></td>
                                                <!-- <td><?=$this->help->namaBulan($val['bulan'])?></td> -->
                                                <td class="text-center"><?=$val['no_surat_tugas']?></td>
                                                <td class="text-center"><?=$this->help->ReverseTgl($val['tgl_surat_tugas'])?></td>
                                                <td class="text-center"><?=$this->help->ReverseTgl($val['tgl_berangkat'])?></td>
                                                <td class="text-center"><?=$this->help->ReverseTgl($val['tgl_tiba'])?></td>
                                                <td class="text-center"><?=$val['kota']?></td>
                                                <td><?=$val['tujuan_skpd']?></td>
                                                <td class="text-center"><?=$val['total_pjd']?></td>
                                                <td class="text-right"><?=number_format($val['total_akhir_all'])?>
                                                    <input type="hidden" id="subTotal_<?=$val['id']?>" value="<?=$val['total_akhir_all']?>">
                                                </td>
                                            </tr>
                                        <?php  $totPengajuan+=$val['total_akhir_all'];
                                         endforeach; ?>
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