<?php include('html-header.php');

	 ?>

	<div class="header">
		<h2 id="torunament-status-title">Status turnee</h2>
	</div>
	
	<div class="main-body">
			<div class="table-responsive container">
				<table class="table table-striped" id="status-turnee-tabel">
					<tr>
						<th>Turneu</th>
						<th>Nr. Piloti</th>
						<th>Nr. Curse</th>
						<th>Status</th>
						<th>Adauga rezultate</th>
						<th>Clasament</th>
					</tr>
					<?php
						//SELECT details from DB
						$selectNumberOfPilotsTournaments = "SELECT COUNT(A.ID_Pilot) as NoOfPilots, A.ID_Turneu as TournamentID FROM (SELECT ID_Pilot, ID_Turneu from piloticurseturnee GROUP by ID_Pilot, ID_Turneu) A GROUP by ID_Turneu ORDER BY ID_Turneu ASC;";
						
						$NoOfPilots = array();
						$Tournament = array();

						$counter = 0;

						$run_selectNumberOfPilotsTournaments = mysqli_query($db, $selectNumberOfPilotsTournaments);
						while ($row = mysqli_fetch_assoc($run_selectNumberOfPilotsTournaments)) {
							$NoOfPilots[$counter] = $row['NoOfPilots'];
							$Tournament[$counter] = $row['TournamentID'];
							$counter++;
						}

						$selectNumberOfRacesTournaments = "SELECT COUNT(A.ID_Cursa) as NoOfRaces, A.ID_Turneu as TournamentID FROM (SELECT ID_Cursa, ID_Turneu from piloticurseturnee GROUP by ID_Cursa, ID_Turneu) A GROUP by ID_Turneu ORDER BY ID_Turneu ASC;";

						$NoOfRaces = array();
						$counter = 0;
						
						$run_selectNumberOfRacesTournaments = mysqli_query($db, $selectNumberOfRacesTournaments);
						while ($row = mysqli_fetch_assoc($run_selectNumberOfRacesTournaments)) {
							
							$NoOfRaces[$counter++] = $row['NoOfRaces'];
						}

						for($i = 0; $i < $counter; $i++) {
							$selectTournamentsById = "SELECT denumire, status FROM turnee WHERE ID_Turneu = $Tournament[$i];";
							$run_selectTournamentsById = mysqli_query($db, $selectTournamentsById);
							while ($row = mysqli_fetch_assoc($run_selectTournamentsById)) {
								$tournamentName = $row['denumire'];
								$tournamentStatus = $row['status'];

								echo "<tr>
										<td>$tournamentName</td>
										<td>$NoOfPilots[$i]</td>
										<td>$NoOfRaces[$i]</td>
										<td>$tournamentStatus</td>
										<td><a href='modify-tournament-results.php?tournamentID=$Tournament[$i]'><button class='btn btn-sm'>Adauga</button></a></td>
										<td><a href='tournament-leaderboard.php?tournamentID=$Tournament[$i]'><button class='btn btn-sm'>Clasament</button></a></td>
									 </tr>";
							}

						}
					?>
				</table>
			</div>
	</div>
<?php include('html-footer.php') ?>