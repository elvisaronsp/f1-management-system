<?php include('html-header.php') ?>

	<div class="header">
		<h2 id="torunament-panel-title">Panou piloti</h2>
	</div>

	<div class="main-panel">
			<h2 id="title">Adaugare pilot</h2>
			<form class="form-horizontal", action="pilots-panel.php" method="POST">
				<div class="form-group">
					<label class="col-sm-2 control-label" for="pilot-name">Nume:</label>
					<div class="col-sm-9">
						<input type="text" name="pilot-name">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="team-selection">Echipa:</label>
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
				<button type="submit" class="btn btn-block btn-lg btn-primary" name="submit-add-new-pilot">Adauga pilot</button>

				<?php
					if(isset($_POST['submit-add-new-pilot'])){
						$teamID = $_POST['team-selection'];
						$pilotName = $_POST['pilot-name'];

						if(!empty($pilotName)){
							//Query to insert a new tournament
							$insertNewPilot = "INSERT INTO piloti (nume, ID_Echipa) VALUES ('$pilotName', $teamID);";
							//Executing Query
							$run_insertNewPilot = mysqli_query($db, $insertNewPilot);
						}

						//Refreshing so I can see the update
    					echo '<meta http-equiv="refresh" content="0">';
					}
				?>
			</form>
			<h2 id="title">Stergere pilot</h2>
			<form class="form-horizontal", action="pilots-panel.php" method="POST">
				<div class="form-group">
					<label class="col-sm-2 control-label" for="delete-pilot-selection">Pilot:</label>
					<div class="col-sm-9">
						<?php
							echo "<select name='delete-pilot-selection' class='form-control'>";

							$selectAllPilots = "SELECT ID_Pilot, nume FROM piloti;";

							$run_selectAllPilots = mysqli_query($db, $selectAllPilots);

							while($row = mysqli_fetch_assoc($run_selectAllPilots)){
								$pilotID = $row['ID_Pilot'];
								$pilotName = $row['nume'];

								echo "<option name='$pilotName' value='$pilotID'>$pilotName</option>";
							}

							echo "</select>"
						?>
					</div>
				</div>
				<button type="submit" class="btn btn-lg btn-block btn-danger" name="submit-delete-pilot">Sterge pilot</button>
				<?php
					if(isset($_POST['submit-delete-pilot'])){
						$pilotID = $_POST['delete-pilot-selection'];

						//Query to delete a tournament
						$deletePilot = "DELETE FROM piloti WHERE ID_Pilot = $pilotID;";
						//Executing query
						$run_deletePilot = mysqli_query($db, $deletePilot);

						//Refreshing so I can see the update
						echo '<meta http-equiv="refresh" content="0">';
					}
				?>
			</form>
			<h2 id="title">Modificare pilot</h2>
			<form class="form-horizontal", action="pilots-panel.php" method="POST">
				<div class="form-group">
					<label for="modify-pilot-selection" class="col-sm-2 control-label">Nume actual:</label>
					<div class="col-sm-9">
						<?php
							echo "<select name='modify-pilot-selection' class='form-control'>";

							$selectAllPilots = "SELECT ID_Pilot, nume FROM piloti;";

							$run_selectAllPilots = mysqli_query($db, $selectAllPilots);

							while($row = mysqli_fetch_assoc($run_selectAllPilots)){
								$pilotID = $row['ID_Pilot'];
								$pilotName = $row['nume'];

								echo "<option name='$pilotName' value='$pilotID'>$pilotName</option>";
							}

							echo "</select>"
						?>
					</div>
					<label for="new-name-pilot" class="col-sm-2 control-label">Nume nou:</label>
					<div class="col-sm-9">
						<input type="text" name="new-name-pilot">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="new-team-selection">Echipa:</label>
					<div class="col-sm-9">
						<?php
							echo "<select name='new-team-selection' class='form-control'>";

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
				<button class="btn btn-lg btn-block btn-info" type="submit" name="submit-modify-pilot">Modifica pilot</button>
				<?php 
					if(isset($_POST['submit-modify-pilot'])){
						$pilotID = $_POST['modify-pilot-selection'];
						$newTeamID = $_POST['new-team-selection'];
						$pilotName = $_POST['new-name-pilot'];

						if(!empty($pilotName)){
							//Modify Query
							$updatePilot = "UPDATE piloti SET nume = '$pilotName', ID_Echipa = $newTeamID WHERE ID_Pilot = $pilotID;";
							//Executing Query
							$run_updatePilot = mysqli_query($db, $updatePilot);
						} 

						//Refreshing so I can see the update
    					echo '<meta http-equiv="refresh" content="0">';
					}
				?>
			</form>
	</div>

<?php include('html-footer.php') ?>