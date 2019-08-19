<!DOCTYPE html>
<html lang="en-US">
	<head>
	    <meta charset="utf-8">
	</head>
	<body>
		<div>
		    Hello,

		    {!! $content !!}

		    <p>From,</p>
		    {{ env('MAIL_FROM_NAME') }}
		</div>

	</body>
</html>