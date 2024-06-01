<?php
namespace Organization\Actions\FreelanceTrainer;
use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
use Organization\Models\{
    FreelanceTrainer
};
class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                     = FreelanceTrainer::find($id);

        $attachment = $record->attachment;
        if($request->file('attachment'))
        {
            FileTrait::RemoveSingleFile($attachment);
            $attachment = FileTrait::storeSingleFile($request->file('attachment'), 'FreelanceTrainers');
        }

        $record->name               = $request->input('name');
        $record->club_sport_id      = $request->input('club_sport_id');
        $record->commission         = $request->input('commission');
        $record->note               = $request->input('note');
        $record->phone              = $request->input('phone');
        $record->attachment         = $attachment;
        $record->national_id        = $request->input('national_id');
        $record->save();
        return $record;
    }
}
