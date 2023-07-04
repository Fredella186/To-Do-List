<html>
    <head>
        <title>Login Page</title>
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        
        <div class="main_login">
           
            <form class="form" method="post" action="sv_login.php";>
                <div class="text4 white black">
                <h1 style="text-align:center">Login</h1>
                </div>
                <div class="text4 white bold">
                <input type="email" name="email" id="email" placeholder="Email" ><br><br>
                <span class="error"> </span>
                <input type="password" name="password" id="password" placeholder="Password" ><br><br>
                <span class="error"> </span>
                <input type="submit" name="submit" id="submit" class="submit"    onclick="window.location.href= 'inside.php'"; >
                </div>
            </form>
            <?php

            if(isset($error)){
                foreach($error as $error){
                    echo '<span class="error-msg">' .$error. '</span>';
                };
            };
            ?>
        </div>
    </body>
</html>
