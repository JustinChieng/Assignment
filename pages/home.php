<?php

    require dirname(__DIR__) . '/parts/header.php';
?>

<div class="mt-4 d-flex justify-content-center gap-3">
        <?php if (AUTHENTICATION::isLoggedIn()) : ?>
        <a href="/dashboard" class="btn btn-link btn-sm">Dashboard</a>
        <a href="/logout" class="btn btn-link btn-sm">Logout</a>
        <?php else : ?>
        <a href="/login" class="btn btn-success btn-sm">Login</a>
        <a href="/signup" class="btn btn-success btn-sm">Sign Up</a>
        <?php endif; ?>
    </div>

<div class="container mx-auto my-5" style="max-width: 500px;">
    <h1 class="h1 mb-4 text-center">Happy Moment sharing corner</h1>
    <?php foreach( POST::getPublishPosts() as $post): ?>
    <div class="card mb-2">
        <div class="card-body">
            <h5 class="card-title"><?php echo $post['title'] ?></h5>
            <p class="card-text"><?php echo substr($post['content'],0,100); ?></p>
            <div class="text-end">
                <a href="/post?id=<?php echo $post['id']; ?>" class="btn btn-primary btn-sm">Read More</a>
            </div>
        </div>
    </div>
    <?php endforeach ?>

   
</div>
<?php

    require dirname(__DIR__) . '/parts/footer.php';