<?php
include('header.php');

if (!isset($_SESSION['user'])) {
    header('location:login.php');
}

$res = mysqli_query($con, "SELECT * FROM tbl_registration WHERE user_id='" . $_SESSION['user'] . "'");
$count = mysqli_num_rows($res);

if ($count == 1) {
    $row = mysqli_fetch_assoc($res);

    $user_id = $row['user_id'];
    $name = $row['name'];
    $email = $row['email'];
    $phone = $row['phone'];
    $age = $row['age'];
    $gender = $row['gender'];
}
?>

<div class="content">
    <div class="wrap">
        <div class="content-top">
            <div class="section group">
                <div class="about span_1_of_2">
                    <h3>MANAGE PROFILE</h3>
                    <?php include('msgbox.php'); ?>
                    <form action="" method="POST">
                        <table class="table table-bordered">
                            <tr>
                                <th>NAME</th>
                                <td>
                                    <input type="text" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $name; ?>">
                                    <input type="hidden" name="id" value="<?php echo $user_id; ?>">
                                </td>
                            </tr>
                            <tr>
                                <th>EMAIL</th>
                                <td>
                                    <input type="text"  name="email" value="<?php echo $email; ?>" >
                                </td>
                            </tr>
                            <tr>
                                <th>PHONE</th>
                                <td>
                                    <input type="text"  name="phone" value="<?php echo $phone; ?>" >
                                </td>
                            </tr>
                            <tr>
                                <th>AGE</th>
                                <td>
                                    <input type="text" name="age" value="<?php echo $age; ?>" >
                                </td>
                            </tr>
                            <tr>
                                <th>GENDER</th>
                                <td>
                                    <input type="text"  name="gender" value="<?php echo $gender; ?>" >
                                </td>
                            </tr>
                            <tr>
                                <th>PASSWORD</th>
                                <td>
                                <label for="forgotpassword"><a href="forgot.php">Click here to change password!</a></label>
                                </td>
                            </tr>
                        </table>
                        <input type="submit" name="submit" value="Update">
                    </form>
                </div>
                <?php include('movie_sidebar.php'); ?>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

<?php
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];

    $sql = "UPDATE tbl_registration SET
        name='$name',
        email='$email',
        phone='$phone',
        age='$age',
        gender='$gender'
        WHERE user_id='$id'";

    $res1 = mysqli_query($con, $sql);

    $sql2 = "UPDATE tbl_login SET
        username='$email'
        WHERE user_id='$id'";

    $res2 = mysqli_query($con, $sql2);
}
?>
