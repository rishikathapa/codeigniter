<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// १. होमपेज (Front-end)
$routes->get('/', 'Home::index');

// २. सार्वजनिक समाचार सेक्सन (Public News Section)
$routes->get('news', 'News::index');

/** * पर्मालिङ्क परिवर्तन: (:segment) को सट्टा (:num) प्रयोग गरिएको छ 
 * यसले युआरएलमा नेपाली फन्टको साटो 'ID' (अंक) मात्र देखाउँछ।
 * उदाहरण: nepalnewsexpressdaily.com/news/123
 */
$routes->get('news/(:num)', 'News::view/$1'); 

// ३. एडमिन ड्यासबोर्ड (Admin Dashboard - Muskan@2084 Password Required)
$routes->get('admin/dashboard', 'News::admin');

// ४. समाचार थप्ने प्रक्रिया (Create & Store)
$routes->get('news/create', 'News::create');
$routes->post('news/store', 'News::store');

// ५. समाचार सम्पादन प्रक्रिया (Edit & Update)
$routes->get('news/edit/(:num)', 'News::edit/$1');
$routes->post('news/update/(:num)', 'News::update/$1');

// ६. समाचार हटाउने प्रक्रिया (Delete)
$routes->get('news/delete/(:num)', 'News::delete/$1');
