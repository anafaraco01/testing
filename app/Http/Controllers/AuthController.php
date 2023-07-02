<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Report;
use App\Models\Truck;
use App\Models\User;
use App\Models\Invoices;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use function PHPUnit\Framework\callback;

class AuthController extends Controller
{
    /**
     * Returns registration view
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.registration');
    }

    /**
     * Validate and create an incoming user request
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])/',
                'role' => 'required'
            ],
            [
                'password.regex' => 'Password must contain at least one letter and one number'
            ]
        );

        $data = $request->all();
        $check = $this->create($data);

        return redirect(route('users.index'))->withSuccess('User created!');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @return response()
     */
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role']
        ]);
    }

    /**
     * Return login view
     *
     * @return response()
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * After the user submits the login form, the credentials are validated
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $userFind = User::where('email', $request->only('email'));
            $userFind->increment('loginTracker');
            $userFind->update([
                'last_login_at' => Carbon::now()->addHours(2),
                'last_login_ip' => $request->getClientIp(),
            ]);
            return redirect()->intended('dashboard')->withSuccess('Welcome Back!');
        }

        return redirect("login")->withSuccess('Oops! You have entered invalid credentials');
    }

    /**
     * Check if the user has changed their password
     *
     * @return response()
     */
    public function dashboard(Request $request, User $user)
    {
        if (Auth::check()) {
            $role = $request->user()->role;
            $password_changed = $request->user()->password_changed;
            $trucks = Truck::simplePaginate(25);
            $users = User::all();
            $date = date('Y-m-d');
            $currentWeek = (int)date('W', strtotime($date));
            $truckIDs = [0, 1, 3, 4, 5];
            $totalRevenue = [];
            $purchaseSold = [];
            $prevWeekRevenue = [];
            $prevWeekPurchaseSold = [];


            if (!$password_changed) {
                return redirect(route('password.change', $user->id));
            } else {
                $invoices = Invoices::all();
                foreach ($truckIDs as $truckID) {
                    $purchaseSold[$truckID] = $invoices
                        ->where('truck_id', $truckID)
                        ->where('week', $currentWeek )
                        ->sum('value') ;
                    $prevWeekPurchaseSold[$truckID] = $invoices
                        ->where('truck_id', $truckID)
                        ->where('week', $currentWeek-1 )
                        ->sum('value') ;
                    $totalRevenue[$truckID] = $invoices
                        ->where('truck_id', $truckID)
                        ->where('week', $currentWeek )
                        ->sum('amount_to_pay') ;
                    $prevWeekRevenue[$truckID] = $invoices
                        ->where('truck_id', $truckID)
                        ->where('week', $currentWeek-1 )
                        ->sum('amount_to_pay') ;
                }




                return view('levels.level1', compact('trucks', 'role', 'users', 'password_changed','prevWeekRevenue','totalRevenue','prevWeekPurchaseSold','purchaseSold','truckIDs'));
            }
        }

        return redirect("login")->withSuccess('Oops! You do not have access');
    }


    /**
     * Returns the level 2 view
     *
     * @return response()
     */
    public function level2(Request $request)
    {
        $user = $request->user();
        $date = date('Y-m-d');
        $currentWeek = (int)date('W', strtotime($date));
        $truckIDs = [0, 1, 3, 4, 5];
        $totalRevenue = [];

        if (!$user->password_changed) {
            return redirect(route('password.change', $user->id));
        } else {
            // Retrieve all invoices from the database
            $invoices = Invoices::all();

            // Calculate the sum of purchase value per truck and total
            $totalPurchaseSoldT0 = $invoices
                ->where('truck_id', 0)
                ->whereIn('week', range($currentWeek - 4, $currentWeek))
                ->sum('value');

            $totalPurchaseSoldT1 = $invoices
                ->where('truck_id', 1)
                ->whereIn('week', range($currentWeek - 4, $currentWeek))
                ->sum('value');

            $totalPurchaseSoldT3 = $invoices
                ->where('truck_id', 3)
                ->whereIn('week', range($currentWeek - 4, $currentWeek))
                ->sum('value');

            $totalPurchaseSoldT4 = $invoices
                ->where('truck_id', 4)
                ->whereIn('week', range($currentWeek - 4, $currentWeek))
                ->sum('value');

            $totalPurchaseSoldT5 = $invoices
                ->where('truck_id', 5)
                ->whereIn('week', range($currentWeek - 4, $currentWeek))
                ->sum('value');

            $totalPurchaseSold = $invoices
                ->whereIn('week', range($currentWeek - 4, $currentWeek))
                ->sum('value');

            // Calculate the sum of revenue per truck and total
            foreach ($truckIDs as $truckID) {
                $totalRevenue[$truckID] = $invoices
                    ->where('truck_id', $truckID)
                    ->whereIn('week', range($currentWeek - 4, $currentWeek))
                    ->sum('amount_to_pay') ;
            }

            // Calculate the sum of profit margin for each truck and total
            $invoiceAmountTotal = $invoices
                ->whereIn('week', range($currentWeek - 4, $currentWeek))
                ->count();
            $invoiceAmountT0 = $invoices
                ->where('truck_id', 0)
                ->whereIn('week', range($currentWeek - 4, $currentWeek))
                ->count();
            $invoiceAmountT1 = $invoices
                ->where('truck_id', 1)
                ->whereIn('week', range($currentWeek - 4, $currentWeek))
                ->count();
            $invoiceAmountT3 = $invoices
                ->where('truck_id', 3)
                ->whereIn('week', range($currentWeek - 4, $currentWeek))
                ->count();
            $invoiceAmountT4 = $invoices
                ->where('truck_id', 4)
                ->whereIn('week', range($currentWeek - 4, $currentWeek))
                ->count();
            $invoiceAmountT5 = $invoices
                ->where('truck_id', 5)
                ->whereIn('week', range($currentWeek - 4, $currentWeek))
                ->count();



            $profitMarginT0 = ($totalRevenue[0] - $totalPurchaseSoldT0) / $totalRevenue[0] * 100;
            $profitMarginT1 = ($totalRevenue[1] - $totalPurchaseSoldT1) / $totalRevenue[1] * 100;
            $profitMarginT3 = ($totalRevenue[3] - $totalPurchaseSoldT3) / $totalRevenue[3] * 100;
            $profitMarginT4 = ($totalRevenue[4] - $totalPurchaseSoldT4) / $totalRevenue[4] * 100;
            $profitMarginT5 = ($totalRevenue[5] - $totalPurchaseSoldT5) / $totalRevenue[5] * 100;
            $profitMargin = (array_sum($totalRevenue) - $totalPurchaseSold) / array_sum($totalRevenue) * 100; // Calculate the profit margin

            // Pass the invoices and total amount to level 2 total view
            return view('levels.level2', compact(
                'totalRevenue',
                'totalPurchaseSoldT0',
                'totalPurchaseSoldT1',
                'totalPurchaseSoldT3',
                'totalPurchaseSoldT4',
                'totalPurchaseSoldT5',
                'totalPurchaseSold',
                'profitMarginT0',
                'profitMarginT1',
                'profitMarginT3',
                'profitMarginT4',
                'profitMarginT5',
                'profitMargin',
                'invoiceAmountTotal',
                'invoiceAmountT0',
                'invoiceAmountT1',
                'invoiceAmountT3',
                'invoiceAmountT4',
                'invoiceAmountT5'
            ));
        }
    }

    /**
     * Returns the level 3 view
     *
     * @return response()
     */
    public function level3(Request $request)
    {
        $user = $request->user();
        $date = date('Y-m-d');
        $currentWeek = (int)date('W', strtotime($date));
        $truckIDs = [0, 1, 3, 4, 5];
        $totalRevenue = [];
        $purchaseSold = [];


        $customers = Customer::all();
        // Retrieve all invoices from the database
        $invoices = Invoices::all();
        foreach ($truckIDs as $truckID) {
            $purchaseSold[$truckID] = $invoices
                ->where('truck_id', $truckID)
                ->where('week', $currentWeek)
                ->sum('value');
            $totalRevenue[$truckID] = $invoices
                ->where('truck_id', $truckID)
                ->where('week', $currentWeek - 1)
                ->sum('amount_to_pay');
            return view('levels.level3', compact('customers', 'totalRevenue', 'purchaseSold'));
            return view('levels.level2', compact('reports'));

        }
    }
    /**
     * Returns the password change view
     *
     * @return response()
     */
    public function showChangeForm()
    {
        $user = Auth::user();

        return view('auth.passwords.change', compact('user'));
    }

    /**
     * Validate and change the user's password
     *
     * @return response()
     */
    public function changePassword(Request $request)
    {
        // Finds the user
        $user = User::find($request->id);

        // Validation the password
        $request->validate([
            'password' => 'required|confirmed|min:8|regex:/\d/|regex:/[a-zA-Z]/',
            'secret_answer1' => 'required',
            'secret_answer2' => 'required'
        ], [
            'password.regex' => 'Password must contain at least one letter and one number'
        ]);

        // Update the user's information
        $user->password = Hash::make($request->password);
        $user->secret_answer1 = Hash::make($request->secret_answer1);
        $user->secret_answer2 = Hash::make($request->secret_answer2);

        // Closes the logic that forces to change the password
        $user->password_changed = true;
        $user->save();

        // Redirects the user to the dashboard
        return redirect()->intended('dashboard')->with('success', 'Password changed successfully.');
    }

    /**
     * Returns the password reset view
     *
     * @return response()
     */
    public function showResetForm()
    {
        $user = Auth::user();

        return view('auth.passwords.reset', compact('user'));
    }

    public function resetPassword(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();

        if (
            !$user || !Hash::check($request->input('secret_answer1'), $user->secret_answer1) ||
            !Hash::check($request->input('secret_answer2'), $user->secret_answer2)
        ) {
            // Secret question/answer doesn't match
            return redirect(route('questions.check'))->withSuccess('Your email or your answers are incorrect');
        }

        $request->validate([
            'password' => 'required|confirmed|min:8|regex:/\d/|regex:/[a-zA-Z]/'
        ], [
            'password.regex' => 'Password must contain at least one letter and one number'
        ]);

        // Update the user's password and set the "password_changed" flag
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('login')->with('status', 'Password changed successfully. Please login.');
    }

    /**
     * Logout the user
     *
     * @return response()
     */
    public function logout(Request $request)
    {
        if (Auth::check()) {
            $user = User::where('id', $request->user()->id);

            $user->update([
                'last_logout_at' => Carbon::now()->addHours(2),
            ]);
            Session::flush();
            Auth::logout();
        }
        return redirect('login');
    }
}
