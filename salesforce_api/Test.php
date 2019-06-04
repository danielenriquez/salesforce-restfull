<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<title> Consume Enterprise WSDL of Salesforce using PHP
</title>
</head>
<body>
<?php
define("USERNAME", "daniel@silverpoint.com");
define("PASSWORD", "dea$1122");
define("SECURITY_TOKEN", "SeXuQPL9liEcA3RZl05RH6opw");

require_once ('soapclient/SforcePartnerClient.php');
require_once ('soapclient/SforceEnterpriseClient.php');

try {
	
	$mySforceConnection = new SforcePartnerClient();	
	$mySforceConnection->createConnection("PartnerWSDL.xml");
	//$mySforceConnection = new SforceEnterpriseClient();
	//$mySforceConnection->createConnection("enterprise.wsdl.xml");
	$mySforceConnection->login(USERNAME, PASSWORD.SECURITY_TOKEN);

	//Query SF Object
	//$query = 'SELECT Id,Name,Phone,Email from Lead limit 5';
	$query = "SELECT Id,FirstName,Phone,Email FROM Lead WHERE Id='00Qw0000019O3iq'";
	$response = $mySforceConnection->query(($query));
	print_r($response);

	
	//Update SF Object
	$fieldsToUpdate = array (
		'FirstName' => 'Test2'
	);
	$sObjectU = new SObject();
	$sObjectU->fields = $fieldsToUpdate;
	$sObjectU->type = 'Lead';
	$sObjectU->Id = '00Qw0000019O3iq'; // YOU NEED TO MENTION THE UDATE FIELD ID	

	$update = $mySforceConnection->update(array ($sObjectU));
	print_r($update);

	//Create SF Objects
	$fieldsToCreate = array (
		'FirstName' => 'TestPHP',
		'LastName' => 'PHPTest',
		'Phone' => '510-555-5555',
		'Email' => 'testphp@mail.com'
	);

	$sObjectC = new SObject();
	$sObjectC->fields = $fieldsToCreate;
	$sObjectC->type = 'Lead';	

	$create = $mySforceConnection->create(array($sObjectC));
	print_r($create);	
		

} catch (Exception $e) {
	echo $e->faultstring;
}	

?>
<div id="wrapper">
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="content">
					<div class="post">
						<h2 class="title"><a href="#"> Force.com Toolkit for PHP </a></h2>
						<p class="meta"><span class="date">Using Enterprise WSDL</span><span class="posted">WebService</span></p>
						<div style="clear: both;">&nbsp;</div>
						<div class="entry">
								<a href="javascript:void(0);">							
								<?php
									echo "Results of query '$query'<br/><br/>\n";
								?>
								</a>
							<table>
								<tr>
									<th>Contact ID </th>
									<th>First Name</th>
									<th>Phone </th>
									<th>Email </th>
								</tr>
								<?php
									foreach ($response->records as $record) {
										echo '<tr> 
													<td>'.$record->Id.'</td>
													<td>'.$record->fields->FirstName.'</td>
													<td>'.$record->fields->Phone.'</td>
													<td>'.$record->fields->Email.'</td>
											 </tr>';
										 }
								?>
							</table>
						</div>
					</div>
					<div style="clear: both;">&nbsp;</div>
				</div>
				<!-- end #content -->
				<div id="sidebar">
					<div id="logo">
						<h1><a href="http://www.silverpoint.com">Silverpoint</a></h1>
						<p><a href="http://www.freecsstemplates.org/">...the supreme solution</a></p>
						
							Consume Partner WSDL Webservice in PHP using the toolkit released by the salesforce
						<br /><br /><br />
						
							Requirement : cURL, SOAP and OpenSSL
					
					</div>
				</div>
				<!-- end #sidebar -->
				<div style="clear: both;">&nbsp;</div>
			</div>
		</div>
	</div>
	<!-- end #page -->
</div>
<!-- end #footer -->
</body>
</html>

