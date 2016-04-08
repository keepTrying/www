<?php
function arrayRecursive(&$array, $function, $apply_to_keys_also = false)
{
    static $recursive_counter = 0;
    if (++$recursive_counter > 1000) {
        die('possible deep recursion attack');
    }
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            arrayRecursive($array[$key], $function, $apply_to_keys_also);
        } else {
            $array[$key] = $function($value);
        }

        if ($apply_to_keys_also && is_string($key)) {
            $new_key = $function($key);
            if ($new_key != $key) {
                $array[$new_key] = $array[$key];
                unset($array[$key]);
            }
        }
    }
    $recursive_counter--;
}
// function JSON1($array) {
//     $array['status']='200';
//     arrayRecursive($array, 'urlencode', true);
//     $json = json_encode($array);
//     return urlencode($json);
    
// }
// function JSON2($error) {
//     $array = array('status' => $error);
//     arrayRecursive($array, 'urlencode', true);
//     $json = json_encode($array);
//     return urlencode($json);
// }

// function __call($name, $args)
// {
//     if ($name=='JSON') {
//         if(is_numeric($args[0]))
//             $this->JSON2($args[0]);
//         else
//             $this->JSON1($args[0]);
//     }
// }
function JSON($error) {
    if(is_numeric($error)){
        $array = array('status' => $error);
        arrayRecursive($array, 'urlencode', true);
        $json = json_encode($array);
        return urldecode($json);
    }else{
        $array = array('status' => '200');
        array_push($error,$array);
        arrayRecursive($error, 'urlencode', true);
        $json = json_encode($error);
        return urldecode($json);
    }
}


?>
