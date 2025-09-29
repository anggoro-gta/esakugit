<section class="content-header">
    <div class="row">
        <div class="col-md-12">
            <div class="judul">Laporan Per GU</div>
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
                        <label class="col-md-2 control-label">Nama GU</label>
                        <div class="col-md-5">
                            <select class="col-md-12 control-label chosen" id="id_gu">
                                <option value="">.: Pilih :.</option>
                                <?php foreach ($arrEntriGu as $val): ?>
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
    id_gu = $("#id_gu").val(); 

    if(id_gu==''){
        alert('Nama GU tidak boleh kosong.');
        return false;
    }
    
    $.ajax({
        type:'post',
        url: "<?php echo base_url()?>Laporan/get_perGu",
        data:{id_gu},
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