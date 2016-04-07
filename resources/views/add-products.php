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

      <form action="/product" class="panel form-horizontal" method="POST">
        <input type="hidden" name="_token" value="<?php echo csrf_token();?>" >
          <div class="panel-heading">
            <span class="panel-title">Adicionar novo produto</span>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-sm-8">
                <div class="form-group no-margin-hr">
                  <label class="control-label">Titulo</label>
                  <input type="text" name="title" class="form-control">
                </div>
              </div><!-- col-sm-8 -->

              <div class="col-sm-4">
                <div class="form-group no-margin-hr">
                  <label class="control-label">Video</label>
                  <input type="text" name="video_id" class="form-control">
                </div>
              </div><!-- col-sm-4 -->
            </div>

            <div class="row">
              <div class="col-sm-3">
                <div class="form-group no-margin-hr">
                  <label class="control-label">Preço</label>
                  <input type="number" name="price" class="form-control">
                </div>
              </div><!-- col-sm-3 -->

              <div class="col-sm-3">
                <div class="form-group no-margin-hr">
                  <label class="control-label">Categoria</label>
                  <select name="category_id" class="form-control">
                    <?php foreach($categories as $category) { ?>
                      <option value="<?php echo $category->id; ?>"><?php echo $category->category; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div><!-- col-sm-3 -->

              <div class="col-sm-3">
                <div class="form-group no-margin-hr">
                  <label class="control-label">Estoque</label>
                  <input type="number" name="quantity" class="form-control">
                </div>
              </div><!-- col-sm-3 -->

              <div class="col-sm-3">
                <div class="form-group no-margin-hr">
                  <label class="control-label">Garantia</label>
                  <input type="number" name="warranty" class="form-control">
                </div>
              </div><!-- col-sm-3 -->
            </div><!-- row -->

            <div class="row">
              <div class="col-sm-12">
                <div class="form-group no-margin-hr">
                  <label class="control-label">Descrição</label>
                  <textarea class="form-control" name="description" rows="10"></textarea>
                </div>
              </div>
            </div>

          </div>
          <div class="panel-footer text-right">
            <button class="btn btn-primary">Salvar</button>
          </div>
        </form>

    </div>

    <!-- Page wide horizontal line -->
    <hr class="no-grid-gutter-h grid-gutter-margin-b no-margin-t">

  </div> <!-- / #content-wrapper -->

<?php include('footer.php'); ?>