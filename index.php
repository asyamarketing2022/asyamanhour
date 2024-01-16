<?php include 'force_homepage.php'; ?>
<?php include 'login.php'; ?>
<?php include 'header.php'; ?>

<!-- Login Form -->
    <div class="form-body">
        <div class="form-wrapper">
            <div class="asyamanhour-logo">
                <img src="img/manhour-logo-2.png" alt="">
            </div>
            <form class="login-form" action="" method="post">
                <!-- <h1>Log in</h1> -->
                <div class="email">
                    <!-- <label class="form-label" for="email">Email</label> -->
                    <input type="email" name="email" id="login-email" placeholder="Email" required>
                </div>
                
                <div class="password pt-3">
                    <!-- <label class="form-label" for="">Password</label> -->
                    <input type="password" name="password" id="login-password" placeholder="Password" required>
                </div>

                <div class="pt-3">
                    <button class="btn" type="submit" name="login" value="Submit Form" id="btn-login">Log in</button>
                    <!-- <button type="button" class="btn">Cancel</button> -->
                </div>
            </form>
        </div>
    </div>

<?php include 'footer.php'; ?>