<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use App\Models\ProductImage;
use Livewire\Component;
use App\Models\ProductSize;
use App\Models\Size;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ProductItems extends Component
{
    use WithFileUploads;

    public $id;
    public $size_id;
    public $quantity;
    public $image;
    public $product_sizes = [];
    public $product_images = [];
    public $sizes;
    public $product;
    public $groupSelect;
    public $selectedSizeItems = [];
    public $selectedImageItems = [];

    public $search = "";

    public function mount($id)
    {
        $this->id = $id;
        $this->load();
    }

    public function render()
    {
        return view('livewire.admin.product-items')->layout("layouts.admin.app");
    }

    public function load()
    {

        $this->product = Product::find($this->id);

        $this->product_sizes = $this->product->size()->orderBy("created_at", "DESC")->get();

        $this->sizes = Size::orderBy("created_at", "DESC")->get();

        $this->product_images = $this->product->image()->orderBy("created_at", "DESC")->get();

        // if (!$this->search) {
        //     $this->sizes = ModelsSize::orderBy("created_at", "DESC")->paginate(10);
        // } else {
        //     $this->sizes = ModelsSize::orderBy("created_at", "DESC")
        //         ->where("name", "LIKE", '%' . $this->search . '%')
        //         ->paginate(10);
        // }
    }

    public function openSizeModal()
    {
        $this->resetValues();

        return  $this->dispatch("openSizeModal");
    }

    public function openImageModal()
    {
        $this->resetValues();

        return  $this->dispatch("openImageModal");
    }

    public function resetValues()
    {
        $this->size_id = "";
        $this->quantity = "";
    }

    public function resetSelectSizeItem()
    {
        $this->selectedSizeItems = [];
    }

    public function resetSelectImageItem()
    {
        $this->selectedImageItems = [];
    }

    public function saveSize()
    {

        $validated = $this->validate([
            "size_id" => "required",
            "quantity" => "required|numeric",
        ], [
            "size_id.required" => "The size field is required"
        ]);

        try {

            if ($this->product->size->contains("size_id", $validated["size_id"])) {
                return $this->showToast("error", "Size already exist");
            }

            $new_size = $this->product->size()->create($validated);

            if ($new_size) {
                $this->load();
                return $this->showToast("success", "Size has been added to product.");
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
            return $this->showToast("error", "Something went wrong, size was not successfully added");
        }
    }

    public function deleteSize($id)
    {

        try {

            $size = ProductSize::find($id);

            if (!$size) {
                return $this->showToast("error", "Size was not successfully found");
            }

            $deleted = $size->delete();

            if (!$deleted) {
                return $this->showToast("error", "Size was not successfully deleted");
            }

            $this->load();
            return $this->showToast("success", "Size has been deleted");
        } catch (\Exception $e) {
            return $this->showToast("error", "Something went wrong, size was not successfully deleted");
        }
    }

    public function deleteSelectedSizes()
    {

        try {

            if (empty($this->selectedSizeItems)) {
                return $this->showToast("info", "you haven't selected any size yet!");
            }

            $delete = ProductSize::whereIn("id", $this->selectedSizeItems)->delete();

            if (!$delete) {
                return $this->showToast("error", "Size was not successfully deleted");
            }

            $this->load();
            $this->resetSelectSizeItem();
            return $this->showToast("success", "Sizes has been deleted");
        } catch (\Exception $e) {
            return $this->showToast("error", "Something went wrong, sizes were not successfully deleted");
        }
    }


    public function saveImage()
    {

        $this->validate([
            "image" => "required|mimes:jpeg,jpg,png,webp,jfif"
        ]);

        try {

            if ($this->product->image()->count() >= 3) {
                return $this->showToast("error", "You caan onky add up to 3 images");
            }

            $file_name = time() . '-' . $this->product->name . '.' . $this->image->guessExtension();

            // dd($file_name);

            $upload = $this->image->storeAs('products', $file_name, 'public');

            if (!$upload) {
                $this->load();
                return $this->showToast("error", "Image was not successfully uploaded");
            }

            $saved = $this->product->image()->create([
                "image" => $file_name,
            ]);

            if ($saved) {
                $this->load();
                return $this->showToast("success", "Image has been successfully uploaded");
            }
        } catch (\Exception $e) {
            return $this->showToast("error", "Something went wrong, please try again");
        }
    }


    public function deleteImage($id)
    {

        try {

            $image = ProductImage::find($id);

            if (!$image) {
                return $this->showToast("error", "Image was not successfully found");
            }

            $deleted = $image->delete();

            if (!$deleted) {
                return $this->showToast("error", "Image was not successfully deleted");
            }

            $this->load();
            return $this->showToast("success", "Image has been deleted");
        } catch (\Exception $e) {
            return $this->showToast("error", "Something went wrong, image was not successfully deleted");
        }
    }

    public function deleteSelectedImages()
    {

        try {

            if (empty($this->selectedImageItems)) {
                return $this->showToast("info", "you haven't selected any image yet!");
            }

            $delete = ProductImage::whereIn("id", $this->selectedImageItems)->delete();

            if (!$delete) {
                return $this->showToast("error", "Image was not successfully deleted");
            }

            $this->load();
            $this->resetSelectImageItem();
            return $this->showToast("success", "Imgages has been deleted");
        } catch (\Exception $e) {
            return $this->showToast("error", "Something went wrong, images were not successfully deleted");
        }
    }


    public function showToast($icon, $title)
    {
        $this->dispatch(
            'message',
            icon: $icon,
            title: $title,
        );
    }
}
