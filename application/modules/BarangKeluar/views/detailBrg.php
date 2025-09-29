
<table class="table table-bordered table-striped" width="100%" id="example3">
	<tr>
		<th style="text-align: center" width="30px">No</th>
		<th style="text-align: center">Nama</th>
		<th style="text-align: center" width="150px">Pesanan dari Bagian</th>
		<th style="text-align: center" width="150px">Rekanan</th>
		<th style="text-align: center" width="150px">Tgl Verifikasi/masuk</th>
		<th style="text-align: center" width="150px">Satuan</th>
		<th style="text-align: center" width="100px">Qty Ver</th>
		<th style="text-align: center" width="200px">Harga Satuan</th>
		<th style="text-align: center" width="100px">Sisa Stok</th>
		<th style="text-align: center" width="50px">Aksi</th>
	</tr>
	<?php $no=1; foreach ($hasil as $val) { ?>
		<tr>
			<td style="text-align: center"><?=$no++?></td>
			<td><?=$val->nm_brg_gabung?></td>
			<td style="text-align: center"><?=$val->singkatan_bagian?></td>
			<td style="text-align: center"><?=$val->nama_rekanan?></td>
			<td style="text-align: center"><?=$val->tgl_datang?></td>
			<td style="text-align: center"><?=$val->satuan?></td>
			<td style="text-align: center"><?=$val->qty_akhir?></td>
			<td style="text-align: right"><?=number_format($val->harga_satuan_beli)?></td>
			<td style="text-align: center"><?=$val->sisa_stok_blm_diambil?></td>
			<td style="text-align: center">
				<a class="btn btn-xs btn-success" title="Ubah Detail" onclick="pilih_barang(<?=$val->id?>)"><i class="glyphicon glyphicon-ok icon-white"></i></a>
			</td>
		</tr>
	<?php } ?>
</table>
<script type="text/javascript">

function pilih_barang(id){
	$("#modal_brg").modal("hide");
	$.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'BarangKeluar/getCariBarang'?>",
        data: {id},
        success: function(msg){
            $('#id_barang').val(msg.id_barang);
            $('#nama_barang').val(msg.nama_barang);
            $('#satuan').val(msg.satuan);
            $('#qty_akhir').val(msg.qty_akhir);
            $('#qty_sisa').val(msg.qty_sisa);
            $('#bts_max_qty_sisa').val(msg.qty_sisa);
            $('#harga_satuan').val(msg.harga_satuan);
            $('#id_pesanan_barang_detail').val(id);     
        }
    });
}

</script>