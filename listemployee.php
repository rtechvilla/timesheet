<?php 
require_once('function/function.php');
$message = '';
if(isset($_REQUEST['del_id'])){
    $delId = $_REQUEST['del_id'];
//    echo $delId;
    $delQuery = "DELETE FROM candidate WHERE can_id=?";
    $stmt = $pdo->prepare($delQuery);
    $stmt->execute([$delId]);
    if($stmt)
    {
        $message = '<div class="alert alert-danger">Record deleted successfully !</div>';
        header("location:listemployee.php");
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List EMployee</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <div class="container">
        <div class="card mt-4">
            <h5 class="card-header text-center">List Employees

                <a href="add-employee.php"><button class="btn btn-sm btn-primary">Add New</button></a>

            </h5>

        <?=$message;?>
            <div class="card-body">
                <table class="table table-striped">
                   <thead>
                       <tr>
                           <th>#</th>
                           <th>Name</th>
                           <th>Email</th>
                           <th>Phone</th>
                           <th>DOB</th>
                           <th>Action</th>
                       </tr>
                   </thead>
                   <tbody>
                       <?php 
                      // echo "SELECT id,firstname,lastname,email,phone,created_on FROM `employees` WHERE status='1' AND deleted='0'";die();
                       $query = "SELECT can_id,fname,lname,email,phone,dob FROM candidate WHERE astatus='1' AND deleted='0'";
                       $stmt = $pdo->prepare($query);
                       $stmt->execute();
                       //$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                       $cntRows = $stmt->rowCount();
                       $cnt = 1;
                       if($cntRows){
                          while($data = $stmt->fetch(PDO::FETCH_ASSOC))
                          {
                       ?>
                       <tr>
                           <td><?=$cnt++;?></td>
                           <td><?=$data['fname']." ".$data['lname'];?></td>
                           <td><?=$data['email']; ?></td>
                           <td><?=$data['phone']; ?></td>
                           <td><?=$data['dob']; ?></td>
                           <td>
                             <i class="fa fa-eye"></i>&nbsp;/&nbsp;
                             <a href="?del_id=<?=$data['can_id']?>"><i class="fa fa-trash"></i></a>&nbsp;/&nbsp;
                             <a href="edit.php?id=<?=$data['can_id']?>"><i class="fa fa-edit"></i></a>

                           </td>
                       </tr>

                       <?php 
                          }
                       }else{ 
                   echo '<h4>NO record found</h4>';
                       
                       }
                       
                       ?>
                   </tbody>
                </table>
            </div>
        </div>

    </div>

    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>
</body>

</html>