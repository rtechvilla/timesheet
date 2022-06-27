<?php
require_once('function/function.php');
check_session();
$pdo = getPDOObject();

//image uploading code
$valid_ext=array("jpg","jpeg","png","gif");
$validsize=2*1024*1024;
if(isset($_FILES['image']['name']))
{
$fileName=$_FILES['image']['name'];
$fileSize=$_FILES['image']['size'];
$fileExt=pathinfo($fileName,PATHINFO_EXTENSION);
$target_path="assets/".$fileName;
    if(!in_array($fileExt,$valid_ext))
         {
      die("invalid file");
         }
if($fileSize>$validsize)
        {
  die("file size is greater");
        }
else
   {
    if(!move_uploaded_file($_FILES['images']['tmp_name'],$target_path))
       {
        die("error in file uploading");
       }
   }
}
//image uploading code ends

if(isset($_POST['btn']))
{
  extract($_POST);
//  echo '<pre>';
//   print_r($_POST);
//   echo '</pre>';

 
//   echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// die();

  $skills = implode(',',$_POST['skills']);

  $query = "INSERT INTO candidate(fname,lname,email,phone,password,country,state,city,address,zip,landmark,epos,dob,doj,hq,skills,image,gender) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$fname, $lname, $email,$phone,$password,$country,$state,$city,$address,$zip,$landmark,$epos,$dob,$doj,$hq,$skills,$image,$gender]);

  if($stmt)
  {
    echo "record inserted successfully";
  }
  else
  {
     echo "there is an error in inserting the record";
  }

}

?>
<!doctype html>
<html lang="en">

<?php require_once('includes/header_css.php'); ?>

<head>
    <title>Add-candidate</title>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
        <?php require_once('includes/header.php'); ?>
        <div class="app-main">
            <?php require_once('includes/sidebar.php'); ?>

            <div class="app-main__outer">
                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="pe-7s-moon icon-gradient bg-amy-crisp">
                                    </i>
                                </div>
                                <div>Add-Candidate </div>
                             </div>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="main-card mb-3 card">
                                        <div class="card-body">
                                            <form action="add-employee.php" method="POST">
                                                <div class="row form-group">
                                                    <div class="col">
                                                        <label for="fname" class="form-label">First Name:</label>
                                                        <input type="text" name="fname" class="form-control" placeholder="Enter the first name">
                                                    </div>
                                                    <div class="col">
                                                        <label for="lname" class="form-label">Last Name:</label>
                                                        <input type="text" name="lname" class="form-control" placeholder="Enter the last name">
                                                    </div>
                                                </div>

                                                <div class="row form-group">
                                                    <div class="col">
                                                        <label for="email" class="form-label">Email:</label>
                                                        <input type="email" name="email" class="form-control" placeholder="Enter the name">
                                                    </div>
                                                    <div class="col">
                                                        <label for="phone" class="form-label">Phone:</label>
                                                        <input type="number" name="phone"  class="form-control" placeholder="Enter the phone no.">
                                                    </div>
                                                </div>
                                    
                                                <div class="row form-group">
                                                    <div class="col">
                                                        <label for="password" class="form-label">Password:</label>
                                                        <input type="password" name="password" class="form-control" placeholder="Enter the password">
                                                    </div>
                                                    <div class="col">
                                                        <label for="names" class="form-label">Country:</label>
                                                        <select name="country" id="country" class="form-control">
                                                            <option value="" >Select Country</option>
                                                            <?php 
                                                             $contSql = $pdo->prepare("SELECT * FROM `countries`");
                                                             $contSql->execute();
                                                             $counData = $contSql->fetchAll(PDO::FETCH_ASSOC);
                                                             foreach($counData as $val)
                                                             { 
                                                               echo '<option value="'.$val['id'].'">'.$val['name'].'</option>';
                                                               
                                                             }
                                                            
                                                            ?>
                                                        </select>
                                                    </div>
                                                   
                                                </div>

                                                <div class="row form-group">
                                                    <div class="col">
                                                        <label for="state" class="form-label">State:</label>
                                                        <select name="state" id="state" class="form-control">
                                                            
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <label for="city" class="form-label">City:</label>
                                                        <select name="city" id="city" class="form-control">
                                                            
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row form-group">
                                                <div class="col">
                                                        <label for="email" class="form-label">Address:</label>
                                                        <input type="text" name="address" class="form-control" placeholder="enter the address">
                                                    </div>    
                                                <div class="col">
                                                        <label for="names" class="form-label">Zip:</label>
                                                        <input type="number" name="zip" class="form-control" placeholder="enter the zip">
                                                    </div>
                                                </div>
                                                
                     <div class="row form-group">      
                                                <div class="col">
                                                    <label for="address" class="form-label">Landmark:</label>
                                                    <input type="text" name="landmark" class="form-control" placeholder="Enter landmark">
                                                </div>
                            <div class="col">
                                <label for="position" class="form-label">Position:</label>
                                <select class="form-control" name="epos">
                                <option value="">--Please Select--</option>
                                <option value="fresher">Fresher</option>
                                <option value="junior developer">Junior Developer</option>
                                <option value="senior developer">Senior Developer</option>
                                <option value="team leader">Team Leader</option>
                                <option value="manager">manager</option>
                                </select>
                              </div>
                     </div>  
  
                     <div class="row form-group">
                                       <div class="col">
                                               <label for="dob" class="form-label">DOB:</label>
                                               <input type="date" name="dob"class="form-control">
                                               </div>
                                            <div class="col">
                                               <label for="doj" class="form-label">DOJ:</label>
                                               <input type="date" name="doj"class="form-control">
                                               </div>
                      </div>
                     <div class="row form-group">
                     <div class="col">
                                <label for="hq" class="form-label">Highest Qualification</label>
                                <select class="form-control" name="hq">
                                <option value="">--Please Select--</option>
                                <option value="Graduation">Graduation</option>
                                <option value="Post graduation">Post Graduation</option>
                                <option value="Mphil">Mphil</option>
                                <option value="PHD">PHD</option>
                                <option value="Others">Others</option>
                                </select>
                     </div>                 
                                               
                   
                   <div class="col">
                         <label for="skills" class="form-label">Skills:</label>   
                         <br><input type="checkbox" name="skills[]" value="Java ">JAVA
                         <input type="checkbox" name="skills[]" value="html ">HTML
                         <input type="checkbox" name="skills[]" value="c++ ">C++
                         <input type="checkbox" name="skills[]" value="c ">C
                         <input type="checkbox" name="skills[]" value="Angular ">ANGULAR 
                   </div>
                 </div>
             <div class="row form-group"> 
                                               <div class="col">
                                               <label for="image" class="form-label">Image:</label>
                                               <input type="file" id="file" name="image"class="form-control">
                                               </div>
                                               <div class="col">
                                               <label class="form-label">Gender:</label>
                                               <input type="radio" name="gender" value='M'>Male &nbsp;
                                               <input type="radio"  name="gender" value='F'>Female
                                               </div>
        
            </div>
            <div class="col">
      <button type="submit" name="btn" class="btn btn-primary rounded-pill btn-lg px-5">Submit</button>
    </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                        
                    </div>
                </div>
                <?php require_once('includes/footer.php'); ?>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="assets/scripts/main.cba69814a806ecc7945a.js"></script>
    <script src="assets/jquery.min.js"></script>
    <script>
    $(document).ready(function(){

        /** Get State on Country Change  */
        $("#country").change(function(){
            cid = $(this).val();
            if(cid)
            {
                $.ajax({
                    method : 'post',
                    url: 'http://localhost/tms/ajax/ajax.php',
                    data : { 'action':'getState','countID':cid },
                    success : function(resp){
                    //  alert(resp);
                     $("#state").html(resp);
                    }
                });

            }else{
                alert("Please select country");
            }
        });

         /** Get City on State Change  */

         $("#state").change(function(){
            sid = $(this).val();
            if(sid)
            {
                $.ajax({
                    method : 'post',
                   // async:false,
                    url: 'http://localhost/tms/ajax/ajax.php',
                    data : { 'action':'getCity','stateID':sid },
                    success : function(resp){
                     // alert(resp);
                     $("#city").html(resp);
                    }
                });

            }else{
                alert("Please select state");
            }
        });
    });
</script>
</body>
</html>

