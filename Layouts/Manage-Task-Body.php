<?php

    if(isset($_SESSION['Manager_Task'])):

?>

<?php
    

    $do = isset($_GET['do']) ? $_GET['do'] : "Manage";

    if($do == "Manage"){?>
            <div class="container-fluid">
                <div class="add">
                    <a href="?do=Add" class="btn btn-primary edit-submit">Add Task</a>
                    <a href="?do=task" class="btn btn-primary edit-submit">Task To Me</a>
                </div>
                </div>
                <div class="container-fluid">
                <div class="row task-mangement">
                        <h4 class="mb-5"> Manage Task </h4>
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>From</th>
                                    <th>TO</th>
                                    <th>Client</th>
                                    <th>Task</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if($_SESSION['U_Account_Type'] == "User"){

                                        $ID_USER = $_SESSION['U_ID'];


                                        $sql ='SELECT * ,users.U_First_Name AS Firstname , users.U_Second_Name AS Sexoundname, users.Image AS imagename,clients.Clietns_name As Nameclients, clients.Image AS ImagenameClient,task.date AS datetask FROM task  INNER JOIN users ON task.id_user = users.U_ID INNER JOIN clients ON task.id_clients = clients.clients_id  WHERE Conditions="Pending" AND state="Active" AND id_user_now = "'.$ID_USER.'" ORDER BY id_Task DESC';

                                    }else{

                                        $sql ='SELECT * ,users.U_First_Name AS Firstname , users.U_Second_Name AS Sexoundname, users.Image AS imagename,clients.Clietns_name As Nameclients, clients.Image AS ImagenameClient,task.date AS datetask FROM task  INNER JOIN users ON task.id_user = users.U_ID INNER JOIN clients ON task.id_clients = clients.clients_id   WHERE Conditions="Pending" AND state="Active" ORDER BY id_Task DESC';

                                    }

                                    $res = mysqli_query($Connection , $sql);

                                    if($res ==true){

                                        $count = mysqli_num_rows($res);

                                        if($count > 0){
                                            $counter = 1;
                                            while($rows = mysqli_fetch_assoc($res)){?>
                                                <tr>
                                                    <td> <?php echo $counter++; ?> </td>
                                                    <td> <?php echo $rows['user_now']; ?> </td>
                                                    <td> <span> <img src="<?php echo "Images/users/".$rows['imagename']; ?>" alt="" style="width : 60px; height: 50px; object-fit: cover;" class="rounded-image"/> </span> <?php echo $rows['Firstname'] ." ".$rows['Sexoundname']; ?>  </td>
                                                    <td> <span><img src="<?php echo "Images/Clients/".$rows['ImagenameClient']; ?>" alt="" style="width : 60px; height: 50px; object-fit: cover;" class="rounded-image"/></span> <?php echo $rows['Nameclients']; ?></td>
                                                    <td> <?php output($rows['Task'],20); ?></td>
                                                    <td> <?php echo $rows['datetask']; ?></td>
                                                    <td> <span class="pending">  <?php echo $rows['Conditions'];?> </span></td>
                                                    <td>
                                                        <a href="Profile?do=Task&id=<?php echo $rows['id_Task']; ?>" class="btn btn-success">View Task</a>
                                                    </td>
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
    }elseif($do == "Add"){?>
        <div class="container-fluid">
                <div class="row task-mangement">
                    <div class="title">Add Task </div>
                    <form method="POST" action="?do=Insert">
                        <div class="row form-g-user">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <main>
                                        <textarea id="editor" name="task">
                                        </textarea>
                                    </main>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="label">Select User</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="user">
                                        <?php 
                                            $cheack_admin = $_SESSION['U_Account_Type'];

                                            if($cheack_admin == "User"){


                                                $sql = 'SELECT * FROM users WHERE U_Status = "Active" AND U_Account_Type != "Admin" AND U_ID !="'.$_SESSION['U_ID'].'"';

                                                $res =  mysqli_query($Connection , $sql);

                                                if($res == true){

                                                    $count = mysqli_num_rows($res);

                                                    if($count > 0){

                                                        while($rows = mysqli_fetch_assoc($res)){?>


                                                        <option value="<?php echo $rows['U_ID']; ?>"><span> <img src="<?php echo "Images/users/".$rows['Image'] ?>" alt="" style="width : 60px; height: 50px; object-fit: cover; margin-right : 5px;" /> </span> <span> <?php echo $rows['U_First_Name'] . " " . $rows['U_Second_Name'] ?> </span></option>


                                                        <?php
                                                        }


                                                    }else{



                                                    }


                                                }else{



                                                }


                                            }else{

                                                $sql = 'SELECT * FROM users WHERE U_Status = "Active" AND U_ID !="'.$_SESSION['U_ID'].'"';

                                                $res =  mysqli_query($Connection , $sql);

                                                if($res == true){

                                                    $count = mysqli_num_rows($res);

                                                    if($count > 0){

                                                        while($rows = mysqli_fetch_assoc($res)){?>
                                                            <option value="<?php echo $rows['U_ID']; ?>"> 
                                                                <?php echo $rows['U_First_Name'] . " " . $rows['U_Second_Name']; ?>
                                                            </option>
                                                        <?php
                                                        }


                                                    }else{



                                                    }


                                                }else{



                                                }


                                            }


                                        ?>

                                    </select>                            
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="label">Select Client</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="Client">
                                        <?php 

                                                $sql = 'SELECT * FROM clients WHERE Status = "Active"';

                                                $res =  mysqli_query($Connection , $sql);

                                                if($res == true){

                                                    $count = mysqli_num_rows($res);

                                                    if($count > 0){

                                                        while($rows = mysqli_fetch_assoc($res)){?>


                                                        <option value="<?php echo $rows['clients_id']; ?>"> <span> <?php echo $rows['Clietns_name']; ?> </span></option>


                                                        <?php
                                                        }


                                                    }else{


                                                    }

                                                }else{

                                                }
                                                ?>
                                    </select>                            
                                </div>
                            </div>
                            <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="label">Title</label>
                                        <input type="text" class="form-control" name="Title" placeholder="Title">
                                    </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="label">Status</label>
                                    <select class="form-control"  name="Status">
                                        <option>Active</option>
                                        <option>UnActive</option>
                                    </select>                            
                                </div>
                            </div>
                            <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="label">Data</label>
                                        <input type="date" class="form-control"  name="Data">
                                    </div>
                            </div>
                        </div>
                        <input type="hidden" value="<?php echo $_SESSION['U_ID'] ?>" name ="Usernow"/>
                        <button type="submit" class="btn btn-primary edit-submit mt-5">Submit</button>
                    </form>
                </div>
        </div>
        <?php
    }elseif($do == "Insert"){

        if($_SERVER['REQUEST_METHOD'] =="POST"){

            $id = $_POST['Usernow'];
            $task = filter_var($_POST['task'], FILTER_SANITIZE_STRING);
            $user =   $_POST['user'];
            $Clients = $_POST['Client'];
            $Title = filter_var($_POST['Title'], FILTER_SANITIZE_STRING);
            $Status = filter_var($_POST['Status'], FILTER_SANITIZE_STRING);
            $Data = $_POST['Data'];


            $FullName = $_SESSION['U_First_Name']." ".$_SESSION['U_Second_Name'];

            $Eroor_message = array();

            if(empty($task)){

                $Eroor_message[] = Message_Handling($wrong_task,'Error',$Font);

            }

            if(empty($Title)){

                $Eroor_message[] = Message_Handling($wrong_Title,'Error',$Font);

            }

            if(empty($Data)){

                $Eroor_message[] = Message_Handling($wrong_Data,'Error',$Font);

            }

            if(!empty($Eroor_message)){ ?>
                <div class="container"> 
                    <div class="row">
                        <?php echo Alert_Message($Eroor_message); ?>
                    </div>
                </div>
            <?php
            }else{

                $sql = 'INSERT INTO task SET
                id_user = "'.$user.'",
                id_clients ="'.$Clients.'",
                Task = "'.$task.'",
                title = "'.$Title.'",
                user_now = "'.$FullName.'",
                state = "'.$Status.'",
                date ="'.$Data.'",
                Conditions ="Pending",
                id_user_now ="'.$id.'"
                ';

                $res = mysqli_query($Connection , $sql);

                if($res == true){

                    echo("<script> location.href = 'http://localhost/MSA-Demo/Manage-Task?do=Manage';</script>");

                }else{

                    echo "your data is not inserted";

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
    
    }elseif($do == "task"){
        ?>
            <div class="container-fluid">
            <div class="row task-mangement">
                    <h4 class="mb-5"> Manage Task </h4>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>From</th>
                                <th>TO</th>
                                <th>Client</th>
                                <th>Task</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $ID_USER = $_SESSION['U_ID'];
                                $sql ='SELECT task.*,users.U_First_Name AS Firstname , users.U_Second_Name AS Sexoundname, users.Image AS imagename,clients.Clietns_name As Nameclients, clients.Image AS ImagenameClient FROM task INNER JOIN users ON task.id_user = users.U_ID INNER JOIN clients ON task.id_clients = clients.clients_id WHERE Conditions="Pending" AND state="Active" AND id_user = "'.$ID_USER.'"';

                                $res = mysqli_query($Connection , $sql);

                                if($res ==true){

                                    $count = mysqli_num_rows($res);

                                    if($count > 0){
                                        $counter = 1;
                                        while($rows = mysqli_fetch_assoc($res)){?>
                                            <tr>
                                                <td> <?php echo $counter++; ?> </td>
                                                <td> <?php echo $rows['user_now']; ?> </td>
                                                <td> <span> <img src="<?php echo "Images/users/".$rows['imagename']; ?>" alt="" style="width : 60px; height: 50px; object-fit: cover;" class="rounded-image"/> </span> <?php echo $rows['Firstname'] ." ".$rows['Sexoundname']; ?>  </td>
                                                <td> <span><img src="<?php echo "Images/Clients/".$rows['ImagenameClient']; ?>" alt="" style="width : 60px; height: 50px; object-fit: cover;" class="rounded-image"/></span> <?php echo $rows['Nameclients']; ?></td>
                                                <td> <?php output($rows['Task'],20); ?></td>
                                                <td> <?php echo $rows['date']; ?></td>
                                                <td> <?php echo $rows['Conditions'];?></td>
                                                <td> 
                                                    <a href="?do=Edit&ID=<?php echo $rows['id_Task'];?>" class="btn btn-primary">Edit</a>
                                                    <a href="Profile?do=TaskToMe&id=<?php echo $rows['id_Task']; ?>" class="btn btn-success">View Task</a>

                                                </td>
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
    }elseif($do == "Edit"){ ?>
        <?php
            $ID_USER = $_SESSION['U_ID'];

            if(isset($_GET['ID'])){

                $id = $_GET['ID'];

                $sql ='SELECT task.*,users.U_First_Name AS Firstname , users.U_Second_Name AS Sexoundname, users.Image AS imagename,clients.Clietns_name As Nameclients, clients.Image AS ImagenameClient FROM task INNER JOIN users ON task.id_user = users.U_ID INNER JOIN clients ON task.id_clients = clients.clients_id WHERE Conditions="Pending" AND state="Active" AND id_user = "'.$ID_USER.'" AND id_Task ="'.$id.'"';

                $res = mysqli_query($Connection , $sql);

                if($res == true){

                    $count = mysqli_num_rows($res);

                    if($count > 0){

                        while($rows = mysqli_fetch_assoc($res)){

                            $id = $rows['id_Task'];
                            $id_user = $rows['id_user'];
                            $id_clients = $rows['id_clients'];
                            $task = $rows['Task'];
                            $usernow = $rows['user_now'];
                            $title = $rows['title'];
                            $date = $rows['date'];
                            $Conditions = $rows['Conditions'];
                            $id_user_now = $rows['id_user_now'];

                        } ?>

                        <div class="container-fluid">
                                <div class="row task-mangement">
                                    <div class="title">Edit Task </div>
                                    <form method="POST" action="?do=Edites">
                                        <div class="row form-g-user">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <main>
                                                        <textarea id="editor" name="task">
                                                            <?php echo $task; ?>
                                                        </textarea>
                                                    </main>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1" class="label">Select User</label>
                                                    <select class="form-control" id="exampleFormControlSelect1" name="user">
                                                        <?php 
                                                            $cheack_admin = $_SESSION['U_Account_Type'];

                                                            if($cheack_admin == "User"){


                                                                $sql = 'SELECT * FROM users WHERE U_Status = "Active" AND U_Account_Type != "Admin" AND U_ID !="'.$_SESSION['U_ID'].'"';

                                                                $res =  mysqli_query($Connection , $sql);

                                                                if($res == true){

                                                                    $count = mysqli_num_rows($res);

                                                                    if($count > 0){

                                                                        while($rows = mysqli_fetch_assoc($res)){?>


                                                                        <option value="<?php echo $rows['U_ID']; ?>" <?php if($id_user == $rows['U_ID']){ echo "selected"; } ?>><span> <img src="<?php echo "Images/users/".$rows['Image'] ?>" alt="" style="width : 60px; height: 50px; object-fit: cover; margin-right : 5px;" /> </span> <span> <?php echo $rows['U_First_Name'] . " " . $rows['U_Second_Name'] ?> </span></option>


                                                                        <?php
                                                                        }


                                                                    }else{



                                                                    }


                                                                }else{



                                                                }


                                                            }else{

                                                                $sql = 'SELECT * FROM users WHERE U_Status = "Active" AND U_ID !="'.$_SESSION['U_ID'].'"';

                                                                $res =  mysqli_query($Connection , $sql);

                                                                if($res == true){

                                                                    $count = mysqli_num_rows($res);

                                                                    if($count > 0){

                                                                        while($rows = mysqli_fetch_assoc($res)){?>
                                                                            <option value="<?php echo $rows['U_ID']; ?>" <?php if($rows['U_ID'] == $id_user) { echo "selected";} ?>> 
                                                                                <?php echo $rows['U_First_Name'] . " " . $rows['U_Second_Name']; ?>
                                                                            </option>
                                                                        <?php
                                                                        }


                                                                    }else{



                                                                    }


                                                                }else{



                                                                }


                                                            }


                                                        ?>

                                                    </select>                            
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1" class="label">Select Client</label>
                                                    <select class="form-control" id="exampleFormControlSelect1" name="Client">
                                                        <?php 

                                                                $sql = 'SELECT * FROM clients WHERE Status = "Active"';

                                                                $res =  mysqli_query($Connection , $sql);

                                                                if($res == true){

                                                                    $count = mysqli_num_rows($res);

                                                                    if($count > 0){

                                                                        while($rows = mysqli_fetch_assoc($res)){?>


                                                                        <option value="<?php echo $rows['clients_id']; ?>" <?php if($id_clients == $rows['clients_id']){ echo "selected"; } ?>> <span> <?php echo $rows['Clietns_name']; ?> </span></option>


                                                                        <?php
                                                                        }


                                                                    }else{


                                                                    }

                                                                }else{

                                                                }
                                                                ?>
                                                    </select>                            
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" class="label">Title</label>
                                                        <input type="text" class="form-control" name="Title" placeholder="Title" value ="<?php echo $title; ?>">
                                                    </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1" class="label">Status</label>
                                                    <select class="form-control"  name="Status">
                                                        <option>Active</option>
                                                    </select>                            
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1" class="label">Your Task</label>
                                                    <select class="form-control"  name="Conditions">
                                                        <option Value="Complete">Complete</option>
                                                        <option Value="UnComplete">UnComplete</option>
                                                    </select>                            
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" value="<?php echo $_SESSION['U_ID'] ?>" name ="Usernow"/>
                                        <input type="hidden" value="<?php echo $id; ?>" name ="id"/>
                                        <button type="submit" class="btn btn-primary edit-submit mt-5">Submit</button>
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
            }else{

                ?>
                    <div class="Eroor_page">
                        <div class="eroor_Text">
                            <p> This Page Not Fount 404</p>
                        </div>
                    </div>
                <?php

            }


    }elseif($do == "Edites"){

        if($_SERVER['REQUEST_METHOD'] =="POST"){

            $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
            $Usernow = filter_var($_POST['Usernow'], FILTER_VALIDATE_INT);
            $Conditions = $_POST['Conditions'];
            $Status = $_POST['Status'];
            $Title = $_POST['Title'];
            $Client = $_POST['Client'];
            $user = $_POST['user'];
            $task = filter_var($_POST['task'],FILTER_SANITIZE_STRING);
            $date_now = CurrentDate();

            $full_name = $_SESSION['U_First_Name'] ." ".$_SESSION['U_Second_Name'];


            $Eroor_message = array();

            if(empty($task)){

                $Eroor_message[] = Message_Handling($wrong_task,'Error',$Font);

            }

            if(empty($Title)){

                $Eroor_message[] = Message_Handling($wrong_Title,'Error',$Font);

            }


            if(!empty($Eroor_message)){ ?>
                <div class="container"> 
                    <div class="row">
                        <?php echo Alert_Message($Eroor_message); ?>
                    </div>
                </div>
            <?php
            }else{

                $sql = 'UPDATE task SET
                id_user = "'.$user.'",
                id_clients = "'.$Client.'",
                Task = "'.$task.'",
                user_now = "'.$full_name.'",
                title = "'.$Title.'",
                state= "'.$Status.'",
                Conditions = "'.$Conditions.'",
                id_user_now = "'.$Usernow.'",
                Date_After_Task	 = "'.$date_now.'"
                WHERE id_Task = "'.$id.'"';

                $res = mysqli_query($Connection , $sql);

                if($res == true){

                    echo("<script> location.href = 'http://localhost/MSA-Demo/Manage-Task?do=Manage';</script>");

                }else{

                    echo "Your Data Is Not Updated";

                }

            }
        

        }

    }
    
    ?>
   <?php else : ?>
        <div class="Eroor_page">
            <div class="eroor_Text">
                <p> This Page Not Fount 404</p>
            </div>
        </div>
        <?php
endif;

?>

