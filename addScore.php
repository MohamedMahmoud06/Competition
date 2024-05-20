<!DOCTYPE html>
<html>
<head>
<title>Edit Product</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
<h1>Edit Product</h1>
<form method="POST" action="addScore.php">
<?php
include 'config.php';

$row = []; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $id = $_POST['name']; 
    $state = $_POST['state'];
    $score = $_POST['score'];
    $rank = $_POST['rank'];
    
    $sql = "UPDATE data SET state='$state', score='$score', rank=$rank WHERE ID=$id";
    
    if ($conn->query($sql) === TRUE) {
        header('Location: games.php');
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} elseif (isset($_GET['ID'])) {
    $id = $_GET['ID'];
    $sql = "SELECT ID, user_name FROM data WHERE ID=$id ORDER BY rank DESC";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<div class="form-group">
<label for="name">Select Member/Team:</label>
<select class="form-control" id="name" name="name" onchange="populateFields(this)">
<option value="">Select a member/team</option>
<?php
$sql = "SELECT ID, user_name FROM data";
$result = $conn->query($sql);

while ($memberTeam = $result->fetch_assoc()) {
    $selected = ($memberTeam['ID'] == $id) ? 'selected' : '';
    echo "<option value='" . $memberTeam['ID'] . "' $selected>" . $memberTeam['user_name'] . "</option>";
}
?>
</select>
</div>

<div class="form-group">
<label for="state">State:</label>
<input type="text" class="form-control" id="state" name="state" value="<?php echo $row['state'] ?? ''; ?>" required>
</div>

<div class="form-group">
<label for="score">Score:</label>
<input type="text" class="form-control" id="score" name="score" value="<?php echo $row['score'] ?? ''; ?>" required>
</div>

<div class="form-group">
<label for="rank">Rank:</label>
<input type="text" class="form-control" id="rank" name="rank" value="<?php echo $row['rank'] ?? ''; ?>" required>
</div>

<button type="submit" class="btn btn-primary">Save Changes</button>
</form>
<p><a class="btn btn-secondary mt-3" href="games.php">Back to Games List</a></p>
</div>

<script>
function populateFields(selectElement) {
    var selectedOption = selectElement.options[selectElement.selectedIndex];
    var stateInput = document.getElementById('state');
    var scoreInput = document.getElementById('score');
    var rankInput = document.getElementById('rank');

    stateInput.value = selectedOption.getAttribute('data-state');
    scoreInput.value = selectedOption.getAttribute('data-score');
    rankInput.value = selectedOption.getAttribute('data-rank');
}
</script>

</body>
</html>