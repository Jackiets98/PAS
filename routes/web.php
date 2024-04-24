<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Managements\UserController;
use App\Http\Controllers\Project\ProjectController;

//Home Routes
Route::get('/', [HomeController::class, 'index']);

// Auth Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//Customer Routes
Route::get('/customerlist', [CustomerController::class, 'index']);
Route::post('/addNewCustomer', [CustomerController::class, 'addCustomer'])->name('createCustomer');
Route::get('/viewCustomer/{id}', [CustomerController::class, 'viewCustomerDetails']);
Route::get('/customer/{id}/{status}', [CustomerController::class, 'updateStatus'])->name('customer.status.update');
Route::post('/customerUpdate/{id}', [CustomerController::class, 'updateCustomer']);

//SuperAdmin Routes
Route::get('/superadminlist', [UserController::class, 'superAdmin']);
Route::get('/superadmin/{id}', [UserController::class, 'getDetails']);
Route::post('/superadminUpdate/{id}', [UserController::class, 'updateSuperAdmin']);
Route::get('/superadminStatusUpdate/{id}/{status}', [UserController::class, 'updateStatus'])->name('superadmin.status.update');
Route::post('/addNewSuperAdmin', [UserController::class, 'addSuperAdmin'])->name('createSuperAdmin');

//Agent Routes
Route::get('/agentlist', [UserController::class, 'propertyAgent']);

//Project Routes
Route::get('/projectlist', [ProjectController::class, 'index']);
Route::get('/addNewProject', [ProjectController::class, 'addNewProject']);
Route::post('/storeProject', [ProjectController::class, 'storeProject']);
