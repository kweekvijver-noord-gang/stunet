<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
        <title>Dashboard</title>
        <link rel="stylesheet" href="styles/main.css" />
    </head>
    <body>
<?php if (login_check($mysqli) == true) : ?>
    <header>stunet <h4>username </h4><a href="profiel.php">plaatje </a></header>
    <li><a href="dashboard.php">home</a><br><a href="">toevoegen</a><br><a href="matches.php">matches</a></li>
   

<?php
$id1 = htmlentities($_SESSION['id']);
$id2 = $mysqli->prepare("SELECT type_id FROM users WHERE id = {$id1}");
$id2->execute();
$id2->store_result();
$id2->bind_result($id3);
$id2->fetch();


if ($id3 == 1) {
   echo "<h2>Gematchde bedrijfen</h2>";
$sth = $dbh->query('SELECT username FROM users WHERE type_id = 2');
$result = $sth->fetchAll();
$times = count($result)+1;


for ($v=1; $v < $times; $v++) { 

  $d = array();
  $e = array();
  $k = array();
  $n = array();
  $i = 1;
        while ($i < 10) {
            if($comps = $mysqli->prepare("SELECT points FROM user_comp WHERE id = {$id1} AND comp_id = {$i} "))
            $comps->execute();
            $comps->store_result();
            $comps->bind_result($p[$i]);
            $comps->fetch();
            
            array_push($d, $p[$i]);
            print_r($d);
            echo $p[$i]."<br>";
            $i++;
        }


  $i = 1;
            $comps = $mysqli->prepare("SELECT username FROM users WHERE company_id = {$v}");
            $comps->execute();
            $comps->store_result();
            $comps->bind_result($j[$i]);
            $comps->fetch();
            $k[] = $j[$i];

        while ($i < 10) {
            if($comps = $mysqli->prepare("SELECT points FROM user_comp WHERE type_id = 2 AND comp_id = {$i} AND company_id = {$v} "))
            $comps->execute();
            $comps->store_result();
            $comps->bind_result($c[$i]);
            $comps->fetch();
            $e[] = $c[$i];
            print_r($e);
            echo $c[$i]."<br>";
            $i++;
        }

  $i = 1;
        while ($i < 10) {
            $extra = $i*100+$i;
            if($comps = $mysqli->prepare("SELECT points FROM user_comp WHERE type_id = 2 AND comp_id = {$extra} AND company_id = {$v} "))
            $comps->execute();
            $comps->store_result();
            $comps->bind_result($m[$i]);
            $comps->fetch();
            $n[] = $m[$i];
            print_r($n);
            echo $m[$i]."<br>";
            $i++;
        }
   
}
}else{
echo "<h2>Gematchde studenten</h2>";
$sth = $dbh->query('SELECT username FROM users WHERE type_id = 1');
$result = $sth->fetchAll();
$times = count($result)+1;


for ($v=1; $v < $times; $v++) { 

  $d = array();
  $e = array();
  $k = array();
  $n = array();
  $i = 1;
        while ($i < 10) {
            if($comps = $mysqli->prepare("SELECT points FROM user_comp WHERE id = {$id1} AND comp_id = {$i} "))
            $comps->execute();
            $comps->store_result();
            $comps->bind_result($p[$i]);
            $comps->fetch();
            
            array_push($d, $p[$i]);
            print_r($d);
            echo $p[$i]."<br>";
            $i++;
        }


  $i = 1;
            $comps = $mysqli->prepare("SELECT username FROM users WHERE student_id = {$v}");
            $comps->execute();
            $comps->store_result();
            $comps->bind_result($j[$i]);
            $comps->fetch();
            $k[] = $j[$i];

        while ($i < 10) {
            if($comps = $mysqli->prepare("SELECT points FROM user_comp WHERE type_id = 1 AND comp_id = {$i} AND student_id = {$v} "))
            $comps->execute();
            $comps->store_result();
            $comps->bind_result($c[$i]);
            $comps->fetch();
            $e[] = $c[$i];
            print_r($e);
            echo $c[$i]."<br>";
            $i++;
        }

  $i = 1;
        while ($i < 10) {
            $extra = $i*100+$i;
            if($comps = $mysqli->prepare("SELECT points FROM user_comp WHERE type_id = 1 AND comp_id = {$extra} AND student_id = {$v} "))
            $comps->execute();
            $comps->store_result();
            $comps->bind_result($m[$i]);
            $comps->fetch();
            $n[] = $m[$i];
            print_r($n);
            echo $m[$i]."<br>";
            $i++;
        }
   
}


}

    for ($i=1, $x=0; $i < 10; $i++, $x++) { 
    if ($n[$x] > 0){
      if ($d[$x] > 0) {
        $z[$i] = $e[$x] + $n[$x];
        $q[$i] = $z[$i] / 2;
        if ($q[$i] > $d[$x]) {
          $o[$i] = $q[$i] - $d[$x];
          $a[$i] = $d[$x] * 10;
          $b[$i] = $o[$i] * 10;
        }else{
          $o[$i] = $d[$x] - $q[$i];
          $a[$i] = $q[$i] * 10;
          $b[$i] = $o[$i] * 10;
        }
      }else{
        $a[$i] = 0;
        $y[$i] = $e[$x] + $n[$x];
        $b[$i] = $y[$i] * 10; 
      }
    }else{
    if ($d[$x] == 0 && $e[$x] == 0) {
        $a[$i] = 0;
        $b[$i] = 0;
    } 
    if ($d[$x] == 0 && $e[$x] > 0){
        $a[$i] = 0;
        $b[$i] = $e[$x] * 10;
    }
    if ($d[$x] > 0 && $e[$x] == 0){
      $a[$i] = 0;
      $b[$i] = $d[$x] * 10;
    }
    if ($d[$x] > 0 && $e[$x] > 0){
      if ($d[$x] > $e[$x]) {
        $t[$i] = $d[$x] - $e[$x];
        $a[$i] = $e[$x] * 10;
        $b[$i] = $t[$i] * 10;
      }else{
        if ($d[$x] == $e[$x]) {
          $a[$i] = $d[$x] * 10;
          $b[$i] = 0;
        }else{
      $t[$i] = $e[$x] - $d[$x] * 10;
      $a[$i] = $d[$x] * 10;
      $b[$i] = $t[$i] * 10;
    }
  }
  }
    }
}
    $total = $a[1]+$a[2]+$a[3]+$a[4]+$a[5]+$a[6]+$a[7]+$a[8]+$a[9];
    $total2 = $b[1]+$b[2]+$b[3]+$b[4]+$b[5]+$b[6]+$b[7]+$b[8]+$b[9];
    $almost = $total - $total2;
    $answer = $total / 9;
    echo $k[0]."<br>";
    echo $answer."<br>";


?>
 
<?php else : ?>
	<p>ur logged out</p>
<?php endif; ?>
	</body>
</html>

