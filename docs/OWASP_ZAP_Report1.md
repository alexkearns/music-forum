
# ZAP Scanning Report




## Summary of Alerts

| Risk Level | Number of Alerts |
| --- | --- |
| High | 0 |
| Medium | 0 |
| Low | 5 |
| Informational | 0 |

## Alert Detail


  
  
  
### Cookie No HttpOnly Flag
##### Low (Medium)
  
  
  
  
#### Description
<p>A cookie has been set without the HttpOnly flag, which means that the cookie can be accessed by JavaScript. If a malicious script can be run on this page then the cookie will be accessible and can be transmitted to another site. If this is a session cookie then session hijacking may be possible.</p>
  
  
  
* URL: [https://softeng2.alexkearns.co.uk/login](https://softeng2.alexkearns.co.uk/login)
  
  
  * Method: `GET`
  
  
  * Parameter: `XSRF-TOKEN`
  
  
  * Evidence: `Set-Cookie: XSRF-TOKEN`
  
  
  
  
* URL: [https://softeng2.alexkearns.co.uk/password/email](https://softeng2.alexkearns.co.uk/password/email)
  
  
  * Method: `POST`
  
  
  * Parameter: `XSRF-TOKEN`
  
  
  * Evidence: `Set-Cookie: XSRF-TOKEN`
  
  
  
  
* URL: [https://softeng2.alexkearns.co.uk](https://softeng2.alexkearns.co.uk)
  
  
  * Method: `GET`
  
  
  * Parameter: `XSRF-TOKEN`
  
  
  * Evidence: `Set-Cookie: XSRF-TOKEN`
  
  
  
  
* URL: [https://softeng2.alexkearns.co.uk/login](https://softeng2.alexkearns.co.uk/login)
  
  
  * Method: `POST`
  
  
  * Parameter: `XSRF-TOKEN`
  
  
  * Evidence: `Set-Cookie: XSRF-TOKEN`
  
  
  
  
* URL: [https://softeng2.alexkearns.co.uk/register](https://softeng2.alexkearns.co.uk/register)
  
  
  * Method: `POST`
  
  
  * Parameter: `XSRF-TOKEN`
  
  
  * Evidence: `Set-Cookie: XSRF-TOKEN`
  
  
  
  
* URL: [https://softeng2.alexkearns.co.uk/password/reset](https://softeng2.alexkearns.co.uk/password/reset)
  
  
  * Method: `GET`
  
  
  * Parameter: `XSRF-TOKEN`
  
  
  * Evidence: `Set-Cookie: XSRF-TOKEN`
  
  
  
  
* URL: [https://softeng2.alexkearns.co.uk/register](https://softeng2.alexkearns.co.uk/register)
  
  
  * Method: `GET`
  
  
  * Parameter: `XSRF-TOKEN`
  
  
  * Evidence: `Set-Cookie: XSRF-TOKEN`
  
  
  
  
Instances: 7
  
### Solution
<p>Ensure that the HttpOnly flag is set for all cookies.</p>
  
### Reference
* http://www.owasp.org/index.php/HttpOnly

  
#### CWE Id : 16
  
#### WASC Id : 13
  
#### Source ID : 3

  
  
  
### Cross-Domain JavaScript Source File Inclusion
##### Low (Medium)
  
  
  
  
#### Description
<p>The page includes one or more script files from a third-party domain.</p>
  
  
  
* URL: [https://softeng2.alexkearns.co.uk/register](https://softeng2.alexkearns.co.uk/register)
  
  
  * Method: `GET`
  
  
  * Parameter: `https://use.fontawesome.com/releases/v5.0.6/js/all.js`
  
  
  * Evidence: `<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>`
  
  
  
  
* URL: [https://softeng2.alexkearns.co.uk/password/reset](https://softeng2.alexkearns.co.uk/password/reset)
  
  
  * Method: `GET`
  
  
  * Parameter: `https://use.fontawesome.com/releases/v5.0.6/js/all.js`
  
  
  * Evidence: `<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>`
  
  
  
  
* URL: [https://softeng2.alexkearns.co.uk/login](https://softeng2.alexkearns.co.uk/login)
  
  
  * Method: `GET`
  
  
  * Parameter: `https://use.fontawesome.com/releases/v5.0.6/js/all.js`
  
  
  * Evidence: `<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>`
  
  
  
  
* URL: [https://softeng2.alexkearns.co.uk](https://softeng2.alexkearns.co.uk)
  
  
  * Method: `GET`
  
  
  * Parameter: `https://use.fontawesome.com/releases/v5.0.6/js/all.js`
  
  
  * Evidence: `<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>`
  
  
  
  
Instances: 4
  
### Solution
<p>Ensure JavaScript source files are loaded from only trusted sources, and the sources can't be controlled by end users of the application.</p>
  
### Reference
* 

  
#### CWE Id : 829
  
#### WASC Id : 15
  
#### Source ID : 3

  
  
  
### Incomplete or No Cache-control and Pragma HTTP Header Set
##### Low (Medium)
  
  
  
  
#### Description
<p>The cache-control and pragma HTTP header have not been set properly or are missing allowing the browser and proxies to cache content.</p>
  
  
  
* URL: [https://softeng2.alexkearns.co.uk/password/reset](https://softeng2.alexkearns.co.uk/password/reset)
  
  
  * Method: `GET`
  
  
  * Parameter: `Cache-Control`
  
  
  * Evidence: `no-cache, private`
  
  
  
  
* URL: [https://softeng2.alexkearns.co.uk](https://softeng2.alexkearns.co.uk)
  
  
  * Method: `GET`
  
  
  * Parameter: `Cache-Control`
  
  
  * Evidence: `no-cache, private`
  
  
  
  
* URL: [https://softeng2.alexkearns.co.uk/robots.txt](https://softeng2.alexkearns.co.uk/robots.txt)
  
  
  * Method: `GET`
  
  
  * Parameter: `Cache-Control`
  
  
  
  
* URL: [https://softeng2.alexkearns.co.uk/register](https://softeng2.alexkearns.co.uk/register)
  
  
  * Method: `GET`
  
  
  * Parameter: `Cache-Control`
  
  
  * Evidence: `no-cache, private`
  
  
  
  
* URL: [https://softeng2.alexkearns.co.uk/css/app.css](https://softeng2.alexkearns.co.uk/css/app.css)
  
  
  * Method: `GET`
  
  
  * Parameter: `Cache-Control`
  
  
  
  
* URL: [https://softeng2.alexkearns.co.uk/login](https://softeng2.alexkearns.co.uk/login)
  
  
  * Method: `GET`
  
  
  * Parameter: `Cache-Control`
  
  
  * Evidence: `no-cache, private`
  
  
  
  
Instances: 6
  
### Solution
<p>Whenever possible ensure the cache-control HTTP header is set with no-cache, no-store, must-revalidate; and that the pragma HTTP header is set with no-cache.</p>
  
### Reference
* https://www.owasp.org/index.php/Session_Management_Cheat_Sheet#Web_Content_Caching

  
#### CWE Id : 525
  
#### WASC Id : 13
  
#### Source ID : 3

  
  
  
### Password Autocomplete in Browser
##### Low (Medium)
  
  
  
  
#### Description
<p>The AUTOCOMPLETE attribute is not disabled on an HTML FORM/INPUT element containing password type input.  Passwords may be stored in browsers and retrieved.</p>
  
  
  
* URL: [https://softeng2.alexkearns.co.uk](https://softeng2.alexkearns.co.uk)
  
  
  * Method: `GET`
  
  
  * Parameter: `password`
  
  
  * Evidence: `<input type="password" id="password" name="password" class="form-control" placeholder="Password" required>`
  
  
  
  
* URL: [https://softeng2.alexkearns.co.uk/login](https://softeng2.alexkearns.co.uk/login)
  
  
  * Method: `GET`
  
  
  * Parameter: `password`
  
  
  * Evidence: `<input type="password" id="password" name="password" class="form-control" placeholder="Password" required>`
  
  
  
  
* URL: [https://softeng2.alexkearns.co.uk/register](https://softeng2.alexkearns.co.uk/register)
  
  
  * Method: `GET`
  
  
  * Parameter: `password`
  
  
  * Evidence: `<input type="password" id="password" name="password" class="form-control" placeholder="Password" required>`
  
  
  
  
Instances: 3
  
### Solution
<p>Turn off the AUTOCOMPLETE attribute in forms or individual input elements containing password inputs by using AUTOCOMPLETE='OFF'.</p>
  
### Reference
* http://www.w3schools.com/tags/att_input_autocomplete.asp
* https://msdn.microsoft.com/en-us/library/ms533486%28v=vs.85%29.aspx

  
#### CWE Id : 525
  
#### WASC Id : 15
  
#### Source ID : 3

  
  
  
### X-Content-Type-Options Header Missing
##### Low (Medium)
  
  
  
  
#### Description
<p>The Anti-MIME-Sniffing header X-Content-Type-Options was not set to 'nosniff'. This allows older versions of Internet Explorer and Chrome to perform MIME-sniffing on the response body, potentially causing the response body to be interpreted and displayed as a content type other than the declared content type. Current (early 2014) and legacy versions of Firefox will use the declared content type (if one is set), rather than performing MIME-sniffing.</p>
  
  
  
* URL: [https://softeng2.alexkearns.co.uk/robots.txt](https://softeng2.alexkearns.co.uk/robots.txt)
  
  
  * Method: `GET`
  
  
  * Parameter: `X-Content-Type-Options`
  
  
  
  
* URL: [https://softeng2.alexkearns.co.uk/css/app.css](https://softeng2.alexkearns.co.uk/css/app.css)
  
  
  * Method: `GET`
  
  
  * Parameter: `X-Content-Type-Options`
  
  
  
  
* URL: [https://softeng2.alexkearns.co.uk/js/app.js](https://softeng2.alexkearns.co.uk/js/app.js)
  
  
  * Method: `GET`
  
  
  * Parameter: `X-Content-Type-Options`
  
  
  
  
Instances: 3
  
### Solution
<p>Ensure that the application/web server sets the Content-Type header appropriately, and that it sets the X-Content-Type-Options header to 'nosniff' for all web pages.</p><p>If possible, ensure that the end user uses a standards-compliant and modern web browser that does not perform MIME-sniffing at all, or that can be directed by the web application/web server to not perform MIME-sniffing.</p>
  
### Other information
<p>This issue still applies to error type pages (401, 403, 500, etc) as those pages are often still affected by injection issues, in which case there is still concern for browsers sniffing pages away from their actual content type.</p><p>At "High" threshold this scanner will not alert on client or server error responses.</p>
  
### Reference
* http://msdn.microsoft.com/en-us/library/ie/gg622941%28v=vs.85%29.aspx
* https://www.owasp.org/index.php/List_of_useful_HTTP_headers

  
#### CWE Id : 16
  
#### WASC Id : 15
  
#### Source ID : 3
