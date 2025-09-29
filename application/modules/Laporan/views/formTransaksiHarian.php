<section class="content-header">
    <div class="row">
        <div class="col-md-12">
            <div class="judul">Daftar Transaksi Harian</div>
        </div>
    </div>
</section>

<section class="content_section">
    <div class="content_spacer">
    <div class="content">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2></h2>
            </div>
            <div class="box-content">  
                <form class='form-horizontal' action="<?php echo base_url();?>Laporan/cetakTransaksiHarian" method="post" enctype="multipart/form-data" target="_blank">          
                    <div class="form-group">
                        <div class="required"><label class="col-md-2 control-label">Bulan</label></div>
                        <div class="col-md-2">
                            <select class="form-control chosen" name="bulan" required>
                                <option value="">Pilih</option>
                                <?php foreach($arrBulan as $key => $bl): ?>
                                    <option value="<?=$key?>"><?=$bl?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">                        
                        <div class="col-md-2"></div>
                        <div class="col-md-2">
                            <button id="submit" type="submit" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-file"></i> Download</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</section>