<?php

# tova sa pulni gluosti po nadolu
/* Брой върхове в графа */
$n = 14;

$multyGraph = array(
    array(0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
    array(1, 0, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0),
    array(0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0),
    array(0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0),
    array(0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0),
    array(0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0),
    array(0, 0, 0, 0, 1, 1, 0, 0, 0, 1, 0, 0, 0, 0),
    array(0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0),
    array(0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 1),
    array(0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0),
    array(0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0),
    array(0, 0, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0),
    array(0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1),
    array(0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0)

);

/* Oбхождане в ширина от даден връх със запазване на предшественика */
$used;
$pred;

function CycleMatrix($i)
{

    global $n;
    global $used;
    global $pred;
    global $multyGraph;


    $queue = array();

    # set queue
    for ($k = 0; $k < $n; $k++) {
        $queue[$k] = 0;
    }

    $queue[0] = $i;
    $used[$i] = 1;

    $currentVert = 0;
    $levelVert = 1;
    $queueEnd = 1;

    /* докато опашката не е празна */
    while ($currentVert < $queueEnd) {

        /* p - вземаме поредния елемент от опашката */
        for ($p = $currentVert; $p < $levelVert; $p++) {
            $currentVert++;

            #270 stranica
            /* за всеки необходен наследник j на queue[p] */
            for ($j = 0; $j < $n; $j++) {
                if ($multyGraph[$queue[$p]][$j] && !$used[$j]) {

                    $queue[$queueEnd++] = $j;
                    $used[$j] = 1;
                    $pred[$j] = $queue[$p];
                }
            }
            $levelVert = $queueEnd;

        }

    }
}
function check($start, $end)
{

    global $n;

    # reset arrays
    global $used;
    global $pred;
    for ($k = 0; $k < $n; $k++) {
        $used[$k] = 0;
        $pred[$k] = -1;
    }

    CycleMatrix($start);

    #echo "Final stats: <pre>";
    #print_r($pred);
    #print_r($used);

    if ($pred[$end] > -1) {
        echo "The path is: \r\n";
        print_r($pred);
    } else {
        echo "well shit";
    }

}

check(0,9);
