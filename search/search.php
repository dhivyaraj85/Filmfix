<!DOCTYPE html>

<html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    </head>

    <body>

    
  
    <form name="button_click" role="form" action="search_db.php" method="POST" class="login-form">
    <div class="container">
	<div class="row">
        <div class="col-md-6">
    		<h2>Search Movies to Rate.</h2>
            <div id="custom-search-input">
                <div class="input-group col-md-12">
                    <input type="text" name="movie_name" class="form-control input-lg" placeholder="Movie ID or Name:" />
                    <span class="input-group-btn" onclick="search_db();">
                        <button class="btn btn-success btn-lg" type="button" onclick="search_db();">
                            <i class="glyphicon glyphicon-search" onclick="search_db();" ></i>
                        </button>
                    </span>
                </div>

            </div>
        </div>
	</div>
</div>
</form>

<script>
        function search_db() {
            
            document.forms['button_click'].action = 'search_db.php';
            document.forms['button_click'].method ='POST'; 
            document.forms['button_click'].submit();
            
        }
        </script>  
</body>

</html>
