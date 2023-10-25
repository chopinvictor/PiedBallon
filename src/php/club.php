<?php
session_start();

if (empty($_SESSION) || ($_SESSION['admin'] !== 1)) {
	header("Location: ../php/login.php");
}


require_once('bdd.php');

$query = "SELECT * FROM clubs";
$getmatch = $db->prepare($query);
$getmatch->execute();

$club = $getmatch->fetchAll(PDO::FETCH_OBJ);

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="../css/club.css">
</head>

<body>
	<button class="button_svg_edit" style="font-size: 2em; font-weight:300; top:20px; right:20px;position:absolute;">

		<a href="match_create.php">+</a>
	</button>

	<?php
	foreach ($club as $Value) :;
		$lieu = $Value->lieu;
		$id_club = $Value->id_club;
	?>
		<div class="principal arbitre">
			<div class="card_container">
				<p class="card_info Division_name"><?= $lieu ?> </p>
				<a href=<?php echo "../php/club_set_id.php?id_club=" . $id_club . "&lieu_club=" . $lieu   ?> class="link">
					<p>voir les équipes du club</p>
				</a>
			</div>
		</div>

	<?php endforeach ?>

</body>

</html>