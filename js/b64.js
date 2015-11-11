function doit(){var cipherText=btoa(document.b64.clear.value);
document.b64.cipher.value=cipherText;}
function undoit(){var clearText=atob(document.b64.cipher.value);
document.b64.clear.value=clearText;}