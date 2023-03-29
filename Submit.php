<?php

include("db.php");

session_start();

if (isset($_SESSION['employeeID']) && isset($_SESSION['name'])) {
    ?>

    <!DOCTYPE html>
    <html lang="en">
<?php include('headerEmployee.php')?>
                    <main>
                        <hr>
                        <div id="EmployeeForm">
                            <h3>Submit FWA Request</h3>
                            <hr>
                            <form action="submitdb.php" method="POST">
                                <label> Employee ID </label>
                                <input type="text" class="form-control col-sm-4 col-form-label" id="ID"
                                    value="<?php echo $_SESSION['employeeID']; ?>" readonly>
                                <label> Name </label>
                                <input type="text" class="form-control col-sm-4 col-form-label" id="Name"
                                    value="<?php echo $_SESSION['name']; ?>" readonly>
                                <div class="form-group row">
                                    <label for="workType" class="col-sm-4 col-form-label">Work Type</label>
                                    <div class="col-sm-10">
                                        <select name='workType' id='workType' class="form-control col-sm-5 col-form-label">
                                            <option value='Work From Home'>Work From Home</option>
                                            <option value='Flexi Hours'>Flexi Hours</option>
                                            <option value='Hybrid'>Hybrid</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="description" class="col-sm-4 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea type="text" class="form-control" id="description" name="description"
                                            placeholder="Description" required></textarea>
                                    </div>
                                </div>
                                <fieldset class="form-group">
                                    <div class="row">
                                        <label for="Reason" class="col-sm-4 col-form-label">Reason</label>
                                        <div class="col-sm-10">
                                            <textarea type="text" class="form-control" id="Reason" name="Reason"
                                                placeholder="Reason" required></textarea>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
               <?php include('footer.php')?>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
            integrity="sha384-AZ+T2QJdAJlb+NPEZhG8JvPc7b2rmVBbdEaq+J1YnHRmZ7LRPZo+poYGDBxFP8R/"
            crossorigin="anonymous"></script>
    </body>

    </html>
    <?php
} else {
    header("Location: login.php");
    exit();
}
?>