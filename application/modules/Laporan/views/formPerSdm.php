<section class="content-header">
    <div class="row">
        <div class="col-md-12">
            <div class="judul">Laporan Per SDM</div>
        </div>
    </div>
</section>

<section class="content_section">
    <div class="content_spacer">
    <div class="content">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2>Filter Data</h2>
            </div>
            <div class="box-content">  
                <form class='form-horizontal' enctype="multipart/form-data">  
                    <div class="form-group required">
                        <label class="col-md-2 control-label">Nama SDM</label>
                        <div class="col-md-5">
                            <select class="col-md-12 control-label chosen" id="nama">
                                <option value="">.: Pilih :.</option>
                                <?php foreach ($arrMsSdm as $val): ?>
                                    <option value="<?=$val['id']?>"> <?=$val['nama'].' ['.$val['jabatan'].']'?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>                        
                    </div>           
                    <div class="form-group">
                        <div class="required"><label class="col-md-2 control-label">Bulan</label></div>
                        <div class="col-md-2">
                            <select class="form-control chosen" id="bulan_awal" >
                                <option value="">Pilih</option>
                                <?php foreach($arrBulan as $key => $bl): ?>
                                    <option value="<?=$key?>"><?=$bl?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <label class="col-md-1 control-label" style="text-align: center">S/D</label>
                        <div class="col-md-2">
                            <select class="form-control chosen" id="bulan_akhir" >
                                <option value="">Pilih</option>
                                <?php foreach($arrBulan as $keyy => $bll): ?>
                                    <option value="<?=$keyy?>"><?=$bll?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">                        
                        <div class="col-md-2"></div>
                        <div class="col-md-2">
                            <a class="btn btn-success" id="tampil"><i class="glyphicon glyphicon-search"></i> Tampilkan</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    <div id="tampilData"></div>
</section>
<script type="text/javascript">
$("#tampil").click(function(){
    data();
});
function data(){   
    nama = $("#nama").val(); 
    bulan_awal = $("#bulan_awal").val(); 
    bulan_akhir = $("#bulan_akhir").val(); 

    if(nama==''){
        alert('Nama SDM tidak boleh kosong.');
        return false;
    }

    if(bulan_awal==''){
        alert('Bulan Awal tidak boleh kosong.');
        return false;
    }

    if(bulan_akhir==''){
        alert('Bulan Akhir tidak boleh kosong.');
        return false;
    }    

    
    $.ajax({
        type:'post',
        url: "<?php echo base_url()?>Laporan/get_perSdm",
        data:{nama,bulan_awal,bulan_akhir},
        beforeSend  : function(){
            $("body").css("cursor", "progress");      
        },
        success: function(data){
            $("body").css("cursor", "default");
            $("#tampilData").html(data);
        }
    });
};

</script>