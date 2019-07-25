<?php


namespace StudentList\helpers;


class Marker
{
    /**
     * @var string
     */
    private $regexp;

    /**
     * Marker constructor.
     * @param $reg
     */
    public function __construct($reg)
    {
        $this->regexp = preg_quote($reg, "/");
    }

    /**
     * @param $text
     * @return string|string[]|null
     */
    public function mark($text)
    {

        if ($this->regexp) {

            preg_match("/$this->regexp/iu", $text, $matches);

            foreach ($matches as $match) {

                return preg_replace("~$match~u", "<span class='text-marker'>$match</span>", $text);
            }
        } else {
            return $text;
        }
    }
}