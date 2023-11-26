<?php

// Boekingsgegevens opslaan in een tekstbestand
function saveBooking($userId, $timeslot) {
    $bookings = json_decode(file_get_contents('bookings.json'), true);

    // Controleer of het tijdsot beschikbaar is
    foreach ($bookings as $booking) {
        if ($booking['timeslot'] == $timeslot) {
            return false; // Tijdslot bezet
        }
    }

    // Voeg nieuwe boeking toe
    $bookings[] = ['userId' => $userId, 'timeslot' => $timeslot];
    file_put_contents('bookings.json', json_encode($bookings));

    return true; // Boeking succesvol
}

// Gebruikersgegevens ophalen uit een tekstbestand
function getUsers() {
    return json_decode(file_get_contents('users.json'), true);
}

// Boekingsgegevens ophalen uit een tekstbestand
function getBookings() {
    return json_decode(file_get_contents('bookings.json'), true);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boekingssysteem</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body class="container mt-5">

<h2>Boekingsformulier</h2>
<form action="process_booking.php" method="post">
    <div class="form-group">
        <label for="userId">Gebruiker:</label>
        <input class="form-control" name="userId" id="userId">
    </div>

    <div class="form-group">
        <label for="timeslot">Tijdslot:</label>
        <select class="form-control" name="timeslot" id="timeslot">
            <option value="09:00-10:00">09:00 - 10:00</option>
            <option value="10:00-11:00">10:00 - 11:00</option>
            <option value="11:00-12:00">11:00 - 12:00</option>
            <option value="12:00-13:00">12:00 - 13:00</option>
            <option value="13:00-14:00">13:00 - 14:00</option>
            <option value="14:00-15:00">14:00 - 15:00</option>
            <option value="15:00-16:00">15:00 - 16:00</option>
            <option value="16:00-17:00">16:00 - 17:00</option>
            <option value="17:00-18:00">17:00 - 18:00</option>


        </select>
    </div>

    <button type="submit" class="btn btn-primary">Boek</button>
</form>

<h2 class="mt-5">Alle Boekingen</h2>
<ul class="list-group">
    <?php
    $bookings = getBookings();
    foreach ($bookings as $booking) {
        echo "<li class='list-group-item'>{$booking['userId']} heeft geboekt voor {$booking['timeslot']}</li>";
    }
    ?>
</ul>
</body>
</html>

