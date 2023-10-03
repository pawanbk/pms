<?php
use core\Auth;
use core\Session;

function prettyArray($array){
    echo "<pre>";
    return print_r($array);
}

function assets(string $path){
    return ROOT_URL.$path;
}

function formatDate($date){
    $date = strtotime($date);
    return date('d M Y', $date);
}

function capital($string){
    return ucfirst($string);
}

function displayMsg(){
    if(Session::exists('success')){
        echo "<script>
            Swal.fire({
                title: 'Success!',
                text: '".Session::flash('success')."',
                icon: 'success',
                confirmButtonText: 'Ok'
            })
        </script>";
    }
}

function redirect($path){
    echo "<script> window.location.href ='".ROOT_URL.$path."'</script>"; exit;
//    header("Location:".ROOT_URL.$path);
}

function hasError($key, $errors = []){
    return $errors[$key] ?? false;
}

function error($key, $error =[]){
    return $error[$key][0] ?? '';
}

function old($key,$old){
    return $old[$key] ?? '';
}

function isAssoc(array $arr)
{
    if (array() === $arr) return false;
    return array_keys($arr) !== range(0, count($arr) - 1);
}

function cellColor(int $status, $due){
    $color ='';
    $curDate = date('Y-m-d');
    if($status === 1){
        $color = 'table-success';
    } 
    elseif($status === 0 && $due < $curDate){
        $color = 'table-danger';
    } 
    else{
        $color = '';
    }

    return $color;
}

function goBack(){
    echo `<script>
            document.getElementById("goBack").addEventListener("click", function(){
                history.back();
            });
        </script>`;
}