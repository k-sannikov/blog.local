<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Blog\BaseController as GuestBaseController;

/**
 * Базовый контроллер для всех контроллеров управления
 * блогом в панели администратора
 *
 * Должен быть родителем всех контроллеров управления блогом
 */
abstract class BaseController extends GuestBaseController
{
    /**
     * BaseController constructor
     */
    public function __construct() {
        // Инициализация общих моментов для админки
    }
}
