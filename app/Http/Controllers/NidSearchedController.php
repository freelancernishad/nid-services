<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\NidSearched;
use Illuminate\Http\Request;

class NidSearchedController extends Controller
{
    function Download($id) {

         $nidinformations = NidSearched::find($id);


        $html = "



        <style>



        .nidInfoHead {
            font-size: 30px;
            font-weight: bold;
            border: 2px solid black;
            padding: 18px 18px 22px 18px;
            border-radius: 22px;
            color: black;
            width: 340px;
            margin: 0 auto;
            margin-bottom:20px;
            text-align: center;
        }



        table.nidInformation tr td {
            font-size: 20px;
            font-weight: bold;
            color: black;

        }
        .nAddress {
            font-size: 20px;
            width: 100px;
        }

        </style>

        <div class='nidInfoHead'> জাতীয় পরিচিতি বিবরন</div>
        <table width='100%' style='margin-bottom:50px'>
        <tr>
            <td></td>
            <td style='text-align: center;'> <div class='nidInfoImage'> <img width='130px' src='".base64('storage/'.$nidinformations->photo)."' alt=''></div> </td>
            <td></td>
        </tr>
    </table>

    <table width='80%' style='margin:0 auto' class='nidInformation'>



        <tr>
            <td width='25%'>নাম</td>
            <td width='5%'>: </td>
            <td width='70%'> $nidinformations->name_bn </td>
        </tr>


        <tr>
            <td style='font-size:15px'>Name</td>
            <td>: </td>
            <td style='font-size:15px'> $nidinformations->name_en </td>
        </tr>



        <tr>
            <td>পিতা</td>
            <td>: </td>
            <td> $nidinformations->father_name </td>
        </tr>


        <tr>
            <td>মাতা</td>
            <td>: </td>
            <td> $nidinformations->mother_name </td>
        </tr>

        <tr>
            <td style='font-size:15px'>Date of Birth</td>
            <td>: </td>
            <td style='font-size:15px'> $nidinformations->dob </td>
        </tr>

        <tr>
            <td style='font-size:15px'>NID No.</td>
            <td>: </td>
            <td style='font-size:15px'> $nidinformations->nidno </td>
        </tr>

        <tr>
            <td style='font-size:15px'>Blood Group</td>
            <td>: </td>
            <td>-</td>
        </tr>

        <tr class='nidAddress'>
            <td style='font-weight:500'>বর্তমান ঠিকানা</td>
            <td>: </td>
            <td> <div class='nAddress'>  $nidinformations->present_address </div></td>
        </tr>



    </table>



        ";
        $Filename = 'nid.pdf';

        return PdfMaker('A4',$html,$Filename,true);
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
            'name_bn' => 'required',
            'name_en' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'old_nid' => 'nullable',
            'blood_group' => 'required',
            'present_address' => 'required',
            'userid' => 'required|exists:users,id',

        ]);


        $photoUrl = $request->photo;

        $photoUrl= nidImageSave($photoUrl);

        $validatedData['photo'] = $photoUrl;
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
        $userid = $request->userid;
        $user = User::find($userid);

        $nidSearched = NidSearched::where(['userid'=>$userid])->get();

        $totalusers = User::count();
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
            'totalusers'=>$totalusers,
            'totalForThisAgent'=>$totalForThisAgent,
            'balance'=>$nidbalance,
            'nidSearchedTotal'=>$nidSearchedTotal,
            'nidSearchedToday'=>$nidSearchedToday,
            'withdrawAbleBalance'=>$withdrawAbleBalance,
        ];
        return $response;
    }


}
