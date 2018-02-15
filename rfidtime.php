<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
"http://www.w3.org/TR/html4/loose.dtd"> <html>
	<head>
		<title>IDTime - Stempeln mit RFID-Token</title>
	</head>
	<body>
		<center> <?php
	// Benutzer ermitteln anhand RFID-Token
	$_stempelid = array();
	$fp = @fopen('./Data/users.txt', 'r');
	@fgets($fp); // erste Zeile überspringen
	while (($logindata = fgetcsv($fp, 0, ';')) != false) {
		if(isset($_GET['rfid']))
		{
			$tempid=trim(@$logindata[3]);
			$tempid = str_ireplace('\r','',$tempid);
			$tempid = str_ireplace('\n','',$tempid);
			if($tempid==@$_GET['rfid']){
				$user = $logindata[0];
			}
		}
	}
	fclose($fp);
	// Zeit eintragen
	if(isset($_GET['rfid']))
	{
		if(isset($user))
		{
			$_timestamp = time();
			if(isset($_GET['time']))
			{
				$_timestamp = $_GET['time'];
			}
			$_zeilenvorschub= "\r\n";
			$_file = './Data/' . $user . '/Timetable/' . 
date('Y') . '.' . date('n');
			$fp = fopen($_file, 'a+b') or die("FEHLER - 
Konnte Stempeldatei nicht &ouml;ffnen!");
			fputs($fp, $_timestamp.$_zeilenvorschub);
			fclose($fp);
			txt("OK und Stempelzeit f&uuml;r <b>$user</b> 
eingetragen.", true);
		}
		else
		{
			txt("Fehler, unbekannte RFID!", false);
		}
	}
	else
	{
		txt("Fehler, keine RFID &uuml;bermittelt!", false);
	}
	
	function txt($txt, $ok) {
		echo '<p style="color:'.($ok?'green':'red').'">' . $txt 
. '</p>';
	}
?>
		</center>
	</body>
</html>
