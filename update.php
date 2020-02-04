<?php
include 'functions.php';

if (
    !empty($_POST) && !empty($_POST['id_stanza']) &&
    controlla_dati_stanza($_POST['numero_stanza'], $_POST['piano'], intval($_POST['letti']))
) {
    // recuperare i dati della stanza da salvare
    $numero_stanza = intval($_POST['numero_stanza']);
    $piano = intval($_POST['piano']);
    $letti = intval($_POST['letti']);
    $id_stanza = intval($_POST['id_stanza']);

    // salvare la stanza nel db
    $sql = "UPDATE stanze SET room_number = $numero_stanza, floor = $piano, beds = $letti, updated_at = NOW() WHERE id = $id_stanza";
    $result = esegui_query($sql);
} else {
    $result = false;
}
if ($result) {
    $get_message = '?success=true&id_stanza=' . $id_stanza;
} else {
    $get_message = '?success=false&id_stanza=' . $id_stanza;
}

// visualizzare un messaggio di conferma => redirect con parametro GET
header('Location: edit.php' . $get_message);
