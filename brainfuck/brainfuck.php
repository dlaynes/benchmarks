<?php

//Not finished

class Tape {
    public $pos = 0;
    public $tape = [];

    public function inc(){
        ++$this->tape[$this->pos];
    }

    public function dec(){
        --$this->tape[$this->pos];
    }

    public function advance(){
        ++$this->pos;
        if(count($this->tape) <= $this->pos ){
            $this->tape[] = 0;
        }
    }

    public function devance(){
        if($this->pos > 0){
            --$this->pos;
        }
    }

    public function get(){
        return $this->tape[$this->pos];
    }
}

class Program {
    public $code = '';
    public $bracket_map = [];

    function __construct($code){
        $pc = $i = 0;
        $leftstack = [];
        
        while (isset($code[$i])) {

            $c = $code[$i];
            if( strpos('+-<>[].,', $c) === FALSE ) {
                continue;
            }
            if($c==='['){
                $leftstack[] = $pc;
            } elseif($c===']' && count($leftstack) > 0 ){
                $left = array_pop($leftstack);

                $this->bracket_map[$pc] = $left;
                $this->bracket_map[$left] = $pc;
            }
            $this->code += $c;
            ++$pc;

            ++$i;
        }

    }

    function run(){
        $pc = $i = 0;
        $tape = new Tape();

        while (isset($this->code[$i])) {

            switch($this->code[$i]){
                case '+':
                    $tape->inc();
                    break;
                case '-':
                    $tape->dec();
                    break;
                case '>':
                    $tape->advance();
                    break;
                case '<':
                    $tape->devance();
                    break;
                case '[':
                    if($tape->get()===0){
                        $pc = $this->bracket_map[$pc];
                    }
                    break;
                case ']':
                    if($tape->get()!==0){
                        $pc = $this->bracket_map[$pc];
                    }
                    break;
                case '.':
                    $chr =chr($tape->get());
                    echo $chr ? $chr : '?';
                    break;
                default:
                    break;
            }
            ++$pc;
            ++$i;
        }
    }

}

$file = '';

if(isset($argv[1])){
    $file = file_get_contents($argv[1]);
    $pr = new Program($file);
    $pr->run();
    echo "\n";
}