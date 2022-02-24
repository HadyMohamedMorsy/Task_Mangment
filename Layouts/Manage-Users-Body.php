<?php

    if(isset($_SESSION['Manager_user'])):

?>


<?php
    

    $do = isset($_GET['do']) ? $_GET['do'] : "Manage";

    if($do == "Manage"){?>
            <div class="container-fluid">
                <div class="add">
                    <a href="?do=Insert" class="btn btn-primary edit-submit">Add User</a>

                    <?php
                    $cheach_Admin =  $_SESSION['U_Account_Type'];

                    if($cheach_Admin == "Admin"){ ?>

                        <a href="?do=Archive" class="btn btn-primary edit-submit">Archive</a>

                        <?php
                    }

                    ?>
                </div>
            </div>
            <div class="container-fluid">

                <div class="row task-mangement">
                        <h4 class="mb-5"> Manage Users </h4>
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                        
                            <thead>
                                <tr>
                                <th>ID</th>
                                <th>FullName</th>
                                <th>Gender</th>
                                <th>Position</th>
                                <th>Status</th>
                                <th>Date</th>
                                <?php
                                    $cheach_Admin =  $_SESSION['U_Account_Type'];
                                    if($cheach_Admin == "Admin"){ ?>
                                        <th>Action</th>
                                        <?php
                                    }
                                ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                    if($cheach_Admin == "Admin"){

                                        $sql = 'SELECT users.*,department.Department AS Department_name FROM users INNER JOIN department ON users.ID_Department= department.ID_D WHERE Group_Id != "0" AND U_Status = "Active" AND U_ID != "'.$_SESSION['U_ID'].'" ORDER BY U_ID DESC';

                                        $res = mysqli_query($Connection , $sql);
    
                                        if($res == true){

                                            $coulm = mysqli_num_rows($res);

                                            if($coulm > 0){

                                                $counter = 1;

                                                while($rows =  mysqli_fetch_assoc($res)){ ?>
                                                    <tr>
                                                        <?php $id = $rows['U_ID'];  ?>
                                                        <td> <?php echo $counter++; ?> </td>
                                                        <td> <span> <img src="<?php echo 'Images/users/'.$rows['Image']; ?>" alt="" style="width : 60px; height: 50px; object-fit: cover;" class="rounded-image"/> </span> <span> <?php echo $rows['U_First_Name'] ." ".$rows['U_Second_Name']." ".$rows['U_Third_Name'] ; ?></span>  </td>
                                                        <td> <?php echo $rows['Gender']; ?> </td>
                                                        <td> <?php echo $rows['U_Account_Type']; ?> </td>
                                                        <td> <?php echo $rows['U_Status']; ?> </td>
                                                        <td> <?php echo $rows['date']; ?> </td>
                                                        <td> 
                                                            <a href="?do=Edit&ID=<?php echo $id;?>" class="btn btn-primary">Edit</a>
                                                            <a href="?do=Deletefromuser&ID=<?php echo $id;?>" class="btn btn-danger">Delete</a>
                                                            <a href="Profile?id=<?php echo $id; ?>" class="btn btn-success">View Profile</a>
                                                        </td>
                                                    </tr>
                                                <?php
                                            }

                                            }

                                        }else{
    
                                        }

                                    }else{

                                        $sql = 'SELECT users.*,department.Department AS Department_name FROM users INNER JOIN department ON users.ID_Department= department.ID_D WHERE Group_Id != "0" AND U_Status = "Active" AND U_ID != "'.$_SESSION['U_ID'].'" ORDER BY U_ID DESC';

                                        $res = mysqli_query($Connection , $sql);
    
                                        if($res == true){

                                            $coulm = mysqli_num_rows($res);

                                            if($coulm > 0){

                                                $counter = 1;

                                                while($rows =  mysqli_fetch_assoc($res)){ ?>
                                                    <tr>
                                                        <?php $id = $rows['U_ID'];  ?>
                                                        <td> <?php echo $counter++; ?> </td>
                                                        <td> <span> <img src="<?php echo 'Images/users/'.$rows['Image']; ?>" alt="" style="width : 60px; height: 50px; object-fit: cover;" class="rounded-image"/> </span> <span> <?php echo $rows['U_First_Name'] ." ".$rows['U_Second_Name']." ".$rows['U_Third_Name'] ; ?></span>  </td>
                                                        <td> <?php echo $rows['Gender']; ?> </td>
                                                        <td> <?php echo $rows['U_Account_Type']; ?> </td>
                                                        <td> <?php echo $rows['U_Status']; ?> </td>
                                                        <td> <?php echo $rows['date']; ?> </td>                                                    </tr>
                                                <?php
                                            }

                                            }

                                        }else{
    
                                        }


                                    }

                                    
                                ?>

                            </tbody>
                        </table>
                </div>
            </div>
            <?php

    }elseif($do == "Insert"){ ?>
            <div class="container-fluid">
                <div class="row task-mangement">
                    <div class="title">Add User </div>
                    <form method="POST" action="?do=Add" enctype="multipart/form-data">
                        <div class="row form-g-user">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="label">First Name</label>
                                    <input type="text" class="form-control" name="First" placeholder="First Name">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="label">Secound Name</label>
                                    <input type="text" class="form-control"  name="Secound"  placeholder="Secound Name">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="label">Thired Name</label>
                                    <input type="text" class="form-control"  name="Thired" placeholder="Thired Name">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="label">Department</label>
                                    <select class="form-control" name ="Department">
                                    <?php
                                        // query About Your Data\
                                        $sql = 'SELECT * FROM department WHERE Status ="Active"';

                                        // Cheack Your Data Here If it Exist 
                                        $res = mysqli_query($Connection , $sql);

                                        // Array Is Empty About Errors
                                        $Alert_Message_sucess = array();

                                        // Cheack your True Of False 

                                        if($res == true){

                                            // Get Your Row Count 

                                            $count = mysqli_num_rows($res);

                                            // if It Exist
                                            if($count > 0){
                                                // Loop Data Here

                                            while($rows = mysqli_fetch_assoc($res)){

                                                $Department_Data = $rows['Department'];
                                                $ID_D = $rows['ID_D'];
                                                ?>
                                                <option value="<?php echo $ID_D; ?>"> <?php echo $Department_Data; ?></option>
                                            <?php
                                            }

                                            }else{

                                            // if It Not Exist
                                                
                                                echo $Department;
                                            }


                                        }else{

                                            // If Your Query Is Faults

                                            $Alert_Message[] = Message_Handling($Qyery_Faild_Empty,'Error',$Font);

                                            Alert_Message($Alert_Message);
                                        }
                                    
                                    ?>

                                    </select>                       
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="label" >UserName</label>
                                    <input type="text" class="form-control" placeholder="UserName" name ="UserName">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="label">Contact No</label>
                                    <input type="number" class="form-control"  placeholder="Contact No" name="Contact">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="label">card number</label>
                                    <input type="number" class="form-control"  placeholder="card number" name="card_number">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="label">Email address</label>
                                    <input type="email" class="form-control"   placeholder="Enter email" name="Email">
                                </div>
                            </div>
                            <?php $cheach_Admin =  $_SESSION['U_Account_Type']; ?>

                            <?php
                            if($cheach_Admin == "Admin"){?>
                                <div class="col-lg-3">
                                    <div class="form-group" >
                                        <label for="exampleInputEmail1" class="label">Password</label>
                                        <input type="password" class="form-control"   placeholder="Password" name="Password">
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="label">Gender</label>
                                    <select class="form-control" name="Gender">
                                        <option value="Female">Female</option>
                                        <option value="Male">Male</option>
                                    </select>                         
                                </div>
                            </div>
                            <?php
                            if($cheach_Admin == "Admin"){ ?>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="label">Status</label>
                                            <select class="form-control" name="Status">
                                                <option value="Active">Active</option>
                                                <option value="UnActive">UnActive</option>
                                            </select>                         
                                        </div>
                                    </div>
                            <?php
                            }
                            ?>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="label">Address</label>
                                    <input type="text" class="form-control" placeholder="Adress" name ="Adress">
                                </div>
                            </div>
                            <?php 

                                if($cheach_Admin =="Admin"){
                                    ?>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="label">User Permation</label>
                                                <select class="form-control Select" name="User">
                                                    <option value="Admin">Admin</option>
                                                    <option value="Manager" <?php if($_SESSION['U_Account_Type'] == "Admin"){ echo "selected";} ?>>Manager</option>
                                                    <option value="User">User</option>
                                                </select>    
                                            </div>
                                        </div>
                                    <?php
                                }
                            
                            ?>
                        </div>
                        <?php 
                                if($cheach_Admin =="Admin"){
                                    ?>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input check" value="Dashbored" name="options[]">
                                            <label class="form-check-label" for="exampleCheck1">    Dashbored</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input check" value="Department" name="options[]">
                                            <label class="form-check-label" for="exampleCheck1">    Department</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input check" value="Manager_user" name="options[]">
                                            <label class="form-check-label" for="exampleCheck1">    Manager_user</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input check"  value="Manager_Task" name="options[]" <?php if($cheach_Admin == "Admin") { echo "checked";}?>>
                                            <label class="form-check-label" for="exampleCheck1" >Manager_Task</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input check"  value="Task_History" name="options[]" <?php if($cheach_Admin == "Admin") { echo "checked";}?>>
                                            <label class="form-check-label" for="exampleCheck1">Task_History</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input check"  value="Clients"      name="options[]" <?php if($cheach_Admin == "Admin") { echo "checked";}?>>
                                            <label class="form-check-label" for="exampleCheck1">Clients</label>
                                        </div>
                                    <?php
                                }
                            ?>

                            <?php
                            if($cheach_Admin =="Manager"){  ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="Users" value="Manager">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Manger
                                        </label>
                                        </div>
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" name="Users" value="User" checked>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            User
                                        </label>
                                    </div>
                                <?php
                            }
                            
                            ?>

                        <div class="form-group">
                            <p class="label"> Image </p>
                            <input type="file" class="form-control-file" name="image">
                        </div>

                        <button type="submit" class="btn btn-primary edit-submit mt-5">Submit</button>
                    </form>
                </div>
            </div>
        <?php
    }elseif($do == "Add"){
        if($_SERVER['REQUEST_METHOD'] =="POST"){
                $cheach_Admin =  $_SESSION['U_Account_Type'];
                if($cheach_Admin =="Admin"){

                    $options = array(
                        'cluster' => 'mt1',
                        'useTLS' => true
                      );
                      $pusher = new Pusher\Pusher(
                        'b43fe26aa93e13911707',
                        'a4516da79df90b233486',
                        '1347621',
                        $options
                      );
                    


                        $array = array();
                        $Eroor_message = array();
                        $Sucess_message = array();

                        $First              =filter_var($_POST['First'],FILTER_SANITIZE_STRING);
                        $Secound            =filter_var($_POST['Secound'],FILTER_SANITIZE_STRING);
                        $Thired             =filter_var($_POST['Thired'],FILTER_SANITIZE_STRING);
                        $Department         =$_POST['Department'];
                        $UserName           =filter_var($_POST['UserName'],FILTER_SANITIZE_STRING); 
                        $Password           =md5(sha1($_POST['Password']));
                        $Contact            =$_POST['Contact']; 
                        $Gender             =$_POST['Gender'];
                        $Status             =$_POST['Status'];
                        $Adress             =filter_var($_POST['Adress'],FILTER_SANITIZE_STRING);
                        $User               =$_POST['User'];
                        $card_number        =$_POST['card_number'];
                        $Email              =filter_var($_POST['Email'],FILTER_VALIDATE_EMAIL);
                        $Group              =filter_var(1,FILTER_VALIDATE_INT);
                        $date               = CurrentDate();

                        $fullName = $First ." ". $Secound;
                        
                        if(isset($_POST['options'])){

                            $array = $_POST['options'];
                        }

                        if(isset($_FILES['image']['name'])){

                            $image_name = $_FILES['image']['name'];

                            $ext = explode('.',$image_name);

                            $final = end($ext);

                            $image_name = "User_".rand(0,9999).".".$final;

                            $destination_path = "Images/users/".$image_name;
                    
                            $source_path = $_FILES['image']['tmp_name'];
                    
                    
                            $upload = move_uploaded_file($source_path , $destination_path);

                            if($upload == false){

                                if($Gender == "Male"){

                                    $image_name = "IMG-Defult-Male.jpg";

                                }else{

                                    $image_name = "IMG-Defult-Female.jpg";

                                }

                            }

                        }else{

                            if($Gender == "Male"){

                                $image_name = "IMG-Defult-Male.jpg";

                            }else{

                                $image_name = "IMG-Defult-Female.jpg";

                            }
                        }

                        if(strlen($First) <= 2 &&  strlen($Secound) <= 2  && strlen($Thired) <= 2 ){

                            $Eroor_message[] = Message_Handling($wrong_length,'Error',$Font);

                        }

                        if(empty($UserName)){

                            $Eroor_message[] = Message_Handling($wrong_UserName,'Error',$Font);

                        }

                        if($Password == "0144712dd81be0c3d9724f5e56ce6685"){
        
                            $Eroor_message[] = Message_Handling($wrong_Password,'Error',$Font);
            
                        }

                        if(strlen($Contact) <= 10){

                            $Eroor_message[] = Message_Handling($wrong_Contact,'Error',$Font);

                        }

                        if(strlen($card_number) <= 13){

                            $Eroor_message[] = Message_Handling($wrong_card_number,'Error',$Font);

                        }

                        if(empty($Email)){

                            $Eroor_message[] = Message_Handling($wrong_Email,'Error',$Font);
                        }
                        if(count($array) > 0){


                        }else{

                            $Eroor_message[] = Message_Handling($wrong_array,'Error',$Font);

                        }
                        if(!empty($Eroor_message)){ ?>

                        <div class="container"> 
                            <div class="row">
                                <?php echo Alert_Message($Eroor_message); ?>
                            </div>
                        </div>

                        <?php

                        }else{

                            $sql2 = 'INSERT INTO users SET
                            U_Username = "'.$UserName.'",
                            U_Password = "'.$Password.'",
                            U_First_Name = "'.$First.'",
                            U_Second_Name = "'.$Secound.'",
                            U_Third_Name = "'.$Thired.'",
                            Gender = "'.$Gender.'",
                            U_Account_Type = "'.$User.'",
                            U_Status = "'.$Status.'",
                            ID_Department = "'.$Department.'",
                            Contact = "'.$Contact.'",
                            card_number = "'.$card_number.'",
                            Adress = "'.$Adress.'",
                            Email = "'.$Email.'",
                            Image = "'.$image_name.'",
                            date = "'.$date.'",
                            Group_Id = "'.$Group.'"
                        ';
                    
                        $res = mysqli_query($Connection , $sql2);


                        if($res == true){

                            $Sucess_message[] = Message_Handling(" Your  Name  $First $Secound $Thired",'Success',$Font);

                                foreach ($array as $key => $value) {

                                    $sql3 = 'SELECT * FROM users WHERE U_Username = "'.$UserName.'"';

                                    $res3 = mysqli_query($Connection , $sql3);

                                    if($res3 == true){

                                        $countrow = mysqli_num_rows($res3);

                                        if($countrow > 0){

                                            while($rows = mysqli_fetch_assoc($res3)){

                                                $ID = $rows['U_ID'];

                                            }

                                            $sql4 = 'INSERT INTO user_permission SET
                                                U_P_User_ID = "'.$ID.'",
                                                P_Selector_page = "'.$value.'",
                                                Select_User_Name = "'.$fullName.'",
                                                Status = "Active",
                                                User_Account_Added = "'.$_SESSION['U_Username'].'"
                                            ';

                                            $res4 = mysqli_query($Connection , $sql4);

                                            if($res4 == true){

                                                echo "Your Data Inserted";

                                            }else{
                                                echo "Data Not Inserted";

                                            }
                                        }

                                    }else{

                                        echo "No Selected";
                                    }
                                }

                            if(!empty($Sucess_message)){ 

                                echo("<script> location.href = 'http://localhost/MSA-Demo/Manage-Users?do=Manage';</script>");

                                $data['message'] = $_SESSION['U_ID'];
                                $data['newid'] =   $ID;
                                $pusher->trigger('my-channel', 'my-event', $data);

                            }

                        }else{

                            $Eroor_message[] = Message_Handling($wrong_Username_Unique,'Error',$Font);

                            if(!empty($Eroor_message)){ ?>

                                <div class="container">
                                    <div class="row">
                                        <?php echo Alert_Message($Eroor_message); ?>
                                    </div>
                                </div>

                                <?php

                            }

                        }
                    }
                }else{

                        if(isset($_POST['Users'])){

                            $user_Manager = $_POST['Users'];

                        }
                        if($user_Manager == "Manager"){

                            $array = array("Manage_Task","Task_History","Manage Users", "Department" , "Clients");

                        }else{

                            $array = array("Manage_Task","Task_History");

                        }

                        $Eroor_message = array();
                        
                        $Sucess_message = array();

                        $First              =filter_var($_POST['First'],FILTER_SANITIZE_STRING);
                        $Secound            =filter_var($_POST['Secound'],FILTER_SANITIZE_STRING);
                        $Thired             =filter_var($_POST['Thired'],FILTER_SANITIZE_STRING);
                        $Department         =$_POST['Department'];
                        $UserName           =filter_var($_POST['UserName'],FILTER_SANITIZE_STRING); 
                        $Password           =md5(sha1(123));
                        $Contact            =$_POST['Contact']; 
                        $Gender             =$_POST['Gender'];
                        $Status             =filter_var("UnActive",FILTER_SANITIZE_STRING);
                        $Adress             =filter_var($_POST['Adress'],FILTER_SANITIZE_STRING);
                        $User               =filter_var($_POST['Users'],FILTER_SANITIZE_STRING);
                        $card_number        =$_POST['card_number'];
                        $Email              =filter_var($_POST['Email'],FILTER_VALIDATE_EMAIL);
                        $Group              =filter_var(0 , FILTER_VALIDATE_INT);
                        $date               = CurrentDate();

                        $fullName = $First ." ". $Secound;


                        if(isset($_FILES['image']['name'])){

                            $image_name = $_FILES['image']['name'];

                            $ext = explode('.',$image_name);

                            $final = end($ext);

                            $image_name = "User_".rand(0,9999).".".$final;

                            $destination_path = "Images/users/".$image_name;
                    
                            $source_path = $_FILES['image']['tmp_name'];
                    
                    
                            $upload = move_uploaded_file($source_path , $destination_path);

                            if($upload == false){

                                if($Gender == "Male"){

                                    $image_name = "IMG-Defult-Male.jpg";

                                }else{

                                    $image_name = "IMG-Defult-Female.jpg";

                                }

                            }

                        }else{

                            if($Gender == "Male"){

                                $image_name = "IMG-Defult-Male.jpg";

                            }else{

                                $image_name = "IMG-Defult-Female.jpg";

                            }


                        }


                        if(strlen($First) <= 2 &&  strlen($Secound) <= 2  && strlen($Thired) <= 2 ){

                            $Eroor_message[] = Message_Handling($wrong_length,'Error',$Font);

                        }

                        if((empty($UserName))){

                            $Eroor_message[] = Message_Handling($wrong_UserName,'Error',$Font);

                        }

                        if((empty($Password))){

                            $Eroor_message[] = Message_Handling($wrong_Password,'Error',$Font);

                        }


                        if(strlen($Contact) <= 10){

                            $Eroor_message[] = Message_Handling($wrong_Contact,'Error',$Font);

                        }elseif(strlen($Contact) > 11){

                            $Eroor_message[] = Message_Handling($wrong_Contact,'Error',$Font);

                        }
                        if(strlen($card_number) <= 13){

                            $Eroor_message[] = Message_Handling($wrong_card_number,'Error',$Font);

                        }elseif(strlen($card_number) > 14){

                            $Eroor_message[] = Message_Handling($wrong_card_number,'Error',$Font);

                        }

                        if((empty($Email))){

                            $Eroor_message[] = Message_Handling($wrong_Email,'Error',$Font);
                        }

                        if(count($array) > 0){

                        }else{
                                $Eroor_message[] = Message_Handling($wrong_array,'Error',$Font);
                        }
                        
                        if(!empty($Eroor_message)){ ?>

                                <div class="container">
                                    <div class="row">
                                        <?php echo Alert_Message($Eroor_message); ?>
                                    </div>
                                </div>
                            <?php
                        }else{

                            $sql2 = 'INSERT INTO users SET
                            U_Username = "'.$UserName.'",
                            U_Password =  "'.$Password.'",
                            U_First_Name = "'.$First.'",
                            U_Second_Name = "'.$Secound.'",
                            U_Third_Name = "'.$Thired.'",
                            Gender = "'.$Gender.'",
                            U_Account_Type = "'.$User.'",
                            U_Status = "'.$Status.'",
                            ID_Department = "'.$Department.'",
                            Contact = "'.$Contact.'",
                            card_number = "'.$card_number.'",
                            Adress = "'.$Adress.'",
                            Email = "'.$Email.'",
                            Image = "'.$image_name.'",
                            date = "'.$date.'",
                            Group_Id = "'.$Group.'"
                            ';
                            

                            $res2 = mysqli_query($Connection , $sql2);

                            if($res2 == true){

                                $Sucess_message[] = Message_Handling(" Your  Name  $First $Secound $Thired",'Success',$Font);

                                    foreach ($array as $key => $value) {
            
                                        $sql5 = 'SELECT * FROM users WHERE U_Username = "'.$UserName.'"';
            
                                        $res5 = mysqli_query($Connection , $sql5);
            
                                        if($res5 == true){
            
                                            $countrow = mysqli_num_rows($res5);
            
                                            if($countrow > 0){
            
                                                while($rows = mysqli_fetch_assoc($res5)){
            
                                                    $ID = $rows['U_ID'];
            
                                                }
            
                                                $sql4 = 'INSERT INTO user_permission SET
                                                    U_P_User_ID = "'.$ID.'",
                                                    P_Selector_page = "'.$value.'",
                                                    Select_User_Name = "'.$fullName.'",
                                                    Status = "Active",
                                                    User_Account_Added = "'.$_SESSION['U_Username'].'"
                                                ';
            
                                                $res4 = mysqli_query($Connection , $sql4);
            
                                                if($res4 == true){
            
                                                    echo $value;
            
                                                }else{
                                                    echo "Data Not Inserted";
            
                                                }
                                            }
            
                                        }else{
            
                                            echo "No Selected";
                                        }
                                    }
            
                                

                                if(!empty($Sucess_message)){ 

                                    echo("<script> location.href = 'http://localhost/MSA-Demo/Manage-Users?do=Manage';</script>");

                                }

                            }else{

                                $Eroor_message[] = Message_Handling($wrong_Username_Unique,'Error',$Font);

                                if(!empty($Eroor_message)){ ?>

                                    <div class="container">
                                        <div class="row">
                                            <?php echo Alert_Message($Eroor_message); ?>
                                        </div>
                                    </div>

                                    <?php

                                }

                            }
                        }
            }
        }
    }elseif($do == "Approve"){

        $cheach_Admin =  $_SESSION['U_Account_Type'];

        if($cheach_Admin == "Admin"){
            
            if(isset($_GET['ID'])){

                $id = $_GET['ID'];

    
                $sql = 'SELECT users.*,department.Department AS Department_name FROM users INNER JOIN department ON users.ID_Department= department.ID_D WHERE U_ID = "'.$id.'" ';
    
                $res = mysqli_query($Connection , $sql);
    
                if($res == true){
    
                    $coulm = mysqli_num_rows($res);
    
                    if($coulm > 0){
    
                            while($rows =  mysqli_fetch_assoc($res)){

                                    $First        =  filter_var($rows['U_First_Name'],FILTER_SANITIZE_STRING) ;
                                    $two          =  filter_var($rows['U_Second_Name'],FILTER_SANITIZE_STRING);
                                    $third        =  filter_var($rows['U_Third_Name'] , FILTER_SANITIZE_STRING);
                                    $username     =  filter_var($rows['U_Username'] , FILTER_SANITIZE_STRING);
                                    $Gender       =  filter_var($rows['Gender'] , FILTER_SANITIZE_STRING);
                                    $Type         =  filter_var($rows['U_Account_Type'] , FILTER_SANITIZE_STRING);
                                    $Active       =  filter_var("Active" , FILTER_SANITIZE_STRING); 
                                    $Department   =  filter_var($rows['Department_name'] , FILTER_SANITIZE_STRING); 
                                    $Contact      =  "0".$rows['Contact'];
                                    $card_number  =  $rows['card_number'];
                                    $Adress       =  filter_var($rows['Adress'],FILTER_SANITIZE_STRING);
                                    $Email        =  filter_var($rows['Email'] ,FILTER_VALIDATE_EMAIL);
                                    $Image        =  filter_var($rows['Image'] , FILTER_SANITIZE_STRING);
                                    $Group_Id     =  filter_var(1,FILTER_VALIDATE_INT);
                                    $id_select =    $rows['ID_Department'];

                            }
                            ?>
                            <div class="container-fluid">
                                <div class="row task-mangement">
                                    <div class="title">Approve  User </div>
                                    <form method="POST" action="?do=InsertApprove&image=<?php echo $Image;?>" enctype="multipart/form-data">
                                        <div class="row form-g-user">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1" class="label">First Name</label>
                                                    <input type="text" class="form-control" name="First" placeholder="First Name"  value="<?php echo $First; ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1" class="label">Secound Name</label>
                                                    <input type="text" class="form-control"  name="Secound"  placeholder="Secound Name" value="<?php echo $two; ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1" class="label">Thired Name</label>
                                                    <input type="text" class="form-control"  name="Thired" placeholder="Thired Name" value="<?php echo $third; ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1" class="label">Department</label>
                                                    <select class="form-control" name ="Department">
                                                    <?php
                                                        // query About Your Data\
                                                        $sql = 'SELECT * FROM department WHERE Status ="Active"';

                                                        // Cheack Your Data Here If it Exist 
                                                        $res = mysqli_query($Connection , $sql);

                                                        // Array Is Empty About Errors
                                                        $Alert_Message_sucess = array();

                                                        // Cheack your True Of False 

                                                        if($res == true){

                                                            // Get Your Row Count 

                                                            $count = mysqli_num_rows($res);

                                                            // if It Exist
                                                            if($count > 0){
                                                                // Loop Data Here

                                                            while($rows = mysqli_fetch_assoc($res)){

                                                                $Department_Data = $rows['Department'];
                                                                $ID_D = $rows['ID_D'];

                                                                ?>
                                                                <option value="<?php echo $ID_D ?>" <?php if($ID_D == $id_select){ echo "selected";} ?>> <?php echo $Department_Data; ?></option>
                                                            <?php
                                                            }

                                                            }else{

                                                            // if It Not Exist
                                                                
                                                                echo $Department;
                                                            }


                                                        }else{

                                                            // If Your Query Is Faults

                                                            $Alert_Message[] = Message_Handling($Qyery_Faild_Empty,'Error',$Font);

                                                            Alert_Message($Alert_Message);
                                                        }
                                                    
                                                    ?>

                                                    </select>                       
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1" class="label" >UserName</label>
                                                    <input type="text" class="form-control" placeholder="UserName" name ="UserName" value="<?php echo $username; ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1" class="label">Contact No</label>
                                                    <input type="number" class="form-control"  placeholder="Contact No" name="Contact"  value="<?php echo $Contact; ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1" class="label">card number</label>
                                                    <input type="number" class="form-control"  placeholder="card number" name="card_number" value="<?php echo $card_number; ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1" class="label">Email address</label>
                                                    <input type="email" class="form-control"   placeholder="Enter email" name="Email" value="<?php echo $Email; ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group" >
                                                    <label for="exampleInputEmail1" class="label">Password</label>
                                                    <input type="password" class="form-control"   placeholder="Password" name="Password">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1" class="label">Gender</label>
                                                    <select class="form-control" name="Gender">
                                                        <option value="Female" <?php if($Gender == "Female") { echo "selected";}?> >Female</option>
                                                        <option value="Male" <?php if($Gender == "Male") { echo "selected";}?>>Male</option>
                                                    </select>                         
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1" class="label">Address</label>
                                                    <input type="text" class="form-control" placeholder="Adress" name ="Adress" value="<?php echo $Adress; ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1" class="label">User Permation</label>
                                                    <select class="form-control Select" name="User">
                                                        <option value="Manager" <?php if($Type == "Manager"){ echo "selected";} ?>>Manager</option>
                                                        <option value="User" <?php if($Type == "User"){ echo "selected";} ?>>User</option>
                                                    </select>    
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <main>
                                                        <label for="editor" class="label">Reason</label>
                                                        <textarea id="editor" name="reason">
                                                        </textarea>
                                                    </main>
                                                </div>
                                            </div>
                                        </div>
                                        <?php 
                                                if($cheach_Admin =="Admin"){
                                                    ?>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input check" value="Dashbored" name="options[]">
                                                            <label class="form-check-label" for="exampleCheck1">    Dashbored</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input check" value="Department" name="options[]">
                                                            <label class="form-check-label" for="exampleCheck1">    Department</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input check" value="Manager_user" name="options[]">
                                                            <label class="form-check-label" for="exampleCheck1">    Manager_user</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input check"  value="Manager_Task" name="options[]">
                                                            <label class="form-check-label" for="exampleCheck1" >Manager_Task</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input check"  value="Task_History" name="options[]" >
                                                            <label class="form-check-label" for="exampleCheck1">Task_History</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input check"  value="Clients" name="options[]" >
                                                            <label class="form-check-label" for="exampleCheck1">Clients</label>
                                                        </div>
                                                    <?php
                                                }
                                            ?>
                                        <div class="form-group">
                                            <img src="<?php echo "Images/users/".$Image; ?>" alt="" style="width: 125px;"/>
                                        </div>
                                        <div class="form-group">
                                            <p class="label"> Image </p>
                                            <input type="file" class="form-control-file" name="image">
                                        </div>
                                        <input type="hidden" class="form-control-file" name="id" value="<?php echo $id; ?>">
                                        <button type="submit" class="btn btn-primary edit-submit mt-5">Submit</button>
                                    </form>
                                </div>
                            </div>
                    <?php }else{
                        ?>
                        <div class="Eroor_page">
                            <div class="eroor_Text">
                                <p> This Page Not Fount 404</p>
                            </div>
                        </div>
                        <?php
                    }
    
                }else{

                    ?>
                    <div class="Eroor_page">
                        <div class="eroor_Text">
                            <p> This Page Not Fount 404</p>
                        </div>
                    </div>
                    <?php

                }

            }
        }else{ ?>
            <div class="Eroor_page">
                <div class="eroor_Text">
                    <p> This Page Not Fount 404</p>
                </div>
            </div>
            <?php
        }


    }elseif($do == "InsertApprove"){

        if($_SERVER['REQUEST_METHOD'] =="POST"){

        if(isset($_GET['image'])){

            $image = $_GET['image'];


            $array = array();
            $Eroor_message = array();
            $Sucess_message = array();

            $id                 =$_POST['id'];
            $First              =filter_var($_POST['First'],FILTER_SANITIZE_STRING);
            $Secound            =filter_var($_POST['Secound'],FILTER_SANITIZE_STRING);
            $Thired             =filter_var($_POST['Thired'],FILTER_SANITIZE_STRING);
            $Department         =$_POST['Department'];
            $UserName           =filter_var($_POST['UserName'],FILTER_SANITIZE_STRING); 
            $Password           =md5(sha1($_POST['Password']));
            $Contact            =$_POST['Contact']; 
            $Gender             =$_POST['Gender'];
            $Status             =filter_var("Active",FILTER_SANITIZE_STRING); ;
            $Adress             =filter_var($_POST['Adress'],FILTER_SANITIZE_STRING);
            $User               =$_POST['User'];
            $card_number        =$_POST['card_number'];
            $Email              =filter_var($_POST['Email'],FILTER_VALIDATE_EMAIL);
            $Group              =filter_var(1,FILTER_VALIDATE_INT);
            $reson              =filter_var($_POST['reason'],FILTER_SANITIZE_STRING);
            $date               = CurrentDate();

            $fullName = $First ." ". $Secound; 
            if(isset($_POST['options'])){

                $array = $_POST['options'];
            }
            if(isset($_FILES['image']['name'])){

                $image_name = $_FILES['image']['name'];

                $ext = explode('.',$image_name);

                $final = end($ext);

                $image_name = "User_".rand(0,9999).".".$final;

                $destination_path = "Images/users/".$image_name;
        
                $source_path = $_FILES['image']['tmp_name'];
        
                $upload = move_uploaded_file($source_path , $destination_path);


                if($upload == false){

                    $image_name = $image;

                }

            }else{

                $image_name = $image;

            }
            if(strlen($First) <= 2 &&  strlen($Secound) <= 2  && strlen($Thired) <= 2 ){

                $Eroor_message[] = Message_Handling($wrong_length,'Error',$Font);

            }
            if((empty($UserName))){

                $Eroor_message[] = Message_Handling($wrong_UserName,'Error',$Font);

            }
            if($Password == "0144712dd81be0c3d9724f5e56ce6685"){
    
                $Eroor_message[] = Message_Handling($wrong_Password,'Error',$Font);

            }
            if(strlen($Contact) <= 10){

                $Eroor_message[] = Message_Handling($wrong_Contact,'Error',$Font);

            }

            if(strlen($card_number) <= 13){

                $Eroor_message[] = Message_Handling($wrong_card_number,'Error',$Font);

            }elseif(strlen($card_number) > 14){
                $Eroor_message[] = Message_Handling($wrong_card_number,'Error',$Font);
            }
            if((empty($Email))){

                $Eroor_message[] = Message_Handling($wrong_Email,'Error',$Font);
            }
            if(count($array) > 0){
            }else{
                $Eroor_message[] = Message_Handling($wrong_array,'Error',$Font);
            }
            if(!empty($Eroor_message)){ ?>

                <div class="container"> 
                    <div class="row">
                        <?php echo Alert_Message($Eroor_message); ?>
                    </div>
                </div>

                <?php

                }else{

                    $sql = 'UPDATE users SET
                    U_Username = "'.$UserName.'",
                    U_Password = "'.$Password.'",
                    U_First_Name = "'.$First.'",
                    U_Second_Name = "'.$Secound.'",
                    U_Third_Name = "'.$Thired.'",
                    Gender = "'.$Gender.'",
                    U_Account_Type = "'.$User.'",
                    U_Status = "'.$Status.'",
                    ID_Department = "'.$Department.'",
                    Contact = "'.$Contact.'",
                    card_number = "'.$card_number.'",
                    Adress = "'.$Adress.'",
                    Email = "'.$Email.'",
                    Image = "'.$image_name.'",
                    date = "'.$date.'",
                    Group_Id = "'.$Group.'",
                    Reason = "'.$reson.'"
                    WHERE U_ID = "'.$id.'"
                    ';

                    $res = mysqli_query($Connection , $sql);

                    if($res == true){
                        
                        foreach ($array as $key => $value) {
                            
                            $sql2 = 'DELETE FROM user_permission WHERE U_P_User_ID = "'.$id.'"';

                            $res2 = mysqli_query($Connection,$sql2);

                            if($res2 == true){
                                
                                echo "yes";

                            }else{

                                echo "no";

                            }

                        }

                        foreach ($array as $key => $value) {

                            $sql3 = 'INSERT INTO user_permission SET
                            U_P_User_ID = "'.$id.'",
                            P_Selector_page = "'.$value.'",
                            Select_User_Name = "'.$fullName.'",
                            Status = "Active",
                            User_Account_Added = "'.$_SESSION['U_Username'].'"
                            ';

                            $res3 = mysqli_query($Connection ,$sql3);

                            if($res3 == true){

                                echo "Inseted";


                            }else{

                                ?>
                                <div class="Eroor_page">
                                    <div class="eroor_Text">
                                        <p> This Page Not Fount 404</p>
                                    </div>
                                </div>
                                <?php


                            }


                        }

                        echo("<script> location.href = 'http://localhost/MSA-Demo/Manage-Users?do=Manage';</script>");

                    }else{
                        ?>
                        <div class="Eroor_page">
                            <div class="eroor_Text">
                                <p> This Page Not Fount 404</p>
                            </div>
                        </div>
                        <?php
                    }

                }
        }else{
            ?>
            <div class="Eroor_page">
                <div class="eroor_Text">
                    <p> This Page Not Fount 404</p>
                </div>
            </div>
            <?php
        }

        }else{
            ?>
            <div class="Eroor_page">
                <div class="eroor_Text">
                    <p> This Page Not Fount 404</p>
                </div>
            </div>
            <?php
        }
    }elseif($do == "Disapprove"){

        if(isset($_GET['ID'])){

            $id = filter_var($_GET['ID'],FILTER_VALIDATE_INT);


            $sql = 'SELECT users.*,department.Department AS Department_name FROM users INNER JOIN department ON users.ID_Department= department.ID_D WHERE U_ID = "'.$id.'"';

            $res = mysqli_query($Connection , $sql);

            if($res == true){

                $coulm = mysqli_num_rows($res);

                if($coulm > 0){

                    while($rows =  mysqli_fetch_assoc($res)){
                            $username     =  filter_var($rows['U_Username'],FILTER_SANITIZE_STRING);
                            $Active       =  filter_var($rows['U_Status'], FILTER_SANITIZE_STRING); 
                    }
                    ?>
                    <?php $group_id = filter_var(1,FILTER_VALIDATE_INT); ?>
                    <div class="container-fluid">
                        <div class="row task-mangement">
                            <div class="title">DisApprove User </div>
                            <form method="POST" action="?do=Delete">
                                <div class="row form-g-user">
                                    <div class="col-lg-6">
                                    <h2> <span> UserName Is </span> <span class="main-color"> <?php echo $username; ?></span> </h2>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <main>
                                                <label for="editor" class="label">Reason</label>
                                                <textarea id="editor" name="reason">
                                                </textarea>
                                            </main>
                                        </div>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="extinstion" id="exampleRadios1" value="Maybe" checked>
                                            <label class="form-check-label" for="exampleRadios1">
                                                Maybe
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="extinstion" id="exampleRadios2" value="Impossible">
                                            <label class="form-check-label" for="exampleRadios2">
                                                Impossible
                                            </label>
                                        </div>
                                    </div>

                                    <input type="hidden" class="form-control-file" name="id" value="<?php echo $id; ?>">
                                    <input type="hidden" class="form-control-file" name="status" value="<?php echo $Active; ?>">
                                    <input type="hidden" class="form-control-file" name="group_id" value="<?php echo $group_id; ?>">

                                    <button type="submit" class="btn btn-primary edit-submit mt-5">Submit</button>
                            </form>
                        </div>
                    </div>
                    <?php
                }
                else{
                    ?>
                    <div class="Eroor_page">
                        <div class="eroor_Text">
                            <p> This Page Not Fount 404</p>
                        </div>
                    </div>
                    <?php
                }

            }else{
                ?>
                <div class="Eroor_page">
                    <div class="eroor_Text">
                        <p> This Page Not Fount 404</p>
                    </div>
                </div>
                <?php
            }

        }else{

            ?>
            <div class="Eroor_page">
                <div class="eroor_Text">
                    <p> This Page Not Fount 404</p>
                </div>
            </div>
            <?php

        }   
    
    }elseif($do == "Delete"){

        if($_SERVER['REQUEST_METHOD'] =="POST"){
            $id =  filter_var($_POST['id'],FILTER_VALIDATE_INT);
            $status = filter_var($_POST['status'],FILTER_SANITIZE_STRING);
            $group = filter_var($_POST['group_id'],FILTER_VALIDATE_INT);
            $reason = filter_var($_POST['reason'],FILTER_SANITIZE_STRING);
            $extinstion = filter_var($_POST['extinstion'],FILTER_SANITIZE_STRING);

            $sql = 'UPDATE users SET
            U_Status = "'.$status.'",
            Group_Id = "'.$group.'",
            Reason   = "'.$reason.'",
            extinstions = "'.$extinstion.'"
            WHERE U_ID = "'.$id.'"';

            $res = mysqli_query($Connection,$sql);

            if($res == true){

                echo("<script> location.href = 'http://localhost/MSA-Demo/Manage-Users?do=Manage';</script>");


            }else{

                ?>
                <div class="Eroor_page">
                    <div class="eroor_Text">
                        <p> This Page Not Fount 404</p>
                    </div>
                </div>
                <?php
            }
        }
        
    }elseif($do == "Edit"){

        $cheach_Admin =  $_SESSION['U_Account_Type'];

        if($cheach_Admin == "Admin"){
            
            if(isset($_GET['ID'])){

                $id = filter_var($_GET['ID'],FILTER_VALIDATE_INT);

    
                $sql = 'SELECT users.*,department.Department AS Department_name FROM users INNER JOIN department ON users.ID_Department= department.ID_D WHERE U_ID = "'.$id.'"';
    
                $res = mysqli_query($Connection , $sql);
    
                if($res == true){
    
                    $coulm = mysqli_num_rows($res);
    
                    if($coulm > 0){
    
                        while($rows =  mysqli_fetch_assoc($res)){

                                $First        =  filter_var($rows['U_First_Name'],FILTER_SANITIZE_STRING) ;
                                $two          =  filter_var($rows['U_Second_Name'],FILTER_SANITIZE_STRING);
                                $third        =  filter_var($rows['U_Third_Name'] , FILTER_SANITIZE_STRING);
                                $username     =  filter_var($rows['U_Username'] , FILTER_SANITIZE_STRING);
                                $Gender       =  filter_var($rows['Gender'] , FILTER_SANITIZE_STRING);
                                $Type         =  filter_var($rows['U_Account_Type'] , FILTER_SANITIZE_STRING);
                                $Active       =  filter_var($rows['U_Status'] , FILTER_SANITIZE_STRING); 
                                $Department   =  filter_var($rows['Department_name'] , FILTER_SANITIZE_STRING); 
                                $Contact      =  "0".$rows['Contact'];
                                $card_number  =  $rows['card_number'];
                                $Adress       =  filter_var($rows['Adress'],FILTER_SANITIZE_STRING);
                                $Email        =  filter_var($rows['Email'] ,FILTER_VALIDATE_EMAIL);
                                $Image        =  filter_var($rows['Image'] , FILTER_SANITIZE_STRING);
                                $Group_Id     =  filter_var(1,FILTER_VALIDATE_INT);
                                $reason       =  filter_var($rows['Reason'],FILTER_SANITIZE_STRING);
                                $id_select =    $rows['ID_Department'];

                        }
                        ?>
                        <div class="container-fluid">
                            <div class="row task-mangement">
                                <div class="title">Edit User </div>
                                <form method="POST" action="?do=Edites&image=<?php echo $Image;?>" enctype="multipart/form-data">
                                    <div class="row form-g-user">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="label">First Name</label>
                                                <input type="text" class="form-control" name="First" placeholder="First Name"  value="<?php echo $First; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="label">Secound Name</label>
                                                <input type="text" class="form-control"  name="Secound"  placeholder="Secound Name" value="<?php echo $two; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="label">Thired Name</label>
                                                <input type="text" class="form-control"  name="Thired" placeholder="Thired Name" value="<?php echo $third; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="label">Department</label>
                                                <select class="form-control" name ="Department">
                                                <?php
                                                    // query About Your Data\
                                                    $sql = 'SELECT * FROM department WHERE Status ="Active"';

                                                    // Cheack Your Data Here If it Exist 
                                                    $res = mysqli_query($Connection , $sql);

                                                    // Array Is Empty About Errors
                                                    $Alert_Message_sucess = array();

                                                    // Cheack your True Of False 

                                                    if($res == true){

                                                        // Get Your Row Count 

                                                        $count = mysqli_num_rows($res);

                                                        // if It Exist
                                                        if($count > 0){
                                                            // Loop Data Here

                                                        while($rows = mysqli_fetch_assoc($res)){

                                                            $Department_Data = $rows['Department'];
                                                            $ID_D = $rows['ID_D'];

                                                            ?>
                                                            <option value="<?php echo $ID_D ?>" <?php if($ID_D == $id_select){ echo "selected";} ?> name="Department"> <?php echo $Department_Data; ?></option>
                                                        <?php
                                                        }

                                                        }else{

                                                        // if It Not Exist
                                                            
                                                            echo $Department;
                                                        }


                                                    }else{

                                                        // If Your Query Is Faults

                                                        $Alert_Message[] = Message_Handling($Qyery_Faild_Empty,'Error',$Font);

                                                        Alert_Message($Alert_Message);
                                                    }
                                                
                                                ?>

                                                </select>                       
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="label" >UserName</label>
                                                <input type="text" class="form-control" placeholder="UserName" name ="UserName" value="<?php echo $username; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="label">Contact No</label>
                                                <input type="number" class="form-control"  placeholder="Contact No" name="Contact"  value="<?php echo $Contact; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="label">card number</label>
                                                <input type="number" class="form-control"  placeholder="card number" name="card_number" value="<?php echo $card_number; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="label">Email address</label>
                                                <input type="email" class="form-control"   placeholder="Enter email" name="Email" value="<?php echo $Email; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group" >
                                                <label for="exampleInputEmail1" class="label">Password</label>
                                                <input type="password" class="form-control" placeholder="Password" name="Password">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="label">Gender</label>
                                                <select class="form-control" name="Gender">
                                                    <option value="Female" <?php if($Gender == "Female") { echo "selected";}?> >Female</option>
                                                    <option value="Male" <?php if($Gender == "Male") { echo "selected";}?>>Male</option>
                                                </select>                         
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="label">Address</label>
                                                <input type="text" class="form-control" placeholder="Adress" name ="Adress" value="<?php echo $Adress; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="label">User Permation</label>
                                                <select class="form-control Select" name="User">
                                                    <option value="Manager" <?php if($Type == "Manager"){ echo "selected";} ?>>Manager</option>
                                                    <option value="User" <?php if($Type == "User"){ echo "selected";} ?>>User</option>
                                                </select>    
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="label">Status</label>
                                                <select class="form-control" name="Status">
                                                    <option <?php if($Active == "Active"){ echo "selected";} ?> value="Active">Active</option>
                                                    <option <?php if($Active == "UnActive"){ echo "selected";} ?> value="UnActive">UnActive</option>
                                                </select>                         
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <main>
                                                    <label for="editor" class="label">Reason</label>
                                                    <textarea id="editor" name="reason">
                                                        <?php echo $reason; ?>
                                                    </textarea>
                                                </main>
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                            if($cheach_Admin =="Admin"){
                                                ?>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input check" value="Dashbored" name="options[]">
                                                        <label class="form-check-label" for="exampleCheck1">    Dashbored</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input check" value="Department" name="options[]">
                                                        <label class="form-check-label" for="exampleCheck1">    Department</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input check" value="Manager_user" name="options[]">
                                                        <label class="form-check-label" for="exampleCheck1">    Manager_user</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input check"  value="Manager_Task" name="options[]">
                                                        <label class="form-check-label" for="exampleCheck1" >Manager_Task</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input check"  value="Task_History" name="options[]" >
                                                        <label class="form-check-label" for="exampleCheck1">Task_History</label>
                                                    </div>
                                                <?php
                                            }
                                        ?>
                                    <div class="form-group">
                                        <img src="<?php echo "Images/users/".$Image; ?>" alt="" style="width: 125px;"/>
                                    </div>
                                    <div class="form-group">
                                        <p class="label"> Image </p>
                                        <input type="file" class="form-control-file" name="image">
                                    </div>
                                    <input type="hidden" class="form-control-file" name="id" value="<?php echo $id; ?>">
                                    <button type="submit" class="btn btn-primary edit-submit mt-5">Submit</button>
                                </form>
                            </div>
                        </div>
                    <?php }else{
                        ?>
                        <div class="Eroor_page">
                            <div class="eroor_Text">
                                <p> This Page Not Fount 404</p>
                            </div>
                        </div>
                        <?php
                    }
    
                }else{
                    ?>
                    <div class="Eroor_page">
                        <div class="eroor_Text">
                            <p> This Page Not Fount 404</p>
                        </div>
                    </div>
                    <?php
                }

            }
        }else{ ?>
            <div class="Eroor_page">
                <div class="eroor_Text">
                    <p> This Page Not Fount 404</p>
                </div>
            </div>
            <?php
        }
    }elseif($do == "Edites"){

        if($_SERVER['REQUEST_METHOD'] =="POST"){

            if(isset($_GET['image'])){
    
                $image = $_GET['image'];
    
    
                $array = array();
                $Eroor_message = array();
                $Sucess_message = array();
    
                $id                 =$_POST['id'];
                $First              =filter_var($_POST['First'],FILTER_SANITIZE_STRING);
                $Secound            =filter_var($_POST['Secound'],FILTER_SANITIZE_STRING);
                $Thired             =filter_var($_POST['Thired'],FILTER_SANITIZE_STRING);
                $Department         =$_POST['Department'];
                $UserName           =filter_var($_POST['UserName'],FILTER_SANITIZE_STRING); 
                $Password           =md5(sha1($_POST['Password']));
                $Contact            =$_POST['Contact']; 
                $Gender             =$_POST['Gender'];
                $Status             =filter_var("Active",FILTER_SANITIZE_STRING); ;
                $Adress             =filter_var($_POST['Adress'],FILTER_SANITIZE_STRING);
                $User               =$_POST['User'];
                $card_number        =$_POST['card_number'];
                $Email              =filter_var($_POST['Email'],FILTER_VALIDATE_EMAIL);
                $Group              =filter_var(1,FILTER_VALIDATE_INT);
                $reson              =filter_var($_POST['reason'],FILTER_SANITIZE_STRING);

    
                $fullName = $First ." ". $Secound; 

                if(isset($_POST['options'])){
    
                    $array = $_POST['options'];
                }

                if(isset($_FILES['image']['name'])){
    
                    $image_name = $_FILES['image']['name'];
    
                    $ext = explode('.',$image_name);
    
                    $final = end($ext);
    
                    $image_name = "User_".rand(0,9999).".".$final;
    
                    $destination_path = "Images/users/".$image_name;
            
                    $source_path = $_FILES['image']['tmp_name'];
            
                    $upload = move_uploaded_file($source_path , $destination_path);
    
    
                    if($upload == false){
    
                        $image_name = $image;
    
                    }
    
                }else{
    
                    $image_name = $image;
    
                }
                if(strlen($First) <= 2 &&  strlen($Secound) <= 2  && strlen($Thired) <= 2 ){
    
                    $Eroor_message[] = Message_Handling($wrong_length,'Error',$Font);
    
                }
                if(empty($UserName)){
    
                    $Eroor_message[] = Message_Handling($wrong_UserName,'Error',$Font);
    
                }
                if($Password == "0144712dd81be0c3d9724f5e56ce6685"){
    
                    $Eroor_message[] = Message_Handling($wrong_Password,'Error',$Font);
    
                }
                if(strlen($Contact) <= 10){
    
                    $Eroor_message[] = Message_Handling($wrong_Contact,'Error',$Font);
    
                }

                if(strlen($card_number) <= 13){
    
                    $Eroor_message[] = Message_Handling($wrong_card_number,'Error',$Font);
    
                }elseif(strlen($card_number) > 14){
                    $Eroor_message[] = Message_Handling($wrong_card_number,'Error',$Font);
                }
                if((empty($Email))){
    
                    $Eroor_message[] = Message_Handling($wrong_Email,'Error',$Font);
                }
                if(count($array) > 0){
                }else{
                    $Eroor_message[] = Message_Handling($wrong_array,'Error',$Font);
                }
                if(!empty($Eroor_message)){ ?>
    
                    <div class="container"> 
                        <div class="row">
                            <?php echo Alert_Message($Eroor_message); ?>
                        </div>
                    </div>
    
                    <?php
    
                    }else{
    
                        $sql = 'UPDATE users SET
                        U_Username = "'.$UserName.'",
                        U_Password = "'.$Password.'",
                        U_First_Name = "'.$First.'",
                        U_Second_Name = "'.$Secound.'",
                        U_Third_Name = "'.$Thired.'",
                        Gender = "'.$Gender.'",
                        U_Account_Type = "'.$User.'",
                        U_Status = "'.$Status.'",
                        ID_Department = "'.$Department.'",
                        Contact = "'.$Contact.'",
                        card_number = "'.$card_number.'",
                        Adress = "'.$Adress.'",
                        Email = "'.$Email.'",
                        Image = "'.$image_name.'",
                        Group_Id = "'.$Group.'",
                        Reason = "'.$reson.'"
                        WHERE U_ID = "'.$id.'"
                        ';
    
                        $res = mysqli_query($Connection , $sql);
    
                        if($res == true){
                            
                            foreach ($array as $key => $value) {
                                
                                $sql2 = 'DELETE FROM user_permission WHERE U_P_User_ID = "'.$id.'"';
    
                                $res2 = mysqli_query($Connection,$sql2);
    
                                if($res2 == true){
                                    
                                    echo "yes";
    
                                }else{
    
                                    echo "no";
    
                                }
    
                            }
    
                            foreach ($array as $key => $value) {
    
                                $sql3 = 'INSERT INTO user_permission SET
                                U_P_User_ID = "'.$id.'",
                                P_Selector_page = "'.$value.'",
                                Select_User_Name = "'.$fullName.'",
                                Status = "Active",
                                User_Account_Added = "'.$_SESSION['U_Username'].'"
                                ';
    
                                $res3 = mysqli_query($Connection ,$sql3);
    
                                if($res3 == true){
    
                                    echo "Inseted";
    
    
                                }else{

                                    ?>
                                    <div class="Eroor_page">
                                        <div class="eroor_Text">
                                            <p> This Page Not Fount 404</p>
                                        </div>
                                    </div>
                                    <?php
    
                                }
    
    
                            }

                            echo("<script> location.href = 'http://localhost/MSA-Demo/Manage-Users?do=Manage';</script>");

    
                        }else{
                            ?>
                            <div class="Eroor_page">
                                <div class="eroor_Text">
                                    <p> This Page Not Fount 404</p>
                                </div>
                            </div>
                            <?php
                        }
    
                    }
            }else{
                ?>
                    <div class="Eroor_page">
                        <div class="eroor_Text">
                            <p> This Page Not Fount 404</p>
                        </div>
                    </div>
                <?php
            }
    
            }else{
                ?>
                    <div class="Eroor_page">
                        <div class="eroor_Text">
                            <p> This Page Not Fount 404</p>
                        </div>
                    </div>
                <?php
        }
    
    }elseif($do == "Deletefromuser"){

        if(isset($_GET['ID'])){

            $id = filter_var($_GET['ID'],FILTER_VALIDATE_INT);


            $sql = 'SELECT users.*,department.Department AS Department_name FROM users INNER JOIN department ON users.ID_Department= department.ID_D WHERE U_ID = "'.$id.'"';

            $res = mysqli_query($Connection , $sql);

            if($res == true){

                $coulm = mysqli_num_rows($res);

                if($coulm > 0){

                    while($rows =  mysqli_fetch_assoc($res)){
                            $username     =  filter_var($rows['U_Username'],FILTER_SANITIZE_STRING);
                    }
                    ?>

                    <?php $group_id = filter_var(1,FILTER_VALIDATE_INT); ?>
                    <?php $Active = filter_var("UnActive", FILTER_SANITIZE_STRING);?>

                    <div class="container-fluid">
                        <div class="row task-mangement">
                            <div class="title">DisApprove User </div>
                            <form method="POST" action="?do=DeleteUser">
                                <div class="row form-g-user">
                                    <div class="col-lg-6">
                                    <h2> <span> UserName Is </span> <span class="main-color"> <?php echo $username; ?></span> </h2>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <main>
                                                <label for="editor" class="label">Reason</label>
                                                <textarea id="editor" name="reason">
                                                </textarea>
                                            </main>
                                        </div>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="extinstion" id="exampleRadios1" value="Maybe" checked>
                                            <label class="form-check-label" for="exampleRadios1">
                                                Maybe
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="extinstion" id="exampleRadios2" value="Impossible">
                                            <label class="form-check-label" for="exampleRadios2">
                                                Impossible
                                            </label>
                                        </div>
                                    </div>

                                    <input type="hidden" class="form-control-file" name="id" value="<?php echo $id; ?>">
                                    <input type="hidden" class="form-control-file" name="status" value="<?php echo $Active; ?>">
                                    <input type="hidden" class="form-control-file" name="group_id" value="<?php echo $group_id; ?>">

                                    <button type="submit" class="btn btn-primary edit-submit mt-5">Submit</button>
                            </form>
                        </div>
                    </div>
                    <?php
                }
                else{
                    ?>
                    <div class="Eroor_page">
                        <div class="eroor_Text">
                            <p> This Page Not Fount 404</p>
                        </div>
                    </div>
                    <?php

                }

            }else{

                ?>
                <div class="Eroor_page">
                    <div class="eroor_Text">
                        <p> This Page Not Fount 404</p>
                    </div>
                </div>
                <?php

            }

        }    
    
    }elseif($do == "DeleteUser"){

        if($_SERVER['REQUEST_METHOD'] =="POST"){
            $id =  filter_var($_POST['id'],FILTER_VALIDATE_INT);
            $status = filter_var($_POST['status'],FILTER_SANITIZE_STRING);
            $group = filter_var($_POST['group_id'],FILTER_VALIDATE_INT);
            $reason = filter_var($_POST['reason'],FILTER_SANITIZE_STRING);
            $extinstion = filter_var($_POST['extinstion'],FILTER_SANITIZE_STRING);

            $sql = 'UPDATE users SET
            U_Status = "'.$status.'",
            Group_Id = "'.$group.'",
            Reason   = "'.$reason.'",
            extinstions = "'.$extinstion.'"
            WHERE U_ID = "'.$id.'"';

            $res = mysqli_query($Connection,$sql);

            if($res == true){

                echo("<script> location.href = 'http://localhost/MSA-Demo/Manage-Users?do=Manage';</script>");

            }else{

                echo "Your Data Is Not Updtaed";

            }
        }
        
    }elseif($do == "Archive"){ ?>
        <?php if($_SESSION['U_Account_Type'] == "Admin") : ?>
            <div class="container-fluid">
                <div class="row task-mangement">
                        <h4 class="mb-5"> Manage Users </h4>
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                <th>ID</th>
                                <th>FullName</th>
                                <th>Gender</th>
                                <th>Position</th>
                                <th>Status</th>
                                <th>Department</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                        $sql = 'SELECT users.*,department.Department AS Department_name FROM users INNER JOIN department ON users.ID_Department= department.ID_D WHERE Group_Id != "0" AND U_Status = "UnActive"';

                                        $res = mysqli_query($Connection , $sql);

                                        if($res == true){

                                            $coulm = mysqli_num_rows($res);

                                            if($coulm > 0){

                                                $counter = 1;

                                                while($rows =  mysqli_fetch_assoc($res)){ ?>
                                                    <tr>
                                                        <?php $id = $rows['U_ID'];  ?>
                                                        <td> <?php echo $counter++; ?> </td>
                                                        <td> <span> <img src="<?php echo 'Images/users/'.$rows['Image']; ?>" alt="" style="width : 60px" class="rounded-image"/> </span> <span> <?php echo $rows['U_First_Name'] ." ".$rows['U_Second_Name']." ".$rows['U_Third_Name'] ; ?></span>  </td>
                                                        <td> <?php echo $rows['Gender']; ?> </td>
                                                        <td> <?php echo $rows['U_Account_Type']; ?> </td>
                                                        <td> <?php echo $rows['U_Status']; ?> </td>
                                                        <td> <?php echo $rows['Department_name']; ?> </td>
                                                        <td> 
                                                            <a href="?do=Restore&ID=<?php echo $id;?>" class="btn btn-primary">Restore</a>
                                                            <a href="Profile?id=<?php echo $id; ?>" class="btn btn-success">View Profile</a>

                                                        </td>
                                                    </tr>
                                                <?php
                                            }

                                            }

                                        }else{

                                        }

                                ?>

                            </tbody>
                        </table>
                </div>
            </div>
        <?php else : ?>
                <div class="Eroor_page">
                    <div class="eroor_Text">
                        <p> This Page Not Fount 404</p>
                    </div>
                </div>

                <?php
            ?>
        <?php endif; ?>
        <?php
    }elseif($do == "Restore"){
        $cheach_Admin =  $_SESSION['U_Account_Type'];
        if($cheach_Admin == "Admin"){

            if(isset($_GET['ID'])){

                $id = $_GET['ID'];

                $reason =  filter_var("she or He was with us in a company and came back again",FILTER_SANITIZE_STRING);

                $status = filter_var("Active", FILTER_SANITIZE_STRING);

                $sql = 'SELECT * FROM users WHERE U_ID = "'.$id.'"';

                $res = mysqli_query($Connection , $sql);

                if($res ==true){

                    $count = mysqli_num_rows($res);

                    if($count > 0){


                        $sql2 = 'UPDATE users SET
                        U_Status = "'.$status.'",
                        Reason   = "'.$reason.'"
                        WHERE U_ID = "'.$id.'"';
            
                        $res2 = mysqli_query($Connection,$sql2);
            
                        if($res2 == true){
            
                            echo("<script> location.href = 'http://localhost/MSA-Demo/Manage-Users?do=Manage';</script>");
            
                        }else{
                            ?>
                                <div class="Eroor_page">
                                    <div class="eroor_Text">
                                        <p> This Page Not Fount 404</p>
                                    </div>
                                </div>
                            <?php
                        }



                    }else{
                        ?>
                            <div class="Eroor_page">
                                <div class="eroor_Text">
                                    <p> This Page Not Fount 404</p>
                                </div>
                            </div>
                        <?php
                    }


                }else{

                    ?>
                        <div class="Eroor_page">
                            <div class="eroor_Text">
                                <p> This Page Not Fount 404</p>
                            </div>
                        </div>
                    <?php
                    }


                }

        }
    }
    ?>
<?php  else : ?>
    <div class="Eroor_page">
        <div class="eroor_Text">
            <p> This Page Not Fount 404</p>
        </div>
    </div>

<?php endif; ?>


