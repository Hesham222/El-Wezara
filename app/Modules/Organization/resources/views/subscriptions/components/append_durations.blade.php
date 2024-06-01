<div class="form-group m-form__group row">
    @if(isset($record))
        @if($record->Training->type == 'مواعيد ثابتة بالجلسات')
            <div class="col-lg-4">
                <label>عدد الجلسات </label>
                <input type="text"  required="" value="{{$record->session_balance}}" class="form-control m-input" name="session_balance" readonly="readonly" placeholder="Number of Sessions...">
                <input type="text"  required="" hidden value="{{$record->session_balance}}" class="form-control m-input" name="current_session" readonly="readonly" placeholder="Number of Sessions...">

            </div>
            <div class="col-lg-4">
                <label>تاريخ البدأ </label>
                <input class="form-control" type="date" name="start_date" id="start_date" value="{{$record->start_date}}" required>
            </div>
            <div id="Duration" class="col-lg-4">
                @include('Organization::subscriptions.components.duration')
            </div>
        @else
            <div class="col-lg-12">
                <label>عدد الجلسات </label>
                <input type="text"  required="" value="{{$record->session_balance}}" class="form-control m-input" name="session_balance" readonly="readonly" placeholder="Number of Sessions...">
                <input type="text" hidden  required="" value="{{$record->session_balance}}" class="form-control m-input" name="current_session" readonly="readonly" placeholder="Number of Sessions...">
            </div>
        @endif
    @endif
    @if(isset($trainingType))
        @if($trainingType == 'مواعيد ثابتة بالجلسات')
            <div class="col-lg-4">
                <label>عدد الجلسات </label>
                <input type="text"  required="" value="{{$sessionBalance}}" class="form-control m-input" name="session_balance" readonly="readonly" placeholder="Number of Sessions...">
                <input type="text" hidden required="" value="{{$sessionBalance}}" class="form-control m-input" name="current_session" readonly="readonly" placeholder="Number of Sessions...">
            </div>
            <div class="col-lg-4">
                <label>تاريخ البدأ </label>
                <input class="form-control" type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" required>
            </div>
            <div id="Duration" class="col-lg-4">
                @include('Organization::subscriptions.components.duration')
            </div>
        @else
            <div class="col-lg-12">
                <label>عدد الجلسات </label>
                <input type="text"  required="" value="{{$sessionBalance}}" class="form-control m-input" name="session_balance" readonly="readonly" placeholder="Number of Sessions...">
                <input type="text" hidden  required="" value="{{$sessionBalance}}" class="form-control m-input" name="current_session" readonly="readonly" placeholder="Number of Sessions...">
            </div>
        @endif
    @endif
</div>


