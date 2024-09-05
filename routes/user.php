<?php

use Illuminate\Support\Facades\Route;

Route::namespace('User\Auth')->name('user.')->group(function () {
    Route::controller('SocialiteController')->group(function () {
        Route::get('social-login/{provider}', 'socialLogin')->name('social.login');
        Route::get('login/callback/{provider}', 'callback')->name('social.login.callback');
    });

    Route::controller('LoginController')->group(function () {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'login');
        Route::get('logout', 'logout')->middleware('auth')->name('logout');
    });

    Route::controller('RegisterController')->group(function () {
        Route::get('register', 'showRegistrationForm')->name('register');
        Route::post('register', 'register')->middleware('registration.status');
        Route::post('check-mail', 'checkUser')->name('checkUser');
    });

    Route::controller('ForgotPasswordController')->prefix('password')->name('password.')->group(function () {
        Route::get('reset', 'showLinkRequestForm')->name('request');
        Route::post('email', 'sendResetCodeEmail')->name('email');
        Route::get('code-verify', 'codeVerify')->name('code.verify');
        Route::post('verify-code', 'verifyCode')->name('verify.code');
    });
    Route::controller('ResetPasswordController')->group(function () {
        Route::post('password/reset', 'reset')->name('password.update');
        Route::get('password/reset/{token}', 'showResetForm')->name('password.reset');
    });
});

Route::middleware('auth')->name('user.')->group(function () {
    //authorization
    Route::namespace('User')->controller('AuthorizationController')->group(function () {
        Route::get('authorization', 'authorizeForm')->name('authorization');
        Route::get('resend-verify/{type}', 'sendVerifyCode')->name('send.verify.code');
        Route::post('verify-email', 'emailVerification')->name('verify.email');
        Route::post('verify-mobile', 'mobileVerification')->name('verify.mobile');
        Route::post('verify-g2fa', 'g2faVerification')->name('go2fa.verify');
    });

    Route::middleware(['check.status'])->group(function () {

        Route::get('user-data', 'User\UserController@userData')->name('data');
        Route::post('user-data-submit', 'User\UserController@userDataSubmit')->name('data.submit');

        Route::middleware('registration.complete')->namespace('User')->group(function () {

            Route::controller('UserController')->group(function () {
                Route::get('dashboard', 'home')->name('home');

                //2FA
                Route::get('twofactor', 'show2faForm')->name('twofactor');
                Route::post('twofactor/enable', 'create2fa')->name('twofactor.enable');
                Route::post('twofactor/disable', 'disable2fa')->name('twofactor.disable');

                //KYC
                Route::get('kyc-form', 'kycForm')->name('kyc.form');
                Route::get('kyc-data', 'kycData')->name('kyc.data');
                Route::post('kyc-submit', 'kycSubmit')->name('kyc.submit');

                //Report
                Route::any('payment/history', 'depositHistory')->name('deposit.history');

                Route::get('rented/history', 'rentedHistory')->name('rented.history');
                Route::get('rented/detail/{id}', 'rentedDetail')->name('rented.detail');

                Route::get('ongoing/rental/list', 'rentalList')->name('ongoing.rental.list');
                Route::get('ongoing/rental/detail/{id}', 'rentalDetail')->name('ongoing.rental.detail');

                Route::get('transactions', 'transactions')->name('transactions');

                Route::get('attachment-download/{fil_hash}', 'attachmentDownload')->name('attachment.download');
            });

            //Vehicle
            Route::controller('VehicleController')->name('vehicle.')->prefix('vehicle')->group(function () {
                Route::get('store', 'store')->name('store');
                Route::get('store/data', 'storeData')->name('store.data');
                Route::post('store/create', 'storeCreate')->name('store.create');

                Route::middleware('vehicle.store')->group(function () {
                    Route::get('index', 'index')->name('index');
                    Route::get('pending', 'pending')->name('pending');
                    Route::get('approved', 'approved')->name('approved');
                    Route::get('rejected', 'rejected')->name('rejected');
                    Route::get('add/{id?}', 'add')->name('add');
                    Route::get('detail/{id}', 'detail')->name('detail');
                    Route::post('update/{id?}', 'update')->name('update');
                    Route::post('status/{id}', 'status')->name('status');
                    Route::get('rented', 'rented')->name('rented');
                });
            });

            // Rent
            Route::controller('RentalController')->name('rental.')->prefix('rental')->group(function () {
                Route::post('vehicle/{id}', 'rentVehice')->name('vehicle');

                Route::get('index', 'index')->name('index');
                Route::get('pending', 'pending')->name('pending');
                Route::get('approved', 'approved')->name('approved');
                Route::get('ongoing', 'ongoing')->name('ongoing');
                Route::get('completed', 'completed')->name('completed');
                Route::get('cancelled', 'cancelled')->name('cancelled');
                Route::get('detail/{id}', 'detail')->name('detail');
                Route::post('approve/{id}', 'approve')->name('approve.status');
                Route::post('cancel/{id}', 'cancel')->name('cancel.status');
                Route::post('ongoing/{id}', 'ongoingStatus')->name('ongoing.status');
                Route::post('complete/{id}', 'completeStatus')->name('complete.status');

            });

            //Review
            Route::controller('ReviewController')->name('review.')->prefix('review')->group(function () {
                Route::get('index', 'index')->name('index');
                Route::get('form/{rental_id}/{id?}', 'form')->name('form');
                Route::post('add/{rental_id}/{id?}', 'add')->name('add');
                Route::post('remove/{id}', 'remove')->name('remove');
            });
            //Profile setting
            Route::controller('ProfileController')->group(function () {
                Route::get('profile-setting', 'profile')->name('profile.setting');
                Route::post('profile-setting', 'submitProfile');
                Route::get('change-password', 'changePassword')->name('change.password');
                Route::post('change-password', 'submitPassword');
            });

            // Withdraw
            Route::controller('WithdrawController')->prefix('withdraw')->name('withdraw')->group(function () {
                Route::middleware('kyc')->group(function () {
                    Route::get('/', 'withdrawMoney');
                    Route::post('/', 'withdrawStore')->name('.money');
                    Route::get('preview', 'withdrawPreview')->name('.preview');
                    Route::post('preview', 'withdrawSubmit')->name('.submit');
                });
                Route::get('history', 'withdrawLog')->name('.history');
            });
        });

        // Payment
        Route::middleware('registration.complete')->prefix('payment')->name('deposit.')->controller('Gateway\PaymentController')->group(function () {
            Route::any('/', 'deposit')->name('index');
            Route::post('insert', 'depositInsert')->name('insert');
            Route::get('confirm', 'depositConfirm')->name('confirm');
            Route::get('manual', 'manualDepositConfirm')->name('manual.confirm');
            Route::post('manual', 'manualDepositUpdate')->name('manual.update');
        });
    });
});
