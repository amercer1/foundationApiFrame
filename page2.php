<?php 
	
	require_once 'fileTree/bootstrap.php';
	session_start();
  $dir = $config['path'];

?>
<!DOCTYPE html>
<html>
<head>
  <title>Job Creation</title>
  <link href="css/bootstrap/css/bootstrap.css" rel="stylesheet">
  <link href="css/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="<?php echo base_url("css/normalize.css"); ?>" />
  <link type="text/css" rel="stylesheet" href="<?php echo base_url("css/global.css"); ?>" />
  <link type="text/css" rel="stylesheet" href="<?php echo base_url("js/jqueryFileTree/jqueryFileTree.css"); ?>" />
  <script src="<?php echo base_url("js/jquery-1.7.1.min.js"); ?>"></script>
  <script src="<?php echo base_url("js/jqueryFileTree/jqueryFileTree.js"); ?>"></script>
  <script src="<?php echo base_url("js/jquery.zclip.min.js"); ?>"></script>
  <script type="text/javascript">function base_url(path) {return '<?php echo BASE_URL; ?>' + path;} var root = "<?php echo $config['path']; ?>"; var dir = "<?php echo $dir; ?>";</script>
  <script src="<?php echo base_url("js/global.js"); ?>"></script>		
</head>

<?php include 'header.php'; // Place header for our framework ?>

<body>

<?php

	
	try {
  	//$account = new RODSAccount($config['server'], $config['port'], $config['username'], $config['password']); // create an irods account object
  	$account = new RODSAccount('data.iplantcollaborative.org', 1247, $_SESSION['login'], $_SESSION['password']);
		$line = "/iplant/home/" . $_SESSION['login'];
		$dir = new ProdsDir($account, $line); // direct it to the disired directory
	}catch (RODSException $e) {
  	echo "--- test failed! --- <br/>\n";
  	echo ($e);
  	echo $e->showStackTrace();
	}
?>
	  	
			<div class="row">
					<div class="span5">
					<h3>Launch a Job</h3><br />
					<form class="form-horizontal" action="jobProcess.php" method="post">
					
						<div class="control-group">
							<label class="control-label" name="jobName"for="login">Job Name</label>
							<div class="controls">
								<input type="text" name="jobName" id="login" placeholder="Job Name" required>
							</div>
						</div>
					
						<div class="control-group">
							<label class="control-label" name="outPutFile" for="output">Output Location</label>
							<div class="controls">
								<div class="input-prepend">
									<span class="add-on"><i class="icon-magnet"></i></span>
									<input type="text" class="toBeGrabbed" name="outPutFile" id="outPutFile" placeholder="Output Location" required>
								</div>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" name="outputPath" for="outputPath">Output Path</label>
							<div class="controls">
								<div class="input-prepend">
                  <span class="add-on"><i class="icon-magnet"></i></span>
									<input type="text" class="toBeGrabbed" name="outputPath" id="outputPath" placeholder="Output Path" required>
								</div>
							</div>
						</div>
					
						<div class="control-group">
							<label class="control-label" name="Species" for="Species">Species</label>
							<div class="controls">
								<select name="Species" required>  
									<option>Arabidopsis</option>  
									<option>maize</option>  
									<option>rice</option>  
									<option>Medicago</option>  
									<option>Aspergillus</option>
									<option>yeast</option>
									<option>human</option>
									<option>mouse</option>
									<option>rat</option>
									<option>chicken</option>
									<option>Drosophila</option>
									<option>nematode</option>  
								</select>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" name="libfname" for="libfname">libfname</label>
							<div class="controls">
								<div class="input-prepend">
                  <span class="add-on"><i class="icon-magnet"></i></span>
									<input type="text" class="toBeGrabbed" name="libfname" id="libfname" placeholder="libfname">
								</div>
							</div>
						</div>
							
						<div class="control-group">
							<label class="control-label" name="EstFormat" for="EstFormat">EstFormat</label>  
							<div class="controls">
								<input type="text" name="EstFormat" id="EstFormat" placeholder="EstFormat">
							</div>
						</div>
					
						<div class="control-group">
							<label class="control-label" name="estSeq" for="estSeq">estSeq</label>
							<div class="controls">
								<div class="input-prepend">
                  <span class="add-on"><i class="icon-magnet"></i></span>
									<input type="text"  class="toBeGrabbed" name="estSeq" id="estSeq" placeholder="estSeq" required>
								</div>
							</div>
						</div> 


						<div class="control-group">
							<label class="control-label" name="maxnest" for="maxnest">maxnest</label>
							<div class="controls">
								<input type="text" name="maxnest" id="maxnest" placeholder="maxnest">
							</div>
						</div>


						<div class="control-group">
							<label class="control-label" name="requestedTime" for="">Requested Time</label>
							<div class="controls">
								<input type="text" name="requestedTime" id="requestedTime" placeholder="1:00:00" required>
							</div>
						</div>
						 
						<div class="control-group">
							<div class="controls">
								<button type="submit" class="btn">Launch</button>
							</div>
						</div>
						</div> <!-- escape span6  -->
						
						<div class="span9">
							<h3>Your File Tree</h3>
							<div id="file-tree"></div>
						</div> <!-- escape span3  -->

				</div> <!-- escape row  -->
</body>

<footer>

<div class="row">
	<div class="span12">
	<p> The icon <i class="icon-magnet"></i> indicates that you can use the file tree to pull text directly into the text area</p>
	</div>
</div>
</footer>
</html>
