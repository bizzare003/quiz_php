$(function() {
	$('.answer').on('click', function() {
		var $selected = $(this);
		if ($selected.hasClass('correct') || $selected.hasClass('wrong')) {return;}
		var answer = $selected.text();
		$.post('_answer.php', {
			answer: answer,
			token: $('#token').val()
		}).done(function(res) {
			// console.log(res.correctAnswer);
			$('.answer').each(function() {
				if ($(this).text() === res.correctAnswer) {
					$(this).addClass('correct');
				} else {
					$(this).addClass('wrong');0
				}
			});
			if (answer === res.correctAnswer) {
				$selected.text(answer + ' ...Correct!');
			} else {
				$selected.text(answer + ' ...Wrong!');
			}
		});
		$('#btn').removeClass('disabled');
	});
	$('#btn').on('click', function() {
		if ($(this).hasClass('disabled')) {return;}
		location.reload();
	});
});