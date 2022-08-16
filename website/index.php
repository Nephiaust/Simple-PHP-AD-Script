<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

define('BASE_DIR',__DIR__ ."/");
$Config = include BASE_DIR . 'config.php';
require './vendor/autoload.php';

$LDAPServer = $Config->server;
$LDAPuser = $Config->username;
$LDAPuserpass = $Config->password;
$LDAPsearch = $Config->searchBase;
$AuthorisationKey = $Config->secretKey;

function MyLDAP($username, $newPassword) {
    global $LDAPsearch, $LDAPServer, $LDAPuser, $LDAPuserpass;
    
    $LDAPConnection = ldap_connect('ldaps://' . $LDAPServer .':636');
    if (FALSE == $LDAPConnection){
        die("Failed to connect to the LDAP server: ". $LDAPServer);
    }
    ldap_set_option($LDAPConnection, LDAP_OPT_PROTOCOL_VERSION, 3) or die('Unable to set LDAP protocol version');
    ldap_set_option($LDAPConnection, LDAP_OPT_REFERRALS, 0);
    ldap_set_option($LDAPConnection, LDAP_OPT_X_TLS_REQUIRE_CERT, LDAP_OPT_X_TLS_NEVER);
    
    if (FALSE == $LDAPbind = ldap_bind($LDAPConnection, $LDAPuser, $LDAPuserpass)){
        die("Failed to bind to LDAP server");
    }
    
    $SearchUser = '(sAMAccountName='. $username .')';

    $SearchResults = ldap_search($LDAPConnection,$LDAPsearch,$SearchUser);
    if (FALSE !== $SearchResults) {
        $user = ldap_get_entries($LDAPConnection, $SearchResults);
        $UserDN = $user[0]["dn"];

        $newPassword = "\"" . $newPassword . "\"";
        $newPasswordLength = strlen($newPassword);
        $MyNewPassword = "";
        for($i=0;$i<$newPasswordLength;$i++){
            $MyNewPassword .= "{$newPassword[$i]}\000";
        }
        
        $EncPassword["unicodePwd"] = $MyNewPassword;
         if (false == ldap_mod_replace($LDAPConnection, $UserDN, $EncPassword)) {
            die("Unable to change password");
         } else {
            return("Successful");
         }
    } else {
        return "User is not found";
    }
}

$app = new \Slim\App;
$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");

    return $response;
});
$app->post('/password/{secretkey}', function (Request $request, Response $response, array $args) {
    $json = file_get_contents('php://input');
    $secretkey = $args['secretkey'];
    global $AuthorisationKey;

    $NewDetails = json_decode($json);
    $username = $NewDetails->username;
    $password = $NewDetails->password;

    $Attempt = MyLDAP($username, $password);

    if ($secretkey == $AuthorisationKey) {
        $response->getBody()->write($Attempt);
    } else {
        $response->getBody()->write("Bad key");
    }
    return $response;
});
$app->run();
