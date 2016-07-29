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
	ul {list-style-type: none; width: 500px; margin: auto;position:relative; top: 40px;}
	ul li {
		display: inline-block;
	}
	ul li a {
		padding: 9px 9px;
		margin: 2px 4px;
		border: 1px solid #8C8C8C;
		background: #171717;
		color: #fff;
		font-weight: bold;
		text-decoration: none;
	}
	ul li a:hover {background:#3C3C3C;}
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
	<h1><?php echo $title; ?></h1>
<ul>
	<li><a href="<?php echo BASE_URL; ?>todo" title="Todo-Home">Home</a></li>
	<li><a href="<?php echo BASE_URL; ?>/todo/add" title="Add a todo item">Add an item</a></li>
</ul>
<pre>
	<?php print_r($loadedControllers); ?>
</pre>
<form action="<?php echo BASE_URL; ?>todo/add" method="post">
	<p>
		<label for="title">Title: </label>
		<input type="text" id="title" name="title" />
	</p>
	<p>
		<label for="deadline">Deadline:  </label>
		<input type="text" id="deadline" name="deadline" />
	</p>
	<p>
		<label for="details">Details: </label>
		<textarea name="details" rows=10 columns=25></textarea>
	</p>
	<p>
		<input type="submit" id="submit" name="submit" value="Add item!" />
	</p>

</form>

</section>

</body>
</html>