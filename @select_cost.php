<?php
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Price</th><th>First Name</th><th>Last Name</th></tr>";
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
$stmt = $conn->prepare('Select sum(foods.cost) as price, clients.first_name, clients.family_name From clients left join bookings on clients.id_client = bookings.fk_client left join foods on bookings.fk_food = foods.id_food where foods.cost > 0 group by clients.family_name order by price desc;');
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