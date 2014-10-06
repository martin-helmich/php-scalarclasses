<?php
namespace Helmich\Scalars\Types;


class Integer
{



    private $int;



    public function __construct($int)
    {
        if ($int instanceof Integer)
        {
            $int = $int->toPrimitive();
        }
        $this->int = $int;
    }



    public function toPrimitive()
    {
        return $this->int;
    }

} 