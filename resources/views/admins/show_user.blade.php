@extends('layouts.app')

@section('content')

    <!-- Page Content -->
    <!-- add member modal -->
    <div class="modal fade" id="MemberModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document" style="max-width: 800px !important;">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Membership</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="append_errors" style="color: #a94442; background-color: #f2dede; border-color: #ebccd1; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
              <ul></ul>
            </div>
            <div class="append_success" style="color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
              <ul></ul>
            </div>
            <form method="post" role="form" class="form-horizontal" id="membership_form">
              @csrf
              <div class="form-group row add">
                <label for="amount" class="control-label col-sm-3" style="font-weight: 600;">Amount :</label>
                <div class="col-sm-9">
                  <input type="text" name="amount" id="amount" maxlength="5" onkeypress="return isNumber(event)" style="border-radius: 5px;" class="form-control" placeholder="Enter amount e.g : 12,000, 10,000, 5,000 or 2,000" autocomplete="off"/>
                  <input type="hidden" name="user_id" value="{{ $user->id }}">
                </div>
              </div>
              <div class="form-group row add">
                <label for="due_fees" class="control-label col-sm-3" style="font-weight: 600;">Due Amount :</label>
                <div class="col-sm-9">
                  <input type="text" name="due_fees" id="due_fees" maxlength="5" onkeypress="return isNumber(event)" style="border-radius: 5px;" class="form-control" placeholder="Enter due amount e.g : 5,000, 3,000 or 2,000" autocomplete="off"/>
                </div>
              </div>
              <div class="form-group row add">
                <label for="transaction_type" class="control-label col-sm-3" style="font-weight: 600;">Transaction Type :</label>
                <div class="col-sm-9">
                  <select class="form-control" style="border-radius: 5px;" name="transaction_type">
                    <option value="">Select Transaction Type</option>
                    <option value="Deposited">Deposited</option>
                    <!-- <option value="Released">Released</option>
                    <option value="Withdrawn">Withdrawn</option>
                    <option value="Refund">Refund</option> -->
                  </select>
                </div>
              </div>
              <div class="form-group row add">
                <label for="membership_type" class="control-label col-sm-3" style="font-weight: 600;">Membership Type :</label>
                <div class="col-sm-9">
                  <select class="form-control" style="border-radius: 5px;" name="membership_type">
                    <option value="">Select Membership Type</option>
                    <option value="monthly">Monthly</option>
                    <option value="weekly">Weekly</option>
                    <option value="daily">Daily</option>
                    <option value="hourly">Hourly</option>
                  </select>
                </div>
              </div>
              <div class="form-group row add">
                <label for="membership_status" class="control-label col-sm-3" style="font-weight: 600;">Status :</label>
                <div class="col-sm-9">
                  <select class="form-control" style="border-radius: 5px;" name="membership_status">
                    <option value="">Select Status</option>
                    <option value="temporary">Temporary</option>
                    <option value="confirmed">Confirmed</option>
                  </select>
                </div>
              </div>
              <div class="form-group row add">
                <label for="membership_date" class="control-label col-sm-3" style="font-weight: 600;">Start End Date :</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control timepicker start_date" value="{{ old('start_date') }}" name="start_date" autocomplete="off" placeholder="Enter start date" style="border-radius: 5px;">
                </div>
                <div class="col-sm-1">
                  <span>to</span>
                </div>
                <div class="col-sm-4">
                  <input type="text" class="form-control timepicker end_date" value="{{ old('end_date') }}" name="end_date" autocomplete="off" placeholder="Enter end date" style="border-radius: 5px;">
                </div>
              </div>
              <div class="form-group row add">
                <label for="comments" class="control-label col-sm-3" style="font-weight: 600;">Comments :</label>
                <div class="col-sm-9">
                  <textarea name="comments" style="border-radius: 5px;" class="form-control" placeholder="Enter your comments" rows="2" cols="20"></textarea>
                </div>
              </div>
              <div class="form-group row add">
                <label for="location_id" class="control-label col-sm-3" style="font-weight: 600;">Location :</label>
                <div class="col-sm-9">
                  <select class="location_change form-control" id="location_id" style="border-radius: 5px;" name="location_id">
                    <option value="">Select Location</option>
                    <?php if(isset($locations) && count($locations) > 0){ ?>
                      @foreach($locations as $location)
                      <option value="{{ $location->id }}">{{ $location->location_name }}</option>
                      @endforeach
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group row add append_rooms">
                <label for="room_id" class="control-label col-sm-3" style="font-weight: 600;">Room :</label>
                <div class="col-sm-9">
                  <select class="room_append room_change form-control" id="room_id" style="border-radius: 5px;" name="room_id">
                    <option value="">Select Room</option>
                  </select>
                </div>
              </div>
              <div class="form-group row add append_seats">
                <label for="seat_id" class="control-label col-sm-3" style="font-weight: 600;">Seat :</label>
                <div class="col-sm-9">
                  <select class="seat_append form-control" id="seat_id" style="border-radius: 5px;" name="seat_id">
                    <option value="">Select Seat</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-save" id="add">Save</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- add member modal end -->
    <!-- edit member modal -->
    <div class="modal fade" id="EditMemberModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document" style="max-width: 800px !important;">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Membership</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="append_errors" style="color: #a94442; background-color: #f2dede; border-color: #ebccd1; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
              <ul></ul>
            </div>
            <div class="append_success" style="color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
              <ul></ul>
            </div>
            <form method="post" role="form" class="form-horizontal" id="edit_membership_form">
              @csrf
              <div class="form-group row add">
                <label for="amount" class="control-label col-sm-3" style="font-weight: 600;">Amount :</label>
                <div class="col-sm-9">
                  <input type="text" name="amount" maxlength="5" onkeypress="return isNumber(event)" style="border-radius: 5px;" class="form-control" placeholder="Enter amount e.g : 12,000, 10,000, 5,000 or 2,000" autocomplete="off" required/>
                  @if($membership->id != null)
                    <input type="hidden" name="membership_id" value="{{ $membership->id }}">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                  @endif
                  @if($membership->id != null && $membership->expiry_date == 'not_expired')
                    <input type="hidden" name="membership_type" value="{{ $membership->membership_type }}">
                    <input type="hidden" name="start_date" value="{{ $membership->start_date }}">
                    <input type="hidden" name="end_date" value="{{ $membership->end_date }}">
                  @endif
                </div>
              </div>
              <div class="form-group row add">
                <label for="due_fees" class="control-label col-sm-3" style="font-weight: 600;">Due Amount :</label>
                <div class="col-sm-9">
                  <input type="text" name="due_fees" maxlength="5" onkeypress="return isNumber(event)" style="border-radius: 5px;" class="form-control" placeholder="Enter due amount e.g : 5,000, 3,000 or 2,000" autocomplete="off" required/>
                </div>
              </div>
              <div class="form-group row add">
                <label for="transaction_type" class="control-label col-sm-3" style="font-weight: 600;">Transaction Type :</label>
                <div class="col-sm-9">
                  <select class="form-control" style="border-radius: 5px;" name="transaction_type">
                    <option value="">Select Transaction Type</option>
                    <option value="Deposited">Deposited</option>
                    <!-- <option value="Released">Released</option>
                    <option value="Withdrawn">Withdrawn</option>
                    <option value="Refund">Refund</option> -->
                  </select>
                </div>
              </div>
              <div class="form-group row add">
                <label for="membership_status" class="control-label col-sm-3" style="font-weight: 600;">Status :</label>
                <div class="col-sm-9">
                  <select class="form-control" style="border-radius: 5px;" name="membership_status">
                    <option value="">Select Status</option>
                    @if($membership->id != null)
                      <option value="temporary" <?php if($membership->membership_status == "temporary") echo "selected"; ?>>Temporary</option>
                      <option value="confirmed" <?php if($membership->membership_status == "confirmed") echo "selected"; ?>>Confirmed</option>
                      <option value="suspended" <?php if($membership->membership_status == "suspended") echo "selected"; ?>>Suspended</option>
                    @endif
                  </select>
                </div>
              </div>
              @if($membership->id != null && $membership->expiry_date == 'expired')
              <div class="form-group row add">
                <label for="membership_type" class="control-label col-sm-3" style="font-weight: 600;">Membership Type :</label>
                <div class="col-sm-9">
                  <select class="form-control" style="border-radius: 5px;" name="membership_type">
                    <option value="">Select Membership Type</option>
                    <option value="monthly">Monthly</option>
                    <option value="weekly">Weekly</option>
                    <option value="daily">Daily</option>
                    <option value="hourly">Hourly</option>
                  </select>
                </div>
              </div>
              <div class="form-group row add">
                <label for="membership_date" class="control-label col-sm-3" style="font-weight: 600;">Start End Date :</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control timepicker start_date" value="{{ old('start_date') }}" name="start_date" autocomplete="off" placeholder="Enter start date" style="border-radius: 5px;">
                </div>
                <div class="col-sm-1">
                  <span>to</span>
                </div>
                <div class="col-sm-4">
                  <input type="text" class="form-control timepicker end_date" value="{{ old('end_date') }}" name="end_date" autocomplete="off" placeholder="Enter end date" style="border-radius: 5px;">
                </div>
              </div>
              @endif
              <div class="form-group row add">
                <label for="comments" class="control-label col-sm-3" style="font-weight: 600;">Comments :</label>
                <div class="col-sm-9">
                  <textarea name="comments" style="border-radius: 5px;" class="form-control" placeholder="Enter your comments" rows="2" cols="20"></textarea>
                </div>
              </div>
              <!-- <div class="form-group row add">
                <label for="elocation_id" class="control-label col-sm-3" style="font-weight: 600;">Location :</label>
                <div class="col-sm-9">
                  <select class="location_change form-control" id="elocation_id" style="border-radius: 5px;" name="location_id">
                    <option value="">Select Location</option>
                    <?php //if(isset($locations) && count($locations) > 0){ ?>
                      @foreach($locations as $location)
                      <option value="{{ $location->id }}">{{ $location->location_name }}</option>
                      @endforeach
                    <?php //} ?>
                  </select>
                </div>
              </div>
              <div class="form-group row add append_rooms">
                <label for="eroom_id" class="control-label col-sm-3" style="font-weight: 600;">Room :</label>
                <div class="col-sm-9">
                  <select class="room_append room_change form-control" id="eroom_id" style="border-radius: 5px;" name="room_id">
                    <option value="">Select Room</option>
                  </select>
                </div>
              </div>
              <div class="form-group row add append_seats">
                <label for="eseat_id" class="control-label col-sm-3" style="font-weight: 600;">Seat :</label>
                <div class="col-sm-9">
                  <select class="seat_append form-control" id="eseat_id" style="border-radius: 5px;" name="seat_id">
                    <option value="">Select Seat</option>
                  </select>
                </div>
              </div> -->
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-save" id="update">Update</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- edit member modal end -->
    <!-- add user modal -->
      <div class="modal fade" id="UserModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document" style="max-width: 1000px !important;">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="append_errors" style="color: #a94442; background-color: #f2dede; border-color: #ebccd1; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
              <ul></ul>
            </div>
            <div class="append_success" style="color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
              <ul></ul>
            </div>
            <form method="post" role="form" class="form-horizontal user_form">
              @csrf
              <fieldset class="scheduler-border">
                <legend class="scheduler-border">Basic Info of Employee</legend>
                <div class="form-group row add">
                  <div class="col-sm-6">
                    <input type="text" name="name" style="border-radius: 5px;" class="form-control" placeholder="Enter first name" autocomplete="off" autofocus required/>
                    <?php $arr = explode(",",$user->days); ?>
                    <input type="hidden" name="is_company" value="employee">
                    <input type="hidden" name="company_id" value="{{ $user->id }}">
                    <input type="hidden" name="company_name" value="{{ $user->name }} {{ $user->lname }}">
                    <input type="hidden" name="start_time" value="{{ $user->start_time }}">
                    <input type="hidden" name="end_time" value="{{ $user->end_time }}">
                    @foreach($arr as $ar)
                      <input type="hidden" name="days[]" value="{{ $ar }}">
                    @endforeach
                  </div>
                  <div class="col-sm-6">
                    <input type="text" name="lname" style="border-radius: 5px;" class="form-control" placeholder="Enter last name" autocomplete="off"/>
                  </div>
                </div>
                <div class="form-group row add">
                  <div class="col-sm-6">
                    <input type="email" name="email" style="border-radius: 5px;" class="form-control" placeholder="Enter email" autocomplete="off"/ required>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" name="cnic_number" style="border-radius: 5px;" maxlength="14" class="form-control" placeholder="Enter cnic number e.g : 44554-4561236-9" autocomplete="off"/>
                  </div>
                </div>
                <div class="form-group row add">
                  <div class="col-sm-6">
                    <input type="text" name="phone_number" onkeypress="return isNumber(event)" style="border-radius: 5px;" maxlength="11" class="form-control" placeholder="Enter phone number e.g : 021 32123213" autocomplete="off"/>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" name="mobile_number"  onkeypress="return isNumber(event)" style="border-radius: 5px;" maxlength="11" class="form-control" placeholder="Enter mobile number e.g : 0313 2356565" autocomplete="off"/>
                  </div>
                </div>
              </fieldset>
              <fieldset class="scheduler-border">
                <legend class="scheduler-border">Company Info</legend>
                <div class="form-group row add">
                  <div class="col-sm-6">
                    <input type="text" name="company_name" style="border-radius: 5px;" class="form-control" value="{{ $user->name }} {{ $user->lname }}" disabled />
                  </div>
                  <div class="col-sm-6">
                    <input type="text" name="designation" style="border-radius: 5px;" class="form-control" placeholder="Enter designation" autocomplete="off"/>
                  </div>
                </div>
                <div class="form-group row add">
                  <div class="col-sm-6">
                    <select class="form-control" style="border-radius: 5px;" name="city">
                      <option value="">Select City</option>
                      <option value="Karachi">Karachi</option>
                      <option value="Hyderabad">Hyderabad</option>
                      <option value="Sukkur">Sukkur</option>
                      <option value="Quetta">Quetta</option>
                      <option value="Lahore">Lahore</option>
                      <option value="Islamabad">Islamabad</option>
                    </select>
                  </div>
                  <div class="col-sm-6">
                    <select class="form-control" style="border-radius: 5px;" name="country">
                      <option value="">Select Country</option>
                      <option value="Pakistan">Pakistan</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row add">
                  <div class="col-sm-8">
                    <textarea name="address" style="border-radius: 5px;" class="form-control" placeholder="Enter your address" rows="2" cols="20"></textarea>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-save">Save</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
      </div>
    <!-- add users modal end -->
    <!-- edit users modal -->
      <div class="modal fade" id="EditUserModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      	<div class="modal-dialog" role="document" style="max-width: 1000px !important;">
      		<div class="modal-content">
      			<div class="modal-header">
      				<h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
      				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
      					<span aria-hidden="true">&times;</span>
      				</button>
      			</div>
      			<div class="modal-body">
      				<div class="edit_append_errors" style="color: #a94442; background-color: #f2dede; border-color: #ebccd1; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
      					<ul></ul>
      				</div>
      				<div class="edit_append_success" style="color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
      					<ul></ul>
      				</div>
      				<form method="post" role="form" class="form-horizontal edit_user_form">
      					@csrf
                <fieldset class="scheduler-border">
                  <legend class="scheduler-border">Basic Info of User</legend>
                  <div class="form-group row add">
        						<label for="fid" class="control-label col-sm-1" style="font-weight: 500;">ID :</label>
        						<div class="col-sm-11">
        							<input type="text" name="fid" style="border-radius: 5px;" class="form-control fid" disabled/>
        							<input type="hidden" class="edit_fid" name="edit_fid">
        						</div>
        					</div>
                  <div class="form-group row add">
                    <div class="col-sm-6">
                      <input type="text" name="edit_name" style="border-radius: 5px;" class="form-control edit_name" placeholder="Enter first name" autocomplete="off" autofocus required/>
                    </div>
                    <div class="col-sm-6">
                      <input type="text" name="edit_lname" style="border-radius: 5px;" class="form-control edit_lname" placeholder="Enter last name" autocomplete="off"/>
                    </div>
                  </div>
                  <div class="form-group row add">
                    <div class="col-sm-6">
                      <input type="email" name="edit_email" style="border-radius: 5px;" class="form-control edit_email" placeholder="Enter email" autocomplete="off"/ required>
                    </div>
                    <div class="col-sm-6">
                      <input type="text" name="edit_cnic_number" style="border-radius: 5px;" maxlength="14" class="form-control edit_cnic_number" placeholder="Enter cnic number e.g : 44554-4561236-9" autocomplete="off"/>
                    </div>
                  </div>
                  <div class="form-group row add">
                    <div class="col-sm-6">
                      <input type="text" name="edit_phone_number" onkeypress="return isNumber(event)" style="border-radius: 5px;" maxlength="11" class="form-control edit_phone_number" placeholder="Enter phone number e.g : 021 32123213" autocomplete="off"/>
                    </div>
                    <div class="col-sm-6">
                      <input type="text" name="edit_mobile_number" onkeypress="return isNumber(event)" style="border-radius: 5px;" maxlength="11" class="form-control edit_mobile_number" placeholder="Enter mobile number e.g : 0313 2356565" autocomplete="off"/>
                    </div>
                  </div>
                </fieldset>
                <fieldset class="scheduler-border">
                  <legend class="scheduler-border">Company Info</legend>

                  <div class="form-group row add">
                    <div class="col-sm-6">
                      <input type="text" name="edit_company_name" style="border-radius: 5px;" class="form-control edit_company_name" placeholder="Enter company name" autocomplete="off"/>
                    </div>
                    <div class="col-sm-6">
                      <input type="text" name="edit_designation" style="border-radius: 5px;" class="form-control edit_designation" placeholder="Enter designation" autocomplete="off"/>
                    </div>
                  </div>
                  <div class="form-group row add">
                    <div class="col-sm-6">
                      <select class="form-control edit_city" style="border-radius: 5px;" name="edit_city">
                        <option value="">Select City</option>
                        <option value="Karachi">Karachi</option>
                        <option value="Hyderabad">Hyderabad</option>
                        <option value="Sukkur">Sukkur</option>
                        <option value="Quetta">Quetta</option>
                        <option value="Lahore">Lahore</option>
                        <option value="Islamabad">Islamabad</option>
                      </select>
                    </div>
                    <div class="col-sm-6">
                      <select class="form-control edit_country" style="border-radius: 5px;" name="edit_country">
                        <option value="">Select Country</option>
                        <option value="Pakistan">Pakistan</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row add">
                    <div class="col-sm-8">
                      <textarea name="edit_address" style="border-radius: 5px;" class="form-control edit_address" placeholder="Enter your address" rows="2" cols="20"></textarea>
                    </div>
                  </div>
                </fieldset>
      				</div>
      				<div class="modal-footer">
      					<button type="submit" class="edit btn btn-save">Update</button>
      					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      				</div>
      			</form>
      		</div>
      	</div>
      </div>
      <!-- edit users modal end -->
      <!-- delete users modal -->
      <div class="modal fade" style="margin-left: -250px; margin-top: 20px;" id="DeleteUserModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      	<div class="modal-dialog" role="document">
      		<div class="modal-content" style="width:200%;">
      			<div class="modal-body">
              <div class="delete_append_success" style="color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
                <ul></ul>
              </div>
      				<div class="deletecontent">
      					Are you sure want to delete <span class="title" style="font-size: 18px; font-weight: 500;"></span>?
      					<span class="id" style="display: none;"></span>
      				</div>
      			</div>
      			<div class="modal-footer">
      				<button type="button" class="delete btn btn-danger">Delete</button>
      				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      			</div>
      		</div>
      	</div>
      </div>
      <!-- edit users modal end -->
      <!-- suspend member modal -->
      <div class="modal fade" style="margin-left: -250px; margin-top: 20px;" id="SuspendMemberModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      	<div class="modal-dialog" role="document">
      		<div class="modal-content" style="width:200%;">
      			<div class="modal-body">
              <div class="delete_append_success" style="color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
                <ul></ul>
              </div>
      				<div class="deletecontent">
      					Are you sure want to suspend <span class="title" style="font-size: 18px; font-weight: 500;"></span>?
                <input type="hidden" name="membership_id" class="mem_id" value="">
      				</div>
      			</div>
      			<div class="modal-footer">
      				<button type="button" class="suspend btn btn-danger">Suspend</button>
      				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      			</div>
      		</div>
      	</div>
      </div>
      <!-- suspend member modal end -->

    <div id="page-content-wrapper">

        <div class="container-fluid py-3" id="users">
          <!-- table-->
          <div class="card">
            <div class="media border p-3">
              <div class="text-center row" style="margin-right: 5px;">
                <div class="col-sm-12">
                  <img src="{{ asset('images/single_user.png') }}" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:210px;">
                  <h4>{{ $user->name }} {{ $user->lname }}</h4>
                </div>
              </div>
              <div class="media-body">
                <div class="row">
                  <div class="col-sm-12" style="text-align: right;">
                    @if($membership->id == null || $membership->membership_status == 'suspended')<a class="btn btn-default btn-save" href="#" id="add_member" data-toggle="modal" data-target="#MemberModal" data-whatever="@mdo"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Membership</a>@endif
                    @if($membership->id != null && $membership->membership_status != 'suspended')<a class="btn btn-default btn-save" href="#" id="edit_member" data-toggle="modal" data-target="#EditMemberModal" data-whatever="@mdo"><i class="fa fa-plus-circle" aria-hidden="true"></i> Edit Membership</a> <a class="suspend_member btn btn-default btn-danger" data-id="{{ $membership->id }}" data-name="{{ $user->name }}" data-lname="{{ $user->lname }}" href="#" id="suspend_member" data-toggle="modal" data-target="#SuspendMemberModal" data-whatever="@mdo"><i class="fa fa-trash" aria-hidden="true"></i> Suspend Member</a>@endif
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <br>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <h4>User Info</h4>
                    <table class="table table-user-information">
                      <tbody>
                        <tr>
                          <th>Email:</th>
                          <td>{{ $user->email }}</td>
                        </tr>
                        @if($user->is_company == false)
                        <tr>
                          <th>CNIC:</th>
                          <td>{{ $user->cnic_number }}</td>
                        </tr>
                        <tr>
                          <th>Company:</th>
                          <td>{{ $user->company_name }}</td>
                        </tr>
                        <tr>
                          <th>Designation:</th>
                          <td>{{ $user->designation }}</td>
                        </tr>
                        @endif
                        <tr>
                          <th>Contact:</th>
                          <td>@if($user->mobile_number) {{ $user->mobile_number }}(Mobile) | @endif @if($user->phone_number) {{ $user->phone_number }}(Landline) @endif</td>
                        </tr>
                        <tr>
                          <th>Address:</th>
                          <td>{{ $user->address }}@if($user->city && $user->country), {{ $user->city }}, {{ $user->country }} @endif</td>
                        </tr>
                        <tr>
                          <th>Availability:</th>
                          <td>@if($user->start_time && $user->end_time) {{ $user->start_time }} to {{ $user->end_time }} @endif <br> {{ $user->days }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div id="append_membership_data">
                  </div>
                  @if($membership->id != null)
                  <div class="col-sm-6">
                    <h4>Membership Info</h4>
                    <table class="table table-user-information">
                      <tbody style="text-align: left;">
                        <tr>
                          <th>Type:</th>
                          <td>{{ ucfirst($membership->membership_type) }} Package</td>
                        </tr>
                        <tr>
                          <th>Status:</th>
                          <td><span class="{{ $membership->status_class }}">{{ ucfirst($membership->membership_status) }}</span></td>
                        </tr>
                        <tr>
                          <th>Start Date:</th>
                          <td><?php echo date('d M Y',strtotime($membership->start_date)); ?></td>
                        </tr>
                        <tr>
                          <th>Expiry Date:</th>
                          <td><?php echo date('d M Y',strtotime($membership->end_date)); ?> @if($membership->id != null && $membership->expiry_date == 'expired') <i class="fas fa-exclamation-circle" style="color:red;"> Expired</i>@endif</td>
                        </tr>
                        <tr>
                          <th>Comments:</th>
                          <td>{{ $membership->comments }}</td>
                        </tr>
                        <tr>
                          <th>Given Amount:</th>
                          <td>€. {{ $membership->amount }}</td>
                        </tr>
                        <tr>
                          <th>Due Amount:</th>
                          <td>€. {{ $membership->due_fees }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
          <div class="card" <?php if($user->is_company == false) echo 'style="display: none;"' ?>>
              <div class="card-header bg-blue text-light">
                <div class="row">
                  <div class="col-sm-6">
                    <h4 class="mb-0">Employees</h4>
                  </div>
                  <div class="col-sm-6" style="text-align: right;">
                    <a class="btn btn-default btn-yellow" href="#" data-toggle="modal" data-target="#UserModal" data-whatever="@mdo"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Employee</a>
                  </div>
                </div>
              </div>
              <div class="table-responsive small">
                <table class="table table-condensed" id="userTable">
                  <thead>
                    <tr>
                      <th><span>ID</span></th>
                      <th><span>Employee Name</span></th>
                      <th><span>Email</span></th>
                      <th><span>Contact</span></th>
                      <th><span>Address</span></th>
                      <th><span>Created Date</span></th>
                      <th class="text-center" style="width:110px">Action</th>
                    </tr>
                  </thead>
                  <tbody class="tBody">
                    <tr>
                      {{ csrf_field() }}
                     <?php if(isset($users) && count($users) > 0){ ?>
                       @foreach($users as $user)
                         <tr class="UserInfo{{$user->id}}">
                           <td>{{ $user->id }}</td>
                           <td> <a href="{{ url('admin/show_user_info') }}/{{ $user->id }}" style="text-decoration: underline;">{{ $user->name }} {{ $user->lname }}</a></td>
                           <td> {{ $user->email }}</td>
                           <td> @if($user->mobile_number) Mobile: {{ $user->mobile_number }} <br> @endif @if($user->phone_number) Phone: {{ $user->phone_number }} @endif</td>
                           <td> {{ $user->address }}@if($user->city && $user->country), {{ $user->city }}, {{ $user->country }} @endif</td>
                           <td><?php echo date('d M Y',strtotime($user->created_at)); ?></td>
                           <td class="px-2 text-nowrap">
                             <a href="#" class="edit_modal btn btn-sm btn-save" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-lname="{{ $user->lname }}" data-email="{{ $user->email }}" data-cnic_number="{{ $user->cnic_number }}" data-mobile_number="{{ $user->mobile_number }}" data-phone_number="{{ $user->phone_number }}" data-company_name="{{ $user->company_name }}" data-designation="{{ $user->designation }}" data-city="{{ $user->city }}" data-country="{{ $user->country }}" data-address="{{ $user->address }}" data-number_of_seats="{{ $user->number_of_seats }}" data-start_time="{{ $user->start_time }}" data-end_time="{{ $user->end_time }}" data-days="{{ $user->days }}" data-is_company="{{ $user->is_company }}" data-toggle="modal" data-target="#EditUserModal" data-whatever="@mdo"><i class='fa fa-pencil'></i> Edit</a>
                             <a href="#" class="delete_modal btn btn-sm btn-danger" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-lname="{{ $user->lname }}" data-toggle="modal" data-target="#DeleteUserModal" data-whatever="@mdo"><i class='fa fa-trash'></i> Delete</a>
                           </td>
                         </tr>
                       @endforeach
                    <?php }else { ?>
                      <tr>
                        <th id="yet">
                          <h2>Employees are not added yet</h2>
                        </th>
                      </tr>
                    <?php } ?>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div style="margin-top: 10px;margin-left: 440px;">
		      </div>
        </div>
    </div>

<script type="text/javascript">
  function isNumber(evt){
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
      return false;
    }
    return true;
  }

  function validation_fields(){
    var preview_start_time = $('input#start_time').val();
    var preview_end_time = $('input#end_time').val();
    var today = moment();
    var today_format = today.format('MM-DD-YYYY');
    var timeStart = new Date(today_format+" "+preview_start_time);
    var timeEnd = new Date(today_format+" "+preview_end_time);
    var diff = (timeEnd - timeStart) / 60000;
    var hours = diff / 60;
    if(preview_start_time == '' || preview_end_time == ''){
      alert('Please mention your Availability !!');
      return false;
    }
    if(hours < 1){
      alert("Shift cannot be less than 1 hour! Please reset Shift Timing..");
      return false;
    }
  }

  $(document).ready(function(){

    $('.append_rooms').hide();
    $('.append_seats').hide();

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('#UserModal').on('shown.bs.modal', function () {
      $('#name').focus();
    });
    $('#MemberModal').on('shown.bs.modal', function () {
      $('#amount').focus();
    });

  $('.user_form').on('submit', function(event){
		event.preventDefault();
    // validation_fields();

    $.ajax({
      url:"{{ url('admin/store_user_info') }}",
      method:"POST",
      data:new FormData(this),
      dataType:"JSON",
			contentType:false,
			cache:false,
			processData:false,
      success:function(data){
				$('.append_errors ul').text('');
				$('.append_success ul').text('');
        if(data.errors)
        {
					$.each(data.errors, function(i, error){
						$('.append_errors').show();
            $('.append_errors ul').append("<li>" + data.errors[i] + "</li>");
        	});
        }else {
          var date = moment(data.created_at).format("D MMM YYYY");

          var phone_i = data.phone_number;
          var mobile_i = data.mobile_number;
          var phone_n = '';
          if(mobile_i != '' && phone_i == ''){
            phone_n = 'Mobile: '+ mobile_i +' <br>';
          }else if(phone_i != '' && mobile_i == '') {
            phone_n = 'Phone: '+ phone_i +'';
          }else if(phone_i != '' && mobile_i != null) {
            phone_n = 'Mobile: '+ mobile_i +' <br> Phone: '+ phone_i;
          }else if(phone_i != '' && mobile_i == null) {
            phone_n = 'Phone: '+ phone_i;
          }

          var address = data.address;
          var city = data.city;
          var country = data.country;
          if(address == '' && city == ''){
            var full_address = '';
          }else {
            var full_address = address+', '+city+', ' +country;
          }

					$('.tBody').prepend("<tr class='UserInfo"+data.id+"'>"+
					"<td>" + data.id + "</td>"+
					"<td>" + data.name + ' ' + data.lname + "</td>"+
					"<td>" + data.email + "</td>"+
					"<td>" + phone_n + "</td>"+
					"<td>" + full_address + "</td>"+
					"<td>" + date + "</td>"+
					"<td class='px-2 text-nowrap'><a href='#' class='edit_modal btn btn-sm btn-save' data-id='"+data.id+"' data-name='"+data.name+"' data-lname='"+data.lname+"' data-email='"+data.email+"' data-mobile_number='"+data.mobile_number+"' data-phone_number='"+data.phone_number+"' data-cnic_number='"+data.cnic_number+"' data-company_name='"+data.company_name+"' data-designation='"+data.designation+"' data-city='"+data.city+"' data-country='"+data.country+"' data-address='"+data.address+"' data-number_of_seats='"+data.number_of_seats+"' data-start_time='"+data.start_time+"' data-end_time='"+data.end_time+"' data-days='"+data.days+"' data-toggle='modal' data-target='#EditUserModal' data-whatever='@mdo'>"+
					"<i class='fa fa-pencil'></i> Edit</a> "+
					"<a href='#' class='delete_modal btn btn-sm btn-danger' data-id='"+data.id+"' data-name='"+data.name+"' data-lname='"+data.lname+"' data-toggle='modal' data-target='#DeleteUserModal' data-whatever='@mdo'>"+
					"<i class='fa fa-trash'></i> Delete</a>"+
					"</td>"+
					"</tr>");
					$('#yet').hide();
					$('.append_errors').hide();
					$('.append_success').show();
					$('.append_success ul').append("<li>Employee Created Successfully.</li>");
          $('.user_form')[0].reset();
					setTimeout(function(){ $('.append_success').hide(); },3000);
					setTimeout(function(){ $('#UserModal').modal('hide'); },3000);
					setTimeout(function(){ $('body').removeClass('modal-open'); },3000);
					setTimeout(function(){ $('.modal-backdrop').remove(); },3000);
	      }
      },
    });
  });

	$(document).on('click', '.edit_modal', function(){
    $('.edit_user_form')[0].reset();
    $('.check_all').prop('checked', false);
    $('.edit_company_check_days').prop('checked', false);
    $('.edit_user_check_days').prop('checked', false);
		$('.fid').val($(this).data('id'));
		$('.edit_fid').val($(this).data('id'));
		$('.edit_name').val($(this).data('name'));
		$('.edit_lname').val($(this).data('lname'));
		$('.edit_email').val($(this).data('email'));
		$('.edit_cnic_number').val($(this).data('cnic_number'));
		$('.edit_mobile_number').val($(this).data('mobile_number'));
		$('.edit_phone_number').val($(this).data('phone_number'));
		$('.edit_company_name').val($(this).data('company_name'));
		$('.edit_designation').val($(this).data('designation'));
    $(".edit_city option[value='"+$(this).data('city')+"']").prop('selected', true);
    $(".edit_country option[value='"+$(this).data('country')+"']").prop('selected', true);
		$('.edit_address').val($(this).data('address'));

		$('.edit_append_errors').hide();
		$('.edit_append_success').hide();
	});

	$('.edit_user_form').on('submit', function(event){
		event.preventDefault();
    $.ajax({
      url:"{{ url('admin/update_user_info') }}",
      method:"POST",
			data:new FormData(this),
      dataType:"JSON",
			contentType:false,
			cache:false,
			processData:false,
			success:function(data){
				$('.edit_append_errors ul').text('');
				$('.edit_append_success ul').text('');
        if(data.errors)
        {
					$.each(data.errors, function(i, error){
						$('.edit_append_errors').show();
            $('.edit_append_errors ul').append("<li>" + data.errors[i] + "</li>");
        	});
        }else {
          var date = moment(data.created_at).format("D MMM YYYY");

          var phone_i = data.phone_number;
          var mobile_i = data.mobile_number;
          var phone_n = '';
          if(mobile_i != '' && phone_i == ''){
            phone_n = 'Mobile: '+ mobile_i +' <br>';
          }else if(phone_i != '' && mobile_i == '') {
            phone_n = 'Phone: '+ phone_i +'';
          }else if(phone_i != '' && mobile_i != null) {
            phone_n = 'Mobile: '+ mobile_i +' <br> Phone: '+ phone_i;
          }else if(phone_i != '' && mobile_i == null) {
            phone_n = 'Phone: '+ phone_i;
          }

          var address = data.address;
          var city = data.city;
          var country = data.country;
          if(address == '' && city == ''){
            var full_address = '';
          }else {
            var full_address = address+', '+city+', ' +country;
          }

					$('.UserInfo' + data.id).replaceWith(" "+
					"<tr class='UserInfo"+data.id+"'>"+
          "<td>" + data.id + "</td>"+
					"<td>" + data.name + ' ' + data.lname + "</td>"+
					"<td>" + data.email + "</td>"+
					"<td>" + phone_n + "</td>"+
					"<td>" + full_address + "</td>"+
					"<td>" + date + "</td>"+
					"<td class='px-2 text-nowrap'><a href='#' class='edit_modal btn btn-sm btn-save' data-id='"+data.id+"' data-name='"+data.name+"' data-lname='"+data.lname+"' data-email='"+data.email+"' data-mobile_number='"+data.mobile_number+"' data-phone_number='"+data.phone_number+"' data-cnic_number='"+data.cnic_number+"' data-company_name='"+data.company_name+"' data-designation='"+data.designation+"' data-city='"+data.city+"' data-country='"+data.country+"' data-address='"+data.address+"' data-number_of_seats='"+data.number_of_seats+"' data-start_time='"+data.start_time+"' data-end_time='"+data.end_time+"' data-days='"+data.days+"' data-toggle='modal' data-target='#EditUserModal' data-whatever='@mdo'>"+
					"<i class='fa fa-pencil'></i> Edit</a> "+
					"<a href='#' class='delete_modal btn btn-sm btn-danger' data-id='"+data.id+"' data-name='"+data.name+"' data-lname='"+data.lname+"' data-toggle='modal' data-target='#DeleteUserModal' data-whatever='@mdo'>"+
					"<i class='fa fa-trash'></i> Delete</a>"+
					"</td>"+
					"</tr>");
					$('.edit_append_errors').hide();
					$('.edit_append_success').show();
					$('.edit_append_success ul').append("<li>Employee Updated Successfully.</li>");
					setTimeout(function(){ $('#EditUserModal').modal('hide'); },3000);
					setTimeout(function(){ $('body').removeClass('modal-open'); },3000);
					setTimeout(function(){ $('.modal-backdrop').remove(); },3000);
        }
      },
    });
  });

	$(document).on('click', '.suspend_member', function(){
		$('.title').html($(this).data('name')+' '+$(this).data('lname'));
		$('.mem_id').val($(this).data('id'));
	});

  $('.suspend').on('click',function(event){
		event.preventDefault();
		var data = {
			'_token' : $('input[name=_token]').val(),
			'id' : $('.mem_id').val()
		};

    $.ajax({
        type:'POST',
        url:"{{ url('admin/suspend_membership') }}",
				data:data,
				dataType:"json",
        success:function(data){
					$('.delete_append_success ul').text('');
					$('.delete_append_success').show();
					$('.delete_append_success ul').append("<li>"+data+"</li>");
          setTimeout(function(){ $('.delete_append_success').hide(); },3000);
          location.reload();
          // $('.UserInfo' + $('.id').text()).remove();
					// setTimeout(function(){ $('.DeleteUserModal').modal('hide'); },3000);
					// setTimeout(function(){ $('body').removeClass('modal-open'); },3000);
					// setTimeout(function(){ $('.modal-backdrop').remove(); },3000);
        }
    });
  });

  $(document).on('click', '.delete_modal', function(){
    $('.title').html($(this).data('name')+' '+$(this).data('lname'));
    $('.id').text($(this).data('id'));
  });

  $('.delete').on('click',function(event){
		event.preventDefault();
		var data = {
			'_token' : $('input[name=_token]').val(),
			'id' : $('.id').text()
		};

    $.ajax({
        type:'POST',
        url:"{{ url('admin/delete_user_info') }}",
				data:data,
				dataType:"json",
        success:function(data){
					$('.delete_append_success ul').text('');
					$('.delete_append_success').show();
					$('.delete_append_success ul').append("<li>"+data+"</li>");
          $('.UserInfo' + $('.id').text()).remove();
          setTimeout(function(){ $('.delete_append_success').hide(); },3000);
					setTimeout(function(){ $('.DeleteUserModal').modal('hide'); },3000);
					setTimeout(function(){ $('body').removeClass('modal-open'); },3000);
					setTimeout(function(){ $('.modal-backdrop').remove(); },3000);
        }
    });
  });

  $('.location_change').on('change',function(event){
		event.preventDefault();
		var data = {
			'id' : $(this).val()
		};

    $.ajax({
        type:'GET',
        url:'/get_location_rooms',
				data:data,
				dataType:"json",
        success:function(data){
					$('.append_rooms').show();
					var $dropdown = $('.room_append');
          var $append_d1 = $('.room_append').text('');
          var $append_d2 = $('.seat_append').text('');
          $append_d2.append($("<option>").val('').text('Select Seat'));
          $append_d1.append($("<option>").val('').text('Select Room'));
          $.each(data, function(key, value){
						$dropdown.append($("<option>").val(value.id).text(value.room_name));
					});
				}
    });
  });
  $('.room_change').on('change',function(event){
		event.preventDefault();
		var data = {
			'id' : $(this).val()
		};

    $.ajax({
        type:'GET',
        url:'/get_room_seats',
				data:data,
				dataType:"json",
        success:function(data){
					$('.append_seats').show();
					var $dropdown = $('.seat_append');
          var $append_d1 = $('.seat_append').text('');
          $append_d1.append($("<option>").val('').text('Select Seat'));
          $.each(data, function(key, value){
						$dropdown.append($("<option>").val(value.id).text(value.seat_no));
					});
				}
    });
  });

  $('input.end_date').bootstrapMaterialDatePicker({
    weekStart: 0,
    format: 'DD-MM-YYYY',
    time: false,
    clearButton: true
  });

  $('input.start_date').bootstrapMaterialDatePicker({
      weekStart: 0,
      format: 'DD-MM-YYYY',
      time: false,
      clearButton: true
  }).on('change', function(e, date) {
      $('input.end_date').bootstrapMaterialDatePicker('setMinDate', date);
      var set_d = moment(date).add(1, 'M').format('DD-MM-YYYY');
      $('input.end_date').bootstrapMaterialDatePicker('setMaxDate',set_d).val(set_d);
  });

  $('#membership_form').on('submit', function(event){
		event.preventDefault();

    $.ajax({
      url:"{{ url('admin/store_membership_info') }}",
      method:"POST",
      data:new FormData(this),
      dataType:"JSON",
			contentType:false,
			cache:false,
			processData:false,
      success:function(data){
				$('.append_errors ul').text('');
				$('.append_success ul').text('');
        if(data.errors)
        {
					$.each(data.errors, function(i, error){
						$('.append_errors').show();
            $('.append_errors ul').append("<li>" + data.errors[i] + "</li>");
        	});
        }else {
          var start_date = moment(data.start_date).format("D MMM YYYY");
          var end_date = moment(data.end_date).format("D MMM YYYY");

					// $('#append_membership_data').prepend("<tr class='UserInfo"+data.id+"'>"+
					// "<td>" + data.id + "</td>"+
					// "<td>" + data.name + ' ' + data.lname + "</td>"+
					// "<td>" + data.email + "</td>"+
					// "<td>" + phone_n + "</td>"+
					// "<td>" + full_address + "</td>"+
					// "<td>" + date + "</td>"+
					// "<td class='px-2 text-nowrap'><a href='#' class='edit_modal btn btn-sm btn-save' data-id='"+data.id+"' data-name='"+data.name+"' data-lname='"+data.lname+"' data-email='"+data.email+"' data-mobile_number='"+data.mobile_number+"' data-phone_number='"+data.phone_number+"' data-cnic_number='"+data.cnic_number+"' data-company_name='"+data.company_name+"' data-designation='"+data.designation+"' data-city='"+data.city+"' data-country='"+data.country+"' data-address='"+data.address+"' data-number_of_seats='"+data.number_of_seats+"' data-start_time='"+data.start_time+"' data-end_time='"+data.end_time+"' data-days='"+data.days+"' data-toggle='modal' data-target='#EditUserModal' data-whatever='@mdo'>"+
					// "<i class='fa fa-pencil'></i> Edit</a> "+
					// "<a href='#' class='delete_modal btn btn-sm btn-danger' data-id='"+data.id+"' data-name='"+data.name+"' data-lname='"+data.lname+"' data-toggle='modal' data-target='#DeleteUserModal' data-whatever='@mdo'>"+
					// "<i class='fa fa-trash'></i> Delete</a>"+
					// "</td>"+
					// "</tr>");
					$('#add_member').hide();
					$('#edit_member').show();
					$('.append_errors').hide();
					$('.append_success').show();
					$('.append_success ul').append("<li>Membership Completed Successfully.</li>");
          $('#membership_form')[0].reset();
					// setTimeout(function(){ $('.append_success').hide(); },3000);
					// setTimeout(function(){ $('#MemberModal').modal('hide'); },3000);
					// setTimeout(function(){ $('body').removeClass('modal-open'); },3000);
					// setTimeout(function(){ $('.modal-backdrop').remove(); },3000);
          location.reload();
	      }
      },
    });
  });
  $('#edit_membership_form').on('submit', function(event){
		event.preventDefault();

    $.ajax({
      url:"{{ url('admin/update_membership_info') }}",
      method:"POST",
      data:new FormData(this),
      dataType:"JSON",
			contentType:false,
			cache:false,
			processData:false,
      success:function(data){
				$('.append_errors ul').text('');
				$('.append_success ul').text('');
        if(data.errors)
        {
					$.each(data.errors, function(i, error){
						$('.append_errors').show();
            $('.append_errors ul').append("<li>" + data.errors[i] + "</li>");
        	});
        }else {
          var start_date = moment(data.start_date).format("D MMM YYYY");
          var end_date = moment(data.end_date).format("D MMM YYYY");


					$('#add_member').hide();
					$('#edit_member').show();
					$('.append_errors').hide();
					$('.append_success').show();
					$('.append_success ul').append("<li>Membership Updated Successfully.</li>");
          $('#edit_membership_form')[0].reset();

          location.reload();
	      }
      },
    });
  });

});
</script>
<style media="screen">
.close{
  font-size: 1.4rem;
}
.table-user-information > tbody > tr {
    border-top: 1px solid rgb(221, 221, 221);
}

.table-user-information > tbody > tr:first-child {
    border-top: 0;
}


.table-user-information > tbody > tr > td {
    border-top: 0;
}
.toppad {
  margin-top:20px;
}

.status_suspend{
  color: #fff;
  background-color: #dc3545;
  border-color: #dc3545;
  padding: .25rem .5rem;
  font-size: 16px;
  line-height: 1.5;
  border-radius: .2rem;
}
.status_confirmed{
  color: #fff;
  background-color: #28a745;
  border-color: #28a745;
  padding: .25rem .5rem;
  font-size: 16px;
  line-height: 1.5;
  border-radius: .2rem;
}
.status_temporary{
  color: #212529;
  background-color: #ffc107;
  border-color: #ffc107;
  padding: .25rem .5rem;
  font-size: 16px;
  line-height: 1.5;
  border-radius: .2rem;
}
</style>
@endsection
