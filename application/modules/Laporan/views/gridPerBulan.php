
<section class="content_section">
    <div class="content_spacer">
        <div class="content">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well">
                        <div class="pull-right">
                            <form action="<?=base_url()?>Laporan/pdfPerBulan" method="post" class="form-horizontal" target="_blank">
                                <input type="hidden" name="bulan" id="bulan" value='<?=$bulan?>''>
                                <input type="hidden" name="nama" id="nama" value='<?=$nama?>'>
                                <input type="hidden" name="fk_bagian_id" id="fk_bagian_id" value='<?=$fk_bagian_id?>'>
                                <button title="Cetak PDF" class="btn btn-sm btn-warning" target="_blank"><i class="glyphicon glyphicon-print"></i> Pdf</button>
                                <!-- <a title="Download Excel" class="btn btn-sm btn-warning" id="cetakExcel" ><i class="glyphicon glyphicon-download"></i> Excel</a> -->
                            </form>
                        </div>
                    </div>
                    <div class="box-content">  
                        <div class="table-responsive">                     
                            <table class="table table-bordered table-striped" id="example2">
                                <thead>
                                    <tr>
                                        <th style="vertical-align: middle;" rowspan="2" width="5%">No</th>
                                        <th style="vertical-align: middle;" rowspan="2">Nama SDM</th>
                                        <th style="text-align: center;" colspan="31">Tanggal</th>
                                    </tr>
                                    <tr>
                                        <th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th><th>9</th><th>10</th>
                                        <th>11</th><th>12</th><th>13</th><th>14</th><th>15</th><th>16</th><th>17</th><th>18</th><th>19</th><th>20</th>
                                        <th>21</th><th>22</th><th>23</th><th>24</th><th>25</th><th>26</th><th>27</th><th>28</th><th>29</th><th>30</th>
                                        <th>31</th>
                                    </tr>
                                </thead> 
                                <tbody>
                                    <?php $no=1; foreach ((array)$namaSDM as $val): ?>
                                        <tr>
                                            <td style="text-align: center;"><?=$no++?></td>
                                            <td><?=$val->nama_sdm?></td>
                                            <?php for ($i=1; $i <= 31; $i++) { ?>
                                                <?php
                                                    if(isset($hasil[$val->fk_sdm_id])){
                                                        echo "<td>";
                                                        foreach ($hasil[$val->fk_sdm_id] as $dtl) {
                                                            if($dtl->tgl==$i){
                                                                if($dtl->fk_kegiatan_orang_id==1){
                                                                    echo "<div style='background-color:red;width:20px'>&nbsp;</div>";
                                                                }
                                                                if($dtl->fk_kegiatan_orang_id==2){
                                                                    echo "<div style='background-color:green;width:20px'>&nbsp;</div>";
                                                                }
                                                                if($dtl->fk_kegiatan_orang_id==3){
                                                                    echo "<div style='background-color:blue;width:20px'>&nbsp;</div>";
                                                                }
                                                                if($dtl->fk_kegiatan_orang_id==4){
                                                                    echo "<div style='background-color:yellow;width:20px'>&nbsp;</div>";
                                                                }
                                                            }
                                                        }
                                                         echo "</td>";                                                            
                                                    }else{
                                                        echo "<td></td>";
                                                    }
                                                ?>
                                            <?php } ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>                  
                            </table>                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">                    
        <table class=" table-striped">
            <tr>
                <td width="22%" style="text-align: right"><b>DL</b></td>
                <td style="text-align: center" width="3%"><b>:</b></td>
                <td width="22%"><a style="color: red"><b>Merah</b></a></td>
                <td width="22%" style="text-align: right"><b>DD</b></td>
                <td align="center" style="text-align: center" width="3%"><b>:</b></td>
                <td width="22%"><a style="color: green"><b>Hijau</b></a></td>
            </tr>
            <tr>
                <td style="text-align: right"><b>Rapat</b></td>
                <td style="text-align: center" ><b>:</b></td>
                <td><a style="color: blue"><b>Biru</b></a></td>
                <td style="text-align: right"><b>Lembur</b></td>
                <td style="text-align: center" width="3%"><b>:</b></td>
                <td><a style="color: yellow"><b>Kuning</b></a></td>
            </tr>
        </table>
    </div>
</section>
<script type="text/javascript">
 $("#cetakExcel").click(function(){
    bulan = $("#bulan").val();
    nama = $("#nama").val();
    fk_bagian_id = $("#fk_bagian_id").val();
    window.location.href="<?= base_url()?>Laporan/excelPerBulan?bulan="+bulan+'&nama='+nama+'&fk_bagian_id='+fk_bagian_id;  
});

$('#example2').dataTable({
    "searching": false,
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
</script>