<?php
include('includes/session.php');
include('includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="style.css">
  <meta charset="utf-8">
  <title>Backup Notes | Web Application</title>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <style>
    body {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
        font-family: 'Playfair Display', serif;
        background-color: #f5f5f5;
    }

    .content {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        border-radius: 12px;
        background-color: #3e2723;
        color: #fff;
        width: 75vw;
        padding: 20px;
    }

    .header {
        font-size: 24px;
        font-weight: bold;
        border-bottom: 1px solid #fff;
        margin-bottom: 20px;
        align-self: center; /* Center the header within the flex container */
    }

    .backup-note {
        margin-bottom: 20px;
    }

    .delete-button {
        cursor: pointer;
        background-color: #c62828;
        color: #fff;
        padding: 5px 10px;
        border: none;
        border-radius: 5px;
    }

    .delete-button:hover {
        background-color: #b71c1c;
    }
  </style>
</head>
<body>

<div class="content">

    <div class="header">Backup Notes</div>

    <?php
    // Fetch backup notes for the current user
    $backupQuery = "SELECT * FROM backup_notes WHERE user_id = '$session_id' AND is_deleted = 0";
    $backupResult = mysqli_query($conn, $backupQuery);

    if ($backupResult) {
        $backupNotes = mysqli_fetch_all($backupResult, MYSQLI_ASSOC);

        if (!empty($backupNotes)) {
            foreach ($backupNotes as $backupNote) {
                echo '<div class="backup-note">';
                echo '<strong>Title:</strong> ' . $backupNote['title'] . '<br>';
                echo '<strong>Note:</strong> ' . $backupNote['note'] . '<br>';
                echo '<strong>Public:</strong> ' . ($backupNote['is_public'] ? 'Yes' : 'No') . '<br>';
                echo '<button class="delete-button" onclick="deleteNote(' . $backupNote['backup_id'] . ')">Delete</button>';
                echo '</div>';
            }
        } else {
            echo '<p>No backup notes found.</p>';
        }
    } else {
        // Handle query error
        echo 'Query error: ' . mysqli_error($conn);
    }
    ?>

    <script>
        function deleteNote(noteId) {
            var confirmation = confirm('Are you sure you want to permanently delete this note?');

            if (confirmation) {
                $.post('delete_note.php', { note_id: noteId }, function(response) {
                    if (response.success) {
                        // Note deleted successfully, you may want to reload the page or update the UI
                        location.reload(); // Reload the page for demonstration purposes
                    } else {
                        alert('Failed to delete note. ' + response.error);
                    }
                }, 'json');
            }
        }
    </script>

</div>

</body>
</html>
