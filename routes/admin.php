<?php


use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Admin\AskController;
use App\Http\Controllers\Admin\DayController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\CenterController;
use App\Http\Controllers\Admin\ClinicController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\HospitalController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\PharmacyController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\WhoAreWeController;
use App\Http\Controllers\Admin\InsuranceController;
use App\Http\Controllers\Admin\SpecialtyController;
use App\Http\Controllers\Admin\CompetencyController;
use App\Http\Controllers\Admin\ConferenceController;
use App\Http\Controllers\Admin\InfoHealthController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RentMaterialController;
use App\Http\Controllers\Admin\SubspecialtyController;
use App\Http\Controllers\Admin\AdvertisementController;
use App\Http\Controllers\Admin\ManagerPersonController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\GoalAndMissionController;
use App\Http\Controllers\Admin\ManagerCompanyController;
use App\Http\Controllers\Admin\MedicalServiceController;
use App\Http\Controllers\Admin\MedicalTourismController;
use App\Http\Controllers\Admin\PartnerProjectController;
use App\Http\Controllers\Admin\PatientsRightsController;
use App\Http\Controllers\Admin\RegisterPersonController;
use App\Http\Controllers\Admin\BoardOfDirectorController;
use App\Http\Controllers\Admin\ManagerHospitalController;
use App\Http\Controllers\Admin\PatientsResponsController;
use App\Http\Controllers\Admin\RegisterCompanyController;
use App\Http\Controllers\Admin\SupplierProjectController;
use App\Http\Controllers\Admin\ContractorPersonController;
use App\Http\Controllers\Admin\InsuranceSectionController;
use App\Http\Controllers\Admin\ContractorCompanyController;
use App\Http\Controllers\Admin\ManagerPersonFileController;
use App\Http\Controllers\Admin\MedicalTechnologyController;
use App\Http\Controllers\Admin\ManagerCompanyFileController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Admin\ExecutiveManagementController;
use App\Http\Controllers\Admin\ConsultingPersonFileController;
use App\Http\Controllers\Admin\ConsultingCompanyFileController;
use App\Http\Controllers\Admin\ConsultingPersonProjectController;
use App\Http\Controllers\Admin\ContractorPersonProjectController;
use App\Http\Controllers\Admin\ConsultingCompanyProjectController;
use App\Http\Controllers\Admin\ContractorCompanyProjectController;
use App\Http\Controllers\Admin\RegisterConsultingServicePersonController;
use App\Http\Controllers\Admin\RegisterConsultingServiceCompanyController;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ],
    function () {
        Route::group(['prefix' => 'admin'], function () {
            Route::get('/login', [LoginController::class, "loginView"])->name('admin.login_page');
            Route::post('/login', [LoginController::class, "login"])->name('login');
            Route::get('/logout', [LoginController::class, "logout"])->name('logout');


            Route::middleware(['admin-role'])->group(function () {
                Route::get('/admincp', function () {
                    return view('admin.home');
                })->name('admin');

                Route::resources([
                        'permissions' => PermissionController::class,
                        'roles' => RoleController::class,
                        'admins' => AdminController::class,
                        'countries' => CountryController::class,
                        'cities' => CityController::class,
                        'settings' => SettingController::class,
                        'languages' => LanguageController::class,
                        'categories' => CategoryController::class,
                        'posts' => PostController::class,
                        'advertisements' => AdvertisementController::class,
                        'insurances' => InsuranceController::class,
                        'asks' => AskController::class,
                        'specialties' => SpecialtyController::class,
                        'subspecialties' => SubspecialtyController::class,
                        'packages' => PackageController::class,
                        'currencies' => CurrencyController::class,
                        'payment-methods' => PaymentMethodController::class,
                        'comments' => CommentController::class,
                        'hospitals' => HospitalController::class,
                        'bookings' => BookingController::class,
                        'doctors' => DoctorController::class,
                        'medical_technologies' => MedicalTechnologyController::class,
                        'medical_tourisms' => MedicalTourismController::class,
                        'info_healths' => InfoHealthController::class,
                        'patients_respons' => PatientsResponsController::class,
                        'patients_rights' => PatientsRightsController::class,
                        'patients' => PatientController::class,
                        'sliders' => SliderController::class,
                        'centers' => CenterController::class,
                        'InsuranceSections' => InsuranceSectionController::class,
                        'manager_hospitals' => ManagerHospitalController::class,                      
                        'competencies' => CompetencyController::class,
                        'days' => DayController::class,
                        'who_are_we' => WhoAreWeController::class,
                        'goal_and_mission' => GoalAndMissionController::class,
                        'clinics' => ClinicController::class,
                        'pharmacies' => PharmacyController::class,
                    ]);


                Route::get('/get-cities/{country_id}', [DoctorController::class, 'getCities']);
                Route::get('/get-cities/{country_id}', [ClinicController::class, 'getCities']);
                Route::get('/get-cities/{country_id}', [PharmacyController::class, 'getCities']);
                Route::get('/get-cities/{country_id}', [PatientController::class, 'getCities']);
                Route::get('/get-hospitals/{doctor_id}', [BookingController::class, 'getHospitals']);
                Route::get('/get-clinics/{doctor_id}', [BookingController::class, 'getClinics']);
                Route::resource('members', MemberController::class)->except('create', 'store');
            });
        });
    }
);
