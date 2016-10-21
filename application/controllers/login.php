<?php
/**
 * Created by PhpStorm.
 * User: hstancu
 * Date: 10/17/2016
 * Time: 9:11 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {

        try {
            $this->load->database();
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            echo 'Username: ';
            print_r($username);
            echo '<br>Password: ';
            print_r($password);

            //$array = array('username' => $username, 'password' => $password);

            //$query=$this->db->where($array);
            //$query = $this->db->where('username',$username)->where('password',$password);

            //$query = $this->db->get_where('user', array('username' => $username, 'password' => $password));
            echo 'SELECT username,password FROM user WHERE username="'.$username.'" AND password="'.$password.'"';
            //$query=$this->db->query('SELECT username,password FROM user WHERE username="'.$username.'" AND password="'.$password.'"');
            $query=$this->db->query('SELECT username FROM user');
            //$query=$this->db->query($hope);
            //$query=$this->db->query('SELECT username FROM user WHERE username="$username"');
            if($query->num_rows()>0) {
                echo "<br>Super";
                $records = $query->result();
                for($i=0; $i<count($records); $i++) {
                    $record = $records[$i];
                    echo "<br>------".$record->username.'<br>';
                }


                foreach ($query->result() as $row)
                {
                    echo "username".$row->username."<br>";
                }

            }



            else
                echo"<br>That's too bad";
            //$show  = $query->result_array();
            //echo $query;
            //echo $query->result();
            //echo $query->result_array();
            echo '<pre>';
            var_dump($query);
            //$this->db->where('username', $username);
            //$query = $this->db->get('user');            //SELECT * FROM user ( mysql table )
            //$users = $query->result_array();
            //print_r($users);
            die;
            /*$link = @mysqli_connect('localhost', 'root', 'Sta19Hor', 'upwego');
            if (!$link) {
                throw new Exception(' Cannot connect to DB');
            }
            if (empty($_POST["username"])) {
                throw new Exception("Umpleti campul 1");  // orice mesaj de eroare prind aici o sa il abordez in catch
            }
            if (($_POST["password"]) == '') {
                throw new Exception("Umpleti campul 2");  // orice mesaj de eroare prind aici o sa il abordez in catch
            }
            $query = mysqli_query($link, "SELECT * FROM user WHERE username='".$_POST['username']."'");
            if (mysqli_num_rows($query) < 1) {
                throw new Exception("Username or password not valid!!!");
            } else {
                $query = mysqli_query($link,"SELECT * FROM user WHERE username='".$_POST['username']."' AND password='".$_POST['password']."'");
                if (mysqli_num_rows($query) == 0) {
                    throw new Exception("Username or password not valid");
                } else {
                    $response = array(
                        'success' => true
                    );
                }
                $link->close();
            }*/
        } catch (Exception $e) {
            $response = array(
                "success" => false, // e o cheie de tip string success
                "msg" => $e->getMessage() // preiau mesajul "umpleti campul"
            );
        }
        echo json_encode($response);
    }
}

