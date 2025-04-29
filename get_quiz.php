<?php
header('Content-Type: application/json');
$conn = new mysqli("localhost", "root", "", "hanawebsite");

$event_id = intval($_GET['event_id']);

// Find the quiz
$quiz_result = $conn->query("SELECT quiz_id FROM quizzes WHERE event_id = $event_id");
$quiz = $quiz_result->fetch_assoc();

if (!$quiz) {
    echo json_encode([]);
    exit;
}

$quiz_id = $quiz['quiz_id'];

// Get all questions for this quiz
$questions_result = $conn->query("SELECT * FROM questions WHERE quiz_id = $quiz_id");
$quiz_data = [];

while ($q = $questions_result->fetch_assoc()) {
    $question_id = $q['question_id'];

    // Fetch all answers for this question
    $answers_result = $conn->query("SELECT * FROM answers WHERE question_id = $question_id");

    $answers = [];
    $correct_label = null;

    while ($a = $answers_result->fetch_assoc()) {
        $answers[] = [
            'label' => $a['answer_label'],
            'text' => $a['answer_text']
        ];

        // For now, assume the first answer (label 'd' or manually set) is correct
        if ($a['is_correct'] ?? 0) {
            $correct_label = $a['answer_label'];
        }
    }

    $quiz_data[] = [
        'question' => $q['question_text'],
        'answers' => $answers,
        'correct_label' => $correct_label
    ];
}

echo json_encode($quiz_data);
?>
