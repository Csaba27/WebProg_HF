<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztrációs űrlap</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>

<h2>Regisztrációs űrlap</h2>
<?php
$errors = [];
$name = $email = $password = $confirm_password = $birthdate = $gender = $country = '';
$interests = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST["name"]) || $_POST["name"] == '') {
        $errors[] = "A név megadása kötelező!";
    } else {
        $name = htmlspecialchars($_POST["name"]);
    }

    if (!isset($_POST["email"]) || $_POST["email"] == '') {
        $errors[] = "Az email cím megadása kötelező!";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Érvénytelen email formátum!";
    } else {
        $email = htmlspecialchars($_POST["email"]);
    }

    if (!isset($_POST["password"]) || $_POST["password"] == '') {
        $errors[] = "A jelszó megadása kötelező!";
    } elseif (!preg_match("/^(?=.*[A-Z])(?=.*[0-9])(?=.*[\W_]).{8,}$/", $_POST["password"])) {
        $errors[] = "A jelszónak legalább 8 karakter hosszúnak kell lennie, tartalmaznia kell egy nagybetűt, számot és speciális karaktert!";
    } else {
        $password = $_POST["password"];

        if (!isset($_POST["confirm_password"]) || $_POST["confirm_password"] == '') {
            $errors[] = "A jelszó megerősítése kötelező!";
        } elseif ($password !== $_POST["confirm_password"]) {
            $errors[] = "A két jelszó nem egyezik meg!";
        } else {
            $confirm_password = $_POST["confirm_password"];
        }
    }

    if (!isset($_POST["birthdate"]) || $_POST["birthdate"] == '') {
        $errors[] = "A születési dátum megadása kötelező!";
    } else {
        $birthdate = $_POST["birthdate"];
        if (!DateTime::createFromFormat('Y-m-d', $birthdate)) {
            $errors[] = "Érvénytelen dátum formátum!";
        }
    }

    if (!isset($_POST["gender"]) || $_POST["gender"] == '') {
        $errors[] = "A nem kiválasztása kötelező!";
    } else {
        $gender = $_POST["gender"];
    }

    if (!empty($_POST["interests"] ?? '')) {
        $interests = $_POST["interests"];
    }

    if (!empty($_POST["country"] ?? '')) {
        $country = $_POST["country"];
    }

    if (empty($errors)) {
        echo "<h3>Sikeres regisztráció!</h3>";
        echo "<p><strong>Név:</strong> $name</p>";
        echo "<p><strong>Email:</strong> $email</p>";
        echo "<p><strong>Születési dátum:</strong> $birthdate</p>";
        echo "<p><strong>Nem:</strong> $gender</p>";
        if (!empty($interests)) {
            echo "<p><strong>Érdeklődési területek:</strong> " . implode(", ", $interests) . "</p>";
        }
        if (!empty($country)) {
            echo "<p><strong>Ország:</strong> $country</p>";
        }
    }
}
?>

<?php if (!empty($errors)): ?>
    <div class="error">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="name">Név:</label><br>
    <input type="text" id="name" name="name" value="<?php echo $name; ?>"><br><br>

    <label for="email">E-mail cím:</label><br>
    <input type="text" id="email" name="email" value="<?php echo $email; ?>"><br><br>

    <label for="password">Jelszó:</label><br>
    <input type="password" id="password" name="password"><br><br>

    <label for="confirm_password">Jelszó megerősítése:</label><br>
    <input type="password" id="confirm_password" name="confirm_password"><br><br>

    <label for="birthdate">Születési dátum:</label><br>
    <input type="date" id="birthdate" name="birthdate" value="<?php echo $birthdate; ?>"><br><br>

    <label>Nem:</label><br>
    <input type="radio" id="male" name="gender" value="Férfi" <?php if ($gender == "Férfi") echo "checked"; ?>>
    <label for="male">Férfi</label><br>
    <input type="radio" id="female" name="gender" value="Nő" <?php if ($gender == "Nő") echo "checked"; ?>>
    <label for="female">Nő</label><br>
    <input type="radio" id="other" name="gender" value="Egyéb" <?php if ($gender == "Egyéb") echo "checked"; ?>>
    <label for="other">Egyéb</label><br><br>

    <label>Érdeklődési területek:</label><br>
    <input type="checkbox" name="interests[]" value="Sport" <?php if (in_array("Sport", $interests)) echo "checked"; ?>>
    Sport<br>
    <input type="checkbox" name="interests[]"
           value="Művészet" <?php if (in_array("Művészet", $interests)) echo "checked"; ?>> Művészet<br>
    <input type="checkbox" name="interests[]"
           value="Tudomány" <?php if (in_array("Tudomány", $interests)) echo "checked"; ?>> Tudomány<br><br>

    <label for="country">Ország:</label><br>
    <select id="country" name="country">
        <option value="">Válasszon országot</option>
        <option value="Magyarország" <?php if ($country == "Magyarország") echo "selected"; ?>>Magyarország</option>
        <option value="Románia" <?php if ($country == "Románia") echo "selected"; ?>>Románia</option>
        <option value="Ukrajna" <?php if ($country == "Ukrajna") echo "selected"; ?>>Ukrajna</option>
    </select><br><br>

    <input type="submit" value="Regisztráció">
</form>

</body>
</html>
