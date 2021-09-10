<?php


namespace Math;


class ComplexNumber
{
    private $re = 0;
    private $im = 0;

    /**
     * ComplexNumber constructor.
     * @param int $re
     * @param int $im
     * @throws ComplexNumberException
     */
    public function __construct($re = 0, $im =0)
    {
        if(is_nan($re) || is_nan($im)) {
            throw new ComplexNumberException('Invalid value of the real or imaginary part!');
        }
        $this->re = $re;
        $this->im = $im;
    }

    /**
     * Get string view
     * @return string
     */
    public function __toString(): string
    {
        $im_str = ($this->im < 0 ? '-' : '+') .'j'+ $this->im;
        return $this->re . ($this->im !== 0 ? $im_str : '');
    }


    /**
     * @param string $name
     * @return mixed
     * @throws ComplexNumberException
     */
    public function __get(string $name)
    {
        if(!in_array($name, ['re', 'im'])) {
            throw new ComplexNumberException('The property '.htmlentities($name) .'isn\'t available for complex numbers!');
        }

        return $this->$name;
    }


    /**
     * Adding a number/numbers to the current one
     * @param array|Int|Float|ComplexNumber $numbers
     * @return ComplexNumber
     */
    public function add($numbers): ComplexNumber
    {
        if(!is_array($numbers)) {
           $numbers = [$numbers];
        }
        foreach($numbers as $number) {
            if(!$number) {
                continue;
            }
            if($number instanceof __CLASS__ ) {
                $this->re += $number->re;
                $this->im += $number->im;
                continue;
            }
            if(is_nan($number)) {
                throw new ComplexNumberException('Invalid value '. $number .'!');
            }
            $this->re += $number;
        }
        return $this;
    }



}

class ComplexNumberException  extends \Exception
{

}