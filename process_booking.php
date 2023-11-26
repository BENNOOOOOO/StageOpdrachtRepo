<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['userId'];
    $timeslot = $_POST['timeslot'];

    // Voer boeking uit en geef goed of foutmelding 
    require_once 'index.php';
    if (saveBooking($userId, $timeslot)) {
        echo 'Boeking succesvol.';
    } else {
        echo 'Het gekozen tijdslot is bezet. Kies een ander tijdslot.';
    }
} else {
    header('Location: index.php'); // Voorkomt toegang tot script
}

?>
