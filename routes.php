<?php
/*
    Copyright (c) 2011 Sergio Díaz

    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is furnished
    to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in all
    copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
    THE SOFTWARE.
*/

/**
 *  Routs, a small PHP framework for handling URL routes.
 *
 *  @author Sergio Díaz <seich@martianwabbit.com>
 *  @version 1.0
 *  @package Routs
 */

/**
* The basic Routs class that'll end up doing all the work.
*/
class Rout
{
    
    /**
     * This function handles requests for the specified route.
     *
     * @param string $name The name determines the type of the current request.
	 * @param array $arguments The passed arguments should be the route and the callback.
     * 
     * @return void
     **/
    public static function __callStatic($name, $arguments) {
       	
        $requestType = strtoupper($name);
       	if (!in_array($requestType, array('GET', 'POST', 'PUT', 'DELETE')))
            return false;
        
        $route = $arguments[0];
        $callback = $arguments[1];
        
        if($_SERVER['REQUEST_METHOD'] != $requestType) return false; // Ignore request if it's not the same type.
        if(!self::matchRoute($route)) return false; // Ignore request if the route doesn't match.
        return self::runCallback($route, $callback); // execute the provided callback and return it's result.
    }
	
	/**
	 * This function checks if the called route is the same as the one provided.
	 *
	 * @params string $route The route to be checked against the the current script route. 
	 * @return boolean returns true if the routes are the same.
	 */
	private static function matchRoute($route) 
	{
		switch($route) {
			case '':
			case '/':
				return true;
				break;
			default:
				$route = explode('/', $route);
				$params = self::getParams();
				
				// If the arrays aren't equal in length, they don't match.
				if(count($route) != count($params)) return false;
				
				// compare the route and the params arrays, Checking for wildcards(*);
				for($i = 0; $i < count($route); $i++) {
					if($route[$i] == $params[$i] || $route[$i] == '*') {
						if($i != (count($route) - 1)) continue;
						else return true;
					} else {
						return false;
					}	
				}
				break;
		}
	}
	
	/**
	 * This function gets the current url params and if all settings are true, executes the provided callback.
	 *
     * @param string $route The route to extract the parameters from.
	 * @param callback $callback The function to be executed.
	 * 
	 * @return void
	 */
	private static function runCallback($route, $callback) 
	{
		$params = self::getParams($route);
		
		$callback($params); // Execute callback.
	}
	
	/**
	 * This function removes the directory data from the url and gets the parameters.
	 * If a route is provided it'll only return the values where wildcards are located.
	 *
	 * @param string $route The route to be compared with the params.
	 * 
	 * @return array returns an array with all the parameters.
	 */
	private static function getParams($route = null) 
	{
		$params = explode('/', $_SERVER['REQUEST_URI']); // Break up the URL to find the parameters.
		
		if(dirname(__FILE__) != '/') { // If the file isn't in the root folder remove directories.
			$script_deepness = count(explode('/', $_SERVER['SCRIPT_NAME'])); // Get the total number of folders the script is in.
			for($i = 0; $i < $script_deepness - 1; $i++) {
				array_shift($params); // Remove the folders from the params.
			}
		}
		
		if($route == null) {
			return $params;
		} else {
			$route = explode('/', $route);
			$new_params = array();
			//Checks for wildcards and only returns those values.
			for($i = 0; $i < count($route); $i++) {
				if($route[$i] == '*') {
					$new_params[] = $params[$i];
				}
			}			
			return $new_params;			
		}
					
	}
}