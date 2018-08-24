<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">

        <title>ระบบเก็บข้อมูลสมุนไพร</title>

        <!-- Bootstrap core CSS -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="bootstrap/css/bootflat.min.css" rel="stylesheet" type="text/css"/>
        <script src="bootstrap/js/jquery.min.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <style>
            html,
            body {
                overflow-x: hidden; /* Prevent scroll on narrow devices */
            }
            body {
                padding-top: 70px;
            }
            footer {
                padding: 30px 0;
            }

            /*
             * Off Canvas
             * --------------------------------------------------
             */
            @media screen and (max-width: 767px) {
                .row-offcanvas {
                    position: relative;
                    -webkit-transition: all .25s ease-out;
                    -o-transition: all .25s ease-out;
                    transition: all .25s ease-out;
                }

                .row-offcanvas-right {
                    right: 0;
                }

                .row-offcanvas-left {
                    left: 0;
                }

                .row-offcanvas-right
                .sidebar-offcanvas {
                    right: -50%; /* 6 columns */
                }

                .row-offcanvas-left
                .sidebar-offcanvas {
                    left: -50%; /* 6 columns */
                }

                .row-offcanvas-right.active {
                    right: 50%; /* 6 columns */
                }

                .row-offcanvas-left.active {
                    left: 50%; /* 6 columns */
                }

                .sidebar-offcanvas {
                    position: absolute;
                    top: 0;
                    width: 50%; /* 6 columns */
                }
            }
        </style>
    </head>

    <body>
        <nav class="navbar navbar-fixed-top navbar-default">
            <div class="container">

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">ระบบเก็บข้อมูลสมุนไพร</a>
                </div>

                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">

                        <li class="active"><a href="index.php"><strong>หน้าแรก</strong></a></li>
                        <li><a href=""></a></li>
                        <!--<li><a href="frm_login.php"><span class="glyphicon glyphicon-log-in"></span>  เข้าสู่ระบบ</a></li>-->

                        <form class="navbar-form navbar-right" role="search">
                            <a href="frm_login.php" class="btn btn-normal">เข้าสู่ระบบ</a>
                        </form>

                    </ul>
                </div><!-- /.nav-collapse -->

            </div><!-- /.container -->
        </nav><!-- /.navbar -->

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <script>
            $(document).ready(function () {
                $('[data-toggle="offcanvas"]').click(function () {
                    $('.row-offcanvas').toggleClass('active')
                });
            });
        </script>
    </body>
</html>
