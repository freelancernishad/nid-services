<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\NidSearched;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class NidSearchedController extends Controller
{
    function Download(Request $request, $id) {


         $nidinformations = NidSearched::where(['token'=>$id])->first();
         if(!$nidinformations){
            return "<h1 style='color:red;text-align:center'>Data Not Found</h1>";
         }

         $html = mainformat($nidinformations);
        $fullhtml = fullformat($nidinformations);
        $format2 = format2($nidinformations);


        $Filename = 'nid.pdf';

        $type = $request->type;
        if($type=='full'){
            return PdfMaker('A4',$fullhtml,$Filename,false);
        }elseif($type=='format2'){
            return PdfMaker('A4',$format2,$Filename,false);
        }else{
            return PdfMaker('A4',$html,$Filename,true);
        }


    }
    // Display a listing of the resource.
    public function index()
    {
        $nidSearchedList = NidSearched::all();
        return view('nidsearched.index', compact('nidSearchedList'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('nidsearched.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'nidno' => 'required',
            'dob' => 'required|date',
            // 'name_bn' => 'required',
            // 'name_en' => 'required',
            // 'father_name' => 'required',
            // 'mother_name' => 'required',
            // 'old_nid' => 'nullable',
            // 'blood_group' => 'required',
            // 'present_address' => 'required',
            'userid' => 'required|exists:users,id',


            // 'oldNationalIdNumber' => 'required',

            // 'gender' => 'required',
            // 'profession' => 'required',
            // 'presentDistrict' => 'required',
            // 'presentThana' => 'required',
            // 'presentUnion' => 'required',
            // 'presentPost' => 'required',
            // 'presentPostCode' => 'required',
            // 'permanentDistrict' => 'required',
            // 'permanentThana' => 'required',
            // // 'permanentUnion' => 'required',
            // 'permanentPost' => 'required',
            // 'permanentPostCode' => 'required',


        ]);




        $validatedData['name_bn'] = $request->name_bn;
        $validatedData['name_en'] = $request->name_en;
        $validatedData['father_name'] = $request->father_name;
        $validatedData['mother_name'] = $request->mother_name;
        $validatedData['old_nid'] = $request->old_nid;
        $validatedData['blood_group'] = $request->blood_group;
        $validatedData['present_address'] = $request->present_address;


        $validatedData['oldNationalIdNumber'] = $request->oldNationalIdNumber;
        $validatedData['gender'] = $request->gender;
        $validatedData['profession'] = $request->profession;
        $validatedData['presentDistrict'] = $request->presentDistrict;
        $validatedData['presentThana'] = $request->presentThana;
        $validatedData['presentUnion'] = $request->presentUnion;
        $validatedData['presentPost'] = $request->presentPost;
        $validatedData['presentPostCode'] = $request->presentPostCode;
        $validatedData['permanentDistrict'] = $request->permanentDistrict;
        $validatedData['permanentThana'] = $request->permanentThana;
        $validatedData['permanentPost'] = $request->permanentPost;
        $validatedData['permanentPostCode'] = $request->permanentPostCode;





        $validatedData['permanentUnion'] = $request->permanentUnion;
        $validatedData['spouseNameBN'] = $request->spouseNameBN;
        $validatedData['disability'] = '-';
        $validatedData['Disability_other'] = '-';
        $validatedData['presentDivision'] = '-';
        $validatedData['present_rmo'] = '-';
        $validatedData['present_city'] = '-';
        $validatedData['present_mouza'] = '-';
        $validatedData['present_additional_mouza'] = '-';
        $validatedData['present_region'] = '-';
        $validatedData['permanentDivision'] = '-';
        $validatedData['permanent_rmo'] = '-';
        $validatedData['permanent_city'] = '-';
        $validatedData['permanent_mouza'] = '-';
        $validatedData['permanent_additional_mouza'] = '-';
        $validatedData['permanent_region'] = '-';

        $validatedData['identification'] = '-';
        $validatedData['phone'] = '-';
        $validatedData['mobile'] = '-';
        $validatedData['religion'] = '-';
        $validatedData['no_finger'] = '-';
        $validatedData['no_finger_print'] = '-';





        $photoUrl = $request->photo;

        $photoUrl= nidImageSave($photoUrl);

        $validatedData['photo'] = $photoUrl;
        $random = Str::random(40);
        $validatedData['token'] = time().$random;
        $validatedData['search_date'] = date('Y-m-d');
        // Create a new NidSearched instance


        $nidSearched = NidSearched::create($validatedData);




        // referral_commissions
        $userid = $request->userid;
        $user = User::findOrFail($userid);
        $parent_id = $user->parent_id;
        if($parent_id){
            $parentuser = User::findOrFail($parent_id);
            $amount = $parentuser->referral_commissions;
            // Update the commission balance
            // $parentuser->referral_commissions += $amount;
            $parentuser->balance += $amount;
            $parentuser->save();
        }







        return response()->json($nidSearched, 201);
    }

    // Display the specified resource.
    public function show($id)
    {
        $nidSearched = NidSearched::findOrFail($id);
        return view('nidsearched.show', compact('nidSearched'));
    }

    // Show the form for editing the specified resource.
    public function edit($id)
    {
        $nidSearched = NidSearched::findOrFail($id);
        return view('nidsearched.edit', compact('nidSearched'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'nidno' => 'required',
            'dob' => 'required|date',
            'name_bn' => 'required',
            'name_en' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'old_nid' => 'nullable',
            'blood_group' => 'required',
            'present_address' => 'required',
            'userid' => 'required|exists:users,id',
            'search_date' => 'required|date',
        ]);

        // Find the NidSearched record and update it
        $nidSearched = NidSearched::findOrFail($id);
        $nidSearched->update($validatedData);

        // Redirect to the index page with a success message
        return redirect()->route('nidsearched.index')->with('success', 'NidSearched record updated successfully!');
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        // Find the NidSearched record and delete it
        $nidSearched = NidSearched::findOrFail($id);
        $nidSearched->delete();

        // Redirect to the index page with a success message
        return redirect()->route('nidsearched.index')->with('success', 'NidSearched record deleted successfully!');
    }

    function allStats(Request $request){
        $role = $request->role;

        $token = $request->userid;


        $user = User::where(['token'=>$token])->first();
        $userid = $user->id;

        $nidSearched = NidSearched::where(['userid'=>$userid])->get();

        $totalmember = User::count();
        $totaladmin = User::where(['role'=>'admin'])->count();
        $totalagent = User::where(['role'=>'agent'])->count();
        $totalusers = User::where(['role'=>'user'])->count();
        $totalForThisAgent = User::where(['parent_id'=>$userid])->count();
        $nidbalance = $user->nidbalance;


        if($role=='admin'){
            $nidSearchedTotal = NidSearched::count();
            $nidSearchedToday = NidSearched::where(['search_date'=>date('Y-m-d')])->count();
        }elseif($role=='agent'){
           // Get all child users (downlines)
           $children = $user->children;

           // Count total searches for all child users
           $nidSearchedTotal = NidSearched::whereIn('userid', $children->pluck('id'))->count();

           // Count today's searches for all child users
           $nidSearchedToday = NidSearched::whereIn('userid', $children->pluck('id'))
               ->whereDate('search_date', Carbon::today())
               ->count();
        }else{
            $nidSearchedTotal = NidSearched::where(['userid'=>$userid])->count();
            $nidSearchedToday = NidSearched::where(['userid'=>$userid,'search_date'=>date('Y-m-d')])->count();
        }










        $withdrawAbleBalance = $user->balance;



        $response = [
            'totalmember'=>$totalmember,
            'totaladmin'=>$totaladmin,
            'totalagent'=>$totalagent,
            'totalusers'=>$totalusers,
            'totalForThisAgent'=>$totalForThisAgent,
            'balance'=>$nidbalance,
            'nidSearchedTotal'=>$nidSearchedTotal,
            'nidSearchedToday'=>$nidSearchedToday,
            'withdrawAbleBalance'=>$withdrawAbleBalance,
            'mainbalance'=>0,
        ];
        return $response;
    }



    function updateNid(Request $request,$id) {

        $nidSearched = NidSearched::find($id);
        $updateData = [
            'blood_group' => $request->blood_group,
            'identification' => $request->identification,
            'phone' => $request->phone,
            'mobile' => $request->mobile,
            'religion' => $request->religion,
            'no_finger' => $request->no_finger,
            'no_finger_print' => $request->no_finger_print,
        ];
        $nidSearched->update($updateData);
        return $nidSearched;

    }


}
