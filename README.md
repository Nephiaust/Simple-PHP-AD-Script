# Simple PHP AD Script
A simple API script in PHP to update passwords for Active Directory.

All the documentation assumes dc1.domain.com is your Active Directory DC and also where XAMPP is installed.

## Security
This script has none (other than a basic auth key). The script doesnt validate any user input nor ensures that the data is suitable for publishing to AD.

This script is a HACK to get password sync'ing for me at work against an old dying domain that is due to be disposed of.

***Its not designed for real-life production***

## Installation
1. Download all the files from [here](website/)
2. Edit the config.php
3. On the CLI run `composer install`
4. Ensure your PHP instance has SSL and LDAP enabled
5. Restart your web service and access

## Usage
1. Do a POST request to the page containing JSON.
2. In the JSON file, specify the username & new password

# Windows NOTES
NOTE: You will require your AD domain controller to have a SSL certificate to enable LDAPs. See Google for more help

1. Install XAMPP with Apache, PHP, and sendmail
2. Copy the following files to `%WINDIR%\System32` directory
```
C:\xampp\sendmail\libeay32.dll
C:\xampp\sendmail\ssleay32.dll
C:\xampp\php\libsasl.dll
```
3. Create the folder structure `C:\openldap\sysconf`
4. Copy the contents of [ldap.conf](OpenLDAP/sysconf/ldap.conf) to the folder
5. Grab a copy of the signing CA certificate (or the self signed certificate)
6. Convert to a base64 PEM format for Apache (see Google for help)
7. Save the certificate as `cert.pem` (OR just update the file name in ldap.conf)

## Testing
See the [test-samples](test-samples/) for more information
