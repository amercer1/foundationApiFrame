<!DOCTYPE html>
<html>
<head>
  <title>Processing</title>
        <link href="css/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
</head>

<?php include 'header.php'; // Place header for our framework ?>

<body>

	<h2>Delete a Job That is Currently Running</h2><br />
  <form class="form-horizontal" action="page4process.php" method="post">
  	<div class="control-group">
    	<label class="control-label" name="job_id"for="login">Job ID</label>
    	<div class="controls">
      	<input type="text" name="job_id" id="login" placeholder="Job ID" required>
    	</div>
    	<div class="controls">
      	<button type="submit" class="btn">Delete Job</button>
    	</div>
  	</div>
	</form>
</body>
</html>
