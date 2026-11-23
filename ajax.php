<?php
session_start();
require_once 'get-data.php';

if (!isset($_SESSION['classes_data'])) {
    $_SESSION['classes_data'] = generateClasses();
}

$action = $_GET['action'] ?? '';

if ($action === 'get_class' && isset($_GET['class'])) {
    $className = $_GET['class'];
    if (isset($_SESSION['classes_data'][$className])) {
        echo "<ul>";
        foreach ($_SESSION['classes_data'][$className] as $student) {
            echo "<li>" . htmlspecialchars($student) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Nem létező osztály.</p>";
    }
} elseif ($action === 'get_all') {
    foreach ($_SESSION['classes_data'] as $className => $students) {
        echo "<h3>" . htmlspecialchars($className) . "</h3><ul>";
        foreach ($students as $student) {
            echo "<li>" . htmlspecialchars($student) . "</li>";
        }
        echo "</ul>";
    }
}