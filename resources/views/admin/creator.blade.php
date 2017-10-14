<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/public/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/public/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/public/favicon/favicon-16x16.png">
    <link rel="manifest" href="/assets/public/favicon/manifest.json">
    <link rel="mask-icon" href="/assets/public/favicon/safari-pinned-tab.svg" color="#cb9753">
    <link rel="shortcut icon" href="/assets/public/favicon/favicon.ico">
    <meta name="msapplication-config" content="/assets/public/favicon/browserconfig.xml">
    <meta name="theme-color" content="#cb9753">
    <!-- CSS Sheets -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="/css/user.css" rel="stylesheet" type="text/css" />
    <script src="/js/user/preload.js" type="text/javascript"></script>
    <script src="http://code.gijgo.com/1.5.1/js/gijgo.js" type="text/javascript"></script>
    <link href="http://code.gijgo.com/1.5.1/css/gijgo.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <style media="screen">
      body {
        background-image: none;
        background: white;
      }
      .floating-div {
        padding: 30px;
        margin: 50px 0;
      }
    </style>
    <title>Groups creator</title>
  </head>
  <body>
    <div class="container">
      <h3>Create a new group</h3>
      <div class="border-panel floating-div">
        <form method="POST" action="/groups/store" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="number">Group Number</label>
            <input type="number" name="number" class="form-control" id="group-number" placeholder="">
          </div>
          <div class="form-group">
            <label for="destination">Destination</label>
            <input type="text" name="destination" class="form-control" id="group-destination" placeholder="">
          </div>
          <div class="row">
            <div class="form-group col-xs-6">
              <label for="depart">Departure Date</label>
              <input type="text" name="depart" class="form-control" id="group-depart" placeholder="">
            </div>
            <div class="form-group col-xs-6">
              <label for="return">Return Date</label>
              <input type="text" name="return" class="form-control" id="group-return" placeholder="">
            </div>
          </div>
          <div class="form-group">
            <label for="school">School</label>
            <input type="text" name="school" class="form-control" id="group-school" placeholder="">
          </div>
          <div class="form-group">
            <label for="packages">Packages</label>
            <input type="text" name="packages" class="form-control" id="group-packages" placeholder="">
          </div>
          <div class="form-group">
            <label for="exampleInputFile">Trip Icon</label>
            <input type="file" name="icon" id="group-icon" class="form-control-file" aria-describedby="fileHelp">
          </div>
          <div class="form-group">
            <label for="itinerary">Itinerary</label>
            <input type="file" name="itinerary" id="group-itinerary"  class="form-control-file" aria-describedby="fileHelp">
          </div>
          <div class="form-group">
            <label for="release">Release</label>
            <input type="file" name="release" id="group-release" class="form-control-file" aria-describedby="fileHelp">
          </div>
          <div class="form-group">
            <label for="message">Message</label>
            <textarea class="form-control" name="message" id="exampleTextarea" rows="3"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </body>
  <script type="text/javascript">
      $('#group-depart').datepicker({
              uiLibrary: 'bootstrap4',
              iconsLibrary: 'fontawesome'
          });
      $('#group-return').datepicker({
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome'
        });
  </script>
</html>
