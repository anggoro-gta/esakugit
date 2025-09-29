<section class="content-header">
    <div class="row">
        <div class="col-md-12">
            <div class="judul">DAFTAR PERSEDIAAN S/D 31 DESEMBER  <?=$this->session->userdata("tahun")?></div>
        </div>
    </div>
</section>
<section class="content_section">
    <div class="content_spacer">
        <div class="content">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well">
                        <div class="pull-right">
                            <!-- <form action="<?=base_url()?>Laporan/pdfDaftarPersediaan" method="post" class="form-horizontal" target="_blank"> -->
                                <!-- <input type="hidden" name="fk_barang_id" id="fk_barang_id" value='<?=$fk_barang_id?>'>
                                <input type="hidden" name="kategori" id="kategori" value='<?=$kategori?>'> -->
                                <!-- <button title="Cetak PDF" class="btn btn-sm btn-warning" target="_blank"><i class="glyphicon glyphicon-print"></i> Pdf</button> -->
                                <div><a class="btn btn-sm btn-warning" onclick="cetak_pdf()"  title="Cetak PDF"><i class="glyphicon glyphicon-print"></i> Pdf</a>
                                    <a class="btn btn-sm btn-warning" onclick="cetak_pdf_persediaan()"  title="Cetak PDF"><i class="glyphicon glyphicon-print"></i> Pdf 2</a>
                                </div>
                            <!-- </form> -->
                        </div>
                    </div>
                    <div class="box-content">  
                        <div class="table-responsive">                     
                            <table class="table table-bordered table-striped" id="example2">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;vertical-align: middle;" width="20px">NO</th>
                                        <th style="text-align: center;vertical-align: middle;" colspan="2">NAMA BARANG</th>
                                        <th style="text-align: center;vertical-align: middle;" colspan="2">SALDO AWAL PER 1 JANUARI TAHUN <?=$tahun?> </th>
                                        <th style="text-align: center;vertical-align: middle;" colspan="2">PENGADAAN JANUARI S/D DESEMBER <?=$tahun?></th>
                                        <th style="text-align: center;vertical-align: middle;" colspan="2">JUMLAH</th>
                                        <th style="text-align: center;vertical-align: middle;" colspan="2">PENGELUARAN JANUARI S/D DESEMBER <?=$tahun?></th>
                                        <th style="text-align: center;vertical-align: middle;" colspan="2">SISA</th>
                                        <th style="text-align: center;vertical-align: middle;">HARGA SATUAN</th>
                                        <th style="text-align: center;vertical-align: middle;">JUMLAH</th>
                                        <th style="text-align: center;vertical-align: middle;">KETERANGAN</th>
                                    </tr>
                                    <tr>
                                        <th style="text-align: center;">1</th>
                                        <th style="text-align: center;" colspan="2">2</th>
                                        <th style="text-align: center;" colspan="2">3</th>
                                        <th style="text-align: center;" colspan="2">4</th>
                                        <th style="text-align: center;" colspan="2">5=3+4</th>
                                        <th style="text-align: center;" colspan="2">6</th>
                                        <th style="text-align: center;" colspan="2">7=5-6</th>
                                        <th style="text-align: center;">8</th>
                                        <th style="text-align: center;">9</th>
                                        <th style="text-align: center;">10</th>
                                    </tr>
                                </thead> 
                                <tbody>
                                    <?php $no=1; ?>
                                    <?php foreach ((array)$kategori as $val): ?>
                                        <tr>
                                            <td style="text-align: center"><b><?=$no++?></b></td>
                                            <td width="20px"></td>
                                            <td><b><?=strtoupper($val->perihal)?></b></td>
                                            <td colspan="13"></td>
                                        </tr>
                                        <?php $noBrg=1; foreach ((array)$hasil[$val->id_perihal] as $valBrg){ ?>
                                            <tr>
                                                <td></td>
                                                <td style="text-align: center"><?=$noBrg++?></td>
                                                <td><?=$valBrg->nm_brg_gabung?></td>
                                                <td style="text-align: center"><?=$saldoAwal[$valBrg->fk_barang_id]->tot_qty_sa?></td>
                                                <td style="text-align: center"><?=$saldoAwal[$valBrg->fk_barang_id]->satuan?></td>
                                                <td style="text-align: center"><?=$pengadaan1Thn[$valBrg->fk_barang_id]->tot_qty_sa?></td>
                                                <td style="text-align: center"><?=$pengadaan1Thn[$valBrg->fk_barang_id]->satuan?></td>
                                                <?php
                                                    $jml = $saldoAwal[$valBrg->fk_barang_id]->tot_qty_sa+$pengadaan1Thn[$valBrg->fk_barang_id]->tot_qty_sa;
                                                    $satuan = $saldoAwal[$valBrg->fk_barang_id]->satuan;
                                                    if($satuan){
                                                        $satuan = $satuan;
                                                    }else{
                                                        $satuan = $pengadaan1Thn[$valBrg->fk_barang_id]->satuan;
                                                    }
                                                ?>
                                                <td style="text-align: center"><?=$jml?></td>
                                                <td style="text-align: center"><?=$satuan?></td>
                                                <?php
                                                    $jmlBrgaKluar = $barangKeluar1Thn[$valBrg->fk_barang_id]->tot_qty;
                                                    $sisa = $jml-$jmlBrgaKluar;
                                                ?>
                                                <td style="text-align: center"><?=$jmlBrgaKluar?></td>
                                                <td style="text-align: center"><?=$barangKeluar1Thn[$valBrg->fk_barang_id]->satuan?></td>
                                                <td style="text-align: center"><?=$sisa?></td>
                                                <td style="text-align: center"><?=$satuan?></td>
                                                <td style="text-align: right;"><?=$sisa==0?'':number_format($hargaBarang[$valBrg->fk_barang_id]->harga_satuan_beli)?></td>
                                                <td style="text-align: right;"><?=$sisa==0?'':number_format($hargaBarang[$valBrg->fk_barang_id]->tot_harga_masuk-$barangKeluar1Thn[$valBrg->fk_barang_id]->tot_harga_keluar)?></td>
                                                <td style="text-align: center"></td>
                                            </tr>
                                        <?php } ?>
                                    <?php endforeach; ?>
                                </tbody>              
                            </table>                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- MODAL  -->
<div class="modal fade slide-up disable-scroll" id="modal_cetak" role="dialog" aria-hidden="false">  
    <div class="modal-dialog" style="width: 50%;padding: 0px">
        <div class="modal-content">
            <form method="post" action="<?=base_url("Laporan/pdfDaftarPersediaan")?>" target="_blank" enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                  <h5><b>CETAK PDF</b></h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group required">      
                            <label class="col-md-4 control-label">Kepala Bappeda</label>
                            <div class="col-md-7">
                                <select class="form-control" name="nama_kepala" id="nama_kepala" required>
                                    <option value="">Pilih</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group required">      
                            <label class="col-md-4 control-label">Pengurus Barang</label>
                            <div class="col-md-7">
                                <select class="form-control" name="nama_pjphp" id="nama_pjphp" required>
                                    <option value="">Pilih</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group required">      
                            <label class="col-md-4 control-label">Ksb. Umum dan Kepegawaian</label>
                            <div class="col-md-7">
                                <select class="form-control" name="nama_ksb_keu" id="nama_ksb_keu" required>
                                    <option value="">Pilih</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group required">      
                            <label class="col-md-4 control-label">Tanggal</label>
                            <div class="col-md-7">
                                <input class="form-control tanggal" name="tanggal" id="tanggal" required></input>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-md btn-primary pull-left inline" data-dismiss="modal">Batal</button>
                    <!-- <button type="submit" class="btn btn-md btn-success pull-left inline" >Cetak</button> -->
                    <a class="btn btn-md btn-warning pull-left inline" onclick="cetakBA()" >Cetak BA</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade slide-up disable-scroll" id="modal_cetak2" role="dialog" aria-hidden="false">  
    <div class="modal-dialog" style="width: 50%;padding: 0px">
        <div class="modal-content">
            <form method="post" action="<?=base_url("Laporan/pdfDaftarPersediaan2")?>" target="_blank" enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                  <h5><b>CETAK PDF</b></h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group required">      
                            <label class="col-md-4 control-label">Kepala Bappeda</label>
                            <div class="col-md-7">
                                <select class="form-control" name="nama_kepala2" id="nama_kepala2" required>
                                    <option value="">Pilih</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group required">      
                            <label class="col-md-4 control-label">Pengurus Barang</label>
                            <div class="col-md-7">
                                <select class="form-control" name="nama_pngrs_brg" id="nama_pngrs_brg" required>
                                    <option value="">Pilih</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group required">      
                            <label class="col-md-4 control-label">Bendahara Pengeluaran</label>
                            <div class="col-md-7">
                                <select class="form-control" name="nama_bndhr_pnglrn" id="nama_bndhr_pnglrn" required>
                                    <option value="">Pilih</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-md btn-primary pull-left inline" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-md btn-success pull-left inline" >Cetak</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
$('#example2').dataTable({
    "searching": true,
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

function cetak_pdf(){
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Laporan/getNamaKepala'?>",
        // data: {id},
        success: function(msg){
            $('#nama_kepala').html(msg.dataNama);
            $('#nama_pjphp').html(msg.dataPejabatPjphp);
            $('#nama_ksb_keu').html(msg.dataKsbKeu);
        }
    }); 
    $("#modal_cetak").modal("show"); 
}

function cetak_pdf_persediaan(){
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Laporan/getPejabatPersediaan'?>",
        // data: {id},
        success: function(msg){
            $('#nama_kepala2').html(msg.dataNama);
            $('#nama_pngrs_brg').html(msg.dataPejabatPengurusBrg);
            $('#nama_bndhr_pnglrn').html(msg.dataBndhrPengeluaran);
        }
    }); 
    $("#modal_cetak2").modal("show"); 
}

function cetakBA(){        
    nama_kepala = $("#nama_kepala").val();
    nama_pjphp = $("#nama_pjphp").val();
    nama_ksb_keu = $("#nama_ksb_keu").val();
    tanggal = $("#tanggal").val();
    window.open("<?= base_url()?>Laporan/pdfBeritaAcara?nama_kepala="+nama_kepala+"&nama_pjphp="+nama_pjphp+"&nama_ksb_keu="+nama_ksb_keu+"&tanggal="+tanggal, '_blank');
};

</script>