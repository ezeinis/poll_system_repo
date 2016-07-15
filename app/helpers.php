<?php

function flash($message,$type)
{
    $flash = app('App\Http\Flash');

    return $flash->message($message,$type);
}

function calculate_percentage($answers,$poll,$answer_id)
{

    $array = [];
    if($poll!=0){
    foreach ($answers as $answer) {
        $array[$answer->id] = round(($answer->submissions_counter/$poll),3)*100;
    }
    $max_duplicate=0;
    $sum=0;
    $temp_percentage_max = 0;
    $max_key=0;
    $temp_percentage_min = 100;
    $min_key=0;
    foreach ($array as $key => $percentage) {
        $sum+=$percentage;
        if($percentage>$temp_percentage_max){
            $temp_percentage_max=$percentage;
            $max_key=$key;
        }
    }
    foreach ($array as $key => $percentage) {
        if($key!=$max_key && $percentage==$array[$max_key]){
            $max_duplicate=1;
        }
    }
    foreach ($array as $key => $percentage) {
        if($percentage<$temp_percentage_min){
            $temp_percentage_min=$percentage;
            $min_key=$key;
        }
    }
    if($max_duplicate==0){
        if($sum>100){
            $array[$max_key]-=($sum-100);
        }else if($sum<100){
            $array[$max_key]+=(100-$sum);
        }
    }else{
        if($array[$min_key]!=0){
            if($sum>100){
            $array[$min_key]-=($sum-100);
            }else if($sum<100){
                $array[$min_key]+=(100-$sum);
            }
        }
    }
    }
    return $array[$answer_id];
}

?>
