
<?php
//Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: auth.php");
    exit;
}
?>
<?php 
//Databse Connection file
include('config.php');
if(isset($_POST['submit']))
  {
   
  	//getting the post values
  
    $post_title = trim($_POST['post_title']);
    $post_description = trim($_POST['post_description']);
    $user_id = $_SESSION['id'];
    $ppic=$_FILES["profilepic"]["name"];

// get the image extension
$extension = substr($ppic,strlen($ppic)-4,strlen($ppic));
// allowed extensions
$allowed_extensions = array(".jpg","jpeg",".png",".gif");
// Validation for allowed extensions .in_array() function searches an array for a specific value.
if(!in_array($extension,$allowed_extensions))
{
echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
}
else
{
//rename the image file
$imgnewfile=md5($imgfile).time().$extension;
// Code for move image into directory
move_uploaded_file($_FILES["profilepic"]["tmp_name"],"profilepics/".$imgnewfile);
// Query for data insertion
$query=mysqli_query($mysqli, "insert into posts(post_title, post_description, user_id, profilepic) value('$post_title', '$post_description', '$user_id', '$imgnewfile' )");
if ($query) {
echo "<script>alert('You have successfully inserted the data');</script>";
echo "<script> document.location ='index.php'; </script>";
} else{
echo "<script>alert('Something Went Wrong. Please try again');</script>";
}}
}
?>

<?php

if(isset($_POST['update'])){
    $user_id = $_SESSION['id'];
    $username = trim($_POST['username']);

    $query=mysqli_query($mysqli, "update users set username='$username' where id='$user_id'");
    if ($query) {
        echo "<script>alert('Username Updated Successfully');</script>";
        echo "<script type='text/javascript'> document.location ='index.php'; </script>";
      }
      else
    {
          echo "<script>alert('Something Went Wrong. Please try again');</script>";
     }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Allurine</title>
    <!-- link css -->
    <link rel="stylesheet" href="style.css">
    <!-- icon scout cdn -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css" />
</head>

<body>
    <nav>
        <div class="container">
            <h2 class="logo">Allurine</h2>
            <div class="search-bar">
                <i class="uil uil-search"></i>
                <input type="search" placeholder="Search for creators, inspiration and project">
            </div>
            <div class="create">
                <label class="btn btn-primary" for="create-post">Search </label>
                <?php
                $user_id=$_SESSION['id'];
                $ret=mysqli_query($mysqli,"select * from users where Id='$user_id'");
               while ($rowData=mysqli_fetch_array($ret)) {

                 ?>
                <div class="profile-photo">
                    <img src="profilepics/<?php  echo $rowData['image'];?>" alt="">
                </div>
                <p><?php echo $rowData["username"]; ?></p>
                <?php } ?>
                <a href="logout.php" class="btn btn-primary">logout</a>
            </div>

        </div>
    </nav>
    <!-- ------------MAIN-------------- -->
    <main>
        <div class="container">
            <!-- Left Side -->
            <div class="left">
                <a class="profile">
                    <div class="profile-photo">
                    <?php
                $user_id=$_SESSION['id'];
                $ret=mysqli_query($mysqli,"select * from users where id='$user_id'");
               while ($row=mysqli_fetch_array($ret)) {

                 ?>
                <div class="profile-photo">
                    <img src="profilepics/<?php  echo $row['image'];?>" alt="">
                </div>
            </div>
            <div class="handle">
                <h4><?php echo $row["username"]; ?></h4>
                <p class="text-muted">@ <?php echo $row["username"]; ?></p>
            </div>
            <?php } ?>
                </a>
                <!-- SideBar -->
                <div class="sidebar">
                    <a class="menu-item active">
                        <span><i class="uil uil-home"></i></span>
                        <h3>Home</h3>
                    </a>
                    <a class="menu-item">
                        <span><i class="uil uil-compass"></i></span>
                        <h3>Explore</h3>
                    </a>
                    <a class="menu-item" id="notifications">
                        <span><i class="uil uil-bell"><small class="notification-count">
                        <?php 
                            $selectCount = mysqli_query($mysqli, "select * from messages");
                            echo $resultCount = mysqli_num_rows($selectCount);
                              
                        ?>
                        </small></i></span>
                        <h3>Notifications</h3>
                        <!-- -----------Notification Popup--------------- -->
                        <div class="notifications-popup">
                        <?php 
                        $selectNoti = mysqli_query($mysqli, "select sender_id from messages");
                        while($resultNoti = mysqli_fetch_array($selectNoti)){
                            
                        ?>
                        <div>
                        <?php 
                        $getSenderId = $resultNoti['sender_id'];
                        

                        $selectNoti = mysqli_query($mysqli, "select image, username from users where id = '$getSenderId'");
                        while($resultNoti = mysqli_fetch_array($selectNoti)){

                         ?>

                         <div class="profile-photo">
                         <img src="profilepics/<?php echo $resultNoti['image']?>" alt="">
                         </div>
                         <div class="notification-body">
                         <b><?php echo $resultNoti['username'];?></b> 
                          Sent A Message To 
                         <b>
                         <?php } ?>
                                       <?php
                                         

                                         $selectNoti1 = mysqli_query($mysqli, "select reciever_id from messages");
                                         while($resultNoti1 = mysqli_fetch_array($selectNoti1)){
                                                                                
                                       ?>
                                       <?php
                                        $getRecieverId = $resultNoti1['reciever_id'];
                                        $selectNoti1= mysqli_query($mysqli, "select username from users where id = '$getRecieverId'");
                                        while($resultNoti1 = mysqli_fetch_array($selectNoti1)){
                                            
                                        

                                    ?>
                                    <?php echo $resultNoti1['username']; ?>
                                      
                                    </b>
                                    <?php } ?>
                                    <small class="text-muted"> 2 Days Ago</small>
                                </div>
                                
                            </div>
                                <?php }?>
                                
                            <?php } ?>
                          
                           
                        </div>
                        <!-- --------------------------End of Notification popup-------------------- -->
                    </a>
                    <a class="menu-item" id="messages-notification">
                        <span>
                            <i class="uil uil-envelope-alt">
                            <small class="notification-count">
                            <?php 
                            $selectCount = mysqli_query($mysqli, "select * from messages");
                            echo $resultCount = mysqli_num_rows($selectCount);
                              
                             ?>
                            </small>
                        </i></span>
                        <h3>Messages</h3>
                    </a>
                    <a class="menu-item">
                        <span><i class="uil uil-bookmark"></i></span>
                        <h3>Bookmarks</h3>
                    </a>
                    <a class="menu-item">
                        <span><i class="uil uil-chart-line"></i></span>
                        <h3>Analytics</h3>
                    </a>
                    <a class="menu-item" id="theme">
                        <span><i class="uil uil-palette"></i></span>
                        <h3>Theme</h3>
                    </a>
                    <a class="menu-item" id="settings">
                        <span><i class="uil uil-setting"></i></span>
                        <h3>Settings</h3>
                    </a>
                </div>
                <!-- --------------------End Of SideBar------------------- -->
                <label class="btn btn-primary" id="modal-create-post" for="create-post">Create Post</label>
            </div>
            <!-- --------------End Of Left-------------- -->
            <!-- Middle Side -->
            <div class="middle">
              <!-- ----------------stories------------- -->
              <div class="stories">
                <?php 
                 $select = mysqli_query($mysqli, "select * from posts order by rand() limit 0,6");
                 while($resultStories = mysqli_fetch_array($select)){

                 ?>


                <div class="story" style="background: url('profilepics/<?php echo $resultStories['profilepic'];?>') no-repeat center center/cover;">
                    <div class="profile-photo">
             
                        <img src="profilepics/<?php echo $resultStories['profilepic'];?>" alt="">
                        
                    </div>
                    <p class="name"><?php echo $resultStories['post_title'];?></p>
                </div>

                
            <?php } ?>
              
              </div>
              <!-- ------------ End Of Stories---------- -->
                 <?php
               
                 $ret=mysqli_query($mysqli,"select * from users where id='$user_id'");
                while ($rowS=mysqli_fetch_array($ret)) {
                 
                 ?>
              <form class="create-post">
                 <div class="profile-photo">
                    <img src="profilepics/<?php echo $rowS['image'];?>" alt="">
                 </div>
                <input type="text" placeholder="Whats on Your Mind, <?php echo $rowS['username'];?>" id="create-post">
                <input type="submit" value="Post" class="btn btn-primary">
              </form>
              <?php } ?>
              <!-- -----------FEEDS--------- -->



              <div class="feeds">
              <!-- -----------FIRST FEED--------- -->
                   <?php   

                    $ret=mysqli_query($mysqli,"select * from posts WHERE user_id = '$user_id' order by rand() limit 0,4");
                    $cnt=1;
                    $row=mysqli_num_rows($ret);
                    if($row>0){
                    while ($row=mysqli_fetch_array($ret)) {

                    ?>
                <div class="feed">
                <div class="head">
                <div class="user">
                <?php
                     
                   $result=mysqli_query($mysqli,"select * from users where id='$user_id'");
                   while ($rowResult=mysqli_fetch_array($result)) {

                 ?>
                        <div class="profile-photo">
                        <img src="profilepics/<?php echo $rowResult['image']; ?>" alt="">
                        </div>
                        <div class="info">
                             <h3><?php echo $rowResult['username']; ?></h3>
                             <small>Canada, <?php echo $row['created_at'];?></small>
                        </div>
                    </div>
                     <?php } ?>
                    <span class="edit">
                        <i class="uil uil-ellipsis-h"></i>
                    </span>
                   </div> 

                     <div class="photo">
                        <img src="profilepics/<?php  echo $row['profilepic'];?>" alt="">
                     </div>
                     <div class="action-buttons">
                        <div class="interaction-buttons">
                         <span>
                            <i class="uil uil-heart"></i>
                         </span>
                         <span><i class="uil uil-comment-dots"></i></span>
                         <span><i class="uil uil-share-alt"></i></span>
                        </div>
                        <div class="bookmark">
                             <span><i class="uil uil-bookmark-full"></i></span>
                        </div>
                     </div>
                     <div class="liked-by">
                        <span><img src="images/profile-10.jpg" alt=""></span>
                        <span><img src="images/profile-4.jpg" alt=""></span>
                        <span><img src="images/profile-15.jpg" alt=""></span>
                        <p>Liked By <b><?php echo $row['post_title']; ?></b> and <b>2800 other top companies.</b></p>
                     </div>
                     <div class="caption">
                        <p><b><?php echo $row['post_title']; ?></b> <?php echo $row['post_description']; ?><span class="harsh-tag"><?php echo $row['post_title']; ?></span></p>

                     </div>
                     <div class="comments text-muted">
                        View All 2899 comments
                     </div>
                     
                     </div>
                     <?php } } else{ ;?>
                <div class="mt-5">
                      <h3 style="text-align: center;">No Posts yet. Make Your first Moment Count</h3>
                </div>
                  
                <?php } ?>
           
              </div>
              <!-- -----------END OF MIDDLE----------- -->
            </div>
            <!-------------- Right Side ---------------->
            <div class="right">
              <div class="messages">
                <div class="heading">
                   <h4>Messages </h4><i class="uil uil-edit"></i> 
                </div>
                <!-- ---------Search Bar---------- -->
                <div class="search-bar">
                    <i class="uil uil-search"></i>
                    <input type="search" placeholder="Search messages" id="message-search">
                </div>
                <!-- ---------Messages Category---------- -->
                 <div class="category">
                    <h6 class="active">Primary</h6>
                    <h6>General</h6>
                    <h6 class="message-requests">Requests(2)</h6>
                 </div>
                <!-- ---------Message---------- -->
                <?php   

                    $resultMessage=mysqli_query($mysqli,"select * from messages");
               
                    $rowMessage=mysqli_num_rows($resultMessage);
                    
                    while ($rowMessage=mysqli_fetch_array($resultMessage)) {

                        ?>
                    
                    <?php 
                    $sender_id = $rowMessage['sender_id']; 
                    
                    $resultUsers=mysqli_query($mysqli,"select * from users where id = '$sender_id'");
               
                    $rowUsers=mysqli_num_rows($resultUsers);
                  
                    while ($rowUsers=mysqli_fetch_array($resultUsers)) {

                    
                    ?>

                 <div class="message">
                    <div class="profile-photo">
                        <img src="profilepics/<?php echo $rowUsers['image'];?>" alt="">
                    </div>
                    <div class="message-body">
                        <h5><?php echo $rowUsers['username'];?></h5>
                        <p class="text-bold"><?php echo $rowMessage['message']; ?></p>
                    </div>
                 </div>
                <?php } ?>
              <?php }?>
         
              </div>
            
              <!-- -------END OF MESSAGES-------- -->

              <!-- ---------FRIEND REQUEST------------- -->
              <div class="friend-requests">
                <h4>Requests</h4>
                <!-- --------request -->
                <div class="request">
                <div class="info">
                    <div class="profile-photo">
                        <img src="images/profile-13.jpg" alt="">
                    </div>
                    <div>
                        <h5>Humphrey Boss</h5>
                        <p class="text-muted">8 mutual friends</p>
                        
                    </div>
                </div>
                <div class="action">
                    <button class="btn btn-primary">Accept</button>
                    <button class="btn">Decline</button>
                </div>
                </div>
                <!----------- Request------------>
                <div class="request">
                    <div class="info">
                        <div class="profile-photo">
                            <img src="images/profile-10.jpg" alt="">
                        </div>
                        <div>
                            <h5>Felix Chukwu</h5>
                            <p class="text-muted">8 mutual friends</p>
                            
                        </div>
                    </div>
                    <div class="action">
                        <button class="btn btn-primary">Accept</button>
                        <button class="btn">Decline</button>
                    </div>
                    </div>
                    <!-- -------Request------- -->
                    <div class="request">
                        <div class="info">
                            <div class="profile-photo">
                                <img src="images/profile-11.jpg" alt="">
                            </div>
                            <div>
                                <h5>Moses Graphics</h5>
                                <p class="text-muted">8 mutual friends</p>
                                
                            </div>
                        </div>
                        <div class="action">
                            <button class="btn btn-primary">Accept</button>
                            <button class="btn">Decline</button>
                        </div>
                        </div>
              </div>
            </div>
            <!-- ===========END==================-->
        </div>
    </main>
    <!-- =======================Theme Customization============= -->
    <div class="customize-theme">
       <div class="card">
        <h2>Customize Your view</h2>
        <p class="text-muted">Manage your font size, color and background</p>

        <!-- -----------------Font Sizes---------------- -->
        <div class="font-size">
            <h4>Font Size</h4>
            <div>
                <h6>Aa</h6>
                <div class="choose-size">
                    <span class="font-size-1"></span>
                    <span class="font-size-2 active"></span>
                    <span class="font-size-3"></span>
                    <span class="font-size-4"></span>
                    <span class="font-size-5"></span>
                </div>
                <h3>Aa</h3>
            </div>
        </div>
        <!-- ----------PRIMARY COLOR----------- -->
        <div class="color">
           <h4>Color</h4>
           <div class="choose-color">
            <span class="color-1 active"></span>
            <span class="color-2"></span>
            <span class="color-3"></span>
            <span class="color-4"></span>
            <span class="color-5"></span>
           
           </div>
        </div>
        <!-- ---------Background Colors -->
        <div class="background">
            <h4>Background</h4>
            <div class="choose-bg">
                <div class="bg-1 active">
                    <span></span>
                    <h5 for="bg-1">Light</h5>
                </div>
                <div class="bg-2">
                    <span></span>
                    <h5>Dim</h5>
                </div>
                <div class="bg-3">
                    <span></span>
                    <h5 for="bg-3">Lights Out</h5>
                </div>
            </div>
        </div>
       </div>
    </div>

    <div class="modal-create-post">
       <div class="card">
        <h2>Post Your Best Moment</h2>
        <p class="text-muted">Create Captivating Moment With A Posts</p>
          <form method="POST" enctype="multipart/form-data" action="">
            <div class="form-group">
                <input type="text" name="post_title" placeholder="Post Title" required>
            </div>
            <div class="form-group">
                <textarea name="post_description" id="" cols="30" rows="10" placeholder="Post Description" required>

                </textarea>
            </div>
            <div class="form-group">
                <input type="file" name="profilepic" required>
                Upload Image
            </div>
            <input type="submit" name="submit" value="Post Moment" class="btn btn-primary mt-5">
          </form>
    
       </div>
    </div>
    <?php
         $user_id=$_SESSION['id'];
         $ret=mysqli_query($mysqli,"select * from users where id='$user_id'");
         while ($row=mysqli_fetch_array($ret)) {

         ?>
    <div class="settingsModal" id="">
       <div class="card">
        <h2>Update your Profile Information</h2>

        <div class="profile-update mt-5">
        <img src="profilepics/<?php  echo $row['image'];?>" class="profile-update">
        <a href="change-image.php?userid=<?php echo $row['id'];?>">Change Image</a>
        </div>
          <form method="POST" enctype="multipart/form-data" action="">
            <div class="form-group mt-5">
                <input type="text" name="username" value="<?php echo $row['username']; ?>" placeholder="User Name" required>
            </div>
           
            
            <input type="submit" name="update" value="Update Profile" class="btn btn-primary mt-5">
          </form>
           
          
        </div>
    </div>
    <?php } ?>
  

<script src="app.js"></script>
</body>
</html>