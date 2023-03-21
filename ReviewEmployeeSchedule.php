<?php include 'header.php';
include 'db.php';
?>
                    <main>
                        <hr>
                        <h3>Review Employee Schedule</h3><br><hr>
                        <h3>Date Available</h3>
                    <form action="" method="post">
                    <select name="courseName">
                        <option value="">Available Date</option>
                        <?php 
                        $query ="SELECT 'employeeID', 'date' FROM dailySchedule WHERE ";
                        $result = $db->query($query);
                        if($result->num_rows> 0){
                            while($optionData=$result->fetch_assoc()){
                            $option =$optionData['date'];
                        ?>
                        <option value="<?php echo $option; ?>" ><?php echo $option; ?> </option>
                    <?php
                        }}
                        ?>
                    </select>
                    <input type="submit" name="submit">
                    </form>
                <br>
                <hr>
                <h3>Employee Supervised</h3>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" data-column="name" data-order="desc">Name </th>
                                <th scope="col" data-column="workLoc" data-order="desc">Work Location</th>
                                <th scope="col" data-column="workHrs" data-order="desc">Work Hours</th>
                                <th scope="col" data-column="workRep" data-order="desc">Work Report</th>
                            </tr>
                        </thead>
                        <tbody id="tableEmployee">
                        </tbody>
                    </table>
                </div>
                <br>
                <div>
                    <label for="comments">Comments: </label>
                    <input type="text" class="form-control form-control-sm" name="comments" id="comments" >
                </div>
                <br>
                <div>
                    <button type="submit" id="submit">Submit</button>
                </div>
                <br>
            
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