<?php

namespace App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Branch;
use App\Branch_hour;

class BranchController extends Controller
{
  public function __construct()
  {
    //checking the user is superadmin
      $this->middleware('auth:superadmin');

  }
  public function list()
  {
    $branches = Branch::all();
    return view('admins.branches.list',compact('branches'));
  }


  public function addform()
  {
    return view('admins.branches.add');
  }

  public function add(Request $req)
  {
      $branch = new Branch;

      $branch->name = $req->name;
      $branch->slug = $req->slug;
      $branch->type = $req->type;
      $branch->map_link = $req->map_link;
      $branch->city = $req->city;
      $branch->area = $req->area;
      $branch->address = $req->address;
      $branch->cuisines = $req->cuisines;

      $branch->contact_number = $req->contact_number;

      $image = $req->cover_image;
      $name=str_replace(' ','_',$req->name.' '.time());
      $img_extension = pathinfo(storage_path().$image->getClientOriginalName(), PATHINFO_EXTENSION);
      $pretty_image_name=$name.'.'.$img_extension;
      $image->storeAs('public/LocationImages/'.str_replace(' ','_',$req->name),$pretty_image_name);
      $fullpath = 'LocationImages/'.str_replace(' ','_',$req->name).'/'.$pretty_image_name;

      $branch->cover_image = $fullpath;

      $branch->save();



        foreach ($req->open as $day => $opentimes) {
          foreach ($opentimes as $index => $opentime) {
            $hours = new Branch_hour;
            $hours->branch_id = $branch->id;
            $hours->day = $day;
            $hours->open_time = date("G:i", strtotime($opentime));
            $hours->close_time = date("G:i", strtotime($req->close[$day][$index]));
            $hours->save();
          }

        }

    return redirect('/notadmin/branches')->withSuccess('Branch Added Successfully');


  }

  public function edit($id)
  {
    $PageHeading = "Edit Branch";
    $branch = Branch::find($id);
    return view('admins.branches.edit',compact('branch','PageHeading'));
  }
  public function update(Request $req)
  {
    $branch = Branch::find($req->branch_id);

    $branch->name = $req->name;
    $branch->slug = $req->slug;
    $branch->type = $req->type;
    $branch->map_link = $req->map_link;
    $branch->city = $req->city;
    $branch->area = $req->area;
    $branch->address = $req->address;
    $branch->cuisines = $req->cuisines;

    $branch->contact_number = $req->contact_number;

  /*  $image = $req->cover_image;
    $name=str_replace(' ','_',$req->name.' '.time());
    $img_extension = pathinfo(storage_path().$image->getClientOriginalName(), PATHINFO_EXTENSION);
    $pretty_image_name=$name.'.'.$img_extension;
    $image->storeAs('public/LocationImages/'.str_replace(' ','_',$req->name),$pretty_image_name);
    $fullpath = 'LocationImages/'.str_replace(' ','_',$req->name).'/'.$pretty_image_name;

    $branch->cover_image = $fullpath;*/

    $branch->save();

    $oldHours = Branch_hour::where('branch_id',$req->branch_id)->delete();


      foreach ($req->open as $day => $opentimes) {
        foreach ($opentimes as $index => $opentime) {
          $hours = new Branch_hour;
          $hours->branch_id = $branch->id;
          $hours->day = $day;
          $hours->open_time = date("G:i", strtotime($opentime));
          $hours->close_time = date("G:i", strtotime($req->close[$day][$index]));
          $hours->save();
        }
      }

  return redirect('/notadmin/branches')->withSuccess('Branch updated Successfully');
  }
}
