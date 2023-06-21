<?php

namespace App\Http\Controllers\API;

use App\Models\Lead;
use App\Mail\NewLead;
use App\Http\Controllers\Controller;
use App\Mail\NewLeadMarkdown;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function store(Request $request)
    {

        $data = $request->all();

        //validate the request fields

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);
        //check if validation fails and returns the validation error messages
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ]);
        }
            //save the lead into the db

            $newLead = new Lead();
            $newLead->fill($data);
            $newLead->save();

            //send the mailable

            //Mail::to('lucaruboni@gmail.com')->send(new NewLead($newLead));

            //send markdown mailable
            Mail::to('lucaruboni@gmail.com')->send(new NewLeadMarkdown($newLead));

            return response()->json([
                'success' => true
            ]);
       

    }
}
