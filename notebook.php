<?php include('includes/session.php')?>
<?php include('includes/config.php')?>

<?php
if (isset($_GET['delete'])) {
  $delete = $_GET['delete'];
  $sql = "DELETE FROM notes where note_id = ".$delete;
  $result = mysqli_query($conn, $sql);
  if ($result) {
    echo "<script>alert('Note removed Successfully');</script>";
      echo "<script type='text/javascript'> document.location = 'notebook.php'; </script>";
    
  }
}

if(isset($_POST['Submit'])){

          $stars = (int)$_POST['stars'];
          $review = $_POST['review'];
          date_default_timezone_set("Africa/Accra");
        $time_now = date("h:i:sa");

        $query = "INSERT INTO `reviews`(`userid`, `review`, `stars`, `date`) VALUES ('$session_id','$review','$stars','$time_now')";

        if(mysqli_query($conn, $query)){

        // echo "<script>alert('Successfully Added');</script>";
        echo "<script type='text/javascript'> document.location = 'index.html'; </script>";

        }else{
            //failure
            echo 'query error: '. mysqli_error($conn);
        }

}



if(isset($_POST['submits'])){

  // if(isset($_POST['report']) && $_POST['report'] !== ''){
         $report = (int)$_POST['report'];
          // } else {
          //      $report = 0;
          // }
          $noteid = (int)$_POST['note_id'];

          $query = "UPDATE `notes` SET report='$report' WHERE note_id='$noteid'";

        if(mysqli_query($conn, $query)){

        echo "<script>alert('Report Successfully');</script>";

        }else{
            //failure
            echo 'query error: '. mysqli_error($conn);
        }

}

 if(isset($_POST['submit'])){
        
        $title=mysqli_real_escape_string($conn,$_POST['title']);
        $note=mysqli_real_escape_string($conn,$_POST['note']);
        if(isset($_POST['public']) && $_POST['public'] !== ''){
         $public = (int)$_POST['public'];
          } else {
               $public = 0;
          }

           $pdffile = $_FILES['pdf']['name'];
           $tempname = $_FILES["pdf"]["tmp_name"];
           $folder = "images/" . $pdffile;


        

        date_default_timezone_set("Africa/Accra");
        $time_now = date("h:i:sa");

        // make sql query
      $query = "INSERT INTO notes(user_id,title,note,pdffile,public,time_in) VALUES('$session_id','$title','$note','$pdffile','$public','$time_now')";

        if(mysqli_query($conn, $query)){

           if (move_uploaded_file($tempname, $folder)) {
        echo "<script>alert('Note Added Successfully');</script>";
    } else {
        echo " Failed to upload image!";
    }
          // echo "<script>alert('Note Added Successfully');</script>";

        }else{
            //failure
            echo 'query error: '. mysqli_error($conn);
        }

    }

    //********************Selection********************
     $query = "SELECT * FROM notes WHERE user_id = \"$session_id\" ";

    if(mysqli_query($conn, $query)){

        // get the query result
        $result = mysqli_query($conn, $query);

        // fetch result in array format
        $notesArray= mysqli_fetch_all($result , MYSQLI_ASSOC);

        // print_r($notesArray);

    }else{
        //failure
        echo 'query error: '. mysqli_error($conn);
    }

    $query1 ="SELECT a.*,b.user_ID AS userid,b.fullName AS Name FROM notes a,register b WHERE public='2' AND a.user_ID=b.user_ID";

    if(mysqli_query($conn, $query1)){

        // get the query result
        $result = mysqli_query($conn, $query1);

        // fetch result in array format
        $notesArrays= mysqli_fetch_all($result , MYSQLI_ASSOC);

        // print_r($notesArray);

    }else{
        //failure
        echo 'query error: '. mysqli_error($conn);
    }
?>

<!DOCTYPE html>
<html lang="en" class="app">
<head>
  <meta charset="utf-8" />
  <title>Notebook | Web Application</title>
  <meta name="description" content="app, web app" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="css/animate.css" type="text/css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="css/font.css" type="text/css" />
  
  <link rel="stylesheet" href="css/app.css" type="text/css" />
  <style>
    /* Styles for the popup */
    .popup {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        padding: 20px;
        border: 1px solid #ccc;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        z-index: 9999;
    }

    .rating {
        unicode-bidi: bidi-override;
        direction: rtl;
        text-align: center;
    }

    .rating > span {
        display: inline-block;
        position: relative;
        width: 1.1em;
    }

    .rating > span:hover:before,
    .rating > span:hover ~ span:before {
        content: "\2605";
        position: absolute;
        color: gold;
    }

    .rating > span:hover:before {
        z-index: 1000;
    }

    .rating > span:before {
        content: "\2606";
        position: absolute;
    }

    .star-rating {
  display: flex;
  align-items: center;
  width: 160px;
  flex-direction: row-reverse;
  justify-content: space-between;
  margin: 40px auto;
  position: relative;
}
/* hide the inputs */
.star-rating input {
  display: none;
}
/* set properties of all labels */
.star-rating > label {
  width: 30px;
  height: 30px;
  font-family: Arial;
  font-size: 30px;
  transition: 0.2s ease;
  color: orange;
}
/* give label a hover state */
.star-rating label:hover {
  color: #ff69b4;
  transition: 0.2s ease;
}
.star-rating label:active::before {
  transform:scale(1.1);
}

/* set shape of unselected label */
.star-rating label::before {
  content: '\2606';
  position: absolute;
  top: 0px;
  line-height: 26px;
}
/* set full star shape for checked label and those that come after it */
.star-rating input:checked ~ label:before {
  content:'\2605';
}

@-moz-document url-prefix() {
  .star-rating input:checked ~ label:before {
  font-size: 36px;
  line-height: 21px;
  }
}  
</style>
</head>
<body>
  <section class="vbox">
    <header class="bg-dark dk header navbar navbar-fixed-top-xs">
      <div class="navbar-header aside-md">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
          <i class="fa fa-bars"></i>
        </a>
        <a href="#" class="navbar-brand" data-toggle="fullscreen"><img src="images/log.jpg" class="m-r-sm">Notebook</a>
        <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".nav-user">
          <i class="fa fa-cog"></i>
        </a>
      </div>
      <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user">
        <li class="dropdown">
          <?php $query= mysqli_query($conn,"select * from register where user_ID = '$session_id'")or die(mysqli_error());
                $row = mysqli_fetch_array($query);
            ?>

          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="thumb-sm avatar pull-left">
              <img src="images/log.jpg">
            </span>
            <?php echo $row['fullName']; ?> <b class="caret"></b>
          </a>
          <ul class="dropdown-menu animated fadeInRight">
            <span class="arrow top"></span>
            <li class="divider"></li>
            <li>
              <a href="logout.php" id="popupTrigger" >Logout</a>
            </li>
          </ul>
        </li>
      </ul>      
    </header>
    <section>
      <section class="hbox stretch">
        <!-- .aside -->
        <aside class="bg-dark lter aside-md hidden-print" id="nav">          
          <section class="vbox">
            <section class="w-f scrollable">
              <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
                
                <!-- nav -->
                <nav class="nav-primary hidden-xs">
                  <ul class="nav">
                    <li  class="active">
                      <a href="notebook.php" class="active">
                        <i class="fa fa-pencil icon">
                          <b class="bg-info"></b>
                        </i>
                        <span>Notes</span>
                      </a>
                    </li>
                    <script type="text/javascript">
                    function googleTranslateElementInit() {
                    new google.translate.TranslateElement({
                     pageLanguage: 'en', // Change this to your website's default language
                      layout: google.translate.TranslateElement.InlineLayout.SIMPLE
                     }, 'google_translate_element');
                   }
                  </script>
                  <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                  <div id="google_translate_element"></div>
                  </ul>
                </nav>
                <!-- / nav -->
              </div>
            </section>
            
            <footer class="footer lt hidden-xs b-t b-dark">
              <div id="invite" class="dropup">                
                <section class="dropdown-menu on aside-md m-l-n">
                  <section class="panel bg-white">
                    <header class="panel-heading b-b b-light">
                      <?php $query= mysqli_query($conn,"select * from register where user_ID = '$session_id'")or die(mysqli_error());
                        $row = mysqli_fetch_array($query);
                      ?>
                      <?php echo $row['fullName']; ?> <i class="fa fa-circle text-success"></i>
                    </header>
                    <div class="panel-body animated fadeInRight">
                      
                      <p><a href="https://api.whatsapp.com/send?text=Hi,%20I%20invite%20you%20from%20WhatsApp" target="_blank" class="btn btn-sm btn-facebook"><i class="fa fa-fw fa-whatsapp"></i> Invite from WhatsApp</a></p>
                    <p><a href="https://mail.google.com/mail/u/0/#inbox" target="_blank" class="btn btn-sm btn-facebook"><i class="fa fa-fw fa-envelope"></i> Invite from Gmail</a></p>
                    </div>
                  </section>
                </section>
              </div>
              <a href="#nav" data-toggle="class:nav-xs" class="pull-right btn btn-sm btn-dark btn-icon">
                <i class="fa fa-angle-left text"></i>
                <i class="fa fa-angle-right text-active"></i>
              </a>
              <div class="btn-group hidden-nav-xs">
                <button type="button" title="Contacts" class="btn btn-icon btn-sm btn-dark" data-toggle="dropdown" data-target="#invite"><i class="fa fa-youtube"></i></button>
              </div>
            </footer>
          </section>
        </aside>
        <!-- /.aside -->
        <section id="content">
          <section class="hbox stretch">
                  <aside class="aside-lg bg-light lter b-r">
                    <div class="wrapper">
                      <h4 class="m-t-none">Add Note</h4>
                      <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                          <label>Title</label>
                          <input name="title" type="text" placeholder="Title" class="input-sm form-control">
                        </div>
                        <div class="form-group">
                          <label>Note</label>
                          <textarea name="note" class="form-control" rows="8" data-minwords="8" data-required="true" placeholder="Take a Note ......"></textarea>
                        </div>
                        <div class="form-group">
                          <label>Attachment</label>
                          <input name="pdf" type="file" placeholder="Attachment" class="input-sm form-control">
                        </div>
                        <div class="form-group">
                          <label for="Public">
                            <input type="checkbox" id="Public"  name="public" value="1"> Public Note
                          </label>
                        </div>
                        <div class="m-t-lg"><button class="btn btn-sm btn-default" name="submit" type="submit">Add Note</button></div>
                      </form>
                    </div>
                </aside>
                <aside class="bg-white">
                  <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                        <li class="active"><a href="#activity" data-toggle="tab"><h4 style = "text-transform:uppercase;"><b>Note Details</b></h4></a></li>
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="activity">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                            <li></li>
                            <?php foreach($notesArray as $note): ?>
    <?php $pdf = $note['pdffile']; ?>
    <li class="list-group-item">
        <div class="btn-group pull-right">
            <?php if($note['pdffile'] != ""): ?>
                <a href="images/<?php echo $note['pdffile']; ?>" target="_blank"><button type="button" class="btn btn-sm btn-default" title="PDF"><i class="fa fa-eye"></i></button></a>
            <?php endif; ?>
            <a href="edit_note.php?edit=<?php echo $note['note_id']; ?>"><button type="button" class="btn btn-sm btn-default" title="Show"><i class="fa fa-eye"></i></button></a>
            <a href="notebook.php?delete=<?php echo $note['note_id']; ?>"><button type="button" class="btn btn-sm btn-default" title="Remove"><i class="fa fa-trash-o bg-danger"></i></button></a>
        </div>
        <h3 style="text-transform: uppercase;"><b><?php echo $note['title']; ?></b></h3>
        <p><?php echo substr($note['note'], 0, 200); ?></p>
        <small class="block text-muted text-info"><i class="fa fa-clock-o text-info"></i> <?php echo $note['time_in']; ?></small>
    </li>
<?php endforeach; ?>

                            </li>
                          </ul>
                        </div>
                        <div class="tab-pane" id="events">
                          <div class="text-center wrapper">
                            <i class="fa fa-spinner fa fa-spin fa fa-large"></i>
                          </div>
                        </div>
                        <div class="tab-pane" id="interaction">
                          <div class="text-center wrapper">
                            <i class="fa fa-spinner fa fa-spin fa fa-large"></i>
                          </div>
                        </div>
                      </div>
                    </section>
                  </section>
                </aside>
                <aside class="bg-white">
                  <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                        <li class="active"><a href="#activitys" data-toggle="tab"><h4 style = "text-transform:uppercase;"><b> Public Note</b></h4></a></li>
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="activitys">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                            <li></li>
                            <?php foreach($notesArrays as $note): ?>
    <?php $pdf = $note['pdffile']; ?>
    <li class="list-group-item">
        <div class="btn-group pull-right">
            <?php if($note['pdffile'] != ""): ?>
                <a href="images/<?php echo $note['pdffile']; ?>" target="_blank"><button type="button" class="btn btn-sm btn-default" title="PDF"><i class="fa fa-eye"></i></button></a>
            <?php endif; ?>
            
        </div>
        <h3 style="text-transform: uppercase;"><b><?php echo $note['title']; ?></b></h3>
        <p><?php echo substr($note['note'], 0, 200); ?></p>
        <small class="block text-muted text-info"><i class="fa fa-clock-o text-info"></i> Created By <?php echo $note['Name']; ?></small>
        <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                          <label for="Report">
                            <input type="checkbox" id="Report"  name="report" required value="1"> Report Note
                            <input type="hidden" name="note_id" value="<?= $note['note_id']?>">
                          </label>
                        </div>
                        <button class="btn btn-sm btn-default" name="submits" type="submit">Report an event</button>
                      </form>
    </li>
<?php endforeach; ?>

                            </li>
                          </ul>
                        </div>
                        <div class="tab-pane" id="events">
                          <div class="text-center wrapper">
                            <i class="fa fa-spinner fa fa-spin fa fa-large"></i>
                          </div>
                        </div>
                        <div class="tab-pane" id="interaction">
                          <div class="text-center wrapper">
                            <i class="fa fa-spinner fa fa-spin fa fa-large"></i>
                          </div>
                        </div>
                      </div>
                    </section>
                  </section>
                </aside>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
        <aside class="bg-light lter b-l aside-md hide" id="notes">
          <div class="wrapper">Notification</div>
        </aside>
      </section>
    </section>
  </section>
  <script src="js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="js/bootstrap.js"></script>
  <!-- App -->
  <script src="js/app.js"></script>
  <script src="js/app.plugin.js"></script>
  <script src="js/slimscroll/jquery.slimscroll.min.js"></script>
  <script src="js/libs/underscore-min.js"></script>
<script src="js/libs/backbone-min.js"></script>
<script src="js/libs/backbone.localStorage-min.js"></script>  
<script src="js/libs/moment.min.js"></script>

<!-- Notes -->
<script src="js/apps/notes.js"></script>

<!-- Popup review form -->
<div class="popup" id="reviewForm">
    <h2>Leave a Review</h2>
    
    
    <form method="POST" enctype="multipart/form-data">
      <div class="star-rating">
      <input type="radio" name="stars" id="star-a" value="5"/>
      <label for="star-a"></label>

      <input type="radio" name="stars" id="star-b" value="4"/>
      <label for="star-b"></label>
  
      <input type="radio" name="stars" id="star-c" value="3"/>
      <label for="star-c"></label>
  
      <input type="radio" name="stars" id="star-d" value="2"/>
      <label for="star-d"></label>
  
      <input type="radio" name="stars" id="star-e" value="1"/>
      <label for="star-e"></label>
</div>
        <label for="review">Your Review:</label><br>
        <textarea id="review" name="review" required rows="4" cols="30"></textarea><br>
        <input type="submit" name="Submit" value="Submit Review">
    </form>
    <!-- <button type="button" onclick="closePopup()">Close</button> -->
    <a href="logout.php" id="popupTrigger" class="btn btn-sm btn-default" title="Close">Close</a>
    <!-- <a href="logout.php" id="popupTrigger" class="btn btn-sm btn-default" title="Submit">Submit</a> -->

</div>

<script>
    // JavaScript to handle popup functionality
    document.getElementById("popupTrigger").addEventListener("click", function(event) {
        event.preventDefault(); // Prevent default link behavior
        document.getElementById("reviewForm").style.display = "block"; // Display the popup
    });

    function closePopup() {
        document.getElementById("reviewForm").style.display = "none"; // Hide the popup
    }

    function setRating(rating) {
        // Here you can handle the logic to set the rating (e.g., store it in a hidden input field)
        console.log("Selected rating: " + rating);
        document.getElementById("selectedRating").textContent = "Selected Rating: " + rating;
    }
</script>
<script type="text/javascript">
  document.addEventListener('contextmenu', event => event.preventDefault());
  $(document).on({
    "contextmenu": function (e) {
        console.log("ctx menu button:", e.which); 

        // Stop the context menu
        e.preventDefault();
    },
    "mousedown": function(e) { 
        console.log("normal mouse down:", e.which); 
    },
    "mouseup": function(e) { 
        console.log("normal mouse up:", e.which); 
    }
});
</script>
 <script type="text/javascript">
        window.oncontextmenu = function () {
            return false;
        }
        $(document).keydown(function (event) {
            if (event.keyCode == 123) {
                return false;
            }
            else if ((event.ctrlKey && event.shiftKey && event.keyCode == 73) || (event.ctrlKey && event.shiftKey && event.keyCode == 74)) {
                return false;
            }
        });
    </script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
document.onkeydown = function(e) {
        if (e.ctrlKey && 
            (e.keyCode === 67 || 
             e.keyCode === 86 || 
             e.keyCode === 85 || 
             e.keyCode === 117)) {
            return false;
        } else {
            return true;
        }
};
$(document).keypress("u",function(e) {
  if(e.ctrlKey)
  {
return false;
}
else
{
return true;
}
});
</script> 
</body>
</html>