<?php
session_start();// come sempre prima cosa, aprire la sessione 
include("db.php"); // Include il file di connessione al database
$_SESSION["username"]=$_POST["username"]; // con questo associo il parametro username che mi è stato passato dal form alla variabile SESSION username
$_SESSION["password"]=$_POST["password"]; // con questo associo il parametro username che mi è stato passato dal form alla variabile SESSION password

$query = pg_query("SELECT * FROM users WHERE username='".$_POST["username"]."' AND password ='".$_POST["password"]."'")  //per selezionare nel db l'utente e pw che abbiamo appena scritto nel log
or DIE('query non riuscita'.pg_error());
// Con il SELECT qua sopra selezione dalla tabella users l utente registrato (se lo è) con i parametri che mi ha passato il form di login, quindi
// Quelli dentro la variabile POST. username e password.
if(pg_num_rows($query) != 1){        //se c'è una persona con quel nome nel db allora loggati
	$row = pg_fetch_assoc($query); // metto i risultati dentro una variabile di nome $row
	$_SESSION["logged"] =true;  // Nella variabile SESSION associo TRUE al valore logge
	header("location:map.html"); // e mando per esempio ad una pagina esempio.php// in questo caso rimanderò ad una pagina prova.php
}else{
	echo "non ti sei registrato con successo"; // altrimenti esce scritta a video questa stringa di errore
}
?>