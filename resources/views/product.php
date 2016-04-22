<html>
  <head>
    <link href="<?= url('/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= url('/css/bootstrap-theme.min.css') ?>" rel="stylesheet">
    <style>
      .container {
          margin-left:10em;
          margin-top:5em;
          border: 1 px solid #8787ab;
          background: #e1e1ea;
          padding-top: 30px;
          padding-left: 40px;
          width: 75%;
          border-radius: 7px;
      }
      .mb20 {
          margin-bottom: 20px;
      }
      body {  
          background: #f0f0f5;
      }
      h1, h3 {
          text-align: center;
          font-family: Cambria;
          
      }
      .error {
          color: red;
      }
      .errors {
          text-align: center;
          margin-top:40px;
      }
      .notice, #running_total {
          font-family: Cambria;
          font-size: 10px;
          margin-left:40px;
      }
      h3 {
          margin-bottom: 20px;
      }
    </style>
  </head>
  <body>
    <form method="post" action="<?= url('/updateProduct') ?>" id="product-form">
      <input type="hidden" name="_token" value="<?= csrf_token(); ?>">
      <h1>Edit Product</h1>
      <div class="container">
        <div class="row">
          <div class="col-md-2">
            <label class="control-label">Product Name:</label>
          </div>
          <div class="col-md-9">
            <input type="text" class="form-control" name="name" id="name">
          </div>
        </div>
        <div class="row">
          <div class="col-md-2">
            <label class="control-label">Quantity in Stock:</label>
          </div>
          <div class="col-md-9">
            <input type="text" class="form-control" name="quantity" id="quantity">
          </div>
        </div>
        <div class="row mb20">
          <div class="col-md-2">
            <label class="control-label">Price Per Item:</label>
          </div>
          <div class="col-md-9">
            <input type="text" class="form-control" name="price" id="price">
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            &nbsp;
          </div>
          <div class="col-md-6">
            <button type="button" class="btn-lg btn-success" onclick="updateProduct()"">UPDATE PRODUCT</button>
          </div>
        </div>
      </div> <!-- end container -->
    </form>
    <div class="errors">
      <?php foreach ($errors->all() as $error): ?>
        <div class="row">
          <div class="col-md-6 error">
            <?= $error ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="notice" id="notice" style="display:none">
      <div class="row">
        <div class='col-md-12'>
          <h3>Form submission contents:</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-2">
          <label class="control-label">Product Name:</label>
        </div>
        <div class="col-sm-2">
          <label class="control-label">Quantity in Stock:</label>
        </div>
        <div class="col-sm-2">
          <label class="control-label">Price Per Item:</label>
        </div>
        <div class="col-sm-3">
          <label class="control-label">Datetime Submitted</label>
        </div>
        <div class="col-sm-2">
          <label class="control-label">Total Value:</label>
        </div>
      </div>
    </div>
    <div id="running_total" class="row" style="display:none"></div>
    <script src="<?= url('/js/jquery-2.2.3.min.js') ?>" type="text/javascript"></script>
    <script src="<?= url('/js/bootstrap.min.js') ?>" type="text/javascript"></script>
    <script type='text/javascript'>
      

      function updateProduct() {
        var running_total = 0;
        $('.product-item').each(function() {
          $(this).remove()
        });
        var has_errors = false;
        //remove any errors that are still showing up
        $('.error').each(function() {
          $(this).remove();
        })
        
        //validate the fields
        if ($('#name').val() == '') {
          $('.errors').append('<div class="row"><div class="col-md-6 error">Please enter product name.</div></div>');
          has_errors = true;
        }
        if (!$.isNumeric($("#quantity").val()) || !$.isNumeric($("#price").val())) {
          $('.errors').append('<div class="row"><div class="col-md-6 error">Please enter a numeric value for price and quantity.</div></div>');
          has_errors  = true;
        }
        
        if (has_errors) {
          console.log("the form has errors");
          return false;
        }
        
        console.log("attempting ajax");
        
        //submit the form
//        $.ajax({
//          type: 'post',
//          data: $("#product-form").serialize(),
//          url: '/updateProduct',
//          dataType: 'json',
//          success: function(data) {
//            //here is where we append the data
//            console.log("something happened");
//            console.debug(data);
//          }
//        });
        $('#notice').show();
        $("#running_total").show();
        $.post('/updateProduct', $("#product-form").serialize(), function(data) {
          data.sort(function(a, b) {
            var date_a = new Date(a);
            var date_b = new Date(b);
            
            if (date_a > date_b) {
              return 1;
            }
            if (date_b > date_a) {
              return -1;
            }
            
            return 0;
          });
          
          for (var i = 0; i < data.length; i++) {
            running_total += parseFloat(data[i].total);
            $('#notice').append('<div class="row product-item"><div class="col-sm-2">' + data[i].name + '</div><div class="col-sm-2">' + data[i].quantity + '</div><div class="col-sm-2">' + data[i].price + '</div><div class="col-sm-3">' + data[i].date + '</div><div class="col-sm-2">' + data[i].total + '</div></div>');
          }
          
          
          $("#running_total").html('<div class="row"><div class="col-sm-2"><label class"control-label">Running Total:</label></div><div class="col-sm-10">' + running_total + '</div></div>');
          
          
        }, 'json');
        
        
      }
    </script>
  </body>
</html>