<?php

namespace Core;

class Template {
    private $__content = null;
    public function run($content, $data = []){
        extract($data);
        if(!empty($content)){
            $this->__content = $content;

            $this->printEntities();
            $this->printRaw();
            $this->ifCodition();
            $this->phpBegin();
            $this->phpEnd();
            $this->forLoop();
            $this->whileLoop();
            $this->forEachLoop();
        
            eval('?> ' . $this->__content . '<?php ');     
        }
    }
    public function printEntities(){
        preg_match_all('~{{\s*(.+?)\s*}}~is', $this->__content, $matches);
        if(!empty($matches[1])){
            foreach($matches[1] as $key => $item){
                $htmlentities = '<?php echo htmlentities(' . $item . '); ?>';
                $this->__content = str_replace($matches[0][$key], $htmlentities, $this->__content);
                
            }
        } 
    }
    public function printRaw(){
        preg_match_all('~{!\s*(.+?)\s*!}~is', $this->__content, $matches);
        if(!empty($matches[1])){
            foreach($matches[1] as $key => $item){
                $this->__content = str_replace($matches[0][$key], '<?php echo ' . $item . '; ?>', $this->__content);
                
            }
        } 
    }

    public function ifCodition(){   
        preg_match_all('~@if\s*\((.+?)\s*\)\s*$~im', $this->__content, $matches);
        if(!empty($matches[1])){
            foreach($matches[1] as $key => $item){
                $this->__content = str_replace($matches[0][$key], '<?php if('.$item.'): ?>', $this->__content);
            }
        } 

        preg_match_all('~@else\s*$~im', $this->__content, $matches);
        if(!empty($matches[0])){
            foreach($matches[0] as $key => $item){
                $this->__content = str_replace($matches[0][$key], '<?php else: ?>', $this->__content);
            }
        } 

        preg_match_all('~@endif\s*$~im', $this->__content, $matches);
        if(!empty($matches[0])){
            foreach($matches[0] as $key => $item){
                $this->__content = str_replace($matches[0][$key], '<?php endif; ?>', $this->__content);
            }
        } 
    }
    public function phpBegin(){
        //@php
        preg_match_all('~@php\s*$~im', $this->__content, $matches);
        if(!empty($matches[0])){
            foreach($matches[0] as $key => $item){
                $this->__content = str_replace($matches[0][$key], '<?php ', $this->__content);
            }
        }
    }
    public function phpEnd(){
        //@endphp
        preg_match_all('~@endphp\s*$~im', $this->__content, $matches);
        if(!empty($matches[0])){
            foreach($matches[0] as $key => $item){
                $this->__content = str_replace($matches[0][$key], ' ?>', $this->__content);
            }
        }
    }
    public function forLoop(){
        // @for($i = 0; $i < 10; $i++)
        preg_match_all('~@for\s*\((.+?)\s*\)\s*$~im', $this->__content, $matches);
        if(!empty($matches[1])){
            foreach($matches[1] as $key => $item){
                $this->__content = str_replace($matches[0][$key], '<?php for('.$item.'): ?>', $this->__content);
            }
        }

        // @endfor
        preg_match_all('~@endfor\s*$~im', $this->__content, $matches);
        if(!empty($matches[0])){
            foreach($matches[0] as $key => $item){
                $this->__content = str_replace($matches[0][$key], '<?php endfor; ?>', $this->__content);
            }
        }
    }

    public function whileLoop(){
        // @while($i < 10)
        preg_match_all('~@while\s*\((.+?)\s*\)\s*$~im', $this->__content, $matches);
        if(!empty($matches[1])){
            foreach($matches[1] as $key => $item){
                $this->__content = str_replace($matches[0][$key], '<?php while('.$item.'): ?>', $this->__content);
            }
        }

        // @endwhile
        preg_match_all('~@endwhile\s*$~im', $this->__content, $matches);
        if(!empty($matches[0])){
            foreach($matches[0] as $key => $item){
                $this->__content = str_replace($matches[0][$key], '<?php endwhile; ?>', $this->__content);
            }
        }
    }
    public function forEachLoop(){
        // @foreach($items as $item)
        preg_match_all('~@foreach\s*\((.+?)\s*\)\s*$~im', $this->__content, $matches);
        if(!empty($matches[1])){
            foreach($matches[1] as $key => $item){
                $this->__content = str_replace($matches[0][$key], '<?php foreach('.$item.'): ?>', $this->__content);
            }
        }

        // @endforeach
        preg_match_all('~@endforeach\s*$~im', $this->__content, $matches);
        if(!empty($matches[0])){
            foreach($matches[0] as $key => $item){
                $this->__content = str_replace($matches[0][$key], '<?php endforeach; ?>', $this->__content);
            }
        }
    }
}
