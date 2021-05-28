<?php

namespace Controller;

use Core\Controller;
use Helper\FormBuilder;
use Core\Request;
use Model\Contact as ContactModel;

class Contact extends Controller
{
    public function index()
    {
        $form = new FormBuilder('post', '/contact/submit');
        if(!$this->isLogedIn()){
            $form->input('email', 'email','','Contact Email');
        }
        $form->texarea('message');
        $form->input('submit', 'submit','Send');
        $this->data['form'] = $form->get();
        $this->render('contact/form', $this->data);
    }

    public function submit()
    {
        $request = new Request();
        if($this->isLogedIn()){
            $user = $this->userSession->getAuthUser();
            $email = $user->getEmail();
        }else{
            $email = $request->getPost('email');
        }
        $message = $request->getPost('message');
        $contact = new ContactModel();
        $contact->setEmail($email);
        $contact->setMeesage($message);
        $contact->save();
        mail('admin@mars.lt','contact from'.$email, $message);


    }
}