
<?php

// if (isset($_POST['editPost'])) {
//     $postID = $_POST["postNumber"];
//     $sqlQuery = "SELECT title, postText FROM posts WHERE postID = $postID";
//     $results = mysqli_query(Controller::config('dbConnect'), $sqlQuery);

//     $user = mysqli_fetch_assoc($results);
//     $postTitle = $user['title'];
//     $postText = $user['postText'];
// }
?>
<div class="postWrapper">
    <form action="<?=PROOT?>posts/store/<?php if(isset($_POST['postNumber'])) echo $_POST['postNumber'];?>" method="post">
    <!-- CHECK IF NOT ARRAYY -->
        <div class="bg-danger"><?php if(is_string($this->getViewData())) echo $this->getViewData(); ?></div>

        <label for="postTitle">Post title</label>
        <input type="text" id="postTitle" name="postTitle" placeholder="The title of your post"
        <?php if(is_object($this->getViewData())) {echo 'value="' . $this->getViewData()->title . '"';}?>>


        <label for="message">Message</label>
        <textarea id="message" name="message" placeholder="Your message.." rows="5" cols="50">
            <?php if(is_object($this->getViewData())) {echo $this->getViewData()->postText;}?>
        </textarea>
        <?php if(is_object($this->getViewData())) {
            echo '<input type="hidden" name="postNumber" value="' . $_POST['postNumber'] . '">'; 
        }
        ?>
        <button type="submit" class="postBtn" name="postButton">Submit post</button>

    
    </form>


</div>