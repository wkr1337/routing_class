<?php $this->start('head'); ?>
<?php $this->end(); ?>
<?php $this->start('body'); ?>
<?php 
$htmlString = "";
// dnd($this->getViewData());
// dnd($this->getViewData()[0]->title);
// echo gettype($this->getViewData()[0]); die();
// if($this->getViewData()) {
    foreach($this->getViewData() as $postResult) {
        // dnd($postResult->title);
        $htmlString.='<div class="contact-form-wrapper">';
        $htmlString.='<div class="card">';
        
        $htmlString.='<h2>' . $postResult->title . '</h2>';
        $htmlString.='<h5>' . $postResult->title . ' Post created at: ' . $postResult->postDate . '</h5>';
        // echo '<div class="fakeimg" style="height:200px;">Image</div>';
        $htmlString.='<p>' . $postResult->postText . '</p>';
        $htmlString.='<sub>Last edited at: ' . $postResult->editDate . '</sub>';

        if ($_SESSION['logged_in']) {
            if ($postResult->userID == $_SESSION['userID']) {
// passsssss post idddd as parameeeters
                $htmlString.='<form action="' . PROOT.'posts/edit/'.$postResult->id.'" method="post">
                        <input type="hidden" name="postNumber" value="' . $postResult->id . '">  

                        <input type="submit" name="editPost" value="Edit post" />
                    </form>';
                    $htmlString.='<form action="'.PROOT.'posts/delete/'.$postResult->id.'" method="post">
                    <input type="hidden" name="deletePostNumber" value="' . $postResult->id . '">  

                        <input type="submit" name="deletePost" value="Delete post" />
                    </form>';
                // echo '<button type="submit" name="editPost">Edit</button>';
                // echo '<button type="submit" name="deletePost">Delete</button>';
            }
        }
        $htmlString.='</div></div>';
    }
// }
echo $htmlString; 
?>