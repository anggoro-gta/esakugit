<!DOCTYPE html>
<html lang="en">
    <head>        
        <title>Datetimepicker</title>            
        <link rel="stylesheet" href="css/bootstrap.min.css">
		<link href="css/bootstrap-datetimepicker.css" rel="stylesheet">
    </head>
    <body>
		
    	<div class="form-group">                                        
			<label class="col-md-1 col-xs-12 control-label">Datetimepicker </label>
			<div class="col-md-3 col-xs-12">
				<div class='input-group date' >
					 <span class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
					</span>
					<input type="text" name="datetimepicker" class="form-control datetimepicker" />
				</div>
			</div>
		</div>
		
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script src="js/moment-with-locales.js"></script>
		<script src="js/bootstrap-datetimepicker.js"></script>
			
		<script type="text/javascript">
		$(function () {
			$('.datetimepicker').datetimepicker({
                format: 'DD-MM-YYYY HH:mm:ss',
            });
		});
	    </script>
    </body>
</html>






