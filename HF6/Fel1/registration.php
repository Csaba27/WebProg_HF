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

    $url = 'form.php?submit';
    $url .= '&firstName=' . urlencode($firstName);
    $url .= '&lastName=' . urlencode($lastName);
    $url .= '&email=' . urlencode($email);
    $url .= '&' . http_build_query(['attend' => $attend]);
    $url .= '&tshirt=' . urlencode($tshirt);
    $url .= '&abstract=' . urlencode($abstract ? $abstract['name'] : '');
    $url .= '&terms=' . ($terms ? 1 : 0);
    $url .= '&' . http_build_query(['errors' => $errors]);

    header ('Location: ' . $url);
}
