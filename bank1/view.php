<?php
	function printHeader() {
		?>
						<!DOCTYPE html>
			<!-- saved from url=(0040)http://getbootstrap.com/examples/signin/ -->
			<html lang="en">

			<head>
			    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			    <meta charset="utf-8">
			    <meta http-equiv="X-UA-Compatible" content="IE=edge">
			    <meta name="viewport" content="width=device-width, initial-scale=1">
			    <meta name="description" content="">
			    <meta name="author" content="">
			    <link rel="icon" href="http://getbootstrap.com/favicon.ico">

			    <title>Citibank</title>

			    <!-- Bootstrap core CSS -->
			    <link href="css/bootstrap.min.css" rel="stylesheet">

			    <!-- Custom styles for this template -->
			    <link href="css/signin.css" rel="stylesheet">

			</head>

			<body>

			    <div class="container">
		<?php
	}

	function printLoginForm() {
		?>
			<form class="form-signin" role="form" _lpchecked="1" method="POST">
            <object type="image/svg+xml" data="image/citibank.svg">CITIBANK</object>

            <h2 class="form-signin-heading">Sign in</h2>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input id="inputEmail" name="username" class="form-control" placeholder="Username" required="" autofocus="" style="cursor: auto; background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3QsPDhss3LcOZQAAAU5JREFUOMvdkzFLA0EQhd/bO7iIYmklaCUopLAQA6KNaawt9BeIgnUwLHPJRchfEBR7CyGWgiDY2SlIQBT/gDaCoGDudiy8SLwkBiwz1c7y+GZ25i0wnFEqlSZFZKGdi8iiiOR7aU32QkR2c7ncPcljAARAkgckb8IwrGf1fg/oJ8lRAHkR2VDVmOQ8AKjqY1bMHgCGYXhFchnAg6omJGcBXEZRtNoXYK2dMsaMt1qtD9/3p40x5yS9tHICYF1Vn0mOxXH8Uq/Xb389wff9PQDbQRB0t/QNOiPZ1h4B2MoO0fxnYz8dOOcOVbWhqq8kJzzPa3RAXZIkawCenHMjJN/+GiIqlcoFgKKq3pEMAMwAuCa5VK1W3SAfbAIopum+cy5KzwXn3M5AI6XVYlVt1mq1U8/zTlS1CeC9j2+6o1wuz1lrVzpWXLDWTg3pz/0CQnd2Jos49xUAAAAASUVORK5CYII=); background-attachment: scroll; background-position: 100% 50%; background-repeat: no-repeat;">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required="" style="cursor: auto; background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3QsPDhss3LcOZQAAAU5JREFUOMvdkzFLA0EQhd/bO7iIYmklaCUopLAQA6KNaawt9BeIgnUwLHPJRchfEBR7CyGWgiDY2SlIQBT/gDaCoGDudiy8SLwkBiwz1c7y+GZ25i0wnFEqlSZFZKGdi8iiiOR7aU32QkR2c7ncPcljAARAkgckb8IwrGf1fg/oJ8lRAHkR2VDVmOQ8AKjqY1bMHgCGYXhFchnAg6omJGcBXEZRtNoXYK2dMsaMt1qtD9/3p40x5yS9tHICYF1Vn0mOxXH8Uq/Xb389wff9PQDbQRB0t/QNOiPZ1h4B2MoO0fxnYz8dOOcOVbWhqq8kJzzPa3RAXZIkawCenHMjJN/+GiIqlcoFgKKq3pEMAMwAuCa5VK1W3SAfbAIopum+cy5KzwXn3M5AI6XVYlVt1mq1U8/zTlS1CeC9j2+6o1wuz1lrVzpWXLDWTg3pz/0CQnd2Jos49xUAAAAASUVORK5CYII=); background-attachment: scroll; background-position: 100% 50%; background-repeat: no-repeat;">
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        	</form>
		<?php
	}

	function printFooter() {
		?>
			</div>
		    <!-- /container -->


		    <script id="hiddenlpsubmitdiv" style="display: none;"></script>
		    <script>
		        try {
		            for (var lastpass_iter = 0; lastpass_iter < document.forms.length; lastpass_iter++) {
		                var lastpass_f = document.forms[lastpass_iter];
		                if (typeof (lastpass_f.lpsubmitorig2) == "undefined") {
		                    lastpass_f.lpsubmitorig2 = lastpass_f.submit;
		                    lastpass_f.submit = function () {
		                        var form = this;
		                        var customEvent = document.createEvent("Event");
		                        customEvent.initEvent("lpCustomEvent", true, true);
		                        var d = document.getElementById("hiddenlpsubmitdiv");
		                        if (d) {
		                            for (var i = 0; i < document.forms.length; i++) {
		                                if (document.forms[i] == form) {
		                                    d.innerText = i;
		                                }
		                            }
		                            d.dispatchEvent(customEvent);
		                        }
		                        form.lpsubmitorig2();
		                    }
		                }
		            }
		        } catch (e) {}
		    </script>
		</body>

		</html>
	<?php
	}

	function printBalance($user, $balance) {
		?>
		<form class="form-signin my-form" _lpchecked="1" method="POST">

            <center>
                <object type="image/svg+xml" data="image/citibank.svg">CITIBANK</object>
            </center>

            <h2 class="form-signin-heading">Welcome, <span id="username" class="default_text"><?php echo $user; ?></span></h2>

            <h2 class="form-signin-heading">Account Balance: <span id="balance" class="default_text"><?php echo $balance; ?></span></h2>

            <h2 class="form-signin-heading" style="margin-top:30px;"></h2>

            <input type="submit" class="btn btn-lg btn-primary btn-block" data-toggle="modal" data-target=".bs-example-modal-sm" value="Logout">
            <input type='hidden' value='true' name='logout'>
        </form>
        <?php
	}

	function printLogout() {
		?>
		<form class="form-signin my-form" _lpchecked="1" method="POST">
            <input type="submit" class="btn btn-lg btn-primary btn-block" data-toggle="modal" data-target=".bs-example-modal-sm" value="Logout">
            <input type='hidden' value='true' name='logout'>
        </form>
        <?php
	}

	function printAuthorize() {
		?>
		<form class="form-signin my-form" _lpchecked="1" method="POST">
            <center>
                <object type="image/svg+xml" data="image/citibank.svg">CITIBANK</object>
            </center>

            <h2 class="form-signin-heading">Please, confirm your request:</h2>

            <h2 class="form-signin-heading"></h2>
            <input type="submit" name="authorized" class="btn btn-lg btn-primary btn-block" data-toggle="modal" data-target=".bs-example-modal-sm" value="Authorize card on Paypal">

            <h2 class="form-signin-heading"></h2>
       	</form>

		<?php

	}
?>
