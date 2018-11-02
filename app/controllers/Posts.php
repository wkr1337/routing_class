<?php 

class Posts extends Controller {
    private $_softDelete=true;
    public $showPosts;
    public $edit = false;
    
    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
    }
    public function index() {
        $this->show();
    }
    

    public function store($params=[]) {
        $validation = new Validate();
        // die();
        // $postTitle = Input::sanitize(trim($_POST['postTitle']));
        // $message = Input::sanitize(trim($_POST['message']));
        if($_POST) {
            $validation->check($_POST, [
                'postTitle' => [
                    'display' => 'Post title',
                    'required' => true
                ],
                'message' => [
                    'display' => 'message',
                    'required' => true

                ]
                ]);
        }
        // dnd($validation->passed());
        if($validation->passed()  && $_SESSION['logged_in']) {
            // dnd($validation->passed());
            // dnd($_SESSION['userID']);
            if(!empty($params)) {
                // dnd($params);
                // check if logged in and check if user id = postUserID
                $findFirstResult = $this->_db->findFirst('posts', [
                    'conditions' => 'id = ?',
                    'bind' => [$params]
                ]);
                if($findFirstResult->userID == $_SESSION['userID']) {
                    $this->_db->update('posts', $params, [
                        'title' => $_POST['postTitle'],
                        'postText' => $_POST['message'],
                        'editDate' => date("Y-m-d H:i:s")
                    ] );
                } else {
                    $validation->addError("The post you are trying to edit doesn't belong to you.");
                }
                
                
                
            } else {
            $this->_db->insert('posts',[
                'userID' => $_SESSION['userID'],
                'title' => $_POST['postTitle'],
                'postText' => $_POST['message'],
                'postImg' => null,
                'postDate' => date("Y-m-d H:i:s"),
                'editDate' => date("Y-m-d H:i:s")
            ]);
            }

            
            Router::redirect('posts/show');
        }
        // dnd($validation->displayErrors());
        $this->view->setViewData($validation->displayErrors());
        // dnd($this->view->getViewData());
        $this->view->render('posts/create');

        // dnd("NOT SO SUCCESSFULL");
    }

    public function show() {
        // $sqlQuery = "SELECT * FROM posts ORDER BY postDate desc";
        // self::$showPosts = mysqli_query($db, $sqlQuery);
        // $this->$showPosts = $this->_db->find('posts');
        // dnd($this->$showPosts);
        $this->view->setViewData($this->_db->find('posts'));
        // dnd($this->view->getViewData());
        $this->view->setLayout= 'default';
        $this->view->render('posts/showPosts');

    }

    public function create() {
        // $fields = ['user_name' => 'hallo', 'email' => 'emailAdres@sssss'];

        $this->view->setLayout('home');
        $this->view->render('posts/create');

    }

    public function edit() {
        if (isset($_POST['editPost'])) {
            $this->edit = true;
            $postID = $_POST["postNumber"];
            // dnd($postID);
            $results = $this->_db->findFirst('posts', [
                'conditions' => 'id = ?',
                'bind' => [$postID]]);
            // dnd($results);
            $this->view->setviewData($results);
            $this->view->render('posts/create');
            // dnd($results);
        }


    }
    
    public function delete($id='') {
        $validation = new Validate();

        if($id != '' && $_SESSION['logged_in']) {
            $userCheck = $this->_db->findFirst('posts', [
                'conditions' => 'id = ?',
                'bind' => [$id]
            ]);
            if($userCheck->userID == $_SESSION['userID']) {
                $this->_db->delete('posts', $id);
                Router::redirect('posts/show');
            } else {
                $validation->addError("The post you are trying to delete doesn't belong to you.");
            }
        }
        $this->view->setViewError($validation->displayErrors());
        Router::redirect('posts/show');
    }

}