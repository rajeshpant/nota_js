<?php
require_once('config.php');
$method = $_SERVER['REQUEST_METHOD'];
if($method == 'POST'){
	$date = date('Y-m-d H:i:s');
	$name = $_POST['name'];
	$stmt = $conn->prepare('INSERT INTO users (name, update_time) VALUES (?, ?)');
	$stmt->bind_param("ss", $name, $date);
	$stmt->execute();
	echo json_encode(['id' => $conn->insert_id, 'update' =>  $date, 'msg' => 'Successfully added']); die;
} else if($method == 'PUT'){
	parse_str(file_get_contents('php://input'), $_PUT);
	$date = date('Y-m-d H:i:s');
	$id = $_PUT['id'];
	$name = $_PUT['name'];
	$stmt = $conn->prepare('UPDATE users SET name = ?, update_time = ? WHERE id = ?');
	$stmt->bind_param("ssi", $name, $date, $id);
	$stmt->execute();
	echo json_encode(['id' => $id, 'update' =>  $date, 'msg' => 'Successfully Updated']); die;
} else if($method == 'DELETE'){
	parse_str(file_get_contents('php://input'), $_DELETE);
	$id = $_DELETE['id'];
	$stmt = $conn->prepare('DELETE FROM users  WHERE id = ?');
	$stmt->bind_param("i", $id);
	$stmt->execute();
	echo json_encode(['id' => $conn->insert_id, 'msg' => 'Successfully Deleted']); die;
} else {
	$result = $conn->query('SELECT * FROM users');
	echo json_encode(['result' => $result->fetch_all(MYSQLI_ASSOC),  'msg' => 'Users List']); die;
} 