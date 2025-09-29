
<section class="content_section">
    <div class="content_spacer">
        <div class="content">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well">
                        <div class="pull-right">
                            <form action="<?=base_url()?>Laporan/pdfPerGu" method="post" class="form-horizontal" target="_blank">
                                <input type="hidden" name="id_gu" id="id_gu" value="<?=$id_gu?>">
                                <button title="Cetak PDF" class="btn btn-sm btn-warning" target="_blank"><i class="glyphicon glyphicon-print"></i> Pdf</button>
                                <a title="Download Excel" class="btn btn-sm btn-warning" id="cetakExcel" ><i class="glyphicon glyphicon-download"></i> Excel</a>
                            </form>
                        </div>
                    </div>
                    <div class="box-content">  
                        <div class="table-responsive">                     
                            <table class="table table-bordered table-striped" id="example2">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
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
                                            <td valign="top" style="text-align: center" ><?php echo $no++;?></td>
                                            <td valign="top"><?=$val->nama_bagian?></td>
                                            <td valign="top"><?=$val->nama_kegiatan_bappeda?></td>
                                            <td valign="top" style="text-align: right"><?=number_format($val->jumlah)?></td>
                                            <td valign="top" style="text-align: center"><span class="btn btn-xs btn-<?=$val->warna?>" style="<?=$val->warna?>"><?=$val->keterangan?></span></td>
                                        </tr>
                                    <?php endforeach;?>
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
$(document).ready(function() {
    $("#cetakExcel").click(function(){
        id_gu = $("#id_gu").val();
        
        window.location.href="<?= base_url()?>Laporan/excelPerGu?id_gu="+id_gu;  
    });

    $('#example2').dataTable({
        // "searching": false,
        "bSort": false,
        'oLanguage': {
            "sProcessing":   "Sedang memproses...",
            "sLengthMenu":   "Tampilkan _MENU_ entri",
            "sZeroRecords":  "Tidak ditemukan data yang sesuai",
            "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
            "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
            "sInfoPostFix":  "",
            "sSearch":       "Cari:",
            "sUrl":          "",
            "oPaginate": {
                "sFirst":    "Pertama",
                "sPrevious": "Sebelumnya",
                "sNext":     "Selanjutnya",
                "sLast":     "Terakhir"
            }
        },
    });
});
</script>