<?php

class HtmlHelper {
    static function formOpen($method = 'GET', $action = '', $id = '', $class = ''){
        echo '<form method="' . $method . '" action="' . $action . '" id="' . $id . '" class="' . $class . '">';
    }

    static function formClose(){
        echo '</form>';
    }   

    static function input($wrapBefore = '', $type = 'text', $name = '', $class = '', $id = '', $placeholder = '',$value = '',  $wrapAfter = ''){ 
        echo $wrapBefore;
        echo '<input type="'.$type.'" name="'.$name.'" class="'.$class.'" id="'.$id.'" placeholder="'.$placeholder.'" value="'.$value.'">';
        echo $wrapAfter;
    }   

    static function button($wrapBefore = '', $type = 'button', $label = '', $class = '', $wrapAfter = ''){ 
        echo $wrapBefore;
        echo '<button type="'.$type.'" class="'.$class.'">'.$label.'</button>';
        echo $wrapAfter;
    }

    static function submit($wrapBefore = '', $label = '', $class = '', $wrapAfter = ''){
        echo $wrapBefore;
        echo '<button type="submit" class="'.$class.'">'.$label.'</button>';
        echo $wrapAfter;
    }

    static function element($wrapBefore = '', $tag = 'div', $class = '', $content = '', $wrapAfter = ''){
        echo $wrapBefore;
        echo '<'.$tag.' class="'.$class.'">'.$content.'</'.$tag.'>';
        echo $wrapAfter;
    }
}
?>