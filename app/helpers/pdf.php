<?php
function mainformat($nidinformations) {
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
    return $html;
}


function fullformat($nidinformations){
    return $fullhtml = "
    <style>

    .border{
        border-collapse: collapse;
    }
    .border, .border th, .border td {
        border: 1px solid black;
        color:#585858;
        padding:10px 5px;
      }
      .border2{
        border-collapse: collapse;
        }
     .border2 th, .border2 td {
        border: 1px solid black;
      }
      .banglaFont{
        font-size:20px;
      }

    </style>

    <p>Citizens</p>

    <table width='100%'>
        <tr>
            <td width='80%'>
                <table width='100%' class='border'  >
                    <tr><td width='20%'>National ID </td> <td width='80%' colspan='4' > $nidinformations->nidno  </td></tr>
                    <tr><td>Pin </td> <td colspan='4'>  $nidinformations->oldNationalIdNumber </td></tr>
                    <tr><td>Status </td> <td colspan='4'> printed  </td></tr>
                    <tr><td>Name(Bangla)  </td> <td colspan='4' class='banglaFont'> $nidinformations->name_bn  </td></tr>
                    <tr><td>Name(English)  </td> <td colspan='4'> $nidinformations->name_en  </td></tr>
                    <tr><td>Date of Birth </td> <td colspan='4'> $nidinformations->dob  </td></tr>
                    <tr><td>Father Name </td> <td colspan='4' class='banglaFont'> $nidinformations->father_name  </td></tr>
                    <tr><td>Mother Name </td> <td colspan='4' class='banglaFont'> $nidinformations->mother_name  </td></tr>
                    <tr><td>Spouse Name </td> <td colspan='4' class='banglaFont'> $nidinformations->spouseNameBN  </td></tr>
                    <tr><td>Gender </td> <td colspan='4'> $nidinformations->gender  </td></tr>
                    <tr><td>Occupation </td> <td colspan='4' class='banglaFont'> $nidinformations->profession  </td></tr>
                    <tr><td>Disability </td> <td colspan='4'>  $nidinformations->disability </td></tr>
                    <tr><td>Disability Other </td> <td colspan='4'>  $nidinformations->Disability_other </td></tr>


                    <tr><td style='vertical-align: top;' rowspan='6'>Present Address </td>
                        <td>Division</td>
                        <td class='banglaFont'>$nidinformations->presentDivision</td>
                        <td>District</td>
                        <td class='banglaFont'>$nidinformations->presentDistrict</td>
                    </tr>

                    <tr>
                        <td>RMO</td>
                        <td class='banglaFont'>$nidinformations->present_rmo</td>
                        <td>City Corporation Or Municipality </td>
                        <td class='banglaFont'>$nidinformations->present_city</td>
                    </tr>


                    <tr>
                        <td>Upozila  </td>
                        <td class='banglaFont'>$nidinformations->presentThana</td>
                        <td>Union/Ward  </td>
                        <td class='banglaFont'>$nidinformations->present_mouza</td>
                    </tr>

                    <tr>

                        <td>Mouza/Moholla </td>
                        <td class='banglaFont'>$nidinformations->present_mouza</td>
                        <td>Additional Mouza/Moholla  </td>
                        <td class='banglaFont'>$nidinformations->present_additional_mouza</td>
                    </tr>



                    <tr>
                        <td>Post Office  </td>
                        <td class='banglaFont'>$nidinformations->presentPost</td>
                        <td>Postal Code </td>
                        <td class='banglaFont'>$nidinformations->presentPostCode</td>
                    </tr>


                    <tr>
                        <td>Region  </td>
                        <td class='banglaFont'>$nidinformations->present_region</td>
                        <td> </td>
                        <td></td>
                    </tr>


                    <tr><td style='vertical-align: top;' rowspan='6'>Permanent Address </td>
                        <td>Division</td>
                        <td class='banglaFont'>$nidinformations->permanentDivision</td>
                        <td>District</td>
                        <td class='banglaFont'>$nidinformations->permanentDistrict</td>
                    </tr>
                    <tr>
                        <td>RMO</td>
                        <td class='banglaFont'>$nidinformations->permanent_rmo</td>
                        <td>City Corporation Or Municipality </td>
                        <td class='banglaFont'>$nidinformations->permanent_city</td>
                    </tr>


                    <tr>
                        <td>Upozila  </td>
                        <td class='banglaFont'>$nidinformations->permanentThana</td>
                        <td>Union/Ward  </td>
                        <td class='banglaFont'>$nidinformations->permanentUnion</td>

                    </tr>

                    <tr>
                        <td>Mouza/Moholla </td>
                        <td class='banglaFont'>$nidinformations->permanent_mouza</td>
                        <td>Additional Mouza/Moholla  </td>
                        <td class='banglaFont'>$nidinformations->permanent_additional_mouza</td>
                    </tr>



                    <tr>
                        <td>Post Office  </td>
                        <td class='banglaFont'>$nidinformations->permanentPost</td>
                        <td>Postal Code </td>
                        <td class='banglaFont'>$nidinformations->permanentPostCode</td>
                    </tr>


                    <tr>
                        <td>Region  </td>
                        <td class='banglaFont'>$nidinformations->permanent_region</td>
                        <td> </td>
                        <td></td>
                    </tr>



                </table>
            </td>
            <td width='20%' style='vertical-align: top;'>

            <div class='nidInfoImage'> <img width='130px' src='".base64('storage/'.$nidinformations->photo)."' alt=''></div>
            <br/>
            <h4>Voter Documents</h4>
            <p>No Documents Available</p>
            </td>
        </tr>

    </table>
    <pagebreak>
    <table width='100%'>
        <tr>
            <td width='80%'>
                <table width='100%' class='border'  >
                    <tr><td width='20%'>Blood Group  </td> <td width='80%' colspan='4'> $nidinformations->blood_group  </td></tr>
                    <tr><td>Identification </td> <td colspan='4'> $nidinformations->identification  </td></tr>
                    <tr><td>Phone </td> <td colspan='4'> $nidinformations->phone  </td></tr>
                    <tr><td>Mobile  </td> <td colspan='4'> $nidinformations->mobile  </td></tr>
                    <tr><td>Religion  </td> <td colspan='4'> $nidinformations->religion  </td></tr>
                    <tr><td>No Finger  </td> <td colspan='4'> $nidinformations->no_finger  </td></tr>
                    <tr><td>No Finger Print  </td> <td colspan='4'> $nidinformations->no_finger_print  </td></tr>
                </table>
            </td>
            <td></td>
        </tr>
    </table>


    ";

}


function format2($nidinformations) {


    $qrdata = "$nidinformations->name_en $nidinformations->nidno $nidinformations->dob";

    $html = "
    <style>

    .mainborder{
        border:1px solid black;
    }
    .detailsTable tr td{
        font-size:20px;
    }
    .enText{
        font-size:16px !important;
    }
    .detailsHead{
        width:100%;
        font-size:25px;
        font-weight:bold;
    }

    </style>


    <div class='mainborder'>


    <img width='100%' src='".base64('nid_2.png')."' alt=''>

    <table width='100%'>
        <tr>
            <td width='25%' style='vertical-align: top; text-align:center;line-height:50px'>
            <div class='nidInfoImage'> <img width='130px' src='".base64('storage/'.$nidinformations->photo)."' alt=''></div>

            <p style='font-size:13px; paddin-top:5px'>$nidinformations->name_en</p>
            <div class='nidInfoImage'> <img width='130px' src='https://api.qrserver.com/v1/create-qr-code/?data=$qrdata&size=250x250' alt=''></div>


            </td>
            <td width='75%'>
                <table width='100%' class='detailsTable'>
                    <tr>
                        <td colspan='2' style='background:#C6E5EA;padding:10px 10px' ><div class='detailsHead'>জাতীয় পরিচিতি তথ্য</div></td>
                    </tr>



                    <tr>
                        <td>জাতীয় পরিচয় পত্র নম্বর</td>
                        <td class='enText' style='font-size:16px'>$nidinformations->nidno</td>
                    </tr>


                    <tr>
                        <td>ভোটার নম্বর</td>
                        <td></td>
                    </tr>

                    <tr>
                        <td>ভোটার এরিয়া কোড </td>
                        <td></td>
                    </tr>

                    <tr>
                        <td>সিরিয়াল নম্বর</td>
                        <td></td>
                    </tr>

                    <tr>
                        <td>ভোটার এলাকা</td>
                        <td></td>
                    </tr>


                    <tr>
                        <td colspan='2' style='background:#C6E5EA;padding:10px 10px' ><div class='detailsHead'>ব্যক্তিগত তথ্য </div></td>
                    </tr>

                    <tr>
                        <td>নাম (বাংলা)</td>
                        <td>$nidinformations->name_bn</td>
                    </tr>

                    <tr>
                        <td>নাম (ইংলিশ)</td>
                        <td class='enText' style='font-size:16px'>$nidinformations->name_en</td>
                    </tr>

                    <tr>
                        <td>জন্ম তারিখ</td>
                        <td class='enText' style='font-size:16px'>$nidinformations->dob</td>
                    </tr>

                    <tr>
                        <td>পিতার নাম </td>
                        <td>$nidinformations->father_name</td>
                    </tr>

                    <tr>
                        <td>মাতার নাম  </td>
                        <td>$nidinformations->mother_name</td>
                    </tr>


                    <tr>
                        <td colspan='2' style='background:#C6E5EA;padding:10px 10px' ><div class='detailsHead'>অন্যান্য তথ্য </div></td>
                    </tr>

                    <tr>
                        <td>লিঙ্গ</td>
                        <td>$nidinformations->gender</td>
                    </tr>

                    <tr>
                        <td>স্বামী/স্ত্রী</td>
                        <td>$nidinformations->spouseNameBN</td>
                    </tr>

                    <tr>
                        <td>ধর্ম</td>
                        <td>$nidinformations->religion</td>
                    </tr>

                    <tr>
                        <td>জন্মস্থান</td>
                        <td></td>
                    </tr>



                    <tr>
                        <td colspan='2' style='background:#C6E5EA;padding:10px 10px' ><div class='detailsHead'>বর্তমান ঠিকানা </div></td>
                    </tr>

                    <tr>
                        <td colspan='2'>$nidinformations->present_address</td>
                    </tr>


                    <tr>
                        <td colspan='2' style='background:#C6E5EA;padding:10px 10px' ><div class='detailsHead'>স্থায়ী ঠিকানা </div></td>
                    </tr>

                    <tr>
                        <td colspan='2'>$nidinformations->permanent_address</td>
                    </tr>


                </tr>


                </table>





            </td>
        </tr>
    </table>



    <p style='font-size:13px;text-align:center;margin-bottom:20px'>
    <span style='color:red;font-size:16px'>উপরে প্রদর্শিত তথ্যসমূহ জাতীয় পরিচয়পত্র সংশ্লিষ্ট, ভোটার তালিকার সাথে সরাসরি সম্পর্কযুক্ত নয়। </span> <br/>
    This is Software Generated Report From Bangladesh Election Commission, Signature & Seal Aren't Required.
    </p>


    </div>



    ";
    return $html;
}
