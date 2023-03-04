<?php include('includes/connect.php');
include('includes/secure.php');
error_reporting(0);
session_start();
$cciid = $_SESSION['cciid'];
?>
<?php include "header.php" ?>
<div class="container-fluid page-body-wrapper">
    <?php include "menu.php" ?>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="container-scroller">
                <div class="container-fluid page-body-wrapper full-page-wrapper">
                    <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
                        <div class="row flex-grow">
                            <div class="col-lg-12 d-flex align-items-center justify-content-center">
                                <div class="auth-form text-left p-3">
                                    <h3>Add New child </h3>
                                    <form class="pt-3" action="add_child_action.php" method="post">
                                        <div class="form-group">
                                            <label>Name of the Child*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend bg-transparent">
                                                </div>
                                                <input type="text" class="form-control form-control-lg border-left-0"
                                                       name="cname" placeholder="Child Name" required autofocus>
                                            </div>

                                            <label>Age of the Child*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend bg-transparent">
                                                </div>
                                                <input type="number" class="form-control form-control-lg border-left-0"
                                                       placeholder="Age" required autofocus name="cage">
                                            </div>

                                            <label>Gender of the child*</label>
                                            <select class="form-control form-control-lg" id="exampleFormControlSelect2"
                                                    required autofocus name="cgender">
                                                <option value="" >Please Select</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Transgender">Transgender</option>
                                            </select>

                                            <label>Date of Admission in CCI*</label>
                                            <input type="date" class="form-control form-control-lg border-left-0"
                                                   placeholder="Admission Date" required autofocus name="admission_date">


                                            <label>Does the child have a birth certificate ?*</label>
                                            <select class="form-control form-control-lg" id="exampleFormControlSelect2"
                                                    required autofocus name="birth_certificate">
                                                <option value="" selected>Please Select</option>
                                                <option value="NA">Information Not Available</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>

                                            <label>Does the child have any kind of disability or the child is with
                                                special needs? </label>
                                            <select class="form-control form-control-lg" id="exampleFormControlSelect2"
                                                    name="cwsn" required autofocus>
                                                <option value="" selected>Please Select</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>

                                            <label> Is the child using a tablet ?</label>
                                            <select required class="form-control form-control-lg" id="exampleFormControlSelect2"
                                                    name="has_tablet" required autofocus>
                                                <option value="" selected>Please Select</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>

                                            <label>Name of School, if child not enrolled in school or has dropped out,
                                                write 'NA'</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend bg-transparent">
                                   </div>
                                                <input type="text" class="form-control form-control-lg border-left-0"
                                                       placeholder="School Name" name="cschool" required autofocus>
                                            </div>

                                            <label>Please select the grade in which the child is enrolled at school. If
                                                the child had dropped out of school, select the standard in which child
                                                was last enrolled </label>
                                            <select class="form-control form-control-lg" id="exampleFormControlSelect2"
                                                    name="cenroll" required autofocus>
                                                <option value="" selected>Please Select</option>
                                                <option value="Child never enrolled in school"> Child never enrolled in
                                                    school
                                                </option>
                                                <option value="Standard XII">Standard XII</option>
                                                <option value="Standard XI">Standard XI</option>
                                                <option value="Standard X">Standard X</option>
                                                <option value="Standard IX">Standard IX</option>
                                                <option value="Standard VIII">Standard VIII</option>
                                                <option value="Standard VII">Standard VII</option>
                                                <option value="Standard VI">Standard VI</option>
                                                <option value="Standard V">Standard V</option>
                                                <option value="Standard IV">Standard IV</option>
                                                <option value="Standard III">Standard III</option>
                                                <option value="Standard II">Standard II</option>
                                                <option value="Standard I">Standard I</option>
                                                <option value="Kindergarden"> Kindergarden</option>
                                            </select>
                                        </div>
                                        <input type="hidden" name="cciid" value="<?php echo $cciid ?>"/>
                                        <?php
                                        session_start();
                                        $sql = "select cciname from tbl_user where cciid=$cciid";
                                        $result = mysqli_query($conn, $sql);
                                        $data = mysqli_fetch_assoc($result);
                                        ?>
                                        <input type="hidden" name="cciname" value="<?php echo $data['cciname']; ?>"/>

                                        <div class="mt-3">
                                            <button class="btn btn-outline-primary " name="addchild">
                                                Add Child
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>