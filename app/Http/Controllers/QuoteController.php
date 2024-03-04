<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\BenefitGroup;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class QuoteController extends Controller
{
    public function create() {
        return inertia('Quote/Create');
    }

    public function store(Request $request)
    {
        $form = $request->all();
        session(['form' => $form]);

        $ages = collect($form['travelers'])->pluck('birthday')
            ->map(fn($birthday) => Carbon::parse($birthday)->diffInYears(Carbon::now()))
            ->sort();

        if($form['coverage_type'] == 'comprehensive'){
            $youngest = $ages->first();
            $days = Carbon::parse($form['first_paid_at'])->diffInYears(Carbon::now());
            if($youngest > 79 && $days < 22){
                $products = Product::find([1, 2]);
            } else {
                $products = Product::find([1, 3]);
            }
            $res = Http::pool(fn (Pool $pool) => [
                $products->map(fn ($product) =>  $product->getPriceFromApi($form, $pool))
            ]);
    
            $products->map(fn($product, $key) => $product->quote = $product->processRes($res[$key]));
        } else {
            $oldest = $ages->last();
            if(($oldest > 95 && $oldest < 100) || $form['departed']){
                $product = Product::find(4);
            }else{
                if($form['primary_health']){
                    $product = Product::find(5);
                } else {
                    $product = Product::find(6);
                }
            }
            $product->quote = $product->getPriceFromApi($form);
            $products = [$product];
        }

        session(['products' => $products]);

        return redirect()->route('quote.index');
    }

    public function index(Request $request)
    {
        $products = session('products');

        if (!$products) {
            return redirect()->route('quote.create');
        }

        return inertia('Quote/Index', [
            'benefit_groups' => BenefitGroup::all(),
            'products' => $products,
        ]);
    }

    public function show($id)
    {
        $products = session('products');

        if (!$products) {
            return redirect()->route('quote.create');
        }

        return inertia('Quote/Show', [
            'benefit_groups' => BenefitGroup::all(),
            'product' => $products[$id],
            'id' => $id
        ]);
    }

    public function price(Product $product, Request $request)
    {
        $price = $product->getPriceFromApi($request->all());
        return response()->json($price);
    }

    public function checkout($id)
    {
        $products = session('products');
        
        if (!$products) {
            return redirect()->route('quote.create');
        }

        return inertia('Quote/Checkout', ['product' => $products[$id], 'id' => $id]);
    }

    public function purchase(Request $request, $id)
    {
        $form = $request['form'];
        $cpform = $request['cpform'];
        $premium = $request['premium'];

        $p = session('products')[$id];
        $product = Product::find($p->id);

        $res = $product->purchase($form, $cpform, $premium);
        dd($res);

        return redirect()->back();
    }
}
