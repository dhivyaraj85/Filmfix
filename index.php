<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Filmfix Login</title>

    <!-- CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/form-elements.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <link rel="shortcut icon" href="assets/ico/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>

<body>
<form name="button_click" role="form" action="home.php" method="POST" class="login-form">
    <!-- Top content -->
    <div class="inner-bg">
    <div class="container">
    <div class="row">
       <div class="col-sm-5 col-sm-offset-3 text">
       <div class="panel with-nav-tabs panel-info">
          <div class="panel-heading">
             <ul class="nav nav-tabs">
                <li class="active"><a href="#login" data-toggle="tab"> Login </a></li>
                <li><a href="#signup" data-toggle="tab"> Signup </a></li>
             </ul>
          </div>

          <div class="panel-body">
             <div class="tab-content">
           
                <div id="login" class="tab-pane fade in active register">
                   <div class="container-fluid">
                      <div class="row">
                            <h2 class="text-center" style="color: #5cb85c;"> <strong> Login  </strong></h2><hr />

                            <div class="row">
                               <div class="col-xs-12 col-sm-6 col-md-12">
                                  <div class="form-group">
                                     <div class="input-group">
                                        <div class="input-group-addon">
                                           <span class="glyphicon glyphicon-user"></span>
                                        </div>
                                        <input type="text" placeholder="User ID" name="form-username" class="form-control" id="form-username">
                                     </div>
                                  </div>
                               </div>
                            </div>

                            <div class="row">
                               <div class="col-xs-12 col-sm-12 col-md-12">
                                  <div class="form-group">
                                     <div class="input-group">
                                        <div class="input-group-addon">
                                           <span class="glyphicon glyphicon-lock"></span>
                                        </div>

                                        <input type="password" placeholder="Password" name="pass" class="form-control">
                                     </div>
                                  </div>
                               </div>
                            </div>
                            <hr />
                           
                            <div class="row">
                               <div class="col-xs-12 col-sm-12 col-md-12">
                                  <button type="submit" class="btn btn-success btn-block btn-lg" onclick="existing_user()"> Login </button>
                               </div>
                            </div>
                         

                      </div>
                   </div> 
                </div>
             
              
                <div id="signup" class="tab-pane fade">
                   <div class="container-fluid">
                      <div class="row">
                            <h2 class="text-center" style="color: #f0ad4e;"> <Strong> Register </Strong></h2> <hr />
                               <div class="row">
                                  <div class="col-xs-12 col-sm-12 col-md-12">
                                     <div class="form-group">
                                        <div class="input-group">
                                           <div class="input-group-addon iga1">
                                              <span class="glyphicon glyphicon-user"></span>
                                           </div>
                                           <input type="text" class="form-control" placeholder="Enter User ID" name="form-new-username" id="form-new-username">
                                        </div>
                                     </div>
                                  </div>
                               </div>
                               <div class="row">
                                  <div class="col-xs-12 col-sm-12 col-md-12">
                                     <div class="form-group">
                                        <div class="input-group">
                                           <div class="input-group-addon iga1">
                                              <span class="glyphicon glyphicon-lock"></span>
                                           </div>
                                           <input type="password" class="form-control" placeholder="Enter Password" name="pass">
                                        </div>
                                     </div>
                                  </div>
                               </div>
                               <hr>
                               <div class="row">
                                  <div class="col-xs-12 col-sm-12 col-md-12">
                               
                                     <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-block btn-warning" onclick="new_user()"> Register</button>
                                     </div>
                                    
                                  </div>
                               </div>
                      </div>
                   </div>
                 
                </div>
                
             </div>
          </div>
       </div>
    </div>
 </div>
</div>


</form>
    <!-- Javascript -->
    <script src="assets/js/jquery-1.11.1.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.backstretch.min.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script>
        function new_user() {
            
            document.forms['button_click'].action = 'pagination-php/signup.php';
            document.forms['button_click'].method ='POST'; 
            document.forms['button_click'].submit();
            
        }
        function existing_user() {
            
            document.forms['button_click'].action = 'home.php';
            document.forms['button_click'].method ='POST'; 
            document.forms['button_click'].submit();
            
        }

        
    </script>
    <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

</body>

</html>