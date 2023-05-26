<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Students statistics</title>
</head>
<body>
    <header>
        <h2>Students statistics</h2>
    </header>

    <main>

    <?php
    /*
    * 582-11B-MA Épreuve Finale
    * Etudiant : Rostyslav Luchyshyn - 2395286
    */
    /*Entrées:
    *- tableaux des étudiants en format Id/Matricule=>((Prenom et Nom) (Travail 1 et Travail 2) (Examen Intra et Examen Final))
    *Sorties
    *- statistique de la group des étudiants 
    */


    $name=$_POST['user_name'];
    $surname=$_POST['user_surname'];
    echo '<article>';
    echo '<h2>' . 'Hello ' . $name . ' ' . $surname . '!' .  '</h2>';
    echo '</article>';
    //array students grades
    $students = [
        1000 => [["Name1", "Student1"], [100, 50], [80, 60]],
        1001 => [["Name2", "Student2"], [70, 80], [90, 70]],
        1002 => [["Name3", "Student3"], [80, 80], [50, 80]],
        1003 => [["Name4", "Student4"], [50, 60], [50, 80]],
        1004 => [["Name5", "Student5"], [35, 55], [50, 30]],
        1005 => [["Name6", "Student6"], [95, 90], [50, 80]],
        1006 => [["Name7", "Student7"], [80, 70], [50, 80]],
        1007 => [["Name8", "Student8"], [80, 70], [90, 80]],
        1008 => [["Name9", "Student9"], [45, 48], [40, 55]],
        1009 => [["Name10", "Student10"], [100, 100], [90, 95]],
        1010 => [["Name11", "Student11"], [0, 90], [95, 95]],
        1011 => [["Name12", "Student12"], [0, 90], [95, 95]]
    ];
  
    include 'final_function.php';
    $newStudents = calculatePercentage($students);

    echo '<section class=examination>';
    findMinMaxGrades($students);
    echo '</section>';

    $exercice1 = 0;
    $exercice2 = 0;
    $examen1 = 0;
    $examen2 = 0;
    $nombreSuccessEx1 = 0; 
    $nombreSuccessEx1 = 0;
    $nombreSuccessExIntra = 0;
    $nombreSuccessExFinal = 0;
    foreach ($newStudents as $id => $data) {
        $maxGrade = 0;
        $minGrade = 0;
        $gradesNotWaged = [];
        $name = $data[0][0];
        $surname = $data[0][1];
        $exercice1+=$data[1][0];
        $exercice2+=$data[1][1];
        $examen1+=$data[2][0];
        $examen2+=$data[2][1];
    }
    echo '<section>';

    $countExercice1Succsess = 0;
    $countExercice1Fail = 0;
    $countExercice2Succsess = 0;
    $countExercice2Fail = 0;
    $countExamen1Succsess = 0;
    $countExamen1Fail = 0;
    $countExamen2Succsess = 0;
    $countExamen2Fail = 0;
    foreach ($students as $id => $data) {

        if ($data[1][0]>59) {
            $countExercice1Succsess+=1;
        }
        else {
            $countExercice1Fail+=1;
        }

        if ($data[1][1]>59) {
            $countExercice2Succsess+=1;
        }
        else {
            $countExercice2Fail+=1;
        }

        if ($data[2][0]>59) {
            $countExamen1Succsess+=1;
        }
        else {
            $countExamen1Fail+=1;
        }

        if ($data[2][1]>59) {
            $countExamen2Succsess+=1;
        }
        else {
            $countExamen2Fail+=1;
        }
    }

    echo '<table>';
    echo '<caption>' . 'Examinations' . '</caption>';
    echo '<thead>' . '<tr>' . '<th>' . ' ' . '</th>' . '<th>' . 'Exercice 1' . '</th>' .  '<th>' . 'Exercice 2' . '</th>' . '<th>' . 'Examen intra' . '</th>' . '<th>' . 'Examen final' . '</th>' . '</tr>' . '</thead>';
    echo '<tbody>'. '<tr>' . '<td>' . 'Exercice succses' . '</td>' . '<td>' . $countExercice1Succsess . '</td>' .  '<td>' . $countExercice2Succsess . '</td>' . '<td>' . $countExamen1Succsess . '</td>' . '<td>' . $countExamen2Succsess . '</td>' . '</tr>';
    echo  '<tr>' . '<td>' . 'Exercice fail' . '</td>' . '<td>' . $countExercice1Fail . '</td>' .  '<td>' . $countExercice2Fail . '</td>' . '<td>' . $countExamen1Fail . '</td>' . '<td>' . $countExamen2Fail . '</td>' . '</tr>' . '</tbody>';
    echo '</table>';
    echo '</section>';

    // main table
    showTable($newStudents);
    ?>
    <footer>
        <h5>copyright</h5>
    </footer>
</body>
</html>