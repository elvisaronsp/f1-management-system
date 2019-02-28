<?php include('html-header.php') ?>

	<div class="header">
		<h2 id="modify-tournament-race-title">Adaugare rezultate</h2>
	</div>
	<div class="main-panel">
		<form class="form-horizontal" action="" method="POST">
			<div class="form-grou">
				<label class="control-label col-sm-2" for="race-selection">Cursa:</label>
				<div class="col-sm-9">
					<?php
							$tournamentID = $_GET['tournamentID'];

							echo "<select name='race-selection' class='form-control'>";

							$selectAllRaces = "SELECT curse.ID_Cursa as ID_Cursa, curse.locatie as locatie FROM curse JOIN (SELECT ID_Cursa FROM piloticurseturnee WHERE ID_Turneu = $tournamentID and timp is NULL) b ON curse.ID_Cursa = b.ID_Cursa GROUP BY ID_Cursa;";

							$run_selectAllRaces = mysqli_query($db, $selectAllRaces);
							
							if(!mysqli_num_rows($run_selectAllRaces)){
								$updateTournamentStatus = "UPDATE turnee SET status = 'Inchis' WHERE ID_Turneu =$tournamentID";
								$run_updateTournamentStatus = mysqli_query($db, $updateTournamentStatus);
								header('location: index.php');
							}
							else{
								while($row = mysqli_fetch_assoc($run_selectAllRaces)){
									$raceID = $row['ID_Cursa'];
									$raceLocation = $row['locatie'];

									echo "<option name='$raceLocation' value='$raceID'>$raceLocation</option>";
								}

								echo "</select>";
							}

							
						?>
				</div>
			</div>
			<div class="form-group">
				<div class="table-responsive col-sm-12">
					<table class="table table-striped" >
						<thead>
							<tr>
								<th>Pilot</th>
								<th>Timp</th>
							</tr>
						</thead>
						<?php 
							$tournamentID = $_GET['tournamentID'];
							$counter = 0;

							$selectAllPilotsFromPilotsRacesTournaments = "SELECT piloti.nume as NumePilot, b.timp as Timp, piloti.ID_Pilot as PilotID FROM piloti JOIN (SELECT ID_Pilot, timp FROM piloticurseturnee WHERE ID_Turneu = $tournamentID) b ON piloti.ID_Pilot = b.ID_Pilot GROUP BY PilotID;";

							$run_selectAllPilotsFromPilotsRacesTournaments = mysqli_query($db, $selectAllPilotsFromPilotsRacesTournaments);
							while($row = mysqli_fetch_assoc($run_selectAllPilotsFromPilotsRacesTournaments)){
								$pilotName = $row['NumePilot'];
								$pilotTime = $row['Timp'];
								$pilotID = $row['PilotID'];

								echo "<tr>
										<td><input type='hidden' value='$pilotID' name='pilots[]'>$pilotName</td>
										<td><input type='number' step='0.01' name='time[]'></td>
									 </tr>";

								$counter++;
							}
						?>
					</table>
				</div>
			</div>
			<button class="btn btn-lg btn-block" type="submit" name="submit-new-tournament-result">Submit</button>
			<?php 
				if(isset($_POST['submit-new-tournament-result'])){	
					$pilotIDs = array();
					$counter = 0;
					foreach($_POST['pilots'] as $pilot){
						$pilotIDs[$counter++] = $pilot;
					}

					$pilotTimes = array();
					$counter = 0;
					foreach($_POST['time'] as $time){
						$pilotTimes[$counter++] = $time;
					}

					for($i = 0; $i < $counter; $i++){
						$updatePilotTime = "UPDATE piloticurseturnee SET timp = $pilotTimes[$i] WHERE ID_Pilot = $pilotIDs[$i] AND ID_Cursa = ".$_POST['race-selection']." AND ID_Turneu = ".$_GET['tournamentID'].";";
						echo "<script> console.log('$updatePilotTime');</script>";
						$run_updatePilotTime = mysqli_query($db, $updatePilotTime);
					}
					
				//Refreshing so I can see the update
				echo '<meta http-equiv="refresh" content="0">';
				}

			?>
		</form>
	</div>

<?php include('html-footer.php') ?>
