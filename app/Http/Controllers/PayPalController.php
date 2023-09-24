<?php

namespace App\Http\Controllers;

use App\Http\Services\Cart\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
class PayPalController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }
    /**
     * create transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function createTransaction()
    {
        return redirect()->route('cart');
    }

    /**
     * process transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function processTransaction(Request $request){
        $totalPay = Session::get('payCart');
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successTransaction'),
                "cancel_url" => route('cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $totalPay,
                    ]

                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {

            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()->route('cart')
                ->with('error', 'Lỗi thanh toán, Vui lòng thử lại sau.');

        } else {
            return redirect()->route('cart')
                ->with('error', $response['message'] ?? 'Lỗi thanh toán, Vui lòng thử lại sau.');
        }
    }

    /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function successTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        $this->cartService->addCartPaypal($request);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return redirect()->route('buyCart')
                ->with('success', 'Thanh toán thành công! Cảm ơn bạn đã mua hàng.');
        } else {
            return redirect()->route('cart')
                ->with('error', $response['message'] ?? 'Lỗi thanh toán, Vui lòng thử lại sau.');
        }
    }

    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransaction(Request $request)
    {
        return redirect()->route('cart')
            ->with('error', $response['message'] ?? 'Bạn đã hủy giao dịch');
    }
}
