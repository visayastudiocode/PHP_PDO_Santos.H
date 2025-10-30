<?php
// dbconfig.php
$host = 'localhost';
$dbname = 'santos.h';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "😑 Connected successfully!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<?php
include 'dbconfig.php';

// Fetch all records
$stmt = $conn->prepare("SELECT * FROM grocery");
$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<pre>";
print_r($result);
echo "</pre>";
?>


<?php
include 'dbconfig.php';

// Fetch single record
$stmt = $conn->prepare("SELECT * FROM grocery WHERE id = 1");
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);

echo "<pre>";
print_r($row);
echo "</pre>";
?>


<?php
include 'dbconfig.php';

// Delete record
$sql = "DELETE FROM grocery WHERE id = 3";
$conn->exec($sql);

echo "Record deleted successfully!";
?>


<?php
include 'dbconfig.php';

// Insert record
$sql = "INSERT INTO grocery(item_name, category, quantity, price)
        VALUES ('Toothpaste', 'Toiletries', 8, 55.00)";
$conn->exec($sql);

echo "Record inserted successfully!";
?>



<?php
include 'dbconfig.php';

// Update record
$sql = "UPDATE grocery SET price =150.00 WHERE id = 2";
$conn->exec($sql);

echo "Record updated successfully!";
?>



<?php
include 'dbconfig.php';

$stmt = $conn->prepare("SELECT * FROM grocery");
$stmt->execute();
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Grocery Items</title>
</head>
<body>
<h2>Grocery Items Table</h2>
<table border="50" cellpadding="40">
<tr>
  <th>ID</th>
  <th>Item Name</th>
  <th>Category</th>
  <th>Quantity</th>
  <th>Price</th>
</tr>
<?php foreach ($items as $item): ?>
<tr>
  <td><?= $item['id'] ?></td>
  <td><?= $item['item_name'] ?></td>
  <td><?= $item['category'] ?></td>
  <td><?= $item['quantity'] ?></td>
  <td><?= $item['price'] ?></td>
</tr>
<?php endforeach; ?>
</table>
</body>
</html>



