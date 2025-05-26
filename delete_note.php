<?php
include('includes/session.php');
include('includes/config.php');

// Check if note_id is set and is a valid integer
if (isset($_POST['note_id']) && filter_var($_POST['note_id'], FILTER_VALIDATE_INT)) {
    $noteId = $_POST['note_id'];

    // Update the backup_notes table to mark the note as deleted
    $updateQuery = "UPDATE backup_notes SET is_deleted = 1 WHERE backup_id = '$noteId' AND user_id = '$session_id'";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        // Return a success response to the AJAX request
        echo json_encode(['success' => true]);
        exit;
    } else {
        // Return an error response to the AJAX request
        echo json_encode(['success' => false, 'error' => 'Failed to update database']);
        exit;
    }
} else {
    // Return an error response to the AJAX request
    echo json_encode(['success' => false, 'error' => 'Invalid note ID']);
    exit;
}
?>
