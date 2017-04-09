<?php

function sendMail($email,$message) {
  $to      = $email;
  $subject = 'Work Order';
  $headers = 'From: dlsl@edu.ph' . "\r\n" .
    'Reply-To: dlsl@edu.ph' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

    $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
  $headers .= 'From: DLSL <dlsl@edu.ph>' . "\r\n";

  mail($to, $subject, $message, $headers);
}

function getData($conn,$table,$s1,$s2,$dbRow){

  $sql = "SELECT * FROM $table WHERE $s1='$s2'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0)
  {
    while($row = $result->fetch_assoc()) 
    {
      $data=$row[$dbRow];
      return $data;
    }
  }
  else
  {
    echo "Error";
    exit();
  }

}

function requestIS($ticket_id,$conn){
  $idnumber=$_SESSION["idnumber"];
  $department=getData($conn,'users','idnumber',$idnumber,'department');
  $position= $department . ' Immediate Superior';
  $user_id=getData($conn,'users','accountType',$position,'idnumber');

  $sql = "INSERT INTO ticket_view (ticket_id,tuser_id,position,tistatus,step)
    VALUES ('$ticket_id','$user_id','$position',0,1)";
  mysqli_query($conn, $sql);

}

function requestDean($ticket_id,$conn){
  $idnumber=$_SESSION["idnumber"];
  $department=getData($conn,'users','idnumber',$idnumber,'department');
  $position= $department . ' Dean';
  $user_id=getData($conn,'users','accountType',$position,'idnumber');

  $sql = "INSERT INTO ticket_view (ticket_id,tuser_id,position,tistatus,step)
    VALUES ('$ticket_id','$user_id','$position',0,1)";
  mysqli_query($conn, $sql);

}
function getName($conn,$ticket_id,$step){
  //
  $sql = "SELECT * FROM ticket_view WHERE step='$step' AND ticket_id='$ticket_id'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0)
  {
    while($row = $result->fetch_assoc()) 
    {
      $position=$row['position'];
      $comment=$row['comment'];
      if($row['tistatus']==0) return 'Being Processed';
      if($row['tistatus']==2) return 'Rejected-'.$position . 'Reason:' .$comment;
      else return 'Approved - ' .$position;
    }
  }
  else
  {
    return 'N/A';
  }
}

?>