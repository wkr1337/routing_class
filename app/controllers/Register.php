<?php

class Register extends Controller {

    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
        $this->view->setLayout('default');
    }

    public function index() {
        $this->view->render('register/login');

    }

    public function login() {
        $validation = new Validate();

        if($_POST) {
            // form validation
            // $validation = true;

            $validation->check($_POST, [
                'username' => [
                    'display' => "Username",
                    'required' => true],
                'password' => [
                    'display' => 'Password',
                    'required' => true,
                    'min' => 0]
            ]);


            if ($validation->passed()) {
                // check if user exists in database
                $user = $this->_db->findFirst('users', ['conditions' => 'username = ?', 'bind' => [$_POST['username']]]);
                if($user) {
                    // check if passwords match of given password and the password out of the database of the given username
                    if($user->password == $_POST['password']) {
                        $_SESSION['logged_in'] = true;
                        $_SESSION['userID'] = $user->id;
                        Router::redirect('');
                    }else {
                        $validation->addError("Your password does not match");
                    
                    }

                } else {
                    $validation->addError("The given username was not found in the database.");
                }
            }
        }
        $this->view->displayErrors = $validation->displayErrors();
        $this->view->setLayout= 'default';
        
        $this->view->render('register/login');
    }

    public function logout() {
        if(isset($_SESSION['logged_in'])) {
            $_SESSION['logged_in'] = false;
            Router::redirect('');
        }
    }

    public function register() {
        $validation = new Validate();
        if($_POST) {

            $validationArray = [
                'username' => [
                    'display' => "Username",
                    'required' => true],
                'email' => [
                    'display' => 'Email',
                    'required' => true,
                    'valid_email' =>true],
                'password_1' => [
                    'display' => 'Password One',
                    'required' => true,
                    'min' => 3],
                'password_2' => [
                    'display' => 'Password Two',
                    'required' => true,
                    'min' => 3]
                
                ];


            $validation->check($_POST, $validationArray);

            if ($validation->passed()) {
                if($_POST['password_1'] == $_POST['password_2']) {
                    // insert into
                    $this->_db->insert('users',[
                        'username' => $_POST['username'],
                        'email' => $_POST['email'],
                        'password' => $_POST['password_1']
                        ]);
                        Router::redirect('');

                } else {
                    $validation->addError("Your passwords do not match");
                
                }


            }
        }

        $this->view->displayErrors = $validation->displayErrors();
        $this->view->setLayout= 'default';
        
        $this->view->render('register/register');
    }

}