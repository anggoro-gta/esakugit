<section class="content-header">
    <div class="row">
        <div class="col-md-12">
            <div class="judul">Laporan Per Bulan</div>
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
                        <label class="col-md-2 control-label">Bagian</label>
                        <div class="col-md-3">
                            <select class="form-control chosen" id="Bagian" multiple>
                                <option value="">.: Pilih :.</option>
                                <?php foreach ($arrMsBagian as $bd): ?>
                                    <option value="<?=$bd['id']?>"> <?=$bd['nama_bagian']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Nama SDM</label>
                        <div class="col-md-3">
                            <select class="form-control chosen" id="nama" multiple>
                                <option value="">.: Pilih :.</option>
                                <?php foreach ($arrMsSdm as $val): ?>
                                    <option value="<?=$val['id']?>"> <?=$val['nama']?></option>
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
    bulan = $("#bulan").val(); 
    nama = $("#nama").val(); 
    Bagian = $("#Bagian").val(); 

    if(bulan==''){
        alert('Bulan tidak boleh kosong.');
        return false;
    }

    $.ajax({
        type:'post',
        url: "<?php echo base_url()?>Laporan/get_perBulan",
        data:{nama,bulan,Bagian},
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