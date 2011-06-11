<?php
    include('routes.php');  

	Rout::get('*', 'test_function');
    
	Rout::get('*/to/*', function($params){
        var_dump($params);
    });
	
	Rout::get('alert/*', function($params) {
		echo('ALERT!');
	});
	
	function test_function() {
		echo('Hello, World');
	}
?>