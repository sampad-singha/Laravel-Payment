<!-- resources/views/oauth-popup-redirect.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Logging in...</title>
</head>
<body>
<script>
    window.opener.postMessage({
        token: @json($token),
        email: @json($email)
    }, '*');

    window.close();
</script>
</body>
</html>
