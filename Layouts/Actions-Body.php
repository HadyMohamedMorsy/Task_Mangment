<?php 
    $do = isset($_GET['do']) ? $_GET['do'] : "Manage";

?>
<?php
if($do == "Manage"){?>
<div class="container-fluid">
    <div class="add">
        <a href="?do=Add" class="btn btn-primary edit-submit">Add Action</a>
    </div>
</div>
<div class="container-fluid">
    <div class="row task-mangement">
        <h4 class="mb-5"> Task History </h4>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>From</th>
                    <th>Client</th>
                    <th>Action</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot style="display : table-header-group;">
                <tr>
                    <th>ID</th>
                    <th>From</th>
                    <th>Client</th>
                    <th>Action</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
                <?php
                    if($_SESSION['U_Account_Type'] == "User"){

                        $ID_USER = $_SESSION['U_ID'];


                        $sql ='SELECT *,users.Image AS IMAGEUSER FROM action INNER JOIN users ON action.id_user = users.U_ID INNER JOIN clients ON action.client_id = clients.clients_id WHERE Id_User = "'.$ID_USER.'" ORDER BY Action_id DESC';

                    }else{

                        $sql ='SELECT *,users.Image AS IMAGEUSER FROM action INNER JOIN users ON action.id_user = users.U_ID INNER JOIN clients ON action.client_id = clients.clients_id ORDER BY Action_id DESC';

                    }

                    $res = mysqli_query($Connection , $sql);

                    if($res ==true){

                        $count = mysqli_num_rows($res);

                        if($count > 0){
                            $counter = 1;
                            while($rows = mysqli_fetch_assoc($res)){?>
                                <tr>
                                    <td> <?php echo $counter++; ?> </td>
                                    <td><img src=<?php echo "Images/users/".$rows['IMAGEUSER'] ?> alt=""  style="width : 60px; height: 50px; object-fit: cover;" class="rounded-image"/> <?php echo $rows['U_First_Name'] ." ".$rows['U_Second_Name']; ?>  </td>
                                    <td><img src=<?php echo "Images/Clients/".$rows['Image'] ?> alt=""  style="width : 60px; height: 50px; object-fit: cover;" class="rounded-image"/> <?php echo $rows['Clietns_name']; ?></td>
                                    <td> <?php output($rows['Action'],20); ?></td>
                                    <td> <?php echo $rows['Date']; ?></td>
                                    <td> 
                                        <a href="Profile?do=Action&id=<?php echo $rows['Action_id']; ?>" class="btn btn-success">View Action</a>
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
            <div class="title">Add Action </div>
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
        $data = CurrentDate();
        $Title = $_POST['Title'];
        $Client = $_POST['Client'];
        $task = filter_var($_POST['task'] , FILTER_SANITIZE_STRING);

        $Eroor_message = array();


        if(empty($task)){

            $Eroor_message[] = Message_Handling($wrong_UserName,'Error',$Font);

        }

        if(empty($Title)){

            $Eroor_message[] = Message_Handling($wrong_UserName,'Error',$Font);

        }

        if(!empty($Eroor_message)){ ?>
            <div class="container"> 
                <div class="row">
                    <?php echo Alert_Message($Eroor_message); ?>
                </div>
            </div>
            <?php
            }else{

                $sql = 'INSERT INTO action SET
                Id_User = "'.$id.'",
                Action = "'.$task.'",
                client_id = "'.$Client.'",
                Date = "'.$data.'",
                Title = "'.$Title.'"
                ';

                $res = mysqli_query($Connection , $sql);

                if($res == true){

                    echo("<script> location.href = 'http://localhost/MSA-Demo/Actions?do=Manage';</script>");


                }else{
                    echo "Your Data Is Not Inserted";


                }


            }

    }
    

}


