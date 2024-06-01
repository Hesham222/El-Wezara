<div class="modal fade" id="confirm-password-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">ادخل كلمة المرور الخاص بك</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="" id="confirm-password-form" method="post" action="#">
                    <input type="hidden" name="resource_id" id="record_resource_id">
                    <input type="hidden" name="_method" id="confirm_password_action_method">
                    <div class="form-group">
                        <label for="inputAdminPass">
                            كلمة المرور<span style="color:red">*</span>
                        </label>
                        <input 
                            type="password" 
                            name="admin_password" 
                            value="{{old('admin_password')}}"
                            required
                            id="inputAdminPass" 
                            class="form-control"
                            placeholder="كلمة المرور.."
                            >
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">اغلاق</button>
                        <button type="submit" class="btn btn-primary">تأكيد</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
