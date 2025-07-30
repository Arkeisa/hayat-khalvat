<?php

namespace App\Http\Controllers;

use App\Models\COFE;

use App\Models\Food;

use App\Models\User;
use App\Models\Order;
use App\Models\Doctor;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function add_food()
    {
        return view('admin.add_food');
    }


    public function upload_food(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'title' => 'required',
                'details' => 'required',
                'price' => 'required|numeric',
                'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'category' => 'required'
            ]);

            Log::info('Validation passed', $request->all());

            // Create new food item
            $data = new Food();
            $data->title = $request->title;
            $data->details = $request->details;
            $data->price = $request->price;
            $data->category = $request->category;

            // Handle image upload
            if ($request->hasFile('img')) {
                $image = $request->file('img');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('food_img'), $filename);
                $data->image = $filename;
                Log::info('Image uploaded: ' . $filename);
            }

            // Save to database
            $saved = $data->save();
            Log::info('Save result: ' . ($saved ? 'success' : 'failed'));

            if (!$saved) {
                Log::error('Failed to save food item');
                return redirect()->back()->with('error', 'خطا در ذخیره سازی غذا');
            }

            return redirect()->back()->with('success', 'غذا با موفقیت اضافه شد');
        } catch (\Exception $e) {
            Log::error('Error saving food: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return redirect()->back()->with('error', 'خطا در ذخیره سازی غذا: ' . $e->getMessage());
        }
    }

    public function upload_item(Request $request)
    {
        try {
            // Add logging to debug
            Log::info('Upload item request received', $request->all());

            // Validate the request
            $validated = $request->validate([
                'title' => 'required',
                'details' => 'required',
                'price' => 'required|numeric',
                'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'category' => 'required'
            ]);

            $data = new COFE;
            $data->title = $request->title;
            $data->detail = $request->details;
            $data->price = $request->price;
            $data->category = $request->category;

            if ($request->hasFile('img')) {
                $image = $request->file('img');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('food_img'), $filename);
                $data->image = $filename;
                Log::info('Image uploaded: ' . $filename);
            }

            $saved = $data->save();
            Log::info('Save result: ' . ($saved ? 'success' : 'failed'));

            if (!$saved) {
                Log::error('Failed to save item');
                return redirect()->back()->with('error', 'خطا در ذخیره سازی محصول');
            }

            return redirect()->back()->with('success', 'محصول با موفقیت اضافه شد');
        } catch (\Exception $e) {
            Log::error('Error saving item: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return redirect()->back()->with('error', 'خطا در ذخیره سازی محصول: ' . $e->getMessage());
        }
    }


    public function view_food()
    {
        $data = Food::all();
        return view('admin.show_food',compact('data'));
    }

    public function delete_food($id)
    {
        // Try to find item in food table first
        $data = Food::find($id);

        // If not found in food table, try COFE table
        if (!$data) {
            $data = COFE::find($id);
        }

        if (!$data) {
            return redirect('/dash')->with('error', 'آیتم مورد نظر یافت نشد');
        }

        // Delete the image file if it exists
        if ($data->image && file_exists(public_path('food_img/'.$data->image))) {
            unlink(public_path('food_img/'.$data->image));
        }

        $data->delete();
        return redirect('/dash')->with('success', 'آیتم با موفقیت حذف شد');
    }


    public function update_food($id)
    {
        $type = request()->query('type');

        if ($type === 'cofe') {
            $item = COFE::find($id);
        } else {
            $item = Food::find($id);
        }

        if (!$item) {
            return redirect()->back()->with('error', 'آیتم مورد نظر یافت نشد');
        }

        return view('admin.update_food', compact('item', 'type'));
    }

    public function edit_food(Request $request, $id)
    {
        try {
            $type = $request->input('model_type');

            if ($type === 'cofe') {
                $data = COFE::find($id);
                if ($data) {
                    $data->title = $request->title;
                    $data->detail = $request->details; // Note: we receive as 'details' but save as 'detail'
                    $data->price = $request->price;
                    $data->category = $request->category;

                    if ($request->hasFile('image')) {
                        // Delete old image if exists
                        if ($data->image && file_exists(public_path('food_img/'.$data->image))) {
                            unlink(public_path('food_img/'.$data->image));
                        }

                        $image = $request->file('image');
                        $imagename = time().'.'.$image->getClientOriginalExtension();
                        $image->move(public_path('food_img'), $imagename);
                        $data->image = $imagename;
                    }

                    $data->save();
                }
            } else {
                $data = Food::find($id);
                if ($data) {
                    $data->title = $request->title;
                    $data->details = $request->details;
                    $data->price = $request->price;
                    $data->category = $request->category;

                    if ($request->hasFile('image')) {
                        // Delete old image if exists
                        if ($data->image && file_exists(public_path('food_img/'.$data->image))) {
                            unlink(public_path('food_img/'.$data->image));
                        }

                        $image = $request->file('image');
                        $imagename = time().'.'.$image->getClientOriginalExtension();
                        $image->move(public_path('food_img'), $imagename);
                        $data->image = $imagename;
                    }

                    $data->save();
                }
            }

            if (!$data) {
                return redirect()->back()->with('error', 'آیتم مورد نظر یافت نشد');
            }

            return redirect('/dash')->with('success', 'آیتم با موفقیت بروزرسانی شد');

        } catch (\Exception $e) {
            Log::error('Error updating item: ' . $e->getMessage());
            return redirect()->back()->with('error', 'خطا در بروزرسانی آیتم: ' . $e->getMessage());
        }
    }

    public function orders()
    {
        if(Auth::user()->role === 'admin') {
            // Admin sees all orders
            $orders = Order::orderBy('created_at', 'desc')->get();
        } else {
            // User sees only their orders
            $orders = Order::where('email', Auth::user()->email)
                        ->orderBy('created_at', 'desc')
                        ->get();
        }

        return view('admin.order', compact('orders'));
    }



    public function on_the_way($id)
    {
        $order = Order::find($id);
        $order->status = "preparing";
        $order->save();
        return redirect()->back();
    }

    public function delivered($id)
    {
        $order = Order::find($id);
        $order->status = "delivering";
        $order->save();
        return redirect()->back();
    }

    public function canceled($id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->status = "canceled";
            $order->save();
            return redirect()->back();
        }
    }

    public function delete_user($id)
    {
        try {
            $user = User::find($id);
            if($user) {
                $user->delete();
                return redirect()->back()->with('success', 'کاربر با موفقیت حذف شد');
            }
            return redirect()->back()->with('error', 'کاربر یافت نشد');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'خطا در حذف کاربر');
        }
    }

    public function edit_user($id)
    {
        $user = User::find($id);
        if(!$user) {
            return redirect()->back()->with('error', 'کاربر یافت نشد');
        }
        return view('admin.edit_user', compact('user'));
    }

    public function update_user(Request $request, $id)
    {
        try {
            $user = User::find($id);
            if(!$user) {
                return redirect()->back()->with('error', 'کاربر یافت نشد');
            }

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,'.$id,
                'phone' => 'required|string|max:11',
                'role' => 'required|in:admin,user,doctor',
            ]);

            $user->update($validated);

            return redirect('/dash')->with('success', 'اطلاعات کاربر با موفقیت بروزرسانی شد');
        } catch (\Exception $e) {
            return redirect('/dash')->with('error', 'خطا در بروزرسانی اطلاعات کاربر');
        }
    }

    public function user_list()
    {
        $users = User::all();
        return view('admin.user_list', compact('users'));
    }

    public function cancelUserOrder($id)
    {
        try {
            $order = Order::find($id);

            if (!$order || $order->email !== Auth::user()->email) {
                return redirect()->back()->with('error', 'سفارش یافت نشد');
            }

            $orderTime = \Carbon\Carbon::parse($order->created_at);
            if ($orderTime->diffInMinutes(now()) > 5) {
                return redirect()->back()->with('error', 'زمان کنسل کردن سفارش به پایان رسیده است');
            }

            $order->status = 'canceled';
            $order->save();

            return redirect()->back()->with('success', 'سفارش با موفقیت کنسل شد');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'خطا در کنسل کردن سفارش');
        }
    }

    public function userOrders()
    {
        if(Auth::user()->role !== 'user') {
            return redirect()->back();
        }

        $userOrders = Order::where('email', Auth::user()->email)
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('admin.user_order', compact('userOrders'));
    }



    public function upload_gal(Request $request)
    {
        $validated = $request->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'details' => 'required',
        ]);

        $data = new Gallery();
        $data->details = $request->details;

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            // Create directory if it doesn't exist
            $path = public_path('images/gallery');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $image->move($path, $filename);
            $data->image = $filename;
            Log::info('Gallery image uploaded: ' . $filename);
        }

        $data->save();
        return redirect()->back()->with('success', 'تصویر با موفقیت اضافه شد');
    }

    public function delete_gallery($id)
    {
        try {
            $gallery_item = Gallery::find($id);

            if ($gallery_item) {
                // Delete the image file
                if ($gallery_item->image && file_exists(public_path('images/gallery/'.$gallery_item->image))) {
                    unlink(public_path('images/gallery/'.$gallery_item->image));
                }

                // Delete the database record
                $gallery_item->delete();
                return redirect('/dash')->with('success', 'تصویر با موفقیت حذف شد');
            }

            return redirect('/dash')->with('error', 'تصویر یافت نشد');
        } catch (\Exception $e) {
            return redirect('/dash')->with('error', 'خطا در حذف تصویر');
        }
    }

    public function deleteOrder($id)
    {
        try {
            // Find all orders with the same timestamp and email
            $order = DB::table('orders')->find($id);
            if ($order) {
                // Delete all related orders (items from the same order)
                DB::table('orders')
                    ->where('email', $order->email)
                    ->where('created_at', $order->created_at)
                    ->delete();

                return redirect()->back()->with('success', 'سفارش با موفقیت حذف شد');
            }

            return redirect()->back()->with('error', 'سفارش یافت نشد');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'خطا در حذف سفارش');
        }
    }

    public function userInfo()
    {
        return view('admin.user_info');
    }

    public function updateUserInfo(Request $request)
    {
        try {
            $user = User::find(Auth::id());
            if (!$user) {
                return redirect()->back()->with('error', 'کاربر یافت نشد');
            }

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,'.$user->id,
                'phone' => 'required|string|max:11',
                'password' => 'nullable|min:8|confirmed'
            ], [
                'name.required' => 'نام الزامی است',
                'lastname.required' => 'نام خانوادگی الزامی است',
                'email.required' => 'ایمیل الزامی است',
                'email.email' => 'ایمیل معتبر نیست',
                'email.unique' => 'این ایمیل قبلا ثبت شده است',
                'phone.required' => 'شماره تلفن الزامی است',
                'password.min' => 'رمز عبور باید حداقل 8 کاراکتر باشد',
                'password.confirmed' => 'رمز عبور و تکرار آن مطابقت ندارند'
            ]);

            $user->name = $validated['name'];
            $user->lastname = $validated['lastname'];
            $user->email = $validated['email'];
            $user->phone = $validated['phone'];

            if ($request->filled('password')) {
                $user->password = Hash::make($validated['password']);
            }

            if (!$user->save()) {
                Log::error('Failed to save user: ' . json_encode($user->getAttributes()));
                return redirect()->back()->with('error', 'خطا در ذخیره اطلاعات کاربر');
            }

            return redirect()->back()->with('success', 'اطلاعات با موفقیت بروزرسانی شد');
        } catch (\Exception $e) {
            Log::error('Error updating user info: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return redirect()->back()->with('error', 'خطا در بروزرسانی اطلاعات: ' . $e->getMessage());
        }
    }
}
