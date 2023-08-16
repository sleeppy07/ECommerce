<?php
abstract class Middlewares{

    public $db;

    abstract function handle();
    abstract function AdminAuthorized();
    abstract function UserAuthorized();
}