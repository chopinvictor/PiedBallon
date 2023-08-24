<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Création d'un match</title>
	<link rel="stylesheet" href="../css/general.css">
</head>
<header>
</header>
<nav>
    <div class="navigation">
        <ul class="ul_nav">
            <li>
                <a href="../php/general.php">
                    <div class=" current nav_box">
                        <svg class="svg_icon" ><use class="svg_nav_all" xlink:href="#svg_setting"/></svg>
                        <p>Général</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="../php/participant.php">
                    <div class="nav_box">
                        <svg class="svg_icon" ><use class="svg_nav_all" xlink:href="#svg_participant"/></svg>
                        <p>Participant</p>
                    </div>
                </a>
            </li>
            <li>
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
            </li>
            <li>
                <div class="nav_box">
                    <svg class="svg_icon" ><use class="svg_nav_all" xlink:href="#svg_presentation"/></svg>
                    <p>Presentation</p>
                </div>
            </li>
            <li>
                <a href="../php/match.php">
                    <div class="nav_box">
                        <svg class="svg_icon" ><use class="svg_nav_all" xlink:href="#svg_score"/></svg>
                        <p>Match</p>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</nav>

<body>
	<section class="parametre">
		<div class="parametre_container">
			<div class="principal tournament_name">
				<h2>Nom du Match</h2>
				<div class="div_input_name">
					<input type="text" value="Cap Vert vs Madagascar">
				</div>
			</div>
			<div class="principal match_day">
				<h2>Date du Match</h2>
				<div class="card_container">
					<p class="card_number match_number">1</p>
					<p class="card_info match_date">Vendredi 18 Avril 2023</p>
					<button class="button_svg_edit"><svg class="svg_icon_edit">
							<use class="svg_nav_all" xlink:href="#svg_edit" />
						</svg></button>
				</div>
			</div>
			<div class="principal Match_location">
				<h2>Lieux</h2>
				<div class="card_container">
					<p class="card_number location_number">1</p>
					<p class="card_info location_name">Biaritz</p>
					<button class="button_svg_edit"><svg class="svg_icon_edit">
							<use class="svg_nav_all" xlink:href="#svg_edit" />
						</svg></button>
				</div>
			</div>
			<div class="principal division">
				<h2>Division</h2>
				<div class="card_container">
					<p class="card_number Division_number">1</p>
					<p class="card_info Division_name">Biaritz</p>
					<button class="button_svg_edit"><svg class="svg_icon_edit">
							<use class="svg_nav_all" xlink:href="#svg_edit" />
						</svg></button>
				</div>
				<button class="button_principal">Ajouter une division</button>
			</div>
		</div>

	</section>
</body>



<hide class="hide">

	<!-- svg pour le menu de navigation -->

	<svg class="svg_all" id="svg_setting" focusable="false" viewBox="0 0 24 24" aria-hidden="true">
		<path transform="scale(1.2, 1.2)" d="M15.95 10.78c.03-.25.05-.51.05-.78s-.02-.53-.06-.78l1.69-1.32c.15-.12.19-.34.1-.51l-1.6-2.77c-.1-.18-.31-.24-.49-.18l-1.99.8c-.42-.32-.86-.58-1.35-.78L12 2.34c-.03-.2-.2-.34-.4-.34H8.4c-.2 0-.36.14-.39.34l-.3 2.12c-.49.2-.94.47-1.35.78l-1.99-.8c-.18-.07-.39 0-.49.18l-1.6 2.77c-.1.18-.06.39.1.51l1.69 1.32c-.04.25-.07.52-.07.78s.02.53.06.78L2.37 12.1c-.15.12-.19.34-.1.51l1.6 2.77c.1.18.31.24.49.18l1.99-.8c.42.32.86.58 1.35.78l.3 2.12c.04.2.2.34.4.34h3.2c.2 0 .37-.14.39-.34l.3-2.12c.49-.2.94-.47 1.35-.78l1.99.8c.18.07.39 0 .49-.18l1.6-2.77c.1-.18.06-.39-.1-.51l-1.67-1.32zM10 13c-1.65 0-3-1.35-3-3s1.35-3 3-3 3 1.35 3 3-1.35 3-3 3z">

		</path>
	</svg>
	<svg class="svg_all" id="svg_participant" viewBox="0 0 24 24" role="accueil" style="width: 1.5rem; height: 1.5rem;">
		<path d="M16,21H8A1,1 0 0,1 7,20V12.07L5.7,13.07C5.31,13.46 4.68,13.46 4.29,13.07L1.46,10.29C1.07,9.9 1.07,9.27 1.46,8.88L7.34,3H9C9,4.1 10.34,5 12,5C13.66,5 15,4.1 15,3H16.66L22.54,8.88C22.93,9.27 22.93,9.9 22.54,10.29L19.71,13.12C19.32,13.5 18.69,13.5 18.3,13.12L17,12.12V20A1,1 0 0,1 16,21">
		</path>
	</svg>

	<svg class="svg_all" id="svg_classement" viewBox="0 0 24 24" role="accueil" style="width: 1.5rem; height: 1.5rem;">
		<path d="M2,2V4H7V8H2V10H7C8.11,10 9,9.11 9,8V7H14V17H9V16C9,14.89 8.11,14 7,14H2V16H7V20H2V22H7C8.11,22 9,21.11 9,20V19H14C15.11,19 16,18.11 16,17V13H22V11H16V7C16,5.89 15.11,5 14,5H9V4C9,2.89 8.11,2 7,2H2Z">
		</path>
	</svg>

	<svg class="svg_all" id="svg_calendrier" viewBox="0 0 24 24" role="accueil" style="width: 1.5rem; height: 1.5rem;">
		<path d="M9,10H7V12H9V10M13,10H11V12H13V10M17,10H15V12H17V10M19,3H18V1H16V3H8V1H6V3H5C3.89,3 3,3.9 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5A2,2 0 0,0 19,3M19,19H5V8H19V19Z">
		</path>
	</svg>


	<svg class="svg_all" id="svg_accueil" focusable="false" viewBox="0 0 24 24" aria-hidden="true">
		<path d="M6 22h12l-6-6z"></path>
		<path d="M21 3H3c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h4v-2H3V5h18v12h-4v2h4c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z">
		</path>
	</svg>

	<svg class="svg_all" id="svg_score" viewBox="0 0 24 24" role="accueil" style="width: 1.5rem; height: 1.5rem;">
		<path d="M6 9H8V15H6V9M16 9H18V15H16V9M21 3C22.1 3 23 3.9 23 5V19C23 20.1 22.1 21 21 21H3C1.9 21 1 20.1 1 19V5C1 3.9 1.9 3 3 3H21M5 7C4.4 7 4 7.4 4 8V16C4 16.6 4.4 17 5 17H9C9.6 17 10 16.6 10 16V8C10 7.4 9.6 7 9 7H5M15 7C14.4 7 14 7.4 14 8V16C14 16.6 14.4 17 15 17H19C19.6 17 20 16.6 20 16V8C20 7.4 19.6 7 19 7H15M12 11C12.6 11 13 10.6 13 10C13 9.4 12.6 9 12 9C11.4 9 11 9.4 11 10C11 10.6 11.4 11 12 11M12 15C12.6 15 13 14.6 13 14C13 13.4 12.6 13 12 13C11.4 13 11 13.4 11 14C11 14.6 11.4 15 12 15Z">
		</path>
	</svg>

	<!-- svg pour le petit edit -->

	<svg class="svg_all" id="svg_edit" focusable="false" viewBox="0 0 24 24" aria-hidden="true">
		<path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34a.9959.9959 0 00-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z">
		</path>
	</svg>

</hide>

</html>