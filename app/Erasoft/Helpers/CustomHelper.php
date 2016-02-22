<?php

use Illuminate\Routing\Route;
 
function getControllerName()
{
	$route = new Route();
	print $route->getActionName();
	print "<br />";
	print $route->getAction();
	
}