# salesforce-restfull
<b>Using CodeIgniter Rest Server and SalesForce Toolkit for PHP</b>

Check this tutorial to understand how to work with RESTful Services in CodeIgniter: https://code.tutsplus.com/tutorials/working-with-restful-services-in-codeigniter--net-8814 
Here you can download all project and install it on your local PC

<b>How to integrate SalesForce Toolkit for PHP on CodeIgniter Rest Server</b>

1-Copy "salesforce_api" on the "aplication" folder.
2-Copy "sforce" folder under "controller" folder. In "sforce" folder we have the Leads.php class with Get/Create/Find/Post/Update/Delete method to manipulate SalesForce <b>Lead</b> object.
3-Copy "Salesforce_model.php" under "model" folder. In this php class we have the SalesForce Credentias (username,password adn token). Also we refer the WSDL xml SalesForce API schema hosted on "salesforce_api/PartnerWSDL.xml".
