<?php
session_start();
// if (!extension_loaded('ssh2')) {
//     echo 'Error: This program requires the PHP extension ssh2' . PHP_EOL;
//     exit(1);
// }
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
// if (isset($_POST['command'])) {
//     echo "you typed '" . $_POST['command'] . "'.";
// }
?>

<?php
if(empty($_SESSION['connected']) || $_SESSION['connected']==''){
    echo 'hello';
        if (!($resource=@ssh2_connect("202.218.224.148"))) {
                echo "[FAILED]<br />";
                exit(1);
        }
        echo "<br />";

        echo "Athetication: ";
        if (!@ssh2_auth_password($resource,"administrator","bmbivPanKuQ5AVe")) {
                echo "[FAILED]<br />";
                exit(1);
        }
        echo "Shell: ";
        if (!($stdio = @ssh2_shell($resource))) {
                echo "[FAILED]<br />";
                exit(1);
        }
        $_SESSION['connected'] = 'connected';
    }
    if($_SESSION['connected']=='connected'){
        echo "<br />";
        $command = "dir \n";
        fwrite($stdio,$command);

        sleep(1);

        while($line = fgets($stdio)) {
                flush();
                echo $line."<br />";
        }
        
    }

        // fclose($stdio);
?>