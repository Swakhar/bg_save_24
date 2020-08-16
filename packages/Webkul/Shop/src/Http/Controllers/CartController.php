<?php

namespace Webkul\Shop\Http\Controllers;

use Webkul\Customer\Repositories\WishlistRepository;
use Webkul\Checkout\Repositories\CartRepository;
use Webkul\Checkout\Repositories\CartItemRepository;
use Webkul\Product\Repositories\ProductRepository;
use Webkul\Product\Repositories\ProductFlatRepository;
use Webkul\Checkout\Contracts\Cart as CartModel;
use Illuminate\Support\Facades\Event;
use Webkul\Velocity\Helpers\Helper;
use Cart;

class CartController extends Controller
{
    /**
     * WishlistRepository Repository object
     *
     * @var \Webkul\Customer\Repositories\WishlistRepository
     */
    protected $wishlistRepository;

    /**
     * ProductRepository object
     *
     * @var \Webkul\Product\Repositories\ProductRepository
     */
    protected $productRepository;
    protected $productFlatRepository;
    protected $cartItemRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Customer\Repositories\CartItemRepository  $wishlistRepository
     * @param  \Webkul\Product\Repositories\ProductRepository  $productRepository
     * @return void
     */
    public function __construct(
        WishlistRepository $wishlistRepository,
        ProductRepository $productRepository,
        ProductFlatRepository $productFlatRepository,
        CartItemRepository $cartItemRepository
    )
    {
        $this->middleware('customer')->only(['moveToWishlist']);

        $this->wishlistRepository = $wishlistRepository;

        $this->productRepository = $productRepository;
        $this->productFlatRepository = $productFlatRepository;
        $this->cartItemRepository = $cartItemRepository;

        parent::__construct();
    }

    /**
     * Method to populate the cart page which will be populated before the checkout process.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        Cart::collectTotals();

        return view($this->_config['view'])->with('cart', Cart::getCart());
    }

    /**
     * Function for guests user to add the product in the cart.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function add($id)
    {
        $data=request()->all();
        $pro = $this->productFlatRepository->findOrFail($id);

        if($pro->min_qty ){
            $min=$pro->min_qty;
            $data['quantity']=$min;
        }
        try {
            $result = Cart::addProduct($id,$data);

            if ($this->onWarningAddingToCart($result)) {
                session()->flash('warning', $result['warning']);

                return redirect()->back();
            }

            if ($result instanceof CartModel) {
                session()->flash('success', trans('shop::app.checkout.cart.item.success'));

                if ($customer = auth()->guard('customer')->user()) {
                    $this->wishlistRepository->deleteWhere(['product_id' => $id, 'customer_id' => $customer->id]);
                }

                if (request()->get('is_buy_now')) {
                    Event::dispatch('shop.item.buy-now', $id);

                    return redirect()->route('shop.checkout.onepage.index');
                }
            }
        } catch(\Exception $e) {
            session()->flash('error', trans($e->getMessage()));

            $product = $this->productRepository->find($id);

            return redirect()->route('shop.productOrCategory.index', $product->url_key);
        }

        return redirect()->back();
    }

    /**
     * Removes the item from the cart if it exists
     *
     * @param  int  $itemId
     * @return \Illuminate\Http\Response
     */
    public function remove($itemId)
    {
        $result = Cart::removeItem($itemId);

        if ($result) {
            session()->flash('success', trans('shop::app.checkout.cart.item.success-remove'));
        }

        return redirect()->back();
    }

    /**
     * Updates the quantity of the items present in the cart.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateBeforeCheckout()
    {
        $data=request()->all();
        $item = $this->cartItemRepository->findOneByField('id', $data['product_id']);
        $pro = $this->productFlatRepository->findOrFail($item->product_id);

        if($pro->min_qty>$data['quantity']){
            return $response = [
                'status'  => 'min_warn',
                'quantity'  => $data['quantity'],
                'message' => trans('Minimum quantity must be '.$pro->min_qty),
            ];
        }

        try {
            if($pro->max_qty !=null){
                if($pro->max_qty<$data['quantity']){
                    return $response = [
                        'status'  => 'max_warn',
                        'quantity'  => $data['quantity'],
                        'message' => trans('Maximum quantity must be under '.$pro->max_qty),
                    ];
                }if ($cart instanceof CartModel) {
                    $response = [
                        'status'         => 'success',
                        'totalCartItems' => sizeof($cart->items),
                        'message'        => trans('Item quantity updated successfully!'),
                    ];
                }
            }
        } catch(\Exception $exception) {
            $response = [
                'status'           => 'danger',
                'message'          => trans($exception->getMessage()),
            ];
        }

        return $response ?? [
            'status'  => 'danger',
            'message' => trans('Something wrong!'),
        ];
    }

    /**
     * Function to move a already added product to wishlist will run only on customer authentication.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function moveToWishlist($id)
    {
        $result = Cart::moveToWishlist($id);

        if ($result) {
            session()->flash('success', trans('shop::app.checkout.cart.move-to-wishlist-success'));
        } else {
            session()->flash('warning', trans('shop::app.checkout.cart.move-to-wishlist-error'));
        }

        return redirect()->back();
    }

    /**
     * Apply coupon to the cart
     *
     * @return \Illuminate\Http\Response
    */
    public function applyCoupon()
    {
        $couponCode = request()->get('code');

        try {
            if (strlen($couponCode)) {
                Cart::setCouponCode($couponCode)->collectTotals();

                if (Cart::getCart()->coupon_code == $couponCode) {
                    return response()->json([
                        'success' => true,
                        'message' => trans('shop::app.checkout.total.success-coupon'),
                    ]);
                }
            }

            return response()->json([
                'success' => false,
                'message' => trans('shop::app.checkout.total.invalid-coupon'),
            ]);
        } catch (\Exception $e) {
            report($e);

            return response()->json([
                'success' => false,
                'message' => trans('shop::app.checkout.total.coupon-apply-issue'),
            ]);
        }
    }

    /**
     * Apply coupon to the cart
     *
     * @return \Illuminate\Http\Response
    */
    public function removeCoupon()
    {
        Cart::removeCouponCode()->collectTotals();

        return response()->json([
            'success' => true,
            'message' => trans('shop::app.checkout.total.remove-coupon'),
        ]);
    }

    /**
     * Returns true, if result of adding product to cart is an array and contains a key "warning"
     *
     * @param  array  $result
     * @return boolean
     */
    private function onWarningAddingToCart($result): bool
    {
        return is_array($result) && isset($result['warning']);
    }
}
