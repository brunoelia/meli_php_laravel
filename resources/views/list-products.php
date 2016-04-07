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
                  <th>Título</th>
                  <th>Valor</th>
                  <th>Estoque</th>
                  <th>Categoria</th>
                  <th>Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($products as $product) { ?>
                  <tr>
                    <td><?php echo $product->id; ?></td>
                    <td><?php echo $product->title; ?></td>
                    <td>R$ <?php echo $product->price; ?></td>
                    <td><?php echo $product->quantity; ?></td>
                    <td><?php echo $product->category->category_meli; ?></td>
                    <td><?php echo ($product->listed) ? $product->listed->status : ''; ?></td>
                    <td>
                      <a href="/product/<?php echo $product->id; ?>" class="btn btn-success btn-flat">view</a>
                      <a href="/product/<?php echo $product->id; ?>/edit" class="btn btn-primary btn-flat">editar</a>
                      <?php if (empty($product->listed->status)) { ?>
                        <a href="/product/<?php echo $product->id; ?>/publish" class="btn btn-success btn-flat">Publicar</a>
                      <?php } elseif ($product->listed->status == 'active') { ?>
                        <a href="/product/<?php echo $product->id; ?>/update-status/closed" class="btn btn btn-warning btn-flat">Finalizar</a>
                        <a href="/product/<?php echo $product->id; ?>/update-status/paused" class="btn btn btn-warning btn-flat">Pausar</a>
                      <?php } elseif ($product->listed->status == 'paused') { ?>
                        <a href="/product/<?php echo $product->id; ?>/update-status/closed" class="btn btn btn-warning btn-flat">Finalizar</a>
                        <a href="/product/<?php echo $product->id; ?>/update-status/active" class="btn btn-success btn-flat">Re-Ativar</a>
                      <?php } elseif ($product->listed->status == 'closed') { ?>
                        <a href="/product/<?php echo $product->id; ?>/relist" class="btn btn-success btn-flat">Re-Publicar</a>
                      <?php } elseif ($product->listed->status == 'not_yet_active') { ?>
                        <a href="/product/<?php echo $product->id; ?>/update-status/closed" class="btn btn btn-warning btn-flat">Finalizar</a>
                        <a href="/product/<?php echo $product->id; ?>/update-status/paused" class="btn btn btn-warning btn-flat">Pausar</a>
                      <?php } ?>
                    </td>
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