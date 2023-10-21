<?php

use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Route;

Route::prefix('pdf')->group(function () {
    Route::get('preview', [PDFController::class, 'preview'])->name('pdf.preview');

    Route::prefix('generate')->group(function () {
        Route::get('v1', [PDFController::class, 'generatePDFv1'])->name('pdf.generate.v1');
        Route::get('v2', [PDFController::class, 'generatePDFv2'])->name('pdf.generate.v2');
    });
});
