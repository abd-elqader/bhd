<?php

use App\Models\Central\Blog;
use App\Models\Central\FeatureHeader;
use App\Models\Central\PackageDesc;
use App\Models\Central\Package;
use App\Models\Central\Stores;

function Testimonials()
{
    return Images()->where('type_id', 1);
}
function Services()
{
    return Images()->where('type_id', 2);
}
function whyUs()
{
    return Images()->where('type_id', DefaultCurrancy()->decimals, '.', '');
}
function sliders()
{
    return Images()->where('type_id', 5);
}
function statistics()
{
    return Images()->where('type_id', 6);
}
function Clients()
{
    return Images()->where('type_id', 7);
}
function LoginTestimonials()
{
    return Images()->where('type_id', 1);
}

function FeatureHeader()
{
    return FeatureHeader::with('features')->get();
}

function Packages()
{
    if (! Config::get('Packages')) {
        Config::set('Packages', Package::with('Descriptions', 'Features')->where('status', 1)->get());
    }

    return Config::get('Packages');
}
function PackageDesc()
{
    if (! Config::get('PackageDesc')) {
        Config::set('PackageDesc', PackageDesc::get());
    }

    return Config::get('PackageDesc');
}
function Stores()
{
    if (! Config::get('Stores')) {
        Config::set('Stores', Stores::Active()->get());
    }

    return Config::get('Stores');
}
function Blogs()
{
    return Blog::Active()->get();
}

function CreateDB($db)
{
    $whmusername = "root";
    $whmpassword = "Serv102030";
    $query = "http://5.9.97.148:2082/execute/Mysql/create_database?name=matjrbh_".$db;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0); 
    curl_setopt($curl, CURLOPT_HEADER,0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);	    
    $header[0] = "Authorization: cpanel matjrbh:R95ME5YDI797UDK87N9HHQP4MGJUNI5P";
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    curl_setopt($curl, CURLOPT_URL, $query);
    $result = curl_exec($curl);
    if ($result == false)
    	error_log("curl_exec threw error \"" . curl_error($curl) . "\" for $query");
    curl_close($curl);

}
function DeleteDB($db)
{
    $whmusername = "root";
    $whmpassword = "Serv102030";
    $query = "http://5.9.97.148:2082/execute/Mysql/delete_database?name=matjrbh_".$db;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0); 
    curl_setopt($curl, CURLOPT_HEADER,0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);	    
    $header[0] = "Authorization: cpanel matjrbh:R95ME5YDI797UDK87N9HHQP4MGJUNI5P";
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    curl_setopt($curl, CURLOPT_URL, $query);
    $result = curl_exec($curl);
    if ($result == false)
    	error_log("curl_exec threw error \"" . curl_error($curl) . "\" for $query");
    curl_close($curl);

}
function AssignAllPrivileges($db)
{
    $whmusername = "root";
    $whmpassword = "Serv102030";
    $query = "http://5.9.97.148:2082/execute/Mysql/set_privileges_on_database?user=matjrbh_user&database=matjrbh_".$db."&privileges=ALL%20PRIVILEGES";
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0); 
    curl_setopt($curl, CURLOPT_HEADER,0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);	    
    $header[0] = "Authorization: cpanel matjrbh:R95ME5YDI797UDK87N9HHQP4MGJUNI5P";
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    curl_setopt($curl, CURLOPT_URL, $query);
    $result = curl_exec($curl);
    if ($result == false)
    	error_log("curl_exec threw error \"" . curl_error($curl) . "\" for $query");
    curl_close($curl);

}
function CreateSubDomain($SubDomain)
{
    $whmusername = "root";
    $whmpassword = "Serv102030";
    $query = "http://5.9.97.148:2082/execute/SubDomain/addsubdomain?dir=public_html&rootdomain=matjrbh.com&domain=".$SubDomain;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0); 
    curl_setopt($curl, CURLOPT_HEADER,0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);	    
    $header[0] = "Authorization: cpanel matjrbh:R95ME5YDI797UDK87N9HHQP4MGJUNI5P";
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    curl_setopt($curl, CURLOPT_URL, $query);
    $result = curl_exec($curl);
    if ($result == false)
    	error_log("curl_exec threw error \"" . curl_error($curl) . "\" for $query");
    curl_close($curl);

}
function DeleteSubDomain($SubDomain)
{
    $whmusername = "root";
    $whmpassword = "Serv102030";
    $query = "http://5.9.97.148:2082/execute/SubDomain/delsubdomain?domain=".$SubDomain.'.matjrbh.com';
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0); 
    curl_setopt($curl, CURLOPT_HEADER,0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);	    
    $header[0] = "Authorization: cpanel matjrbh:R95ME5YDI797UDK87N9HHQP4MGJUNI5P";
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    curl_setopt($curl, CURLOPT_URL, $query);
    $result = curl_exec($curl);
    if ($result == false)
    	error_log("curl_exec threw error \"" . curl_error($curl) . "\" for $query");
    curl_close($curl);
    return $result;
}



function CreateEmail($email)
{
    $whmusername = "root";
    $whmpassword = "Serv102030";
    $query = "http://5.9.97.148:2082/execute/Email/add_pop?email=info@".$email.".matjrbh.com&password=".env('MAIL_PASSWORD');
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0); 
    curl_setopt($curl, CURLOPT_HEADER,0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);	    
    $header[0] = "Authorization: cpanel matjrbh:R95ME5YDI797UDK87N9HHQP4MGJUNI5P";
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    curl_setopt($curl, CURLOPT_URL, $query);
    $result = curl_exec($curl);
    if ($result == false)
    	error_log("curl_exec threw error \"" . curl_error($curl) . "\" for $query");
    curl_close($curl);
    return $result;

}
function DeleteEmail($email)
{
    $whmusername = "root";
    $whmpassword = "Serv102030";
    $query = "http://5.9.97.148:2082/execute/Email/delete_pop?email=info@".$email.".matjrbh.com";
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0); 
    curl_setopt($curl, CURLOPT_HEADER,0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);	    
    $header[0] = "Authorization: cpanel matjrbh:R95ME5YDI797UDK87N9HHQP4MGJUNI5P";
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    curl_setopt($curl, CURLOPT_URL, $query);
    $result = curl_exec($curl);
    if ($result == false)
    	error_log("curl_exec threw error \"" . curl_error($curl) . "\" for $query");
    curl_close($curl);
    return $result;

}