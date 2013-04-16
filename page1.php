<!DOCTYPE html>
<html>
<head>
  <title>Job Creation</title>
  <link href="css/bootstrap/css/bootstrap.css" rel="stylesheet">
  <link href="css/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
</head>

<?php include 'header.php'; // Place header for our framework ?>

<body>

	<h3>Form For Grabbing Arguments for Launching a Job</h3>	  	
			<div class="row">
					<div class="span5">
					<br />
					<form class="form-horizontal" action="page1process.php" method="post">
					
						<div class="control-group">
							<label class="control-label" name="jobName"for="login">Job Name</label>
							<div class="controls">
								<input type="text" name="jobName" id="login" placeholder="Job Name" required>
							</div>
						</div>
					
						<div class="control-group">
							<label class="control-label" name="outPutFile" for="output">Output Location</label>
							<div class="controls">
								<input type="text" class="toBeGrabbed" name="outPutFile" id="outPutFile" placeholder="Output Location" required>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" name="outputPath" for="outputPath">Output Path</label>
							<div class="controls">
								<input type="text" class="toBeGrabbed" name="outputPath" id="outputPath" placeholder="Output Path" required>
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
								<input type="text" class="toBeGrabbed" name="libfname" id="libfname" placeholder="libfname">
								</select>
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
								<input type="text"  class="toBeGrabbed" name="estSeq" id="estSeq" placeholder="estSeq" required>
								</select>
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
						

</body>
</html>
