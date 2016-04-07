<?php include('header.php'); ?>

  <div id="content-wrapper">
    
    <div class="page-header">
      
      <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-archive page-header-icon"></i>&nbsp;&nbsp;Perguntas</h1>

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
            <span class="panel-title">Perguntas</span>
          </div>
          <div class="panel-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Pergunta</th>
                  <th>Produto</th>
                  <th>Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($questions as $question) { ?>
                  <tr>
                    <td><?php echo $question->id; ?></td>
                    <td><?php echo $question->text; ?></td>
                    <td>
                      <a href="/product/<?php echo $question->product_id; ?>"><?php echo $question->product->title; ?></a>
                    </td>
                    <td><?php echo $question->status; ?></td>
                    <td>
                      <?php if ($question->status == 'UNANSWERED') { ?>
                        <a href="/question/<?php echo $question->id; ?>/reply" class="btn btn-success btn-flat">Responder</a>
                      <?php } 
                        if ($question->status != 'ANSWERED') {
                      ?>
                        <a href="/question/<?php echo $question->id; ?>/delete" class="btn btn-danger btn-flat">Apagar</a>
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