<?php
$servername = "202.218.224.21";
$username = "tester";
$password = "welcome123!";
$dbname = "japan_system_development_18102021";
$vmname =$argv[1];
try {

  define('DBDSN','sqlsrv:Server=202.218.224.21;Database=japan_system_development_18102021');
// define('SERVICEDSN','sqlsrv:Server=202.218.224.21;Database=service_db');
define('DBROOT','tester');
define('DBROOT_PASS','welcome123!');
  $conn = new PDO(DBDSN, DBROOT, DBROOT_PASS);
            $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
 $query ="SELECT * FROM vps_account WHERE instance='$vmname'";
  $stmt1 = $conn->prepare($query);
        $stmt1->execute($params);
        $data = $stmt1->fetch(PDO::FETCH_ASSOC);
  $id = $data['id'];
  $update = $data['plan_update'];
  $sql = "UPDATE vps_account SET [plan]='$update' WHERE id='$id' ";

  // Prepare statement
  $stmt = $conn->prepare($sql);

  // execute the query
  $stmt->execute();

  // echo a message to say the UPDATE succeeded
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>