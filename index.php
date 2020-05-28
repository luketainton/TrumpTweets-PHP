<?php
  $appname = "TrumpTweets";

  function curl_get_contents($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
  }

  $quote = json_decode(curl_get_contents('https://api.tronalddump.io/random/quote'));
  $date =  explode('T', $quote->appeared_at)[0];
  $year = explode('-', $date)[0];
  $month = DateTime::createFromFormat('!m', explode('-', $date)[1])->format('F');
  $day = explode('-', $date)[2];
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title><?php echo($appname); ?></title>
    <link rel="shortcut icon" href="/trump.png">

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/cover/">

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.3/examples/cover/cover.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
  <header class="masthead mb-auto">
    <div class="inner">
      <h3 class="masthead-brand"><?php echo($appname); ?></h3>
    </div>
  </header>

  <main role="main" class="inner cover">
    <img src="/trump.png" height="250px" />
        <div id="tweet" style="margin-top: 2%">
            <p><?php echo($quote->value); ?></p>
            <p><i>  - <?php echo($quote->_embedded->author[0]->name . " (". $day . " " . $month . " " . $year . ")"); ?></i></p>
        </div>
        <p style="margin-top: 5%;"><a target="_blank" href="<?php echo($quote->_embedded->source[0]->url); ?>">View Tweet</a></p>
  </main>

  <footer class="mastfoot mt-auto">
    <div class="inner">
      <p><?php echo($appname); ?> built by Luke Tainton.<br>Cover template for <a href="https://getbootstrap.com/">Bootstrap</a> built by <a href="https://twitter.com/mdo">@mdo</a>.</p>
    </div>
  </footer>
</div>
</body>
</html>
