<?php include('html-header.php') ?>

	<div class="header">
		<h2 id="torunament-panel-title">Panou curse</h2>
	</div>

	<div class="main-panel">
			<h2 id="title">Adaugare cursa</h2>
			<form class="form-horizontal", action="races-panel.php" method="POST">
				<div class="form-group">
					<label class="col-sm-2 control-label" for="race-location">Locatie:</label>
					<div class="col-sm-9">
						<input type="text" name="race-location">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="race-laps">Numar ture:</label>
					<div class="col-sm-9">
						<input type="number" name="race-laps">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="race-length">Lungime:</label>
					<div class="col-sm-9">
						<input type="number" step="0.01" name="race-length">
					</div>
				</div>
				<button type="submit" class="btn btn-block btn-lg btn-primary" name="submit-add-new-race">Adauga cursa</button>

				<?php
					if(isset($_POST['submit-add-new-race'])){
						$raceLocation= $_POST['race-location'];
						$raceLaps = $_POST['race-laps'];
						$raceLength = $_POST['race-length'];

						if(!empty($raceLocation) && !empty($raceLaps) && !empty($raceLength)){
							//Query to insert a new tournament
							$insertNewRace = "INSERT INTO curse (locatie, numar_ture, lungime) VALUES ('$raceLocation', $raceLaps, $raceLength);";
							//Executing Query
							$run_insertNewRace = mysqli_query($db, $insertNewRace);
						}

						//Refreshing so I can see the update
    					echo '<meta http-equiv="refresh" content="0">';
					}
				?>
			</form>
			<h2 id="title">Stergere cursa</h2>
			<form class="form-horizontal", action="races-panel.php" method="POST">
				<div class="form-group">
					<label class="col-sm-2 control-label" for="delete-race-selection">Cursa:</label>
					<div class="col-sm-9">
						<?php
							echo "<select name='delete-race-selection' class='form-control'>";

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
				<button type="submit" class="btn btn-lg btn-block btn-danger" name="submit-delete-race">Sterge cursa</button>
				<?php
					if(isset($_POST['submit-delete-race'])){
						$raceID = $_POST['delete-race-selection'];

						//Query to delete a tournament
						$deleteRace = "DELETE FROM curse WHERE ID_Cursa = $raceID;";
						//Executing query
						$run_deleteRace = mysqli_query($db, $deleteRace);

						//Refreshing so I can see the update
						echo '<meta http-equiv="refresh" content="0">';
					}
				?>
			</form>
			<h2 id="title">Modificare cursa</h2>
			<form class="form-horizontal", action="races-panel.php" method="POST">
				<div class="form-group">
					<label for="modify-race-selection" class="col-sm-2 control-label">Locatie actuala:</label>
					<div class="col-sm-9">
						<?php
							echo "<select name='modify-race-selection' class='form-control'>";

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
					<label for="new-location-race" class="col-sm-2 control-label">Locatie noua:</label>
					<div class="col-sm-9">
						<input type="text" name="new-location-race">
					</div>
				</div>
				<div class="form-group">
					<label for="new-race-laps" class="col-sm-2 control-label">Numar de ture nou:</label>
					<div class="col-sm-9">
						<input type="number" name="new-race-laps">
					</div>
				</div>
				<div class="form-group">
					<label for="new-race-length" class="col-sm-2 control-label">Lungime noua:</label>
					<div class="col-sm-9">
						<input type="number" step="0.01" name="new-race-length">
					</div>
				</div>
				<button class="btn btn-lg btn-block btn-info" type="submit" name="submit-modify-race">Modifica cursa</button>
				<?php 
					if(isset($_POST['submit-modify-race'])){
						$raceID = $_POST['modify-race-selection'];
						$raceNewLocation = $_POST['new-location-race'];
						$raceNewLaps = $_POST['new-race-laps'];
						$raceNewLength = $_POST['new-race-length'];

						if(!empty($raceNewLocation) && !empty($raceNewLaps) && !empty($raceNewLength)){
							//Modify Query
							$updateRace = "UPDATE curse SET locatie = '$raceNewLocation', numar_ture = $raceNewLaps, lungime = $raceNewLength WHERE ID_Cursa = $raceID;";
							//Executing Query
							$run_updateRace = mysqli_query($db, $updateRace);
						} 

						//Refreshing so I can see the update
    					echo '<meta http-equiv="refresh" content="0">';
					}
				?>
			</form>
	</div>

<?php include('html-footer.php') ?>