<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>বর্ণমালা</title>
    <link rel="shortcut icon" href="source/fabicon.png" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <!-- font & icon -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Bengali:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e8f84a7605.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div id="app">
        <component :is="$route.meta.layout || 'div'"  :latestpost="{{ $latestpost }}"  >
            <router-view />
          </component>

    </div>

    <script src="{{ asset('js/frontend.js?v=1.0.22') }}"></script>

<script>


if ("{{ Auth::user() }}") {

    if(!User.loggedIn()){
        axios.post('/logout').then(()=>{
            // window.location.href = '/'
        })
    }


}else{
    User.loggedOut()

}

</script>

</body>
</html>
