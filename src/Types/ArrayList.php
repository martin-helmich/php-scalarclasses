<?php
namespace Helmich\Scalars\Types;


class ArrayList implements \Iterator, \ArrayAccess
{



    private $arr;



    public function __construct($arr)
    {
        $this->arr = $arr;
    }



    public function append($item)
    {
        $this->arr[] = $item;
    }



    public function map($function)
    {
        return new ArrayList(array_map($function, $this->arr));
    }



    public function mapWithKey($function)
    {
        $items = [];
        foreach ($this->arr as $key => $value)
        {
            $items[$key] = call_user_func($function, $key, $value);
        }
        return new ArrayList($items);
    }



    public function filter($function)
    {
        return new ArrayList(array_filter($this->arr, $function));
    }



    public function join($glue)
    {
        return new String(implode($glue, $this->arr));
    }



    /**
     * @param $index
     * @param $value
     * @return ArrayList
     */
    public function set($index, $value)
    {
        $this->arr[$index] = $value;
        return $this;
    }



    /**
     * @param int|string $index
     * @return \Helmich\Scalars\Types\String
     */
    public function getString($index)
    {
        $item = $this->arr[$index];
        if (!$item instanceof String)
        {
            $item = new String($item);
        }
        return $item;
    }



    public function length()
    {
        return count($this->arr);
    }



    public function contains($element)
    {
        return in_array($element, $this->arr);
    }



    public function current()
    {
        return current($this->arr);
    }



    public function next()
    {
        next($this->arr);
    }



    public function key()
    {
        return key($this->arr);
    }



    public function valid()
    {
        return $this->current() !== FALSE;
    }



    public function rewind()
    {
        reset($this->arr);
    }



    public function offsetExists($offset)
    {
        return isset($this->arr[$offset]);
    }



    public function offsetGet($offset)
    {
        return $this->arr[$offset];
    }



    public function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
    }



    public function offsetUnset($offset)
    {
        unset($this->arr[$offset]);
    }

}