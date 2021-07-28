<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
</head>
<body class="antialiased">
    <h2>CSRF</h2>
    <div>
        <pre>
            CSRF(Cross-Site Request Forgery, 교차 사이트 요청 위조)라고 하며, 공격 방법의 일종인데,
            어느 한 사이트, 또는 페이지가 다른 사람의 권한을 도용하여 마치 그 사람이 요청한 것처럼 다른 페이지를 속이는 것을 말한다.
            PHP:HTML 폼 (GET, POST)에 일반적인 PHP 에서 그것을 막는 방법이 기술되어 있고,
            라라벨에서 이를 막으려면 더욱 간단하게 다음과 같이 
            1. csrf_field() 헬퍼를 사용하거나
            2. input tag에 _token 추가
            3. @csrf를 사용할 수 있다.
        </pre>
    </div>
    <div>
        <form method="POST" action="/">
        <?php echo csrf_field() ?>
        <input type="text" name="_token" value="<?php echo csrf_token() ?>">
        @csrf
    </div>
</body>
</html>
