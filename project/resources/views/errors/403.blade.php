<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="{{getPhoto($gs->favicon)}}">
  <title>403</title>
  <style>
    body {
      padding: 0;
      margin: 0;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh
    }
    div {
      text-align: center;
    }
    div img {
      width: 100%;
      max-width: 720px;
      max-height: 640px;
      object-fit: contain;
      object-position: center center
    }
    .btn {
      padding: 10px 25px;
      background: #6078f2;
      text-decoration: none;
      color: #fff;
      border-radius: 3px;
      margin-top: 40px;
      display: inline-block
    }
  </style>
</head>


<body>
  <div>
    <img src="{{getPhoto('403.png')}}">
    <div>
      <a href="{{url()->previous()}}" class="btn">@langg('Go Back')</a>
    </div>
  </div>
</body>

</html>