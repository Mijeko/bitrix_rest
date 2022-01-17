<?php

namespace Abm22\Tool\Classes;

class FlashMessages
{
    public static function saveMessage(string $message)
    {
        $_SESSION['FLASH_MESSAGE'] = $message;
    }
}