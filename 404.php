<?php
	//if a URL that looks like an image is detected, output an image 404
	if ( strpos( $_SERVER["REQUEST_URI"], '.png' ) 
		|| strpos( $_SERVER["REQUEST_URI"], '.jpg' )
		|| strpos( $_SERVER["REQUEST_URI"], '.jpeg' )
		|| strpos( $_SERVER["REQUEST_URI"], '.gif' ) ) {
			header( 'Content-Type: image/png' );
			readfile( get_stylesheet_directory() . '/graphics/404.png' );
			die();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<style>
		body {
			margin: 4em;
		}
		a {
			border-bottom: 1px solid #ccc;
			border-color: rgba(0,0,0,0.2);
			color: #333;
			text-decoration: none;

			-webkit-transition  : border .3s;
			-moz-transition     : border .3s;
			transition          : border .3s;
		}
		a:hover {
			border-bottom: 4px solid #000
		}
	</style>
</head>
<body onload="init()">
<?php
	echo '<h1><a href="' . get_bloginfo('url') . '">' . get_bloginfo('name') . '</a></h1>';
?>
	<p id="output">404</p>
	<script type="text/javascript">
		var count = 1, output = document.getElementById('output');

		setTimeout(function(){
					output.innerHTML += ' = ';
				}, 20);

		function write() {
			if (count < 404) {
				output.innerHTML += '1';
				setTimeout(function(){
					output.innerHTML += ' + ';
				}, 20);
				count++;
			}
			else {
				output.innerHTML += '1 <br/> <a onclick="history.go(-1);"><?php _e( 'Not what you expected?', 'tect' ); ?></a>';
				window.clearInterval(timer);
			}
		}

		function init() {
			timer = setInterval(write, 100);
		}
	</script>
</body>
</html>