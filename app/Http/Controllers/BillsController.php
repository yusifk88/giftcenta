<?php

namespace App\Http\Controllers;

use App\Airtime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Stmt\DeclareDeclare;

class BillsController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->base_url."/bill-categories?country=GH",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer ".$this->key,
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
         $bills = json_decode($response,true);
         if ($bills['status']=='success'){
             return  response()->json($bills['data']);

         }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Airtime::find($id);
        return response()->json($item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function home(){
        return view('welcome');

    }

    public function varify(Request $request){

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->base_url."/bill-items/".$request->item_code."/validate?code=".$request->code.'&customer='.$request->customer,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer ".$this->key
            ),
        ));

        $response = curl_exec($curl);
        dd(json_decode($response,true));

    }


    public function buyairtime(Request $request){

      $airtime = new Airtime(
          [
              'phone_number'=>$request->customer,
              'country'=>$request->country,
              'network'=>$request->type,
              'amount'=>$request->amount,
              'recipient_email'=>$request->recipient_email,
              'sender_email'=>$request->sender_email,
              'sender_name'=>$request->sender_name,
              'message'=>$request->message
          ]
      );
      $airtime->save();

      if ($airtime){
          return response()->json($airtime);
      }else{
          return response('Error: Could not create airtime payment',302);
      }


    }



    public function payairtime($id){

        $curl = curl_init();
        //$data = $request->all();


            $airtime = Airtime::find($id);
        if (!$airtime->paid){

        $data['reference']=Carbon::now()->timestamp;
        $data['customer']=$airtime->phone_number;
        $data['country']=$airtime->country;
        $data['biller_name']=$airtime->network;
        $data['amount']=$airtime->amount;
        $data['type']=$airtime->network;
        $data['recurrence']='ONCE';



        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->base_url."/bills",
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
        $results = json_decode($response,true);

        if ($results['status'] === 'success'){
            $airtime->update([
                'paid'=>1
            ]);

            Mail::to($airtime->recipient_email)->send(new \App\Mail\airtime($airtime));
            if ($airtime->sender_email){
            Mail::to($airtime->sender_email)->send(new \App\Mail\airtimesent($airtime));
            }
            return redirect()->to('/airtimecomplete/'.$id);

        }else{
            return response('Error: '.$results['message'],302);
        }
        }else{

            return redirect()->to('/airtimecomplete/'.$id);
        }


    }



    public function mail(){

        $item = Airtime::find(5);

        return new \App\Mail\airtime($item);

    }


}
