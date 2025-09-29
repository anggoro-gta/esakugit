<section class="content-header">
    <div class="row">
        <div class="col-md-12">
            <div class="judul">Laporan Perjalanan Dinas Tahunan</div>
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
                <form class='form-horizontal' enctype="multipart/form-data" action="<?php echo base_url();?>Laporan/cetakRekapPjdTahunan" method="post" >    
                    <div class="form-group required">
                        <label class="col-md-2 control-label">Kategori</label>
                        <div class="col-md-2">
                            <select class="form-control" name="kategori" id="kategori" required>
                                <option value="">.: Pilih :.</option>
                                <option value="DD">DD</option>
                                <option value="DL">DL</option>
                            </select>
                        </div> 
                    </div> 
                    <div class="form-group">                        
                        <div class="col-md-2"></div>
                        <div class="col-md-2">
                            <button class="btn btn-md btn-warning" title="Download Excel"><i class="glyphicon glyphicon-download"></i> Excel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
</section>