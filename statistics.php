<?php include('html-header.php');

	 ?>

	<div class="header">
		<h2 id="torunament-status-title">Statistici</h2>
	</div>
	
	<div class="main-panel">
		<h2 id="title">Piloti ai echipei</h2>
		<form class="form-horizontal" action="statistics.php" method="POST">

			<button class="btn btn-block btn-lg" type="submit" name="submit-pilots-teams">Go!</button>
			<div class="form-group">
				<label for="team-selection" class="control-label col-sm-2">Alegeti echipa:</label>
				<div class="col-sm-9">
					<?php
						echo "<select name='team-selection' class='form-control'>";

						$selectAllTeams = "SELECT ID_Echipa, nume FROM echipe;";

						$run_selectAllTeams = mysqli_query($db, $selectAllTeams);

						while($row = mysqli_fetch_assoc($run_selectAllTeams)){
							$teamID = $row['ID_Echipa'];
							$teamName = $row['nume'];

							echo "<option name='$teamName' value='$teamID'>$teamName</option>";
						}

						echo "</select>"
					?>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table table-striped">
					<tr>
						<th>Pilot</th>
						<th>Masina</th>
						<th>Putere masina</th>
						<th>Capacitate motor</th>
					</tr>
					<?php
					if(isset($_POST['submit-pilots-teams'])){
						$teamID = $_POST['team-selection'];

						$selectPilotDetails = "SELECT piloti.Nume as Pilot_nume, masini.Serie_Sasiu as Serie_sasiu, masini.putere_motor as Putere_motor, masini.capacitate_motor as Capacitate_motor FROM piloti JOIN masini ON piloti.ID_Pilot = masini.ID_Pilot WHERE piloti.ID_Echipa = $teamID;";

						$run_selectPilotDetails = mysqli_query($db, $selectPilotDetails);

						while($row = mysqli_fetch_assoc($run_selectPilotDetails)){
							$pilotName = $row['Pilot_nume'];
							$carVin = $row['Serie_sasiu'];
							$carPow = $row['Putere_motor'];
							$carCap = $row['Capacitate_motor'];

							echo "<tr>
									 <td>$pilotName</td>
									 <td>$carVin</td>
									 <td>$carPow</td>
									 <td>$carCap</td>
								 </tr>";
					}

						}
					?>
				</table>
			</div>
		</form>
		<h2 id="title">Cel mai bun timp al unui pilot pe o cursa</h2>
		<form class="form-horizontal" action="statistics.php" method="POST">
			<button class="btn btn-block btn-lg" type="submit" name="submit-best-race">Go!</button>
				<div class="form-group">
					<label for="race-selection" class="control-label col-sm-2">Alegeti cursa:</label>
					<div class="col-sm-9">
						<?php
								echo "<select name='race-selection' class='form-control'>";

								$selectAllRaces = "SELECT ID_Cursa, locatie FROM curse;";

								$run_selectAllRaces = mysqli_query($db, $selectAllRaces);

								while($row = mysqli_fetch_assoc($run_selectAllRaces)){
									$raceID = $row['ID_Cursa'];
									$raceLocation = $row['locatie'];

									echo "<option name='$raceLocation' value='$raceID'>$raceLocation</option>";
								}

								echo "</select>"
							?>
					</div>
				</div>
				<div class="table-responsive">
					<table class="table table-striped">
						<tr>
							<th>Pilot</th>
							<th>Timp</th>
						</tr>
				<?php

					if(isset($_POST['submit-best-race'])){
						$raceID = $_POST['race-selection'];

						$selectBestPilotForRace = "SELECT piloti.nume as PilotNume, a.timp as PilotTimp FROM piloti JOIN (SELECT ID_Pilot, timp FROM piloticurseturnee WHERE piloticurseturnee.ID_Cursa = $raceID) a ON piloti.ID_Pilot = a.ID_Pilot WHERE timp IS NOT NULL ORDER BY a.timp ASC LIMIT 1";
						$run_selectBestPilotForRace = mysqli_query($db, $selectBestPilotForRace);

						while($row = mysqli_fetch_assoc($run_selectBestPilotForRace)){
							$pilotName = $row['PilotNume'];
							$pilotTime = $row['PilotTimp'];

							echo "<tr>
									 <td>$pilotName</td>
									 <td>$pilotTime</td>
								 </tr>";
						}
					}
				?>
				</table>
			</div>
		</form>
	</div>
<?php include('html-footer.php') ?>