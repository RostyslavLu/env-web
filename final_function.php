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

    //function to create new table with waged grades

    function calculatePercentage($students) {
        foreach ($students as $id => $student) {
            //for ($i=1; $i < 3; $i++) { 
                //for ($j=0; $j < count($students[0]); $j++) { 
                    //echo $students[$i][$j];
                //}
                
            //}
            $newStudent = array();
            $newStudent[] = $student[0];
            $newStudent[] = $student[1];
            $newStudent[] = $student[2];
            $firstExamPercentage = ($student[1][0] / 100) * 0.2;
            $secondExamPercentage = ($student[1][1] / 100) * 0.2;
            $thirdExamPercentage = ($student[2][0] / 100) * 0.25;
            $fourthExamPercentage = ($student[2][1] / 100) * 0.35;
            $totalPercentage = $firstExamPercentage + $secondExamPercentage + $thirdExamPercentage + $fourthExamPercentage;
            $newStudent[] = array(round($firstExamPercentage * 100), round($secondExamPercentage * 100));
            $newStudent[] = array(round($thirdExamPercentage * 100), round($fourthExamPercentage * 100));
            $newStudents[$id] = $newStudent;
        }
        return $newStudents;
    }

    //function for displaying statistical table of exercises and examinations
    
    function findMinMaxGrades($newStudents) {

        $arrayEvaluation = [];
        
        foreach ($newStudents as $key => $value) {
            $arrayEvaluation[$key] = [$value[0], array_merge($value[1], $value[2])];
        }
        $tasks = ["Exercice 1", "Exercice 2", "Examen Intra", "Examen Final"];
        foreach ($tasks as $task) {
            echo '<div>';
            echo '<h4>' . $task . '</h4>';
            
            //store estimates for the current task in a other array
            $grades = [];
            
            foreach ($arrayEvaluation as $student_id => $data) {
                $student_name = $data[0][0] . " " . $data[0][1];
                $student_grade = $data[1][array_search($task, $tasks)];
                $grades[$student_id] = [
                    "name" => $student_name,
                    "grade" => $student_grade,
                ];
            }
            
            //maximum and minimum grades
            $max_grade = max(array_column($grades, "grade"));
            $min_grade = min(array_column($grades, "grade"));
            
            //statistics maximum grades for each exercice
            echo '<strong>' . 'Max grade: ' . '</strong>'  . $max_grade . '<br>';
            foreach ($grades as $student_id => $data) {
                if ($data["grade"] == $max_grade) {
                    echo "ID: " . $student_id . ", Name: " . $data["name"] . '<br>';
                }
            }
            //statistics average grades for each exercice
            echo '<strong>' . 'Min grade: ' . '</strong>'  . $min_grade . '<br>';
            foreach ($grades as $student_id => $data) {
                if ($data["grade"] == $min_grade) {
                    echo "ID: " . $student_id . ", Name: " . $data["name"] . '<br>';
                }
            }
            //statistics average grades for each exercice
            $sumGrades=0;
            foreach ($grades as $student_id => $data) {
                $sumGrades+=$data["grade"];
            }
            echo '<strong>' . 'Average: ' . '</strong>' . '<br>' . round($sumGrades/count($arrayEvaluation), 2);
            echo '</div>';
        }
        
    }

    //function for displaying statistical table for students and group average

    function showTable($newStudents){
        echo '<section>';
        echo "<table>";
        echo '<caption>' . 'Students statistics' . '</caption>';
        echo "<thead>" . "<tr>" . "<th>" . "ID" . "</th>" . "<th>" . "Name" . "</th>" . "<th>" . "Surname" . "</th>" . "<th>" . "Exercice 1" . "</th>" . "<th>" . "Exercice 2" . "</th>" . "<th>" . "Examen intra" . "</th>" . "<th>" . "Examen final" . "</th>" . "<th>" . "Weighted grades" . "</th>" .  "<th>" . "Total weighted grade" . "</th>" .  "<th>" . "Grade" . "</th>" .  "<th>" . "Result" . "</th>" . "<th>" . "Max grade" . "</th>" . "<th>" . "Min grade" . "</th>" . "</tr>";
        echo "</thead>";
        echo "<tbody>";
        $avgGr=0;
        foreach ($newStudents as $id => $data) {
            if (count($data[0])!=2) {
                echo 'Error';
                return;
            } 
            if (count($data[1])!=2) {
                echo 'Error';
                return;
            } 
            if (count($data[2])!=2) {
                echo 'Error';
                return;
            } 
            $name = $data[0][0];
            $surname = $data[0][1];
            $grades = [];
                for ($i = 3; $i < count($data); $i++) {
                    $grades = array_merge($grades, $data[$i]);
                }
                $gradeFinal = (array_sum($grades));
                if ($gradeFinal > 90 ) {
                    $gradeStudent='A';
                    $result='success';
                }
                elseif ($gradeFinal<89 && $gradeFinal>80) {
                    $gradeStudent='B';
                    $result='success';
                }
                elseif ($gradeFinal<79 && $gradeFinal>70) {
                    $gradeStudent='C';
                    $result='success';
                }
                elseif ($gradeFinal<69 && $gradeFinal>60) {
                    $gradeStudent='D';
                    $result='success';
                }
                elseif ($gradeFinal<59 && $gradeFinal>1) {
                    $gradeStudent='E';
                    $result='failure';
                }
                $avgGr+=$gradeFinal;
                $evStudents=[];
                
                for ($i=1; $i < 3; $i++) {                 
                    for ($j=0; $j < count($data[$i]); $j++) {
                        $evStudents[]=$data[$i][$j];
                    }
                }
            echo "<tr><td>" . $id . "</td><td>" . $name . "</td><td>" . $surname . "</td><td>" . $data[1][0] . "</td><td>" . $data[1][1] . "</td><td>" . $data[2][0] . "</td><td>" . $data[2][1] . "</td><td>" . implode(" - ", $grades) . "</td><td>" . $gradeFinal . "</td><td>" . $gradeStudent . "</td><td>" . $result . "</td><td>" . max($evStudents) . "</td><td>" . min($evStudents) . "</td></tr>";   
        }
        echo "</tbody>";
        echo "</table>" ;
        echo '<h4>' . 'Group average weighted grade: ' . round($avgGr/count($newStudents),2) . '</h4>'; 
        echo '</section>';
        echo '</main>';
    }
    ?>