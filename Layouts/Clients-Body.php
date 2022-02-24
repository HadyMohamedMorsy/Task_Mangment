
<?php

if(isset($_SESSION['Clients'])):

?>

<?php
    

    $do = isset($_GET['do']) ? $_GET['do'] : "Manage";

    if($do == "Manage"){?>
        <div class="container-fluid">
            <div class="add">
                <a href="?do=Insert" class="btn btn-primary edit-submit">Add Clients</a>

                <?php 
                    if($_SESSION['U_Account_Type'] == "Admin"){
                        ?>
                        <a href="?do=Archive" class="btn btn-primary edit-submit">Archive</a>
                        <?php
                    }
                ?>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row task-mangement">
                    <h4 class="mb-5"> Clients </h4>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Client</th>
                                <th>Name</th>
                                <th>Number</th>
                                <th>Date</th>
                                <th>Status</th>
                                <?php if($_SESSION['U_Account_Type'] == "Admin") :?> 
                                <th>Action</th>
                                <?php endif; ?>
                            </tr>
                            
                        </thead>
                        <tbody>
                            <?php   

                            $sql = 'SELECT * FROM clients WHERE Status = "Active" ORDER BY clients_id DESC';

                            $res = mysqli_query($Connection , $sql);


                            if($res  == true){

                                $count = mysqli_num_rows($res);

                                if($count > 0){

                                    $counter = 1;
                                    while($rows = mysqli_fetch_assoc($res)){?>

                                        <tr>
                                            <td> <?php echo $counter++; ?> </td>
                                            <td>
                                                <img src=" <?php echo "Images/Clients/".$rows['Image'] ?>" alt="" style="width : 60px; height: 50px; object-fit: cover;" class="rounded-image"/> 
                                                <?php echo $rows['Clietns_name']; ?> 
                                            </td>
                                            <td> <?php echo  $rows['First_name_owner'] . " " .$rows['Secound_name_owner']; ?> </td>
                                            <td> <?php echo "0". $rows['Number']; ?> </td>
                                            <td> <?php echo $rows['Date']; ?> </td>
                                            <td> <?php echo  $rows['Status']; ?> </td>
                                            <?php if($_SESSION['U_Account_Type'] == "Admin") :?> 
                                                <td>
                                                    <a href="?do=Edit&ID=<?php echo $rows['clients_id'];?>&image=<?php echo $rows['Image']; ?>" class="btn btn-primary">Edit</a>
                                                    <a href="?do=Delete&ID=<?php echo $rows['clients_id'];?>" class="btn btn-danger">Delete</a>
                                                    <a href="Profile?do=Clients&id=<?php echo  $rows['clients_id']; ?>" class="btn btn-success">View Client</a>
                                                </td>
                                            <?php endif;  ?>
                                        </tr>
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
                    <div class="title">Add Clients </div>
                    <form action="?do=Add" Method="POST" enctype="multipart/form-data">
                        <div class="row form-g-user">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="label">Clients</label>
                                    <input type="text" class="form-control" name="Clients" placeholder="Clients" >
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
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="label">First_Name_Owner</label>
                                    <input type="text" class="form-control" name="First_Name_Owner" placeholder="First_Name" >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="label">Secound_Name_Owner</label>
                                    <input type="text" class="form-control" name="Secound_Name_Owner" placeholder="Secound_Name" >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="label">Number_phone</label>
                                    <input type="number" class="form-control" name="Number_phone" placeholder="Number_phone" >
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <p class="label"> Image </p>
                                <input type="file" class="form-control-file" name="image">
                            </div>
                        </div>
                        <button type="submit" name="Submit" class="btn btn-primary edit-submit mt-5">Submit</button>
                    </form>
                </div>
        </div>
    <?php
    }elseif($do == "Add"){

        if($_SERVER['REQUEST_METHOD'] =="POST"){

            
            $Eroor_message = array();

            $clients  = filter_var($_POST['Clients'] , FILTER_SANITIZE_STRING);
            $Status   = filter_var($_POST['Status'] , FILTER_SANITIZE_STRING);
            $First    = filter_var($_POST['First_Name_Owner'],FILTER_SANITIZE_STRING);
            $Secound    = filter_var($_POST['Secound_Name_Owner'],FILTER_SANITIZE_STRING);
            $number   = $_POST['Number_phone'];
            $Date     = CurrentDate();

            if(isset($_FILES['image']['name'])){

                $image_name = $_FILES['image']['name'];

                $ext = explode('.',$image_name);

                $final = end($ext);

                $image_name = "Clients_".rand(0,9999).".".$final;

                $destination_path = "Images/Clients/".$image_name;

                $source_path = $_FILES['image']['tmp_name'];

                $upload = move_uploaded_file($source_path , $destination_path);

                if($upload == false){

                    $Eroor_message[] = Message_Handling($wrong_Image,'Error',$Font);

                }

            }else{

                $Eroor_message[] = Message_Handling($wrong_Image,'Error',$Font);


            }



            if(empty($clients)){

                $Eroor_message[] = Message_Handling($wrong_clients,'Error',$Font);

            }

            if(empty($First)){

                $Eroor_message[] = Message_Handling($wrong_Owner,'Error',$Font);

            }
            if(empty($Secound)){

                $Eroor_message[] = Message_Handling($wrong_Owner,'Error',$Font);

            }

            if(strlen($number) <= 10){

                $Eroor_message[] = Message_Handling($wrong_number,'Error',$Font);

            }

            if(!empty($Eroor_message)){ ?>

                <div class="container"> 
                    <div class="row">
                        <?php echo Alert_Message($Eroor_message); ?>
                    </div>
                </div>

                <?php

                }else{

                    $sql = 'INSERT INTO clients SET
                    Clietns_name = "'.$clients.'",
                    First_name_owner = "'.$First.'",
                    Secound_name_owner = "'.$Secound.'",
                    Number = "'.$number.'",
                    Status = "'.$Status.'",
                    Image = "'.$image_name.'",
                    Date  = "'.$Date.'"
                    ';

                    $res = mysqli_query($Connection , $sql);

                    if($res == true){

                        echo "Your Data Is Inserted";

                    }else{

                        echo "Your Data Is not Inserted";


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


    }elseif($do == "Edit"){ ?>
        <?php 

        if($_SESSION['U_Account_Type'] == "Admin"){?>
            <?php 
                if(isset($_GET['ID']) && isset($_GET['image'])){?>

                <?php
                    $id = $_GET['ID'];
                    $image = $_GET['image'];

                    $sql = 'SELECT * FROM clients WHERE clients_id = "'.$id.'"';
                    $res = mysqli_query($Connection , $sql);

                    if($res == true){

                        $count = mysqli_num_rows($res);

                        if($count > 0 ){

                            while($rows = mysqli_fetch_assoc($res)){

                                $client_name = $rows['Clietns_name'];
                                $first_name = $rows['First_name_owner'];
                                $secound_name = $rows['Secound_name_owner'];
                                $number = "0". $rows['Number'];
                                $Status = $rows['Status'];
                            
                            }

                            ?>
                            <div class="container-fluid">
                                                    <div class="row task-mangement">
                                                        <div class="title">Add Clients </div>
                                                        <form action="?do=Edites" Method="POST" enctype="multipart/form-data">
                                                            <div class="row form-g-user">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1" class="label">Clients</label>
                                                                        <input type="text" class="form-control" name="Clients" placeholder="Clients" value="<?php echo $client_name; ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1" class="label">Status</label>
                                                                        <select class="form-control" name="Status">
                                                                            <option value="Active" <?php if($Status == "Active") {echo "selected";} ?>>Active</option>
                                                                        </select>                            
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1" class="label">First_Name_Owner</label>
                                                                        <input type="text" class="form-control" name="First_Name_Owner" placeholder="Owner" value="<?php echo $first_name; ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1" class="label">Secound_Name_Owner</label>
                                                                        <input type="text" class="form-control" name="Secound_Name_Owner" placeholder="Owner" value="<?php echo $secound_name; ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1" class="label">Number_phone</label>
                                                                        <input type="number" class="form-control" name="Number_phone" placeholder="Number_phone" value="<?php echo $number; ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <p class="label"> Image </p>
                                                                        <input type="file" class="form-control-file" name="image">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <img src="<?php echo "Images/Clients/".$image ?>" alt="" style="width : 400px;"/>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" value="<?php echo $id; ?>" alt="" name="id"/>
                                                            <input type="hidden" value="<?php echo $image; ?>" alt="" name="image"/>
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
                        ?>
        
                        <div class="Eroor_page">
                            <div class="eroor_Text">
                                <p> This Page Not Fount 404</p>
                            </div>
                        </div>
                
                    <?php
                        
                    }

                }
            
        
            }else{?>
        
        <div class="Eroor_page">
            <div class="eroor_Text">
                <p> This Page Not Fount 404</p>
            </div>
        </div>

    <?php
    }   
    }elseif($do == "Edites"){

    if($_SERVER['REQUEST_METHOD'] =="POST"){

        $Eroor_message = array();

        $Clients = filter_var($_POST['Clients'], FILTER_SANITIZE_STRING);
        $Status = filter_var($_POST['Status'], FILTER_SANITIZE_STRING);
        $First_Name_Owner = filter_var($_POST['First_Name_Owner'], FILTER_SANITIZE_STRING);
        $Secound_Name_Owner = filter_var($_POST['Secound_Name_Owner'], FILTER_SANITIZE_STRING);
        $Number_phone = $_POST['Number_phone'];
        $id = $_POST['id'];
        $image = $_POST['image'];

        if(empty($Clients)){

            $Eroor_message[] = Message_Handling($wrong_Owner,'Error',$Font);

        }

        if(empty($First_Name_Owner)){

            $Eroor_message[] = Message_Handling($wrong_Owner,'Error',$Font);

        }

        if(empty($Secound_Name_Owner)){

            $Eroor_message[] = Message_Handling($wrong_Owner,'Error',$Font);

        }

        if(empty($Number_phone)){

            $Eroor_message[] = Message_Handling($wrong_number,'Error',$Font);

        }


        if(isset($_FILES['image']['name'])){

            if($image !=''){

                $remove_path = "Images/Clients/".$image;

                $remove = unlink($remove_path);

                if($remove == FALSE){
            
                    echo 'there is no unlink here';

                }

            }

            $image_name = $_FILES['image']['name'];

            $ext = explode('.',$image_name);

            $final = end($ext);

            $image_name = "Clients_".rand(0,9999).".".$final;

            $destination_path = "Images/Clients/".$image_name;

            $source_path = $_FILES['image']['tmp_name'];

            $upload = move_uploaded_file($source_path , $destination_path);
    
    
            if($upload == false){

                $image_name = $image;

            }

        }else{

            $image_name = $image;
        }


        $sql = 'UPDATE clients SET
        Clietns_name = "'.$Clients.'",
        First_name_owner ="'.$First_Name_Owner.'",
        Secound_name_owner ="'.$Secound_Name_Owner.'",
        Number ="'.$Number_phone.'",
        Image ="'.$image_name.'"
        WHERE clients_id ="'.$id.'"';

        $res = mysqli_query($Connection , $sql);

        if($res == true){

            echo "Updated";

        }else{

            echo "No Updated";
        }
    }
    }elseif($do == "Delete"){

        if(isset($_GET['ID'])){


            $id = filter_var($_GET['ID'],FILTER_VALIDATE_INT);


            $sql = 'SELECT * FROM clients WHERE clients_id ="'.$id.'"';

            $res = mysqli_query($Connection , $sql);

            if($res == true){

                $coulm = mysqli_num_rows($res);

                if($coulm > 0){

                    while($rows =  mysqli_fetch_assoc($res)){
                            $username     =  filter_var($rows['Clietns_name'],FILTER_SANITIZE_STRING);
                            $Active       =  filter_var($rows['Status'], FILTER_SANITIZE_STRING); 
                    }
                    ?>
                    <div class="container-fluid">
                        <div class="row task-mangement">
                            <div class="title">Delete Client </div>
                            <form method="POST" action="?do=Deletefinal">
                                <div class="row form-g-user">
                                    <div class="col-lg-6">
                                    <h2> <span> Client Is </span> <span class="main-color"> <?php echo $username; ?></span> </h2>
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

                                    <input type="hidden" class="form-control-file" name="id" value="<?php echo $id; ?>">
                                    <input type="hidden" class="form-control-file" name="status" value="<?php echo $Active; ?>">
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



    }elseif($do == "Archive"){?>

        <?php if($_SESSION['U_Account_Type'] == "Admin") : ?>
            <div class="container-fluid">
                <div class="row task-mangement">
                        <h4 class="mb-5"> Archive Clients </h4>
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Client</th>
                                <th>Name</th>
                                <th>Number</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql = 'SELECT * FROM clients WHERE Status = "UnActive"';

                                        $res = mysqli_query($Connection , $sql);

                                        if($res == true){

                                            $coulm = mysqli_num_rows($res);

                                            if($coulm > 0){

                                                $counter = 1;

                                                while($rows =  mysqli_fetch_assoc($res)){ ?>

                                                    <tr>
                                                        <td> <?php echo $counter++; ?> </td>
                                                        <td>
                                                            <img src=" <?php echo "Images/Clients/".$rows['Image'] ?>" alt="" style="width : 60px; height: 50px; object-fit: cover;" class="rounded-image"/> 
                                                            <?php echo $rows['Clietns_name']; ?> 
                                                        </td>
                                                        <td colspan="2"> <?php echo  $rows['First_name_owner'] . " " .$rows['Secound_name_owner']; ?> </td>
                                                        <td> <?php echo "0". $rows['Number']; ?> </td>
                                                        <td> <?php echo  $rows['Status']; ?> </td>
                                                        <td colspan="2"> 
                                                            <a href="?do=Restore&ID=<?php echo $rows['clients_id'];?>" class="btn btn-primary">Restore</a>
                                                            <a href="Profile?do=Clients&id=<?php echo  $rows['clients_id']; ?>" class="btn btn-success">View Client</a>
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
                $reason = "";

                $status = filter_var("Active", FILTER_SANITIZE_STRING);

                $sql = 'SELECT * FROM clients WHERE clients_id = "'.$id.'"';

                $res = mysqli_query($Connection , $sql);

                if($res == true){

                    $count = mysqli_num_rows($res);

                    if($count > 0){

                        $sql2 = 'UPDATE clients SET
                        Status = "'.$status.'",
                        Reason = "'.$reason.'"
                        WHERE clients_id = "'.$id.'"';
            
                        $res2 = mysqli_query($Connection,$sql2);
            
                        if($res2 == true){
            
                            echo("<script> location.href = 'http://localhost/MSA-Demo/Clients?do=Manage';</script>");
            
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


    }elseif($do == "Deletefinal"){

        if($_SESSION['U_Account_Type'] =="Admin"){

            if($_SERVER['REQUEST_METHOD'] =="POST"){

                    $id = $_POST['id'];

                    $reason = filter_var($_POST['reason'],FILTER_SANITIZE_STRING);
    
                    $sql = 'SELECT * FROM clients WHERE clients_id = "'.$id.'"';
    
                    $res = mysqli_query($Connection , $sql);
    
                    if($res == true){
    
                        $count = mysqli_num_rows($res);
    
                        if($count > 0){
    
                            $sql2 = 'UPDATE clients SET
                            Status = "UnActive",
                            Reason = "'.$reason.'"
                            WHERE clients_id = "'.$id.'"';
    
                            $res2 = mysqli_query($Connection , $sql2);
    
                            if($res2 == true){
    
                                echo("<script> location.href = 'http://localhost/MSA-Demo/Clients?do=Manage';</script>");
    
                            }else{
    
                                echo "your data is Not Deleted";
                            }
    
                        }else{ ?>
                                <div class="Eroor_page">
                                    <div class="eroor_Text">
                                        <p> This Page Not Fount 404</p>
                                    </div>
                                </div>
    
                            <?php
                        }
    
    
                    }else{
    
                        echo "No Data Here";
                    }
    
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