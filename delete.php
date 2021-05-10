<?php
require 'db.php';
$query = $db->prepare('DELETE FROM todo_app WHERE id=:id');
$delete = $query->execute([
    'id' => $_GET['id']
]);
if ($delete) {
    header('Location: index.php');
} else {
    echo "<script>alert('Silmə əməliyyatı baş vermədi!');</script>";
}
