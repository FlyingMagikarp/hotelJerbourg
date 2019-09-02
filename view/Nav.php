<?php
function getNavbar(){
    return ('
    <h1>Hotel Jerbourg</h1>
    <a href="/hotelJerbourg"><button class="btn">Home</button></a>
    <a href="/hotelJerbourg/View/View_GuestOverview.php"><button class="btn">Guests</button></a>
    <a href="/hotelJerbourg/View/View_RoomOverview.php"><button class="btn">Rooms</button></a>
    <a href="/hotelJerbourg/View/View_ReservationsOverview.php"><button class="btn">Reservations</button></a>
    <a href="/hotelJerbourg/View/View_Reports.php"><button class="btn">Reports</button></a>
    ');
}
?>