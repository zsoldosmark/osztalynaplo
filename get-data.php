<?php
require_once 'classroom-data.php';

function generateStudentnum() {
    return random_int(10, 15);
}

function generateLastnames() {
    $lastnames = [];
    $lastnamesCount = count(DATA['lastnames']);
    $studentnum = generateStudentnum();
    while (count($lastnames) < $studentnum) {
        $num = random_int(0, $lastnamesCount - 1);
        if (in_array($num, $lastnames)) {
            continue;
        }
        $lastnames[] = $num;
    }
    return $lastnames;
}

function generateFirstname() {
    $gender = random_int(0, 1); 
    if ($gender == 0) {
        $firstnameIndex = random_int(0, count(DATA['firstnames']['men']) - 1);
        $firstname = DATA['firstnames']['men'][$firstnameIndex];
    } else {
        $firstnameIndex = random_int(0, count(DATA['firstnames']['women']) - 1);
        $firstname = DATA['firstnames']['women'][$firstnameIndex];
    }
    return $firstname;
}

function stringStudent($lastnameIdx, $firstname) {
    $lastname = DATA['lastnames'][$lastnameIdx];
    return "{$lastname} {$firstname}";
}

function generateGrades() {
    $grades = [];
    foreach (DATA['subjects'] as $subject) {
        $grades[$subject] = random_int(1, 5);
    }
    return $grades;
}

function generateStudents() {
    $lastnames = generateLastnames();
    $students = [];
    foreach ($lastnames as $lastname) {
        $name = stringStudent($lastname, generateFirstname());
        $students[] = [
            'name' => $name,
            'grades' => generateGrades()
        ];
    }
    usort($students, function($a, $b) {
        return strcmp($a['name'], $b['name']);
    });
    return $students;
}

function generateClasses() {
    $classes = [];
    foreach (DATA['classes'] as $class) {
        $classes[$class] = generateStudents();
        sort($classes[$class]);
    }
    return $classes;
}