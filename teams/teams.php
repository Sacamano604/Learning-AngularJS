<?php
$mysqli = mysqli_connect("localhost", "bentouss_testing", "b3ntoussi", "bentouss_testing");


switch($_GET["action"]){
	case "list":
		$query = "SELECT * FROM teamList";
		$result = $mysqli->query($query);
		while ($row = $result->fetch_assoc()) {
			$json[] = array('id' => $row['id'], 'name' => $row['name'], 'founded' => $row['founded'], 'city' => $row['city'], 'stadium' => $row['stadium'], 'capacity' => $row['capacity'], 'manager' => $row['manager'], 'websiteLink' => $row['websiteLink'], 'image' => $row['image'], 'details' => $row['details']);
		}
		echo json_encode($json);
		$mysqli->close();
	break;

	case "detail":
	 	$id = $_GET['id'];
	 	$stmt = $mysqli->stmt_init();
		$query = $mysqli->prepare('SELECT * FROM teamList WHERE id = ?');
		$query->bind_param('i', $id);
		$query->execute();
		$result = $query->get_result();
		while ($row = $result->fetch_assoc()){
		 	$json = array('id' => $row['id'], 'name' => $row['name'], 'founded' => $row['founded'], 'city' => $row['city'], 'stadium' => $row['stadium'], 'capacity' => $row['capacity'], 'manager' => $row['manager'], 'websiteLink' => $row['websiteLink'], 'image' => $row['image'], 'details' => $row['details']);
		 }
		 echo json_encode($json);
		 $query->close();
	break;

	case "add":
		$query = $mysqli->prepare('INSERT INTO teamList (name, founded, city, stadium, capacity, manager, websiteLink, image, details) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
		$query->bind_param('sssssssss', $_POST['name'], $_POST['founded'], $_POST['city'], $_POST['stadium'], $_POST['capacity'], $_POST['manager'], $_POST['websiteLink'], $_POST['image'], $_POST['details']);
		$query->execute();
		$query->close();
	break;

}