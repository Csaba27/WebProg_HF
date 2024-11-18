<?php
session_start();
include "mysql_connect.php";

if (!($_SESSION['bejelentkezve'] ?? false)) {
    header('Location: bejelentkezes.php');
}

$id = intval($_GET['id'] ?? 0);

$sql = "SELECT * FROM hallgatok WHERE id = " . $id;
$res = $con->query($sql);

if (!$res->num_rows) {
    echo 'Hallgató nem létezik!';
    $con->close();
    die;
}
$hallgato = $res->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nev = trim($_POST['nev'] ?? '');
    $szak = trim($_POST['szak'] ?? '');
    $atlag = floatval($_POST['atlag'] ?? 0.0);

    $sql = "UPDATE hallgatok SET nev = ?, szak = ?, atlag = ? WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('ssdi', $nev, $szak, $atlag, $id);

    if ($stmt->execute() === true) {
        echo '<a href="listazas.php">Listázás</a> | <a href="bevitel.php">Bevitel</a>';
    } else {
        echo "Hiba a szerkesztés során: " . $con->error;
    }

    $stmt->close();
    $con->close();
    die;
}
?>
    <a href="listazas.php">Listázás</a>
    <h1>Hallató szerkesztése</h1>
    <form method="post">
        <input type="hidden" name="hozzaad" value="1">
        <table>
            <tr>
                <td><label for="nev">Név:</label></td>
                <td><input type="text" id="nev" name="nev"
                           value="<?php echo htmlspecialchars($hallgato['nev']); ?>"></td>
            </tr>
            <tr>
                <td><label for="szak">Szak:</label></td>
                <td><input type="text" id="szak" name="szak"
                           value="<?php echo htmlspecialchars($hallgato['szak']); ?>"></td>
            </tr>
            <tr>
                <td><label for="atlag">Átlag:</label></td>
                <td><input type="number" id="atlag" name="atlag"
                           value="<?php echo floatval($hallgato['atlag']); ?>" step="0.1"></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <input type="submit" value="Szerkesztés">
                </td>
            </tr>
        </table>
    </form>

<?php
$con->close();