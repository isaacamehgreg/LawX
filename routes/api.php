<?php

use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Validator;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/client', function (Request $request) {

    //validate request
    $validated = $request->validate([
        'firstName' => 'required',
        'lastName'  => 'required',
        'email' => 'required',
        'dateProfiled' => 'required|date',
        'primaryLegalCounsel' => 'required',
        'dateOfBirth' => 'required',   
        'caseDetail' => 'required',
     ]);


     if(!$validated){
        return response()->json([
            'status'=>"failed",
            'message'=>'please check the details you provided'
          ],201);
     }


$data = $request->all();
$profileImage = null;

if($request->hasFile('profileImage')){
	$file = $request->file('profileImage');
	 $destinationPath = 'profile_images'; 
	 $extension = $file->getClientOriginalExtension();  
	 $fileName = rand(11111, 99999) . '.' . $extension;  
	 $upload_success = $file->move($destinationPath, $fileName); 

 if ($upload_success) {
	 $profileImage = $destinationPath.'/'.$fileName;
 }}




    // new client
    $client =new Client;
    $client->firstName = $request->input('firstName');
    $client->lastName = $request->input('lastName');
    $client->email = $request->input('email');
    $client->dateProfiled = $request->input('dateProfiled');
    $client->primaryLegalCounsel = $request->input('primaryLegalCounsel');
    $client->dateOfBirth = $request->input('dateOfBirth');
    $client->profileImage = $profileImage;
    $client->caseDetail = $request->input('caseDetail');
    $client->created_at = Carbon::now();
    $client->updated_at = Carbon::now();
    $client->save();

    // sendmail

    return response()->json([
      'status'=>"success",
      'message'=>'client created sucess fully'
    ],201);


});

Route::get('/client', function () {
  
   $clients = Client::all();
    return response()->json([
      'status'=>"success",
      'data'=>$clients, 
    ],200);

});

Route::get('/client/{id}', function ($id) {
  
    $client = Client::find($id);
     return response()->json([
       'status'=>"success",
       'data'=>$client, 
     ],200);
 
 });

 //lastname filter
 Route::get('/client/{query}', function ($query) {
  
    $client = Client::where('lastName', $query)->get();
     return response()->json([
       'status'=>"success",
       'data'=>$client, 
     ],200);
 
 });


