<?php
session_start();
require_once 'get-data.php';
if (!isset($_SESSION['classes_data'])) {
    $_SESSION['classes_data'] = generateClasses();
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Iskolanévsor</title>
</head>
<body>

    <nav>
        <ul>
            <li><button id="btn-all">Teljes iskolanévsor</button></li>
            <li>
                <label for="classSelect">Osztály szerinti névsor: </label>
                <select id="classSelect">
                    <option value="">Válasszon osztályt<option>
                    <?php foreach (array_keys($_SESSION['classes_data']) as $className): ?>
                        <option value="<?php echo htmlspecialchars($className); ?>"><?php echo htmlspecialchars($className); ?></option>
                    <?php endforeach; ?>
                </select>
            </li>
        </ul>
    </nav>
    <hr>
    <div id="content"></div>

    <script src="app.js"></script>
</body>
</html>