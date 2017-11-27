<?php
$num_guests = $_POST['numGuests'];
$event_date = $_POST['cateringDate'];
$foodFK = $_POST['foodFK'];
$clientIDFK = $_POST['clientIDFK'];
$username = 'root';
$password = '';
try 
{
$conn = new PDO('mysql:host=localhost;dbname=catering', $username, $password); 
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare('INSERT INTO bookings(event_date, num_guests, fk_client, fk_food) VALUES (:date,:num_guests,:fk_client,:fk_food)');
$stmt->bindParam(':date', $event_date, PDO::PARAM_STR);
$stmt->bindParam(':num_guests', $num_guests, PDO::PARAM_INT);
$stmt->bindParam(':fk_client', $clientIDFK, PDO::PARAM_INT);
$stmt->bindParam(':fk_food', $foodFK, PDO::PARAM_INT);

$stmt->execute();
echo '<H1>';
echo 'Your record has been successfully added';
echo '</H1>';
}
catch(PDOException $e) 
{
  echo 'ERROR: ' . $e->getMessage();
}
$conn = null;
echo "</table>";
?>