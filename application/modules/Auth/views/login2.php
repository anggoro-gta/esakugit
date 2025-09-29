<!DOCTYPE html>
<html lang="en">
<head>
	<title>SAKU</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="shortcut icon" href="<?php echo base_url()?>image/icon.png">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets_login/'?><?php echo base_url().'assets_login/'?>vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets_login/'?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets_login/'?>fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets_login/'?>vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets_login/'?>vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets_login/'?>vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets_login/'?>vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets_login/'?>vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets_login/'?>css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets_login/'?>css/main.css">
    <link href="<?php echo base_url().'charisma/'?>plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
<!--===============================================================================================-->
</head>
<body style="background-color: #666666;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100" style="margin-top: -50px">
				<form class="login100-form validate-form" action="Auth/prosesLogin" method="post" autocomplete="off">
					<span class="login100-form-title p-b-23">
						Login Aplikasi SAKU
					</span>
					<?php if ($this->session->flashdata('error')): ?>
		                <span style="color:red" class="login100-form-title p-b-23">
		                    <strong>Error!</strong> <?php echo $this->session->flashdata('error') ?>
		                </span>
		            <?php endif; ?>
					<div class="wrap-input100 validate-input" data-validate = "Username wajib diisi">
						<input class="input100" type="text" name="username">
						<span class="focus-input100"></span>
						<span class="label-input100">Username</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Password wajib diisi">
						<input class="input100" type="password" name="password" id="password">
						<span class="focus-input100"></span>
						<span class="label-input100">Password</span>
					</div>
					<div class="input-group input-group-lg">
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <input type="checkbox" id="checkbox"> &nbsp; <span class="label-success label label-default"> Show password</span>
                    </div>
					<div class="wrap-input100 validate-input" data-validate = "Tahun wajib diisi">
						<input class="input100" type="text" name="tahun" id="tahun" value="<?=date('Y')?>">
						<span class="focus-input100"></span>
						<span class="label-input100"></span>
					</div>

					<!-- <div class="flex-sb-m w-full p-t-3 p-b-32">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

						<div>
							<a href="<?php echo base_url().'assets_login/'?>#" class="txt1">
								Forgot Password?
							</a>
						</div>
					</div> -->
			

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>
					
					<div class="text-center p-t-46 p-b-20">
						<span class="txt2">
							Bagian Perencanaan dan Keuangan Setda Kab. Kediri<br>
							Versi 2.0
						</span>
					</div>

					<div class="login100-form-social flex-c-m">
						<!-- <a href="<?php echo base_url().'assets_login/'?>#" class="login100-form-social-item flex-c-m bg1 m-r-5">
							<i class="fa fa-facebook-f" aria-hidden="true"></i>
						</a>

						<a href="<?php echo base_url().'assets_login/'?>#" class="login100-form-social-item flex-c-m bg2 m-r-5">
							<i class="fa fa-twitter" aria-hidden="true"></i>
						</a> -->
					</div>
				</form>

				<div class="login100-more" style="background-image: url('<?php echo base_url().'assets_login/'?>images/bg.png');">
				</div>
			</div>
		</div>
	</div>
	
	

	
	
<!--===============================================================================================-->
	<script src="<?php echo base_url().'assets_login/'?>vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url().'assets_login/'?>vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url().'assets_login/'?>vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo base_url().'assets_login/'?>vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url().'assets_login/'?>vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url().'assets_login/'?>vendor/daterangepicker/moment.min.js"></script>
	<script src="<?php echo base_url().'assets_login/'?>vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url().'assets_login/'?>vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url().'assets_login/'?>js/main.js"></script>

	<script src="<?php echo base_url().'charisma/'?>plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>

</body>
</html>
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