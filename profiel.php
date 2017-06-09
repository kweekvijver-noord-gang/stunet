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
 	$i = 1;
        while ($i < 10) {
            if($comps = $mysqli->prepare("SELECT comp_name, comp_id FROM competenties WHERE comp_id = '".$i."'"))
            $comps->execute();
            $comps->store_result();
            $comps->bind_result($comp_id, $comp_name);
            $comps->fetch();
            print_r($comp_id."<br>");
            $i++;
        }
    ?>
    </div>
<?php else : ?>
	<p>ur logged out</p>
<?php endif; ?>
	</body>
</html>

