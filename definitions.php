<?php
$con = new mysqli("localhost", "root", "", "hanawebsite");

function generateDefs($table, $con, $rowId, $rowName, $rowValue){
    $sql = "SELECT * FROM `$table`";
    $result = $con->query($sql);

    if (!$result) {
        echo "<p>Error fetching data: " . $con->error . "</p>";
        return;
    }

    while ($row = $result->fetch_assoc()) {
        $id = htmlspecialchars($row[$rowId]);
        $name = htmlspecialchars($row[$rowName]);
        $value = htmlspecialchars($row[$rowValue]);

        echo '<div class="card">';
        echo '  <div class="card-header" id="heading'.$id.'">';
        echo '    <h2 class="mb-0">';
        echo '      <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse'.$id.'" aria-expanded="false" aria-controls="collapse'.$id.'">';
        echo            $name;
        echo '      </button>';
        echo '    </h2>';
        echo '  </div>';
        echo '  <div id="collapse'.$id.'" class="collapse" aria-labelledby="heading'.$id.'" data-parent="#definitionsAccordion">';
        echo '    <div class="card-body">';
        echo        $value;
        echo '    </div>';
        echo '  </div>';
        echo '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Definitions</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar">
        <ul class="nav-list">
            <li><a href="./login/login_register_modal.html">Logout</a></li>
            <li><a href="lhome.html">Timeline</a></li>
            <li><a href="#about">Context</a></li>
            <li><a href="definitions.php">Definitions</a></li>
            <li><a href="#contact">Other</a></li>
        </ul>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Definitions</h1>
        <div id="definitionsAccordion" class="accordion">
            <?php generateDefs("definitions", $con, "id", "term", "definition"); ?>
        </div>  
    </div>
</body>
</html>
