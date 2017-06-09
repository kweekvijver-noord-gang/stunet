<?php
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

	<div class="welcomescreen"><p>WELCOME BACK <?php echo htmlentities($_SESSION['username']); ?></p></div>
    <div class="matches">Gematchde studenten</div>
    <div class="vacatures">Openstaande vacatures</div>
	<p><?php echo htmlentities($_SESSION['comp_points']); ?>punten over</p>

<?php else : ?>
	<p>ur logged out</p>
<?php endif; ?>
	</body>
</html>

