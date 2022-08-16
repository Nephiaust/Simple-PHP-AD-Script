# Simple PHP AD Script
A simple API script in PHP to update passwords for Active Directory.

##Installation
1. Download
2. Edit the config.php
3. On the CLI run `composer install`
4. Ensure your PHP instance has SSL and LDAP enabled
5. Restart your web service and access

##Usage
1. Do a POST request to the page containing JSON.
2. In the JSON file, specify the username & new password
