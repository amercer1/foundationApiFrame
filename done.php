<?php


//Here you can have the script send you an email like below, or you could have it run more scripts to run more jobs, thuse creating a pipeline
// The message you wish to send. Somehow replace with job_id


$message = "Your job has finished\n";

foreach($_GET as $name => $value) {
   $message="$message$name : $value\n";
}

foreach($_POST as $name => $value) {
 $message= "$message$name : $value\n";
}
// In case any of our lines are larger than 70 characters, we should use wordwrap()
$message = wordwrap($message, 70, "\r\n");

// Send it to the hard coded email. Make sure you change this
mail('emailAddress', 'Gene-Seqer 5.0 completed', $message);

?>

