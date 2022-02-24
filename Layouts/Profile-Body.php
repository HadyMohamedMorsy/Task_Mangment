


<?php 

$do = isset($_GET['do']) ? $_GET['do'] : "Manage";

if($do == "Manage"){

    $cheack = $_SESSION['U_Account_Type'];

    if($cheack == "Admin"){

        if(isset($_GET['id'])){

            $id = filter_var($_GET['id'],FILTER_VALIDATE_INT);
    
            $sql = 'SELECT * FROM users  INNER JOIN department ON users.ID_Department = department.ID_D  WHERE U_ID = "'.$id.'"';
    
            $res = mysqli_query($Connection , $sql);
    
            if($res == true){
    
                $count = mysqli_num_rows($res);
    
                if($count > 0){
    
                    while($rows = mysqli_fetch_assoc($res)){ ?>
                        <div class="prfile-box">
                            <div class="container">
                                <div class="profile_image">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="d-flex justify-content-center">
                                                <img src="<?php echo "Images/users/".$rows['Image']; ?>" alt="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row content-details">
                                            <div class="col-lg-4 spacing">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1" class="title">U_First_Name</label>
                                                    <input type="Text" class="form-control"  disabled value="<?php echo $rows['U_First_Name']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 spacing">
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1" class="title">U_Second_Name</label>
                                                    <input type="Text" class="form-control"  disabled value="<?php echo $rows['U_Second_Name']; ?>">
                                                </div>
                                            </div>
                                        <div class="col-lg-4 spacing">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1" class="title">U_Third_Name</label>
                                                <input type="Text" class="form-control"  disabled value="<?php echo $rows['U_Third_Name']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 spacing">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1" class="title">Gender</label>
                                                <input type="Text" class="form-control"  disabled value="<?php echo $rows['Gender']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 spacing">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1" class="title">U_Account_Type</label>
                                                <input type="Text" class="form-control"  disabled value="<?php echo $rows['U_Account_Type']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 spacing">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1" class="title">Department</label>
                                                <input type="Text" class="form-control"  disabled value="<?php echo $rows['Department']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 spacing">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1" class="title">Contact</label>
                                                <input type="Text" class="form-control"  disabled value="<?php echo "0". $rows['Contact']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 spacing">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1" class="title">card_number</label>
                                                <input type="Text" class="form-control"  disabled value="<?php echo $rows['card_number']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 spacing">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1" class="title">Date</label>
                                                <input type="Text" class="form-control"  disabled value="<?php echo $rows['date']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 spacing">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1" class="title">extinstions</label>
                                                <input type="Text" class="form-control"  disabled value="<?php echo $rows['extinstions']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 spacing">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1" class="title">Email</label>
                                                <input type="Text" class="form-control"  disabled value="<?php echo $rows['Email']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 spacing">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1" class="title">Adress</label>
                                                <textarea type="Text" class="form-control"  disabled> <?php echo $rows['Adress']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 spacing">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1" class="title">Reason</label>
                                                <textarea type="Text" class="form-control"  disabled> <?php echo $rows['Reason']; ?> </textarea>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
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



    
}elseif($do == "Person"){

        if(isset($_GET['id'])){

            $id = filter_var($_GET['id'],FILTER_VALIDATE_INT);
    
            $sql = 'SELECT * FROM users  INNER JOIN department ON users.ID_Department = department.ID_D  WHERE U_ID = "'.$id.'"';
    
            $res = mysqli_query($Connection , $sql);
    
            if($res == true){
    
                $count = mysqli_num_rows($res);
    
                if($count > 0){
    
                    while($rows = mysqli_fetch_assoc($res)){ ?>
                        <div class="prfile-box">
                            <div class="container">
                                <div class="profile_image">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="d-flex justify-content-center">
                                                <img src="<?php echo "Images/users/".$rows['Image']; ?>" alt="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row content-details">
                                            <div class="col-lg-4 spacing">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1" class="title">U_First_Name</label>
                                                    <input type="Text" class="form-control"  disabled value="<?php echo $rows['U_First_Name']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 spacing">
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1" class="title">U_Second_Name</label>
                                                    <input type="Text" class="form-control"  disabled value="<?php echo $rows['U_Second_Name']; ?>">
                                                </div>
                                            </div>
                                        <div class="col-lg-4 spacing">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1" class="title">U_Third_Name</label>
                                                <input type="Text" class="form-control"  disabled value="<?php echo $rows['U_Third_Name']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 spacing">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1" class="title">Gender</label>
                                                <input type="Text" class="form-control"  disabled value="<?php echo $rows['Gender']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 spacing">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1" class="title">U_Account_Type</label>
                                                <input type="Text" class="form-control"  disabled value="<?php echo $rows['U_Account_Type']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 spacing">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1" class="title">Department</label>
                                                <input type="Text" class="form-control"  disabled value="<?php echo $rows['Department']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 spacing">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1" class="title">Contact</label>
                                                <input type="Text" class="form-control"  disabled value="<?php echo "0". $rows['Contact']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 spacing">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1" class="title">card_number</label>
                                                <input type="Text" class="form-control"  disabled value="<?php echo $rows['card_number']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 spacing">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1" class="title">Email</label>
                                                <input type="Text" class="form-control"  disabled value="<?php echo $rows['Email']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 spacing">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1" class="title">Adress</label>
                                                <textarea type="Text" class="form-control"  disabled> <?php echo $rows['Adress']; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
    
    
    
        }else{
    
            ?>
                <div class="Eroor_page">
                    <div class="eroor_Text">
                        <p> This Page Not Fount 404</p>
                    </div>
                </div>
            <?php
    
        }
}elseif($do == "Action"){

    if(isset($_GET['id'])){

        $id = filter_var($_GET['id'],FILTER_VALIDATE_INT);

        $sql = 'SELECT * FROM action  INNER JOIN users ON users.U_ID = action.Id_User INNER JOIN clients ON clients.clients_id = action.client_id   WHERE Action_id = "'.$id.'"';

        $res = mysqli_query($Connection , $sql);

        if($res == true){

            $count = mysqli_num_rows($res);

            if($count > 0){

                while($rows = mysqli_fetch_assoc($res)){ ?>
                    <div class="prfile-box">
                        <div class="container">
                            <div class="profile_image">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-center">
                                            <img src="<?php echo "Images/Clients/".$rows['Image']; ?>" alt="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row content-details">
                                        <div class="col-lg-6 spacing">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="title">User Put This Actions</label>
                                                <input type="Text" class="form-control"  disabled value="<?php echo $rows['U_First_Name'] ." ".$rows['U_Second_Name']; ?>">
                                            </div>
                                        </div>
                                    <div class="col-lg-6 spacing">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1" class="title">U_Account_Type</label>
                                            <input type="Text" class="form-control"  disabled value="<?php echo $rows['U_Account_Type']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 spacing">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1" class="title">Date</label>
                                            <input type="Text" class="form-control"  disabled value="<?php echo $rows['Date']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 spacing">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1" class="title">The Action</label>
                                            <textarea type="Text" class="form-control"  disabled> <?php echo $rows['Action']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
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



    }else{

        ?>
            <div class="Eroor_page">
                <div class="eroor_Text">
                    <p> This Page Not Fount 404</p>
                </div>
            </div>
        <?php

    }
}elseif($do == "Clients"){

    $cheack = $_SESSION['U_Account_Type'];

    if($cheack == "Admin"){
        
        if(isset($_GET['id'])){

            $id = filter_var($_GET['id'],FILTER_VALIDATE_INT);
    
            $sql = 'SELECT * FROM  clients  WHERE clients_id = "'.$id.'"';
    
            $res = mysqli_query($Connection , $sql);
    
            if($res == true){
    
                $count = mysqli_num_rows($res);
    
                if($count > 0){
    
                    while($rows = mysqli_fetch_assoc($res)){ ?>
                        <div class="prfile-box">
                            <div class="container">
                                <div class="profile_image">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="d-flex justify-content-center">
                                                <img src="<?php echo "Images/Clients/".$rows['Image']; ?>" alt="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row content-details">
                                        <div class="col-lg-6 spacing">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="title">Client_Name</label>
                                                <input type="Text" class="form-control"  disabled value="<?php echo $rows['Clietns_name']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 spacing">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="title">User Put This Actions</label>
                                                <input type="Text" class="form-control"  disabled value="<?php echo $rows['First_name_owner'] ." ".$rows['Secound_name_owner']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 spacing">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1" class="title">Number</label>
                                                <input type="Text" class="form-control"  disabled value="<?php echo "0".$rows['Number']; ?>">
                                            </div>
                                        </div>

                                        <?php if(!empty($rows['Reason'])) : ?>
                                        <div class="col-lg-12 spacing">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1" class="title">The Action</label>
                                                <textarea type="Text" class="form-control"  disabled> <?php echo $rows['Reason']; ?></textarea>
                                            </div>
                                        </div>

                                        <?php endif; ?>

                                    </div>
                                </div>
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
}elseif($do == "Task"){
    if(isset($_GET['id'])){

        $id = filter_var($_GET['id'],FILTER_VALIDATE_INT);

        $sql = 'SELECT *, task.date  AS Date_task,users.Image AS imageuser FROM task  INNER JOIN users ON users.U_ID = task.id_user INNER JOIN clients ON clients.clients_id = task.id_clients   WHERE id_Task = "'.$id.'"';

        $res = mysqli_query($Connection , $sql);

        if($res == true){

            $count = mysqli_num_rows($res);

            if($count > 0){

                while($rows = mysqli_fetch_assoc($res)){ ?>
                    <div class="prfile-box">
                        <div class="container">
                            <div class="profile_image">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-center">
                                            <img src="<?php echo "Images/users/".$rows['imageuser']; ?>" alt="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row content-details">
                                    <div class="col-lg-6 spacing">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="title">Sender</label>
                                            <input type="Text" class="form-control"  disabled value="<?php echo $rows['user_now']?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 spacing">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="title">Recevier</label>
                                            <input type="Text" class="form-control"  disabled value="<?php echo $rows['U_First_Name'] . " " .$rows['U_Second_Name'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 spacing">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1" class="title">Client</label>
                                            <input type="Text" class="form-control"  disabled value="<?php echo $rows['Clietns_name']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 spacing">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1" class="title">Date</label>
                                            <input type="Text" class="form-control"  disabled value="<?php echo $rows['Date_task']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 spacing">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1" class="title">The Task</label>
                                            <textarea type="Text" class="form-control"  disabled> <?php echo $rows['Task']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
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



    }else{

        ?>
            <div class="Eroor_page">
                <div class="eroor_Text">
                    <p> This Page Not Fount 404</p>
                </div>
            </div>
        <?php

    }
}elseif($do == "TaskToMe"){
    if(isset($_GET['id'])){

        $id = filter_var($_GET['id'],FILTER_VALIDATE_INT);

        $sql = 'SELECT *, task.date  AS Date_task,users.Image AS imageuser FROM task  INNER JOIN users ON users.U_ID = task.id_user INNER JOIN clients ON clients.clients_id = task.id_clients   WHERE id_Task = "'.$id.'"';

        $res = mysqli_query($Connection , $sql);

        if($res == true){

            $count = mysqli_num_rows($res);

            if($count > 0){

                while($rows = mysqli_fetch_assoc($res)){ ?>
                    <div class="prfile-box">
                        <div class="container">
                            <div class="profile_image">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-center">
                                            <img src="<?php echo "Images/users/".$rows['imageuser']; ?>" alt="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row content-details">
                                    <div class="col-lg-6 spacing">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="title">My Name</label>
                                            <input type="Text" class="form-control"  disabled  value="<?php echo $rows['U_First_Name'] . " " .$rows['U_Second_Name'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 spacing">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="title">Sender</label>
                                            <input type="Text" class="form-control"  disabled value="<?php echo $rows['user_now']?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 spacing">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1" class="title">Client</label>
                                            <input type="Text" class="form-control"  disabled value="<?php echo $rows['Clietns_name']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 spacing">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1" class="title">Date</label>
                                            <input type="Text" class="form-control"  disabled value="<?php echo $rows['Date_task']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 spacing">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1" class="title">The Task</label>
                                            <textarea type="Text" class="form-control"  disabled> <?php echo $rows['Task']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
?>

