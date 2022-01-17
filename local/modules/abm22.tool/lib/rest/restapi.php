<?php

namespace Abm22\Tool\Rest;

use Bitrix\Main\Localization\Loc;

class RestApi
{

    public $routing = array(
        'equipment' => 'Abm22\Tool\Rest\Models\Equipment',
        'element' => 'Abm22\Tool\Rest\Models\Element',
        'basket' => 'Abm22\Tool\Rest\Models\Basket',
    );

    public function handle()
    {
        /* source from https://webdevkin.ru/posts/backend/restful-servis-na-nativnom-php*/
        $method = $_SERVER['REQUEST_METHOD'];
        $this->getFormData($method);

        $url = (isset($_GET['q'])) ? $_GET['q'] : '';
        $url = rtrim($url, '/');
        $urls = explode('/', $url);

        // Определяем роутер и url data
        $router = $urls[0];
        $urlData = array_slice($urls, 1);
        $class = $this->routing[$router];


        if (!class_exists($class)) throw new \Exception(Loc::getMessage('ABM22_TOOL_REST_API_NOT_FOUND_CLASS'));

        /* @var $object RestApiInterface */
        $object = new $class;

        if ($method === 'GET') {
            if (count($urlData) == 1) {
                $id = $urlData[0];
                $response = $object->actionView($id);
            } else {
                $response = $object->actionIndex();
            }

            Response::emit_all(Response::STATUS_OK, $response);
        }

        // Создание элемента
        if ($method === 'POST' && empty($urlData)) {
            try {
                $object->actionCreate($_POST);
                Response::emit_create();
            } catch (\Exception $exception) {
                Response::badRequest($exception->getMessage());
            }
        }

        // Редактирование элемента
        if ($method === 'PUT' && count($urlData) === 1) {
            $id = $urlData[0];
            $response = $object->actionUpdate($id, $_POST);
        }


        if ($method === 'DELETE' && count($urlData) === 1) {
            $id = $urlData[0];
            $response = $object->actionDelete($id);
        }


    }

    function getFormData($method)
    {
        // GET или POST: данные возвращаем как есть
        if ($method === 'GET') return $_GET;
        if ($method === 'POST') return $_POST;

        // PUT, PATCH или DELETE
        $data = array();
        $exploded = explode('&', file_get_contents('php://input'));

        foreach ($exploded as $pair) {
            $item = explode('=', $pair);
            if (count($item) == 2) {
                $data[urldecode($item[0])] = urldecode($item[1]);
            }
        }

        return $data;
    }
}