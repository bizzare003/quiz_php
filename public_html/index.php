<?php
	require_once(__DIR__ . '/../config/config.php');
	$quiz = new \MyApp\Index();
	if(!$quiz->isFinished()) {
		$data = $quiz->getData();
		$btnValue = $_SESSION['current'] === 2 ? 'Show Result' : 'Next Question';
	}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>Quiz</title>
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<?php 
		if($quiz->isFinished()):
		$score = $quiz->getScore();
		$quiz->reset();
	?>
	<div id="container">
		<div id="result">
			Your score ...
			<div><?= h($score);?> %</div>
		</div>
		<a href=""><div id="btn">Replay?</div></a>
	</div>
	<?php else:?>
	<div id="container">
		<h1>Q. <?= h($data['q']);?></h1>
		<ul>
			<?php 
				foreach($data['a'] as $a) {
					echo '<li class="answer">'. h($a). '</li>';
				}
			?>
		</ul>
		<div id="btn" class="disabled"><?= h($btnValue);?></div>
		<input type="hidden" id="token" value="<?= h($_SESSION['token']); ?>">
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="./js/quiz.js"></script>
	<?php endif;?>
</body>
</html>