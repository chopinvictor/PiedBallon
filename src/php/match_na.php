<?php 

session_start();

if(empty($_SESSION) || ($_SESSION['admin']!==1)){
    header("Location: ../php/login.php");
}



require_once('bdd.php');

$id_equipe =$_SESSION['id_equipe'];
$id_adversaire = $_SESSION['id_adversaire'];
$id_match = $_SESSION['id_match'];


$query = "SELECT * 
FROM matchs
WHERE id_match=?";
$getmatch = $db->prepare($query);
$getmatch->execute([$id_match]);

$match= $getmatch->fetchAll(PDO::FETCH_OBJ);

$query = "SELECT * 
FROM equipes
WHERE id_equipe=?";
$getmatch = $db->prepare($query);
$getmatch->execute([$id_equipe]);

$equipe_une= $getmatch->fetchAll(PDO::FETCH_OBJ);

$query = "SELECT * 
FROM equipes
WHERE id_equipe=?";
$getmatch = $db->prepare($query);
$getmatch->execute([$id_adversaire]);

$equipe_deux= $getmatch->fetchAll(PDO::FETCH_OBJ);

$query_team = "SELECT *
FROM matchs
WHERE id_match =?;";

$getmatch = $db->prepare($query_team);
$getmatch->execute([$id_match]);

$match = $getmatch->fetchAll(PDO::FETCH_OBJ);

if($id_equipe<$id_adversaire){
	$nom_equipe_une = $equipe_une[0]->nom_equipe ;
	$nom_equipe_deux = $equipe_deux[0]->nom_equipe ;
	$id_equipe_une = $equipe_une[0]->id_equipe;
	$id_equipe_deux = $equipe_deux[0]->id_equipe;
	$score_une= $match[0]->score_equipe_1;	
	$score_deux= $match[0]->score_equipe_2;	

}else{
	$nom_equipe_une = $equipe_deux[0]->nom_equipe ;
	$nom_equipe_deux = $equipe_une[0]->nom_equipe ;
	$id_equipe_une =  $equipe_deux[0]->id_equipe;	
	$id_equipe_deux =$equipe_une[0]->id_equipe;
	$score_deux= $match[0]->score_equipe_1;	
	$score_une= $match[0]->score_equipe_2;	

};


if(isset($_POST['remplacement_equipe_deux'])){
	if(!empty($_POST['temps_equipe_deux'])){
		header("Location: ../php/match_remplacement.php?id_equipe=".$id_equipe_deux."&temps_jeux=".$_POST['temps_equipe_deux'] );
	}
}
if(isset($_POST['send'])){
	if(!empty($_POST['equipe_une'])){
		header("Location: ../php/match_remplacement.php?id_equipe=".$id_equipe_une."&temps_jeux=".$_POST['temps_equipe_une'] );
	}
}

$query = "SELECT joueurs.nom, evenements.*, remplacements.id_remplacement, remplace.est_remplace
FROM evenements
INNER JOIN remplacements ON remplacements.id_evenement = evenements.id_evenement
INNER JOIN remplace ON remplace.id_remplacement = remplacements.id_remplacement
INNER JOIN joueurs ON joueurs.id_joueur = remplace.id_joueur
WHERE id_match = ?";
$getmatch = $db->prepare($query);
$getmatch->execute([$id_match]);

$remplacement= $getmatch->fetchAll(PDO::FETCH_OBJ);


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Match</title>
	<link rel="stylesheet" href="../css/match.css">
	<link rel="stylesheet" href="../css/participant.css">
</head>


<nav>
    <div class="navigation">
        <ul class="ul_nav">
            <li>
				<a href="../php/club_na.php">
                    <div class="nav_box">
                        <svg class="svg_icon" ><use class="svg_nav_all" xlink:href="#svg_home"/></svg>
                        <p>Home</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="../php/general_na.php">
                    <div class="nav_box">
                        <svg class="svg_icon" ><use class="svg_nav_all" xlink:href="#svg_setting"/></svg>
                        <p>Général</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="../php/participant_na.php">
                    <div class="nav_box">
                        <svg class="svg_icon" ><use class="svg_nav_all" xlink:href="#svg_participant"/></svg>
                        <p>Participant</p>
                    </div>
                </a>
            </li>
            <!-- <li>
                <div class="nav_box">
                    <svg class="svg_icon" ><use class="svg_nav_all" xlink:href="#svg_classement"/></svg>
                    <p>Classement</p>
                </div>
            </li>
            <li>
                <div class="nav_box">
                    <svg class="svg_icon" ><use class="svg_nav_all" xlink:href="#svg_calendrier"/></svg>
                    <p>Calendrier</p>
                </div>
            </li> -->
            <li>
                <a href="../php/match.php">
                    <div class="current nav_box">
                        <svg class="svg_icon" ><use class="svg_nav_all" xlink:href="#svg_score"/></svg>
                        <p>Match</p>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</nav>

<body>
	<section class="sec_main">
		<div class="affichage_score">
			<div class="equipe">
				<h2 class="nom_equipe_1"><?php echo $nom_equipe_une ?></h2>
				<p class="Value_Score"><?php echo $score_une ?></p>
			</div>
			<div class="terrain">
				<img class="img_terrain" src="../media/football.jpg" alt="terrain de football">
			</div>
			<div class="equipe">
				<h2 class="nom_equipe_2"><?php echo $nom_equipe_deux ?></h2>
				<p class="Value_Score"><?php echo $score_deux ?></p>
            </div>
        <div>
		<h2 style="margin-left: 170px;">les remplacements</h2>
		<?php
		$count = 0;
            foreach($remplacement as $Value) : ;
			$count=$count +1;
				$nom=$Value->nom;
				if($Value->est_remplace == 1){
					$remplace = "Est remplacé";
				}else{
					$remplace ="Remplace";
				};
				$temps = strval($Value->horodatage)
				
                    ?>
                    <div style="margin-left: 170px;" class="card_container">
                        <p class="card_number Division_number">1</p>
                        <p class="card_info Division_name"><?= $nom." ".$remplace." à la ".$temps."min" ?> </p>
                    </div>                
            <?php endforeach ?>
            </div>
	</div>
	</section>
</body>


<hide class="hide">

	<!-- svg pour le menu de navigation -->
	
    <svg class="svg_all" id="svg_home" viewBox="0 0 24 24" fill="none">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M21.4498 10.275L11.9998 3.1875L2.5498 10.275L2.9998 11.625H3.7498V20.25H20.2498V11.625H20.9998L21.4498 10.275ZM5.2498 18.75V10.125L11.9998 5.0625L18.7498 10.125V18.75H14.9999V14.3333L14.2499 13.5833H9.74988L8.99988 14.3333V18.75H5.2498ZM10.4999 18.75H13.4999V15.0833H10.4999V18.75Z" fill="#080341"/>
    </svg>

	<svg class="svg_all" id="svg_setting" focusable="false" viewBox="0 0 24 24" aria-hidden="true">
		<path transform="scale(1.2, 1.2)"
			d="M15.95 10.78c.03-.25.05-.51.05-.78s-.02-.53-.06-.78l1.69-1.32c.15-.12.19-.34.1-.51l-1.6-2.77c-.1-.18-.31-.24-.49-.18l-1.99.8c-.42-.32-.86-.58-1.35-.78L12 2.34c-.03-.2-.2-.34-.4-.34H8.4c-.2 0-.36.14-.39.34l-.3 2.12c-.49.2-.94.47-1.35.78l-1.99-.8c-.18-.07-.39 0-.49.18l-1.6 2.77c-.1.18-.06.39.1.51l1.69 1.32c-.04.25-.07.52-.07.78s.02.53.06.78L2.37 12.1c-.15.12-.19.34-.1.51l1.6 2.77c.1.18.31.24.49.18l1.99-.8c.42.32.86.58 1.35.78l.3 2.12c.04.2.2.34.4.34h3.2c.2 0 .37-.14.39-.34l.3-2.12c.49-.2.94-.47 1.35-.78l1.99.8c.18.07.39 0 .49-.18l1.6-2.77c.1-.18.06-.39-.1-.51l-1.67-1.32zM10 13c-1.65 0-3-1.35-3-3s1.35-3 3-3 3 1.35 3 3-1.35 3-3 3z">

		</path>
	</svg>
	<svg class="svg_all" id="svg_participant" viewBox="0 0 24 24" role="accueil" style="width: 1.5rem; height: 1.5rem;">
		<path
			d="M16,21H8A1,1 0 0,1 7,20V12.07L5.7,13.07C5.31,13.46 4.68,13.46 4.29,13.07L1.46,10.29C1.07,9.9 1.07,9.27 1.46,8.88L7.34,3H9C9,4.1 10.34,5 12,5C13.66,5 15,4.1 15,3H16.66L22.54,8.88C22.93,9.27 22.93,9.9 22.54,10.29L19.71,13.12C19.32,13.5 18.69,13.5 18.3,13.12L17,12.12V20A1,1 0 0,1 16,21">
		</path>
	</svg>

	<svg class="svg_all" id="svg_classement" viewBox="0 0 24 24" role="accueil" style="width: 1.5rem; height: 1.5rem;">
		<path
			d="M2,2V4H7V8H2V10H7C8.11,10 9,9.11 9,8V7H14V17H9V16C9,14.89 8.11,14 7,14H2V16H7V20H2V22H7C8.11,22 9,21.11 9,20V19H14C15.11,19 16,18.11 16,17V13H22V11H16V7C16,5.89 15.11,5 14,5H9V4C9,2.89 8.11,2 7,2H2Z">
		</path>
	</svg>

	<svg class="svg_all" id="svg_calendrier" viewBox="0 0 24 24" role="accueil" style="width: 1.5rem; height: 1.5rem;">
		<path
			d="M9,10H7V12H9V10M13,10H11V12H13V10M17,10H15V12H17V10M19,3H18V1H16V3H8V1H6V3H5C3.89,3 3,3.9 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5A2,2 0 0,0 19,3M19,19H5V8H19V19Z">
		</path>
	</svg>


	<svg class="svg_all" id="svg_accueil" focusable="false" viewBox="0 0 24 24" aria-hidden="true">
		<path d="M6 22h12l-6-6z"></path>
		<path d="M21 3H3c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h4v-2H3V5h18v12h-4v2h4c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z">
		</path>
	</svg>

	<svg class="svg_all" id="svg_score" viewBox="0 0 24 24" role="accueil" style="width: 1.5rem; height: 1.5rem;">
		<path
			d="M6 9H8V15H6V9M16 9H18V15H16V9M21 3C22.1 3 23 3.9 23 5V19C23 20.1 22.1 21 21 21H3C1.9 21 1 20.1 1 19V5C1 3.9 1.9 3 3 3H21M5 7C4.4 7 4 7.4 4 8V16C4 16.6 4.4 17 5 17H9C9.6 17 10 16.6 10 16V8C10 7.4 9.6 7 9 7H5M15 7C14.4 7 14 7.4 14 8V16C14 16.6 14.4 17 15 17H19C19.6 17 20 16.6 20 16V8C20 7.4 19.6 7 19 7H15M12 11C12.6 11 13 10.6 13 10C13 9.4 12.6 9 12 9C11.4 9 11 9.4 11 10C11 10.6 11.4 11 12 11M12 15C12.6 15 13 14.6 13 14C13 13.4 12.6 13 12 13C11.4 13 11 13.4 11 14C11 14.6 11.4 15 12 15Z">
		</path>
	</svg>

	<!-- svg pour le petit edit -->

	<svg class="svg_all" id="svg_edit" focusable="false" viewBox="0 0 24 24" aria-hidden="true">
		<path
			d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34a.9959.9959 0 00-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z">
		</path>
	</svg>

	<!-- svg pour le terrain de foot -->

	<svg id="svg_terrain" version="1.0" viewBox="2000 0 1000 4000">
		<path
			d="M1177 2793 c-1 0 -168 -3 -370 -6 -202 -2 -371 -7 -374 -11 -7 -7 155 -8 1762 -7 1744 0 1889 0 1882 7 -3 3 -142 8 -309 10 -295 4 -2588 11 -2591 7z" />
		<path d="M4105 2780 c-17 -7 -15 -8 10 -9 17 0 37 -1 45 -2 26 -4 84 1 79 6 -9 8 -114 13 -134 5z" />
		<path
			d="M223 2768 c-4 -7 -9 -76 -10 -153 -2 -124 -14 -744 -15 -770 0 -5 1 -56 2 -112 1 -56 -1 -106 -4 -112 -4 -6 -19 -8 -34 -5 -19 4 -35 0 -50 -13 -22 -17 -23 -24 -23 -185 -1 -92 2 -176 6 -187 6 -20 22 -27 75 -33 25 -3 25 -3 26 -114 1 -61 5 -121 9 -134 5 -17 4 -21 -5 -15 -9 5 -11 4 -6 -4 5 -7 10 -191 12 -409 3 -396 7 -477 24 -487 31 -19 3989 -19 4008 0 3 3 -898 5 -2001 5 l-2007 0 0 590 0 590 -60 0 -60 0 0 185 0 185 60 0 60 0 0 589 0 590 86 -1 c47 0 88 3 91 6 4 3 -35 6 -85 6 -62 0 -93 -4 -99 -12z" />
		<path d="M250 2715 c0 -19 2 -35 4 -35 18 0 39 17 52 41 l15 29 -36 0 c-33 0 -35 -2 -35 -35z" />
		<path
			d="M323 2720 c-6 -16 -25 -38 -42 -47 l-30 -18 -3 -137 -3 -138 398 0 397 0 0 -312 0 -313 41 -40 c94 -93 143 -213 137 -338 -4 -104 -41 -187 -121 -274 l-57 -61 0 -306 0 -306 -401 0 c-362 0 -401 -2 -395 -16 3 -9 6 -71 6 -139 l0 -124 28 -13 c15 -7 34 -28 42 -45 l15 -33 953 0 952 0 0 438 0 439 -67 12 c-99 18 -169 55 -244 130 -95 96 -139 197 -139 326 0 201 130 377 321 436 33 10 76 19 95 19 l34 0 0 435 c0 283 3 435 10 435 7 0 10 -151 10 -434 l0 -433 62 -7 c139 -14 278 -117 346 -255 37 -74 37 -76 37 -196 0 -120 0 -122 -38 -199 -70 -140 -193 -234 -343 -258 l-64 -11 0 -438 0 -439 953 0 953 0 17 36 c11 22 29 40 47 47 l30 11 0 138 0 138 -400 0 -400 0 0 308 0 308 -31 30 c-47 44 -109 140 -130 200 -48 137 -2 306 118 435 l43 46 0 312 0 311 400 0 400 0 0 138 0 137 -33 15 c-18 8 -39 29 -47 47 l-15 33 -1915 0 -1916 0 -11 -30z m963 5 c445 -2 837 -5 871 -5 l62 0 0 -325 c0 -246 -3 -323 -12 -318 -7 4 -7 1 1 -9 9 -11 12 -41 10 -94 l-3 -77 -60 -19 c-33 -10 -67 -20 -75 -21 -61 -11 -216 -142 -250 -212 -8 -16 -21 -41 -29 -54 -9 -13 -17 -33 -18 -45 -2 -12 -7 -46 -12 -76 -24 -157 32 -309 158 -427 46 -43 169 -113 200 -113 9 0 33 -5 54 -11 l37 -10 0 -409 c0 -381 -1 -409 -17 -413 -10 -3 -337 -6 -728 -7 -390 -1 -801 -2 -912 -3 l-202 -2 -50 55 -51 55 3 103 c1 78 6 105 17 112 9 6 165 10 385 9 360 -1 370 0 386 20 14 17 16 54 17 288 0 147 1 279 1 293 1 15 22 47 51 80 55 61 104 151 123 225 10 39 10 66 1 125 -19 120 -44 174 -131 277 l-44 52 -1 298 c-1 275 -2 300 -19 319 -18 20 -26 20 -385 17 -219 -1 -373 1 -384 7 -15 8 -18 25 -19 113 -2 101 -1 104 26 128 15 14 35 35 43 48 17 25 74 41 121 35 15 -2 390 -6 835 -9z m2810 3 c-1 -7 -1 -10 1 -5 12 20 48 2 93 -45 28 -29 50 -57 51 -63 5 -51 -3 -191 -12 -201 -8 -10 -92 -12 -385 -11 -316 1 -376 -1 -388 -13 -12 -12 -15 -72 -18 -317 l-4 -302 -26 -28 c-35 -38 -102 -140 -118 -180 -7 -18 -16 -33 -19 -33 -9 0 -15 -69 -13 -152 2 -85 32 -166 90 -243 25 -33 50 -64 57 -70 28 -24 32 -60 33 -338 1 -238 4 -290 16 -302 12 -13 74 -15 394 -15 337 0 381 -2 386 -16 3 -9 6 -61 6 -115 0 -99 0 -100 -31 -128 -17 -16 -36 -39 -43 -52 l-12 -24 -252 0 c-138 0 -252 2 -252 5 0 3 -304 5 -675 5 -590 0 -677 2 -685 15 -14 21 -10 210 4 210 8 0 8 2 0 8 -14 9 -17 307 -4 332 7 13 7 21 0 25 -5 3 -10 20 -10 36 0 20 4 28 12 23 7 -5 8 -3 2 7 -11 17 -12 159 -1 152 4 -2 7 3 7 11 0 14 71 33 107 29 7 0 10 3 7 8 -3 5 3 9 13 9 28 0 121 65 178 124 93 98 127 187 126 336 0 102 -24 186 -71 256 -38 55 -99 117 -142 142 -15 9 -28 20 -28 24 0 4 -7 8 -15 8 -8 0 -23 4 -33 10 -9 5 -46 16 -81 25 -36 9 -67 18 -70 21 -9 9 -7 815 2 821 4 3 405 7 889 9 485 3 884 7 887 9 10 10 30 4 27 -7z" />
		<path d="M4190 2737 c0 -16 42 -57 58 -57 7 0 12 15 12 35 0 33 -2 35 -35 35 -22 0 -35 -5 -35 -13z" />
		<path
			d="M4278 2157 l-3 -567 58 0 57 0 0 -185 0 -185 -57 0 -58 0 3 -567 c1 -311 5 -563 9 -560 3 4 8 244 10 534 2 291 6 538 9 551 4 18 11 22 44 22 65 0 70 16 65 213 -3 178 -8 197 -52 197 -13 0 -33 5 -43 10 -19 10 -20 26 -20 363 0 382 -7 727 -15 735 -2 3 -6 -250 -7 -561z" />
		<path
			d="M245 2105 l0 -255 138 0 137 0 0 -445 0 -445 -137 0 -138 0 0 -255 0 -255 387 0 388 0 2 648 c2 356 2 785 0 955 l-2 307 -388 0 -387 0 0 -255z m391 224 c12 -10 13 -9 8 6 -5 13 -4 16 4 11 7 -4 86 -7 176 -7 135 -1 166 -3 170 -15 3 -8 6 -226 6 -485 -1 -362 -3 -469 -13 -469 -9 0 -9 -2 0 -8 10 -6 12 -110 10 -447 l-2 -440 -69 -3 c-49 -2 -71 0 -77 10 -6 9 -9 9 -9 1 0 -9 -70 -12 -285 -12 l-285 1 -1 41 c-4 169 2 402 11 411 6 6 55 10 119 8 95 -1 110 1 125 17 16 17 17 59 17 456 0 409 -1 438 -18 451 -16 12 -160 21 -226 15 -9 -1 -19 4 -22 11 -8 24 -10 268 -2 268 4 0 4 8 -2 18 -11 21 -5 163 7 171 19 12 343 3 358 -10z" />
		<path
			d="M738 1443 c-30 -36 -31 -44 -3 -73 l28 -29 28 20 c34 24 37 47 9 77 -25 27 -42 28 -62 5z m55 -25 c7 -21 -4 -38 -23 -38 -23 0 -34 16 -26 35 7 18 43 20 49 3z" />
		<path
			d="M3480 1405 l0 -955 390 0 390 0 0 255 0 254 -137 3 -138 3 -1 425 c0 234 2 433 4 443 4 15 19 17 138 17 l134 0 0 255 0 255 -390 0 -390 0 0 -955z m659 935 c30 0 56 2 59 5 3 2 13 0 23 -6 18 -9 19 -24 18 -222 -1 -117 -6 -220 -11 -230 -8 -15 -22 -18 -91 -17 -110 1 -118 0 -150 -12 l-28 -11 0 -161 c0 -88 0 -190 1 -225 0 -43 -4 -67 -12 -73 -9 -5 -10 -8 -1 -8 9 0 12 -54 13 -207 0 -170 3 -210 15 -222 11 -12 44 -16 128 -18 61 -2 117 -5 123 -7 12 -4 16 -426 5 -445 -8 -13 -6 -12 -398 -12 -178 1 -322 5 -322 9 1 4 0 9 -1 12 -8 16 -5 1148 3 1143 6 -4 7 -1 1 8 -13 22 -14 543 0 551 8 6 7 8 -2 8 -8 0 -12 16 -11 53 2 93 -18 86 231 87 122 0 223 2 224 3 1 1 31 1 66 -1 34 -1 87 -2 117 -2z" />
		<path
			d="M3701 1436 c-27 -29 -22 -57 13 -75 29 -16 61 -2 71 30 7 22 -27 69 -50 69 -6 0 -22 -11 -34 -24z m57 -29 c4 -20 -25 -34 -40 -19 -15 15 -1 44 19 40 10 -2 19 -11 21 -21z" />
		<path
			d="M2175 1840 c-148 -31 -264 -122 -328 -258 -30 -63 -32 -74 -32 -177 0 -106 1 -113 37 -187 48 -101 114 -168 211 -213 39 -19 96 -37 125 -41 l52 -7 0 215 c0 155 -3 217 -12 226 -10 10 -10 17 0 32 17 28 17 420 0 419 -7 -1 -31 -5 -53 -9z m29 -26 c14 -5 16 -30 16 -175 0 -168 -5 -200 -39 -244 -15 -18 -15 -19 1 -7 32 25 39 -15 36 -209 -3 -208 -1 -202 -90 -173 -119 39 -199 107 -250 212 -30 60 -33 77 -36 173 -4 104 -3 109 31 180 38 82 117 176 138 164 7 -5 10 -4 6 3 -8 11 58 46 126 68 23 7 43 13 44 13 1 1 8 -2 17 -5z" />
		<path
			d="M2260 1647 c0 -147 3 -206 12 -215 10 -10 10 -17 0 -32 -8 -14 -12 -81 -12 -230 l0 -210 23 0 c45 0 143 31 196 63 69 41 133 113 171 190 123 254 -23 556 -301 622 -35 8 -70 15 -76 15 -10 0 -13 -47 -13 -203z m187 123 c66 -35 143 -104 143 -126 0 -8 4 -14 8 -14 9 0 39 -62 44 -90 2 -8 7 -18 12 -22 5 -3 9 -53 9 -110 0 -93 -3 -109 -30 -172 -17 -39 -33 -62 -36 -55 -4 9 -6 7 -6 -5 -1 -26 -48 -86 -67 -86 -8 0 -13 -4 -10 -9 3 -5 -21 -23 -54 -40 -33 -18 -60 -29 -60 -25 0 3 -6 2 -13 -4 -7 -6 -31 -14 -54 -18 -39 -6 -40 -6 -45 27 -3 19 -3 108 -1 199 2 91 4 179 4 195 -5 201 -5 373 1 386 9 24 79 10 155 -31z" />
		<path
			d="M248 1405 l2 -425 125 0 125 0 0 425 0 425 -127 0 -128 0 3 -425z m210 399 c18 -5 22 -13 22 -45 0 -24 -5 -39 -12 -40 -10 0 -10 -2 0 -6 16 -6 17 -693 1 -693 -6 0 -7 -4 -4 -10 4 -6 -28 -10 -89 -10 -52 0 -97 4 -100 8 -3 5 -6 27 -7 48 -3 89 3 739 7 746 6 9 148 11 182 2z" />
		<path
			d="M4000 1405 l0 -425 130 0 130 0 0 425 0 425 -130 0 -130 0 0 -425z m226 394 c5 -8 9 -678 5 -781 -1 -16 -12 -18 -95 -18 -64 0 -97 4 -102 12 -4 7 -9 182 -10 390 -3 327 -1 380 12 393 19 18 179 22 190 4z" />
		<path
			d="M1040 1399 l1 -334 45 50 c25 28 61 83 81 123 33 66 37 81 36 150 0 51 -7 96 -20 133 -22 59 -85 160 -122 193 l-21 19 0 -334z m80 199 c16 -29 33 -68 36 -86 3 -18 10 -34 14 -37 11 -7 12 -145 1 -145 -6 0 -8 -7 -5 -15 4 -8 2 -21 -4 -28 -5 -6 -15 -28 -21 -48 -6 -20 -25 -51 -41 -69 l-30 -34 -1 47 c-1 26 -1 58 -1 72 0 276 4 395 12 395 5 0 23 -24 40 -52z" />
		<path
			d="M3411 1680 c-24 -30 -58 -84 -75 -120 -28 -59 -31 -74 -31 -165 0 -89 3 -106 27 -155 15 -30 49 -81 75 -113 l48 -59 3 166 c1 91 1 241 0 333 l-3 167 -44 -54z m27 -317 c-2 -123 -6 -223 -10 -223 -5 0 -8 7 -8 16 0 8 -4 12 -10 9 -5 -3 -12 6 -16 20 -3 14 -10 25 -14 25 -4 0 -18 26 -31 57 -44 110 -24 255 49 350 l27 36 7 -34 c4 -19 7 -134 6 -256z" />
		<path
			d="M130 1410 l0 -170 50 0 50 0 0 170 0 170 -50 0 -50 0 0 -170z m72 24 c2 -64 0 -118 -4 -120 -3 -2 -4 -13 -1 -24 4 -15 0 -20 -15 -20 -35 0 -35 3 -32 165 1 63 6 103 13 107 31 20 36 7 39 -108z" />
		<path
			d="M4278 1408 l-3 -168 48 0 47 0 0 168 0 167 -45 0 -44 1 -3 -168z m67 132 c3 -5 6 -65 6 -132 0 -105 -2 -124 -17 -135 -12 -9 -20 -10 -24 -2 -8 12 -11 259 -4 271 7 11 32 10 39 -2z" />
		<path d="M245 95 c0 -33 2 -35 33 -35 38 0 42 17 9 48 -32 31 -42 28 -42 -13z" />
		<path d="M4211 104 c-29 -37 -26 -44 14 -44 33 0 35 2 35 35 0 43 -20 46 -49 9z" />
	</svg>

	<!-- svg pour l'icon switch -->
	<svg id="svg_switch" viewBox="0 0 1024 1024">
		<path
			d="M118.656 438.656a32 32 0 0 1 0-45.248L416 96l4.48-3.776A32 32 0 0 1 461.248 96l3.712 4.48a32.064 32.064 0 0 1-3.712 40.832L218.56 384H928a32 32 0 1 1 0 64H141.248a32 32 0 0 1-22.592-9.344zM64 608a32 32 0 0 1 32-32h786.752a32 32 0 0 1 22.656 54.592L608 928l-4.48 3.776a32.064 32.064 0 0 1-40.832-49.024L805.632 640H96a32 32 0 0 1-32-32z" />
	</svg>

</hide>


</html>