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
            <span class="panel-title">Venda: # <?php echo $order->meli_id; ?></span>
          </div>
          <div class="panel-body">
            <div class="row">
              <table class="table table-striped">
                <tbody>
                  <tr>
                    <th class="col-sm-3">Status</th>
                    <td><?php echo $order->status; ?></td>
                  </tr>

                  <tr>
                    <th class="col-sm-3">Valor</th>
                    <td><?php echo $order->currency . ' ' . $order->total_amount; ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
            
            <div class="row">
              <table class="table table-striped">
                <thead>
                  <th colspan="2">Comprador</th>
                </thead>

                <tbody>
                  <tr>
                    <th class="col-sm-3">Nome</th>
                    <td><strong><?php echo $order->buyer->name; ?></strong></td>
                  </tr>

                  <tr>
                    <th class="col-sm-3">Meli ID</th>
                    <td><?php echo $order->buyer->meli_id; ?></td>
                  </tr>

                  <tr>
                    <th class="col-sm-3">Nickname</th>
                    <td><?php echo $order->buyer->nickname; ?></td>
                  </tr>

                  <tr>
                    <th class="col-sm-3">Fone</th>
                    <td><?php echo $order->buyer->phone; ?></td>
                  </tr>

                  <tr>
                    <th class="col-sm-3">Fone alternativo</th>
                    <td><?php echo $order->buyer->alternative_phone; ?></td>
                  </tr>

                  <tr>
                    <th class="col-sm-3">Billing doc type</th>
                    <td><?php echo $order->buyer->billing_doc_type; ?></td>
                  </tr>

                  <tr>
                    <th class="col-sm-3">Billing doc number</th>
                    <td><?php echo $order->buyer->billing_doc_number; ?></td>
                  </tr>
                </tbody>

              </table>
            </div>

            <div class="row">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th colspan="2">Pagamento</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th class="col-sm-2">Status</th>
                    <td><?php echo $order->payment->status; ?></td>
                  </tr>

                  <tr>
                    <th class="col-sm-2">Detalhe do status</th>
                    <td><?php echo $order->payment->status_detail; ?></td>
                  </tr>

                  <tr>
                    <th class="col-sm-2">Valor Transação</th>
                    <td><?php echo $order->payment->transaction_amount; ?></td>
                  </tr>

                  <tr>
                    <th class="col-sm-2">Valor Envio</th>
                    <td><?php echo $order->payment->shipping_cost; ?></td>
                  </tr>

                  <tr>
                    <th class="col-sm-2">Valor do Cupom</th>
                    <td><?php echo $order->payment->coupon_amount; ?></td>
                  </tr>

                  <tr>
                    <th class="col-sm-2">Valor pago a mais</th>
                    <td><?php echo $order->payment->overpaid_amount; ?></td>
                  </tr>

                  <tr>
                    <th class="col-sm-2">Total pago</th>
                    <td><?php echo $order->payment->total_payment_amount; ?></td>
                  </tr>
                </tbody>
              </table>
            </div>

          </div>
        </div>
    </div>

    <!-- Page wide horizontal line -->
    <hr class="no-grid-gutter-h grid-gutter-margin-b no-margin-t">

  </div> <!-- / #content-wrapper -->
  
<?php include('footer.php'); ?>