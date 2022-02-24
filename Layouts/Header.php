

<nav class="navbar navbar-dark  fixed-top" >
    <div class="container-fluid">
        <ul class="nav" style="padding-right: initial;">
            <li class="nav-item dropdown">
                <a class="" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                    <div class="text-center">
                        <img  src="<?php echo "Images/users/".$_SESSION['Image'];?>"  style="width : 60px; height: 60px; object-fit: cover;" class="rounded-image" alt="...">
                    </div>
                </a>
                <ul class="dropdown-menu" style="left: unset; <?php echo $Style_Text_Align;?> ">
                    <li>
                        <a class="dropdown-item" href="Profile?do=Person&id=<?php echo $_SESSION['U_ID'];?>">
                            <span class="<?php echo $Font;?>"> <?php echo $My_Profile;?> </span>
                        </a>
                    </li>
                        <hr class="dropdown-divider">
                    <li>
                        <a class="dropdown-item" href="./Logout.php">
                            <span class="<?php echo $Font;?>"> <?php echo $Logout;?> </span>
                        </a>
                    </li>

                </ul>
        </ul>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-<?php echo $Offcanvas;?>" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" dir="<?php echo $Navbar ;?>">
            <div class="offcanvas-header ">
                <img src="Images/brand.png" alt="" style="width: 275px;">
                <button type="button" class="btn-close text-reset btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <?php

                        $sql = 'SELECT * FROM user_permission WHERE U_P_User_ID ="'.$_SESSION['U_ID'].'" AND Status = "Active"';

                        $res = mysqli_query($Connection ,$sql);

                        if($res == true){

                            $rowcount = mysqli_num_rows($res);

                            if($rowcount > 0){


                                while($rows = mysqli_fetch_assoc($res)){
    
                                    $Page = $rows['P_Selector_page'];

                                    if($Page == "Dashbored"){?>
                                        <li class="nav-item">
                                            <a class="nav-link " aria-current="page" href="Home">
                                                <span class="<?php echo $Font;?>"> Dashbored </span>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    if($Page == "Department"){?>
                                        <li class="nav-item">
                                            <a class="nav-link " aria-current="page" href="Department">
                                                <span class="<?php echo $Font;?>"> Department </span>
                                            </a>
                                        </li>
                                        <?php
                                    }
                            
                                    if($Page == "Manager_user"){?>
                                        <li class="nav-item">
                                            <a class="nav-link" href="Manage-Users">
                                                <span class="<?php echo $Font;?>"> Manage Users </span>
                                            </a>
                                        </li>
                                        <?php
                                    }

                                    if($Page == "Manager_Task"){?>
                                        <li class="nav-item">
                                            <a class="nav-link" href="Manage-Task">
                                                <span class="<?php echo $Font;?>"> Manage Task </span>
                                            </a>
                                        </li>
                                        <?php
                                    }

                                    if($Page == "Task_History"){?>
                                        <li class="nav-item">
                                            <a class="nav-link" href="Task-History">
                                                <span class="<?php echo $Font;?>"> Task History </span>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    if($Page == "Clients"){?>
                                        <li class="nav-item">
                                            <a class="nav-link" href="Clients">
                                                <span class="<?php echo $Font;?>"> Clients </span>
                                            </a>
                                        </li>
                                        <?php
                                    }
                            
                                
                                
                                }
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link " aria-current="page" href="Events">
                                        <span class="<?php echo $Font;?>"> Events </span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link " aria-current="page" href="Actions">
                                        <span class="<?php echo $Font;?>"> Actions </span>
                                    </a>
                                </li>
                                <?php
                
                            }
                        }else{
                            echo "No Data Here";
                        }?>
                </ul>
            </div>
        </div>
    </div>
</nav>

<div class="mt-5 mb-2"></div>

<div id="div1"></div>

