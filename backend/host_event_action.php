$status = "pending";
$publish_event = 0;

$sql = "INSERT INTO create_event (title, description, date, venue, status, publish_event)
        VALUES ('$title', '$description', '$date', '$venue', '$status', '$publish_event')";
