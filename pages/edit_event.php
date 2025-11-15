<?php
session_start();
if (!isset($_SESSION['email'])) { header("Location: login.php"); exit(); }

include("../backend/dbconnect.php");

$event_id = $_GET['id'];

// Fetch event details
$result = mysqli_query($conn, "SELECT * FROM create_event WHERE event_id = $event_id");
$event = mysqli_fetch_assoc($result);

if (!$event) { 
    echo "Event not found!";
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Event | Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body { background:#050505; color:white; font-family:Poppins; }

        .card-custom {
            background:rgba(255,255,255,0.08);
            padding:30px;
            border-radius:16px;
            border:1px solid rgba(255,255,255,0.12);
            margin-top:120px;
            backdrop-filter:blur(8px);
            max-width:600px;
            margin-left:auto;
            margin-right:auto;
        }

        .form-control {
            background:rgba(255,255,255,0.12);
            color:white;
            border-radius:10px;
        }

        .btn-yellow {
            background:#ffd800;
            color:black;
            font-weight:600;
            border-radius:10px;
        }
        .btn-yellow:hover { background:#e6c000; }
    </style>
</head>
<body>

<div class="container">
    <div class="card-custom">

        <h3 class="fw-bold mb-3">✏ Edit Event</h3>

        <form action="../backend/update_event.php" method="POST">
            
            <input type="hidden" name="event_id" value="<?php echo $event['event_id']; ?>">

            <label class="mt-3">Event Title</label>
            <input type="text" name="title" class="form-control" 
                   value="<?php echo $event['title']; ?>" required>

            <label class="mt-3">Description</label>
            <textarea name="description" class="form-control" rows="4" required><?php echo $event['description']; ?></textarea>

            <label class="mt-3">Event Date</label>
            <input type="date" name="event_date" class="form-control" 
                   value="<?php echo $event['event_date']; ?>" required>

            <label class="mt-3">Event Time</label>
            <input type="time" name="event_time" class="form-control" 
                   value="<?php echo $event['event_time']; ?>" required>

            <label class="mt-3">Venue</label>
            <input type="text" name="venue" class="form-control" 
                   value="<?php echo $event['venue']; ?>" required>

            <label class="mt-3">Publish Status</label>
            <select name="publish_event" class="form-control">
                <option value="yes" <?php if($event['publish_event']=="yes") echo "selected"; ?>>Published</option>
                <option value="no"  <?php if($event['publish_event']=="no") echo "selected"; ?>>Draft</option>
            </select>

            <button class="btn btn-yellow w-100 mt-4">Save Changes</button>

        </form>

    </div>
</div>

<?php if (isset($_GET['success']) && $_GET['success']=="event_updated") { ?>
<script>
document.addEventListener("DOMContentLoaded", () => {
    showSuccess("Event updated successfully!");
});
</script>
<?php } ?>

<!-- Universal Popup -->
<div class="modal fade" id="successModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background:#121212; color:white; border-radius:15px;">
      <div class="modal-header" style="border:none;">
        <h5 class="modal-title text-warning fw-bold">✔ Success</h5>
        <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center" id="successMessage"></div>
      <div class="modal-footer" style="border:none;">
        <button class="btn btn-warning fw-bold px-4" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<script>
function showSuccess(msg) {
    document.getElementById("successMessage").innerHTML = msg;
    var myPopup = new bootstrap.Modal(document.getElementById("successModal"));
    myPopup.show();
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
