<!DOCTYPE html>
<html>
<head>
   
    <link rel="stylesheet" href="bootstrap-4.0.0-dist\css\bootstrap.min.css">
</head>


<?php
session_start();

// Include the database connection file
include_once('connection.php');

// Check if the user is logged in as an admin


// Get all pharmacist registrations from the database
$sql = "SELECT * FROM pharmacies";
$result = mysqli_query($con, $sql);

// Display errors if any
if (isset($_SESSION['errors'])) {
  echo '<div style="color: red;">';
  foreach ($_SESSION['errors'] as $error) {
    echo $error . '<br>';
  }
  echo '</div>';
  unset($_SESSION['errors']);
}

// Display success message if any
if (isset($_SESSION['success'])) {
  echo '<div style="color: green;">';
  echo $_SESSION['success'];
  echo '</div>';
  unset($_SESSION['success']);
}

?>

<h2>Pharmacist Registrations</h2>

<table border="1">
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Mobile</th>
    <th>Address</th>
    <th>Region</th>
    <th>Is Approved</th>
    <th>Action</th>
  </tr>
  <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
      <td><?php echo $row['id']; ?></td>
      <td><?php echo $row['pharmacy_name']; ?></td>
      <td><?php echo $row['email']; ?></td>
      <td><?php echo $row['mobile']; ?></td>
      <td><?php echo $row['address']; ?></td>
      <td><?php echo $row['region']; ?></td>
      <td><?php echo $row['is_approved'] ? 'Yes' : 'No'; ?></td>
      <td>
        <form method="post" action="add_pharmacist.php">
          <input type="hidden" name="pharmacist_id" value="<?php echo $row['id']; ?>">
          <input type="submit" name="add" value="Add">
        </form>
        <form method="post" action="delete_pharmacist.php">
          <input type="hidden" name="pharmacist_id" value="<?php echo $row['id']; ?>">
          <input type="submit" name="delete" value="Delete" onclick="return confirm('Are you sure you want to delete this pharmacist?')">
        </form>
      </td>
    </tr>
  <?php } ?>
</table>


