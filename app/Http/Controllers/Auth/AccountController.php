<?php
namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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

        return redirect()->route('login.form')->with('success', 'Registration successful!');
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
            if($roles === 'customer')
            {
                return redirect()->route('customer.index')->with('success','Login Successfully');
            }
            elseif($roles === 'admin')
            {
                //mapupunta sa admin hindi pa ito final
            }
            else{
                dd('ERROR');
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

        return redirect()->route('home')->with('success', 'You have been logged out.');
    }
    
}
