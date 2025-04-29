
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>The 1960s</title>
  <link rel="stylesheet" href="/hanawebsite/home.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  <nav class="navbar sticky-top">
    <ul class="nav-list">
        <li><a href= "../login/login_register_modal.html">Logout</a></li>
        <li><a href="../home.php">Timeline</a></li>
        <li><a href="/hanaWebsite/definitions.php">Definitions</a></li>
        <li><a href="/hanaWebsite/matching_game.php">Matching Game</a></li>
        <?php
                session_start();
                if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                    echo '<li><a href="/hanawebsite/login/dashboard.php">Admin Dashboard</a></li>';
                }
            ?>
    </ul>
  </nav>

  <div class="container mt-4">
    <div class="main-timeline" id="timeline-container">
      <!-- Events will load here -->
    </div>
  </div>

  <!-- Quiz Modal -->
  <div class="modal fade" id="quizModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Quiz</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="quiz-content">
          <!-- Quiz content appears here -->
        </div>
      </div>
    </div>
  </div>

  <script>
  document.addEventListener("DOMContentLoaded", () => {
    fetch("http://localhost/hanawebsite/get_events.php?decade=1960s")
      .then(res => res.json())
      .then(data => {
        const container = document.getElementById("timeline-container");
        data.forEach(event => {
          const html = `
            <div class="timeline">
              <div class="icon"></div>
              <div class="date-content">
                <div class="date-outer">
                  <span class="date">
                    <span class="year">${event.year}</span>
                    <span class="month">
                      <button class="btn btn-sm btn-outline-primary" onclick="showQuiz(${event.id})">View Quiz</button>
                    </span>
                  </span>
                </div>
              </div>
              <div class="timeline-content">
                <h5 class="title">${event.title}</h5>
                <p class="description">${event.description}</p>
              </div>
            </div>`;
          container.innerHTML += html;
        });
      })
      .catch(err => console.error("Failed to load events:", err));
  });

  function showQuiz(eventId) {
  fetch(`http://localhost/hanawebsite/get_quiz.php?event_id=${eventId}`)
    .then(res => {
      if (!res.ok) throw new Error("HTTP error! status: " + res.status);
      return res.json();
    })
    .then(quiz => {
      let html = '<form id="quiz-form">';
      const answerKey = {};

      quiz.forEach((q, index) => {
        const qid = `q${index}`;
        html += `<div class="mb-4"><strong>Q${index + 1}: ${q.question}</strong><br>`;

        if (q.answers.length > 0) {
          q.answers.forEach(ans => {
            html += `
              <div class="form-check">
                <input class="form-check-input" type="radio" name="${qid}" id="${qid}_${ans.label}" value="${ans.label}">
                <label class="form-check-label" for="${qid}_${ans.label}">
                  ${ans.label}. ${ans.text}
                </label>
              </div>`;
          });
        } else {
          html += `<input type="text" name="${qid}" class="form-control" placeholder="Your answer">`;
        }

        html += "</div>";

        // Store correct answer (assuming you can fetch it later dynamically)
        answerKey[qid] = q.correct_label; // you need correct_label returned from backend
      });

      html += '<button type="submit" class="btn btn-primary">Submit Quiz</button>';
      html += '</form>';
      html += '<div id="quiz-results" class="mt-4"></div>';

      document.getElementById("quiz-content").innerHTML = html;

      // Now handle form submission
      document.getElementById("quiz-form").addEventListener("submit", function(e) {
        e.preventDefault();

        let score = 0;
        let total = Object.keys(answerKey).length;

        for (let qid in answerKey) {
          const selected = document.querySelector(`input[name="${qid}"]:checked`);
          if (selected && selected.value === answerKey[qid]) {
            score++;
          }
        }

        document.getElementById("quiz-results").innerHTML = `<h5>You scored ${score} out of ${total}</h5>`;
      });

      const modal = new bootstrap.Modal(document.getElementById("quizModal"));
      modal.show();
    })
    .catch(err => {
      console.error("Quiz fetch error:", err);
      document.getElementById("quiz-content").innerHTML = "<em>Failed to load quiz.</em>";
      const modal = new bootstrap.Modal(document.getElementById("quizModal"));
      modal.show();
    });
}
  </script>
</body>
</html>
