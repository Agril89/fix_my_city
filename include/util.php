<?php
	class FixMyCity
	{
		var $error_message;
		
		var $username;
		var $pwd;
		var $database;
		var $tablename;
		var $connection;
		
		function FixMyCity()
		{
			$this->sitename = 'FixMyCity.it';
		}
		
		//Init Database
		function InitDB($host,$uname,$pwd,$database,$tablename)
		{
			$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
			
			$this->db_host  = $url["host"];
			$this->username = $url["user"];
			$this->pwd  = $url["pass"];
			$this->database  = substr($url["path"], 1);
			$this->tablename = $tablename;
			
		}

		//Users Function
		function RegisterUser()
		{
			$username = trim($_POST['username']);
			$email = trim($_POST['email']);
			$password = trim($_POST['password']);
			$c_password = trim($_POST['c_password']);
			$name= trim($_POST['name']);
			$surname= trim($_POST['surname']);
			$gender=$contract=NULL;
			
			if (isset($_POST['gender'])){
				$gender=$_POST['gender'];
				}
			if (isset($_POST['contract'])){
				$contract=$_POST['contract'];
			}
			if(!$this->CheckFields($username,$email,$password,$c_password,$name,$surname,$gender,$contract))
			{
				return false;
			}
			
			if(!$this->DBLogin())
			{
				$this->HandleError("Database login failed!");
				return false;
			}
			if(!$this->CheckTable())
			{
				return false;
			}
			if(!$this->IsFieldUnique($email,'email'))
			{
				$this->HandleError("This email is already registered");
				return false;
			}
			
			if(!$this->IsFieldUnique($username,'username'))
			{
				$this->HandleError("This UserName is already used. Please try another username");
				return false;
			} 
						
			if($gender=='1') {
				$gender='Maschio' ;
			}
			if($gender=='2') {
				$gender='Femmina' ;
			}
			if(!$this->InsertIntoDB($username,$email,md5($password),$name,$surname,$gender))
			{
				$this->HandleError("Inserting to Database failed!");
				return false;
			}
			return true;
		}
		
		function Login()
		{
			if(empty($_POST['user']))
			{
				$this->HandleError("Username is empty!");
				return false;
			}
			
			if(empty($_POST['pass']))
			{
				$this->HandleError("Password is empty!");
				return false;
			}
			
			$username = trim($_POST['user']);
			$password = md5(trim($_POST['pass']));
			
			if(!isset($_SESSION)){ session_start(); }
			if(!$this->CheckLoginInDB($username,$password))
			{
				return false;
			}
			if(!empty($_POST["remember"])) {
				setcookie ('FixMyCityLogin', 'usr='.$username.'&hash='.$password, time() + (7 * 24 * 60 * 60), "/"); //7 days			
			}
			$_SESSION['username'] = $username;
			
			return true;
		}
		
		function AutoLogin(){
			if(isSet($_COOKIE['FixMyCityLogin']))
			{
				parse_str($_COOKIE['FixMyCityLogin'], $str);
				if($this->CheckLoginInDB($str['usr'],$str['hash'])) { 
					if(!isset($_SESSION)){ session_start(); }
					$_SESSION['username'] = $str['usr'];
					return true;
				}
			}
            return false;
		}
		
		function LogOut()
		{
			session_start();
            
            setcookie ('FixMyCityLogin', '', time() - (7 * 24 * 60 * 60), "/");	
			
			$_SESSION['username']=NULL;
			
			unset($_SESSION['username']);
		}
		
		function CheckSession() {
			session_start(); 
			$user_check=$_SESSION['username']; 
			$ses_sql=mysqli_query($db,"select  username  from $this->tablename where  username='$user_check'  "); 
			$row=mysqli_fetch_array($ses_sql,MYSQLI_ASSOC); 
			$loggedin_session=$row['username']; 
			if(!isset($loggedin_session)  ||  $loggedin_session==NULL) { 
				echo  "Go  back"; 
				header("Location:  index.php"); 
			} 
		}
		
		//Database Function
		function DBLogin()
		{
			$this->connection = mysqli_connect($this->db_host,$this->username,$this->pwd);
			
			if(!$this->connection)
			{   
				$this->HandleDBError("Database Login failed! Please make sure that the DB login credentials provided are correct");
				return false;
			}
			if(!mysqli_select_db($this->connection, $this->database))
			{
				$this->HandleDBError('Failed to select database: '.$this->database.' Please make sure that the database name provided is correct');
				return false;
			}
			return true;
		}
		
		function CheckTable()
		{
			$result = mysqli_query($this->connection, "SHOW COLUMNS FROM $this->tablename");   
			if(!$result || mysqli_num_rows($result) <= 0)
			{
				return $this->CreateTable();
			}
			return true;
		}
		
		function CreateTable()
		{
			$qry = "Create Table $this->tablename (".
			"username VARCHAR( 16 ) UNIQUE NOT NULL ,".
			"email VARCHAR( 64 ) NOT NULL ,".
			"password VARCHAR(80) NOT NULL ,".
			"name VARCHAR( 128 ) NOT NULL ,".
			"surname VARCHAR(16) NOT NULL,".
			"gender VARCHAR(1) NOT NULL,".
			"PRIMARY KEY ( email )".
			")";
			
			if(!mysqli_query($this->connection, $qry))
			{
				$this->HandleDBError("Error creating the table \nquery was\n $qry");
				return false;
			}
			return true;
		}
		
		function InsertIntoDB($username,$email,$password,$name,$surname,$gender)
		{
			//$stored = password_hash(hash('sha256', $_POST['password'], true), PASSWORD_DEFAULT);
			
			$insert_query = 'insert into '.$this->tablename.'(
			username,
			email,
			password,	
			name,
			surname,
			gender
			)
			values
			(
			"' . $username . '",
			"' . $email . '",
			"' . $password . '",
			"' . $name . '",
			"' . $surname . '",
			"' . $gender . '"
			)';  
			
			
			if(!mysqli_query($this->connection, $insert_query))
			{
				$this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
				return false;
			}        
			return true;
		}
		
		function CheckLoginInDB($username,$password)
		{
			if(!$this->DBLogin())
			{
				$this->HandleError("Database login failed!");
				return false;
			}          
			
			$qry = "Select name, surname, email, gender from $this->tablename where username='$username' and password='$password'";
			
			$result = mysqli_query($this->connection, $qry);
			
			if(!$result || mysqli_num_rows($result) <= 0)
			{
				$this->HandleError("Error logging in. The username or password does not match");
				return false;
			}
			
			$row = mysqli_fetch_assoc($result);
			
			
			$_SESSION['name']  = $row['name'];
			$_SESSION['surname']  = $row['surname'];
			$_SESSION['email'] = $row['email'];
			$_SESSION['gender']  = $row['gender'];
			
			return true;
		}
		
		//Control Fields
		function CheckFields($username,$email,$password,$c_password,$name,$surname,$gender,$contract) 
		{
			if (!preg_match("/^[a-zA-Z0-9]*$/",$username) || $username == '') {
				$this->HandleError('Il campo username &egrave; errato (composto di sole lettere e numeri)'); 
			}
			if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $email == '') {
				$this->HandleError('Il campo e-mail &egrave; errato'); 
			}
			if($password == '' || $c_password == ''){
				$this->HandleError('Tutti i campi password devono essere riempiti');
			}
			elseif($password != $c_password){
				$this->HandleError('Le password non combaciano');
			}
			if (!preg_match("/^[a-zA-Z]*$/",$name) || $name == '') {
				$this->HandleError('Il campo name deve essere solo di lettere e non vuoto'); 
			}
			
			if (!preg_match("/^[a-zA-Z]*$/",$surname) || $surname == '') {
				$this->HandleError('Il campo cognome deve essere solo di lettere e non vuoto'); 
			}
			if (!isset($_POST['gender'])) {
				$this->HandleError('Il campo del sesso non &egrave; stato selezionato');
			}
			if (!isset($_POST['contract'])) {
				$this->HandleError('Bisogna accettare le condizioni di utilizzo');
			}
			
			if($this->error_message != ''){
				return false;
			}
			return true;
		}
		
		function IsFieldUnique($fieldvalue,$fieldname)
		{
			$qry = "select username from $this->tablename where $fieldname='".$fieldvalue."'";
			$result = mysqli_query($this->connection, $qry);   
			if($result && mysqli_num_rows($result) > 0)
			{
				return false;
			}
			return true;
		}
		
		//Error Handler
		function HandleError($err){
			$this->error_message .= $err."\r\n";
		}
		
		function HandleDBError($err){
			$this->HandleError($err."\r\n mysqlerror:".mysql_error());
		}
		
		function GetErrorMessage(){
			if(empty($this->error_message)){
				return '';
			}
			$errormsg = nl2br(($this->error_message));
			return $errormsg;
		}  
		
		//Util
		function RedirectToURL($url){
			header("Location: $url");
			exit;
		}
	}
?>					