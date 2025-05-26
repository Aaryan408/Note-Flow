<?php include('includes/session.php')?>
<?php include('includes/config.php')?>

<?php
if (isset($_GET['delete'])) {
  $delete = $_GET['delete'];
  $sql = "DELETE FROM notes where note_id = ".$delete;
  $result = mysqli_query($conn, $sql);
  if ($result) {
    echo "<script>alert('Note removed Successfully');</script>";
      echo "<script type='text/javascript'> document.location = 'adnotebook.php'; </script>";
    
  }
}

if(isset($_POST['submits'])){

  if(isset($_POST['public']) && $_POST['public'] !== ''){
         $public = (int)$_POST['public'];
          } else {
               $public = 1;
          }
          $noteid = (int)$_POST['note_id'];

          $query = "UPDATE `notes` SET public='$public' WHERE note_id='$noteid'";

        if(mysqli_query($conn, $query)){

        echo "<script>alert('Approve Successfully');</script>";

        }else{
            //failure
            echo 'query error: '. mysqli_error($conn);
        }

}



    //********************Selection********************
     $query = "SELECT * FROM `notes` WHERE report='1'";

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

    $query1 ="SELECT a.*,b.user_ID AS userid,b.fullName AS Name FROM reviews a,register b WHERE a.userid=b.user_ID";

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
    
    $query2 = "SELECT * FROM `notes` WHERE public='1'";

    if(mysqli_query($conn, $query2)){

        // get the query result
        $result = mysqli_query($conn, $query2);

        // fetch result in array format
        $notesArrayss= mysqli_fetch_all($result , MYSQLI_ASSOC);

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
              <a href="logout.php" >Logout</a>
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
                      <a href="adnotebook.php" class="active">
                        <i class="fa fa-pencil icon">
                          <b class="bg-info"></b>
                        </i>
                        <span>Notes</span>
                      </a>
                    </li>
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
                  
                <aside class="bg-white">
                  <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                        <li class="active"><a href="#activity" data-toggle="tab"><h4 style = "text-transform:uppercase;"><b>Report Note Details</b></h4></a></li>
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
            <a href="adnotebook.php?delete=<?php echo $note['note_id']; ?>"><button type="button" class="btn btn-sm btn-default" title="Remove"><i class="fa fa-trash-o bg-danger"></i></button></a>
        </div>
        <h3 style="text-transform: uppercase;"><b><?php echo $note['title']; ?></b></h3>
        <p><?php echo substr($note['note'], 0, 200); ?></p>
        <small class="block text-muted text-info"><i class="fa fa-clock-o text-info"></i> Note Added <?php echo $note['time_in']; ?></small>
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
                        <li class="active"><a href="#activity" data-toggle="tab"><h4 style = "text-transform:uppercase;"><b>Public Activation</b></h4></a></li>
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="activity">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                            <li></li>
                            <?php foreach($notesArrayss as $note): ?>
    <?php $pdf = $note['pdffile']; ?>
    <li class="list-group-item">
        <div class="btn-group pull-right">
            <?php if($note['pdffile'] != ""): ?>
                <a href="images/<?php echo $note['pdffile']; ?>" target="_blank"><button type="button" class="btn btn-sm btn-default" title="PDF"><i class="fa fa-eye"></i></button></a>
            <?php endif; ?>
            <a href="adnotebook.php?delete=<?php echo $note['note_id']; ?>"><button type="button" class="btn btn-sm btn-default" title="Remove"><i class="fa fa-trash-o bg-danger"></i></button></a>
        </div>
        <h3 style="text-transform: uppercase;"><b><?php echo $note['title']; ?></b></h3>
        <p><?php echo substr($note['note'], 0, 200); ?></p>
        <small class="block text-muted text-info"><i class="fa fa-clock-o text-info"></i> Note Added <?php echo $note['time_in']; ?></small>
        <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                          <label for="Report">
                            <input type="checkbox" id="Report"  name="public" required value="2"> Public Note Approval
                            <input type="hidden" name="note_id" value="<?= $note['note_id']?>">
                          </label>
                        </div>
                        <button class="btn btn-sm btn-default" name="submits" type="submit">Approve</button>
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
                
                
                
                
                
                
                
                
                
                
                <aside class="bg-white">
                  <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                        <li class="active"><a href="#activitys" data-toggle="tab"><h4 style = "text-transform:uppercase;"><b> Public Review</b></h4></a></li>
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="activitys">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                            <li></li>
                            <?php foreach($notesArrays as $note): ?>
    
    <li class="list-group-item">
        <div class="btn-group pull-right">
            
            
        </div>
        <h3 style="text-transform: uppercase;"><b><?php echo $note['review']; ?></b></h3>
        <!-- <h1>Give <p><?php echo $note['stars']; ?> stars</p></h1> -->
        <big class="block text-muted text-info"><i class="fa fa-clock-o text-info"></i> Give  <?php echo $note['stars']; ?> stars</big>
        <small class="block text-muted text-info"><i class="fa fa-clock-o text-info"></i> Review By <?php echo $note['Name']; ?></small>
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