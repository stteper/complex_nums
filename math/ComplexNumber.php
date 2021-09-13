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
     * @throws \Math\Exceptions\ComplexNumberException
     */
    public function __construct($re = 0, $im =0)
    {
        if(is_nan($re) || is_nan($im)) {
            throw new \Math\Exceptions\ComplexNumberException('Invalid value of the real or imaginary part!');
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
        $re_str = $this->re !== 0 ? round($this->re,3) : '';
        $im_str = ($this->im < 0 ? '-' : '+') .'j'. abs($this->im);
        $res = $re_str . ($this->im !== 0 ? $im_str : '');
        if($res === '') {
            $res = '0';
        }
        if($res[0] === '+') {
            $res = substr($res, 1);
        }
        return $res;
    }


    /**
     * @param string $name
     * @return mixed
     * @throws \Math\Exceptions\ComplexNumberException
     */
    public function __get(string $name)
    {
        if(!in_array($name, ['re', 'im'])) {
            throw new \Math\Exceptions\ComplexNumberException('The property '.htmlentities($name) .'isn\'t available for complex numbers!');
        }

        return $this->$name;
    }

    /**
     * Checking the number for zero
     * @return bool
     */
    public function isZero()
    {
        return $this->re === 0 && $this->im === 0;
    }


    /**
     * Adding a number/numbers to the current one
     * @param array|Int|Float|ComplexNumber $numbers
     * @return ComplexNumber
     * @throws \Math\Exceptions\ComplexNumberException
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
            if($number instanceof ComplexNumber ) {
                $this->re += $number->re;
                $this->im += $number->im;
                continue;
            }
            if(is_nan($number)) {
                throw new \Math\Exceptions\ComplexNumberException('Invalid value '. $number .'!');
            }
            $this->re += $number;
        }
        return $this;
    }

    /**
     * Subtracting a number/numbers to the current one
     * @param array|Int|Float|ComplexNumber $numbers
     * @return ComplexNumber
     * @throws \Math\Exceptions\ComplexNumberException
     */
    public function sub($numbers): ComplexNumber
    {
        if(!is_array($numbers)) {
            $numbers = [$numbers];
        }
        foreach($numbers as $number) {
            if(!$number) {
                continue;
            }
            if($number instanceof ComplexNumber ) {
                $this->re -= $number->re;
                $this->im -= $number->im;
                continue;
            }
            if(is_nan($number)) {
                throw new \Math\Exceptions\ComplexNumberException('Invalid value '. $number .'!');
            }
            $this->re -= $number;
        }
        return $this;
    }

    /**
     * Multiplying a number/numbers to the current one
     * @param array|Int|Float|ComplexNumber $numbers
     * @return ComplexNumber
     * @throws \Math\Exceptions\ComplexNumberException
     */
    public function mul($numbers): ComplexNumber
    {
        if($this->isZero()) {
            return $this;
        }
        if(!is_array($numbers)) {
            $numbers = [$numbers];
        }
        foreach($numbers as $number) {
            if($number === 0) {
                $this->re = 0;
                $this->im = 0;
                return $this;
            }
            if($number instanceof ComplexNumber ) {
                $re = $this->re;
                $this->re = $this->re * $number->re - $this->im * $number->im;
                $this->im = $re * $number->im + $this->im * $number->re;
                continue;
            }
            if(is_nan($number)) {
                throw new \Math\Exceptions\ComplexNumberException('Invalid value '. $number .'!');
            }
            $this->re *= $number;
            $this->im *= $number;
        }
        return $this;
    }

    /**
     * Division of the current number by a given one/ones
     * @param array|Int|Float|ComplexNumber $numbers
     * @return ComplexNumber
     * @throws \Math\Exceptions\ComplexNumberException
     */
    public function div($numbers): ComplexNumber
    {
        if($this->isZero()) {
            return $this;
        }
        if(!is_array($numbers)) {
            $numbers = [$numbers];
        }
        foreach($numbers as $number) {
            if(!$number) {
                throw new \Math\Exceptions\ComplexNumberException('Divizion by zero! Given number is zero or not set!');
            }
            if($number instanceof ComplexNumber ) {
                $re = $this->re;
                $denumenator = sqr($number->re) + sqr($this->im);
                $this->re = ($this->re * $number->re + $this->im * $number->im) / $denumenator;
                $this->im = ($this->im * $number->re - $re * $number->im) / $denumenator;
                continue;
            }
            if(is_nan($number)) {
                throw new \Math\Exceptions\ComplexNumberException('Invalid value '. $number .'!');
            }
            $this->re /= $number;
            $this->im /= $number;
        }
        return $this;
    }
}