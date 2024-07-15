<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = 'welcome';
$route['tag/(:any)'] = 'Businessideas/tag/$2';
$route['jobs'] = 'jobs';
$route['jobs/type/(:any)'] = 'jobs/type/$1';

$route['(?!admin)(?!businessideas)(?!Coins)(?!Outsource)(?!outsource)(?!gain)(?!Gain)(?!User)(?!franchise)(?!Entrepreneur)(?!entrepreneur)(?!earn)(?!Earn)(?!Investor)(?!investor)(?!Jobs)(?!jobs)(?!Ownbusiness)(?!ownbusiness)(?!Dashboard)(?!dashboard)(?!skill)(?!jobs)(?!contact)(?!proposals)(?!coins)(?!payment)(?!search)(?!ideazone)(?!Sitemap)(?!paypal)(?!learn)(:any)'] = 'Welcome/page/$1';
$route['businessideas/(:num)'] = 'businessideas';

$route['businessideas/(?!postidea)(?!ideadetails)(?!submitpost)(?!savecomments)(?!commentsadd)(?!commentLike)(?!reportIdea)(?!impressidea)(?!Sitemap)(?!savedideas)(?!postIniateIdea)(?!initiateIdeas)(?!investideas)(?!postiniateidea)(?!initiateideas)(?!postinvestidea)(:any)'] = 'Businessideas/industry/$2';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;
