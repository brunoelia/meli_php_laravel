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
            <span class="panel-title"><?php echo $product->title; ?></span>
            <div class="panel-heading-controls">
              <a href="/product/<?php echo $product->id; ?>/edit" class="btn btn-success btn-flat">editar</a>
            </div>
          </div>
          <div class="panel-body">
            <table class="table table-striped">
              <tbody>
                <tr>
                  <th class="col-sm-2 text-right">Título:</th>
                  <td><?php echo $product->title; ?></td>
                </tr>
                <tr>
                  <th class="col-sm-2 text-right">Preço:</th>
                  <td>R$ <?php echo $product->price; ?></td>
                </tr>
                <tr>
                  <th class="col-sm-2 text-right">Estoque:</th>
                  <td><?php echo $product->quantity; ?></td>
                </tr>
                <tr>
                  <th class="col-sm-2 text-right">Video:</th>
                  <td><?php echo $product->video_id; ?></td>
                </tr>
                <tr>
                  <th class="col-sm-2 text-right">Image:</th>
                  <td><?php echo $product->video_id; ?></td>
                </tr>
                <?php if (!empty($product->listed->meli_id)) { ?>
                  <tr>
                    <th class="col-sm-2 text-right">MeLi id:</th>
                    <td><?php echo $product->listed->meli_id; ?></td>
                  </tr>
                  <tr>
                    <th class="col-sm-2 text-right">MeLi Status:</th>
                    <td><?php echo $product->listed->status; ?></td>
                  </tr>
                  <tr>
                    <th class="col-sm-2 text-right">MeLi Category:</th>
                    <td><?php echo $product->listed->category_id; ?></td>
                  </tr>
                  <tr>
                    <th class="col-sm-2 text-right">MeLi Permalink:</th>
                    <td><a target='_blank' href="<?php echo $product->listed->permalink; ?>"><?php echo $product->listed->permalink; ?></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            <div class="pull-right">
              <div class="btn-group">
                <a href="/product" class="btn btn-default btn-flat">Voltar</a>
                <a href="/product/<?php echo $product->id; ?>/edit" class="btn btn-primary btn-flat">Editar</a>
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
              </div>
            </div>
          </div>
        </div>
    </div>

    <!-- Page wide horizontal line -->
    <hr class="no-grid-gutter-h grid-gutter-margin-b no-margin-t">

  </div> <!-- / #content-wrapper -->
  
<?php include('footer.php'); ?>