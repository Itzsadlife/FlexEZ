<?php

include "db.php";
session_start();

// generate a random ID
$randomID = 'R' . str_pad(mt_rand(1, 999), 3, '0', STR_PAD_LEFT);

// check if the ID already exists in the database

$sql = "SELECT * FROM request WHERE requestID = '$randomID'";
$checkingResult = mysqli_query($db, $sql);

if (mysqli_num_rows($checkingResult) > 0) {
    // the ID already exists in the database, regenerate the ID
    $randomID = 'R' . str_pad(mt_rand(1, 999), 3, '0', STR_PAD_LEFT);
}

if (isset($_POST['submit'])) {

    // Set the timezone to Malaysia
    date_default_timezone_set('Asia/Kuala_Lumpur');

    // Get the current date in the format of "DD-MM-YYYY"
    $localDate = date('d-m-Y');

    // Convert the local date format to "YYYY-MM-DD"
    $convertedDate = date('Y-m-d', strtotime($localDate));


    $workType = $_POST['workType']; // Retrieve the ID value from the form
    $Description = $_POST['description']; // Retrieve the name value from the form
    $Reason = $_POST['Reason']; // Retrieve the name value from the form

    //checking if the employee has Supervisor or not
    $sql = "SELECT * FROM employee WHERE SupervisorID IS NOT NULL AND employeeID = '$_SESSION[employeeID]'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_num_rows($result);

    if (mysqli_num_rows($result) == 1) {
        $query = "INSERT INTO request (requestID, employeeID, requestDate, workType, description, reason, FWAstatus)
            VALUES ('$randomID', '$_SESSION[employeeID]', '$convertedDate', '$workType', '$Description', '$Reason', 'Pending')";

        $result = mysqli_query($db, $query);
        echo "
        <!DOCTYPE html>
        <html lang='en'>

        "; 
        include('headerkai.php');
        echo"
                        <main>
                            <hr>
                            <div class='alert alert-success' role='alert'>
                                <h4 class='alert-heading'>Congratulation!</h4>
                                <p>You have successful submitted a FWA request.</p>
                                <hr>
                                <p class='mb-0'>Your request ID is $randomID</p>
                            </div>

                    </div>
                </div>
                </main>
                <br>
            </div>
            <div class='col-md-1'></div>
            </div>
            </div>
            <div class='footer'>
                <small><i>Copyright &copy; 2023 HELP University</i></small>
            </div>

            <!-- jQuery -->
            <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>

            <!-- Bootstrap JS -->
            <script src='https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js' integrity='sha384-AZ+T2QJdAJlb+NPEZhG8JvPc7b2rmVBbdEaq+J1YnHRmZ7LRPZo+poYGDBxFP8R/' crossorigin='anonymous'></script>
        </body>

        </html>";

    } else {
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        "; 
        include('headerkai.php');
        echo"

                        <main>
                            <hr>
                            <div class='alert alert-danger' role='alert'>
                                <h4 class='alert-heading'>Error!</h4>
                                <p>You cannot submit a FWA request without a supervisor.</p>
                                <hr>
                                <p class='mb-0'>Please contact HR if you have any questions.</p>
                            </div>

                    </div>
                </div>
                </main>
                <br>
            </div>
            <div class='col-md-1'></div>
            </div>
            </div>
            <div class='footer'>
                <small><i>Copyright &copy; 2023 HELP University</i></small>
            </div>

            <!-- jQuery -->
            <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>

            <!-- Bootstrap JS -->
            <script src='https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js' integrity='sha384-AZ+T2QJdAJlb+NPEZhG8JvPc7b2rmVBbdEaq+J1YnHRmZ7LRPZo+poYGDBxFP8R/' crossorigin='anonymous'></script>
        </body>

        </html>";
    }
}
?>