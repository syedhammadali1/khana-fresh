<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\UserDataRequest;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Options;
use App\Models\Plan;
use App\Models\Product;
use App\Models\Term;
use App\Models\User;
use App\Models\UserPlan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Matrix\Functions;

class FrontendController extends Controller
{


    public function home()
    {
        // scheduleUserPlanPendingToActive();

        $plans = Plan::orderBy('limit')->get();
        $products = Product::orderBy('created_at', 'desc')->paginate(8);


        return view('frontend.home', compact('plans', 'products'));
    }

    public function userMenu(User $user, Plan $plan)
    {
        if (auth()->id() != $user->id) {
            abort(403);
        }
        $meals = auth()->user()->meals()->wherePivot('plan_id', $plan->id)->get();
        $userplan = auth()->user()->plan()->where('plan_id', $plan->id)->first();

        return view('frontend.subscriptionplan', compact('meals', 'userplan'));
    }
    public function userMenuEdit(User $user, Plan $plan)
    {
        if (auth()->id() != $user->id) {
            abort(403);
        }
        // $meals = DB::table('product_user')
        //     ->where('product_user.user_id', $user->id)
        //     ->where('product_user.plan_id', $plan->id)
        //     ->select('product_user.product_id', DB::raw('COUNT(product_id) as count'))
        //     ->groupBy('product_id')
        //     ->orderBy('count')
        //     ->get()->toArray();
        $meals = DB::table('product_user')
            ->where('product_user.user_id', $user->id)
            ->where('product_user.plan_id', $plan->id)
            ->get()->toArray();
        $productsQuantity =  [];
        collect($meals)->map(function ($meal) use (&$productsQuantity) {
            $productsQuantity += [$meal->product_id => $meal->quantity];
        });
        return view('frontend.plan-product-edit', compact('plan', 'productsQuantity'));
    }

    public function planCancel(UserPlan $userplan, Request $request)
    {
        if ($request->for == 'cancel') {
            $userplan->update([
                'status' => 0
            ]);
        }
        if ($request->for == 'renew') {
            $array = auth()->user()->plan()->pluck('status')->toArray();
            if (in_array(1, $array) || in_array(2, $array)) {
                add_error('You are already using a plan');
            } else {
                $userplan->update([
                    'status' => 2
                ]);
            }
        }
        return redirect()->back();
    }
    // public function productsbycategory($id)
    // {
    //     $productsbycategory =  Category::find($id)->products;

    //     // return view('frontend.category_products')->render();

    //     return response()->json([
    //         'productsbycategory' =>  $productsbycategory,
    //     ]);
    // }

    // public function categoryproducts()
    // {
    //     $products = Product::all();
    //     return response()->json([
    //         'products' => $products,
    //     ]);
    // }

    public function showdataonload($id)
    {
        $data =  Product::where('category_id', $id)->get();
        //  $data = Product::with('media')->get();
        return response()->json([
            'data' =>  $data,
        ]);
    }


    public function plan()
    {
        $featuredProducts = Product::where('featured', 1)->get();
        return view('frontend.plan', compact('featuredProducts'));
    }
    public function aboutus()
    {
        return view('frontend.aboutus');
    }
    public function menu()
    {
        $featuredProducts = Product::where('featured', 1)->get();
        return view('frontend.menu', compact('featuredProducts'));
    }
    public function recipes(Product $product)
    {
        return view('frontend.recipes', compact('product'));
    }
    public function contactus()
    {
        return view('frontend.contactus');
    }
    public function latestnews()
    {
        $blogs = Blog::with('category', 'media')->where('featured', 1)->get();
        return view('frontend.latestnews', compact('blogs'));
    }
    public function myaccount()
    {
        return view('frontend.myaccount');
    }
    public function dashboard()
    {
        return view('frontend.dashboard');
    }

    public function singleblog(Blog $blog)
    {

        return view('frontend.singleblog', compact('blog'));
    }

    public function terms()
    {
        $terms = Term::all();
        // dd($term);
        return view('frontend.terms', compact('terms'));
    }



    public function userRegister(Request $request)
    {
        $request->validate([
            "email" => "required",
            "password" => "required",
            // "zipCode" => "required",

        ]);


        User::create([
            "email" => $request->email,
            "password" => $request->password,
            "status" => 0,
            // "post_author" => $request->post_author,


        ]);

        return redirect()->back();
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        // auth()->user()->update([
        //     'password' => Hash::make($request->password)
        // ]);
        User::find(auth()->id())->update([
            'password' => Hash::make($request->password)
        ]);
        return redirect()->route('frontend.dashboard')->with(['success' => 'password updated successfully']);;
    }

    public function checkPassword(Request $request)
    {
        if (cache()->get('CardAttemps') >= 3) {
            return redirect()->route('frontend.dashboard')->with(['error' => 'You’ve reached the maximum attempts']);;
        }

        if (!Hash::check($request->password, auth()->user()->password)) {
            if (cache()->has('CardAttemps')) {
                $value =  cache()->get('CardAttemps');
                cache()->put('CardAttemps', $value + 1);
            } else {
                cache()->remember('CardAttemps', Carbon::now()->addHour(), function () {
                    return 1;
                });
            }
            return redirect()->route('frontend.dashboard')->with(['error' => 'password does not match']);;
        } else {
            if (cache()->has('CardAttemps')) {
                cache()->forget('CardAttemps');
            }
            cache()->remember('checkCardNumber', Carbon::now()->addMinute(), function () {
                return true;
            });
            return redirect()->route('frontend.dashboard')->with(['success' => 'Identity Confirmed']);;
        }
    }

    public function profileupdate(ProfileRequest $request)
    {
        $user = User::find(auth()->user()->id)->update($request->validated());
        return redirect()->route('frontend.dashboard')->with(['success' => 'profile updated successfully']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('frontend.home')->with(['success' => 'logout successfully']);
    }



    public function userData(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        if (isset(auth()->user()->id)) {
            return redirect()->route('frontend.dashboard');
        } else {
            session()->flash('_old_input.register_email', $request->email);
            if (isset($request->zip)) {
                // session(['_old_input.register_zip' => $request->zip]); //permenant set
                session()->flash('_old_input.register_zip', $request->zip);
            }
            return redirect()->route('frontend.myaccount');
        }
    }

    public function search(Request $request)
    {
        $request->validate([
            'keyword' => 'required'
        ]);

        $products =  Product::where('name', 'Like', '%' . $request->keyword . '%')->get();

        return view('frontend.search', compact('products'));
    }
}
