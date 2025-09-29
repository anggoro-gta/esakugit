
<section class="content_section">
    <div class="content_spacer">
        <div class="content">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well">
                        <div class="pull-right">
                            <a href="<?=base_url()?>MsProgram/create" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
                        </div>
                    </div>
                    <div class="box-content">  
                        <div class="table-responsive">                     
                            <table class="table table-bordered table-striped" id="example2">
                                <thead>
                                    <tr>
                                        <th style="vertical-align: middle" rowspan="2" >No</th>
                                        <th style="vertical-align: middle" rowspan="2">Nama Bagian</th>
                                        <th style="vertical-align: middle" rowspan="2">Nama Program</th>
                                        <th style="vertical-align: middle" rowspan="2">Nama Kegiatan</th>
                                        <th style="vertical-align: middle" rowspan="2">Kode Kegiatan</th>
                                        <th style="text-align: center" colspan="2">Masa Berlaku</th>
                                        <th style="vertical-align: middle" rowspan="2">Aksi</th>
                                    </tr>
                                    <tr>
                                        <th>Dari</th>
                                        <th>Sampai</th>
                                    </tr>
                                </thead>                        
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function() {
        var t = $("#example2").dataTable({
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
            ajax: {"url": "<?= base_url()?>MsProgram/getDatatables", "type": "POST", "data": {"fk_bagian_id": "<?=$fk_bagian_id?>"}
            },
            columns: [
                {
                    "data": "id",
                    "orderable": false,
                    "className" : "text-center"
                },
                {
                    "data": "nama_bagian",
                    "orderable": false,
                },
                {
                    "data": "program_utama",
                    "orderable": false,
                },
                {
                    "data": "nama_program",
                    "orderable": false,
                },
                {
                    "data": "kode_program",
                    "orderable": false,
                     "className" : "text-center"
                },
                {
                    "data": "thn_dari",
                    "orderable": false,
                     "className" : "text-center"
                },
                {
                    "data": "thn_sampai",
                    "orderable": false,
                     "className" : "text-center"
                },
                {
                    "data": "action",
                    "orderable": false,
                    "className" : "text-center"
                },
            ],
            order: [[0, 'desc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });
    });
</script>