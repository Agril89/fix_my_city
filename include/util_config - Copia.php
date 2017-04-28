<?PHP
	require_once("util.php");
	$fixmycity = new FixMyCity();
	$fixmycity->InitDB(/*hostname*/'localhost',
                      /*username*/'root',
                      /*password*/'',
                      /*database name*/'saw',
                      /*table name*/'users');

?>