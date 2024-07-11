<?php
    include("create_event.php");
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events Explore</title>
    <link rel="stylesheet" href="event.css">
</head>
<body>
    <h1>EVENTS YOU WANT TO EXPLORE</h1>

    <div class="data">
        <table>
            <thead>
                <tr>
                    
                    <th>Event name</th>
                    <th>Event location</th>
                    <th>Event Date</th>
                    <th>poster</th>
                </tr>
            </thead>
            <tbody>
            <?php
                
                $query = "SELECT * FROM `create_event`"; 
                $result = mysqli_query($conn, $query);

                if ($result) {
                    while ($row_fetch = mysqli_fetch_assoc($result)) {
                        echo "
                            <tr>
                               
                                <td>{$row_fetch['event_name']}</td>
                                <td>{$row_fetch['event_location']}</td>
                                <td>{$row_fetch['event_date']}</td>
                                <td><img src='$row_fetch[poster]' width='600px'></td>
                            </tr>
                        ";
                    }
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>