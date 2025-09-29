<section class="content_section">
    <div class="content_spacer">
        <div class="content">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well">
                        <div class="pull-right">
                            <a href="<?=base_url()?>MsSdm/create" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
                        </div>
                    </div>
                    <div class="box-content">  
                        <div class="table-responsive">                     
                            <table class="table table-bordered table-striped" id="example2" style="font-size: 9pt;" width="100%">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Nama</th>
                                        <th>NIP</th>
                                        <th>Golongan/Pangkat</th>                                        
                                        <th>Golongan/Pangkat Baru</th>
                                        <th>TMT Golongan/Pangkat Baru</th>
                                        <th>Bagian</th>
                                        <th>Jabatan</th>
                                        <th>Jabatan Tambahan</th>
                                        <th>Jabatan Baru</th>
                                        <!-- <th>Pejabat KPA</th>
                                        <th>Bendahara Pembantu</th> -->
                                        <th>Status Pegawai</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                        <th>Bank</th>
                                        <th>No Rekening</th>
                                        <th>Nama Rekening</th>
                                        <th>NPWP</th>
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
            ajax: {"url": "<?= base_url()?>MsSdm/getDatatables", "type": "POST", "data": {"fk_bagian_id": "<?=$fk_bagian_id?>"}
            },
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
                {
                    "data": "nip",
                    "orderable": false,
                    "className" : "text-center"
                },
                {
                    "data": "gol_pangkat",
                    "orderable": false,
                    "className" : "text-center"
                },
                {
                    "data": "gol_pangkat_baru",
                    "orderable": false,
                    "className" : "text-center"
                },
                {
                    "data": "tmt_gol_pangkat_baru",
                    "orderable": false,
                    "className" : "text-center"
                },
                {
                    "data": "nama_bagian",
                    "orderable": false,
                    "className" : "text-center"
                },
                // {
                //     "data": "jabatan",
                //     "orderable": false,
                //     "className" : "text-center"
                // },
                {
                    "data": "jabatan",
                    "orderable": false,
                    "className" : "text-center",
                    render : function (data, type, row) {
                        sttJab='';
                        if(row.status_jabatan !== null && row.status_jabatan !== ''){
                            sttJab=row.status_jabatan ;
                        }
                        jab=data;

                        return sttJab+' '+jab;
                   },
                   "searchable": false,
                },
                {
                    "data": "pejabat_kpa",
                    "orderable": false,
                    "className" : "text-center",
                    render : function (data, type, row) {
                        hsl='';
                        if(data==1){
                            hsl += 'Pejabat KPA, ';
                        }
                        if(row.pejabat_ppk==1){
                            hsl += 'PPK';
                        }
                        if(row.bendahara==1){
                            hsl += 'Bendahara';
                        }
                        if(row.bendahara_pembantu==1){
                            hsl += 'Bendahara Pembantu';
                        }
                        if(row.pphp==1){
                            hsl += 'PPHP';
                        }
                        return hsl;
                   },
                   "searchable": false,
                },
                {
                    "data": "jabatan_baru",
                    "orderable": false,
                    "className" : "text-center",
                    render : function (data, type, row) {
                        sttJab='';jab='';
                        if(data !== null && data !== ''){
                           jab=data;
                           if(row.status_jabatan_baru !== null || row.status_jabatan_baru !== ''){
                               sttJab=row.status_jabatan_baru;
                            }
                        }

                        return sttJab+' '+jab;
                   },
                   "searchable": false,
                },
                // {
                //     "data": "bendahara_pembantu",
                //     "orderable": false,
                //     "className" : "text-center",
                //     render : function (data, type, row) {
                //         if(data==1){
                //             return '&#8730;';
                //         }
                //         return '';
                //    },
                // },
                {
                    "data": "status_pegawai",
                    "orderable": false,
                    "searchable": false,
                    "className" : "text-center"
                },
                {
                    "data": "nama_status",
                    "orderable": false,
                    "searchable": false,
                    "className" : "text-center"
                },
                {
                    "data": "action",
                    "orderable": false,
                    "className" : "text-center"
                },
                {
                    "data": "nama_bank",
                    "orderable": false,
                    "className" : "text-center"
                },
                {
                    "data": "no_rekening",
                    "orderable": false,
                    "className" : "text-center"
                },
                {
                    "data": "nama_rekening",
                    "orderable": false,
                    "className" : "text-center"
                },
                {
                    "data": "npwp",
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