<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Deposit;
use App\Models\Gateway;
use App\Models\Level;
use App\Models\Plan;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Hash;
use App\Models\Transition;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{

    function balanceUpdate($id,$bal) {

        $user = User::find($id);
        $user->update(['nidbalance'=>$bal]);
        return $user;
    }



    public function referfunction($id)
    {
        $refer = [];
        if ($id) {
            $user = User::find($id);
            $wh = [
                'ref_by' => $user->username,
            ];
            $level1 =  User::where($wh)->get();
            // $level1 =  User::join('tasks', 'users.id', '=', 'tasks.user_id')
            // // ->join('tasks', 'users.id', '=', 'tasks.user_id')
            // ->select('users.*', 'tasks.task_comisition')
            // ->get();
            $refer['level1'] = $level1;
            $refer2 = [];
            foreach ($level1 as $value1) {
                $wh2 = [
                    'ref_by' => $value1->username,
                ];
                $level2 =  User::where($wh2)->get();
                $level2count =  User::where($wh2)->count();
                if ($level2count) {
                    array_push($refer2, $level2);
                }
            }
            $refer['level2'] = $refer2;
            $refer3 = [];
            if (!empty($refer2)) {
                foreach ($refer2[0] as $value2) {
                    $wh3 = [
                        'ref_by' => $value2->username,
                    ];
                    $level3 =  User::where($wh3)->get();
                    $level2count =  User::where($wh3)->count();
                    if ($level2count) {
                        array_push($refer3, $level3);
                    }
                }
            }
            $refer['level3'] = $refer3;
        }
        return $refer;
    }
    public function referlist(Request $request)
    {
        $id = $request->id;
        //         $users =  User::select('users.*', 'tasks.user_id as taskuser_id', 'deposits.user_id as depositsuser_id')
        //         ->rightJoin('tasks', 'tasks.user_id', '=', 'users.id')
        //         ->rightJoin('deposits', 'deposits.user_id', '=', 'users.id')
        //         // ->where('analytics.date', Carbon::today()->toDateString())
        //         ->groupBy('tasks.user_id')
        //         ->get();
        // return $users;
        //         return $res = array_merge($users, ['tasks' => $histories]);
        // dd($users);
        return $this->referfunction($id);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = $request->status;
        if ($status == 'all') {
            return User::all();
        } else {
            return User::where([
                'status' => $status
            ])->get();
        }
    }
    public function userbanned(Request $request, $status, $id)
    {

         $users = User::find($id);
        return $users->update(['status' => $status]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
       return $user;

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->except(['password']);
        if ($request->password) {
            $data['password'] = hash::make($request->password);
        }
        return $user->update($data);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
       $user->delete();
    }

    public function passwordupdate(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        $type = $request->type;
        if ($type == 'account') {
            $old = $request->old;
            $newpass = $request->newpass;
            if (Hash::check($newpass, $old)) {
                $user->update([
                    'password' => hash::make($newpass)
                ]);
            } else {
                return 0;
            }
        } else if ($type == 'withdraw') {
            $old = $request->old;
            $newpass = $request->newpass;
            if ($old === $user->withdrawpass) {
                $user->update([
                    'withdrawpass' => $newpass
                ]);
            } else {
                return 0;
            }
        }
        return 1;
    }



    public function barReport($start,$end,$year,$table)
    {



    //   return  $start = $month = strtotime("$start");
        // $end = strtotime("$end");
        $data = [];
        $allmonth = [];
        $borderColor = [];
        $backgroundColor = [];
        $datas = [];
        $month = date("m",strtotime($start));
        $curentmonth = date("Y-m",strtotime($start));
        $days = cal_days_in_month(CAL_GREGORIAN,$month,$year);
        for ($i=1; $i <=$days ; $i++) {
           $d = str_pad($i, 2, '0', STR_PAD_LEFT);
            $fdate = $curentmonth.'-'.$d;

            $total = DB::table($table)->where(['status'=>'approved'])->whereDate('created_at', '<=', $fdate.' 00:00:00')->whereDate('created_at', '>=', $fdate.' 00:00:00')
            ->sum('amount');
            //  $total = DB::table($table)->whereBetween('created_at', [$start.' 00:00:00',$end.' 23:59:59'])->sum('amount');

            array_push($data, "$total");
            array_push($allmonth, $fdate);
            // $month = strtotime("+1 day", $month);


        // array_push($borderColor, "#" . $this->random_color());
        // array_push($backgroundColor, "#" . $this->random_color());



        }




        // $datas['allmonth'] = $allmonth;
        $arr = [
            'label' => $table,
            'backgroundColor' => 'green',
            'data' => $data,
            'borderColor' => 'red',
            'borderWidth' => 1
        ];

        $datas['reports'] = (object)$arr;
        $datas['allmonth'] = $allmonth;
        return $datas;
    }






    public function dashboard(Request $request)
    {


        $dpChart = $this->barReport('2022-08-01','2022-08-31','2022','deposits');
        $WChart = $this->barReport('2022-08-01','2022-08-31','2022','withdrawals');

        $totalDeposit = Deposit::where(['status'=>'approved'])->sum('amount');
        $totalWithdrawal = Withdrawal::where(['status'=>'approved'])->sum('amount');
        $date = date("Y-m-d");

        $todayApprovedDeposit = Deposit::where(['status'=>'approved'])->whereDate('created_at', '<=', $date)->whereDate('created_at', '>=', $date)
        ->sum('amount');
        $todayApprovedWithdrawal = Withdrawal::where(['status'=>'approved'])->whereDate('created_at', '<=', $date)->whereDate('created_at', '>=', $date)->sum('amount');

        $todayPendingDepositCount = Deposit::where(['status'=>'pending'])->whereDate('created_at', '<=', $date)->whereDate('created_at', '>=', $date)->count();
        $todayPendingWithdrawalCount = Withdrawal::where(['status'=>'pending'])->whereDate('created_at', '<=', $date)->whereDate('created_at', '>=', $date)->count();

        $todayPendingDepositAmount = Deposit::where(['status'=>'pending'])->whereDate('created_at', '<=', $date)->whereDate('created_at', '>=', $date)
        ->sum('amount');
        $todayPendingWithdrawalAmount = Withdrawal::where(['status'=>'pending'])->whereDate('created_at', '<=', $date)->whereDate('created_at', '>=', $date)->sum('amount');


        $data = [
            'totalDeposit'=>$totalDeposit,
            'totalWithdrawal'=>$totalWithdrawal,
            'todayApprovedDeposit'=>$todayApprovedDeposit,
            'todayApprovedWithdrawal'=>$todayApprovedWithdrawal,
            'todayPendingDepositCount'=>$todayPendingDepositCount,
            'todayPendingWithdrawalCount'=>$todayPendingWithdrawalCount,
            'todayPendingDepositAmount'=>$todayPendingDepositAmount,
            'todayPendingWithdrawalAmount'=>$todayPendingWithdrawalAmount,
            'dpChart'=>$dpChart,
            'WChart'=>$WChart,
        ];

        return $data;

    }





}
