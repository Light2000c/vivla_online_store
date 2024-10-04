<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class AddProducts extends Component
{
    use WithFileUploads;

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
    public $categories;
    public $selectedItems = [];
    public $category_error;


    public function render()
    {
        $this->load();

        return view('livewire.admin.add-products', [
            "categories" => $this->categories,
        ])->layout("layouts.admin.app");
    }

    public function load()
    {
        $this->categories = Category::get();
    }

    public function send()
    {
        $this->dispatch('syncCKEditorContent');


        $category_error = "";

        $this->message = null;

        $this->validate([
            "name" => "required|unique:products,name",
            "price" => "required|numeric|min:0",
            "quantity" => "required|numeric|min:0",
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

        $product = Product::create([
            "name" => $this->name,
            "price" => $this->price,
            "discount" => $this->discount,
            "quantity" => $this->quantity,
            "brand" => $this->brand,
            "category" => $this->category,
            "tag" => $this->tag,
            "image" => $file_name,
            "description" => $this->description,
        ]);

        if (!$product) {
            return  $this->addError("message", "Product was not successfully created!");
        }

        $this->resetValues();
        return $this->showAlert("Success", "Product has been successfully created", "success");
    }





    public function resetValues()
    {
        $this->reset();
        $this->resetValidation($this->name);
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


    public function setDescription($value)
    {
        $this->description = $value;
    }
}
