
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="icon" type="image/png" href="{{ asset('/images/icon.png')}}"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Laravel') }}</title>
    <style>
        .page_break { page-break-before: always; }
        body {
            
   font-family: Book Antiqua;
   font-size:12;
        }
        @page {   margin-top: 3.048cm;
   margin-bottom: 2.54cm;
   margin-left: 3.81cm;
   margin-right: 2.54cm;;
   border: 1px solid blue;
   font-family: Book Antiqua;
            font-size:12;
}
    </style>
</head>
<body> 
    @php
    ini_set('memory_limit', '-1');
@endphp
    @foreach($inventories as $inventory)
    <table width="100%" style='   font-size:12;'>
        <tr>
            <td style='text-align:right;'>
                {{date('F d, Y')}}
             
            </td>
        </tr>
        <tr>
            <td>
                <br>
            </td>
        </tr>
        <tr>
            <td>
                <br>
            </td>
        </tr>
        <tr>
            <td style='text-align:left;'>
                Dear @if($inventory->accountabilities[0]->user_info->gender == 'MALE') Mr. @else Mrs. @endif {{$inventory->accountabilities[0]->user_info->first_name." ".$inventory->accountabilities[0]->user_info->last_name}},
            </td>
        </tr>
        <tr>
            <td style='text-align:left;'>
                <p style='text-indent: 50px;text-align: justify;' >
                     This confirms your mobile phone plan allocation in the amount of {{$inventory->plan_offer}} {{$inventory->plan_description}} @if($inventory->phone_unit == null) without mobile unit @else with mobile unit {{$inventory->phone_unit}}  @endif mobile no. {{$inventory->service_number}}.
                </p>
                <p style='text-indent: 50px;text-align: justify;'>
                    Please be reminded that usage under this Plan should only be for purposes related to your work with {{$inventory->accountabilities[0]->user_info->EmployeeCompany[0]->name}}.
                 </p>
                <p style='text-indent: 50px;text-align: justify;'>
                    In the event that your usage for a particular billing period exceeds the Plan, the excess amount shall automatically be deducted from your salary for the pay period during which the statement of account for the Plan was received. However, if the excess amount was for usage related to your work, you are given a period of two (2) weeks from receipt of the statement of account within which to request for a reimbursement of the deducted amount, which shall be granted only if, and only to the extent that, such excess usage is justified and found by the Company as work-related.   
                </p>
                <p style='text-indent: 50px;text-align: justify;'>
                    By signing at the space provided below, you signify your conformity to the automatic deduction arrangement mentioned in the preceding paragraph. 
                 </p>
                <p style='text-indent: 50px;text-align: justify;'>
                    Thank you for your kind attention.
                  </p>
                  <br>
                  <p style='text-indent: 300px;text-align: justify;'>
                    Truly yours,
                  </p>
                  <p style='text-indent: 300px;margin-top:25px;'>
                    Francis Albert dela Cruz

                  </p>
                  <p style='text-indent: 255px;padding:0px;margin:0px;margin-top:-15px;'>
					VP Group Admin & General Services
                  </p>
                  <br>
                  <p >
					Conforme:
                  </p>
                  <p >
					_________________________
                  </p>
                  <p style='margin-top:-15px;'>
					Printed Name & Signature 
                  </p>
                  <p >
					Date: ___________________
                  </p>
                </td>
        </tr>
    </table>
    <div class="page_break"></div>
    @endforeach
</body>
</html>


