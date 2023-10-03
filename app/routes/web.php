<?php

use app\controllers\AuthController;
use app\controllers\ProjectController;
use app\controllers\RegisterController;
use app\controllers\MilestoneController;
use app\controllers\Task\MainController;
use app\controllers\Task\TypeController;
use app\controllers\ResetPasswordController;
use app\controllers\ForgetPasswordController;

// register routes
$app->router->get('/register',[RegisterController::class,'index']);
$app->router->post('/register',[RegisterController::class,'store']);

// login and logout
$app->router->get('/login',[AuthController::class,'login']);
$app->router->post('/login',[AuthController::class,'authenticate']);
$app->router->get('/logout',[AuthController::class,'logout']);

// forget Password and resetPassword
$app->router->get('/forget-password',[ForgetPasswordController::class, 'index']);
$app->router->post('/forget-password',[ForgetPasswordController::class, 'handle']);

// reset password

$app->router->get('/reset-password',[ResetPasswordController::class,'index']);
$app->router->post('/reset-password',[ResetPasswordController::class,'reset']);

// route for project
$app->router->get('/',[ProjectController::class,'index']);
$app->router->get('/project/add',[ProjectController::class,'add']);
$app->router->post('/project/add',[ProjectController::class,'store']);
$app->router->delete('/project/delete/{id}',[ProjectController::class,'delete']);
$app->router->get('/project/edit/{id}',[ProjectController::class,'edit']);
$app->router->put('/project/edit',[ProjectController::class,'update']);

// route for milestones
$app->router->get('/project/{id}/milestones',[MilestoneController::class,'index']);
$app->router->get('/project/milestone/add',[MilestoneController::class,'add']);
$app->router->post('/project/milestone/add',[MilestoneController::class,'store']);
$app->router->delete('/project/milestone/delete/{id}',[MilestoneController::class,'delete']);
$app->router->get('/milestone/edit/{id}',[MilestoneController::class,'edit']);
$app->router->put('/milestone/edit',[MilestoneController::class,'update']);

// route for task
$app->router->get('/milestone/{id}/tasks',[MainController::class, 'index']);
$app->router->get('/milestone/task/add',[MainController::class,'add']);
$app->router->post('/milestone/task/add',[MainController::class,'store']);

// task type
$app->router->get('/task/types',[TypeController::class, 'index']);
$app->router->get('/task/type/create',[TypeController::class, 'add']);
$app->router->post('/task/type/create',[TypeController::class, 'store']);
$app->router->delete('/task/type/delete/{id}',[TypeController::class, 'delete']);
$app->router->get('/task/type/edit/{id}',[TypeController::class,'edit']);
$app->router->put('/task/type/edit',[TypeController::class,'update']);


//
$app->router->post('/task/mark/complete',[MainController::class,'markComplete']);


