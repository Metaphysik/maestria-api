<?php

/* @var $framework \Sohoa\Framework\Framework */

// Defines the defaults route
$this->get('/', ['as' => 'root', 'to' => 'Main#index']);              // Help message
$this->any('/login', ['as' => 'login', 'to' => 'Main#Login']);      // user: foo, pass: bawa

//$this->resource('etablissement');

// Need Etablissement key (Ekey)
$this->resource('user', ['only' =>  ['index', 'show']]);

$evaluation = $this->resource('evaluation', ['only' => ['index', 'show']]);
$eval = clone $evaluation;
$evaluation->resource('question', ['only' => ['index', 'show']]);
$eval->resource('answer', ['only' => ['index', 'show']]);

// 
// $this->resource('classroom');

// No Ekey
// $this->resource('theme');
// $this->resource('domain');
// $this->resource('know');

/* Error Handler */

$err = $this->getFramework()->getErrorHandler();
$err->handleErrorsAsException();
$err->routeError(\Sohoa\Framework\ErrorHandler::ROUTE_ALL_ERROR, 'Error#Default');
$err->routeError(\Sohoa\Framework\ErrorHandler::ROUTE_ERROR_404, 'Error#Err404');
$err->routeError('\ErrorException', 'Error#PHP');
