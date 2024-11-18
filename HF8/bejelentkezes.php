<?php
session_start();
include "mysql_connect.php";

if (($_SESSION['bejelentkezve'] ?? false)) {
    header('Location: listazas.php');
    die;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nev = trim($_POST['nev'] ?? '');
    $jelszo = trim($_POST['jelszo'] ?? '');

    $sql = "SELECT id, password FROM users WHERE username = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('s', $nev);
    $stmt->execute();

    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        $user = $res->fetch_assoc();
        if (password_verify($jelszo, $user['password'])) {
            $_SESSION['bejelentkezve'] = true;
            $_SESSION['nev'] = $nev;

            header('Location: listazas.php');
            die;
        }
    }
    echo 'Bejelentkezés nem sikerült: érvénytelen felhasználónév vagy jelszó!';
    $con->close();
    die;
}
?>

    <a href="listazas.php">Listázás</a>
    <h1>Bejelentkezes</h1>
    <form method="post">
        <table>
            <tr>
                <td><label for="nev">Név:</label></td>
                <td><input type="text" id="nev" name="nev"></td>
            </tr>
            <tr>
                <td><label for="jelszo">Jelszó:</label></td>
                <td><input type="password" id="jelszo" name="jelszo"></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <input type="submit" value="Bejelenkezem">
                </td>
            </tr>
        </table>
    </form>

<?php
$con->close();
