<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Jobs\ContactUsJob;
use App\Mail\ContactUs;
use App\Mail\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\IpUtils;

class ContactController extends Controller
{

    public function show(){
        return view('contact');
    }

    public function sendEnquiry(ContactRequest $contactRequest){

        $recaptcha_response = $contactRequest->input('g-recaptcha-response');

        if (is_null($recaptcha_response)) {
            return redirect()->back()->with('recaptcha', __('Please Complete the Recaptcha to proceed'));
        }

        $url = "https://www.google.com/recaptcha/api/siteverify";

        $body = [
            'secret' => config('services.recaptcha.secret'),
            'response' => $recaptcha_response,
            'remoteip' => IpUtils::anonymize($contactRequest->ip()) //anonymize the ip to be GDPR compliant. Otherwise just pass the default ip address
        ];

        $response = Http::asForm()->post($url, $body);
        $result = json_decode($response);

        if ($response->successful() && $result->success == true) {
            $data = $contactRequest->validated();
            ContactUsJob::dispatch($data)->delay(now()->addMinutes(5));
            return redirect()->back()->with('contact_send', __('Your message has been sent successfully...'));

        } else {

            return redirect()->back()->with('status', __('Please Complete the Recaptcha Again to proceed'));
        }

    }
}
