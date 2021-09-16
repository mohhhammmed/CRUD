<?php
$host='localhost';
$user='root';
$password='';
$dbname='learning';

$connect=mysqli_connect($host,$user,$password,$dbname);
if($connect){
    if(isset($_POST['send'])){
        $email=$_POST['email'];
        $password=$_POST['password'];
        $ins="INSERT INTO clients(id,email,password) value (null,'$email',' $password')";
        mysqli_query($connect,$ins);
    }
    $data="SELECT * FROM clients";
    $data= mysqli_query($connect,$data);
  
    if(isset($_GET['del'])){
        $id=$_GET['del'];
        $del="DELETE FROM clients where id=$id";
        mysqli_query($connect,$del);
    }

    $update=false;
    $email="";
    $password="";
    if(isset($_GET['edit'])){
        $id=$_GET['edit'];
        $update=true;
        $user_data="SELECT * FROM clients where id=$id";
        $selected= mysqli_query($connect,$user_data);
        $user_data=mysqli_fetch_assoc($selected);
        $email=$user_data['email'];
        $password=$user_data['password'];
            
        if(isset($_POST['update'])){
            $new_email=$_POST['email'];
            $new_pass=$_POST['password'];
            $update_email="UPDATE clients set email=' $new_email',password='$new_pass' where id=$id";
            $up= mysqli_query($connect,$update_email);

            if($up){
               
                echo 'Updated Done<br>';
            }else{
                echo 'Updated false<br>';
            }
        }
    }
   

}else{
    echo 'you are not connected';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" class="stylesheet">
    <title>Document</title>
</head>
<body>
<div class="form-body">
    <form method="POST">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" name="email" value="<?php echo $email?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" value="<?php echo $password?>" class="form-control" id="exampleInputPassword1">
        </div>
        <?php if($update==false): ?>
            <div class="mb-3">
            <button name="send" class="btn btn-primary">Send</button>
            </div>
         <?php else: ?>  
            <div class="mb-3">
            <button name="update" class="btn btn-primary">update</button>
            </div>
         <?php endif ?>
    </form>
</div>
 <!-- table -->
 <div class="table-data">
    <table class="table">
    <thead>
        <tr>
        <th scope="col">id</th>
        <th scope="col">email</th>
        <th scope="col">password</th>
        <th scope="col">action</th>
        </tr>
    </thead>
    <tbody>
          <?php foreach($data as $d){ ?>  
            <tr>
            <?php echo '<td>'. $d['id'] . '</td>'?>
            <?php echo '<td>'. $d['email'] . '</td>'?>
            <?php echo '<td>'. $d['password'] . '</td>'?>
          <td>  <a href="index.php?del=<?php echo $d['id']?>" class="btn btn-danger">Del</a>
            <a href="index.php?edit=<?php echo $d['id']?>" class="btn btn-primary">Edit</a> </td>
            </tr>
        <?php } ?>
    </tbody>
    </table>
 </div>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
 integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
 
</body>
</html>