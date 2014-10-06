<?php
namespace Helmich\Scalars\Types;


class ArrayList
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

}