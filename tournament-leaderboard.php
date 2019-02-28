<?php include('html-header.php') ?>

	<div class="header">
		<h2 id="tournament-statistics-title">Clasament turneu</h2>
	</div>
	<div class="main-panel">
		<h3>Clasament:</h3>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Pilot</th>
						<th>Echipa</th>
						<th>Puncte</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$tournamentID = $_GET['tournamentID'];

					$pointsArray = array();
					$noOfPilots = 0;
					$selectPilots = "SELECT ID_Pilot, COUNT(ID_Pilot) as NoOfPilots FROM piloticurseturnee WHERE ID_Turneu = $tournamentID GROUP by ID_Pilot";

					$run_selectPilots = mysqli_query($db, $selectPilots);
					while($row = mysqli_fetch_assoc($run_selectPilots)){
						$pointsArray[$row['ID_Pilot']] = 0;
						$noOfPilots = $row['NoOfPilots'];
					}

					$selectRacesId = "SELECT ID_Cursa FROM piloticurseturnee WHERE ID_Turneu = $tournamentID GROUP BY ID_Cursa";

					$run_selectRacesId = mysqli_query($db, $selectRacesId);

					while($row = mysqli_fetch_assoc($run_selectRacesId)){
						$selectPilotsAsc = "SELECT ID_Pilot, timp FROM piloticurseturnee WHERE ID_Turneu = $tournamentID AND ID_Cursa = ".$row['ID_Cursa']." AND timp IS NOT NULL GROUP BY timp ORDER BY timp ASC;";
						$run_selectPilotsAsc = mysqli_query($db, $selectPilotsAsc);
						$counter = $noOfPilots;
						while($pilotRow = mysqli_fetch_assoc($run_selectPilotsAsc)){
							$pointsArray[$pilotRow['ID_Pilot']] += 10 * $counter--;
						}
					}

					$selectPilotsId = "SELECT piloti.ID_Pilot as ID_Pilot, piloti.Nume as Pilot_Nume, echipe.nume as Echipa_Nume FROM piloti JOIN echipe ON piloti.ID_Echipa = echipe.ID_Echipa WHERE piloti.ID_Pilot IN (SELECT ID_Pilot FROM piloticurseturnee WHERE ID_Turneu = $tournamentID GROUP BY ID_Pilot);";
					$run_selectPilotsId = mysqli_query($db, $selectPilotsId);

					while($row = mysqli_fetch_assoc($run_selectPilotsId)){
						$pilotName = $row['Pilot_Nume'];
						$teamName = $row['Echipa_Nume'];
						$pilotId = $row['ID_Pilot'];

						echo "<tr>
								 <td>$pilotName</td>
								 <td>$teamName</td>
								 <td>$pointsArray[$pilotId]</td>
							 </tr>";
					}
				?>
				</tbody>
			</table>
		</div>

<?php include('html-footer.php') ?>
