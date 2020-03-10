<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cashier;
use App\Branch;
use Illuminate\Support\Facades\Hash;

class CashierController extends Controller
{
  public function __construct()
  {
    //checking the user is superadmin
      $this->middleware('auth:superadmin');

  }

    public function list()
    {
      $PageHeading = "Cashier List";
      $cashiers = Cashier::all();
      return view('admins.cashiers.list',compact('cashiers','PageHeading'));
    }


    public function addform()
    {
      $PageHeading = "Add Cashier";
      $branches = Branch::all();
      return view('admins.cashiers.add',compact('PageHeading','branches'));
    }

    public function add(Request $req)
    {
      $cashier = new Cashier;
      $cashier->name = $req->name;
      $cashier->username = $req->username;
      $cashier->password = Hash::make($req->password);
      $cashier->branch_id = $req->branch_id;
      $cashier->save();
      return redirect('/notadmin/cashiers')->withSuccess('cashier Added Successfully');
    }
    public function delete($id)
    {
      $cashier = Cashier::find($id);
      $cashier->delete();
      return redirect('/notadmin/cashiers')->withSuccess('cashier deleted Successfully');
    }
    public function edit($id)
    {
      $PageHeading = "Edit Cashier";
      $branches = Branch::all();
      $cashier = Cashier::find($id);
      return view('admins.cashiers.edit',compact('cashier','PageHeading','branches'));
    }
    public function update(Request $req)
    {
      $cashier = Cashier::find($req->cashier_id);
      $cashier->name = $req->name;
      $cashier->username = $req->username;
      if($req->password)
      {
        $cashier->password = Hash::make($req->password);
      }
      $cashier->branch_id = $req->branch_id;
      $cashier->save();
      return redirect('/notadmin/cashiers')->withSuccess('cashier Updated Successfully');
    }

}
