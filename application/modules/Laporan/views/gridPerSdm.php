
<section class="content_section">
    <div class="content_spacer">
        <div class="content">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well">
                        <div class="pull-right">
                            <form action="<?=base_url()?>Laporan/pdfSdm" method="post" class="form-horizontal" target="_blank">
                                <input type="hidden" name="nama" id="nama" value="<?=$nama?>">
                                <input type="hidden" name="bulan_awal" id="bulan_awal" value="<?=$bulan_awal?>">
                                <input type="hidden" name="bulan_akhir" id="bulan_akhir" value="<?=$bulan_akhir?>">
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
                                        <th>Nomor</th>
                                        <th>Tanggal</th>
                                        <th>Kegiatan Orang</th>
                                        <th>Kegiatan</th>
                                    </tr>
                                </thead>                   
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
        nama = $("#nama").val();
        bulan_awal = $("#bulan_awal").val();
        bulan_akhir  = $("#bulan_akhir").val();
        
        window.location.href="<?= base_url()?>Laporan/excelSdm?nama="+nama+'&bulan_awal='+bulan_awal+'&bulan_akhir='+bulan_akhir;  
    });

    var t = $("#example2").dataTable({
        "lengthMenu": [[10, 25, 50, 100, 500, -1], [10, 25, 50, 100, 500, "All"]],
        initComplete: function() {
            var api = this.api();
            $('#mytable_filter input')
                    .off('.DT')
                    .on('keyup.DT', function(e) {
                        if (e.keyCode == 13) {
                            api.search(this.value).draw();
                }
            });
        },
        'oLanguage':
        {
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
        processing: true,
        serverSide: true,
        ajax: {"url": "<?= base_url()?>Laporan/getDatatablesPerSdm", "type": "POST", "data": {
                "nama": "<?=$nama?>","bulan_awal": "<?=$bulan_awal?>","bulan_akhir": "<?=$bulan_akhir?>"}
        },
        columns: [
            {
                "data": "id",
                "orderable": false,
                "className" : "text-center"
            },
            {"data": "nomor"},
            {"data": "tglnya"},
            {"data": "nama_kegiatan_orang"},
            {"data": "kegiatan"},
        ],
        order: [[0, 'desc']],
        rowCallback: function(row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $('td:eq(0)', row).html(index);
        },
    });
});
</script>