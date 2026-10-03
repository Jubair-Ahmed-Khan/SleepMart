<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductImageController extends Controller
{
    public function index(Product $product): View
    {
        $product->load([
            'images' => function ($query) {
                $query
                    ->orderByDesc('is_primary')
                    ->orderBy('sort_order')
                    ->orderBy('id');
            },
        ]);

        return view(
            'admin.products.images.index',
            compact('product')
        );
    }

    public function store(
        Request $request,
        Product $product
    ): RedirectResponse {
        $request->validate([
            'images' => [
                'required',
                'array',
                'min:1',
                'max:10',
            ],
            'images.*' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],
        ]);

        $hasPrimaryImage = $product->images()
            ->where('is_primary', true)
            ->exists();

        foreach ($request->file('images') as $index => $image) {

            $path = $image->store(
                'products/' . $product->id,
                'public'
            );

            $isPrimary =
                !$hasPrimaryImage &&
                $index === 0;

            ProductImage::create([
                'product_id' => $product->id,
                'image' => $path,
                'is_primary' => $isPrimary,
                'sort_order' => $product->images()->max('sort_order') + $index + 1,
            ]);

            if ($isPrimary) {
                $hasPrimaryImage = true;
            }
        }

        return back()->with(
            'success',
            'Product images uploaded successfully.'
        );
    }

    public function primary(
        Product $product,
        ProductImage $image
    ): RedirectResponse {
        abort_unless(
            $image->product_id === $product->id,
            404
        );

        DB::transaction(function () use ($product, $image) {

            $product->images()
                ->update([
                    'is_primary' => false,
                ]);

            $image->update([
                'is_primary' => true,
            ]);
        });

        return back()->with(
            'success',
            'Primary image updated successfully.'
        );
    }

    public function updateOrder(
        Request $request,
        Product $product
    ): RedirectResponse {
        $request->validate([
            'sort_order' => [
                'required',
                'array',
            ],
            'sort_order.*' => [
                'required',
                'integer',
                'min:0',
            ],
        ]);

        foreach ($request->sort_order as $imageId => $sortOrder) {

            ProductImage::query()
                ->where('id', $imageId)
                ->where('product_id', $product->id)
                ->update([
                    'sort_order' => $sortOrder,
                ]);
        }

        return back()->with(
            'success',
            'Image order updated successfully.'
        );
    }

    public function destroy(
        Product $product,
        ProductImage $image
    ): RedirectResponse {
        abort_unless(
            $image->product_id === $product->id,
            404
        );

        $wasPrimary = $image->is_primary;

        Storage::disk('public')->delete(
            $image->image
        );

        $image->delete();

        if ($wasPrimary) {

            $nextImage = $product->images()
                ->orderBy('sort_order')
                ->orderBy('id')
                ->first();

            if ($nextImage) {
                $nextImage->update([
                    'is_primary' => true,
                ]);
            }
        }

        return back()->with(
            'success',
            'Product image deleted successfully.'
        );
    }
}