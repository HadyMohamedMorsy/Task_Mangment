
<?php

if(isset($_SESSION['Department'])):

?>

<?php
    

    $do = isset($_GET['do']) ? $_GET['do'] : "Manage";

    if($do == "Manage"){?>
        <div class="container-fluid">
            <div class="add">
                <a href="?do=Insert" class="btn btn-primary edit-submit">Add Department</a>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row task-mangement">
                    <h4 class="mb-5"> Department </h4>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Statues</th>
                                <th>Position</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php

                        $sql='SELECT users.*,department.Department AS Department_name,department.Status As StatusDepartment FROM users INNER JOIN department ON users.ID_Department= department.ID_D WHERE Group_Id != "0" AND U_Status = "Active" ORDER BY ID_D DESC';

                        $res = mysqli_query($Connection ,  $sql);

                        if($res == true){

                            $coulmn = mysqli_num_rows($res);

                            if($coulmn > 0){
                                $counter = 1;
                                while( $rows = mysqli_fetch_assoc($res)){
                                    ?>
                                        <?php if($rows['StatusDepartment'] == "Active") : ?>
                                        <tr>
                                            <td> <?php echo $counter++; ?> </td>
                                            <td> <span> <img src="<?php echo 'Images/users/'.$rows['Image']; ?>" alt="" style="width : 60px" class="rounded-image"/> </span> <span> <?php echo $rows['U_First_Name'] ." ".$rows['U_Second_Name']." ".$rows['U_Third_Name'] ; ?></span>  </td>
                                            <td> <?php echo $rows['Department_name']; ?> </td>
                                            <td> <?php echo $rows['StatusDepartment']; ?> </td>
                                            <td> <?php echo $rows['U_Account_Type']; ?> </td>
                                            <td> 
                                                <a href="?do=Edit&ID_Department=<?php echo $rows['ID_Department'];?>&ID=<?php echo $rows['U_ID']; ?>" class="btn btn-primary">Edit</a>
                                            </td>
                                        </tr>
                                        <?php  endif; ?>
                                    <?php
                                }

                            }else{
                            }
                        }else{
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
                    <div class="title">Add Department </div>
                    <form action="?do=Add" Method="POST">
                        <div class="row form-g-user">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="label">Department</label>
                                    <input type="text" class="form-control" name="Department" placeholder="Department" >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="label">Status</label>
                                    <select class="form-control" name="Status">
                                        <option value="Active">Active</option>
                                        <option value="UnActive">UnActive</option>
                                    </select>                            
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="Submit" class="btn btn-primary edit-submit mt-5">Submit</button>
                    </form>
                </div>
        </div>
    <?php
    }elseif($do == "Add"){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $department = filter_var($_POST['Department'],FILTER_SANITIZE_STRING);

            $Status = $_POST['Status'];

            $Alert_Message  = array();

            $Alert_Message_sucess = array();

            if(empty($department)){

                $Alert_Message[] = Message_Handling($Department_Faild_Empty,'Error',$Font);
            }

            if(empty($Status)){
                
                $Alert_Message[] = Message_Handling($Status,'Error',$Font);

            }
            if(empty($Alert_Message)){

                $sql = "INSERT INTO department SET
                Department = '$department',
                Status = '$Status'
                ";

                $res = mysqli_query($Connection , $sql);

                if($res == true){
                    
                    echo("<script> location.href = 'http://localhost/MSA-Demo/Department?do=Manage';</script>");


                }else{

                }

            }else{  

                    Alert_Message($Alert_Message);

            }

        }else {
        

            echo "U Must Go Home U Cant to be here";

        }

    }elseif($do == "Edit"){
        $cheack_admin = $_SESSION['U_Account_Type'];
        
        if($cheack_admin == "Admin"){?>
        <?php 
            if(isset($_GET['ID_Department']) && isset($_GET['ID'])){

                $id_department = $_GET['ID_Department'];

                $id_user = $_GET['ID'];


                $sql = 'SELECT * FROM users WHERE U_ID = "'.$id_user.'" AND ID_Department = "'.$id_department.'"';

                $res = mysqli_query($Connection , $sql);

                if($res == true){

                    $coulm = mysqli_num_rows($res);

                    if($coulm > 0){

                        while($rows = mysqli_fetch_assoc($res)){

                            $id = $rows['U_ID'];
                            $id_department = $rows['ID_Department'];
                            
                        }
                        
                        ?>

                        <div class="container-fluid">
                            <div class="row task-mangement">
                                <div class="title">Edit Department </div>
                                <form action="?do=EditDepartment" Method="POST">
                                    <div class="row form-g-user">
                                        <div class="col-lg-6">
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
                                                            <option name="Department" value="<?php echo $ID_D; ?>" <?php if($id_department == $ID_D ){  echo "selected";} ?>> <?php echo $Department_Data; ?></option>
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
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="label">Status</label>
                                                <select class="form-control" name="Status">
                                                    <option value="Active">Active</option>
                                                </select>                            
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                    <button type="submit" name="Submit" class="btn btn-primary edit-submit mt-5">Submit</button>
                                </form>
                            </div>
                        </div>
                    <?php
                    

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

        

    }elseif($do == "EditDepartment"){

        if($_SERVER['REQUEST_METHOD'] =="POST"){

            $id = $_POST['id'];
            $department = $_POST['Department'];

            $sql = 'UPDATE  users SET
            ID_Department = "'.$department.'"
            WHERE U_ID ="'.$id.'"';

            $res = mysqli_query($Connection , $sql);

            if($res == true){

                echo("<script> location.href = 'http://localhost/MSA-Demo/Department?do=Manage';</script>");


            }else{


            }

        }
    }
    ?>
<?php
else : ?>

    <div class="Eroor_page">
        <div class="eroor_Text">
            <p> This Page Not Fount 404</p>
        </div>

    </div>
    <?php
endif;

?>

