<!--Template page for IDCP-->
<?php
    $title = "Report a Bug";
    $page = 'report_bug';
    require('includes/header.php');
    require( 'includes/connect_db_c9.php' ) ;
    if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
        // $to      = 'syni679@gmail.com';
        // $subject = 'the subject';
        // $message = 'hello';
        // $headers = 'From: Kai.Wong1@marist.edu' . "\r\n" .
        // 'Reply-To: Kai.Wong1@marist.edu' . "\r\n" .
        // 'X-Mailer: PHP/' . phpversion();
        // mail($to, $subject, $message, $headers);
        $name = $_POST['name'];
        $email = $_POST['email'];
        $comment = $_POST['comment'];
        $query = "INSERT INTO BUG_REPORT(NAME, EMAIL, COMMENT) VALUES('$name', '$email', '$comment')";
        $result = mysqli_query($dbc, $query);
        if ($result){
        ?>
        <div class="alert alert-success alert-dismissible" role="alert" style="margin-top: 20px">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Success!</strong> Bug report has been submitted.
        </div>
        <?php
        }
    }
?>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="dropdown">
                    <div class="page-header">
                        <h1>Report a Bug</h1>
                    </div>
                    <form name="contactform" method="post" action="report_bug.php" class="form-horizontal" role="form" data-toggle="validator">
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Name *</label>
                            <div class="col-xs-2">
                                <input type="text" class="form-control" name = "name" data-error="Please enter your name" required>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Email *</label>
                            <div class="col-xs-2">
                                <input type="email" class="form-control" name = "email" data-error="Please enter your email" required>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Comment *</label>
                            <div class="col-xs-2">
                                <textarea class="form-control" rows="5" id="comment" name = "comment" data-error="Please enter a bug comment" required></textarea>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <br><br>
                        <div class="form-group">
                            <div class="col-xs-5 col-xs-offset-3">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <!-- /#page-content-wrapper -->
        </div>
        <!--Footer-->
        <?php require('includes/footer.php'); ?>
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Bootstrap Form Validator -->
    <script src="js/validator.js"></script>
</body>
</html>
