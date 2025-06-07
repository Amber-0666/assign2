<!DOCTYPE html>
<html lang="en">
<head>
  <title>Join Us Applications</title>
  <meta charset="utf-8"/>
</head>

<body>
  <h1>BrewnGo Applicant List</h1>

  <table border="1" cellpadding="8" cellspacing="0">
    <tr>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Phone</th>
      <th>City</th>
      <th>State</th>
    </tr>

    <?php
    include 'connection.php';

    // SQL query to fetch only required columns
    $sql = "SELECT firstname, lastname, email, phone, city, state FROM BrewnGo";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        //fetching the data row by row
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['firstname']) . "</td>
                    <td>" . htmlspecialchars($row['lastname']) . "</td>
                    <td>" . htmlspecialchars($row['email']) . "</td>
                    <td>" . htmlspecialchars($row['phone']) . "</td>
                    <td>" . htmlspecialchars($row['city']) . "</td>
                    <td>" . htmlspecialchars($row['state']) . "</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No records found</td></tr>";
    }

    mysqli_close($conn);
    ?>

  </table>
</body>
</html>
