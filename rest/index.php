<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

if (!CModule::IncludeModule('abm22.tool')) throw new Exception('Модуль good.begin не подключен');

$rest = new \Abm22\Tool\Rest\RestApi();
try {
    $rest->handle();
} catch (Exception $exception) {
    \Abm22\Tool\Rest\Response::badRequest($exception->getMessage());
}
