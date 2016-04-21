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
      .errors, .notice {
          text-align: center;
          margin-top:40px;
      }
      .notice {
          text-align: center;
          font-family: Cambria;
          font-size: 12px;
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
            <button type="submit" class="btn-lg btn-success" value="Update Product">UPDATE PRODUCT</button>
          </div>
        </div>
      </div> <!-- end container -->
      <div class="errors">
        <?php foreach ($errors->all() as $error): ?>
          <div class="row">
            <div class="col-md-6 error">
              <?= $error ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="notice">
        <?php if (Session::get('product_return') != null): ?>
          <div class="row">
            <h3>Form submission contents:</h3>
          </div>
          <div class="row">
            <div class="col-md-2">
              <label class="control-label">Product Name:</label>
            </div>
            <div class="col-md-6">
              <p><?= Session::get('product_return')['Product_Name'] ?></p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2">
              <label class="control-label">Quantity in Stock:</label>
            </div>
            <div class="col-md-6">
              <p><?= Session::get('product_return')['Quantity_In_Stock'] ?></p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2">
              <label class="control-label">Price Per Item:</label>
            </div>
            <div class="col-md-6">
              <p><?= Session::get('product_return')['Price_Per_Item'] ?></p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2">
              <label class="control-label">Datetime Submitted</label>
            </div>
            <div class="col-md-6">
              <p><?= Session::get('product_return')['Datetime_Submitted'] ?></p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2">
              <label class="control-label">Total Value:</label>
            </div>
            <div class="col-md-6">
              <p><?= Session::get('product_return')['Total_Value'] ?></p>
            </div>
          </div>
        <?php endif ?>
      </div>
    </form>
    <script src="<?= url('/js/bootstrap.min.js') ?>" type="text/javascript"></script>
    <script src="<?= url('/jquery-2.2.3.min.js') ?>" type="text/javascript"></script> 
  </body>
</html>