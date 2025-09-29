<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Rekap (Edit Nama Narasumber / Moderator)</div>
            <h1>
                <a href="<?=base_url()?>Rekap" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-list-alt"></i> Tabel Data</a>
            </h1>
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
                <?php if ($this->session->flashdata('error2')): ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Error!</strong> <?php echo print_r($this->session->flashdata('error2')) ?>
                    </div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('warning')): ?>
                    <div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Error!</strong> <?php echo $this->session->flashdata('warning') ?>
                    </div>
                <?php endif; ?>
                <div class="box-inner">
                    <div class="box-content">    
                        <div class="table-responsive"> 
                            <table class="table table-bordered table-striped" id="example2">
                                <thead>
                                    <tr>
                                        <th style="text-align: center" width="5%">No</th>
                                        <th style="text-align: center">Tgl Kwitansi</th>
                                        <th style="text-align: center">Untuk Pembayaran</th>
                                        <th style="text-align: center">Sub Kegiatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead> 
                                <tbody>
                                    <?php $no=1; foreach ((array)$arrKwitansiHr as $val){ ?>
                                        <tr>
                                            <td style="text-align: center;"><?=$no++?></td>
                                            <td style="text-align: center;"><?=$this->help->ReverseTgl($val['tgl_kwitansi'])?></td>
                                            <td><?=$val['untuk_pembayaran']?></td>
                                            <td><?=$val['kegiatan_bappeda']?></td>
                                            <td><a class="btn btn-xs" style="background-color: orange; color:white" href="<?=base_url()?>Rekap/updateNarsumDtl/<?=$val['fk_rekap_dana_id']?>/<?=$val['id']?>"><i class="glyphicon glyphicon-pencil icon-white" title="Update Narsum"></i></a></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>                  
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
    $('#example2').dataTable({
        "searching": false,
        "bSort": false,
        'oLanguage': {
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
    });
});
</script>