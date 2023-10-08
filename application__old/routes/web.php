<?php

use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Route;

Route::prefix('pdf')->group(function () {
    Route::get('preview', [PDFController::class, 'preview'])->name('pdf.preview');
    Route::get('generate', [PDFController::class, 'generatePDF'])->name('pdf.generate');
});
