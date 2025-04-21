<?php
error_reporting(1);
include 'hanaWebsite-config.inc.php';
$con = connect_db();

function generateDefs($table, $con, $rowId, $rowName, $rowValue){
    $sql = "SELECT * FROM $table";
    $result = $con -> query($sql);
    while($rows = $result->fetch()){
    
        echo '<div class="card">';
        echo '  <div class="card-header" id="heading'.htmlspecialchars($rows[$rowId]).'">';
        echo '      <h2 class="mb-0">';
        //echo '      <button class="btn btn-link" type="button" data-toggle="collapse show" data-target="#collapse'.htmlspecialchars($rows[$rowId]).'" aria-expanded="true" aria-controls="collapse'.htmlspecialchars($rows[$rowId]).'">';
        echo '      <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse'.htmlspecialchars($rows[$rowId]).'" aria-expanded="true" aria-controls="collapse'.htmlspecialchars($rows[$rowId]).'">'; //copilot code
        echo            htmlspecialchars($rows[$rowName]);
        echo '      </button>';
        echo '      </h2>';
        echo '  </div>';
        //echo '  <div id="collapse'.htmlspecialchars($rows[$rowId]).'" class="collapse" aria-labelledby="heading'.htmlspecialchars($rows[$rowId]).'data-parent="#definitionsAccordion"">'; 
        echo '  <div id="collapse'.htmlspecialchars($rows[$rowId]).'" class="collapse" aria-labelledby="heading'.htmlspecialchars($rows[$rowId]).'" data-parent="#definitionsAccordion">'; //copilot code
        echo '      <div class="card-body">';
        echo            htmlspecialchars($rows[$rowValue]);
        echo '      </div>';
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
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <title>Definitions</title>
</head>
<body>
    <nav class="navbar">
        <ul class="nav-list">
            <li><a href= "localhost/hanaWebsite/login/login_register_modal.html">Logout</a></li>
            <li><a href="localhost/hanaWebsite/home.html">Timeline</a></li>
            <li><a href="#about">Context</a></li>
            <li><a href="localhost/hanaWebsite/definitions.php">Definitions</a></li>
            <li><a href="#contact">Other</a></li>
        </ul>
    </nav>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Definitions</h1>
        <div id="definitionsAccordion" class="accordion">
            <?php generateDefs("definitions", $con, "def_id","item","definition"); ?>
        </div>  
    </div>
</body>
</html>