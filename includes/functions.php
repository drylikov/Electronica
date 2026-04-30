
<?php
function generateProductId($code, $rev, $mfg) {
    // Remove spaces, uppercase, and concatenate
    $code = strtoupper(preg_replace('/\s+/', '', $code));
    $rev = strtoupper($rev);
    $mfg = str_pad($mfg, 3, "0", STR_PAD_LEFT); // pad if less than 3 digits

    return substr($code, 0, 5) . substr($rev, 0, 2) . substr($mfg, -3);
}


function generateTestId($product_id) {
    $random = rand(100, 999); // Or increment logic
    return strtoupper($product_id) . '-T' . $random;
}

