<?php

namespace App\Http\Controllers;

use App\Models\Image;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Cart;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Auth;
use PDF;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{

    // public function showMessages()
    // {
    //     $messages = ContactMessage::all(); // Get all contact messages
    //     return view('admin.messages', compact('messages'));
    // }
    public function ViewCategory()
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {

                $categories = Category::all();
                return view('admin.category', compact('categories'));
                
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }

    public function AddCategory(Request $request)
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {

                $data = new Category();
                $data->category_name = $request->category;
                $data->save();
                return redirect()->back()->with('message', 'Category Added Successfully');
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }

    }

    public function DeleteCategory($id)
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {

                $category = Category::find($id);
                $category->delete();
                return redirect()->back();

            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }

    }

    public function AddProduct(Request $request)
    {

        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {
                // Validate the request
                $request->validate([
                    'title' => 'required|string|max:255',
                    'category' => 'required|string|max:255',
                    'material' => 'required|string|max:255',
                    'size' => 'required|string|max:255',
                    'color' => 'required|string|max:255',
                    'design_type' => 'required|string|max:255',
                    'price' => 'required|numeric|min:0',
                    'discount_price' => 'nullable|numeric|min:0',
                    'quantity' => 'required|integer|min:1',
                    // 'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                ]);
    
                // Create and save the product
                $product = new Product();
                $product->title = $request->title;
                $product->category = $request->category;
                $product->material = $request->material;
                $product->size = $request->size;
                $product->color = $request->color;
                $product->design_type = $request->design_type;
                $product->price = $request->price;
                $product->discount_price = $request->discount_price;
                $product->quantity = $request->quantity;
                $product->save();
    
                // Handle multiple image uploads
               if ($request->images) {
            foreach ($request->images as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move('products_images', $imageName);
               
                // // Save the image in the images table
                Image::create([
                    'product_id' => $product->id,
                    'image_url' => $imageName, // Store the relative path
                ]);
            }

        }
    
                Alert::success('Product Added Successfully!', 'You have added a new product');
                return redirect()->route('admin.show_product');
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }
    



    public function ViewProduct()
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {

                $categories = Category::all();
                return view('admin.add_product', compact('categories'));
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }

    }

    public function ShowProduct()
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {

                // $products = Product::orderBy('id', 'desc')->get();
                $products = Product::with('images')->orderBy('id', 'desc')->get();
                // return $products;
                return view('admin.show_product', compact('products'));

            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
        
    }

    public function DeleteProduct($id)
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {

                $product = Product::find($id);
                $product->delete();
                return redirect()->back()->with('message', 'The Product has been deleted successfully');

            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
        
    }

    public function EditProduct($id)
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {

                $product = Product::find($id);
                $categories = Category::all();
                return view('admin.edit_product', compact('product'));

            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    
    }

    public function UpdateProduct(Request $request, $id)
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {

                $product = Product::find($id);
                $product->title = $request->title;
                $product->category = $request->category;
                $product->material = $request->material;
                $product->size = $request->size;
                $product->color = $request->color;


                $product->design_type = $request->design_type;
                $product->price = $request->price;
                $product->discount_price = $request->discount_price;
                $product->quantity = $request->quantity;




               
              
                

                if ($request->hasFile('image')) {
                    $image = $request->image;
                    @unlink(public_path('products_images/' . $image->image_url));
                    $imageName = time() . '.' . $image->getClientOriginalExtension();
                    $request->image->move('products_images', $imageName);
                    $image->image_url = $imageName;
                } else {
                    $image->image_url = $image->image_url;
                }
                $product->save();

                Alert::success('Successfully Updated', 'The product has been successfully updated!');
                return redirect()->route('admin.show_product');

            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
        
    }

    public function UserOrders()
    {
        if(Auth::check()){
            $userType = Auth::user()->usertype;
            if($userType == 1){

                $orders = Order::where('delivery_status', '!=', 'passive_order')->get();
                return view('admin.orders', compact('orders'));

            }else{
                return redirect('login');
            }
        }else{
            return redirect('login');
        }
    }

    public function UpdateOrder($user_id, $order_id,$delivery_status)
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {

                $order = Order::where('user_id', $user_id)->where('id', $order_id)->first();
                
                if($order){
                    // the order was found, update the delivery status
                    if($delivery_status == 'cancel_order'){
                        $product = Product::find($order->product_id);
                        if ($product) {
                            // Update the quantity of the product in the products table
                            $product->quantity += $order->quantity;
                            $product->save();

                            // Remove the product from the cart
                            $order->delete();

                            return redirect()->back();
                        } else {
                            return redirect()->back()->with('error', 'Product not found!');
                        }
                    }else{
                        $order->delivery_status = $delivery_status;
                        $order->save();
                        return redirect()->back();
                    }
                }else{
                    return redirect()->back();
                }
                
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }

    public function PrintBill($order_id)
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {

                $order = Order::where('id', $order_id)->first();

                if ($order) {
                    
                    $pdf = PDF::loadView('admin.user_bill', compact('order'));
                    return $pdf->download('order_bill'.$order->id.'.pdf');

                } else {
                    return redirect()->back();
                }

            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }

    public function SearchProduct(Request $request)
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {

                $searchText = $request->search;
                $products  = Product::where('title','LIKE',"%$searchText%")->orWhere('ram', 'LIKE', "%$searchText%")->orWhere('category', 'LIKE', "%$searchText%")->get();
                return view('admin.show_product', compact('products'));
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }

    public function SearchOrder(Request $request)
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {

                $searchText = $request->search;
                $orders  = Order::where('tracking_id', 'LIKE', "%$searchText%")->where('delivery_status', '!=', 'passive_order')->get();
                return view('admin.orders', compact('orders'));
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }

    public function Customers()
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {

                $users = User::where('userType','=',0)->get();
                return view('admin.customers',compact('users'));

            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }

    public function DeleteUser($id)
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {

                User::where('id','=',$id)->delete();
                Cart::where('user_id','=',$id)->delete();
                Order::where('user_id','=',$id)->delete();

                return redirect()->back();

            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }

    public function SearchUser(Request $request)
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {

                $searchText = $request->search;
                $users  = User::where('name', 'LIKE', "%$searchText%")->orWhere('email', 'LIKE', "%$searchText%")->get();
                return view('admin.customers', compact('users'));
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }
}
