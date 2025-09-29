<?php if($cbx_uang_harian!='0' || $cbx_transport!='0' || $cbx_penginapan!='0'){?>
<table border="1">
    <tr>
        <th style="text-align: center">Nama</th>
        <?php if($cbx_uang_harian=='1'){?>
            <th style="text-align: center" width="10%">Tarif</th>
            <th style="text-align: center" width="6%">%</th>
            <th style="text-align: center" width="10%">Representasi</th>
            <th style="text-align: center" width="6%">Hari</th>
            <th style="text-align: center" width="10%">Total</th>
        <?php } ?>
        <?php if($cbx_transport=='1'){?>
            <th style="text-align: center" width="10%">Transport</th>
        <?php } ?>
        <?php if($cbx_penginapan=='1'){?>
            <th style="text-align: center" width="10%">Penginapan</th>
        <?php } ?>
        <th style="text-align: center" width="10%">Total Akhir</th>
        <!-- <th style="text-align: center" width="10%">Kontribusi</th> -->
    </tr>
    <tr>
        <td>
            <select class="form-control chosen kosong" id="id_sdm" >
                <option value="">Pilih</option>
                <?php foreach($arrMsSdm as $sd): ?>
                    <?php
                        $jbtn = empty($sd['jabatan_baru'])?$sd['jabatan']:$sd['jabatan_baru'];
                    ?>
                    <option value="<?=$sd['id']?>"><?=$sd['nama'].' ['.$jbtn.']'?></option>
                <?php endforeach; ?>
            </select>
        </td>
        <?php if($cbx_uang_harian=='1'){?>
            <td>
                <input type="text" class="form-control kosong nominal" id="tarif">
            </td>
            <td>
                <input type="text" class="form-control kosong angka text-center" id="persen">
            </td>
            <td>
                <input type="text" class="form-control kosong nominal" id="representasi">
            </td>
            <td>
                <input type="text" class="form-control kosong angka text-center" id="hari">
            </td>
            <td>
                <input type="text" class="form-control kosong text-right" id="total" readonly>
            </td>
        <?php }else{ ?>
            <input type="hidden" id="tarif" value="">
            <input type="hidden" id="persen" value="">
            <input type="hidden" id="representasi" value="">
            <input type="hidden" id="hari" value="">
            <input type="hidden" id="total" value="">
        <?php } ?>
        <?php if($cbx_transport=='1'){?>
            <td>
                <input type="text" class="form-control kosong nominal" id="transport">
            </td>
        <?php }else{ ?>
            <input type="hidden" id="transport" value="">
        <?php } ?>
        <?php if($cbx_penginapan=='1'){?>
            <td>
                <input type="text" class="form-control kosong nominal" id="penginapan">
            </td>
        <?php }else{ ?>
            <input type="hidden" id="penginapan" value="">
        <?php } ?>
        <td>
            <input type="text" class="form-control kosong nominal" id="total_akhir" readonly>
        </td>
       <!--  <td>
            <input type="text" class="form-control kosong nominal" id="kontribusi">
        </td> -->
    </tr>
</table>
 <input type="hidden" class="form-control " id="cek_uang_harian" value="<?=$cbx_uang_harian?>">
 <input type="hidden" class="form-control " id="cek_transport" value="<?=$cbx_transport?>">
 <input type="hidden" class="form-control " id="cek_penginapan" value="<?=$cbx_penginapan?>">
<?php } ?>
<div class="form-group">
    <div class="col-md-2"></div>
    <div class="col-md-6" align="center">
        <a id="reset" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-remove"></i> Reset (esc)</a>
        <a id="tambah" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-plus"></i> Tambahkan Ke List (F2)</a>
        <i id='loading'></i>
    </div>
</div>
<div class="form-group">
    <div class="col-md-12">
        <div class="panel panel-default">
        <table class="table table-bordered table-striped" >
            <tr style="background-color: #d5d2d1">
                <th style="vertical-align: middle;" rowspan="2" class="text-center">Nama</th>
                <?php if($cbx_uang_harian=='1'){?>
                    <th style="vertical-align: middle;" colspan="5" class="text-center" width="40%">Uang Harian</th>
                <?php } ?>
                <?php if($cbx_transport=='1'){?>
                    <th style="vertical-align: middle;" rowspan="2" class="text-center" width="10%">Transport</th>
                <?php } ?>
                <?php if($cbx_penginapan=='1'){?>
                    <th style="vertical-align: middle;" rowspan="2" class="text-center" width="10%">Penginapan</th>
                <?php } ?>
                <th style="vertical-align: middle;" rowspan="2" class="text-center" width="10%">Total Akhir</th>
                <!-- <th style="vertical-align: middle;" rowspan="2" class="text-center" width="10%">Kontribusi</th> -->
                <th style="vertical-align: middle;" rowspan="2" class="text-center" width="4%">Aksi</th>
            </tr>
            <tr>
                <?php if($cbx_uang_harian=='1'){?>
                    <th class="text-center">Tarif</th>
                    <th class="text-center">%</th>
                    <th class="text-center" width="10%">Representasi</th>
                    <th class="text-center">Hari</th>
                    <th class="text-center">Total</th>
                <?php } ?>
            </tr>
            <tbody id="tampilDetail"></tbody>
        </table>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('.chosen').chosen({ allow_single_deselect: true });
    $(".nominal").autoNumeric("init", {vMax: 9999999999999, vMin: -9999999999999});$(".dec").autoNumeric("init", {vMax: 9999999999999, vMin: -9999999999999, mDec: 2});$(".user_input").keyup(function(){$(this).val($(this).val().toUpperCase());});$.currToDouble = function(curr) {if (!curr) return 0; return Number(curr.replace(/[^0-9\.]+/g,""));}
      $.doubleToCurr = function(input, sign) { 
                      if (sign == undefined) sign  = "bracket";
          var number = input;
          if (input.toString().substring(0,1) == "-") {
              number = parseFloat(input.toString().substring(1)*1);
                  if (sign == "bracket") {
                      return "("+(number.toFixed(2).replace(/./g, function(c, i, a){return i && c !== "." && !((a.length - i) % 3) ? "," + c : c; }))+")";
                  } else if (sign == "minus") {
                      return "-"+(number.toFixed(2).replace(/./g, function(c, i, a){return i && c !== "." && !((a.length - i) % 3) ? "," + c : c; }));
                  }
          }
          return (number.toFixed(2).replace(/./g, function(c, i, a){return i && c !== "." && !((a.length - i) % 3) ? "," + c : c; }));
      }

    $(".angka").keypress(function(data){
        if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) 
        {
            return false;
        }
    });
});


$("#reset").click(function(){
    kosong();
});
function kosong(){
    $(".kosong").val('');
    $('#id_sdm').trigger("chosen:updated");
}

$("#tambah").click(function(){
    tambahList();
});

$("#id_sdm").change(function(){
    id=$(this).val();
    kategori = $('#kategori').val();
    fk_sub_kategori_id = $('#fk_sub_kategori_id').val();
    jenis_pjd = $('#jenis_pjd').val();

    if(kategori==''){
        alert('Kategori tidak boleh kosong..');
        return false;
    }

    if(jenis_pjd==''){
        alert('Jenis PJD tidak boleh kosong..');
        return false;
    }

    if(fk_sub_kategori_id==''){
        alert('Provinsi tidak boleh kosong..');
        return false;
    }

    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Pjd/getTarifPjdBaru'?>",
        data: {id,kategori,jenis_pjd,fk_sub_kategori_id},
        success: function(msg){
            trf = '';
            if($('#cek_uang_harian').val()==1){
                trf = msg.trfnya;
            }
           $('#tarif').val(trf);
           $('#representasi').val(msg.rpresntsi);
        }
    }); 
});

function tambahList(){
    kategori = $('#kategori').val();
    tgl_surat_tugas = $('#tgl_surat_tugas').val();
    tgl_berangkat = $('#tgl_berangkat').val();
    tgl_tiba = $('#tgl_tiba').val();
    fk_bagian_id = $('#fk_bagian_id').val();
    fk_kegiatan_id = $('#fk_kegiatan_id').val();
    nama_pejabat_pa = $('#nama_pejabat_pa').val();
    nama_pejabat_kpa = $('#nama_pejabat_kpa').val();

    if(kategori==''){
        alert('Kategori tidak boleh kosong..');
        return false;
    }
    if(tgl_berangkat==''){
        alert('Tgl Berangkat tidak boleh kosong..');
        return false;
    }
    if(tgl_tiba==''){
        alert('Tgl Tiba tidak boleh kosong..');
        return false;
    }
    if(nama_pejabat_pa==''){
        alert('Kolom PA tidak boleh kosong..');
        return false;
    }
    if(fk_kegiatan_id==''){
        alert('Sub Kegiatan Bappeda tidak boleh kosong..');
        return false;
    }

    id_sdm = $('#id_sdm').val();
    tarif = $('#tarif').val();
    hari = $('#hari').val();
    persen = $('#persen').val();
    total = $('#total').val();
    representasi = $('#representasi').val();
    transport = $('#transport').val();
    penginapan = $('#penginapan').val();
    total_akhir = $('#total_akhir').val();
    kontribusi = $('#kontribusi').val();

    cek = cekHariLibur();
    if(cek!=''){
        if(!confirm(cek)){
            return false;
        }
    }

    if(id_sdm==''){
        alert('Nama tidak boleh kosong..');
        return false;
    }
    $("#loading").html('<div class="loader"></div>');

    cekDataSdhAda='kosong';
    $.ajax({
        async: false,
        type: "POST",
        url: "<?php echo base_url().'Pjd/cariNama'?>",
        data: {kategori,tgl_surat_tugas,tgl_berangkat,tgl_tiba,fk_kegiatan_id,id_sdm,fk_bagian_id,nama_pejabat_pa,nama_pejabat_kpa},
        dataType: 'json',
        success: function(msg){ 
            if(msg.hslCek!=''){
                alert(msg.hslCek);       
                cekDataSdhAda='ada';
            }
                
            namaSdm = msg.nama;
            nip = msg.nip;
            gol_pangkat = msg.gol_pangkat;
            jabatan = msg.jabatan;
            eselon = msg.eselon;
            nama_rincian = msg.nama_rincian;
            nip_rincian = msg.nip_rincian;
            pangkat_rincian = msg.pangkat_rincian;
            jabatan_rincian = msg.jabatan_rincian;
            urut_ttd_rincian = msg.urut_ttd_rincian;
        }
    });  

    cbx_uang_harian = '0';
    if ($('#cbx_uang_harian').is(':checked')) {
        cbx_uang_harian = '1';
    }

    cbx_transport = '0';
    if ($('#cbx_transport').is(':checked')) {
        cbx_transport = '1';
    }

    cbx_penginapan = '0';
    if ($('#cbx_penginapan').is(':checked')) {
        cbx_penginapan = '1';
    }

    if(cbx_uang_harian==1){
        uangHarian = '<td class="text-right">'+tarif+'</td>'+
        '<td class="text-center">'+persen+'</td>'+
        '<td class="text-right">'+representasi+'</td>'+
        '<td class="text-center">'+hari+'</td>'+
        '<td class="text-right">'+total+'</td>';
    }
    if(cekDataSdhAda=='kosong'){
        $("#tampilDetail").append(
            '<tr>'+
                '<td>'+namaSdm+'</td>'+
                uangHarian+
                '<td class="text-right">'+tarif+'</td>'+
                '<td class="text-center">'+persen+'</td>'+
                '<td class="text-right">'+representasi+'</td>'+
                '<td class="text-center">'+hari+'</td>'+
                '<td class="text-right">'+total+'</td>'+
                
                '<td class="text-right">'+transport+'</td>'+
                '<td class="text-right">'+penginapan+'</td>'+
                '<td class="text-right">'+total_akhir+'</td>'+
                // '<td class="text-right">'+kontribusi+'</td>'+
                '<td class="text-center"><a style="cursor: pointer;" title="hapus" class="remove btn btn-xs btn-danger" ><i class="glyphicon glyphicon-trash"></i></a>'+
                    '<input type="hidden" name="listSdmId[]" value="'+id_sdm+'">'+
                    '<input type="hidden" name="listNamaSdm[]" value="'+namaSdm+'">'+
                    '<input type="hidden" name="listNip[]" value="'+nip+'">'+
                    '<input type="hidden" name="listGolPangkat[]" value="'+gol_pangkat+'">'+
                    '<input type="hidden" name="listJabatan[]" value="'+jabatan+'">'+
                    '<input type="hidden" name="listEselon[]" value="'+eselon+'">'+
                    '<input type="hidden" name="listTarif[]" value="'+tarif+'">'+
                    '<input type="hidden" name="listPersen[]" value="'+persen+'">'+
                    '<input type="hidden" name="listRepresentasi[]" value="'+representasi+'">'+
                    '<input type="hidden" name="listHari[]" value="'+hari+'">'+
                    '<input type="hidden" name="listTotal[]" value="'+total+'">'+
                    '<input type="hidden" name="listTransport[]" value="'+transport+'">'+
                    '<input type="hidden" name="listPenginapan[]" value="'+penginapan+'">'+
                    '<input type="hidden" name="listTotalAkhir[]" value="'+total_akhir+'">'+
                    '<input type="hidden" name="listKontribusi[]" value="'+kontribusi+'">'+
                    '<input type="hidden" name="listNamaRincian[]" value="'+nama_rincian+'">'+
                    '<input type="hidden" name="listNipRincian[]" value="'+nip_rincian+'">'+
                    '<input type="hidden" name="listPangkatRincian[]" value="'+pangkat_rincian+'">'+
                    '<input type="hidden" name="listJabatanRincian[]" value="'+jabatan_rincian+'">'+
                    '<input type="hidden" name="listUrutTtdRincian[]" value="'+urut_ttd_rincian+'">'+
                '</td>'+
            '</tr>'
        );
    }

    $('#id_sdm').val('');
    $('#id_sdm').trigger("chosen:updated");
    kosong();
    $("#loading").html('');
}
               
function cekHariLibur(){
    var retval='';
    tgl_berangkat = $("#tgl_berangkat").val();
    tgl_tiba = $("#tgl_tiba").val();
    $.ajax({
        async: false,
        type: "POST",
        url: "<?php echo base_url().'Pjd/cekTglLibur'?>",
        data: {tgl_berangkat,tgl_tiba},
        dataType: 'json',
        success: function(msg){
            if(msg.hasil!='sukses'){
                retval = msg.hasil;
            }
        }
    });  
    
    return retval;
};

$("#tampilDetail").on('click','.remove',function(){
    if(confirm('Apakah anda yakin?')){
        $(this).parent().parent().remove();
    }
});

$("#tarif").keyup(function(){
    cariTotal();
});
$("#hari").keyup(function(){
    cariTotal();
});
$("#persen").keyup(function(){
    cariTotal();
});
$("#representasi").keyup(function(){
    cariTotal();
});

function cariTotal(){
    tarif = $("#tarif").val();
    rep_tarif = tarif.replace(/,/g,"");
    hari = $("#hari").val();
    persen = $("#persen").val();

    representasi = $("#representasi").val();
    if(representasi==''){
        representasi='0';
    }
    rep_representasi = representasi.replace(/,/g,"");

    jml='';
    if(rep_tarif!='' && hari!='' && persen!=''){
        jml = convertToRupiah((((rep_tarif*persen)/100)+parseFloat(rep_representasi))*hari);
    }
    $("#total").val(jml);
    cariTotalAkhir();
}

$("#transport").keyup(function(){
    cariTotalAkhir();
});
$("#penginapan").keyup(function(){
    cariTotalAkhir();
});

function cariTotalAkhir(){
    total = $("#total").val();
    if(total==''){
        total='0';
    }
    rep_total = total.replace(/,/g,"");
    transport = $("#transport").val();
    if(transport==''){
        transport='0';
    }
    rep_transport = transport.replace(/,/g,"");
    penginapan = $("#penginapan").val();
    if(penginapan==''){
        penginapan='0';
    }
    rep_penginapan = penginapan.replace(/,/g,"");

    jmlAkhir='';
    if(rep_total!=''){
        totAkhr = parseFloat(rep_total)+parseFloat(rep_transport)+parseFloat(rep_penginapan);
        jmlAkhir = convertToRupiah(totAkhr);
    }
    
    $("#total_akhir").val(jmlAkhir);
}

//detail
$("#detail_tarif").keyup(function(){
    cariTotalDetail();
});
$("#detail_hari").keyup(function(){
    cariTotalDetail();
});
$("#detail_persen").keyup(function(){
    cariTotalDetail();
});

function cariTotalDetail(){
    tarif = $("#detail_tarif").val();
    rep_tarif = tarif.replace(/,/g,"");
    hari = $("#detail_hari").val();
    persen = $("#detail_persen").val();
    
    representasi = $("#detail_representasi").val();
    if(representasi==''){
        representasi='0';
    }
    rep_representasi = representasi.replace(/,/g,"");

    jml='';
    if(rep_tarif!='' && hari!='' && persen!=''){
        jml = convertToRupiah((((rep_tarif*persen)/100)+parseFloat(rep_representasi))*hari);
    }
    $("#detail_total").val(jml);
    cariTotalAkhirDetail();
}

$("#detail_transport").keyup(function(){
    cariTotalAkhirDetail();
});
$("#detail_penginapan").keyup(function(){
    cariTotalAkhirDetail();
});

function cariTotalAkhirDetail(){
    total = $("#detail_total").val();
    rep_total = total.replace(/,/g,"");
    
    transport = $("#detail_transport").val();
    if(transport==''){
        transport='0';
    }
    rep_transport = transport.replace(/,/g,"");
    penginapan = $("#detail_penginapan").val();
    if(penginapan==''){
        penginapan='0';
    }
    rep_penginapan = penginapan.replace(/,/g,"");

    jmlAkhir='';
    if(rep_total!=''){
        totAkhr = parseFloat(rep_total)+parseFloat(rep_transport)+parseFloat(rep_penginapan);
        jmlAkhir = convertToRupiah(totAkhr);
    }
    $("#detail_total_akhir").val(jmlAkhir);
}
// end detail
</script>