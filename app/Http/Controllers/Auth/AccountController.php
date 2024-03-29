<?php
namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Mail\Verification;
use Illuminate\Support\Facades\Mail;


class AccountController extends Controller
{

    public function loginform()
    {
        return view('accounts.login');
    }

    public function signupform()
    {
        return view('accounts.signup');
    }

    public function AdminSignupForm()
    {
        return view('accounts.adminsignup');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:12',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('customer_images'), $imageName);


        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'roles' => 'customer',
            'status' => 'Pending'
        ]);
        $user->save();


        $customerInfo = new Customer([
            'user_id' => $user->id,
            'name' => $request->name,
            'Address' => $request->address, 
            'PhoneNumber' => $request->phone,
            'image' => $imageName,
        ]);
        $customerInfo->save();

        Mail::to($request->email)->send(new Verification($request->email, $request->name));

        return redirect()->route('login.form')->with('success', 'Registration successful!');
    }

    public function registerAdmin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'roles' => 'admin',
            'status' => 'Verified',
        ]);
        $user->save();

        return redirect()->route('login.form')->with('success', 'Admin Register Successfully!');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = auth()->user();
            $roles = $user->roles;
            $status = $user->status;
        if($status === 'Verified')
        {
    
            if($roles === 'customer')
            {
                return redirect()->route('customer.index')->with('success','Login Successfully');
            }
            elseif($roles === 'admin')
            {
                return redirect()->route('admin.products.index')->with('success','Login Successfully');
            }
            else{
                dd('ERROR');
            }

        }
        elseif($status === 'Pending')
        {
            Auth::logout(); // Logout the user
            $request->session()->invalidate(); // Invalidate the session
            return redirect()->route('login.form')->with('error','Please Verify your Account First');
        }
        else
        {
            Auth::logout(); // Logout the user
            $request->session()->invalidate(); // Invalidate the session
            return redirect()->route('login.form')->with('error','Your Account has been Banned');
        }
        }
        else{
            return redirect()->route('login.form')->with('error','Incorrect Email or Password');
        }
    }


    public function showProfile()
    {
        $user = Auth::user(); // Get the logged-in user
        $customerInfo = Customer::where('user_id', $user->id)->first(); // Fetch customer info based on user ID
    
        // Fetch email from the User model
        $email = $user->email;
    
        return view('customer.profile', compact('customerInfo', 'email'));
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Logout the user
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate CSRF token

        return redirect()->route('login.form')->with('success', 'You have been logged out.');
    }

    public function edit()
    {
        $user = Auth::user();
        $customerInfo = Customer::where('user_id', $user->id)->first();
        $email = $user->email;
    
        return view('customer.editprofile', compact('customerInfo', 'email'));
    }
    

public function update(Request $request)
{
    $user = Auth::user();
    $customerInfo = Customer::where('user_id', $user->id)->first();
    $email = $user->email;

    $request->validate([
        'address' => 'required|string|max:255',
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:12',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Update email, address, and phone
    $user->email = $request->email;
    $customerInfo->name = $request->name;
    $customerInfo->Address = $request->address;
    $customerInfo->PhoneNumber = $request->phone;

    // Update image if provided
    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('customer_images'), $imageName);
        $customerInfo->image = $imageName;
    }

    $user->save();
    $customerInfo->save();

    return redirect()->route('customer.profile')->with('success', 'Profile updated successfully.');
}

public function showChangePasswordForm()
{
    return view('customer.changepass');
}

public function changePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required|string',
        'password' => 'required|string|min:8|confirmed',
    ], [
        'current_password.required' => 'Please enter your current password.',
        'password.required' => 'Please enter a new password.',
        'password.min' => 'New password must be at least 8 characters.',
        'password.confirmed' => 'Passwords do not match.',
    ]);

    $user = Auth::user();

    // Check if the current password matches the one in the database
    if (Hash::check($request->current_password, $user->password)) {
        // Update the password
        $user->password = Hash::make($request->password);
        $user->save();

        // Logout the user
        Auth::logout();

        return redirect()->route('login')->with('success', 'Password changed successfully. Please login with your new password.');
    } else {
        return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
    }
}

public function verify($email)
{
    $user = User::where('email', $email)->first();
    $user->status = 'Verified';
    $user->email_verified_at = now();
    $user->save();

    return redirect()->route('login.form')->with('success', 'Your Account is Verified. You can login now');
}


}
