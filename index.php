<pre>
<?php
    include('routes.php');  

	Rout::get('*', 'test_function');
    
	Rout::get('*/to/*', function($params){
        var_dump($params);
    });
	
	Rout::get('alert/*', function($params) {
		var_dump($params);
	});
	
	function test_function($params) {
		echo("Hello, World.");
	}
?>