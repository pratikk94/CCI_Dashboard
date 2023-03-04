<?php include('includes/connect.php');
include('includes/secure.php');
error_reporting(0);
session_start();
$cciid = $_SESSION['cciid'];
$cid=$_GET['cid'];
$sql = "select * from tbl_child where cciid=$cciid and cid=$cid";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);

$alert=0;
if(isset($_GET['updatechild']))
{
    $cname = $_GET['cname'];
    $cid = $_GET['cid'];
    $cage = $_GET['cage'];
    $has_tablet = $_GET['has_tablet'];
    $admission_date = $_GET['admission_date'];
    $cbirthcertificate = $_GET['birth_certificate'];
    $cgender = $_GET['cgender'];
    $cwsn = $_GET['cwsn'];
    $cschool = $_GET['cschool'];
    $cenroll = $_GET['cenroll'];
    $cciid = $_SESSION['cciid'];
    $cciname = $_GET['cciname'];
    $query = sprintf("update tbl_child set cciid='%s', cciname='%s', cname='%s', cage='%s', cgender='%s', cwsn='%s', 
        cschool='%s',cenroll='%s',has_tablet='%s',admission_date='%s',birth_certificate='%s' where cid='%s'",
        $cciid,
        mysqli_real_escape_string($conn, $cciname),
        mysqli_real_escape_string($conn, $cname),
        mysqli_real_escape_string($conn, $cage),
        mysqli_real_escape_string($conn, $cgender),
        mysqli_real_escape_string($conn, $cwsn),
        mysqli_real_escape_string($conn, $cschool),
        mysqli_real_escape_string($conn, $cenroll),
        mysqli_real_escape_string($conn, $has_tablet),
        mysqli_real_escape_string($conn, $admission_date),
        mysqli_real_escape_string($conn, $cbirthcertificate),
        mysqli_real_escape_string($conn, $cid)
    );

    $res = mysqli_query($conn, $query);
    // Check connection
    if (!$res) {
        echo "ERROR: Could not able to execute $query . " . mysqli_error($conn);
        echo "<script>location . href = 'dashboard.php' </script>";
    } else {
        header("location: update_child_record.php?cciid=$cciid&cid=$cid");
    }

}
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
                                    <h3>Update Child Record</h3>
                                    <form class="pt-3" action="?" method="GET">
                                        <div class="form-group">
                                            <label <?=$cname=($data['cname']=="")?"style='color: red;'":"" ?>>Name of the Child*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend bg-transparent">
                                                </div>
                                                <input type="text" class="form-control form-control-lg border-left-0"
                                                       name="cname" value="<?=$data['cname']?>" placeholder="Child Name" required>
                                                <input hidden type="text" class="form-control form-control-lg border-left-0"
                                                       name="cid" value="<?=$cid?>">
                                            </div>

                                            <label <?=$cage=($data['cage']=="")?"style='color: red;'":"" ?>>Age of the Child*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend bg-transparent">
                                                </div>
                                                <input type="number" class="form-control form-control-lg border-left-0"
                                                       value="<?=$data['cage']?>" required name="cage">
                                            </div>

                                            <label <?=$gender=($data['cgender']=="")?"style='color: red;'":"" ?>>Gender of the child*</label>
                                            <select class="form-control form-control-lg" id="exampleFormControlSelect2"
                                                    required  name="cgender">
                                                <option value="" <?=$gender=($data['cgender']=="")?"selected":"" ?>>Please Select</option>
                                                <option value="Male"<?= $gender=($data['cgender']=="Male")? "selected":"" ?>>Male</option>
                                                <option value="Female" <?= $gender=($data['cgender']=="Female")? "selected":"" ?>>Female</option>
                                                <option value="Transgender" <?= $gender=($data['cgender']=="Transgender")? "selected":"" ?>>Transgender</option>
                                            </select>

                                            <label <?=$admission_date=($data['admission_date']=="")?"style='color: red;'":"" ?>>Date of Admission in CCI*</label>
                                            <input type="date" class="form-control form-control-lg border-left-0"
                                                   placeholder="Admission Date" required  value="<?=$data['admission_date']?>" name="admission_date">


                                            <label <?=$birth_certificate=($data['birth_certificate']=="")?"style='color: red;'":"" ?>>Does the child have a birth certificate ?*</label>
                                            <select class="form-control form-control-lg" id="exampleFormControlSelect2"
                                                    required  name="birth_certificate">
                                                <option value="" <?=$birth_certificate=($data['birth_certificate']=="")?"selected":"" ?>>Please Select</option>
                                                <option value="NA" <?=$birth_certificate=($data['birth_certificate']=="NA")?"selected":"" ?>>Information Not Available</option>
                                                <option value="Yes" <?=$birth_certificate=($data['birth_certificate']=="Yes")?"selected":"" ?>>Yes</option>
                                                <option value="No" <?=$birth_certificate=($data['birth_certificate']=="No")?"selected":"" ?>>No</option>
                                            </select>

                                            <label <?=$cwsn=($data['cwsn']=="")?"style='color: red;'":"" ?>>Does the child have any kind of disability or the child is with
                                                special needs? </label>
                                            <select class="form-control form-control-lg" id="exampleFormControlSelect2"
                                                    name="cwsn" required >
                                                <option value="" <?=$cwsn=($data['cwsn']=="")?"selected":"" ?>>Please Select</option>
                                                <option value="Yes" <?=$cwsn=($data['cwsn']=="Yes")?"selected":"" ?>>Yes</option>
                                                <option value="No" <?=$cwsn=($data['cwsn']=="No")?"selected":"" ?>>No</option>
                                            </select>

                                            <label <?=$has_tablet=($data['has_tablet']=="")?"style='color: red;'":"" ?>> Is the child using a tablet ?</label>
                                            <select required class="form-control form-control-lg" id="exampleFormControlSelect2"
                                                    name="has_tablet" required >
                                                <option value="" <?=$has_tablet=($data['has_tablet']=="")?"selected":"" ?>>Please Select</option>
                                                <option value="1" <?=$has_tablet=($data['has_tablet']=="1")?"selected":"" ?>>Yes</option>
                                                <option value="0" <?=$has_tablet=($data['has_tablet']=="0")?"selected":"" ?>>No</option>
                                            </select>

                                            <label <?=$cschool=($data['cschool']=="")?"style='color: red;'":"" ?> >Name of School, if child not enrolled in school or has dropped out,
                                                write 'NA'</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend bg-transparent">
                                   </div>
                                                <input type="text" class="form-control form-control-lg border-left-0"
                                                       placeholder="School Name" name="cschool" value="<?=$data['cschool']?>" required>
                                            </div>

                                            <label <?=$cenroll=($data['cenroll']=="")?"style='color: red;'":"" ?> >Please select the grade in which the child is enrolled at school. If
                                                the child had dropped out of school, select the standard in which child
                                                was last enrolled </label>
                                            <select class="form-control form-control-lg" id="exampleFormControlSelect2"
                                                    name="cenroll" required >
                                                <?=trim($data['cenroll']," ")?>
                                                <option value="" <?=$cenroll=($data['cenroll']=="")?"":"selected" ?>>Please Select</option>
                                                <option value="Child never enrolled in school" <?=$cenroll=(trim($data['cenroll'])==" Child never enrolled in school ")?"":"selected" ?>>Child never enrolled in school</option>
                                                <option value="Standard XII" <?=$cenroll=($data['cenroll']=="Standard XII")?"selected":"" ?>>Standard XII</option>
                                                <option value="Standard XI" <?=$cenroll=($data['cenroll']=="Standard XI")?"selected":"" ?>>Standard XI</option>
                                                <option value="Standard X" <?=$cenroll=($data['cenroll']=="Standard X")?"selected":"" ?>>Standard X</option>
                                                <option value="Standard IX" <?=$cenroll=($data['cenroll']=="Standard IX")?"selected":"" ?>>Standard IX</option>
                                                <option value="Standard VIII" <?=$cenroll=($data['cenroll']=="Standard VIII")?"selected":"" ?>>Standard VIII</option>
                                                <option value="Standard VII" <?=$cenroll=($data['cenroll']=="Standard VII")?"selected":"" ?>>Standard VII</option>
                                                <option value="Standard VI" <?=$cenroll=($data['cenroll']=="Standard VI")?"selected":"" ?>>Standard VI</option>
                                                <option value="Standard V" <?=$cenroll=($data['cenroll']=="Standard V")?"selected":"" ?>>Standard V</option>
                                                <option value="Standard IV" <?=$cenroll=($data['cenroll']=="Standard IV")?"selected":"" ?>>Standard IV</option>
                                                <option value="Standard III" <?=$cenroll=($data['cenroll']=="Standard III")?"selected":"" ?>>Standard III</option>
                                                <option value="Standard II" <?=$cenroll=($data['cenroll']=="Standard II")?"selected":"" ?>>Standard II</option>
                                                <option value="Standard I" <?=$cenroll=($data['cenroll']=="Standard I")?"selected":"" ?>>Standard I</option>
                                                <option value="Kindergarden" <?=$cenroll=($data['cenroll']=="Kindergarden")?"selected":"" ?>> Kindergarden</option>
                                            </select>
                                        </div>
                                        <input type="hidden" name="cciid" value="<?php echo $cciid ?>"/>
                                        <?php
                                        $sql = "select cciname from tbl_user where cciid=$cciid";
                                        $result = mysqli_query($conn, $sql);
                                        $data = mysqli_fetch_assoc($result);
                                        ?>
                                        <input type="hidden" name="cciname" value="<?php echo $data['cciname']; ?>"/>
                                        <div class="mt-3">
                                            <button class="btn btn-outline-primary " name="updatechild" onclick="return confirm('Are you sure you want to update the child record?')">
                                                Update
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
