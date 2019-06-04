# Salesforce-RESTfull
<b>Using CodeIgniter Rest Server and SalesForce Toolkit for PHP</b>

Check this tutorial to understand how to install and how to work with RESTful Services in CodeIgniter: https://code.tutsplus.com/tutorials/working-with-restful-services-in-codeigniter--net-8814 

Here you can download all project and install it on your local PC : https://github.com/chriskacerguis/codeigniter-restserver

<b>How to integrate SalesForce Toolkit for PHP on CodeIgniter Rest Server</b>

1- Copy "salesforce_api" under the "aplication" folder.</br></br>
2- Copy "sforce" folder under "controller" folder. In "controller/sforce" folder we have the Leads.php class with Get/Create/Find/Post/Update/Delete method to manipulate SalesForce <b>Lead</b> object. Notice that on class constructor we load "salesforce_model" class to stablish SalesForce connection</br></br>
3- Copy "Salesforce_model.php" under "model" folder. In this php class we have the SalesForce Credentias (username,password adn token). Also we refer the WSDL xml SalesForce API schema hosted on <b>"salesforce_api/PartnerWSDL.xml"</b>. You can edit this file and replace it with your cxml content.</br>
![sf-api](https://user-images.githubusercontent.com/8003697/58886501-eafe3980-86db-11e9-9eca-316c20cc0fc9.jpg)
</br>
![sf-api-WSDL](https://user-images.githubusercontent.com/8003697/58886828-71b31680-86dc-11e9-89f5-bfd82fe5174f.jpg)
</br>
On <b>"Salesforce_model.php"</b> you can find:</br>
define("USERNAME", "salesforce@email.com");</br>
define("PASSWORD", "paswword");</br>
define("SECURITY_TOKEN", "salesforce-token-here");</br>
Path to the WSDL xml generared by SalesForce API (Setup/API)</br>
$this->mySforceConnection->createConnection(APPPATH ."salesforce_api/PartnerWSDL.xml");</br>
4- Check "route.php" class under "application/config" folder to review the routing rules.</br>

<b>Route for Salesforce</b></br>
$route['leads']['get'] = 'leads/index';</br>
$route['leads/(:num)']['get'] = 'leads/find/$1';</br>
$route['leads']['post'] = 'leads/index';</br>
$route['leads/(:num)']['put'] = 'leads/index/$1';</br>
$route['leads/(:num)']['delete'] = 'leads/index/$1';</br>

5- To test the functionality use the fallowing URL: http://localhost/sforce/Leads service has to retive the first 10000 lead records

<b>Note:</b> PHP SoapClient module is mandatory to run this project on your server.
