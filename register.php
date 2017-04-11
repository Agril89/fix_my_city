<?php
session_start(); // dive essere la prima cosa nella pagina, aprire la sessione
include("db.php"); // includo il file di connessione al database
	if($_POST['gender']=='1') {
		$gender='m' ;
	}
	else if($_POST['gender']=='2') {
		$gender='f' ;
	}
	
	$contract = isset($_POST['contract']) ? $_POST['contract'] : 'no';

if($_POST["username_reg"] != "" && $_POST["password_reg"]!= "" && $_POST["email_reg"] != "" && $_POST["name_reg"] != "" && $_POST["surname_reg"] != "" && $_POST["gender"] != "0" && $contract != "no"){  // se i parametri iscritto non sono vuoti non sono vuote
	$query_registrazione = pg_query("INSERT INTO users (username,email,password,first_name,last_name,gender)
	VALUES ('".$_POST["username_reg"]."','".$_POST["email_reg"]."','".$_POST["password_reg"]."','".$_POST[name_reg]."','".$_POST[surname_reg]."','".$gender."')") // scrivo sul DB questi valori
	or die ("query di registrazione non riuscita".pg_error()); // se la query fallisce mostrami questo errore
}else{
	header('location:index.php?action=registration&errore=Non hai compilato tutti i campi obbligatori'); // se le prime condizioni non vanno bene entra in questo ramo else
}
if(isset($query_registrazione)){ //se la reg è andata a buon fine
	$_SESSION["logged"]=true; //restituisci vero alla chiave logged in SESSION
	header("location:index.html");
}else{
	echo "non ti sei registrato con successo"; // altrimenti esce scritta a video questa stringa
}
?>