<?php
namespace SleepingOwl\Framework\Contracts;

use Illuminate\Config\Repository as ConfigRepository;
use SleepingOwl\Framework\Contracts\Auth\User as UserContract;

interface SleepingOwl
{
    /**
     * The SleepingOwl contexts.
     */
    const CTX_BACKEND = 'backend';
    const CTX_FRONTEND = 'frontend';
    const CTX_API = 'api';

    /**
     * Get the default JavaScript variables for Framework.
     *
     * @return array
     */
    public function scriptVariables(): array;

    /**
     * Получение версии фреймворка
     *
     * @return string
     */
    public function version(): string;

    /**
     * Получение название фреймворка
     *
     * @return string
     */
    public function name(): string;

    /**
     * Получение названия фреймворка с указанием версии
     *
     * @return string
     */
    public function longName(): string;

    /**
     * Получение настроек
     *
     * @return ConfigRepository
     */
    public function config(): ConfigRepository;

    /**
     * Get the base path of the SleepingOwl installation.
     *
     * @return string
     */
    public function basePath(): string;

    /**
     * Set the base path for the SleepingOwl framework.
     *
     * @param  string  $basePath
     * @return $this
     */
    public function setBasePath(string $basePath);

    /**
     * Добавление контекста в текущий запрос
     *
     * @param string|string[] ...$context
     *
     */
    public function setContext(string ...$context);

    /**
     * Если не переданы аргументы - получение списка контекстов для текущего запроса
     * При передачи аргументов, то проверка на наличие контекста
     *
     * @return bool|array
     */
    public function context();

    /**
     * URL префикс админ панели по умочанию
     *
     * @return string
     */
    public static function defaultUrlPrefix(): string;

    /**
     * URL префикс админ панели
     *
     * @return string
     */
    public function urlPrefix(): string;

    /**
     * Получение названия класса модели пользователя админ панели
     *
     * @return string
     */
    public static function userModel(): string;

    /**
     * Переопределение класса пользователя
     *
     * @param string $class
     * @return void
     */
    public static function setUserModel(string $class);

    /**
     * Получение объекта пользователя админ панели
     *
     * @return UserContract
     */
    public static function user(): UserContract;

    /**
     * Получение названия гарда для админ панели
     *
     * @return string
     */
    public static function guard(): string;

    /**
     * Получение настроек для гарда
     *
     * @return array
     */
    public static function guardConfig(): array;

    /**
     * Получение настроек провайдера для гарда
     *
     * @return array
     */
    public static function guardProvider(): array;
}