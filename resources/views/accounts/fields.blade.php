<!-- Oldaccountid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('OldAccountID', 'Oldaccountid:') !!}
    {!! Form::text('OldAccountID', null, ['class' => 'form-control']) !!}
</div>

<!-- Cardexpires Field -->
<div class="form-group col-sm-6">
    {!! Form::label('CardExpires', 'Cardexpires:') !!}
    {!! Form::text('CardExpires', null, ['class' => 'form-control']) !!}
</div>

<!-- Billphone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('BillPhone', 'Billphone:') !!}
    {!! Form::text('BillPhone', null, ['class' => 'form-control']) !!}
</div>

<!-- Lastname U Field -->
<div class="form-group col-sm-6">
    {!! Form::label('LastName_U', 'Lastname U:') !!}
    {!! Form::text('LastName_U', null, ['class' => 'form-control']) !!}
</div>

<!-- Lessonlevel Field -->
<div class="form-group col-sm-6">
    {!! Form::label('LessonLevel', 'Lessonlevel:') !!}
    {!! Form::text('LessonLevel', null, ['class' => 'form-control']) !!}
</div>

<!-- Cxnspeed Field -->
<div class="form-group col-sm-6">
    {!! Form::label('CxnSpeed', 'Cxnspeed:') !!}
    {!! Form::text('CxnSpeed', null, ['class' => 'form-control']) !!}
</div>

<!-- Lastname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('LastName', 'Lastname:') !!}
    {!! Form::text('LastName', null, ['class' => 'form-control']) !!}
</div>

<!-- Birthdate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Birthdate', 'Birthdate:') !!}
    {!! Form::date('Birthdate', null, ['class' => 'form-control','id'=>'Birthdate']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#Birthdate').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Alwaysusedefault Field -->
<div class="form-group col-sm-6">
    {!! Form::label('AlwaysUseDefault', 'Alwaysusedefault:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('AlwaysUseDefault', 0) !!}
        {!! Form::checkbox('AlwaysUseDefault', '1', null) !!} 1
    </label>
</div>

<!-- Cardtype Field -->
<div class="form-group col-sm-6">
    {!! Form::label('CardType', 'Cardtype:') !!}
    {!! Form::text('CardType', null, ['class' => 'form-control']) !!}
</div>

<!-- Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Phone', 'Phone:') !!}
    {!! Form::text('Phone', null, ['class' => 'form-control']) !!}
</div>

<!-- Autosms Field -->
<div class="form-group col-sm-6">
    {!! Form::label('AutoSMS', 'Autosms:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('AutoSMS', 0) !!}
        {!! Form::checkbox('AutoSMS', '1', null) !!} 1
    </label>
</div>

<!-- Notifyme Field -->
<div class="form-group col-sm-6">
    {!! Form::label('NotifyMe', 'Notifyme:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('NotifyMe', 0) !!}
        {!! Form::checkbox('NotifyMe', '1', null) !!} 1
    </label>
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Email', 'Email:') !!}
    {!! Form::text('Email', null, ['class' => 'form-control']) !!}
</div>

<!-- Vimeo Token Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Vimeo_Token', 'Vimeo Token:') !!}
    {!! Form::text('Vimeo_Token', null, ['class' => 'form-control']) !!}
</div>

<!-- Passwordex Field -->
<div class="form-group col-sm-6">
    {!! Form::label('PasswordEx', 'Passwordex:') !!}
    {!! Form::text('PasswordEx', null, ['class' => 'form-control']) !!}
</div>

<!-- Billstate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('BillState', 'Billstate:') !!}
    {!! Form::text('BillState', null, ['class' => 'form-control']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Address', 'Address:') !!}
    {!! Form::text('Address', null, ['class' => 'form-control']) !!}
</div>

<!-- Optout Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Optout', 'Optout:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('Optout', 0) !!}
        {!! Form::checkbox('Optout', '1', null) !!} 1
    </label>
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Password', 'Password:') !!}
    {!! Form::text('Password', null, ['class' => 'form-control']) !!}
</div>

<!-- Lessonlocation Field -->
<div class="form-group col-sm-6">
    {!! Form::label('LessonLocation', 'Lessonlocation:') !!}
    {!! Form::text('LessonLocation', null, ['class' => 'form-control']) !!}
</div>

<!-- Siteid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('SiteID', 'Siteid:') !!}
    {!! Form::text('SiteID', null, ['class' => 'form-control']) !!}
</div>

<!-- Cardnumberex Field -->
<div class="form-group col-sm-6">
    {!! Form::label('CardNumberEx', 'Cardnumberex:') !!}
    {!! Form::text('CardNumberEx', null, ['class' => 'form-control']) !!}
</div>

<!-- Zip Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Zip', 'Zip:') !!}
    {!! Form::text('Zip', null, ['class' => 'form-control']) !!}
</div>

<!-- Billphoneext Field -->
<div class="form-group col-sm-6">
    {!! Form::label('BillPhoneExt', 'Billphoneext:') !!}
    {!! Form::text('BillPhoneExt', null, ['class' => 'form-control']) !!}
</div>

<!-- Billstreet Field -->
<div class="form-group col-sm-6">
    {!! Form::label('BillStreet', 'Billstreet:') !!}
    {!! Form::text('BillStreet', null, ['class' => 'form-control']) !!}
</div>

<!-- Lessonagerange Field -->
<div class="form-group col-sm-6">
    {!! Form::label('LessonAgeRange', 'Lessonagerange:') !!}
    {!! Form::text('LessonAgeRange', null, ['class' => 'form-control']) !!}
</div>

<!-- Os Field -->
<div class="form-group col-sm-6">
    {!! Form::label('OS', 'Os:') !!}
    {!! Form::text('OS', null, ['class' => 'form-control']) !!}
</div>

<!-- Balance Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Balance', 'Balance:') !!}
    {!! Form::text('Balance', null, ['class' => 'form-control']) !!}
</div>

<!-- Cardcvv Field -->
<div class="form-group col-sm-6">
    {!! Form::label('CardCVV', 'Cardcvv:') !!}
    {!! Form::text('CardCVV', null, ['class' => 'form-control']) !!}
</div>

<!-- Instructorid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('InstructorID', 'Instructorid:') !!}
    {!! Form::text('InstructorID', null, ['class' => 'form-control']) !!}
</div>

<!-- Carddescript Field -->
<div class="form-group col-sm-6">
    {!! Form::label('CardDescript', 'Carddescript:') !!}
    {!! Form::text('CardDescript', null, ['class' => 'form-control']) !!}
</div>

<!-- Procodeupdate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ProCodeUpdate', 'Procodeupdate:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('ProCodeUpdate', 0) !!}
        {!! Form::checkbox('ProCodeUpdate', '1', null) !!} 1
    </label>
</div>

<!-- Billapt Field -->
<div class="form-group col-sm-6">
    {!! Form::label('BillApt', 'Billapt:') !!}
    {!! Form::text('BillApt', null, ['class' => 'form-control']) !!}
</div>

<!-- Cookielogin Field -->
<div class="form-group col-sm-6">
    {!! Form::label('CookieLogin', 'Cookielogin:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('CookieLogin', 0) !!}
        {!! Form::checkbox('CookieLogin', '1', null) !!} 1
    </label>
</div>

<!-- Autofb Field -->
<div class="form-group col-sm-6">
    {!! Form::label('AutoFB', 'Autofb:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('AutoFB', 0) !!}
        {!! Form::checkbox('AutoFB', '1', null) !!} 1
    </label>
</div>

<!-- Closed Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Closed', 'Closed:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('Closed', 0) !!}
        {!! Form::checkbox('Closed', '1', null) !!} 1
    </label>
</div>

<!-- Fb Oauth Token Field -->
<div class="form-group col-sm-6">
    {!! Form::label('FB_OAuth_Token', 'Fb Oauth Token:') !!}
    {!! Form::text('FB_OAuth_Token', null, ['class' => 'form-control']) !!}
</div>

<!-- Billzip Field -->
<div class="form-group col-sm-6">
    {!! Form::label('BillZip', 'Billzip:') !!}
    {!! Form::text('BillZip', null, ['class' => 'form-control']) !!}
</div>

<!-- City Field -->
<div class="form-group col-sm-6">
    {!! Form::label('City', 'City:') !!}
    {!! Form::text('City', null, ['class' => 'form-control']) !!}
</div>

<!-- Cardholder Field -->
<div class="form-group col-sm-6">
    {!! Form::label('CardHolder', 'Cardholder:') !!}
    {!! Form::text('CardHolder', null, ['class' => 'form-control']) !!}
</div>

<!-- Fb Userid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('FB_UserID', 'Fb Userid:') !!}
    {!! Form::text('FB_UserID', null, ['class' => 'form-control']) !!}
</div>

<!-- Country Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Country', 'Country:') !!}
    {!! Form::text('Country', null, ['class' => 'form-control']) !!}
</div>

<!-- Passwordsalt Field -->
<div class="form-group col-sm-6">
    {!! Form::label('PasswordSalt', 'Passwordsalt:') !!}
    {!! Form::text('PasswordSalt', null, ['class' => 'form-control']) !!}
</div>

<!-- State Field -->
<div class="form-group col-sm-6">
    {!! Form::label('State', 'State:') !!}
    {!! Form::text('State', null, ['class' => 'form-control']) !!}
</div>

<!-- Billcompany Field -->
<div class="form-group col-sm-6">
    {!! Form::label('BillCompany', 'Billcompany:') !!}
    {!! Form::text('BillCompany', null, ['class' => 'form-control']) !!}
</div>

<!-- Fb Sessionkey Field -->
<div class="form-group col-sm-6">
    {!! Form::label('FB_SessionKey', 'Fb Sessionkey:') !!}
    {!! Form::text('FB_SessionKey', null, ['class' => 'form-control']) !!}
</div>

<!-- Lessongender Field -->
<div class="form-group col-sm-6">
    {!! Form::label('LessonGender', 'Lessongender:') !!}
    {!! Form::text('LessonGender', null, ['class' => 'form-control']) !!}
</div>

<!-- Lastaccessed Field -->
<div class="form-group col-sm-6">
    {!! Form::label('LastAccessed', 'Lastaccessed:') !!}
    {!! Form::date('LastAccessed', null, ['class' => 'form-control','id'=>'LastAccessed']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#LastAccessed').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Dateopened Field -->
<div class="form-group col-sm-6">
    {!! Form::label('DateOpened', 'Dateopened:') !!}
    {!! Form::date('DateOpened', null, ['class' => 'form-control','id'=>'DateOpened']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#DateOpened').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Passwordhash Field -->
<div class="form-group col-sm-6">
    {!! Form::label('PasswordHash', 'Passwordhash:') !!}
    {!! Form::text('PasswordHash', null, ['class' => 'form-control']) !!}
</div>

<!-- Addressheader Field -->
<div class="form-group col-sm-6">
    {!! Form::label('AddressHeader', 'Addressheader:') !!}
    {!! Form::text('AddressHeader', null, ['class' => 'form-control']) !!}
</div>

<!-- Billcity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('BillCity', 'Billcity:') !!}
    {!! Form::text('BillCity', null, ['class' => 'form-control']) !!}
</div>

<!-- Cardnumber Field -->
<div class="form-group col-sm-6">
    {!! Form::label('CardNumber', 'Cardnumber:') !!}
    {!! Form::text('CardNumber', null, ['class' => 'form-control']) !!}
</div>

<!-- Lessonfeerange Field -->
<div class="form-group col-sm-6">
    {!! Form::label('LessonFeeRange', 'Lessonfeerange:') !!}
    {!! Form::text('LessonFeeRange', null, ['class' => 'form-control']) !!}
</div>

<!-- Firstname U Field -->
<div class="form-group col-sm-6">
    {!! Form::label('FirstName_U', 'Firstname U:') !!}
    {!! Form::text('FirstName_U', null, ['class' => 'form-control']) !!}
</div>

<!-- Firstname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('FirstName', 'Firstname:') !!}
    {!! Form::text('FirstName', null, ['class' => 'form-control']) !!}
</div>

<!-- Gender Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Gender', 'Gender:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('Gender', 0) !!}
        {!! Form::checkbox('Gender', '1', null) !!} 1
    </label>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('accounts.index') !!}" class="btn btn-default">Cancel</a>
</div>
