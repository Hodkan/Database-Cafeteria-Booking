<?php
$clientName = $_POST['clientFamilyName'];
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Invoice Number</th><th>Date</th><th>Guest Number</th><th>First Name</th><th>Last Name</th><th>Food</th></tr>";
class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }
    function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }
    function beginChildren() {
        echo "<tr>";
    }
    function endChildren() {
        echo "</tr>" . "\n";
    }
} 
$username = 'root';
$password = '';
try 
{
$conn = new PDO('mysql:host=localhost;dbname=catering', $username, $password); 
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare('SELECT bookings.invoice_number, bookings.event_date, bookings.num_guests, clients.first_name, clients.family_name, foods.description FROM bookings left join clients on bookings.fk_client = clients.id_client  left join foods on bookings.fk_food = foods.id_food where clients.family_name = :familyName');
$stmt->bindParam(':familyName', $clientName, PDO::PARAM_STR);
$stmt->execute();

// set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        echo $v;
}
}
catch(PDOException $e) 
{
  echo 'ERROR: ' . $e->getMessage();
}
$conn = null;
echo "</table>";
?>