<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Rekanan Catering</div>
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
                            <a href="<?=base_url()?>MsRekananCatering/create" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
                        </div>
                    </div>
                    <div class="box-content">  
                        <div class="table-responsive">                     
                            <table class="table table-bordered table-striped" id="example2">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Rekanan</th>
                                        <th>NPWP</th>
                                        <th>Nama Pimpinan</th>
                                        <th>Jabatan</th>
                                        <th>Nama Bank</th>
                                        <th>No Rekening</th>
                                        <th>Atas Nama Rekening</th>
                                        <th>Alamat</th>
                                        <th>Desa/ Kel.</th>
                                        <th>Kecamatan</th>
                                        <th>Kab/ Kota</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
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
                    "sFirst":    "<<",
                    "sPrevious": "<",
                    "sNext":     ">",
                    "sLast":     ">>"
                }
            },
            processing: true,
            serverSide: true,
            ajax: {"url": "<?= base_url()?>MsRekananCatering/getDatatables", "type": "POST"},
            columns: [
                {
                    "data": "id",
                    "orderable": false,
                    "className" : "text-center"
                },
                {
                    "data": "nama_rekanan",
                    "orderable": false,
                },
                {
                    "data": "npwp",
                    "orderable": false,
                     "className" : "text-center"
                },
                {
                    "data": "nama_pemilik",
                    "orderable": false,
                     "className" : "text-center"
                },
                {
                    "data": "jabatan",
                    "orderable": false,
                     "className" : "text-center"
                },
                {
                    "data": "nama_bank",
                    "orderable": false,
                },
                {
                    "data": "no_rekening",
                    "orderable": false,
                },
                {
                    "data": "atas_nama_rekening",
                    "orderable": false,
                     "className" : "text-center"
                },
                {
                    "data": "jalan",
                    "orderable": false,
                },
                {
                    "data": "desa_kel",
                    "orderable": false,
                },                
                {
                    "data": "kecamatan",
                    "orderable": false,
                },                
                {
                    "data": "kab_kota",
                    "orderable": false,
                },
                {
                    "data": "status",
                    "orderable": false,
                    "className" : "text-center",
                    render : function (data, type, row) {
                        if(data==1){
                            return 'Aktif';
                        }
                        return 'Tidak Aktif';
                   },
                   "searchable": false,
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