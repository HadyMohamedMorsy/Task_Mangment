

<?php
    

    $do = isset($_GET['do']) ? $_GET['do'] : "Manage";

    if($do == "Manage"){ ?>
                                <?php 
                                if($_SESSION['U_Account_Type'] == "Admin" || $_SESSION['U_Account_Type'] == "Manager" ){
                                    ?>
                                        <div class="position-relative">
                                            <a href="?do=add">
                                                <div class="Plus">
                                                    <i class="fas fa-plus"></i>
                                                </div>
                                            </a>
                                        </div>
                                        <?php
                                    }
                                ?>
                                <?php 

                                    $sql = 'SELECT *,events.date AS Dateevent FROM events INNER JOIN users ON events.events_id = users.U_ID ORDER BY Id_events DESC LIMIT 10 ';

                                    $res = mysqli_query($Connection , $sql);

                                    if($res == true){

                                        $count = mysqli_num_rows($res);

                                        if($count > 0){ ?>


                                        <div class="container-fluid">
                                                <div class="content-event">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                            <?php 
                                                                while($rows = mysqli_fetch_assoc($res)){?>
                                                            <div class="event-box position-relative">
                                                                <div class="content-details">
                                                                    <div class="image">
                                                                        <img src="<?php echo 'Images/users/'.$rows['Image']; ?>" alt="" />
                                                                        <h6 class="header-selector"> <?php echo $rows['U_First_Name'] . " ".$rows['U_Second_Name']; ?> 
                                                                            <span class="date-now"><?php echo $rows['Date_now']; ?> </span>
                                                                        </h6> 
                                                                    </div>
                                                                    <h6 class="mt-3 header"> <?php echo $rows['U_Account_Type']; ?> </h6>
                                                                </div>
                                                                <div class="content-data">
                                                                    <span class="date"><?php echo $rows['Dateevent']; ?> 
                                                                    </span>
                                                                </div>
                                                                <?php
                                                                if($_SESSION['U_Account_Type'] == "Admin" || $_SESSION['U_Account_Type'] == "Manager" ){ ?>
                                                                    <div class="icon-delete">
                                                                        <a href="?do=Delete&id=<?php echo $rows['Id_events']; ?>">
                                                                            <span class="icon"><i class="fas fa-times"></i></spa> 
                                                                        </a>
                                                                    </div>
                                                                <?php
                                                                }
                                                                ?>
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <p class="content"><?php echo $rows['Event']; ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                    <?php
                                                                }
                                                            
                                                            ?>

                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }else{
                                            ?>
                                            <div class="Eroor_page">
                                                <div class="eroor_Text">
                                                    <p> There Is no Events Here</p>
                                                </div>
                                            </div>
                                            <?php

                                        }

                                    }else{


                                    }

                                ?>


        <?php
    }elseif($do == "add"){

        if($_SESSION['U_Account_Type'] == "Admin" || $_SESSION['U_Account_Type'] == "Manager"){
            ?>
                <div class="container-fluid">
                        <div class="row task-mangement">
                            <form method="POST" action="?do=Insert">
                                <div class="title">Add Event </div>
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
        }else{ ?>
                <div class="Eroor_page">
                    <div class="eroor_Text">
                        <p> This Page Not Fount 404</p>
                    </div>
                </div>
            <?php
        }


    }elseif($do == "Insert"){

        if($_SERVER['REQUEST_METHOD'] =="POST"){

            $id= filter_var($_POST['Usernow'], FILTER_VALIDATE_INT);

            $task = filter_var($_POST['task'], FILTER_SANITIZE_STRING);

            $Data = $_POST['Data'];

            $Eroor_message = array();

            if(empty($task)){

                $Eroor_message[] = Message_Handling($wrong_task,'Error',$Font);

            }

            if(empty($Data)){

                $Eroor_message[] = Message_Handling($wrong_date,'Error',$Font);

            }

            if(!empty($Eroor_message)){ ?>
                <div class="container"> 
                    <div class="row">
                        <?php echo Alert_Message($Eroor_message); ?>
                    </div>
                </div>
            <?php
            }else{

                $datenow =  CurrentDate();

                
                $sql = 'INSERT INTO events SET
                events_id = "'.$id.'",
                Event =  "'.$task.'",
                date = "'.$Data.'",
                Date_now = "'.$datenow.'"
                ';

                $res = mysqli_query($Connection , $sql);

                if($res == true){

                    echo("<script> location.href = 'http://localhost/MSA-Demo/Events?do=Manage';</script>");

                }else{

                    echo "your data is not inserted";


                }



            }

        }


    }elseif($do == "Delete"){
        if($_SESSION['U_Account_Type'] == "Admin" || $_SESSION['U_Account_Type'] == "Manager" ){
                if(isset($_GET['id'])){

                    $id = $_GET['id'];
        
                    $sql = 'SELECT * FROM events WHERE Id_events = "'.$id.'"';
        
                    $res = mysqli_query($Connection , $sql);
        
                    if($res == true){
        
                        $count = mysqli_num_rows($res);
        
        
                        if($count > 0){
        
                            $sql2 = 'DELETE FROM events WHERE Id_events = "'.$id.'"' ;
        
                            $res2 = mysqli_query($Connection , $sql2);
        
        
                            if($res2 == true){
        
                                echo("<script> location.href = 'http://localhost/MSA-Demo/Events?do=Manage';</script>");
        
                            }else{
        
                                echo "Your Data is Not Deleted";
        
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




    }


