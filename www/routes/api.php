<?php

include 'api/admin.api.php'; include 'api/auth.api.php'; include 'api/user.api.php'; include 'api/front.api.php';
Route::post('create-page', 'Conf\ConfigurationController@createPage');
