
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
                                        <th style="text-align: center; vertical-align: middle;">Tgl Pesanan</th>
                                        <th style="text-align: center; vertical-align: middle;">Perihal</th>
                                        <th style="text-align: center; vertical-align: middle;">Rekanan</th>
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
                                            <td class="text-center"><?=$this->help->ReverseTgl($val['tgl_pesanan'])?></td>
                                            <td class="text-center"><?=$val['perihal']?></td>
                                            <td><?=$val['nama_rekanan']?></td>
                                            <td class="text-right"><?=number_format($val['total_akhir_all'])?>
                                                <input type="hidden" id="subTotal_<?=$val['id']?>" value="<?=$val['total_akhir_all']?>">
                                            </td>
                                            <td><?=$val['kegiatan_bappeda']?></td>
                                        </tr>
                                    <?php  $totPengajuan+=$val['total_akhir_all']; ?>
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