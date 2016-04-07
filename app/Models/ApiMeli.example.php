<?php
 
namespace App\Models;
 
use Session;
use App\Helpers\Meli;
 
use App\Models\Listed;    
use App\Models\Question;  
use App\Models\User;      
use App\Models\MeliAccess;
use App\Models\Order;      
use App\Models\Payment;    
use App\Models\Buyer;      
 
 
use Auth;
use Log;
 
class ApiMeli
{
  protected $meliSdk;
 
  /**
    Instancia o SDK fornecendo APP_ID e APP_SECRET cadastrados no .env
  **/
 
  public function __construct()
  {
    $this->meliSdk = new Meli(env('APP_ID'), env('APP_SECRET'));
  }
 
  /**
     Identifica o CustId do usuário do sistema, através de um $user fornecido ou da sessão.
     Verifica a validade do access_token, se necessário realiza o fluxo de refresh token e retorna um access_token válido
  **/
 
  private static function token($user = null)
  {
    if(!$user) {
      $user = Auth::user();
    }
 
    $MeliAccesses = MeliAccess::where(['cust_id' => $user->MeliAccess->cust_id])->first();
 
    if(strtotime($MeliAccesses->expires_in) < time())
    {
      $auth = $this->meliSdk->refreshAccessToken();
 
      $access_token = $auth['body']->access_token;
       
      $MeliAccesses->access_token   = $access_token;
      $MeliAccesses->refresh_token  = $auth['body']->refresh_token;
      $MeliAccesses->expires_in     = date('Y-m-d H:i:s', time() + $auth['body']->expires_in);
      $MeliAccesses->save();
 
    } else {
      $access_token = $MeliAccesses->access_token;
    }
 
    return $MeliAccesses->access_token;
  }
 
  /**
    Retorna a url para que o usuário do MeLi possa autorizar a aplicação
  **/
 
  public function authorize()
  {
    $redirectUrl = $this->meliSdk->getAuthUrl(env('BASE_URL').'/callback');
 
    return $redirectUrl;
  }
 
  /**
    Recebe o $code de autorização da aplicação, verifica se já existe uma autorização para a aplicação, se positivo, atualiza os dados, se negativo insere uma nova linha no DB.
  **/
 
  public function authorizeReturn($code)
  {
    $auth = $this->meliSdk->authorize($code, env('BASE_URL').'/callback');
 
    $userInfo = $this->meliSdk->get('/users/me', array('access_token' => $auth['body']->access_token));
 
    $MeliAccesses = MeliAccess::firstOrNew(['cust_id' => $userInfo['body']->id]);
      $MeliAccesses->access_token   = $auth['body']->access_token;
      $MeliAccesses->refresh_token  = $auth['body']->refresh_token;
      $MeliAccesses->cust_id        = $userInfo['body']->id;
      $MeliAccesses->expires_in     = date('Y-m-d H:i:s', time() + $auth['body']->expires_in);
    $MeliAccesses->save();
 
    Session::put(['cust_id' => $userInfo['body']->id]);
 
    return $userInfo;
  }
 
  /**
    Recebe os dados de um produto e o publica no MercadoLivre, se publicado, salva os dados da publicação na tabela Listed
  **/
 
  public function publish($product)
  {
    $item = ApiMeli::organize($product);
 
    $post = $this->meliSdk->post('/items', $item, array('access_token' => ApiMeli::token()));
 
    if ($post['httpCode'] == 201)
    {
      $post = $post['body'];
 
      //save it on database
      $listed = new Listed();
        $listed->product_id       = $product->id;
        $listed->meli_id          = $post->id;
        $listed->category_id      = $post->category_id;
        $listed->buying_mode      = $post->buying_mode;
        $listed->listing_type_id  = $post->listing_type_id;
        $listed->start_time       = $post->start_time;
        $listed->stop_time        = $post->stop_time;
        $listed->end_time         = $post->end_time;
        $listed->permalink        = $post->permalink;
        $listed->status           = $post->status;
      $listed->save();
 
      return true;
    } else {
      Log::error($post);
 
      return false;
    }
  }
 
  /**
    Recebe um objeto com os dados do produto e o organiza, transformando em um array que será usado pelo SDK para publicar o produto
  **/
 
  private static function organize($product)
  {
    $output = [
      'title'               => $product->title,
      'category_id'         => $product->category->category_meli,
      'price'               => $product->price,
      'currency_id'         => 'BRL',
      'available_quantity'  => '1',
      'buying_mode'         => 'buy_it_now',
      'listing_type_id'     => 'silver',
      'condition'           => 'new',
      'description'         => $product->description,
      'video_id'            => $product->video_id,
      'warranty'            => '12 months by manufacturer',
      'pictures'            => [
      ],
 
    ];
 
    return $output;
  }
 
  /**
    Recebe um objeto com os dados do produto e uma string com o novo status. Atualiza o status no MeLi, e a tabela Listed
  **/
 
  public function updateStatus($product,$status)
  {
    $body = ['status' => $status];
 
    $updatedStatus = $this->meliSdk->put('/items/'.$product->listed->meli_id, $body, array('access_token' => ApiMeli::token()));
 
    //update listed status
    $newStatus = $updatedStatus['body'];
    if ($updatedStatus['httpCode'] == '200')
    {
      $newStatus = $newStatus->status;
      $updateListed = Listed::where('product_id',$product->id)->update(['status' => $newStatus]);
 
      return true;
    } else {
      Log::error($newStatus);
 
      return false;
    }
  }
 
  /**
    Recebe um objeto com os dados do produto, faz o reslisting no MeLi e atualiza a tabela Listed
  **/
 
  public function relist($product)
  {    
    $body = [
      'price'           => (float)$product->price,
      'quantity'        => 1,
      'listing_type_id' => 'free',
    ];
 
    $updatedStatus = $this->meliSdk->post('/items/'.$product->listed->meli_id .'/relist', $body, array('access_token' => ApiMeli::token()));
 
    //update listed status
    $relisted = $updatedStatus['body'];
 
    if ($updatedStatus['httpCode'] == 200)
    {
      ApiMeli::update($relisted,$product->id);
 
      return true;
    } else {
      Log::error($updatedStatus);
 
      return false;
    }
  }
 
  /**
    Atualiza dados do produto na tabela Listed
  **/
 
  public function update($data,$id)
  {
    $update = Listed::where('product_id',$id)
              ->update([
                'status'      => $data->status,
                'meli_id'     => $data->id,
                'category_id' => $data->category_id,
                'permalink'   => $data->permalink
                ]);
  }
 
  /**
    Recebe o $id da pergunta e publica a resposta no MercadoLivre
    Atualiza o status da pergunta no DB de acordo com o retorno da API
  **/
 
  public function pushAnswer($id)
  {    
    $question = Question::find($id);
 
    $body = [
      'question_id' => $question->meli_id,
      'text'        => $question->answer
    ];
 
    $updatedStatus = $this->meliSdk->post('/answers/', $body, array('access_token' => ApiMeli::token()));
 
    if ($updatedStatus['httpCode'] ==  200)
    {
      $updated = $updatedStatus['body'];
 
      $question->status = $updated->status;
      $question->save();
 
      return true;
    } else {
      Log::error($updatedStatus);
 
      return false;
    }
  }
 
  /**
    Recebe o $id da pergunta, recupera do banco de dados a pergunta "deletada" (softDelete) e dispara para o SDK a requisição para deletar a pergunta no MeLi
  **/
 
  public function deleteQuestion($id)
  {    
    $question = Question::where('id',$id)->withTrashed()->first();
 
    $delete = $this->meliSdk->delete('/questions/'.$question->meli_id, array('access_token' => ApiMeli::token()));
 
    if ($delete['httpCode'] == 200)
    {
      return true;
    } else {
      Log::error($delete);
      return false;
    }
  }
 
  /**
    Recebe os dados da notificação de question, busca as informações através da API, e salva a pergunta no banco de dados.
    Se a pergunta já existir no banco, apenas atualiza os dados
  **/
 
  public function gotQuestion($data)
  {
    $questionReturn = $this->meliSdk->get($data->resource);
   
    if ($questionReturn['httpCode'] == '200'){
      $question = $questionReturn['body'];
 
      if (!($itemId = Listed::getIdFromMeliId($question->item_id)))
      {
        return false;
      }
 
      $saveQuestion = Question::firstOrNew(['meli_id' => $question->id]);
        $saveQuestion->product_id       = $itemId;
        $saveQuestion->meli_id          = $question->id;
        $saveQuestion->product_meli_id  = $question->item_id;
        $saveQuestion->status           = $question->status;
        $saveQuestion->text             = $question->text;
      $saveQuestion->save();
 
      return true;
    } else {
      Log::error($questionReturn);
      return false;
    }
 
  }
 
  /**
    Recebe os dados da notificação de items, busca as informações através da API e atualiza as informações do produto no banco de dados
  **/
 
  public function gotItem($data)
  {
    $user = MeliAccess::where('cust_id', $data->user_id)->first()->user;
   
    $itemReturn = $this->meliSdk->get($data->resource, array('access_token' => ApiMeli::token($user)));
       
    if ($itemReturn['httpCode'] == '200'){
      $listed = $itemReturn['body'];
 
      if($listedItem = Listed::where('meli_id', $listed->id)->first()) {
        $listedItem->status           = $listed->status;
        $listedItem->listing_type_id  = $listed->listing_type_id;
        $listedItem->end_time         = $listed->end_time;
        $listedItem->save();
      }
 
      return true;
    } else {
      Log::error($itemReturn);
      return false;
    }    
  }
 
  /**
    Recebe os dados da notificação de order, recupera as informações através da API e insere os dados no banco de dados. Caso a order já esteja no banco, atualiza as informações
  **/
 
  public function gotOrder($data)
  {
    $user = MeliAccess::where('cust_id', $data->user_id)->first()->user;
 
    $orderData = $this->meliSdk->get($data->resource,array('access_token' => ApiMeli::token($user)));
 
    if ($orderData['httpCode'] == 200)
    {
      $order = $orderData['body'];
 
      //get product details from order
      $product = $order->order_items[0]->item;
 
      if (!($itemId = Listed::getIdFromMeliId($product->id)))
      {
        return false;
      }
 
      $newOrder = Order::firstOrNew(['meli_id' => $order->id]);
        $newOrder->meli_id        = $order->id;
        $newOrder->status         = $order->status;
        $newOrder->status_detail  = $order->status_detail;
        $newOrder->product_id     = $itemId;
        $newOrder->total_amount   = $order->total_amount;
        $newOrder->currency       = $order->currency_id;
      if($newOrder->save())
      {
        $buyer = ApiMeli::saveBuyer($order);
 
        $payment = ApiMeli::savePayment($order,$buyer->id);
 
        $updateOrder = Order::find($newOrder->id);
          $updateOrder->payment_id  = $payment->id;
          $updateOrder->buyer_id    = $buyer->id;
        $updateOrder->save();
      };
 
    } else {
      Log::error($orderData);
      return false;
    }
  }
 
  /**
    Salva os dados do comprador presente na notificação de orders
  **/
 
  public static function saveBuyer($order)
  {
    $buyer = $order->buyer;
 
    $newBuyer = Buyer::firstOrNew(['meli_id' => $buyer->id]);
      $newBuyer->meli_id            = $buyer->id;
      $newBuyer->nickname           = $buyer->nickname;
      $newBuyer->phone              = $buyer->phone->number;
      $newBuyer->alternative_phone  = $buyer->alternative_phone->number;
      $newBuyer->first_name         = $buyer->first_name;
      $newBuyer->last_name          = $buyer->last_name;
      $newBuyer->billing_doc_type   = $buyer->billing_info->doc_type;
      $newBuyer->billing_doc_number = $buyer->billing_info->doc_number;
 
    if ($newBuyer->save())
    {
      return $newBuyer;
    }
 
    return false;
  }
 
  /**
    Salva os dados do pagamento presente na notifação de order
  **/
 
  public static function savePayment($order,$buyer)
  {
    $payment = $order->payments[0];
 
    $newPayment = Payment::firstOrNew(['meli_id' => $payment->id]);
      $newPayment->order_id             = $order->id;
      $newPayment->payer_id             = $buyer;
      $newPayment->collector_id         = $payment->collector->id;
      $newPayment->card_id              = $payment->card_id;
      $newPayment->site_id              = $payment->site_id;
      $newPayment->reason               = $payment->reason;
      $newPayment->payment_method_id    = $payment->payment_method_id;
      $newPayment->currency_id          = $payment->currency_id;
      $newPayment->installments         = $payment->installments;
      $newPayment->status               = $payment->status;
      $newPayment->status_code          = $payment->status_code;
      $newPayment->status_detail        = $payment->status_detail;
      $newPayment->transaction_amount   = $payment->transaction_amount;
      $newPayment->shipping_cost        = $payment->shipping_cost;
      $newPayment->coupon_amount        = $payment->coupon_amount;
      $newPayment->overpaid_amount      = $payment->overpaid_amount;
      $newPayment->total_payment_amount = $payment->total_paid_amount;
 
    if($newPayment->save())
    {
      return $newPayment;
    }
 
    return false;
  }
 
 
}