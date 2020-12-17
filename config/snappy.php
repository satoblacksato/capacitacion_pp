<?php

return array(


    'pdf' => array(
        'enabled' => true,
        'binary'  =>  'wkhtmltopdf',
        'timeout' => 3600,
        'options' => array(

            'page-size' => 'A4',
            'margin-top' => 5,
            'margin-right' => 5,
            'margin-left' => 5,
            'margin-bottom' => 10,
            'footer-center' => 'Page [page] of [toPage]',
            'footer-font-size' => 8,
            'footer-left' => 'SITIO',
            'footer-right'=>'[date] [time]'
        ),
        'env'     => array(),
    ),
    'image' => array(
        'enabled' => true,
        'binary'  =>  'wkhtmltoimage',
        'timeout' => 3600,
        'options' => array(),
        'env'     => array(),
    ),


);
