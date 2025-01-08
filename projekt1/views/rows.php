<?php foreach ($data as $i => $row) : ?>
    <tr id="row<?= $row['id']; ?>">
        <td><?= $row['id']; ?></td>
        <td><?= $row['imie']; ?></td>
        <td><?= $row['nazwisko']; ?></td>
        <td><?= $row['adres']; ?></td>
        <td><?= $row['email']; ?></td>
        <td>
            <!-- <a href="index.php?page=home&removePeopleID=<?= $row['id']; ?>">Usuń</a>
            <a href="index.php?page=home&editPeopleID=<?= $row['id']; ?>">Edytuj</a> -->
            <button id="deletebtn<?= $row['id']; ?>" class="btn btn-primary btn-sm deletebtn" onclick="deleteRow(<?= $row['id']; ?>)">Usuń</button>
            <button id="edit<?= $row['id']; ?>" class="btn btn-primary btn-sm" onclick="editRow(<?= $row['id']; ?>)">Edytuj</button>
        </td>
    </tr> 
<?php endforeach; ?>
 