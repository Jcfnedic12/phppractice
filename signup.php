<?php 
require_once('connection.php');

class signupdbconnector extends connection{

   function singupprocess($username, $password,$contactnumber){

    $stmt = $this->connect()->prepare("INSERT INTO pdolesson (Username, Password, ContacNumber) VALUES (?,?,?) ");

    $encrypted = password_hash($password,PASSWORD_DEFAULT);


    $stmt->execute([$username,$encrypted,$contactnumber]);

    


   }

   function checkuser($username){

        $stmt = $this->connect()->prepare("SELECT * FROM pdolesson WHERE Username = ?");

        $stmt->execute([$username]);

        $fetch = $stmt->fetchAll();


        $result = false;

        foreach($fetch as $data){
            if($data['Username'] == $username){
                $result = true;
            }
            else{
                $result = false;
            }
        }

        return $result;

   }

}

class contentchecker extends signupdbconnector{
    protected $username;
    protected $password;
    protected $contactnumber;

    function __construct($username,$password,$contactnumber)        
    {
        $this->username = $username;
        $this->password = $password;
        $this->contactnumber = $contactnumber;
    }

    
    
    function usernamechecker(){
        $value = true;
        
        
        if(empty($this->username)){
            return $value = false;
        
        }else{
            return $value = true;
        }
    }

    function passwordchecker(){
        $value = true;

        if(empty($this->password)){
            
            return $value = false;
        }else{
            return $value = true;
        }
    }

    function contactnumberchecker(){
        $value = true;

        if(empty($this->contactnumber)){
            return $value = false;
        }else{
            return $value = true;
        }
    }

    function emptyfieldfilter(){
        $value = true;

        if($this->checkuser($this->username)==true){
            echo 'username exists';

            return $value = false;
        }

        if($this->usernamechecker()==false){
            echo "username textfield is empty";

            return $value = false;
        }
        if($this->passwordchecker()==false){
            echo "password textfield is empty";
            return $value = false;
        }
        if($this->contactnumberchecker()==false){
            echo "contactnumber textfield is empty";
            return $value = false;
        }
        if($value == true){

            $this->singupprocess($this->username,$this->password,$this->contactnumber);

            echo "tingin nga kung nakapasok";
        }
    }
}




if(isset($_POST['signclick'])){
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $contactnumber = htmlspecialchars($_POST['contactnumber']);
   
    $signupfinisher = new contentchecker($username,$password,$contactnumber);

    $signupfinisher->emptyfieldfilter();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cssfolderforpdoaral\signup.css">
    <title>signup</title>
</head>
<body>
    <header class="headersect">

        <h1>Signup</h1>
        <ul class="ulforsignup">
                <li><a href="signup.php">signup</a></li>
                <li><a href="login.php">login</a></li>
                <li><a href="index.php">index</a></li>
            </ul>
    </header>
    <section class="formsection">


        <form action="signup.php" method="post" name="loginform" class="signupform">
            <div class="userdiv"><label for="username">Enter Username:</label><input type="text" name="username"  placeholder="Enter Valid Username"  class="userinput"></div>
    
            <div class="userdiv"><label for="password">Enter Password:</label><input type="password" name="password"  placeholder="Enter Valid Password" class="userinput"></div>
    
            <div class="userdiv"><label for="contactnumber">Enter Contact Number:</label><input type="text" name="contactnumber"  placeholder="Enter Valid contact number" class="userinput"></div>
            
    
            <div class="btndiv"><input type="submit" value="signup now" name="signclick" class="btninp"></div>
        </form>
    </section>
</body>
</html>