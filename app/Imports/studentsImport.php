<?php

namespace App\Imports;

use App\Models\student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class studentsImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // public function model(array $row)
    // {



    //     $AdmissionID = (string)$this->StudentAdmissionId('','125983');

    //     $StudentID = (string)$this->StudentId($row[1],$row[0],'125983',$row[2]);


    //     return new student([
    //         'school_id '=>'125983',
    //         'StudentID'=>$StudentID,
    //         'AdmissionID'=>$AdmissionID,
    //         'Year'=>date('Y'),
    //         'StudentStatus'=>'Active',
    //         'StudentRoll'=>$row[0],
    //         'StudentClass'=>$row[1],
    //         'StudentGroup'=>$row[2],
    //         'StudentNameEn'=>$row[3],
    //         'StudentName'=>$row[4],
    //     ]);
    // }



        public function collection(Collection $rows)
        {
            foreach ($rows as $row)
            {


            }

            }



}
