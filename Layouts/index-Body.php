<div class="b-pink">
<div class="container home-login b-pink">
    <div class="row background-content">
        
        <div class="col-lg-6 content-flex-center">
            <img src="Images/gaallop.png" alt="" class="w-100">
        </div>
        <div class="col-lg-6">
            <form action="" method="POST">
                
                <h2 class="header-login">Admin Login</h2>


                <p class="colo-p">Please Enter your Details Below To continue</p>
                <div class="input-parent">
                    <input type="text" name="Input_Username" class="form-control" placeholder="USERNAME">
                    <i class="far fa-envelope"></i>
                </div>
                <div class="input-parent">
                    <input type="password" name="Input_Password" class="form-control" placeholder="PASSWORD">
                    <i class="fas fa-key"></i>
                </div>
                <div class="row d-flex justify-content-between">
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-6">
                        <div class="forget-password">
                            <a href="#" class="link-secondary mx-auto col-2 mt-3">Forget-password</a>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary edit-submit" name="Login_BTN">Login</button>

                <div class="text-center">
                    <a href="Developer-Management/SM-Control-Center.php" class="link-secondary mx-auto col-2 mt-3">Developer Management</a>
                </div>
                
                <?php
                    Alert_Message($Alert_Message);
                ?>
            </form>
        </div>
    </div>
</div>
</div>

