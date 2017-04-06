<?php

function dd($data)
{
    die(var_dump($data));
}

function loggedIn() {
    return !empty($_SESSION['username']);
}



function redirect($url)
{
    header ('Location: ' . $url);
    die();
}

function e($value)
{
	return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

// -----------------------------------------------------------------------------
//Connect to the database function.
// -----------------------------------------------------------------------------


function connectDatabase($host,$database,$user,$pass){
	try{
		$dbh = new PDO('mysql:host=' . $host . ';dbname=' . $database, $user, $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

		return  $dbh;

	} catch (PDOException $e){
		print('Error! ' . $e->getMessage() . '<br>');
		die();
	}
}

// -----------------------------------------------------------------------------
// Insert into "users" table
// -----------------------------------------------------------------------------


function addUser($dbh, $username, $email, $password) {

//Prepare the statement that will be executed
	$sth = $dbh->prepare("INSERT INTO users VALUES (NULL, :username, :email, :password)");



//Bind the "$searchQuery" the SQL statement
	$sth->bindValue(':username', $username, PDO::PARAM_STR);
	$sth->bindValue(':email', $email , PDO::PARAM_STR);
	$sth->bindValue(':password', $password , PDO::PARAM_STR);
	

//Execute the statement
	$success = $sth->execute();    
	return true;
}

/* 
 To add a new message you will use this syntax addMessage [success|error] [message]

 To display errors on the page place following code in a div on what ever page.

 <= showMessages() ?>
*/



/**
 * A helpful message function to return all massages saved in the session
 * @param string|null $type
 * @return string
 */


// -----------------------------------------------------------------------------
//Show the success or error message
// -----------------------------------------------------------------------------

function showMessages($type = null)
{
  $messages = '';
  if(!empty($_SESSION['flash'])) {
    foreach ($_SESSION['flash'] as $key => $message) {
      if(($type && $type === $key) || !$type) {
        foreach ($message as $k => $value) {
          unset($_SESSION['flash'][$key][$k]);
          $key = ($key == 'error') ? 'danger': $key;
          $messages .= '<div class="alert alert-' . $key . '">' . $value . '</div>' . "\n";
        }
      }
    }
  }
  return $messages;
}


/**
 * Add a message to the session
 * @param string $type
 * @param string $message
 * @return void
 */
function addMessage($type, $message) {
  $_SESSION['flash'][$type][] = $message;
}


// -----------------------------------------------------------------------------
// Insert into "projects" table
// -----------------------------------------------------------------------------


function addProject($dbh, $title, $url, $content, $link) {

//Prepare the statement that will be executed
	$sth = $dbh->prepare("INSERT INTO projects VALUES (NULL, :title, :url, :content, :link)");



//Bind the "$searchQuery" the SQL statement
	$sth->bindValue(':title', $title, PDO::PARAM_STR);
	$sth->bindValue(':url', $url , PDO::PARAM_STR);
	$sth->bindValue(':content', $content , PDO::PARAM_STR);
	$sth->bindValue(':link', $link , PDO::PARAM_STR);

//Execute the statement
	$success = $sth->execute();    
	return $success;
}



function getUser($dbh, $username) {
    $sth = $dbh->prepare('SELECT * FROM `users` WHERE username = :username OR email = :email');

    $sth->bindValue(':username', $username, PDO::PARAM_STR);
    $sth->bindValue(':email', $username, PDO::PARAM_STR);

    // Execute the statement.
    $sth->execute();

    $row = $sth->fetch();

    if (!empty($row)) {
      return $row;
    }
    return false;
}

function getProjects($dbh) {
    $sth = $dbh->prepare('SELECT * FROM `projects` ');



    // Execute the statement.
    $sth->execute();

    $row = $sth->fetchAll();

    if (!empty($row)) {
      return $row;
    }
    return false;
}
// -----------------------------------------------------------------------------
// Edit and delelte projects functions
// -----------------------------------------------------------------------------


function editProject($id, $dbh) {
	// prepare statement that will be executed
	$sth = $dbh->prepare("SELECT * FROM projects WHERE id = :id");
	$sth->bindParam(':id', $id, PDO::PARAM_STR);
	$sth->execute();

	$result = $sth->fetch();
	return $result;
}

function updateProject($id, $dbh, $title, $url, $content, $link) {
	$sth = $dbh->prepare("UPDATE projects SET title = :title, url = :url, content = :content, link = :link WHERE id = :id");
	// bind the $id to the SQL statement
	$sth->bindParam(':id', $id, PDO::PARAM_STR);
	// bind the $name to the SQL statement
	$sth->bindParam(':title', $title, PDO::PARAM_STR);
	// bind the $email to the SQL statement
	$sth->bindParam(':url', $url, PDO::PARAM_STR);
	// bind the $feedback to the SQL statement
	$sth->bindParam(':content', $content, PDO::PARAM_STR);
		// bind the $feedback to the SQL statement
	$sth->bindParam(':link', $link, PDO::PARAM_STR);
	// execute the statement 
	$result = $sth->execute();
	return $result;
}

function deleteProject($id, $dbh) {
	// prepare statement that will be executed
	$result = $dbh->prepare("DELETE FROM projects WHERE id= :id");
	$result->bindParam(':id', $id);
	$result->execute();
}



















































