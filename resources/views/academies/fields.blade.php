<!-- Basecolor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('BaseColor', 'Basecolor:') !!}
    {!! Form::text('BaseColor', null, ['class' => 'form-control']) !!}
</div>

<!-- Adampaid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('AdamPaid', 'Adampaid:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('AdamPaid', 0) !!}
        {!! Form::checkbox('AdamPaid', '1', null) !!} 1
    </label>
</div>

<!-- Basecolorlt Field -->
<div class="form-group col-sm-6">
    {!! Form::label('BaseColorLt', 'Basecolorlt:') !!}
    {!! Form::text('BaseColorLt', null, ['class' => 'form-control']) !!}
</div>

<!-- Minmonthlylessonsinc Field -->
<div class="form-group col-sm-6">
    {!! Form::label('MinMonthlyLessonsInc', 'Minmonthlylessonsinc:') !!}
    {!! Form::text('MinMonthlyLessonsInc', null, ['class' => 'form-control']) !!}
</div>

<!-- Dateholidayends Field -->
<div class="form-group col-sm-6">
    {!! Form::label('DateHolidayEnds', 'Dateholidayends:') !!}
    {!! Form::date('DateHolidayEnds', null, ['class' => 'form-control','id'=>'DateHolidayEnds']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#DateHolidayEnds').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Displayv1Models Field -->
<div class="form-group col-sm-6">
    {!! Form::label('DisplayV1Models', 'Displayv1Models:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('DisplayV1Models', 0) !!}
        {!! Form::checkbox('DisplayV1Models', '1', null) !!} 1
    </label>
</div>

<!-- Yt Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('YT_Password', 'Yt Password:') !!}
    {!! Form::text('YT_Password', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Name', 'Name:') !!}
    {!! Form::text('Name', null, ['class' => 'form-control']) !!}
</div>

<!-- Sendmoveemail Field -->
<div class="form-group col-sm-6">
    {!! Form::label('SendMoveEmail', 'Sendmoveemail:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('SendMoveEmail', 0) !!}
        {!! Form::checkbox('SendMoveEmail', '1', null) !!} 1
    </label>
</div>

<!-- Hidepoweredby Field -->
<div class="form-group col-sm-6">
    {!! Form::label('HidePoweredBy', 'Hidepoweredby:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('HidePoweredBy', 0) !!}
        {!! Form::checkbox('HidePoweredBy', '1', null) !!} 1
    </label>
</div>

<!-- Logo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Logo', 'Logo:') !!}
    {!! Form::text('Logo', null, ['class' => 'form-control']) !!}
</div>

<!-- Contractpdf Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ContractPDF', 'Contractpdf:') !!}
    {!! Form::text('ContractPDF', null, ['class' => 'form-control']) !!}
</div>

<!-- Live Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Live', 'Live:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('Live', 0) !!}
        {!! Form::checkbox('Live', '1', null) !!} 1
    </label>
</div>

<!-- Proadv Serial Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ProAdv_Serial', 'Proadv Serial:') !!}
    {!! Form::text('ProAdv_Serial', null, ['class' => 'form-control']) !!}
</div>

<!-- Tw Secret Field -->
<div class="form-group col-sm-6">
    {!! Form::label('TW_Secret', 'Tw Secret:') !!}
    {!! Form::text('TW_Secret', null, ['class' => 'form-control']) !!}
</div>

<!-- Yt Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('YT_URL', 'Yt Url:') !!}
    {!! Form::text('YT_URL', null, ['class' => 'form-control']) !!}
</div>

<!-- Createdweburl Field -->
<div class="form-group col-sm-6">
    {!! Form::label('CreatedWebURL', 'Createdweburl:') !!}
    {!! Form::text('CreatedWebURL', null, ['class' => 'form-control']) !!}
</div>

<!-- Privateflag Field -->
<div class="form-group col-sm-6">
    {!! Form::label('PrivateFlag', 'Privateflag:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('PrivateFlag', 0) !!}
        {!! Form::checkbox('PrivateFlag', '1', null) !!} 1
    </label>
</div>

<!-- Fb Userid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('FB_UserID', 'Fb Userid:') !!}
    {!! Form::text('FB_UserID', null, ['class' => 'form-control']) !!}
</div>

<!-- Secondarysalesperson Field -->
<div class="form-group col-sm-6">
    {!! Form::label('SecondarySalesPerson', 'Secondarysalesperson:') !!}
    {!! Form::text('SecondarySalesPerson', null, ['class' => 'form-control']) !!}
</div>

<!-- Samplelesson Field -->
<div class="form-group col-sm-6">
    {!! Form::label('SampleLesson', 'Samplelesson:') !!}
    {!! Form::text('SampleLesson', null, ['class' => 'form-control']) !!}
</div>

<!-- Datetraining Field -->
<div class="form-group col-sm-6">
    {!! Form::label('DateTraining', 'Datetraining:') !!}
    {!! Form::date('DateTraining', null, ['class' => 'form-control','id'=>'DateTraining']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#DateTraining').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Notbuiltflag Field -->
<div class="form-group col-sm-6">
    {!! Form::label('NotBuiltFlag', 'Notbuiltflag:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('NotBuiltFlag', 0) !!}
        {!! Form::checkbox('NotBuiltFlag', '1', null) !!} 1
    </label>
</div>

<!-- Logingraphic Field -->
<div class="form-group col-sm-6">
    {!! Form::label('LogInGraphic', 'Logingraphic:') !!}
    {!! Form::text('LogInGraphic', null, ['class' => 'form-control']) !!}
</div>

<!-- Modelspage Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ModelsPage', 'Modelspage:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('ModelsPage', 0) !!}
        {!! Form::checkbox('ModelsPage', '1', null) !!} 1
    </label>
</div>

<!-- Enddate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('EndDate', 'Enddate:') !!}
    {!! Form::text('EndDate', null, ['class' => 'form-control']) !!}
</div>

<!-- Fb Oauth Token Field -->
<div class="form-group col-sm-6">
    {!! Form::label('FB_OAuth_Token', 'Fb Oauth Token:') !!}
    {!! Form::text('FB_OAuth_Token', null, ['class' => 'form-control']) !!}
</div>

<!-- Promoid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('PromoID', 'Promoid:') !!}
    {!! Form::text('PromoID', null, ['class' => 'form-control']) !!}
</div>

<!-- Billingstatusid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('BillingStatusID', 'Billingstatusid:') !!}
    {!! Form::text('BillingStatusID', null, ['class' => 'form-control']) !!}
</div>

<!-- Dividebythreshold Field -->
<div class="form-group col-sm-6">
    {!! Form::label('DivideByThreshold', 'Dividebythreshold:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('DivideByThreshold', 0) !!}
        {!! Form::checkbox('DivideByThreshold', '1', null) !!} 1
    </label>
</div>

<!-- Sportid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('SportID', 'Sportid:') !!}
    {!! Form::text('SportID', null, ['class' => 'form-control']) !!}
</div>

<!-- Bodytext Field -->
<div class="form-group col-sm-6">
    {!! Form::label('BodyText', 'Bodytext:') !!}
    {!! Form::text('BodyText', null, ['class' => 'form-control']) !!}
</div>

<!-- Tw Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('TW_Password', 'Tw Password:') !!}
    {!! Form::text('TW_Password', null, ['class' => 'form-control']) !!}
</div>

<!-- Selectedcolormed Field -->
<div class="form-group col-sm-6">
    {!! Form::label('SelectedColorMed', 'Selectedcolormed:') !!}
    {!! Form::text('SelectedColorMed', null, ['class' => 'form-control']) !!}
</div>

<!-- Mailchimpkey Field -->
<div class="form-group col-sm-6">
    {!! Form::label('MailChimpKey', 'Mailchimpkey:') !!}
    {!! Form::text('MailChimpKey', null, ['class' => 'form-control']) !!}
</div>

<!-- Fb Url Long Field -->
<div class="form-group col-sm-6">
    {!! Form::label('FB_URL_Long', 'Fb Url Long:') !!}
    {!! Form::text('FB_URL_Long', null, ['class' => 'form-control']) !!}
</div>

<!-- Secureflag Field -->
<div class="form-group col-sm-6">
    {!! Form::label('SecureFlag', 'Secureflag:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('SecureFlag', 0) !!}
        {!! Form::checkbox('SecureFlag', '1', null) !!} 1
    </label>
</div>

<!-- Datelessoncaddy Field -->
<div class="form-group col-sm-6">
    {!! Form::label('DateLessonCaddy', 'Datelessoncaddy:') !!}
    {!! Form::date('DateLessonCaddy', null, ['class' => 'form-control','id'=>'DateLessonCaddy']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#DateLessonCaddy').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Startdate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('StartDate', 'Startdate:') !!}
    {!! Form::text('StartDate', null, ['class' => 'form-control']) !!}
</div>

<!-- Dateadded Field -->
<div class="form-group col-sm-6">
    {!! Form::label('DateAdded', 'Dateadded:') !!}
    {!! Form::date('DateAdded', null, ['class' => 'form-control','id'=>'DateAdded']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#DateAdded').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Basecolormed Field -->
<div class="form-group col-sm-6">
    {!! Form::label('BaseColorMed', 'Basecolormed:') !!}
    {!! Form::text('BaseColorMed', null, ['class' => 'form-control']) !!}
</div>

<!-- Minmonthlybilling Field -->
<div class="form-group col-sm-6">
    {!! Form::label('MinMonthlyBilling', 'Minmonthlybilling:') !!}
    {!! Form::text('MinMonthlyBilling', null, ['class' => 'form-control']) !!}
</div>

<!-- Createdwebpw Field -->
<div class="form-group col-sm-6">
    {!! Form::label('CreatedWebPW', 'Createdwebpw:') !!}
    {!! Form::text('CreatedWebPW', null, ['class' => 'form-control']) !!}
</div>

<!-- Iframe Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('IFrame_URL', 'Iframe Url:') !!}
    {!! Form::text('IFrame_URL', null, ['class' => 'form-control']) !!}
</div>

<!-- Hashtagflag Field -->
<div class="form-group col-sm-6">
    {!! Form::label('HashTagFlag', 'Hashtagflag:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('HashTagFlag', 0) !!}
        {!! Form::checkbox('HashTagFlag', '1', null) !!} 1
    </label>
</div>

<!-- Toptextselectedcolor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('TopTextSelectedColor', 'Toptextselectedcolor:') !!}
    {!! Form::text('TopTextSelectedColor', null, ['class' => 'form-control']) !!}
</div>

<!-- Iframe Height Field -->
<div class="form-group col-sm-6">
    {!! Form::label('IFrame_Height', 'Iframe Height:') !!}
    {!! Form::text('IFrame_Height', null, ['class' => 'form-control']) !!}
</div>

<!-- Datetrainingcontact Field -->
<div class="form-group col-sm-6">
    {!! Form::label('DateTrainingContact', 'Datetrainingcontact:') !!}
    {!! Form::date('DateTrainingContact', null, ['class' => 'form-control','id'=>'DateTrainingContact']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#DateTrainingContact').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Sendanalysisemail Field -->
<div class="form-group col-sm-6">
    {!! Form::label('SendAnalysisEmail', 'Sendanalysisemail:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('SendAnalysisEmail', 0) !!}
        {!! Form::checkbox('SendAnalysisEmail', '1', null) !!} 1
    </label>
</div>

<!-- Adminaccountid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('AdminAccountID', 'Adminaccountid:') !!}
    {!! Form::text('AdminAccountID', null, ['class' => 'form-control']) !!}
</div>

<!-- Lessoncharge Field -->
<div class="form-group col-sm-6">
    {!! Form::label('LessonCharge', 'Lessoncharge:') !!}
    {!! Form::text('LessonCharge', null, ['class' => 'form-control']) !!}
</div>

<!-- Commissionpercentage Field -->
<div class="form-group col-sm-6">
    {!! Form::label('CommissionPercentage', 'Commissionpercentage:') !!}
    {!! Form::text('CommissionPercentage', null, ['class' => 'form-control']) !!}
</div>

<!-- Endnotes Field -->
<div class="form-group col-sm-6">
    {!! Form::label('EndNotes', 'Endnotes:') !!}
    {!! Form::text('EndNotes', null, ['class' => 'form-control']) !!}
</div>

<!-- Creditcard Field -->
<div class="form-group col-sm-6">
    {!! Form::label('CreditCard', 'Creditcard:') !!}
    {!! Form::text('CreditCard', null, ['class' => 'form-control']) !!}
</div>

<!-- Tw Key Field -->
<div class="form-group col-sm-6">
    {!! Form::label('TW_Key', 'Tw Key:') !!}
    {!! Form::text('TW_Key', null, ['class' => 'form-control']) !!}
</div>

<!-- Datev1Proapp Field -->
<div class="form-group col-sm-6">
    {!! Form::label('DateV1ProApp', 'Datev1Proapp:') !!}
    {!! Form::date('DateV1ProApp', null, ['class' => 'form-control','id'=>'DateV1ProApp']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#DateV1ProApp').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Createdweblogin Field -->
<div class="form-group col-sm-6">
    {!! Form::label('CreatedWebLogin', 'Createdweblogin:') !!}
    {!! Form::text('CreatedWebLogin', null, ['class' => 'form-control']) !!}
</div>

<!-- Toptextbasecolor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('TopTextBaseColor', 'Toptextbasecolor:') !!}
    {!! Form::text('TopTextBaseColor', null, ['class' => 'form-control']) !!}
</div>

<!-- Fb Fanpage Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('FB_FanPage_ID', 'Fb Fanpage Id:') !!}
    {!! Form::text('FB_FanPage_ID', null, ['class' => 'form-control']) !!}
</div>

<!-- Emailbody Field -->
<div class="form-group col-sm-6">
    {!! Form::label('EmailBody', 'Emailbody:') !!}
    {!! Form::text('EmailBody', null, ['class' => 'form-control']) !!}
</div>

<!-- Discountflag Field -->
<div class="form-group col-sm-6">
    {!! Form::label('DiscountFlag', 'Discountflag:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('DiscountFlag', 0) !!}
        {!! Form::checkbox('DiscountFlag', '1', null) !!} 1
    </label>
</div>

<!-- V1Ga Locker Field -->
<div class="form-group col-sm-6">
    {!! Form::label('V1GA_Locker', 'V1Ga Locker:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('V1GA_Locker', 0) !!}
        {!! Form::checkbox('V1GA_Locker', '1', null) !!} 1
    </label>
</div>

<!-- Contactname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ContactName', 'Contactname:') !!}
    {!! Form::text('ContactName', null, ['class' => 'form-control']) !!}
</div>

<!-- Annualrenewfee Field -->
<div class="form-group col-sm-6">
    {!! Form::label('AnnualRenewFee', 'Annualrenewfee:') !!}
    {!! Form::text('AnnualRenewFee', null, ['class' => 'form-control']) !!}
</div>

<!-- Prepayedmonths Field -->
<div class="form-group col-sm-6">
    {!! Form::label('PrePayedMonths', 'Prepayedmonths:') !!}
    {!! Form::text('PrePayedMonths', null, ['class' => 'form-control']) !!}
</div>

<!-- Salesperson Field -->
<div class="form-group col-sm-6">
    {!! Form::label('SalesPerson', 'Salesperson:') !!}
    {!! Form::text('SalesPerson', null, ['class' => 'form-control']) !!}
</div>

<!-- Selectedcolor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('SelectedColor', 'Selectedcolor:') !!}
    {!! Form::text('SelectedColor', null, ['class' => 'form-control']) !!}
</div>

<!-- Freelessons Field -->
<div class="form-group col-sm-6">
    {!! Form::label('FreeLessons', 'Freelessons:') !!}
    {!! Form::text('FreeLessons', null, ['class' => 'form-control']) !!}
</div>

<!-- Contactemail Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ContactEmail', 'Contactemail:') !!}
    {!! Form::text('ContactEmail', null, ['class' => 'form-control']) !!}
</div>

<!-- Yt Username Field -->
<div class="form-group col-sm-6">
    {!! Form::label('YT_UserName', 'Yt Username:') !!}
    {!! Form::text('YT_UserName', null, ['class' => 'form-control']) !!}
</div>

<!-- Ratingflag Field -->
<div class="form-group col-sm-6">
    {!! Form::label('RatingFlag', 'Ratingflag:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('RatingFlag', 0) !!}
        {!! Form::checkbox('RatingFlag', '1', null) !!} 1
    </label>
</div>

<!-- Bodyfont Field -->
<div class="form-group col-sm-6">
    {!! Form::label('BodyFont', 'Bodyfont:') !!}
    {!! Form::text('BodyFont', null, ['class' => 'form-control']) !!}
</div>

<!-- Yt Login Field -->
<div class="form-group col-sm-6">
    {!! Form::label('YT_Login', 'Yt Login:') !!}
    {!! Form::text('YT_Login', null, ['class' => 'form-control']) !!}
</div>

<!-- Hiddenflag Field -->
<div class="form-group col-sm-6">
    {!! Form::label('HiddenFlag', 'Hiddenflag:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('HiddenFlag', 0) !!}
        {!! Form::checkbox('HiddenFlag', '1', null) !!} 1
    </label>
</div>

<!-- Frontpagetext2 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('FrontPageText2', 'Frontpagetext2:') !!}
    {!! Form::text('FrontPageText2', null, ['class' => 'form-control']) !!}
</div>

<!-- Yt Refresh Field -->
<div class="form-group col-sm-6">
    {!! Form::label('YT_Refresh', 'Yt Refresh:') !!}
    {!! Form::text('YT_Refresh', null, ['class' => 'form-control']) !!}
</div>

<!-- Creditcard Exp Field -->
<div class="form-group col-sm-6">
    {!! Form::label('CreditCard_Exp', 'Creditcard Exp:') !!}
    {!! Form::text('CreditCard_Exp', null, ['class' => 'form-control']) !!}
</div>

<!-- Commissionpercentage Yearplus Field -->
<div class="form-group col-sm-6">
    {!! Form::label('CommissionPercentage_YearPlus', 'Commissionpercentage Yearplus:') !!}
    {!! Form::text('CommissionPercentage_YearPlus', null, ['class' => 'form-control']) !!}
</div>

<!-- Yt Channelflag Field -->
<div class="form-group col-sm-6">
    {!! Form::label('YT_ChannelFlag', 'Yt Channelflag:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('YT_ChannelFlag', 0) !!}
        {!! Form::checkbox('YT_ChannelFlag', '1', null) !!} 1
    </label>
</div>

<!-- Splitcommission Field -->
<div class="form-group col-sm-6">
    {!! Form::label('SplitCommission', 'Splitcommission:') !!}
    {!! Form::text('SplitCommission', null, ['class' => 'form-control']) !!}
</div>

<!-- Bg Lightdark Field -->
<div class="form-group col-sm-6">
    {!! Form::label('BG_LightDark', 'Bg Lightdark:') !!}
    {!! Form::text('BG_LightDark', null, ['class' => 'form-control']) !!}
</div>

<!-- Saveasflag Field -->
<div class="form-group col-sm-6">
    {!! Form::label('SaveAsFlag', 'Saveasflag:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('SaveAsFlag', 0) !!}
        {!! Form::checkbox('SaveAsFlag', '1', null) !!} 1
    </label>
</div>

<!-- Toptextfont Field -->
<div class="form-group col-sm-6">
    {!! Form::label('TopTextFont', 'Toptextfont:') !!}
    {!! Form::text('TopTextFont', null, ['class' => 'form-control']) !!}
</div>

<!-- Fb Sessionkey Field -->
<div class="form-group col-sm-6">
    {!! Form::label('FB_SessionKey', 'Fb Sessionkey:') !!}
    {!! Form::text('FB_SessionKey', null, ['class' => 'form-control']) !!}
</div>

<!-- Iframe Width Field -->
<div class="form-group col-sm-6">
    {!! Form::label('IFrame_Width', 'Iframe Width:') !!}
    {!! Form::text('IFrame_Width', null, ['class' => 'form-control']) !!}
</div>

<!-- Bgcolor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('BGColor', 'Bgcolor:') !!}
    {!! Form::text('BGColor', null, ['class' => 'form-control']) !!}
</div>

<!-- Commissionpercentage Overage Field -->
<div class="form-group col-sm-6">
    {!! Form::label('CommissionPercentage_Overage', 'Commissionpercentage Overage:') !!}
    {!! Form::text('CommissionPercentage_Overage', null, ['class' => 'form-control']) !!}
</div>

<!-- Academycountry Field -->
<div class="form-group col-sm-6">
    {!! Form::label('AcademyCountry', 'Academycountry:') !!}
    {!! Form::text('AcademyCountry', null, ['class' => 'form-control']) !!}
</div>

<!-- Creditcard Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('CreditCard_Name', 'Creditcard Name:') !!}
    {!! Form::text('CreditCard_Name', null, ['class' => 'form-control']) !!}
</div>

<!-- Displayv1Drills Field -->
<div class="form-group col-sm-6">
    {!! Form::label('DisplayV1Drills', 'Displayv1Drills:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('DisplayV1Drills', 0) !!}
        {!! Form::checkbox('DisplayV1Drills', '1', null) !!} 1
    </label>
</div>

<!-- Playerpartnerlogos Field -->
<div class="form-group col-sm-6">
    {!! Form::label('PlayerPartnerLogos', 'Playerpartnerlogos:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('PlayerPartnerLogos', 0) !!}
        {!! Form::checkbox('PlayerPartnerLogos', '1', null) !!} 1
    </label>
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Description', 'Description:') !!}
    {!! Form::text('Description', null, ['class' => 'form-control']) !!}
</div>

<!-- Tw Login Field -->
<div class="form-group col-sm-6">
    {!! Form::label('TW_Login', 'Tw Login:') !!}
    {!! Form::text('TW_Login', null, ['class' => 'form-control']) !!}
</div>

<!-- Frontpagetext1 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('FrontPageText1', 'Frontpagetext1:') !!}
    {!! Form::text('FrontPageText1', null, ['class' => 'form-control']) !!}
</div>

<!-- Selectedcolorlt Field -->
<div class="form-group col-sm-6">
    {!! Form::label('SelectedColorLt', 'Selectedcolorlt:') !!}
    {!! Form::text('SelectedColorLt', null, ['class' => 'form-control']) !!}
</div>

<!-- Startup Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Startup', 'Startup:') !!}
    {!! Form::text('Startup', null, ['class' => 'form-control']) !!}
</div>

<!-- Fb Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('FB_URL', 'Fb Url:') !!}
    {!! Form::text('FB_URL', null, ['class' => 'form-control']) !!}
</div>

<!-- Datev1Prosoftware Field -->
<div class="form-group col-sm-6">
    {!! Form::label('DateV1ProSoftware', 'Datev1Prosoftware:') !!}
    {!! Form::date('DateV1ProSoftware', null, ['class' => 'form-control','id'=>'DateV1ProSoftware']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#DateV1ProSoftware').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Bannertext Field -->
<div class="form-group col-sm-6">
    {!! Form::label('BannerText', 'Bannertext:') !!}
    {!! Form::text('BannerText', null, ['class' => 'form-control']) !!}
</div>

<!-- Lessonthreshold Field -->
<div class="form-group col-sm-6">
    {!! Form::label('LessonThreshold', 'Lessonthreshold:') !!}
    {!! Form::text('LessonThreshold', null, ['class' => 'form-control']) !!}
</div>

<!-- Translate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Translate', 'Translate:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('Translate', 0) !!}
        {!! Form::checkbox('Translate', '1', null) !!} 1
    </label>
</div>

<!-- Notes Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Notes', 'Notes:') !!}
    {!! Form::text('Notes', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('academies.index') !!}" class="btn btn-default">Cancel</a>
</div>
