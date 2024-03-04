<html>
<head>
    <title>Sample UI</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>    <style>
        .responsive-content-window {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
</head>
<body>
    <div id="main_content"></div>
    <script>
        $(document).ready(function () {
            // IFrame URL
            var url = 'https://individualsalesportal-staging.betahth.com/Session/SSO';

            // Your POST Data Here
            var data = {
               "LinkId": 258965,
                "QuoteID": "603657",
                "QuoteKey": "b0Bw9Ki7Th",
               "TimeStamp": new Date().toJSON(),
            };//End of POST DATA

            // Creating Element
            $('#main_content').append('<div class="container"><iframe name="contentWindow" title="Individual Sales Portal" src="' + url + '" class="responsive-content-window"></iframe></div>');

            // Creating Form for SSO POST
            $('#main_content').append('<form action="' + url + '" method="post" target="contentWindow" id="ssoForm"></form>');

            // Appending Form Fields
            appendFormFields(data);

            // Submitting and removing Form
            $('#ssoForm').submit().remove();
        });

        function appendFormFields(postData) {
            $.each(postData, function (name, value) {
                $('#ssoForm').append('<input type="hidden" name="' + name + '" value="' + value + '" />');
            });
        }
    </script>
</body>
</html>
