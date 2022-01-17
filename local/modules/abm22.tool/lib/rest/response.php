<?php

namespace Abm22\Tool\Rest;

class Response
{
    const STATUS_OK = 200;
    const KEY_ITEMS = 'data';

    public static function emit_one(array $data)
    {
        global $APPLICATION;
        $APPLICATION->RestartBuffer();
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            'status' => self::STATUS_OK,
            self::KEY_ITEMS => $data,
        ]);
        exit();
    }

    public static function emit_create()
    {
        global $APPLICATION;
        $APPLICATION->RestartBuffer();
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            'status' => self::STATUS_OK
        ]);
        exit();
    }

    public static function emit_all(int $status, array $data)
    {

        global $APPLICATION;
        $APPLICATION->RestartBuffer();
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(
            array(
                'status' => $status,
                self::KEY_ITEMS => $data
            )
        );
        exit();
    }

    public static function badRequest(string $message)
    {
        global $APPLICATION;
        $APPLICATION->RestartBuffer();
        header('Content-Type: application/json; charset=utf-8');
        header('HTTP/1.0 400 Bad Request');
        echo json_encode(array(
            'error' => 'Bad Request',
            'message' => $message,
        ));
    }
}