<!DOCTYPE html>
<html>
<head>
<title>Product CRUD</title>
<link rel="stylesheet"href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
<h1>Games List</h1>
<table class="table table-striped">
<thead>
<tr>
<th>Name</th>
<th>Description</th>
<th>kind</th>
<th>number</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php
include 'config.php';
$sql = "SELECT * FROM games";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
echo "<tr>";
echo "<td>{$row['name']}</td>";
echo "<td>{$row['description']}</td>";
echo "<td>{$row['kind']}</td>";
echo "<td>{$row['number']}</td>";
echo "<td><a class='btn btn-info btn-sm' href='addScore.php?id={$row['ID']}'>Edit</a> ";


echo "</tr>";
}
} else {
echo "<tr><td colspan='4'>No games found</td></tr>";
}
?>
</tbody>


</table>
<p><a class="btn btn-primary" href="addGame.php">Add New Game</a></p>
</div>
</body>
</html>