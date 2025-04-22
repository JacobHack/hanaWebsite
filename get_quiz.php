<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "hanawebsite");

if ($conn->connect_error) {
    die(json_encode(["error" => $conn->connect_error]));
}

$event_id = isset($_GET['event_id']) ? intval($_GET['event_id']) : 0;

$sql = "
    SELECT q.question_id, q.question_text, a.answer_label, a.answer_text
    FROM quizzes z
    JOIN questions q ON z.quiz_id = q.quiz_id
    LEFT JOIN answers a ON q.question_id = a.question_id
    WHERE z.event_id = $event_id
    ORDER BY q.question_id, a.answer_label
";

$result = $conn->query($sql);
$quiz = [];

while ($row = $result->fetch_assoc()) {
    $qid = $row['question_id'];
    if (!isset($quiz[$qid])) {
        $quiz[$qid] = [
            "question" => $row['question_text'],
            "answers" => []
        ];
    }
    if ($row['answer_label']) {
        $quiz[$qid]["answers"][] = [
            "label" => $row['answer_label'],
            "text" => $row['answer_text']
        ];
    }
}

echo json_encode(array_values($quiz));
$conn->close();
?>
