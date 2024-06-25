<?php

class VUtente{
    private $smarty;
    public function __construct()
    {
        $this->smarty = StartSmarty::configuration();
    }
}