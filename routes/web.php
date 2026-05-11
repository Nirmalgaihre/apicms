<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

// Controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\NoticeCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\IdCardController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\PublicationCategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\StaffCategoryController;

// Models (only if used directly in routes)
use App\Models\Notice;
use App\Models\BlogPost;
use App\Models\Gallery;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Contact
Route::view('/contact', 'contact.index')->name('public.contact');

Route::post('/contact/store', function (Request $request) {
    if (!$request->has(['latitude', 'longitude'])) {
        return back()->with('error', 'Location permission is required.');
    }

    DB::table('contacts')->insert([
        'name'          => $request->name,
        'email'         => $request->email,
        'subject'       => $request->subject,
        'message'       => $request->message,
        'ip_address'    => $request->ip(),
        'location_data' => "Lat: {$request->latitude}, Long: {$request->longitude}",
        'created_at'    => now(),
    ]);

    return back()->with('success', 'Message sent successfully!');
})->name('contact.store');

// Notices
// ================= PUBLIC NOTICES =================
Route::get('/notices', [NoticeController::class, 'allNotices'])->name('notices.all');
Route::get('/notices/show/{id}', [NoticeController::class, 'show'])->name('notices.show');
// Blog
Route::prefix('blog')->group(function () {
    Route::get('/', [BlogController::class, 'publicIndex'])->name('public.blog.index');
    Route::get('/{slug}', [BlogController::class, 'publicShow'])->name('public.blog.show');
});

Route::get('/staff', [StaffController::class, 'publicIndex'])->name('staff.public');
// Staff Frontend Route
Route::get('/staff', function() {
    $staffGroups = DB::table('staff')
        ->leftJoin('staff_categories', 'staff.staff_category', '=', 'staff_categories.id')
        ->select(
            'staff.*', 
            'staff_categories.title as category_title',
            'staff_categories.position as category_position'
        )
        ->orderBy('staff_categories.position', 'asc') 
        ->orderBy('staff.position', 'asc') 
        ->get()
        ->groupBy('category_title');

    return view('staff.index', compact('staffGroups'));
})->name('public.staff.index'); // <--- ADD THIS LINE

Route::get('/principal-message', [StaffController::class, 'principalMessage'])->name('principal.message');

// Publications
Route::get('/publications', [PublicationController::class, 'publicIndex'])->name('publications.all');

// Gallery
Route::prefix('gallery')->group(function () {
    Route::get('/', [GalleryController::class, 'publicIndex'])->name('public.gallery.index');
    Route::get('/{id}', [GalleryController::class, 'publicShow'])
        ->name('public.gallery.show')
        ->where('id', '[0-9]+');
});

// Downloads
Route::get('/downloads', function () {
    return view('download');
})->name('public.downloads');

Route::get('/downloads/{dept}/{sem}', function ($dept, $sem) {
    $path = "downloads/{$dept}/{$sem}.pdf";
    if (Storage::disk('public')->exists($path)) {
        return Storage::disk('public')->download($path);
    }
    return back()->with('error', 'File not found.');
})->name('semester.show');

// Programs
Route::get('/programs/plant-science', function () {
    return view('programs.dit');
})->name('programs.dit');

Route::get('/programs/animal-science', function () {
    return view('programs.dce');
})->name('programs.dce'); 

Route::get('/programs/pre-diploma', function () {
    return view('programs.pre-diploma');
})->name('programs.pre-diploma');

Route::get('/video-gallery', [VideoController::class, 'publicIndex'])->name('public.videos.index');

// This MUST be the last route in your web.php file
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Forgot Password
Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');

// OTP Verification
Route::get('/verify-otp', [AuthController::class, 'showVerifyForm'])->name('verify.otp');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('verify.otp.submit');

// Reset Password
Route::get('/reset-password/{token}', function ($token, Request $request) {
    return view('auth.reset-password', [
        'token' => $token,
        'email' => $request->email,
    ]);
})->name('password.reset');

Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
// The main list page
// 1. The Listing Page
Route::get('/short-term-programs', [AnnouncementController::class, 'publicShortTerm'])
    ->name('public.short-term');

// 2. The Detail Page (This is the one causing the error)
Route::get('/short-term/{id}', [AnnouncementController::class, 'showPublic'])
    ->name('public.program.show');

Route::get('/student/login', [AuthController::class, 'showStudentLogin'])->name('student.login');
Route::post('/student/login', [AuthController::class, 'studentLogin'])->name('student.login.submit');
    /*
|--------------------------------------------------------------------------
| ADMIN ROUTES (AUTH REQUIRED)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->prefix('admin')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    /*
    |---------------- GALLERY ----------------|
    */
 Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
    Route::get('/gallery/create', [GalleryController::class, 'create'])->name('gallery.create');
    Route::post('/gallery/store', [GalleryController::class, 'store'])->name('gallery.store');
    Route::get('/gallery/{id}/edit', [GalleryController::class, 'edit'])->name('gallery.edit');
    Route::put('/gallery/{id}/update', [GalleryController::class, 'update'])->name('gallery.update');
    Route::delete('/gallery/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

    /*
    |---------------- ANNOUNCEMENTS ----------------|
    */


    // Video Gallery
// The page with the form
    Route::get('/videos/create', [VideoController::class, 'create'])->name('videos.create');
    
    // The final database save
    Route::post('/videos/store', [VideoController::class, 'store'])->name('videos.store');

    // The FilePond chunk handler
    Route::post('/upload/process', [VideoController::class, 'upload'])->name('upload.process');
    Route::match(['POST', 'PATCH'], '/upload/process', [VideoController::class, 'upload'])->name('upload.process');
  // Announcement Management
    Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
    Route::get('/announcements/create', [AnnouncementController::class, 'create'])->name('announcements.create');
    Route::post('/announcements/store', [AnnouncementController::class, 'store'])->name('announcements.store');
    Route::get('/announcements/{id}/edit', [AnnouncementController::class, 'edit'])->name('announcements.edit');
    Route::put('/announcements/{id}', [AnnouncementController::class, 'update'])->name('announcements.update');
    Route::delete('/announcements/{id}', [AnnouncementController::class, 'destroy'])->name('announcements.destroy');  
Route::get('/announcements/categories', [AnnouncementController::class, 'categories'])->name('announcements.categories');
    Route::post('/announcements/categories/store', [AnnouncementController::class, 'storeCategory'])->name('announcements.categories.store');
    Route::delete('/announcements/categories/{id}', [AnnouncementController::class, 'destroyCategory'])->name('announcements.categories.destroy');
/*
    |---------------- NOTICES ----------------|
    */
Route::prefix('notices')->group(function () {

        // Main Notice Management
        Route::get('/', [NoticeController::class, 'index'])->name('notices.index');
        Route::get('/create', [NoticeController::class, 'create'])->name('notices.create');
        Route::post('/store', [NoticeController::class, 'store'])->name('notices.store');
        Route::get('/show/{id}', [NoticeController::class, 'show'])->name('notices.show');
        Route::get('/{id}/edit', [NoticeController::class, 'edit'])->name('notices.edit');
        Route::put('/{id}', [NoticeController::class, 'update'])->name('notices.update');
        Route::delete('/{id}', [NoticeController::class, 'destroy'])->name('notices.destroy');

        // Notice Categories
        Route::get('/categories', [NoticeCategoryController::class, 'index'])->name('categories.index');
        Route::post('/categories/store', [NoticeCategoryController::class, 'store'])->name('categories.store');
        Route::delete('/categories/{id}', [NoticeCategoryController::class, 'destroy'])->name('categories.destroy');
});


// User Guide
Route::get('/user-guide', function () {
        return view('admin.guide');
    })->name('admin.guide');
    /*
    |---------------- BLOG ----------------|
    */
    Route::prefix('blog')->group(function () {
        Route::get('/', [BlogController::class, 'index'])->name('blog.index');
        Route::get('/create', [BlogController::class, 'create'])->name('blog.create');
        Route::post('/', [BlogController::class, 'store'])->name('blog.store');
        Route::delete('/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');
        // Existing routes...
Route::get('/{post}/edit', [BlogController::class, 'edit'])->name('blog.edit');
Route::put('/{post}', [BlogController::class, 'update'])->name('blog.update');
    });

    // Video
    Route::resource('videos', VideoController::class);
/*
|--------------------------------------------------------------------------
| STAFF & CATEGORY MANAGEMENT
|--------------------------------------------------------------------------
*/

    Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
    Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.create');
    Route::post('/staff/store', [StaffController::class, 'store'])->name('staff.store');
    // THE MISSING ROUTES CAUSING THE ERROR:
    Route::get('/staff/{id}/edit', [StaffController::class, 'edit'])->name('staff.edit');
    Route::put('/staff/{id}', [StaffController::class, 'update'])->name('staff.update');
    Route::delete('/staff/{id}', [StaffController::class, 'destroy'])->name('staff.destroy');
    // Temporary placeholder to stop the error
    // Hierarchy View
    Route::get('/staff/hierarchy', [StaffController::class, 'hierarchy'])->name('staff.hierarchy');

    // AJAX Reorder Action
    Route::post('/staff/reorder', [StaffController::class, 'reorder'])->name('staff.reorder');

    // This handles the /admin/categories URL
    Route::get('/categories', [StaffCategoryController::class, 'index'])->name('staff-categories.index');
    Route::post('/categories', [StaffCategoryController::class, 'store'])->name('staff-categories.store');
    Route::delete('/categories/{id}', [StaffCategoryController::class, 'destroy'])->name('staff-categories.destroy');
        // --- Other Admin Routes ---
        Route::get('/updates', function () {
            return view('admin.updates.index');
        })->name('admin.updates');
    /*
    |---------------- SETTINGS / PRINCIPAL MESSAGE ----------------|
    */
    Route::get('/principal-message', [SettingController::class, 'edit'])->name('principal.edit');
    Route::post('/principal-message', [SettingController::class, 'update'])->name('principal.update');

    /*
    |---------------- CERTIFICATES ----------------|
    */
    Route::prefix('certificates')->group(function () {
        Route::get('/', [CertificateController::class, 'index'])->name('certificates.index');
        Route::get('/create', [CertificateController::class, 'create'])->name('certificates.create');
        Route::post('/', [CertificateController::class, 'store'])->name('certificates.store');
        Route::get('/{id}/edit', [CertificateController::class, 'edit'])->name('certificates.edit');
        Route::put('/{id}', [CertificateController::class, 'update'])->name('certificates.update');
        Route::delete('/{id}', [CertificateController::class, 'destroy'])->name('certificates.destroy');
        Route::get('/{id}/print', [CertificateController::class, 'print'])->name('certificates.print');
    });

    /*
    |---------------- ID CARDS ----------------|
    */
    Route::prefix('id-cards')->group(function () {
        Route::get('/', [IdCardController::class, 'index'])->name('id_cards.index');
        Route::get('/create', [IdCardController::class, 'create'])->name('id_cards.create');
        Route::post('/', [IdCardController::class, 'store'])->name('id_cards.store');
        Route::get('/{id}', [IdCardController::class, 'show'])->name('id_cards.show');
        Route::get('/{id}/edit', [IdCardController::class, 'edit'])->name('id_cards.edit');
        Route::put('/{id}', [IdCardController::class, 'update'])->name('id_cards.update');
        Route::delete('/{id}', [IdCardController::class, 'destroy'])->name('id_cards.destroy');
        Route::get('/{id}/pdf', [IdCardController::class, 'generatePDF'])->name('id_cards.pdf');
    });

    // Login Activities
    Route::get('/login-activity', function () {
        // Using the Model we created is better than DB::table
        $logs = \App\Models\LoginActivity::latest()->paginate(20);
        return view('admin.logs.login_activity', compact('logs'));
    })->name('admin.login_logs');

    Route::get('/security-stats', function () {
    $stats = [
        'total_attempts' => \App\Models\LoginActivity::count(),
        'successful'     => \App\Models\LoginActivity::where('is_successful', true)->count(),
        'failed'         => \App\Models\LoginActivity::where('is_successful', false)->count(),
        // Get the top 5 suspicious IP addresses
        'suspicious_ips' => \App\Models\LoginActivity::where('is_successful', false)
                            ->select('ip_address', \DB::raw('count(*) as total'))
                            ->groupBy('ip_address')
                            ->orderBy('total', 'desc')
                            ->limit(5)
                            ->get(),
    ];

    return view('admin.logs.security_stats', compact('stats'));
    })->name('admin.security_stats');
    
    // Model Resource Routes
    Route::get('/resources', [ResourceController::class, 'index'])->name('resources.index');
    Route::get('/resources/create', [ResourceController::class, 'create'])->name('resources.create');
    Route::post('/resources', [ResourceController::class, 'store'])->name('resources.store');
    Route::get('/resources/{id}/edit', [ResourceController::class, 'edit'])->name('resources.edit');
    Route::put('/resources/{id}', [ResourceController::class, 'update'])->name('resources.update');
    Route::delete('/resources/{id}', [ResourceController::class, 'destroy'])->name('resources.destroy');
    /*
    |---------------- PUBLICATIONS ----------------|
    */
    Route::resource('publications', PublicationController::class);

   Route::prefix('publication-categories')->group(function () {
        Route::get('/', [PublicationCategoryController::class, 'index'])->name('pub-categories.index');
        Route::post('/', [PublicationCategoryController::class, 'store'])->name('pub-categories.store');
        Route::delete('/{id}', [PublicationCategoryController::class, 'destroy'])->name('pub-categories.destroy');
    });

    // Contact
    Route::get('/contacts', function () {
        $contacts = DB::table('contacts')->latest()->paginate(10);
        return view('admin.contacts.index', compact('contacts'));
    })->name('admin.contacts.index'); // <--- THIS IS THE MISSING PIECE

    /*
    |---------------- USERS ----------------|
    */
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/store', [UserController::class, 'store'])->name('users.store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    /*
    |---------------- HOSTING ----------------|
    */
    Route::get('/hosting', function () {
        return view('admin.hosting');
    })->name('admin.hosting');

    

}); // end auth middleware