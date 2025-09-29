
<section class="content_section">
    <div class="content_spacer">
        <div class="content">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well">
                        <div class="pull-right">
                            <a href="<?=base_url()?>BarangKeluar/create" class="btn btn-xs btn-success" title="Tambah Data"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
                        </div>
                    </div>
                    <div class="box-content">  
                        <div class="table-responsive">                     
                            <table class="table table-bordered table-striped" id="example2" style="font-size: 90%">
                                <thead>
                                    <tr>
                                        <th width="3%">No</th>
                                        <th>Tgl</th>
                                        <th>Nomor</th>
                                        <th>Jenis Barang</th>
                                        <th>Bagian</th>
                                        <th>Sub Kegiatan</th>
                                        <th>Jml Barang</th>
                                        <th>Cetak</th>
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
        ajax: {"url": "<?= base_url()?>BarangKeluar/getDatatables", "type": "POST", "data": {
                "nomor": "<?=$nomor?>","kategori": "<?=$kategori?>","fk_bagian_id": "<?=$fk_bagian_id?>"}
        },
        columns: [
            {
                "data": "id",
                "orderable": false,
                "className" : "text-center"
            }, 
            {
                "data": "tgl",
                "orderable": false,
                "className" : "text-center"
            },
            {  "data": "nomor",
               "orderable": false,
            },
            {  "data": "kategori",
               "orderable": false,
            },           
            {  "data": "singkatan_bagian",
               "orderable": false,
            },
            {  "data": "kegiatan_bappeda",
               "orderable": false,
            },
            {  "data": "total_barang",
               "orderable": false,
                "searchable": false,
                "className" : "text-center"
            },
            {
                "data": "id",
                "orderable": false,
                "searchable": false,
                "className" : "text-center",
                render : function (data, type, row) {
                    hsl='';
                    hsl += '<a href="<?=base_url()?>BarangKeluar/sbbk/'+data+'" target="_blank"  title="Surat Bukti Barang Keluar">SBBK</a>';
                                        
                    return hsl;
               },
            },
            {"data": "id",
                render : function ( data, type, row ){ 
                    aksi = '<div class="btn-group">';
                    
                    aksi += '<a class="btn btn-xs btn-danger" href="<?=base_url()?>BarangKeluar/delete/'+data+'"><i class="glyphicon glyphicon-trash icon-white" title="Hapus" onclick="return confirmDelete()"></i></a>';
                    aksi += '<a class="btn btn-xs btn-success" href="<?=base_url()?>BarangKeluar/update/'+data+'"><i class="glyphicon glyphicon-edit icon-white" title="Update"></i></a>'; 
                    // aksi += '<a class="btn btn-xs btn-warning" href="<?=base_url()?>BarangKeluar/detail/'+data+'"><i class="glyphicon glyphicon-eye-open icon-white" title="Detail"></i></a>';
                     
                    aksi += '</div>';
                    return aksi ;
                },
                "orderable": false,
                "searchable": false,
                "className" : "text-center col-md-1"
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