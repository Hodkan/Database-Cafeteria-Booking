<?php
$client_id = $_POST['clientID'];
$username = 'root';
$password = '';
try 
{
$conn = new PDO('mysql:host=localhost;dbname=catering', $username, $password); 
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare('DELETE FROM bookings WHERE fk_client = :clientID');
$stmt->bindParam(':clientID', $client_id, PDO::PARAM_INT);
$stmt->execute();
echo '<H1>';
echo 'Your record has been successfully REMOVED';
echo '</H1>';
}
catch(PDOException $e) 
{
  echo 'ERROR: ' . $e->getMessage();
}
$conn = null;
echo "</table>";
?>