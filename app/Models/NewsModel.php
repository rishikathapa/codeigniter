<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsModel extends Model
{
    protected $table      = 'news';
    protected $primaryKey = 'id';

    // सबै आवश्यक फिल्डहरू यहाँ राखिएको छ, 'views' थप्न नबिर्सिनुहोला
    protected $allowedFields = [
        'title', 
        'slug', 
        'body', 
        'category', 
        'author', 
        'status', 
        'image', 
        'views',      // यो ड्यासबोर्डमा भ्युज देखाउन अनिवार्य छ
        'created_at'
    ];

    // भ्यु काउन्ट, इमेज आदि सबैलाई एरेमा पठाउन यसले मद्दत गर्छ
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    public function getNews($slug = false)
    {
        if ($slug === false) {
            return $this->orderBy('id', 'DESC')->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }
}
