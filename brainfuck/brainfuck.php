<?php

class Tape {
    public $pos = 0;
    public $tape = [0];

    public function inc(){
        $this->tape[$this->pos] += 1;
    }

    public function dec(){
        $this->tape[$this->pos] -= 1;
    }

    public function advance(){
        $this->pos += 1;
        if(count($this->tape) <= $this->pos ){
            $this->tape[] = 0;
        }
    }

    public function devance(){
        if($this->pos > 0){
            $this->pos -= 1;
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
        $pc = 0;
        $leftstack = [];
        
        foreach (str_split($code) as $c ) {

            if( strpos('+-<>[].,', $c) === FALSE ) {
                continue;
            }
            $this->code .= $c;

            if($c=='['){
                $leftstack[] = $pc;
            } elseif($c==']' && count($leftstack) > 0 ){
                $left = array_pop($leftstack);
                $right = $pc;

                $this->bracket_map[$right] = $left;
                $this->bracket_map[$left] = $right;
            }
            ++$pc;
        }

    }

    function run(){
        $pc = 0;
        $tape = new Tape();

        while (isset($this->code[$pc])) {
            switch($this->code[$pc]){
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
                    echo chr($tape->get());
                    break;
                default:
                    break;
            }
            ++$pc;
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