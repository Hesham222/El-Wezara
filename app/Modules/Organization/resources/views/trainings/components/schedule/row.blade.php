
            <tr>
                <td>
                    <select name="day[]" required="" class="form-control m-input m-input--square" >

                        <option value="Saturday">Saturday
                        </option>
                        <option value="Sunday">Sunday
                        </option>
                        <option value="Monday">Monday
                        </option>
                        <option value="Tuesday">Tuesday
                        </option>
                        <option value="Wednesday">Wednesday
                        </option>
                        <option value="Thursday">Thursday
                        </option>
                        <option value="Friday">Friday
                        </option>
                    </select>
                    @error('day')
                    <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                    @enderror
                </td>
                <td>
                    <input class="form-control" type="time" name="start_time[]" id="start_time[]" required>
                    @error('start_time')
                    <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                    @enderror
                </td>
                <td>
                    <input class="form-control" type="time" name="end_time[]" id="end_time[]" required>
                    @error('end_time')
                    <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                    @enderror
                </td>
                <td>
                    <a
                        title="Remove the row"
                        class="btn btn-sm btn-danger"
                        onclick="DeleteVendorRowTable(this)">
                        <i class="fa fa-times" style="color: #fff"></i>
                    </a>
                </td>
            </tr>

