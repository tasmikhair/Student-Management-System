<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $teacherName = $_POST['teacherName'];
        $teacherEmail = $_POST['teacherEmail'];
        $teacherSubject = $_POST['teacherSubject'];
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $teacherID = $_POST['teacherID'];
        $connum = $_POST['connum'];
        $address = $_POST['address'];
        $uname = $_POST['uname'];
        $password = md5($_POST['password']);
        $eid = $_GET['editid'];
        $sql = "update tblteacher set TeacherName=:teacherName,TeacherEmail=:teacherEmail,TeacherSubject=:teacherSubject,Gender=:gender,DOB=:dob,TeacherID=:teacherID,ContactNumber=:connum,Address=:address where ID=:eid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':teacherName', $teacherName, PDO::PARAM_STR);
        $query->bindParam(':teacherEmail', $teacherEmail, PDO::PARAM_STR);
        $query->bindParam(':teacherSubject', $teacherSubject, PDO::PARAM_STR);
        $query->bindParam(':gender', $gender, PDO::PARAM_STR);
        $query->bindParam(':dob', $dob, PDO::PARAM_STR);
        $query->bindParam(':teacherID', $teacherID, PDO::PARAM_STR);
        $query->bindParam(':connum', $connum, PDO::PARAM_STR);
        $query->bindParam(':address', $address, PDO::PARAM_STR);
        $query->bindParam(':eid', $eid, PDO::PARAM_STR);
        $query->execute();
        echo '<script>alert("Teacher has been updated")</script>';
        echo "<script>window.location.href ='manage-teachers.php'</script>";
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <title>Student Management System|| Update Teachers</title>
        <!-- plugins:css -->
        <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
        <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
        <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
        <!-- endinject -->
        <!-- Plugin css for this page -->
        <link rel="stylesheet" href="vendors/select2/select2.min.css">
        <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <!-- endinject -->
        <!-- Layout styles -->
        <link rel="stylesheet" href="css/style.css" />

    </head>

    <body>
        <div class="container-scroller">
            <!-- partial:partials/_navbar.html -->
            <?php include_once('includes/header.php'); ?>
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_sidebar.html -->
                <?php include_once('includes/sidebar.php'); ?>
                <!-- partial -->
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="page-header">
                            <h3 class="page-title"> Update Teachers </h3>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> Update Teachers</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="row">

                            <div class="col-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title" style="text-align: center;">Update Teachers</h4>

                                        <form class="forms-sample" method="post" enctype="multipart/form-data">
                                            <?php
                                            $eid = $_GET['editid'];
                                            $sql = "SELECT tblteacher.TeacherName,tblteacher.TeacherEmail,tblteacher.TeacherSubject,tblteacher.Gender,tblteacher.DOB,tblteacher.TeacherID,tblteacher.ContactNumber,tblteacher.Address,tblteacher.UserName,tblteacher.Password,tblteacher.Image,tblteacher.JoiningDate,tblsubject.SubjectName from tblteacher join tblsubject on tblsubject.ID=tblteacher.TeacherSubject where tblteacher.ID=:eid";
                                            $query = $dbh->prepare($sql);
                                            $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $row) {               ?>
                                                    <div class="form-group">
                                                        <label for="exampleInputName1">Teacher Name</label>
                                                        <input type="text" name="teacherName" value="<?php echo htmlentities($row->TeacherName); ?>" class="form-control" required='true'>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputName1">Teacher Email</label>
                                                        <input type="text" name="teacherEmail" value="<?php echo htmlentities($row->TeacherEmail); ?>" class="form-control" required='true'>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail3">Teacher Subject</label>
                                                        <select name="teacherSubject" class="form-control" required='true'>
                                                            <option value="<?php echo htmlentities($row->TeacherSubject); ?>"><?php echo htmlentities($row->SubjectName); ?></option>
                                                            <?php

                                                            $sql2 = "SELECT * from    tblsubject ";
                                                            $query2 = $dbh->prepare($sql2);
                                                            $query2->execute();
                                                            $result2 = $query2->fetchAll(PDO::FETCH_OBJ);

                                                            foreach ($result2 as $row1) {
                                                            ?>
                                                                <option value="<?php echo htmlentities($row1->ID);?>"><?php echo htmlentities($row1->SubjectName);?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputName1">Gender</label>
                                                        <select name="gender" value="" class="form-control" required='true'>
                                                            <option value="<?php echo htmlentities($row->Gender); ?>"><?php echo htmlentities($row->Gender); ?></option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputName1">Date of Birth</label>
                                                        <input type="date" name="dob" value="<?php echo htmlentities($row->DOB); ?>" class="form-control" required='true'>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputName1">Teacher ID</label>
                                                        <input type="text" name="teacherID" value="<?php echo htmlentities($row->TeacherID); ?>" class="form-control" readonly='true'>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputName1">Teacher Photo</label>
                                                        <img src="images/<?php echo $row->Image; ?>" width="100" height="100" value="<?php echo $row->Image; ?>"><a href="changeimage.php?editid=<?php echo $row->ID; ?>"> &nbsp; Edit Image</a>
                                                    </div>
                        
                                                    <div class="form-group">
                                                        <label for="exampleInputName1">Contact Number</label>
                                                        <input type="text" name="connum" value="<?php echo htmlentities($row->ContactNumber); ?>" class="form-control" required='true' maxlength="10" pattern="[0-9]+">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputName1">Address</label>
                                                        <textarea name="address" class="form-control" required='true'><?php echo htmlentities($row->Address); ?></textarea>
                                                    </div>
                                                    <h3>Login details</h3>
                                                    <div class="form-group">
                                                        <label for="exampleInputName1">User Name</label>
                                                        <input type="text" name="uname" value="<?php echo htmlentities($row->UserName); ?>" class="form-control" readonly='true'>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputName1">Password</label>
                                                        <input type="Password" name="password" value="<?php echo htmlentities($row->Password); ?>" class="form-control" readonly='true'>
                                                    </div><?php $cnt = $cnt + 1;
                                                        }
                                                    } ?>
                                            <button type="submit" class="btn btn-primary mr-2" name="submit">Update</button>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- content-wrapper ends -->
                    <!-- partial:partials/_footer.html -->
                    <?php include_once('includes/footer.php'); ?>
                    <!-- partial -->
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="vendors/js/vendor.bundle.base.js"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <script src="vendors/select2/select2.min.js"></script>
        <script src="vendors/typeahead.js/typeahead.bundle.min.js"></script>
        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="js/off-canvas.js"></script>
        <script src="js/misc.js"></script>
        <!-- endinject -->
        <!-- Custom js for this page -->
        <script src="js/typeahead.js"></script>
        <script src="js/select2.js"></script>
        <!-- End custom js for this page -->
    </body>

    </html><?php }  ?>