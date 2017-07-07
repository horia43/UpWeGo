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
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {


        try {

            $this->load->database();
            $username = $this->input->post('username');
            $password = $this->input->post('password');


            $this->db->select("password");
            $this->db->where('username=', $username);
            $select = $this->db->get("user");
            if ($select->num_rows() == 0) {
                throw new Exception("Datele introduse nu sunt valide sau sesiunea a expirat!");
            } elseif ($select->num_rows() > 1) {
                throw new Exception("Eroare in baza de date. Vă rugăm adresati-vă personalului suport.");
            } elseif ($select->num_rows() == 1) {
                $pass = $select->result_array()[0]['password'];


                if (password_verify($password, $pass)) {


                    $query = $this->db->query('SELECT username,password,admin,email,active FROM user WHERE username="' . $username . '" AND password="' . $pass . '"');

                    /*
                     * $query = $this->db->get_where('user', array('username' => $username, 'password' => $password));
                     * */

                    /*$this->db->where('username', $username);
                    $this->db->where('password', $password);
                    $query = $this->db->get('user');*/

                    /*$this->db->where('username', $username);
                    $query = $this->db->get('user');            //SELECT * FROM user ( mysql table )
                    $users = $query->result_array();
                    echo '<pre>';
                    print_r($users);
                    echo '</pre>';
                    print_r($users);
                    die;*/

                    /*if ($query->num_rows() == 0) {
                        throw new Exception("Invalid input data.");
                    }
                    else{
                        $response = array(
                            "success" => true
                        );
                    }*/

                    if ($query->num_rows() == 0) {
                        throw new Exception("Datele introduse nu sunt valide sau sesiunea a expirat!");
                    } elseif ($query->num_rows() > 1) {
                        throw new Exception("Eroare in baza de date. Vă rugăm adresati-vă personalului suport.");
                    } elseif ($query->num_rows() == 1) {

                        if ($query->result_array()[0]['active'] == 0) {
                            throw new Exception("Va rugăm să vă activați contul accesând link-ul trimis pe email.");
                        }
                        $isAdmin = $query->result_array()[0]['admin']; /// Select from first result, the 'admin' property
                        $email = $query->result_array()[0]['email'];
                        if ($isAdmin) {
                            $response = array(
                                "success" => true,
                                "isAdmin" => true
                            );

                            $sessiondata = array(
                                'username' => $username,
                                'email' => $email,
                                'logged_in' => TRUE,
                                'isAdmin' => true,
                                'password' => $password
                            );
                            $this->session->set_userdata('logged_in', $sessiondata);
                        } else {

                            $response = array(
                                "success" => true,
                                "isAdmin" => false
                            );

                            $sessiondata = array(
                                'username' => $username,
                                'email' => $email,
                                'logged_in' => TRUE,
                                'password' => $password,
                                'isAdmin' => false
                            );

                            $this->session->set_userdata('logged_in', $sessiondata);
                        }
                    } else {
                        throw new Exception("Există o problemă. Va rugăm să contactați personalul suport.");
                    }
                } else {
                    throw new Exception("Datele introduse nu sunt valide sau sesiunea a expirat!");
                }
            }
            /*
                $link = @mysqli_connect('localhost', 'root', 'Sta19Hor', 'upwego');
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
                }
            */
        } catch (Exception $e) {
            $response = array(
                "success" => false, // e o cheie de tip string success
                "msg" => $e->getMessage() // preiau mesajul "umpleti campul"
            );
        }
        echo json_encode($response);
    }

    /*public function verify()
    {
        if (isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])) {
            $this->load->view('verify');
        } else {
            echo '<div class="statusmsg" style="margin:50px auto; width:450px;text-align:center;background: #ffd3db;color: #c40022;border: 3px solid;padding: 20px;margin-bottom: 20px;">
                    Invalid approach, please use the link that has been send to your email.</div>';
        }
    }*/
    /*        // Verify data
            $email = $_GET['email']; // Set email variable
            $hash = $_GET['hash']; // Set hash variable
            $this->load->database();

            $this->db->select('email,password');
            $this->db->where('email=', $email);
            $this->db->where('password=', $hash);
            $this->db->where('active=', 0);
            $select = $this->db->get("user");

            if ($select->num_rows() == 1) {
                $this->load->view('verify');
            } else {
                echo '<div class="statusmsg" style="margin:50px auto; width:450px;text-align:center;background: #ffd3db;color: #c40022;border: 3px solid;padding: 20px;margin-bottom: 20px;">
                    The url is either invalid or you already have activated your account.</div>';
            }
        } else {
            echo '<div class="statusmsg" style="margin:50px auto; width:450px;text-align:center;background: #ffd3db;color: #c40022;border: 3px solid;padding: 20px;margin-bottom: 20px;">
                    Invalid approach, please use the link that has been send to your email.</div>';
        }

    }*/


    public function verify()
    {
        if ($this->input->post()) {
            try {
                //if (isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])) {
                if (!empty($this->input->post('email')) && !empty($this->input->post('hash'))) {
                    $this->load->database();

                    $password = $this->input->post('current_pass');
                    $new_pass = $this->input->post('new_pass');
                    $new_pass2 = $this->input->post('new_pass2');

                    //$email = $_GET['email']; // Set email variable
                    //$hash = $_GET['hash']; // Set hash variable
                    $email = $this->input->post('email'); // Set email variable
                    $hash = $this->input->post('hash'); // Set hash variable

                    $this->db->select('email,password');
                    $this->db->where('email=', $email);
                    $this->db->where('password=', $hash);
                    $this->db->where('active=', 0);
                    $select = $this->db->get("user");
                    if ($select->num_rows() == 1) {
                        if(!password_verify($password, $hash)){
                            throw new Exception("Primul câmp nu corespunde cerințelor.");
                        }
                        if($new_pass != $new_pass2){
                            throw new Exception("Parolele nu se potrivesc.");
                        }
                        if(strlen($new_pass)<6 || strlen($new_pass2)<6){
                            throw new Exception("Vă rugăm să introduceți o parola ce are minim 6 caractere.");
                        }
                        $new_pass=password_hash($new_pass, PASSWORD_BCRYPT);
                        $data = array(
                            'password'  =>  $new_pass,
                            'active'    => 1
                        );
                        $this->db->where('email=', $email);
                        $this->db->where('password=', $hash);
                        $this->db->update('user', $data);

                        $response = array(
                            "success" => true, // e o cheie de tip string success
                            "msg" => "Activated"// preiau mesajul "umpleti campul"
                        );
                    } else {
                        throw new Exception("URL-ul accesat este invalid sau contul a fost deja validat.");
                        /*echo '<div class="statusmsg" style="margin:50px auto; width:450px;text-align:center;background: #ffd3db;color: #c40022;border: 3px solid;padding: 20px;margin-bottom: 20px;">
                        The url is either invalid or you already have activated your account.</div>';*/

                    }
                }else {
                    throw new Exception("Abordare invalidă, vă rugăm să folosiți link-ul trimis în e-mail.");
                    /* echo '<div class="statusmsg" style="margin:50px auto; width:450px;text-align:center;background: #ffd3db; color: #c40022;border: 3px solid;padding: 20px;margin-bottom: 20px;">
                         Invalid approach, please use the link that has been send to your email.</div>';*/
                }

            } catch
            (Exception $e) {
                $response = array(
                    "success" => false, // e o cheie de tip string success
                    "msg" => $e->getMessage()// preiau mesajul "umpleti campul"
                );

                /*echo '<div class="statusmsg" style="margin:50px auto; width:450px;text-align:center;background: #ffd3db; color: #c40022;border: 3px solid;padding: 20px;margin-bottom: 20px;">
                        '.$e->getMessage().'</div>';*/

            }
            echo json_encode($response);

        }else{
            $this->load->view('verify');
        }

    }


    public function logout()
    {
        try{
            $this->session->unset_userdata('logged_in');
            session_destroy();
            $response = array(
                "success"   => true,
                "msg"       => "merge"
            );
        }catch (Exception $e){
            $response = array(
                "success"   => false,
                "msg"       => "nu merge.."
            );
        }
        echo json_encode($response);

        //$this->load->view('login');
        //redirect('welcome', 'refresh');
    }

//    function activation()
//    {
//        try {
//            if (isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])) {
//                $this->load->database();
//                $password = $this->input->post('current_pass');
//                $new_pass = $this->input->post('new_pass');
//                $new_pass2 = $this->input->post('new_pass2');
//
//                $email = $_GET['email']; // Set email variable
//                $hash = $_GET['hash']; // Set hash variable
//
//                $this->db->select('email,password');
//                $this->db->where('email=', $email);
//                $this->db->where('password=', $hash);
//                $this->db->where('active=', 0);
//                $select = $this->db->get("user");
//                if ($select->num_rows() == 1) {
//                    if(!password_verify($password, $hash)){
//                        throw new Exception("Current password invalid.");
//                    }
//                    if($new_pass == $new_pass2){
//                        throw new Exception("Passwords don't match.");
//                    }
//                    $data = array(
//                        'active' => 1
//                    );
//                    $this->db->where('email=', $email);
//                    $this->db->where('password=', $hash);
//                    $this->db->update('user', $data);
//
//                    $response = array(
//                        "success" => true, // e o cheie de tip string success
//                        "msg" => "Activated"// preiau mesajul "umpleti campul"
//                    );
//                    echo '<div class="statusmsg" style="margin:50px auto; width:450px;text-align:center;background: #cdffc0;color: #0dc435;border: 3px solid;padding: 20px;margin-bottom: 20px;">
//                    Your account has been activated.</div>';
//                } else {
//                    throw new Exception("The url is either invalid or you already have activated your account.");
//                    /*echo '<div class="statusmsg" style="margin:50px auto; width:450px;text-align:center;background: #ffd3db;color: #c40022;border: 3px solid;padding: 20px;margin-bottom: 20px;">
//                    The url is either invalid or you already have activated your account.</div>';*/
//
//                }
//            }else {
//                throw new Exception("Invalid approach, please use the link that has been send to your email.");
//               /* echo '<div class="statusmsg" style="margin:50px auto; width:450px;text-align:center;background: #ffd3db; color: #c40022;border: 3px solid;padding: 20px;margin-bottom: 20px;">
//                    Invalid approach, please use the link that has been send to your email.</div>';*/
//            }
//
//        } catch
//        (Exception $e) {
//            $response = array(
//                "success" => false, // e o cheie de tip string success
//                "msg" => $e->getMessage()// preiau mesajul "umpleti campul"
//            );
//
//            /*echo '<div class="statusmsg" style="margin:50px auto; width:450px;text-align:center;background: #ffd3db; color: #c40022;border: 3px solid;padding: 20px;margin-bottom: 20px;">
//                    '.$e->getMessage().'</div>';*/
//
//        }
//        echo json_encode($response);
//    }

}

