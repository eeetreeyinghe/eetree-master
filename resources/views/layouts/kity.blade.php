<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<link href="favicon.ico" type="image/x-icon" rel="shortcut icon">

	<link rel="stylesheet" href="{{ asset('vendor/kityminder/kityminder.css') }}" />
    <link href="{{ asset('vendor/toastr/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">
    <style>
		html, body {
			margin: 0;
			padding: 0;
			height: 100%;
			overflow: hidden;
		}
		.editor-title {
			background: #393F4F;
			color: white;
			height: 40px;
			padding: 0 20px;
		}
        .editor-title .doc-ope{
			margin: 0 0 0 10px;
			line-height: 40px;
			font-family: 'Hiragino Sans GB', 'Arial', 'Microsoft Yahei';
			font-weight: normal;
            display:inline-block;
            vertical-align: middle;
            cursor: pointer;
        }
        .editor-title .doc-share ,.editor-title.doc-return-up{
            color: #ccc;
            font-size: 12px;
        }

        .editor-title .doc-name{
            font-size: 14px;
            width: 60%;
            text-align: center;
            margin-left: 3rem;
        }
        .editor-title .doc-share {
            cursor: pointer;
        }
        .editor-title .fa{
            font-size:14px;
            margin-right:1rem;

        }
		div.minder-editor-container {
			position: absolute;
			top: 40px;
			bottom: 0;
			left: 0;
			right: 0;
        }
        .copy-cont{
            width: 80%;
            padding: 5px 10px;
            color: #777;
            margin-right: 10px;
            margin-bottom: 20px;
            margin-top: 20px;
        }
	</style>
</head>
@yield('content')
</html>
