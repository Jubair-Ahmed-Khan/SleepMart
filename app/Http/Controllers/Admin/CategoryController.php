<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * List categories.
     */
    public function index(): View
    {
        $categories = Category::query()
            ->withCount('products')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(15);

        return view(
            'admin.categories.index',
            compact('categories')
        );
    }


    /**
     * Create form.
     */
    public function create(): View
    {
        $category = new Category();

        return view(
            'admin.categories.create',
            compact('category')
        );
    }


    /**
     * Store category.
     */
    public function store(
        Request $request
    ): RedirectResponse {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:categories,slug',
            ],

            'icon' => [
                'nullable',
                'string',
                'max:100',
            ],

            'description' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        $category = Category::create([
            'name' => $validated['name'],

            'slug' =>
                $validated['slug']
                ?: Str::slug($validated['name']),

            'icon' =>
                $validated['icon'] ?? null,

            'description' =>
                $validated['description'] ?? null,

            'sort_order' =>
                $validated['sort_order'] ?? 0,

            'is_active' =>
                $request->boolean('is_active'),
        ]);

        if ($request->hasFile('image')) {

            $path = $request
                ->file('image')
                ->store(
                    'categories',
                    'public'
                );

            $category->update([
                'image' => $path,
            ]);
        }

        return redirect()
            ->route('admin.categories.index')
            ->with(
                'success',
                'Category created successfully.'
            );
    }


    /**
     * Edit form.
     */
    public function edit(
        Category $category
    ): View {
        return view(
            'admin.categories.edit',
            compact('category')
        );
    }


    /**
     * Update category.
     */
    public function update(
        Request $request,
        Category $category
    ): RedirectResponse {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:categories,slug,' . $category->id,
            ],

            'icon' => [
                'nullable',
                'string',
                'max:100',
            ],

            'description' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        $category->update([
            'name' => $validated['name'],

            'slug' =>
                $validated['slug']
                ?: Str::slug($validated['name']),

            'icon' =>
                $validated['icon'] ?? null,

            'description' =>
                $validated['description'] ?? null,

            'sort_order' =>
                $validated['sort_order'] ?? 0,

            'is_active' =>
                $request->boolean('is_active'),
        ]);

        if ($request->hasFile('image')) {

            if ($category->image) {
                Storage::disk('public')
                    ->delete($category->image);
            }

            $path = $request
                ->file('image')
                ->store(
                    'categories',
                    'public'
                );

            $category->update([
                'image' => $path,
            ]);
        }

        return redirect()
            ->route('admin.categories.index')
            ->with(
                'success',
                'Category updated successfully.'
            );
    }


    /**
     * Deactivate category.
     */
    public function deactivate(
        Category $category
    ): RedirectResponse {
        $category->update([
            'is_active' => false,
        ]);

        return back()->with(
            'success',
            'Category has been deactivated.'
        );
    }


    /**
     * Activate category.
     */
    public function activate(
        Category $category
    ): RedirectResponse {
        $category->update([
            'is_active' => true,
        ]);

        return back()->with(
            'success',
            'Category has been activated.'
        );
    }


    /**
     * Delete category.
     *
     * If products exist, deactivate instead
     * of deleting the category.
     */
    public function destroy(
        Category $category
    ): RedirectResponse {
        if ($category->products()->exists()) {

            $category->update([
                'is_active' => false,
            ]);

            return back()->with(
                'warning',
                'Category has products, so it was deactivated instead of deleted.'
            );
        }

        if ($category->image) {
            Storage::disk('public')
                ->delete($category->image);
        }

        $category->delete();

        return back()->with(
            'success',
            'Category deleted successfully.'
        );
    }
}