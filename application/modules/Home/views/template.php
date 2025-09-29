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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>SAKU</title>
    <link rel="shortcut icon" href="<?php echo base_url()?>image/icon.png">

    <!-- The styles -->
    <link href="<?php echo base_url().'charisma/'?>css/bootstrap-spacelab.min.css" rel="stylesheet">
                <!-- 
                    <li><a data-value="classic" href="#"><i class="whitespace"></i> Classic</a></li>
                    <li><a data-value="cerulean" href="#"><i class="whitespace"></i> Cerulean</a></li>
                    <li><a data-value="cyborg" href="#"><i class="whitespace"></i> Cyborg</a></li>
                    <li><a data-value="simplex" href="#"><i class="whitespace"></i> Simplex</a></li>
                    <li><a data-value="darkly" href="#"><i class="whitespace"></i> Darkly</a></li>
                    <li><a data-value="lumen" href="#"><i class="whitespace"></i> Lumen</a></li>
                    <li><a data-value="slate" href="#"><i class="whitespace"></i> Slate</a></li>
                    <li><a data-value="spacelab" href="#"><i class="whitespace"></i> Spacelab</a></li>
                    <li><a data-value="united" href="#"><i class="whitespace"></i> United</a></li> -->

    <link href="<?php echo base_url().'charisma/'?>css/charisma-app.css" rel="stylesheet">
    <link href='<?php echo base_url().'charisma/'?>bower_components/fullcalendar/dist/fullcalendar.css' rel='stylesheet'>
    <link href='<?php echo base_url().'charisma/'?>bower_components/fullcalendar/dist/fullcalendar.print.css' rel='stylesheet' media='print'>
    <link href='<?php echo base_url().'charisma/'?>bower_components/chosen/chosen.min.css' rel='stylesheet'>
    <link href='<?php echo base_url().'charisma/'?>bower_components/chosen/chosen-dark.css' rel='stylesheet'>

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
    <link href="<?php echo base_url().'charisma/'?>plugins/search/jquery-ui.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url().'charisma/'?>plugins/datetimepicker/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css" />

    <!-- jQuery -->
    <script src="<?php echo base_url().'charisma/'?>bower_components/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url().'charisma/'?>plugins/moneymask/autoNumeric.js" type="text/javascript"></script>
    <script src="<?php echo base_url().'charisma/'?>plugins/search/jquery-ui.js" type="text/javascript"></script>
    <script src="<?php echo base_url().'charisma/'?>plugins/datetimepicker/js/moment-with-locales.js"></script>
    <script src="<?php echo base_url().'charisma/'?>plugins/datetimepicker/js/bootstrap-datetimepicker.js"></script>
</head>
<script type="text/javascript">
$(document).ready(function(){
    $(".nominal").autoNumeric("init", {vMax: 9999999999999, vMin: -9999999999999});$(".dec").autoNumeric("init", {vMax: 9999999999999, vMin: -9999999999999, mDec: 2});$(".user_input").keyup(function(){$(this).val($(this).val().toUpperCase());});$.currToDouble = function(curr) {if (!curr) return 0; return Number(curr.replace(/[^0-9\.]+/g,""));}
      $.doubleToCurr = function(input, sign) { 
                      if (sign == undefined) sign  = "bracket";
          var number = input;
          if (input.toString().substring(0,1) == "-") {
              number = parseFloat(input.toString().substring(1)*1);
                  if (sign == "bracket") {
                      return "("+(number.toFixed(2).replace(/./g, function(c, i, a){return i && c !== "." && !((a.length - i) % 3) ? "," + c : c; }))+")";
                  } else if (sign == "minus") {
                      return "-"+(number.toFixed(2).replace(/./g, function(c, i, a){return i && c !== "." && !((a.length - i) % 3) ? "," + c : c; }));
                  }
          }
          return (number.toFixed(2).replace(/./g, function(c, i, a){return i && c !== "." && !((a.length - i) % 3) ? "," + c : c; }));
      }

    $(".angka").keypress(function(data){
        if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) 
        {
            return false;
        }
    });

            //entry huruf besar
    $(".upper").keyup(function(e){
        var isi = $(e.target).val();
        $(e.target).val(isi.toUpperCase());
    });
    
});
</script>
<?php 
    // $admin=$this->session->level==1?true:false; 
    $level=$this->session->level;
?>
<body>
    <!-- topbar starts -->
    <div class="navbar navbar-default" role="navigation" id="header">
        <div class="navbar-inner">
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
             <a class="box-header well" style="width: 50%"><span>Tahun Anggaran <i style="color: red"><?=$this->session->userdata("tahun")?></i></span></a>
            <!-- user dropdown starts -->
            <div class="btn-group pull-right">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> <?= $this->session->nama_lengkap; ?></span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="<?=base_url()?>Users/ubahPswd">Ubah Password</a></li>
                    <li class="divider"></li>
                    <li><a href="<?=base_url()?>Auth/logout">Logout</a></li>
                </ul>
            </div>
            <!-- user dropdown ends -->

            <!-- theme selector starts -->
            <div class="btn-group pull-right theme-container">
                <ul class="collapse navbar-collapse nav navbar-nav top-menu">
                    <li>
                        <input type="text" name="log_tahun" id="log_tahun" class="form-control text-center tahun col-sm-1" style="background-color: yellow;" value="<?=$this->session->tahun?>">                    
                    </li>
                    <li>
                        <!-- <i class="glyphicon glyphicon-star"></i> -->
                        <a href="<?= base_url()?>">Home</a>                    
                    </li>
                    <?php if($level==1): ?>
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown"></i> Master <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?=base_url()?>MsBagian">Bagian</a></li>
                                <li><a href="<?=base_url()?>MsJabatan">Jabatan</a></li>
                                <li><a href="<?=base_url()?>MsTarifPjdProvinsi">Tarif PJD Provinsi</a></li>
                                <li><a href="<?=base_url()?>MsTarifLembur">Tarif Lembur</a></li>
                                <!-- <li><a href="<?=base_url()?>MsTarifPjd">Tarif PJD</a></li> -->
                                <li><a href="<?=base_url()?>MsSdm">Pegawai</a></li>
                                <li><a href="<?=base_url()?>MsProgramUtama">Program</a></li>
                                <li><a href="<?=base_url()?>MsProgram">Kegiatan</a></li>
                                <li><a href="<?=base_url()?>MsKegiatan">Sub Kegiatan</a></li>
                                <li><a href="<?=base_url()?>MsRekeningBelanja">Rekening Belanja</a></li>
                                <li><a href="<?=base_url()?>MsDpa">DPA / Dasar ST</a></li>
                                <!-- <li><a href="<?=base_url()?>MsKegiatanOrang">Kegiatan Orang</a></li> -->
                                <li><a href="<?=base_url()?>MsHariLibur">Hari Libur</a></li>
                                <li><a href="<?=base_url()?>MsKategoriBarang">Kategori Barang</a></li>
                                <li><a href="<?=base_url()?>MsBarang">SSH Barang</a></li>
                                <li><a href="<?=base_url()?>MsRekanan">Rekanan ATK/ Barang/ Jasa Lainnya</a></li>
                                <li><a href="<?=base_url()?>MsRekananCatering">Rekanan Catering</a></li>
                                <li><a href="<?=base_url()?>MsRekananSwakelola">Rekanan Swakelola</a></li>
                                <li><a href="<?=base_url()?>Users">User</a></li>
                            </ul>
                        </li>
                    <?php elseif($level!=3 && $level!=6):?>
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown"></i> Master <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?=base_url()?>MsSdm">Pegawai</a></li>
                                <li><a href="<?=base_url()?>MsRekeningBelanja">Rekening Belanja</a></li>
                                <li><a href="<?=base_url()?>MsBarang">SSH Barang</a></li>
                                <li><a href="<?=base_url()?>MsRekanan">Rekanan ATK/ Barang/ Jasa Lainnya</a></li>
                                <li><a href="<?=base_url()?>MsRekananCatering">Rekanan Catering</a></li>
                                <li><a href="<?=base_url()?>MsRekananSwakelola">Rekanan Swakelola</a></li>
                            </ul>
                        </li>
                    <?php endif;?>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown"></i> Belanja <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <?php if($this->session->level!=6){ ?>
                                <li><a href="<?=base_url()?>Pjd">Perjadin</a></li>
                                <li><a href="<?=base_url()?>Lembur">Lembur</a></li>
                                <li><a href="<?=base_url()?>Rapat">Rapat</a></li>
                                <li><a href="<?=base_url()?>KwitansiHR">HR</a></li>
                            <?php } ?>
                            <li><a href="<?=base_url()?>PesananBarang">Barang (ATK, Krts Cover, Bhn Komp, Perabot Kantor)</a></li>
                            <?php if($this->session->level==6 || $this->session->level==1){ ?>
                                <!-- <li><a href="<?=base_url()?>Barangkeluar">Barang Keluar</a></li> -->
                            <?php } ?>
                            <li><a href="<?=base_url()?>Kwitansi/barangLainnya">Barang Lainnya</a></li>
                            <li><a href="<?=base_url()?>Kwitansi">Jasa Lainnya/ Jasa Konsultasi/ Pekerjaan Kontruksi</a></li>
                            <li><a href="<?=base_url()?>Kwitansi/swakelola">Swakelola</a></li>
                            <?php if($this->session->level==1 || $this->session->fk_bagian_id==8){ ?>
                                <li><a href="<?=base_url()?>GajiTpp">Gaji dan TPP</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li><a href="<?=base_url()?>Rekap"">Rekap</a></li>
                    <li><a href="<?=base_url()?>Pencairan"">Pencairan</a></li>
                    <li><a href="<?=base_url()?>Laporan/rekapLRA"">LRA</a></li>
                    <?php //if($level==1): ?>
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown"></i> Laporan <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?=base_url()?>Laporan/DLPerBulan"">DD & DL Per Bulan</a></li>
                                <li><a href="<?=base_url()?>Laporan/DLPerSdm"">DD & DL Per Pegawai</a></li>
                                <!-- <li><a href="<?=base_url()?>Laporan/transaksiHarian">Daftar Transaksi Harian (DTH)</a></li> -->
                                <li><a href="<?=base_url()?>Laporan/rekapPjdTahunan"">Rekap Tahunan</a></li>
                                <!-- <li><a href="<?=base_url()?>Laporan/daftarPersediaan">Daftar Persediaan</a></li> -->
                            </ul>
                        </li>
                    <?php //endif;?>
                </ul>
                <!-- <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-tint"></i><span
                        class="hidden-sm hidden-xs"> Change Theme / Skin</span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" id="themes">
                    <li><a data-value="classic" href="#"><i class="whitespace"></i> Classic</a></li>
                    <li><a data-value="cerulean" href="#"><i class="whitespace"></i> Cerulean</a></li>
                    <li><a data-value="cyborg" href="#"><i class="whitespace"></i> Cyborg</a></li>
                    <li><a data-value="simplex" href="#"><i class="whitespace"></i> Simplex</a></li>
                    <li><a data-value="darkly" href="#"><i class="whitespace"></i> Darkly</a></li>
                    <li><a data-value="lumen" href="#"><i class="whitespace"></i> Lumen</a></li>
                    <li><a data-value="slate" href="#"><i class="whitespace"></i> Slate</a></li>
                    <li><a data-value="spacelab" href="#"><i class="whitespace"></i> Spacelab</a></li>
                    <li><a data-value="united" href="#"><i class="whitespace"></i> United</a></li>
                </ul> -->
            </div>
            <!-- theme selector ends -->
        </div>
    </div>
    <!-- topbar ends -->
<div class="ch-container">
    <div class="row">        
        <!-- left menu starts -->
        <div class="col-sm-1 col-lg-2">
            <div class="sidebar-nav">
                <div class="nav-canvas">
                    <div class="nav-sm nav nav-stacked"></div>
                </div>
            </div>
        </div>
        <!--/span-->
        <!-- left menu ends -->    
    </div>

    <script src="<?php echo base_url().'charisma/'?>plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <div class="content-wrapper"> 
        <br><br><br><br>
        <?php echo $contents; ?>
    </div>
     <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="glyphicon glyphicon-chevron-up"></i></button> 
   <!--  <footer class="main-footer" style="padding-top: 10%">
        <p class="col-md-9 col-sm-9 col-xs-12 copyright">&copy; <a href="#" >
                Surya Techno</a> <?=date('Y')?></p>
        <p class="col-md-3 col-sm-3 col-xs-12 powered-by">Powered by: <a
                href="#">Charisma</a></p>
    </footer> -->
    <!-- <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0
        </div>
        
      </footer> -->
</div><!--/#content.col-md-0-->

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
<!-- tambahan -->
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<link href="<?php echo base_url().'charisma/'?>plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<!-- application script for Charisma demo -->
<script src="<?php echo base_url().'charisma/'?>js/charisma.js"></script>

<script src="<?php echo base_url().'charisma/'?>plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
</body>
<style>
#header{
  width:100%; 
  z-index:1000;
  position:fixed;
}

.nominal{
    text-align: right;
}
.judul {
    height:40px;
    border:1px solid #CCC;
    width:100%;
    text-align: center;
    border-radius: 5px;
    font-size: 14pt;
    color:#2204AB;
    background-color:#CCFAE6;
    padding: 6px;
    font-weight: bold;
    font-family: sans-serif;
}
.required .control-label:after { 
    color: #d00;
    content: "*";
    position: absolute;
    margin-left: 5px;
    /*top:7px;*/
}
.dataTables_processing {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 100%;
    margin-left: -50%;
    margin-top: -25px;
    padding-top: 20px;
    text-align: center;
    font-size: 1.2em;
    color:grey;
}
#myBtn {
    display: none; /* Hidden by default */
    position: fixed; /* Fixed/sticky position */
    bottom: 20px; /* Place the button at the bottom of the page */
    right: 15px; /* Place the button 30px from the right */
    z-index: 99; /* Make sure it does not overlap */
    border: none; /* Remove borders */
    outline: none; /* Remove outline */
    background-color: #fecfbb; /* Set a background color */
    color: white; /* Text color */
    cursor: pointer; /* Add a mouse pointer on hover */
    padding: 12px; /* Some padding */
    border-radius: 100px; /* Rounded corners */
}

#myBtn:hover {
    background-color: #555; /* Add a dark-grey background on hover */
}
</style>
<script type="text/javascript">
window.onscroll = function() {scrollFunction()};
function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("myBtn").style.display = "block";
    } else {
        document.getElementById("myBtn").style.display = "none";
    }
}
// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0; // For Chrome, Safari and Opera
    document.documentElement.scrollTop = 0; // For IE and Firefox
} 

$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings){
    return {
        "iStart": oSettings._iDisplayStart,
        "iEnd": oSettings.fnDisplayEnd(),
        "iLength": oSettings._iDisplayLength,
        "iTotal": oSettings.fnRecordsTotal(),
        "iFilteredTotal": oSettings.fnRecordsDisplay(),
        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
    };
};
$('.chosen').chosen({ allow_single_deselect: true });

function convertToRupiah(angka){
    var rupiah = '';
    var angkarev = angka.toString().split('').reverse().join('');
    for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+',';
    return rupiah.split('',rupiah.length-1).reverse().join('');
}

$( ".tanggal" ).datepicker();
$(".tahun").datepicker( {
    format: 'yyyy',
    viewMode: "years",
    minViewMode: "years",
    todayHighlight: 'true',
    autoclose: true,
});

$("#log_tahun").change(function(){
  $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo base_url().'Home/changeYear'?>",
        data: {tahun:$(this).val()},
        beforeSend  : function(){
            $("body").css("cursor", "progress");      
        },
        success: function(msg){
            $("body").css("cursor", "default");
            location.reload();
        }
    });
});

</script>
</html>
