<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Proses Entry SPJ</div>
            <h1>
                <a href="<?=base_url()?>EntriSpj" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-list-alt"></i> Tabel Data</a>
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
                                <td style="text-align: right" class="col-md-2"><b>Nama GU</b></td>
                                <th width="20px">:</th>
                                <td class="col-md-4"><?= $entriGu['nama']; ?> </td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="table-responsive"> 
                        <form class="form-horizontal" action="<?php echo base_url();?>EntriSpj/save" method="post" enctype="multipart/form-data" onsubmit="return validateForm();" id="assignmentForm">
                            <table class="table table-bordered table-striped" id="example2">
                                <thead>
                                    <tr>
                                        <th style="text-align: center" width="40px">No</th>
                                        <th style="text-align: center">Bagian</th>
                                        <th style="text-align: center">Kegiatan</th>
                                        <th style="text-align: center">Jumlah</th>
                                        <th style="text-align: center">Status</th>
                                        <th style="text-align: center">Warna</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; $total=0;?>
                                    <?php foreach($detail as $val) :?>
                                        <tr>
                                            <td style="text-align: center" ><?php echo $no++;?></td>
                                            <td><?=$val['nama_bagian']?></td>
                                            <td><?=$val['nama_kegiatan_bappeda']?></td>
                                            <td style="text-align: right"><?=number_format($val['jumlah'])?></td>
                                            <td class="col-md-2" style="text-align: center">
                                                <?php if($val['status_spj_detail']==9){?>
                                                    <div class="btn btn-xs" style="background-color: blue; color:white">Selesai Scan</div>
                                                <?php }else{ ?>
                                                    <input type="hidden" name="id" value="<?=$entriGu['id']?>">
                                                    <input type="hidden" name="idDetail[]" value="<?=$val['id']?>">
                                                    <select class="form-control chosen" name="status_spj_detail[]" >
                                                        <option <?=$val['status_spj_detail']==3 || $val['status_spj_detail']==''?'selected':''?> value="3">Belum Selesai</option>
                                                        <option <?=$val['status_spj_detail']==0 && $val['status_spj_detail']!=''?'selected':''?> value="0">Masuk</option>
                                                        <option <?=$val['status_spj_detail']==1?'selected':''?> value="1">Selesai</option>
                                                        <option <?=$val['status_spj_detail']==2?'selected':''?> value="2">Revisi</option>
                                                        <option <?=$val['status_spj_detail']==9?'selected':''?> value="9">Selesai Scan</option>
                                                    </select>
                                                <?php } ?>
                                            </td>
                                            <?php 
                                                $stt = $val['status_spj_detail'];
                                                if($stt==0 && $stt!=NULL){
                                                    echo "<td  style='background-color:purple'></td>";
                                                }else if($stt==1){
                                                    echo "<td  style='background-color:green'></td>";
                                                }else if($stt==2){
                                                    echo "<td  style='background-color:yellow'></td>";
                                                }else if($stt==3 || $stt==NULL){
                                                    echo "<td  style='background-color:red'></td>";
                                                }else if($stt==9){
                                                    echo "<td  style='background-color:blue'></td>";
                                                }else{
                                                    echo "<td></td>";
                                                }
                                            ?>
                                        </tr>
                                        <?php $total += $val['jumlah'];?>
                                    <?php endforeach;?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td style="text-align: right"><b>TOTAL</b></td>
                                        <td style="text-align: right"><b><?=number_format($total)?></b></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="form-group">
                                <div class="col-md-2"></div>
                                <div class="col-md-6" align="center">
                                <button type="submit" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
$(document).ready(function() {
    // $('#example2').dataTable({
    //     // "searching": false,
    //     "bSort": false,
    //     'oLanguage': {
    //         "sProcessing":   "Sedang memproses...",
    //         "sLengthMenu":   "Tampilkan _MENU_ entri",
    //         "sZeroRecords":  "Tidak ditemukan data yang sesuai",
    //         "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
    //         "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
    //         "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
    //         "sInfoPostFix":  "",
    //         "sSearch":       "Cari:",
    //         "sUrl":          "",
    //         "oPaginate": {
    //             "sFirst":    "Pertama",
    //             "sPrevious": "Sebelumnya",
    //             "sNext":     "Selanjutnya",
    //             "sLast":     "Terakhir"
    //         }
    //     },
    // });
    
});

function validateForm(assignmentForm){
    return confirm('Apakah anda yakin?');
}
</script>