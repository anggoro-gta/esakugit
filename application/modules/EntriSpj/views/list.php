<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Entri SPJ</div>
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
                    </div>
                    <div class="box-content">  
                        <div class="table-responsive">                     
                            <table class="table table-bordered table-striped" id="example2">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Nama GU</th>
                                        <th>Jml Kegiatan</th>
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
    </div>
</section>

<script type="text/javascript">
$(document).ready(function() {
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
        ajax: {"url": "<?= base_url()?>EntriSpj/getDatatables", "type": "POST" },
        columns: [
            {
                "data": "id",
                "orderable": false,
                "className" : "text-center"
            },
            {
                "data": "nama",
                "orderable": false,
            },
            {  "data": "jml_kegiatan",
               "orderable": false,
               "className" : "text-center",
                "searchable" : false,
            },
            {"data": "",
                render : function ( data, type, row ){
                    stat = '<div>';
                    if(row.status_spj==1){
                        stat += '<span class="btn btn-xs btn-success"> Sudah SPJ</span> &nbsp; ';
                        stat += '<a class="btn btn-xs btn-warning" href="<?=base_url()?>EntriSpj/detail/'+row.id+'"><i class="glyphicon glyphicon-eye-open icon-white" title="Detail"></i></a>';
                    }else{
                        stat += '<span class="btn btn-xs btn-warning"> Belum SPJ</span>';
                    }
                    stat += '</div>';
                    return stat;
                },
                "orderable": false,
                "className" : "text-center",
                "searchable" : false,
            },
            {"data": "",
                render : function ( data, type, row ){ 
                    aksi = '<div class="btn-group">';
                    aksi += '<a class="btn btn-xs btn-primary" href="<?=base_url()?>EntriSpj/proses/'+row.id+'" title="Proses">Proses</i></a>';
                    aksi += '</div>';
                    return aksi ;
                },
                "orderable": false,
                "className" : "text-center",
                "searchable" : false,
            },
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
function confirmDelete() {
    return confirm('Apakah anda yakin?');
};

</script>