# Simple PHP AD Script
A simple API script in PHP to update passwords for Active Directory.

All the documentation assumes dc1.domain.com is your Active Directory DC and also where XAMPP is installed.

## Installation
1. Download all the files from `website`
2. Edit the config.php
3. On the CLI run `composer install`
4. Ensure your PHP instance has SSL and LDAP enabled
5. Restart your web service and access

## Usage
1. Do a POST request to the page containing JSON.
2. In the JSON file, specify the username & new password

# Windows NOTES
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
See the (test-samples/README.md) for more information
