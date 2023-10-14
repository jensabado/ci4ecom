<?php

use CodeIgniter\Router\RouteCollection;

use App\Controllers\AdminController;

/**
 * @var RouteCollection $routes
 */

$routes->group('admin', ['prefix' => 'admin:auth'], function($routes) {
  $routes->group('', ['filter' => 'admin:auth'], function($routes) {
    $routes->get('dashboard', 'AdminController::dashboard', ['as' => 'admin.dashboard']);
    $routes->get('logout', 'AdminController::logout', ['as' => 'admin.logout']);
  });

  $routes->group('', ['filter' => 'admin:guest'], function($routes) {
    $routes->get('login', 'AdminController::index', ['as' => 'admin.login']);
    $routes->post('login-handler', 'AdminController::loginHandler', ['as' => 'admin.login-handler']);
    $routes->get('forgot-password', 'AdminController::forgotPassword', ['as' => 'admin.forgot-password']);
    $routes->post('forgot-password-handler', 'AdminController::forgotPasswordHandler', ['as' => 'admin.forgot-password-handler']);
  });
});