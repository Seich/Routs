<?php
    include('routes.php');  
?>
<pre>
<?php 

	var_dump($_SERVER['REQUEST_URI']);  
    	
	$settings = array(
		'HTTP_USER_AGENT' => 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/534.24 (KHTML, like Gecko) Chrome/11.0.696.71 Safari/534.24'
	);
	
    Rout::get('/', function($params){
        var_dump($params);
    }, $settings);

?>