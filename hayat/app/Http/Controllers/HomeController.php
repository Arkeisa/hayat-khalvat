<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\COFE;
use App\Models\Food;
use App\Models\Order;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function add_cart(Request $request, $id)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'لطفا وارد شوید'], 401);
        }

        try {
            $userId = Auth::id();
            $item = Food::find($id);

            if (!$item) {
                return response()->json(['error' => 'آیتم مورد نظر یافت نشد'], 404);
            }

            // Check if the item already exists in the cart for the user
            $cartItem = Cart::where('userid', $userId)
                           ->where('title', $item->title)
                           ->first();

            if ($cartItem) {
                // Update existing cart item
                $cartItem->quantity += 1;
                $cartItem->price = $item->price;
                $cartItem->save();
            } else {
                // Create new cart item
                Cart::create([
                    'userid' => $userId,
                    'title' => $item->title,
                    'details' => $item->detail ?? '',
                    'price' => $item->price,
                    'image' => $item->image,
                    'quantity' => 1
                ]);
            }

            return response()->json(['success' => true, 'message' => 'آیتم به سبد خرید اضافه شد']);
        } catch (\Exception $e) {
            Log::error('Error adding to cart: ' . $e->getMessage());
            return response()->json(['error' => 'خطا در افزودن به سبد خرید'], 500);
        }
    }

    // New function for coffee items
    public function add_coffee_cart(Request $request, $id)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'لطفا وارد شوید'], 401);
        }

        try {
            $userId = Auth::id();
            $item = COFE::find($id);

            if (!$item) {
                return response()->json(['error' => 'آیتم مورد نظر یافت نشد'], 404);
            }

            $cartItem = Cart::where('userid', $userId)
                           ->where('title', $item->title)
                           ->first();

            if ($cartItem) {
                $cartItem->quantity += 1;
                $cartItem->price = $item->price;
                $cartItem->save();
            } else {
                Cart::create([
                    'userid' => $userId,
                    'title' => $item->title,
                    'details' => $item->detail ?? '',
                    'price' => $item->price,
                    'image' => 'food_img/' . $item->image,
                    'quantity' => 1
                ]);
            }

            return response()->json(['success' => true, 'message' => 'آیتم به سبد خرید اضافه شد']);
        } catch (\Exception $e) {
            Log::error('Error adding coffee to cart: ' . $e->getMessage());
            return response()->json(['error' => 'خطا در افزودن به سبد خرید'], 500);
        }
    }

    public function my_cart()
    {
        $user_id = Auth::id();
        $data = Cart::where('userid', '=', $user_id)->get();

        return view('pages.addcart', compact('data'));
    }

    public function remove_cart($id)
    {
        try {
            if (!Auth::check()) {
                return response()->json(['success' => false, 'error' => 'لطفا وارد شوید'], 401);
            }

            $userId = Auth::id();

            // First try by cart ID
            $cartItem = Cart::where('id', $id)
                           ->where('userid', $userId)
                           ->first();

            if ($cartItem) {
                if ($cartItem->quantity > 1) {
                    $cartItem->quantity -= 1;
                    $cartItem->save();
                } else {
                    $cartItem->delete();
                }

                return response()->json([
                    'success' => true,
                    'quantity' => $cartItem->quantity ?? 0
                ]);
            }

            return response()->json(['success' => false, 'error' => 'Item not found in cart']);
        } catch (\Exception $e) {
            Log::error('Error removing from cart: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'خطا در حذف از سبد خرید',
                'debug' => $e->getMessage()
            ]);
        }
    }

    public function confirm_order(Request $request)
    {
        try {
            $request->validate([
                'address' => 'required|string|min:10'
            ], [
                'address.required' => 'لطفا آدرس خود را وارد کنید',
                'address.min' => 'آدرس باید حداقل ۱۰ کاراکتر باشد'
            ]);

            $user = Auth::user();
            $cartItems = Cart::where('userid', '=', Auth::id())->get();

            if($cartItems->isEmpty()) {
                return redirect()->back()->with('error', 'سبد خرید شما خالی است');
            }

            DB::beginTransaction();
            try {
                foreach($cartItems as $item) {
                    Order::create([
                        'name' => $user->name . ' ' . $user->lastname,
                        'email' => $user->email,
                        'phone' => $user->phone,
                        'address' => $request->address,
                        'title' => $item->title,
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                        'image' => str_starts_with($item->image, 'food_img/')
                            ? $item->image
                            : 'food_img/' . $item->image,
                        'status' => 'pending'
                    ]);
                }

                // Delete all cart items for this user after successful order
                Cart::where('userid', Auth::id())->delete();

                DB::commit();

                // Redirect to user orders page after successful order
                return redirect('/dash')->with('success', 'سفارش شما با موفقیت ثبت شد. می‌توانید وضعیت سفارش خود را در بخش سفارش‌های من مشاهده کنید.');
            } catch (\Exception $e) {
                DB::rollback();
                Log::error('Error in transaction: ' . $e->getMessage());
                throw $e;
            }
        } catch (\Exception $e) {
            Log::error('Error creating order: ' . $e->getMessage());
            return redirect()->back()->with('error', 'خطا در ثبت سفارش: ' . $e->getMessage());
        }
    }

    public function menu()
    {
        $menuItems = Food::all();
        // Group items by category
        $groupedItems = $menuItems->groupBy('category');
        return view('pages.menu', compact('groupedItems'));
    }


    public function storeConsultation(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'phone' => 'required|string',
                'details' => 'required|string'
            ]);

            Doctor::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'details' => $request->details
            ]);

            return redirect()->back()->with('success', 'درخواست شما با موفقیت ثبت شد دکتر در اسراع وقت با شما تماس حاصل میکند');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'خطا در ثبت درخواست');
        }
    }

    public function getCartItems()
    {
        try {
            if (!Auth::check()) {
                return response()->json(['success' => false, 'error' => 'لطفا وارد شوید'], 401);
            }

            $userId = Auth::id();

            // First get all cart items for this user
            $cartItems = Cart::where('userid', $userId)->get();

            // Then get all food items
            $foodItems = Food::all()->keyBy('title');

            // Map cart items to include food_id
            $mappedItems = $cartItems->map(function($cartItem) use ($foodItems) {
                if (isset($foodItems[$cartItem->title])) {
                    $cartItem->food_id = $foodItems[$cartItem->title]->id;
                    return $cartItem;
                }
                return null;
            })->filter()->values();

            return response()->json([
                'success' => true,
                'items' => $mappedItems
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching cart items: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'خطا در دریافت اطلاعات سبد خرید',
                'debug' => $e->getMessage()
            ], 500);
        }
    }

    public function getCoffeeCartItems()
    {
        try {
            if (!Auth::check()) {
                return response()->json(['success' => false, 'error' => 'لطفا وارد شوید'], 401);
            }

            $userId = Auth::id();

            // First get all cart items for this user
            $cartItems = Cart::where('userid', $userId)->get();

            // Then get all coffee items
            $coffeeItems = COFE::all()->keyBy('title');

            // Map cart items to include coffee_id
            $mappedItems = $cartItems->map(function($cartItem) use ($coffeeItems) {
                if (isset($coffeeItems[$cartItem->title])) {
                    $cartItem->coffee_id = $coffeeItems[$cartItem->title]->id;
                    return $cartItem;
                }
                return null;
            })->filter()->values();

            return response()->json([
                'success' => true,
                'items' => $mappedItems
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching coffee cart items: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'خطا در دریافت اطلاعات سبد خرید',
                'debug' => $e->getMessage()
            ], 500);
        }
    }

    public function removeCoffeeCart($id)
    {
        try {
            if (!Auth::check()) {
                return response()->json(['success' => false, 'error' => 'لطفا وارد شوید'], 401);
            }

            $userId = Auth::id();

            // Get the coffee item first
            $coffeeItem = COFE::find($id);
            if (!$coffeeItem) {
                return response()->json(['success' => false, 'error' => 'Item not found']);
            }

            // Find the cart item using the coffee title
            $cartItem = Cart::where('userid', $userId)
                           ->where('title', $coffeeItem->title)
                           ->first();

            if ($cartItem) {
                if ($cartItem->quantity > 1) {
                    $cartItem->quantity -= 1;
                    $cartItem->save();
                } else {
                    $cartItem->delete();
                }

                return response()->json([
                    'success' => true,
                    'quantity' => $cartItem->quantity ?? 0
                ]);
            }

            return response()->json(['success' => false, 'error' => 'Item not found in cart']);
        } catch (\Exception $e) {
            Log::error('Error removing coffee from cart: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'خطا در حذف از سبد خرید',
                'debug' => $e->getMessage()
            ]);
        }
    }

}
