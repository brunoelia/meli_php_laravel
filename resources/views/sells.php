<?php include('header.php'); ?>

  <div id="content-wrapper">
    
    <div class="page-header">
      
      <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-archive page-header-icon"></i>&nbsp;&nbsp;Produtos</h1>

        <div class="col-xs-12 col-sm-8">
          <div class="row">
            <hr class="visible-xs no-grid-gutter-h">
            <!-- "Create project" button, width=auto on desktops -->
            <!-- Margin -->
            <div class="visible-xs clearfix form-group-margin"></div>

          </div>
        </div>
      </div>
    </div> <!-- / .page-header -->


    <div class="row">

      <div class="panel">
          <div class="panel-heading">
            <span class="panel-title">Produtos</span>
          </div>
          <div class="panel-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Data</th>
                  <th>Comprador</th>
                  <th>Produto</th>
                  <th>Quantidade</th>
                  <th>Envio</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($sells as $sell) { ?>
                  <tr>
                    <td><?php echo $sell->id; ?></td>
                    <td><?php echo $sell->created_at; ?></td>
                    <td><?php echo $sell->buyer->name; ?></td>
                    <td><?php echo $sell->product->title; ?></td>
                    <td><?php echo $sell->quantity; ?></td>
                    <td><?php echo $sell->send; ?></td>
                    <td><a href="/order/<?php echo $sell->id; ?>" class="btn btn-primary">+ detalhes</a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>

    </div>

    <!-- Page wide horizontal line -->
    <hr class="no-grid-gutter-h grid-gutter-margin-b no-margin-t">

  </div> <!-- / #content-wrapper -->
  
<?php include('footer.php'); ?>