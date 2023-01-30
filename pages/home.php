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

    <div class="home py-5">
      <div class="container">
        <div class="row">
        <?php foreach( Post::getPublishPosts() as $post ) : ?>
        <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card mb-5 shadow-sm" style="border: 2px solid maroon;">
            <div class="card-body">
              <div class="card-title">
                <h2><?php echo $post['title']; ?></h2>
              </div>
              <div class="card-text">
                <p>
                <?php echo substr($post['content'], 0, 50); ?> ...
                </p>
              </div>
              <a href="/post?id=<?php echo $post['id']; ?>" class="btn btn-primary btn-sm">Read More</a>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

<?php

    require dirname(__DIR__) . '/parts/footer.php';