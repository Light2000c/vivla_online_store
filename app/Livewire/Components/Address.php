<?php

namespace App\Livewire\Components;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Address as ModelsAddress;

class Address extends Component
{

    private $addresses;
    public $firstname;
    public $lastname;
    public $email;
    public $phone;
    public $updatePhone;
    public $street;
    public $city;
    public $country;
    public $activeAddress;

    public function render()
    {
        $this->load();

        return view('livewire.components.address', [
            "addresses" => $this->addresses
        ]);
    }


    public function load()
    {
        $this->addresses = Auth::user()->address()->orderBy("created_at", "DESC")->get();
    }


    public function resetValues()
    {


        $this->firstname = "";
        $this->lastname = "";
        $this->email = "";
        $this->phone = "";
        $this->city = "";
        $this->street = "";
        $this->country = "";
    }


    public function openCreateModal()
    {

        $this->resetValues();

        $this->dispatch("openCreateModal");
    }

    public function openUpdateModal($id)
    {

        $this->resetValues();

        $address = ModelsAddress::find($id);

        if (!$address) {
            return;
        }

        $this->activeAddress = $address;

        $this->firstname = $address->firstname;
        $this->lastname = $address->lastname;
        $this->email = $address->email;
        $this->updatePhone = $address->phone;
        $this->street = $address->street;
        $this->city = $address->city;
        $this->country = $address->country;

        $this->dispatch("openUpdateModal");
    }


    public function send()
    {


        $validators = $this->validate([
            "firstname" => "required",
            "lastname" => "required",
            "email" => "required",
            "phone" => "required",
            "street" => "required",
            "city" => "required",
            "country" => "required",
        ]);



        $user = User::find(Auth::user()->id);

        $address = $user->address()->create($validators);

        if ($address) {
            $this->load();
            $this->dispatch("closeCreateModal");
            $this->showToast("success", "Address has been successfully added");
        }
    }

    public function update()
    {


        $address = ModelsAddress::find($this->activeAddress->id);

        if (!$address) {
            return;
        }

        $validated = $this->validate([
            "firstname" => "required",
            "lastname" => "required",
            "email" => "required",
            "updatePhone" => "required",
            "street" => "required",
            "city" => "required",
            "country" => "required",
        ]);


        if ($address && $address->user->is(Auth::user())) {

            $validated["phone"] = $this->updatePhone;

            unset($validated["updatePhone"]);


            $updated = $address->update($validated);

            if ($updated) {
                $this->load();
                $this->dispatch("closeUpdateModal");
                $this->showToast("success", "Address has been successfully updated");
            }
        }
    }


    public function delete($id)
    {

        $address = ModelsAddress::find($id);

        if (!$address) {
            return;
        }

        if ($address && $address->user->is(Auth::user())) {

            $deleted = $address->delete();

            if ($deleted) {
                $this->load();
                $this->showToast("success", "Address has been successfully deleted");
            }
        }
    }

    public function setAsDefault($id)
    {

        $address = ModelsAddress::find($id);

        if (!$address) {
            return;
        }

        if ($address->active === 1) {
            return;
        }

        $updated = ModelsAddress::where("user_id", Auth::user()->id)->update([
            "active" => 0,
        ]);

        if (!$updated) {
            $this->showToast("success", "Something went wrong, please try again.");
        }

        if ($address && $address->user->is(Auth::user())) {

            $default = $address->update([
                "active" => 1,
            ]);

            if ($default) {
                $this->load();
                $this->showToast("success", "Address has been successfully updated");
            }
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
