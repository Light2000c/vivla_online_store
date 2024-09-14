<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class EditProduct extends Component
{

    use WithFileUploads;
    private $product;
    public $id;

    public $name;
    public $price;
    public $quantity;
    public $discount;
    public $brand;
    public $tag = "";
    public $category = "";
    public $image;
    public $description;
    public $busy = false;
    public $message = "";
    public $display_image;
    public $categories;
    public $selectedItems = [];
    public $category_error;

    public $rules = [];

    public function mount($id)
    {
        $this->id = $id;
        $this->load();
        $this->product = Product::find($id);
        $this->setData();
    }


    public function render()
    {
        return view('livewire.admin.edit-product', [
            "product" => $this->product,
        ])->layout("layouts.admin.app");
    }

    public function load()
    {
        $this->categories = Category::get();
    }

    public function reload()
    {
        $product = Product::find($this->id);

        $this->product = $product;
        $this->setData();
        $this->image = null;
    }

    public function setData()
    {
        $this->name = $this->product->name;
        $this->price = $this->product->price;
        $this->quantity = $this->product->quantity;
        $this->discount =  $this->product->discount;
        $this->brand = $this->product->brand;
        $this->tag = $this->product->tag;
        $this->category = $this->product->category;
        $this->description = $this->product->description;
        $this->display_image = $this->product->image;

        $this->setSelectedItems($this->category);
    }

    public function update()
    {

        $this->category_error = "";

        $product = Product::find($this->id);

        if (!$product) {
            return  $this->showAlert("Error", "No product was found with ID" . $this->id, "error");
        }

        if ($this->image) {
            $this->validate([
                "name" => $product->name === $this->name ? "required" : "required|unique:products,name",
                "price" => "required|numeric|min:0",
                "quantity" => "required|numeric|min:0",
                "category" => "required",
                "image" => "required|mimes:jpeg,jpg,png,webp,jfif",
                "description" => "required",
            ]);

            if (empty($this->selectedItems)) {
                return $this->addError("category_error", "Please select product categories");
            }

            // dd($this->selectedItems);

            $this->category = $this->getSelectedCategories();

            // dd($this->category);


            $file_name = time() . '-' . $this->name . '.' . $this->image->guessExtension();

            $upload = $this->image->storeAs('products', $file_name, 'public');

            if (!$upload) {
                return $this->addError("message", "An error occurred while trying to upload product image, please try again!.");
            }

            $update = $product->update([
                "name" => $this->name,
                "price" => (int) $this->price,
                "discount" =>  (int) $this->discount,
                "quantity" => (int) $this->quantity,
                "brand" => $this->brand,
                "category" => $this->category,
                "tag" => $this->tag,
                "image" => $file_name,
                "description" => $this->description,
            ]);

            if (!$update) {
                return  $this->addError("message", "Product was not successfully updated!");
            }

            $this->reload();
            return $this->showAlert("Success", "Product has been successfully updated", "success");
        } else {
            $this->validate([
                "name" => $product->name === $this->name ? "required" : "required|unique:products,name",
                "price" => "required|numeric|min:0",
                "quantity" => "required|numeric|min:0",
                "category" => "required",
                "description" => "required",
            ]);

            if (empty($this->selectedItems)) {
                return $this->addError("category_error", "Please select product categories");
            }

            // dd($this->selectedItems);

            $this->category = $this->getSelectedCategories();

            // dd($this->category);



            $update = $product->update([
                "name" => $this->name,
                "price" => (int) $this->price,
                "discount" =>  (int) $this->discount,
                "quantity" => (int) $this->quantity,
                "brand" => $this->brand,
                "category" => $this->category,
                "tag" => $this->tag,
                "description" => $this->description,
            ]);

            if (!$update) {
                return  $this->addError("message", "Product was not successfully updated!");
            }

            $this->reload();
            return $this->showAlert("Success", "Product has been successfully updated", "success");
        }
    }

    public function getSelectedCategories()
    {
        $category = "";

        foreach ($this->selectedItems as $index => $item) {
            if ($category === "") {
                $category = $item;
            } else {
                $category = $category . ',' . $item;
            }
        }

        return $category;
    }

    public function setSelectedItems($categories)
    {

        $storedCategories = $categories; // Example string from the database.

        // Split the string into an array.
        $this->selectedItems = explode(',', $storedCategories);

        // dd($this->selectedItems);
    }


    public function showAlert($title, $text, $icon)
    {

        return $this->dispatch(
            "message",
            title: $title,
            text: $text,
            icon: $icon,
            redirectUrl: url('/admin/products')
        );
    }
}
