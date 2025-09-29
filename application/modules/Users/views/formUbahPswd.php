<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul"> Ubah Password</div>
        </div>
    </div>
</section>
<section class="content_section">
    <div class="content_spacer">
        <div class="content">
            <div class="box col-md-12">
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Sukses!</strong> <?php echo $this->session->flashdata('success') ?>
                    </div>
                <?php elseif($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Error!</strong> <?php echo $this->session->flashdata('error') ?>
                    </div>
                <?php endif; ?>
                <div class="box-inner">
                    <div class="box-header well">
                        <h2><?=$this->help->labelnya()?></h2>
                    </div>
                    <div class="box-content">
                        <form action="<?=base_url()?>Users/ubahPswd" method="post" class="form-horizontal" onsubmit="return validateForm();" id="assignmentForm">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Username</label>
                                <div class="col-md-3">
                                     <input class="form-control" value="<?=$this->session->username?>" readonly></input>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Password Lama</label>
                                <div class="col-md-3">
                                     <input type="text" id="pswdLama" name="pswdLama" class="form-control" value="<?=$pswdLama?>" required></input>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Password Baru</label>
                                <div class="col-md-3">
                                     <input type="text" id="pswdBaru" name="pswdBaru" class="form-control" value="<?=$pswdBaru?>" required></input>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Ulangi Password Baru</label>
                                <div class="col-md-3">
                                     <input type="text" id="pswdLama" name="ulangiPswdBaru" class="form-control" value="<?=$ulangiPswdBaru?>" required></input>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">&nbsp;</div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-2"></div>
                                <div class="col-md-3" align="center">
                                    <button type="submit" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-hdd"></i> Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>