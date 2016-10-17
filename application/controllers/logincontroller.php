<?php
/**
 * Created by PhpStorm.
 * User: hstancu
 * Date: 10/17/2016
 * Time: 9:11 PM
 */
try{
    $link = @mysqli_connect('localhost','root','Sta19Hor','upwego');
    if(!$link){
        throw new Exception(' Cannot connect to DB' );
    }
    mysqli_select_db($link , "first"); // Use DB
    if(empty($_POST["username"])){
        throw new Exception("Umpleti campul 1");  // orice mesaj de eroare prind aici o sa il abordez in catch
    }
    if(($_POST["password"])==''){
        throw new Exception("Umpleti campul 2");  // orice mesaj de eroare prind aici o sa il abordez in catch
    }
    $query = mysqli_query($link, "SELECT * FROM user WHERE username='".$_POST['username']."'");
    if(mysqli_num_rows($query) == 0){
        throw new Exception("Username or password not valid");
    }else{
        $query=mysqli_query($link, "SELECT * FROM user WHERE username='".$_POST['username']."' AND password='".$_POST['password']."'");
        if(mysqli_num_rows($query) == 0) {
            throw new Exception("Username or password not valid");
        }else{
            $response = array(
                'success'=>true
            );
        }
        $link->close();
    }
}catch(Exception $e){
    $response = array(
        "success" => false, // e o cheie de tip string success
        "msg" => $e->getMessage() // preiau mesajul "umpleti campul"
    );
}
echo json_encode($response);

?>
