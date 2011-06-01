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
     * This function handles GET requests for the specified route.
     *
	 * @param string $route The route to be handled by this function.
	 * @param callback $callback The function to be executed when the 
	 * @param array $settings An array containing additional configurations.
	 * 
     * @return void
     **/
    public static function get($route, $callback, $settings = null) 
    {
        if($_SERVER['REQUEST_METHOD'] != 'GET') return false; // Ignore request if it's not a get call.
				
		$params = self::getParams();
		
		$callback($params);
   	}
	
	/**
	* This function removes the directory data from the url and gets the parameters.
	*
	* @return array returns an array with all the parameters.
	*/
	private static function getParams() 
	{
		$params = explode('/', $_SERVER['REQUEST_URI']); // Break up the URL to find the parameters.
		
		if(dirname(__FILE__) != '/') { // If the file isn't in the root folder remove directories.
			$script_deepness = count(explode('/', $_SERVER['SCRIPT_NAME'])); // Get the total number of folders the script is in.
			for($i = 0; $i < $script_deepness - 1; $i++) {
				array_shift($params); // Remove the folders from the params.
			}
		}
		
		return $params;		
	}

}