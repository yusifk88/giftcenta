<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveVirtualRequest;
use App\VirtualCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use phpbrowscap\Browscap;
use phpbrowscap\Exception;

class VirtualCardController extends Controller
{

    /**
     * @var \Illuminate\Config\Repository
     */
    private $key;
    /**
     * @var \Illuminate\Config\Repository
     */
    private $base_url;

    public function __construct()
    {
        $this->key = config('app.API_key');
        $this->base_url = config('app.BASE_URL');
    }


    public function store(SaveVirtualRequest $request){

        try {
            $card = new VirtualCard($request->all());
            $card->save();
            return response()->json($card);
           }catch (\Exception $exception){

            throw new Exception($exception->getMessage());
        }



    }


    public function makeCard(array $data){

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->base_url."/virtual-cards",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer ".$this->key
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response,true);

    }

    public function show($id){
        $card = VirtualCard::find($id);
        return response()->json($card);

    }


    public function buycard($id){

        $card = VirtualCard::find($id);
        if (!$card->created){
            $data['amount'] = $card->amount;
            $data['currency'] = $card->currency;
            $data['billing_name'] = $card->billing_name;
            $data['billing_address']='333 Freemont Road';
            $data['billing_city']='San Francisco';
            $data['billing_state']='CA';
            $data['billing_postal_code']='94105';
            $data['billing_country']='US';

            $newcard = VirtualCardController::mockCard();
            if ($newcard['status']==='success'){

                $card->created = 1;
                $card->number = $newcard['data']['card_pan'];
                $card->cvv = $newcard['data']['cvv'];
                $card->vendor_name = $newcard['data']['card_type'];
                $card->expiry_date = $newcard['data']['expiration'];
                $card->update();

                return redirect('/previewcard/'.$id);


            }

        }



    }


    public static function mockCard(){

        return  [
  "status" => "success",
  "message" => "Card created successfully",
  "data" => [
    "id" => "b4eeeaea-c639-4070-a2ef-a9876d2526c4",
    "account_id" => 123932,
    "amount" => "5.00",
    "currency" => "USD",
    "card_pan" => "4288030064088869",
    "masked_pan" => "428803*******8869",
    "city" => "San Francisco",
    "state" => "CA",
    "address_1" => "333 Fremont Street",
    "address_2" => null,
    "zip_code" => "94105",
    "cvv" => "175",
    "expiration" => "2024-12",
    "send_to" => null,
    "bin_check_name" => null,
    "card_type" => "visa",
    "name_on_card" => "Katulie Yusif",
    "created_at" => "2020-12-10T05:52:14.4770574+00:00",
    "is_active" => true,
    "callback_url" => null,
  ]
];


    }



}


