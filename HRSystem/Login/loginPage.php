<!DOCTYPE html>
<html>
	<head>
		<link href="../includes/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="../includes/style/loginStyle.css" rel="stylesheet" type="text/css">
		<script type = "text/javascript" src = "../includes/javascript/functions.js"></script>
	</head>
	
   <body>
        <div class="container">
            <div class="row vertical-offset-100">
                <div class="col-md-4 col-md-offset-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">                                
                            <div class="row-fluid user-row">
								<img src="../includes/style/thumbnail_FZ_logo.jpg" class="img-responsive" alt="Firezetta Sdn. Bhd."/>
							</div>
						</div>
						<div class="panel-body">	
							<form id = "loginForm" role = "form" class = "form-signin" name = "loginForm" method = "POST" 
								action = "<?= $_SERVER['PHP_SELF'] ?>" onsubmit = "return validateInput('form-control')" >
								<fieldset>
									<h3>Firezetta Sdn. Bhd.</h3>
									
									<input class="form-control" placeholder="Username" name = "username" id="username" type="text">
									<input class="form-control" placeholder="Password" name = "password" id="password" type="password">
									<span class = "error" id = "errLogin"><?= $errorMessage ?></span>
									<br></br>

									<input class="btn btn-lg btn-success btn-block" type="submit" id="login" value="Login »">
								</fieldset>
							</form>
						</div>
                    </div>
                </div>
            </div>
        </div>
	</body>
</html>