<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>To-do app!</title>
	<link rel="stylesheet" href=""/>
	<?php
	/**
	 * Write a function to load jQuery and jQuery-UI
	 * load('jquery');
	 * load('jquery-ui');
	 */ 
	?>
	<link type="text/css" href="/Orpheus/resources/css/ui-lightness/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
	<script type="text/javascript" src="/Orpheus/resources/js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="/Orpheus/resources/js/jquery-ui-1.8.21.custom.min.js"></script>
	<script type="text/javascript">
			$(function(){
				// Datepicker
				$('#deadline').datepicker({			
					changeMonth: true,
					changeYear: true
				});

				//hover states on the static widgets
				$('#dialog_link, ul#icons li').hover(
					function() { $(this).addClass('ui-state-hover'); },
					function() { $(this).removeClass('ui-state-hover'); }
				);
			});
	</script>

	<style>
	body {background:#1D1D1D; color: #e3e3e3; font-family: Georgia, sans-serif;}
	form {margin: auto; width: 85%;}
	input, textarea {
		width:95%;
		 line-height: 2em; 
		 font-family: Georgia, sans-serif; 
		 border-radius: 5px;
    	-webkit-border-radius: 5px;
    	-moz-border-radius: 5px;
    }

    input[type=text], textarea  {border:none;}
	input[type="submit"] {
    	border: 1px solid #c62828;
    	background: #aa2828;
    	color: #e3e3e3;
    	padding: .5em;
    	cursor: pointer;
    	width: 20%;
	}
	input[type="submit"]:hover {background: #9a2222;}
	label {display:block; text-align: left;font-weight:bolder; cursor: pointer;}
	section {width: 750px; margin: auto; background: #e3e3e3; color: #333;border: 1px solid #e3e3e3; padding: 1em;}
	h1 {margin: auto; text-align: center; font-size: 2em;}
	</style>
</head>
<body>

<section>
	<h1>Task : <?php echo $title; ?></h1>


<?php echo $details; ?> 
</section>


</body>
</html>