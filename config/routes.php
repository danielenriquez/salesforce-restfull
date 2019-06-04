<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
| example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
| https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
| $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
| $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
| $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples: my-controller/index -> my_controller/index
|   my-controller/my-method -> my_controller/my_method
*/
$route['default_controller'] = 'cities';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

//Route for cities mysql
$route['cities']['get'] = 'cities/index';
$route['cities/(:num)']['get'] = 'cities/find/$1';
$route['cities']['post'] = 'cities/index';
$route['cities/(:num)']['put'] = 'cities/index/$1';
$route['cities/(:num)']['delete'] = 'cities/index/$1';

//Route for post mysql
$route['post']['get'] = 'post/index';
$route['post/(:num)']['get'] = 'post/find/$1';

//Route for campaigns SQL Server
$route['campaigns']['get'] = 'campaigns/index';
$route['campaigns/(:num)']['get'] = 'campaigns/find/$1';
$route['campaigns']['post'] = 'campaigns/index';
$route['campaigns/(:num)']['put'] = 'campaigns/index/$1';
$route['campaigns/(:num)']['delete'] = 'campaigns/index/$1';

//Route for Salesforce
$route['leads']['get'] = 'leads/index';
$route['leads/(:num)']['get'] = 'leads/find/$1';
$route['leads']['post'] = 'leads/index';
$route['leads/(:num)']['put'] = 'leads/index/$1';
$route['leads/(:num)']['delete'] = 'leads/index/$1';
/*
| -------------------------------------------------------------------------
| Sample REST API Routes
| -------------------------------------------------------------------------
*/
$route['api/example/users/(:num)'] = 'api/example/users/id/$1'; // Example 4
$route['api/example/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/example/users/id/$1/format/$3$4'; // Example 8
