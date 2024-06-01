<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;


//$organization_id = 0;
//if (auth('organization_admin')->user())
//{
//    $organization_id = auth('organization_admin')->user()->organization_id;
//}elseif (request()->has('email') && request()->has('password'))
//{
//    $organization_id = 31;
//
//}


//$organization_id =  31;// Request::segment(2); //fetches first URI segment
Config::set('auth.defines', 'organization_admin');
Route::group(['middleware' => ['web'], 'as' => 'organizations.'], function () {
    Route::get('/login', 'Auth\LoginController@login')->name('login');
    Route::post('/login', 'Auth\LoginController@CheckLogin')->name('CheckLogin')->middleware('throttle:5,1');
});

Config::set('auth.defines', 'organization_admin');
Route::group(['middleware' => ['web', 'initDB'], 'as' => 'organizations.'], function () {
    app()->setLocale('ar');

    Route::group(['middleware' => 'authOrganizationUser:organization_admin'], function () {
        Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
        Route::get('/lang', 'LangController')->name('lang');
        Route::middleware('lang')->group(function () {
            Route::get('/', 'OrganizationController@home')->name('home');
            Route::get('organization/view/trainers{id}', 'TrainerDashboardController@viewTrainers')->name('viewTrainers');
            Route::get('organization/view/training{id}', 'TrainingDashboardController@viewTraining')->name('viewTraining');
            Route::get('organization/allTrainings', 'TrainingDashboardController@AllTrainings')->name('AllTrainings');

            // navigation pages
            Route::prefix('navigations')->group(function () {
                Route:: as ('navigations.')->group(function () {


                    Route::get('hrVideo', function () {
                        return view('Organization::video.hr');
                    })->name('hrVideo');

                    Route::get('inventoryVideo', function () {
                        return view('Organization::video.inventory');
                    })->name('inventoryVideo');


                    Route::get('rentVideo', function () {
                        return view('Organization::video.rent');
                    })->name('rentVideo');


                    Route::get('gateVideo', function () {
                        return view('Organization::video.gate');
                    })->name('gateVideo');


                    Route::get('componentVideo', function () {
                        return view('Organization::video.component');
                    })->name('componentVideo');


                    Route::get('finVideo', function () {
                        return view('Organization::video.fin');
                    })->name('finVideo');

                    Route::get('posVideo', function () {
                        return view('Organization::video.pos');
                    })->name('posVideo');

                    Route::get('sportVideo', function () {
                        return view('Organization::video.sport');
                    })->name('sportVideo');

                    Route::get('eventVideo', function () {
                        return view('Organization::video.event');
                    })->name('eventVideo');

                    Route::get('hotelVideo', function () {
                        return view('Organization::video.hotel');
                    })->name('hotelVideo');


                    Route::get('laundryVideo', function () {
                        return view('Organization::video.laundry');
                    })->name('laundryVideo');


                    // component
                    Route::get('components', function () {
                        return view('Organization::_components.layout.navigations.components');
                    })->name('components');

                    // sports-activities
                    Route::get('sports-activities', function () {
                        return view('Organization::_components.layout.navigations.sports_activities');
                    })->name('sports-activities');

                    // hr
                    Route::get('hr', function () {
                        return view('Organization::_components.layout.navigations.hr');
                    })->name('hr');

                    // club
                    Route::get('club', function () {
                        return view('Organization::_components.layout.navigations.club');
                    })->name('club');

                    // rent
                    Route::get('rent', function () {
                        return view('Organization::_components.layout.navigations.rent');
                    })->name('rent');

                    // gate
                    Route::get('gate', function () {
                        return view('Organization::_components.layout.navigations.gate');
                    })->name('gate');

                    // event
                    Route::get('event', function () {
                        return view('Organization::_components.layout.navigations.event');
                    })->name('event');

                    // hotel
                    Route::get('hotel', function () {
                        return view('Organization::_components.layout.navigations.hotel');
                    })->name('hotel');

                    // laundry
                    Route::get('laundry', function () {
                        return view('Organization::_components.layout.navigations.laundry');
                    })->name('laundry');

                    // finance
                    Route::get('finance', function () {
                        return view('Organization::_components.layout.navigations.finance');
                    })->name('finance');

                });
            });

            /**
             * employee Module Routes
             */

            Route::prefix('areas')->group(function () {
                Route:: as ('area.')->group(function () {
                    Route::get('/notifications', 'AreasNotificationController@notifications')->name('notification');

                });
            });

            Route::prefix('hotels')->group(function () {
                Route:: as ('hotel.')->group(function () {
                    Route::get('/notifications', 'HotelNotificationController@notifications')->name('notification');

                });
            });

            Route::prefix('laundries')->group(function () {
                Route:: as ('laundrys.')->group(function () {
                    Route::get('/notifications', 'LaundryNotificationController@notifications')->name('notification');

                });
            });

            Route::prefix('employeeAttendancees')->group(function () {
                Route:: as ('employeeAttendance.')->group(function () {
                    Route::get('show', 'EmployeeAttendanceController@show')->name('show');
                    Route::get('data', 'EmployeeAttendanceController@data')->name('data');
                    Route::post('storeAttendance', 'EmployeeAttendanceController@storeAttendance')->name('storeAttendance');

                    Route::get('vacation/{id}/{date}', 'EmployeeAttendanceController@vacation')->name('vacation');

                    Route::get('dessmissOverTime/{id}/{date}', 'EmployeeAttendanceController@dessmissOverTime')->name('dessmissOverTime');

                    Route::get('approveHours/{id}/{date}', 'EmployeeAttendanceController@approveHours')->name('approveHours');

                });

            });

            Route::resource('employee', 'EmployeeController');
            Route::prefix('employees')->group(function () {
                Route:: as ('employee.')->group(function () {
                    Route::get('data', 'EmployeeController@data')->name('data');
                    Route::post('trash', 'EmployeeController@trash')->name('trash');
                    Route::post('restore', 'EmployeeController@restore')->name('restore');
                    Route::get('show/data/{id}', 'EmployeeController@showData')->name('show.data');
                    Route::get('attachments/{id}', 'EmployeeController@showAttachmentsData')->name('show.attachments.data');
                    Route::get('download/attachment/{id}', 'EmployeeController@downloadAttachment')->name('download.attachment');
                    Route::get('delete/attachment/{id}', 'EmployeeController@deleteAttachment')->name('delete.attachment');
                    Route::get('upload/attachments/{id}', 'EmployeeController@uploadAttachments')->name('upload.attachment');
                    Route::post('store/attachments/{id}', 'EmployeeController@storeAttachments')->name('store.attachment');
                    Route::get('download/jobDescription/{id}', 'EmployeeController@downloadJobDescription')->name('download.jobDescription');
                    Route::get('add/salary/{id}', 'EmployeeController@addSalary')->name('add.salary');
                    Route::post('store/salary', 'EmployeeController@storeSalary')->name('store.salary');
                    Route::get('append/exemption/description', 'EmployeeController@appendExemptionDescription')->name('append.exemption.description');
                    Route::get('{id}/Unpaid/vacation', 'EmployeeController@UnpaidVacation')->name('unpaid');
                    Route::post('store/Unpaid/vacation', 'EmployeeController@StoreUnpaidVacation')->name('store.unpaid');
                    Route::get('{id}/return/vacation', 'EmployeeController@ReturnVacation')->name('return');
                    Route::get('{id}/view/notification', 'EmployeeController@ViewNotification')->name('view.notification');

                    Route::get('add/working/days/{id}', 'EmployeeController@addWorkingDays')->name('add.working.days');

                    Route::post('store/days', 'EmployeeController@storeDays')->name('store.days');

                    Route::get('upload/contract/{id}', 'EmployeeController@uploadContract')->name('upload.contract');
                    Route::post('store/contract/{id}', 'EmployeeController@storecontract')->name('store.contract');

                    Route::get('download/contract/{id}', 'EmployeeController@downloadContract')->name('download.contract');

                    Route::get('upload/job_description/{id}', 'EmployeeController@uploadJobDescription')->name('upload.job_description');
                    Route::post('store/job_description/{id}', 'EmployeeController@storeJobDescription')->name('store.job_description');

                    Route::get('approve/{id}', 'EmployeeController@approve')->name('approve');

                    Route::get('refuse/{id}', 'EmployeeController@refuse')->name('refuse');

                    Route::get('import', 'EmployeeController@import')->name('import');
                    Route::post('store_import', 'EmployeeController@importExcelCSV')->name('storeImport');



                    Route::get('last/vacations/{id}', 'EmployeeController@lastVacations')->name('last.vacations');

                });
            });

            /**
             * settings Module Routes
             */
            Route::resource('setting', 'SettingController');

            //            Route::resource('admin', 'AdminController');
//            Route::prefix('admins')->group(function () {
//                Route::as('admin.')->group(function () {
//                    Route::get('data', 'AdminController@data')->name('data');
//                    Route::post('reset/password', 'AdminController@resetPassword')->name('reset.password');
//                    Route::post('trash', 'AdminController@trash')->name('trash');
//                    Route::post('restore', 'AdminController@restore')->name('restore');
//                    Route::get('export', 'AdminController@export')->name('export');
//                });
//            });

            /**
             * halls Module Routes
             */
            Route::resource('hall', 'HallController');
            Route::prefix('halls')->group(function () {
                Route:: as ('hall.')->group(function () {
                    Route::get('data', 'HallController@data')->name('data');
                    Route::post('trash', 'HallController@trash')->name('trash');
                    Route::post('restore', 'HallController@restore')->name('restore');
                    Route::get('export', 'HallController@export')->name('export');
                });
            });

            /**
             * event item types Module Routes
             */
            Route::resource('eventItemType', 'EventItemTypeController');
            Route::prefix('eventItemTypes')->group(function () {
                Route:: as ('eventItemType.')->group(function () {
                    Route::get('data', 'EventItemTypeController@data')->name('data');
                    Route::post('trash', 'EventItemTypeController@trash')->name('trash');
                    Route::post('restore', 'EventItemTypeController@restore')->name('restore');
                    Route::get('export', 'EventItemTypeController@export')->name('export');
                });
            });

            /**
             * event item types Module Routes
             */
            Route::resource('eventItem', 'EventItemController');
            Route::prefix('eventItems')->group(function () {
                Route:: as ('eventItem.')->group(function () {
                    Route::get('data', 'EventItemController@data')->name('data');
                    Route::post('trash', 'EventItemController@trash')->name('trash');
                    Route::post('restore', 'EventItemController@restore')->name('restore');
                    Route::get('export', 'EventItemController@export')->name('export');
                });
            });

            /**
             * unit of measurement Module Routes
             */
            Route::resource('unit', 'UnitMeasurementController');
            Route::prefix('units')->group(function () {
                Route:: as ('unit.')->group(function () {
                    Route::get('data', 'UnitMeasurementController@data')->name('data');
                    Route::post('trash', 'UnitMeasurementController@trash')->name('trash');
                    Route::post('restore', 'UnitMeasurementController@restore')->name('restore');
                });
            });
            /**
             * ingredient category Module Routes
             */
            Route::resource('ingredientCategory', 'IngredientCategoryController');
            Route::prefix('ingredientCategories')->group(function () {
                Route:: as ('ingredientCategory.')->group(function () {
                    Route::get('data', 'IngredientCategoryController@data')->name('data');
                    Route::post('trash', 'IngredientCategoryController@trash')->name('trash');
                    Route::post('restore', 'IngredientCategoryController@restore')->name('restore');
                    Route::get('export', 'IngredientCategoryController@export')->name('export');
                });
            });
            /**
             * ingredient Module Routes
             */
            Route::resource('ingredient', 'IngredientController');
            Route::prefix('ingredients')->group(function () {
                Route:: as ('ingredient.')->group(function () {
                    Route::get('data', 'IngredientController@data')->name('data');
                    Route::post('trash', 'IngredientController@trash')->name('trash');
                    Route::post('restore', 'IngredientController@restore')->name('restore');
                    Route::get('export', 'IngredientController@export')->name('export');

                    Route::get('import', 'IngredientController@import')->name('import');
                    Route::post('store_import', 'IngredientController@importExcelCSV')->name('storeImport');

                    Route::get('reOrderIndex', 'IngredientController@reOrderIndex')->name('reOrderIndex');
                    Route::get('reOrderIndex/data', 'IngredientController@reOrderIndexData')->name('reOrderIndex.data');

                    Route::get('manufactured/{id}', 'IngredientController@manufactured')->name('manufactured');
                    Route::get('add/manufactured/{id}', 'IngredientController@addManufactured')->name('add.manufactured');

                    Route::get('{id}/execution/ingredent', 'IngredientController@executionIngredent')->name('execution');
                    Route::get('{id}/execution', 'IngredientController@execIng')->name('execIng');

                    Route::get('execIndex', 'IngredientController@execIndex')->name('execIndex');
                    Route::get('execIndex/data', 'IngredientController@execIndexData')->name('execIndex.data');

                    Route::get('card/{id}', 'IngredientController@card')->name('card');

                    Route::get('exportCard/{id}', 'IngredientController@exportCard')->name('exportCard');
                });
            });
            Route::prefix('InventoryStockings')->group(function () {
                Route:: as ('InventoryStocking.')->group(function () {
                    Route::get('index/{id}', 'InventoryStockingController@index')->name('index');
                    Route::get('data/{id}', 'InventoryStockingController@data')->name('data');
                    Route::get('create/{id}', 'InventoryStockingController@create')->name('create');
                    Route::post('store', 'InventoryStockingController@store')->name('store');
                    Route::get('detail/{id}', 'InventoryStockingController@detail')->name('detail');

                });
            });
            ################### Start Sport Activity Modules #####################
            /**
             * Sport Activity Areas Module Routes
             */
            Route::resource('sportArea', 'SportAreaController');
            Route::prefix('sportAreas')->group(function () {
                Route:: as ('sportArea.')->group(function () {
                    Route::get('show/reservations/{id}', 'SportAreaController@showReservations')->name('showReservations');
                    Route::post('show/reservation', 'SportAreaController@showReservation')->name('show.Reservation');
                    Route::get('data', 'SportAreaController@data')->name('data');
                    Route::post('trash', 'SportAreaController@trash')->name('trash');
                    Route::post('restore', 'SportAreaController@restore')->name('restore');
                    Route::get('export', 'SportAreaController@export')->name('export');
                });
            });

            /**
             * Club Sports Module Routes
             */
            Route::resource('clubSport', 'ClubSportController');
            Route::prefix('clubSports')->group(function () {
                Route:: as ('clubSport.')->group(function () {
                    Route::get('data', 'ClubSportController@data')->name('data');
                    Route::post('trash', 'ClubSportController@trash')->name('trash');
                    Route::post('restore', 'ClubSportController@restore')->name('restore');
                    Route::get('export', 'ClubSportController@export')->name('export');
                });
            });

            /**
             * Freelance Trainers Module Routes
             */
            Route::resource('freelanceTrainer', 'FreelanceTrainerController');
            Route::prefix('freelanceTrainers')->group(function () {
                Route:: as ('freelanceTrainer.')->group(function () {
                    Route::get('append/table', 'FreelanceTrainerController@appendTable')->name('append.table');
                    Route::get('data', 'FreelanceTrainerController@data')->name('data');
                    Route::post('trash', 'FreelanceTrainerController@trash')->name('trash');
                    Route::post('restore', 'FreelanceTrainerController@restore')->name('restore');
                    Route::get('export', 'FreelanceTrainerController@export')->name('export');
                });
            });
//            Route::prefix('trainerRevenues')->group(function () {
//                Route:: as ('trainerRevenue.')->group(function () {
//                    Route::get('/{id}', 'TrainerRevenueController@TrainerRevenueIndex')->name('index');
//                    Route::get('data/{id}', 'TrainerRevenueController@TrainerRevenueData')->name('data');
//                    Route::get('export/{id}', 'TrainerRevenueController@TrainerRevenueExport')->name('export');
//
//                });
//            });
            /**
             * Subscribers Types Module Routes
             */
            Route::resource('subscriberType', 'SubscriberTypeController');
            Route::prefix('subscriberTypes')->group(function () {
                Route:: as ('subscriberType.')->group(function () {
                    Route::get('data', 'SubscriberTypeController@data')->name('data');
                    Route::post('trash', 'SubscriberTypeController@trash')->name('trash');
                    Route::post('restore', 'SubscriberTypeController@restore')->name('restore');
                    Route::get('export', 'SubscriberTypeController@export')->name('export');
                });
            });

            /**
             * Trainings Module Routes
             */
            Route::resource('training', 'TrainingController')->except(['show']);
            Route::prefix('trainings')->group(function () {
                Route:: as ('training.')->group(function () {
                    Route::get('data', 'TrainingController@data')->name('data');
                    Route::get('append/trainers', 'TrainingController@appendTrainers')->name('append.trainers');
                    Route::post('trash', 'TrainingController@trash')->name('trash');
                    Route::post('restore', 'TrainingController@restore')->name('restore');
                    Route::get('export', 'TrainingController@export')->name('export');
                    Route::get('get/schedule/row', 'TrainingController@getScheduleRow')->name('get.schedule.row');
                    Route::get('get/pricing/row', 'TrainingController@getPricingRow')->name('get.pricing.row');

                });
            });

            /**
             * Subscribers Module Routes
             */
            Route::resource('subscriber', 'SubscriberController');
            Route::prefix('subscribers')->group(function () {
                Route:: as ('subscriber.')->group(function () {
                    Route::get('data', 'SubscriberController@data')->name('data');
                    Route::post('trash', 'SubscriberController@trash')->name('trash');
                    Route::post('restore', 'SubscriberController@restore')->name('restore');
                    Route::get('export', 'SubscriberController@export')->name('export');

                });
            });
            /**
             * Subscriptions Module Routes
             */
            Route::resource('subscription', 'SubscriptionController');
            Route::prefix('subscriptions')->group(function () {
                Route:: as ('subscription.')->group(function () {
                    Route::get('data', 'SubscriptionController@data')->name('data');
                    Route::get('cancels', 'SubscriptionController@cancels')->name('cancels');
                    Route::get('cancel/data', 'SubscriptionController@cancelData')->name('cancel.data');
                    Route::get('cancel/{id}', 'SubscriptionController@cancel')->name('cancel');
                    Route::post('cancel/subscription', 'SubscriptionController@cancelSubscription')->name('cancelSubscription');
                    Route::get('append/refund', 'SubscriptionController@appendRefund')->name('append.refund');
                    Route::get('append/pricing', 'SubscriptionController@appendPricings')->name('append.pricings');
                    Route::get('append/training', 'SubscriptionController@appendTrainings')->name('append.trainings');
                    Route::get('append/duration', 'SubscriptionController@appendDurations')->name('append.durations');
                    Route::get('append/date/duration', 'SubscriptionController@appendDateDuration')->name('append.date.duration');
                    Route::get('append/balance', 'SubscriptionController@appendBalance')->name('append.balance');
                    Route::get('append/price', 'SubscriptionController@appendPrice')->name('append.price');
                    Route::get('append/overprice', 'SubscriptionController@appendOverprice')->name('append.overprice');
                    Route::get('append/balance/overprice', 'SubscriptionController@appendBalanceOverprice')->name('append.balance.overprice');
                    Route::post('trash', 'SubscriptionController@trash')->name('trash');
                    Route::post('restore', 'SubscriptionController@restore')->name('restore');
                    Route::get('export', 'SubscriptionController@export')->name('export');
                    Route::get('cancel/export', 'SubscriptionController@exportCancel')->name('exportCancel');

                    Route::get('canceled/exported', 'SubscriptionController@exportCancel')->name('exported');

                });
            });

            /**
             * Payments Module Routes
             */
            Route::resource('payment', 'PaymentController');
            Route::get('payment/create/{id}', 'PaymentController@createPayment')->name('payment.createPayment');
            Route::prefix('payments')->group(function () {
                Route:: as ('payment.')->group(function () {
                    Route::get('data', 'PaymentController@data')->name('data');
                    Route::get('append/subscription', 'PaymentController@appendSubscription')->name('append.subscriptions');
                    Route::get('append/balance', 'PaymentController@appendBalance')->name('append.balance');
                    Route::post('trash', 'PaymentController@trash')->name('trash');
                    Route::post('restore', 'PaymentController@restore')->name('restore');
                    Route::get('export', 'PaymentController@export')->name('export');

                });
            });
            /**
             * Trainer Attendance Module Routes
             */
            Route::resource('trainerAttendance', 'TrainerAttendanceController');
            Route::prefix('trainerAttendances')->group(function () {
                Route:: as ('trainerAttendance.')->group(function () {
                    Route::get('data', 'TrainerAttendanceController@data')->name('data');
                    Route::post('trash', 'TrainerAttendanceController@trash')->name('trash');
                    Route::post('restore', 'TrainerAttendanceController@restore')->name('restore');
                    Route::get('export', 'TrainerAttendanceController@export')->name('export');

                });
            });
            /**
             * Subscriber Attendance Module Routes
             */
            Route::resource('subscriberAttendance', 'SubscriberAttendanceController');
            Route::prefix('subscriberAttendances')->group(function () {
                Route:: as ('subscriberAttendance.')->group(function () {
                    Route::get('data', 'SubscriberAttendanceController@data')->name('data');
                    Route::post('trash', 'SubscriberAttendanceController@trash')->name('trash');
                    Route::post('restore', 'SubscriberAttendanceController@restore')->name('restore');
                    Route::get('export', 'SubscriberAttendanceController@export')->name('export');

                });
            });
            /**
             * External pricing Module Routes
             */
            Route::resource('externalPrice', 'ExternalPricingController')->except(['show']);
            Route::prefix('externalPrices')->group(function () {
                Route:: as ('externalPrice.')->group(function () {
                    Route::get('data', 'ExternalPricingController@data')->name('data');
                    Route::post('trash', 'ExternalPricingController@trash')->name('trash');
                    Route::post('restore', 'ExternalPricingController@restore')->name('restore');
                    Route::get('export', 'ExternalPricingController@export')->name('export');
                    Route::get('get/pricing/row', 'ExternalPricingController@getPricingRow')->name('get.pricing.row');

                });
            });
            /**
             * External reservation Module Routes
             */
            Route::resource('externalReservation', 'ExternalReservationController')->except(['show']);
            Route::prefix('externalReservations')->group(function () {
                Route:: as ('externalReservation.')->group(function () {
                    Route::get('data', 'ExternalReservationController@data')->name('data');
                    Route::post('trash', 'ExternalReservationController@trash')->name('trash');
                    Route::post('restore', 'ExternalReservationController@restore')->name('restore');
                    Route::get('export', 'ExternalReservationController@export')->name('export');
                    Route::get('append/EndTime', 'ExternalReservationController@appendEndTime')->name('append.endTime');
                    Route::get('append/final/price', 'ExternalReservationController@appendFinalPrice')->name('append.finalPrice');

                });
            });
            /**
             * External reservation Payment Module Routes
             */
            Route::resource('external_payment', 'ExternalPaymentController');
            Route::get('external_payment/create/{id}', 'ExternalPaymentController@createPayment')->name('external_payment.createPayment');
            Route::prefix('external_payments')->group(function () {
                Route:: as ('external_payment.')->group(function () {
                    Route::get('data', 'ExternalPaymentController@data')->name('data');
                    Route::get('append/subscription', 'ExternalPaymentController@appendSubscription')->name('append.subscriptions');
                    Route::get('append/balance', 'ExternalPaymentController@appendBalance')->name('append.balance');
                    Route::get('append/overprice', 'ExternalPaymentController@appendOverprice')->name('append.overprice');
                    Route::post('trash', 'ExternalPaymentController@trash')->name('trash');
                    Route::post('restore', 'ExternalPaymentController@restore')->name('restore');
                    Route::get('export', 'ExternalPaymentController@export')->name('export');

                });
            });
            /**
             * Club Reports Module Routes
             */
            Route::resource('clubReport', 'ClubReportController');
            Route::prefix('clubReports')->group(function () {
                Route:: as ('clubReport.')->group(function () {
                    Route::get('data', 'ClubReportController@data')->name('data');
                    Route::get('export', 'ClubReportController@export')->name('export');
                });
            });
            /**
             * Trainer Reports Module Routes
             */
            Route::resource('trainerReport', 'TrainerReportController');
            Route::prefix('trainerReports')->group(function () {
                Route:: as ('trainerReport.')->group(function () {
                    Route::get('data', 'TrainerReportController@data')->name('data');
                    Route::get('export', 'TrainerReportController@export')->name('export');
                });
            });
            /**
             * Trainings Reports Module Routes
             */
            Route::resource('trainingReport', 'TrainingReportController');
            Route::prefix('trainingReports')->group(function () {
                Route:: as ('trainingReport.')->group(function () {
                    Route::get('data', 'TrainingReportController@data')->name('data');
                    Route::get('export', 'TrainingReportController@export')->name('export');
                });
            });
            /**
             * Subscribers Remaining Subscribers Balances Reports Module Routes
             */
            Route::resource('subscriberBalance', 'SubscriberBalanceReportController');
            Route::prefix('subscriberBalances')->group(function () {
                Route:: as ('subscriberBalance.')->group(function () {
                    Route::get('data', 'SubscriberBalanceReportController@data')->name('data');
                    Route::get('export', 'SubscriberBalanceReportController@export')->name('export');
                });
            });
            /**
             * Payment Reports Module Routes
             */
            Route::resource('paymentReport', 'PaymentReportController');
            Route::prefix('paymentReports')->group(function () {
                Route:: as ('paymentReport.')->group(function () {
                    Route::get('data', 'PaymentReportController@data')->name('data');
                    Route::get('export', 'PaymentReportController@export')->name('export');
                });
            });
            /**
             * Trainer Revenue report for all sports Module Routes
             */
            Route::resource('revenueSport', 'RevenueSportController');
            Route::prefix('revenueSports')->group(function () {
                Route:: as ('revenueSport.')->group(function () {
                    Route::get('clubSport{id}', 'RevenueSportController@trainingDetails')->name('clubSport');
                    Route::get('training{id}', 'RevenueSportController@subscriptionDetails')->name('training');
                    Route::get('data', 'RevenueSportController@data')->name('data');
                    Route::get('export', 'RevenueSportController@export')->name('export');
                });
            });
            /**
             * Area Reports Module Routes
             */
            Route::resource('areaReport', 'AreaReportController');
            Route::prefix('areaReports')->group(function () {
                Route:: as ('areaReport.')->group(function () {
                    Route::get('data', 'AreaReportController@data')->name('data');
                    Route::get('export', 'AreaReportController@export')->name('export');
                });
            });
            /**
             * Attendance report for trainers Reports Module Routes
             */
            Route::resource('trainerAttend', 'TrainerAttendController');
            Route::prefix('trainerAttends')->group(function () {
                Route:: as ('trainerAttend.')->group(function () {
                    Route::get('trainer{id}', 'TrainerAttendController@Totaltrainings')->name('showCount');
                    Route::get('data', 'TrainerAttendController@data')->name('data');
                    Route::get('export', 'TrainerAttendController@export')->name('export');
                });
            });
            ################### End Sport Activity Modules #####################

            ################### Start Hotels Modules #####################
            /**
             * hotels Module Routes
             */
            Route::resource('hotel', 'HotelController');
            Route::prefix('hotels')->group(function () {
                Route:: as ('hotel.')->group(function () {
                    Route::get('data', 'HotelController@data')->name('data');
                    Route::post('trash', 'HotelController@trash')->name('trash');
                    Route::post('restore', 'HotelController@restore')->name('restore');
                    Route::get('export', 'HotelController@export')->name('export');
                    Route::get('{id}/inventories', 'HotelController@inventories')->name('inventories');
                    Route::get('{id}/invoices', 'HotelController@invoices')->name('invoices');
                });
            });

            /**
             * hotels Order Module Routes
             */
            Route::resource('hotelOrder', 'HotelOrderController');
            Route::prefix('hotelOrders')->group(function () {
                Route:: as ('hotelOrder.')->group(function () {
                    Route::get('data', 'HotelOrderController@data')->name('data');
                    Route::post('trash', 'HotelOrderController@trash')->name('trash');
                    Route::post('restore', 'HotelOrderController@restore')->name('restore');
                    Route::get('export', 'HotelOrderController@export')->name('export');
                    Route::get('get-service-row', 'HotelOrderController@getServiceRow')->name('get.service.row');
                    Route::get('change-order-status', 'HotelOrderController@changeStatus')->name('change.order.status');
                    Route::get('cancel-order', 'HotelOrderController@cancelOrder')->name('cancel.order');

                });
            });
            /**
             * room Types Module Routes
             */
            Route::resource('roomType', 'RoomTypeController');
            Route::prefix('roomTypes')->group(function () {
                Route:: as ('roomType.')->group(function () {
                    Route::get('data', 'RoomTypeController@data')->name('data');
                    Route::post('trash', 'RoomTypeController@trash')->name('trash');
                    Route::post('restore', 'RoomTypeController@restore')->name('restore');
                    Route::get('export', 'RoomTypeController@export')->name('export');
                });
            });
            /**
             * parent Rooms Module Routes
             */
            Route::resource('parentRoom', 'ParentRoomController');
            Route::prefix('parentRooms')->group(function () {
                Route:: as ('parentRoom.')->group(function () {
                    Route::get('data', 'ParentRoomController@data')->name('data');
                    Route::post('trash', 'ParentRoomController@trash')->name('trash');
                    Route::post('restore', 'ParentRoomController@restore')->name('restore');
                    Route::get('export', 'ParentRoomController@export')->name('export');
                    Route::get('get/dayPricing/row', 'ParentRoomController@getDayPricingRow')->name('get.dayPricing.row');
                    Route::get('get/pricing/row', 'ParentRoomController@getPricingRow')->name('get.pricing.row');
                });
            });

            /**
             * rooms Module Routes
             */
            Route::resource('room', 'RoomController');
            Route::prefix('rooms')->group(function () {
                Route:: as ('room.')->group(function () {
                    Route::get('data', 'RoomController@data')->name('data');
                    Route::post('trash', 'RoomController@trash')->name('trash');
                    Route::post('restore', 'RoomController@restore')->name('restore');
                    Route::get('export', 'RoomController@export')->name('export');
                });
            });
            /**
             * customer Types Module Routes
             */
            Route::resource('customerType', 'CustomerTypeController');
            Route::prefix('customerTypes')->group(function () {
                Route:: as ('customerType.')->group(function () {
                    Route::get('data', 'CustomerTypeController@data')->name('data');
                    Route::post('trash', 'CustomerTypeController@trash')->name('trash');
                    Route::post('restore', 'CustomerTypeController@restore')->name('restore');
                    Route::get('export', 'CustomerTypeController@export')->name('export');
                    Route::get('get/information/row', 'CustomerTypeController@getInformationRow')->name('get.information.row');

                });
            });

            /**
             * customer Types Module Routes
             */
            Route::resource('qrMenu', 'QrMenuController');
            Route::prefix('qrMenus')->group(function () {
                Route:: as ('qrMenu.')->group(function () {
                    Route::get('data', 'QrMenuController@data')->name('data');
                    Route::post('trash', 'QrMenuController@trash')->name('trash');
                    Route::post('restore', 'QrMenuController@restore')->name('restore');
                    Route::get('export', 'QrMenuController@export')->name('export');

                });
            });
            /**
             * customers Module Routes
             */
            Route::resource('customer', 'CustomerController');
            Route::prefix('customers')->group(function () {
                Route:: as ('customer.')->group(function () {
                    Route::get('data', 'CustomerController@data')->name('data');
                    Route::get('append/information', 'CustomerController@appendInformation')->name('append.information');
                    Route::post('trash', 'CustomerController@trash')->name('trash');
                    Route::post('restore', 'CustomerController@restore')->name('restore');
                    Route::get('export', 'CustomerController@export')->name('export');
                    Route::get('toggle_trobble_maker/{id}', 'CustomerController@toggle_trobble_maker')->name('toggle_trobble_maker');

                });
            });
            /**
             * Hotel Reservations Module Routes
             */
            Route::resource('hotelReservation', 'HotelReservationController');
            Route::prefix('hotelReservations')->group(function () {
                Route:: as ('hotelReservation.')->group(function () {
                    Route::get('data', 'HotelReservationController@data')->name('data');
                    Route::post('trash', 'HotelReservationController@trash')->name('trash');
                    Route::post('restore', 'HotelReservationController@restore')->name('restore');
                    Route::get('export', 'HotelReservationController@export')->name('export');
                    Route::get('append/departure/duration', 'HotelReservationController@appendDepartureDuration')->name('append.departure.date');
                    Route::get('append/number/of/nights', 'HotelReservationController@appendNumberOfNights')->name('append.number.nights');
                    Route::get('append/rooms', 'HotelReservationController@appendRooms')->name('append.rooms');
                    Route::get('append/price/night', 'HotelReservationController@appendPriceNight')->name('append.price.night');
                    Route::get('append/total/price/night', 'HotelReservationController@appendTotalPriceNight')->name('append.total.price.night');
                    Route::get('append/total/price', 'HotelReservationController@appendTotalPrice')->name('append.total.price');
                    Route::get('append/final/price', 'HotelReservationController@appendFinalPrice')->name('append.final.price');
                    Route::get('append/final/price/night', 'HotelReservationController@appendFinalPriceNight')->name('append.final.price.night');
                    Route::get('get/account/row', 'HotelReservationController@getAccountRow')->name('get.account.row');
                    Route::get('get/children/row', 'HotelReservationController@getChildrenRow')->name('get.children.row');
                    Route::post('checkIn', 'HotelReservationController@checkIn')->name('checkIn');

                    Route::get('{id}/invoices', 'HotelReservationController@invoices')->name('invoices');
                    Route::get('{id}/payments', 'HotelReservationController@payments')->name('payments');
                    Route::get('{id}/damage', 'HotelReservationController@damage')->name('damage');
                    Route::get('{id}/damages', 'HotelReservationController@damages')->name('damages');
                    Route::post('store/damage', 'HotelReservationController@StoreDamage')->name('store.damage');
                    Route::get('{id}/create/payment', 'HotelReservationController@createPayment')->name('create.payment');
                    Route::post('store/payment', 'HotelReservationController@storePayment')->name('store.payment');
                    Route::get('confirm/{id}/invoice', 'HotelReservationController@confirmInvoice')->name('confirm.invoice');
                    Route::get('edit/{id}/invoice', 'HotelReservationController@editInvoice')->name('edit.invoice');
                    Route::post('update/{id}/invoice', 'HotelReservationController@updateInvoice')->name('update.invoice');
                    Route::get('edit/{id}/dates', 'HotelReservationController@editDates')->name('edit.dates');
                    Route::post('update/{id}/dates', 'HotelReservationController@updateDates')->name('update.dates');
                    Route::post('change/invoice/reservation', 'HotelReservationController@changeInvoiceReservation')->name('change.reservation');
                });
            });

            /**
             *  Laundry InventoryModule Routes
             */
            Route::resource('hotelInventory', 'HotelInventoryController');
            Route::prefix('hotelInventories')->group(function () {
                Route:: as ('hotelInventory.')->group(function () {
                    Route::get('data', 'HotelInventoryController@data')->name('data');
                    Route::get('export', 'HotelInventoryController@export')->name('export');
                    Route::get('{id}/consumption', 'HotelInventoryController@consumption')->name('consumption');
                    Route::post('save', 'HotelInventoryController@save')->name('save');
                });
            });
            Route::prefix('HotelStockings')->group(function () {
                Route:: as ('HotelStocking.')->group(function () {
                    Route::get('index/{id}', 'HotelStockingController@index')->name('index');
                    Route::get('data/{id}', 'HotelStockingController@data')->name('data');

                    Route::get('create/{id}', 'HotelStockingController@create')->name('create');
                    Route::post('store', 'HotelStockingController@store')->name('store');
                    Route::get('detail/{id}', 'HotelStockingController@detail')->name('detail');

                });
            });
            Route::resource('CompanyReport', 'CompanyReportController');
            Route::prefix('CompanyReports')->group(function () {
                Route:: as ('CompanyReport.')->group(function () {
                    Route::get('data', 'CompanyReportController@data')->name('data');
                    Route::get('export', 'CompanyReportController@export')->name('export');
                });
            });
            Route::resource('CompanyStatistic', 'CompanyStatisticsController');
            Route::prefix('CompanyStatistics')->group(function () {
                Route:: as ('CompanyStatistic.')->group(function () {
                    Route::get('data', 'CompanyStatisticsController@data')->name('data');
                    Route::get('export', 'CompanyStatisticsController@export')->name('export');
                });
            });
            Route::prefix('CompanyDetails')->group(function () {
                Route:: as ('CompanyDetail.')->group(function () {
                    Route::get('/{id}', 'CompanyDetailController@CompanyDetailIndex')->name('index');
                    Route::get('data/{id}', 'CompanyDetailController@CompanyDetailData')->name('data');
                    Route::get('export/{id}', 'CompanyDetailController@CompanyDetailExport')->name('export');

                });
            });
            Route::resource('IndividualReport', 'IndividualReportController');
            Route::prefix('IndividualReports')->group(function () {
                Route:: as ('IndividualReport.')->group(function () {
                    Route::get('data', 'IndividualReportController@data')->name('data');
                    Route::get('export', 'IndividualReportController@export')->name('export');
                });
            });
            Route::resource('RoomBalance', 'RoomBalanceController');
            Route::prefix('RoomBalances')->group(function () {
                Route::as('RoomBalance.')->group(function () {
                    Route::get('data', 'RoomBalanceController@data')->name('data');
                    Route::get('export', 'RoomBalanceController@export')->name('export');
                });
            });

            Route::resource('RoomTypeReport', 'RoomTypeReportController');
            Route::prefix('RoomTypeReports')->group(function () {
                Route::as('RoomTypeReport.')->group(function () {
                    Route::get('data', 'RoomTypeReportController@data')->name('data');
                    Route::get('export', 'RoomTypeReportController@export')->name('export');
                });
            });
            Route::resource('CompanyEmployee', 'CompanyEmployeeController');
            Route::prefix('CompanyEmployees')->group(function () {
                Route::as('CompanyEmployee.')->group(function () {
                    Route::get('data', 'CompanyEmployeeController@data')->name('data');
                    Route::get('export', 'CompanyEmployeeController@export')->name('export');
                });
            });
            Route::resource('AllEmployee', 'AllEmployeeController');
            Route::prefix('AllEmployees')->group(function () {
                Route::as('AllEmployee.')->group(function () {
                    Route::get('data', 'AllEmployeeController@data')->name('data');
                    Route::get('export', 'AllEmployeeController@export')->name('export');
                });
            });
            Route::resource('RoomTypeDayReport', 'RoomTypeDayReportController');
            Route::prefix('RoomTypeDayReports')->group(function () {
                Route::as('RoomTypeDayReport.')->group(function () {
                    Route::get('data', 'RoomTypeDayReportController@data')->name('data');
                    Route::get('export', 'RoomTypeDayReportController@export')->name('export');
                });
            });
            Route::resource('RoomTodayReport', 'RoomTodayReportController');
            Route::prefix('RoomTodayReports')->group(function () {
                Route::as('RoomTodayReport.')->group(function () {
                    Route::get('data', 'RoomTodayReportController@data')->name('data');
                    Route::get('export', 'RoomTodayReportController@export')->name('export');
                });
            });
            Route::resource('RoomYearReport', 'RoomYearReportController');
            Route::prefix('RoomYearReports')->group(function () {
                Route::as('RoomYearReport.')->group(function () {
                    Route::get('data', 'RoomYearReportController@data')->name('data');
                    Route::get('export', 'RoomYearReportController@export')->name('export');
                });
            });
            ################### End Hotels  Modules #####################

            ################### Start Laundries Modules #####################
            /**
             * laundries Module Routes
             */
            Route::resource('laundry', 'LaundryController');
            Route::prefix('laundries')->group(function () {
                Route:: as ('laundry.')->group(function () {
                    Route::get('data', 'LaundryController@data')->name('data');
                    Route::post('trash', 'LaundryController@trash')->name('trash');
                    Route::post('restore', 'LaundryController@restore')->name('restore');
                    Route::get('export', 'LaundryController@export')->name('export');
                    Route::get('{id}/inventories', 'LaundryController@inventories')->name('inventories');

                });
            });
            /**
             * laundry Services Module Routes
             */
            Route::resource('laundryService', 'LaundryServiceController');
            Route::prefix('laundryServices')->group(function () {
                Route:: as ('laundryService.')->group(function () {
                    Route::get('data', 'LaundryServiceController@data')->name('data');
                    Route::post('trash', 'LaundryServiceController@trash')->name('trash');
                    Route::post('restore', 'LaundryServiceController@restore')->name('restore');
                    Route::get('export', 'LaundryServiceController@export')->name('export');

                });
            });

            /**
             * laundry Categories Module Routes
             */
            Route::resource('laundryCategory', 'LaundryCategoryController');
            Route::prefix('laundryCategories')->group(function () {
                Route:: as ('laundryCategory.')->group(function () {
                    Route::get('data', 'LaundryCategoryController@data')->name('data');
                    Route::post('trash', 'LaundryCategoryController@trash')->name('trash');
                    Route::post('restore', 'LaundryCategoryController@restore')->name('restore');
                    Route::get('export', 'LaundryCategoryController@export')->name('export');

                });
            });

            /**
             * laundry Sub Categories Module Routes
             */
            Route::resource('laundrySubCategory', 'LaundrySubCategoryController');
            Route::prefix('laundrySubCategories')->group(function () {
                Route:: as ('laundrySubCategory.')->group(function () {
                    Route::get('data', 'LaundrySubCategoryController@data')->name('data');
                    Route::post('trash', 'LaundrySubCategoryController@trash')->name('trash');
                    Route::post('restore', 'LaundrySubCategoryController@restore')->name('restore');
                    Route::get('export', 'LaundrySubCategoryController@export')->name('export');
                    Route::get('get-service-row', 'LaundrySubCategoryController@getServiceRow')->name('get.service.row');
                });
            });

            /**
             * laundry Order Module Routes
             */
            Route::resource('laundryOrder', 'LaundryOrderController');
            Route::prefix('laundryOrders')->group(function () {
                Route:: as ('laundryOrder.')->group(function () {
                    Route::get('data', 'LaundryOrderController@data')->name('data');
                    Route::get('details/{id}', 'LaundryOrderController@details')->name('details');
                    Route::post('trash', 'LaundryOrderController@trash')->name('trash');
                    Route::post('restore', 'LaundryOrderController@restore')->name('restore');
                    Route::get('export', 'LaundryOrderController@export')->name('export');
                    Route::get('get-service-row', 'LaundryOrderController@getServiceRow')->name('get.service.row');
                    Route::get('get-subCategories', 'LaundryOrderController@getSubCategories')->name('get.subCategories');
                    Route::get('get-subCategories-services', 'LaundryOrderController@getSubCategoriesServices')->name('get.subCategories.services');
                    Route::get('get-subCategory-service-price', 'LaundryOrderController@getSubCategoryServicePrice')->name('get.subCategory.service.price');
                    Route::get('{id}/payment', 'LaundryOrderController@payment')->name('payment');
                    Route::post('payment', 'LaundryOrderController@addPayment')->name('addPayment');
                });
            });

            /**
             * laundry Order Module Routes
             */
            Route::resource('returnLaundryOrder', 'ReturnLaundryOrderController');
            Route::prefix('returnLaundryOrders')->group(function () {
                Route:: as ('returnLaundryOrder.')->group(function () {
                    Route::get('data', 'ReturnLaundryOrderController@data')->name('data');
                    Route::get('export', 'ReturnLaundryOrderController@export')->name('export');
                    Route::get('get-service-row', 'ReturnLaundryOrderController@getServiceRow')->name('get.service.row');
                    Route::get('get-subCategories', 'ReturnLaundryOrderController@getSubCategories')->name('get.subCategories');
                    Route::get('get-subCategories-services', 'ReturnLaundryOrderController@getSubCategoriesServices')->name('get.subCategories.services');
                    Route::get('get-subCategory-service-price', 'ReturnLaundryOrderController@getOrderDetails')->name('get.subCategory.service.price');
                    Route::get('get-order-details', 'ReturnLaundryOrderController@getOrderDetails')->name('get.order.details');

                });
            });

            /**
             * laundry Iskan Order Module Routes
             */
            Route::resource('laundryHotelOrder', 'LaundryHotelOrderController');
            Route::prefix('laundryHotelOrders')->group(function () {
                Route:: as ('laundryHotelOrder.')->group(function () {
                    Route::get('data', 'LaundryHotelOrderController@data')->name('data');
                    Route::post('trash', 'LaundryHotelOrderController@trash')->name('trash');
                    Route::post('restore', 'LaundryHotelOrderController@restore')->name('restore');
                    Route::get('export', 'LaundryHotelOrderController@export')->name('export');
                    Route::get('get-subCategories', 'LaundryHotelOrderController@getSubCategories')->name('get.subCategories');
                    Route::get('get-service-row', 'LaundryHotelOrderController@getServiceRow')->name('get.service.row');
                    Route::get('get-subCategories-services', 'LaundryHotelOrderController@getSubCategoriesServices')->name('get.subCategories.services');
                    Route::get('get-subCategory-service-price', 'LaundryHotelOrderController@getSubCategoryServicePrice')->name('get.subCategory.service.price');

                });
            });

            /**
             * laundry Service Order Module Routes
             */
            Route::resource('laundryServiceOrder', 'LaundryServiceOrderController');
            Route::prefix('laundryServiceOrders')->group(function () {
                Route:: as ('laundryServiceOrder.')->group(function () {
                    Route::get('data', 'LaundryServiceOrderController@data')->name('data');
                    Route::post('trash', 'LaundryServiceOrderController@trash')->name('trash');
                    Route::post('restore', 'LaundryServiceOrderController@restore')->name('restore');
                    Route::get('export', 'LaundryServiceOrderController@export')->name('export');
                });
            });

            /**
             * Inventory Order Module Routes
             */

            Route::resource('inventoryOrder', 'InventoryOrderController');
            Route::prefix('inventoryOrders')->group(function () {
                Route:: as ('inventoryOrder.')->group(function () {
                    Route::get('data', 'InventoryOrderController@data')->name('data');
                    Route::post('trash', 'InventoryOrderController@trash')->name('trash');
                    Route::post('restore', 'InventoryOrderController@restore')->name('restore');
                    Route::get('export', 'InventoryOrderController@export')->name('export');
                    Route::get('get-service-row', 'InventoryOrderController@getServiceRow')->name('get.service.row');
                    Route::get('change-order-status', 'InventoryOrderController@changeStatus')->name('change.order.status');
                    Route::get('cancel-order', 'InventoryOrderController@cancelOrder')->name('cancel.order');
                    Route::get('{id}/consumption', 'InventoryOrderController@consumption')->name('consumption');

                });
            });

            /**
             *  Laundry InventoryModule Routes
             */
            Route::resource('laundryInventory', 'LaundryInventoryController');
            Route::prefix('laundryInventories')->group(function () {
                Route:: as ('laundryInventory.')->group(function () {
                    Route::get('data', 'LaundryInventoryController@data')->name('data');
                    Route::get('export', 'LaundryInventoryController@export')->name('export');
                    Route::get('{id}/consumption', 'LaundryInventoryController@consumption')->name('consumption');
                    Route::post('save', 'LaundryInventoryController@save')->name('save');
                });
            });
            Route::prefix('LaundryStockings')->group(function () {
                Route:: as ('LaundryStocking.')->group(function () {
                    Route::get('index/{id}', 'LaundryStockingController@index')->name('index');
                    Route::get('data/{id}', 'LaundryStockingController@data')->name('data');

                    Route::get('create/{id}', 'LaundryStockingController@create')->name('create');
                    Route::post('store', 'LaundryStockingController@store')->name('store');
                    Route::get('detail/{id}', 'LaundryStockingController@detail')->name('detail');

                });
            });
            ################### End Laundries Modules #####################

            ################### Start Menu Modules #####################

            /**
             * Menu Categories Module Routes
             */
            Route::resource('menuCategory', 'MenuCategoryController');
            Route::prefix('menuCategories')->group(function () {
                Route:: as ('menuCategory.')->group(function () {
                    Route::get('data', 'MenuCategoryController@data')->name('data');
                    Route::post('trash', 'MenuCategoryController@trash')->name('trash');
                    Route::post('restore', 'MenuCategoryController@restore')->name('restore');
                    Route::get('export', 'MenuCategoryController@export')->name('export');

                });
            });

            /**
             * Preparation Areas Module Routes
             */
            Route::resource('preparationArea', 'PreparationAreaController');
            Route::prefix('preparationAreas')->group(function () {
                Route:: as ('preparationArea.')->group(function () {
                    Route::get('data', 'PreparationAreaController@data')->name('data');
                    Route::post('trash', 'PreparationAreaController@trash')->name('trash');
                    Route::post('restore', 'PreparationAreaController@restore')->name('restore');
                    Route::get('export', 'PreparationAreaController@export')->name('export');
                    Route::get('{id}/inventories', 'PreparationAreaController@inventories')->name('inventories');

                    Route::get('{id}/orders/items', 'PreparationAreaController@viewOrdersItmes')->name('orders.items');
                    Route::get('orders/items/data/{id}', 'PreparationAreaController@ordersItemData')->name('orders.items.data');

                    Route::get('{id}/reservations/items', 'PreparationAreaController@viewReservationsItmes')->name('reservations.items');
                    Route::get('orders/reservations/data/{id}', 'PreparationAreaController@reservationsItemData')->name('reservations.items.data');

                    Route::get('{id}/orders/item/details', 'PreparationAreaController@viewOrdersItmeDetail')->name('orders.item.detail');
                    Route::get('{id}/orders/item/ready', 'PreparationAreaController@orderItmeReady')->name('orders.item.ready');
                    Route::get('{id}/order/item/shortcomings', 'PreparationAreaController@orderShortcomings')->name('orders.item.shortcomings');

                    Route::get('{id}/retrieval/order', 'PreparationAreaController@createRetrievalOrder')->name('create.retrieval.order');
                    Route::post('store/retrieval/order', 'PreparationAreaController@storeRetrievalOrder')->name('store.retrieval.order');
                    Route::get('retrieval/orders', 'PreparationAreaController@getRetrievalOrders')->name('get.retrieval.orders');
                    Route::get('{id}/approve/retrieval/order', 'PreparationAreaController@approveRetrievalOrder')->name('approve.retrieval.order');
                    Route::get('{id}/cancel/retrieval/order', 'PreparationAreaController@cancelRetrievalOrder')->name('cancel.retrieval.order');

                    Route::get('{id}/manufactured/ingredent', 'PreparationAreaController@mortalIngredent')->name('manufactured.ingredent');
                    Route::post('calc/quantity/manufactured', 'PreparationAreaController@calcManufacturedQty')->name('calc.manufactured.qty');

                    Route::post('get/calc_cost', 'PreparationAreaController@getCalc_cost')->name('calc_cost');
                    Route::post('store/manufactured/ings', 'PreparationAreaController@storeManufacturedIngs')->name('store.manufactured.ings');

                });
            });

            /**
             * Preparation Area stocking Module Routes
             */
            Route::prefix('PreparationAreaStockings')->group(function () {
                Route:: as ('PreparationAreaStocking.')->group(function () {
                    Route::get('index/{id}', 'PreparationAreaStockingController@index')->name('index');
                    Route::get('data/{id}', 'PreparationAreaStockingController@data')->name('data');

                    Route::get('create/{id}', 'PreparationAreaStockingController@create')->name('create');
                    Route::post('store', 'PreparationAreaStockingController@store')->name('store');
                    Route::get('detail/{id}', 'PreparationAreaStockingController@detail')->name('detail');

                });
            });

            /**
             * PO stocking Module Routes
             */
            Route::prefix('POStockings')->group(function () {
                Route:: as ('POStocking.')->group(function () {
                    Route::get('index/{id}', 'POStockingController@index')->name('index');
                    Route::get('data/{id}', 'POStockingController@data')->name('data');

                    Route::get('create/{id}', 'POStockingController@create')->name('create');
                    Route::post('store', 'POStockingController@store')->name('store');
                    Route::get('detail/{id}', 'POStockingController@detail')->name('detail');

                });
            });

            /**
             * Preparation Area Order Module Routes
             */
            Route::resource('preparationAreaOrder', 'PreparationAreaOrderController');
            Route::prefix('preparationAreaOrders')->group(function () {
                Route:: as ('preparationAreaOrder.')->group(function () {
                    Route::get('data', 'PreparationAreaOrderController@data')->name('data');
                    Route::get('export', 'PreparationAreaOrderController@export')->name('export');
                    Route::get('get-service-row', 'PreparationAreaOrderController@getServiceRow')->name('get.service.row');
                    Route::get('change-order-status', 'PreparationAreaOrderController@changeStatus')->name('change.order.status');
                    Route::get('cancel-order', 'PreparationAreaOrderController@cancelOrder')->name('cancel.order');
                    Route::get('{id}/consumption', 'PreparationAreaOrderController@consumption')->name('consumption');

                });
            });

            /**
             *  Laundry InventoryModule Routes
             */
            Route::resource('preparationAreaInventory', 'PreparationAreaInventoryController');
            Route::prefix('preparationAreaInventories')->group(function () {
                Route:: as ('preparationAreaInventory.')->group(function () {
                    Route::get('data', 'PreparationAreaInventoryController@data')->name('data');
                    Route::get('export', 'PreparationAreaInventoryController@export')->name('export');
                    Route::get('{id}/consumption', 'PreparationAreaInventoryController@consumption')->name('consumption');
                    Route::post('save', 'PreparationAreaInventoryController@save')->name('save');
                });
            });

            /**
             * Point Of Sales Module Routes
             */
            Route::resource('pointOfSale', 'PointOfSaleController');
            Route::prefix('pointOfSales')->group(function () {
                Route:: as ('pointOfSale.')->group(function () {
                    Route::get('data', 'PointOfSaleController@data')->name('data');
                    Route::post('trash', 'PointOfSaleController@trash')->name('trash');
                    Route::post('restore', 'PointOfSaleController@restore')->name('restore');
                    Route::get('export', 'PointOfSaleController@export')->name('export');
                    Route::get('{id}/inventories', 'PointOfSaleController@inventories')->name('inventories');
                    Route::get('{id}/order', 'PointOfSaleController@makeOrder')->name('make.order');

                    Route::post('start/shift', 'PointOfSaleController@startShift')->name('start-shift');
                    Route::post('end/shift', 'PointOfSaleController@endShift')->name('end-shift');

                    Route::get('get-ingredients-row', 'PointOfSaleController@getIngredientsRow')->name('get.ingredients.row');
                    Route::post('get-ingredients-tags', 'PointOfSaleController@getIngredientsTags')->name('get.ingredients.tags');
                    Route::post('store/order', 'PointOfSaleController@storeOrder')->name('store.order');
                    Route::get('edit/order/view/{id}', 'PointOfSaleController@editOrderView')->name('edit.order.view');
                    Route::post('update/order', 'PointOfSaleController@updateOrder')->name('update.order');

                    Route::get('close/order/view/{id}', 'PointOfSaleController@closeOrderView')->name('close.order.view');

                    Route::get('close/order{id}', 'PointOfSaleController@closeOrder')->name('close.order');

                    Route::get('orders/{id}', 'PointOfSaleController@orders')->name('orders');
                    Route::get('orders/data/{id}', 'PointOfSaleController@ordersData')->name('orders.data');

                    Route::get('all/orders', 'PointOfSaleController@allOrders')->name('all.orders');
                    Route::get('all/orders/data', 'PointOfSaleController@allOrdersData')->name('all.orders.data');

                    Route::get('payments/{id}', 'PointOfSaleController@payments')->name('payments');
                    Route::get('payments/data/{id}', 'PointOfSaleController@paymentsData')->name('payments.data');

                    Route::post('close/order', 'PointOfSaleController@closeOrderPayment')->name('close.order.payment');

                    Route::get('{id}/retrieval/order', 'PointOfSaleController@createRetrievalOrder')->name('create.retrieval.order');
                    Route::post('store/retrieval/order', 'PointOfSaleController@storeRetrievalOrder')->name('store.retrieval.order');
                    Route::get('retrieval/orders', 'PointOfSaleController@getRetrievalOrders')->name('get.retrieval.orders');
                    Route::get('{id}/approve/retrieval/order', 'PointOfSaleController@approveRetrievalOrder')->name('approve.retrieval.order');
                    Route::get('{id}/cancel/retrieval/order', 'PointOfSaleController@cancelRetrievalOrder')->name('cancel.retrieval.order');

                });
            });

            Route::prefix('pointOfSaleShiftSheets')->group(function () {
                Route:: as ('pointOfSaleShiftSheet.')->group(function () {
                    Route::get('/', 'PointOfSaleShiftSheetController@index')->name('index');
                    Route::get('data', 'PointOfSaleShiftSheetController@data')->name('data');
                    Route::get('export', 'PointOfSaleShiftSheetController@export')->name('export');
                    Route::get('today/visitors', 'PointOfSaleShiftSheetController@export')->name('export');
                });
            });

            Route::prefix('safes')->group(function () {
                Route:: as ('safe.')->group(function () {
                    Route::get('/', 'SafeController@index')->name('index');
                    Route::get('data', 'SafeController@data')->name('data');
                    //  Route::get('export', 'PointOfSaleShiftSheetController@export')->name('export');
                    Route::get('reserve/{id}', 'SafeController@reserve')->name('reserve');

                    Route::get('receipts', 'SafeController@receiptsIndex')->name('receiptsIndex');
                    Route::get('receiptsData', 'SafeController@receiptsData')->name('receiptsData');

                    Route::get('supply/{id}', 'SafeController@supply')->name('supply');
                    Route::post('store/supply', 'SafeController@storeSupply')->name('store.supply');

                    Route::get('bank/supply', 'SafeController@bankSupply')->name('bankSupply');
                    Route::get('bankSupplyData', 'SafeController@bankSupplyData')->name('bankSupplyData');
                    Route::get('bank/supply/download/{id}', 'SafeController@downloadBankSupply')->name('bankSupply.download');

                });
            });

            Route::prefix('spend_permissions')->group(function () {
                Route:: as ('spend_permission.')->group(function () {
                    Route::get('hotel/spend_permission', 'SpenPermissionController@hotelSpendPermissionindex')->name('hotel.spend_permission.index');
                    Route::get('hotel/spend_permission/data', 'SpenPermissionController@hotelSpendPermissionData')->name('hotel.spend_permission.data');
                    Route::get('hotel/spend_permission/export', 'SpenPermissionController@hotelSpendPermissionExport')->name('hotel.spend_permission.export');

                    Route::get('hotel/spend/permission', 'SpendPermissionController@hotelSpendPermissionindex')->name('hotel.spend.index');
                    Route::get('hotel/spend/permission/data', 'SpendPermissionController@hotelSpendPermissionData')->name('hotel.spend.data');
                    Route::get('hotel/spend/permission/export', 'SpendPermissionController@hotelSpendPermissionExport')->name('hotel.spend.export');

                    Route::get('laundry/spend_permission', 'SpenPermissionController@laundrySpendPermissionindex')->name('laundry.spend_permission.index');
                    Route::get('laundry/spend_permission/data', 'SpenPermissionController@laundrySpendPermissionData')->name('laundry.spend_permission.data');
                    Route::get('laundry/spend_permission/export', 'SpenPermissionController@laundrySpendPermissionExport')->name('laundry.spend_permission.export');

                    Route::get('laundry/spend/permission', 'SpendPermissionController@laundrySpendPermissionindex')->name('laundry.spend.index');
                    Route::get('laundry/spend/permission/data', 'SpendPermissionController@laundrySpendPermissionData')->name('laundry.spend.data');
                    Route::get('laundry/spend/permission/export', 'SpendPermissionController@laundrySpendPermissionExport')->name('laundry.spend.export');

                    Route::get('po/spend_permission', 'SpenPermissionController@poSpendPermissionindex')->name('po.spend_permission.index');
                    Route::get('po/spend_permission/data', 'SpenPermissionController@poSpendPermissionData')->name('po.spend_permission.data');
                    Route::get('po/spend_permission/export', 'SpenPermissionController@poSpendPermissionExport')->name('po.spend_permission.export');

                    Route::get('po/spend/permission', 'SpendPermissionController@poSpendPermissionindex')->name('po.spend.index');
                    Route::get('po/spend/permission/data', 'SpendPermissionController@poSpendPermissionData')->name('po.spend.data');
                    Route::get('po/spend/permission/export', 'SpendPermissionController@poSpendPermissionExport')->name('po.spend.export');

                    Route::get('prep/spend_permission', 'SpenPermissionController@prepSpendPermissionindex')->name('prep.spend_permission.index');
                    Route::get('prep/spend_permission/data', 'SpenPermissionController@prepSpendPermissionData')->name('prep.spend_permission.data');
                    Route::get('prep/spend_permission/export', 'SpenPermissionController@prepSpendPermissionExport')->name('prep.spend_permission.export');

                    Route::get('prep/spend/permission', 'SpendPermissionController@prepSpendPermissionindex')->name('prep.spend.index');
                    Route::get('prep/spend/permission/data', 'SpendPermissionController@prepSpendPermissionData')->name('prep.spend.data');
                    Route::get('prep/spend/permission/export', 'SpendPermissionController@prepSpendPermissionExport')->name('prep.spend.export');

                    Route::get('purchase/spend/permission', 'SpendPermissionController@purchaseSpendPermissionIndex')->name('purchase.spend.index');
                    Route::get('purchase/spend/permission/data', 'SpendPermissionController@purchaseSpendPermissionData')->name('purchase.spend.data');
                    Route::get('purchase/spend/permission/export', 'SpendPermissionController@purchaseSpendPermissionExport')->name('purchase.spend.export');
                });
            });

            Route::prefix('priceReports')->group(function () {
                Route:: as ('priceReport.')->group(function () {

                    Route::get('vendor', 'VendorPriceController@VendorPriceIndex')->name('vendor.index');
                    Route::get('vendor/data', 'VendorPriceController@VendorPriceData')->name('vendor.data');
                    Route::get('vendor/export', 'VendorPriceController@VendorPriceExport')->name('vendor.export');

                });
            });
            Route::prefix('goodsReports')->group(function () {
                Route:: as ('goodsReport.')->group(function () {

                    Route::get('/', 'GoodsReportController@GoodsReportIndex')->name('index');
                    Route::get('data', 'GoodsReportController@GoodsReportData')->name('data');
                    Route::get('export', 'GoodsReportController@GoodsReportExport')->name('export');

                });
            });
            Route::prefix('expirationDates')->group(function () {
                Route:: as ('expirationDate.')->group(function () {

                    Route::get('/', 'ExpirationDateController@ExpirationDateIndex')->name('index');
                    Route::get('data', 'ExpirationDateController@ExpirationDateData')->name('data');
                    Route::get('export', 'ExpirationDateController@ExpirationDateExport')->name('export');

                });
            });
            Route::prefix('damageReports')->group(function () {
                Route:: as ('damageReport.')->group(function () {
                    Route::get('/', 'DamageReportController@DamageReportIndex')->name('index');
                    Route::get('data', 'DamageReportController@DamageReportData')->name('data');
                    Route::get('export', 'DamageReportController@DamageReportExport')->name('export');

                });
            });
            Route::prefix('purchaseOrderReports')->group(function () {
                Route:: as ('purchaseOrderReport.')->group(function () {
                    Route::get('/', 'PurchaseOrderReportController@PurchaseOrderReportIndex')->name('index');
                    Route::get('data', 'PurchaseOrderReportController@PurchaseOrderReportData')->name('data');
                    Route::get('export', 'PurchaseOrderReportController@PurchaseOrderReportExport')->name('export');

                });
            });
            Route::prefix('minMaxIngredients')->group(function () {
                Route:: as ('minMaxIngredient.')->group(function () {
                    Route::get('/', 'MinMaxIngredientController@MinMaxIngredientIndex')->name('index');
                    Route::get('data', 'MinMaxIngredientController@MinMaxIngredientData')->name('data');
                    Route::get('export', 'MinMaxIngredientController@MinMaxIngredientExport')->name('export');

                });
            });
            Route::prefix('stockBalances')->group(function () {
                Route:: as ('stockBalance.')->group(function () {
                    Route::get('/', 'StockBalanceController@StockBalanceIndex')->name('index');
                    Route::get('data', 'StockBalanceController@StockBalanceData')->name('data');
                    Route::get('export', 'StockBalanceController@StockBalanceExport')->name('export');

                });
            });
            Route::prefix('inventoryBalances')->group(function () {
                Route:: as ('inventoryBalance.')->group(function () {
                    Route::get('/', 'InventoryBalanceController@InventoryBalanceIndex')->name('index');
                    Route::get('data', 'InventoryBalanceController@InventoryBalanceData')->name('data');
                    Route::get('export', 'InventoryBalanceController@InventoryBalanceExport')->name('export');

                });
            });
            Route::prefix('AreaConsumptions')->group(function () {
                Route:: as ('AreaConsumption.')->group(function () {
                    Route::get('/', 'AreaConsumptionController@AreaConsumptionIndex')->name('index');
                    Route::get('data', 'AreaConsumptionController@AreaConsumptionData')->name('data');
                    Route::get('export', 'AreaConsumptionController@AreaConsumptionExport')->name('export');

                });
            });

            Route::prefix('prepAreaNotifications')->group(function () {
                Route:: as ('prepAreaNotification.')->group(function () {
                    Route::get('/{id}', 'PrepAreaNotificationController@index')->name('index');
                    Route::get('data/{id}', 'PrepAreaNotificationController@data')->name('data');

                });
            });

            Route::prefix('Hrs')->group(function () {
                Route:: as ('Hr.')->group(function () {
                    Route::get('/notifications', 'HrNotificationController@notifications')->name('notification');

                });
            });

            Route::prefix('PoConsumptions')->group(function () {
                Route:: as ('PoConsumption.')->group(function () {
                    Route::get('/', 'PoConsumptionController@PoConsumptionIndex')->name('index');
                    Route::get('data', 'PoConsumptionController@PoConsumptionData')->name('data');
                    Route::get('export', 'PoConsumptionController@PoConsumptionExport')->name('export');

                });
            });
            Route::prefix('HotelConsumptions')->group(function () {
                Route:: as ('HotelConsumption.')->group(function () {
                    Route::get('/', 'HotelConsumptionController@HotelConsumptionIndex')->name('index');
                    Route::get('data', 'HotelConsumptionController@HotelConsumptionData')->name('data');
                    Route::get('export', 'HotelConsumptionController@HotelConsumptionExport')->name('export');

                });
            });
            Route::prefix('LaundryConsumptions')->group(function () {
                Route:: as ('LaundryConsumption.')->group(function () {
                    Route::get('/', 'LaundryConsumptionController@LaundryConsumptionIndex')->name('index');
                    Route::get('data', 'LaundryConsumptionController@LaundryConsumptionData')->name('data');
                    Route::get('export', 'LaundryConsumptionController@LaundryConsumptionExport')->name('export');

                });
            });
            Route::prefix('IngredientConsumptions')->group(function () {
                Route:: as ('IngredientConsumption.')->group(function () {
                    Route::get('/', 'IngredientConsumptionController@IngredientConsumptionIndex')->name('index');
                    Route::get('data', 'IngredientConsumptionController@IngredientConsumptionData')->name('data');
                    Route::get('export', 'IngredientConsumptionController@IngredientConsumptionExport')->name('export');

                });
            });
            Route::prefix('HotelConsumptionDetails')->group(function () {
                Route:: as ('HotelConsumptionDetail.')->group(function () {
                    Route::get('/{id}', 'HotelConsumptionDetailController@HotelConsumptionDetailIndex')->name('index');
                    Route::get('data/{id}', 'HotelConsumptionDetailController@HotelConsumptionDetailData')->name('data');
                    Route::get('export/{id}', 'HotelConsumptionDetailController@HotelConsumptionDetailExport')->name('export');

                });
            });
            Route::prefix('AreaConsumptionDetails')->group(function () {
                Route:: as ('AreaConsumptionDetail.')->group(function () {
                    Route::get('/{id}', 'AreaConsumptionDetailController@AreaConsumptionDetailIndex')->name('index');
                    Route::get('data/{id}', 'AreaConsumptionDetailController@AreaConsumptionDetailData')->name('data');
                    Route::get('export/{id}', 'AreaConsumptionDetailController@AreaConsumptionDetailExport')->name('export');

                });
            });
            Route::prefix('PoConsumptionDetails')->group(function () {
                Route:: as ('PoConsumptionDetail.')->group(function () {
                    Route::get('/{id}', 'PoConsumptionDetailController@PoConsumptionDetailIndex')->name('index');
                    Route::get('data/{id}', 'PoConsumptionDetailController@PoConsumptionDetailData')->name('data');
                    Route::get('export/{id}', 'PoConsumptionDetailController@PoConsumptionDetailExport')->name('export');

                });
            });
            Route::prefix('LaundryConsumptionDetails')->group(function () {
                Route:: as ('LaundryConsumptionDetail.')->group(function () {
                    Route::get('/{id}', 'LaundryConsumptionDetailController@LaundryConsumptionDetailIndex')->name('index');
                    Route::get('data/{id}', 'LaundryConsumptionDetailController@LaundryConsumptionDetailData')->name('data');
                    Route::get('export/{id}', 'LaundryConsumptionDetailController@LaundryConsumptionDetailExport')->name('export');

                });
            });
            Route::prefix('IngredientConsumptionDetails')->group(function () {
                Route:: as ('IngredientConsumptionDetail.')->group(function () {
                    Route::get('/{id}', 'IngredientConsumptionDetailController@IngredientConsumptionDetailIndex')->name('index');
                    Route::get('data/{id}', 'IngredientConsumptionDetailController@IngredientConsumptionDetailData')->name('data');
                    Route::get('export/{id}', 'IngredientConsumptionDetailController@IngredientConsumptionDetailExport')->name('export');

                });
            });
            Route::prefix('ItemComponents')->group(function () {
                Route:: as ('ItemComponent.')->group(function () {
                    Route::get('/', 'ItemComponentController@ItemComponentIndex')->name('index');
                    Route::get('data', 'ItemComponentController@ItemComponentData')->name('data');
                    Route::get('export', 'ItemComponentController@ItemComponentExport')->name('export');

                });
            });
            Route::prefix('IngredientComponents')->group(function () {
                Route:: as ('IngredientComponent.')->group(function () {
                    Route::get('/', 'IngredientComponentController@IngredientComponentIndex')->name('index');
                    Route::get('data', 'IngredientComponentController@IngredientComponentData')->name('data');
                    Route::get('export', 'IngredientComponentController@IngredientComponentExport')->name('export');

                });
            });
            Route::prefix('IngredientTotals')->group(function () {
                Route:: as ('IngredientTotal.')->group(function () {
                    Route::get('/', 'IngredientTotalController@IngredientTotalIndex')->name('index');
                    Route::get('data', 'IngredientTotalController@IngredientTotalData')->name('data');
                    Route::get('export', 'IngredientTotalController@IngredientTotalExport')->name('export');

                });
            });
            Route::prefix('CategoryTotals')->group(function () {
                Route:: as ('CategoryTotal.')->group(function () {
                    Route::get('/', 'CategoryTotalController@CategoryTotalIndex')->name('index');
                    Route::get('data', 'CategoryTotalController@CategoryTotalData')->name('data');
                    Route::get('export', 'CategoryTotalController@CategoryTotalExport')->name('export');

                });
            });
            /**
             * Point Of Sale Order Module Routes
             */
            Route::resource('PointOfSaleOrder', 'PointOfSaleOrderController');
            Route::prefix('PointOfSaleOrders')->group(function () {
                Route:: as ('PointOfSaleOrder.')->group(function () {
                    Route::get('data', 'PointOfSaleOrderController@data')->name('data');
                    Route::post('trash', 'PointOfSaleOrderController@trash')->name('trash');
                    Route::post('restore', 'PointOfSaleOrderController@restore')->name('restore');
                    Route::get('export', 'PointOfSaleOrderController@export')->name('export');
                    Route::get('get-service-row', 'PointOfSaleOrderController@getServiceRow')->name('get.service.row');
                    Route::get('change-order-status', 'PointOfSaleOrderController@changeStatus')->name('change.order.status');
                    Route::get('cancel-order', 'PointOfSaleOrderController@cancelOrder')->name('cancel.order');
                    Route::get('{id}/consumption', 'PointOfSaleOrderController@consumption')->name('consumption');

                });
            });

            /**
             *  Laundry InventoryModule Routes
             */
            Route::resource('PointOfSaleInventory', 'PointOfSaleInventoryController');
            Route::prefix('PointOfSaleInventories')->group(function () {
                Route:: as ('PointOfSaleInventory.')->group(function () {
                    Route::get('data', 'PointOfSaleInventoryController@data')->name('data');
                    Route::get('export', 'PointOfSaleInventoryController@export')->name('export');
                    Route::get('{id}/consumption', 'PointOfSaleInventoryController@consumption')->name('consumption');
                    Route::post('save', 'PointOfSaleInventoryController@save')->name('save');
                });
            });

            ################### End Menu Modules #####################

            /**
             * ticket category Module Routes
             */
            Route::resource('ticketCategory', 'TicketCategoryController');
            Route::prefix('ticketCategories')->group(function () {
                Route:: as ('ticketCategory.')->group(function () {
                    Route::get('data', 'TicketCategoryController@data')->name('data');
                    Route::post('trash', 'TicketCategoryController@trash')->name('trash');
                    Route::post('restore', 'TicketCategoryController@restore')->name('restore');
                    Route::get('export', 'TicketCategoryController@export')->name('export');
                });
            });

            /**
             * ticket sub category Module Routes
             */
            Route::resource('ticketSubCategory', 'TicketSubCategoryController');
            Route::prefix('ticketSubCategories')->group(function () {
                Route:: as ('ticketSubCategory.')->group(function () {
                    Route::get('data', 'TicketSubCategoryController@data')->name('data');
                    Route::post('trash', 'TicketSubCategoryController@trash')->name('trash');
                    Route::post('restore', 'TicketSubCategoryController@restore')->name('restore');
                    Route::get('export', 'TicketSubCategoryController@export')->name('export');
                });
            });

            /**
             * ticket ticket prices Module Routes
             */
            Route::resource('ticketPrice', 'TicketPriceController');
            Route::prefix('ticketPrices')->group(function () {
                Route:: as ('ticketPrice.')->group(function () {
                    Route::get('data', 'TicketPriceController@data')->name('data');
                    Route::get('export', 'TicketPriceController@export')->name('export');
                });
            });

            /**
             * Rent Space Module Routes
             */
            Route::resource('rentSpace', 'RentSpaceController');
            Route::prefix('rentSpaces')->group(function () {
                Route:: as ('rentSpace.')->group(function () {
                    Route::get('data', 'RentSpaceController@data')->name('data');
                    Route::post('trash', 'RentSpaceController@trash')->name('trash');
                    Route::post('restore', 'RentSpaceController@restore')->name('restore');
                    Route::get('export', 'RentSpaceController@export')->name('export');
                });
            });

            /**
             * Tenants Module Routes
             */
            Route::resource('tenant', 'TenantController')->except('show');
            Route::prefix('tenants')->group(function () {
                Route:: as ('tenant.')->group(function () {
                    Route::get('data', 'TenantController@data')->name('data');
                    Route::post('trash', 'TenantController@trash')->name('trash');
                    Route::get('destroy/file/{id}', 'TenantController@destroyFile')->name('file.destroy');
                    Route::post('restore', 'TenantController@restore')->name('restore');
                    Route::get('export', 'TenantController@export')->name('export');
                });
            });

            /**
             * Tenants Module Routes
             */
            Route::resource('rentContract', 'RentContractController');
            Route::prefix('rentContracts')->group(function () {
                Route:: as ('rentContract.')->group(function () {
                    Route::get('data', 'RentContractController@data')->name('data');
                    Route::post('trash', 'RentContractController@trash')->name('trash');
                    Route::post('restore', 'RentContractController@restore')->name('restore');
                    Route::get('export', 'RentContractController@export')->name('export');
                });
            });

            Route::prefix('rentContractPayment')->group(function () {
                Route:: as ('rentContractPayment.')->group(function () {
                    Route::get('/{id}', 'RentContractPaymentController@index')->name('index');
                    Route::get('data/{id}', 'RentContractPaymentController@data')->name('data');
                    Route::post('pay', 'RentContractPaymentController@pay')->name('pay');
                    Route::get('export/{id}', 'RentContractPaymentController@export')->name('export');
                });
            });

            /**
             * Gates Module Routes
             */
            Route::resource('gate', 'GateController');
            Route::prefix('gates')->group(function () {
                Route:: as ('gate.')->group(function () {
                    Route::get('data', 'GateController@data')->name('data');
                    Route::post('trash', 'GateController@trash')->name('trash');
                    Route::post('restore', 'GateController@restore')->name('restore');
                    Route::get('export', 'GateController@export')->name('export');
                });
            });

            /**
             * Gate Shifts Module Routes
             */
            Route::resource('gateShift', 'GateShiftController');
            Route::prefix('gateShifts')->group(function () {
                Route:: as ('gateShift.')->group(function () {
                    Route::get('data', 'GateShiftController@data')->name('data');
                    Route::post('trash', 'GateShiftController@trash')->name('trash');
                    Route::post('restore', 'GateShiftController@restore')->name('restore');
                    Route::get('export', 'GateShiftController@export')->name('export');
                });
            });

            Route::prefix('gateShiftSheets')->group(function () {
                Route:: as ('gateShiftSheet.')->group(function () {
                    Route::get('/', 'GateShiftSheetController@index')->name('index');
                    Route::get('data', 'GateShiftSheetController@data')->name('data');
                    Route::get('export', 'GateShiftSheetController@export')->name('export');
                    Route::get('today/visitors', 'GateShiftSheetController@export')->name('export');
                });
            });

            Route::prefix('todayVisitors')->group(function () {
                Route:: as ('todayVisitor.')->group(function () {
                    Route::get('rents', 'TodayVisitorController@indexRent')->name('rent-index');
                    Route::get('rents/data', 'TodayVisitorController@dataRent')->name('rent-data');
                    Route::get('rents/export', 'TodayVisitorController@exportRent')->name('rent-export');

                    Route::get('hotels', 'TodayVisitorController@indexHotel')->name('hotel-index');
                    Route::get('hotels/data', 'TodayVisitorController@dataHotel')->name('hotel-data');
                    Route::get('hotels/export', 'TodayVisitorController@exportHotel')->name('hotel-export');

                    Route::get('inventories', 'TodayVisitorController@indexInventory')->name('inventory-index');
                    Route::get('inventories/data', 'TodayVisitorController@dataInventory')->name('inventory-data');
                    Route::get('inventories/export', 'TodayVisitorController@exportInventory')->name('inventory-export');

                    Route::get('events', 'TodayVisitorController@indexEvent')->name('event-index');
                    Route::get('events/data', 'TodayVisitorController@dataEvent')->name('event-data');
                    Route::get('events/export', 'TodayVisitorController@exportEvent')->name('event-export');

                    Route::get('sports', 'TodayVisitorController@indexSport')->name('sport-index');
                    Route::get('sports/data', 'TodayVisitorController@dataSport')->name('sport-data');
                    Route::get('sports/export', 'TodayVisitorController@exportSport')->name('sport-export');
                });
            });

            /**
             * ticket Module Routes
             */
            Route::resource('ticket', 'TicketController');
            Route::prefix('tickets')->group(function () {
                Route:: as ('ticket.')->group(function () {
                    Route::get('data', 'TicketController@data')->name('data');
                    Route::post('trash', 'TicketController@trash')->name('trash');
                    Route::post('restore', 'TicketController@restore')->name('restore');
                    Route::get('export', 'TicketController@export')->name('export');
                    Route::post('list/prices', 'TicketController@getSubCategoryPrices')->name('prices');
                    Route::post('start/shift', 'TicketController@startShift')->name('start-shift');
                    Route::post('end/shift', 'TicketController@endShift')->name('end-shift');

                    Route::get('print_ticket/{id}', 'TicketController@print_ticket')->name('print_ticket');
                });
            });

            Route::resource('role', 'RoleController');
            Route::prefix('roles')->group(function () {
                Route:: as ('role.')->group(function () {
                    Route::get('data', 'RoleController@data')->name('data');
                    Route::post('trash', 'RoleController@trash')->name('trash');
                    Route::post('restore', 'RoleController@restore')->name('restore');
                    Route::get('export', 'RoleController@export')->name('export');
                });
            });

            /**
             * Supplier Module Routes
             */
            Route::resource('supplier', 'SupplierController');
            Route::prefix('suppliers')->group(function () {
                Route:: as ('supplier.')->group(function () {
                    Route::get('data', 'SupplierController@data')->name('data');
                    Route::post('trash', 'SupplierController@trash')->name('trash');
                    Route::post('restore', 'SupplierController@restore')->name('restore');
                    Route::get('export', 'SupplierController@export')->name('export');
                });
            });

            Route::prefix('resevedIngredentSuppliers')->group(function () {
                Route:: as ('resevedIngredentSupplier.')->group(function () {
                    Route::get('index', 'ResevedIngredentSupplierController@index')->name('index');
                    Route::get('data', 'ResevedIngredentSupplierController@data')->name('data');
                    Route::get('export', 'ResevedIngredentSupplierController@export')->name('export');
                });
            });

            Route::prefix('classAndOutgoings')->group(function () {
                Route:: as ('classAndOutgoing.')->group(function () {
                    Route::get('index', 'ClassAndOutgoingController@index')->name('index');
                    Route::get('data', 'ClassAndOutgoingController@data')->name('data');
                    Route::get('export', 'ClassAndOutgoingController@export')->name('export');
                });
            });

            Route::prefix('outgoings')->group(function () {
                Route:: as ('outgoing.')->group(function () {
                    Route::get('index', 'OutgoingController@index')->name('index');
                    Route::get('data', 'OutgoingController@data')->name('data');
                    Route::get('export', 'OutgoingController@export')->name('export');
                });
            });

            Route::prefix('diffOutgoingInComings')->group(function () {
                Route:: as ('diffOutgoingInComing.')->group(function () {
                    Route::get('index', 'DiffOutgoingInComingController@index')->name('index');
                    Route::get('data', 'DiffOutgoingInComingController@data')->name('data');
                    Route::get('export', 'DiffOutgoingInComingController@export')->name('export');
                });
            });

            Route::prefix('allOutgoings')->group(function () {
                Route:: as ('allOutgoing.')->group(function () {
                    Route::get('index', 'AllOutgoingController@index')->name('index');
                    Route::get('data', 'AllOutgoingController@data')->name('data');
                    Route::get('export', 'AllOutgoingController@export')->name('export');
                });
            });

            /**
             * Supplier Service Module Routes
             */
            Route::resource('supplierService', 'SupplierServiceController');
            Route::prefix('supplierServices')->group(function () {
                Route:: as ('supplierService.')->group(function () {
                    Route::get('data', 'SupplierServiceController@data')->name('data');
                    Route::post('trash', 'SupplierServiceController@trash')->name('trash');
                    Route::post('restore', 'SupplierServiceController@restore')->name('restore');
                    Route::get('export', 'SupplierServiceController@export')->name('export');
                });
            });

            /**
             * Event Type Module Routes
             */
            Route::resource('eventType', 'EventTypeController');
            Route::prefix('eventTypes')->group(function () {
                Route:: as ('eventType.')->group(function () {
                    Route::get('data', 'EventTypeController@data')->name('data');
                    Route::post('trash', 'EventTypeController@trash')->name('trash');
                    Route::post('restore', 'EventTypeController@restore')->name('restore');
                    Route::get('export', 'EventTypeController@export')->name('export');
                });
            });

            /**
             * Package Module Routes
             */
            Route::resource('package', 'PackageController');
            Route::prefix('packages')->group(function () {
                Route:: as ('package.')->group(function () {
                    Route::get('data', 'PackageController@data')->name('data');
                    Route::post('trash', 'PackageController@trash')->name('trash');
                    Route::post('restore', 'PackageController@restore')->name('restore');
                    Route::get('export', 'PackageController@export')->name('export');
                    Route::get('get-hall-capacity', 'PackageController@getHallCapacity')->name('get.hall.capacity');
                    Route::get('get-item-row', 'PackageController@getItemRow')->name('get.item.row');
                    Route::get('get-item-price', 'PackageController@getItemPrice')->name('get.item.price');
                    Route::get('get-service-row', 'PackageController@getServiceRow')->name('get.service.row');
                    Route::get('get-service-price', 'PackageController@getServicePrice')->name('get.service.price');
                    Route::get('get-product-row', 'PackageController@getProductRow')->name('get.product.row');
                    Route::get('get-product-price', 'PackageController@getProductPrice')->name('get.product.price');

                });
            });

            /**
             * Reservation Module Routes
             */
            Route::resource('reservation', 'ReservationController');
            Route::prefix('reservations')->group(function () {
                Route:: as ('reservation.')->group(function () {
                    Route::get('data', 'ReservationController@data')->name('data');
                    Route::post('trash', 'ReservationController@trash')->name('trash');
                    Route::post('restore', 'ReservationController@restore')->name('restore');
                    Route::get('export', 'ReservationController@export')->name('export');
                    Route::get('{id}/payment', 'ReservationController@payment')->name('payment');
                    Route::post('payment', 'ReservationController@addPayment')->name('addPayment');
                    Route::get('{id}/supplierPayment', 'ReservationController@supplierPayment')->name('supplier.payment');
                    Route::post('supplierPayment', 'ReservationController@addSupplierPayment')->name('supplier.addPayment');
                    Route::get('get-supplier-remaining-amount', 'ReservationController@getSupplierRemainingAmount')->name('get.supplier.remaining.amount');
                    Route::get('get-hall-events', 'ReservationController@appendEvents')->name('get.hall.events');
                    Route::get('get-hall-packages', 'ReservationController@appendPackages')->name('get.hall.packages');
                    Route::get('get-package-price', 'ReservationController@getPackagePrice')->name('get.package.price');
                    Route::get('get-service-row', 'ReservationController@getServiceRow')->name('get.service.row');
                    Route::get('get-contact-row', 'ReservationController@getContactRow')->name('get.contact.row');
                    Route::get('get-service-price', 'ReservationController@getServicePrice')->name('get.service.price');
                    Route::get('get-supplier-remaining', 'ReservationController@supplierRemaining')->name('get.supplier.remaining');
                    Route::get('get-product-row', 'ReservationController@getProductRow')->name('get.product.row');
                    Route::get('get-product-price', 'ReservationController@getProductPrice')->name('get.product.price');
                    Route::get('{id}/confirm', 'ReservationController@confirm')->name('confirm');
                    Route::get('{id}/confirm', 'ReservationController@confirm')->name('confirm');
                    Route::get('{id}/cancel', 'ReservationController@cancel')->name('cancel');
                    Route::get('{id}/confirm/discount', 'ReservationController@confirmDiscount')->name('confirm.discount');
                    Route::get('{id}/cancel/discount', 'ReservationController@cancelDiscount')->name('cancel.discount');
                    Route::get('get-ticket-price', 'ReservationController@getTicketPrice')->name('get.ticket.price');
                    Route::get('{id}/money/back', 'ReservationController@moneyBack')->name('money.back');
                    Route::post('money/back', 'ReservationController@addMoneyBack')->name('add.money.back');
                    Route::get('append/information', 'ReservationController@appendInformation')->name('append.information');
                    Route::get('print/reservation/{id}', 'ReservationController@print_reservation')->name('print_reservation');

                });
            });

            /**
             * Report Module Routes
             */
            Route::prefix('reports')->group(function () {
                Route:: as ('report.')->group(function () {

                    Route::get('reservations', 'ReportController@reservations')->name('reservations');
                    Route::get('data', 'ReportController@data')->name('data');
                    Route::get('export', 'ReportController@export')->name('export');

                    Route::get('customers', 'ReportController@customers')->name('customers');
                    Route::get('data-customers', 'ReportController@data_customers')->name('data_customers');
                    Route::get('export-customers', 'ReportController@export_customers')->name('export_customers');

                    Route::get('transactions', 'ReportController@transactions')->name('transactions');
                    Route::get('data-transactions', 'ReportController@data_transactions')->name('data_transactions');
                    Route::get('export-transactions', 'ReportController@export_transactions')->name('export_transactions');

                    Route::get('revenue', 'ReportController@revenue')->name('revenue');
                    Route::get('data-revenue', 'ReportController@data_revenue')->name('data_revenue');
                    Route::get('export-revenue', 'ReportController@export_revenue')->name('export_revenue');

                    Route::get('net-revenue', 'ReportController@net_revenue')->name('net_revenue');
                    Route::get('data-net-revenue', 'ReportController@data_net_revenue')->name('data_net_revenue');
                    Route::get('export-net-revenue', 'ReportController@export_net_revenue')->name('export_net_revenue');

                    Route::get('expected-revenue', 'ReportController@expected_revenue')->name('expected_revenue');
                    Route::get('data-expected-revenue', 'ReportController@data_expected_revenue')->name('data_expected_revenue');
                    Route::get('export-expected-revenue', 'ReportController@export_expected_revenue')->name('export_expected_revenue');

                    Route::get('triple', 'ReportController@triple')->name('triple');
                    Route::get('data-triple', 'ReportController@data_triple')->name('data_triple');
                    Route::get('export-triple', 'ReportController@export_triple')->name('export_triple');
                    Route::get('{id}/services', 'ReportController@triple_services')->name('triple_services');

                });
            });
        });

        /**
         * item Module Routes
         */
        Route::resource('item', 'ItemController');
        Route::prefix('items')->group(function () {
            Route:: as ('item.')->group(function () {
                Route::get('data', 'ItemController@data')->name('data');
                Route::post('trash', 'ItemController@trash')->name('trash');
                Route::post('restore', 'ItemController@restore')->name('restore');
                Route::get('export', 'ItemController@export')->name('export');
                Route::get('add-variant/{id}', 'ItemController@addVariant')->name('add.variant');
                Route::post('store-variant', 'ItemController@storeVariant')->name('store.variant');
                Route::get('ingredient-variants/{id}', 'ItemController@allVariant')->name('all.variant');
                Route::get('delete-variant/{id}', 'ItemController@deleteVariant')->name('delete.variant');

                Route::get('get-ingredients-row', 'ItemController@getIngredientsRow')->name('get.ingredients.row');
                Route::post('get-ingredients-tags', 'ItemController@getIngredientsTags')->name('get.ingredients.tags');

                Route::post('get-item-calcus', 'ItemController@getItemCalcus')->name('get.calcus');

                Route::get('show-item-detail/{id}', 'ItemController@showDetail')->name('showDetail');
                Route::get('show-item-variantDetail/{id}', 'ItemController@showVariantDetail')->name('showVariantDetail');

//                Route::post('get-ingredients-tags', 'ItemController@getIngredientsTags')->name('get.ingredients.tags');

            });
        });

        /**
         * departments Module Routes
         */
        Route::resource('department', 'DepartmentController');
        Route::prefix('departments')->group(function () {
            Route:: as ('department.')->group(function () {
                Route::get('data', 'DepartmentController@data')->name('data');
                Route::post('trash', 'DepartmentController@trash')->name('trash');
                Route::post('restore', 'DepartmentController@restore')->name('restore');

            });
        });

        /**
         * vendors Module Routes
         */
        Route::resource('vendor', 'VendorController');
        Route::prefix('vendors')->group(function () {
            Route:: as ('vendor.')->group(function () {
                Route::get('data', 'VendorController@data')->name('data');
                Route::get('show/ingredients/{id}', 'VendorController@showIngredients')->name('show.ingredient');
                Route::get('ingredient/data', 'VendorController@ingredientData')->name('ingredientData');
                Route::get('create/ingredients/{id}', 'VendorController@createIngredient')->name('create.ingredient');
                Route::post('store/ingredient', 'VendorController@storeIngredient')->name('store.ingredient');
                Route::get('edit/ingredient/{id}', 'VendorController@editIngredient')->name('edit.ingredient');
                Route::post('update/ingredient/{id}', 'VendorController@updateIngredient')->name('update.ingredient');
                Route::delete('destroy/ingredient/{id}', 'VendorController@destroyIngredient')->name('destroy.ingredient');
                Route::get('export/ingredient', 'VendorController@exportIngredient')->name('export.ingredient');
                Route::post('trash', 'VendorController@trash')->name('trash');
                Route::post('restore', 'VendorController@restore')->name('restore');
                Route::get('download/tax_card/{id}', 'VendorController@downloadtTax_card')->name('download.tax_card');
                Route::get('download/commercial_record/{id}', 'VendorController@downloadCommercial_record')->name('download.commercial_record');
                Route::get('append/information', 'VendorController@appendInformation')->name('append.information');

                Route::get('po/make_deduction_order/{po_id}', 'VendorController@showDeductionOrderForm')->name('show.deduction.form');

                Route::post('po/deduction_order', 'VendorController@makeDeductionOrder')->name('make.deduction');
                Route::get('po/deduction_orders/{po_id}', 'VendorController@showDeductionOrders')->name('show.deductions');
                Route::get('po/delete/deduction/{deduction_id}', 'VendorController@deleteDeduction')->name('delete.deduction');

            });
        });

        Route::resource('vendorType', 'VendorTypeController');
        Route::prefix('vendorTypes')->group(function () {
            Route:: as ('vendorType.')->group(function () {
                Route::get('data', 'VendorTypeController@data')->name('data');
                Route::post('trash', 'VendorTypeController@trash')->name('trash');
                Route::post('restore', 'VendorTypeController@restore')->name('restore');
                Route::get('export', 'VendorTypeController@export')->name('export');
                Route::get('get/information/row', 'VendorTypeController@getInformationRow')->name('get.information.row');

            });
        });

        Route::resource('complain', 'CustomerComplainController');
        Route::prefix('complains')->group(function () {
            Route:: as ('complain.')->group(function () {
                Route::get('data', 'CustomerComplainController@data')->name('data');
                Route::post('trash', 'CustomerComplainController@trash')->name('trash');
                Route::post('restore', 'CustomerComplainController@restore')->name('restore');
                Route::get('export', 'CustomerComplainController@export')->name('export');

            });
        });

        Route::prefix('hotelWorks')->group(function () {
            Route:: as ('hotelWork.')->group(function () {
                Route::get('weekly', 'HotelWorkController@weekly')->name('weekly');
                Route::get('export', 'HotelWorkController@export')->name('export');

                Route::get('arrivalList', 'HotelWorkController@arrivalList')->name('arrivalList');
                Route::get('arrivalListData', 'HotelWorkController@arrivalListData')->name('arrivalListData');
                Route::get('arrivalLisExport', 'HotelWorkController@arrivalLisExport')->name('arrivalLisExport');



                Route::get('departureList', 'HotelWorkController@departureList')->name('departureList');
                Route::get('departureListData', 'HotelWorkController@departureListData')->name('departureListData');
                Route::get('departureListExport', 'HotelWorkController@departureListExport')->name('departureListExport');


                Route::get('cancelledList', 'HotelWorkController@cancelledList')->name('cancelledList');
                Route::get('cancelledListData', 'HotelWorkController@cancelledListData')->name('cancelledListData');
                Route::get('cancelledListExport', 'HotelWorkController@cancelledListExport')->name('cancelledListExport');


                Route::get('reservationArrivalList', 'HotelWorkController@reservationArrivalList')->name('reservationArrivalList');
                Route::get('reservationArrivalListtData', 'HotelWorkController@reservationArrivalListtData')->name('reservationArrivalListtData');
                Route::get('reservationArrivalListExport', 'HotelWorkController@reservationArrivalListExport')->name('reservationArrivalListExport');

                Route::get('carNumberReservationArrivalList', 'HotelWorkController@carNumberReservationArrivalList')->name('carNumberReservationArrivalList');
                Route::get('carNumberReservationArrivalListData', 'HotelWorkController@carNumberReservationArrivalListData')->name('carNumberReservationArrivalListData');
                Route::get('carNumberReservationArrivalListExport', 'HotelWorkController@carNumberReservationArrivalListExport')->name('carNumberReservationArrivalListExport');


                Route::get('foundLoss', 'HotelWorkController@foundLoss')->name('foundLoss');
                Route::get('foundLosstData', 'HotelWorkController@foundLosstData')->name('foundLosstData');
                Route::get('foundLossExport', 'HotelWorkController@foundLossExport')->name('foundLossExport');


                Route::get('miantinaceReport', 'HotelWorkController@miantinaceReport')->name('miantinaceReport');
                Route::get('miantinaceReportData', 'HotelWorkController@miantinaceReportData')->name('miantinaceReportData');
                Route::get('miantinaceReportExport', 'HotelWorkController@miantinaceReportExport')->name('miantinaceReportExport');



                Route::get('OccupancyRateReport', 'HotelWorkController@OccupancyRateReport')->name('OccupancyRateReport');
                Route::get('OccupancyAnnualReport', 'HotelWorkController@OccupancyAnnualReport')->name('OccupancyAnnualReport');


            });
        });

        Route::get('inventory', 'OrganizationController@inventory')->name('inventory');

        //begin purchase orders
        Route::resource('po', 'PurchaseOrderController');
        Route::get('po/get/items', 'PurchaseOrderController@getItems')->name('po.getItems');
        Route::get('po/get/item/row', 'PurchaseOrderController@getItemRow')->name('po.getItemRow');
        Route::get('change/po/status/toCheckIn/{id}', 'PurchaseOrderController@ChangeToCheckInStatus')->name('change.POStatus.toCheckin');
        Route::post('update/po/checkIn/data/{id}', 'PurchaseOrderController@updateCheckIn')->name('po.updateCheckIn');

        Route::get('feach/item', 'PurchaseOrderController@feachItem')->name('feach.item');
        //end purchase orders
        Route::get('po/get/orders', 'PurchaseOrderController@inventoriesIndex')->name('po.inventoriesIndex');
        Route::get('po/show/order{id}/{type}', 'PurchaseOrderController@inventoriesorderDetail')->name('po.order.detail');
        Route::get('po/fullFill/order{id}/{type}', 'PurchaseOrderController@fullFillOrder')->name('po.fullFill.order');
        Route::get('po/order/{id}/{type}', 'PurchaseOrderController@createPoOrder')->name('po.create.order');

        Route::get('po/orders/ingredients', 'PurchaseOrderController@ordersIngredients')->name('po.show.orders.ingredients');

        Route::get('po/orders/ingredient/{id}/{qnt}', 'PurchaseOrderController@createPoOrderIngredient')->name('po.create.order.ingredient');

        Route::get('po/refuse/order{id}/{type}', 'PurchaseOrderController@refuseOrder')->name('po.refuse.order');
        Route::post('po/refuse/order', 'PurchaseOrderController@storeFefuseOrderReason')->name('po.store.refuse.order');

        //begin purchaseOrderPayments module
        Route::resource('purchaseOrderPayment', 'PurchaseOrderPaymentController');
        //end purchaseOrderPayments module

        /**
         * employee type Module Routes
         */
        Route::resource('employeeType', 'EmployeeTypeController');
        Route::prefix('employeeTypes')->group(function () {
            Route:: as ('employeeType.')->group(function () {
                Route::get('data', 'EmployeeTypeController@data')->name('data');
                Route::post('trash', 'EmployeeTypeController@trash')->name('trash');
                Route::post('restore', 'EmployeeTypeController@restore')->name('restore');
            });
        });

        /**
         * vacation request Module Routes
         */
        Route::resource('vacationRequest', 'VacationRequestController');
        Route::prefix('vacationRequests')->group(function () {
            Route:: as ('vacationRequest.')->group(function () {
                Route::get('data', 'VacationRequestController@data')->name('data');
                Route::get('department/{id}', 'VacationRequestController@indexDepartment')->name('indexDepartment');
                Route::get('department/data/{id}', 'VacationRequestController@dataDepartment')->name('dataDepartment');
                Route::get('create/formAdmin/{id}', 'VacationRequestController@create')->name('create.fromAdmin');

                Route::get('approve/{id}', 'VacationRequestController@approve')->name('approve');
                Route::get('reject/{id}', 'VacationRequestController@reject')->name('reject');

                Route::get('employee/{id}', 'VacationRequestController@empVacation')->name('empVacation');
                Route::get('employee/data/{id}', 'VacationRequestController@empVacationData')->name('empVacationData');

            });
        });

        Route::prefix('laundrys')->group(function () {
            Route:: as ('laundry.')->group(function () {
                Route::get('/notifications', 'LaundryNotificationController@notifications')->name('notification');

            });
        });

        /**
         * Financial advance Module Routes
         */
        Route::resource('financialAdvanceRequest', 'FinancialAdvanceRequestController');
        Route::prefix('financialAdvanceRequests')->group(function () {
            Route:: as ('financialAdvanceRequest.')->group(function () {
                Route::get('data', 'FinancialAdvanceRequestController@data')->name('data');
                Route::get('department/{id}', 'FinancialAdvanceRequestController@indexDepartment')->name('indexDepartment');
                Route::get('department/data/{id}', 'FinancialAdvanceRequestController@dataDepartment')->name('dataDepartment');
                Route::get('create/formAdmin/{id}', 'FinancialAdvanceRequestController@create')->name('create.fromAdmin');

                Route::get('approve/{id}', 'FinancialAdvanceRequestController@approve')->name('approve');
                Route::get('reject/{id}', 'FinancialAdvanceRequestController@reject')->name('reject');

                Route::get('employee/{id}', 'FinancialAdvanceRequestController@empVacation')->name('empVacation');
                Route::get('employee/data/{id}', 'FinancialAdvanceRequestController@empVacationData')->name('empVacationData');

            });
        });

        /**
         * employee bonus  Module Routes
         */
        Route::resource('employeeBonus', 'EmployeeBonusController');
        Route::prefix('employeeBonuses')->group(function () {
            Route:: as ('employeeBonus.')->group(function () {
                Route::get('data', 'EmployeeBonusController@data')->name('data');
                Route::get('create/formAdmin/{id}', 'EmployeeBonusController@create')->name('create.fromAdmin');
                Route::get('employee/{id}', 'EmployeeBonusController@empBonus')->name('empBonus');
                Route::get('employee/data/{id}', 'EmployeeBonusController@empBonusData')->name('empBonusData');

            });
        });

        /**
         * employee deductions  Module Routes
         */
        Route::resource('employeeDeduction', 'EmployeeDeductionController');
        Route::prefix('employeeDeductions')->group(function () {
            Route:: as ('employeeDeduction.')->group(function () {
                Route::get('data', 'EmployeeDeductionController@data')->name('data');
                Route::get('create/formAdmin/{id}', 'EmployeeDeductionController@create')->name('create.fromAdmin');
                Route::get('employee/{id}', 'EmployeeDeductionController@empDeduction')->name('empDeduction');
                Route::get('employee/data/{id}', 'EmployeeDeductionController@empDeductionData')->name('empDeductionData');

            });
        });

        /**
         * employee Financial report  Module Routes
         */
        Route::resource('employeeFinancialReport', 'EmployeeFinancialReportController');
        Route::prefix('employeeFinancialReports')->group(function () {
            Route:: as ('employeeFinancialReport.')->group(function () {
                Route::get('data', 'EmployeeFinancialReportController@data')->name('data');
            });
        });

        /**
         * employee job Module Routes
         */
        Route::resource('employeeJob', 'EmployeeJobController');
        Route::prefix('employeeJobs')->group(function () {
            Route:: as ('employeeJob.')->group(function () {
                Route::get('data', 'EmployeeJobController@data')->name('data');
                Route::post('trash', 'EmployeeJobController@trash')->name('trash');
                Route::post('restore', 'EmployeeJobController@restore')->name('restore');
            });
        });

        /**
         * employee_vacation_types Module Routes
         */
        Route::resource('employeeVacationType', 'EmployeeVacationTypeController');
        Route::prefix('employeeVacationTypes')->group(function () {
            Route:: as ('employeeVacationType.')->group(function () {
                Route::get('data', 'EmployeeVacationTypeController@data')->name('data');
                Route::post('trash', 'EmployeeVacationTypeController@trash')->name('trash');
                Route::post('restore', 'EmployeeVacationTypeController@restore')->name('restore');
            });
        });

        /**
         * employee_vacation_types Module Routes
         */
        Route::resource('roomMaintenanceRequest', 'RoomMaintenanceRequestController');
        Route::prefix('roomMaintenanceRequests')->group(function () {
            Route:: as ('roomMaintenanceRequest.')->group(function () {
                Route::get('data', 'RoomMaintenanceRequestController@data')->name('data');
                Route::post('trash', 'RoomMaintenanceRequestController@trash')->name('trash');
                Route::post('restore', 'RoomMaintenanceRequestController@restore')->name('restore');
                Route::get('export', 'RoomMaintenanceRequestController@export')->name('export');
                Route::post('fetch/hotel/rooms', 'RoomMaintenanceRequestController@fetchHotelRooms')->name('hotel.rooms');
            });
        });

        Route::resource('roomLoss', 'RoomLossController');
        Route::prefix('roomLosses')->group(function () {
            Route:: as ('roomLoss.')->group(function () {
                Route::get('data', 'RoomLossController@data')->name('data');
                Route::post('trash', 'RoomLossController@trash')->name('trash');
                Route::post('restore', 'RoomLossController@restore')->name('restore');
                Route::get('export', 'RoomLossController@export')->name('export');
                Route::put('loss/{id}/found', 'RoomLossController@lossFound')->name('found');
            });
        });

        Route::resource('housekeeping', 'RoomHouseKeepingController');
        Route::prefix('housekeepings')->group(function () {
            Route:: as ('housekeeping.')->group(function () {
                Route::get('data', 'RoomHouseKeepingController@data')->name('data');
                Route::get('export', 'RoomHouseKeepingController@export')->name('export');
            });
        });

        Route::get('events-dashboard', 'EventDashboardController@eventDashboard')->name('events-dashboard');
        Route::post('events/show/reservation', 'EventDashboardController@showReservation')->name('events.show.Reservation');

        Route::get('housing-dashboard', 'HousingDashboardController')->name('housing-dashboard');

    });
    ################### Start Financial Modules #####################
    /**
     * Account Type Module Routes
     */
    Route::resource('accountType', 'AccountTypeController');
    Route::prefix('accountTypes')->group(function () {
        Route:: as ('accountType.')->group(function () {
            Route::get('data', 'AccountTypeController@data')->name('data');
            Route::post('trash', 'AccountTypeController@trash')->name('trash');
            Route::post('restore', 'AccountTypeController@restore')->name('restore');
            Route::get('export', 'AccountTypeController@export')->name('export');
        });
    });
    /**
     * Account Module Routes
     */
    Route::resource('account', 'AccountController');
    Route::prefix('accounts')->group(function () {
        Route:: as ('account.')->group(function () {
            Route::get('data', 'AccountController@data')->name('data');
            Route::post('trash', 'AccountController@trash')->name('trash');
            Route::post('restore', 'AccountController@restore')->name('restore');
            Route::get('export', 'AccountController@export')->name('export');
            Route::get('master/sheet/{id}', 'AccountController@masterSheet')->name('masterSheet');
        });
    });
    /**
     * Account Module Routes
     */
    Route::resource('subAccount', 'SubAccountController');
    Route::prefix('subAccounts')->group(function () {
        Route:: as ('subAccount.')->group(function () {
            Route::get('data', 'SubAccountController@data')->name('data');
            Route::post('trash', 'SubAccountController@trash')->name('trash');
            Route::post('restore', 'SubAccountController@restore')->name('restore');
            Route::get('export', 'SubAccountController@export')->name('export');
        });
    });
    /**
     * Journal Entry Routes
     */
    Route::resource('journalEntry', 'JournalEntryController');
    Route::prefix('journalEntries')->group(function () {
        Route:: as ('journalEntry.')->group(function () {
            Route::get('data', 'JournalEntryController@data')->name('data');
            Route::post('trash', 'JournalEntryController@trash')->name('trash');
            Route::post('restore', 'JournalEntryController@restore')->name('restore');
            Route::get('export', 'JournalEntryController@export')->name('export');
            Route::get('get/debit/row', 'JournalEntryController@getDebitRow')->name('get.debit.row');
            Route::get('get/credit/row', 'JournalEntryController@getCreditRow')->name('get.credit.row');
            Route::get('append/debit/subAccount', 'JournalEntryController@appendSubAccounts')->name('append.sub_accounts');
            Route::get('append/credit/subAccount', 'JournalEntryController@appendSubAccountsCredit')->name('append.credit');

            Route::get('invoices', 'JournalEntryController@invoices')->name('invoices');
            Route::get('createWithInvoices', 'JournalEntryController@create')->name('createWithInvoice');

        });
    });
    /**
     * Daily Account Routes
     */
    Route::resource('dailyAccount', 'DailyAccountController');
    Route::prefix('dailyAccounts')->group(function () {
        Route:: as ('dailyAccount.')->group(function () {
            Route::get('data', 'DailyAccountController@data')->name('data');
            Route::post('trash', 'DailyAccountController@trash')->name('trash');
            Route::post('restore', 'DailyAccountController@restore')->name('restore');
            Route::get('export', 'DailyAccountController@export')->name('export');
        });
    });

    /**
     * Financial Reports Routes
     */
    Route::prefix('reports')->group(function () {
        Route:: as ('report.')->group(function () {
            Route::get('sportsActivities', 'ReportsController@sportsActivitiesIndex')->name('sportsActivitiesIndex');
            Route::get('sportsActivitiesIndex/data', 'ReportsController@sportsActivitiesIndexData')->name('sportsActivitiesIndex.data');
            Route::get('sportsActivities/approve/{id}', 'ReportsController@sportsActivitiesApprove')->name('sportsActivitiesApprove');

            Route::get('rentBills', 'ReportsController@rentBills')->name('rentBills');
            Route::get('rentBills/data', 'ReportsController@rentBillsData')->name('rentBills.data');
            Route::get('rentBills/approve/{id}', 'ReportsController@rentBillsApprove')->name('rentBillsApprove');

            Route::get('hotelReservation', 'ReportsController@hotelReservations')->name('hotelReservations');
            Route::get('hotelReservation/data', 'ReportsController@hotelReservationsData')->name('hotelReservations.data');
            Route::get('hotelReservation/approve/{id}', 'ReportsController@hotelReservationApprove')->name('hotelReservationApprove');

            Route::get('gateTickets', 'ReportsController@gateTickets')->name('gateTickets');
            Route::get('gateTicketsReservation/data', 'ReportsController@gateTicketsData')->name('gateTickets.data');
            Route::get('gateTicketsReservation/approve/{id}', 'ReportsController@gateTicketsReservationApprove')->name('gateTicketsReservationApprove');

            Route::get('eventBills', 'ReportsController@eventBills')->name('eventBills');
            Route::get('eventBills/data', 'ReportsController@eventBillsData')->name('eventBills.data');
            Route::get('eventBills/approve/{id}', 'ReportsController@eventBillsApprove')->name('eventBillsApprove');

            Route::get('laundryBills', 'ReportsController@laundryBills')->name('laundryBills');
            Route::get('laundryBills/data', 'ReportsController@laundryBillsData')->name('laundryBills.data');
            Route::get('laundryBills/approve/{id}', 'ReportsController@laundryBillsApprove')->name('laundryBillsApprove');

            Route::get('posBills', 'ReportsController@posBills')->name('posBills');
            Route::get('posBills/data', 'ReportsController@posBillsData')->name('posBills.data');
            Route::get('posBills/approve/{id}', 'ReportsController@posBillsApprove')->name('posBillsApprove');

        });
    });

    /**
     * Financial emps Routes
     */
    Route::prefix('financial/employees')->group(function () {
        Route:: as ('financial/employee.')->group(function () {
            Route::get('nomination', 'financialEmployeesController@nomination')->name('nomination');
            Route::get('nomination/data', 'financialEmployeesController@nominationData')->name('nomination.data');

            Route::get('TheInsured', 'financialEmployeesController@TheInsured')->name('TheInsured');
            Route::get('TheInsured/data', 'financialEmployeesController@TheInsuredData')->name('TheInsured.data');

            Route::get('temporary', 'financialEmployeesController@temporary')->name('temporary');
            Route::get('temporary/data', 'financialEmployeesController@temporaryData')->name('temporary.data');

            Route::get('officer', 'financialEmployeesController@officer')->name('officer');
            Route::get('officer/data', 'financialEmployeesController@officerData')->name('officer.data');

            Route::get('nomination/salaries', 'financialEmployeesController@nominationSalaries')->name('nomination.salaries');
            Route::get('nomination/salaries/data', 'financialEmployeesController@nominationSalariesData')->name('nomination.salaries.data');

            Route::get('TheInsured/salaries', 'financialEmployeesController@TheInsuredSalaries')->name('TheInsured.salaries');
            Route::get('TheInsured/salaries/data', 'financialEmployeesController@TheInsuredSalariesData')->name('TheInsured.salaries.data');

            Route::get('temporary/salaries', 'financialEmployeesController@temporarySalaries')->name('temporary.salaries');
            Route::get('temporary/salaries/data', 'financialEmployeesController@temporarySalariesData')->name('temporary.salaries.data');

            Route::get('officer/salaries', 'financialEmployeesController@officerSalaries')->name('officer.salaries');
            Route::get('officer/salaries/data', 'financialEmployeesController@officerSalariesData')->name('officer.salaries.data');

        });
    });

    /**
     * Central Daily Journal Module Routes
     */
    Route::resource('dailyCenter', 'DailyCenterController');
    Route::prefix('dailyCenters')->group(function () {
        Route:: as ('dailyCenter.')->group(function () {
            Route::get('data', 'DailyCenterController@data')->name('data');
            Route::get('export', 'DailyCenterController@export')->name('export');
        });
    });
    /**
     * Balance Sheet Module Routes
     */
    Route::get('balance/sheet', 'BalanceSheetController@index')->name('balanceSheet.index');
    Route::get('income/statement', 'IncomeStatementController@index')->name('incomeStatement.index');
    Route::get('financial/statement', 'FinancialStatementController@index')->name('financialStatement.index');
    Route::get('depreciation/report', 'DepreciationController@index')->name('depreciation.index');

    ################### End Financial Modules #####################

    ################### Club Service Modules #####################
    /**
     * Asset Category Module Routes
     */
    Route::resource('assetCategory', 'AssetCategoryController');
    Route::prefix('assetCategories')->group(function () {
        Route:: as ('assetCategory.')->group(function () {
            Route::get('data', 'AssetCategoryController@data')->name('data');
            Route::post('trash', 'AssetCategoryController@trash')->name('trash');
            Route::post('restore', 'AssetCategoryController@restore')->name('restore');
            Route::get('export', 'AssetCategoryController@export')->name('export');
            Route::get('append/duration', 'AssetCategoryController@appendDuration')->name('append.duration');

        });
    });
    /**
     * Asset Product Module Routes
     */
    Route::resource('assetProduct', 'AssetProductController');
    Route::prefix('assetProducts')->group(function () {
        Route:: as ('assetProduct.')->group(function () {
            Route::get('data', 'AssetProductController@data')->name('data');
            Route::post('trash', 'AssetProductController@trash')->name('trash');
            Route::post('restore', 'AssetProductController@restore')->name('restore');
            Route::get('export', 'AssetProductController@export')->name('export');

        });
    });
    /**
     * Sub Asset Product Module Routes
     */
    Route::resource('subAssetProduct', 'SubAssetProductController');
    Route::prefix('subAssetProducts')->group(function () {
        Route:: as ('subAssetProduct.')->group(function () {
            Route::get('data', 'SubAssetProductController@data')->name('data');
            Route::post('trash', 'SubAssetProductController@trash')->name('trash');
            Route::post('restore', 'SubAssetProductController@restore')->name('restore');
            Route::get('export', 'SubAssetProductController@export')->name('export');

        });
    });
    ################### End Financial Modules #####################

});
