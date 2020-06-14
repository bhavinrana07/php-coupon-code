<?php

class CodeGenerator
{
    private $length;
    private $prefix;
    private $noOfCodes;
    private $capitalize;

    function __construct($length = 10, $prefix = NULL, $noOfCodes = NULL, $capitalize = true)
    {
        $lenthAfterPrefix = (empty($prefix) ? $length : $length - strlen($prefix));
        $this->length = $lenthAfterPrefix;
        $this->prefix = $prefix;
        $this->noOfCodes = $noOfCodes;
        $this->capitalize = $capitalize;
    }

    /**
     * Get Single Code
     *
     * @return void
     */
    public function getCode()
    {
        try {
            $string = substr(md5(uniqid(rand(), true)), 1, $this->length);
            $string = empty($this->prefix) ? $string : $this->prefix . $string;
            return empty($this->capitalize) ? $string : strtoupper($string);
        } catch (Exception $e) {
            exit('Caught exception: ' . $e->getMessage()); // TODO show formatted message to user
        }
    }

    /**
     * Get Multiple Codes
     *
     * @return void
     */
    public function getCodes()
    {
        if (empty($this->noOfCodes)) return false;
        $codes = [];
        do {
            $code = $this->getCode();
            if (!in_array($code, $codes)) $codes[] = $code;
        } while (count($codes) < $this->noOfCodes);

        return $codes;
    }
}
