<?php include('html-header.php') ?>

	<div class="header">
		<h2 id="torunament-panel-title">Panou turnee</h2>
	</div>

	<div class="main-panel">
			<h2 id="title">Activare turneu</h2>
			<form class="form-horizontal" action="tournaments-panel.php" method="POST">
				<div class="form-group">
					<label class="col-sm-2 control-label" for="dropdown-selection">Turneu:</label>
					<div class="col-sm-9">
						<?php
							//Query String
							$selectAllTournaments = "SELECT ID_Turneu, denumire FROM turnee WHERE status = 'Deschis'";
							//Executing Query 
							$run_selectAllTournaments = mysqli_query($db, $selectAllTournaments);
							echo "<select id='dropdown-selection' name='dropdown-selection' class='form-control'>";

							while($row = mysqli_fetch_assoc($run_selectAllTournaments)){
								$id_turneu = $row["ID_Turneu"];
								$tournamentName = $row["denumire"];
								echo "<option name='$tournamentName' value = $id_turneu>$tournamentName</option>";
							}

							echo "</select>";
						?>
					</div>
				</div>
				<div class="form-group">
					<div class="table-responsive col-sm-12">
						<table class="table table-striped" id="pilot-selection-table">
							<tr>
								<th>Pilot</th>
								<th>Echipa</th>
								<th>Serie sasiu - Masina</th>
								<th>Nr. Masina</th>
								<th>Capacitate motor</th>
								<th>Putere motor</th>
								<th>Selectie</th>
							</tr>
							<?php
								//Query String
								$selectAllPilotsCarsDetails = "SELECT piloti.nume AS NumePilot, echipe.nume AS NumeEchipa, masini.Serie_Sasiu AS VinMasina, masini.numar_masina as NrMasina, masini.capacitate_motor AS CmMasina, masini.putere_motor AS PmMasina FROM piloti JOIN echipe ON piloti.ID_Echipa = echipe.ID_Echipa JOIN masini ON piloti.ID_Pilot = masini.ID_Pilot;";

								$run_selectAllPilotsCarsDetails = mysqli_query($db, $selectAllPilotsCarsDetails);
								
								$counter = 1;
								
								while ($row = mysqli_fetch_assoc($run_selectAllPilotsCarsDetails)) {
									
									$pilotName = $row["NumePilot"];
									$teamName = $row["NumeEchipa"];
									$carVin = $row["VinMasina"];
									$carNo = $row["NrMasina"];
									$carEngCap = $row["CmMasina"];
									$carEngPow = $row["PmMasina"];
									

									echo "<tr id='$counter'>
											<td id='pilot_$counter'><input type='hidden' name='pilot_$counter' value='$pilotName'>$pilotName</td>
											<td id='team_$counter'>$teamName</td>
											<td id='car_vin_$counter'>$carVin</td>
											<td id='car_no_$counter'>$carNo</td>
											<td id='car_ec_$counter'>$carEngCap</td>
											<td id='car_ep_$counter'>$carEngPow</td>
											<td id='checkbox_pilot_$counter'><input type='checkbox' name='pilot_checkboxes[]' value='$counter'></td>
										 </tr>";

									$counter++;
								}
							?>
						</table>
					</div>
				</div>

				<div class="form-group">
					<div class="table-responsive col-sm-12">
						<table class="table table-striped" id="race-selection-table">
							<tr>
								<th>Locatie</th>
								<th>Numar ture</th>
								<th>Lungime</th>
								<th>Selectie</th>
							</tr>
							<?php
								//Query String
								$selectAllRacesDetails = "SELECT locatie, numar_ture, lungime FROM curse;";

								$run_selectAllRacesDetails = mysqli_query($db, $selectAllRacesDetails);
								
								$counter = 1;

								while ($row = mysqli_fetch_assoc($run_selectAllRacesDetails)) {
									
									$location = $row["locatie"];
									$laps = $row["numar_ture"];
									$length = $row["lungime"];

									echo "<tr id='$counter'>
											<td id='location_$counter'><input type='hidden' name='location_$counter' value='$location'>$location</td>
											<td id='laps_$counter'>$laps</td>
											<td id='length_$counter'>$length</td>
											<td id='checkbox_race_$counter'><input type='checkbox' name='race_checkboxes[]' value='$counter'></td>
										 </tr>";

									$counter++;
								}
							?>
						</table>
					</div>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-success btn-lg btn-block" name="submit-tournament-form">Activeaza turneu</button>
				</div>

				<?php
					if(isset($_POST['submit-tournament-form'])){
						$tournamentID = $_POST['dropdown-selection'];

						foreach($_POST['pilot_checkboxes'] as $selected){
							$pilotName = $_POST['pilot_'.$selected];
							
							//Query to fetch pilot's ID
							$selectPilotIdByName = "SELECT ID_Pilot FROM piloti WHERE nume = '$pilotName';";
							//Executing query
							$run_selectPilotIdByName = mysqli_query($db, $selectPilotIdByName);

							while($row = mysqli_fetch_assoc($run_selectPilotIdByName)){
								$pilotID = $row['ID_Pilot'];

							}
							foreach ($_POST['race_checkboxes'] as $selectedRace) {
								$raceLocation = $_POST['location_'.$selectedRace];

								//Query to fetch pilot's ID
								$selectRaceIdByLocation = "SELECT ID_Cursa FROM curse WHERE locatie = '$raceLocation';";
								//Executing query
								$run_selectRaceIdByLocation = mysqli_query($db, $selectRaceIdByLocation);

								while($row = mysqli_fetch_assoc($run_selectRaceIdByLocation)){
									$raceID = $row['ID_Cursa'];
								}

								$insertIntoPilotsRacesTournaments = "INSERT INTO piloticurseturnee (ID_Pilot, ID_Cursa, ID_Turneu) VALUES ($pilotID, $raceID, $tournamentID);";
							
								$run_insertIntoPilotsRacesTournaments = mysqli_query($db, $insertIntoPilotsRacesTournaments);
							}
						}
					}
				?>
			</form>
			<h2 id="title">Adaugare turneu</h2>
			<form class="form-horizontal", action="tournaments-panel" method="POST">
				<div class="form-group">
					<label class="col-sm-2 control-label" for="tournament-name">Denumire:</label>
					<div class="col-sm-9">
						<input type="text" name="tournament-name">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="tournament-year">An:</label>
					<div class="col-sm-9">
						<input type="number" name="tournament-year">
					</div>
				</div>
				<button type="submit" class="btn btn-block btn-lg btn-primary" name="submit-add-new-tournament">Adauga turneu</button>

				<?php
					if(isset($_POST['submit-add-new-tournament'])){
						$tournamentName = $_POST['tournament-name'];
						$tournamentYear = $_POST['tournament-year'];

						if(!empty($tournamentName) && !empty($tournamentYear)){
							//Query to insert a new tournament
							$insertNewTournament = "INSERT INTO turnee (denumire, an, status) VALUES ('$tournamentName', $tournamentYear, 'Deschis');";
							//Executing Query
							$run_insertNewTournament = mysqli_query($db, $insertNewTournament);
						}

						//Refreshing so I can see the update
    					echo '<meta http-equiv="refresh" content="0">';
					}
				?>
			</form>
			<h2 id="title">Stergere turneu</h2>
			<form class="form-horizontal" action="tournaments-panel.php" method="POST">
				<div class="form-group">
					<label class="col-sm-2 control-label" for="delete-tournament-selection">Turneu:</label>
					<div class="col-sm-9">
						<?php
							echo "<select name='delete-tournament-selection' class='form-control'>";

							$selectAllTournaments = "SELECT ID_Turneu, denumire FROM turnee;";

							$run_selectAllTournaments = mysqli_query($db, $selectAllTournaments);

							while($row = mysqli_fetch_assoc($run_selectAllTournaments)){
								$tournamentID = $row['ID_Turneu'];
								$tournamentName = $row['denumire'];

								echo "<option name='$tournamentName' value='$tournamentID'>$tournamentName</option>";
							}

							echo "</select>"
						?>
					</div>
				</div>
				<button type="submit" class="btn btn-lg btn-block btn-danger" name="submit-delete-tournament">Sterge turneu</button>
				<?php
					if(isset($_POST['submit-delete-tournament'])){
						$tournamentID = $_POST['delete-tournament-selection'];

						//Query to delete a tournament
						$deleteTournament = "DELETE FROM turnee WHERE ID_Turneu = $tournamentID;";
						//Executing query
						$run_deleteTournament = mysqli_query($db, $deleteTournament);

						//Refreshing so I can see the update
    					echo '<meta http-equiv="refresh" content="0">';
					}
				?>
			</form>
			<h2 id="title">Modificare turneu</h2>
			<form class="form-horizontal" action="tournaments-panel.php" method="POST">
				<div class="form-group">
					<label for="modify-tournament-selection" class="col-sm-2 control-label">Denumire actuala:</label>
					<div class="col-sm-9">
						<?php
							echo "<select name='modify-tournament-selection' class='form-control'>";

							$selectAllTournaments = "SELECT ID_Turneu, denumire FROM turnee;";

							$run_selectAllTournaments = mysqli_query($db, $selectAllTournaments);

							while($row = mysqli_fetch_assoc($run_selectAllTournaments)){
								$tournamentID = $row['ID_Turneu'];
								$tournamentName = $row['denumire'];

								echo "<option name='$tournamentName' value='$tournamentID'>$tournamentName</option>";
							}

							echo "</select>"
						?>
					</div>
					<label for="new-name-tournament" class="col-sm-2 control-label">Denumire noua:</label>
					<div class="col-sm-9">
						<input type="text" name="new-name-tournament">
					</div>
				</div>
				<div class="form-group">
					<label for="tournament-year" class="col-sm-2 control-label">An nou:</label>
					<div class="col-sm-9">
						<input type="number" name="tournament-year">
					</div>
				</div>
				<button class="btn btn-lg btn-block btn-info" type="submit" name="submit-modify-tournament">Modifica turneu</button>
				<?php 
					if(isset($_POST['submit-modify-tournament'])){
						$tournamentID = $_POST['modify-tournament-selection'];
						$tournamentNewName = $_POST['new-name-tournament'];
						$tournamentYear = $_POST['tournament-year'];

						if(!empty($tournamentYear) && !empty($tournamentNewName)){
							//Modify Query
							$updateTournament = "UPDATE turnee SET denumire = '$tournamentNewName', an = $tournamentYear WHERE ID_Turneu = $tournamentID;";
							//Executing Query
							$run_updateTournament = mysqli_query($db, $updateTournament);
						}

						//Refreshing so I can see the update
    					echo '<meta http-equiv="refresh" content="0">'; 
					}
				?>
			</form>
	</div>
	
<?php include('html-footer.php') ?>
