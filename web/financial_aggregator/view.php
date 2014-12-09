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

        <title>Paypal</title>

        <!-- Bootstrap core CSS -->
        <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/signin.css" rel="stylesheet">

        <link href="css/my-css.css" rel="stylesheet">


    </head>

    <body>

    <div class="container">
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

?>