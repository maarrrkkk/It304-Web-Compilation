<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "jmaguilar";

$connection = new mysqli($servername, $username, $password, $database);

$name = "";
$email = "";
$phone = "";
$address = "";
$weight = "";
$height = "";
$facebook_link = "";
$gmail = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $weight = $_POST["weight"];
    $height = $_POST["height"];
    $facebook_link = $_POST["facebook_link"];
    $gmail = $_POST["gmail"];

    do {
        if (empty($name) || empty($email) || empty($phone) || empty($address) || empty($weight) || empty($height) || empty($gmail)) {
            $errorMessage = "All fields except Facebook link are required";
            break;
        }

        $sql = "INSERT INTO staff (name, email, phone, address, weight, height, facebook_link, gmail) " .
               "VALUES ('$name', '$email', '$phone', '$address', '$weight', '$height', '$facebook_link', '$gmail')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $name = "";
        $email = "";
        $phone = "";
        $address = "";
        $weight = "";
        $height = "";
        $facebook_link = "";
        $gmail = "";

        $successMessage = "Staff added correctly";

        header("location: index.php");
        exit;

    } while (false);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-transparent">
    <div class="container my-5">
        <h2>New Staff</h2>

        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>

        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control <?php echo (!empty($nameError) ? 'is-invalid' : ''); ?>" name="name" value="<?php echo $name; ?>">
                    <div class="invalid-feedback"><?php echo $nameError; ?></div>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control <?php echo (!empty($emailError) ? 'is-invalid' : ''); ?>" name="email" value="<?php echo $email; ?>">
                    <div class="invalid-feedback"><?php echo $emailError; ?></div>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Phone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Weight</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="weight" value="<?php echo $weight; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Height</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="height" value="<?php echo $height; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Facebook Link</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="facebook_link" value="<?php echo $facebook_link; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Gmail</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="gmail" value="<?php echo $gmail; ?>">
                </div>
            </div>

            <?php
            if (!empty($successMessage)) {
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>
           
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-6">
                    <button class="btn btn-success" type="submit">Submit</button>
                    <a href="index.php" class="btn btn-outline-danger ms-2" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
