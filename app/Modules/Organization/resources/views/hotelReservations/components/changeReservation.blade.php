<div class="modal fade" id="change-invoice-reservation-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Enter your password</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="" id="change-reservation-form" method="post" action="#">
                    <input type="hidden" name="resource_id" id="record_resource_id">
                    <input type="hidden" name="_method" id="confirm_password_action_method">
                    <div class="form-group">
                        <label>الحجوزات :</label>
                        <select name="reservation" required="" class="form-control m-input m-input--square" id="reservation">
                            @foreach($reservationIds as $reservationId)
                                <option @if(old('reservation') == $reservationId) selected @endif value="{{$reservationId}}"> رقم الحجز: {{$reservationId}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputAdminPassword">
                            Password<span style="color:red">*</span>
                        </label>
                        <input
                            type="password"
                            name="admin_password"
                            value="{{old('admin_password')}}"
                            required
                            id="inputAdminPassword"
                            class="form-control"
                            placeholder="Password.."
                        >
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
