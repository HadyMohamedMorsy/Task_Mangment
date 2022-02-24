<?php

    if(isset($_SESSION['Dashbored'])):

?>

<div class="container">
    <div class="Dashbored d-flex justify-content-between">
        <h4> Welcome back <span class="Name_Of_Seession"><?php echo $_SESSION['U_First_Name']." ".$_SESSION['U_Second_Name'];?></span></h4>
        <div class="admin">
            Dashbored ||| <?php echo $_SESSION['U_Account_Type']; ?>
        </div>
    </div>
    <div class="row pt-5 pb-5">
        <div class="col-lg-3">
            <div class="department Dashbored-circle">
                <div class="row">
                    <div class="col-lg-4 icon">
                        <i class="fas fa-address-card"></i>
                    </div>
                    <div class="col-lg-8 d-flex justify-content-center align-items-center">
                        <div class="title">
                            Pending task
                            <div class="number text-center">
                            <?php 
                                $sql = 'SELECT COUNT(*) AS Count FROM  task WHERE Conditions = "Pending"';


                                $res = mysqli_query($Connection , $sql);

                                if($res == true){

                                    $count = mysqli_num_rows($res);

                                    if($count > 0){

                                        while($rows = mysqli_fetch_assoc($res)){

                                            echo $rows['Count'];

                                        }

                                    }else{

                                        echo "0";
                                    }

                                }else{

                                }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 ">
            <div class="users Dashbored-circle ">
                <div class="row">
                    <div class="col-lg-4 icon">
                        <i class="fas fa-address-card"></i>
                    </div>
                    <div class="col-lg-8 d-flex justify-content-center align-items-center">
                        <div class="title">
                                UnComplete task
                            <div class="number text-center">

                            <?php 
                                $sql = 'SELECT COUNT(*) AS Count FROM  task WHERE Conditions = "UnComplete"';


                                $res = mysqli_query($Connection , $sql);

                                if($res == true){

                                    $count = mysqli_num_rows($res);

                                    if($count > 0){

                                        while($rows = mysqli_fetch_assoc($res)){

                                            echo $rows['Count'];

                                        }

                                    }else{

                                        echo "0";
                                    }

                                }else{

                                }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 ">
            <div class="completed-task Dashbored-circle ">
                <div class="row">
                    <div class="col-lg-4 icon">
                        <i class="fas fa-address-card"></i>
                    </div>
                    <div class="col-lg-8 d-flex justify-content-center align-items-center">
                        <div class="title">
                                Complete task
                            <div class="number text-center">
                            <?php 
                                $sql = 'SELECT COUNT(*) AS Count FROM  task WHERE Conditions = "Complete"';


                                $res = mysqli_query($Connection , $sql);

                                if($res == true){

                                    $count = mysqli_num_rows($res);

                                    if($count > 0){

                                        while($rows = mysqli_fetch_assoc($res)){

                                            echo $rows['Count'];

                                        }

                                    }else{

                                        echo "0";
                                    }

                                }else{

                                }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 ">
            <div class="complited Dashbored-circle">
                <div class="row">
                    <div class="col-lg-4 icon">
                        <i class="fas fa-address-card"></i>
                    </div>
                    <div class="col-lg-8 d-flex justify-content-center align-items-center">
                        <div class="title">
                                Count Of User
                            <div class="number text-center">
                            <?php 
                                $sql = 'SELECT COUNT(*) AS Count FROM  users';


                                $res = mysqli_query($Connection , $sql);

                                if($res == true){

                                    $count = mysqli_num_rows($res);

                                    if($count > 0){

                                        while($rows = mysqli_fetch_assoc($res)){

                                            echo $rows['Count'];

                                        }

                                    }else{

                                        echo "0";
                                    }

                                }else{

                                }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row task-mangement">
        <h4 class="mb-5"> Mangement Approve Users</h4>
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
                
                $cheach_Admin =  $_SESSION['U_Account_Type'];
                
                    if($cheach_Admin == "Admin"){

                        $sql = 'SELECT users.*,department.Department AS Department_name FROM users INNER JOIN department ON users.ID_Department= department.ID_D WHERE Group_Id != "1" AND U_Status="UnActive" ORDER BY U_ID DESC';

                        $res = mysqli_query($Connection , $sql);

                        if($res == true){

                            $coulm = mysqli_num_rows($res);

                            if($coulm > 0){
                                $counter = 1;
                                while($rows =  mysqli_fetch_assoc($res)){ ?>
                                    <?php $ID = $rows['U_ID']; ?>
                                    <tr>
                                        <td> <?php echo $counter++; ?> </td>
                                        <td> <span> <img src="<?php echo 'Images/users/'.$rows['Image']; ?>" alt="" style="width : 60px" class="rounded-image"/> </span> <?php echo $rows['U_First_Name'] ." ".$rows['U_Second_Name']." ".$rows['U_Third_Name'] ; ?> </td>
                                        <td> <?php echo $rows['Gender']; ?> </td>
                                        <td> <?php echo $rows['U_Account_Type']; ?> </td>
                                        <td> <?php echo $rows['U_Status']; ?> </td>
                                        <td> <?php echo $rows['Department_name']; ?> </td>
                                        <td> 
                                            <a href="Manage-Users?do=Approve&ID=<?php echo $ID ?>" class="btn btn-primary">Approve</a>
                                            <a href="Manage-Users?do=Disapprove&ID=<?php echo $ID ?>" class="btn btn-danger">Disapprove</a>
                                            <a href="Profile?do=profile&id=<?php echo $ID ?>" class="btn btn-success">View Profile</a>

                                        </td>
                                    </tr>
                                    <?php
                                }
                            }else{


                            }

                        }else{

                        }
                    }else{

                        $sql2 = 'SELECT users.*,department.Department AS Department_name FROM users INNER JOIN department ON users.ID_Department= department.ID_D WHERE Group_Id != "1" AND U_Status="UnActive"';

                        $res2 = mysqli_query($Connection , $sql2);

                        if($res2 == true){

                            $coulm2 = mysqli_num_rows($res2);

                            if($coulm2 > 0){

                                $counter = 1;
                                
                                while($rows =  mysqli_fetch_assoc($res2)){ ?>
                                    <td> <?php echo $counter++; ?> </td>
                                    <td> <span> <img src="<?php echo 'Images/users/'.$rows['Image']; ?>" alt="" style="width : 60px" class="rounded-image"/> </span> <span><?php echo $rows['U_First_Name'] ." ".$rows['U_Second_Name']." ".$rows['U_Third_Name'] ; ?>  </span> </td>
                                    <td> <?php echo $rows['Gender']; ?> </td>
                                    <td> <?php echo $rows['U_Account_Type']; ?> </td>
                                    <td> <?php echo $rows['U_Status']; ?> </td>
                                    <td> <?php echo $rows['Department_name']; ?> </td>
                                    <td class="Another"> 
                                        The Admin Not Approvet Yet
                                    </td>
                                <?php
                            }

                            }else{

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

    else : ?>

     <div class="Eroor_page">
        <div class="eroor_Text">
            <p> This Page Not Fount 404</p>
        </div>

     </div>

        <?php
    endif;

?>
