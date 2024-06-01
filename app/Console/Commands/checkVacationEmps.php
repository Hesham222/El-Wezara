<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use DateTime;
use Illuminate\Console\Command;
use Organization\Models\Employee;

class checkVacationEmps extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:vacation_emps';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update vacations for employees';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Employee::where(function ($query){
            $query->whereDate('vacation_renew_date',Carbon::today());
        })->chunk(100, function($emps) {
            foreach ($emps as $emp) {

                // check if emp is age <=50

                // recalc age
                $emp->age = $emp->calc_age($emp->birth_date);
                $emp->save();

                if ($emp->age >= 50 || $emp->is_disabled ==1)
                {
                    $emp->remaining_vacs += $emp->vacation_balance ;
                    $emp->save();
                    $emp->vacation_balance = 45 ;
                    $emp->save();
                    $futureDate=date('Y-m-d', strtotime('+1 year', strtotime($emp->vacation_renew_date)) );
                    $emp->vacation_renew_date = $futureDate;
                    $emp->save();
                }

                if ($emp->age < 50 && $emp->is_disabled == 0)
                {

                    $today = new DateTime("today");
                    $today = $today->format('m');
                    $year = $today->format('Y');
                    if (date('Y', strtotime( strtotime($emp->date_of_hiring)) ) == $year
                        && date('m', strtotime('+6 months', strtotime($emp->date_of_hiring)) ) ==$today
                    ){

                        $emp->remaining_vacs += $emp->vacation_balance ;
                        $emp->save();
                        $emp->vacation_balance = 15 ;
                        $emp->save();
                        $futureDate=date('Y-m-d', strtotime('+1 year', strtotime($emp->vacation_renew_date)) );
                        $emp->vacation_renew_date = $futureDate;
                        $emp->save();

                    }




                    $today = new DateTime("today");
                    $today = $today->format('Y');









                    if (date('Y', strtotime('+1 year', strtotime($emp->date_of_hiring)) ) >= $today
                        && date('Y', strtotime('+1 year', strtotime($emp->date_of_hiring)) ) < 10
                    )
                    {
                        $emp->remaining_vacs += $emp->vacation_balance ;
                        $emp->save();
                        $emp->vacation_balance = 21 ;
                        $emp->save();
                        $futureDate=date('Y-m-d', strtotime('+1 year', strtotime($emp->vacation_renew_date)) );
                        $emp->vacation_renew_date = $futureDate;
                        $emp->save();
                    }


                    if (date('Y', strtotime('+9 year', strtotime($emp->date_of_hiring)) ) >= $today)
                    {

                        $emp->remaining_vacs += $emp->vacation_balance ;
                        $emp->save();
                        $emp->vacation_balance = 30 ;
                        $emp->save();
                        $futureDate=date('Y-m-d', strtotime('+1 year', strtotime($emp->vacation_renew_date)) );
                        $emp->vacation_renew_date = $futureDate;
                        $emp->save();

                    }


                }

            }
        });

    }
}
