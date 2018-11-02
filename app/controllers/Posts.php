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
        if($validation->passed()  && $_SESSION['logged_in']) {

            if(!empty($params)) {
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
        $this->view->setViewData($validation->displayErrors());
        $this->view->render('posts/create');

    }

    public function show() {
   
        $this->view->setViewData($this->_db->find('posts'));
        $this->view->setLayout= 'default';
        $this->view->render('posts/showPosts');

    }

    public function create() {
        $this->view->setLayout('home');
        $this->view->render('posts/create');

    }

    public function edit() {
        if (isset($_POST['editPost'])) {
            $this->edit = true;
            $postID = $_POST["postNumber"];
            $results = $this->_db->findFirst('posts', [
                'conditions' => 'id = ?',
                'bind' => [$postID]]);
            $this->view->setviewData($results);
            $this->view->render('posts/create');
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