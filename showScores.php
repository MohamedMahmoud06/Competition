<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Scores</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>User Scores</h2>
    <?php
    include 'config.php';

    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT games.name AS game_name, data.score 
                FROM games 
                INNER JOIN data ON games.ID = data.game_id 
                WHERE data.user_id = '$id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<table class="table">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Game Name</th>';
            echo '<th>Score</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            while($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['game_name'] . '</td>';
                echo '<td>' . $row['score'] . '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>No scores found for this user.</p>';
        }
    } else {
        echo '<p>User ID not provided in the URL.</p>';
    }
    ?>
</div>
</body>
</html>
