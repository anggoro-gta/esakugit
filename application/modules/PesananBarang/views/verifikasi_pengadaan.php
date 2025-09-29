<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Verifikasi Pesanan Barang</div>
            <h1>
                <a onclick="window.history.back()" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-list-alt"></i> Tabel Data</a>
            </h1>
        </div>
    </div>
</section>
<section class="content_section">
    <div class="content_spacer">
        <div class="content">
            <div class="box col-md-12">
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Error!</strong> <?php echo $this->session->flashdata('error') ?>
                    </div>
                <?php endif; ?>
                <div class="panel panel-default">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <td style="text-align: right" class="col-md-2"><b>Tgl Pesanan</b></td>
                                <th>:</th>
                                <td class="col-md-4"><?=  $this->help->ReverseTgl($hsl['tgl_pesanan']); ?> </td>
                                <td style="text-align: right" class="col-md-2"><b>Bagian</b></td>
                                <th>:</th>
                                <td class="col-md-5"><?= $Bagian[0]['nama_bagian']; ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><b>Nomor</b></td>
                                <th>:</th>
                                <td><?= $hsl['nomor']; ?> </td>
                                <td style="text-align: right"><b>Program</b></td>
                                <th>:</th>
                                <td><?= $hsl['nama_program']; ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><b>Perihal Pengadaan</b></td>
                                <th>:</th>
                                <td><?= $hsl['perihal']; ?> </td>
                                <td style="text-align: right"><b>Kegiatan Bappeda</b></td>
                                <th>:</th>
                                <td><?= $hsl['kegiatan_bappeda']; ?></td>
                            </tr>                            
                            <tr>
                                <td style="text-align: right"><b>Nama Rekanan</b></td>
                                <th>:</th>
                                <td><?= $rekanan[0]['nama_rekanan']; ?></td>
                                <td style="text-align: right"><b>PPK</b></td>
                                <th>:</th>
                                <td><?= $hsl['nama_ppk']; ?> </td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><b>No Kontrak</b></td>
                                <th>:</th>
                                <td><?= $hsl['no_kontrak']; ?></td>
                                <td style="text-align: right"><b>Tgl Kontrak</b></td>
                                <th>:</th>
                                <td><?= $this->help->ReverseTgl($hsl['tgl_kontrak']); ?> </td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><b>Nilai Kontrak</b></td>
                                <th>:</th>
                                <td><?= empty($hsl['nilai_kontrak'])?'':number_format($hsl['nilai_kontrak']); ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="table-responsive">
                    <form class="form-horizontal" action="<?php echo base_url();?>PesananBarang/saveVerifikasi" method="post" enctype="multipart/form-data">                     
                        <table class="table table-bordered table-striped" id="example2">
                            <thead>
                                <tr>
                                    <th style="vertical-align: middle;" rowspan="2" class="text-center" width="3%">No</th>
                                    <th style="vertical-align: middle;" rowspan="2" class="text-center" width="30%">Nama</th>
                                    <th style="vertical-align: middle;" rowspan="2" class="text-center" width="5%">Qty Awal</th>
                                    <th style="vertical-align: middle;" rowspan="2" class="text-center" width="10%">Satuan</th>
                                    <th style="vertical-align: middle;" class="text-center" width="25%">Std Harga Satuan</th>
                                    <th style="vertical-align: middle;" colspan="3" class="text-center" width="25%">Verifikasi</th>
                                </tr>
                                <tr>
                                    <th class="text-center">Minimal</th>
                                    <th class="text-center" width="6%">Qty</th>
                                    <th class="text-center">Harga Satuan</th>
                                    <th class="text-center">Total</th>
                                    <!-- <th class="text-center">Aksi</th> -->
                                     <!-- <input type="checkbox" id="check_all"> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1;?>
                                <?php foreach((array)$detail as $val) :?>
                                    <tr>
                                        <td style="text-align: center" ><?php echo $no++;?></td>
                                        <td><?=$val['nm_brg_gabung']?></td>
                                        <td style="text-align: center"><?= $val['qty_awal']?></td>
                                        <td style="text-align: center"><?=$val['satuan']?></td>
                                        <td style="text-align: center">
                                            <?php $hrgMinimal = $cariData[$val['satuan']] ?>
                                            <?= isset($hrgMinimal)?number_format($hrgMinimal):''; ?>
                                            <input type="hidden" id="harga_minimal_<?=$val['id']?>" name="listHargaMin[<?=$val['id']?>]" value="<?=$hrgMinimal?>">
                                        </td>
                                        <td><input type="text" id="qtyAkhir_<?=$val['id']?>" name="listQtyAkhir[<?=$val['id']?>]" class="form-control angka text-center" value="<?=$val['qty_akhir']?>"></td>
                                        <td><input type="text" name="listHargaSatBeli[<?=$val['id']?>]" class="form-control nominal text-center" onchange="cekHarga(this.value,<?=$val['id']?>)" id="harga_input_<?=$val['id']?>" value="<?=$val['harga_satuan_beli']?>">
                                        </td>
                                        <?=$total=empty($val['qty_akhir'])?'':$val['qty_akhir']*$val['harga_satuan_beli']?>
                                        <td><input type="text" id="total_<?=$val['id']?>" name="listTotal" class="form-control nominal text-center" value="<?=$total?>" readonly>
                                        <!-- </td>
                                        <td> -->
                                            <?php //if($val['status_verifikasi']=='' || $val['status_verifikasi']=='0'){ ?>
                                                <!-- <a onclick="tombol_verifikasi(<?=$val['id']?>)" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-check" title="Simpan"></i> </a> -->
                                            <?php //} ?>
                                            <!-- <input type="checkbox" name="listStatusVer[<?=$val['id']?>]" class="form-control text-center status_ver" id="checkbox_verifikasi_<?=$val['id']?>"> -->
                                            <input type="hidden" name="listIdDetail[]" value="<?=$val['id']?>">
                                            <input type="hidden" name="listIdBrg[]" value="<?=$val['fk_barang_id']?>">
                                            <input type="hidden" name="idPesananBrg" value="<?=$val['fk_pesanan_barang_id']?>">
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                                <tr>
                                    <td colspan="5" style="text-align: right"><b>TOTAL</b></td>
                                    <td colspan="2"></td>
                                    <td><input type="text" id="totalAll" class="form-control nominal text-center" readonly></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <div class="col-md-5">
                                <div class="form-group required">
                                    <label class="col-md-7 control-label">Tgl BA</label>
                                    <div class="col-md-5">
                                        <input type="text" name="tgl_ver" class="form-control tanggal text-center" value="<?=$this->help->ReverseTgl($hsl['tgl_pesanan']);?>" style="background-color: yellow" required>
                                    </div>
                                </div>                                
                            </div>
                            <div class="col-md-6">
                            <button id="submit" type="submit" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-hdd"></i> Proses Verifikasi</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
$(document).ready(function() {
        
});

function cekHarga(val,id){
    repVal = val.replace(/\,/g, '');
    hrgMin = $("#harga_minimal_"+id).val();

    if(parseInt(repVal) < parseInt(hrgMin)){
        alert('Harga tidak boleh DIBAWAH Std Harga Minimal');
        // $("#checkbox_verifikasi_"+id).prop('checked',false);
        $("#harga_input_"+id).val('');
        return false;
    }

    qtyAkhr = $("#qtyAkhir_"+id).val();
    totId = convertToRupiah(qtyAkhr*repVal);
    $("#total_"+id).val(totId);
    jumlah_semua();
}

function jumlah_semua(){
    totAll=0;
    $("input[name='listTotal']").each(function() {
        value = $(this).val();
        repValue = value.replace(/\,/g, '');
        if(repValue!=''){
            totAll += Number(repValue);
        }
    });
    $("#totalAll").val(convertToRupiah(totAll));
}

function tombol_verifikasi(id){
    hrgMin = $("#harga_minimal_"+id).val();
    qtyAkhr = $("#qtyAkhir_"+id).val();
    hargaBeli = $("#harga_input_"+id).val();

    if(qtyAkhr==''){
        alert('QTY Tidak Boleh Kosong');
        
        return $("#qtyAkhir_"+id).focus();
    }
    if(hargaBeli==''){
        alert('Harga Satuan Tidak Boleh Kosong');
        
        return $("#harga_input_"+id).focus();
    }

    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'PesananBarang/verifikasiPerItem'?>",
        data: {id,hrgMin,qtyAkhr,hargaBeli},
        success: function(msg){
             alert(msg.notif);       
        }
    });      
}

$("#check_all").click(function(){
    if ($(this).is(':checked')) {
        $('.status_ver').prop('checked',true);
    }else{
        $('.status_ver').prop('checked',false);
    }    
});

</script>