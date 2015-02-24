<?php

/* @var $framework \Sohoa\Framework\Framework */

// Defines the defaults route
$this->get('/', ['as' => 'root', 'to' => 'Main#index']);            // Help message
$this->any('/login', ['as' => 'login', 'to' => 'Main#Login']);      // user: foo, pass: bawa

//$this->resource('etablissement');

// Need Etablissement key (Ekey)
$this
	->resource('user', 			['only' =>  ['index', 'show']])
	->resource('evaluation', 	['only' =>  ['index', 'show']]) 	// TEST iT
	->resource('answer', 		['only' =>  ['index']]) 	// TEST iT
;
	

$evaluation = $this->resource('evaluation', ['only' => ['index', 'show']]);

$eval = clone $evaluation; // Création d'une bifurcation

$evaluation->resource('question', ['only' => ['index', 'show']]); 	// TEST iT
$eval->resource('answer', ['only' => ['index']]); 			// TEST iT

// 
$this->resource('classroom', ['only' => ['index', 'show']]);

// No Ekey
$this->resource('theme', ['only' => ['index', 'show']]);
$this->resource('domain', ['only' => ['index', 'show']]);
// $this->resource('know', ['only' => ['index', 'show']]);

/* Error Handler */

$err = $this->getFramework()->getErrorHandler();
$err->handleErrorsAsException();
$err->routeError(\Sohoa\Framework\ErrorHandler::ROUTE_ALL_ERROR, 'Error#Default');
$err->routeError(\Sohoa\Framework\ErrorHandler::ROUTE_ERROR_404, 'Error#Err404');
$err->routeError('\ErrorException', 'Error#PHP');
