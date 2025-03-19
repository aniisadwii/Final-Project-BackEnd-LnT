<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use App\Models\Item;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{   
    public function createPage()
    {
        return view('admin.create-item', [
            'title' => 'Create Item',
            'categories' => Category::all()
        ]);
    }

    public function viewItem()
    {
        $items = Item::with('category')->get();
        return view('item.catalog', ['title' => 'Item Catalog', 'items' => $items]);

    }
    

    public function createItem(ItemRequest $request)
    {
        $fileName = time() . '_' . str_replace(' ', '_', $request->name) . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->storeAs('public/images/', $fileName);

        Item::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'image' => $fileName
        ]);

        return redirect('/items')->with('success', 'Item successfully created!');
    }

    public function getItemById(Item $item) // Route Model Binding
    {
        return view('admin.update-item', [
            'title' => 'Update Item',
            'item' => $item,
            'categories' => Category::all()
        ]);
    }

    public function updateItem(ItemRequest $request, Item $item)
    {
        $validated = $request->validated();
        
        if ($request->hasFile('image')) {
            // Delete old image
            if ($item->image && Storage::exists('public/images/' . $item->image)) {
                Storage::delete('public/images/' . $item->image);
            }

            // Store new image
            $fileName = time() . '_' . str_replace(' ', '_', $request->name) . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('public/images/', $fileName);
            $item->image = $fileName;
        }

        $item->update([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id
        ]);

        return redirect('/items')->with('success', 'Item successfully updated!');
    }

    public function deleteItem(Item $item)
    {

        if ($item->image && Storage::exists('public/images/' . $item->image)) {
            Storage::delete('public/images/' . $item->image);
        }
    
        $item->delete();
        
        return redirect()->route('view')->with('success', 'Item successfully deleted!');
    }
}
