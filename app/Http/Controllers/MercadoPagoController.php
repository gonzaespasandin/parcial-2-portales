<?php

namespace App\Http\Controllers;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MercadoPagoController extends Controller
{
    public function createPreference()
    {
        try {
            $cart = session()->get('cart', []);

            if(empty($cart)){
                return redirect()->route('home')
                    ->with('feedback.message', 'No hay productos en el carrito')
                    ->with('feedback.type', 'danger');
            }
    
            $productsIds = array_keys($cart);
    
            $products = Products::whereIn('id', $productsIds)->get();
    
            $items = [];
            $total = 0;
    
            foreach($products as $product){
                $quantity = $cart[$product->id]['quantity'];
                $subtotal = $product->price * $quantity;
                $total += $subtotal;
                $items[] = [
                    'title' => $product->title,
                    'quantity' => $quantity,
                    'unit_price' => floatval($product->price),
                    'currency_id' => 'ARS',
                ];
            }
    
            MercadoPagoConfig::setAccessToken(config('mercadopago.access_token'));
    
            $preferenceFactory = new PreferenceClient();
            $preference = $preferenceFactory->create([
                'items' => $items,
                'back_urls' => [
                    'success' => 'https://6db8c2ec7f15.ngrok-free.app/mercadopago/success',
                    'failure' => route('mercadopago.failure'),
                    'pending' => route('mercadopago.pending'),
                ],
                'auto_return' => 'approved',
            ]);
    
            return view('mercadopago.index', [
                'preference' => $preference,
                'MPPublicKey' => config('mercadopago.public_key'),
            ]);

        } catch (\MercadoPago\Exceptions\MPApiException $e) {
            return redirect()->route('cart.index')
                ->with('feedback.message', 'Error al procesar el pago')
                ->with('feedback.type', 'danger');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function verifyPayment(Request $request)
    {
        Log::info('---------------------------------------------------');

        $receivedSignature = $request->header('x-signature');
        $receiverRequestId = $request->header('x-request-id');
        $data = $request->input();

        $signatureParts = explode(',', $receivedSignature);

        $signatureTS = explode('=', $signatureParts[0])[1];
        $signatureKey = explode('=', $signatureParts[1])[1];

        $validationKey = "id:$data[id];request-id:$receiverRequestId;ts:$signatureTS;";

        $hashedKey = hash_hmac('sha256', $validationKey, config('mercadopago.secret_key'));
        
        Log::info('Request ID: ' . $receiverRequestId);
        Log::info('Signature: ' . $receivedSignature);
        Log::info('Signature TS: ' . $signatureTS);
        Log::info('Signature Key: ' . $signatureKey);
        Log::info('Validation Key: ' . $validationKey);
        Log::info('Datos del pago con Mercado pago: ' . json_encode($data));

        if($hashedKey === $signatureKey){
            Log::info('Pago válido');
        } else {
            Log::info('Firma inválida');
        }

        Log::info('---------------------------------------------------');
    }


    public function success(Request $request)
    {
        $data = $request->input();
        Log::info('---------------------------------------------------');
        Log::info('Datos del pago con Mercado pago: ' . json_encode($data));
        Log::info('---------------------------------------------------');

        session()->forget('cart');
        
        return view('mercadopago.success');
    }

    public function failure()
    {
        return view('mercadopago.failure');
    }

    public function pending()
    {
        return view('mercadopago.pending');
    }
}
