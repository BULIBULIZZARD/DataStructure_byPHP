<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/6
 * Time: 19:10
 */
require_once "arrayStack.php";
$stack  = new ArrayStack();
$string = "{}{}[]({[]})";
sizeof($string);
for ($i=0;$i<strlen($string);$i++){
    if ($string[$i]=='}'){
        echo 'pop'."\n";
        if ($stack->pop()!='{'){
            echo 'false';
            return false;
        }
        continue;
    }
    if ($string[$i]==']'){
        echo 'pop'."\n";
        if ($stack->pop()!='['){
            echo 'false';
            return false;
        }
        continue;
    }
    if ($string[$i]==')'){
        echo 'pop'."\n";
        if ($stack->pop()!='('){
            echo 'false';
            return false;
        }
        continue;
    }
    $stack->push($string[$i]);
    echo 'push'.$string[$i]."\n";
}
echo $stack->getSize();
if ($stack->getSize()==0){
    echo 'true';
    return true;
}else{
    echo 'false';
    return false;
}

