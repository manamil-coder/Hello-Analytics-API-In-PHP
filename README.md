## Hello Analytics API: PHP Quickstart For Service Accounts
<br>
<b>Step 1: Enable the Analytics API</b>
<br><br>
1 - Open the <a href="https://console.developers.google.com/iam-admin/serviceaccounts">Service accounts page</a> 👉
<br><br>
2- Click <b> + Create Service Account</b> enter a name and description for the service account. You can use the default service account ID, or choose a different, unique one. When done click <b>Create.</b>
<br><br>
3 - The <b>Service account permissions (optional)</b> section that follows is not required. Click <b>Continue</b>.
<br><br>
4 - On the <b>Grant users access to this service account</b> screen, scroll down to the <b> Create key </b>
section. Click <b> + Create key.</b>
<br><br>
5 - In the side panel that appears, select the format for your key: <b>JSON</b>  is recommended.
<br><br>
6 - Click <b>Create.</b>  Your new public/private key pair is generated and downloaded to your machine; it serves as the only copy of this key. For information on how to store it securely, see  <a href="https://cloud.google.com/iam/docs/understanding-service-accounts#managing_service_account_keys">Managing service account keys.</a> 👉
<br><br>
7 - Click <b>Close </b> on the <b>Private key saved to your computer</b> dialog, then click <b>Done </b> to return to the table of your service accounts.
<br><br>
<b>Step 2: Download Zip / Clone Git</b><br>
<b>Step 3: Setup the sample</b><br>
<br>
change the key file location if necessary.<br>
$KEY_FILE_LOCATION = 'example-jason-key.json';
<br>
Replace with your view ID, for example XXXX.<br>
$VIEW_ID = "XXXX";
<br>
<br>
if you get any error in this repository so contact me. 
