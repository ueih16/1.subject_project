<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <style>
    #project-label {
      display: block;
      font-weight: bold;
      margin-bottom: 1em;
    }
    #project-icon {
      float: left;
      height: 32px;
      width: 32px;
    }
    #project-description {
      margin: 0;
      padding: 0;
    }
  </style>
</head>
<body>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $( "#project" ).autocomplete({
        source: "search.php",
        focus: function( event, ui ) {
          $( "#project" ).val( ui.item.label );
          return false;
        },
        select: function( event, ui ) {
          var productId = ui.item.id;
          window.location.href = "detail_product.php?id=" + productId;

          return false;
        }
      })
      .autocomplete( "instance" )._renderItem = function( ul, item ) {
        return $( "<li>" )
        .append(` <div>
          ${item.label}
          <br>
          <img src="admin/products/photo/${item.image}" height="50">
          ${item.price}
          </div>`)
        .appendTo( ul );
      };

    });
  </script>
  <input id="project">
  <input type="hidden" id="project-id">
</body>
</html>