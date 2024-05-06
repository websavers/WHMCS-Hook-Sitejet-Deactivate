<?php

use WHMCS\View\Menu\Item as MenuItem;

// Hide in Client Area Sidebar
add_hook('ClientAreaPage', 1, function($vars) {
    $primarySidebar = Menu::primarySidebar();
    if ($primarySidebar) {
        $serviceActions = $primarySidebar->getChild('Service Details Actions');
        if ($serviceActions) {
            $serviceActions->removeChild('sitejet');
        }
    }
}); 

// Hide from Client area
add_hook('ClientAreaFooterOutput', 1, function($vars) {
    return <<<STYLE
    <style>
        #sitejetPromoPanel{ display: none !important; }
        button[data-identifier="sitejet"],
        li[data-identifier="sitejet"]{ display:none !important; }
        button[data-identifier="sitejet"] + .btn-group > .btn[data-toggle="dropdown"]{
        border-top-left-radius: 3.2px;
        border-bottom-left-radius: 3.2px;
        }
        button[data-identifier=“sitejet”] + .btn-group > .btn[data-toggle=“dropdown”],
        .btn-group:has(> button[data-identifier=“sitejet”]) > .btn[data-toggle=“dropdown”] {
        display: none !important;
        }
    </style>
    STYLE;
});

// Hide from Admin area
add_hook('AdminAreaFooterOutput', 10000, function($vars) {
    return <<<SCRIPT
    <script>
    jQuery(document).ready(function($){
        $('.context-btn-container .btn-group button').each( function(){
            if ( typeof $(this).attr('onclick') !== 'undefined' && $(this).attr('onclick').includes("SitejetSingleSignOn") ){
                $(this).hide();
            }
        });
    });
    </script>
    SCRIPT;
});

