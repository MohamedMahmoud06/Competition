<?php
include 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$name = $_POST['name'];
$description = $_POST['description'];
$kind = $_POST['flexRadioDefault'];
$number = $_POST['number'];
$sql = "INSERT INTO games ( name, description, kind, number) VALUES ('$name',
'$description','$kind','$number')";

if ($conn->query($sql) === TRUE) {
header('Location: games.php');
exit;
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Add Game</title>
<link rel="stylesheet"href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="css/signup.css">
</head>
<body>
<div class="d-flex justify-content-center py-5">
<form class="form" method="POST" action="addGame.php">
       <p class="form-title">Add game</p>
      <div class="input-container">
          <input type="text" placeholder="Enter Name" name="name">
        </div>
        <div class="input-container">
          <input type="text" placeholder="Enter Description" name="description">
        </div>
        <div class="input-container">
          <input type="text" placeholder="Enter Nmber" name="number">
        </div>
        
        <div class="form-check">
  <input class="form-check-input" type="radio" name="flexRadioDefault" id="indvidual" value="indvidual">
  <label class="form-check-label" for="members">
    Indvidual
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="team">
  <label class="form-check-label" for="flexRadioDefault2">
    Team
  </label>
</div>
        
<button type="submit" class="submit"> Add</button>

     
   </form>

</div>
</body>
</html>
