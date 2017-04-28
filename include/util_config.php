<?PHP
	require_once("util.php");
	$fixmycity = new FixMyCity();
	$fixmycity->InitDB(/*hostname*/'eu-cdbr-west-01.cleardb.com',
                      /*username*/'b47103a86a0dcf',
                      /*password*/'c88d2a41',
                      /*database name*/'heroku_86079c91c63fe9f',
                      /*table name*/'users');

?>