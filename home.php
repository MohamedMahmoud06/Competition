<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php
include 'config.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM users WHERE ID='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo '<div class="container">';
        echo '<div class="row">';
        echo '<div class="col-md-4">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $row['name'] . '</h5>';
        
        echo '<h4>' . $row['kind'] . '</h4>';
        echo '<a class="btn btn-primary" href="showScores.php?id=' . $row['ID'] . '">Show Scores</a>';
        
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        $kind = $row['kind'];
        $sql1 = "SELECT * FROM games WHERE kind='$kind'";
        $result1 = $conn->query($sql1);

        if ($result1->num_rows > 0) {
            while ($row1 = $result1->fetch_assoc()) {
                echo '<div class="col-md-4">';
                echo '<div class="card">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row1['name'] . '</h5>';
                echo '<p class="card-text">' . $row1['description'] . '</p>';
                echo '<h4>' . $row1['kind'] . '</h4>';
                echo '<h4>' . $row1['number'] . '</h4>';
                echo '<form method="POST" action="">';
                echo '<input type="hidden" name="user_id" value="'. $row['ID'] .'">';
                echo '<input type="hidden" name="user_name" value="'. $row['name'] .'">';
                echo '<input type="hidden" name="game_id" value="'. $row1['ID'] .'">';
                echo '<input type="hidden" name="game_name" value="'. $row1['name'] .'">';
                echo '<button type="submit" name="signup" class="btn btn-primary">Signup</button>';
                echo '</form>'; 
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<div class="container">';
            echo '<div class="row">';
            echo '<div class="col-md-4">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">No games found</h5>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<div class="container">';
        echo '<div class="row">';
        echo '<div class="col-md-4">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">User not found</h5>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo '<div class="container">';
    echo '<div class="row">';
    echo '<div class="col-md-4">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">ID not provided</h5>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

if (isset($_POST['signup'])) {
    $userId = $_POST['user_id'];
    $gameId = $_POST['game_id'];
    $userName = $_POST['user_name'];
    $gameName = $_POST['game_name'];
    
    $sql_check = "SELECT COUNT(*) as count FROM data WHERE user_id='$userId' AND game_id='$gameId'";
    $result_check = $conn->query($sql_check);
    $row_check = $result_check->fetch_assoc();
    $already_signed_up = ($row_check['count'] > 0);

    if (!$already_signed_up) {
        $sql_games_count = "SELECT COUNT(*) as games_count FROM data WHERE user_id='$userId'";
        $result_games_count = $conn->query($sql_games_count);
        $row_games_count = $result_games_count->fetch_assoc();
        $games_count = $row_games_count['games_count'];

        if ($games_count < 5) {
            $sql = "INSERT INTO data (user_id, user_name, game_id, game_name) 
                    VALUES ('$userId', '$userName', '$gameId', '$gameName')";
            $result = $conn->query($sql);
        
            if ($result){
                echo '<div class="alert alert-success">Signup successful!</div>';
            } else {
                echo '<div class="alert alert-danger">Signup failed. Please try again.</div>';
            }
        } else {
            echo '<div class="alert alert-danger">Maximum games limit (5) reached!</div>';
        }
    } else {
        echo '<div class="alert alert-danger">You are already signed up for this game!</div>';
    }
}
?>
<script src="Testing/home-testing.js"></script>
</body>
</html>
