<?php
    include('routes.php');  
?>
<pre>
<?php 

	var_dump($_SERVER['REQUEST_URI']);  
    	
	$settings = array(
		'HTTP_USER_AGENT' => 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/534.24 (KHTML, like Gecko) Chrome/11.0.696.71 Safari/534.24'
	);
	
	$settings = null; // Remove this when testing settings.
	
    Rout::get('/', function($params){
        var_dump($params);
    }, $settings);

	//Rout::get('/', 'test_function'); It should also allow to pass the name of the function to be executed on route matched.
?>