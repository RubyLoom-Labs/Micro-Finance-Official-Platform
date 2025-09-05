<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\InstallmentController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRoleController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.signIn');
})->name('login');
Route::get('/signup', function () {
    return view('auth.signUp');
});
Route::post('user/login', [UserController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    //branches routes
    Route::post('/branches/create',  [BranchController::class, 'create_branch'])->middleware(['can:branch_creation'])->name('branches.createbranch');

    //centers routes
    Route::get('/centers', [CenterController::class, 'getAllActiveCenters'])->middleware(['can:centers-view'])->name('centers.viewblade');
    Route::post('/centers/create',  [CenterController::class, 'createCenter'])->middleware(['can:centers-edit'])->name('centers.createcenter');
    Route::get('/centers/{branchId}', [CenterController::class, 'getCentersByBranch']);
    Route::get('/centerSummary/{centerId}', [CenterController::class, 'viewCenterSummary'])->middleware(['can:centers-view'])->name('center.summary');
    Route::delete('/centers/delete/{centerId}', [CenterController::class, 'deleteCenter'])->middleware(['can:centers-delete']);
    Route::post('/centers/update/{centerId}', [CenterController::class, 'updateCenter'])->middleware(['can:centers-edit'])->name('centers.updateCenter');


    //group route
    Route::get('/groupSummary/{groupId}', [GroupController::class, 'viewGroupSummary'])->middleware(['can:groups-view'])->name('group.summary');
    Route::get('/groups/{centerId}', [GroupController::class, 'getGroupsByCenter']);
    Route::post('/group/create', [GroupController::class, 'createGroup'])->middleware(['can:groups-edit'])->name('groups.creategroup');
    Route::post('/groups/update/{groupId}', [GroupController::class, 'updateGroup'])->middleware(['can:groups-edit'])->name('groups.updateGroup');
    Route::delete('/groups/delete/{centerId}', [GroupController::class, 'deleteGroup'])->middleware(['can:groups-delete']);



    //members routes
    Route::get(
        '/members',
        [MemberController::class, 'viewAllMembers']
    )->middleware(['can:members-view'])->name('members.viewblade');
    Route::post('/members/create', [MemberController::class, 'createMember'])->middleware(['can:members-edit'])->name('members.create');
    Route::get('/unassignmembers/search',  [MemberController::class, 'unAssignMemberSearch']);
    Route::get('/memberSummery/{memberId}', [MemberController::class, 'viewMemberSummary'])->middleware(['can:members-view'])->name('member.summary');
    Route::post('/members/update/{memberId}', [MemberController::class, 'updateMember'])->middleware(['can:members-edit'])->name('members.updateMember');
    Route::delete('/members/delete/{memberId}', [MemberController::class, 'deleteMember'])->middleware(['can:members-delete']);


    //loans routes
    Route::post('/loans/create/{memberId}', [LoanController::class, 'createLoan'])->middleware('can:loans')->name('loans.createLoan');

    //installments routes
    Route::post('/installments/update/{loanId}', [InstallmentController::class, 'updateInstallment'])->middleware('can:loans')->name('installments.updateInstallment');

    /*income*/
    Route::get('/income', [CenterController::class, 'incomeView'])->middleware('can:income')->name('centers.viewIncomeBlade');
    Route::get('/collection',  [CenterController::class, 'collectionView'])->middleware('can:income')->name('centers.viewCollectionBlade');
/*     Route::get('/underpayment', [CenterController::class, 'underPaymentView'])->middleware('can:income')->name('centers.viewUnderPaymentBlade');
 */
    //user roles routes
    Route::get('/userRole', [UserRoleController::class, 'userRolesView'])->middleware(['can:create-user-roles']);
    Route::post('/userRole/create', [UserRoleController::class, 'createUserRole'])->middleware(['can:create-user-roles'])->name('userRoles.create');
    Route::post('/userRole/update', [UserRoleController::class, 'updateUserRole'])->middleware(['can:create-user-roles'])->name('userRoles.update');

    //user routes
    Route::get('/userAccount', [UserController::class, 'usersView'])->middleware(['can:create-user-accounts'])->name('user.viewblade');
    Route::post('/userAccount/create', [UserController::class, 'createUser'])->middleware(['can:create-user-accounts'])->name('user.create');
    Route::post('/userAccount/update', [UserController::class, 'updateUser'])->middleware(['can:create-user-accounts'])->name('user.update');
    Route::post('/userAccount/updatepw', [UserController::class, 'updatePwUser'])->middleware(['can:create-user-accounts'])->name('user.updatePw');
    Route::get('user/logout', [UserController::class, 'logout'])->name('user.logout');
    Route::get('/userLogs', function () {
        return view('settings/userLogs');
    });
    Route::delete('/userAccount/delete/{userId}', [UserController::class, 'deleteUser']);

    //logs
    Route::get('/userLogs', [LogController::class, 'logsView'])->middleware(['can:user-logs'])->name('log.viewblade');


    /* Route::get('/recentlyAdded', function () {
        return view('branches/recentlyAdded');
    }); */

    /*Branches/Recently*/
    /*  Route::get('/recentCenters', function () {
        return view('branches/recentlyAdded/centers');
    });
    Route::get('/recentGroups', function () {
        return view('branches/recentlyAdded/groups');
    });
    Route::get('/recentLoans', function () {
        return view('branches/recentlyAdded/loans');
    });
    Route::get('/recentMembers', function () {
        return view('branches/recentlyAdded/members');
    }); */



    /*Payments*/
    Route::get('/payments', [LoanController::class, 'viewUncompletedLoans'])->middleware('can:payments');
    Route::get('/pending', [LoanController::class, 'viewPendingLoans'])->middleware('can:payments');
    Route::get('/nopaid', [LoanController::class, 'viewNoPaidLoans'])->middleware('can:payments');
    /*  Route::get('/paymentsSummery', function () {
        return view('payments/paymentsSummery');
    }); */

    /*Profile View*/
    Route::get('/profile', function () {
        return view('profile/profile');
    });

    /*Reports*/
    Route::get('/loneIssue', function () {
        return view('reports/loneIssue');
    })->middleware('can:reports');
    Route::get('/incomeReports', function () {
        return view('reports/incomeReports');
    })->middleware('can:reports');
    Route::get('/pendingPaymentsReport', function () {
        return view('reports/pendingPaymentsReport');
    })->middleware('can:reports');
    Route::get('/membersReport', function () {
        return view('reports/membersReport');
    })->middleware('can:reports');

    /*Settings*/
});
