<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">LOGIN</h5>
    </div>
    <div class="modal-body">
    <?php if($error != false) : ?>
        <div class="alert alert-danger" role="alert">
            <?= $error; ?>
        </div>
    <?php endif ?>
    <form action="profile.php" method="post">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" id="username">
        </div>
        <div class="mb-3">
            <label for="paaword" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="paaword">
        </div>
        <button class="btn btn-success" name="login">Login</button>
    </form>
    <center><a class="text-decoration-none" href="">Forgot Password</a></center>
    <center><a class="text-center text-decoration-none" href="profile.php?signUp=true">Create an Account</a></center>
    
    </div>
    </div>
</div>