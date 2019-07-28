<?php 
namespace MyApp;

class Index {
	private $_quizSets = [];
	public function __construct() {
		$this->_setData();
		Token::create();
		if(!isset($_SESSION['current'])) {
			$this->iniSets();
		}
	}
	private function iniSets() {
		$_SESSION['current'] = 0;
		$_SESSION['correct'] = 0;
	}
	public function checkedSets() {
		Token::validate('token');
		$correctAnswer = $this->_quizSets[$_SESSION['current']]['a'][0];
		$_SESSION['current']++;
		if(!isset($_POST['answer'])) {
			throw new \Exception('answer not set!');
		}
		if($correctAnswer === $_POST['answer']) {
			$_SESSION['correct']++;
		}
		return $correctAnswer;
	}

	public function reset() {
		$this->iniSets();
	}
	public function isFinished() {
		return count($this->_quizSets) === $_SESSION['current'];
	}
	public function getScore() {
		return round($_SESSION['correct'] / count($this->_quizSets) * 100);
	}
	public function getData() {
		$data = $this->_quizSets[$_SESSION['current']];
		shuffle($data['a']);
		return $data;
	}
	private function _setData() {
		$this->_quizSets[] = [
			'q' => 'What is A?',
			'a' => ['A0', 'A1', 'A2', 'A3']
		];
		$this->_quizSets[] = [
			'q' => 'What is B?',
			'a' => ['B0', 'B1', 'B2', 'B3']
		];
		$this->_quizSets[] = [
			'q' => 'What is A?',
			'a' => ['C0', 'C1', 'C2', 'C3']
		];
	}
}