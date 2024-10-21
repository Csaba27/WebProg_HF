<?php

$errors = [];
$firstName = '';
$lastName = '';
$email = '';
$attend = [];
$terms = false;
$abstract = false;
$tshirt = '';

if (isset($_POST['submit'])) {

    $firstName = trim($_POST['firstName'] ?? '');
    $lastName = trim($_POST['lastName'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $attend = $_POST['attend'] ?? '';
    $tshirt = $_POST['tshirt'];
    $abstract = $_FILES['abstract'] ?? false;
    $terms = isset($_POST['terms']);

    if ($firstName == '') {
        $errors[] = 'First name is empty!';
    }

    if ($lastName === '') {
        $errors[] = 'Last name is empty!';
    }

    if ($email === '') {
        $errors[] = 'E-mail is empty!';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'E-mail address is invaid!';
        $email = '';
    }

    if (empty($attend) || !is_array($attend)) {
        $errors[] = 'One attend is required!';
        $attend = [];
    }

    if (!$abstract || $abstract['name'] === '' || !is_uploaded_file($abstract['tmp_name'])) {
        $errors[] = 'Abstract file not uploaded!';
    } else if ($abstract['error'] === UPLOAD_ERR_OK) {
        $mime_type = mime_content_type($abstract['tmp_name']);

        if ($mime_type !== 'application/pdf') {
            $errors[] = 'Abstract is not .pdf!';
        } else if ($abstract['size'] > 3 * 1024 * 1024) {
            $errors[] = "File size must be less than 3MB!";
        }
    }

    if (!$terms) {
        $errors[] = 'Terms is required!';
    }
}

?>

    <h3>Online conference registration</h3>

<?php

if (empty($errors) && isset($_POST['submit'])) {
    echo '<h3>Registration details</h3>';
    echo '<p>First Name: ' . htmlspecialchars($firstName) . '</p>';
    echo '<p>Last Name: ' . htmlspecialchars($lastName) . '</p>';
    echo '<p>Email: ' . htmlspecialchars($email) . '</p>';
    echo '<p>Attend: ' . implode(', ', $attend) . '</p>';
    echo '<p>T-shirt Size: ' . htmlspecialchars($tshirt) . '</p>';
    echo '<p>Abstract file uploaded: ' . htmlspecialchars($abstract['name']) . '</p>';
} else {
    foreach ($errors as $error) {
        echo '<p style="color:red;">' . $error . '</p>';
    }
}

?>

    <form method="post" action="" enctype="multipart/form-data">
        <label for="fname"> First name:
            <input type="text" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>">
        </label>
        <br><br>
        <label for="lname"> Last name:
            <input type="text" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>">
        </label>
        <br><br>
        <label for="email"> E-mail:
            <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
        </label>
        <br><br>
        <label for="attend"> I will attend:<br>
            <input type="checkbox" name="attend[]"
                   value="Event1" <?php echo(in_array('Event1', $attend) ? 'checked' : ''); ?>>Event 1<br>
            <input type="checkbox" name="attend[]"
                   value="Event2" <?php echo(in_array('Event2', $attend) ? 'checked' : ''); ?>>Event2<br>
            <input type="checkbox" name="attend[]"
                   value="Event3" <?php echo(in_array('Event3', $attend) ? 'checked' : ''); ?>>Event2<br>
            <input type="checkbox" name="attend[]"
                   value="Event4" <?php echo(in_array('Event4', $attend) ? 'checked' : ''); ?>>Event3<br>
        </label>
        <br><br>
        <label for="tshirt"> What's your T-Shirt size?<br>
            <select name="tshirt">
                <option value="P"<?php echo($tshirt === 'P' ? ' selected' : ''); ?>>Please select</option>
                <option value="S"<?php echo($tshirt === 'S' ? ' selected' : ''); ?>>S</option>
                <option value="M"<?php echo($tshirt === 'M' ? ' selected' : ''); ?>>M</option>
                <option value="L"<?php echo($tshirt === 'L' ? ' selected' : ''); ?>>L</option>
                <option value="XL"<?php echo($tshirt === 'XL' ? ' selected' : ''); ?>>XL</option>
            </select>
        </label>
        <br><br>
        <label for="abstract"> Upload your abstract<br>
            <input type="file" name="abstract"/>
        </label>
        <br><br>
        <label>
            <input type="checkbox" name="terms" value="" <?php echo($terms ? 'checked' : ''); ?>>
        </label>I agree to terms &
        conditions.<br>
        <br><br>
        <input type="submit" name="submit" value="Send registration"/>
    </form>

<?php
