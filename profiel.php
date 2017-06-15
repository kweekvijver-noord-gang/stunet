<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
        <title>Profiel</title>
        <link rel="stylesheet" href="styles/main.css" />
    </head>
    <body>
<?php if (login_check($mysqli) == true) : ?>
    <header>stunet <h4>username </h4><a href="">plaatje </a></header>
    <li><a href="dashboard.php">home</a><br><a href="">toevoegen</a><br><a href="matches.php">matches</a></li>
 	<div class="welcomescreen">Uw profiel</div>
    <div class="gegevens">Persoonlijke gegevens</div>
    <div class="competenties">Competenties<br>
    <?php
$id1 = htmlentities($_SESSION['id']);


        $comp = [];
        $points = [];

       for ($i=1; $i < 10; $i++) { 
           $comp[$i] = $mysqli->prepare("SELECT id, comp_id, points FROM user_comp WHERE comp_id={$i} AND id={$id1}");
           $comp[$i]->execute();
           $comp[$i]->store_result();
           $comp[$i]->bind_result($id, $comp_id, $points[$i]);
           $comp[$i]->fetch();
           echo $points[$i].'<br>';
       }
       


 	$i = 1;
        while ($i < 10) {
            if($comps = $mysqli->prepare("SELECT comp_name, comp_id FROM competenties WHERE comp_id = '".$i."'"))
            $comps->execute();
            $comps->store_result();
            $comps->bind_result($comp_id, $comp_name);
            $comps->fetch();
            print_r($comp_id);
            echo ': '.$points[$i]."<br>";
            $i++;
        }
       // 

        $p1 = 0;
        $p2 = 0;
        $p3 = 0;
        $p4 = 30;
        $p5 = 0;
        $p6 = 20;
        $p7 = 30;
        $p8 = 20;
        $p9 = 0;

        $post = [$p1,$p2,$p3,$p4,$p5,$p6,$p7,$p8,$p9];
        $result = mysqli_query($mysqli, "SELECT * FROM user_comp WHERE id={$id1}");
        $num_rows = mysqli_num_rows($result);

       for ($i=1, $p = 0; $i < 10; $i++, $p++) { 
        $comp_id = $i;
        $points = $post[$p];
        if ($num_rows > 0) {
            $sql = mysqli_query($mysqli, "UPDATE user_comp SET points={$points} WHERE id={$id1} AND comp_id={$comp_id}");
        }else{
            $query = mysqli_query($mysqli, "INSERT INTO user_comp ( id, comp_id, points ) VALUES ({$id1}, {$comp_id}, {$points})");
        }
       }

        

    ?>
    </div>
<?php else : ?>
	<p>ur logged out</p>
<?php endif; ?>
	</body>
</html>

