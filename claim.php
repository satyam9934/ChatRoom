<?php
$room = $_POST['room'];


//checking for room size

if(strlen($room)>20 or strlen($room)<2){
  $message = "Plese choose a name  between 2 or 20 characters";
  echo '<script type="text/javascript">';
  echo ' alert("'.$message.'");';  //not showing an alert box.
  echo 'window.location="http://localhost/ChatRoom";';
  echo '</script>';
}
// checking weather room name is alphanumeric   
else if(!ctype_alnum($room)){
    $message = "Plese choose a name  alpha numeric room name ";
    echo '<script type="text/javascript">';
  echo ' alert("'.$message.'");';  //not showing an alert box.
  echo 'window.location="http://localhost/ChatRoom";';
  echo '</script>';
}
else{
    //connect to the database;
    include 'db_connect.php';
}

//check if room already exist;

$sql = "SELECT * FROM `rooms` WHERE roomname = '$room'";
$result = Mysqli_query($conn, $sql);
if($result){
  if (mysqli_num_rows($result)>0) {
    $message = "Plese choose a Different room This room is already claimed ";
    echo '<script type="text/javascript">';
    echo ' alert("'.$message.'");';  //not showing an alert box.
    echo 'window.location="http://localhost/ChatRoom";';
    echo '</script>';
  }
  else{
    $sql = "INSERT INTO `rooms` (`roomname`, `stime`) VALUES ('$room', current_timestamp()) ";
     if(Mysqli_query($conn, $sql)){
      $message = "Your room  is ready and you can chat now!  ";
      echo '<script type="text/javascript">';
      echo ' alert("'.$message.'");';  //not showing an alert box.
      echo 'window.location="http://localhost/ChatRoom/rooms.php?roomname='.$room.'";';
      echo '</script>';

     }
  }
}
else{
  echo "Error". mysqli_error($conn);
}



?>