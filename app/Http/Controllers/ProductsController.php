<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Category;
use App\Models\ApiMeli;

class ProductsController extends Controller
{
  protected $meli;

  public function __construct() 
  {
    $this->meli = new ApiMeli();
  }
  
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $data['products'] = Product::all();

    return view('list-products',$data);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $data['categories'] = Category::all();

    return view('add-products',$data);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  Request  $request
   * @return Response
   */
  public function store(Request $request)
  {
    $data = $request->all();

    $product = new Product;
      $product->title         = $data['title'];
      $product->category_id   = $data['category_id'];
      $product->price         = $data['price'];
      $product->quantity      = $data['quantity'];
      $product->description   = $data['description'];
      $product->video_id      = $data['video_id'];
      $product->warranty      = $data['warranty'];
    $product->save();

    return redirect('product/'.$product->id);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    $data['product'] = Product::find($id);
    
    return view('product',$data);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    $data['product'] = Product::find($id);
    $data['categories'] = Category::all();

    return view('edit-products',$data);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  Request  $request
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, $id)
  {
    $data = $request->all();

    $product = Product::find($id);
      $product->title         = $data['title'];
      $product->category_id   = $data['category_id'];
      $product->price         = $data['price'];
      $product->quantity      = $data['quantity'];
      $product->description   = $data['description'];
      $product->video_id      = $data['video_id'];
      $product->warranty      = $data['warranty'];
    $product->save();

    return redirect('product/'.$product->id);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
      //
  }

  public function listStock()
  {
    $data['products'] = Product::all();

    return view('stock',$data);
  }

  public function publish($id)
  {

    $product = Product::where('id',$id)->first();

    if ($product->listed == null) {
      $this->meli->publish($product);

    } elseif ($product->listed->status == 'closed')
    {
      $this->meli->relist($product);

    } elseif ($product->lited->status == 'paused')
    {
      $this->meli->updateStatus($product,'active');
    }

    return redirect('/product')->with(['message' => 'produto(s) publicado(s) com sucesso!']);
  }

  public function updateStatus($id,$status = 'closed')
  {
    $product = Product::where('id',$id)->first();

    $this->meli->updateStatus($product,$status);

    return redirect('/product/'.$product->id)->with(['message' => 'produto atualizado com sucesso!']);
  }

  public function relistProduct($id)
  {
    $product = Product::where('id',$id)->first();

    $this->meli->relist($product);

    return redirect('/product/'.$product->id)->with(['message' => 'produto atualizado com sucesso!']);
  }
}
