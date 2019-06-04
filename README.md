# salesforce-restfull
<b>Using CodeIgniter Rest Server and SalesForce Toolkit for PHP</b>

Check this tutorial to understand how to install and how to work with RESTful Services in CodeIgniter: https://code.tutsplus.com/tutorials/working-with-restful-services-in-codeigniter--net-8814 

Here you can download all project and install it on your local PC : https://github.com/chriskacerguis/codeigniter-restserver

<b>How to integrate SalesForce Toolkit for PHP on CodeIgniter Rest Server</b>

1- Copy "salesforce_api" under the "aplication" folder.</br></br>
2- Copy "sforce" folder under "controller" folder. In "sforce" folder we have the Leads.php class with Get/Create/Find/Post/Update/Delete method to manipulate SalesForce <b>Lead</b> object.</br></br>
3- Copy "Salesforce_model.php" under "model" folder. In this php class we have the SalesForce Credentias (username,password adn token). Also we refer the WSDL xml SalesForce API schema hosted on "salesforce_api/PartnerWSDL.xml".
</br></br>
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

5- To test the functionality use the fallowint URL: http://localhost/sforce/Leads service has to retive the first 10000 lead records
