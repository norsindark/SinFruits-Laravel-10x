<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Redirect;
use App\Models\ProductWarehouse;

class ProductCrawlerController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.productCrawler', compact('products'));
    }

    public function crawl()
    {
        $baseURL = 'https://traicaytonyteo.com/trai-cay-hot?page=';
        $maxPages = 5;

        $client = new Client();

        for ($page = 1; $page <= $maxPages; $page++) {
            $url = $baseURL . $page;
            $response = $client->get($url);
            $html = $response->getBody()->getContents();
            $crawler = new Crawler($html);

            $products = $crawler->filter('.item.product-item');

            $products->each(function (Crawler $product) {
                $imageSrc = $product->filter('.img picture img')->attr('src');
                $productName = $product->filter('.title .heading a')->attr('title');
                $productHref = $product->filter('.title .heading a')->attr('href');

                $product = new Product([
                    'name' => $productName,
                    'title' => $productHref,
                    'category_id' => 1,
                ]);

                $product->save();

                // $this->crawlAndSaveImage($imageSrc, $product->id);

                $this->addToWarehouses($product->id, 100);
            });
        }
        return Redirect::route('dashboard.products.index');
    }

    private function addToWarehouses($productId, $quantity)
    {
        $productWarehouse = ProductWarehouse::where('product_id', $productId)->first();

        if (!$productWarehouse) {
            ProductWarehouse::create([
                'product_id' => $productId,
                'warehouse_id' => 1,
                'quantity' => $quantity,
            ]);
        } else {
            $productWarehouse->increment('quantity', $quantity);
        }
    }


    public function crawlDetail()
    {
        $baseURL = 'https://traicaytonyteo.com/';
        $client = new Client();
        $products = Product::all();

        foreach ($products as $product) {
            $productTitle = $product->title;
            $url = $baseURL . $productTitle;
            $response = $client->get($url);
            $html = $response->getBody()->getContents();
            $crawler = new Crawler($html);

            $description = $crawler->filter('.description p span')->count() > 0
                ? str_replace('Tony Tèo Fruit', 'SinFruit', $crawler->filter('.description p span')->text())
                : 'Trái cây sạch nhập khẩu, chỉ có tại SinFruit.';

            $priceText = $crawler->filter('#product-detail-price')->count() > 0
                ? $crawler->filter('#product-detail-price')->text()
                : null;

            $price = floatval(str_replace(['$', ','], '', $priceText));

            if ($price <= 0) {
                $price = 150000;
            }


            $existingProduct = Product::where('title', $productTitle)->first();

            if ($existingProduct) {
                $productDetails = $existingProduct->product_details()->updateOrCreate([], compact('description', 'price'));

                $imageUrls = $crawler->filter('.product-thumb img')->each(function (Crawler $node, $i) {
                    return $node->attr('src');
                });

                $this->crawlAndSaveImages($imageUrls, $existingProduct->id);
            }
        }

        return Redirect::route('dashboard.products.index');
    }

    public function crawlAndSaveImages(array $imageUrls, $productId)
    {
        $client = new Client();
        $images = [];

        foreach ($imageUrls as $imageUrl) {
            $imageContents = file_get_contents('https://traicaytonyteo.com/' . ltrim($imageUrl, '/'));
            $imageName = 'product_image_' . time() . '_' . uniqid() . '.jpg';
            $images[] = ['product_id' => $productId, 'image_path' => asset('storage/products/' . $imageName)];
            Storage::put('public/products/' . $imageName, $imageContents);
        }
        ProductImage::insert($images);
    }
}
