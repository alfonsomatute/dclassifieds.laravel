<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Mail;

class ContactController extends Controller
{
    /**
     * Show site contact form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //set page title
        $title = [config('dc.site_domain')];
        $title[] = trans('contact.Contact Us Page Title');

        return view('contact.contact', ['title' => $title]);
    }

    /**
     * If contact form submitted, validate and send mail to site owner
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Foundation\Validation\ValidationException
     */
    public function postContact(Request $request)
    {
        //validate form
        $rules = [
            'contact_name'      => 'required|string|max:255',
            'contact_mail'      => 'required|email|max:255',
            'contact_message'   => 'required|min:' . config('dc.site_contact_min_words')
        ];

        if(config('dc.enable_recaptcha_site_contact')){
            $rules['g-recaptcha-response'] = 'required|recaptcha';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        //send activation mail
        Mail::send('emails.contact', ['params' => $request->all()], function ($m) {
            $m->from(config('dc.site_contact_mail'), config('dc.site_domain'));
            $m->to(config('dc.site_contact_mail'))->subject(trans('contact.New Contact Us Request'));
        });

        session()->flash('message', trans('contact.Your message was send.'));
        return redirect(route('info'));
    }
}