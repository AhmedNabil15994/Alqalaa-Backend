<?php
use Illuminate\Support\Facades\Route;
//use PDF;

Route::post('contact-us'   , 'ContactUsController@send')->name('api.contactus.send');
//Route::post('test'   , function (\Illuminate\Http\Request $request){
//    $pdf = PDF::loadFile($request->file);
//    $pdf->SetWatermarkText('DRAFT'); // Will cope with UTF-8 encoded text
//    $pdf->watermark_font = 'DejaVuSansCondensed';
//    $pdf->save(public_path('output.pdf'));
//    return 'done';
//});

