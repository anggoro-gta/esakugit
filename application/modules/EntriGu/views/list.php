<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Entri GU</div>
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
                            <a href="<?=base_url()?>EntriGu/create" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
                        </div>
                    </div>
                    <div class="box-content">  
                        <div class="table-responsive">                     
                            <table class="table table-bordered table-striped" id="example2">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Bulan</th>
                                        <th>Nama GU</th>
                                        <th>Jml Sub Kegiatan</th>
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
<div  id="modal-updateGu" class="modal disable-scroll"  role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content-wrapper">
            <div class="modal-content">
                <div class="modal-header">
                    <b><h5></h5></b>
                </div>
                <form class="form-horizontal" action="<?=base_url('EntriGu/updateNama')?>" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group required">
                            <label class="col-md-3 control-label">Nama GU</label>
                            <div class="col-md-8">
                                <input type="txt" class="form-control" name="nama_gu" id="nama_gu" required></input>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-success">Update</button>
                        <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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
        ajax: {"url": "<?= base_url()?>EntriGu/getDatatables", "type": "POST" },
        columns: [
            {
                "data": "id",
                "orderable": false,
                "className" : "text-center"
            },
            {
                "data": "nama_bulan",
                "orderable": false,
            },
            {
                "data": "nama",
                "orderable": false,
            },
            {  "data": "jml_kegiatan",
               "orderable": false,
               "className" : "text-center"
            },
            {"data": "",
                render : function ( data, type, row ){ 
                    aksi = '<div class="btn-group">';
                    // if(row.status_spj!=1){
                        aksi += '<a class="btn btn-xs btn-danger" href="<?=base_url()?>EntriGu/delete/'+row.id+'"><i class="glyphicon glyphicon-trash icon-white" title="Hapus" onclick="return confirmDelete()"></i></a>';
                        aksi += '<a class="btn btn-xs btn-success" href="<?=base_url()?>EntriGu/edit/'+row.id+'"><i class="glyphicon glyphicon-edit icon-white" title="Update"></i></a>';
                        aksi += '<a class="btn btn-xs btn-warning" href="<?=base_url()?>EntriGu/detail/'+row.id+'"><i class="glyphicon glyphicon-eye-open icon-white" title="Detail"></i></a>';
                    // }else{
                    //     aksi += '<input type="hidden" id="nama_'+row.id+'" value="'+row.nama+'">';
                    //     aksi += '<a class="btn btn-xs btn-info" href="#"><i class="glyphicon glyphicon-edit icon-white" title="Update Nama GU" onclick="updateGu('+row.id+')"></i></a>';
                    //     aksi += '<span class="btn btn-xs btn-success" >Sudah SPJ</a>';
                    // }
                    aksi += '</div>';
                    return aksi ;
                },
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
        },
        
    });
});
function confirmDelete() {
    return confirm('Apakah anda yakin?');
};

function updateGu(id){
    $("#id").val(id);
    $("#nama_gu").val($("#nama_"+id).val());

    $("#modal-updateGu").modal("show");
};

</script>