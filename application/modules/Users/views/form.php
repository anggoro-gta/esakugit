<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul"> User</div>
        </div>
    </div>
</section>
<section class="content_section">
    <div class="content_spacer">
        <div class="content">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well">
                        <h2><?=$this->help->labelnya()?></h2>
                    </div>
                    <div class="box-content">
                        <form action="<?=base_url()?>Users/save" method="post" class="form-horizontal">
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Username</label>
                                <div class="col-md-3">
                                     <input name="username" class="form-control" value="<?=$username?>" required></input>
                                </div>
                            </div>
                            <?php if(empty($id)):?>
                                <div class="form-group required">
                                    <label class="col-md-2 control-label">Password</label>
                                    <div class="col-md-3">
                                         <input name="password" class="form-control" required></input>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Nama Lengkap</label>
                                <div class="col-md-3">
                                     <input name="nama_lengkap" class="form-control upper" value="<?=$nama_lengkap?>" required></input>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Level</label>
                                <div class="col-md-3">
                                     <select name="level" class="form-control chosen" required>
                                         <option value="">.: Pilih :.</option>
                                         <?php foreach($arrMsLevel as $lvl): ?>
                                            <option <?= $level==$lvl['id']?'selected':'';?> value="<?=$lvl['id']?>"><?=$lvl['nama_level']?></option>
                                        <?php endforeach; ?>
                                     </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Bagian</label>
                                <div class="col-md-5">
                                    <select class="form-control chosen" name="fk_bagian_id" id="fk_bagian_id">
                                        <option value="">Pilih</option>
                                        <?php foreach($arrMsBagian as $val): ?>
                                            <option <?= $fk_bagian_id==$val['id']?'selected':'';?> value="<?=$val['id']?>"><?=$val['nama_bagian']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 control-label">Blokir</label>
                                <div class="col-md-3">
                                    <label class="radio-inline">
                                        <input id="inlineRadio1" name="blokir" value="Y" type="radio" <?php echo $blokir=='Y'?'checked':'';?> >
                                        Ya
                                    </label>
                                    <label class="radio-inline">
                                        <input id="inlineRadio2" name="blokir" value="N" type="radio" <?php echo $blokir!='Y'?'checked':'';?> >
                                        Tidak
                                    </label>
                                </div>
                            </div>
                            <?php if($id):?>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Reset Password</label>
                                    <div class="col-md-5">
                                        <div class="input-group">
                                            <div class="col-md-1">
                                                <input name="reset_password" id="reset_password" type="checkbox">
                                            </div>
                                            <div class="col-md-10 control-label">
                                                <span id="info_pswd" class="label-success label label-default">Password awal : 123456</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif;?>
                            <input type="hidden" name="id" value="<?=$id?>">

                            <div class="form-group">
                                <div class="col-md-12">&nbsp;</div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-2"></div>
                                <div class="col-md-3" align="center">
                                    <a href="<?=base_url()?>Users" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-chevron-left"></i> kembali</a>
                                    <button type="submit" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-hdd"></i> <?=$button;?></button>
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
$(document).ready(function(){
    $('#info_pswd').hide();
    $("#reset_password").click(function(){
        if ($('#reset_password').is(':checked')) {
            $('#info_pswd').show();
        }else{
            $('#info_pswd').hide();
        }
    });
});
</script>