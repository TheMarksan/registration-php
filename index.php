<?php
    include("database.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proxeto</title>
</head>
<body>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
        <h2>Bem-Vindo ao PHP puro!</h2>
        Username:<br>
        <input type="text" name="username" id="username"><br>
        Password:<br>
        <input type="password" name="password" id="password"><br>
        <button type="submit" name="submit" value="register">Register</button>


    </form>
</body>
</html>

<?php

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

        // $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        // $result = mysqli_query($conn, $sql);

        // if(mysqli_num_rows($result) > 0){
        //     echo "Login efetuado com sucesso!";
        // }else{
        //     echo "Login falhou!";
        // }

        if(empty($username) || empty($password)){
            echo "Preencha todos os campos!";
        }else{
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (user, password) VALUES ('$username', '$hash')";

            try{
                mysqli_query($conn, $sql);
                echo "Registo efetuado com sucesso!<br>";
            }
            catch(mysqli_sql_exception $e){
                echo "Já existe!<br>";
            }   

        }
    }

    mysqli_close($conn);
?>