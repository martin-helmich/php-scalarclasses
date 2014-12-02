<?php
namespace Helmich\Scalars\Types;


class String extends AbstractScalar
{



    /**
     * @var string
     */
    private $str;



    public function __construct($str)
    {
        if ($str instanceof String)
        {
            $str = $str->toPrimitive();
        }
        $this->str = $str;
    }



    public function toLower()
    {
        return new String(strtolower($this->str));
    }



    public function toUpper()
    {
        return new String(strtoupper($this->str));
    }



    public function toCamelCase()
    {
        return new String(ucfirst($this->str));
    }



    public function replace($search, $replace)
    {
        return new String(str_replace($search, $replace, $this->str));
    }



    /**
     * @param string $pattern
     * @param string $replace
     * @return \Helmich\Scalars\Types\String
     */
    public function regexReplace($pattern, $replace)
    {
        return new String(preg_replace($pattern, $replace, $this->str));
    }



    public function regexMatch($pattern, &$matches = NULL)
    {
        return preg_match($pattern, $this->str, $matches);
    }



    public function split($glue)
    {
        return new ArrayList(array_map(function ($part) { return new String($part); }, explode($glue, $this->str)));
    }



    public function strip($characters = " \t\n\r\0\x0B")
    {
        return new String(trim($this->str, $characters));
    }



    public function stripRight($characters = " \t\n\r\0\x0B")
    {
        return new String(rtrim($this->str, $characters));
    }



    public function __toString()
    {
        return $this->str;
    }



    public function toPrimitive()
    {
        return $this->__toString();
    }



    public function subString($start, $length = NULL)
    {
        return new String(substr($this->str, $start, $length));
    }



    public function equals($compare)
    {
        return $this->str == "$compare";
    }



    public function startWith($start)
    {
        return $this->subString(0, strlen($start))->equals($start);
    }



    public function endsWidth($end)
    {
        return $this->subString(-strlen($end))->equals($end);
    }



    public function contains($substring)
    {
        return strpos($this->str, $substring) !== FALSE;
    }



    public function length()
    {
        return strlen($this->str);
    }



    public function append($string)
    {
        return new String($this->str . $string);
    }



}
