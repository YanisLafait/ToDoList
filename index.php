<?php

// Initialisation de la liste des tâches
$tasks = array();

// Traitement du formulaire d'ajout de tâche
if (isset($_POST['add_task'])) {
    $task = array(
        'name' => $_POST['name'],
        'date' => $_POST['date']
    );

    // Ajout de la tâche à la liste des tâches
    $tasks[] = $task;
}

// Traitement de la suppression de tâche automatique
    if (isset($_GET['delete'])) {
    $index = $_GET['delete'];
    unset($tasks[$index]);
    $tasks = array_values($tasks);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>To-Do-List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Mise en forme responsive */
        @media (max-width: 600px) {
            .container {
                width: 100%;
            }
            .task {
                width: 100%;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h1>To-Do-List</h1>
    <!-- création du formulaire -->
    <form method="post">
        <input type="text" name="name" placeholder="Nom de la tâche">
        <input type="date" name="date" placeholder="Date limite">
        <input type="submit" name="add_task" value="Ajouter">
    </form>

    <ul>
        <?php
        // Affichage de la liste des tâches avec une boucle
        foreach ($tasks as $index => $task) {
            if(time() > strtotime($task['date'])) {
                unset($tasks[$index]);
            } else {
                echo '<li class="task">' . $task['name'] . ' <a href="?delete=' . $index . '">Supprimer</a></li>';
            }
        }
        ?>
    </ul>
</div>
</body>
</html>
