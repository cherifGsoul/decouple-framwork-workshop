<?php

use Illuminate\Http\Request;

Route::post('/api/todos/add', 'Todo\Infrastructure\Framework\Laravel\Http\Controller\Todo@add');
Route::post('/api/todos/mark-as-done', 'Todo\Infrastructure\Framework\Laravel\Http\Controller\Todo@markAsDone');
Route::post('/api/todos/reopen', 'Todo\Infrastructure\Framework\Laravel\Http\Controller\Todo@reopen');
