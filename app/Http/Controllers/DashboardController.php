<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notice;
use App\Models\Staff;
use App\Models\BlogPost; // Changed from Blog to BlogPost to match your web.php imports
use App\Models\Gallery;
use App\Models\Publication;
use App\Models\IdCard; // Ensure this exists or use a DB count
use Illuminate\Support\Facades\DB; // Ensure DB is imported

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'userCount'        => User::count(),
            'noticesCount'     => Notice::count(),
            'staffCount'       => Staff::count(),
            'blogCount'        => BlogPost::count(),
            'galleryCount'     => Gallery::count(),
            'publicationCount' => Publication::count(),
            'idCardsCount'     => \DB::table('id_cards')->count(), 

            // New: Contact Count
            'contactCount'     => DB::table('contacts')->count(),

            'recentNotices'    => Notice::latest()->take(5)->get(),
            'recentBlogs'      => BlogPost::latest()->take(5)->get(),
            'recentPublications' => Publication::latest()->take(5)->get(),
            'recentGallery'    => Gallery::latest()->take(8)->get(),

            'recentContacts'   => DB::table('contacts')->latest()->take(5)->get(),
        ]);
    }
}