@extends('layout')
@section('title','Quiz Page')
@section('content')
<div class="container">
    <h1>Quiz</h1>
    <div id="quiz">
        <form id="quiz-form">
            @foreach ($quizData as $index => $question)
            <div class="question" id="question-{{ $index }}" style="display: {{ $index === 0 ? 'block' : 'none' }}">
                <h2>Question {{ $index + 1 }}</h2>
                <p>{{ $question['question'] }}</p>
                <ul class="list-group">
                    @foreach ($question['answers'] as $answer)
                    <li class="list-group-item">
                        <label>
                            <input type="radio" name="answers[{{ $index }}]" value="{{ $answer }}">{{ $answer }}
                        </label>
                    </li>
                    @endforeach
                </ul>
                <div class="feedback"></div>
            </div>
            @endforeach
            <button class="btn btn-primary" id="submit-button">Submit</button>
        </form>
    </div>
</div>

<script>
    const quizForm = document.getElementById('quiz-form');
    const questions = document.querySelectorAll('.question');
    const submitButton = document.getElementById('submit-button');

    let currentQuestion = 0;

    quizForm.addEventListener('submit', function (event) {
        event.preventDefault();
        const selectedAnswer = document.querySelector(`input[name="answers[${currentQuestion}]"]:checked`);
        if (selectedAnswer) {
            const feedback = document.querySelector(`#question-${currentQuestion} .feedback`);
            const correctAnswer = '{{ $quizData[currentQuestion]["answers"][0] }}';
            if (selectedAnswer.value === correctAnswer) {
                feedback.innerHTML = '<div class="alert alert-success">Correct!</div>';
            } else {
                feedback.innerHTML = '<div class="alert alert-danger">Wrong. Try again.</div>';
            }
            currentQuestion++;
            if (currentQuestion < questions.length) {
                questions[currentQuestion - 1].style.display = 'none';
                questions[currentQuestion].style.display = 'block';
            } else {
                quizForm.innerHTML = '<div class="alert alert-success">Quiz completed! You\'ve answered all questions.</div>';
            }
        }
    });

    submitButton.addEventListener('click', function () {
        if (currentQuestion === 0) {
            questions[currentQuestion].style.display = 'block';
        }
    });
</script>
@endsection