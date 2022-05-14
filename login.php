<?php
require_once ('connection.php');
// $host = "localhost";
// $username = "root";
// $password = "";
// $dbname = "pdoaral";

// $dsn = "mysql:host=$host;dbname=$dbname";

// $pdo = new PDO($dsn, $username, $password);
// $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
// $stmt = $pdo->query("SELECT * FROM pdolesson");


// while($row = $stmt->fetch()){
//     echo $row->Username;
// }
// $contacNumber = "09456312";
// $sql = "SELECT * FROM pdolesson WHERE ContacNumber = ?";

// $stmt = $pdo->prepare($sql);
// $stmt->execute([$contacNumber]);
// $userData = $stmt->fetchAll();

// foreach($userData as $userftched){
//     echo $userftched->Username." ". $userftched->Password;
// }

class datapuller extends connection{
    function datagatherer($username,$password){
        $stmt =  $this->connect()->prepare("SELECT * FROM pdolesson WHERE Username = ?  AND Password = ?");

        $stmt->execute([$username,$password]);

        $row = $stmt->fetchAll();

        var_dump($row[0]);
        // $rowusername = $row[0]['Username'];

        // echo $rowusername."<br> "; 
        if (!empty($row)){

            echo"ayaww gumana";
            foreach($row as $rowlist){
                echo $rowlist['Username']." " . $rowlist['Password'];

            }
        }else{
            echo $username." ". $password."-- eto ung laman ng else statment" ."<br>";

            $sql = $this->connect()->query("SELECT * FROM pdolesson");

            $rowerror = $sql->fetchAll();

            foreach ($rowerror as $rowlister ) {
                echo $rowlister['Username']. " ". $rowlister['Password']." -- eto ung laman ng database ko"."<br>";
            }

            
        }
        

    }

}

class dataFilter extends datapuller{

    protected $username;
    protected $password;

    function __construct($usernamedata, $userpassdata)
    {
        $this->username = $usernamedata;
        $this->password = $userpassdata;

    }

    function datachecking(){
        
        if(empty($this->username) || empty($this->password)){
            echo "there's an empty field";
        }else{
           $this->datagatherer($this->username, $this->password);

           echo $this->username." ". $this->password. "-- eto ung laman nung class na gamit ko pangcheck if empty ung username or password" ."<br>";
        }

    }
}

if(isset($_POST['loginbutton'])){
    $usernamedata = htmlspecialchars($_POST['username']);
    $userpassdata = htmlspecialchars($_POST['userpassword']);
    
    $datapasser = new dataFilter($usernamedata, $userpassdata);

    
     
    $datapasser->datachecking();


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cssfolderforpdoaral\login.css">
    <title>Document</title>
</head>
<body>
    <header>
        <h1>Log in page</h1>
        <ul class="loginul">
            <li><a href="signup.php">signup</a></li>
            <li><a href="login.php">login</a></li>
            <li><a href="index.php">index</a></li>
        </ul>
    </header>
    <div class="formdiv">
        <form action="login.php" method="post" name="Loginform" class="formpart">
            
            <div class="forminputdiv">

                <h2>Log in now →</h2>
            </div>
            <div class="forminputdiv">
                <label for="username">Enter Username</label>
                <input type="text" name="username" id="" placeholder="Enter valid username">

            </div>
            <div class="forminputdiv">

                <label for="userpassword">Enter password:</label>   
                <input type="password" name="userpassword" id="" placeholder="Enter valid password">
            </div>
           <div class="forminputsubmit">

               <input type="submit" value="Login" name="loginbutton" class="submitbtn">
           </div>
        </form>
    </div>
</body>
</html>