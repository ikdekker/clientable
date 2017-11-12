<style>
#customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;cursor: pointer}

#customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
}
</style>

<table id="customers">
    <tr>
        <th>id</th>
        <th>Voornaam</th>
        <th>Achter</th>
        <th>middel</th>
    </tr>
<?php

foreach ($clients as $client) {
    echo "<tr onclick=\"document.location = 'client/edit/" . $client->getId() . "';\">";
    echo "<td>" . $client->getId() . "</td>";
    echo "<td>" . $client->getFirstName() . "</td>";
    echo "<td>" . $client->getLastName() . "</td>";
    echo "<td>" . $client->getMiddleName() . "</td>";
    echo "</a></tr>";
}
?>
</table>