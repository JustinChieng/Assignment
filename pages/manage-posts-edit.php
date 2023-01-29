<?php
// make sure only admin can access
    if ( !Authentication::whoCanAccess('user') ) {
        header('Location:/dashboard');
        exit;
    }
    
//load post data
    $post_dt = POST::getPostById( $_GET['id'] );
    
// step 1: set CSRF token   
    CSRF::generateToken('edit_post_form');

// step 2: make sure post request
if ( $_SERVER ["REQUEST_METHOD"] === 'POST' )
    {
        //if both password & confirm_password fields are empty
        //skip error checking for both fields.
        $rules=[
            'post-title'=>'required',
            'status' => 'required',
            'csrf_token'=>'edit_post_form',
        ];

        // if eiter password & confirm_password fields are not empty, 
        // do error check for both fields

        $error = FORMVALIDATION::validate(
            $_POST,
            $rules
        );

        if ( !$error ){
            // step 4: update user  
            POST::update(
                $post_dt['id'], //id
                $_POST['status'],//status
                $_POST['post-title'],//title
                $_POST['post-content'],//content
            );


            // step 5: remove the CSRF token
            CSRF::removeToken( 'edit_user_form' );


            // step 6:redirect to manage users page
            header('Location: /manage-posts');
            exit;
    }
}


    require dirname(__DIR__) . '/parts/header.php';
?>

<div class="container mx-auto my-5" style="max-width: 700px;">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Edit Post</h1>
    </div>
    <div class="card mb-2 p-4">
        <?php require dirname( __DIR__ ) . '/parts/error_box.php'; ?>
        <form method="POST" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
            <div class="mb-3">
                <label for="post-title" class="form-label">Title</label>
                <input type="text" class="form-control" id="post-title" name="post-title"
                    value="<?php echo $post_dt['title']; ?>" />
            </div>
            <div class="mb-3">
                <label for="post-content" class="form-label">Content</label>
                <textarea class="form-control" id="post-content" name="post-content"
                    rows="10"><?php echo $post_dt['content']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="post-content" class="form-label">Status</label>
                <select class="form-control" id="post-status" name="status">
                    <option value="pending" <?php echo ( $post_dt['status'] == 'pending' ? 'selected' : '' ); ?>>
                        Pending for Review</option>
                    <option value="publish" <?php echo ( $post_dt['status'] == 'publish' ? 'selected' : '' ); ?>>
                        Publish
                    </option>
                </select>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            <input type="hidden" name="csrf_token" value="<?php echo CSRF::getToken('edit_post_form') ?>">
        </form>
    </div>
    <div class="text-center">
        <a href="/manage-posts" class="btn btn-link btn-sm"><i class="bi bi-arrow-left"></i> Back to Posts</a>
    </div>
</div>

<?php

    require dirname(__DIR__) . '/parts/footer.php';