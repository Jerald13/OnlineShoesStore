<?php

namespace App\Http\Controllers;

use App\Http\Controllers\RepositoryPattern\ProductInterface;
use App\Http\Controllers\RepositoryPattern\ProductRepository;
use App\Models\User;
use App\Models\Product;

use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use SimpleXMLElement;
use XSLTProcessor;

class ProductController extends Controller
{
    private ProductInterface $productRepository;
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function store(){
        if(auth()->user()== null) {
            return redirect()->route('usernamelogin');
        }
        $products = $this->productRepository->getAvailableProduct();
        return view('index', compact('products'));
    }

    public function productList(){
        if(auth()->user()->getAttribute("isAdmin") != 1) {
            return redirect()->route('usernamelogin');
        }
        $products = $this->productRepository->getAllProduct();
        return view('products', compact('products'));
    }

    public function createProductForm(Request $request){
        if(auth()->user()->getAttribute("isAdmin") != 1) {
            return redirect()->route('usernamelogin');
        }
        return view('createproduct');
    }

    public function importProductForm(){
        if(auth()->user()->getAttribute("isAdmin") != 1) {
            return redirect()->route('usernamelogin');
        }
        return view('importproduct');
    }

    public function editProductForm($id){
        if(auth()->user()->getAttribute("isAdmin") != 1) {
            return redirect()->route('usernamelogin');
        }
        $product = $this->productRepository->getProductbyId($id);
        return view('editproduct', compact('product'));
    }

    public function createProduct(Request $request){

        if(auth()->user()->getAttribute("isAdmin") != 1) {
            return redirect()->route('usernamelogin');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:0',
            'price' =>'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:0',
            'file' => 'required|file|mimes:jpeg,png,bmp,gif,svg|image',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $productName = $request->input('name');
        $price = $request->input('price');
        $quantity = $request->input('quantity');

        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('/img/'), $imageName);
        $imagePath = "/img/" . $imageName;

        $this->productRepository->createProduct($productName, $price, $quantity, $imagePath);

        return redirect()->route('productList');
    }

    public function editProduct(Request $request){

        if(auth()->user()->getAttribute("isAdmin") != 1) {
            return redirect()->route('usernamelogin');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:0',
            'price' =>'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:0'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $productName = $request->input('name');
        $price = $request->input('price');
        $quantity = $request->input('quantity');
        $id = $request->input('id');

        $this->productRepository->editProductDetails($productName, $price, $quantity, $id);

        return redirect()->route("productList");
    }

    public function displayImportedProduct(Request $request){
        if(auth()->user()->getAttribute("isAdmin") != 1) {
            return redirect()->route('usernamelogin');
        }

        $file = $request->file('file');

        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimetypes:text/xml,application/xml',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $xmlDoc = new DOMDocument();
        $xmlDoc->load($file);

        $xsl = new DOMDocument();
        $xsl->load(public_path('xsl/product.xsl'));

        $processor = new XSLTProcessor();
        $processor->importStylesheet($xsl);
        $transformedXml = $processor->transformToXml($xmlDoc);

        // Load the transformed XML string as a DOMDocument
        $transformedDoc = new DOMDocument();
        $transformedDoc->loadXML($transformedXml);

        return view('confirmimportproduct')->with([
            'originalXml' => $xmlDoc->saveXML(),
            'transformedXml' => $transformedXml,
        ]);
    }


//     public function importProductsFromXml(Request $request)
// {
//     if(auth()->user()->isAdmin != 1) {
//         return redirect()->route('usernamelogin');
//     }

//     $xmlFile = $request->file("xmlFile");
//     $xmlString = file_get_contents($xmlFile);
//     $xml = new \SimpleXMLElement($xmlString);

//     foreach ($xml->product as $productData) {
//         $product = new Product();
//         $product->name = (string) $productData->name;
//         $product->price = (float) $productData->price;
//         $product->quantity = (int) $productData->quantity;
//         $product->save();


//         $name = (string) $productData->name;
//         $price = (double)$productData->price;
//         $quantity = (int) $productData->quantity;
        
//         $validator = Validator::make([
//             "bookName" => $name,
//             "quantity" => $quantity,
//             "price" => $price,
//         ], [
//             'bookName' => 'required|string|max:255',
//             'quantity' => 'required|numeric|min:0',
//             'price' =>'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:0'
//         ]);

//         if ($validator->fails()) {
//             dd($validator->errors()->all());
//             continue;
//         }
//     }

//     return redirect()->route('productList');

// }


    public function importProduct(Request $request){
        if(auth()->user()->isAdmin != 1) {
            return redirect()->route('usernamelogin');
        }

        $xml = new SimpleXMLElement($request->input('importXml'));
        foreach ($xml->children() as $child) {
            $name = (string) $child->name;
            $price = (double)$child->price;
            $quantity = (int) $child->quantity;



            $validator = Validator::make([
                "bookName" => $name,
                "quantity" => $quantity,
                "price" => $price,
            ], [
                'bookName' => 'required|string|max:255',
                'quantity' => 'required|numeric|min:0',
                'price' =>'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:0'
            ]);

            if ($validator->fails()) {
                dd($validator->errors()->all());
                continue;
            }

            $this->productRepository->importProduct($name, $price, $quantity);
        }
        return redirect()->route('productList');
    }
}
