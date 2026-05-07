<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

#### Autenticação pelo Sanctum ####
Route::middleware('auth:sanctum')->group(function () {
    #### Autorização de rotas (definido no banco de dados) ####
    # Acionar php artisan db:seed --class=FrontendAuthorizationTableSeeder para atualizar rotas no banco
    Route::middleware('EndpointAuthorizationMiddleware')->group(function () {

        ###### UserInterface ######
        Route::prefix('app/user-interface')->group(function () {
            
        });

        ###### Email Interface ######
        Route::prefix('app/email-interface')->group(function () {
            #Route::post('send-with-mailgun', [EmailInterface::class, 'sendWithMailgun'])->name('sendWithMailgun');
        });
    });
});

#################################################
############## Somente Autorização ##############

###### API Authentication ######
Route::middleware('EndpointAuthorizationMiddleware')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('login', [ApiAuthController::class, 'login'])->name('login');
    });
});

###### Helper ######
Route::middleware('EndpointAuthorizationMiddleware')->group(function () {
    Route::prefix('app/helper')->group(function () {
        #Route::get('get-datetime-info', [HelperInterface::class, 'getDateTimeInfo'])->name('getDateTimeInfo');
    });
});
###### Email ######
Route::middleware('EndpointAuthorizationMiddleware')->group(function () {
    Route::prefix('app/email')->group(function () {
        #Route::post('check-email-connection', [EmailInterface::class, 'checkEmailConnection'])->name('checkEmailConnection');
    });
});
###### User ######
Route::middleware('EndpointAuthorizationMiddleware')->group(function () {
    Route::prefix('app/user')->group(function () {
        #Route::post('add-user', [UserInterface::class, 'addUser'])->name('addUser');
        #Route::post('create-user-key', [UserInterface::class, 'createUserKey'])->name('createUserKey');
        #Route::post('save-google-token', [UserInterface::class, 'saveGoogleToken'])->name('saveGoogleToken');

    });
});

###### Test #######
Route::middleware('EndpointAuthorizationMiddleware')->group(function () {
    Route::prefix('test')->group(function () {
        Route::post('print_request', [TestController::class, 'print_request'])->name('print_request');
    });
});

###### Contact ######
Route::middleware('EndpointAuthorizationMiddleware')->group(function () {
    Route::prefix('app/contact')->group(function () {
        #Route::post('send-contact-email', [ContactInterface::class, 'sendContactEmail'])->name('sendContactEmail');
    });
});
