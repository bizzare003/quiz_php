<?php
	require_once(__DIR__ . '/../config/config.php');
	$quiz = new \MyApp\Index();
	try {
		$correctAnswer = $quiz->checkedSets();
		header('Content-Type: application/json; charset=UTF-8');
		echo json_encode([
			'correctAnswer' => $correctAnswer
		]);
	} catch(Exception $e) {
		header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden', true, 403);
		echo $e->getMessage();
		exit;
	}
