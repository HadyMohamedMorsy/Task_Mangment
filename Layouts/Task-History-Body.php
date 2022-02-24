<?php

    if(isset($_SESSION['Task_History'])):

?>


<div class="container-fluid">
<div class="row task-mangement">
        <h4 class="mb-5"> Task History </h4>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>From</th>
                    <th>TO</th>
                    <th>Client</th>
                    <th>Task</th>
                    <th>Date</th>
                    <th>Date From Action</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tfoot style="display : table-header-group;">
                <tr>
                    <th>ID</th>
                    <th>From</th>
                    <th>TO</th>
                    <th>Client</th>
                    <th>Task</th>
                    <th>Date</th>
                    <th>Date From Action</th>
                    <th>Status</th>
                </tr>
            </tfoot>
            <tbody>
                <?php
                    if($_SESSION['U_Account_Type'] == "User"){

                        $ID_USER = $_SESSION['U_ID'];


                        $sql ='SELECT task.*,users.U_First_Name AS Firstname , users.U_Second_Name AS Sexoundname, users.Image AS imagename,clients.Clietns_name As Nameclients, clients.Image AS ImagenameClient FROM task INNER JOIN users ON task.id_user = users.U_ID INNER JOIN clients ON task.id_clients = clients.clients_id WHERE Conditions!="Pending" AND state="Active" AND id_user_now = "'.$ID_USER.'" ORDER BY id_Task DESC';

                    }else{

                        $sql ='SELECT task.*,users.U_First_Name AS Firstname , users.U_Second_Name AS Sexoundname, users.Image AS imagename,clients.Clietns_name As Nameclients, clients.Image AS ImagenameClient FROM task INNER JOIN users ON task.id_user = users.U_ID INNER JOIN clients ON task.id_clients = clients.clients_id WHERE Conditions!="Pending" AND state="Active" ORDER BY id_Task DESC';

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
                                    <td> <?php echo $rows['Firstname'] ." ".$rows['Sexoundname']; ?>  </td>
                                    <td> <?php echo $rows['Nameclients']; ?></td>
                                    <td> <?php output($rows['Task'],20); ?></td>
                                    <td> <?php echo $rows['date']; ?></td>
                                    <td> <?php echo $rows['Date_After_Task']; ?></td>
                                    <td class="<?php if($rows['Conditions'] == "Complete") { echo "Complete" ;}else{echo "UnComplete"; } ?>"> <?php echo $rows['Conditions'];?> </td>
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

else : ?>

    <div class="Eroor_page">
        <div class="eroor_Text">
            <p> This Page Not Fount 404</p>
        </div>

    </div>
    <?php
endif;

?>