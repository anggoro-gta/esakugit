<section class="content-header">
    <div class="row">
        <div class="col-md-12">
            <div class="judul">Laporan Per Bulan DD dan DL </div>
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
                    <div class="form-group">
                        <div class="required"><label class="col-md-2 control-label">Bulan</label></div>
                        <div class="col-md-2">
                            <select class="form-control chosen" id="bulan" >
                                <option value="">Pilih</option>
                                <?php foreach($arrBulan as $key => $bl): ?>
                                    <option value="<?=$key?>"><?=$bl?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <?php if($this->session->userdata("level")==1){ ?>
                            <div class="form-group required">  
                                <label class="col-md-2 control-label">Bagian</label>
                                <div class="col-md-3">
                                    <select class="form-control chosen" id="fk_bagian_id">
                                        <option value="">.: Pilih :.</option>
                                        <?php foreach ($arrMsBagian as $bd): ?>
                                            <option value="<?=$bd['id']?>"> <?=$bd['nama_bagian']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        <?php }else{ ?>
                            <input type="hidden" id="fk_bagian_id" value="<?=$this->session->userdata("fk_bagian_id")?>">
                        <?php }?>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Nama Pegawai</label>
                        <div class="col-md-3">
                            <select class="form-control chosen" id="nama" multiple>
                                <option value="">.: Pilih :.</option>
                                <!-- <?php foreach ($arrMsSdm as $val): ?>
                                    <option value="<?=$val['id']?>"> <?=$val['nama']?></option>
                                <?php endforeach; ?> -->
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
$("#bulan").change(function(){
    cari_pegawai();
});
$("#tampil").click(function(){
    data();
});
function data(){   
    bulan = $("#bulan").val(); 
    nama = $("#nama").val(); 
    fk_bagian_id = $("#fk_bagian_id").val(); 

    if(bulan==''){
        alert('Bulan tidak boleh kosong.');
        return false;
    }

    $.ajax({
        type:'post',
        url: "<?php echo base_url()?>Laporan/get_DLPerBulan",
        data:{nama,bulan,fk_bagian_id},
        beforeSend  : function(){
            $("body").css("cursor", "progress");      
        },
        success: function(data){
            $("body").css("cursor", "default");
            $("#tampilData").html(data);
        }
    });
};

$("#fk_bagian_id").change(function(){
    cari_pegawai();
});

function cari_pegawai(){
    fk_bagian_id = $("#fk_bagian_id").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Pjd/getNamaPegawai'?>",
        data: {fk_bagian_id},
        success: function(msg){
            $('#nama').html(msg.arrPegawai);
            $('#nama').trigger("chosen:updated");
        }
    });     
}

</script>