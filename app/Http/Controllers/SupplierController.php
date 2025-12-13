<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Http\Requests\Supplier\StoreSupplierRequest;
use App\Http\Requests\Supplier\UpdateSupplierRequest;
use Illuminate\Support\Str;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();

        return view('suppliers.index', [
            'suppliers' => $suppliers
        ]);
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(StoreSupplierRequest $request)
    {
        $image = "";
        if ($request->hasFile('photo')) {
            $image = $request->file('photo')->store("supliers", "public");
        }

        Supplier::create([
            "user_id" => auth()->id(),
            "uuid" => Str::uuid(),
            'photo' => $image,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'kra_pin' => $request->kra_pin,
            'shopname' => $request->shopname,
            'type' => $request->type,
            'account_holder' => $request->account_holder,
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name,
            'address' => $request->address,
        ]);

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'New supplier has been created!');
    }

    public function show($uuid)
    {
        $supplier = Supplier::where("uuid", $uuid)->firstOrFail();
        $supplier->loadMissing('purchases')->get();

        return view('suppliers.show', [
            'supplier' => $supplier
        ]);
    }

    public function edit($uuid)
    {
        $supplier = Supplier::where("uuid", $uuid)->firstOrFail();
        return view('suppliers.edit', [
            'supplier' => $supplier
        ]);
    }

    public function update(UpdateSupplierRequest $request, $uuid)
    {
        $supplier = Supplier::where("uuid", $uuid)->firstOrFail();

        /**
         * Handle upload image with Storage.
         */
        $image = $supplier->photo;
        if ($request->hasFile('photo')) {

            // Delete Old Photo
            if ($supplier->photo) {
                unlink(public_path('storage/') . $supplier->photo);
            }

            $image = $request->file('photo')->store("supliers", "public");
        }

        $supplier->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'kra_pin' => $request->kra_pin,
            'photo' => $image,
            'shopname' => $request->shopname,
            'type' => $request->type,
            'account_holder' => $request->account_holder,
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name,
            'address' => $request->address,
        ]);

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Supplier has been updated!');
    }

    public function destroy($uuid)
    {
        $supplier = Supplier::where("uuid", $uuid)->firstOrFail();
        
        // Check if supplier has associated purchases
        if ($supplier->purchases()->exists()) {
            return redirect()
                ->back()
                ->with('error', 'Cannot delete supplier "' . $supplier->name . '" because they have associated purchases. Please delete the purchases first or consider deactivating the supplier instead.');
        }

        /**
         * Delete photo if exists.
         */
        if ($supplier->photo) {
            $photoPath = public_path('storage/' . $supplier->photo);
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
        }

        $supplier->delete();

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Supplier has been deleted!');
    }
}
