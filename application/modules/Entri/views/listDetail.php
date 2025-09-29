
<section class="content_section">
    <div class="content_spacer">
        <div class="content">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well">
                        <div class="pull-left">
                            <a href="<?=base_url()?>EntriSpj" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-arrow-right"></i> Entri SPJ</a>
                        </div>
                        <div class="pull-right">
                            <a href="<?=base_url()?>Entri/create" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
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
                                        <th>Bagian</th>
                                        <th>Kegiatan</th>
                                        <th>Sub Kegiatan</th>
                                        <th>Nomor</th>
                                        <th>Tanggal</th>
                                        <th>Total</th>
                                        <th>Catatan</th>
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
        ajax: {"url": "<?= base_url()?>Entri/getDatatables", "type": "POST", "data": {
                "nomor": "<?=$nomor?>","bulan": "<?=$bulan?>","fk_bagian_id": "<?=$fk_bagian_id?>","fk_program_id": "<?=$fk_program_id?>","fk_kegiatan_id": "<?=$fk_kegiatan_id?>"}
        },
        columns: [
            {
                "data": "id",
                "orderable": false,
                "className" : "text-center"
            },
            {
                "data": "bulan",
                "orderable": false,
                render : function ( data, type, row ){ 
                    if(data=='01'){
                        bln = 'Januari';
                    }else if(data=='02'){
                        bln = 'Februari';
                    }else if(data=='03'){
                        bln = 'Maret';
                    }else if(data=='04'){
                        bln = 'April';
                    }else if(data=='05'){
                        bln = 'Mei';
                    }else if(data=='06'){
                        bln = 'Juni';
                    }else if(data=='07'){
                        bln = 'Juli';
                    }else if(data=='08'){
                        bln = 'Agustus';
                    }else if(data=='09'){
                        bln = 'September';
                    }else if(data=='10'){
                        bln = 'Oktober';
                    }else if(data=='11'){
                        bln = 'November';
                    }else{
                        bln = 'Desember';
                    }
                    return bln;
                },
                "searchable": false,
            },
            {
                "data": "nama_gu",
                "orderable": false,
            },
            {
                "data": "nama_bagian",
                "orderable": false,
            },
            {  "data": "nama_program",
               "orderable": false,
            },
            {  "data": "kegiatan",
               "orderable": false,
            },
            {  "data": "nomor",
               "orderable": false,
            },
            {  "data": "tglnya",
               "orderable": false,
               "className" : "text-center",
                "searchable": false,
                render : function (data, type, row){ 
                    if(row.fk_kegiatan_orang_id==3){
                        return data;
                    }
                    return '';
                }
            },            
            {  "data": "total_spj",
               "orderable": false,
               "className" : "text-center",
                "searchable": false,
            },
            {"data": "catatan",
                render : function (data, type, row){ 
                    if(data!='' && data!=null){
                        return '<i style="background-color:red; color:white">'+data+'</i>';
                    }
                    return '';
                }
            },
            {"data": "id",
                render : function ( data, type, row ){ 
                    aksi = '<div class="btn-group">';
                    // aksi += '<a class="btn btn-xs btn-success" href="<?=base_url()?>Pembelian/update/'+row.id+'"><i class="glyphicon glyphicon-edit icon-white" title="Edit"></i></a>';
                    aksi += '<a class="btn btn-xs btn-danger" href="<?=base_url()?>Entri/delete/'+data+'"><i class="glyphicon glyphicon-trash icon-white" title="Hapus" onclick="return confirmDelete()"></i></a>';
                    aksi += '<a class="btn btn-xs btn-success" href="<?=base_url()?>Entri/edit/'+data+'"><i class="glyphicon glyphicon-edit icon-white" title="Update"></i></a>';
                    aksi += '<a class="btn btn-xs btn-warning" href="<?=base_url()?>Entri/detail/'+data+'"><i class="glyphicon glyphicon-eye-open icon-white" title="Detail"></i></a>';
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

</script>