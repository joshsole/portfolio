<?php

function connectDatabase($host,$database,$user,$pass){
	try{
		$dbh = new PDO('mysql:host=' . $host . ';dbname=' . $database, $user, $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

		return  $dbh;

	} catch (PDOException $e){
		print('Error! ' . $e->getMessage() . '<br>');
	}
}
// This function inserts all feedback into feedback database
Function addFeedback($dbh, $name, $email, $feedback) {
 
//Prepare the statement that will be executed
$sth = $dbh->prepare("INSERT INTO feedback (name, email, feedback, created_at) VALUES (:name, :email, :feedback, NOW())");
 
//Bind the "$searchQuery" the SQL statement
$sth->bindValue(':name', $name , PDO::PARAM_STR);
$sth->bindValue(':email', $email , PDO::PARAM_STR);
$sth->bindValue(':feedback', $feedback , PDO::PARAM_STR);
 
//Execute the statement
$result = $sth->execute();    
return $result;
}