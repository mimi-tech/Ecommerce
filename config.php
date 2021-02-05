<?php
define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/chilee/');
define('CART_COOKIE','SBwi72Ucklwiqzz2');
define('CART_COOKIE_EXPIRE',time()+ (86400 * 30));
define('TAXRATE',0);

define('CURRENCY','NGN');
define('CHECKOUTMODE', 'TEST');

if(CHECKOUTMODE == 'TEST'){
    define('PAYSTACK_PUBLIC_KEY', '');
    define('PAYSTACK_PRIVATE_KEY', '');
}

if(CHECKOUTMODE == 'LIVE'){
    define('PAYSTACK_PUBLIC_KEY', '');
    define('PAYSTACK_PRIVATE_KEY', '');
}