<!DOCTYPE html>
<html lang="en">
<head>
    <!--
        ===
        This comment should NOT be removed.

        Charisma v2.0.0

        Copyright 2012-2014 Muhammad Usman
        Licensed under the Apache License v2.0
        http://www.apache.org/licenses/LICENSE-2.0

        http://usman.it
        http://twitter.com/halalit_usman
        ===
    -->
    <meta charset="utf-8">
    <title>E-SPJ</title>
    <link rel="shortcut icon" href="<?php echo base_url()?>image/icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">    

    <!-- The styles -->
    <link href="<?php echo base_url().'charisma/'?>css/bootstrap-cerulean.min.css" rel="stylesheet">

    <link href="<?php echo base_url().'charisma/'?>css/charisma-app.css" rel="stylesheet">
    <link href='<?php echo base_url().'charisma/'?>bower_components/fullcalendar/dist/fullcalendar.css' rel='stylesheet'>
    <link href='<?php echo base_url().'charisma/'?>bower_components/fullcalendar/dist/fullcalendar.print.css' rel='stylesheet' media='print'>
    <link href='<?php echo base_url().'charisma/'?>bower_components/chosen/chosen.min.css' rel='stylesheet'>
    <link href='<?php echo base_url().'charisma/'?>bower_components/colorbox/example3/colorbox.css' rel='stylesheet'>
    <link href='<?php echo base_url().'charisma/'?>bower_components/responsive-tables/responsive-tables.css' rel='stylesheet'>
    <link href='<?php echo base_url().'charisma/'?>bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css' rel='stylesheet'>
    <link href='<?php echo base_url().'charisma/'?>css/jquery.noty.css' rel='stylesheet'>
    <link href='<?php echo base_url().'charisma/'?>css/noty_theme_default.css' rel='stylesheet'>
    <link href='<?php echo base_url().'charisma/'?>css/elfinder.min.css' rel='stylesheet'>
    <link href='<?php echo base_url().'charisma/'?>css/elfinder.theme.css' rel='stylesheet'>
    <link href='<?php echo base_url().'charisma/'?>css/jquery.iphone.toggle.css' rel='stylesheet'>
    <link href='<?php echo base_url().'charisma/'?>css/uploadify.css' rel='stylesheet'>
    <link href='<?php echo base_url().'charisma/'?>css/animate.min.css' rel='stylesheet'>
    <link href="<?php echo base_url().'charisma/'?>plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />

    <!-- jQuery -->
    <script src="<?php echo base_url().'charisma/'?>bower_components/jquery/jquery.min.js"></script>

    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->


</head>

<body class="background">
<div class="ch-container">
    <div class="row">
        
    <div class="row">
        <div class="col-md-12 center login-header header">
            <h2><b>LOGIN<br>Aplikasi Keuangan Bappeda</b></h2>
        </div>
        <!--/span-->
    </div><!--/row-->
    <br>
    <div class="row">
        <div class="well col-md-3 center login-box">
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-warning">
                    <strong>Error!</strong> <?php echo $this->session->flashdata('error') ?>
                </div>
            <?php else: ?>
            <div class="alert alert-info">
                Masukkan Username dan Password.
            </div>
            <?php endif; ?>
            <form class="form-horizontal" action="Auth/prosesLogin" method="post">
                <fieldset>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                        <input name="username" type="text" class="form-control" placeholder="Username" required>
                    </div>
                    <div class="clearfix"></div><br>

                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <input name="password" id="password" type="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="input-group input-group-lg">
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <input type="checkbox" id="checkbox"> &nbsp; <span class="label-success label label-default"> Show password</span>
                    </div>
                    <div class="clearfix"></div><br>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar red"></i></span>
                        <input name="tahun" id="tahun" type="text" class="form-control" value="<?=date('Y')?>" required>
                    </div>
                    <div class="clearfix"></div>

                    <!-- <div class="input-prepend">
                        <label class="remember" for="remember"><input type="checkbox" id="remember"> Remember me</label>
                    </div> -->
                    <div class="clearfix"></div>

                    <p class="center col-md-5">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </p>
                </fieldset>
            </form>
        </div>
        <!--/span-->
    </div><!--/row-->
</div><!--/fluid-row-->

</div><!--/.fluid-container-->

<!-- external javascript -->

<script src="<?php echo base_url().'charisma/'?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- library for cookie management -->
<script src="<?php echo base_url().'charisma/'?>js/jquery.cookie.js"></script>
<!-- calender plugin -->
<script src='<?php echo base_url().'charisma/'?>bower_components/moment/min/moment.min.js'></script>
<script src='<?php echo base_url().'charisma/'?>bower_components/fullcalendar/dist/fullcalendar.min.js'></script>
<!-- data table plugin -->
<!-- <script src='<?php echo base_url().'charisma/'?>js/jquery.dataTables.min.js'></script> -->

<!-- select or dropdown enhancer -->
<script src="<?php echo base_url().'charisma/'?>bower_components/chosen/chosen.jquery.min.js"></script>
<!-- plugin for gallery image view -->
<script src="<?php echo base_url().'charisma/'?>bower_components/colorbox/jquery.colorbox-min.js"></script>
<!-- notification plugin -->
<script src="<?php echo base_url().'charisma/'?>js/jquery.noty.js"></script>
<!-- library for making tables responsive -->
<script src="<?php echo base_url().'charisma/'?>bower_components/responsive-tables/responsive-tables.js"></script>
<!-- tour plugin -->
<script src="<?php echo base_url().'charisma/'?>bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js"></script>
<!-- star rating plugin -->
<script src="<?php echo base_url().'charisma/'?>js/jquery.raty.min.js"></script>
<!-- for iOS style toggle switch -->
<script src="<?php echo base_url().'charisma/'?>js/jquery.iphone.toggle.js"></script>
<!-- autogrowing textarea plugin -->
<script src="<?php echo base_url().'charisma/'?>js/jquery.autogrow-textarea.js"></script>
<!-- multiple file upload plugin -->
<script src="<?php echo base_url().'charisma/'?>js/jquery.uploadify-3.1.min.js"></script>
<!-- history.js for cross-browser state change on ajax -->
<script src="<?php echo base_url().'charisma/'?>js/jquery.history.js"></script>
<!-- application script for Charisma demo -->
<script src="<?php echo base_url().'charisma/'?>js/charisma.js"></script>

<script src="<?php echo base_url().'charisma/'?>plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
</body>
</html>
<style type="text/css">
    .background {
          background-image: url('<?php echo base_url()?>image/bg.png');
          background-position: center center;
          background-size: 100%;
          /*background-color: #e0dbe0;*/
    }
    .header {
        /*color: black;*/
        -webkit-text-fill-color: blue; /* Will override color (regardless of order) */
        -webkit-text-stroke-width: 1.5px;
        -webkit-text-stroke-color: white;
      }
</style>
<script type="text/javascript">
$("#tahun").datepicker( {
    format: 'yyyy',
    viewMode: "years",
    minViewMode: "years",
    todayHighlight: 'true',
    autoclose: true,
});

$('#checkbox').click(function(){
    if($(this).is(':checked')){
        $('#password').attr('type','text');
    }else{
        $('#password').attr('type','password');
    }
});

</script>
