<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Tarif Lembur</div>
        </div>
    </div>
</section>
<section class="content_section">
    <div class="content_spacer">
        <div class="content">
            <div class="box col-md-12">
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Sukses!</strong> <?php echo $this->session->flashdata('success') ?>
                    </div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Error!</strong> <?php echo $this->session->flashdata('error') ?>
                    </div>
                <?php endif; ?>
                <div class="box-inner">
                    <div class="box-header well">
                        <div class="pull-right">
                            <a href="<?=base_url()?>MsTarifLembur/create" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
                        </div>
                    </div>
                    <div class="box-content">  
                        <div class="table-responsive">                     
                            <table class="table table-bordered table-striped" id="example2" style="font-size: 10pt; width: 100%">
                                <thead>
                                    <tr>
                                        <th width="4%">No</th>
                                        <th width="8%">Kategori Pegawai</th>
                                        <th width="8%">Golongan</th>
                                        <th width="8%">Tarif Lembur</th>
                                        <th width="8%">Potongan PPh21 (%)</th>
                                        <th width="8%">Uang Makan</th>
                                        <th width="6%">Aksi</th>
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
            ajax: {"url": "<?= base_url()?>MsTarifLembur/getDatatables", "type": "POST"},
            columns: [
                {
                    "data": "id",
                    "orderable": false,
                    "className" : "text-center"
                },
                {
                    "data": "kategori",
                    "orderable": false,
                    "className" : "text-center"
                },
                {
                    "data": "golongan",
                    "orderable": false,
                    "className" : "text-center"
                },
                {
                    "data": "tarif",
                    "orderable": false,
                    "className" : "text-center"
                },
                {
                    "data": "pot_pph",
                    "orderable": false,
                    "className" : "text-center"
                },
                {
                    "data": "uang_makan",
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