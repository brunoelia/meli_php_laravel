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
            <span class="panel-title"><?php echo $question->product->title; ?></span>
          </div>
          <div class="panel-body">
            <table class="table table-striped">
              <tbody>
                <tr>
                  <th class="col-sm-2 text-right">Título:</th>
                  <td><?php echo $question->product->title; ?></td>
                </tr>
                <tr>
                  <th class="col-sm-2 text-right">Preço:</th>
                  <td>R$ <?php echo $question->product->price; ?></td>
                </tr>
                <tr>
                  <th class="col-sm-2 text-right">Estoque:</th>
                  <td><?php echo $question->product->quantity; ?></td>
                </tr>
                <tr>
                  <th class="col-sm-2 text-right">Video:</th>
                  <td><?php echo $question->product->video_id; ?></td>
                </tr>
                <tr>
                  <th class="col-sm-2 text-right">Image:</th>
                  <td><?php echo $question->product->video_id; ?></td>
                </tr>
                <?php if (!empty($product->listed->meli_id)) { ?>
                  <tr>
                    <th class="col-sm-2 text-right">MeLi id:</th>
                    <td><?php echo $question->product->listed->meli_id; ?></td>
                  </tr>
                  <tr>
                    <th class="col-sm-2 text-right">MeLi Status:</th>
                    <td><?php echo $question->product->listed->status; ?></td>
                  </tr>
                  <tr>
                    <th class="col-sm-2 text-right">MeLi Category:</th>
                    <td><?php echo $question->product->listed->category_id; ?></td>
                  </tr>
                  <tr>
                    <th class="col-sm-2 text-right">MeLi Permalink:</th>
                    <td><a href="<?php echo $question->product->listed->permalink; ?>"><?php echo $question->product->listed->permalink; ?></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            <form action="/question/<?php echo $question->id; ?>/send-reply" method="post">
              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" >
              <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                  <div class="form-group no-margin-hr">
                    <label class="control-label">Pergunta: <span style='font-weight: normal'><?php echo $question->text; ?></span> (??)</label>
                    <textarea name="answer" class="form-control"></textarea>
                  </div>
                </div><!-- col-sm-8 -->
              </div>
              <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                  <button class="btn btn-primary">Responder</button>
                </div>
              </div>

            </form>

          </div>
        </div>
    </div>

    <!-- Page wide horizontal line -->
    <hr class="no-grid-gutter-h grid-gutter-margin-b no-margin-t">

  </div> <!-- / #content-wrapper -->

<?php include('footer.php'); ?>