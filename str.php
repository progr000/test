<?php

class Str
{
    public static function of($string)
    {
        return new Stringable($string);
    }

    public static function replace($search, $replace, $subject)
    {
        return str_replace($search, $replace, $subject);
    }

    public static function slug($title, $separator = '-', $language = 'en')
    {
        // Convert all dashes/underscores into separator
        $flip = $separator === '-' ? '_' : '-';

        $title = preg_replace('!['.preg_quote($flip).']+!u', $separator, $title);

        // Replace @ with the word 'at'
        $title = str_replace('@', $separator.'at'.$separator, $title);


        // Replace all separator characters and whitespace by a single separator
        $title = preg_replace('!['.preg_quote($separator).'\s]+!u', $separator, $title);

        return trim($title, $separator);
    }

    public static function length($value, $encoding = null)
    {
        if ($encoding) {
            return mb_strlen($value, $encoding);
        }

        return mb_strlen($value);
    }

}

class Stringable
{
    /**
     * The underlying string value.
     *
     * @var string
     */
    protected $value;

    /**
     * Create a new instance of the class.
     *
     * @param  string $value
     * @return void
     */
    public function __construct($value = '')
    {
        $this->value = (string)$value;
    }

    public function trim($characters = null)
    {
        return new static(trim(...array_merge([$this->value], func_get_args())));
    }

    public function replace($search, $replace)
    {
        return new static(Str::replace($search, $replace, $this->value));
    }

    public function slug($separator = '-', $language = 'en')
    {
        return new static(Str::slug($this->value, $separator, $language));
    }

    public function length($encoding = null)
    {
        return Str::length($this->value, $encoding);
    }

    /**
     * Get the raw string value.
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->value;
    }

    public function ret()
    {
        return (string) $this->value;
    }
}


$str = (string) Str::of('  Test 1 2 3')
    ->replace('1', 'one')
    ->trim()
    ->slug();
    //->ret();

var_dump($str);