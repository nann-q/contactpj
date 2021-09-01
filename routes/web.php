<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactsController;
use App\Models\Contact;

// 入力画面
Route::get('contact',[ContactsController::class,'index'])->name('contact');

// 確認画面
Route::post('contact/confirm',[ContactsController::class,'confirm'])->name('confirm');
Route::get('contact/confirm',[ContactsController::class,'confirm'])->name('confirm');

// DB挿入
Route::post('/contact/process',[ContactsController::class,'process'])->name('process');

// 完了画面
Route::post('contact/thanks',[ContactsController::class,'thanks'])->name('thanks');
Route::get('contact/thanks',[ContactsController::class,'thanks'])->name('thanks');

// 管理画面
Route::get('contact/manage',[ContactsController::class,'manage']);

// 検索結果の表示
Route::get('contact/manage/search',[ContactsController::class,'search']);
Route::post('contact/manage/search',[ContactsController::class,'search']);

// 検索結果の削除
Route::post('contact/manage/delete',[ContactsController::class,'delete'])->name('manage.delete');



