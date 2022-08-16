# Test files
These files are designed to test the API system to show it working

## Testing via web browser
This test uses a sample API to test if all required PHP extras have been installed (via composer install)

1. Open your favourite web browser
2. Go to http://dc1.domain.local/hello/NAME
   * Replace `NAME` with a name
4. This will give a simple response showing "Hello, `NAME`"

## Testing via PowerShell
This test does require a real user to modify. This will generate a valid request to the script to force the password change.

1. Edit the test.ps1 as required
2. Run test.ps1 in a terminal (dont double click, as you cant see the response)
3. See if `Successful` was display
   * Any errors will be displayed
