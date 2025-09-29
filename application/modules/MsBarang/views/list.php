<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Barang</div>
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
                            <?php if($this->session->level!=2){ ?>
                                <a href="<?=base_url()?>MsBarang/create" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="box-content">  
                        <div class="table-responsive">                     
                            <table class="table table-bordered table-striped" id="example2" width="100%">
                                <thead>
                                    <tr>
                                        <th style="vertical-align: middle;text-align: center" rowspan="2">No</th>
                                        <th style="vertical-align: middle;text-align: center" colspan="2">Masa Tahun</th>
                                        <th style="vertical-align: middle;text-align: center" rowspan="2">Kode Barang</th>
                                        <th style="vertical-align: middle;text-align: center" rowspan="2">Kategori Barang</th>
                                        <th style="vertical-align: middle;text-align: center" rowspan="2">Nama Barang</th>
                                        <th style="vertical-align: middle;text-align: center" rowspan="2">Merk</th>
                                        <th style="vertical-align: middle;text-align: center" rowspan="2">Spesifikasi</th>
                                        <th style="vertical-align: middle;text-align: center" rowspan="2">Satuan</th>
                                        <th style="vertical-align: middle;text-align: right" rowspan="2">Harga Maksimal</th>
                                        <th style="vertical-align: middle;text-align: center" rowspan="2">Stok Global</th>
                                        <th style="vertical-align: middle;text-align: center" rowspan="2">Aksi</th>
                                    </tr>
                                    <tr>
                                        <th>Awal</th>
                                        <th>Akhir</th>
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
<input type="hidden" id="level" value="<?=$this->session->level?>">

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
            ajax: {"url": "<?= base_url()?>MsBarang/getDatatables", "type": "POST"},
            columns: [
                {
                    "data": "id",
                    "orderable": false,
                    "className" : "text-center"
                },
                {
                    "data": "masa_thn_awal",
                    "orderable": false,
                },    
                {
                    "data": "masa_thn_akhir",
                    "orderable": false,
                },    
                {
                    "data": "kode_barang",
                    "orderable": false,
                },               
                {
                    "data": "nama_kategori",
                    "orderable": false,
                     "className" : "text-center"
                },
                {
                    "data": "nama_barang",
                    "orderable": false,
                },
                {
                    "data": "merk",
                    "orderable": false,
                     "className" : "text-center"
                },
                {
                    "data": "spesifikasi",
                    "orderable": false,
                     "className" : "text-center"
                },
                {
                    "data": "satuan",
                    "orderable": false,
                     "className" : "text-center"
                },                
                {
                    "data": "std_harga_satuan",
                    "orderable": false,
                    "searchable": false,
                     "className" : "text-right"
                },
                {
                    "data": "stok_global",
                    "orderable": false,
                     "className" : "text-center",
                    "visible" : $("#level").val()==2?false:true,
                },  
                {
                    "data": "action",
                    "orderable": false,
                    "className" : "text-center",
                    "visible" : $("#level").val()==2?false:true,
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