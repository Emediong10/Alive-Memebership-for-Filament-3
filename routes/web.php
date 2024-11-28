<?php

use App\Models\Payment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmailController;
use Unicodeveloper\Paystack\Facades\Paystack;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//  Route::get('form', Form::class);

route::get('requirement', [HomeController:: class,'requirement']);
Route::get('/',[HomeController:: class , 'home'])->name('home');

route::get('eligibility', [HomeController:: class,'eligibility']);
route::get('eligible', [HomeController:: class,'eligible']);
route::get('membership_standards', [HomeController:: class,'membership_standards'])->name('membership_standards');
route::get('registration',[HomeController::class, 'registration'])->name('registration');

route::get('application', [HomeController:: class,'application'])->name('application');
route::get('send-email', [EmailController::class, 'sendWelcomeEmail' ]);



Route::get('/payment/callback', function () {
    $paymentDetails = Paystack::getPaymentData();
    if($paymentDetails['status'] && $paymentDetails['data']['status'] === 'success') {
        $userId = $paymentDetails['data']['metadata']['user_id'];
        Payment::create([
            'user_id' => $userId,
            'amount' => $paymentDetails['data']['amount'] * 100,
            'description' => $paymentDetails['data']['metadata']['description'],
            'trans_reference' => $paymentDetails['data']['reference'],
            'trans_status' => $paymentDetails['data']['status'],
            'metadata' => json_encode($paymentDetails['data']['metadata']),
            'created_at' => now(),
        ]);

        return redirect()->route('filament.users.pages.dashboard')
            ->withSuccess('Payment successful!');
    }

    return redirect()->route('filament.users.pages.dashboard')
        ->withError('Payment failed!');
});


Route::get('pdf/{payment}', PdfController::class)->name('pdf');
