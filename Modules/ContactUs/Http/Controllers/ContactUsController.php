<?php

namespace Modules\ContactUs\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Notification;

use Modules\ContactUs\Entities\Contacts ;
use Modules\ContactUs\Entities\ContactPages ;
use Modules\ContactUs\Entities\ContactSubject ;

// Contact Events 
use Modules\ContactUs\Events\ContactForm;
use Modules\ContactUs\Notifications\NotifyContactForm;


class ContactUsController extends Controller
{

    /**
     * Function : Get Contact Us Info
     * Dev : Joe
     * Update Date : 18 Nov 2021
     * @param POST
     * @return response of contact us info
    */
    public function getContactInfo(){

        $data = [];
        $contact = ContactPages::find(1);
        if(!empty($contact)){

            if(app()->getLocale() == '' || app()->getLocale() == 'th'){
                $data['description'] = mwz_getTextString($contact->description_th);
                $data['head_office'] = $contact->head_office_th;
                $data['factory'] = $contact->factory_th;
            }else{
                $data['description'] = mwz_getTextString($contact->description_en);
                $data['head_office'] = $contact->head_office_en;
                $data['factory'] = $contact->factory_en;
            }

            $data['facebook_url'] = $contact->facebook_url;
            $data['line_url'] = $contact->line_url;
            $data['twitter_url'] = $contact->twitter_url;
            $data['instagram_url'] = $contact->instagram_url;

            $data['phone_head_office'] = $contact->phone_head_office;
            $data['phone_factory'] = $contact->phone_factory;
            $data['email_head_office'] = $contact->email_head_office;
            $data['email_factory'] = $contact->email_factory;

            $data['google_map'] = $contact->gmaps;
            
        }

        return $data;

    }

     /**
     * Function : Get Contact Us Subject
     * Dev : Joe
     * Update Date : 18 Nov 2021
     * @param POST
     * @return response of contact us info
    */
    public function getContactSubjects(){
        $lang = app()->getLocale() ;
        $subjects_data = ContactSubject::where('status', 1)->get()->toArray();
        $subjects = []; 
        if(!empty($subjects_data)){
            foreach($subjects_data as $sbj){
                $subjects[] = ['id'=>$sbj['id'],'subject'=>$sbj["subject_$lang"]] ;
            }
        }
        return $subjects ;
    }


    /**
    * Function :  send contact
    * Dev : Tong
    * Update Date : 5 Dec 2022
    * @param POST
    * @return json response status
    */
    public function send_contactus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'integer',
            'name' => 'required|max:500',
            'email' => 'required|max:500',
            'phone' => 'required|max:10',
            'message' => 'required',
        ]);

        if ($validator->fails()){
            $errors = $validator->errors();
            $resp = ['success'=>0,'code'=>0,'msg'=>'error','error'=>$errors] ;
            return response()->json($resp);
        }

        if( !empty($request->get('subject_id')) ){
            $contact_subject = ContactSubject::find($request->get('subject_id'));
        }else{
            $contact_subject = ContactSubject::where('status',1)->orderby('sequence','asc')->first();
            $contact_subject->subject = $request->get('subject') ;
        }
      
        if(!empty($contact_subject->id)){
            $attributes = [
                "subject_id"=> $contact_subject->id,
                "subject"=> $contact_subject->subject,
                "name"=>$request->get('name'),
                "email"=>$request->get('email'),
                "phone"=>$request->get('phone'),
                "message"=>$request->get('message'),
            ];

            $contact = Contacts::create($attributes);

            $attributes['to_email'] = $contact_subject->to_email;
            $attributes['cc_email'] = $contact_subject->cc_email;

            Notification::route('mail', $attributes['to_email'])
                        ->notify(new NotifyContactForm($attributes));
            
            $resp = ['success'=>1,'code'=>200,'msg'=>'send competet'];
        }

        return response()->json($resp);
    }

}