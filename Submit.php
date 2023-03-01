<?php

include("db.php");

session_start();

if (isset($_SESSION['employeeID']) && isset($_SESSION['name'])) {
 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>FlexIS | Register Employee </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="KaiLiang.css">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" 
         integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    </head>
    <body>
        <div class="logoBanner">
            <img src="logo.jpg" alt="FlexIS">
        </div>
        <div class="colorDiv"></div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-3 bg-secondary sticky-top">
                    <nav>
                        <div class="row row-cols-5 row-cols-md-1">
                            <div class="col py-3 text-center text-md-left">Menu</div>
                            <div class="col py-3 text-center text-md-left"><a href="register.html">Register Employee</a></div>
                            <div class="col py-3 text-center text-md-left"><a href="">View FWA Analytics</a></div>
                            <div class="col py-3 text-center text-md-left"><a href="">Logout</a></div>
                        </div>
                    </nav>
                </div>
                <div class="col-md-7 bg-light">
                    <main>
                        <hr>
                        <div id="EmployeeForm">
                            <h3>Register Employee</h3><hr>
                            <form action="submitdb.php" method = "post">
                                <label> Employee ID </label>
                                <input type="text" class="form-control col-sm-4 col-form-label" id="ID" value= "<?php echo $_SESSION['employeeID']; ?>" readonly>
                                <label> Name </label>
                                <input type="text" class="form-control col-sm-4 col-form-label" id="Name" value="<?php echo $_SESSION['name']; ?>" readonly>
                                <div class="form-group row">
                                    <label for="workType" class="col-sm-4 col-form-label">Work Type</label>
                                    <div class="col-sm-10">
                                    <select id="workType" class="form-control col-sm-5 col-form-label">
                                        <option selected>(Select Work Type)</option>
                                        <option>Work From Home</option>
                                        <option>Flexi Hours</option>
                                        <option>Hybrid</option>
                                    </select>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="description" class="col-sm-4 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                      <textarea type="text" class="form-control" id="description" placeholder="Description"></textarea>
                                    </div>
                                  </div>
                                  <fieldset class="form-group">
                                    <div class="row">
                                        <label for="Reason" class="col-sm-4 col-form-label">Reason</label>
                                        <div class="col-sm-10">
                                          <textarea type="text" class="form-control" id="Reason" placeholder="Reason"></textarea>
                                        </div>
                                    </div>
                                  </fieldset>
                                  <div class="form-group row">
                                    <div class="col-sm-10">
                                      <button type="submit" name="submit" class="btn btn-primary" data-toggle="modal" data-target="#verModal">Submit</button>
                                    </div>
                                  </div>
                              </form>
                        </div>
                    </main>
                    <br>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
        <div class="footer">
            <small><i>Copyright &copy; 2023 HELP University</i></small>
        </div>

        <!-- JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" 
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
         <script src="PorSie.js"></script>
    </body>
</html>
<?php
}else{
    header("Location: index.php");
    exit();
}?>