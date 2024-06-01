<?php
namespace Organization\Actions\FreelanceTrainer;
use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
use Organization\Models\{
    FreelanceTrainer
};
class StoreAction
{
    public function execute(Request $request)
    {
        $file = FileTrait::storeSingleFile($request->file('attachment'),'FreelanceTrainers');

        $record =  FreelanceTrainer::create([
            'name'              => $request->input('name'),
            'club_sport_id'     => $request->input('club_sport_id'),
            'commission'        => $request->input('commission'),
            'note'              => $request->input('note'),
            'phone'             => $request->input('phone'),
            'attachment'        => $file,
            'national_id'       => $request->input('national_id'),
        ]);
        return $record;
    }
}
