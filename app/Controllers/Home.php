<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        // हेडरको लागि आवश्यक डाटा
        $data = [
            'title' => 'स्वागत छ'
        ];

        // हेडर, होमपेज (welcome_message) र फुटरलाई जोडेर रिटर्न गर्ने
        return view('templates/header', $data)
             . view('welcome_message')
             . view('templates/footer');
    }
}
