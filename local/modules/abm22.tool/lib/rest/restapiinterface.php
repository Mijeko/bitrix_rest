<?php

namespace Abm22\Tool\Rest;

interface RestApiInterface
{
    public function actionIndex();

    public function actionCreate($params);

    public function actionUpdate($id, $params);

    public function actionDelete($id);

    public function actionView($id);
}